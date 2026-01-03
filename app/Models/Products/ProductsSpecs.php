<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsSpecs extends Model
{
    use HasFactory;
	
	protected $primaryKey = 'id';
	
    //protected $table = 'products_specs';
	
	protected $table = 'master_specification';

    //protected $fillable = ["products_id", "specify_attribute", "specify_value"];
	
	protected $fillable = [
        "category_sub_id",
        "name",
        "value",
        "status"
    ];
	
}
