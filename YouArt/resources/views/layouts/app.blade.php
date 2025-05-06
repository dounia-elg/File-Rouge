<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'YouArt') }} - @yield('title', 'Art Community')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600&family=Noto+Naskh+Arabic:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        h1, h2, h3, .serif {
            font-family: 'Playfair Display', serif;
        }

        .font-arabic {
            font-family: 'Noto Naskh Arabic', serif;
        }
    </style>
    @yield('styles')
</head>
<body class="bg-cream text-charcoal">
    <!-- Navigation -->
    <nav class="bg-sand shadow-md">
        <div class="container mx-auto px-4 py-3">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-rust">YouArt</a>
                </div>
                <div class="flex flex-wrap justify-center space-x-6 mb-4 md:mb-0">
                    <a href="{{ route('home') }}" class="text-charcoal hover:text-rust font-medium">Home</a>
                    <a href="{{ route('artists.all') }}" class="text-charcoal hover:text-rust">Artists</a>
                    <a href="{{ route('workshops.index') }}" class="text-charcoal hover:text-rust">Workshops</a>
                    <a href="{{ route('artworks.all') }}" class="text-charcoal hover:text-rust">Artworks</a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        @if(Auth::user()->role === 'artist')
                            <a href="{{ route('artist.space') }}" class="text-charcoal hover:text-rust">My Space</a>
                        @elseif(Auth::user()->role === 'art_lover')
                            <a href="{{ route('artlover.space') }}" class="text-charcoal hover:text-rust">My Space</a>
                        @elseif(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-charcoal hover:text-rust">Dashboard</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-charcoal hover:text-rust">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-charcoal hover:text-rust">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-rust text-cream rounded hover:bg-coffee transition">Register</a>
                    @endauth
                </div>
            </div>
            <div class="flex items-center justify-center space-x-4 md:hidden mt-4">
                <a href="{{ route('login') }}" class="px-4 py-2 bg-rust text-cream rounded hover:bg-coffee transition">Sign In</a>
                <button class="menu-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div class="mobile-menu hidden md:hidden">
            <div class="px-4 py-2 space-y-2 text-center">
                <a href="{{ route('home') }}" class="block text-charcoal hover:text-rust">Home</a>
                <a href="{{ route('artists.all') }}" class="block text-charcoal hover:text-rust">Artists</a>
                <a href="{{ route('workshops.index') }}" class="block text-charcoal hover:text-rust">Workshops</a>
                <a href="{{ route('artworks.all') }}" class="block text-charcoal hover:text-rust">Artworks</a>
                @auth
                    @if(Auth::user()->role === 'artist')
                        <a href="{{ route('artist.space') }}" class="block text-charcoal hover:text-rust">My Space</a>
                    @elseif(Auth::user()->role === 'art_lover')
                        <a href="{{ route('artlover.space') }}" class="block text-charcoal hover:text-rust">My Space</a>
                    @elseif(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="block text-charcoal hover:text-rust">Dashboard</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="text-charcoal hover:text-rust">Logout</button>
                    </form>
                @else
                    <a href="{{ route('register') }}" class="block text-charcoal hover:text-rust">Register</a>
                @endauth
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

    <!-- Footer -->
    <footer class="bg-charcoal text-cream py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">YouArt</h3>
                    <p class="mb-4">A platform dedicated to artists and art lovers, fostering creativity and community.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-cream hover:text-terracotta">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-cream hover:text-terracotta">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-cream hover:text-terracotta">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7 11v2.4h3.97c-.16 1.029-1.2 3.02-3.97 3.02-2.39 0-4.34-1.979-4.34-4.42 0-2.44 1.95-4.42 4.34-4.42 1.36 0 2.27.58 2.79 1.08l1.9-1.83c-1.22-1.14-2.8-1.83-4.69-1.83-3.87 0-7 3.13-7 7s3.13 7 7 7c4.04 0 6.721-2.84 6.721-6.84 0-.46-.051-.81-.111-1.16h-6.61zm0 0 17 2h-3v3h-2v-3h-3v-2h3v-3h2v3h3v2z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Explore</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('artworks.all') }}" class="hover:text-terracotta">Galleries</a></li>
                        <li><a href="{{ route('artists.all') }}" class="hover:text-terracotta">Artists</a></li>
                        <li><a href="{{ route('workshops.index') }}" class="hover:text-terracotta">Workshops</a></li>
                        <li><a href="{{ route('artists.all') }}" class="hover:text-terracotta">Featured Artists</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Join</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('register') }}" class="hover:text-terracotta">Artist Account</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-terracotta">Collector Account</a></li>
                        <li><a href="#" class="hover:text-terracotta">Newsletter</a></li>
                        <li><a href="#" class="hover:text-terracotta">Become a Partner</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-terracotta">Support</a></li>
                        <li><a href="#" class="hover:text-terracotta">Feedback</a></li>
                        <li><a href="#" class="hover:text-terracotta">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-terracotta">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-sm">
                <p>&copy; {{ date('Y') }} YouArt. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.querySelector('.menu-toggle');
            const mobileMenu = document.querySelector('.mobile-menu');

            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>

    @yield('scripts')
</body>
</html> 