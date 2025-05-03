<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the workshops.
     */
    public function index()
    {
        $workshops = Workshop::orderBy('id', 'desc')
                            ->paginate(9);
        
        return view('workshops.index', compact('workshops'));
    }

    /**
     * Display the specified workshop video.
     */
    public function show(Workshop $workshop)
    {
        // Increment view count
        $workshop->increment('views');
        
        return view('workshops.show', compact('workshop'));
    }
    
    /**
     * Like a workshop (AJAX and normal)
     */
    public function like(Workshop $workshop)
    {
        $user = auth()->user();
        if (!$workshop->isLikedBy($user)) {
            $workshop->likes()->attach($user->id);
        }
        return back();
    }

    /**
     * Unlike a workshop
     */
    public function unlike(Workshop $workshop)
    {
        $user = auth()->user();
        if ($workshop->isLikedBy($user)) {
            $workshop->likes()->detach($user->id);
        }
        return back();
    }

    /**
     * Toggle like/unlike for AJAX requests
     */
    public function toggleLikeAjax(Workshop $workshop)
    {
        $user = auth()->user();
        $liked = false;
        if ($workshop->isLikedBy($user)) {
            $workshop->likes()->detach($user->id);
        } else {
            $workshop->likes()->attach($user->id);
            $liked = true;
        }
        $likeCount = $workshop->likes()->count();
        return response()->json([
            'liked' => $liked,
            'likeCount' => $likeCount
        ]);
    }
} 