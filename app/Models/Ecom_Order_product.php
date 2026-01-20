<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecom_Order_product extends Model
{
    protected $table = 'ecom_order_product';

   

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_image',
        'product_gstin',
        'product_size',
        'product_quantity',
        'product_price',
        'total_price',
        'order_status',
        'created_at',
        'updated_at',
    ];
	
	  public function gstvalue()
    {
        return $this->belongsTo('App\Models\Ecom_Product_Gst','product_gstin','ecom_gst_id');
    }
   
}
