@extends('layouts.frontend')

@section('title', 'Home')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
@endpush

@section('content')
@php
    use Illuminate\Support\Str;

    $name = $settings['bio_name'] ?? 'Md Saiful Islam';
    $role = $settings['bio_title'] ?? 'Software Developer';
    $email = $settings['email'] ?? null;
    $address = $settings['address'] ?? null;

    $heroImg = ($settings['hero_image'] ?? null) ?: 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&q=80&w=600&h=600';
    $heroUrl = Str::startsWith($heroImg, 'http') ? $heroImg : asset($heroImg);

    // "South Kafrul, Cantonment, Dhaka - 1206" -> "Dhaka"
    $city = $address ? Str::of($address)->afterLast(',')->before(' - ')->trim()->value() : null;

    // rotating one-liners, built from what the site actually knows
    $topSkills = $skills->take(6)->pluck('name')->implode(' · ');
    $lines = collect([
        $settings['bio_tagline'] ?? null,
        $topSkills ? $topSkills . '.' : null,
        $city ? 'Based in ' . $city . '.' : null,
        'Open to new opportunities.',
    ])->filter()->values();

    $focus = [
        ['no' => '01', 'title' => 'Enterprise Solutions', 'text' => 'ERP systems, custom CMS and high-traffic e-commerce platforms built on Laravel and modern stacks.'],
        ['no' => '02', 'title' => 'Clean Architecture', 'text' => 'SOLID principles, tests and modular design, so the code still makes sense after the requirements change.'],
        ['no' => '03', 'title' => 'Shipping & Support', 'text' => 'Deployment, database tuning and maintenance — the part that starts after the demo goes well.'],
    ];

    $projectUrl = fn ($path) => Str::startsWith($path, 'http') ? $path : asset($path);
@endphp

<div class="home-page">

    {{-- ---------- hero ---------- --}}
    <p class="prompt"><span class="sign">$ </span>whoami</p>

    <h1 class="hero-title">
        I build <span class="accent">Laravel systems</span>,<br>
        that <span class="accent-2">actually ship.</span>
    </h1>

    <div class="hero-typed">
        <span data-typed-target></span><span class="caret"></span>
        <script type="application/json" data-typed-lines>@json($lines)</script>
    </div>

    <div class="hero-grid">
        <div>
            <p class="hero-lead">
                I'm {{ Str::title(Str::lower($name)) }}, a {{ $role }} from Bangladesh.
                {{ $settings['bio_description'] ?? '' }}
                Most of my work lives in <a href="{{ route('projects.index') }}">the project archive</a>.
            </p>

            <div class="hero-actions">
                <a class="btn-solid" href="{{ route('projects.index') }}">See my work →</a>
                @if($email)
                    <a class="btn-ghost" href="mailto:{{ $email }}">{{ $email }}</a>
                @else
                    <a class="btn-ghost" href="{{ route('contact.index') }}">Get in touch</a>
                @endif
            </div>
        </div>

        <div class="status-card">
            <div class="status-card__head">
                <i class="fas fa-terminal"></i>
                <span>currently</span>
                <span class="live"></span>
            </div>
            <div class="status-card__body">
                <img src="{{ $heroUrl }}" alt="{{ $name }}" width="80" height="80">
                <div>
                    <p class="status-card__name">{{ $name }}</p>
                    <p class="status-card__role">{{ $role }}</p>
                    @if($address)
                        <p class="status-card__role"><i class="fas fa-location-dot"></i> {{ Str::limit($address, 34) }}</p>
                    @endif
                </div>
            </div>
            <p class="status-card__foot"># open to new opportunities</p>
        </div>
    </div>

    <div class="stats">
        <div>
            <div class="stats__value">{{ $stats['projects'] }}</div>
            <div class="stats__label">projects in the archive</div>
        </div>
        <div>
            <div class="stats__value">{{ $stats['skills'] }}</div>
            <div class="stats__label">technologies in daily use</div>
        </div>
        <div>
            <div class="stats__value">{{ $stats['categories'] }}</div>
            <div class="stats__label">domains worked in</div>
        </div>
    </div>

    {{-- ---------- focus ---------- --}}
    <section class="section">
        <p class="prompt"><span class="sign">$ </span>cat focus.md</p>

        <div class="focus-grid">
            @foreach($focus as $item)
                <div class="focus-card" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 80 }}">
                    <div class="focus-card__no">{{ $item['no'] }}</div>
                    <h3>{{ $item['title'] }}</h3>
                    <p>{{ $item['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ---------- stack marquee ---------- --}}
    @if($skills->count())
        <section class="section">
            <p class="prompt"><span class="sign">$ </span>ls stack/</p>

            <div class="marquee">
                <div class="marquee__track">
                    @for($i = 0; $i < 2; $i++)
                        <div class="marquee__row" @if($i) aria-hidden="true" @endif>
                            @foreach($skills as $skill)
                                <span class="chip">
                                    <span>{{ $skill->name }}</span>
                                    <span class="pct">{{ $skill->percentage }}%</span>
                                </span>
                            @endforeach
                        </div>
                    @endfor
                </div>
            </div>
        </section>
    @endif

    {{-- ---------- featured projects ---------- --}}
    <section class="section">
        <p class="prompt"><span class="sign">$ </span>ls projects/ --featured</p>

        <div class="project-grid">
            @forelse($featured_projects as $project)
                <a class="project-card" href="{{ route('projects.show', $project->slug) }}"
                   data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 80 }}">
                    <img class="project-card__img" src="{{ $projectUrl($project->cover_image) }}" alt="{{ $project->title }}">
                    <div class="project-card__body">
                        <h3>{{ $project->title }}</h3>
                        <p>{{ Str::limit(strip_tags($project->description), 96) }}</p>
                        <span class="project-card__more">read more →</span>
                    </div>
                </a>
            @empty
                <p class="empty-note">No projects featured yet.</p>
            @endforelse
        </div>

        @if($featured_projects->count())
            <div class="section-foot">
                <a href="{{ route('projects.index') }}">browse the full archive →</a>
            </div>
        @endif
    </section>

    {{-- ---------- github contribution calendar ---------- --}}
    @if($contributions)
        <section class="section">
            <p class="prompt"><span class="sign">$ </span>git log</p>

            <div class="contrib-card">
                <div class="contrib-scroll">
                    <div class="contrib-grid" role="img"
                         aria-label="{{ $contributions['total'] }} GitHub contributions in the last year">
                        <div class="contrib-months">
                            @foreach($contributions['months'] as $month)
                                <span style="grid-column: span {{ $month['span'] }}">{{ $month['label'] }}</span>
                            @endforeach
                        </div>

                        <div class="contrib-weeks">
                            @foreach($contributions['weeks'] as $week)
                                <div class="contrib-week">
                                    @foreach($week as $day)
                                        @if($day)
                                            <span class="contrib-day" data-level="{{ $day['level'] }}"
                                                  title="{{ $day['count'] }} contributions on {{ \Carbon\Carbon::parse($day['date'])->format('M j, Y') }}"></span>
                                        @else
                                            <span class="contrib-day is-empty"></span>
                                        @endif
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="contrib-foot">
                    <a href="{{ $settings['github'] }}" target="_blank" rel="noopener">
                        {{ number_format($contributions['total']) }} contributions in the last year
                    </a>
                    <div class="contrib-legend">
                        <span>Less</span>
                        @for($l = 0; $l <= 4; $l++)
                            <span class="contrib-day" data-level="{{ $l }}"></span>
                        @endfor
                        <span>More</span>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- ---------- closing CTA ---------- --}}
    <section class="cta">
        <p class="prompt"><span class="sign">$ </span>ping {{ Str::of(config('app.url'))->after('//') }}</p>

        <h2>Got a project that needs to <span class="grad-word">actually work</span>?</h2>
        <p class="cta__sub">Tell me what you are building — I'll tell you how I'd build it.</p>

        @if($email)
            <a class="cta__mail" href="mailto:{{ $email }}">
                <span>{{ $email }}</span><span class="arrow">→</span>
            </a>
        @else
            <a class="cta__mail" href="{{ route('contact.index') }}">
                <span>Start a conversation</span><span class="arrow">→</span>
            </a>
        @endif

        <div class="cta__links">
            @if(!empty($settings['github']))
                <a href="{{ $settings['github'] }}" target="_blank" rel="noopener">./github</a>
            @endif
            @if(!empty($settings['linkedin']))
                <a href="{{ $settings['linkedin'] }}" target="_blank" rel="noopener">./linkedin</a>
            @endif
            @if(!empty($settings['facebook']))
                <a href="{{ $settings['facebook'] }}" target="_blank" rel="noopener">./facebook</a>
            @endif
            <a href="{{ route('contact.index') }}">./contact</a>
        </div>
    </section>
</div>
@endsection

@push('js')
<script>
    /* rotating one-liner under the headline: type, hold, erase, next */
    (function () {
        var target = document.querySelector('[data-typed-target]');
        var data = document.querySelector('[data-typed-lines]');
        if (!target || !data) return;

        var lines;
        try {
            lines = JSON.parse(data.textContent) || [];
        } catch (e) {
            return;
        }
        if (!lines.length) return;

        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            target.textContent = lines[0];
            return;
        }

        var line = 0, char = 0, erasing = false;

        function tick() {
            var text = lines[line];
            target.textContent = text.slice(0, char);

            if (!erasing && char === text.length) {
                erasing = true;
                return setTimeout(tick, 2200);
            }

            if (erasing && char === 0) {
                erasing = false;
                line = (line + 1) % lines.length;
                return setTimeout(tick, 400);
            }

            char += erasing ? -1 : 1;
            setTimeout(tick, erasing ? 25 : 45);
        }

        tick();
    })();
</script>
@endpush
