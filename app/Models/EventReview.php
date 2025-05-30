<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventReview extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'rating',
        'comment',
        'event_id',
        'profile_id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function comments()
    {
        return $this->hasMany(ReviewComment::class);
    }

    public function likes()
    {
        return $this->hasMany(ReviewLike::class);
    }
}
