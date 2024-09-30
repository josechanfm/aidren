<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::with('user')->latest()->get();
        return Inertia::render('Forum/Index', ['topics' => $topics]);
    }

    public function show(Topic $topic)
    {
        $topic->load(['messages' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }, 'messages.user']);

        return Inertia::render('Forum/Topic', [
            'topic' => $topic,
            'messages' => $topic->messages,
            'canEdit' => auth()->user()->can('update', $topic),
            'canDelete' => auth()->user()->can('delete', $topic),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $topic = Topic::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('forum.topic', $topic);
    }
}
