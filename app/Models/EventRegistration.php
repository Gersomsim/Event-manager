<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasUuid;

class EventRegistration extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'event_id',
        'profile_id',
        'status',
    ];

    protected $hidden = [
        'updated_at',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
