@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Artist Profile Header -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
        <div class="relative h-64 bg-cover bg-center" style="background-image: url('{{ asset('images/heroArtist.jpg') }}');">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        </div>
        <div class="relative -mt-16 px-6 pt-0 pb-6">
            <div class="flex flex-col md:flex-row items-start md:items-end">
                <div class="ml-4 mb-4">
                    <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('images/default-profile.jpg') }}" 
                         alt="{{ $user->name }}" 
                         class="w-24 h-24 rounded-full border-4 border-white shadow-md">
                </div>
                <div class="ml-4 flex-grow">
                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                            <p class="text-gray-600">{{ $user->position ?? 'Digital Artist & Illustrator' }}</p>
                            
                            <div class="flex items-center mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="ml-1 text-sm text-gray-600">{{ $user->location ?? 'Morocco' }}</span>
                            </div>
                            
                            <div class="flex items-center mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span class="ml-1 text-sm text-gray-600">{{ $user->followers ?? 0 }} followers</span>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <a href="{{ route('artist.edit') }}" class="bg-red-600 text-white px-4 py-2 rounded-full text-sm hover:bg-red-700">Edit Profile</a>
                        </div>
                    </div>
                    
                    <div class="mt-4 pr-4">
                        <p class="text-gray-700">{{ $user->bio ?? 'Creating vibrant digital illustrations and concept art. Specialized in character design and fantasy landscapes. Available for commissions and collaborations.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- My Artworks Section -->
    <div class="mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">My Artworks</h2>
            <a href="{{ route('artworks.create') }}" class="bg-red-600 text-white px-4 py-2 rounded-full text-sm hover:bg-red-700">+ Add Artwork</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if(count($artworks) > 0)
                @foreach($artworks as $artwork)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $artwork->image_path) }}" alt="{{ $artwork->title }}" class="w-full h-48 object-cover">
                            <div class="absolute top-2 right-2 bg-white bg-opacity-80 rounded-full p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold">{{ $artwork->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $artwork->category }}</p>
                            <div class="mt-2 flex justify-between items-center">
                                <span class="font-bold text-red-600">${{ number_format($artwork->price, 2) }}</span>
                                <div class="flex items-center text-sm text-gray-500">
                                    <div class="flex items-center mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                        {{ $artwork->likes }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        {{ $artwork->views }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-3 bg-gray-50 border border-gray-200 rounded-lg p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <h4 class="mt-2 text-lg font-medium text-gray-900">No artworks yet</h4>
                    <p class="mt-1 text-gray-500">Add your first artwork to showcase your talent</p>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Performance Statistics -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-6">Performance Statistics</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="flex items-center">
                <div class="mr-4 bg-pink-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Artworks</p>
                    <p class="text-xl font-bold">{{ count($artworks) }}</p>
                </div>
            </div>
            
            <div class="flex items-center">
                <div class="mr-4 bg-purple-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Sold Artworks</p>
                    <p class="text-xl font-bold">{{ $artworks->where('is_sold', true)->count() }}</p>
                </div>
            </div>
            
            <div class="flex items-center">
                <div class="mr-4 bg-blue-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Views</p>
                    <p class="text-xl font-bold">{{ $artworks->sum('views') }}</p>
                </div>
            </div>
            
            <div class="flex items-center">
                <div class="mr-4 bg-green-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Earnings</p>
                    <p class="text-xl font-bold">${{ number_format($artworks->where('is_sold', true)->sum('price'), 2) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 