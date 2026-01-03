<?php

namespace App\Models\vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class packages extends Model
{
    use HasFactory;
    protected $table = 'packages';

    protected $primaryKey = 'id';

    protected $fillable = [
        "name",
        "image",
        "price",
        "validity",
        "days",
        "wallet",
        "commission",
        "description",
        "status",
        "flag",
        "created_at",
        "updated_at"

    ];
}
