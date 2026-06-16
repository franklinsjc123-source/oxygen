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
        $product = Products::where('id', $auction->product_id)->first();

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
                        $productImages[] = $img;
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
                'name' => $winner ? ($winner->customer_firstname . ' ' . ($winner->customer_lastname ?? '')) : 'Unknown',
                'amount' => $highestBid,
                'coupon_code' => $auction->winner_coupon_code,
                'is_current_user' => ($customerId == $auction->winner_customer_id),
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
                if (!empty($customer->customer_address1)) {
                    $locationParts[] = $customer->customer_address1;
                }
                if (!empty($customer->customer_city)) {
                    $locationParts[] = $customer->customer_city;
                }
                if (!empty($customer->customer_state)) {
                    $locationParts[] = $customer->customer_state;
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
}
