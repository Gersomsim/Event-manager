<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\FilterByQuery;

class Role extends Model
{
    use HasFactory, SoftDeletes, FilterByQuery;

    protected $fillable = [
        'name',
        'description',
    ];
    
    
}
