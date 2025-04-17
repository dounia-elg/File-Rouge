<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    /**
     * Display the artist space
     */
    public function space()
    {
        $user = Auth::user();
        $artworks = $user->artworks()->latest()->get();
        
        return view('artist.artist-space', compact('user', 'artworks'));
    }
    
    /**
     * Show the artist profile edit form
     */
    public function edit()
    {
        $user = Auth::user();
        return view('artist.edit-profile', compact('user'));
    }
    
    /**
     * Update the artist profile
     */
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
            
            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                if ($user->profile_image && Storage::exists('public/' . $user->profile_image)) {
                    Storage::delete('public/' . $user->profile_image);
                }
                
                $imagePath = $request->file('profile_image')->store('profile-images', 'public');
                $validated['profile_image'] = $imagePath;
            }
            
            // Only update fields that are in the database table 
            $fieldsToUpdate = [];
            
            // Check if fields exist in users table before attempting to update
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
    
    /**
     * Show the artwork creation form
     */
    public function createArtwork()
    {
        return view('artist.create-artwork');
    }
    
    /**
     * Store a new artwork
     */
    public function storeArtwork(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|max:5048',
            'description' => 'nullable|string',
        ]);
        
        $user = Auth::user();
        
        // Store image
        $imagePath = $request->file('image')->store('artwork-images', 'public');
        
        // Create artwork
        $artwork = new Artwork([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image_path' => $imagePath,
        ]);
        
        $user->artworks()->save($artwork);
        
        return redirect()->route('artist.space')->with('success', 'Artwork added successfully');
    }
}
