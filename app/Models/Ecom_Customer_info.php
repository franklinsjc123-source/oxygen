<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecom_Customer_info extends Model
{
    protected $table = 'ecom_customer_info';

  


    protected $fillable = [
        'customer_id',          // ✅ MUST ADD
        'customer_firstname',
        'customer_lastname',
        'customer_email',
        'customer_mobileno',
        'customer_password',
        'customer_address',
        'customer_address1',
        'customer_city',
        'customer_state',
        'customer_pincode',
        'customer_type',
    ];
}