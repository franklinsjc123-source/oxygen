<?php

namespace App\Models\vendor\Master\Specification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use HasFactory;

    protected $table = 'vendor_master_specification';

    protected $primaryKey = 'id';

    protected $fillable = [
        "category_sub_id",
        "name",
        "value",
        "status"
    ];
}