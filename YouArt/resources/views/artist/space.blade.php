<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Space</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Hero Section -->
    <div class="relative h-64">
        <img src="{{ asset('images/default-hero.jpg') }}" 
             alt="Hero Image" 
             class="w-full h-full object-cover">
    </div>

    <!-- Artist Info Section -->
    <div class="max-w-4xl mx-auto -mt-16 relative px-4">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <!-- Profile Info -->
            <div class="flex items-start gap-6">
                <!-- Profile Photo -->
                <div class="relative">
                    <img src="{{ asset('images/default-profile.jpg') }}" 
                         alt="Profile Photo" 
                         class="w-32 h-32 rounded-full object-cover border-4 border-white">
                    <button class="absolute bottom-0 right-0 bg-gray-100 p-2 rounded-full shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </button>
                </div>

                <!-- Artist Details -->
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-2xl font-bold">Artist Name</h1>
                            <p class="text-gray-500">Location (Not specified)</p>
                            <p class="mt-2">0 Followers</p>
                        </div>
                        <button class="bg-black text-white px-6 py-2 rounded-full hover:bg-gray-800">
                            Edit Profile
                        </button>
                    </div>
                    <p class="mt-4 text-gray-600">No bio yet...</p>
                </div>
            </div>
        </div>

        <!-- Artworks Section -->
        <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold">My Artworks</h2>
                <button class="bg-black text-white px-6 py-2 rounded-full hover:bg-gray-800">
                    Add Artwork
                </button>
            </div>

            <!-- Artworks Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div class="text-center text-gray-500 py-12">
                    No artworks yet. Click "Add Artwork" to get started!
                </div>
            </div>
        </div>
    </div>
</body>
</html>