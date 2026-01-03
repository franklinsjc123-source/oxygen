<?php

namespace App\Models\Marketting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wh_app extends Model
{
    use HasFactory;

    protected $table = 'wh_apps';

    protected $primaryKey = 'id';

    protected $fillable = [
        "admin_id",
		"title",
        "sub_title",
        "line1",
        "line2",        
        "ph_no",
        "image",
        "status"        
    ];
}
