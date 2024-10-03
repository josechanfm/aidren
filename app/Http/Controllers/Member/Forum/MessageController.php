<?php

namespace App\Http\Controllers\Member\Forum;

use App\Http\Controllers\Controller;

use App\Models\Message;
use App\Models\Topic;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MessageController extends Controller
{
    public function store(Request $request, Topic $topic)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:messages,id'
        ]);

        $message = $topic->messages()->create([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'parent_id' => $validated['parent_id'] ?? null
        ]);
        // Load the user relationship for the new message
        $message->load('user');
        return response()->json($message);
    }

    // Add other methods as needed
}
