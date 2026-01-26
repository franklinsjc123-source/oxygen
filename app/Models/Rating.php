<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReviewVote;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    protected $fillable = [
        'products_id',
        'customer_id',
        'customer_name',
        'star_rating',
        'comments',
        'status'
    ];

    public function helpfulVotes()
    {
        return $this->hasMany(ReviewVote::class, 'rating_id')
                    ->where('type', 'helpful');
    }

    public function unhelpfulVotes()
    {
        return $this->hasMany(ReviewVote::class, 'rating_id')
                    ->where('type', 'unhelpful');
    }
}
