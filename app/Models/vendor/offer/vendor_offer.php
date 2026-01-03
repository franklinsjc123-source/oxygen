<?php

namespace App\Models\vendor\offer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendor_offer extends Model
{
    use HasFactory;
    protected $table = 'vendor_offers';

    protected $fillable = ["created_by_id","catagory_id","product_id","title","type","buy","getoffer","cashbacktype","cashbackvalue","ActiveStartDate","ActiveEndDate","ActiveStartTime","ActiveEndTime","discount_type","backgroundimage", "textalign", "value", "types","m_p_a"];
}