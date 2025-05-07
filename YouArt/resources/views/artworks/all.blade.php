@extends('layouts.app')

@section('title', 'All Artworks')

@section('content')
<div class="container mx-auto px-4 py-8 bg-cream">
    <h1 class="text-3xl font-bold mb-8 text-center text-rust serif flex justify-center items-center">
        <i class="fas fa-palette mr-3"></i>Discover Artworks
    </h1>
    
    <form method="GET" action="{{ route('artworks.all') }}" class="mb-8 flex justify-center">
        <div class="relative w-full max-w-md">
            <input type="text" 
                   name="q" 
                   value="{{ isset($query) ? $query : '' }}" 
                   placeholder="Search artworks by title..." 
                   class="w-full px-4 py-3 pr-10 border border-terracotta border-opacity-30 rounded-md focus:outline-none focus:ring focus:ring-rust focus:ring-opacity-30 bg-sand">
            <button type="submit" class="absolute right-3 top-3 text-coffee hover:text-rust transition">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @forelse($artworks as $artwork)
            <a href="{{ route('artworks.show', $artwork) }}" 
               class="bg-sand rounded-lg shadow-md p-5 flex flex-col hover:shadow-lg transition transform hover:-translate-y-1">
                <div class="overflow-hidden rounded-md mb-4 border-2 border-cream">
                    <img src="{{ $artwork->image_path ? asset('storage/' . $artwork->image_path) : asset('images/default-artwork.jpg') }}" 
                         alt="{{ $artwork->title }}" 
                         class="w-full h-48 object-cover hover:scale-105 transition duration-300">
                </div>
                <h2 class="text-lg font-semibold mb-1 text-charcoal serif">{{ $artwork->title }}</h2>
                <p class="text-coffee text-sm mb-1 flex items-center">
                    <i class="fas fa-user-circle mr-1"></i>By {{ $artwork->user->name ?? 'Unknown' }}
                </p>
                
                <div class="mt-auto flex justify-between items-center pt-3">
                    <p class="text-rust font-bold text-lg">${{ number_format($artwork->price, 0) }}</p>
                    <p class="text-coffee text-xs flex items-center">
                        <i class="fas fa-calendar-alt mr-1"></i>{{ $artwork->created_at->format('M d, Y') }}
                    </p>
                </div>
            </a>
        @empty
            <div class="col-span-3 text-center py-12 bg-sand rounded-lg shadow-md">
                <div class="w-20 h-20 mx-auto bg-cream rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-palette text-terracotta text-2xl"></i>
                </div>
                <p class="text-coffee text-lg">No artworks found matching your search criteria.</p>
                <p class="mt-2 text-coffee italic">Try searching with different keywords.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
