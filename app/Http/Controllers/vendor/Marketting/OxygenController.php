<?php

namespace App\Http\Controllers\vendor\Marketting;

use App\Models\Marketting\oxygen as masteroxy;
use App\Models\vendor\Marketting\oxygen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OxygenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor_id = session()->get('login_id') ?? (auth()->check() ? auth()->user()->login_id : 1); 

        // Master budgets from admin (oxygens_promo)
        $masterBudgets = masteroxy::where('status', 1)->get();
        $vendorBudgets = oxygen::where("vendor_id", $vendor_id)->get();

        foreach ($masterBudgets as $master) {
            $exists = $vendorBudgets->first(function($item) use ($master) {
                return ($item->package_id && $item->package_id == $master->id) || ($item->amount == $master->amount && $item->duration == $master->duration);
            });

            if (!$exists) {
                $newOxy = new oxygen();
                $newOxy->vendor_id     = $vendor_id;
                $newOxy->package_id    = $master->id;
                $newOxy->amount        = $master->amount;
                $newOxy->impressions   = $master->impressions;
                $newOxy->clicks        = $master->clicks;
                $newOxy->duration      = $master->duration;
                $newOxy->status        = 0;
                $newOxy->is_subscribed = 0;
                $newOxy->approval_status = 'Pending';
                $newOxy->image         = $master->image ?? '-';
                $newOxy->text          = $master->text ?? '-';
                $newOxy->save();
            } else if (!$exists->package_id) {
                $exists->package_id = $master->id;
                $exists->save();
            }
        }

        // Auto-pause expired packages
        oxygen::where('vendor_id', $vendor_id)
            ->where('is_subscribed', 1)
            ->where('status', 1)
            ->whereNotNull('expires_at')
            ->where('expires_at', '<', now())
            ->update(['status' => 0]);

        $oxygen = oxygen::where("vendor_id", $vendor_id)->get();
        $vendorDetails = DB::table('vendor_details')
            ->where('id', $vendor_id)
            ->orWhere('vendor_id', $vendor_id)
            ->first();
        $razorpayKey = config('services.razorpay.key');

        return view('layout.vendor.marketing.oxygen', compact('oxygen', 'vendorDetails', 'razorpayKey'));
    }

    /**
     * Subscribe, pay, and upload advertisement banner for Trymenow Promo.
     * Request will be sent to Admin for approval before publishing to home page.
     */
    public function subscribe(Request $request)
    {
        $vendor_id = session()->get('login_id') ?? (auth()->check() ? auth()->user()->login_id : 1);
        $ox = oxygen::where('id', $request->id)->where('vendor_id', $vendor_id)->first();
        if (!$ox) {
            return response()->json(['status' => 404, 'message' => 'Package not found!'], 404);
        }

        $razorpayPaymentId = $request->input('razorpay_payment_id');
        if (empty($razorpayPaymentId)) {
            return response()->json(['status' => 400, 'message' => 'Online payment verification is required to activate this advertisement package.'], 400);
        }

        // Handle Banner Image upload
        $imageName = $ox->banner_image;
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $ext = $file->getClientOriginalExtension();
            $imageName = 'vendor_banner_' . $vendor_id . '_' . time() . '.' . $ext;
            
            $destOxy = public_path('assets/images/banners/advoxygen');
            $destAdv = public_path('assets/images/banners/adv-baner');
            if (!file_exists($destOxy)) {
                mkdir($destOxy, 0755, true);
            }
            if (!file_exists($destAdv)) {
                mkdir($destAdv, 0755, true);
            }

            $file->move($destOxy, $imageName);
            @copy($destOxy . '/' . $imageName, $destAdv . '/' . $imageName);
        }

        if (empty($imageName)) {
            return response()->json(['status' => 400, 'message' => 'Please upload an advertisement banner image.'], 400);
        }

        $durationDays = (int) $ox->duration > 0 ? (int) $ox->duration : 30;

        $bannerType = $request->input('banner_type', 'trymenow_adv');
        if (!in_array($bannerType, ['trymenow_adv', 'adv_banner'])) {
            $bannerType = 'trymenow_adv';
        }

        $ox->banner_type = $bannerType;
        $ox->title = $request->input('title', $ox->title);
        $ox->sub_title = $request->input('sub_title', $ox->sub_title);
        $ox->link = $request->input('link', $ox->link);
        $ox->banner_image = $imageName;
        $ox->is_subscribed = 1;
        $ox->approval_status = 'Pending'; // Awaiting admin approval
        $ox->status = 0; // Not live until admin approves
        $ox->subscribed_at = now();
        $ox->razorpay_payment_id = $razorpayPaymentId;
        $ox->razorpay_order_id = $request->input('razorpay_order_id', '');
        $ox->razorpay_signature = $request->input('razorpay_signature', '');
        $ox->payment_status = 'Paid';
        $ox->paid_amount = (float) $ox->amount;
        $ox->save();

        // Record in central payments table
        try {
            DB::table('payments')->insert([
                'order_id' => 'OXY-AD-' . $vendor_id . '-' . time(),
                'razorpay_payment_id' => $razorpayPaymentId,
                'razorpay_order_id' => $request->input('razorpay_order_id', ''),
                'razorpay_signature' => $request->input('razorpay_signature', ''),
                'amount' => (float) $ox->amount,
                'status' => 'Captured',
                'payment_data' => json_encode([
                    'vendor_id' => $vendor_id,
                    'package_id' => $ox->id,
                    'platform' => 'Trymenow Promo Banner',
                    'banner_image' => $imageName,
                    'amount' => $ox->amount,
                    'duration' => $ox->duration,
                    'type' => 'trymenow_promo'
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } catch (\Throwable $e) {
            Log::warning("Could not record promo ad payment: " . $e->getMessage());
        }

        return response()->json([
            'status' => 200,
            'message' => 'Payment verified! Your banner advertisement request has been submitted to Admin for approval. Once accepted by Admin, it will be published on the Home Page.',
            'payment_id' => $razorpayPaymentId,
            'approval_status' => 'Pending'
        ]);
    }

    public function changestatus(Request $request)
    {
        $vendor_id = session()->get('login_id') ?? (auth()->check() ? auth()->user()->login_id : 1);
        $ox = oxygen::where('id', $request->id)->where('vendor_id', $vendor_id)->first();
        if (!$ox) {
            return response()->json(['error' => 'Not found'], 404);
        }

        if (!$ox->is_subscribed) {
            return response()->json(['error' => 'Please subscribe and pay for this package first.'], 400);
        }

        if ($ox->approval_status !== 'Approved') {
            return response()->json(['error' => 'Your banner is currently ' . $ox->approval_status . ' and not yet approved by Admin.'], 400);
        }

        if ($ox->expires_at && \Carbon\Carbon::parse($ox->expires_at)->isPast() && $request->status == 1) {
            return response()->json(['error' => 'This package has expired. Please renew the package to reactivate campaign.'], 400);
        }

        $ox->status = $request->status;
        $ox->save();
        return response()->json(['success' => 'Status changed successfully.']);
    }

    public function edit($id)
    {
        $ox = oxygen::find($id);
        if ($ox) {
            return response()->json(['status' => 200, 'oxygen' => $ox]);
        }
        return response()->json(['status' => 404, 'message' => 'oxygen not found']);
    }

    public function destroy($id, FlasherInterface $flasher)
    {
        try {
            $ox = oxygen::find($id);           
            if ($ox) $ox->delete();
            $flasher->addSuccess('Data Removed!');
            return redirect()->route('vendoroxygen.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!');
            return redirect()->route('vendoroxygen.index');
        }
    }
}
