<?php

namespace App\Models\Master\ProductCollection;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCollection extends Model
{
    use HasFactory;

    protected $table = 'master_product_collection';

    protected $fillable = ["id", "name", "image", "status", "flag", "created_by"];
}