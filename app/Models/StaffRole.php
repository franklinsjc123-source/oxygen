<?php

namespace App\Models;
use App\Models\Departments;
use App\Models\designation\designation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffRole extends Model
{
    use HasFactory;
    protected $table = 'staff_roles';
    protected $fillable = ['department', 'designation','mainmenus', 'submenus'];
    public function department() {
        return $this->belongsTo(Departments::class);
    }
    
    public function designation() {
        return $this->belongsTo(Designation::class);
    }
}
