<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zonal extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'name', 'status', 'createdBy'];
    public function routes()
    {
        return $this->hasMany('App\Models\Route');
    }
}
