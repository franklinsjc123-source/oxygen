<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staffcreates extends Model
{
    use HasFactory;
    protected $table = 'staffother';

    protected $fillable = ["employee_id", "username", "fullname", "dob", "department", "designation","mobileno","a_mobileno","email","qualification","exprience","bloodgroup","doj","permanant_addr","curr_addr","password",
    "profileimage","aatherimage","pancard","otherdoc","monthlysalary","ctc","dailytarget","monthlytarget","zone_id","route_id","flag", "createdBy"];
}
