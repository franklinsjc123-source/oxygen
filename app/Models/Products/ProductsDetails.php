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
        "common_product",
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

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->common_product)) {
                $max = static::where('products_id', $model->products_id)->max('common_product');
                $model->common_product = $max ? ($max + 1) : 1;
            }
        });
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'products_id', 'id');
    }
}
