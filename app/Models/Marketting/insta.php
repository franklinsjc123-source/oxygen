<?php

namespace App\Models\Marketting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class insta extends Model
{
    use HasFactory;
    protected $table = 'instas';

    protected $primaryKey = 'id';

    protected $fillable = [
        "admin_id",
		"amount",
        "impressions",
        "clicks",
        "duration",        
        "status",
        "image",
        "text"        
    ];
}