<?php

namespace App\Helper;

use App\Mail\SellerCredentialsMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailHelper
{
    /**
     * Send seller login credentials email post successful payment.
     *
     * @param object|int $vendor
     * @param string|null $plainPassword
     * @return bool
     */
    public static function sendSellerCredentials($vendor, $plainPassword = null)
    {
        try {
            if (is_numeric($vendor)) {
                $vendor = DB::table('vendor_details')->where('id', $vendor)->first();
            }

            if (!$vendor || empty($vendor->email)) {
                Log::warning('EmailHelper: Cannot send credentials email, vendor or email missing.', ['vendor' => $vendor]);
                return false;
            }

            $username = $vendor->username ?? '';
            $password = $plainPassword ?: ($vendor->pass ?? '');

            if (empty($username) || empty($password)) {
                Log::warning('EmailHelper: Username or password missing for vendor.', [
                    'vendor_id' => $vendor->id ?? null,
                    'username' => $username,
                    'has_password' => !empty($password)
                ]);
                return false;
            }

            $loginUrl = url('/seller/login');

            Mail::to($vendor->email)->send(new SellerCredentialsMail($vendor, $username, $password, $loginUrl));

            Log::info("Seller credentials email sent successfully to {$vendor->email} for vendor #{$vendor->id}");
            return true;
        } catch (\Throwable $e) {
            Log::error('EmailHelper: Error sending seller credentials email: ' . $e->getMessage(), [
                'exception' => $e,
                'vendor_id' => is_object($vendor) ? ($vendor->id ?? null) : $vendor
            ]);
            return false;
        }
    }
}

