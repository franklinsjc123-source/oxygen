<?php

namespace App\Models\vendor\Marketting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wh_app extends Model
{
    use HasFactory;

    protected $table = 'vendor_wh_apps';

    protected $primaryKey = 'id';

    protected $fillable = [
        "vendor_id",
		"title",
        "sub_title",
        "line1",
        "line2",        
        "ph_no",
        "image",
        "status"        
    ];
}
