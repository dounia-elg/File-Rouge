<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouArt - Community for Artists and Art Lovers</title>
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

        .quote-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #bc8a7e;
        }

        .art-grid-item {
            transition: transform 0.3s ease;
        }

        .art-grid-item:hover {
            transform: scale(1.03);
        }
    </style>
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

    <!-- Hero Section -->
    <section class="py-16 md:py-24 bg-terracotta bg-opacity-10">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">Where Art <br><span class="text-rust italic">Meets Community</span></h1>
                    <p class="text-lg mb-8 max-w-lg">Discover, create, and connect in a vibrant space dedicated to artists and art enthusiasts. Showcase your work, participate in auctions, and join workshops.</p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('register') }}" class="px-6 py-3 bg-rust text-cream rounded-md text-center hover:bg-coffee transition">Join as Artist</a>
                        <a href="{{ route('artworks.all') }}" class="px-6 py-3 border border-rust text-rust rounded-md text-center hover:bg-rust hover:text-cream transition">Explore Galleries</a>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <div class="relative">
                        <div class="bg-sand p-6 rounded-lg shadow-lg transform rotate-3">
                            <img src="images/Art Gallery Exhibition.webp" alt="Art Gallery Exhibition" class="rounded w-full h-auto">
                        </div>
                        <div class="absolute -bottom-5 -left-5 bg-rust p-4 rounded-lg shadow-lg">
                            <p class="text-cream serif italic">"Art enables us to find ourselves and lose ourselves at the same time."</p>
                            <p class="text-cream text-sm mt-2">— Thomas Merton</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Artists/Artworks -->
    <section class="py-16 bg-cream">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Featured Masterpieces</h2>
                <p class="max-w-2xl mx-auto text-coffee">Experience some of the most influential artworks throughout history, showcasing the evolution of human creativity and expression.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Artwork 1 -->
                <div class="art-grid-item bg-sand rounded-lg overflow-hidden shadow-md">
                    <img src="images/Starry Night by Van Gogh.webp" alt="Starry Night by Van Gogh" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Starry Night</h3>
                        <p class="text-sm text-coffee mb-3">Vincent van Gogh, 1889</p>
                        <p class="text-sm">A night scene showing the swirling clouds, bright crescent moon and stars radiating with a luminescence that contrasts with the dark blue sky.</p>
                    </div>
                </div>

                <!-- Artwork 2 -->
                <div class="art-grid-item bg-sand rounded-lg overflow-hidden shadow-md">
                    <img src="images/Girl with a Pearl Earring by Vermeer.jpg" alt="Girl with a Pearl Earring by Vermeer" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Girl with a Pearl Earring</h3>
                        <p class="text-sm text-coffee mb-3">Johannes Vermeer, c. 1665</p>
                        <p class="text-sm">Often referred to as the "Mona Lisa of the North" or the "Dutch Mona Lisa", this portrait captures the gaze of a young woman wearing an exotic dress.</p>
                    </div>
                </div>

                <!-- Artwork 3 -->
                <div class="art-grid-item bg-sand rounded-lg overflow-hidden shadow-md">
                    <img src="images/The Persistence of Memory by Salvador Dalí.jpg" alt="The Persistence of Memory by Salvador Dalí" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">The Persistence of Memory</h3>
                        <p class="text-sm text-coffee mb-3">Salvador Dalí, 1931</p>
                        <p class="text-sm">One of the most recognizable works of Surrealism, featuring melting watches in a dreamlike landscape, questioning our rigid understanding of time.</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('artworks.all') }}" class="inline-flex items-center text-rust hover:text-coffee transition">
                    <span>Explore more masterpieces</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Arabic Art Quotes Section -->
    <section class="py-16 bg-terracotta bg-opacity-10">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">شعر وفن | Poetry and Art</h2>
                <p class="max-w-2xl mx-auto text-coffee">Experience the beauty of Arabic poetry about art and creativity.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <!-- Verse 1 -->
                <div class="flex flex-col items-center">
                    <div class="relative mb-6 w-full">
                        <img src="images/Arabic Calligraphy Art.webp" alt="Arabic Calligraphy Art" class="w-full h-64 object-cover rounded-lg shadow-lg">
                        <div class="absolute -bottom-4 -right-4 bg-cream p-4 rounded-lg shadow-lg">
                            <span class="text-3xl text-rust font-arabic">"</span>
                        </div>
                    </div>
                    <blockquote class="text-center mb-4">
                        <p class="text-xl font-medium italic font-arabic mb-2 leading-relaxed">الفنُ يرقى بالروحِ إلى السماءِ<br>ويُحلقُ بالخيالِ في الفضاءِ</p>
                        <p class="text-lg text-coffee">"Art elevates the soul to the heavens<br>And soars with imagination in space"</p>
                    </blockquote>
                </div>

                <!-- Verse 2 -->
                <div class="flex flex-col items-center">
                    <div class="relative mb-6 w-full">
                        <img src="images/arab.webp" alt="Arabic Calligraphy Art" class="w-full h-64 object-cover rounded-lg shadow-lg">
                        <div class="absolute -bottom-4 -right-4 bg-cream p-4 rounded-lg shadow-lg">
                            <span class="text-3xl text-rust font-arabic">"</span>
                        </div>
                    </div>
                    <blockquote class="text-center mb-4">
                        <p class="text-xl font-medium italic font-arabic mb-2 leading-relaxed">في كلِّ لوحةٍ حكايةٌ ترويها<br>وفي كلِّ لونٍ قصةٌ تُحييها</p>
                        <p class="text-lg text-coffee">"In every painting, a story it tells<br>In every color, a tale that dwells"</p>
                    </blockquote>
                </div>

                <!-- Verse 3 -->
                <div class="flex flex-col items-center">
                    <div class="relative mb-6 w-full">
                        <img src="images/n.jpg" alt="Arabic Calligraphy Art" class="w-full h-64 object-cover rounded-lg shadow-lg">
                        <div class="absolute -bottom-4 -right-4 bg-cream p-4 rounded-lg shadow-lg">
                            <span class="text-3xl text-rust font-arabic">"</span>
                        </div>
                    </div>
                    <blockquote class="text-center mb-4">
                        <p class="text-xl font-medium italic font-arabic mb-2 leading-relaxed">الفنُ هوَ الحياةُ في أبهى صورها<br>والجمالُ في أسمى معانيها</p>
                        <p class="text-lg text-coffee">"Art is life in its most beautiful form<br>And beauty in its highest meaning"</p>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <!-- Artistic Quotes Section -->
    <section class="py-16 bg-rust bg-opacity-15">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Words of Inspiration</h2>
                <p class="max-w-2xl mx-auto text-coffee">Throughout history, artists have shared profound insights about creativity and expression.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <!-- Quote 1 -->
                <div class="flex flex-col items-center">
                    <div class="relative mb-6">
                        <img src="images/Ralph Waldo Emerson.jpg" alt="Ralph Waldo Emerson" class="rounded-full w-44 h-44 object-cover border-4 border-sand">
                        <div class="quote-circle bg-cream absolute -bottom-4 -right-4 w-12 h-12 flex items-center justify-center">
                            <span class="text-2xl text-rust">"</span>
                        </div>
                    </div>
                    <blockquote class="text-center mb-4">
                        <p class="text-lg font-medium italic">"Every artist was first an amateur."</p>
                    </blockquote>
                    <cite class="text-rust font-medium">— Ralph Waldo Emerson</cite>
                </div>

                <!-- Quote 2 -->
                <div class="flex flex-col items-center">
                    <div class="relative mb-6">
                        <img src="images/Pablo Picasso.jpg" alt="Pablo Picasso" class="rounded-full w-44 h-44 object-cover border-4 border-sand">
                        <div class="quote-circle bg-cream absolute -bottom-4 -right-4 w-12 h-12 flex items-center justify-center">
                            <span class="text-2xl text-rust">"</span>
                        </div>
                    </div>
                    <blockquote class="text-center mb-4">
                        <p class="text-lg font-medium italic">"Art washes away from the soul the dust of everyday life."</p>
                    </blockquote>
                    <cite class="text-rust font-medium">— Pablo Picasso</cite>
                </div>

                <!-- Quote 3 -->
                <div class="flex flex-col items-center">
                    <div class="relative mb-6">
                        <img src="images/Henri Matisse.png" alt="Henri Matisse" class="rounded-full w-44 h-44 object-cover border-4 border-sand">
                        <div class="quote-circle bg-cream absolute -bottom-4 -right-4 w-12 h-12 flex items-center justify-center">
                            <span class="text-2xl text-rust">"</span>
                        </div>
                    </div>
                    <blockquote class="text-center mb-4">
                        <p class="text-lg font-medium italic">"Creativity takes courage."</p>
                    </blockquote>
                    <cite class="text-rust font-medium">— Henri Matisse</cite>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Spaces Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between mb-16">
                <div class="md:w-1/2 mb-10 md:mb-0 md:pr-12">
                    <h2 class="text-3xl font-bold mb-6">Experience Art in Virtual Galleries</h2>
                    <p class="mb-6">Discover curated collections in our virtual galleries, designed to showcase artistic diversity and provide immersive viewing experiences.</p>
                    <p class="mb-8">Each gallery offers a unique perspective on different artistic movements, techniques, and cultural expressions.</p>
                    <a href="{{ route('artworks.all') }}" class="px-6 py-3 bg-rust text-cream rounded-md inline-block hover:bg-coffee transition">Explore Galleries</a>
                </div>
                <div class="md:w-1/2">
                    <div class="grid grid-cols-2 gap-4">
                        <img src="images/Modern Art Gallery.jpg" alt="Modern Art Gallery" class="rounded-lg shadow-md w-full h-40 object-cover">
                        <img src="images/Contemporary Exhibition Space.jpg" alt="Contemporary Exhibition Space" class="rounded-lg shadow-md w-full h-40 object-cover mt-8">
                        <img src="images/Renaissance Collection.gif" alt="Renaissance Collection" class="rounded-lg shadow-md w-full h-40 object-cover">
                        <img src="images/Abstract Expressionism Room.jpg" alt="Abstract Expressionism Room" class="rounded-lg shadow-md w-full h-40 object-cover mt-8">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Workshops Teaser -->
    <section class="py-16 bg-sand">
        <div class="container mx-auto px-4">
            <div class="bg-cream rounded-lg shadow-lg p-8">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-2/3 md:pr-8 mb-8 md:mb-0">
                        <h2 class="text-3xl font-bold mb-4">Enhance Your Artistic Journey</h2>
                        <p class="mb-6">Join our interactive workshops led by established artists and educators. Whether you're a beginner or an experienced artist, our sessions offer valuable insights and techniques to elevate your craft.</p>
                        <div class="flex flex-wrap gap-3 mb-6">
                            <span class="px-3 py-1 bg-terracotta text-cream rounded-full text-sm">Oil Painting</span>
                            <span class="px-3 py-1 bg-terracotta text-cream rounded-full text-sm">Digital Art</span>
                            <span class="px-3 py-1 bg-terracotta text-cream rounded-full text-sm">Watercolor</span>
                            <span class="px-3 py-1 bg-terracotta text-cream rounded-full text-sm">Sculpture</span>
                            <span class="px-3 py-1 bg-terracotta text-cream rounded-full text-sm">Art History</span>
                        </div>
                        <a href="{{ route('workshops.index') }}" class="px-6 py-3 border border-rust text-rust rounded-md inline-block hover:bg-rust hover:text-cream transition">Browse Workshops</a>
                    </div>
                    <div class="md:w-1/3">
                        <img src="images/Art Workshop.jpg" alt="Art Workshop" class="rounded-lg shadow-md w-full">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Join Community CTA -->
    <section class="py-16 bg-rust text-cream">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">"Every artist was once a beginner"</h2>
            <p class="max-w-2xl mx-auto mb-10 text-lg">Join our growing community of artists and art enthusiasts. Create, share, learn, and connect with like-minded individuals passionate about artistic expression.</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('register') }}" class="px-6 py-3 bg-cream text-rust rounded-md font-medium hover:bg-sand transition">Create Account</a>
                <a href="{{ route('artists.all') }}" class="px-6 py-3 border border-cream text-cream rounded-md font-medium hover:bg-coffee hover:border-coffee transition">Learn More</a>
            </div>
        </div>
    </section>

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
                <p>&copy; 2025 YouArt. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // JavaScript for enhanced interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Animation for quotes
            const quotes = document.querySelectorAll('.quote-circle');
            quotes.forEach(quote => {
                quote.addEventListener('mouseenter', () => {
                    quote.style.transform = 'scale(1.1)';
                    quote.style.transition = 'transform 0.3s ease';
                });

                quote.addEventListener('mouseleave', () => {
                    quote.style.transform = 'scale(1)';
                });
            });

            // Mobile menu toggle
            const menuToggle = document.querySelector('.menu-toggle');
            const mobileMenu = document.querySelector('.mobile-menu');
            
            if (menuToggle && mobileMenu) {
                menuToggle.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>
