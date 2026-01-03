<?php

namespace App\Models\Marketting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class oxygen extends Model
{
    use HasFactory; 
    protected $table = 'oxygens_promo';

    protected $primaryKey = 'id';

    protected $fillable = [
        "admin_id",
		"amount",
        "impressions",
        "clicks",
        "duration",        
        "status",
        "image",
        "text"        
    ]; //oxygens_promo
}