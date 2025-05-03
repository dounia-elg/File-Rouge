@extends('layouts.app')

@section('title', 'All Artists')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">All Artists</h1>
    <form method="GET" action="{{ route('artists.all') }}" class="mb-8 flex justify-center">
        <input type="text" name="q" value="{{ isset($query) ? $query : '' }}" placeholder="Search artists by name..." class="px-4 py-2 border border-gray-300 rounded-l focus:outline-none focus:ring-2 focus:ring-red-400 w-64">
        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-r hover:bg-red-600 transition">Search</button>
    </form>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @forelse($artists as $artist)
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center hover:shadow-lg transition">
                <img src="{{ $artist->profile_image ? asset('storage/' . $artist->profile_image) : asset('images/default-profile.jpg') }}" alt="{{ $artist->name }}" class="w-24 h-24 rounded-full object-cover mb-4">
                <h2 class="text-lg font-semibold mb-1">{{ $artist->name }}</h2>
                @if($artist->location)
                    <p class="text-gray-600 text-sm mb-1">{{ $artist->location }}</p>
                @endif
                @if($artist->bio)
                    <p class="text-gray-500 text-xs mb-2 line-clamp-2">{{ $artist->bio }}</p>
                @endif
                <div class="flex space-x-2 mt-2">
                    <a href="{{ route('artist.profile', ['id' => $artist->id]) }}" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">View Profile</a>
                    @auth
                        @if(Auth::id() !== $artist->id)
                            <form action="{{ Auth::user()->isFollowing($artist) ? route('artist.unfollow', $artist->id) : route('artist.follow', $artist->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 rounded text-white transition {{ Auth::user()->isFollowing($artist) ? 'bg-gray-400 hover:bg-gray-500' : 'bg-blue-500 hover:bg-blue-600' }}">
                                    {{ Auth::user()->isFollowing($artist) ? 'Unfollow' : 'Follow' }}
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center text-gray-500">No artists found.</div>
        @endforelse
    </div>
</div>
@endsection 