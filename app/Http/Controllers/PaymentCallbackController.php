<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;

class PaymentCallbackController extends Controller
{
    public function paymentPending(Request $request)
    {
        $paymentLink = session('payment_link');
        $whatsappLink = session('whatsapp_link');
        $vendorId = session('new_vendor_id');

        if (!$paymentLink) {
            return redirect()->route('staffvendor-list');
        }

        $vendor = DB::table('vendor_details')->where('id', $vendorId)->first();

        return view('payment.pending-payment', compact('paymentLink', 'whatsappLink', 'vendor'));
    }

    public function paymentCallback(Request $request)
    {
        $paymentLinkId = $request->get('razorpay_payment_link_id');
        $paymentId = $request->get('razorpay_payment_id');
        $paymentLinkStatus = $request->get('razorpay_payment_link_status');
        $signature = $request->get('razorpay_signature');

        if (empty($paymentLinkId)) {
            return view('payment.success-payment', [
                'success' => false,
                'message' => 'Invalid payment callback parameters.'
            ]);
        }

        // Fetch vendor by payment_link_id
        $vendor = DB::table('vendor_details')->where('payment_link_id', $paymentLinkId)->first();
        if (!$vendor) {
            return view('payment.success-payment', [
                'success' => false,
                'message' => 'Vendor not found for this payment link.'
            ]);
        }

        // Initialize Razorpay
        $keyId = config('services.razorpay.key');
        $keySecret = config('services.razorpay.secret');
        $api = new Api($keyId, $keySecret);

        try {
            // Fetch payment link status directly from Razorpay to verify
            $pl = $api->paymentLink->fetch($paymentLinkId);
            
            if ($pl->status === 'paid') {
                // If vendor is not already paid
                if ($vendor->payment_status !== 'paid') {
                    DB::beginTransaction();

                    // Update vendor details to active/paid
                    DB::table('vendor_details')
                        ->where('id', $vendor->id)
                        ->update([
                            'payment_status' => 'paid',
                            'updated_at' => now()
                        ]);

                    $orderId = 'REG-' . $vendor->id . '-' . time();
                    $package = DB::table('packages')->where('id', $vendor->package_id)->first();
                    $price = $package ? (float) $package->price : 0.0;
                    $validityDays = $package ? (int) $package->validity : 30;
                    $additionalDays = $package ? (int) $package->days : 0;
                    $totalDays = $validityDays + $additionalDays;

                    // Insert payment record into payments table
                    DB::table('payments')->insert([
                        'order_id' => $orderId,
                        'razorpay_payment_id' => $paymentId,
                        'razorpay_order_id' => $pl->order_id ?? '',
                        'razorpay_signature' => $signature ?? '',
                        'amount' => $price,
                        'status' => 'Captured',
                        'payment_data' => json_encode([
                            'vendor_id' => $vendor->id,
                            'package_id' => $vendor->package_id,
                            'package_name' => $package->name ?? '',
                            'validity_days' => $totalDays,
                            'type' => 'first_time_payment'
                        ]),
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                    // Insert record into subscription_payments table
                    DB::table('subscription_payments')->insert([
                        'vendor_id' => $vendor->id,
                        'vendor_name' => $vendor->shop_name ?? ($vendor->owner_name ?? ''),
                        'package_id' => $vendor->package_id,
                        'package_name' => $package->name ?? '',
                        'amount' => $price,
                        'validity_days' => $totalDays,
                        'purchase_date' => $vendor->purchase_date,
                        'expired_date' => $vendor->expired_date,
                        'razorpay_payment_id' => $paymentId,
                        'razorpay_order_id' => $pl->order_id ?? '',
                        'razorpay_signature' => $signature ?? '',
                        'payment_status' => 'paid',
                        'payment_method' => 'Razorpay',
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                    DB::commit();
                }

                return view('payment.success-payment', [
                    'success' => true,
                    'message' => 'Your payment has been successfully verified! Your vendor account is active.',
                    'vendor' => $vendor
                ]);
            } else {
                return view('payment.success-payment', [
                    'success' => false,
                    'message' => 'Payment has not been completed. Current status: ' . $pl->status
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return view('payment.success-payment', [
                'success' => false,
                'message' => 'An error occurred during verification: ' . $e->getMessage()
            ]);
        }
    }
}
