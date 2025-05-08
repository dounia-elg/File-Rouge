@extends('layouts.app')

@section('content')
<div class="bg-cream text-charcoal">
    <!-- Hero Section with Decorative Elements -->
    <section class="relative overflow-hidden">
        <div class="w-full h-80 bg-cover bg-center" style="background-image: url('{{ asset('images/t.jpg') }}');">

        </div>
    </section>

    <!-- Artist Profile Card -->
    <div class="container mx-auto px-4">
        <div class="bg-sand shadow-lg rounded-lg -mt-16 relative z-10 overflow-visible transform ">
            <div class="p-8">
                <div class="flex flex-col md:flex-row">
                    <!-- Profile Image with Decorative Frame -->
                    <div class="">

                        <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('images/default-profile.jpg') }}"
                             alt="{{ $user->name }}"
                             class="relative w-24 h-24 rounded-full border-4 border-cream shadow-lg">
                    </div>

                    <!-- Profile Details -->
                    <div class="md:ml-6 flex-grow">
                        <div class="flex flex-col md:flex-row justify-between">
                            <div>
                                <h2 class="text-3xl font-bold text-charcoal serif">{{ $user->name }}</h2>

                                <div class="flex mt-4 space-x-6">
                                    <div class="flex items-center">
                                        <div class="bg-cream p-2 rounded-full mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-terracotta" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <span class="text-sm text-coffee">{{ $user->location ?? 'Safi, Morocco' }}</span>
                                    </div>

                                    <div class="flex items-center">
                                        <div class="bg-cream p-2 rounded-full mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-terracotta" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                        <span class="text-sm text-coffee">{{ $user->followers ?? 0 }} followers</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Profile Button -->
                            <div class="mt-4 md:mt-0">
                                <a href="{{ route('artist.edit') }}" class="bg-rust text-cream px-6 py-2 rounded-full text-sm hover:bg-coffee transition transform hover:scale-105 inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    Edit Profile
                                </a>
                            </div>
                        </div>

                        <!-- Bio with Decorative Quote -->
                        <div class="mt-6 relative">
                            <div class="absolute -left-4 top-0 text-4xl text-terracotta/30 font-serif">"</div>
                            <div class="absolute -right-4 bottom-0 text-4xl text-terracotta/30 font-serif">"</div>
                            <p class="text-charcoal pl-6 pr-6 italic">{{ $user->bio ?? 'Every artist dips their brush in their own soul, and paints their own nature into their artworks. Share your unique perspective with the world through every stroke and creation.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- My Artworks Section -->
    <div class="mb-12  mt-16">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-charcoal serif">My Artworks</h2>
            </div>
            <a href="{{ route('artworks.create') }}" class="bg-rust text-cream px-6 py-2 rounded-full text-sm hover:bg-coffee transition transform hover:scale-105 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Artwork
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @if(count($artworks) > 0)
                @foreach($artworks as $artwork)
                    <div class="bg-white rounded-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-102 hover:shadow-lg">
                        <a href="{{ route('artworks.show', $artwork) }}" class="block relative h-44 overflow-hidden">
                            <img class="w-full h-full object-cover object-center transition-transform duration-500 hover:scale-110" 
                                 src="{{ asset('storage/' . $artwork->image_path) }}" alt="{{ $artwork->title }}">
                        </a>
                        <div class="p-4">
                            <h3 class="text-lg font-playfair text-charcoal mb-1 line-clamp-1">{{ $artwork->title }}</h3>
                            <p class="text-sm text-coffee mt-2">${{ number_format($artwork->price, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-3 bg-sand border border-cream rounded-lg p-12 text-center">
                    <div class="w-24 h-24 mx-auto mb-6 bg-cream rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-terracotta" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h4 class="text-2xl font-medium text-charcoal serif">No artworks yet</h4>
                    <p class="mt-2 text-coffee">Start your artistic journey by adding your first masterpiece</p>
                    <a href="{{ route('artworks.create') }}" class="mt-6 inline-block bg-rust text-cream px-6 py-2 rounded-full text-sm hover:bg-coffee transition transform hover:scale-105">
                        Create Your First Artwork
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Performance Statistics -->
    <div class="container mx-auto px-4 py-12">
        <div class="bg-sand rounded-lg shadow-lg p-8 transform  mb-12">
            <h2 class="text-2xl font-bold mb-8 text-charcoal serif">Your Creative Journey</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="flex items-center">
                    <div class="mr-4 bg-cream p-4 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-terracotta" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-coffee">Total Artworks</p>
                        <p class="text-2xl font-bold text-charcoal">{{ count($artworks) }}</p>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="mr-4 bg-cream p-4 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-terracotta" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-coffee">Sold Artworks</p>
                        <p class="text-2xl font-bold text-charcoal">{{ $artworks->where('is_sold', true)->count() }}</p>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="mr-4 bg-cream p-4 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-terracotta" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-coffee">Total Views</p>
                        <p class="text-2xl font-bold text-charcoal">{{ $artworks->sum('views') }}</p>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="mr-4 bg-cream p-4 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-terracotta" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-coffee">Total Earnings</p>
                        <p class="text-2xl font-bold text-charcoal">${{ number_format($artworks->where('is_sold', true)->sum('price'), 2) }}</p>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Followed Artists -->
    <div class="container mx-auto px-4 py-12">
        <div class="w-full max-w-6xl mx-auto">
            <h2 class="text-2xl font-bold mb-4 text-left serif text-charcoal">Artists You Follow</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @forelse($followedArtists as $artist)
                    <div class="bg-white rounded-xl shadow-md p-4 flex flex-col items-center border border-cream art-grid-item">
                        <img src="{{ $artist->profile_image ? asset('storage/' . $artist->profile_image) : asset('images/default-profile.jpg') }}" alt="{{ $artist->name }}" class="w-20 h-20 rounded-full object-cover mb-3 border-4 border-sand">
                        <h3 class="text-lg font-semibold serif text-charcoal mb-1">{{ $artist->name }}</h3>
                        @if($artist->location)
                            <p class="text-coffee text-sm mb-1">{{ $artist->location }}</p>
                        @endif
                        @if($artist->bio)
                            <p class="text-coffee text-xs mb-2 line-clamp-2 text-center">{{ $artist->bio }}</p>
                        @endif
                        <a href="{{ route('artist.profile', ['id' => $artist->id]) }}" class="mt-2 px-4 py-2 bg-rust text-cream rounded hover:bg-coffee transition text-sm">View Profile</a>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-coffee">You are not following any artists yet.</div>
                @endforelse
            </div>
        </div>
    </div>

</div>

<style>
    .art-grid-item {
        transition: transform 0.3s ease;
    }

    .art-grid-item:hover {
        transform: scale(1.03);
    }

    h1, h2, h3, .serif {
        font-family: 'Playfair Display', serif;
    }
</style>

<script>
    // JavaScript for enhanced interactivity
    document.addEventListener('DOMContentLoaded', function() {
        // Dropdown toggle functionality
        const dropdownButtons = document.querySelectorAll('.dropdown button');
        dropdownButtons.forEach(button => {
            button.addEventListener('click', () => {
                const dropdown = button.nextElementSibling;
                dropdown.classList.toggle('hidden');
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!event.target.closest('.dropdown')) {
                document.querySelectorAll('.dropdown div').forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
            }
        });
    });
</script>
@endsection
