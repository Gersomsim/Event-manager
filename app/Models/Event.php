<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\FilterByQuery;
use App\Models\Traits\HasUuid;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory, SoftDeletes, FilterByQuery, HasUuid;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'event_start_date',
        'event_end_date',
        'status',
        'available_places',
        'category_id',
        'location_id',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'event_start_date' => 'datetime',
        'event_end_date' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function organizers()
    {
        return $this->belongsToMany(Organizer::class);
    }

    public function tasks()
    {
        return $this->hasMany(EventTask::class);
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function reviews()
    {
        return $this->hasMany(EventReview::class);
    }

    public function recommendations()
    {
        return $this->hasMany(EventRecommendation::class);
    }
    
}
