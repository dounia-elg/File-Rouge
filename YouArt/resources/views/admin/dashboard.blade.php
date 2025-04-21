@extends('admin.layouts.app')

@section('content')
<div class="p-4">
    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>
    
    <!-- Simple Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-medium text-gray-600">Total Users</h2>
            <p class="text-3xl font-bold text-red-600">{{ $userCount }}</p>
        </div>
        
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-medium text-gray-600">Total Artworks</h2>
            <p class="text-3xl font-bold text-green-600">{{ $artworkCount }}</p>
        </div>
        
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-medium text-gray-600">Total Workshops</h2>
            <p class="text-3xl font-bold text-purple-600">{{ $workshopCount }}</p>
        </div>
    </div>
    
    <!-- Recent Data -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Recent Users -->
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-medium mb-4">Recent Users</h2>
            
            @if($recentUsers->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-2 text-left">Name</th>
                                <th class="p-2 text-left">Email</th>
                                <th class="p-2 text-left">Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentUsers as $user)
                                <tr class="border-t">
                                    <td class="p-2">{{ $user->name }}</td>
                                    <td class="p-2">{{ $user->email }}</td>
                                    <td class="p-2">
                                        <span class="px-2 py-1 text-xs rounded 
                                            {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 
                                               ($user->role === 'artist' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500">No users found.</p>
            @endif
        </div>
        
        <!-- Recent Workshops -->
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-medium mb-4">Recent Workshops</h2>
            
            @if($recentWorkshops->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-2 text-left">Title</th>
                                <th class="p-2 text-left">Date</th>
                                <th class="p-2 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentWorkshops as $workshop)
                                <tr class="border-t">
                                    <td class="p-2">
                                        <a href="{{ route('admin.workshops.edit', $workshop) }}" class="text-blue-600 hover:underline">
                                            {{ $workshop->title }}
                                        </a>
                                    </td>
                                    <td class="p-2">{{ $workshop->date->format('M d, Y') }}</td>
                                    <td class="p-2">
                                        @if($workshop->is_active)
                                            <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Active</span>
                                        @else
                                            <span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500">No workshops found.</p>
            @endif
        </div>
    </div>
</div>
@endsection 