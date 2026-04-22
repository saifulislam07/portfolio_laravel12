@extends('layouts.frontend')

@section('title', 'About Me')

@section('content')
<section class="page-header">
    <div class="container">
        <h1 class="display-4 playfair text-gold" data-aos="fade-down">{{ $settings['about_title'] ?? 'About Me' }}</h1>
        <p class="lead" data-aos="fade-up">{{ $settings['about_subtitle'] ?? 'Laravel Developer ' }}</p>
    </div>
</section>

<section class="py-5 my-5">
    <div class="container-fluid px-md-5">
        <div class="row g-5 align-items-center">
            <div class="col-md-5" data-aos="fade-right">
                <div class="luxury-border">
                    @php
                        $aboutImg = $settings['about_image'] ?? 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&q=80&w=600&h=800';
                        $aboutUrl = \Illuminate\Support\Str::startsWith($aboutImg, 'http') ? $aboutImg : asset($aboutImg);
                    @endphp
                    <img src="{{ $aboutUrl }}" alt="{{ $settings['bio_name'] ?? 'Md Saiful Islam' }}" class="img-fluid gray-scale shadow-lg w-100" style="filter: grayscale(100%);">
                </div>
            </div>
            <div class="col-md-7" data-aos="fade-left">
                <h2 class="playfair text-navy mb-4">Precision in Every Line of Code</h2>
                <div class="text-muted lead mb-4">
                    {!! nl2br(e($settings['bio_description'] ?? 'I am a dedicated software engineer with a focus on building robust backend systems using the Laravel framework.')) !!}
                </div>
                
                <div class="row mt-5">
                    <div class="col-md-6 mb-4">
                        <h4 class="playfair text-gold mb-3">Enterprise Solutions</h4>
                        <p class="text-muted small">Specializing in ERP systems, custom CMS, and high-traffic e-commerce platforms using Laravel and modern stacks.</p>
                    </div>
                    <div class="col-md-6 mb-4">
                        <h4 class="playfair text-gold mb-3">Clean Architecture</h4>
                        <p class="text-muted small">Commitment to SOLID principles, TDD, and modular design patterns to ensure scalability and maintainability.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Skills Section -->
<section class="py-5 bg-white border-top border-bottom text-navy">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="playfair display-5 text-gold">My Expertise</h2>
            <p class="text-muted">Continuously evolving and mastering new technologies.</p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($skills as $skill)
            <div class="col-md-4" data-aos="flip-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="skill-item mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="fw-bold">{{ $skill->name }}</span>
                        <span class="text-gold">{{ $skill->percentage }}%</span>
                    </div>
                    <div class="progress rounded-0" style="height: 4px; background: rgba(0,0,0,0.05);">
                        <div class="progress-bar" role="progressbar" style="width: {{ $skill->percentage }}%; background-color: #000000 !important;" aria-valuenow="{{ $skill->percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Education Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Education Timeline -->
            <div class="col-lg-8" data-aos="fade-up">
                <h3 class="playfair text-navy mb-5 text-center">Educational Background</h3>
                <div class="timeline px-md-5">
                    @if(isset($settings['education_masters']))
                    <div class="mb-4 border-start border-gold ps-4 position-relative">
                        <div class="position-absolute start-0 top-0 translate-middle-x bg-gold rounded-circle" style="width: 12px; height: 12px; margin-left: -1px;"></div>
                        <h5 class="playfair mb-1 text-navy">Masters of Management</h5>
                        <p class="text-muted small mb-0">{{ $settings['education_masters'] }}</p>
                    </div>
                    @endif
                    @if(isset($settings['education_bachelor']))
                    <div class="mb-4 border-start border-gold ps-4 position-relative">
                        <div class="position-absolute start-0 top-0 translate-middle-x bg-gold rounded-circle" style="width: 12px; height: 12px; margin-left: -1px;"></div>
                        <h5 class="playfair mb-1 text-navy">Bachelor of Business Studies</h5>
                        <p class="text-muted small mb-0">{{ $settings['education_bachelor'] }}</p>
                    </div>
                    @endif
                    @if(isset($settings['education_hsc']))
                    <div class="mb-4 border-start border-gold ps-4 position-relative">
                        <div class="position-absolute start-0 top-0 translate-middle-x bg-gold rounded-circle" style="width: 12px; height: 12px; margin-left: -1px;"></div>
                        <h5 class="playfair mb-1 text-navy">Higher Secondary Certificate</h5>
                        <p class="text-muted small mb-0">{{ $settings['education_hsc'] }}</p>
                    </div>
                    @endif
                    @if(isset($settings['education_ssc']))
                    <div class="mb-4 border-start border-gold ps-4 position-relative">
                        <div class="position-absolute start-0 top-0 translate-middle-x bg-gold rounded-circle" style="width: 12px; height: 12px; margin-left: -1px;"></div>
                        <h5 class="playfair mb-1 text-navy">Secondary School Certificate</h5>
                        <p class="text-muted small mb-0">{{ $settings['education_ssc'] }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
    </div>
</section>

@php
    $hobbies = \App\Models\Hobby::all();
@endphp

@if($hobbies->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="playfair text-center mb-5" data-aos="fade-up">My Interests & Hobbies</h2>
        <div class="row g-4 justify-content-center">
            @foreach($hobbies as $hobby)
            <div class="col-md-3 col-6" data-aos="zoom-in">
                <div class="card card-luxury h-100 text-center p-4 border-0 shadow-sm">
                    <div class="mb-3">
                        <i class="{{ $hobby->icon ?? 'fas fa-star' }} fs-2 text-gold"></i>
                    </div>
                    <h5 class="playfair mb-0 small text-uppercase">{{ $hobby->name }}</h5>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="py-5 my-5">
    <div class="container text-center" data-aos="zoom-in">
        <h3 class="playfair mb-4">Wanna collaborate on a project?</h3>
        <a href="{{ route('contact.index') }}" class="btn btn-gold px-5 py-3">LET'S START A CONVERSATION</a>
    </div>
</section>
@endsection
