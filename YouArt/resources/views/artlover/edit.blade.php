@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="bg-white shadow rounded-lg p-10 w-full max-w-md">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Profile</h1>
        <form action="{{ route('artlover.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4 text-left">
                <label class="block text-gray-700 mb-2">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4 text-left">
                <label class="block text-gray-700 mb-2">Profile Image</label>
                @if($user->profile_image)
                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="mb-2 w-20 h-20 rounded-full object-cover">
                @endif
                <input type="file" name="profile_image" class="w-full">
            </div>
            <div class="mb-4 text-left">
                <label class="block text-gray-700 mb-2">Location</label>
                <input type="text" name="location" value="{{ old('location', $user->location) }}" class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4 text-left">
                <label class="block text-gray-700 mb-2">Bio</label>
                <textarea name="bio" rows="3" class="w-full border rounded px-3 py-2">{{ old('bio', $user->bio) }}</textarea>
            </div>
            <button type="submit" class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600 transition">Save</button>
        </form>
    </div>
</div>
@endsection 