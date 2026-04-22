@extends('layouts.frontend')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6" data-aos="fade-right">
                <h6 class="text-gold text-uppercase letter-spacing mb-3">Architecting the Future</h6>
                <h1 class="display-3 playfair fw-bold mb-4">{{ $settings['bio_name'] ?? 'Md Saiful Islam' }}</h1>
                <h3 class="h4 text-muted mb-4 subtitle">{{ $settings['bio_title'] ?? 'Laravel Solutions Architect' }}</h3>
                <p class="lead text-off-white opacity-75 mb-5 fs-6">
                    "{{ $settings['bio_tagline'] ?? 'Building scalable systems with elegant code.' }}"
                </p>
                <div class="d-flex gap-3">
                    <a href="{{ route('projects.index') }}" class="btn btn-gold px-4 py-2">EXPLORE MY SYSTEMS</a>
                    <a href="{{ route('contact.index') }}" class="btn btn-outline-dark px-4 py-2">GET IN TOUCH</a>
                </div>
            </div>
            <div class="col-md-6 mt-5 mt-md-0 d-flex justify-content-center" data-aos="fade-left">
                <div class="luxury-border">
                    @php
                        $heroImg = $settings['hero_image'] ?? 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&q=80&w=600&h=800';
                        $heroUrl = \Illuminate\Support\Str::startsWith($heroImg, 'http') ? $heroImg : asset($heroImg);
                    @endphp
                    <img src="{{ $heroUrl }}" alt="{{ $settings['bio_name'] ?? 'Md Saiful Islam' }}" class="img-fluid gray-scale shadow-lg" style="filter: grayscale(100%); width: 100%; height: auto; max-height: 500px; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Section -->
<section class="py-5 my-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="playfair display-5 text-navy">Featured Projects</h2>
            <div class="gold-line mx-auto" style="width: 60px; height: 2px; background: var(--gold); margin-top: 15px;"></div>
        </div>

        <div class="row g-4">
            @forelse($featured_projects as $project)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="card card-luxury h-100 overflow-hidden border-0">
                    <div class="position-relative overflow-hidden">
                        <img src="{{ \Illuminate\Support\Str::startsWith($project->cover_image, 'http') ? $project->cover_image : asset($project->cover_image) }}" class="card-img-top" alt="{{ $project->title }}" style="transition: transform 0.5s ease;">
                        <div class="hover-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(10, 25, 47, 0.8); opacity: 0; transition: 0.3s;">
                            <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-gold">VIEW MORE</a>
                        </div>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h5 class="playfair mb-2">{{ $project->title }}</h5>
                        <p class="small text-muted">{{ Str::limit($project->description, 80) }}</p>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center text-muted">No projects featured yet.</p>
            @endforelse
        </div>
    </div>
</section>

<style>
    .card-luxury:hover .hover-overlay { opacity: 1 !important; }
    .card-luxury:hover img { transform: scale(1.1); }
</style>
@endsection
