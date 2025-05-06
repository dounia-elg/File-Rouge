@extends('layouts.app')

@section('title', 'ArtLover Space')

@section('content')
<div class="min-h-screen bg-cream py-10 font-poppins">
    <div class="container mx-auto px-4 flex flex-col items-center">
        <!-- Profile Card -->
        <div class="bg-white shadow rounded-lg px-10 py-8 w-full max-w-4xl mb-10 flex flex-col md:flex-row items-center md:items-start justify-between border border-sand">
            <div class="flex items-center w-full md:w-auto">
                <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('images/default-profile.jpg') }}" alt="Profile Image" class="w-24 h-24 rounded-full object-cover mr-6 border-4 border-sand">
                <div class="text-left">
                    <h1 class="text-2xl font-bold text-charcoal mb-1 font-playfair">{{ $user->name }}</h1>
                    @if($user->location)
                        <p class="text-coffee mb-1">{{ $user->location }}</p>
                    @endif
                    @if($user->bio)
                        <p class="text-coffee mb-1">{{ $user->bio }}</p>
                    @endif
                </div>
            </div>
            <div class="mt-6 md:mt-0 md:ml-8">
                <a href="{{ route('artlover.edit') }}" class="px-6 py-2 bg-rust text-cream rounded hover:bg-coffee transition font-medium">Edit Profile</a>
            </div>
        </div>

        

        <!-- Favorite Artworks -->
        <div class="w-full max-w-6xl mb-12">
            <h2 class="text-2xl font-bold mb-4 text-left font-playfair text-charcoal">Favorite Artworks</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @forelse($favoriteArtworks as $artwork)
                    <a href="{{ route('artworks.show', $artwork) }}" class="bg-white rounded-xl shadow-md p-4 flex flex-col items-start relative group transition hover:shadow-lg cursor-pointer border border-cream art-grid-item">
                        <div class="w-full relative">
                            <img src="{{ $artwork->image_path ? asset('storage/' . $artwork->image_path) : asset('images/default-artwork.jpg') }}" alt="{{ $artwork->title }}" class="w-full h-48 object-cover rounded mb-4">
                            <svg class="absolute top-3 right-3 h-7 w-7 text-rust" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                            </svg>
                        </div>
                        <div class="w-full text-left">
                            <h3 class="text-md font-semibold mb-1 font-playfair text-charcoal">{{ $artwork->title }}</h3>
                            <p class="text-coffee text-sm mb-1">by {{ $artwork->user->name ?? 'Unknown' }}</p>
                            <p class="text-rust font-bold text-base">${{ number_format($artwork->price, 0) }}</p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center text-coffee">No favorite artworks yet.</div>
                @endforelse
            </div>
        </div>

        <!-- Favorite Workshops -->
        <div class="w-full max-w-6xl">
            <h2 class="text-2xl font-bold mb-4 text-left font-playfair text-charcoal">Favorite Workshops</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @forelse($favoriteWorkshops as $workshop)
                    <a href="{{ route('workshops.show', $workshop) }}" class="bg-white rounded-xl shadow-md p-4 flex flex-col items-start relative group transition hover:shadow-lg cursor-pointer border border-cream art-grid-item">
                        <div class="w-full relative">
                            @if($workshop->video_thumbnail)
                                <img src="{{ $workshop->video_thumbnail }}" alt="{{ $workshop->title }}" class="w-full h-48 object-cover rounded mb-4">
                            @elseif($workshop->thumbnail_image)
                                <img src="{{ asset('storage/' . $workshop->thumbnail_image) }}" alt="{{ $workshop->title }}" class="w-full h-48 object-cover rounded mb-4">
                            @else
                                <div class="w-full h-48 bg-cream flex items-center justify-center rounded mb-4">
                                    <i class="fas fa-paint-brush text-4xl text-coffee"></i>
                                </div>
                            @endif
                            <svg class="absolute top-3 right-3 h-7 w-7 text-rust" fill="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <div class="w-full text-left">
                            <h3 class="text-md font-semibold mb-1 font-playfair text-charcoal">{{ $workshop->title }}</h3>
                            <p class="text-coffee text-sm mb-1 line-clamp-2">{{ $workshop->description }}</p>
                            <div class="flex items-center text-xs text-coffee mb-1">
                                <span>{{ $workshop->date ? $workshop->date->format('M d, Y') : 'Added: ' . $workshop->created_at->format('M d, Y') }}</span>
                                <span class="ml-2 px-2 py-0.5 rounded-full {{ $workshop->skill_level == 'beginner' ? 'bg-green-100 text-green-800' : ($workshop->skill_level == 'intermediate' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') }}">
                                    {{ ucfirst($workshop->skill_level) }}
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center text-coffee">No favorite workshops yet.</div>
                @endforelse
            </div>
        </div>

        <!-- Followed Artists -->
        <div class="w-full max-w-6xl mt-12">
            <h2 class="text-2xl font-bold mb-4 text-left font-playfair text-charcoal">Artists You Follow</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @forelse($followedArtists as $artist)
                    <div class="bg-white rounded-xl shadow-md p-4 flex flex-col items-center border border-cream art-grid-item">
                        <img src="{{ $artist->profile_image ? asset('storage/' . $artist->profile_image) : asset('images/default-profile.jpg') }}" alt="{{ $artist->name }}" class="w-20 h-20 rounded-full object-cover mb-3 border-4 border-sand">
                        <h3 class="text-lg font-semibold font-playfair text-charcoal mb-1">{{ $artist->name }}</h3>
                        @if($artist->location)
                            <p class="text-coffee text-sm mb-1">{{ $artist->location }}</p>
                        @endif
                        @if($artist->bio)
                            <p class="text-coffee text-xs mb-2 line-clamp-2 text-center">{{ $artist->bio }}</p>
                        @endif
                        <a href="{{ route('artist.profile', ['id' => $artist->id]) }}" class="mt-2 px-4 py-2 bg-rust text-cream rounded hover:bg-coffee transition text-sm">View Profile</a>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-coffee">You are not following any artists yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection 