<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - YouArt</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen w-screen bg-cover bg-center flex items-center justify-center" style="background-image: url('images/login.jpg');">

    <div class="absolute top-5 right-10 text-white">
        <a href="/" class="text-sm hover:underline">Back to Home</a>
    </div>

    <div class="bg-black bg-opacity-70 text-white p-8 rounded-2xl shadow-xl w-full max-w-md text-center">
        <h2 class="text-2xl font-semibold mb-6">Welcome back</h2>

        <div id="success-message" class="hidden bg-green-500 text-white px-4 py-2 rounded mb-4"></div>
        <div id="error-message" class="hidden bg-red-500 text-white px-4 py-2 rounded mb-4"></div>

        <form id="loginForm" class="space-y-4">
            <input type="email" id="email" name="email" placeholder="Your Email" required
                   class="w-full px-4 py-2 rounded-full bg-white bg-opacity-20 text-white placeholder-white outline-none focus:ring-2 focus:ring-white">

            <input type="password" id="password" name="password" placeholder="Your Password" required
                   class="w-full px-4 py-2 rounded-full bg-white bg-opacity-20 text-white placeholder-white outline-none focus:ring-2 focus:ring-white">

            <button type="submit"
                    class="w-full bg-white text-black font-semibold py-2 rounded-full hover:bg-gray-200 transition">
                Login
            </button>
        </form>

        <p class="mt-4 text-sm text-white">Don't have an account? <a href="/register" class="text-red-400 hover:underline">Sign up</a></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#loginForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: '/api/login',
                    type: 'POST',
                    data: {
                        email: $('#email').val(),
                        password: $('#password').val()
                    },
                    success: function (response) {
                        $('#error-message').hide();
                        $('#success-message')
                            .text('Login successful!')
                            .removeClass('hidden');

                        localStorage.setItem('token', response.token);

                        setTimeout(function () {
                            window.location.href = '/dashboard';
                        }, 1000);
                    },
                    error: function (xhr) {
                        $('#success-message').hide();
                        $('#error-message')
                            .text(xhr.responseJSON.message)
                            .removeClass('hidden');
                    }
                });
            });
        });
    </script>
</body>
</html>
