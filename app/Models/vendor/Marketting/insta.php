<?php

namespace App\Models\vendor\Marketting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class insta extends Model
{
    use HasFactory;
    protected $table = 'vendor_instas';

    protected $primaryKey = 'id';

    protected $fillable = [
        "vendor_id",
		"amount",
        "impressions",
        "clicks",
        "duration",        
        "status",
        "image",
        "text"        
    ];
}