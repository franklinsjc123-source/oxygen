<?php

namespace App\Models\vendor\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productcollection extends Model
{
    use HasFactory;
    protected $table = 'vendor_master_product_collection';

    protected $fillable = ["vendor_id","name", "image", "status"];	

    
}
