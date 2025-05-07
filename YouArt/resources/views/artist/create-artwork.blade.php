@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 bg-cream">
    <div class="max-w-2xl mx-auto bg-sand rounded-lg shadow-md p-8">
        <h1 class="text-3xl font-bold mb-8 text-rust serif flex items-center">
            <i class="fas fa-plus-circle mr-3"></i>Add New Artwork
        </h1>
        
        <form action="{{ route('artworks.store') }}" method="POST" enctype="multipart/form-data">
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
                <label for="image" class="block mb-2 text-coffee font-medium flex items-center">
                    <i class="fas fa-image mr-2"></i>Artwork Image
                </label>
                <input type="file" name="image" id="image" required 
                       class="block w-full text-charcoal border border-terracotta border-opacity-30 rounded-lg cursor-pointer bg-cream p-2 focus:outline-none focus:border-rust">
                <p class="mt-1 text-xs text-coffee italic flex items-center">
                    <i class="fas fa-info-circle mr-1"></i> JPG, PNG or GIF. Max 5MB.
                </p>
            </div>
            
            <div class="mb-5">
                <label for="title" class="block mb-2 text-coffee font-medium flex items-center">
                    <i class="fas fa-heading mr-2"></i>Title
                </label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                       class="w-full px-3 py-3 border border-terracotta border-opacity-30 rounded-md focus:outline-none focus:ring focus:ring-rust focus:ring-opacity-30 bg-cream">
            </div>
            
            <div class="mb-5">
                <label for="category" class="block mb-2 text-coffee font-medium flex items-center">
                    <i class="fas fa-tag mr-2"></i>Category
                </label>
                <select name="category" id="category" required
                        class="w-full px-3 py-3 border border-terracotta border-opacity-30 rounded-md focus:outline-none focus:ring focus:ring-rust focus:ring-opacity-30 bg-cream">
                    <option value="">Select Category</option>
                    <option value="Digital Illustration" {{ old('category') == 'Digital Illustration' ? 'selected' : '' }}>Digital Illustration</option>
                    <option value="Character Design" {{ old('category') == 'Character Design' ? 'selected' : '' }}>Character Design</option>
                    <option value="Concept Art" {{ old('category') == 'Concept Art' ? 'selected' : '' }}>Concept Art</option>
                    <option value="Traditional Painting" {{ old('category') == 'Traditional Painting' ? 'selected' : '' }}>Traditional Painting</option>
                    <option value="Photography" {{ old('category') == 'Photography' ? 'selected' : '' }}>Photography</option>
                    <option value="Sculpture" {{ old('category') == 'Sculpture' ? 'selected' : '' }}>Sculpture</option>
                    <option value="Mixed Media" {{ old('category') == 'Mixed Media' ? 'selected' : '' }}>Mixed Media</option>
                </select>
            </div>
            
            <div class="mb-5">
                <label for="price" class="block mb-2 text-coffee font-medium flex items-center">
                    <i class="fas fa-dollar-sign mr-2"></i>Price ($)
                </label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" min="0" step="0.01" required
                       class="w-full px-3 py-3 border border-terracotta border-opacity-30 rounded-md focus:outline-none focus:ring focus:ring-rust focus:ring-opacity-30 bg-cream">
            </div>
            
            <div class="mb-5">
                <label for="dimensions" class="block mb-2 text-coffee font-medium flex items-center">
                    <i class="fas fa-ruler-combined mr-2"></i>Dimensions
                </label>
                <input type="text" name="dimensions" id="dimensions" value="{{ old('dimensions') }}" required
                       class="w-full px-3 py-3 border border-terracotta border-opacity-30 rounded-md focus:outline-none focus:ring focus:ring-rust focus:ring-opacity-30 bg-cream"
                       placeholder="e.g., 24 x 36 inches">
            </div>
            
            <div class="mb-6">
                <label for="description" class="block mb-2 text-coffee font-medium flex items-center">
                    <i class="fas fa-align-left mr-2"></i>Description
                </label>
                <textarea name="description" id="description" rows="4" 
                          class="w-full px-3 py-3 border border-terracotta border-opacity-30 rounded-md focus:outline-none focus:ring focus:ring-rust focus:ring-opacity-30 bg-cream"
                          placeholder="Tell us about your artwork...">{{ old('description') }}</textarea>
            </div>
            
            <div class="flex justify-end space-x-4">
                <a href="{{ route('artist.space') }}" class="px-5 py-3 border border-coffee text-coffee rounded-md hover:bg-coffee hover:text-cream transition flex items-center">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
                <button type="submit" class="px-5 py-3 bg-rust text-cream rounded-md hover:bg-coffee transition flex items-center">
                    <i class="fas fa-cloud-upload-alt mr-2"></i>Upload Artwork
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 