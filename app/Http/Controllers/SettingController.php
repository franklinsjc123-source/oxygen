<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repository\SharedRepo;
use App\Helper\CommonHelper;
use App\Repository\ProfileRepo;
use App\Helper\ImageUploadHelper\ImageUploadHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{ 
    public function __construct(SharedRepo $sharedRepo, CommonHelper $commonHelper, ProfileRepo $profileRepo)
    {
        $this->sharedRepo   = $sharedRepo;
        $this->commonHelper = $commonHelper;
        $this->profileRepo  = $profileRepo;
    }

    public function profile()
    {
        $userId  = Session::get('userId');
        $status  = Session::get('status');
        $loginId = Session::get('login_id');

        $viewBag['data'] = $this->profileRepo->getRecords($userId); 
        
        if ($status == 2) {
            $vendor = null;
            if ($loginId) {
                $vendor = DB::table('vendor_details')->where('id', $loginId)->first();
            }
            if (!$vendor && $userId) {
                $vendor = DB::table('vendor_details')->where('user_id', $userId)->first();
            }

            $viewBag['vendor'] = $vendor;
            $viewBag['data']['vendor'] = $vendor;

            return view('layout.vendor.setting.profile', $viewBag);
        }
        
        return view('layout.admin.setting.profile', $viewBag);
    }

    public function updateVendorProfile(Request $request)
    {
        $userId  = Session::get('userId');
        $loginId = Session::get('login_id');

        $vendor = null;
        if ($loginId) {
            $vendor = DB::table('vendor_details')->where('id', $loginId)->first();
        }
        if (!$vendor && $userId) {
            $vendor = DB::table('vendor_details')->where('user_id', $userId)->first();
        }

        if (!$vendor) {
            return redirect()->back()->with('error', 'Vendor record not found.');
        }

        // Format Facebook link
        $facebookLink = trim((string) $request->input('facebook_link', ''));
        if (!empty($facebookLink) && !preg_match('~^(?:f|ht)tps?://~i', $facebookLink)) {
            if (str_starts_with($facebookLink, 'facebook.com/')) {
                $facebookLink = 'https://' . $facebookLink;
            } else {
                $facebookLink = 'https://facebook.com/' . ltrim($facebookLink, '@/');
            }
        }

        // Format Instagram link
        $instagramLink = trim((string) $request->input('instagram_link', ''));
        if (!empty($instagramLink) && !preg_match('~^(?:f|ht)tps?://~i', $instagramLink)) {
            if (str_starts_with($instagramLink, 'instagram.com/')) {
                $instagramLink = 'https://' . $instagramLink;
            } else {
                $instagramLink = 'https://instagram.com/' . ltrim($instagramLink, '@/');
            }
        }

        // WhatsApp number
        $whatsappNumber = trim((string) $request->input('whatsapp_number', ''));

        $updateData = [
            'facebook_link'   => $facebookLink ?: null,
            'instagram_link'  => $instagramLink ?: null,
            'whatsapp_number' => $whatsappNumber ?: null,
            'updated_at'      => now(),
        ];

        if ($request->filled('shop_name')) {
            $updateData['shop_name'] = trim((string) $request->input('shop_name'));
        }
        if ($request->filled('owner_name')) {
            $updateData['owner_name'] = trim((string) $request->input('owner_name'));
        }
        if ($request->filled('mobile_number1')) {
            $updateData['mobile_number1'] = trim((string) $request->input('mobile_number1'));
        }
        if ($request->filled('address')) {
            $updateData['address'] = trim((string) $request->input('address'));
        }

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            if ($file && $file->isValid()) {
                $storedImage = ImageUploadHelper::storeImage($file, 'assets/images/vendor/profile');
                if ($storedImage) {
                    $updateData['profile_image'] = $storedImage;
                }
            }
        }

        DB::table('vendor_details')->where('id', $vendor->id)->update($updateData);

        // Sync with users table
        if ($userId) {
            $userUpdate = [];
            if ($request->filled('owner_name')) {
                $userUpdate['name']     = trim((string) $request->input('owner_name'));
                $userUpdate['lastName'] = trim((string) $request->input('owner_name'));
            }
            if ($request->filled('shop_name')) {
                $userUpdate['firstName'] = trim((string) $request->input('shop_name'));
            }
            if (!empty($userUpdate)) {
                DB::table('users')->where('id', $userId)->update($userUpdate);
            }
        }

        // Sync with user_details table
        if ($userId) {
            DB::table('user_details')->updateOrInsert(
                ['user_id' => $userId],
                [
                    'firstName'  => $request->input('shop_name', $vendor->shop_name ?? ''),
                    'lastName'   => $request->input('owner_name', $vendor->owner_name ?? ''),
                    'mobile'     => $request->input('mobile_number1', $vendor->mobile_number1 ?? ''),
                    'address'    => $request->input('address', $vendor->address ?? ''),
                    'updated_at' => now(),
                ]
            );
        }

        return redirect()->back()->with('success', 'Profile and social media links updated successfully.');
    }
}
