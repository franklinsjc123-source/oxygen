<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;

class State extends Model
{
    use HasFactory;
    protected $table = 'statelist';
    protected $fillable = ['state_name', 'status'];

    public function cities() {
        return $this->hasMany(City::class, 'state_id');
    }
}
