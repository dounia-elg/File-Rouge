@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <div class="mb-6">
            @if(Auth::user()->role === 'artist')
                <a href="{{ route('artist.space') }}" class="text-coffee hover:text-rust transition duration-300 flex items-center">
            @elseif(Auth::user()->role === 'art_lover')
                <a href="{{ route('artlover.space') }}" class="text-coffee hover:text-rust transition duration-300 flex items-center">
            @else
                <a href="{{ route('home') }}" class="text-coffee hover:text-rust transition duration-300 flex items-center">
            @endif
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to My Space
            </a>
        </div>

        <div class="bg-sand rounded-lg shadow-md overflow-hidden">
            <div class="md:flex">
                <!-- Artwork Image -->
                <div class="md:w-1/2 p-6">
                    <img src="{{ asset('storage/' . $artwork->image_path) }}" alt="{{ $artwork->title }}" class="w-full h-auto object-cover rounded-lg shadow-lg">
                </div>

                <!-- Artwork Details -->
                <div class="md:w-1/2 p-6">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex items-center space-x-4">
                            <h1 class="text-3xl font-bold text-charcoal">{{ $artwork->title }}</h1>
                            <span class="text-coffee bg-cream/50 px-3 py-1 rounded-full text-sm">{{ $artwork->category }}</span>
                        </div>

                        @if($artwork->user_id == Auth::id())
                            <a href="{{ route('artworks.edit', $artwork->id) }}" class="bg-rust text-cream px-4 py-2 rounded hover:bg-coffee transition duration-300">
                                Edit Artwork
                            </a>
                        @endif
                    </div>

                    <div class="mb-6">
                        <p class="text-3xl font-bold text-rust mb-4">${{ number_format($artwork->price, 2) }}</p>

                        <div class="flex items-center space-x-4 mb-4">
                            <div>
                                @if($artwork->is_sold)
                                    <span class="bg-rust/10 text-rust px-3 py-1 rounded-full text-sm">Sold</span>
                                @else
                                    <span class="bg-coffee/10 text-coffee px-3 py-1 rounded-full text-sm">Available</span>
                                @endif
                            </div>
                        </div>

                        @auth
                        <div class="flex items-center space-x-2">
                            <button id="like-btn" data-artwork-id="{{ $artwork->id }}" class="focus:outline-none">
                                <svg id="like-heart" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 transition" viewBox="0 0 24 24" stroke="currentColor" fill="{{ $artwork->isLikedBy(Auth::user()) ? 'currentColor' : 'none' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                            <span id="like-count" class="text-coffee">{{ $artwork->likes()->count() }}</span>
                        </div>
                        @endauth
                    </div>

                    <!-- Artwork Details Grid -->
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-charcoal mb-4">Artwork Details</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-cream/50 p-3 rounded-lg">
                                <p class="text-sm text-coffee mb-1">Category</p>
                                <p class="text-charcoal font-medium">{{ $artwork->category }}</p>
                            </div>
                            <div class="bg-cream/50 p-3 rounded-lg">
                                <p class="text-sm text-coffee mb-1">Medium</p>
                                <p class="text-charcoal font-medium">{{ $artwork->medium }}</p>
                            </div>
                            <div class="bg-cream/50 p-3 rounded-lg">
                                <p class="text-sm text-coffee mb-1">Dimensions</p>
                                <p class="text-charcoal font-medium">{{ $artwork->dimensions }}</p>
                            </div>
                            <div class="bg-cream/50 p-3 rounded-lg">
                                <p class="text-sm text-coffee mb-1">Year Created</p>
                                <p class="text-charcoal font-medium">{{ $artwork->year }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-charcoal mb-4">About This Artwork</h2>
                        <div class="bg-cream/50 p-4 rounded-lg">
                            <p class="text-charcoal leading-relaxed">{{ $artwork->description }}</p>
                        </div>
                    </div>

                    <!-- Artist Info -->
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-charcoal mb-4">Artist Information</h2>
                        <div class="bg-cream/50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <img src="{{ $artwork->user->profile_image ? asset('storage/' . $artwork->user->profile_image) : asset('images/default-profile.jpg') }}"
                                     alt="{{ $artwork->user->name }}"
                                     class="w-12 h-12 rounded-full mr-4 object-cover">
                                <div>
                                    <p class="font-bold text-charcoal">{{ $artwork->user->name }}</p>
                                    <p class="text-coffee">{{ $artwork->user->position ?? 'Digital Artist' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(!$artwork->is_sold && $artwork->user_id != Auth::id())
                        <div class="mt-8">
                            <button class="w-full bg-rust text-cream py-3 rounded-lg font-medium hover:bg-coffee transition duration-300">
                                Contact Artist
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@auth
<script>
document.addEventListener('DOMContentLoaded', function() {
    const likeBtn = document.getElementById('like-btn');
    const likeHeart = document.getElementById('like-heart');
    const likeCount = document.getElementById('like-count');

    likeBtn.addEventListener('click', function(e) {
        e.preventDefault();
        fetch(`/artworks/${likeBtn.dataset.artworkId}/toggle-like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            likeCount.textContent = data.likeCount;
            if (data.liked) {
                likeHeart.setAttribute('fill', 'currentColor');
                likeHeart.classList.remove('text-coffee');
                likeHeart.classList.add('text-rust');
            } else {
                likeHeart.setAttribute('fill', 'none');
                likeHeart.classList.remove('text-rust');
                likeHeart.classList.add('text-coffee');
            }
        });
    });
});
</script>
@endauth
@endsection
