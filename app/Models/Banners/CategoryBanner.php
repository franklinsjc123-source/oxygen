<?php

namespace App\Models\Banners;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryBanner extends Model
{
    use HasFactory;
    protected $table = 'category_banners';
    protected $fillable = 
    [
        "admin_id",
        "title",
        "sub_title",
        "image",
        "link",
        "sort",
        "status"
    ];
}
