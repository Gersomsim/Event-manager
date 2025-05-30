<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\FilterByQuery;

class EventTask extends Model
{
    use HasFactory, SoftDeletes, FilterByQuery;

    protected $fillable = [
        'name',
        'description',
        'task_start_date',
        'task_end_date',
        'event_id',
    ];

    protected $casts = [
        'task_start_date' => 'datetime',
        'task_end_date' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
