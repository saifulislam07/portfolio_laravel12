@extends('layouts.frontend')

@section('title', 'About')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">
@endpush

@section('content')
@php
    use Illuminate\Support\Str;

    $aboutImg = $settings['about_image'] ?? 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&q=80&w=800&h=500';
    $aboutUrl = Str::startsWith($aboutImg, 'http') ? $aboutImg : asset($aboutImg);

    $hobbies = \App\Models\Hobby::all();

    // "Degree, Institution (2013 - 2015)" -> ['degree', 'institution', 'years']
    $parseEducation = function ($value) {
        if (blank($value)) {
            return null;
        }

        $years = null;
        if (preg_match('/\(([^)]*)\)\s*$/', $value, $m)) {
            $years = trim($m[1]);
            $value = trim(preg_replace('/\(([^)]*)\)\s*$/', '', $value));
        }

        $parts = array_map('trim', explode(',', $value, 2));

        return [
            'degree' => $parts[0] ?? $value,
            'institution' => $parts[1] ?? null,
            'years' => $years,
        ];
    };

    $education = collect([
        'education_masters' => 'fas fa-graduation-cap',
        'education_bachelor' => 'fas fa-user-graduate',
        'education_hsc' => 'fas fa-school',
        'education_ssc' => 'fas fa-book-open',
    ])->map(function ($icon, $key) use ($settings, $parseEducation) {
        $row = $parseEducation($settings[$key] ?? null);

        return $row ? $row + ['icon' => $icon] : null;
    })->filter()->values();

    $handle = fn ($url) => trim(parse_url($url, PHP_URL_PATH) ?? '', '/') ?: Str::of($url)->after('//')->before('/');
@endphp

<div class="about-page">

    <div class="about-head">
        <h1>{{ $settings['about_title'] ?? 'About' }}</h1>
        <p>{{ $settings['about_subtitle'] ?? 'A bit of background on who I am, what I do, and what I like building.' }}</p>
    </div>

    <div class="about-grid">

        <aside class="about-aside" data-aos="fade-right">
            <div class="about-card">
                <img class="about-card__cover" src="{{ $aboutUrl }}"
                     alt="{{ $settings['bio_name'] ?? 'Md Saiful Islam' }}" width="550" height="350">

                <div class="about-card__strip">
                    <span class="dot"></span>
                    <span>Open to new opportunities</span>
                </div>

                <div class="about-card__body">
                    <h3 class="about-card__name">{{ $settings['bio_name'] ?? 'MD SAIFUL ISLAM' }}</h3>
                    <p class="about-card__tagline">
                        Learner | Builder | <span class="grad-text">{{ $settings['bio_title'] ?? 'Software Developer' }}</span>
                    </p>

                    <div class="about-meta">
                        @if(!empty($settings['bio_title']))
                            <div><i class="fas fa-briefcase"></i><span>{{ $settings['bio_title'] }}</span></div>
                        @endif
                        @if(!empty($settings['address']))
                            <div><i class="fas fa-location-dot"></i><span>{{ $settings['address'] }}</span></div>
                        @endif
                        @if(!empty($settings['email']))
                            <div><i class="fas fa-envelope"></i><a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a></div>
                        @endif
                        @if(!empty($settings['phone']))
                            <div><i class="fas fa-phone"></i><a href="tel:{{ $settings['phone'] }}">{{ $settings['phone'] }}</a></div>
                        @endif
                    </div>

                    <div class="about-socials">
                        @if(!empty($settings['github']))
                            <a href="{{ $settings['github'] }}" target="_blank" rel="noopener">
                                <i class="fab fa-github"></i><span class="slash">/</span><span>{{ $handle($settings['github']) }}</span>
                            </a>
                        @endif
                        @if(!empty($settings['linkedin']))
                            <a href="{{ $settings['linkedin'] }}" target="_blank" rel="noopener">
                                <i class="fab fa-linkedin-in"></i><span class="slash">/</span><span>{{ Str::afterLast($handle($settings['linkedin']), '/') }}</span>
                            </a>
                        @endif
                        @if(!empty($settings['facebook']))
                            <a href="{{ $settings['facebook'] }}" target="_blank" rel="noopener">
                                <i class="fab fa-facebook-f"></i><span class="slash">/</span><span>{{ $handle($settings['facebook']) }}</span>
                            </a>
                        @endif
                        @if(!empty($settings['whatsapp']))
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp']) }}" target="_blank" rel="noopener">
                                <i class="fab fa-whatsapp"></i><span class="slash">/</span><span>WhatsApp</span>
                            </a>
                        @endif
                    </div>
                </div>

                <span class="about-card__bar"></span>
            </div>
        </aside>

        <div class="about-prose" data-aos="fade-left">
            <h2>Hi there 👋</h2>
            <p>{!! nl2br(e($settings['bio_description'] ?? 'I am a dedicated software engineer focused on building robust backend systems with Laravel.')) !!}</p>

            @if($skills->count())
                <h3>Technologies 💻</h3>
                <p>The tools I reach for, depending on the problem:</p>
                <ul class="skill-chips">
                    @foreach($skills as $skill)
                        <li>
                            <span>{{ $skill->name }}</span>
                            <span class="pct">{{ $skill->percentage }}%</span>
                        </li>
                    @endforeach
                </ul>
            @endif

            @if($hobbies->count())
                <h3>Interests 🐾</h3>
                <ul>
                    @foreach($hobbies as $hobby)
                        <li><i class="{{ $hobby->icon ?? 'fas fa-star' }}"></i> {{ $hobby->name }}</li>
                    @endforeach
                </ul>
            @endif

            <h3>What I focus on</h3>
            <ul>
                <li><strong>Enterprise solutions:</strong> ERP systems, custom CMS and high-traffic e-commerce platforms on Laravel.</li>
                <li><strong>Clean architecture:</strong> SOLID principles, tests and modular design so the code stays maintainable.</li>
            </ul>

            @if($education->count())
                <h2>My education</h2>
                <ul class="about-timeline">
                    @foreach($education as $item)
                        <li>
                            <div class="tl-item">
                                <span class="tl-mark"><i class="{{ $item['icon'] }}"></i></span>
                                <div class="tl-body">
                                    @if($item['years'])
                                        <div class="tl-date">{{ $item['years'] }}</div>
                                    @endif
                                    <span class="tl-title">{{ $item['degree'] }}</span>
                                    @if($item['institution'])
                                        <div class="tl-sub"><i class="fas fa-building-columns"></i><span>{{ $item['institution'] }}</span></div>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div class="about-cta" data-aos="zoom-in">
        <h3>Wanna collaborate on a project?</h3>
        <a href="{{ route('contact.index') }}" class="btn btn-gold px-5 py-3">LET'S START A CONVERSATION</a>
    </div>
</div>
@endsection
