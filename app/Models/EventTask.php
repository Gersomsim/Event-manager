<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\FilterByQuery;
use App\Models\Traits\HasUuid;

class EventTask extends Model
{
    use HasFactory, SoftDeletes, FilterByQuery, HasUuid;

    protected $fillable = [
        'name',
        'description',
        'task_start_date',
        'task_end_date',
        'event_id',
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'task_start_date' => 'datetime',
        'task_end_date' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function organizers()
    {
        return $this->belongsToMany(Organizer::class, 'event_task_organizer');
    }
}
