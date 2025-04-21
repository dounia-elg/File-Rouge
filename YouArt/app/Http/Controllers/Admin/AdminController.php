<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\User;
use App\Models\Workshop;
use App\Models\WorkshopRegistration;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dash
     */
    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'artworks' => Artwork::count(),
            'workshops' => Workshop::count(),
            'registrations' => WorkshopRegistration::count(),
        ];
        
        $recentWorkshops = Workshop::latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'recentWorkshops', 'recentUsers'));
    }
    
    /**
     * Display a list of users
     */
    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    
    /**
     * Display a list of all artworks
     */
    public function artworks()
    {
        $artworks = Artwork::with('user')->latest()->get();
        return view('admin.artworks.index', compact('artworks'));
    }
}
