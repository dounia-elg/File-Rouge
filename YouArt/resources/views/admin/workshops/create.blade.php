@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-semibold text-gray-800">Add New Workshop</h1>
    <a href="{{ route('admin.workshops.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
        Back to Workshops
    </a>
</div>

<div class="bg-white shadow overflow-hidden rounded-lg p-6">
    <form action="{{ route('admin.workshops.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div class="col-span-2">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50">
            </div>
            
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="date" id="date" value="{{ old('date') }}" required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50">
            </div>
            
            <div>
                <label for="duration" class="block text-sm font-medium text-gray-700">Duration</label>
                <input type="text" name="duration" id="duration" value="{{ old('duration') }}" required placeholder="e.g., 2 hours" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50">
            </div>
            
            <div>
                <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50">
            </div>
            
            <div>
                <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50">
            </div>
            
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" name="location" id="location" value="{{ old('location') }}" required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50">
            </div>
            
            <div>
                <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
                <input type="number" name="capacity" id="capacity" value="{{ old('capacity', 20) }}" required min="1" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50">
            </div>
            
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                <input type="number" name="price" id="price" value="{{ old('price', 0) }}" required min="0" step="0.01" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50">
            </div>
            
            <div>
                <label for="video_link" class="block text-sm font-medium text-gray-700">Video Link (optional)</label>
                <input type="url" name="video_link" id="video_link" value="{{ old('video_link') }}" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50">
            </div>
            
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Workshop Image</label>
                <input type="file" name="image" id="image" required 
                       class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                <p class="mt-1 text-xs text-gray-500">JPG, PNG or GIF. Max 5MB.</p>
            </div>
            
            <div class="flex items-center mt-4">
                <input type="checkbox" name="is_active" id="is_active" checked 
                       class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                <label for="is_active" class="ml-2 block text-sm text-gray-900">Active</label>
            </div>
            
            <div class="col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" required 
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50">{{ old('description') }}</textarea>
            </div>
        </div>
        
        <div class="mt-6">
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                Create Workshop
            </button>
        </div>
    </form>
</div>
@endsection 