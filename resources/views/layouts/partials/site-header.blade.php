@php
    $siteSettings = \App\Models\Setting::whereIn('key', ['logo', 'bio_name', 'bio_title', 'github', 'linkedin', 'facebook', 'whatsapp'])
        ->pluck('value', 'key');

    $brandName = $siteSettings['bio_name'] ?? 'MD SAIFUL ISLAM';
    $brandRole = $siteSettings['bio_title'] ?? null;

    $navItems = [
        ['label' => 'Home', 'url' => route('home'), 'active' => request()->routeIs('home')],
        ['label' => 'About', 'url' => route('about'), 'active' => request()->routeIs('about')],
        ['label' => 'Work', 'url' => route('projects.index'), 'active' => request()->routeIs('projects.*')],
        ['label' => 'Contact', 'url' => route('contact.index'), 'active' => request()->routeIs('contact.*')],
    ];
@endphp

<header class="site-header">
    <div class="site-header__inner">
        <a class="site-header__brand" href="{{ route('home') }}" aria-label="{{ $brandName }} — home">
            <span class="site-header__mark">
                @if(!empty($siteSettings['logo']))
                    <img src="{{ asset($siteSettings['logo']) }}" alt="{{ $brandName }}" width="40" height="40">
                @else
                    <img class="logo-on-light" src="{{ asset('assets/img/logo/logo-mark.png') }}"
                         alt="{{ $brandName }}" width="576" height="318">
                    <img class="logo-on-dark" src="{{ asset('assets/img/logo/logo-mark-light.png') }}"
                         alt="{{ $brandName }}" width="576" height="318">
                @endif
            </span>
            <span>
                <span class="site-header__name">{{ $brandName }}</span>
                @if($brandRole)
                    <span class="site-header__role d-none d-sm-block">{{ $brandRole }}</span>
                @endif
            </span>
        </a>

        <div class="site-header__right">
            <nav class="site-nav" aria-label="Main">
                @foreach($navItems as $item)
                    <a class="site-nav__link {{ $item['active'] ? 'is-active' : '' }}" href="{{ $item['url'] }}">
                        <span class="hl">{{ $item['label'] }}</span>
                    </a>
                @endforeach

                <div class="site-nav__more">
                    <button type="button" class="site-nav__more-btn" aria-label="More links" aria-haspopup="menu"
                            aria-expanded="false" data-more-toggle>
                        <span class="hl">
                            <span>More</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                 stroke-linejoin="round" aria-hidden="true">
                                <path d="m6 9 6 6 6-6"></path>
                            </svg>
                        </span>
                    </button>

                    <div class="site-nav__menu" role="menu" data-more-menu>
                        @if(!empty($siteSettings['github']))
                            <a href="{{ $siteSettings['github'] }}" target="_blank" rel="noopener" role="menuitem">
                                <i class="fab fa-github"></i> GitHub
                            </a>
                        @endif
                        @if(!empty($siteSettings['linkedin']))
                            <a href="{{ $siteSettings['linkedin'] }}" target="_blank" rel="noopener" role="menuitem">
                                <i class="fab fa-linkedin-in"></i> LinkedIn
                            </a>
                        @endif
                        <a href="{{ url('/sitemap.xml') }}" target="_blank" rel="noopener" role="menuitem">
                            <i class="fas fa-sitemap"></i> Sitemap
                        </a>
                        @auth
                            <a href="{{ route('admin.dashboard') }}" role="menuitem">
                                <i class="fas fa-gauge-high"></i> Dashboard
                            </a>
                        @endauth
                    </div>
                </div>
            </nav>

            <div class="site-header__divider" role="separator" aria-orientation="vertical"></div>

            <div class="site-header__actions">
                <button type="button" class="icon-btn icon-btn--theme" aria-label="Theme switcher" data-theme-toggle>
                    <svg class="icon-sun" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                         stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="4"></circle>
                        <path d="M12 2v2"></path><path d="M12 20v2"></path>
                        <path d="m4.9 4.9 1.4 1.4"></path><path d="m17.7 17.7 1.4 1.4"></path>
                        <path d="M2 12h2"></path><path d="M20 12h2"></path>
                        <path d="m6.3 17.7-1.4 1.4"></path><path d="m19.1 4.9-1.4 1.4"></path>
                    </svg>
                    <svg class="icon-moon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                         stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
                    </svg>
                </button>

            </div>
        </div>
    </div>
</header>
