@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Welcome, {{ Auth::user()->name }}!</h2>
        
        <div class="mb-6">
            <h3 class="text-lg font-medium text-gray-700 mb-2">Your Account Details</h3>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Role:</strong> {{ ucfirst(Auth::user()->role) }}</p>
            <p><strong>Joined:</strong> {{ Auth::user()->created_at->format('F j, Y') }}</p>
        </div>
        
        @if(Auth::user()->isArtist())
            <div class="mb-4">
                <h3 class="text-lg font-medium text-gray-700 mb-2">Artist Tools</h3>
                <p class="text-gray-600">Start creating your art gallery and upload your first artwork!</p>
            </div>
        @endif
        
        @if(Auth::user()->isAmateur())
            <div class="mb-4">
                <h3 class="text-lg font-medium text-gray-700 mb-2">Discover Art</h3>
                <p class="text-gray-600">Start exploring artists and their amazing artworks!</p>
            </div>
        @endif
    </div>
@endsection