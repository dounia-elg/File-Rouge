@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 bg-cream">
    <div class="max-w-6xl mx-auto">
        <!-- Breadcrumb -->
        <div class="mb-6">
            @if(Auth::user()->role === 'artist')
                <a href="{{ route('artist.space') }}" class="text-coffee hover:text-rust transition duration-300 flex items-center">
            @elseif(Auth::user()->role === 'art_lover')
                <a href="{{ route('artlover.space') }}" class="text-coffee hover:text-rust transition duration-300 flex items-center">
            @else
                <a href="{{ route('home') }}" class="text-coffee hover:text-rust transition duration-300 flex items-center">
            @endif
                <i class="fas fa-arrow-left mr-2"></i>
                Back to My Space
            </a>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col md:flex-row gap-12">
            <!-- Artwork Image - Left Side -->
            <div class="w-full md:w-1/2">
                <div class="bg-sand rounded-lg shadow-md overflow-hidden p-8 h-full">
                    <div class="relative w-full">
                        <img src="{{ asset('storage/' . $artwork->image_path) }}" alt="{{ $artwork->title }}" class="w-full h-auto object-contain mx-auto">
                        
                        <!-- Like Button (heart icon) -->
                        @auth
                        <button id="like-btn" data-artwork-id="{{ $artwork->id }}" class="absolute bottom-2 right-2 bg-sand bg-opacity-80 rounded-full p-2 focus:outline-none">
                            <svg id="like-heart" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 transition {{ $artwork->isLikedBy(Auth::user()) ? 'text-rust' : 'text-coffee text-opacity-40' }}" viewBox="0 0 24 24" stroke="currentColor" fill="{{ $artwork->isLikedBy(Auth::user()) ? 'currentColor' : 'none' }}">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Artwork Details - Right Side -->
            <div class="w-full md:w-1/2 pt-4">
                <!-- Artwork Title -->
                <h1 class="text-3xl font-bold text-charcoal serif mb-2">{{ $artwork->title }}</h1>
                
                <!-- Artist Info -->
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 rounded-full overflow-hidden mr-3">
                        <img src="{{ $artwork->user->profile_image ? asset('storage/' . $artwork->user->profile_image) : asset('images/default-profile.jpg') }}"
                             alt="{{ $artwork->user->name }}"
                             class="w-full h-full object-cover">
                    </div>
                    <div>
                        <p class="font-semibold text-charcoal">{{ $artwork->user->name }}</p>
                    </div>
                </div>
                
                <!-- Description -->
                <div class="mb-8">
                    <div class="flex items-start">
                        <i class="fas fa-quote-left text-terracotta mr-2 mt-1"></i>
                        <p class="text-coffee leading-relaxed">{{ $artwork->description }}</p>
                    </div>
                </div>
                
                <!-- Artwork Details Grid -->
                <div class="mb-8">
                    <div class="grid grid-cols-2 gap-x-16 gap-y-6">
                        <div>
                            <p class="text-coffee text-sm mb-1 flex items-center">
                                <i class="fas fa-calendar-alt text-terracotta mr-2"></i>Created
                            </p>
                            <p class="text-charcoal font-medium">{{ $artwork->created_at->format('F d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-coffee text-sm mb-1 flex items-center">
                                <i class="fas fa-paint-brush text-terracotta mr-2"></i>Medium
                            </p>
                            <p class="text-charcoal font-medium">{{ $artwork->medium }}</p>
                        </div>
                        <div>
                            <p class="text-coffee text-sm mb-1 flex items-center">
                                <i class="fas fa-ruler-combined text-terracotta mr-2"></i>Dimensions
                            </p>
                            <p class="text-charcoal font-medium">{{ $artwork->dimensions }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Price and Status -->
                <div class="mb-8">
                    <p class="text-coffee text-sm mb-1 flex items-center">
                        <i class="fas fa-dollar-sign text-terracotta mr-2"></i>Current Price
                    </p>
                    <div class="flex items-center justify-between">
                        <p class="text-3xl font-bold text-charcoal">${{ number_format($artwork->price, 0) }}</p>
                        @if($artwork->is_sold)
                            <span class="bg-rust bg-opacity-10 text-rust px-4 py-1 rounded-full text-sm flex items-center">
                                <i class="fas fa-tag mr-1"></i>Sold
                            </span>
                        @else
                            <span class="bg-coffee bg-opacity-10 text-coffee px-4 py-1 rounded-full text-sm flex items-center">
                                <i class="fas fa-shopping-cart mr-1"></i>Available
                            </span>
                        @endif
                    </div>
                </div>
                
                <!-- Action Buttons -->
                @auth
                    @if(!$artwork->is_sold && Auth::id() !== $artwork->user_id)
                        <div class="mb-4">
                            <a href="{{ route('payment.checkout', $artwork) }}" 
                               class="block w-full bg-rust text-cream py-3 rounded-md hover:bg-coffee transition text-center font-medium flex items-center justify-center">
                                <i class="fas fa-credit-card mr-2"></i>Buy Now
                            </a>
                        </div>
                    @endif
                    
                    <div class="flex space-x-3 mb-6">
                        @if($artwork->user_id == Auth::id())
                            <a href="{{ route('artworks.edit', $artwork->id) }}" 
                               class="block flex-1 border border-coffee text-coffee py-2 rounded-md hover:bg-coffee hover:text-cream transition text-center font-medium flex items-center justify-center">
                                <i class="fas fa-edit mr-2"></i>Edit Artwork
                            </a>
                        @elseif(!$artwork->is_sold && Auth::id() !== $artwork->user_id)
                            <button class="block flex-1 border border-coffee text-coffee py-2 rounded-md hover:bg-coffee hover:text-cream transition text-center font-medium flex items-center justify-center">
                                <i class="fas fa-envelope mr-2"></i>Contact Artist
                            </button>
                        @endif
                    </div>
                @endauth
                
                <div class="flex items-center text-coffee">
                    <i class="fas fa-heart text-terracotta mr-2"></i>
                    <span id="like-count" class="text-sm">{{ $artwork->likes()->count() }} likes</span>
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
            likeCount.textContent = data.likeCount + ' likes';
            if (data.liked) {
                likeHeart.setAttribute('fill', 'currentColor');
                likeHeart.classList.remove('text-coffee', 'text-opacity-40');
                likeHeart.classList.add('text-rust');
            } else {
                likeHeart.setAttribute('fill', 'none');
                likeHeart.classList.remove('text-rust');
                likeHeart.classList.add('text-coffee', 'text-opacity-40');
            }
        });
    });
});
</script>
@endauth
@endsection
