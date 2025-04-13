<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    public function index()
    {
        return view('artist.space');
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = auth()->user();

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                Storage::disk('public')->delete('profile-photos/' . $user->profile_photo);
            }

            // Store new photo
            $photoName = time() . '.' . $request->profile_photo->extension();
            $request->profile_photo->storeAs('profile-photos', $photoName, 'public');
            $validated['profile_photo'] = $photoName;
        }

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully');
    }
}