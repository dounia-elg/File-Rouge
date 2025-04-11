<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ArtistController extends Controller
{
    /**
     * Show the artist space page
     */
    public function index()
    {
        $user = auth()->user();
        return view('artist.space', compact('user'));
    }

    /**
     * Update all profile information
     */
    public function updateProfile(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = auth()->user();

        // Handle profile photo if uploaded
        if ($request->hasFile('profile_photo')) {
            // Delete existing photo if it exists
            if ($user->profile_photo) {
                Storage::disk('public')->delete('profile-photos/' . $user->profile_photo);
            }

            // Store the new photo
            $photoName = time() . '-' . $request->profile_photo->getClientOriginalName();
            $request->profile_photo->storeAs('profile-photos', $photoName, 'public');
            $validated['profile_photo'] = $photoName;
        }

        // Update the user profile
        $user->update($validated);

        return back()->with('success', 'Profile updated successfully');
    }
}