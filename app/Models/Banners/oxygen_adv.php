<?php

namespace App\Models\Banners;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class oxygen_adv extends Model
{
    use HasFactory;
    protected $table = 'oxygen_advs';
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
