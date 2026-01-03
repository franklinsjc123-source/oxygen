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
        "category_sub_image",
        "status",
        "flag",
        "created_by"
    ];
}