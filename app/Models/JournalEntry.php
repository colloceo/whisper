<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    protected $fillable = [
        'user_email',
        'content',
        'mood',
        'is_anonymous'
    ];

    protected $casts = [
        'is_anonymous' => 'boolean'
    ];
}
