@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <a href="{{ route('artist.space') }}" class="text-gray-600 hover:text-red-600">
                <span class="inline-block mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                </span>
                Back to My Space
            </a>
        </div>
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="md:flex">
                <!-- Artwork Image -->
                <div class="md:w-1/2">
                    <img src="{{ asset('storage/' . $artwork->image_path) }}" alt="{{ $artwork->title }}" class="w-full h-auto object-cover">
                </div>
                
                <!-- Artwork Details -->
                <div class="md:w-1/2 p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-2xl font-bold">{{ $artwork->title }}</h1>
                            <p class="text-gray-600">{{ $artwork->category }}</p>
                        </div>
                        
                        @if($artwork->user_id == Auth::id())
                            <a href="{{ route('artworks.edit', $artwork->id) }}" class="bg-red-600 text-white px-4 py-2 rounded-full text-sm hover:bg-red-700">
                                Edit Artwork
                            </a>
                        @endif
                    </div>
                    
                    <div class="mt-4">
                        <p class="text-3xl font-bold text-red-600">${{ number_format($artwork->price, 2) }}</p>
                        <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                {{ $artwork->likes }} likes
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                {{ $artwork->views }} views
                            </div>
                            <div>
                                @if($artwork->is_sold)
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">Sold</span>
                                @else
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">Available</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <h2 class="text-lg font-semibold mb-2">Details</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Category</p>
                                <p class="text-gray-700">{{ $artwork->category }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Dimensions</p>
                                <p class="text-gray-700">{{ $artwork->dimensions }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <h2 class="text-lg font-semibold mb-2">Description</h2>
                        <p class="text-gray-700">{{ $artwork->description }}</p>
                    </div>
                    
                    <div class="mt-6">
                        <h2 class="text-lg font-semibold mb-2">Artist</h2>
                        <div class="flex items-center">
                            <img src="{{ $artwork->user->profile_image ? asset('storage/' . $artwork->user->profile_image) : asset('images/default-profile.jpg') }}" 
                                 alt="{{ $artwork->user->name }}" 
                                 class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <p class="font-medium">{{ $artwork->user->name }}</p>
                                <p class="text-sm text-gray-600">{{ $artwork->user->position ?? 'Digital Artist' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    @if(!$artwork->is_sold && $artwork->user_id != Auth::id())
                        <div class="mt-8">
                            <button class="w-full bg-red-600 text-white py-3 rounded-lg font-medium hover:bg-red-700">
                                Contact Artist
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 