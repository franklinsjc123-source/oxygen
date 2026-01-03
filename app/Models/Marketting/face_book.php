<?php

namespace App\Models\Marketting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class face_book extends Model
{
    use HasFactory;
    protected $table = 'face_books';

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
