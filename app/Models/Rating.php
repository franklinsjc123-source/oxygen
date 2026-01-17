<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    protected $fillable = [
        'products_id',
        'customer_id',
        'customer_name',
        'star_rating',
        'comments',
        'status'
    ];

}
