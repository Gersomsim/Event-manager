<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRecomendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'profile_id',
    ];
}
