<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\FilterByQuery;
use App\Models\Traits\HasUuid;

class EventReview extends Model
{
    use HasFactory, SoftDeletes, FilterByQuery, HasUuid;

    protected $fillable = [
        'rating',
        'comment',
        'event_id',
        'profile_id',
    ];
    protected $hidden = [
        'updated_at',
        'deleted_at',
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

    public function photos()
    {
        return $this->hasMany(ReviewPhoto::class);
    }
}
