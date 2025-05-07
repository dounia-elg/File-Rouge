@extends('admin.layouts.app')

@section('content')
<div class="p-6 bg-cream">
    <h1 class="text-3xl font-bold mb-8 text-rust serif">
        <i class="fas fa-user-edit mr-3"></i>Edit User
    </h1>

    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('admin.users.index') }}" class="bg-coffee hover:bg-terracotta text-cream px-4 py-2 rounded-md transition flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to Users
        </a>
    </div>

    <div class="bg-sand p-6 rounded-lg shadow-md">
        <div class="mb-6 flex items-center">
            <i class="fas fa-user text-3xl text-rust mr-3"></i>
            <h2 class="text-xl text-coffee">Edit User: <span class="font-medium">{{ $user->name }}</span></h2>
        </div>
        
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')
            
            <div class="mb-5">
                <label for="name" class="block text-coffee font-medium mb-2">
                    <i class="fas fa-user mr-2"></i>Name
                </label>
                <input type="text" 
                       class="w-full border border-terracotta border-opacity-30 rounded-md p-3 focus:border-rust focus:ring focus:ring-rust focus:ring-opacity-20 bg-cream" 
                       id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <p class="text-rust text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>
            
            <div class="mb-5">
                <label for="email" class="block text-coffee font-medium mb-2">
                    <i class="fas fa-envelope mr-2"></i>Email
                </label>
                <input type="email" 
                       class="w-full border border-terracotta border-opacity-30 rounded-md p-3 focus:border-rust focus:ring focus:ring-rust focus:ring-opacity-20 bg-cream" 
                       id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <p class="text-rust text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>
            
            <div class="mb-5">
                <label for="role" class="block text-coffee font-medium mb-2">
                    <i class="fas fa-user-tag mr-2"></i>Role
                </label>
                <select class="w-full border border-terracotta border-opacity-30 rounded-md p-3 focus:border-rust focus:ring focus:ring-rust focus:ring-opacity-20 bg-cream" 
                        id="role" name="role" required>
                    <option value="artist" {{ old('role', $user->role) == 'artist' ? 'selected' : '' }}>Artist</option>
                    <option value="amateur" {{ old('role', $user->role) == 'amateur' ? 'selected' : '' }}>Amateur</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                </select>
                @error('role')
                    <p class="text-rust text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" class="rounded text-rust focus:ring-rust h-5 w-5" 
                           id="is_active" name="is_active" value="1" 
                           {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                    <span class="ml-2 text-coffee">
                        <i class="fas fa-toggle-on mr-1"></i> Active Account
                    </span>
                </label>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="bg-rust hover:bg-coffee text-cream px-5 py-2 rounded-md transition flex items-center">
                    <i class="fas fa-save mr-2"></i> Update User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 