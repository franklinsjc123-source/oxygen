<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMain extends Model
{
    use HasFactory;
    protected $table = 'category_main';
    protected $primaryKey = 'id';
    protected $fillable = ["category_main_name", "slug", "category_main_image", "status", 'flag', "created_by"];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = static::generateUniqueSlug($model->category_main_name);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('category_main_name') && !$model->isDirty('slug')) {
                $model->slug = static::generateUniqueSlug($model->category_main_name, $model->id);
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

    public function submenu(){
       // $sub = ('App\Models\Category\Category', 'main_category_id', 'id');
        
        return $this->hasMany('App\Models\Category\Category', 'main_category_id', 'id')->orderBy('category_sortorder', 'asc');
          
    }


}


