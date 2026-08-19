@php
    $footerSettings = \App\Models\Setting::whereIn('key', [
        'logo', 'bio_name', 'bio_title', 'bio_tagline', 'email', 'phone',
        'github', 'linkedin', 'facebook', 'whatsapp',
    ])->pluck('value', 'key');

    $footerName = $footerSettings['bio_name'] ?? 'MD SAIFUL ISLAM';
    $footerLogo = $footerSettings['logo'] ?? null;
    $footerTagline = $footerSettings['bio_tagline'] ?? null;
    $host = \Illuminate\Support\Str::of(config('app.url'))->after('//')->rtrim('/');
@endphp

<footer class="footer site-footer">
    <div class="site-footer__grid">

        <div>
            <a class="site-footer__brand" href="{{ route('home') }}" aria-label="{{ $footerName }} — home">
                @if($footerLogo)
                    <img class="footer-logo" src="{{ asset($footerLogo) }}" alt="{{ $footerName }}">
                @else
                    <img class="footer-logo logo-on-light" src="{{ asset('assets/img/logo/logo-full.png') }}"
                         alt="{{ $footerName }}" width="1201" height="318">
                    <img class="footer-logo logo-on-dark" src="{{ asset('assets/img/logo/logo-full-light.png') }}"
                         alt="{{ $footerName }}" width="1201" height="318">
                @endif
            </a>

            @if($footerTagline)
                <p class="site-footer__tagline">{{ $footerTagline }}</p>
            @endif

            <div class="site-footer__socials">
                @if(!empty($footerSettings['github']))
                    <a href="{{ $footerSettings['github'] }}" target="_blank" rel="noopener" aria-label="GitHub"><i class="fab fa-github"></i></a>
                @endif
                @if(!empty($footerSettings['linkedin']))
                    <a href="{{ $footerSettings['linkedin'] }}" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                @endif
                @if(!empty($footerSettings['facebook']))
                    <a href="{{ $footerSettings['facebook'] }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                @endif
                @if(!empty($footerSettings['whatsapp']))
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $footerSettings['whatsapp']) }}" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                @endif
            </div>

            <div class="site-footer__meta">
                <a href="{{ route('home') }}"><i class="fas fa-link"></i>{{ $host }}</a>
                <span>
                    <i class="fas fa-clock"></i>
                    Dhaka, <span data-local-time>--:--</span>
                    <span class="offset" data-time-offset></span>
                </span>
            </div>
        </div>

        <div class="site-footer__col">
            <h4>Sitemap</h4>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ route('projects.index') }}">Work</a></li>
                <li><a href="{{ route('contact.index') }}">Contact</a></li>
                <li><a href="{{ url('/sitemap.xml') }}" target="_blank" rel="noopener">sitemap.xml</a></li>
            </ul>
        </div>

        <div class="site-footer__col">
            <h4>Get in touch</h4>
            <ul>
                @if(!empty($footerSettings['email']))
                    <li><a href="mailto:{{ $footerSettings['email'] }}"><i class="fas fa-envelope"></i>{{ $footerSettings['email'] }}</a></li>
                @endif
                @if(!empty($footerSettings['phone']))
                    <li><a href="tel:{{ $footerSettings['phone'] }}"><i class="fas fa-phone"></i>{{ $footerSettings['phone'] }}</a></li>
                @endif
                <li><a href="{{ route('contact.index') }}"><i class="fas fa-paper-plane"></i>Send a message</a></li>
                @auth
                    <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-gauge-high"></i>Dashboard</a></li>
                @endauth
            </ul>
        </div>
    </div>

    <div class="site-footer__bar">
        <span>&copy; {{ date('Y') }} {{ $footerName }}. All rights reserved.</span>
        <span>Built with Laravel <span class="heart">&hearts;</span></span>
    </div>
</footer>

<script>
    /* live Dhaka clock + how far ahead/behind the visitor is */
    (function () {
        var clock = document.querySelector('[data-local-time]');
        var offsetEl = document.querySelector('[data-time-offset]');
        if (!clock) return;

        var zone = 'Asia/Dhaka';

        function zonedDate(tz) {
            return new Date(new Date().toLocaleString('en-US', { timeZone: tz }));
        }

        function render() {
            clock.textContent = new Intl.DateTimeFormat('en-US', {
                timeZone: zone, hour: '2-digit', minute: '2-digit', hour12: true
            }).format(new Date());

            if (offsetEl) {
                var visitorZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                var diff = Math.round((zonedDate(zone) - zonedDate(visitorZone)) / 3600000);
                offsetEl.textContent = diff === 0
                    ? '- same time as you'
                    : '- ' + Math.abs(diff) + 'h ' + (diff > 0 ? 'ahead' : 'behind');
            }
        }

        render();
        setInterval(render, 30000);
    })();
</script>
