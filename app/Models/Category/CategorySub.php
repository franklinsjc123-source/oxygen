<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySub extends Model
{
    use HasFactory;
    protected $table = 'category_sub';

    protected $primaryKey = 'id';


    // public function main_category_name($id)
    // {
    //     return view('product-listing',  $CategorySub = CategorySub::find($id));

    //     //  $query->where('active', '=', 1);
    // }

    protected $fillable = [
        "category_id",
        "category_main_id",
        "category_sub_name",
        "slug",
        "category_sub_image",
        "status",
        "flag",
        "created_by"
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = static::generateUniqueSlug($model->category_sub_name);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('category_sub_name') && !$model->isDirty('slug')) {
                $model->slug = static::generateUniqueSlug($model->category_sub_name, $model->id);
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