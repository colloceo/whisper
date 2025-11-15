<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affirmation extends Model
{
    protected $fillable = [
        'user_email',
        'original_entry',
        'affirmation_text',
        'is_saved'
    ];

    protected $casts = [
        'is_saved' => 'boolean'
    ];
}
