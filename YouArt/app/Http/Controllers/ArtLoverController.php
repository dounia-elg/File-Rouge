<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workshop;
use App\Models\Artwork;

class ArtLoverController extends Controller
{
    /**
     * Show the ArtLover dashboard
     */
    public function space()
    {
        $user = auth()->user();
        $favoriteArtworks = $user->likedArtworks()->with('user')->latest()->get();
        $favoriteWorkshops = $user->likedWorkshops()->latest()->get();
        $followedArtists = $user->following()->where('role', 'artist')->get();
        return view('artlover.space', compact('user', 'favoriteArtworks', 'favoriteWorkshops', 'followedArtists'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('artlover.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            if ($user->profile_image && \Storage::exists('public/' . $user->profile_image)) {
                \Storage::delete('public/' . $user->profile_image);
            }
            $imagePath = $request->file('profile_image')->store('profile-images', 'public');
            $validated['profile_image'] = $imagePath;
        }

        $user->update($validated);

        return redirect()->route('artlover.space')->with('success', 'Profile updated successfully!');
    }
} 