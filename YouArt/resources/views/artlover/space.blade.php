@extends('layouts.app')

@section('title', 'ArtLover Space')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="bg-white shadow rounded-lg p-10 text-center w-full max-w-2xl mx-auto mb-10">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        <div class="flex flex-col items-center mb-6">
            <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default-profile.jpg') }}" alt="Profile Image" class="w-24 h-24 rounded-full object-cover mb-2">
            <h1 class="text-3xl font-bold text-gray-900 mb-1">{{ Auth::user()->name }}</h1>
            @if(Auth::user()->location)
                <p class="text-gray-600 mb-1">{{ Auth::user()->location }}</p>
            @endif
        </div>
        @if(Auth::user()->bio)
            <div class="mb-6">
                <p class="text-gray-700 italic">{{ Auth::user()->bio }}</p>
            </div>
        @endif
        <a href="{{ route('artlover.edit') }}" class="inline-block px-6 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition" id="edit-profile-btn">Edit Profile</a>
    </div>

    <div class="max-w-6xl mx-auto">
        <h2 class="text-xl font-bold mb-4 text-left">Favorite Artworks</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @forelse($favoriteArtworks as $artwork)
                <div class="bg-white rounded shadow p-4 flex flex-col items-center relative">
                    <img src="{{ $artwork->image_path ? asset('storage/' . $artwork->image_path) : asset('images/default-artwork.jpg') }}" alt="{{ $artwork->title }}" class="w-full h-48 object-cover rounded mb-4">
                    <svg class="absolute top-4 right-4 h-7 w-7 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                    </svg>
                    <div class="w-full text-left">
                        <h3 class="text-md font-semibold">{{ $artwork->title }}</h3>
                        <p class="text-gray-600 text-sm mb-1">by {{ $artwork->user->name ?? 'Unknown' }}</p>
                        <p class="text-red-600 font-bold">${{ number_format($artwork->price, 0) }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500">No favorite artworks yet.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection 