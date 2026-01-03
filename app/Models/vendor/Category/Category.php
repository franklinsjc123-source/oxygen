<?php

namespace App\Models\vendor\Category;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'vendor_category';

    // public function main_category_name($id)
    // {
    //     return view('product-listing',  $CategoryMain = CategoryMain::find($id));

    //     //  $query->where('active', '=', 1);
    // }
    
    protected $fillable = ["main_category_id", "category_name", "category_image", "status", "flag", "created_by"];

    public function childmenu(){
        return $this->hasMany('App\Models\vendor\Category\CategorySub');
        
    }

}

