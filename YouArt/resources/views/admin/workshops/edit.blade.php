@extends('admin.layouts.app')

@section('content')
<div class="p-4">
    <h1 class="text-2xl font-bold mb-6">Edit Workshop</h1>

    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('admin.workshops.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Back to Workshops
        </a>
    </div>


    <div class="bg-white p-6 rounded shadow">
        <form action="{{ route('admin.workshops.update', $workshop) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $workshop->title) }}"
                    class="w-full border border-gray-300 rounded p-2 focus:border-red-500 focus:ring focus:ring-red-200"
                    required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea name="description" id="description" rows="6"
                    class="w-full border border-gray-300 rounded p-2 focus:border-red-500 focus:ring focus:ring-red-200"
                    required>{{ old('description', $workshop->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="video_link" class="block text-gray-700 font-medium mb-2">Video Link</label>
                <input type="text" name="video_link" id="video_link" value="{{ old('video_link', $workshop->video_link) }}"
                    class="w-full border border-gray-300 rounded p-2 focus:border-red-500 focus:ring focus:ring-red-200"
                    required>
                <p class="text-gray-500 text-sm mt-1">Enter YouTube or Vimeo link for the workshop</p>
                @error('video_link')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="skill_level" class="block text-gray-700 font-medium mb-2">Skill Level</label>
                <select name="skill_level" id="skill_level"
                    class="w-full border border-gray-300 rounded p-2 focus:border-red-500 focus:ring focus:ring-red-200"
                    required>
                    <option value="beginner" {{ old('skill_level', $workshop->skill_level) == 'beginner' ? 'selected' : '' }}>Beginner</option>
                    <option value="intermediate" {{ old('skill_level', $workshop->skill_level) == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                    <option value="advanced" {{ old('skill_level', $workshop->skill_level) == 'advanced' ? 'selected' : '' }}>Advanced</option>
                </select>
                @error('skill_level')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
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
