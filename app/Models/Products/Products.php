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
use Illuminate\Support\Str;

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
        "slug",
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
        "created_by",
        "hsncode"
    ];

    /**
     * Auto-generate slug from product_name on create/update.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = static::generateUniqueSlug($product->product_name);
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('product_name') && !$product->isDirty('slug')) {
                $product->slug = static::generateUniqueSlug($product->product_name, $product->id);
            }
        });

        static::addGlobalScope('activeVendor', function (\Illuminate\Database\Eloquent\Builder $builder) {
            $prefix = request()->segment(1);
            if (!in_array($prefix, ['admin', 'staff', 'vendor'])) {
                $builder->where(function($query) {
                    $query->where('products.logintype', '!=', 'Vendor')
                          ->orWhereExists(function ($sub) {
                              $sub->select(\Illuminate\Support\Facades\DB::raw(1))
                                  ->from('vendor_details')
                                  ->whereColumn('vendor_details.id', 'products.login_id')
                                  ->whereDate('vendor_details.expired_date', '>=', date('Y-m-d'))
                                  ->where('vendor_details.status', 1);
                          });
                });
            }
        });
    }

    /**
     * Generate a unique slug from a product name.
     */
    public static function generateUniqueSlug($name, $ignoreId = null)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

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
