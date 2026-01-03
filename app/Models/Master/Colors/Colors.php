<?php

namespace App\Models\Master\Colors;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    use HasFactory;

    protected $table = 'master_gst';

    protected $primaryKey = 'id';

    protected $fillable = [
        "name",
        "value",
        "description",
        "status",
        "flag",
        "created_by",
    ];
}