<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $fillable = ['user_email', 'daily_reminders', 'crisis_alerts', 'anonymous_mode'];
    
    protected $casts = [
        'daily_reminders' => 'boolean',
        'crisis_alerts' => 'boolean',
        'anonymous_mode' => 'boolean'
    ];
}
