<?php

namespace App\Models\Banners;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mainslider extends Model
{
    use HasFactory;
    protected $table = 'mainsliders';
    protected $fillable = 
    [
        "admin_id",
        "title",
        "sub_title",
        "image",
        "link",
        "sort",
        "start_date",
        "end_date",
    ];
}
