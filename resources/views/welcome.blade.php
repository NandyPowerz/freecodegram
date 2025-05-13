<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Church Change Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e3f2fd, #f1f8e9);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .welcome-card {
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            padding: 0.75rem 2rem;
            font-size: 1.1rem;
        }
        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/LOGO.jpg') }}" alt="Church Logo" style="height: 60px; width: auto; object-fit: contain;">
                <strong>Universal Church</strong>
            </a>
            <div>
                <a href="{{ url('/login') }}" class="btn btn-outline-primary me-2">Login</a>
                <a href="{{ url('/register') }}" class="btn btn-primary">Register</a>
            </div>
        </div>
    </nav>

    <!-- Welcome Content -->
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="card text-center p-5 welcome-card bg-white">
            <h1 class="mb-3">⛪ Welcome to the UCKG</h1>
            <p class="lead" style="color: black; font-size: 20px;">Manage church transitions with grace, coordinate impactful events, 
                and warmly receive every new member through a system built for the body of Christ.</p>
            <div class="mt-4 d-flex justify-content-center gap-3">
                <a href="{{ url('/login') }}" class="btn btn-primary btn-custom">Login</a>
                <a href="{{ url('/register') }}" class="btn btn-outline-primary btn-custom">Register</a>
            </div>
        </div>
    </div>

</body>
</html>
