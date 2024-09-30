<?php

namespace Database\Seeders;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('email', 'admin@example.com')->first();

        Topic::create([
            'title' => 'Welcome to our Dispute Resolution Forum',
            'description' => 'Introduce yourself and learn about our community guidelines.',
            'user_id' => $admin->id,
        ]);

        Topic::create([
            'title' => 'Mediation Techniques',
            'description' => 'Share and discuss effective mediation techniques.',
            'user_id' => $admin->id,
        ]);
    }
}

