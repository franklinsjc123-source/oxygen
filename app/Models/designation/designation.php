<?php

namespace App\Models\designation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class designation extends Model
{
    use HasFactory;

    protected $table = 'designation';

    protected $primaryKey = 'id';

    protected $fillable = [
        "department",
		"designation",
        "status"        
    ];
}
