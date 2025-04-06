<!DOCTYPE html>
<html>
<head>
    <title>Register - YouArt</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        
        .login-link {
            color: #FF5252;
            text-decoration: none;
        }
        
        .form-input {
            background-color: rgba(255, 255, 255, 0.5);
            border: none;
            border-radius: 20px;
        }
        
        .role-button {
            border-radius: 20px;
            padding: 8px 20px;
            background-color: transparent;
            border: 1px solid white;
            color: black;
            font-weight: normal;
        }
        
        .role-button.active {
            background-color: white;
            color: black;
        }
        
        .create-button {
            background-color: white;
            color: black;
            border-radius: 20px;
            border: none;
            font-weight: bold;
        }
        
        select.form-input {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23000000' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
            padding-right: 2.5rem;
        }
        
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="min-h-screen w-full flex items-center justify-center bg-cover bg-center" style="background-image: url('{{ asset('images/register background.webp') }}');">
        <div class="container">
            <div class="p-8 bg-black bg-opacity-50 backdrop-filter backdrop-blur-sm text-center rounded-lg">
                <h2 class="text-3xl font-bold text-white mb-8">Join YouArt</h2>
                
                <!-- Role Selection Buttons -->
                <div class="flex justify-center gap-4 mb-6">
                    <button type="button" id="artist-btn" class="role-button active">Artist</button>
                    <button type="button" id="art-lover-btn" class="role-button">Art Lover</button>
                </div>
                
                @if ($errors->any())
                <div class="error mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-400 text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="form-group">
                        <input 
                            type="text" 
                            name="name" 
                            id="name"
                            value="{{ old('name') }}" 
                            placeholder="Your Name"
                            class="w-full py-2 px-4 form-input"
                            required
                        >
                    </div>
                    
                    <div class="form-group">
                        <input 
                            type="email" 
                            name="email"
                            id="email" 
                            value="{{ old('email') }}" 
                            placeholder="Your Email"
                            class="w-full py-2 px-4 form-input"
                            required
                        >
                    </div>
                    
                    <div class="form-group">
                        <input 
                            type="password" 
                            name="password"
                            id="password" 
                            placeholder="Your Password"
                            class="w-full py-2 px-4 form-input"
                            required
                        >
                    </div>
                    
                    <div class="form-group">
                        <input 
                            type="password" 
                            name="password_confirmation"
                            id="password_confirmation" 
                            placeholder="Confirm Password"
                            class="w-full py-2 px-4 form-input"
                            required
                        >
                    </div>
                    
                    <div class="form-group" style="display: none;">
                        <!-- Hidden but functional role select -->
                        <select name="role" id="role" class="form-input" required>
                            <option value="amateur">Amateur</option>
                            <option value="artist" selected>Artist</option>
                        </select>
                    </div>
                    
                    <div class="form-group flex items-center justify-start my-4">
                        <input type="checkbox" name="terms" id="terms" class="mr-2" required>
                        <label for="terms" class="text-white text-sm text-left">
                            I agree to the <a href="{{ route('terms') }}" class="text-red-400 hover:underline">Terms of Service</a> and <a href="{{ route('privacy') }}" class="text-red-400 hover:underline">Privacy Policy</a>
                        </label>
                    </div>
                    
                    <button type="submit" class="w-full py-2 create-button">
                        Create Account
                    </button>
                </form>
                
                <div class="mt-4 text-center text-sm text-white">
                    Already have an account? <a href="{{ route('login') }}" class="login-link">Login</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handle role selection
        const artistBtn = document.getElementById('artist-btn');
        const artLoverBtn = document.getElementById('art-lover-btn');
        const roleSelect = document.getElementById('role');
        
        artistBtn.addEventListener('click', function() {
            roleSelect.value = 'artist';
            artistBtn.classList.add('active');
            artLoverBtn.classList.remove('active');
        });
        
        artLoverBtn.addEventListener('click', function() {
            roleSelect.value = 'amateur';
            artLoverBtn.classList.add('active');
            artistBtn.classList.remove('active');
        });
    </script>
</body>
</html>