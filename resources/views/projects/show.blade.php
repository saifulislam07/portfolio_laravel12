@extends('layouts.frontend')

@section('title', $project->title)

@section('content')
<section class="py-5 mt-5">
    <div class="container">
        <div class="row mb-5" data-aos="fade-up">
            <div class="col-md-10 mx-auto text-center">
                <h1 class="display-3 playfair mb-4">{{ $project->title }}</h1>
                <div class="d-flex justify-content-center gap-2 mb-4">
                    @foreach($project->tech_stack as $tech)
                        <span class="badge rounded-0 border text-navy px-3 py-2">{{ trim($tech) }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row mb-5" data-aos="fade-up">
            <div class="col-md-12">
                <div class="luxury-border p-3 bg-white">
                    <img src="{{ \Illuminate\Support\Str::startsWith($project->cover_image, 'http') ? $project->cover_image : asset($project->cover_image) }}" class="img-fluid w-100 shadow-lg" alt="{{ $project->title }}">
                </div>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-md-8" data-aos="fade-right">
                <div class="mb-5">
                    <h3 class="playfair text-gold mb-3">Overview</h3>
                    <div class="text-navy opacity-75 lead">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h4 class="playfair text-gold mb-3">The Problem</h4>
                        <p class="text-muted">{{ $project->problem }}</p>
                    </div>
                    <div class="col-md-6 mb-4">
                        <h4 class="playfair text-gold mb-3">The Solution</h4>
                        <p class="text-muted">{{ $project->solution }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-left">
                <div class="card card-luxury p-4 sticky-top" style="top: 100px;">
                    <h4 class="playfair mb-4 text-center">Gallery</h4>
                    <div class="row g-2">
                        @foreach($project->images as $img)
                        <div class="col-6">
                            <a href="{{ \Illuminate\Support\Str::startsWith($img->image_path, 'http') ? $img->image_path : asset($img->image_path) }}" class="gallery-link">
                                <img src="{{ \Illuminate\Support\Str::startsWith($img->image_path, 'http') ? $img->image_path : asset($img->image_path) }}" class="img-fluid shadow-sm" alt="">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 text-center" data-aos="fade-up">
            <a href="{{ route('projects.index') }}" class="btn btn-navy text-gold border-gold px-5 py-3 rounded-0">BACK TO WORK</a>
        </div>
    </div>
</section>

<style>
    .btn-navy {
        background-color: var(--navy);
    }
    .btn-navy:hover {
        background-color: #1a2a44;
    }
</style>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.14.2/simple-lightbox.min.css">
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.14.2/simple-lightbox.min.js"></script>
<script>
    var lightbox = new SimpleLightbox('.gallery-link', {});
</script>
@endpush
