<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkshopController extends Controller
{
    /**
     * Display a listing of workshops
     */
    public function index()
    {
        $workshops = Workshop::latest()->get();
        return view('admin.workshops.index', compact('workshops'));
    }

    /**
     * Show the form for creating a new works
     */
    public function create()
    {
        return view('admin.workshops.create');
    }

    /**
     * Store a newly created workshop
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'duration' => 'required|string',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|max:5048',
            'video_link' => 'nullable|url',
            'is_active' => 'boolean',
        ]);

        // Store image
        $imagePath = $request->file('image')->store('workshop-images', 'public');

        // Create workshop
        $workshop = new Workshop([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'duration' => $validated['duration'],
            'location' => $validated['location'],
            'capacity' => $validated['capacity'],
            'price' => $validated['price'],
            'image_path' => $imagePath,
            'video_link' => $validated['video_link'] ?? null,
            'is_active' => $request->has('is_active'),
        ]);

        $workshop->save();

        return redirect()->route('admin.workshops.index')->with('success', 'Workshop created successfully');
    }

    /**
     * Show the form for editing the workshop
     */
    public function edit(Workshop $workshop)
    {
        return view('admin.workshops.edit', compact('workshop'));
    }

    /**
     * Update the workshop
     */
    public function update(Request $request, Workshop $workshop)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'duration' => 'required|string',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:5048',
            'video_link' => 'nullable|url',
            'is_active' => 'boolean',
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image
            if ($workshop->image_path && Storage::exists('public/' . $workshop->image_path)) {
                Storage::delete('public/' . $workshop->image_path);
            }
            
            // Store new image
            $imagePath = $request->file('image')->store('workshop-images', 'public');
            $workshop->image_path = $imagePath;
        }

        // Update workshop properties
        $workshop->title = $validated['title'];
        $workshop->description = $validated['description'];
        $workshop->date = $validated['date'];
        $workshop->start_time = $validated['start_time'];
        $workshop->end_time = $validated['end_time'];
        $workshop->duration = $validated['duration'];
        $workshop->location = $validated['location'];
        $workshop->capacity = $validated['capacity'];
        $workshop->price = $validated['price'];
        $workshop->video_link = $validated['video_link'] ?? null;
        $workshop->is_active = $request->has('is_active');

        $workshop->save();

        return redirect()->route('admin.workshops.index')->with('success', 'Workshop updated successfully');
    }

    /**
     * Delete the workshop
     */
    public function destroy(Workshop $workshop)
    {
        // Delete the image file
        if ($workshop->image_path && Storage::exists('public/' . $workshop->image_path)) {
            Storage::delete('public/' . $workshop->image_path);
        }

        // Delete the workshop
        $workshop->delete();

        return redirect()->route('admin.workshops.index')->with('success', 'Workshop deleted successfully');
    }
}
