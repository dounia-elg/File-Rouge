<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\User;
use App\Models\Workshop;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    
    public function dashboard()
    {

        $userCount = User::count();
        $artworkCount = Artwork::count();
        $workshopCount = Workshop::count();


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
