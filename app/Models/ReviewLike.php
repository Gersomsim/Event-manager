<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasUuid;

class ReviewLike extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'event_review_id',
        'profile_id',
        'is_like',
    ];

    protected $hidden = [
        'updated_at',
    ];

    public function eventReview()
    {
        return $this->belongsTo(EventReview::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
