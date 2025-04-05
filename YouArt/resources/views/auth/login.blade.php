<!DOCTYPE html>
<html>
<head>
    <title>Login - YouArt</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <div id="success-message" class="alert alert-success" style="display: none;"></div>
                        <div id="error-message" class="alert alert-danger" style="display: none;"></div>

                        <form id="loginForm">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#loginForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '/api/login',
                    type: 'POST',
                    data: {
                        email: $('#email').val(),
                        password: $('#password').val()
                    },
                    success: function(response) {
                        $('#error-message').hide();
                        $('#success-message')
                            .html('Login successful!')
                            .show();
                            
                        // Store the token
                        localStorage.setItem('token', response.token);
                        
                        // Redirect after successful login
                        setTimeout(function() {
                            window.location.href = '/dashboard';
                        }, 1000);
                    },
                    error: function(xhr) {
                        $('#success-message').hide();
                        $('#error-message')
                            .html(xhr.responseJSON.message)
                            .show();
                    }
                });
            });
        });
    </script>
</body>
</html>