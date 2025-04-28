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
                        burgundy: '#5D0B1A',
                        darkBurgundy: '#3D0812',
                        gold: '#D4AF37',
                        goldLight: '#F2E394',
                        cream: '#F5F0E1',
                        dark: '#1A0000'
                    },
                    fontFamily: {
                        display: ['Playfair Display', 'serif'],
                        sans: ['Montserrat', 'sans-serif'],
                        script: ['Cormorant Garamond', 'serif'],
                    },
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=Montserrat:wght@200;300;400;500&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #3D0812;
            color: #F5F0E1;
            overflow-x: hidden;
        }
        .font-display {
            font-family: 'Playfair Display', serif;
        }
        .font-script {
            font-family: 'Cormorant Garamond', serif;
        }
        .ornate-frame {
            position: relative;
        }
        .ornate-frame::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            background-image: url('https://i.imgur.com/R7oCxPW.png');
            background-size: 100% 100%;
            background-repeat: no-repeat;
            opacity: 0.8;
            z-index: -1;
        }
        .gold-border {
            border: 1px solid #D4AF37;
            box-shadow: 0 0 15px rgba(212, 175, 55, 0.2);
        }
        .gold-divider {
            position: relative;
            height: 1px;
            background: linear-gradient(90deg, transparent, #D4AF37, transparent);
        }
        .gold-divider::before, .gold-divider::after {
            content: '✦';
            position: absolute;
            top: -10px;
            color: #D4AF37;
            font-size: 16px;
        }
        .gold-divider::before {
            left: calc(50% - 40px);
        }
        .gold-divider::after {
            right: calc(50% - 40px);
        }
        .decorative-corner {
            position: absolute;
            width: 24px;
            height: 24px;
            background-image: url('https://i.imgur.com/JV4zeSA.png');
            background-size: contain;
            background-repeat: no-repeat;
        }
        .top-left {
            top: 0;
            left: 0;
            transform: rotate(0deg);
        }
        .top-right {
            top: 0;
            right: 0;
            transform: rotate(90deg);
        }
        .bottom-left {
            bottom: 0;
            left: 0;
            transform: rotate(270deg);
        }
        .bottom-right {
            bottom: 0;
            right: 0;
            transform: rotate(180deg);
        }
        .art-piece {
            transition: transform 0.7s ease, box-shadow 0.7s ease;
        }
        .art-piece:hover {
            transform: scale(1.03);
            box-shadow: 0 0 20px rgba(212, 175, 55, 0.3);
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
            background-color: #5D0B1A;
            border: 1px solid #D4AF37;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #D4AF37;
            font-weight: bold;
            z-index: 10;
        }
    </style>
    </head>
<body class="bg-darkBurgundy text-cream min-h-screen">
    <!-- Minimal Header -->
    <header class="fixed w-full z-50 bg-darkBurgundy bg-opacity-90 backdrop-blur-md">
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

    <!-- Hero Title Section - Russian Style -->
    <section class="pt-36 pb-16 px-6 bg-burgundy relative overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image: url('https://i.imgur.com/8CEfJwL.png'); background-repeat: repeat;"></div>
        <div class="max-w-6xl mx-auto relative">
            <div class="text-center mb-10">
                <h1 class="font-display text-4xl md:text-6xl font-bold text-gold leading-tight mb-4">Искусство сквозь века</h1>
                <p class="font-script text-xl text-cream italic">Art Through the Ages</p>
                <div class="gold-divider w-48 mx-auto my-6"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="relative gold-border p-1 bg-darkBurgundy">
                        <div class="decorative-corner top-left"></div>
                        <div class="decorative-corner top-right"></div>
                        <div class="decorative-corner bottom-left"></div>
                        <div class="decorative-corner bottom-right"></div>
                        <img src="https://images.unsplash.com/photo-1513364776144-60967b0f800f?ixlib=rb-1.2.1&auto=format&fit=crop&w=2070&q=80" alt="Classical Masterpiece" class="w-full h-96 object-cover">
                    </div>
                </div>
                <div class="text-center md:text-left">
                    <p class="font-script text-xl text-goldLight italic mb-8">"Прекрасное пленяет навсегда"</p>
                    <p class="text-sm text-cream mb-6 max-w-md">Discover the profound beauty of classical art masters through our curated collection spanning centuries of human creativity and expression.</p>
                    <a href="#exhibitions" class="inline-block px-6 py-2 border border-gold text-gold text-sm tracking-widest hover:bg-gold hover:text-darkBurgundy transition duration-300">Explore</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Numbered Exhibition Section -->
    <section id="exhibitions" class="py-20 px-6 relative">
        <div class="absolute inset-0 opacity-5" style="background-image: url('https://i.imgur.com/8CEfJwL.png'); background-repeat: repeat;"></div>
        <div class="max-w-6xl mx-auto relative">
            <div class="text-center mb-16">
                <h2 class="font-display text-3xl text-gold">Выставки</h2>
                <p class="font-script text-cream">Exhibitions</p>
                <div class="gold-divider w-24 mx-auto my-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Exhibition 1 -->
                <div class="numbered-item">
                    <div class="item-number">01</div>
                    <div class="gold-border p-1 bg-burgundy">
                        <img src="https://images.unsplash.com/photo-1579783483458-83d02161294e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1056&q=80" alt="Art Exhibition" class="w-full h-72 object-cover">
                        <div class="p-4">
                            <h3 class="font-display text-xl text-gold mb-2">Русская классика</h3>
                            <p class="text-xs text-cream mb-2">The masterpieces of Russian classical art reveal the soul of a nation through landscapes, portraits, and historical scenes.</p>
                            <p class="text-xs text-goldLight">До 30 сентября</p>
                        </div>
                    </div>
                </div>

                <!-- Exhibition 2 -->
                <div class="numbered-item mt-20 md:mt-0">
                    <div class="item-number">02</div>
                    <div class="gold-border p-1 bg-burgundy">
                        <img src="https://images.unsplash.com/photo-1578926288207-32356a2b8838?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" alt="Abstract Art" class="w-full h-72 object-cover">
                        <div class="p-4">
                            <h3 class="font-display text-xl text-gold mb-2">Абстрактные видения</h3>
                            <p class="text-xs text-cream mb-2">When form dissolves, emotion emerges. Experience the revolutionary power of abstraction.</p>
                            <p class="text-xs text-goldLight">Открытие 15 октября</p>
                        </div>
                    </div>
                </div>

                <!-- Arabic Quote Float -->
                <div class="rtl col-span-1 md:col-span-2 my-12 text-center float">
                    <p class="font-script text-xl text-gold italic">
                        "الفن هو الجمال الذي يخلقه الإنسان"
                    </p>
                    <p class="text-xs text-goldLight mt-2">- Art is the beauty created by humans</p>
                </div>

                <!-- Exhibition 3 -->
                <div class="numbered-item">
                    <div class="item-number">03</div>
                    <div class="gold-border p-1 bg-burgundy">
                        <img src="https://images.unsplash.com/photo-1545989253-02cc26577f88?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Sculpture" class="w-full h-72 object-cover">
                        <div class="p-4">
                            <h3 class="font-display text-xl text-gold mb-2">Скульптурные формы</h3>
                            <p class="text-xs text-cream mb-2">The three-dimensional art that invites you to experience beauty from every angle.</p>
                            <p class="text-xs text-goldLight">Постоянная экспозиция</p>
                        </div>
                    </div>
                </div>

                <!-- Exhibition 4 -->
                <div class="numbered-item mt-20 md:mt-0">
                    <div class="item-number">04</div>
                    <div class="gold-border p-1 bg-burgundy">
                        <img src="https://images.unsplash.com/photo-1547891654-e66ed7ebb968?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" alt="Portrait" class="w-full h-72 object-cover">
                        <div class="p-4">
                            <h3 class="font-display text-xl text-gold mb-2">Портреты эпохи</h3>
                            <p class="text-xs text-cream mb-2">Faces that tell stories of their time, capturing personalities across centuries.</p>
                            <p class="text-xs text-goldLight">Ноябрь - Декабрь</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Artist with Ornate Frame -->
    <section class="py-20 px-6 bg-burgundy relative">
        <div class="absolute inset-0 opacity-10" style="background-image: url('https://i.imgur.com/8CEfJwL.png'); background-repeat: repeat;"></div>
        <div class="max-w-6xl mx-auto relative">
            <div class="text-center mb-16">
                <h2 class="font-display text-3xl text-gold">Великие мастера</h2>
                <p class="font-script text-cream">Great Masters</p>
                <div class="gold-divider w-28 mx-auto my-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-16 items-center">
                <div class="text-center md:text-right order-2 md:order-1">
                    <h3 class="font-display text-2xl text-gold mb-4">Иван Иванович Шишкин</h3>
                    <p class="font-script text-sm text-goldLight italic mb-6">1832 - 1898</p>
                    <p class="text-sm text-cream mb-6">
                        Known as the "Forest Tsar" for his magnificent depictions of the Russian wilderness, Shishkin's meticulous attention to botanical detail and mastery of light created landscapes of unparalleled realism and emotional depth.
                    </p>
                    <a href="#" class="text-xs text-gold border-b border-gold pb-1 hover:text-cream hover:border-cream transition duration-300">Explore works</a>
                </div>

                <div class="ornate-frame p-8 order-1 md:order-2">
                    <img src="https://i.imgur.com/Qkbx9gq.jpg" alt="Ivan Shishkin" class="w-56 h-56 object-cover rounded-full border-2 border-gold mx-auto">
                </div>

                <div class="ornate-frame p-8 order-3">
                    <img src="https://i.imgur.com/5xF2KGs.jpg" alt="Ivan Aivazovsky" class="w-56 h-56 object-cover rounded-full border-2 border-gold mx-auto">
                </div>

                <div class="text-center md:text-left order-4">
                    <h3 class="font-display text-2xl text-gold mb-4">Иван Константинович Айвазовский</h3>
                    <p class="font-script text-sm text-goldLight italic mb-6">1817 - 1900</p>
                    <p class="text-sm text-cream mb-6">
                        The premier marine artist of his time, Aivazovsky created over 6,000 paintings of exceptional emotional power. His depictions of stormy seas and tranquil waters reveal both the terrifying grandeur and serene beauty of nature.
                    </p>
                    <a href="#" class="text-xs text-gold border-b border-gold pb-1 hover:text-cream hover:border-cream transition duration-300">Explore works</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section with Decorative Elements -->
    <section class="py-20 px-6 relative">
        <div class="absolute inset-0 opacity-5" style="background-image: url('https://i.imgur.com/8CEfJwL.png'); background-repeat: repeat;"></div>
        <div class="max-w-6xl mx-auto relative">
            <div class="text-center mb-16">
                <h2 class="font-display text-3xl text-gold">Галерея шедевров</h2>
                <p class="font-script text-cream">Masterpiece Gallery</p>
                <div class="gold-divider w-32 mx-auto my-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="gold-border p-1 bg-burgundy art-piece">
                    <img src="https://i.imgur.com/sCG2Dcw.jpg" alt="Russian Art" class="w-full h-72 object-cover">
                    <div class="p-4">
                        <p class="text-xs text-goldLight">Василий Поленов</p>
                        <h3 class="font-display text-lg text-gold mt-1">Московский дворик</h3>
                        <p class="text-xs text-cream mt-2">1878, Oil on canvas</p>
                    </div>
                </div>

                <div class="gold-border p-1 bg-burgundy art-piece">
                    <img src="https://i.imgur.com/JzR5Xzm.jpg" alt="Russian Art" class="w-full h-72 object-cover">
                    <div class="p-4">
                        <p class="text-xs text-goldLight">Исаак Левитан</p>
                        <h3 class="font-display text-lg text-gold mt-1">Над вечным покоем</h3>
                        <p class="text-xs text-cream mt-2">1894, Oil on canvas</p>
                    </div>
                </div>

                <div class="gold-border p-1 bg-burgundy art-piece">
                    <img src="https://i.imgur.com/vA8mAQY.jpg" alt="Russian Art" class="w-full h-72 object-cover">
                    <div class="p-4">
                        <p class="text-xs text-goldLight">Виктор Васнецов</p>
                        <h3 class="font-display text-lg text-gold mt-1">Богатыри</h3>
                        <p class="text-xs text-cream mt-2">1898, Oil on canvas</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Workshop Section with Russian Aesthetic -->
    <section class="py-20 px-6 bg-burgundy relative">
        <div class="absolute inset-0 opacity-10" style="background-image: url('https://i.imgur.com/8CEfJwL.png'); background-repeat: repeat;"></div>
        <div class="max-w-6xl mx-auto relative">
            <div class="text-center mb-16">
                <h2 class="font-display text-3xl text-gold">Мастер-классы</h2>
                <p class="font-script text-cream">Workshops</p>
                <div class="gold-divider w-24 mx-auto my-4"></div>
            </div>
            
            @if(isset($featuredWorkshops) && $featuredWorkshops->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($featuredWorkshops as $workshop)
                        <div class="gold-border p-1 bg-darkBurgundy art-piece">
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
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 gold-border bg-darkBurgundy p-6">
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

    <!-- Registration Section with Ornate Elements -->
    <section class="py-32 px-6 relative">
        <div class="absolute inset-0 opacity-5" style="background-image: url('https://i.imgur.com/8CEfJwL.png'); background-repeat: repeat;"></div>
        <div class="max-w-4xl mx-auto relative">
            <div class="gold-border p-8 bg-burgundy">
                <div class="decorative-corner top-left"></div>
                <div class="decorative-corner top-right"></div>
                <div class="decorative-corner bottom-left"></div>
                <div class="decorative-corner bottom-right"></div>
                
                <div class="text-center">
                    <h2 class="font-display text-3xl text-gold mb-4">Присоединяйтесь к нам</h2>
                    <p class="font-script text-goldLight italic mb-8">Join Our Creative Community</p>
                    <p class="text-sm text-cream mb-8 max-w-lg mx-auto">Become part of our growing family of artists and enthusiasts exploring the vast world of creative expression throughout human history.</p>
                    <a href="{{ route('register') }}" class="inline-block px-8 py-3 bg-gold text-darkBurgundy text-sm font-medium tracking-widest hover:bg-cream transition duration-300">Register Now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer with Russian Style -->
    <footer class="py-16 px-6 bg-darkBurgundy border-t border-gold/30">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div>
                    <a href="{{ route('home') }}" class="text-2xl font-display font-light tracking-widest text-gold mb-6 inline-block">You<span class="text-goldLight">Art</span></a>
                    <p class="text-cream text-sm mb-6 font-script italic">"Art washes away from the soul the dust of everyday life." — Pablo Picasso</p>
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
                <p class="text-gold font-script text-lg">Спасибо за внимание!</p>
                <p class="text-xs text-cream mt-2">Thank you for your attention</p>
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
            
            document.querySelectorAll('.art-piece:not(.fade-in), .numbered-item').forEach(item => {
                observer.observe(item);
            });
        });
    </script>
</body>
</html>
