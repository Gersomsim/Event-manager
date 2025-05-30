<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'last_name',
        'phone',
        'profile_picture_url',
        'email',
        'user_id',
    ];

    public function organizer()
    {
        return $this->hasOne(Organizer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function eventsRegistered()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function eventReviews()
    {
        return $this->hasMany(EventReview::class);
    }

    public function eventRecommendations()
    {
        return $this->hasMany(EventRecommendation::class);
    }

    public function eventTasks()
    {
        return $this->hasMany(EventTask::class);
    }

    public function reviewsComments()
    {
        return $this->hasMany(ReviewComment::class);
    }

    public function reviewsLikes()
    {
        return $this->hasMany(ReviewLike::class);
    }    
}
