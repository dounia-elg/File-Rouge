@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Edit Artwork</h1>
        
        <form action="{{ route('artworks.update', $artwork->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
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
                <label for="image" class="block mb-2 text-sm font-medium text-gray-700">Artwork Image</label>
                <div class="flex items-center space-x-4 mb-2">
                    <img src="{{ asset('storage/' . $artwork->image_path) }}" alt="{{ $artwork->title }}" class="w-24 h-24 object-cover rounded-md">
                </div>
                <input type="file" name="image" id="image" 
                       class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                <p class="mt-1 text-xs text-gray-500">JPG, PNG or GIF. Max 5MB. Leave empty to keep the current image.</p>
            </div>
            
            <div class="mb-4">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $artwork->title) }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600">
            </div>
            
            <div class="mb-4">
                <label for="category" class="block mb-2 text-sm font-medium text-gray-700">Category</label>
                <select name="category" id="category" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600">
                    <option value="">Select Category</option>
                    <option value="Digital Illustration" {{ old('category', $artwork->category) == 'Digital Illustration' ? 'selected' : '' }}>Digital Illustration</option>
                    <option value="Character Design" {{ old('category', $artwork->category) == 'Character Design' ? 'selected' : '' }}>Character Design</option>
                    <option value="Concept Art" {{ old('category', $artwork->category) == 'Concept Art' ? 'selected' : '' }}>Concept Art</option>
                    <option value="Traditional Painting" {{ old('category', $artwork->category) == 'Traditional Painting' ? 'selected' : '' }}>Traditional Painting</option>
                    <option value="Photography" {{ old('category', $artwork->category) == 'Photography' ? 'selected' : '' }}>Photography</option>
                    <option value="Sculpture" {{ old('category', $artwork->category) == 'Sculpture' ? 'selected' : '' }}>Sculpture</option>
                    <option value="Mixed Media" {{ old('category', $artwork->category) == 'Mixed Media' ? 'selected' : '' }}>Mixed Media</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-700">Price ($)</label>
                <input type="number" name="price" id="price" value="{{ old('price', $artwork->price) }}" min="0" step="0.01" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600">
            </div>
            
            <div class="mb-4">
                <label for="dimensions" class="block mb-2 text-sm font-medium text-gray-700">Dimensions</label>
                <input type="text" name="dimensions" id="dimensions" value="{{ old('dimensions', $artwork->dimensions) }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600"
                       placeholder="e.g., 24 x 36 inches">
            </div>
            
            <div class="mb-4">
                <label for="is_sold" class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                <select name="is_sold" id="is_sold" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600">
                    <option value="0" {{ old('is_sold', $artwork->is_sold) == 0 ? 'selected' : '' }}>Available</option>
                    <option value="1" {{ old('is_sold', $artwork->is_sold) == 1 ? 'selected' : '' }}>Sold</option>
                </select>
            </div>
            
            <div class="mb-6">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600"
                          placeholder="Tell us about your artwork...">{{ old('description', $artwork->description) }}</textarea>
            </div>
            
            <div class="flex justify-between">
                <div>
                    <button type="button" class="px-4 py-2 bg-red-100 text-red-700 border border-red-300 rounded-md hover:bg-red-200" 
                            onclick="document.getElementById('delete-form').submit();">
                        Delete Artwork
                    </button>
                </div>
                
                <div class="flex space-x-4">
                    <a href="{{ route('artist.space') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
        
        <form id="delete-form" action="{{ route('artworks.destroy', $artwork->id) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
@endsection 