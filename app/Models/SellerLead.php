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
        'business_category',
        'address',
        'message',
        'status',
        'admin_notes',
    ];
}

