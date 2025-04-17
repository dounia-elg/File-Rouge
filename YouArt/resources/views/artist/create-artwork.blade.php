@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Add New Artwork</h1>
        
        <form action="{{ route('artworks.store') }}" method="POST" enctype="multipart/form-data">
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
                <label for="image" class="block mb-2 text-sm font-medium text-gray-700">Artwork Image</label>
                <input type="file" name="image" id="image" required 
                       class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                <p class="mt-1 text-xs text-gray-500">JPG, PNG or GIF. Max 5MB.</p>
            </div>
            
            <div class="mb-4">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600">
            </div>
            
            <div class="mb-4">
                <label for="category" class="block mb-2 text-sm font-medium text-gray-700">Category</label>
                <select name="category" id="category" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600">
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
            
            <div class="mb-4">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-700">Price ($)</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" min="0" step="0.01" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600">
            </div>
            
            <div class="mb-6">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600"
                          placeholder="Tell us about your artwork...">{{ old('description') }}</textarea>
            </div>
            
            <div class="flex justify-end space-x-4">
                <a href="{{ route('artist.space') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    Upload Artwork
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 