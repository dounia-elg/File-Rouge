@extends('layouts.app')

@section('title', 'Drawing Workshops')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">Drawing Workshops</h1>
    
    @if($workshops->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-600 text-lg">No workshops available at the moment.</p>
            <p class="mt-2">Please check back later for new content!</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($workshops as $workshop)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="relative pb-[56.25%]"> <!-- 16:9 aspect ratio -->
                        <div class="absolute top-0 left-0 w-full h-full bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-paint-brush text-4xl text-gray-400"></i>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-70 text-white p-2">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <i class="fas fa-eye mr-1"></i>
                                    <span>{{ $workshop->views }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-heart mr-1"></i>
                                    <span>{{ $workshop->likes }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <h3 class="text-xl font-bold mb-2">{{ $workshop->title }}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ $workshop->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $workshop->skill_level == 'beginner' ? 'bg-green-100 text-green-800' : 
                                  ($workshop->skill_level == 'intermediate' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') }}">
                                {{ ucfirst($workshop->skill_level) }}
                            </span>
                            <a href="{{ route('workshops.show', $workshop) }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-full transition-colors">
                                Watch Now
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $workshops->links() }}
        </div>
    @endif
</div>
@endsection 