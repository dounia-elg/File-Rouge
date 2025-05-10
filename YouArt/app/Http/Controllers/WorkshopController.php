<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->input('q');
        $workshops = Workshop::orderBy('id', 'desc')
            ->when($query, function($qB) use ($query) {
                $qB->where('title', 'ILIKE', "%$query%");
            })
            ->paginate(9);
        return view('workshops.index', compact('workshops', 'query'));
    }


    public function show(Workshop $workshop)
    {

        $workshop->increment('views');

        return view('workshops.show', compact('workshop'));
    }


    public function like(Workshop $workshop)
    {
        $user = auth()->user();
        if (!$workshop->isLikedBy($user)) {
            $workshop->likes()->attach($user->id);
        }
        return back();
    }


    public function unlike(Workshop $workshop)
    {
        $user = auth()->user();
        if ($workshop->isLikedBy($user)) {
            $workshop->likes()->detach($user->id);
        }
        return back();
    }

    
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
