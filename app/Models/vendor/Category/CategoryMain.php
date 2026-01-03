<?php

namespace App\Models\vendor\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMain extends Model
{
    use HasFactory;
    protected $table = 'vendor_category_main';

    protected $fillable = ["category_main_name", "category_main_image", "status", 'flag', "created_by"];


    public function submenu(){
       // $sub = ('App\Models\Category\Category', 'main_category_id', 'id');
        
        return $this->hasMany('App\Models\vendor\Category\Category', 'main_category_id', 'id');
          
    }


}


