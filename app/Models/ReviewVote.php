<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rating;

class ReviewVote extends Model
{
    use HasFactory;
    protected $table = 'review_votes';

    protected $fillable = ['rating_id', 'customer_id', 'type'];

    public function rating()
    {
        return $this->belongsTo(Rating::class);
    }
}
