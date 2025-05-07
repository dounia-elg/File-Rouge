@extends('admin.layouts.app')

@section('content')
<div class="p-6 bg-cream">
    <h1 class="text-3xl font-bold mb-8 text-rust serif">
        <i class="fas fa-users mr-3"></i>User Management
    </h1>
    
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
    
    <div class="bg-sand p-6 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-terracotta border-opacity-30">
                        <th class="p-3 text-left text-charcoal">ID</th>
                        <th class="p-3 text-left text-charcoal">Name</th>
                        <th class="p-3 text-left text-charcoal">Email</th>
                        <th class="p-3 text-left text-charcoal">Role</th>
                        <th class="p-3 text-left text-charcoal">Status</th>
                        <th class="p-3 text-left text-charcoal">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border-b border-terracotta border-opacity-20 hover:bg-terracotta hover:bg-opacity-10">
                        <td class="p-3">{{ $user->id }}</td>
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
                        <td class="p-3">
                            <span class="px-3 py-1 text-xs rounded-full flex items-center w-fit
                                {{ $user->is_active ? 'bg-terracotta text-cream' : 'bg-rust text-cream' }}">
                                <i class="fas {{ $user->is_active ? 'fa-check-circle' : 'fa-ban' }} mr-1"></i>
                                {{ $user->is_active ? 'Active' : 'Suspended' }}
                            </span>
                        </td>
                        <td class="p-3">
                            <div class="flex space-x-2">
                                @if($user->is_active)
                                    <form action="{{ route('admin.users.suspend', $user) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 bg-coffee text-cream rounded-full hover:bg-terracotta transition flex items-center text-xs">
                                            <i class="fas fa-user-slash mr-1"></i> Suspend
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.users.activate', $user) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 bg-terracotta text-cream rounded-full hover:bg-coffee transition flex items-center text-xs">
                                            <i class="fas fa-user-check mr-1"></i> Activate
                                        </button>
                                    </form>
                                @endif
                                
                                @if(auth()->id() != $user->id)
                                    <form action="{{ route('admin.users.delete', $user) }}" method="POST" 
                                          onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-rust text-cream rounded-full hover:bg-coffee transition flex items-center text-xs">
                                            <i class="fas fa-trash-alt mr-1"></i> Delete
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 