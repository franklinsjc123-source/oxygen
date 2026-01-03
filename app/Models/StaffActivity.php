<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffActivity extends Model
{
    use HasFactory;

    // Define the table if it does not follow Laravel's convention (e.g., "activity_trakcers" in the database)
    protected $table = 'staff_activity'; 

    // Define the fillable fields for mass assignment
    protected $fillable = [
         'vendor_id',
        'pipline',
        'win',        
        'next_follow_date',
        'reason'
    ];

    
}
