<?php

namespace App\Models\vendor\Master\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $table = 'vendor_master_attribute';

    protected $primaryKey = 'id';

    protected $fillable = [
        "category_sub_id",
        "attribute_name",
        "value",
        "status"
    ];
}