<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\FilterByQuery;
use App\Models\Traits\HasUuid;

class City extends Model
{
    use HasFactory, SoftDeletes, FilterByQuery, HasUuid;

    protected $fillable = [
        'name',
        'country_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
