<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{

    public function space()
    {
        $user = Auth::user();
        $artworks = $user->artworks()->latest()->get();
        $followedArtists = $user->following()->where('role', 'artist')->get();
        return view('artist.artist-space', compact('user', 'artworks', 'followedArtists'));
    }


    public function edit()
    {
        $user = Auth::user();
        return view('artist.edit-profile', compact('user'));
    }


    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'nullable|string|max:255',
                'location' => 'nullable|string|max:255',
                'bio' => 'nullable|string|max:1000',
                'profile_image' => 'nullable|image|max:2048',
            ]);

            $user = Auth::user();


            if ($request->hasFile('profile_image')) {
                if ($user->profile_image && Storage::exists('public/' . $user->profile_image)) {
                    Storage::delete('public/' . $user->profile_image);
                }

                $imagePath = $request->file('profile_image')->store('profile-images', 'public');
                $validated['profile_image'] = $imagePath;
            }


            $fieldsToUpdate = [];


            $columns = Schema::getColumnListing('users');

            foreach ($validated as $field => $value) {
                if (in_array($field, $columns)) {
                    $fieldsToUpdate[$field] = $value;
                }
            }

            $user->update($fieldsToUpdate);

            return redirect()->route('artist.space')->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            \Log::error('Profile update error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating your profile. Please try again later.');
        }
    }


    public function all(Request $request)
    {
        $query = $request->input('q');
        $artists = \App\Models\User::where('role', 'artist')
            ->when($query, function($q) use ($query) {
                $q->where('name', 'ILIKE', "%$query%");
            })
            ->latest()->get();
        return view('artist.all-artists', compact('artists', 'query'));
    }


    public function profile($id)
    {
        $artist = \App\Models\User::where('id', $id)->where('role', 'artist')->firstOrFail();
        $artworks = $artist->artworks()->latest()->get();
        return view('artist.public-profile', compact('artist', 'artworks'));
    }


    public function follow($id)
    {
        $artist = \App\Models\User::where('id', $id)->where('role', 'artist')->firstOrFail();
        $user = auth()->user();
        if (!$user->isFollowing($artist)) {
            $user->following()->attach($artist->id);
        }
        return back();
    }

    
    public function unfollow($id)
    {
        $artist = \App\Models\User::where('id', $id)->where('role', 'artist')->firstOrFail();
        $user = auth()->user();
        if ($user->isFollowing($artist)) {
            $user->following()->detach($artist->id);
        }
        return back();
    }
}
