<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouArt - Connect with Art</title>
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
<body>
    <!-- Header/Navigation -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">!
                <h1 class="text-2xl font-bold text-red-600">YouArt</h1>
            </div>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="{{ route('home') }}" class="text-gray-800 hover:text-red-600">Home</a></li>
                    <li><a href="#" class="text-gray-800 hover:text-red-600">Artworks</a></li>
                    <li><a href="#" class="text-gray-800 hover:text-red-600">Auctions</a></li>
                    <li><a href="#" class="text-gray-800 hover:text-red-600">Workshops</a></li>
                    @auth
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
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

    <!-- Hero Section -->
    <section class="bg-cover bg-center h-96 flex items-center" style="background-image: url('{{ asset('images/gallery-header.jpg') }}');">
        <div class="container mx-auto px-4 text-center">
            <div class="bg-black bg-opacity-50 p-8 rounded-lg inline-block">
                <h2 class="text-4xl font-bold text-white mb-4">Discover, Connect, Create</h2>
                <p class="text-xl text-white mb-6">Join our community of artists and art enthusiasts</p>
                <a href="{{ route('register') }}" class="bg-red-600 text-white px-6 py-3 rounded-full font-bold hover:bg-red-700">Get Started</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Why Choose YouArt?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="text-red-600 text-4xl mb-4">🎨</div>
                    <h3 class="text-xl font-semibold mb-2">Showcase Your Art</h3>
                    <p class="text-gray-600">Create your personal gallery and showcase your artwork to a global audience</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="text-red-600 text-4xl mb-4">💰</div>
                    <h3 class="text-xl font-semibold mb-2">Sell Your Creations</h3>
                    <p class="text-gray-600">Sell your artwork directly or through auctions with secure payment processing</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="text-red-600 text-4xl mb-4">🤝</div>
                    <h3 class="text-xl font-semibold mb-2">Connect with Others</h3>
                    <p class="text-gray-600">Build your network, receive feedback, and collaborate with fellow artists</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
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
