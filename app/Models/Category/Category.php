<?php

namespace App\Models\Category;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';

    // public function main_category_name($id)
    // {
    //     return view('product-listing',  $CategoryMain = CategoryMain::find($id));

    //     //  $query->where('active', '=', 1);
    // }
    
    protected $fillable = ["main_category_id", "category_name", "slug", "category_image", "status", "flag", "created_by"];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = static::generateUniqueSlug($model->category_name);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('category_name') && !$model->isDirty('slug')) {
                $model->slug = static::generateUniqueSlug($model->category_name, $model->id);
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

    public function childmenu(){
        return $this->hasMany('App\Models\Category\CategorySub')->orderBy('category_sub_sortorder', 'asc');
        
    }

}

