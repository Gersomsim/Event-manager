<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasUuid;

class ReviewPhoto extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'event_review_id',
        'photo_url',
    ];

    protected $hidden = [
        'updated_at',
    ];

    public function eventReview()
    {
        return $this->belongsTo(EventReview::class);
    }
}
