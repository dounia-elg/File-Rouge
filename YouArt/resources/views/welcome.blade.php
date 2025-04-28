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
                        burgundy: '#220207',
                        darkBurgundy: '#1A0105',
                        gold: '#D4AF37',
                        goldLight: '#E5C56E',
                        cream: '#F5F0E1',
                        beige: '#E8E1D4'
                    },
                    fontFamily: {
                        display: ['Playfair Display', 'serif'],
                        sans: ['Montserrat', 'sans-serif'],
                        script: ['Cormorant Garamond', 'serif'],
                        arabic: ['Noto Naskh Arabic', 'serif'],
                        chinese: ['"Noto Serif SC"', 'serif'],
                        cyrillic: ['"Noto Serif"', 'serif'],
                    },
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=Montserrat:wght@200;300;400;500&family=Noto+Naskh+Arabic:wght@400;500;600&family=Noto+Serif+SC:wght@400;500;600&family=Noto+Serif:wght@400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #1A0105;
            color: #F5F0E1;
            overflow-x: hidden;
        }
        .font-display {
            font-family: 'Playfair Display', serif;
        }
        .font-script {
            font-family: 'Cormorant Garamond', serif;
        }
        .font-arabic {
            font-family: 'Noto Naskh Arabic', serif;
            direction: rtl;
        }
        .font-chinese {
            font-family: 'Noto Serif SC', serif;
        }
        .font-cyrillic {
            font-family: 'Noto Serif', serif;
        }
        .gold-border {
            border: 2px solid #D4AF37;
            box-shadow: 0 0 20px rgba(212, 175, 55, 0.2);
        }
        .gold-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #D4AF37, transparent);
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
            background-color: #D4AF37;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .numbered-item {
            position: relative;
        }
        .item-number {
            font-family: 'Playfair Display', serif;
            position: absolute;
            top: -15px;
            left: -15px;
            width: 40px;
            height: 40px;
            background-color: #220207;
            border: 2px solid #D4AF37;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #D4AF37;
            font-weight: bold;
            z-index: 10;
        }
        .workshop-item {
            transition: transform 0.3s ease;
        }
        .workshop-item:hover {
            transform: translateY(-5px);
        }
        .slide-bg {
            background-color: #150002;
        }
        .card-item {
            background-color: #150002;
        }
        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.9);
        }
        .art-card {
            transform: rotate(var(--rotate, 0deg));
            transition: all 0.5s ease;
        }
        .art-card:hover {
            transform: rotate(0deg) scale(1.02);
            z-index: 10;
            box-shadow: 0 0 30px rgba(212, 175, 55, 0.3);
        }
        .quote-card {
            position: relative;
            overflow: hidden;
        }
        .quote-card::before {
            content: '"';
            position: absolute;
            font-size: 15rem;
            opacity: 0.05;
            font-family: 'Playfair Display', serif;
            top: -4rem;
            left: -2rem;
        }
        .scattered-layout {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            grid-auto-rows: minmax(100px, auto);
            gap: 20px;
        }
        .art-tools {
            background-image: url('https://images.unsplash.com/photo-1574180566232-aaad1b5b8450?ixlib=rb-1.2.1&auto=format&fit=crop&w=1074&q=80');
            background-size: cover;
            background-position: center;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 1.2s ease forwards;
            opacity: 0;
        }
        .animation-delay-300 {
            animation-delay: 300ms;
        }
        .animation-delay-600 {
            animation-delay: 600ms;
        }
        .animation-delay-900 {
            animation-delay: 900ms;
        }
    </style>
    </head>
<body class="bg-darkBurgundy text-cream min-h-screen">
    <!-- Minimal Header -->
    <header class="fixed w-full z-50 bg-darkBurgundy bg-opacity-90 backdrop-blur-md border-b border-gold/20">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-display font-light tracking-widest text-gold">You<span class="text-goldLight">Art</span></a>
            <nav class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" class="nav-link text-sm text-cream font-light hover:text-gold">Home</a>
                <a href="#" class="nav-link text-sm text-cream font-light hover:text-gold">Exhibitions</a>
                <a href="#" class="nav-link text-sm text-cream font-light hover:text-gold">Collections</a>
                <a href="{{ route('workshops.index') }}" class="nav-link text-sm text-cream font-light hover:text-gold">Workshops</a>
                @auth
                    @if(Auth::user()->role === 'artist')
                        <a href="{{ route('artist.space') }}" class="nav-link text-sm text-cream font-light hover:text-gold">Artist Space</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="nav-link text-sm text-cream font-light hover:text-gold bg-transparent border-0">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link text-sm text-cream font-light hover:text-gold">Login</a>
                    <a href="{{ route('register') }}" class="nav-link text-sm text-gold font-light hover:text-cream">Register</a>
                @endauth
            </nav>
            <button class="md:hidden text-cream focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </header>

    <!-- Hero Section with Multilingual Welcome -->
    <section class="pt-36 pb-16 px-6 bg-burgundy relative overflow-hidden">
        <div class="images/Art Texture.png" alt="Art Texture" class="w-full h-full object-cover">
        </div>
        <div class="max-w-6xl mx-auto relative z-10">
            <div class="text-center mb-16 animate-fade-in">
                <h1 class="font-display text-5xl md:text-7xl font-bold text-gold leading-tight mb-4 text-shadow">YouArt</h1>
                <p class="font-script text-xl text-cream italic mb-4">A journey through the world of artistic expression</p>
                <div class="gold-divider w-48 mx-auto my-6"></div>

                <!-- Multilingual Welcome Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                    <div class="quote-card card-item gold-border p-6 animate-fade-in animation-delay-300">
                        <p class="font-arabic text-xl text-gold mb-2">أهلاً بكم في عالم الفن</p>
                        <p class="text-xs text-cream">Welcome to the world of art (Arabic)</p>
                    </div>

                    <div class="quote-card card-item gold-border p-6 animate-fade-in animation-delay-600">
                        <p class="font-chinese text-xl text-gold mb-2">欢迎来到艺术世界</p>
                        <p class="text-xs text-cream">Welcome to the world of art (Chinese)</p>
                    </div>

                    <div class="quote-card card-item gold-border p-6 animate-fade-in animation-delay-900">
                        <p class="font-cyrillic text-xl text-gold mb-2">Добро пожаловать в мир искусства</p>
                        <p class="text-xs text-cream">Welcome to the world of art (Russian)</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                <div class="md:col-span-5">
                    <div class="gold-border p-1 bg-darkBurgundy art-card" style="--rotate: -2deg">
                        <img src="images/the ninth wave by ivan aivazovsky.jpg" alt="The Ninth Wave by Aivazovsky" class="w-full h-96 object-cover">
                        <div class="p-3 bg-darkBurgundy">
                            <p class="text-xs text-goldLight">Ivan Aivazovsky - The Ninth Wave (1850)</p>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-7 text-center md:text-left">
                    <p class="font-script text-2xl text-goldLight italic mb-8">"Art is not what you see, but what you make others see."</p>
                    <p class="text-xs text-gold mb-2">— Edgar Degas</p>
                    <p class="text-sm text-cream mb-6">
                        Explore the profound beauty of classical masterpieces, contemporary expressions, and the historical journey of human creativity. Through brushstrokes, sculptures, and visual narratives, discover how art has shaped our understanding of beauty and meaning across civilizations.
                    </p>
                    <a href="#exhibitions" class="inline-block px-6 py-2 border border-gold text-gold text-sm tracking-widest hover:bg-gold hover:text-darkBurgundy transition duration-300">Begin Journey</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Artistic Quote Section -->
    <section class="py-16 px-6 relative bg-darkBurgundy">
        <div class="max-w-6xl mx-auto">
            <div class="quote-card card-item gold-border p-8 text-center">
                <p class="font-script text-2xl text-goldLight italic mb-4">"الفن هو الجمال الذي يعيش في القلب"</p>
                <p class="text-sm text-cream mb-4">Art is beauty that lives in the heart</p>
                <div class="gold-divider w-24 mx-auto"></div>
            </div>
        </div>
    </section>

    <!-- Exhibition Section with Scattered Layout -->
    <section id="exhibitions" class="py-20 px-6 relative bg-burgundy">
        <div class="absolute inset-0 bg-[url('https://i.imgur.com/1KkCtZZ.jpg')] opacity-5 bg-fixed bg-center bg-cover"></div>
        <div class="max-w-6xl mx-auto relative z-10">
            <div class="text-center mb-16">
                <h2 class="font-display text-3xl text-gold text-shadow">Classical Masters</h2>
                <p class="font-script text-cream">Timeless Exhibitions</p>
                <div class="gold-divider w-24 mx-auto my-4"></div>
            </div>

            <div class="scattered-layout">
                <!-- Exhibition 1 -->
                <div class="col-span-6 md:col-span-5 row-span-2 art-card" style="--rotate: 1deg">
                    <div class="gold-border p-1">
                        <img src="images/Moscow Courtyard.jpg" alt="Moscow Courtyard" class="w-full h-full object-cover">
                        <div class="p-4 bg-darkBurgundy bg-opacity-95">
                            <h3 class="font-display text-xl text-gold mb-2">Poetic Landscapes</h3>
                            <p class="text-xs text-cream mb-2">The beauty of nature captured through the eyes of the Russian masters, revealing the soul of a nation through landscapes.</p>
                            <p class="text-xs text-goldLight">Featured Artist: Vasily Polenov</p>
                        </div>
                    </div>
                </div>

                <!-- Historical Context Card -->
                <div class="col-span-6 md:col-span-7 quote-card card-item gold-border p-6" style="--rotate: -1deg">
                    <h3 class="font-display text-xl text-gold mb-3">The Golden Age of Russian Painting</h3>
                    <p class="text-sm text-cream mb-4">The 19th century marked the golden age of Russian painting, with artists skillfully capturing the essence of Russian life and nature. Moving beyond academic constraints, these artists sought to represent the nation's soul through depictions of everyday landscapes, common people, and historical scenes.</p>
                    <p class="font-script text-goldLight italic">"The landscape is not merely a visual spectacle but a reflection of the artist's spiritual connection to their homeland."</p>
                </div>

                <!-- Exhibition 2 -->
                <div class="col-span-6 md:col-span-6 row-span-2 art-card" style="--rotate: -1.5deg">
                    <div class="gold-border p-1">
                        <img src="images/Bogatyrs.jpg" alt="Bogatyrs" class="w-full h-full object-cover">
                        <div class="p-4 bg-darkBurgundy bg-opacity-95">
                            <h3 class="font-display text-xl text-gold mb-2">Legends & Folklore</h3>
                            <p class="text-xs text-cream mb-2">Mythical heroes and legendary tales brought to life through the artistic vision of masters who preserved Russian cultural heritage.</p>
                            <p class="text-xs text-goldLight">Featured Artist: Viktor Vasnetsov</p>
                        </div>
                    </div>
                </div>

                <!-- Exhibition 3 -->
                <div class="col-span-6 md:col-span-6 row-span-2 art-card" style="--rotate: 2deg">
                    <div class="gold-border p-1">
                        <img src="images/Above Eternal Rest.jpg" alt="Above Eternal Rest" class="w-full h-full object-cover">
                        <div class="p-4 bg-darkBurgundy bg-opacity-95">
                            <h3 class="font-display text-xl text-gold mb-2">Spiritual Landscapes</h3>
                            <p class="text-xs text-cream mb-2">Contemplative visions of nature that transcend mere representation, inviting viewers to experience profound emotional and spiritual depths.</p>
                            <p class="text-xs text-goldLight">Featured Artist: Isaac Levitan</p>
                        </div>
                    </div>
                </div>

                <!-- Tools of the Masters Card -->
                <div class="col-span-12 md:col-span-5 art-tools gold-border p-8 flex items-end">
                    <div class="bg-darkBurgundy bg-opacity-80 p-4 gold-border">
                        <h3 class="font-display text-xl text-gold mb-2">Tools of the Masters</h3>
                        <p class="text-xs text-cream">Behind every masterpiece lies the artist's intimate relationship with their tools—handcrafted brushes, pigments ground from minerals and plants, and canvases prepared with traditional techniques passed down through generations.</p>
                    </div>
                </div>

                <!-- Multilingual Quote -->
                <div class="col-span-12 md:col-span-7 quote-card card-item gold-border p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="font-cyrillic text-lg text-gold mb-2">"Искусство — это отражение души человека на холсте времени."</p>
                            <p class="text-xs text-cream mb-4">Art is the reflection of the human soul on the canvas of time. (Russian)</p>
                        </div>
                        <div>
                            <p class="font-arabic text-lg text-gold text-right mb-2">"الفن هو أعلى تعبير عن الحضارة"</p>
                            <p class="text-xs text-cream text-right">Art is the highest expression of civilization. (Arabic)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Artist Section - Museum Style -->
    <section class="py-20 px-6 bg-darkBurgundy relative">
        <div class="absolute inset-0 bg-[url('https://i.imgur.com/zfvOda1.jpg')] opacity-5 bg-fixed bg-center bg-cover"></div>
        <div class="max-w-6xl mx-auto relative z-10">
            <div class="text-center mb-16">
                <h2 class="font-display text-3xl text-gold text-shadow">Великие мастера</h2>
                <p class="font-script text-cream">Great Masters</p>
                <div class="gold-divider w-28 mx-auto my-4"></div>
            </div>

            <!-- Ivan Shishkin Museum Card -->
            <div class="card-item gold-border p-1 mb-16">
                <div class="bg-darkBurgundy p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                        <div class="md:col-span-3">
                            <img src="images/Ivan Shishkin.jpg" alt="Ivan Shishkin" class="w-full gold-border">
                            <p class="text-xs text-goldLight text-center mt-2">Portrait of Ivan Shishkin</p>
                        </div>

                        <div class="md:col-span-5">
                            <h3 class="font-display text-2xl text-gold mb-2">Ivan Shishkin</h3>
                            <p class="font-script text-sm text-goldLight italic mb-4">1832 - 1898</p>
                            <div class="gold-divider w-16 my-4"></div>
                            <p class="text-sm text-cream mb-6">
                                Known as "The Forest Tsar," Ivan Shishkin is one of Russia's most beloved landscape painters. His extraordinary attention to detail and technical mastery allowed him to capture the Russian wilderness with unparalleled accuracy and emotional depth.
                            </p>
                            <p class="text-sm text-cream mb-6">
                                Having studied at the Moscow School of Painting and the St. Petersburg Imperial Academy of Arts, Shishkin dedicated his life to depicting the majestic beauty of Russian forests. His works are characterized by photographic precision, yet they transcend mere reproduction, revealing his profound spiritual connection to nature.
                            </p>
                            <div class="font-script text-goldLight italic">
                                "To walk into a Shishkin landscape is to be embraced by the soul of Russia itself."
                            </div>
                        </div>

                        <div class="md:col-span-4">
                            <div class="gold-border p-1 mb-4">
                                <img src="images/Morning in a Pine Forest.jpg" alt="Morning in a Pine Forest" class="w-full">
                            </div>
                            <p class="text-xs text-goldLight text-center italic mb-6">Morning in a Pine Forest, 1889</p>

                            <div class="gold-border p-1">
                                <img src="images/Rye.jpg" alt="Rye" class="w-full">
                            </div>
                            <p class="text-xs text-goldLight text-center italic">Rye, 1878</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ivan Aivazovsky Museum Card -->
            <div class="card-item gold-border p-1">
                <div class="bg-darkBurgundy p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                        <div class="md:col-span-3 order-1">
                            <img src="images/Ivan Aivazovsky.jpg" alt="Ivan Aivazovsky" class="w-full gold-border">
                            <p class="text-xs text-goldLight text-center mt-2">Portrait of Ivan Aivazovsky</p>
                        </div>

                        <div class="md:col-span-5 order-2">
                            <h3 class="font-display text-2xl text-gold mb-2">Ivan Aivazovsky</h3>
                            <p class="font-script text-sm text-goldLight italic mb-4">1817 - 1900</p>
                            <div class="gold-divider w-16 my-4"></div>
                            <p class="text-sm text-cream mb-6">
                                Ivan Aivazovsky, a prominent Russian Romantic painter, is considered one of the greatest marine artists in history. With an extraordinary memory and exceptional talent, he created over 6,000 paintings during his lifetime, most depicting the sea in various moods and conditions.
                            </p>
                            <p class="text-sm text-cream mb-6">
                                Born to an Armenian family in Feodosia, Crimea, Aivazovsky studied at the Imperial Academy of Arts in St. Petersburg. His technical brilliance allowed him to capture the translucent quality of water and the play of light on waves with remarkable authenticity, often painting from memory rather than from direct observation.
                            </p>
                            <div class="font-script text-goldLight italic">
                                <p class="font-arabic text-right">"البحر هو حياتي"</p>
                                <p class="text-xs text-cream text-right">"The sea is my life"</p>
                            </div>
                        </div>

                        <div class="md:col-span-4 order-3">
                            <div class="gold-border p-1 mb-4">
                                <img src="images/The Ninth Wave.jpg" alt="The Ninth Wave" class="w-full">
                            </div>
                            <p class="text-xs text-goldLight text-center italic mb-6">The Ninth Wave, 1850</p>

                            <div class="gold-border p-1">
                                <img src="images/Storm on the Sea at Night.jpg" alt="Storm on the Sea at Night" class="w-full">
                            </div>
                            <p class="text-xs text-goldLight text-center italic">Storm on the Sea at Night, 1849</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Art Tools & Techniques Interlude -->
    <section class="py-12 px-6 relative bg-burgundy">
        <div class="max-w-6xl mx-auto">
            <div class="scattered-layout">
                <div class="col-span-12 md:col-span-5 card-item gold-border p-6 quote-card">
                    <h3 class="font-display text-xl text-gold mb-3">أدوات الفنان</h3>
                    <p class="text-xs text-cream mb-2">The Artist's Tools</p>
                    <p class="text-sm text-cream">
                        Behind every masterpiece lies the artist's intimate relationship with their tools. From handcrafted brushes to pigments ground from rare minerals, these instruments translate vision into reality.
                    </p>
                </div>

                <div class="col-span-12 md:col-span-7">
                    <div class="gold-border p-1">
                        <img src="images/tools.jpg" alt="Artist Tools" class="w-full h-48 object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Masterpiece Gallery Section - Museum Style -->
    <section class="py-20 px-6 relative bg-darkBurgundy">
        <div class="absolute inset-0 bg-[url('https://i.imgur.com/tsnDt7p.jpg')] opacity-5 bg-fixed bg-center bg-cover"></div>
        <div class="max-w-6xl mx-auto relative z-10">
            <div class="text-center mb-16">
                <h2 class="font-display text-3xl text-gold text-shadow">معرض التحف الفنية</h2>
                <p class="font-script text-cream">Masterpiece Gallery</p>
                <div class="gold-divider w-32 mx-auto my-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                <!-- Gallery Introduction -->
                <div class="md:col-span-12 quote-card card-item gold-border p-6 mb-8">
                    <p class="font-script text-xl text-goldLight italic text-center">
                        "Every painting is a voyage into a sacred harbor." — Giotto di Bondone
                    </p>
                </div>

                <!-- Artwork 1 with Description -->
                <div class="md:col-span-8 card-item gold-border p-1 art-card" style="--rotate: -1deg">
                    <img src="images/5_deYoungOpen_GarySexton_10_2_20_UPDATED-1024x683.webp" alt="The Rooks Have Come Back" class="w-full object-cover">
                    <div class="p-4 bg-darkBurgundy">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-display text-xl text-gold">The Rooks Have Come Back</h3>
                                <p class="text-xs text-goldLight">Alexei Savrasov, 1871</p>
                            </div>
                            <div class="text-xs text-cream text-right">
                                <p>Oil on canvas</p>
                                <p>62 × 48.5 cm</p>
                            </div>
                        </div>
                        <div class="gold-divider w-full my-3"></div>
                        <p class="text-sm text-cream">
                            A humble yet profoundly moving depiction of early spring in Russia, this painting marks a turning point in Russian landscape art. Through the simple scene of rooks returning to their nests, Savrasov created what critic Pavel Tretyakov called "the very soul of Russia."
                        </p>
                    </div>
                </div>

                <!-- Artwork Quote -->
                <div class="md:col-span-4 quote-card card-item gold-border p-6 flex flex-col justify-center">
                    <p class="font-chinese text-xl text-gold mb-2">艺术是灵魂的语言</p>
                    <p class="text-xs text-cream mb-6">Art is the language of the soul (Chinese)</p>

                    <p class="font-script text-lg text-goldLight italic">
                        "In nature's simple forms lie profound truths about our existence."
                    </p>
                    <p class="text-xs text-cream text-right mt-2">— Alexei Savrasov</p>
                </div>

                <!-- Artwork 2 with Description -->
                <div class="md:col-span-6 card-item gold-border p-1 art-card" style="--rotate: 1deg">
                    <img src="images/R.jpg" alt="Moonlit Night on the Dnieper" class="w-full object-cover">
                    <div class="p-4 bg-darkBurgundy">
                        <h3 class="font-display text-lg text-gold">Moonlit Night on the Dnieper</h3>
                        <p class="text-xs text-goldLight mb-2">Arkhip Kuindzhi, 1880</p>
                        <p class="text-xs text-cream">
                            Revolutionary in its use of light, this nocturne painting created a sensation when first exhibited. Using innovative techniques, Kuindzhi achieved an almost luminous quality in his depiction of moonlight reflected on water.
                        </p>
                    </div>
                </div>

                <!-- Artwork 3 with Description -->
                <div class="md:col-span-6 card-item gold-border p-1 art-card" style="--rotate: -1deg">
                    <img src="images/screenshot 2023-06-22 142237__73629.original.png" alt="The Rainbow" class="w-full object-cover">
                    <div class="p-4 bg-darkBurgundy">
                        <h3 class="font-display text-lg text-gold">The Rainbow</h3>
                        <p class="text-xs text-goldLight mb-2">Ivan Shishkin, 1865</p>
                        <p class="text-xs text-cream">
                            This early work by Shishkin already demonstrates his impressive ability to render the Russian landscape with both scientific precision and poetic sensibility. The rainbow creates a symbolic bridge between heaven and earth.
                        </p>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <!-- Exhibition Spaces Interlude -->
    <section class="py-12 px-6 relative bg-burgundy">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="gold-border p-1">
                    <img src="images/Art Exhibition.jpg" alt="Art Exhibition" class="w-full h-64 object-cover">
                </div>
                <div class="quote-card card-item gold-border p-6 flex flex-col justify-center">
                    <p class="font-cyrillic text-xl text-gold mb-2">Выставочные пространства</p>
                    <p class="text-xs text-cream mb-2">Exhibition Spaces</p>
                    <p class="text-sm text-cream">
                        The white walls of the gallery create a sacred space where art and viewer can engage in intimate dialogue, free from the distractions of the outside world.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Workshop Section - Artistic Style -->
    <section class="py-20 px-6 bg-darkBurgundy relative">
        <div class="absolute inset-0 bg-[url('https://i.imgur.com/1KkCtZZ.jpg')] opacity-5 bg-fixed bg-center bg-cover"></div>
        <div class="max-w-6xl mx-auto relative z-10">
            <div class="text-center mb-16">
                <h2 class="font-display text-3xl text-gold text-shadow">ورش العمل الفنية</h2>
                <p class="font-script text-cream">Artistic Workshops</p>
                <div class="gold-divider w-24 mx-auto my-4"></div>
            </div>

            @if(isset($featuredWorkshops) && $featuredWorkshops->count() > 0)
                <div class="scattered-layout">
                    @foreach($featuredWorkshops as $index => $workshop)
                        <div class="col-span-12 md:col-span-4 art-card" style="--rotate: {{ ($index % 3) - 1 }}deg">
                            <div class="card-item gold-border p-1 workshop-item h-full">
                                <div class="relative">
                                    @if($workshop->video_thumbnail)
                                        <img src="{{ $workshop->video_thumbnail }}" alt="{{ $workshop->title }}" class="w-full h-56 object-cover">
                                    @elseif($workshop->thumbnail_image)
                                        <img src="{{ asset('storage/' . $workshop->thumbnail_image) }}" alt="{{ $workshop->title }}" class="w-full h-56 object-cover">
                                    @else
                                        <div class="w-full h-56 bg-darkBurgundy flex items-center justify-center">
                                            <i class="fas fa-paint-brush text-4xl text-gold opacity-30"></i>
                                        </div>
                                    @endif

                                    <div class="absolute bottom-2 right-2 bg-darkBurgundy bg-opacity-80 text-gold px-2 py-1 text-xs border border-gold">
                                        {{ $workshop->formatted_duration }}
                                    </div>
                                </div>

                                <div class="p-4">
                                    <h3 class="font-display text-lg text-gold mb-2">{{ $workshop->title }}</h3>
                                    <p class="text-xs text-cream mb-4 line-clamp-2">{{ $workshop->description }}</p>

                                    <div class="flex justify-between items-center text-xs text-goldLight mb-4">
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
                                        <span class="text-xs
                                            {{ $workshop->skill_level == 'beginner' ? 'text-green-300' :
                                            ($workshop->skill_level == 'intermediate' ? 'text-blue-300' : 'text-purple-300') }}">
                                            {{ ucfirst($workshop->skill_level) }}
                                        </span>
                                        <a href="{{ route('workshops.show', $workshop) }}" class="text-gold text-xs hover:text-cream transition-colors flex items-center">
                                            Watch now
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 card-item gold-border p-6">
                    <p class="font-script text-xl text-gold italic mb-2">No featured workshops available at the moment.</p>
                    <p class="text-xs text-cream">New artistic journeys coming soon.</p>
                </div>
            @endif

            <div class="text-center mt-12">
                <a href="{{ route('workshops.index') }}" class="inline-block px-6 py-2 border border-gold text-gold text-sm tracking-widest hover:bg-gold hover:text-darkBurgundy transition duration-300">
                    View All Workshops
                </a>
            </div>
        </div>
    </section>

    <!-- Multilingual Art Appreciation -->
    <section class="py-16 px-6 relative bg-burgundy">
        <div class="max-w-6xl mx-auto">
            <div class="scattered-layout">
                <div class="col-span-12 md:col-span-4 quote-card card-item gold-border p-6">
                    <p class="font-arabic text-xl text-gold text-right mb-2">الفن يتجاوز حدود اللغة</p>
                    <p class="text-xs text-cream text-right">Art transcends the boundaries of language (Arabic)</p>
                </div>

                <div class="col-span-12 md:col-span-4 quote-card card-item gold-border p-6">
                    <p class="font-chinese text-xl text-gold mb-2">艺术是人类共同的语言</p>
                    <p class="text-xs text-cream">Art is humanity's common language (Chinese)</p>
                </div>

                <div class="col-span-12 md:col-span-4 quote-card card-item gold-border p-6">
                    <p class="font-cyrillic text-xl text-gold mb-2">Искусство объединяет нас всех</p>
                    <p class="text-xs text-cream">Art unites us all (Russian)</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Registration Section -->
    <section class="py-32 px-6 relative bg-darkBurgundy">
        <div class="absolute inset-0 bg-[url('https://i.imgur.com/Y3wBnHS.jpg')] opacity-10 bg-fixed bg-center bg-cover"></div>
        <div class="max-w-4xl mx-auto relative z-10">
            <div class="card-item gold-border p-8">
                <div class="text-center">
                    <h2 class="font-display text-3xl text-gold mb-4 text-shadow">Join Our Artistic Community</h2>
                    <p class="font-script text-goldLight italic mb-8">انضم إلى مجتمعنا الفني</p>
                    <p class="text-sm text-cream mb-8 max-w-lg mx-auto">Become part of our global family of artists and enthusiasts exploring the vast world of creative expression throughout human history.</p>
                    <a href="{{ route('register') }}" class="inline-block px-8 py-3 bg-gold text-darkBurgundy text-sm font-medium tracking-widest hover:bg-cream transition duration-300">Register Now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-16 px-6 bg-darkBurgundy border-t border-gold/30">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div>
                    <a href="{{ route('home') }}" class="text-2xl font-display font-light tracking-widest text-gold mb-6 inline-block">You<span class="text-goldLight">Art</span></a>
                    <p class="text-cream text-sm mb-6 font-script italic">"The purpose of art is washing the dust of daily life off our souls." — Pablo Picasso</p>
                    <p class="text-goldLight text-xs">© {{ date('Y') }} YouArt. All rights reserved.</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium mb-6 uppercase tracking-wider text-gold">Navigation</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-cream text-sm hover:text-gold transition duration-300">Home</a></li>
                        <li><a href="#" class="text-cream text-sm hover:text-gold transition duration-300">Exhibitions</a></li>
                        <li><a href="#" class="text-cream text-sm hover:text-gold transition duration-300">Collections</a></li>
                        <li><a href="{{ route('workshops.index') }}" class="text-cream text-sm hover:text-gold transition duration-300">Workshops</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-medium mb-6 uppercase tracking-wider text-gold">Legal</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('terms') }}" class="text-cream text-sm hover:text-gold transition duration-300">Terms of Service</a></li>
                        <li><a href="{{ route('privacy') }}" class="text-cream text-sm hover:text-gold transition duration-300">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="gold-divider w-full mt-12 mb-8"></div>

            <div class="text-center">
                <p class="font-arabic text-gold text-lg">"الفن يجعل الحياة جميلة"</p>
                <p class="text-xs text-cream">Art makes life beautiful</p>
            </div>
        </div>
    </footer>

    <script>
        // Animation for art cards on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            document.querySelectorAll('.art-card').forEach(card => {
                observer.observe(card);
            });
        });
    </script>
</body>
</html>
