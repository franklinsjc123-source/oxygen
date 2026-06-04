<?php

namespace App\Models\auction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionBid extends Model
{
    use HasFactory;

    protected $table = 'auction_bids';

    protected $fillable = [
        'auction_id',
        'customer_id',
        'bid_amount',
    ];

    /**
     * Get the auction this bid belongs to.
     */
    public function auction()
    {
        return $this->belongsTo(auction::class, 'auction_id', 'id');
    }

    /**
     * Get the customer who placed this bid.
     */
    public function customer()
    {
        return $this->belongsTo(\App\Models\Ecom_Customer_info::class, 'customer_id', 'customer_id');
    }
}
