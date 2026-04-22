<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - {{ config('app.name') }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #ffffff;
            color: #000000;
            padding-top: 20px;
            border-right: 1px solid #eeeeee;
        }
        .sidebar .nav-link {
            color: #444444;
            padding: 12px 20px;
            border-left: 4px solid transparent;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s ease;
        }
        .sidebar .nav-link:hover {
            color: #000000;
            background-color: #f8f9fa;
        }
        .sidebar .nav-link.active {
            color: #000000;
            background-color: #f0f0f0;
            border-left-color: #000000;
            font-weight: 600;
        }
        .sidebar .nav-link i {
            width: 20px;
            font-size: 1.1rem;
        }
        .main-content {
            background-color: #fafafa;
        }
        .navbar-admin {
            background-color: white;
            border-bottom: 1px solid #eee;
            padding: 1rem 1.5rem;
        }
        .playfair {
            font-family: 'Fragment Mono', monospace !important;
            letter-spacing: -1px;
        }
    </style>
    @stack('css')
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse shadow">
            <div class="position-sticky">
                <div class="text-center mb-4">
                    @php
                        $logo = \App\Models\Setting::where('key', 'logo')->first();
                    @endphp
                    @if($logo && $logo->value)
                        <img src="{{ asset($logo->value) }}" alt="Logo" style="max-width: 180px; height: auto; object-fit: contain;">
                    @else
                        <img src="{{ asset('assets/branding/signature_tech.png') }}" alt="Saiful Signature" style="max-width: 150px; filter: grayscale(1) contrast(1.2);">
                    @endif
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}" href="{{ route('admin.projects.index') }}">
                            <i class="fas fa-project-diagram"></i> Projects
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}" href="{{ route('admin.skills.index') }}">
                            <i class="fas fa-tools"></i> Skills
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.hobbies.*') ? 'active' : '' }}" href="{{ route('admin.hobbies.index') }}">
                            <i class="fas fa-heart"></i> Hobbies
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}" href="{{ route('admin.messages.index') }}">
                            <i class="fas fa-envelope"></i> Messages
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                    </li>
                   
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom navbar-admin px-3">
                <h1 class="h2 playfair">@yield('page_title', 'Dashboard')</h1>
                <div class="d-flex align-items-center gap-3">
                    <!-- Maintenance Status Badge -->
                    @php 
                        $isMaint = \App\Models\Setting::where('key', 'is_maintenance')->first()?->value ?? '0';
                    @endphp
                    @if($isMaint == '1')
                        <span class="badge bg-danger text-white p-2" title="Site is currently in Maintenance Mode">
                            <i class="fas fa-hammer me-1"></i> MAINTENANCE ON
                        </span>
                    @endif

                    <!-- Clear Cache -->
                    <a href="{{ route('admin.clear-cache') }}" class="btn btn-sm btn-outline-danger" title="Clear System Cache">
                        <i class="fas fa-broom"></i>
                    </a>

                    <!-- Quick Add -->
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-plus me-1"></i> Quick Add
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                            <li><a class="dropdown-item" href="{{ route('admin.projects.create') }}"><i class="fas fa-project-diagram me-2"></i> New Project</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.hobbies.index') }}"><i class="fas fa-heart me-2"></i> New Hobby</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.skills.index') }}"><i class="fas fa-tools me-2"></i> New Skill</a></li>
                        </ul>
                    </div>

                    <!-- Profile Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-link text-decoration-none text-dark p-0 dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                            <div class="bg-black text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="small fw-bold d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                            <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i class="fas fa-cog me-2"></i> Settings</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i> My Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="py-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
@stack('js')
</body>
</html>
