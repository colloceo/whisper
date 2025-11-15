<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SupportGroup;
use App\Models\CommunityActivity;

class SupportGroupSeeder extends Seeder
{
    public function run(): void
    {
        SupportGroup::create([
            'name' => 'Anxiety Support',
            'code' => 'AS',
            'description' => 'Managing daily worries together',
            'online_count' => 23
        ]);

        SupportGroup::create([
            'name' => 'Depression Support',
            'code' => 'DS',
            'description' => 'Finding light in dark moments',
            'online_count' => 18
        ]);

        SupportGroup::create([
            'name' => 'General Wellness',
            'code' => 'GW',
            'description' => 'Daily check-ins and positivity',
            'online_count' => 31
        ]);

        CommunityActivity::create([
            'user_name' => 'Anonymous',
            'action' => 'shared an encouraging message in',
            'group_name' => 'Anxiety Support'
        ]);

        CommunityActivity::create([
            'user_name' => 'Whisperer',
            'action' => 'joined',
            'group_name' => 'General Wellness'
        ]);

        CommunityActivity::create([
            'user_name' => 'Someone',
            'action' => 'started a new topic in',
            'group_name' => 'Depression Support'
        ]);
    }
}