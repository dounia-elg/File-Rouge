<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Space</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

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
                    <img src="{{ auth()->user()->profile_photo 
                        ? Storage::url('profile-photos/' . auth()->user()->profile_photo) 
                        : asset('images/default-profile.jpg') }}" 
                         alt="Profile Photo" 
                         class="w-32 h-32 rounded-full object-cover border-4 border-white">
                </div>

                <!-- Artist Details -->
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-2xl font-bold">{{ auth()->user()->name }}</h1>
                            <p class="text-gray-500">{{ auth()->user()->location ?? 'Location (Not specified)' }}</p>
                        </div>
                        <button onclick="openEditModal()" 
                                class="bg-black text-white px-6 py-2 rounded-full hover:bg-gray-800">
                            Edit Profile
                        </button>
                    </div>
                    <p class="mt-4 text-gray-600">{{ auth()->user()->bio ?? 'No bio yet...' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div id="editProfileModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 w-96">
            <h2 class="text-xl font-bold mb-4">Edit Profile</h2>
            
            <form action="{{ route('artist.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Name</label>
                    <input type="text" 
                           name="name" 
                           value="{{ auth()->user()->name }}" 
                           class="w-full px-3 py-2 border rounded-lg"
                           required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Location</label>
                    <input type="text" 
                           name="location" 
                           value="{{ auth()->user()->location }}" 
                           class="w-full px-3 py-2 border rounded-lg">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Bio</label>
                    <textarea name="bio" 
                              rows="4" 
                              class="w-full px-3 py-2 border rounded-lg">{{ auth()->user()->bio }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Profile Photo</label>
                    <input type="file" 
                           name="profile_photo" 
                           accept="image/*" 
                           class="w-full px-3 py-2 border rounded-lg">
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" 
                            onclick="closeEditModal()" 
                            class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal() {
            document.getElementById('editProfileModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editProfileModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('editProfileModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
    </script>
</body>
</html>