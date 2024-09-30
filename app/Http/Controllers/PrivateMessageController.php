<?php

namespace App\Http\Controllers;

use App\Models\PrivateMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PrivateMessageController extends Controller
{
    public function index()
    {
        $messages = PrivateMessage::where('sender_id', auth()->id())
            ->orWhere('recipient_id', auth()->id())
            ->with(['sender', 'recipient'])
            ->latest()
            ->get();

        return Inertia::render('Messages/Index', ['messages' => $messages]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'recipient_id' => 'required|exists:users,id',
        ]);

        PrivateMessage::create([
            'content' => $validated['content'],
            'sender_id' => auth()->id(),
            'recipient_id' => $validated['recipient_id'],
        ]);

        return back();
    }
}
