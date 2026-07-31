<?php

namespace App\Models\vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendorcreate extends Model
{
    use HasFactory;
    protected $table = 'vendor_details';

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
