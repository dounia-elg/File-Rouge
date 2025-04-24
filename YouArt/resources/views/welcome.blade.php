<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouArt - Connect with Art</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                    <li><a href="{{ route('workshops.index') }}" class="text-gray-800 hover:text-red-600">Workshops</a></li>
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

    <!-- Featured Workshops Sectio -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Featured Workshops</h2>
                <a href="{{ route('workshops.index') }}" class="text-red-600 hover:text-red-700 font-semibold">View All →</a>
            </div>
            
            @if(isset($featuredWorkshops) && $featuredWorkshops->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($featuredWorkshops as $workshop)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="relative">
                                @if($workshop->video_thumbnail)
                                    <img src="{{ $workshop->video_thumbnail }}" alt="{{ $workshop->title }}" class="w-full h-48 object-cover">
                                @elseif($workshop->thumbnail_image)
                                    <img src="{{ asset('storage/' . $workshop->thumbnail_image) }}" alt="{{ $workshop->title }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-paint-brush text-4xl text-gray-400"></i>
                                    </div>
                                @endif
                                
                                <div class="absolute top-2 right-2 bg-black bg-opacity-70 text-white px-2 py-1 text-sm rounded">
                                    {{ $workshop->formatted_duration }}
                                </div>
                            </div>
                            
                            <div class="p-4">
                                <h3 class="text-xl font-bold mb-2">{{ $workshop->title }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $workshop->description }}</p>
                                
                                <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
                                    <span>{{ $workshop->date ? $workshop->date->format('M d, Y') : 'Date TBA' }}</span>
                                    <div class="flex items-center">
                                        <span class="flex items-center mr-3">
                                            <i class="fas fa-eye mr-1"></i>
                                            {{ $workshop->views }}
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-heart mr-1"></i>
                                            {{ $workshop->likes }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $workshop->skill_level == 'beginner' ? 'bg-green-100 text-green-800' : 
                                        ($workshop->skill_level == 'intermediate' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') }}">
                                        {{ ucfirst($workshop->skill_level) }}
                                    </span>
                                    <a href="{{ route('workshops.show', $workshop) }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition-colors">
                                        Watch Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-600 text-lg">No featured workshops available at the moment.</p>
                </div>
            @endif
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
                        <li><a href="{{ route('workshops.index') }}" class="text-gray-400 hover:text-white">Workshops</a></li>
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
