<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Experience;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $portfolio = [
            'personalInfo' => [
                'name' => $user->name,
                'contactInformation' => $user->email,
                'profilePicture' => $user->profile_photo_url,
            ],
            'experiences' => $user->experiences ?? [],
        ];

        return Inertia::render('Member/Portfolio/Show', [
            'portfolio' => $portfolio,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user)
    {
        $portfolio = [
            'personalInfo' => [
                'name' => $user->name,
                'contactInformation' => $user->email,
                'profilePicture' => $user->profile_photo_url,
            ],
            'professionalInfo' => [
                'jobTitle' => $user->job_title,
                'employer' => $user->employer,
                'education' => $user->education,
            ],
            'experiences' => [
                'workHistory' => $user->workHistory,
                'skills' => $user->skills,
                'certifications' => $user->certifications,
            ],
            'accountSettings' => [
                // You can add any relevant account settings here
            ],
        ];

        return Inertia::render('Member/Portfolio', [
            'portfolio' => $portfolio,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'avatar' => 'nullable|image|max:1024', // max 1MB
        ]);

        $user = auth()->user();
        
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($request->hasFile('avatar')) {
            $user->updateProfilePhoto($request->file('avatar'));
        }

        return back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Store experience.
     */
    public function storeExperience(Request $request)
    {
        $validated = $request->validate([
            'position' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
        ]);

        $experience = auth()->user()->experiences()->create($validated);

        return back()->with('success', 'Experience added successfully.');
    }

    /**
     * Update experience.
     */
    public function updateExperience(Request $request, $id)
    {
        $validated = $request->validate([
            'position' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
        ]);

        $experience = Experience::findOrFail($id);
        $experience->update($validated);

        return back()->with('success', 'Experience updated successfully.');
    }

    /**
     * Delete experience.
     */
    public function deleteExperience($id)
    {
        $experience = Experience::findOrFail($id);
        $experience->delete();

        return back()->with('success', 'Experience deleted successfully.');
    }

    /**
     * Update skills.
     */
    public function updateSkills(Request $request)
    {
        $validated = $request->validate([
            'skills' => 'array',
            'skills.*.id' => 'sometimes|integer',
            'skills.*.name' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        $user->skills = $validated['skills'];
        $user->save();

        return back()->with('success', 'Skills updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function profile(Request $request){
        return redirect()->route('profile.show');
    }
    
}
