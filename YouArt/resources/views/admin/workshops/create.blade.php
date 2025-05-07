@extends('admin.layouts.app')

@section('content')
<div class="p-6 bg-cream">
    <h1 class="text-3xl font-bold mb-8 text-rust serif">
        <i class="fas fa-plus-circle mr-3"></i>Add New Workshop
    </h1>
    
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('admin.workshops.index') }}" class="bg-coffee hover:bg-terracotta text-cream px-4 py-2 rounded-md transition flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to Workshops
        </a>
    </div>

    <div class="bg-sand p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.workshops.store') }}" method="POST">
            @csrf

            <div class="mb-5">
                <label for="title" class="block text-coffee font-medium mb-2">
                    <i class="fas fa-heading mr-2"></i>Title
                </label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                    class="w-full border border-terracotta border-opacity-30 rounded-md p-3 focus:border-rust focus:ring focus:ring-rust focus:ring-opacity-20 bg-cream" 
                    required>
                @error('title')
                    <p class="text-rust text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="description" class="block text-coffee font-medium mb-2">
                    <i class="fas fa-align-left mr-2"></i>Description
                </label>
                <textarea name="description" id="description" rows="6" 
                    class="w-full border border-terracotta border-opacity-30 rounded-md p-3 focus:border-rust focus:ring focus:ring-rust focus:ring-opacity-20 bg-cream" 
                    required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-rust text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="video_link" class="block text-coffee font-medium mb-2">
                    <i class="fas fa-video mr-2"></i>Video Link
                </label>
                <input type="text" name="video_link" id="video_link" value="{{ old('video_link') }}" 
                    class="w-full border border-terracotta border-opacity-30 rounded-md p-3 focus:border-rust focus:ring focus:ring-rust focus:ring-opacity-20 bg-cream" 
                    required>
                <p class="text-charcoal text-sm mt-1 italic flex items-center">
                    <i class="fas fa-info-circle mr-1"></i> Enter YouTube or Vimeo link for the workshop
                </p>
                @error('video_link')
                    <p class="text-rust text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="skill_level" class="block text-coffee font-medium mb-2">
                    <i class="fas fa-graduation-cap mr-2"></i>Skill Level
                </label>
                <select name="skill_level" id="skill_level" 
                    class="w-full border border-terracotta border-opacity-30 rounded-md p-3 focus:border-rust focus:ring focus:ring-rust focus:ring-opacity-20 bg-cream" 
                    required>
                    <option value="beginner" {{ old('skill_level') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                    <option value="intermediate" {{ old('skill_level') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                    <option value="advanced" {{ old('skill_level') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                </select>
                @error('skill_level')
                    <p class="text-rust text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-rust hover:bg-coffee text-cream px-5 py-2 rounded-md transition flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i> Create Workshop
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 