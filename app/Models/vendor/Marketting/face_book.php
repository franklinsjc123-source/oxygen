<?php

namespace App\Models\vendor\Marketting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class face_book extends Model
{
    use HasFactory;
    protected $table = 'vendor_face_books';

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
