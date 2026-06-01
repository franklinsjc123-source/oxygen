<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendor_details';
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['id','user_id','shop_name','slug','owner_name','business_category','email','mobile_number1','mobile_number2','address','address1','state','city','pincode','location_map','gst_number','profile_image','gst','other_documents'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = static::generateUniqueSlug($model->shop_name ?: 'shop');
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('shop_name') && !$model->isDirty('slug')) {
                $model->slug = static::generateUniqueSlug($model->shop_name ?: 'shop', $model->id);
            }
        });
    }

    public static function generateUniqueSlug($name, $ignoreId = null)
    {
        $slug = \Illuminate\Support\Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
