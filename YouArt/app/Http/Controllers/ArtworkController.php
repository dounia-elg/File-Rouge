<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArtworkController extends Controller
{
    /**
     * Show the artwork creation form
     */
    public function create()
    {
        return view('artist.create-artwork');
    }
    
    /**
     * Store a new artwork
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'dimensions' => 'required|string|max:255',
            'image' => 'required|image|max:5048',
            'description' => 'nullable|string',
        ]);
        
        $user = Auth::user();
        
        // Store image
        $imagePath = $request->file('image')->store('artwork-images', 'public');
        
        // Create artwork
        $artwork = new Artwork([
            'title' => $validated['title'],
            'price' => $validated['price'],
            'dimensions' => $validated['dimensions'],
            'description' => $validated['description'],
            'image_path' => $imagePath,
        ]);
        
        $user->artworks()->save($artwork);
        
        return redirect()->route('artist.space')->with('success', 'Artwork added successfully');
    }

    /**
     * Show the artwork
     */
    public function show(Artwork $artwork)
    {
        return view('artist.show-artwork', compact('artwork'));
    }

    /**
     * Edit the artwork
     */
    public function edit(Artwork $artwork)
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
    public function update(Request $request, Artwork $artwork)
    {
        // Check if the user is the owner of the artwork
        if (Auth::id() !== $artwork->user_id) {
            return redirect()->route('artist.space')->with('error', 'You are not authorized to edit this artwork');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'dimensions' => 'required|string|max:255',
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
        $artwork->price = $validated['price'];
        $artwork->dimensions = $validated['dimensions'];
        $artwork->description = $validated['description'];
        $artwork->is_sold = isset($validated['is_sold']) ? $validated['is_sold'] : false;

        $artwork->save();

        return redirect()->route('artworks.show', $artwork)->with('success', 'Artwork updated successfully');
    }

    /**
     * Delete the artwork
     */
    public function destroy(Artwork $artwork)
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

    /**
     * Show all artworks ordered by newest first
     */
    public function all(Request $request)
    {
        $query = $request->input('q');
        $artworks = Artwork::with('user')
            ->when($query, function($qB) use ($query) {
                $qB->where('title', 'ILIKE', "%$query%");
            })
            ->orderBy('created_at', 'desc')
            ->get();
        return view('artworks.all', compact('artworks', 'query'));
    }

    /**
     * Like an artwork
     */
    public function like(Artwork $artwork)
    {
        $user = Auth::user();
        if (!$artwork->isLikedBy($user)) {
            $artwork->likes()->attach($user->id);
        }
        return back();
    }

    /**
     * Unlike an artwork
     */
    public function unlike(Artwork $artwork)
    {
        $user = Auth::user();
        if ($artwork->isLikedBy($user)) {
            $artwork->likes()->detach($user->id);
        }
        return back();
    }

    /**
     * Toggle like/unlike for AJAX requests
     */
    public function toggleLikeAjax(Artwork $artwork)
    {
        $user = Auth::user();
        $liked = false;
        if ($artwork->isLikedBy($user)) {
            $artwork->likes()->detach($user->id);
        } else {
            $artwork->likes()->attach($user->id);
            $liked = true;
        }
        $likeCount = $artwork->likes()->count();
        return response()->json([
            'liked' => $liked,
            'likeCount' => $likeCount
        ]);
    }
}
