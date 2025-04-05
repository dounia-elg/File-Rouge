<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - YouArt</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Dashboard</h4>
                        <button id="logoutBtn" class="btn btn-danger">Logout</button>
                    </div>
                    <div class="card-body">
                        <h5>Welcome to YouArt!</h5>
                        <div id="error-message" class="alert alert-danger mt-3" style="display: none;"></div>
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
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            });

            $('#logoutBtn').click(function() {
                $.ajax({
                    url: '/api/logout',
                    type: 'POST',
                    success: function(response) {
                        // Clear the stored token
                        localStorage.removeItem('token');
                        
                        // Redirect to login page
                        window.location.href = '/login';
                    },
                    error: function(xhr) {
                        $('#error-message')
                            .html('Error logging out. Please try again.')
                            .show();
                    }
                });
            });
        });
    </script>
</body>
</html>