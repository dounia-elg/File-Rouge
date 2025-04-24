@extends('layouts.app')

@section('title', 'Edit Workshop')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Edit Workshop</h1>
        <a href="{{ route('admin.workshops.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Back to Workshops
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.workshops.update', $workshop) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $workshop->title) }}" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring focus:ring-red-200" 
                    required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea name="description" id="description" rows="6" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring focus:ring-red-200" 
                    required>{{ old('description', $workshop->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="video_link" class="block text-gray-700 font-medium mb-2">Video Link</label>
                <input type="text" name="video_link" id="video_link" value="{{ old('video_link', $workshop->video_link) }}" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring focus:ring-red-200" 
                    required>
                @error('video_link')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="thumbnail_image" class="block text-gray-700 font-medium mb-2">Thumbnail Image</label>
                @if ($workshop->thumbnail_image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $workshop->thumbnail_image) }}" alt="{{ $workshop->title }}" 
                            class="h-32 w-auto object-cover rounded">
                    </div>
                @endif
                <input type="file" name="thumbnail_image" id="thumbnail_image" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring focus:ring-red-200">
                <p class="text-gray-500 text-sm mt-1">Recommended size: 16:9 ratio, minimum 720px width</p>
                @error('thumbnail_image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="date" class="block text-gray-700 font-medium mb-2">Workshop Date</label>
                    <input type="datetime-local" name="date" id="date" 
                        value="{{ old('date', $workshop->date ? $workshop->date->format('Y-m-d\TH:i') : '') }}" 
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring focus:ring-red-200" 
                        required>
                    @error('date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="duration" class="block text-gray-700 font-medium mb-2">Duration (minutes)</label>
                    <input type="number" name="duration" id="duration" value="{{ old('duration', $workshop->duration) }}" 
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring focus:ring-red-200" 
                        min="1" required>
                    @error('duration')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="skill_level" class="block text-gray-700 font-medium mb-2">Skill Level</label>
                <select name="skill_level" id="skill_level" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring focus:ring-red-200" 
                    required>
                    <option value="beginner" {{ old('skill_level', $workshop->skill_level) == 'beginner' ? 'selected' : '' }}>Beginner</option>
                    <option value="intermediate" {{ old('skill_level', $workshop->skill_level) == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                    <option value="advanced" {{ old('skill_level', $workshop->skill_level) == 'advanced' ? 'selected' : '' }}>Advanced</option>
                </select>
                @error('skill_level')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col md:flex-row gap-4 mb-6">
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" 
                        class="rounded border-gray-300 text-red-500 focus:border-red-500 focus:ring focus:ring-red-200" 
                        {{ old('is_active', $workshop->is_active) ? 'checked' : '' }}>
                    <label for="is_active" class="ml-2 text-gray-700">Active (visible to users)</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_featured" id="is_featured" 
                        class="rounded border-gray-300 text-red-500 focus:border-red-500 focus:ring focus:ring-red-200" 
                        {{ old('is_featured', $workshop->is_featured) ? 'checked' : '' }}>
                    <label for="is_featured" class="ml-2 text-gray-700">Featured (shown on homepage)</label>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                    Update Workshop
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 