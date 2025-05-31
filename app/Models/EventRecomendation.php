<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\FilterByQuery;

class EventRecomendation extends Model
{
    use HasFactory, FilterByQuery;

    protected $fillable = [
        'event_id',
        'profile_id',
    ];
}
