<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\FilterByQuery;
use App\Models\Traits\HasUuid;

class ReviewComment extends Model
{
    use HasFactory, SoftDeletes, FilterByQuery, HasUuid;

    protected $fillable = [
        'event_review_id',
        'profile_id',
        'comment',
    ];

    protected $hidden = [
        'deleted_at',
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
