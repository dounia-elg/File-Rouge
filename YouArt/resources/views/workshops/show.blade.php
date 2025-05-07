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
        border-bottom: 1px solid rgba(168, 119, 90, 0.2);
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }
    
    .workshop-detail:last-child {
        border-bottom: none;
    }
</style>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8 bg-cream">
    <div class="bg-sand rounded-lg shadow-md overflow-hidden mb-8">
        <!-- Video Player -->
        <div class="video-container bg-charcoal">
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
                <div class="absolute inset-0 flex items-center justify-center bg-charcoal">
                    <div class="text-center">
                        <p class="text-cream flex items-center"><i class="fas fa-video-slash mr-2"></i>No video available</p>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Workshop Information -->
        <div class="p-8">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-2xl font-bold mb-3 text-rust serif flex items-center">
                        <i class="fas fa-chalkboard-teacher mr-3"></i>{{ $workshop->title }}
                    </h1>
                    <div class="flex flex-wrap gap-2">
                        <span class="bg-terracotta bg-opacity-20 text-terracotta px-3 py-1 rounded-full text-sm flex items-center">
                            <i class="fas fa-user-graduate mr-2"></i>{{ ucfirst($workshop->skill_level) }}
                        </span>
                        @if($workshop->duration)
                        <span class="bg-rust bg-opacity-20 text-rust px-3 py-1 rounded-full text-sm flex items-center">
                            <i class="fas fa-clock mr-2"></i>{{ $workshop->duration }} minutes
                        </span>
                        @endif
                    </div>
                </div>
                
                @if($workshop->likes !== null)
                <div class="flex items-center">
                    <form action="{{ route('workshops.like', $workshop) }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center gap-1 text-coffee hover:text-rust transition">
                            <i class="fas fa-heart mr-1"></i>
                            <span>{{ $workshop->likes }}</span>
                        </button>
                    </form>
                </div>
                @endif
            </div>
            
            <div class="workshop-detail">
                <h2 class="text-lg font-medium mb-3 text-charcoal serif flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>About this workshop
                </h2>
                <p class="text-coffee">{{ $workshop->description }}</p>
            </div>
            
            <!-- Additional details if available -->
            @if($workshop->date)
            <div class="workshop-detail">
                <h2 class="text-lg font-medium mb-3 text-charcoal serif flex items-center">
                    <i class="fas fa-calendar-alt mr-2"></i>When
                </h2>
                <p class="text-coffee">{{ $workshop->date->format('F d, Y') }}</p>
            </div>
            @endif
            
            <div class="workshop-detail">
                <h2 class="text-lg font-medium mb-3 text-charcoal serif flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i>Added on
                </h2>
                <p class="text-coffee">{{ $workshop->created_at->format('F d, Y') }}</p>
            </div>
            
            <div class="workshop-detail">
                <h2 class="text-lg font-medium mb-3 text-charcoal serif flex items-center">
                    <i class="fas fa-star mr-2"></i>What you'll learn
                </h2>
                <ul class="list-disc pl-8 text-coffee">
                    <li class="mb-1">Learn the fundamental techniques of {{ strtolower($workshop->title) }}</li>
                    <li class="mb-1">Perfect for {{ $workshop->skill_level }} level students</li>
                    <li>Step-by-step guidance from start to finish</li>
                </ul>
            </div>
            
            <div class="flex justify-end mt-6">
                <a href="{{ route('workshops.index') }}" class="px-5 py-3 border border-coffee text-coffee rounded-md hover:bg-coffee hover:text-cream transition flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Workshops
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 