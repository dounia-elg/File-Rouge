@extends('layouts.app')

@section('title', $artist->name . ' - Artist Profile')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8 bg-cream">
    <div class="bg-sand rounded-lg shadow-md p-8 flex flex-col md:flex-row items-center md:items-start mb-10">
        <div class="w-36 h-36 rounded-full overflow-hidden border-4 border-cream shadow-md mr-8 mb-4 md:mb-0">
            <img src="{{ $artist->profile_image ? asset('storage/' . $artist->profile_image) : asset('images/default-profile.jpg') }}" 
                 alt="{{ $artist->name }}" 
                 class="w-full h-full object-cover">
        </div>
        <div class="flex-1 text-left">
            <h1 class="text-3xl font-bold text-rust serif mb-2">{{ $artist->name }}</h1>
            
            @if($artist->location)
                <p class="text-coffee mb-3 flex items-center">
                    <i class="fas fa-map-marker-alt mr-2 text-terracotta"></i>{{ $artist->location }}
                </p>
            @endif
            
            @if($artist->bio)
                <div class="mb-4 relative">
                    <div class="absolute -left-4 top-0 text-4xl text-terracotta opacity-20 serif">"</div>
                    <p class="text-charcoal pl-4 pr-4 italic">{{ $artist->bio }}</p>
                    <div class="absolute -right-2 bottom-0 text-4xl text-terracotta opacity-20 serif">"</div>
                </div>
            @endif
            
            @auth
                @if(Auth::id() !== $artist->id)
                    <form action="{{ Auth::user()->isFollowing($artist) ? route('artist.unfollow', $artist->id) : route('artist.follow', $artist->id) }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" 
                                class="px-5 py-2 rounded-full text-cream transition flex items-center {{ Auth::user()->isFollowing($artist) ? 'bg-coffee hover:bg-terracotta' : 'bg-rust hover:bg-coffee' }}">
                            <i class="fas {{ Auth::user()->isFollowing($artist) ? 'fa-user-minus' : 'fa-user-plus' }} mr-2"></i>
                            {{ Auth::user()->isFollowing($artist) ? 'Unfollow' : 'Follow' }}
                        </button>
                    </form>
                @endif
            @endauth
        </div>
    </div>

    <h2 class="text-2xl font-bold mb-6 text-coffee serif flex items-center">
        <i class="fas fa-palette mr-3"></i>Artworks by {{ $artist->name }}
    </h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @forelse($artworks as $artwork)
            <a href="{{ route('artworks.show', $artwork) }}" 
               class="bg-sand rounded-lg shadow-md p-4 flex flex-col hover:shadow-lg transition transform hover:-translate-y-1">
                <div class="overflow-hidden rounded-md mb-4 border-2 border-cream">
                    <img src="{{ $artwork->image_path ? asset('storage/' . $artwork->image_path) : asset('images/default-artwork.jpg') }}" 
                         alt="{{ $artwork->title }}" 
                         class="w-full h-48 object-cover hover:scale-105 transition duration-300">
                </div>
                <h3 class="text-lg font-semibold mb-1 text-charcoal">{{ $artwork->title }}</h3>
                <p class="text-coffee text-sm mb-2 line-clamp-2 italic">{{ $artwork->description }}</p>
                
                <div class="mt-auto flex justify-between items-center">
                    <p class="text-rust font-bold text-lg">${{ number_format($artwork->price, 0) }}</p>
                    <span class="text-coffee text-sm flex items-center">
                        <i class="fas fa-eye mr-1"></i> {{ $artwork->views ?? 0 }}
                    </span>
                </div>
            </a>
        @empty
            <div class="col-span-3 text-center py-12">
                <div class="w-20 h-20 mx-auto bg-sand rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-paint-brush text-terracotta text-2xl"></i>
                </div>
                <p class="text-coffee italic">No artworks found for this artist.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection 