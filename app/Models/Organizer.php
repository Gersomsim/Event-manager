<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\FilterByQuery;

class Organizer extends Model
{
    use HasFactory, SoftDeletes, FilterByQuery;

    protected $fillable = [
        'nickname',
        'email',
        'phone',
        'organizer_type_id',
        'profile_id',
    ];

    public function organizerType()
    {
        return $this->belongsTo(OrganizerType::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
