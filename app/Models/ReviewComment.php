<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\FilterByQuery;

class ReviewComment extends Model
{
    use HasFactory, SoftDeletes, FilterByQuery;

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
