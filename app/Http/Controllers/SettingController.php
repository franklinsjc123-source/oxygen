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
use Illuminate\Support\Facades\Hash;

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

        // Handle Username
        $username = trim((string) $request->input('username', ''));
        if (!empty($username)) {
            // Check if username is already taken by another user
            $conflictUser = DB::table('users')
                ->where('username', $username)
                ->when($userId, function ($q) use ($userId) {
                    $q->where('id', '!=', $userId);
                })
                ->first();

            if ($conflictUser) {
                return redirect()->back()->with('error', 'The username "' . $username . '" is already taken. Please choose another username.');
            }

            $updateData['username'] = $username;
            Session::put('username', $username);
        }

        // Handle Password
        $password = (string) ($request->input('password') ?: $request->input('pass', ''));
        $confirmPassword = (string) ($request->input('confirm_password') ?: $request->input('pass1', ''));

        if (!empty($password)) {
            if ($confirmPassword !== '' && $password !== $confirmPassword) {
                return redirect()->back()->with('error', 'The password confirmation does not match.');
            }
            $updateData['pass']  = $password;
            $updateData['pass1'] = $confirmPassword !== '' ? $confirmPassword : $password;
        }

        // Shop & personal details are restricted / read-only for vendors.
        // In case of any changes, vendors must contact their RM or Admin for revision.

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
        $userRecord = null;
        if ($userId) {
            $userRecord = DB::table('users')->where('id', $userId)->first();
        }
        if (!$userRecord && !empty($vendor->id)) {
            $userRecord = DB::table('users')->where('login_id', $vendor->id)->first();
        }

        if ($userRecord) {
            $userUpdate = [];
            if (!empty($username)) {
                $userUpdate['username'] = $username;
            }
            if (!empty($password)) {
                $userUpdate['password'] = Hash::make($password);
            }
            if (!empty($userUpdate)) {
                $userUpdate['updated_at'] = now();
                DB::table('users')->where('id', $userRecord->id)->update($userUpdate);
            }
        }

        return redirect()->back()->with('success', 'Profile and login details updated successfully.');
    }
}
