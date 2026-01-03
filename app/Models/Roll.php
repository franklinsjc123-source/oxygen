<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roll extends Model
{
    use HasFactory;

    protected $table = 'rolls';

    protected $primaryKey = 'id';

    protected $fillable = [
        "roll",
		"description", 
        "permission_id"       
    ];
}
