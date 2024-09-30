<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('email', 'admin@example.com')->first();
        $topics = Topic::all();

        foreach ($topics as $topic) {
            Message::create([
                'content' => "Welcome to the {$topic->title} discussion!",
                'topic_id' => $topic->id,
                'user_id' => $admin->id,
            ]);
        }
    }
}
