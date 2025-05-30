<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'profile_id',
        'status',
    ];

    public function events()
    {
        return $this->belongsTo(Event::class);
    }

}
