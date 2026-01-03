<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'zonal_id','name', 'status','createdBy'];

    public function zonals()
    {
        return $this->belongsTo('App\Models\Zonal','zonal_id');
    }
}
