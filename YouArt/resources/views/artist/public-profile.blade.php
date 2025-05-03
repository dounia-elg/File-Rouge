@extends('layouts.app')

@section('title', $artist->name . ' - Artist Profile')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="bg-white rounded-lg shadow p-8 flex flex-col md:flex-row items-center md:items-start mb-10">
        <img src="{{ $artist->profile_image ? asset('storage/' . $artist->profile_image) : asset('images/default-profile.jpg') }}" alt="{{ $artist->name }}" class="w-32 h-32 rounded-full object-cover mr-8 mb-4 md:mb-0">
        <div class="flex-1 text-left">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $artist->name }}</h1>
            @if($artist->location)
                <p class="text-gray-600 mb-1">{{ $artist->location }}</p>
            @endif
            @if($artist->bio)
                <p class="text-gray-600 mb-2">{{ $artist->bio }}</p>
            @endif
            @auth
                @if(Auth::id() !== $artist->id)
                    <form action="{{ Auth::user()->isFollowing($artist) ? route('artist.unfollow', $artist->id) : route('artist.follow', $artist->id) }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded text-white transition {{ Auth::user()->isFollowing($artist) ? 'bg-gray-400 hover:bg-gray-500' : 'bg-red-500 hover:bg-red-600' }}">
                            {{ Auth::user()->isFollowing($artist) ? 'Unfollow' : 'Follow' }}
                        </button>
                    </form>
                @endif
            @endauth
        </div>
    </div>

    <h2 class="text-xl font-bold mb-4">Artworks by {{ $artist->name }}</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @forelse($artworks as $artwork)
            <a href="{{ route('artworks.show', $artwork) }}" class="bg-white rounded shadow p-4 flex flex-col items-center hover:shadow-lg transition cursor-pointer">
                <img src="{{ $artwork->image_path ? asset('storage/' . $artwork->image_path) : asset('images/default-artwork.jpg') }}" alt="{{ $artwork->title }}" class="w-full h-48 object-cover rounded mb-4">
                <h3 class="text-md font-semibold mb-1">{{ $artwork->title }}</h3>
                <p class="text-gray-600 text-sm mb-1 line-clamp-2">{{ $artwork->description }}</p>
                <p class="text-red-600 font-bold text-base mb-1">${{ number_format($artwork->price, 0) }}</p>
            </a>
        @empty
            <div class="col-span-3 text-center text-gray-500">No artworks found for this artist.</div>
        @endforelse
    </div>
</div>
@endsection 