<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouArt - Connect with Art</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
        .serif {
            font-family: 'Cormorant Garamond', serif;
        }
        .quote {
            position: relative;
        }
        .quote::before, .quote::after {
            content: '"';
            font-family: 'Cormorant Garamond', serif;
            font-size: 4rem;
            opacity: 0.2;
            position: absolute;
        }
        .quote::before {
            top: -2rem;
            left: -1rem;
        }
        .quote::after {
            bottom: -4rem;
            right: -1rem;
        }
        .art-card {
            transition: transform 0.3s ease;
        }
        .art-card:hover {
            transform: translateY(-5px);
        }
        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
    </head>
<body class="bg-gray-50">
    <!-- Header/Navigation -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
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

    <!-- Hero Section with Inspirational Quote -->
    <section class="relative h-screen bg-cover bg-center flex items-center" style="background-image: url('https://images.unsplash.com/photo-1513364776144-60967b0f800f?ixlib=rb-1.2.1&auto=format&fit=crop&w=2070&q=80');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="max-w-3xl mx-auto">
                <h2 class="serif text-5xl font-bold text-white mb-6 leading-tight">Art is the stored honey of the human soul</h2>
                <p class="text-xl text-white mb-4 italic">- Theodore Dreiser</p>
                <p class="text-xl text-white mb-8">Discover the beauty of creation in our global community of artists</p>
                <a href="{{ route('register') }}" class="bg-red-600 text-white px-8 py-4 rounded-full font-bold hover:bg-red-700 inline-block transition duration-300 transform hover:scale-105">Begin Your Artistic Journey</a>
            </div>
        </div>
    </section>

    <!-- Artist Quote Carousel -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="quote serif text-center px-8 py-4 text-2xl italic text-gray-700 relative">
                    <p class="mb-4">"Every artist dips his brush in his own soul, and paints his own nature into his pictures."</p>
                    <p class="text-right font-semibold text-xl">— Henry Ward Beecher</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Art Gallery Showcase -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="serif text-4xl font-bold text-center mb-4">A Canvas for Every Story</h2>
            <p class="text-center text-gray-600 mb-12 max-w-3xl mx-auto">From classical masterpieces to contemporary expressions, art speaks in the language of emotions that transcends words.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="art-card bg-white rounded-lg overflow-hidden shadow-lg">
                    <img src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Classical Art" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="serif text-2xl font-bold mb-2">Classical Beauty</h3>
                        <p class="text-gray-600">The timeless elegance of classical techniques continues to inspire generations of artists seeking perfection in form and composition.</p>
                    </div>
                </div>
                
                <div class="art-card bg-white rounded-lg overflow-hidden shadow-lg">
                    <img src="https://images.unsplash.com/photo-1547826039-bfc35e0f1ea8?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Abstract Art" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="serif text-2xl font-bold mb-2">Abstract Expressions</h3>
                        <p class="text-gray-600">When emotions transcend form, abstract art emerges as a powerful medium to convey the complexities of human experience.</p>
                    </div>
                </div>
                
                <div class="art-card bg-white rounded-lg overflow-hidden shadow-lg">
                    <img src="https://images.unsplash.com/photo-1501084817091-a4f3d1d19e07?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Modern Art" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="serif text-2xl font-bold mb-2">Contemporary Vision</h3>
                        <p class="text-gray-600">Today's artists blend tradition with innovation, using new media and perspectives to challenge our understanding of art itself.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Historical Art Parallax Section -->
    <section class="parallax py-32 text-center text-white relative" style="background-image: url('https://images.unsplash.com/photo-1566041510639-8d95a2490bfb?ixlib=rb-1.2.1&auto=format&fit=crop&w=2070&q=80');">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="container mx-auto px-4 relative z-10">
            <h2 class="serif text-4xl font-bold mb-6">The Legacy of Masters</h2>
            <div class="max-w-4xl mx-auto">
                <p class="mb-8 text-lg">In the 15th century, Leonardo da Vinci revolutionized art by combining scientific observation with artistic genius. His technique of sfumato—the delicate blending of light and shadow—created an unprecedented sense of depth and emotion in works like the Mona Lisa.</p>
                <p class="mb-8 text-lg">Vincent van Gogh's bold brushstrokes and vibrant colors were initially dismissed, yet his expressive style laid the groundwork for modern art movements. Despite selling only one painting during his lifetime, his work now inspires countless artists to pursue their vision regardless of recognition.</p>
                <p class="text-lg">Frida Kahlo transformed personal suffering into powerful visual narratives, using self-portraiture to explore identity, gender, and cultural heritage. Her unflinching honesty continues to resonate with contemporary audiences seeking authentic expression.</p>
            </div>
        </div>
    </section>

    <!-- Artist Tools Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="serif text-4xl font-bold text-center mb-4">The Tools of Creation</h2>
            <p class="text-center text-gray-600 mb-12 max-w-3xl mx-auto">Behind every masterpiece lies the humble tools that transform vision into reality.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="mb-4 mx-auto w-32 h-32 rounded-full flex items-center justify-center bg-red-50">
                        <img src="https://images.unsplash.com/photo-1520420097861-e4959843b682?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Brushes" class="w-16 h-16 object-contain">
                    </div>
                    <h3 class="serif text-xl font-bold mb-2">The Humble Brush</h3>
                    <p class="text-gray-600">From delicate details to bold strokes, the brush extends the artist's hand to the canvas.</p>
                </div>
                
                <div class="text-center">
                    <div class="mb-4 mx-auto w-32 h-32 rounded-full flex items-center justify-center bg-blue-50">
                        <img src="https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Palette" class="w-16 h-16 object-contain">
                    </div>
                    <h3 class="serif text-xl font-bold mb-2">The Vibrant Palette</h3>
                    <p class="text-gray-600">Where colors blend and harmonize before bringing life to the artist's vision.</p>
                </div>
                
                <div class="text-center">
                    <div class="mb-4 mx-auto w-32 h-32 rounded-full flex items-center justify-center bg-yellow-50">
                        <img src="https://images.unsplash.com/photo-1452860606245-08befc0ff44b?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Pencil" class="w-16 h-16 object-contain">
                    </div>
                    <h3 class="serif text-xl font-bold mb-2">The Patient Pencil</h3>
                    <p class="text-gray-600">Where masterpieces begin their journey as whispers of graphite on paper.</p>
                </div>
                
                <div class="text-center">
                    <div class="mb-4 mx-auto w-32 h-32 rounded-full flex items-center justify-center bg-green-50">
                        <img src="https://images.unsplash.com/photo-1526289034009-0240ddb68ce3?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Canvas" class="w-16 h-16 object-contain">
                    </div>
                    <h3 class="serif text-xl font-bold mb-2">The Blank Canvas</h3>
                    <p class="text-gray-600">A world of infinite possibility awaiting the first touch of inspiration.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Exhibition Showcase -->
    <section class="py-16 bg-gray-900 text-white">
        <div class="container mx-auto px-4">
            <h2 class="serif text-4xl font-bold text-center mb-4">Where Art Comes Alive</h2>
            <p class="text-center text-gray-300 mb-12 max-w-3xl mx-auto">Step into the transformative spaces where art and humanity connect in profound dialogue.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="relative rounded-lg overflow-hidden group">
                    <img src="https://images.unsplash.com/photo-1482245294234-b3f2f8d5f1a4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Gallery Exhibition" class="w-full h-80 object-cover transition duration-500 transform group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80"></div>
                    <div class="absolute bottom-0 left-0 p-6">
                        <h3 class="serif text-2xl font-bold mb-2">The Modern Gallery</h3>
                        <p class="text-gray-200">Contemporary spaces designed to challenge perceptions and provoke thought.</p>
                    </div>
                </div>
                
                <div class="relative rounded-lg overflow-hidden group">
                    <img src="https://images.unsplash.com/photo-1594760467013-64ac2b80b7d3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Museum Exhibition" class="w-full h-80 object-cover transition duration-500 transform group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80"></div>
                    <div class="absolute bottom-0 left-0 p-6">
                        <h3 class="serif text-2xl font-bold mb-2">Historic Museums</h3>
                        <p class="text-gray-200">Guardians of artistic heritage preserving our collective cultural memory.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Inspirational Quote -->
    <section class="py-24 bg-red-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-4xl mx-auto">
                <p class="serif text-3xl italic font-light mb-6">"Art enables us to find ourselves and lose ourselves at the same time."</p>
                <p class="text-xl">— Thomas Merton</p>
            </div>
        </div>
    </section>

    <!-- Featured Workshops Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="serif text-4xl font-bold">Featured Workshops</h2>
                <a href="{{ route('workshops.index') }}" class="text-red-600 hover:text-red-700 font-semibold flex items-center">
                    <span>Explore All Workshops</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            
            @if(isset($featuredWorkshops) && $featuredWorkshops->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($featuredWorkshops as $workshop)
                        <div class="art-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                            <div class="relative">
                                @if($workshop->video_thumbnail)
                                    <img src="{{ $workshop->video_thumbnail }}" alt="{{ $workshop->title }}" class="w-full h-56 object-cover">
                                @elseif($workshop->thumbnail_image)
                                    <img src="{{ asset('storage/' . $workshop->thumbnail_image) }}" alt="{{ $workshop->title }}" class="w-full h-56 object-cover">
                                @else
                                    <div class="w-full h-56 bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-paint-brush text-4xl text-gray-400"></i>
                                    </div>
                                @endif
                                
                                <div class="absolute top-2 right-2 bg-black bg-opacity-70 text-white px-2 py-1 text-sm rounded">
                                    {{ $workshop->formatted_duration }}
                                </div>
                            </div>
                            
                            <div class="p-6">
                                <h3 class="serif text-xl font-bold mb-2">{{ $workshop->title }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $workshop->description }}</p>
                                
                                <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
                                    <span>{{ $workshop->date ? $workshop->date->format('M d, Y') : 'Added: ' . $workshop->created_at->format('M d, Y') }}</span>
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
                                    <a href="{{ route('workshops.show', $workshop) }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition-colors flex items-center">
                                        <span>Watch Now</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-600 text-lg serif italic">No featured workshops available at the moment.</p>
                    <p class="mt-2">New artistic journeys coming soon.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-24 bg-cover bg-center text-white relative" style="background-image: url('https://images.unsplash.com/photo-1595909315417-2edd382a56dc?ixlib=rb-1.2.1&auto=format&fit=crop&w=2070&q=80');">
        <div class="absolute inset-0 bg-black opacity-70"></div>
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h2 class="serif text-4xl font-bold mb-6">Begin Your Artistic Journey Today</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Join our community of artists and art enthusiasts to share, learn, and grow together in the timeless pursuit of creative expression.</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('register') }}" class="bg-red-600 text-white px-8 py-3 rounded-full font-bold hover:bg-red-700 transition duration-300">Join YouArt</a>
                <a href="{{ route('workshops.index') }}" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-full font-bold hover:bg-white hover:text-gray-900 transition duration-300">Explore Workshops</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="serif text-2xl font-bold mb-4">YouArt</h3>
                    <p class="text-gray-400 mb-4">"Art is not what you see, but what you make others see." — Edgar Degas</p>
                    <p class="text-gray-400">Connecting artists and art lovers worldwide through inspiration and creation.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Explore</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition duration-300">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Artworks</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Auctions</a></li>
                        <li><a href="{{ route('workshops.index') }}" class="text-gray-400 hover:text-white transition duration-300">Workshops</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Community</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Artist Spotlights</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Exhibitions</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Art History</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Testimonials</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Legal</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('terms') }}" class="text-gray-400 hover:text-white transition duration-300">Terms of Service</a></li>
                        <li><a href="{{ route('privacy') }}" class="text-gray-400 hover:text-white transition duration-300">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Cookie Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Copyright Information</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-500">
                <p>&copy; {{ date('Y') }} YouArt. All rights reserved.</p>
                <p class="mt-2 text-sm">Crafted with passion for artists and art lovers everywhere.</p>
            </div>
        </div>
    </footer>
    </body>
</html>
