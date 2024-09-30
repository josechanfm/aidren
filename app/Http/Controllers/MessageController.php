<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Topic;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'topic_id' => 'required|exists:topics,id',
            'parent_id' => 'nullable|exists:messages,id',
        ]);

        $message = Message::create([
            'content' => $validated['content'],
            'topic_id' => $validated['topic_id'],
            'user_id' => auth()->id(),
            'parent_id' => $validated['parent_id'] ?? null,
        ]);

        return back();
    }

    // Add other methods as needed
}
