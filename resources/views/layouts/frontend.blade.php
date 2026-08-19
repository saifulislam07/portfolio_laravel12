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
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Site header (floating sticky menu) -->
    <link rel="stylesheet" href="{{ asset('assets/css/site-header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/site-footer.css') }}">
    <!-- Apply the stored theme before first paint so there is no flash -->
    <script>
        (function () {
            try {
                var stored = localStorage.getItem('theme');
                var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (stored === 'dark' || (!stored && prefersDark)) {
                    document.documentElement.classList.add('dark');
                }
            } catch (e) {}
        })();
    </script>
    <style>
        html:not(.dark) * {
            color: #000000 !important;
        }
        html:not(.dark) h1, html:not(.dark) h2, html:not(.dark) h3, html:not(.dark) h4,
        html:not(.dark) h5, html:not(.dark) h6, html:not(.dark) .btn,
        html:not(.dark) .badge, html:not(.dark) .text-gold {
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
        .footer {
            background-color: #ffffff !important;
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
        html:not(.dark) .opacity-75, html:not(.dark) .text-muted {
            opacity: 1 !important;
            color: #000000 !important;
        }
        /* Mobile adjustment */
        @media (max-width: 768px) {
            .hero-section { text-align: center; padding-top: 100px; }
        }

        /* ---------- dark theme (toggled from the header) ---------- */
        html.dark body,
        html.dark .hero-section,
        html.dark .footer {
            background-color: #0b0b0d !important;
            color: #e5e7eb;
        }
        html.dark .page-header {
            background-color: #111114 !important;
            border-bottom-color: #27272a;
        }
        html.dark .footer { border-top-color: #27272a; }
        html.dark .texture-bg::before { opacity: 0.04; }
        html.dark h1, html.dark h2, html.dark h3, html.dark h4, html.dark h5, html.dark h6,
        html.dark p, html.dark li, html.dark span, html.dark a, html.dark .playfair, html.dark .text-gold {
            color: #e5e7eb;
        }
        html.dark .text-muted, html.dark .opacity-75 { color: #9ca3af !important; }
        html.dark .card, html.dark .card-luxury {
            background-color: #18181b !important;
            border-color: #27272a !important;
            color: #e5e7eb;
        }
        html.dark .badge {
            background-color: #18181b !important;
            border-color: #3f3f46 !important;
            color: #e5e7eb !important;
        }
        html.dark .btn-gold {
            background-color: #e5e7eb !important;
            border-color: #e5e7eb !important;
            color: #0b0b0d !important;
        }
        html.dark .btn-outline-dark, html.dark .btn-outline-navy, html.dark .btn-outline-gold {
            border-color: #e5e7eb !important;
            color: #e5e7eb !important;
        }
        html.dark .gold-line { background: #e5e7eb !important; }
        html.dark .luxury-border, html.dark .luxury-border::after { border-color: #3f3f46 !important; }
        html.dark .form-control, html.dark .form-select {
            background-color: #18181b;
            border-color: #3f3f46;
            color: #e5e7eb;
        }
    </style>
    @stack('css')
</head>
<body class="texture-bg">

<div class="content-wrapper">
    <!-- Navbar -->
    @include('layouts.partials.site-header')

    @yield('content')

    <!-- Footer -->
    @include('layouts.partials.site-footer')
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
<script>
    /* ---------- site header: More dropdown + theme switcher ---------- */
    (function () {
        var moreBtn = document.querySelector('[data-more-toggle]');
        var moreMenu = document.querySelector('[data-more-menu]');

        if (moreBtn && moreMenu) {
            moreBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                var open = moreMenu.classList.toggle('is-open');
                moreBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
            });

            document.addEventListener('click', function (e) {
                if (!moreMenu.contains(e.target) && !moreBtn.contains(e.target)) {
                    moreMenu.classList.remove('is-open');
                    moreBtn.setAttribute('aria-expanded', 'false');
                }
            });
        }

        var themeBtn = document.querySelector('[data-theme-toggle]');
        if (themeBtn) {
            themeBtn.addEventListener('click', function () {
                var isDark = document.documentElement.classList.toggle('dark');
                try {
                    localStorage.setItem('theme', isDark ? 'dark' : 'light');
                } catch (e) {}
            });
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && moreMenu) {
                moreMenu.classList.remove('is-open');
                if (moreBtn) moreBtn.setAttribute('aria-expanded', 'false');
            }
        });
    })();
</script>
@stack('js')
</body>
</html>
