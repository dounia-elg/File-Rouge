<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkshopController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Middleware should be applied in routes file instead of constructor
        // or use parent middleware methods if Controller class has them
    }

    /**
     * Display a listing of the workshops.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workshops = Workshop::latest()->paginate(10);
        return view('admin.workshops.index', compact('workshops'));
    }

    /**
     * Show the form for creating a new workshop.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.workshops.create');
    }

    /**
     * Store a newly created workshop in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_link' => 'required|string|max:255',
            'skill_level' => 'required|string|in:beginner,intermediate,advanced',
        ]);

        Workshop::create($validated);

        return redirect()->route('admin.workshops.index')
            ->with('success', 'Workshop created successfully.');
    }

    /**
     * Show the form for editing the specified workshop.
     *
     * @param  \App\Models\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function edit(Workshop $workshop)
    {
        return view('admin.workshops.edit', compact('workshop'));
    }

    /**
     * Update the specified workshop in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workshop $workshop)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_link' => 'required|string|max:255',
            'skill_level' => 'required|string|in:beginner,intermediate,advanced',
        ]);

        $workshop->update($validated);

        return redirect()->route('admin.workshops.index')
            ->with('success', 'Workshop updated successfully.');
    }

    /**
     * Remove the specified workshop from storage.
     *
     * @param  \App\Models\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workshop $workshop)
    {
        // Delete thumbnail if exists
        if ($workshop->thumbnail_image) {
            Storage::disk('public')->delete($workshop->thumbnail_image);
        }
        
        $workshop->delete();
        
        return redirect()->route('admin.workshops.index')
            ->with('success', 'Workshop deleted successfully.');
    }
}
