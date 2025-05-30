<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\FilterByQuery;
use App\Models\Traits\HasUuid;

class Organizer extends Model
{
    use HasFactory, SoftDeletes, FilterByQuery, HasUuid;

    protected $fillable = [
        'nickname',
        'email',
        'phone',
        'organizer_type_id',
        'profile_id',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
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
