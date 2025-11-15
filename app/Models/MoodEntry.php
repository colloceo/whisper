<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoodEntry extends Model
{
    protected $fillable = [
        'user_email',
        'mood_type',
        'intensity',
        'notes'
    ];

    protected $casts = [
        'intensity' => 'integer'
    ];
}
