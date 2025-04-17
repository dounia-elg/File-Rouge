@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Edit Profile</h1>
        
        <form action="{{ route('artist.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
                    <ul class="list-disc pl-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="mb-6">
                <label for="profile_image" class="block mb-2 text-sm font-medium text-gray-700">Profile Image</label>
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('images/default-profile.jpg') }}" 
                             alt="{{ $user->name }}" 
                             class="w-24 h-24 rounded-full object-cover">
                    </div>
                    <div class="flex-grow">
                        <input type="file" name="profile_image" id="profile_image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                        <p class="mt-1 text-xs text-gray-500">JPG, PNG or GIF. Max 2MB.</p>
                    </div>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600">
            </div>
            
            
            
            <div class="mb-4">
                <label for="location" class="block mb-2 text-sm font-medium text-gray-700">Location</label>
                <input type="text" name="location" id="location" value="{{ old('location', $user->location) }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600"
                       placeholder="e.g. Paris, France">
            </div>
            
            <div class="mb-6">
                <label for="bio" class="block mb-2 text-sm font-medium text-gray-700">Bio</label>
                <textarea name="bio" id="bio" rows="4" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600"
                          placeholder="Tell us about yourself and your art...">{{ old('bio', $user->bio) }}</textarea>
                <p class="mt-1 text-xs text-gray-500">Max 1000 characters</p>
            </div>
            
            <div class="flex justify-end space-x-4">
                <a href="{{ route('artist.space') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 