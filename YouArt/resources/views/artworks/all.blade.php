@extends('layouts.app')

@section('title', 'All Artworks')

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold mb-8 text-center">All Artworks</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @forelse($artworks as $artwork)
            <a href="{{ route('artworks.show', $artwork) }}" class="bg-white rounded shadow p-4 flex flex-col items-center hover:shadow-lg transition cursor-pointer">
                <img src="{{ $artwork->image_path ? asset('storage/' . $artwork->image_path) : asset('images/default-artwork.jpg') }}" alt="{{ $artwork->title }}" class="w-full h-48 object-cover rounded mb-4">
                <h2 class="text-lg font-semibold mb-1">{{ $artwork->title }}</h2>
                <p class="text-gray-600 text-sm mb-1">By {{ $artwork->user->name ?? 'Unknown' }}</p>
                <p class="text-gray-400 text-xs">{{ $artwork->created_at->format('M d, Y') }}</p>
            </a>
        @empty
            <div class="col-span-3 text-center text-gray-500">No artworks found.</div>
        @endforelse
    </div>
</div>
@endsection 