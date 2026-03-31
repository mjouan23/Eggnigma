<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Egg extends Model
{
    protected $fillable = [
        'code',
        'title',
        'clue',
        'hint',
        'answer',
        'image',
    ];

    public function getRouteKeyName()
    {
        return 'code';
    }
}
