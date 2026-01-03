<?php

namespace App\Models\vendor\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{

    use HasFactory;
    protected $table = 'vendor_products';

    protected $fillable = [
        "user_id",
        "product_id",
        "category",
        "category_main",
        "category_sub",
        "product_name",
        "tax_id",
        "gst_id",
        "product_image",
        "product_gallery_image",
        "description",
        "weight",
        "length",
        "width",
        "height",
        "offers",
        "collection",
        "flag",
        "status",
        "created_by"
    ];

    
}
