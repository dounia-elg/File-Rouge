<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'YouArt') }} - @yield('title', 'Art Community')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @yield('styles')
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div>
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-red-500">YouArt</a>
                </div>
                <div class="flex space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-red-500">Home</a>
                    <a href="{{ route('workshops.index') }}" class="text-gray-700 hover:text-red-500">Workshops</a>
                    @auth
                        <a href="{{ route('artist.space') }}" class="text-gray-700 hover:text-red-500">My Space</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-red-500">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-red-500">Login</a>
                        <a href="{{ route('register') }}" class="text-gray-700 hover:text-red-500">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p>&copy; {{ date('Y') }} YouArt. All rights reserved.</p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('terms') }}" class="text-gray-300 hover:text-white">Terms</a>
                    <a href="{{ route('privacy') }}" class="text-gray-300 hover:text-white">Privacy</a>
                </div>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html> 