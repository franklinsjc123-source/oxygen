<?php

namespace App\Models\vendor\products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productsAttri extends Model
{
    use HasFactory;


    protected $table = 'vendor_products_attris';
	
	

    protected $fillable = ["products_id", "category_sub_id", "spec_attribute", "spec_value"];
	
}
