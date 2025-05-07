@extends('layouts.app')

@section('title', 'Art Workshops')

@section('content')
<div class="container mx-auto px-4 py-8 bg-cream">
    <h1 class="text-3xl font-bold mb-8 text-center text-rust serif flex justify-center items-center">
        <i class="fas fa-chalkboard-teacher mr-3"></i>Art Workshops
    </h1>
    <form method="GET" action="{{ route('workshops.index') }}" class="mb-8 flex justify-center">
        <div class="relative w-full max-w-md">
            <input type="text" name="q" value="{{ isset($query) ? $query : '' }}" placeholder="Search workshops by title..." 
            placeholder="Search artists by name..." 
            class="w-full px-4 py-3 pr-10 border border-terracotta border-opacity-30 rounded-md focus:outline-none focus:ring focus:ring-rust focus:ring-opacity-30 bg-sand">
     <button type="submit" class="absolute right-3 top-3 text-coffee hover:text-rust transition">
         <i class="fas fa-search"></i>
     </button>
        </div>
    </form>

    @if($workshops->isEmpty())
        <div class="text-center py-12 bg-sand rounded-lg shadow-md">
            <div class="w-20 h-20 mx-auto bg-cream rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-video-slash text-terracotta text-2xl"></i>
            </div>
            <p class="text-coffee text-lg">No workshops available at the moment.</p>
            <p class="mt-2 text-coffee italic">Please check back later for new content!</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($workshops as $workshop)
                <div class="bg-sand rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow transform hover:-translate-y-1">
                    <div class="relative">
                        @if($workshop->video_thumbnail)
                            <img src="{{ $workshop->video_thumbnail }}" alt="{{ $workshop->title }}" class="w-full h-48 object-cover">
                        @elseif($workshop->thumbnail_image)
                            <img src="{{ asset('storage/' . $workshop->thumbnail_image) }}" alt="{{ $workshop->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-cream flex items-center justify-center">
                                <i class="fas fa-paint-brush text-4xl text-terracotta"></i>
                            </div>
                        @endif

                        <div class="absolute top-2 right-2 bg-charcoal bg-opacity-70 text-cream px-2 py-1 text-sm rounded-full flex items-center">
                            <i class="fas fa-clock mr-1"></i>{{ $workshop->formatted_duration }}
                        </div>
                        @auth
                        <!-- Like button removed from here -->
                        @endauth
                    </div>

                    <div class="p-5">
                        <h3 class="text-xl font-bold mb-2 text-charcoal serif">{{ $workshop->title }}</h3>
                        <p class="text-coffee mb-4 line-clamp-2">{{ $workshop->description }}</p>

                        <div class="flex justify-between items-center text-sm text-coffee mb-4">
                            <span class="flex items-center"><i class="fas fa-calendar-alt mr-2"></i>{{ $workshop->date ? $workshop->date->format('M d, Y') : 'Added: ' . $workshop->created_at->format('M d, Y') }}</span>
                        </div>

                        <div class="flex justify-between items-center mb-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $workshop->skill_level == 'beginner' ? 'bg-terracotta bg-opacity-20 text-terracotta' :
                                ($workshop->skill_level == 'intermediate' ? 'bg-rust bg-opacity-20 text-rust' : 'bg-coffee bg-opacity-20 text-coffee') }}">
                                <i class="fas fa-user-graduate mr-1"></i>{{ ucfirst($workshop->skill_level) }}
                            </span>
                            @auth
                            <div class="flex items-center space-x-1">
                                <button class="workshop-like-btn focus:outline-none" data-id="{{ $workshop->id }}">
                                    <svg id="workshop-heart-{{ $workshop->id }}" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 transition {{ $workshop->isLikedBy(Auth::user()) ? 'text-rust' : 'text-coffee text-opacity-40' }}" viewBox="0 0 24 24" stroke="currentColor" fill="{{ $workshop->isLikedBy(Auth::user()) ? 'currentColor' : 'none' }}">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                                <span id="workshop-like-count-{{ $workshop->id }}" class="text-coffee text-sm">{{ $workshop->likes()->count() }}</span>
                            </div>
                            @endauth
                        </div>
                        <div class="flex justify-end items-center">
                            <a href="{{ route('workshops.show', $workshop) }}" class="bg-rust text-cream hover:bg-coffee px-4 py-2 rounded transition-colors flex items-center">
                                <i class="fas fa-play-circle mr-2"></i>Watch Now
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
                    heart.classList.remove('text-coffee', 'text-opacity-40');
                    heart.classList.add('text-rust');
                } else {
                    heart.setAttribute('fill', 'none');
                    heart.classList.remove('text-rust');
                    heart.classList.add('text-coffee', 'text-opacity-40');
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
