@extends('layouts.app')

@section('title', $workshop->title)

@section('styles')
<style>
    .video-container {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 aspect ratio */
        height: 0;
        overflow: hidden;
    }
    
    .video-container iframe,
    .video-container video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }
    
    .workshop-detail {
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }
    
    .workshop-detail:last-child {
        border-bottom: none;
    }
</style>
@endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Video Player -->
        <div class="video-container bg-black">
            @if($workshop->video_link)
                <!-- If YouTube video -->
                @if(Str::contains($workshop->video_link, ['youtube.com', 'youtu.be']))
                    <iframe 
                        src="{{ Str::contains($workshop->video_link, 'embed') ? $workshop->video_link : 'https://www.youtube.com/embed/' . Str::afterLast($workshop->video_link, '/') }}" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                <!-- If Vimeo video -->
                @elseif(Str::contains($workshop->video_link, 'vimeo.com'))
                    <iframe 
                        src="https://player.vimeo.com/video/{{ Str::afterLast($workshop->video_link, '/') }}" 
                        frameborder="0" 
                        allow="autoplay; fullscreen; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                <!-- If self-hosted video -->
                @else
                    <video id="workshop-video" controls>
                        <source src="{{ asset($workshop->video_link) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
            @else
                <div class="absolute inset-0 flex items-center justify-center bg-gray-900">
                    <div class="text-center">
                        <p class="text-white">No video available</p>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Workshop Information -->
        <div class="p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h1 class="text-2xl font-bold mb-2">{{ $workshop->title }}</h1>
                    <div class="flex flex-wrap gap-2">
                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm">
                            {{ ucfirst($workshop->skill_level) }}
                        </span>
                        @if($workshop->duration)
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">
                            {{ $workshop->duration }} minutes
                        </span>
                        @endif
                    </div>
                </div>
                
                @if($workshop->likes !== null)
                <div class="flex items-center">
                    <form action="{{ route('workshops.like', $workshop) }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center gap-1 hover:text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                            </svg>
                            <span>{{ $workshop->likes }}</span>
                        </button>
                    </form>
                </div>
                @endif
            </div>
            
            <div class="workshop-detail">
                <h2 class="text-lg font-medium mb-2">About this workshop</h2>
                <p class="text-gray-800">{{ $workshop->description }}</p>
            </div>
            
            <!-- Additional details if available -->
            @if($workshop->date)
            <div class="workshop-detail">
                <h2 class="text-lg font-medium mb-2">When</h2>
                <p class="text-gray-800">{{ $workshop->date->format('F d, Y') }}</p>
            </div>
            @endif
            
            <div class="workshop-detail">
                <h2 class="text-lg font-medium mb-2">Added on</h2>
                <p class="text-gray-800">{{ $workshop->created_at->format('F d, Y') }}</p>
            </div>
            
            <div class="workshop-detail">
                <h2 class="text-lg font-medium mb-2">What you'll learn</h2>
                <ul class="list-disc pl-5 text-gray-800">
                    <li>Learn the fundamental techniques of {{ strtolower($workshop->title) }}</li>
                    <li>Perfect for {{ $workshop->skill_level }} level students</li>
                    <li>Step-by-step guidance from start to finish</li>
                </ul>
            </div>
            
            <div class="flex justify-end mt-6">
                <a href="{{ route('workshops.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Back to Workshops
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 