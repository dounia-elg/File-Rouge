<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouArt - Connect with Art</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dark: '#0a0a0a',
                        accent: '#d4a373',
                    },
                    fontFamily: {
                        display: ['Cormorant Garamond', 'serif'],
                        sans: ['Montserrat', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=Montserrat:wght@200;300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #0a0a0a;
            color: #f5f5f5;
            overflow-x: hidden;
        }
        .font-display {
            font-family: 'Cormorant Garamond', serif;
        }
        .item {
            transition: all 0.5s ease;
        }
        .item:hover {
            transform: translateY(-10px);
        }
        .scattered-item {
            position: relative;
        }
        .art-piece {
            transition: transform 0.7s ease, box-shadow 0.7s ease;
        }
        .art-piece:hover {
            transform: scale(1.03);
            box-shadow: 0 25px 50px -12px rgba(255, 255, 255, 0.1);
        }
        .rtl {
            direction: rtl;
        }
        .fade-in {
            animation: fadeIn 1.5s ease-in;
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        .float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .overlap {
            margin-top: -5rem;
        }
        .nav-link {
            position: relative;
            display: inline-block;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            bottom: -2px;
            left: 0;
            background-color: #d4a373;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
    </style>
    </head>
<body class="bg-dark text-white min-h-screen">
    <!-- Minimal Header -->
    <header class="fixed w-full z-50 bg-dark bg-opacity-80 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-display font-light tracking-widest text-white">You<span class="text-accent">Art</span></a>
            <nav class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" class="nav-link text-sm text-white font-light hover:text-accent">Home</a>
                <a href="#" class="nav-link text-sm text-white font-light hover:text-accent">Exhibitions</a>
                <a href="#" class="nav-link text-sm text-white font-light hover:text-accent">Collections</a>
                <a href="{{ route('workshops.index') }}" class="nav-link text-sm text-white font-light hover:text-accent">Workshops</a>
                @auth
                    @if(Auth::user()->role === 'artist')
                        <a href="{{ route('artist.space') }}" class="nav-link text-sm text-white font-light hover:text-accent">Artist Space</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="nav-link text-sm text-white font-light hover:text-accent bg-transparent border-0">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link text-sm text-white font-light hover:text-accent">Login</a>
                    <a href="{{ route('register') }}" class="nav-link text-sm text-accent font-light hover:text-white">Register</a>
                @endauth
            </nav>
            <button class="md:hidden text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </header>

    <!-- Featured Exhibition in Minimal Style -->
    <section class="pt-32 pb-16 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="order-2 md:order-1">
                    <h1 class="font-display text-4xl md:text-6xl font-light mb-6 leading-tight">Classical <br>Masterpieces <br>Reimagined</h1>
                    <div class="mb-10">
                        <p class="text-sm text-gray-300 mb-6 max-w-md">Discover how the legacy of classical art continues to inspire contemporary creation through our curated collection.</p>
                        <a href="#exhibitions" class="inline-block px-6 py-2 border border-accent text-accent text-sm tracking-widest hover:bg-accent hover:text-black transition duration-300">Explore</a>
                    </div>
                </div>
                <div class="order-1 md:order-2">
                    <img src="https://images.unsplash.com/photo-1513364776144-60967b0f800f?ixlib=rb-1.2.1&auto=format&fit=crop&w=2070&q=80" alt="Starry Night" class="w-full h-96 object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Scattered Exhibition Section -->
    <section id="exhibitions" class="py-20 relative">
        <h2 class="font-display text-2xl md:text-3xl text-center mb-16">Exhibitions</h2>

        <div class="max-w-7xl mx-auto grid grid-cols-12 gap-4">
            <!-- Item 1 - Large Right -->
            <div class="col-span-12 md:col-span-8 md:col-start-5 mb-24 art-piece fade-in">
                <img src="https://images.unsplash.com/photo-1579783483458-83d02161294e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1056&q=80" alt="Art Exhibition" class="w-full h-80 object-cover">
                <div class="mt-4 flex justify-between items-start">
                    <div>
                        <h3 class="font-display text-2xl text-accent">European Classics</h3>
                        <p class="text-xs text-gray-400">On display until Sept 30</p>
                    </div>
                    <span class="text-xs text-gray-400">01</span>
                </div>
            </div>

            <!-- Arabic Quote Top Left -->
            <div class="col-span-12 md:col-span-4 md:col-start-1 -mt-20 mb-16 scattered-item rtl fade-in float">
                <p class="font-display text-xl text-right text-gray-300 italic">
                    "الفن هو حوار بين الروح والعالم"
                </p>
                <p class="text-xs text-right text-gray-500 mt-2">- فريدا كالو</p>
            </div>

            <!-- Item 2 - Middle Left -->
            <div class="col-span-12 md:col-span-6 mb-16 art-piece fade-in">
                <div class="flex flex-col md:flex-row gap-6">
                    <img src="https://images.unsplash.com/photo-1547891654-e66ed7ebb968?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" alt="Portrait" class="w-full md:w-1/2 h-64 object-cover">
                    <div class="md:w-1/2 flex flex-col justify-between">
                        <div>
                            <h3 class="font-display text-2xl text-accent">Contemporary Portraits</h3>
                            <p class="text-xs text-gray-400 mb-4">New collection</p>
                        </div>
                        <span class="text-xs text-gray-400">02</span>
                    </div>
                </div>
            </div>

            <!-- French Quote Right -->
            <div class="col-span-12 md:col-span-4 md:col-start-9 md:-mt-10 mb-16 scattered-item fade-in float">
                <p class="font-display text-xl text-gray-300 italic">
                    "L'art lave notre âme de la poussière du quotidien"
                </p>
                <p class="text-xs text-gray-500 mt-2">- Pablo Picasso</p>
            </div>

            <!-- Item 3 - Large Left -->
            <div class="col-span-12 md:col-span-8 mb-24 art-piece fade-in">
                <img src="https://images.unsplash.com/photo-1578926288207-32356a2b8838?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" alt="Abstract Art" class="w-full h-96 object-cover">
                <div class="mt-4 flex justify-between items-start">
                    <div>
                        <h3 class="font-display text-2xl text-accent">Abstract Expressions</h3>
                        <p class="text-xs text-gray-400">Upcoming</p>
                    </div>
                    <span class="text-xs text-gray-400">03</span>
                </div>
            </div>

            <!-- Japanese Quote Bottom -->
            <div class="col-span-12 md:col-span-4 md:col-start-7 mb-16 scattered-item fade-in float">
                <p class="font-display text-xl text-gray-300 italic">
                    "芸術は人生に不必要なもののうち、最も必要なものである"
                </p>
                <p class="text-xs text-gray-500 mt-2">- 上村松園</p>
            </div>

            <!-- Item 4 - Small Right -->
            <div class="col-span-12 md:col-span-5 md:col-start-8 mb-16 art-piece fade-in">
                <img src="https://images.unsplash.com/photo-1545989253-02cc26577f88?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Sculpture" class="w-full h-72 object-cover">
                <div class="mt-4 flex justify-between items-start">
                    <div>
                        <h3 class="font-display text-2xl text-accent">Modern Sculpture</h3>
                        <p class="text-xs text-gray-400">Limited exhibition</p>
                    </div>
                    <span class="text-xs text-gray-400">04</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-20 px-6 bg-black">
        <div class="max-w-7xl mx-auto mb-16">
            <div class="md:flex justify-between items-end">
                <h2 class="font-display text-2xl md:text-3xl mb-6 md:mb-0">The Art Gallery of <br>San Francisco</h2>
                <p class="text-gray-400 text-sm max-w-md">A temple to artistic expression where tradition meets innovation in carefully curated exhibitions that challenge perception.</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto grid grid-cols-12 gap-8">
            <div class="col-span-12 md:col-span-7 mb-8">
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <img src="https://images.unsplash.com/photo-1577720643272-265a9f9acbd3?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" alt="Gallery Art" class="w-full h-48 object-cover mb-2">
                        <img src="https://images.unsplash.com/photo-1577083552792-a0d398a513ed?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" alt="Gallery Art" class="w-full h-60 object-cover">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1577083552453-2b0595ba3c75?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" alt="Gallery Art" class="w-full h-60 object-cover mb-2">
                        <img src="https://images.unsplash.com/photo-1582555172866-f73bb12a2ab3?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" alt="Gallery Art" class="w-full h-48 object-cover">
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-5 flex flex-col justify-center">
                <p class="mb-8 text-sm text-gray-300">The gallery exhibits a diverse collection spanning centuries of artistic evolution, from Renaissance masterpieces to cutting-edge contemporary works.</p>
                <p class="mb-8 text-sm text-gray-300">Our rotating exhibitions ensure every visit offers a new perspective on the transformative power of visual expression.</p>
                <div class="rtl mb-8">
                    <p class="text-sm text-gray-300 text-right">
                        المتحف يعرض تشكيلة متنوعة تمتد عبر قرون من التطور الفني، من روائع عصر النهضة إلى الأعمال المعاصرة المتطورة
                    </p>
                </div>
                <a href="#" class="inline-block px-6 py-2 border border-accent text-accent text-sm tracking-widest hover:bg-accent hover:text-black transition duration-300 self-start">Visit Gallery</a>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section class="py-20 px-6">
        <h2 class="font-display text-2xl md:text-3xl text-center mb-20">Events & Programs</h2>

        <div class="max-w-6xl mx-auto grid grid-cols-12 gap-y-16">
            <!-- Event 1 -->
            <div class="col-span-12 md:col-span-8 md:col-start-1 flex flex-col md:flex-row gap-6 items-center fade-in">
                <div class="md:w-1/2">
                    <img src="https://images.unsplash.com/photo-1515169067868-5387ec356754?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Summer Studios" class="w-full h-72 object-cover">
                </div>
                <div class="md:w-1/2">
                    <span class="text-xs text-gray-400">June 15 - August 30</span>
                    <h3 class="font-display text-2xl text-accent mt-2 mb-4">Summer Studios: Art Exploration</h3>
                    <p class="text-sm text-gray-300 mb-4">Immerse yourself in creative processes guided by master artists in our summer-long workshop series.</p>
                    <a href="#" class="text-xs text-accent border-b border-accent pb-1 hover:text-white hover:border-white transition duration-300">Learn more</a>
                </div>
            </div>

            <!-- Russian Quote -->
            <div class="col-span-12 md:col-span-4 md:col-start-9 scattered-item fade-in float">
                <p class="font-display text-xl text-gray-300 italic">
                    "Искусство — это не что иное, как созерцание мира в состоянии благодати"
                </p>
                <p class="text-xs text-gray-500 mt-2">- Герман Гессе</p>
            </div>

            <!-- Event 2 -->
            <div class="col-span-12 md:col-span-8 md:col-start-5 flex flex-col md:flex-row-reverse gap-6 items-center fade-in">
                <div class="md:w-1/2">
                    <img src="https://images.unsplash.com/photo-1459908676235-d5f02a50184b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Wine & Canvas" class="w-full h-72 object-cover">
                </div>
                <div class="md:w-1/2 text-right">
                    <span class="text-xs text-gray-400">Every Friday, 7PM</span>
                    <h3 class="font-display text-2xl text-accent mt-2 mb-4">Wine & Canvas: Adult Workshop</h3>
                    <p class="text-sm text-gray-300 mb-4">Unwind with a glass of fine wine while creating your own masterpiece in this social painting experience.</p>
                    <a href="#" class="text-xs text-accent border-b border-accent pb-1 hover:text-white hover:border-white transition duration-300">Learn more</a>
                </div>
            </div>

            <!-- Spanish Quote -->
            <div class="col-span-12 md:col-span-4 md:col-start-1 scattered-item fade-in float">
                <p class="font-display text-xl text-gray-300 italic">
                    "El arte es la mentira que nos permite comprender la verdad"
                </p>
                <p class="text-xs text-gray-500 mt-2">- Pablo Picasso</p>
            </div>
        </div>
    </section>

    <!-- Featured Collection -->
    <section class="py-20 px-6 bg-gradient-to-b from-dark to-black">
        <div class="max-w-6xl mx-auto mb-16">
            <h2 class="font-display text-2xl md:text-3xl mb-2">Featured Collection</h2>
            <p class="text-sm text-gray-400 mb-10">Impressionist Masterpieces from the 19th Century</p>
            
            <div class="relative">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 md:col-span-7">
                        <img src="https://images.unsplash.com/photo-1579541592825-712979624ece?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Impressionist Art" class="w-full h-96 object-cover">
                    </div>
                    <div class="col-span-12 md:col-span-5 md:mt-20 bg-black md:bg-transparent p-6 md:p-0">
                        <p class="text-sm text-gray-300 mb-6">
                            Our Impressionist collection features works that capture fleeting moments of light and atmosphere, challenging traditional academic painting with bold brushwork and vibrant color.
                        </p>
                        <p class="text-sm text-gray-300 mb-6">
                            Celebrate the innovation of artists who dared to break conventions and paved the way for modern art movements.
                        </p>
                        <a href="#" class="inline-block px-6 py-2 border border-accent text-accent text-sm tracking-widest hover:bg-accent hover:text-black transition duration-300">View Collection</a>
                    </div>
                    
                    <!-- Scattered elements -->
                    <div class="hidden md:block col-span-4 col-start-9 -mt-16">
                        <img src="https://images.unsplash.com/photo-1578301978693-85fa9c0320b9?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Art Detail" class="w-full h-48 object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Collection Grid -->
    <section class="py-20 px-6">
        <h2 class="font-display text-2xl md:text-3xl text-center mb-2">Explore the Collection</h2>
        <p class="text-center text-sm text-gray-400 mb-16">Discover our diverse artistic heritage across periods and mediums</p>
        
        <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-2">
            <a href="#" class="block overflow-hidden art-piece">
                <img src="https://images.unsplash.com/photo-1617791160536-598cf32026fb?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Renaissance" class="w-full h-80 object-cover hover:scale-105 transition duration-500">
                <p class="text-xs mt-2 text-gray-300">Renaissance</p>
            </a>
            <a href="#" class="block overflow-hidden art-piece mt-10">
                <img src="https://images.unsplash.com/photo-1557753478-d612d367e395?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Portraits" class="w-full h-80 object-cover hover:scale-105 transition duration-500">
                <p class="text-xs mt-2 text-gray-300">Portraits</p>
            </a>
            <a href="#" class="block overflow-hidden art-piece">
                <img src="https://images.unsplash.com/photo-1559102877-4a2cc0e37fce?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Sculptures" class="w-full h-80 object-cover hover:scale-105 transition duration-500">
                <p class="text-xs mt-2 text-gray-300">Sculptures</p>
            </a>
            <a href="#" class="block overflow-hidden art-piece mt-10">
                <img src="https://images.unsplash.com/photo-1579541814924-49fef17c5be5?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Modern" class="w-full h-80 object-cover hover:scale-105 transition duration-500">
                <p class="text-xs mt-2 text-gray-300">Modern</p>
            </a>
        </div>
    </section>

    <!-- Workshop Section -->
    <section class="py-20 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="md:flex justify-between items-end mb-16">
                <h2 class="font-display text-2xl md:text-3xl mb-6 md:mb-0">Featured Workshops</h2>
                <a href="{{ route('workshops.index') }}" class="text-accent text-sm tracking-widest hover:text-white transition duration-300 flex items-center">
                    View all workshops
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
            
            @if(isset($featuredWorkshops) && $featuredWorkshops->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($featuredWorkshops as $workshop)
                        <div class="bg-black p-4 art-piece">
                            <div class="relative">
                                @if($workshop->video_thumbnail)
                                    <img src="{{ $workshop->video_thumbnail }}" alt="{{ $workshop->title }}" class="w-full h-60 object-cover">
                                @elseif($workshop->thumbnail_image)
                                    <img src="{{ asset('storage/' . $workshop->thumbnail_image) }}" alt="{{ $workshop->title }}" class="w-full h-60 object-cover">
                                @else
                                    <div class="w-full h-60 bg-gray-900 flex items-center justify-center">
                                        <i class="fas fa-paint-brush text-4xl text-gray-600"></i>
                                    </div>
                                @endif
                                
                                <div class="absolute bottom-4 right-4 bg-black bg-opacity-70 text-white px-2 py-1 text-xs">
                                    {{ $workshop->formatted_duration }}
                                </div>
                            </div>
                            
                            <div class="pt-6">
                                <h3 class="font-display text-xl mb-2">{{ $workshop->title }}</h3>
                                <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ $workshop->description }}</p>
                                
                                <div class="flex justify-between items-center text-xs text-gray-500 mb-4">
                                    <span>{{ $workshop->date ? $workshop->date->format('M d, Y') : 'Added: ' . $workshop->created_at->format('M d, Y') }}</span>
                                    <div class="flex items-center space-x-3">
                                        <span class="flex items-center">
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
                                    <span class="inline-flex items-center px-2 py-1 text-xs 
                                        {{ $workshop->skill_level == 'beginner' ? 'text-green-400' : 
                                        ($workshop->skill_level == 'intermediate' ? 'text-blue-400' : 'text-purple-400') }}">
                                        {{ ucfirst($workshop->skill_level) }}
                                    </span>
                                    <a href="{{ route('workshops.show', $workshop) }}" class="text-accent text-sm hover:text-white transition-colors flex items-center">
                                        Watch
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
                <div class="text-center py-16 bg-black">
                    <p class="font-display text-xl text-gray-300 italic mb-2">No featured workshops available at the moment.</p>
                    <p class="text-sm text-gray-400">New artistic journeys coming soon.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Sign Up -->
    <section class="py-32 px-6 bg-black">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="font-display text-3xl md:text-4xl mb-6">Begin Your Artistic Journey</h2>
            <p class="text-gray-300 mb-10 max-w-lg mx-auto">Join our community of artists and enthusiasts exploring the transformative power of creative expression.</p>
            <a href="{{ route('register') }}" class="inline-block px-8 py-3 bg-accent text-black text-sm font-medium tracking-widest hover:bg-white transition duration-300">Join YouArt</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-16 px-6 bg-black border-t border-gray-900">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div>
                    <a href="{{ route('home') }}" class="text-2xl font-display font-light tracking-widest text-white mb-6 inline-block">You<span class="text-accent">Art</span></a>
                    <p class="text-gray-400 text-sm mb-6">"Art is not what you see, but what you make others see." — Edgar Degas</p>
                    <p class="text-gray-500 text-xs">© {{ date('Y') }} YouArt. All rights reserved.</p>
                </div>
                
                <div>
                    <h3 class="text-sm font-medium mb-6 uppercase tracking-wider">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-400 text-sm hover:text-white transition duration-300">Home</a></li>
                        <li><a href="#" class="text-gray-400 text-sm hover:text-white transition duration-300">Exhibitions</a></li>
                        <li><a href="#" class="text-gray-400 text-sm hover:text-white transition duration-300">Collections</a></li>
                        <li><a href="{{ route('workshops.index') }}" class="text-gray-400 text-sm hover:text-white transition duration-300">Workshops</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-sm font-medium mb-6 uppercase tracking-wider">Legal</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('terms') }}" class="text-gray-400 text-sm hover:text-white transition duration-300">Terms of Service</a></li>
                        <li><a href="{{ route('privacy') }}" class="text-gray-400 text-sm hover:text-white transition duration-300">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Reveal animations on scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });
            
            document.querySelectorAll('.art-piece:not(.fade-in)').forEach(item => {
                observer.observe(item);
            });
        });
    </script>
</body>
</html>
