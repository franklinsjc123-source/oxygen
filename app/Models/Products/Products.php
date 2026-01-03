<?php

namespace App\Models\Products;

use App\Models\Category\CategoryMain;
use App\Models\Master\Offers\Offers;
use App\Models\Products\ProductsDetails;
use App\Models\User;
use App\Models\vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category\Category;
use App\Models\Category\CategorySub;

class Products extends Model
{

    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        "login_id",
        "product_id",
        "vendor_id",
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
        "specification",
        "offers",
        "collection",
        "flag",
        "status",
        "created_by"
    ];

    public function CategoryMain()
    {
        return $this->belongsTo(CategoryMain::class, 'category_main', 'id');
    }

    public function CategorySub()
    {
        return $this->belongsTo(Category::class, 'category', 'id');
    }

    public function CategoryChild()
    {
        return $this->belongsTo(CategorySub::class, 'category_sub', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'created_by', 'login_id');
    }

    public function productdetails()
    {
        return $this->hasOne(ProductsDetails::class, 'products_id', 'id');
    }

    public function offer()
    {
        return $this->belongsTo(Offers::class, 'offers', 'id');
    }

    // public function vendor_details()
    // {
    //     return $this->belongsTo(vendor::class, 'vendor_id', 'id');
    // }

}
