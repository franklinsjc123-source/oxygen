<?php

namespace App\Models\vendor\Marketting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class face_book extends Model
{
    use HasFactory;
    protected $table = 'vendor_face_books';

    protected $primaryKey = 'id';

    protected $fillable = [
        "vendor_id",
        "package_id",
		"amount",
        "impressions",
        "clicks",
        "duration",
        "status",
        "is_subscribed",
        "subscribed_at",
        "expires_at",
        "razorpay_payment_id",
        "razorpay_order_id",
        "razorpay_signature",
        "payment_status",
        "paid_amount",
        "image",
        "text"        
    ];

    protected $dates = [
        'subscribed_at',
        'expires_at'
    ];
}
