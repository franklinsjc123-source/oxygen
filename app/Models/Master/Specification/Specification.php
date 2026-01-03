<?php

namespace App\Models\Master\Specification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use HasFactory;

    protected $table = 'master_specification';

    protected $primaryKey = 'id';

    protected $fillable = [
        "category_sub_id",
        "name",
        "value",
        "status"
    ];
}