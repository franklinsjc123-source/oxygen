<?php

namespace App\Models\auction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class auction extends Model
{
    use HasFactory;
    protected $table = 'auctions';

    protected $fillable = ["admin_id", "product_type", "product_id", "start_price", "slab", "bid_price","start_date","start_time","end_date","end_time", "status", "winner_customer_id", "winner_coupon_code", "is_settled"];

    /**
     * Get all bids for this auction.
     */
    public function bids()
    {
        return $this->hasMany(AuctionBid::class, 'auction_id', 'id');
    }

    /**
     * Get the highest bid for this auction.
     */
    public function highestBid()
    {
        return $this->hasOne(AuctionBid::class, 'auction_id', 'id')->orderByDesc('bid_amount');
    }

    /**
     * Get the product linked to this auction.
     */
    public function product()
    {
        return $this->belongsTo(\App\Models\Products\Products::class, 'product_id', 'id');
    }

}
