<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RmRating extends Model
{
    use HasFactory;

    protected $table = 'rm_ratings';

    protected $fillable = [
        'staff_id',
        'vendor_id',
        'rating',
        'review'
    ];
}

