<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'YouArt') }} Admin</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'cream': '#f5f0e6',
                        'sand': '#e6d7c3',
                        'terracotta': '#bc8a7e',
                        'rust': '#994c4c',
                        'coffee': '#855c4f',
                        'charcoal': '#333333',
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        h1, h2, h3, .serif {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="bg-cream text-charcoal">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-rust text-cream shadow-lg">
            <div class="p-5 text-2xl font-bold serif flex items-center">
                <i class="fas fa-palette mr-3"></i> YouArt Admin
            </div>
            
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="block py-3 px-5 text-cream {{ request()->routeIs('admin.dashboard') ? 'bg-coffee' : 'hover:bg-terracotta' }} transition flex items-center">
                    <i class="fas fa-chart-line w-6"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('admin.workshops.index') }}" class="block py-3 px-5 text-cream {{ request()->routeIs('admin.workshops.*') ? 'bg-coffee' : 'hover:bg-terracotta' }} transition flex items-center">
                    <i class="fas fa-chalkboard-teacher w-6"></i>
                    <span>Workshops</span>
                </a>
                
                <a href="{{ route('admin.artworks') }}" class="block py-3 px-5 text-cream {{ request()->routeIs('admin.artworks') ? 'bg-coffee' : 'hover:bg-terracotta' }} transition flex items-center">
                    <i class="fas fa-image w-6"></i>
                    <span>Artworks</span>
                </a>
                
                <a href="{{ route('admin.users.index') }}" class="block py-3 px-5 text-cream {{ request()->routeIs('admin.users.*') ? 'bg-coffee' : 'hover:bg-terracotta' }} transition flex items-center">
                    <i class="fas fa-users w-6"></i>
                    <span>Users</span>
                </a>
            </nav>
            
            <div class="absolute bottom-0 w-64 p-5 border-t border-terracotta">
                <div class="flex justify-between">
                    <a href="{{ route('home') }}" class="text-cream hover:text-sand transition flex items-center">
                        <i class="fas fa-home mr-2"></i> Back to Site
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-cream hover:text-sand transition flex items-center">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <header class="bg-sand shadow-md">
                <div class="p-5 flex justify-between items-center">
                    <h1 class="text-xl font-bold text-coffee serif">
                        <i class="fas fa-brush mr-2"></i> YouArt Administration
                    </h1>
                    <div class="flex items-center">
                        <span class="text-sm text-coffee mr-3">
                            <i class="far fa-clock mr-1"></i> {{ date('F j, Y') }}
                        </span>
                    </div>
                </div>
            </header>
            
            <main>
                @if (session('success'))
                    <div class="m-6 p-4 bg-terracotta bg-opacity-20 border-l-4 border-terracotta text-coffee flex items-center">
                        <i class="fas fa-check-circle mr-3"></i> {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="m-6 p-4 bg-rust bg-opacity-20 border-l-4 border-rust text-rust flex items-center">
                        <i class="fas fa-exclamation-circle mr-3"></i> {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html> 