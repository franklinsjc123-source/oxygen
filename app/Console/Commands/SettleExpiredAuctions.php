<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\auction\auction;
use App\Models\auction\AuctionBid;
use App\Models\Ecom_Customer_info;
use App\Models\coupon\coupon;
use App\Mail\AuctionWinnerMail;

class SettleExpiredAuctions extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'auction:settle-expired';

    /**
     * The console command description.
     */
    protected $description = 'Settle expired auctions, determine winners, generate coupons, and send emails';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for expired auctions...');

        // Get all active, non-settled auctions that have ended
        $expiredAuctions = auction::where('status', 1)
            ->where('is_settled', 0)
            ->get();

        $settled = 0;

        foreach ($expiredAuctions as $auction) {
            // Parse end date
            $endDateStr = str_replace('T', ' ', $auction->end_date);
            try {
                $endDate = Carbon::parse($endDateStr);
            } catch (\Exception $e) {
                $this->warn("Auction #{$auction->id}: Invalid end date format, skipping.");
                continue;
            }

            // Check if auction has expired
            if (Carbon::now()->lessThan($endDate)) {
                continue; // Not expired yet
            }

            // Find the highest bidder
            $highestBid = AuctionBid::where('auction_id', $auction->id)
                ->orderByDesc('bid_amount')
                ->first();

            if (!$highestBid) {
                // No bids placed, just mark as settled
                $auction->is_settled = 1;
                $auction->save();
                $this->info("Auction #{$auction->id}: No bids placed, marked as settled.");
                $settled++;
                continue;
            }

            // Get winner customer details
            $winner = Ecom_Customer_info::where('customer_id', $highestBid->customer_id)->first();

            if (!$winner) {
                $this->warn("Auction #{$auction->id}: Winner customer not found, marking settled without coupon.");
                $auction->is_settled = 1;
                $auction->winner_customer_id = $highestBid->customer_id;
                $auction->save();
                $settled++;
                continue;
            }

            // Generate unique coupon code
            $couponCode = 'AUCTWIN-' . strtoupper(Str::random(6));

            // Make sure the code is unique
            while (coupon::where('coupon_code', $couponCode)->exists()) {
                $couponCode = 'AUCTWIN-' . strtoupper(Str::random(6));
            }

            // Get product details
            $product = \App\Models\Products\Products::where('id', $auction->product_id)->first();
            $productName = $product ? $product->product_name : 'Auction Product';

            // Create coupon in coupans table
            $couponRecord = coupon::create([
                'admin_id' => $auction->admin_id ?? 'system',
                'product_id' => $auction->product_id,
                'title' => 'Auction Winner - ' . $productName,
                'coupon_code' => $couponCode,
                'discount_type' => 'percentage',
                'discount_amount' => null,
                'discount_percentage' => '100',
                'minimum_requirment_type' => 'none',
                'minimum_requirment_amount' => null,
                'minimum_requirment_quantity' => null,
                'start_date' => Carbon::now()->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(30)->format('Y-m-d'),
                'created_by' => 'system',
                'status' => '1',
                'flag' => '1',
            ]);

            // Update auction with winner info
            $auction->winner_customer_id = $highestBid->customer_id;
            $auction->winner_coupon_code = $couponCode;
            $auction->is_settled = 1;
            $auction->save();

            // Send email to winner
            $winnerName = $winner->customer_firstname . ' ' . ($winner->customer_lastname ?? '');
            $winnerEmail = $winner->customer_email;

            if (!empty($winnerEmail)) {
                try {
                    Mail::to($winnerEmail)->send(new AuctionWinnerMail(
                        $winnerName,
                        $productName,
                        $highestBid->bid_amount,
                        $couponCode,
                        $product ? $product->product_image : null
                    ));
                    $this->info("Auction #{$auction->id}: Email sent to {$winnerEmail}");
                } catch (\Exception $e) {
                    $this->error("Auction #{$auction->id}: Failed to send email - " . $e->getMessage());
                }
            } else {
                $this->warn("Auction #{$auction->id}: Winner has no email address.");
            }

            $this->info("Auction #{$auction->id}: Settled! Winner: {$winnerName}, Coupon: {$couponCode}");
            $settled++;
        }

        $this->info("Done. {$settled} auction(s) settled.");
        return 0;
    }
}
