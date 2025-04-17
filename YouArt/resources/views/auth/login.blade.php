<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - YouArt</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen w-screen bg-cover bg-center" style="background-image: url('{{ asset('images/login.jpg') }}');">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-black bg-opacity-70 p-8 rounded-lg shadow-xl w-full max-w-md mx-4 text-center">
            <h2 class="text-white text-2xl font-bold mb-6">Welcome back</h2>
            
            @if (session('error'))
                <div class="bg-red-500 text-white p-3 rounded-lg mb-4">
                    {{ session('error') }}
                </div>
            @endif
            
            @if ($errors->any())
                <div class="bg-red-500 text-white p-3 rounded-lg mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Your Email" required
                           class="w-full px-4 py-2 rounded-full bg-white bg-opacity-20 text-white placeholder-white focus:outline-none">
                </div>
                
                <div>
                    <input type="password" name="password" placeholder="Your Password" required
                           class="w-full px-4 py-2 rounded-full bg-white bg-opacity-20 text-white placeholder-white focus:outline-none">
                </div>
                
                <button type="submit" class="w-full bg-white text-black font-bold py-2 px-4 rounded-full hover:bg-gray-200 focus:outline-none">
                    Login
                </button>
            </form>
            
            <div class="mt-6 text-white text-sm">
                Don't have an account? <a href="{{ route('register') }}" class="text-red-400 hover:underline">Register</a>
            </div>

            <div class="mt-4">
                <a href="{{ route('home') }}" class="text-white text-sm hover:underline">Back to home</a>
            </div>
        </div>
    </div>
</body>
</html> 