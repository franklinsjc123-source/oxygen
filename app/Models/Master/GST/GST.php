<?php

namespace App\Models\Master\GST;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GST extends Model
{
    use HasFactory;

    protected $table = 'master_gst';

    protected $primaryKey = 'id';

    protected $fillable = [
        "gst_name",
        "value",
        "description",
        "status",
        "flag",
        "created_by",
    ];
}