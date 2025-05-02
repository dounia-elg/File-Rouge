@extends('layouts.app')

@section('title', 'ArtLover Space')

@section('styles')
<style>
    .art-card {
        transition: transform 0.3s ease;
    }
    .art-card:hover {
        transform: translateY(-5px);
    }
    .workshop-card {
        transition: transform 0.3s ease;
    }
    .workshop-card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">Welcome to Your ArtLover Space</h1>
            <p class="mt-2 text-sm text-gray-600">Discover and explore amazing artworks and workshops</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Featured Workshops -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Featured Workshops</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($featuredWorkshops as $workshop)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden workshop-card">
                        <img src="{{ $workshop->thumbnail_image ? asset('storage/' . $workshop->thumbnail_image) : asset('images/default-workshop.jpg') }}" 
                             alt="{{ $workshop->title }}" 
                             class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $workshop->title }}</h3>
                            <p class="text-sm text-gray-600 mt-2">{{ Str::limit($workshop->description, 100) }}</p>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-sm text-gray-500">{{ $workshop->date ? $workshop->date->format('M d, Y') : 'Coming soon' }}</span>
                                <a href="{{ route('workshops.show', $workshop) }}" 
                                   class="text-red-500 hover:text-red-600 text-sm font-medium">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Featured Artworks -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Featured Artworks</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($featuredArtworks as $artwork)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden art-card">
                        <img src="{{ $artwork->image ? asset('storage/' . $artwork->image) : asset('images/default-artwork.jpg') }}" 
                             alt="{{ $artwork->title }}" 
                             class="w-full h-64 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $artwork->title }}</h3>
                            <p class="text-sm text-gray-600 mt-2">By {{ $artwork->artist->name }}</p>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-sm text-gray-500">{{ $artwork->created_at->format('M d, Y') }}</span>
                                <a href="{{ route('artworks.show', $artwork) }}" 
                                   class="text-red-500 hover:text-red-600 text-sm font-medium">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection 