<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'YouArt') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50">
    <!-- Header/Navigation -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-red-600">YouArt</a>
            </div>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="{{ route('home') }}" class="text-gray-800 hover:text-red-600">Home</a></li>
                    <li><a href="#" class="text-gray-800 hover:text-red-600">Artworks</a></li>
                    <li><a href="#" class="text-gray-800 hover:text-red-600">Auctions</a></li>
                    <li><a href="#" class="text-gray-800 hover:text-red-600">Workshops</a></li>
                    @auth
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-800 hover:text-red-600">Logout</button>
                            </form>
                        </li>
                        @if(Auth::user()->role === 'artist')
                            <li><a href="{{ route('artist.space') }}" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">My Space</a></li>
                        @endif
                    @else
                        <li><a href="{{ route('login') }}" class="text-gray-800 hover:text-red-600">Login</a></li>
                        <li><a href="{{ route('register') }}" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Register</a></li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 w-full">
            <div class="container mx-auto px-4">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-500 text-white p-4 w-full">
            <div class="container mx-auto px-4">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-auto">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">YouArt</h3>
                    <p class="text-gray-400">Connecting artists and art lovers worldwide</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Artworks</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Auctions</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Legal</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('terms') }}" class="text-gray-400 hover:text-white">Terms of Service</a></li>
                        <li><a href="{{ route('privacy') }}" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} YouArt. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html> 