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
     * Like a workshop video.
     */
    public function like(Workshop $workshop)
    {
        // Increment like count
        $workshop->increment('likes');
        
        return back()->with('success', 'Thank you for liking this workshop!');
    }
} 