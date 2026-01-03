<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productcollection extends Model
{
    use HasFactory;
    protected $table = 'master_product_collection';

    protected $fillable = ["name", "image", "status"];	

    
}
