<?php

namespace App\Http\Controllers\Member\Forum;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::with('user')->latest()->get();
        return Inertia::render('Member/Forum/Index', ['topics' => $topics]);
    }

    public function show(Topic $topic)
    {
        $topic->load(['messages' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }, 'messages.user', 'messages.replies']);
        //dd($topic->messages);
        return Inertia::render('Member/Forum/Topic', [
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

        return redirect()->route('member.forum.topic', $topic);
    }
}
