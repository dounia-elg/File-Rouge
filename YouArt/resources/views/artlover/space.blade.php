@extends('layouts.app')

@section('title', 'ArtLover Space')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="bg-white shadow rounded-lg p-10 text-center w-full max-w-md">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        <div class="flex flex-col items-center mb-6">
            <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default-profile.jpg') }}" alt="Profile Image" class="w-24 h-24 rounded-full object-cover mb-2">
            <h1 class="text-3xl font-bold text-gray-900 mb-1">{{ Auth::user()->name }}</h1>
            @if(Auth::user()->location)
                <p class="text-gray-600 mb-1">{{ Auth::user()->location }}</p>
            @endif
        </div>
        @if(Auth::user()->bio)
            <div class="mb-6">
                <p class="text-gray-700 italic">{{ Auth::user()->bio }}</p>
            </div>
        @endif
        <a href="{{ route('artlover.edit') }}" class="inline-block px-6 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition" id="edit-profile-btn">Edit Profile</a>
    </div>
</div>
@endsection 