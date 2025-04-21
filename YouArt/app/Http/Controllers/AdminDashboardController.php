<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\User;
use App\Models\Workshop;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard
     */
    public function dashboard()
    {
        // Simple stats for dashboard
        $userCount = User::count();
        $artworkCount = Artwork::count();
        $workshopCount = Workshop::count();
        
        // Get recent items
        $recentUsers = User::latest()->take(5)->get();
        $recentWorkshops = Workshop::latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'userCount', 
            'artworkCount', 
            'workshopCount',
            'recentUsers',
            'recentWorkshops'
        ));
    }
} 