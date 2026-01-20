<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecom_Orders extends Model
{
    protected $table = 'ecom_order_info';
    

    protected $fillable = [
        'order_id',
        'delivery_type',
        'customer_id',
        'customer_firstname',
        'customer_lastname',
        'customer_company_name',
        'customer_mobileno',
        'customer_email',
        'customer_address',
        'customer_address1',
        'customer_city',
        'customer_state',
        'customer_pincode',
        'payment_type',
        'total_amount',
        'discount_amount',
        'shipping_charge',
        'gst_charge',
        'grand_total',
        'order_status',
        'coupon_code',
        'payment_status',
        'order_date',
        'payment_date',
        'delivery_date',
        'order_notes',
        'remember_token',
        'created_at',
        'updated_at',
    ];
  
}
