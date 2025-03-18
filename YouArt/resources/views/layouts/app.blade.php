<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouArt - @yield('title', 'Welcome')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="{{ route('home') }}" class="flex items-center py-4 px-2">
                            <span class="font-semibold text-gray-500 text-lg">You<span class="text-indigo-600">Art</span></span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="py-2 px-4 text-gray-500 hover:text-indigo-600">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded transition duration-300">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('register') }}" class="py-2 px-4 text-gray-500 hover:text-indigo-600">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto mt-6 px-4">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="bg-white py-6 mt-12">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-center">
                <p class="text-gray-500">© {{ date('Y') }} YouArt. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>