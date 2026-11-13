<?php

namespace App\Models\vendor\Marketting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class oxygen extends Model
{
    use HasFactory; 
    protected $table = 'vendor_oxygens_promo';

    protected $primaryKey = 'id';

    protected $fillable = [
        "vendor_id",
        "package_id",
        "title",
        "sub_title",
        "banner_image",
        "link",
		"amount",
        "impressions",
        "clicks",
        "duration",        
        "status",
        "is_subscribed",
        "approval_status",
        "admin_notes",
        "subscribed_at",
        "approved_at",
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
        'approved_at',
        'expires_at'
    ];

    public function getVendorDetailAttribute()
    {
        return DB::table('vendor_details')
            ->where('id', $this->vendor_id)
            ->orWhere('vendor_id', $this->vendor_id)
            ->first();
    }
}
