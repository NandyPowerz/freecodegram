<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Church Change Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e3f2fd, #f1f8e9);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .form-card {
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            padding: 0.75rem 2rem;
            font-weight: 500;
        }
        .form-label {
            font-weight: 500;
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

    <!-- Login Form -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card form-card bg-white p-4">
                    <div class="text-center mb-4">
                        <h2>⛪ Welcome Back</h2>
                        <p class="text-muted">Sign in to access the church management system</p>
                    </div>
                    
                    <form method="POST" action="{{ route('login.submit') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-custom py-2">
                                Login
                            </button>
                        </div>
                        
                        <div class="text-center mt-3">
                            <p>Don't have an account?? <a href="{{ route('register') }}" class="text-decoration-none">Register here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>