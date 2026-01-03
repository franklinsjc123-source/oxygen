<?php

namespace App\Models\coupon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coupon extends Model
{
    use HasFactory;
    protected $table = 'coupans';
    protected $fillable = 
    [
        "admin_id",
        "product_id",
        "title",
        "coupon_code",
        "discount_type",
        "discount_amount",
        "discount_percentage",
        "minimum_requirment_type",
        "minimum_requirment_amount",
        "minimum_requirment_quantity",
        "start_date",
        "end_date",
        "created_by",
        "status",
        "flag"
    ];

}
