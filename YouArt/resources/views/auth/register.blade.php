<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - YouArt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-cover bg-center font-sans" style="background-image: url('{{ asset('images/register background.webp') }}');">

    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-black bg-opacity-40 backdrop-blur-sm rounded-2xl px-10 py-8 w-full max-w-md">
            <h2 class="text-3xl font-semibold text-center text-gray-900 mb-6">Join YouArt</h2>

            <!-- Role Buttons -->
            <div class="flex justify-center gap-4 mb-6">
                <button type="button" id="artist-btn" class="border border-white bg-white text-black px-5 py-2 rounded-full font-medium active">Artist</button>
                <button type="button" id="art-lover-btn" class="border border-white text-black px-5 py-2 rounded-full font-medium">Art Lover</button>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 text-red-600 text-sm px-4 py-2 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name" class="w-full px-4 py-2 bg-white bg-opacity-60 rounded-full focus:outline-none" required>

                <input type="email" name="email" value="{{ old('email') }}" placeholder="Your Email" class="w-full px-4 py-2 bg-white bg-opacity-60 rounded-full focus:outline-none" required>

                <input type="password" name="password" placeholder="Your Password" class="w-full px-4 py-2 bg-white bg-opacity-60 rounded-full focus:outline-none" required>

                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full px-4 py-2 bg-white bg-opacity-60 rounded-full focus:outline-none" required>

                <select name="role" id="role" class="hidden">
                    <option value="amateur">Amateur</option>
                    <option value="artist" selected>Artist</option>
                </select>

                <div class="flex items-start gap-2 text-sm text-gray-700">
                    <input type="checkbox" name="terms" id="terms" class="mt-1" required>
                    <label for="terms">I agree to the <a href="{{ route('terms') }}" class="text-red-500 underline">Terms of Service</a> and <a href="{{ route('privacy') }}" class="text-red-500 underline">Privacy Policy</a>.</label>
                </div>

                <button type="submit" class="w-full bg-white text-black font-bold py-2 rounded-full hover:bg-gray-200 transition">Create Account</button>
            </form>

            <p class="mt-4 text-center text-sm text-gray-700">
                Already have an account? <a href="{{ route('login') }}" class="text-red-500 hover:underline">Login</a>
            </p>
        </div>
    </div>

    <script>
        const artistBtn = document.getElementById('artist-btn');
        const artLoverBtn = document.getElementById('art-lover-btn');
        const roleSelect = document.getElementById('role');

        artistBtn.addEventListener('click', () => {
            roleSelect.value = 'artist';
            artistBtn.classList.add('bg-white');
            artLoverBtn.classList.remove('bg-white');
        });

        artLoverBtn.addEventListener('click', () => {
            roleSelect.value = 'amateur';
            artLoverBtn.classList.add('bg-white');
            artistBtn.classList.remove('bg-white');
        });
    </script>

</body>
</html>
