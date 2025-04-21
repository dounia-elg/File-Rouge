@extends('admin.layouts.app')

@section('content')
<h1 class="text-3xl font-semibold text-gray-800">Dashboard</h1>

<div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-4">
    <div class="p-6 bg-white rounded-md shadow">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-3xl font-semibold text-gray-700">{{ $stats['users'] }}</h3>
                <p class="text-gray-600">Total Users</p>
            </div>
            <div class="p-3 bg-red-100 rounded-full">
                <svg class="w-6 h-6 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="p-6 bg-white rounded-md shadow">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-3xl font-semibold text-gray-700">{{ $stats['artworks'] }}</h3>
                <p class="text-gray-600">Total Artworks</p>
            </div>
            <div class="p-3 bg-green-100 rounded-full">
                <svg class="w-6 h-6 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="p-6 bg-white rounded-md shadow">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-3xl font-semibold text-gray-700">{{ $stats['workshops'] }}</h3>
                <p class="text-gray-600">Total Workshops</p>
            </div>
            <div class="p-3 bg-blue-100 rounded-full">
                <svg class="w-6 h-6 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="p-6 bg-white rounded-md shadow">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-3xl font-semibold text-gray-700">{{ $stats['registrations'] }}</h3>
                <p class="text-gray-600">Workshop Registrations</p>
            </div>
            <div class="p-3 bg-yellow-100 rounded-full">
                <svg class="w-6 h-6 text-yellow-600" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z" />
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 gap-6 mt-8 lg:grid-cols-2">
    <div class="p-6 bg-white rounded-md shadow">
        <h2 class="text-xl font-semibold text-gray-800">Recent Workshops</h2>
        <div class="mt-4">
            @if($recentWorkshops->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left">
                                <th class="px-4 py-2 text-gray-600">Title</th>
                                <th class="px-4 py-2 text-gray-600">Date</th>
                                <th class="px-4 py-2 text-gray-600">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentWorkshops as $workshop)
                                <tr>
                                    <td class="px-4 py-2 border-t">
                                        <a href="{{ route('admin.workshops.edit', $workshop) }}" class="text-blue-600 hover:underline">
                                            {{ $workshop->title }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-2 border-t">{{ $workshop->date->format('M d, Y') }}</td>
                                    <td class="px-4 py-2 border-t">
                                        @if($workshop->is_active)
                                            <span class="px-2 py-1 text-xs text-green-800 bg-green-100 rounded-full">Active</span>
                                        @else
                                            <span class="px-2 py-1 text-xs text-red-800 bg-red-100 rounded-full">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-600">No workshops found.</p>
            @endif
        </div>
    </div>

    <div class="p-6 bg-white rounded-md shadow">
        <h2 class="text-xl font-semibold text-gray-800">Recent Users</h2>
        <div class="mt-4">
            @if($recentUsers->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left">
                                <th class="px-4 py-2 text-gray-600">Name</th>
                                <th class="px-4 py-2 text-gray-600">Email</th>
                                <th class="px-4 py-2 text-gray-600">Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentUsers as $user)
                                <tr>
                                    <td class="px-4 py-2 border-t">{{ $user->name }}</td>
                                    <td class="px-4 py-2 border-t">{{ $user->email }}</td>
                                    <td class="px-4 py-2 border-t">
                                        <span class="px-2 py-1 text-xs {{ $user->role === 'admin' ? 'text-purple-800 bg-purple-100' : 'text-blue-800 bg-blue-100' }} rounded-full">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-600">No users found.</p>
            @endif
        </div>
    </div>
</div>
@endsection 