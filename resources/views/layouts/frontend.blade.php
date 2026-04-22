<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ $settings['site_title'] ?? 'Md Saiful Islam' }}</title>
    
    <meta name="description" content="{{ $settings['meta_description'] ?? '' }}">
    <meta name="keywords" content="{{ $settings['meta_keywords'] ?? '' }}">
    <meta name="author" content="Md Saiful Islam">

    @if(!empty($settings['google_analytics']))
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings['google_analytics'] }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ $settings['google_analytics'] }}');
    </script>
    @endif
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Fragment+Mono:ital@0;1&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        * {
            color: #000000 !important;
        }
        h1, h2, h3, h4, h5, h6, .navbar-brand, .nav-link, .btn, .badge, .text-gold {
            color: #000000 !important;
        }
        .btn-gold {
            background-color: #000000 !important;
            color: #ffffff !important;
            border-color: #000000 !important;
        }
        .btn-outline-dark, .btn-outline-navy, .btn-outline-gold {
            border-color: #000000 !important;
            color: #000000 !important;
        }
        .badge {
            background-color: #ffffff !important;
            border: 1px solid #000000 !important;
            color: #000000 !important;
        }
        .gold-line {
            background: #000000 !important;
        }
        .luxury-border, .luxury-border::after {
            border-color: #000000 !important;
        }
        .navbar {
            background-color: #ffffff !important;
            padding: 15px 0;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .nav-link {
            font-family: 'Fragment Mono', monospace;
            text-transform: lowercase;
            font-size: 0.9rem;
            letter-spacing: -0.5px;
            margin: 0 15px;
        }
        .navbar-brand img {
            height: 40px;
            width: auto;
            max-width: 100%;
            object-fit: contain;
        }
        @media (max-width: 576px) {
            .navbar-brand img {
                height: 30px;
            }
            .navbar-brand {
                font-size: 1.2rem !important;
                max-width: 70%;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
        }
        .nav-link:hover, .nav-link.active {
            color: var(--gold) !important;
        }
        .footer {
            background-color: #ffffff !important;
            padding: 60px 0;
            border-top: 1px solid #eeeeee;
        }
        .page-header {
            padding: 120px 0 80px;
            background-color: #fcfcfc !important;
            text-align: center;
            border-bottom: 1px solid #f0f0f0;
        }
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background-color: #ffffff !important;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url('https://www.transparenttextures.com/patterns/natural-paper.png');
            opacity: 0.1;
        }
        .opacity-75, .text-muted {
            opacity: 1 !important;
            color: #000000 !important;
        }
        /* Mobile adjustment */
        @media (max-width: 768px) {
            .hero-section { text-align: center; padding-top: 100px; }
        }
    </style>
    @stack('css')
</head>
<body class="texture-bg">

<div class="content-wrapper">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand playfair text-gold fw-bold fs-3" href="{{ route('home') }}">
                @php
                    $name = \App\Models\Setting::where('key', 'bio_name')->first();
                    $title = \App\Models\Setting::where('key', 'bio_title')->first();
                @endphp
                {{ $name->value ?? 'MD SAIFUL ISLAM' }}
                @if($title && $title->value)
                    <span class="fs-6 fw-normal text-muted ms-2 d-none d-sm-inline">| {{ $title->value }}</span>
                @endif
            </a>
            <button class="navbar-toggler border-gold" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                <span class="fas fa-bars text-gold"></span>
            </button>
            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}" href="{{ route('projects.index') }}">Work</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact.index') ? 'active' : '' }}" href="{{ route('contact.index') }}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <div class="mb-4">
                @php
                    $name = \App\Models\Setting::where('key', 'bio_name')->first();
                    $title = \App\Models\Setting::where('key', 'bio_title')->first();
                @endphp
                <h2 class="playfair text-gold mb-1">{{ $name->value ?? 'MD SAIFUL ISLAM' }}</h2>
                @if($title && $title->value)
                    <p class="text-muted small text-uppercase letter-spacing-1">{{ $title->value }}</p>
                @endif
            </div>
            <div class="d-flex justify-content-center gap-4 mb-4 fs-4">
                @php $socials = \App\Models\Setting::whereIn('key', ['facebook', 'linkedin', 'whatsapp', 'github'])->pluck('value', 'key'); @endphp
                @if($socials->get('facebook')) <a href="{{ $socials->get('facebook') }}" class="text-off-white" target="_blank"><i class="fab fa-facebook-f"></i></a> @endif
                @if($socials->get('linkedin')) <a href="{{ $socials->get('linkedin') }}" class="text-off-white" target="_blank"><i class="fab fa-linkedin-in"></i></a> @endif
                @if($socials->get('github')) <a href="{{ $socials->get('github') }}" class="text-off-white" target="_blank"><i class="fab fa-github"></i></a> @endif
                @if($socials->get('whatsapp')) <a href="https://wa.me/{{ $socials->get('whatsapp') }}" class="text-off-white" target="_blank"><i class="fab fa-whatsapp"></i></a> @endif
            </div>
            <p class="text-muted small">&copy; {{ date('Y') }} All Rights Reserved. Built with Laravel.</p>
        </div>
    </footer>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true
    });
</script>
@stack('js')
</body>
</html>
