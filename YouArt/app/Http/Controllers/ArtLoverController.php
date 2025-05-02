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
        // Get featured workshops
        $featuredWorkshops = Workshop::orderBy('id', 'desc')
            ->take(3)
            ->get();

        // Get featured artworks
        $featuredArtworks = Artwork::orderBy('id', 'desc')
            ->take(6)
            ->get();

        return view('artlover.space', compact('featuredWorkshops', 'featuredArtworks'));
    }
} 