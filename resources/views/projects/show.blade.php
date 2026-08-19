@extends('layouts.frontend')

@section('title', $project->title)

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/pages.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.14.2/simple-lightbox.min.css">
@endpush

@section('content')
@php
    use Illuminate\Support\Str;
    $url = fn ($path) => Str::startsWith($path, 'http') ? $path : asset($path);
@endphp

<div class="page-shell">

    <a class="back-link" href="{{ route('projects.index') }}">← back to work</a>

    <div class="detail-head" data-aos="fade-up">
        <p class="prompt"><span class="sign">$ </span>cat projects/{{ $project->slug }}.md</p>
        <h1>{{ $project->title }}</h1>

        @if($project->tech_stack)
            <ul class="tech-chips">
                @foreach($project->tech_stack as $tech)
                    <li>{{ trim($tech) }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="detail-cover" data-aos="fade-up">
        <img src="{{ $url($project->cover_image) }}" alt="{{ $project->title }}">
    </div>

    <div class="detail-grid">
        <div class="detail-prose" data-aos="fade-right">
            <h2>Overview</h2>
            <p>{!! nl2br(e($project->description)) !!}</p>

            @if($project->problem || $project->solution)
                <div class="detail-split">
                    @if($project->problem)
                        <div class="info-card">
                            <h3>The problem</h3>
                            <p>{{ $project->problem }}</p>
                        </div>
                    @endif
                    @if($project->solution)
                        <div class="info-card">
                            <h3>The solution</h3>
                            <p>{{ $project->solution }}</p>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        @if($project->images->count())
            <aside class="detail-aside" data-aos="fade-left">
                <div class="info-card">
                    <h3>Gallery</h3>
                    <div class="gallery-grid">
                        @foreach($project->images as $img)
                            <a class="gallery-link" href="{{ $url($img->image_path) }}">
                                <img src="{{ $url($img->image_path) }}" alt="{{ $project->title }} screenshot">
                            </a>
                        @endforeach
                    </div>
                </div>
            </aside>
        @endif
    </div>

    <div class="page-foot">
        <a href="{{ route('contact.index') }}">Building something similar? Let's talk →</a>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.14.2/simple-lightbox.min.js"></script>
<script>
    new SimpleLightbox('.gallery-link', {});
</script>
@endpush
