<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StaffRole;

class Departments extends Model
{
    use HasFactory;
	
    protected $table = 'departments';

    protected $primaryKey = 'id';

    protected $fillable = [
        "name",
		"status"        
    ];
    public function staffRoles() {
        return $this->hasMany(StaffRole::class);
    }
    
}

