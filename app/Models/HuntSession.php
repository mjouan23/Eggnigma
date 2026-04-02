<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HuntSession extends Model
{
    protected $fillable = [
        'session_key',
        'started_at',
        'ends_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ends_at' => 'datetime',
    ];
}
