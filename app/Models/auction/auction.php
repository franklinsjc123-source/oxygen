<?php

namespace App\Models\auction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class auction extends Model
{
    use HasFactory;
    protected $table = 'auctions';

    protected $fillable = ["admin_id", "product_type", "product_id", "start_price", "slab", "bid_price","start_date","start_time","end_date","end_time"];

}
