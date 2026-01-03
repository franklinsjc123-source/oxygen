<?php

namespace App\Models\PinCode;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinCode extends Model
{
    use HasFactory;
    protected $table = 'pincode';

    protected $fillable = ["zonal_id", "route_id", "name", "area", "post_region", "status","flag", "createdBy"];
}
