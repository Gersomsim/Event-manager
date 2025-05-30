<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\FilterByQuery;

class EventReview extends Model
{
    use HasFactory, SoftDeletes, FilterByQuery;

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
