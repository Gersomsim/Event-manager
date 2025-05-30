<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewComment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'event_review_id',
        'profile_id',
        'comment',
    ];

    public function eventReview()
    {
        return $this->belongsTo(EventReview::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function likes()
    {
        return $this->hasMany(ReviewLike::class);
    }
    
}
