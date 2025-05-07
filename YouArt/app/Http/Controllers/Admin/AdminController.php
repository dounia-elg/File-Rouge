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
        $soldArtworks = Artwork::with(['user', 'payment', 'payment.user'])
            ->where('is_sold', true)
            ->latest()
            ->get();
            
        $availableArtworks = Artwork::with('user')
            ->where('is_sold', false)
            ->latest()
            ->get();
            
        $potentialBuyers = User::where('role', 'art_lover')
            ->orWhere('role', 'admin')
            ->orderBy('name')
            ->get();
            
        return view('admin.artworks.index', compact('soldArtworks', 'availableArtworks', 'potentialBuyers'));
    }
    
    /**
     * Activate a user account
     */
    public function activateUser(User $user)
    {
        $user->is_active = true;
        $user->save();
        
        return redirect()->back()->with('success', 'User activated successfully.');
    }
    
    /**
     * Suspend a user account
     */
    public function suspendUser(User $user)
    {
        $user->is_active = false;
        $user->save();
        
        return redirect()->back()->with('success', 'User suspended successfully.');
    }
    
    /**
     * Delete a user account
     */
    public function deleteUser(User $user)
    {
        // Prevent admin from deleting themselves
        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }
        
        $user->delete();
        
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
    
    /**
     * Mark an artwork as sold
     */
    public function markArtworkAsSold(Request $request, Artwork $artwork)
    {
        // Validate the request
        $request->validate([
            'buyer_id' => 'required|exists:users,id',
        ]);
        
        // Create a payment record
        $payment = new \App\Models\Payment([
            'user_id' => $request->buyer_id,
            'artwork_id' => $artwork->id,
            'amount' => $artwork->price,
            'currency' => 'usd',
            'status' => 'completed',
            'stripe_payment_id' => 'admin-' . time(), // Placeholder for admin-created payments
            'payment_details' => json_encode([
                'method' => 'admin_marked',
                'admin_id' => auth()->id(),
                'created_at' => now()->toIso8601String()
            ]),
        ]);
        $payment->save();
        
        // Mark artwork as sold
        $artwork->is_sold = true;
        $artwork->save();
        
        return redirect()->route('admin.artworks')->with('success', 'Artwork marked as sold successfully.');
    }
}
