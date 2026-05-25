<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'type',
        'title',
        'date',
        'time',
        'venue',
        'agenda',
        'members',
    ];

    protected $casts = [
        'members' => 'array',
    ];
}