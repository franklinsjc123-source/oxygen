<?php

namespace App\Models\order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'orders';

       public $timestamps = true;

    protected $fillable = [
        'User_id',
        'orders_id',

        'firstname',
        'lastname',
        'phone',
        'email',

        'address',
        'town',
        'state',
        'country',
        'postelcode',

        'value',
        'shipping',
        'total',
        'discount',
        'grandtotal',
        'gst_charge',

        'order_status',
        'coupon_code',
        'payment_status',

        'order_date',
        'payment_date',
        'delivery_date',

        'order_notes',
        'remember_token',
        'status',
        'flag',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

}
