@extends('layouts.app')

@section('title', 'Art Workshops')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Art Workshops</h1>
    
    @if($workshops->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-600 text-lg">No workshops available at the moment.</p>
            <p class="mt-2">Please check back later for new content!</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($workshops as $workshop)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="relative">
                        @if($workshop->video_thumbnail)
                            <img src="{{ $workshop->video_thumbnail }}" alt="{{ $workshop->title }}" class="w-full h-48 object-cover">
                        @elseif($workshop->thumbnail_image)
                            <img src="{{ asset('storage/' . $workshop->thumbnail_image) }}" alt="{{ $workshop->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-paint-brush text-4xl text-gray-400"></i>
                            </div>
                        @endif
                        
                        <div class="absolute top-2 right-2 bg-black bg-opacity-70 text-white px-2 py-1 text-sm rounded">
                            {{ $workshop->formatted_duration }}
                        </div>
                        @auth
                        <!-- Like button removed from here -->
                        @endauth
                    </div>
                    
                    <div class="p-4">
                        <h3 class="text-xl font-bold mb-2">{{ $workshop->title }}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ $workshop->description }}</p>
                        
                        <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
                            <span>{{ $workshop->date ? $workshop->date->format('M d, Y') : 'Added: ' . $workshop->created_at->format('M d, Y') }}</span>
                            
                        </div>
                        
                        <div class="flex justify-between items-center mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $workshop->skill_level == 'beginner' ? 'bg-green-100 text-green-800' : 
                                ($workshop->skill_level == 'intermediate' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') }}">
                                {{ ucfirst($workshop->skill_level) }}
                            </span>
                            @auth
                            <div class="flex items-center space-x-1">
                                <button class="workshop-like-btn focus:outline-none" data-id="{{ $workshop->id }}">
                                    <svg id="workshop-heart-{{ $workshop->id }}" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 transition {{ $workshop->isLikedBy(Auth::user()) ? 'text-red-500' : 'text-gray-400' }}" viewBox="0 0 24 24" stroke="currentColor" fill="{{ $workshop->isLikedBy(Auth::user()) ? 'currentColor' : 'none' }}">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                                <span id="workshop-like-count-{{ $workshop->id }}" class="text-gray-600 text-sm">{{ $workshop->likes()->count() }}</span>
                            </div>
                            @endauth
                        </div>
                        <div class="flex justify-end items-center">
                            <a href="{{ route('workshops.show', $workshop) }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition-colors">
                                Watch Now
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-8 flex justify-center">
            {{ $workshops->links() }}
        </div>
    @endif
</div>
@endsection

@section('scripts')
@auth
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.workshop-like-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const id = btn.getAttribute('data-id');
            const heart = document.getElementById('workshop-heart-' + id);
            const likeCountSpan = document.getElementById('workshop-like-count-' + id);
            fetch(`/workshops/${id}/toggle-like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.liked) {
                    heart.setAttribute('fill', 'currentColor');
                    heart.classList.remove('text-gray-400');
                    heart.classList.add('text-red-500');
                } else {
                    heart.setAttribute('fill', 'none');
                    heart.classList.remove('text-red-500');
                    heart.classList.add('text-gray-400');
                }
                if (likeCountSpan) {
                    likeCountSpan.textContent = data.likeCount;
                }
            });
        });
    });
});
</script>
@endauth
@endsection 