@extends('layouts.app')

@section('title', 'All Artists')

@section('content')
<div class="container mx-auto px-4 py-8 bg-cream">
    <h1 class="text-3xl font-bold mb-8 text-center text-rust serif flex justify-center items-center">
        <i class="fas fa-users mr-3"></i>Discover Artists
    </h1>
    
    <form method="GET" action="{{ route('artists.all') }}" class="mb-8 flex justify-center">
        <div class="relative w-full max-w-md">
            <input type="text" 
                   name="q" 
                   value="{{ isset($query) ? $query : '' }}" 
                   placeholder="Search artists by name..." 
                   class="w-full px-4 py-3 pr-10 border border-terracotta border-opacity-30 rounded-md focus:outline-none focus:ring focus:ring-rust focus:ring-opacity-30 bg-sand">
            <button type="submit" class="absolute right-3 top-3 text-coffee hover:text-rust transition">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @forelse($artists as $artist)
            <div class="bg-sand rounded-xl shadow-md p-6 flex flex-col items-center hover:shadow-lg transition transform hover:-translate-y-1">
                <div class="w-28 h-28 rounded-full overflow-hidden border-4 border-cream shadow-md mb-4">
                    <img src="{{ $artist->profile_image ? asset('storage/' . $artist->profile_image) : asset('images/default-profile.jpg') }}" 
                         alt="{{ $artist->name }}" 
                         class="w-full h-full object-cover">
                </div>
                <h2 class="text-xl font-semibold mb-1 text-charcoal serif">{{ $artist->name }}</h2>
                
                @if($artist->location)
                    <p class="text-coffee text-sm mb-1 flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-terracotta"></i>{{ $artist->location }}
                    </p>
                @endif
                
                @if($artist->bio)
                    <p class="text-coffee text-sm mb-4 line-clamp-2 text-center italic">{{ $artist->bio }}</p>
                @endif
                
                <div class="flex space-x-2 mt-2">
                    <a href="{{ route('artist.profile', ['id' => $artist->id]) }}" 
                       class="px-4 py-2 bg-rust text-cream rounded-full hover:bg-coffee transition flex items-center">
                        <i class="fas fa-user mr-2"></i>View Profile
                    </a>
                    
                    @auth
                        @if(Auth::id() !== $artist->id)
                            <form action="{{ Auth::user()->isFollowing($artist) ? route('artist.unfollow', $artist->id) : route('artist.follow', $artist->id) }}" method="POST">
                                @csrf
                                <button type="submit" 
                                        class="px-4 py-2 rounded-full text-cream transition flex items-center {{ Auth::user()->isFollowing($artist) ? 'bg-coffee hover:bg-terracotta' : 'bg-terracotta hover:bg-coffee' }}">
                                    <i class="fas {{ Auth::user()->isFollowing($artist) ? 'fa-user-minus' : 'fa-user-plus' }} mr-2"></i>
                                    {{ Auth::user()->isFollowing($artist) ? 'Unfollow' : 'Follow' }}
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12">
                <div class="w-20 h-20 mx-auto bg-sand rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-user-slash text-terracotta text-2xl"></i>
                </div>
                <p class="text-coffee italic">No artists found matching your search criteria.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
