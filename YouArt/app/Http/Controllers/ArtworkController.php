<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArtworkController extends Controller
{

    public function create()
    {
        return view('artist.create-artwork');
    }


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


        $imagePath = $request->file('image')->store('artwork-images', 'public');


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

    public function show(Artwork $artwork)
    {
        return view('artist.show-artwork', compact('artwork'));
    }


    public function edit(Artwork $artwork)
    {

        if (Auth::id() !== $artwork->user_id) {
            return redirect()->route('artist.space')->with('error', 'You are not authorized to edit this artwork');
        }

        return view('artist.edit-artwork', compact('artwork'));
    }


    public function update(Request $request, Artwork $artwork)
    {

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


        if ($request->hasFile('image')) {

            if ($artwork->image_path && Storage::exists('public/' . $artwork->image_path)) {
                Storage::delete('public/' . $artwork->image_path);
            }


            $imagePath = $request->file('image')->store('artwork-images', 'public');
            $artwork->image_path = $imagePath;
        }


        $artwork->title = $validated['title'];
        $artwork->price = $validated['price'];
        $artwork->dimensions = $validated['dimensions'];
        $artwork->description = $validated['description'];
        $artwork->is_sold = isset($validated['is_sold']) ? $validated['is_sold'] : false;

        $artwork->save();

        return redirect()->route('artworks.show', $artwork)->with('success', 'Artwork updated successfully');
    }


    public function destroy(Artwork $artwork)
    {

        if (Auth::id() !== $artwork->user_id) {
            return redirect()->route('artist.space')->with('error', 'You are not authorized to delete this artwork');
        }


        if ($artwork->image_path && Storage::exists('public/' . $artwork->image_path)) {
            Storage::delete('public/' . $artwork->image_path);
        }


        $artwork->delete();

        return redirect()->route('artist.space')->with('success', 'Artwork deleted successfully');
    }


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


    public function like(Artwork $artwork)
    {
        $user = Auth::user();
        if (!$artwork->isLikedBy($user)) {
            $artwork->likes()->attach($user->id);
        }
        return back();
    }


    public function unlike(Artwork $artwork)
    {
        $user = Auth::user();
        if ($artwork->isLikedBy($user)) {
            $artwork->likes()->detach($user->id);
        }
        return back();
    }

    
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
