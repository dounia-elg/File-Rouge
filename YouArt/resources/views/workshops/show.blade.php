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
    
    .timeline {
        position: relative;
        height: 4px;
        background-color: #e5e7eb;
        cursor: pointer;
        border-radius: 2px;
    }
    
    .progress {
        position: absolute;
        height: 100%;
        background-color: #ef4444;
        border-radius: 2px;
    }
    
    .timeline-handle {
        position: absolute;
        width: 12px;
        height: 12px;
        background-color: #ef4444;
        border-radius: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        cursor: pointer;
    }
    
    .workshop-actions button {
        transition: all 0.2s;
    }
    
    .workshop-actions button:hover {
        transform: scale(1.1);
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
                <!-- Mock video player -->
                <div class="absolute inset-0 flex items-center justify-center bg-gray-900">
                    <div class="text-center">
                        <div class="text-red-500 text-5xl mb-4">
                            <i class="fas fa-paint-brush"></i>
                        </div>
                        <h3 class="text-white text-xl font-bold mb-2">{{ $workshop->title }}</h3>
                        <p class="text-gray-400 mb-4">Basic Portrait Drawing Workshop</p>
                        
                        <!-- Custom video player controls -->
                        <div class="max-w-lg mx-auto">
                            <div class="timeline mb-4">
                                <div class="progress" style="width: 35%;"></div>
                                <div class="timeline-handle" style="left: 35%;"></div>
                            </div>
                            
                            <div class="flex justify-center space-x-6 text-white text-2xl">
                                <button class="focus:outline-none"><i class="fas fa-step-backward"></i></button>
                                <button class="focus:outline-none"><i class="fas fa-play"></i></button>
                                <button class="focus:outline-none"><i class="fas fa-step-forward"></i></button>
                                <button class="focus:outline-none"><i class="fas fa-volume-up"></i></button>
                                <button class="focus:outline-none"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Video Information -->
        <div class="p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-2xl font-bold mb-2">{{ $workshop->title }}</h1>
                    <div class="flex text-gray-600 text-sm space-x-4">
                        <span><i class="fas fa-graduation-cap mr-1"></i> {{ ucfirst($workshop->skill_level) }}</span>
                        <span><i class="far fa-eye mr-1"></i> {{ $workshop->views }} views</span>
                    </div>
                </div>
                
                <div class="workshop-actions flex space-x-4">
                    <form action="{{ route('workshops.like', $workshop) }}" method="POST">
                        @csrf
                        <button type="submit" class="flex flex-col items-center text-gray-700 hover:text-red-500 focus:outline-none">
                            <i class="fas fa-heart text-xl mb-1"></i>
                            <span class="text-xs">{{ $workshop->likes }}</span>
                        </button>
                    </form>
                    
                    <button class="flex flex-col items-center text-gray-700 hover:text-blue-500 focus:outline-none">
                        <i class="fas fa-share-alt text-xl mb-1"></i>
                        <span class="text-xs">Share</span>
                    </button>
                    
                    <button class="flex flex-col items-center text-gray-700 hover:text-green-500 focus:outline-none">
                        <i class="fas fa-download text-xl mb-1"></i>
                        <span class="text-xs">Save</span>
                    </button>
                </div>
            </div>
            
            <div class="border-t border-b border-gray-200 py-4 mb-6">
                <p class="text-gray-800 whitespace-pre-line">{{ $workshop->description }}</p>
            </div>
            
            <!-- Workshop Content Sections -->
            <div class="space-y-4">
                <div class="flex items-center">
                    <div class="bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3">
                        <i class="fas fa-play"></i>
                    </div>
                    <div>
                        <h3 class="font-medium">Introduction to Portrait Drawing</h3>
                        <p class="text-sm text-gray-600">Understanding basic facial proportions</p>
                    </div>
                    <div class="ml-auto text-gray-600">0:00</div>
                </div>
                
                <div class="flex items-center">
                    <div class="bg-gray-300 text-gray-700 rounded-full w-8 h-8 flex items-center justify-center mr-3">
                        <span class="text-sm">2</span>
                    </div>
                    <div>
                        <h3 class="font-medium">Drawing the Basic Shape</h3>
                        <p class="text-sm text-gray-600">Creating the oval and guidelines</p>
                    </div>
                    <div class="ml-auto text-gray-600">5:22</div>
                </div>
                
                <div class="flex items-center">
                    <div class="bg-gray-300 text-gray-700 rounded-full w-8 h-8 flex items-center justify-center mr-3">
                        <span class="text-sm">3</span>
                    </div>
                    <div>
                        <h3 class="font-medium">Sketching the Eyes</h3>
                        <p class="text-sm text-gray-600">Creating depth and expression</p>
                    </div>
                    <div class="ml-auto text-gray-600">12:47</div>
                </div>
                
                <div class="flex items-center">
                    <div class="bg-gray-300 text-gray-700 rounded-full w-8 h-8 flex items-center justify-center mr-3">
                        <span class="text-sm">4</span>
                    </div>
                    <div>
                        <h3 class="font-medium">Sketching the Nose and Mouth</h3>
                        <p class="text-sm text-gray-600">Techniques for realistic features</p>
                    </div>
                    <div class="ml-auto text-gray-600">19:35</div>
                </div>
                
                <div class="flex items-center">
                    <div class="bg-gray-300 text-gray-700 rounded-full w-8 h-8 flex items-center justify-center mr-3">
                        <span class="text-sm">5</span>
                    </div>
                    <div>
                        <h3 class="font-medium">Shading Techniques</h3>
                        <p class="text-sm text-gray-600">Creating depth and dimension</p>
                    </div>
                    <div class="ml-auto text-gray-600">28:12</div>
                </div>
                
                <div class="flex items-center">
                    <div class="bg-gray-300 text-gray-700 rounded-full w-8 h-8 flex items-center justify-center mr-3">
                        <span class="text-sm">6</span>
                    </div>
                    <div>
                        <h3 class="font-medium">Final Touches</h3>
                        <p class="text-sm text-gray-600">Refining your portrait</p>
                    </div>
                    <div class="ml-auto text-gray-600">36:48</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Related Workshops -->
    <div class="mt-10">
        <h2 class="text-xl font-bold mb-4">Related Workshops</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @for($i = 0; $i < 4; $i++)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="relative pb-[56.25%]">
                        <div class="absolute top-0 left-0 w-full h-full bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-paint-brush text-4xl text-gray-400"></i>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-70 text-white p-2">
                            <div class="text-sm">24:15</div>
                        </div>
                    </div>
                    <div class="p-3">
                        <h3 class="font-medium mb-1">{{ ['Landscape Basics', 'Watercolor Techniques', 'Figure Drawing', 'Still Life Composition'][$i] }}</h3>
                        <p class="text-xs text-gray-600">{{rand(100, 999)}} views • {{rand(1, 12)}} days ago</p>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Simulate video functionality if needed
        const playButton = document.querySelector('.fa-play');
        if (playButton) {
            playButton.addEventListener('click', function() {
                this.classList.toggle('fa-play');
                this.classList.toggle('fa-pause');
            });
        }
    });
</script>
@endsection 