@extends('admin.layouts.app')

@section('content')
<div class="p-4">
    <h1 class="text-2xl font-bold mb-6">User Management</h1>
    
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
                    <th class="p-2 text-left">Name</th>
                    <th class="p-2 text-left">Email</th>
                    <th class="p-2 text-left">Role</th>
                    <th class="p-2 text-left">Status</th>
                    <th class="p-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-t">
                    <td class="p-2">{{ $user->id }}</td>
                    <td class="p-2">{{ $user->name }}</td>
                    <td class="p-2">{{ $user->email }}</td>
                    <td class="p-2">
                        <span class="px-2 py-1 text-xs rounded 
                            {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 
                              ($user->role === 'artist' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="p-2">
                        <span class="px-2 py-1 text-xs rounded 
                            {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $user->is_active ? 'Active' : 'Suspended' }}
                        </span>
                    </td>
                    <td class="p-2 flex space-x-2">
                        @if($user->is_active)
                            <form action="{{ route('admin.users.suspend', $user) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-xs">
                                    Suspend
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.users.activate', $user) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-xs">
                                    Activate
                                </button>
                            </form>
                        @endif
                        
                        @if(auth()->id() != $user->id)
                            <form action="{{ route('admin.users.delete', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 