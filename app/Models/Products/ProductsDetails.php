<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsDetails extends Model
{
    use HasFactory;
    protected $table = 'products_details';

    protected $fillable = [
        "products_id",
        "product_detail_image",
        "color",
        "size",
        "quantity",
        "retail_price",
        "selling_price",
        "sku",
        "return_replace",
        "r_days",
        "low_stock_limit",
        "threshold",
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'products_id', 'id');
    }
}
