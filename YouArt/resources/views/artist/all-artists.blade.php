@extends('layouts.app')

@section('title', 'All Artists')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">All Artists</h1>
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
                <a href="#" class="mt-2 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">View Profile</a>
            </div>
        @empty
            <div class="col-span-3 text-center text-gray-500">No artists found.</div>
        @endforelse
    </div>
</div>
@endsection 