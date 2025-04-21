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

    /**
     * Show the artwork
     */
    public function showArtwork(Artwork $artwork)
    {
        return view('artist.show-artwork', compact('artwork'));
    }

    /**
     * Edit the artwork
     */
    public function editArtwork(Artwork $artwork)
    {
        // Check if the user is the owner of the artwork
        if (Auth::id() !== $artwork->user_id) {
            return redirect()->route('artist.space')->with('error', 'You are not authorized to edit this artwork');
        }

        return view('artist.edit-artwork', compact('artwork'));
    }

    /**
     * Update the artwork
     */
    public function updateArtwork(Request $request, Artwork $artwork)
    {
        // Check if the user is the owner of the artwork
        if (Auth::id() !== $artwork->user_id) {
            return redirect()->route('artist.space')->with('error', 'You are not authorized to edit this artwork');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:5048',
            'description' => 'nullable|string',
            'is_sold' => 'nullable|boolean',
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image
            if ($artwork->image_path && Storage::exists('public/' . $artwork->image_path)) {
                Storage::delete('public/' . $artwork->image_path);
            }
            
            // Store new image
            $imagePath = $request->file('image')->store('artwork-images', 'public');
            $artwork->image_path = $imagePath;
        }

        // Update artwork properties
        $artwork->title = $validated['title'];
        $artwork->category = $validated['category'];
        $artwork->price = $validated['price'];
        $artwork->description = $validated['description'];
        $artwork->is_sold = isset($validated['is_sold']) ? $validated['is_sold'] : false;

        $artwork->save();

        return redirect()->route('artworks.show', $artwork)->with('success', 'Artwork updated successfully');
    }

    /**
     * Delete the artwork
     */
    public function destroyArtwork(Artwork $artwork)
    {
        // Check if the user is the owner of the artwork
        if (Auth::id() !== $artwork->user_id) {
            return redirect()->route('artist.space')->with('error', 'You are not authorized to delete this artwork');
        }

        // Delete the image file
        if ($artwork->image_path && Storage::exists('public/' . $artwork->image_path)) {
            Storage::delete('public/' . $artwork->image_path);
        }

        // Delete the artwork
        $artwork->delete();

        return redirect()->route('artist.space')->with('success', 'Artwork deleted successfully');
    }
}
