<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendor_details';
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['id','user_id','shop_name','owner_name','business_category','email','mobile_number1','mobile_number2','address','address1','state','city','pincode','location_map','gst_number','profile_image','gst','other_documents'];
}
