@extends('layouts.app')

@section('title', 'ArtLover Space')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">
    <div class="flex flex-col items-center">
        <!-- Profile Card -->
        <div class="bg-white shadow rounded-lg px-10 py-8 w-full max-w-4xl mb-10 flex flex-col md:flex-row items-center md:items-start justify-between">
            <div class="flex items-center w-full md:w-auto">
                <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('images/default-profile.jpg') }}" alt="Profile Image" class="w-24 h-24 rounded-full object-cover mr-6">
                <div class="text-left">
                    <h1 class="text-2xl font-bold text-gray-900 mb-1">{{ $user->name }}</h1>
                    @if($user->location)
                        <p class="text-gray-600 mb-1">{{ $user->location }}</p>
                    @endif
                    @if($user->bio)
                        <p class="text-gray-600 mb-1">{{ $user->bio }}</p>
                    @endif
                </div>
            </div>
            <div class="mt-6 md:mt-0 md:ml-8">
                <a href="{{ route('artlover.edit') }}" class="px-6 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Edit Profile</a>
            </div>
        </div>

        <!-- Favorite Artworks -->
        <div class="w-full max-w-6xl mb-12">
            <h2 class="text-xl font-bold mb-4 text-left">Favorite Artworks</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @forelse($favoriteArtworks as $artwork)
                    <a href="{{ route('artworks.show', $artwork) }}" class="bg-white rounded-xl shadow p-4 flex flex-col items-start relative group transition hover:shadow-lg cursor-pointer">
                        <div class="w-full relative">
                            <img src="{{ $artwork->image_path ? asset('storage/' . $artwork->image_path) : asset('images/default-artwork.jpg') }}" alt="{{ $artwork->title }}" class="w-full h-48 object-cover rounded mb-4">
                            <svg class="absolute top-3 right-3 h-7 w-7 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                            </svg>
                        </div>
                        <div class="w-full text-left">
                            <h3 class="text-md font-semibold mb-1">{{ $artwork->title }}</h3>
                            <p class="text-gray-600 text-sm mb-1">by {{ $artwork->user->name ?? 'Unknown' }}</p>
                            <p class="text-red-600 font-bold text-base">${{ number_format($artwork->price, 0) }}</p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center text-gray-500">No favorite artworks yet.</div>
                @endforelse
            </div>
        </div>

        <!-- Favorite Workshops -->
        <div class="w-full max-w-6xl">
            <h2 class="text-xl font-bold mb-4 text-left">Favorite Workshops</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @forelse($favoriteWorkshops as $workshop)
                    <a href="{{ route('workshops.show', $workshop) }}" class="bg-white rounded-xl shadow p-4 flex flex-col items-start relative group transition hover:shadow-lg cursor-pointer">
                        <div class="w-full relative">
                            @if($workshop->video_thumbnail)
                                <img src="{{ $workshop->video_thumbnail }}" alt="{{ $workshop->title }}" class="w-full h-48 object-cover rounded mb-4">
                            @elseif($workshop->thumbnail_image)
                                <img src="{{ asset('storage/' . $workshop->thumbnail_image) }}" alt="{{ $workshop->title }}" class="w-full h-48 object-cover rounded mb-4">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded mb-4">
                                    <i class="fas fa-paint-brush text-4xl text-gray-400"></i>
                                </div>
                            @endif
                            <svg class="absolute top-3 right-3 h-7 w-7 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <div class="w-full text-left">
                            <h3 class="text-md font-semibold mb-1">{{ $workshop->title }}</h3>
                            <p class="text-gray-600 text-sm mb-1 line-clamp-2">{{ $workshop->description }}</p>
                            <div class="flex items-center text-xs text-gray-500 mb-1">
                                <span>{{ $workshop->date ? $workshop->date->format('M d, Y') : 'Added: ' . $workshop->created_at->format('M d, Y') }}</span>
                                <span class="ml-2 px-2 py-0.5 rounded-full {{ $workshop->skill_level == 'beginner' ? 'bg-green-100 text-green-800' : ($workshop->skill_level == 'intermediate' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') }}">
                                    {{ ucfirst($workshop->skill_level) }}
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center text-gray-500">No favorite workshops yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection 