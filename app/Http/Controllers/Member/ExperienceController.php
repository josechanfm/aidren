<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Experience;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = auth()->user()->experiences;
        return response()->json($experiences);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'position' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
        ]);

        $experience = auth()->user()->experiences()->create($validated);

        return back()->with('success', 'Experience added successfully.');
    }

    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'position' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
        ]);

        $experience->update($validated);

        return back()->with('success', 'Experience updated successfully.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return back()->with('success', 'Experience deleted successfully.');
    }
}