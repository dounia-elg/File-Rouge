<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - YouArt</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen w-screen bg-cover bg-center" style="background-image: url('{{ asset('images/register background.webp') }}');">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-black bg-opacity-70 p-8 rounded-lg shadow-xl w-full max-w-md mx-4 text-center">
            <h2 class="text-white text-2xl font-bold mb-6">Join YouArt</h2>
            
            @if ($errors->any())
                <div class="bg-red-500 text-white p-3 rounded-lg mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="mb-6">
                <div class="flex justify-center mb-4">
                    <button type="button" id="artist-btn" class="bg-white text-black py-2 px-4 rounded-l-full focus:outline-none artist-active">
                        Artist
                    </button>
                    <button type="button" id="art-lover-btn" class="bg-gray-300 text-gray-700 py-2 px-4 rounded-r-full focus:outline-none">
                        Art Lover
                    </button>
                </div>
            </div>
            
            <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" id="role" name="role" value="artist">
                
                <div>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name" 
                           class="w-full px-4 py-2 rounded-full bg-white bg-opacity-20 text-white placeholder-white focus:outline-none">
                </div>
                
                <div>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Your Email" 
                           class="w-full px-4 py-2 rounded-full bg-white bg-opacity-20 text-white placeholder-white focus:outline-none">
                </div>
                
                <div>
                    <input type="password" name="password" placeholder="Your Password" 
                           class="w-full px-4 py-2 rounded-full bg-white bg-opacity-20 text-white placeholder-white focus:outline-none">
                </div>
                
                <div class="flex items-center mt-4">
                    <input type="checkbox" name="terms" id="terms" class="mr-2">
                    <label for="terms" class="text-white text-sm">
                        I agree to the <a href="{{ route('terms') }}" class="text-red-400 hover:underline">Terms and Conditions</a>
                    </label>
                </div>
                
                <button type="submit" class="w-full bg-white text-black font-bold py-2 px-4 rounded-full hover:bg-gray-200 focus:outline-none">
                    Create Account
                </button>
            </form>
            
            <div class="mt-6 text-white text-sm">
                Already have an account? <a href="{{ route('login') }}" class="text-red-400 hover:underline">Login</a>
            </div>
        </div>
    </div>
    
    <script>
        // Role selector functionality
        const artistBtn = document.getElementById('artist-btn');
        const artLoverBtn = document.getElementById('art-lover-btn');
        const roleInput = document.getElementById('role');
        
        artistBtn.addEventListener('click', () => {
            artistBtn.classList.add('bg-white', 'text-black');
            artistBtn.classList.remove('bg-gray-300', 'text-gray-700');
            artLoverBtn.classList.add('bg-gray-300', 'text-gray-700');
            artLoverBtn.classList.remove('bg-white', 'text-black');
            roleInput.value = 'artist';
        });
        
        artLoverBtn.addEventListener('click', () => {
            artLoverBtn.classList.add('bg-white', 'text-black');
            artLoverBtn.classList.remove('bg-gray-300', 'text-gray-700');
            artistBtn.classList.add('bg-gray-300', 'text-gray-700');
            artistBtn.classList.remove('bg-white', 'text-black');
            roleInput.value = 'art_lover';
        });
    </script>
</body>
</html> 