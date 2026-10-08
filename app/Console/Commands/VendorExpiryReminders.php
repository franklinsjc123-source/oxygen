<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class VendorExpiryReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vendor:expiry-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders to Vendor, Staff, and Admin 15 days before expiry and on expiry date.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today()->toDateString();
        $in15Days = Carbon::today()->addDays(15)->toDateString();

        // Get vendors expiring in exactly 15 days or today
        $vendors = DB::table('vendor_details')
            ->whereNotNull('expired_date')
            ->where(function($query) use ($today, $in15Days) {
                $query->whereDate('expired_date', $in15Days)
                      ->orWhereDate('expired_date', $today);
            })
            ->get();

        $adminEmail = DB::table('users')->where('log_type', 'Admin')->value('username') ?? 'admin@oxygen.com';

        foreach ($vendors as $vendor) {
            $isExpiryToday = (Carbon::parse($vendor->expired_date)->toDateString() === $today);
            $subject = $isExpiryToday ? "Action Required: Your Vendor Plan Has Expired" : "Reminder: Vendor Plan Expiring in 15 Days";
            $formattedDate = Carbon::parse($vendor->expired_date)->format('d M Y');
            $shopName = $vendor->shop_name ?? 'Vendor';

            // 1. Send to Vendor
            if (!empty($vendor->email)) {
                $this->sendEmail($vendor->email, $vendor->owner_name ?? 'Vendor', $shopName, $formattedDate, $isExpiryToday, true, $subject);
                $this->createNotification($vendor->id, 'Vendor', $subject);
            }

            // 2. Send to Relationship Staff
            if (!empty($vendor->staff_id)) {
                $staff = DB::table('staffother')->where('id', $vendor->staff_id)->first();
                if ($staff && !empty($staff->email)) {
                    $staffSubject = $isExpiryToday ? "Staff Notice: Vendor Plan Expired - {$shopName}" : "Staff Notice: Vendor Plan Expiring - {$shopName}";
                    $this->sendEmail($staff->email, $staff->fullname ?? 'Staff', $shopName, $formattedDate, $isExpiryToday, false, $staffSubject);
                    $this->createNotification($staff->employee_id, 'Staff', $staffSubject);
                }
            }

            // 3. Send to Admin
            if (!empty($adminEmail)) {
                $adminSubject = $isExpiryToday ? "Admin Notice: Vendor Plan Expired - {$shopName}" : "Admin Notice: Vendor Plan Expiring - {$shopName}";
                $this->sendEmail($adminEmail, 'Admin', $shopName, $formattedDate, $isExpiryToday, false, $adminSubject);
                $this->createNotification(1, 'Admin', $adminSubject);
            }
            
            $this->info("Reminders sent for vendor: {$shopName}");
        }

        return Command::SUCCESS;
    }

    private function sendEmail($email, $recipientName, $shopName, $expiryDate, $isExpiryToday, $isVendor, $subject)
    {
        try {
            Mail::send('emails.vendor-expiry', [
                'recipientName' => $recipientName,
                'shopName' => $shopName,
                'expiryDate' => $expiryDate,
                'isExpiryToday' => $isExpiryToday,
                'isVendor' => $isVendor
            ], function($message) use ($email, $subject) {
                $message->to($email)->subject($subject);
            });
        } catch (\Exception $e) {
            $this->error("Failed to send email to {$email}: " . $e->getMessage());
        }
    }

    private function createNotification($loginId, $loginType, $details)
    {
        try {
            DB::table('notifications')->insert([
                'login_id' => $loginId,
                'login_type' => $loginType,
                'details' => $details,
                'status' => 0, // Unread
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        } catch (\Exception $e) {
            $this->error("Failed to create notification for {$loginType} {$loginId}: " . $e->getMessage());
        }
    }
}

