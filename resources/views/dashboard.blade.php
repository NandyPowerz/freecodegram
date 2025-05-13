<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Church Change Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            background: linear-gradient(to bottom, #3a4bc9, #2c3e50);
            min-height: 100vh;
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            margin-bottom: 0.5rem;
            border-radius: 0.3rem;
            padding: 0.75rem 1rem;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: rgba(255,255,255,0.1);
            color: white;
        }
        .sidebar .nav-link i {
            margin-right: 0.5rem;
        }
        .content-area {
            min-height: 100vh;
        }
        .card-stats {
            border-radius: 0.8rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }
        .card-stats:hover {
            transform: translateY(-5px);
        }
        .stat-icon {
            width: 3rem;
            height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.7rem;
        }
        .welcome-banner {
            background: linear-gradient(to right, #4e73df, #224abe);
            color: white;
            border-radius: 0.8rem;
        }
        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-auto px-0 sidebar">
            <div class="d-flex flex-column align-items-center align-items-sm-start pt-4 text-white min-vh-100">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 text-white text-decoration-none">
                    <img src="{{ asset('images/LOGO.jpg') }}" alt="Church Logo" width="40" height="40" class="rounded-circle me-2">
                    <span class="fs-5 d-none d-sm-inline">Universal Church</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start w-100 px-3" id="menu">
                    <li class="nav-item w-100">
                        <a href="#" class="nav-link active">
                            <i class="bi bi-speedometer2"></i> <span class="d-none d-sm-inline">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item w-100">
                        <a href="#" class="nav-link">
                            <i class="bi bi-people"></i> <span class="d-none d-sm-inline">Members</span>
                        </a>
                    </li>
                    <li class="nav-item w-100">
                        <a href="#" class="nav-link">
                            <i class="bi bi-calendar-event"></i> <span class="d-none d-sm-inline">Events</span>
                        </a>
                    </li>
                    <li class="nav-item w-100">
                        <a href="#" class="nav-link">
                            <i class="bi bi-house-door"></i> <span class="d-none d-sm-inline">Small Groups</span>
                        </a>
                    </li>
                    <li class="nav-item w-100">
                        <a href="#" class="nav-link">
                            <i class="bi bi-heart"></i> <span class="d-none d-sm-inline">Discipleship</span>
                        </a>
                    </li>
                    <li class="nav-item w-100">
                        <a href="#" class="nav-link">
                            <i class="bi bi-graph-up"></i> <span class="d-none d-sm-inline">Reports</span>
                        </a>
                    </li>
                    <li class="nav-item w-100">
                        <a href="#" class="nav-link">
                            <i class="bi bi-gear"></i> <span class="d-none d-sm-inline">Settings</span>
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown pb-4 px-3 w-100">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="rounded-circle bg-light text-dark d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px; font-weight: bold;">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="d-none d-sm-inline mx-1">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Sign out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Main Content Area -->
        <div class="col content-area p-4">
            <!-- Top Navigation Bar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4 rounded">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1">Dashboard</span>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="bi bi-bell"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="bi bi-envelope"></i></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">My Profile</a></li>
                                    <li><a class="dropdown-item" href="#">Account Settings</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-2').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form-2" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <!-- Welcome Banner -->
            <div class="welcome-banner p-4 mb-4">
                <h2>Welcome, {{ Auth::user()->name }}! 🙏</h2>
                <p class="mb-0">Let's manage your church community today. Here's what's happening this week.</p>
            </div>
            
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="stat-icon bg-primary-subtle text-primary me-3">
                                    <i class="bi bi-people-fill fs-4"></i>
                                </div>
                                <h5 class="card-title mb-0">Total Members</h5>
                            </div>
                            <h3 class="fw-bold">124</h3>
                            <div class="text-success small">
                                <i class="bi bi-arrow-up"></i> 5% from last month
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="stat-icon bg-success-subtle text-success me-3">
                                    <i class="bi bi-calendar-check fs-4"></i>
                                </div>
                                <h5 class="card-title mb-0">Upcoming Events</h5>
                            </div>
                            <h3 class="fw-bold">8</h3>
                            <div class="text-success small">
                                <i class="bi bi-calendar-week"></i> Next: Sunday Service
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="stat-icon bg-warning-subtle text-warning me-3">
                                    <i class="bi bi-person-plus fs-4"></i>
                                </div>
                                <h5 class="card-title mb-0">New Members</h5>
                            </div>
                            <h3 class="fw-bold">12</h3>
                            <div class="text-success small">
                                <i class="bi bi-arrow-up"></i> 8% from last month
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="stat-icon bg-info-subtle text-info me-3">
                                    <i class="bi bi-house-heart fs-4"></i>
                                </div>
                                <h5 class="card-title mb-0">Small Groups</h5>
                            </div>
                            <h3 class="fw-bold">15</h3>
                            <div class="text-success small">
                                <i class="bi bi-people"></i> 87 total participants
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Activity & Upcoming Events -->
            <div class="row">
                <div class="col-12 col-lg-7 mb-4">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">Recent Activity</h5>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="timeline-item pb-3 mb-3 border-bottom">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="bi bi-person-plus"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">New Member Registration</h6>
                                            <p class="mb-1">Sarah Johnson has joined the church community</p>
                                            <small class="text-muted">Today, 9:41 AM</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="timeline-item pb-3 mb-3 border-bottom">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="bi bi-calendar-event"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Youth Service Updated</h6>
                                            <p class="mb-1">Youth service schedule has been updated for next month</p>
                                            <small class="text-muted">Yesterday, 4:15 PM</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="timeline-item">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="bi bi-chat-dots"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Prayer Request</h6>
                                            <p class="mb-1">New prayer request from Michael Smith for his mother's health</p>
                                            <small class="text-muted">May 12, 10:30 AM</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-lg-5 mb-4">
                    <div class="card">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Upcoming Events</h5>
                            <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        <div class="card-body">
                            <div class="event-item pb-3 mb-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <div class="me-3 text-center">
                                        <div class="bg-light rounded p-2">
                                            <div class="text-primary fw-bold">16</div>
                                            <div class="small">May</div>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Sunday Worship Service</h6>
                                        <p class="mb-0 small text-muted"><i class="bi bi-clock me-1"></i> 10:00 AM - 12:00 PM</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="event-item pb-3 mb-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <div class="me-3 text-center">
                                        <div class="bg-light rounded p-2">
                                            <div class="text-primary fw-bold">18</div>
                                            <div class="small">May</div>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Bible Study</h6>
                                        <p class="mb-0 small text-muted"><i class="bi bi-clock me-1"></i> 7:00 PM - 8:30 PM</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="event-item">
                                <div class="d-flex align-items-center">
                                    <div class="me-3 text-center">
                                        <div class="bg-light rounded p-2">
                                            <div class="text-primary fw-bold">22</div>
                                            <div class="small">May</div>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Youth Fellowship</h6>
                                        <p class="mb-0 small text-muted"><i class="bi bi-clock me-1"></i> 5:00 PM - 7:00 PM</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>