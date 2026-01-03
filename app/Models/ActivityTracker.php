<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityTracker extends Model
{
    use HasFactory;

    // Define the table if it does not follow Laravel's convention (e.g., "activity_trakcers" in the database)
    protected $table = 'activity_trakcers'; 

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'shop_name',
        'owner_name',
        'business_category',
        'email',
        'mobile_number',
        'mobile_number1',
        'address',
        'address1',
        'state',
        'city',
        'pincode',
        'location_map',
        'zone',
        'area',
        'pipline',
        'win',
        'reference',
        'next_follow_date',
        'createdby',
        'status',
        'reason',
        'manufacturer_type',
        'manufacturer_details',
    ];

    // Optionally, you can define relationships if your model has any relationships to other models, such as a "User" model.
    // For example, if you have a user who created the activity, you could define a relationship:

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'createdBy');
    }

    // If needed, you can also define accessors, mutators, or any other custom methods.
}
