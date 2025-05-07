@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container mx-auto px-4 py-8 bg-cream">
    <div class="max-w-md mx-auto bg-sand rounded-lg shadow-md p-8">
        <h1 class="text-2xl font-bold mb-8 text-rust serif flex items-center">
            <i class="fas fa-user-edit mr-3"></i>Edit Profile
        </h1>
        
        <form action="{{ route('artlover.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            @if ($errors->any())
                <div class="bg-rust bg-opacity-10 border-l-4 border-rust text-rust p-4 mb-6 rounded">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span class="font-medium">Please fix the following errors:</span>
                    </div>
                    <ul class="list-disc pl-10">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="mb-5">
                <label for="name" class="block mb-2 text-coffee font-medium flex items-center">
                    <i class="fas fa-user mr-2"></i>Name
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                       class="w-full px-3 py-3 border border-terracotta border-opacity-30 rounded-md focus:outline-none focus:ring focus:ring-rust focus:ring-opacity-30 bg-cream">
            </div>
            
            <div class="mb-5">
                <label for="profile_image" class="block mb-2 text-coffee font-medium flex items-center">
                    <i class="fas fa-user-circle mr-2"></i>Profile Image
                </label>
                <div class="flex items-center space-x-4 mb-3">
                    @if($user->profile_image)
                        <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-cream shadow-md">
                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="w-full h-full object-cover">
                        </div>
                    @endif
                </div>
                <input type="file" name="profile_image" id="profile_image" 
                       class="block w-full text-charcoal border border-terracotta border-opacity-30 rounded-lg cursor-pointer bg-cream p-2 focus:outline-none focus:border-rust">
                <p class="mt-1 text-xs text-coffee italic flex items-center">
                    <i class="fas fa-info-circle mr-1"></i> JPG, PNG or GIF. Max 2MB.
                </p>
            </div>
            
            <div class="mb-5">
                <label for="location" class="block mb-2 text-coffee font-medium flex items-center">
                    <i class="fas fa-map-marker-alt mr-2"></i>Location
                </label>
                <input type="text" name="location" id="location" value="{{ old('location', $user->location) }}" 
                       class="w-full px-3 py-3 border border-terracotta border-opacity-30 rounded-md focus:outline-none focus:ring focus:ring-rust focus:ring-opacity-30 bg-cream">
            </div>
            
            <div class="mb-6">
                <label for="bio" class="block mb-2 text-coffee font-medium flex items-center">
                    <i class="fas fa-quote-left mr-2"></i>Bio
                </label>
                <textarea name="bio" id="bio" rows="3" 
                          class="w-full px-3 py-3 border border-terracotta border-opacity-30 rounded-md focus:outline-none focus:ring focus:ring-rust focus:ring-opacity-30 bg-cream"
                          placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
                <p class="mt-1 text-xs text-coffee italic flex items-center">
                    <i class="fas fa-info-circle mr-1"></i> Max 200 characters
                </p>
            </div>
            
            <div class="flex justify-end space-x-4">
                <a href="{{ route('artlover.space') }}" class="px-5 py-3 border border-coffee text-coffee rounded-md hover:bg-coffee hover:text-cream transition flex items-center">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
                <button type="submit" class="px-5 py-3 bg-rust text-cream rounded-md hover:bg-coffee transition flex items-center">
                    <i class="fas fa-save mr-2"></i>Save
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 