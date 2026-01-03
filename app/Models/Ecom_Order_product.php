<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecom_Order_product extends Model
{
    protected $table = 'ecom_order_product';
	
	  public function gstvalue()
    {
        return $this->belongsTo('App\Models\Ecom_Product_Gst','product_gstin','ecom_gst_id');
    }
   
}
