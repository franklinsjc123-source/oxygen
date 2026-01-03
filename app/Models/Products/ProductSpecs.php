<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSpecs extends Model
{
    use HasFactory;


    protected $primaryKey = 'id';
	
    protected $table = 'products_specs';
	
	

    protected $fillable = ["products_id", "category_sub_id", "specify_attribute", "specify_value"];
	
	
}
