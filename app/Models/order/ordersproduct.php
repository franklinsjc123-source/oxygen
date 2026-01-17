<?php

namespace App\Models\order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ordersproduct extends Model
{
    use HasFactory;

    protected $table = 'ordersproducts';

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_image',
        'product_gstin',
        'product_size',
        'product_quantity',
        'product_price',
        'total_price',
        'order_status'
    ];

}
