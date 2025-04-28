@extends('admin.layouts.app')

@section('content')
<div class="p-4">
    <h1 class="text-2xl font-bold mb-6">Workshop Management</h1>
    
    <div class="flex justify-between items-center mb-6">
        <div></div>
        <a href="{{ route('admin.workshops.create') }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
            Add New Workshop
        </a>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            {{ session('error') }}
        </div>
    @endif
    
    <div class="bg-white p-4 rounded shadow">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 text-left">ID</th>
                    <th class="p-2 text-left">Title</th>
                    <th class="p-2 text-left">Date</th>
                    <th class="p-2 text-left">Level</th>
                    <th class="p-2 text-left">Status</th>
                    <th class="p-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($workshops as $workshop)
                <tr class="border-t">
                    <td class="p-2">{{ $workshop->id }}</td>
                    <td class="p-2">{{ $workshop->title }}</td>
                    <td class="p-2">{{ $workshop->date ? $workshop->date->format('d/m/Y') : 'N/A' }}</td>
                    <td class="p-2">
                        <span class="px-2 py-1 text-xs rounded 
                            {{ $workshop->skill_level == 'beginner' ? 'bg-green-100 text-green-800' : 
                               ($workshop->skill_level == 'intermediate' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') }}">
                            {{ ucfirst($workshop->skill_level) }}
                        </span>
                    </td>
                    <td class="p-2">
                        <span class="px-2 py-1 text-xs rounded 
                            {{ $workshop->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $workshop->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="p-2 flex space-x-2">
                        <a href="{{ route('admin.workshops.edit', $workshop) }}" 
                           class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs">
                            Edit
                        </a>
                        
                        <form action="{{ route('admin.workshops.destroy', $workshop) }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this workshop?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-2 text-center text-gray-500">No workshops found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $workshops->links() }}
    </div>
</div>
@endsection 