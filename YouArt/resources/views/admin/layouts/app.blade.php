<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'YouArt') }} Admin</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
    </style>
</head>
<body>
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-red-700 text-white">
            <div class="p-4 text-xl font-bold">
                YouArt Admin
            </div>
            
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="block py-3 px-4 text-white {{ request()->routeIs('admin.dashboard') ? 'bg-red-900' : 'hover:bg-red-800' }}">
                    Dashboard
                </a>
                
                <a href="{{ route('admin.workshops.index') }}" class="block py-3 px-4 text-white {{ request()->routeIs('admin.workshops.*') ? 'bg-red-900' : 'hover:bg-red-800' }}">
                    Workshops
                </a>
                
                <a href="{{ route('admin.artworks') }}" class="block py-3 px-4 text-white {{ request()->routeIs('admin.artworks') ? 'bg-red-900' : 'hover:bg-red-800' }}">
                    Artworks
                </a>
                
                <a href="{{ route('admin.users.index') }}" class="block py-3 px-4 text-white {{ request()->routeIs('admin.users.*') ? 'bg-red-900' : 'hover:bg-red-800' }}">
                    Users
                </a>
            </nav>
            
            <div class="mt-auto p-4 border-t border-gray-700">
                <div class="flex justify-between">
                    <a href="{{ route('home') }}" class="text-gray-400 hover:text-white">
                        Back to Site
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-white">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <header class="bg-white shadow">
                <div class="p-4">
                    <h1 class="text-lg font-medium">YouArt Administration</h1>
                </div>
            </header>
            
            <main class="p-4">
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html> 