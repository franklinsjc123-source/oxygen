<?php

namespace App\Models\Master\Colors;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected $table = 'product_color';
 protected $fillable = [
        'color_name',
        'color_code',
        'status',
         // Add this line to allow mass assignment for _token
    ];
    
}