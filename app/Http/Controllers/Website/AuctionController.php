<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\auction\auction;
use App\Models\auction\AuctionBid;
use App\Models\Ecom_Customer_info;
use App\Models\PinCode\PinCode;
use App\Models\Products\Products;
use App\Models\coupon\coupon;
use App\Mail\AuctionWinnerMail;

class AuctionController extends Controller
{
    /**
     * Show auction detail page with product info, countdown, and bidding interface.
     */
    public function show($id)
    {
        $auction = auction::where('id', $id)
            ->where('status', 1)
            ->first();

        if (!$auction) {
            return redirect()->route('auction')->with('error', 'Auction not found.');
        }

        // Get product details
        $product = $auction->product;

        if (!$product) {
            return redirect()->route('auction')->with('error', 'Product not found.');
        }

        // Get product images
        $productImages = [];
        $details = DB::table('products_details')
            ->where('products_id', $product->id)
            ->get(['product_detail_image']);

        foreach ($details as $detail) {
            $decoded = json_decode($detail->product_detail_image, true);
            if (is_array($decoded)) {
                foreach ($decoded as $img) {
                    if (!empty($img)) {
                        if (file_exists(public_path('assets/images/products/detail/' . $img))) {
                            $productImages[] = $img;
                        }
                    }
                }
            }
        }

        // Get vendor details
        $vendor = DB::table('vendor_details')
            ->where('id', $product->vendor_id)
            ->first();

        $timezone = 'Asia/Kolkata';

        // Parse end date for countdown
        $endDateStr = str_replace('T', ' ', $auction->end_date);
        try {
            $endDate = \Carbon\Carbon::parse($endDateStr, $timezone);
        } catch (\Exception $e) {
            $endDate = \Carbon\Carbon::now($timezone);
        }

        // Parse start date to check if it has started
        $startDateStr = str_replace('T', ' ', $auction->start_date);
        try {
            $startDate = \Carbon\Carbon::parse($startDateStr, $timezone);
        } catch (\Exception $e) {
            $startDate = \Carbon\Carbon::now($timezone);
        }

        $now = \Carbon\Carbon::now($timezone);
        $isExpired = $now->greaterThanOrEqualTo($endDate);
        $hasNotStarted = $now->lessThan($startDate);

        // Auto-settle auction if expired and not settled yet
        if ($isExpired && !$auction->is_settled) {
            $this->settleAuction($auction);
            $auction = auction::where('id', $id)->first();
        }

        // Get latest bids with customer names
        $bids = AuctionBid::where('auction_id', $id)
            ->orderByDesc('bid_amount')
            ->limit(20)
            ->get();

        $bidList = [];
        foreach ($bids as $bid) {
            $customer = Ecom_Customer_info::where('customer_id', $bid->customer_id)->first();
            $locationParts = [];
            if ($customer) {
                if (!empty($customer->customer_address1)) {
                    $locationParts[] = $customer->customer_address1;
                }
                if (!empty($customer->customer_city)) {
                    $locationParts[] = $customer->customer_city;
                }
                if (!empty($customer->customer_state)) {
                    $locationParts[] = $customer->customer_state;
                }
                if (empty($customer->customer_city) && empty($customer->customer_state) && !empty($customer->customer_pincode)) {
                    $pincodeRecord = PinCode::where('name', $customer->customer_pincode)->first();
                    if ($pincodeRecord) {
                        if (!empty($pincodeRecord->area)) {
                            $locationParts[] = $pincodeRecord->area;
                        } elseif (!empty($pincodeRecord->post_region)) {
                            $locationParts[] = $pincodeRecord->post_region;
                        }
                    }
                }
            }
            $bidList[] = [
                'id' => $bid->id,
                'customer_name' => $customer ? ($customer->customer_firstname . ' ' . ($customer->customer_lastname ?? '')) : 'Unknown',
                'location' => implode(', ', $locationParts),
                'bid_amount' => $bid->bid_amount,
                'time' => Carbon::parse($bid->created_at)->diffForHumans(),
                'created_at' => $bid->created_at,
            ];
        }

        // Get highest bid
        $highestBid = AuctionBid::where('auction_id', $id)->max('bid_amount');
        $currentBid = $highestBid ?? $auction->start_price;

        // Total bid count
        $totalBids = AuctionBid::where('auction_id', $id)->count();

        // Check if current customer has a session
        $customerId = Session::get('customer_id');
        $isLoggedIn = !empty($customerId);

        // Get the minimum next bid amount
        $minimumBid = $currentBid + $auction->slab;

        // Winner info (if auction settled)
        $winnerInfo = null;
        if ($auction->is_settled && $auction->winner_customer_id) {
            $winner = Ecom_Customer_info::where('customer_id', $auction->winner_customer_id)->first();
            $winnerInfo = [
                'name' => $winner ? trim(($winner->customer_firstname ?? '') . ' ' . ($winner->customer_lastname ?? '')) : 'Unknown',
                'amount' => $highestBid ?? $auction->start_price,
                'coupon_code' => $auction->winner_coupon_code,
                'is_current_user' => ($customerId == $auction->winner_customer_id),
                'email' => $winner ? $winner->customer_email : '',
            ];
        }

        // Product Specs and Ratings
        $ProductSpecs = \App\Models\Products\ProductSpecs::where('products_id', $product->id)->get();
        $reviewCount = \App\Models\Rating::where('products_id', $product->id)->count();
        $avg = \App\Models\Rating::where('products_id', $product->id)->avg('star_rating') ?? 0;
        $ratings = \App\Models\Rating::where('products_id', $product->id)->latest()->get();
        
        $mostHelpfulPositive = \App\Models\Rating::where('products_id', $product->id)
                                ->where('star_rating', '>=', 4)
                                ->withCount('helpfulVotes')
                                ->orderByDesc('helpful_votes_count')
                                ->take(5)->get();
                                
        $mostHelpfulNegative = \App\Models\Rating::where('products_id', $product->id)
                                ->where('star_rating', '<=', 3)
                                ->withCount('helpfulVotes')
                                ->orderByDesc('helpful_votes_count')
                                ->take(5)->get();
                                
        $highestRatingList = \App\Models\Rating::where('products_id', $product->id)
                                ->orderByDesc('star_rating')
                                ->take(5)->get();
                                
        $lowestRatingList = \App\Models\Rating::where('products_id', $product->id)
                                ->orderBy('star_rating')
                                ->take(5)->get();

        $myRating = null;
        $canRate = false;

        if ($customerId) {
            $canRate = true; 
            
            $customerInfo = \App\Models\Ecom_Customer_info::where('customer_id', $customerId)->first();
            $customerName = trim((string) (($customerInfo?->customer_firstname ?? session('customer_name', '')) . ' ' . ($customerInfo?->customer_lastname ?? '')));
            if ($customerName === '') {
                $customerName = (string) session('customer_name', $customerId);
            }
            
            $myRating = \App\Models\Rating::where('products_id', $product->id)
                            ->where('customer_name', $customerName)
                            ->first();
        }

        // Fetch product colors and sizes from products_details
        $productDetailsList = DB::table('products_details')
            ->where('products_id', $product->id)
            ->get();

        $availableColors = [];
        $availableSizes = [];

        foreach ($productDetailsList as $d) {
            // Check Color
            $c = !empty($d->color) ? $d->color : null;
            if (!$c && !empty($d->attributename1) && strcasecmp(trim($d->attributename1), 'Color') === 0) {
                $c = $d->attributevalue1;
            }
            if (!$c && !empty($d->attributevalue1)) {
                $c = $d->attributevalue1;
            }
            if ($c && !in_array(trim($c), $availableColors)) {
                $availableColors[] = trim($c);
            }

            // Check Size
            $s = !empty($d->size) ? $d->size : null;
            if (!$s && !empty($d->attributename2) && stripos($d->attributename2, 'Size') !== false) {
                $s = $d->attributevalue2;
            }
            if (!$s && !empty($d->attributevalue2)) {
                $s = $d->attributevalue2;
            }
            if ($s && strtoupper(trim($s)) !== 'NA' && !in_array(trim($s), $availableSizes)) {
                $availableSizes[] = trim($s);
            }
        }
        $percent = $avg > 0 ? ($avg / 5) * 100 : 0;

        return view('frontend.auction_detail', compact(
            'auction',
            'product',
            'productImages',
            'vendor',
            'endDate',
            'isExpired',
            'hasNotStarted',
            'startDate',
            'bidList',
            'currentBid',
            'totalBids',
            'minimumBid',
            'isLoggedIn',
            'customerId',
            'winnerInfo',
            'availableColors',
            'availableSizes',
            'ProductSpecs', 'reviewCount', 'avg', 'ratings', 'percent',
            'canRate', 'myRating', 'mostHelpfulPositive', 'mostHelpfulNegative', 'highestRatingList', 'lowestRatingList'
        ));
    }

    /**
     * Place a bid on an auction (AJAX).
     */
    public function placeBid(Request $request)
    {
        $customerId = Session::get('customer_id');

        if (!$customerId) {
            return response()->json(['success' => false, 'message' => 'Please login to place a bid.'], 401);
        }

        $request->validate([
            'auction_id' => 'required|integer',
            'bid_amount' => 'required|numeric|min:1',
        ]);

        $auction = auction::where('id', $request->auction_id)
            ->where('status', 1)
            ->first();

        if (!$auction) {
            return response()->json(['success' => false, 'message' => 'Auction not found.']);
        }

        $timezone = 'Asia/Kolkata';
        $now = \Carbon\Carbon::now($timezone);

        // Check if auction has expired
        $endDateStr = str_replace('T', ' ', $auction->end_date);
        $endDate = \Carbon\Carbon::parse($endDateStr, $timezone);
        if ($now->greaterThanOrEqualTo($endDate)) {
            return response()->json(['success' => false, 'message' => 'This auction has ended.']);
        }

        // Check if auction has started
        $startDateStr = str_replace('T', ' ', $auction->start_date);
        $startDate = \Carbon\Carbon::parse($startDateStr, $timezone);
        if ($now->lessThan($startDate)) {
            return response()->json(['success' => false, 'message' => 'This auction has not started yet.']);
        }

        // Check if customer is already participating in another active auction
        $otherActiveBids = AuctionBid::where('customer_id', $customerId)
            ->where('auction_id', '!=', $auction->id)
            ->whereHas('auction', function ($query) {
                $query->where('status', 1)
                      ->where('is_settled', 0);
            })
            ->get();

        $activeOtherAuctionId = null;
        foreach ($otherActiveBids as $bid) {
            $otherAuction = $bid->auction;
            if ($otherAuction) {
                $otherStartStr = str_replace('T', ' ', $otherAuction->start_date);
                $otherEndStr = str_replace('T', ' ', $otherAuction->end_date);
                try {
                    $otherStart = \Carbon\Carbon::parse($otherStartStr, $timezone);
                    $otherEnd = \Carbon\Carbon::parse($otherEndStr, $timezone);
                    if ($now->greaterThanOrEqualTo($otherStart) && $now->lessThan($otherEnd)) {
                        $activeOtherAuctionId = $otherAuction->id;
                        break;
                    }
                } catch (\Exception $e) {
                    // Ignore bad formatting
                }
            }
        }

        if ($activeOtherAuctionId) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot place a bid because you are already participating in another active auction.'
            ]);
        }

        // Get current highest bid
        $highestBid = AuctionBid::where('auction_id', $auction->id)->max('bid_amount');
        $currentBid = $highestBid ?? $auction->start_price;
        $minimumBid = $currentBid + $auction->slab;

        if ($request->bid_amount < $minimumBid) {
            return response()->json([
                'success' => false,
                'message' => 'Your bid must be at least ₹' . number_format($minimumBid, 2) . '.'
            ]);
        }

        // Strictly enforce slab increments
        $bidDifference = (int)round($request->bid_amount * 100) - (int)round($currentBid * 100);
        $slabCents = (int)round($auction->slab * 100);
        if ($slabCents > 0 && $bidDifference % $slabCents !== 0) {
            return response()->json([
                'success' => false,
                'message' => 'Your bid must be an exact increment of ₹' . number_format($auction->slab, 2) . '.'
            ]);
        }

        // Place the bid
        $bid = AuctionBid::create([
            'auction_id' => $auction->id,
            'customer_id' => $customerId,
            'bid_amount' => $request->bid_amount,
        ]);

        // Update the auction bid_price
        $auction->bid_price = $request->bid_amount;
        $auction->save();

        // Get customer name for response
        $customer = Ecom_Customer_info::where('customer_id', $customerId)->first();
        $customerName = $customer ? ($customer->customer_firstname . ' ' . ($customer->customer_lastname ?? '')) : 'You';

        $locationParts = [];
        if ($customer) {
            if (!empty($customer->customer_address1)) {
                $locationParts[] = $customer->customer_address1;
            }
            if (!empty($customer->customer_city)) {
                $locationParts[] = $customer->customer_city;
            }
            if (!empty($customer->customer_state)) {
                $locationParts[] = $customer->customer_state;
            }
            if (empty($customer->customer_city) && empty($customer->customer_state) && !empty($customer->customer_pincode)) {
                $pincodeRecord = PinCode::where('name', $customer->customer_pincode)->first();
                if ($pincodeRecord) {
                    if (!empty($pincodeRecord->area)) {
                        $locationParts[] = $pincodeRecord->area;
                    } elseif (!empty($pincodeRecord->post_region)) {
                        $locationParts[] = $pincodeRecord->post_region;
                    }
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Bid placed successfully!',
            'bid' => [
                'customer_name' => $customerName,
                'location' => implode(', ', $locationParts),
                'bid_amount' => $request->bid_amount,
                'time' => 'Just now',
            ],
            'new_minimum_bid' => $request->bid_amount + $auction->slab,
            'total_bids' => AuctionBid::where('auction_id', $auction->id)->count(),
        ]);
    }

    /**
     * Get latest bids for an auction (AJAX polling).
     */
    public function getBids($id)
    {
        $bids = AuctionBid::where('auction_id', $id)
            ->orderByDesc('bid_amount')
            ->limit(20)
            ->get();

        $bidList = [];
        foreach ($bids as $bid) {
            $customer = Ecom_Customer_info::where('customer_id', $bid->customer_id)->first();
            $locationParts = [];
            if ($customer) {
                if (!empty($customer->customer_city)) {
                    $locationParts[] = $customer->customer_city;
                }
                if (!empty($customer->customer_state)) {
                    $locationParts[] = $customer->customer_state;
                }
                if (empty($locationParts) && !empty($customer->customer_pincode)) {
                    $pincodeRecord = PinCode::where('name', $customer->customer_pincode)->first();
                    if ($pincodeRecord) {
                        if (!empty($pincodeRecord->area)) {
                            $locationParts[] = $pincodeRecord->area;
                        } elseif (!empty($pincodeRecord->post_region)) {
                            $locationParts[] = $pincodeRecord->post_region;
                        }
                    }
                }
            }
            $bidList[] = [
                'customer_name' => $customer ? ($customer->customer_firstname . ' ' . ($customer->customer_lastname ?? '')) : 'Unknown',
                'location' => implode(', ', $locationParts),
                'bid_amount' => $bid->bid_amount,
                'time' => Carbon::parse($bid->created_at)->diffForHumans(),
            ];
        }

        $highestBid = AuctionBid::where('auction_id', $id)->max('bid_amount');
        $auction = auction::find($id);
        $currentBid = $highestBid ?? ($auction ? $auction->start_price : 0);

        return response()->json([
            'bids' => $bidList,
            'current_bid' => $currentBid,
            'minimum_bid' => $currentBid + ($auction ? $auction->slab : 0),
            'total_bids' => AuctionBid::where('auction_id', $id)->count(),
            'is_settled' => $auction ? $auction->is_settled : 0,
        ]);
    }

    /**
     * Settle auction via AJAX when countdown reaches 0 live.
     */
    public function settleAjax($id)
    {
        $auction = auction::where('id', $id)->first();
        if (!$auction) {
            return response()->json(['success' => false, 'message' => 'Auction not found']);
        }

        $timezone = 'Asia/Kolkata';
        $endDateStr = str_replace('T', ' ', $auction->end_date);
        try {
            $endDate = \Carbon\Carbon::parse($endDateStr, $timezone);
        } catch (\Exception $e) {
            $endDate = \Carbon\Carbon::now($timezone);
        }

        $now = \Carbon\Carbon::now($timezone);
        if ($now->greaterThanOrEqualTo($endDate) && !$auction->is_settled) {
            $this->settleAuction($auction);
            $auction = auction::where('id', $id)->first();
        }

        $winnerInfo = null;
        $highestBid = AuctionBid::where('auction_id', $id)->max('bid_amount') ?? ($auction ? $auction->start_price : 0);
        $customerId = Session::get('customer_id');

        if ($auction && $auction->is_settled && $auction->winner_customer_id) {
            $winner = Ecom_Customer_info::where('customer_id', $auction->winner_customer_id)->first();
            $winnerName = $winner ? trim(($winner->customer_firstname ?? '') . ' ' . ($winner->customer_lastname ?? '')) : 'Unknown';
            $winnerInfo = [
                'name' => $winnerName,
                'amount' => $highestBid,
                'coupon_code' => $auction->winner_coupon_code,
                'is_current_user' => ($customerId == $auction->winner_customer_id),
                'email' => $winner ? $winner->customer_email : '',
            ];
        }

        return response()->json([
            'success' => true,
            'is_settled' => $auction ? (bool)$auction->is_settled : false,
            'winner_info' => $winnerInfo,
        ]);
    }

    /**
     * AJAX endpoint to manually resend winner coupon email.
     */
    public function resendWinnerEmailAjax($id)
    {
        $auction = auction::where('id', $id)->first();
        if (!$auction) {
            return response()->json(['success' => false, 'message' => 'Auction not found']);
        }

        if (!$auction->winner_customer_id || !$auction->winner_coupon_code) {
            return response()->json(['success' => false, 'message' => 'Auction has no registered winner yet.']);
        }

        $sent = $this->sendWinnerEmail($auction);

        if ($sent) {
            return response()->json(['success' => true, 'message' => 'Winner email sent successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to send email. Please check server email settings.']);
        }
    }

    /**
     * Helper to settle an auction, generate coupon code, and send winner email.
     */
    private function settleAuction($auction)
    {
        if (!$auction) {
            return;
        }

        if (!$auction->is_settled) {
            $highestBid = AuctionBid::where('auction_id', $auction->id)
                ->orderByDesc('bid_amount')
                ->first();

            if (!$highestBid) {
                $auction->is_settled = 1;
                $auction->save();
                return;
            }

            $winner = Ecom_Customer_info::where('customer_id', $highestBid->customer_id)
                ->orWhere('id', $highestBid->customer_id)
                ->first();

            if (!$winner) {
                $auction->is_settled = 1;
                $auction->winner_customer_id = $highestBid->customer_id;
                $auction->save();
                return;
            }

            // Generate unique coupon code if not existing
            if (empty($auction->winner_coupon_code)) {
                $couponCode = 'AUCTWIN-' . strtoupper(Str::random(6));
                while (coupon::where('coupon_code', $couponCode)->exists()) {
                    $couponCode = 'AUCTWIN-' . strtoupper(Str::random(6));
                }

                $product = Products::where('id', $auction->product_id)->first();
                $productName = $product ? $product->product_name : 'Auction Product';

                // Code validation: next day 11:00 PM
                $expiryDate = Carbon::now()->addDay()->setTime(23, 0, 0)->format('Y-m-d H:i:s');

                // Create coupon in coupans table
                coupon::create([
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
                    'end_date' => $expiryDate,
                    'created_by' => 'system',
                    'status' => '1',
                    'flag' => '1',
                ]);

                $auction->winner_coupon_code = $couponCode;
            }

            $auction->winner_customer_id = $highestBid->customer_id;
            $auction->is_settled = 1;
            $auction->save();
        }

        // Send email to winner
        if (!empty($auction->winner_coupon_code) && !empty($auction->winner_customer_id)) {
            $this->sendWinnerEmail($auction);
        }
    }

    /**
     * Send email to auction winner safely
     */
    private function sendWinnerEmail($auction)
    {
        if (!$auction || !$auction->winner_customer_id || !$auction->winner_coupon_code) {
            return false;
        }

        $winner = Ecom_Customer_info::where('customer_id', $auction->winner_customer_id)
            ->orWhere('id', $auction->winner_customer_id)
            ->first();

        if (!$winner || empty($winner->customer_email)) {
            \Illuminate\Support\Facades\Log::warning("Auction #{$auction->id}: Winner customer or email address not found.");
            return false;
        }

        $product = Products::where('id', $auction->product_id)->first();
        $productName = $product ? $product->product_name : 'Auction Product';

        $highestBid = AuctionBid::where('auction_id', $auction->id)
            ->orderByDesc('bid_amount')
            ->first();
        $bidAmount = $highestBid ? $highestBid->bid_amount : ($auction->bid_price ?? $auction->start_price);

        $winnerName = trim(($winner->customer_firstname ?? '') . ' ' . ($winner->customer_lastname ?? ''));
        $winnerEmail = trim($winner->customer_email);

        try {
            Mail::to($winnerEmail)->send(new AuctionWinnerMail(
                $winnerName,
                $productName,
                $bidAmount,
                $auction->winner_coupon_code,
                $product ? $product->product_image : null
            ));
            \Illuminate\Support\Facades\Log::info("Auction #{$auction->id}: Winner email dispatched successfully to {$winnerEmail}");
            return true;
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error("Auction #{$auction->id}: Winner email send error: " . $e->getMessage());
            return false;
        }
    }
}
