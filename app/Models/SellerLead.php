<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerLead extends Model
{
    use HasFactory;

    protected $table = 'seller_leads';

    protected $fillable = [
        'shop_name',
        'owner_name',
        'mobile_number',
        'email',
        'city',
        'pincode',
        'business_category',
        'gstin',
        'uin',
        'address',
        'message',
        'status',
        'admin_notes',
    ];
}

