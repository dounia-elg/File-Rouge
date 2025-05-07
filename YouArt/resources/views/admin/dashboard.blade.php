@extends('admin.layouts.app')

@section('content')
<div class="p-6 bg-cream">
    <h1 class="text-3xl font-bold mb-8 text-rust serif">
        <i class="fas fa-tachometer-alt mr-3"></i>Admin Dashboard
    </h1>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-sand p-6 rounded-lg shadow-md transition hover:shadow-lg">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-lg font-medium text-coffee">Total Users</h2>
                <i class="fas fa-users text-2xl text-rust opacity-50"></i>
            </div>
            <p class="text-4xl font-bold text-rust serif">{{ $userCount }}</p>
        </div>
        
        <div class="bg-sand p-6 rounded-lg shadow-md transition hover:shadow-lg">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-lg font-medium text-coffee">Total Artworks</h2>
                <i class="fas fa-image text-2xl text-terracotta opacity-50"></i>
            </div>
            <p class="text-4xl font-bold text-terracotta serif">{{ $artworkCount }}</p>
        </div>
        
        <div class="bg-sand p-6 rounded-lg shadow-md transition hover:shadow-lg">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-lg font-medium text-coffee">Total Workshops</h2>
                <i class="fas fa-chalkboard-teacher text-2xl text-coffee opacity-50"></i>
            </div>
            <p class="text-4xl font-bold text-coffee serif">{{ $workshopCount }}</p>
        </div>
    </div>
    
    <!-- Recent Data -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Users -->
        <div class="bg-sand p-6 rounded-lg shadow-md">
            <div class="flex items-center mb-6">
                <i class="fas fa-user-clock text-xl text-coffee mr-3"></i>
                <h2 class="text-2xl font-bold text-coffee serif">Recent Users</h2>
            </div>
            
            @if($recentUsers->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-terracotta border-opacity-30">
                                <th class="p-3 text-left text-charcoal">Name</th>
                                <th class="p-3 text-left text-charcoal">Email</th>
                                <th class="p-3 text-left text-charcoal">Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentUsers as $user)
                                <tr class="border-b border-terracotta border-opacity-20 hover:bg-terracotta hover:bg-opacity-10">
                                    <td class="p-3">
                                        <div class="flex items-center">
                                            <i class="fas fa-user text-coffee mr-2"></i>
                                            {{ $user->name }}
                                        </div>
                                    </td>
                                    <td class="p-3">
                                        <div class="flex items-center">
                                            <i class="fas fa-envelope text-coffee mr-2"></i>
                                            {{ $user->email }}
                                        </div>
                                    </td>
                                    <td class="p-3">
                                        <span class="px-3 py-1 text-xs rounded-full flex items-center w-fit
                                            {{ $user->role === 'admin' ? 'bg-rust text-cream' : 
                                               ($user->role === 'artist' ? 'bg-terracotta text-cream' : 'bg-coffee text-cream') }}">
                                            <i class="fas {{ $user->role === 'admin' ? 'fa-crown' : 
                                                             ($user->role === 'artist' ? 'fa-paint-brush' : 'fa-heart') }} mr-1"></i>
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-coffee italic flex items-center">
                    <i class="fas fa-info-circle mr-2"></i> No users found.
                </p>
            @endif
            
            <div class="mt-6 text-right">
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-rust hover:text-coffee transition">
                    <span>View all users</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
        
        <!-- Recent Workshops -->
        <div class="bg-sand p-6 rounded-lg shadow-md">
            <div class="flex items-center mb-6">
                <i class="fas fa-calendar-alt text-xl text-coffee mr-3"></i>
                <h2 class="text-2xl font-bold text-coffee serif">Recent Workshops</h2>
            </div>
            
            @if($recentWorkshops->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-terracotta border-opacity-30">
                                <th class="p-3 text-left text-charcoal">Title</th>
                                <th class="p-3 text-left text-charcoal">Date</th>
                                <th class="p-3 text-left text-charcoal">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentWorkshops as $workshop)
                                <tr class="border-b border-terracotta border-opacity-20 hover:bg-terracotta hover:bg-opacity-10">
                                    <td class="p-3">
                                        <a href="{{ route('admin.workshops.edit', $workshop) }}" class="text-rust hover:underline font-medium flex items-center">
                                            <i class="fas fa-chalkboard text-coffee mr-2"></i>
                                            {{ $workshop->title }}
                                        </a>
                                    </td>
                                    <td class="p-3">
                                        <div class="flex items-center">
                                            <i class="far fa-calendar text-coffee mr-2"></i>
                                            {{ $workshop->date ? $workshop->date->format('M d, Y') : 'N/A' }}
                                        </div>
                                    </td>
                                    <td class="p-3">
                                        @if($workshop->is_active)
                                            <span class="px-3 py-1 text-xs bg-terracotta text-cream rounded-full flex items-center w-fit">
                                                <i class="fas fa-check-circle mr-1"></i> Active
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs bg-rust text-cream rounded-full flex items-center w-fit">
                                                <i class="fas fa-times-circle mr-1"></i> Inactive
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-coffee italic flex items-center">
                    <i class="fas fa-info-circle mr-2"></i> No workshops found.
                </p>
            @endif
            
            <div class="mt-6 text-right">
                <a href="{{ route('admin.workshops.index') }}" class="inline-flex items-center text-rust hover:text-coffee transition">
                    <span>View all workshops</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 