@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 bg-cream">
    <div class="max-w-2xl mx-auto bg-sand rounded-lg shadow-md p-8">
        <h1 class="text-3xl font-bold mb-8 text-rust serif flex items-center">
            <i class="fas fa-user-edit mr-3"></i>Edit Profile
        </h1>
        
        <form action="{{ route('artist.update') }}" method="POST" enctype="multipart/form-data">
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
            
            <div class="mb-6">
                <label for="profile_image" class="block mb-2 text-coffee font-medium flex items-center">
                    <i class="fas fa-user-circle mr-2"></i>Profile Image
                </label>
                <div class="flex items-center space-x-6">
                    <div class="flex-shrink-0">
                        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-cream shadow-md">
                            <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('images/default-profile.jpg') }}" 
                                alt="{{ $user->name }}" 
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="flex-grow">
                        <input type="file" name="profile_image" id="profile_image" 
                               class="block w-full text-charcoal border border-terracotta border-opacity-30 rounded-lg cursor-pointer bg-cream p-2 focus:outline-none focus:border-rust">
                        <p class="mt-2 text-xs text-coffee italic flex items-center">
                            <i class="fas fa-info-circle mr-1"></i> JPG, PNG or GIF. Max 2MB.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="mb-5">
                <label for="name" class="block mb-2 text-coffee font-medium flex items-center">
                    <i class="fas fa-user mr-2"></i>Name
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                       class="w-full px-3 py-3 border border-terracotta border-opacity-30 rounded-md focus:outline-none focus:ring focus:ring-rust focus:ring-opacity-30 bg-cream">
            </div>
            
            <div class="mb-5">
                <label for="location" class="block mb-2 text-coffee font-medium flex items-center">
                    <i class="fas fa-map-marker-alt mr-2"></i>Location
                </label>
                <input type="text" name="location" id="location" value="{{ old('location', $user->location) }}" 
                       class="w-full px-3 py-3 border border-terracotta border-opacity-30 rounded-md focus:outline-none focus:ring focus:ring-rust focus:ring-opacity-30 bg-cream"
                       placeholder="e.g. Safi, Morocco">
            </div>
            
            <div class="mb-6">
                <label for="bio" class="block mb-2 text-coffee font-medium flex items-center">
                    <i class="fas fa-quote-left mr-2"></i>Bio
                </label>
                <textarea name="bio" id="bio" rows="4" 
                          class="w-full px-3 py-3 border border-terracotta border-opacity-30 rounded-md focus:outline-none focus:ring focus:ring-rust focus:ring-opacity-30 bg-cream"
                          placeholder="Tell us about yourself and your art...">{{ old('bio', $user->bio) }}</textarea>
                <p class="mt-2 text-xs text-coffee italic flex items-center">
                    <i class="fas fa-info-circle mr-1"></i> Max 1000 characters
                </p>
            </div>
            
            <div class="flex justify-end space-x-4">
                <a href="{{ route('artist.space') }}" class="px-5 py-3 border border-coffee text-coffee rounded-md hover:bg-coffee hover:text-cream transition flex items-center">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
                <button type="submit" class="px-5 py-3 bg-rust text-cream rounded-md hover:bg-coffee transition flex items-center">
                    <i class="fas fa-save mr-2"></i>Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 