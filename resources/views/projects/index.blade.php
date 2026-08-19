@extends('layouts.frontend')

@section('title', 'Work')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/pages.css') }}">
@endpush

@section('content')
@php
    use Illuminate\Support\Str;
    $cover = fn ($path) => Str::startsWith($path, 'http') ? $path : asset($path);
@endphp

<div class="page-shell">

    <div class="page-head">
        <p class="prompt"><span class="sign">$ </span>ls projects/</p>
        <h1>Work</h1>
        <p>Systems I have designed, built and kept running — client platforms, internal tools and the odd side experiment.</p>
    </div>

    <div class="work-grid">
        @forelse($projects as $project)
            <a class="work-card" href="{{ route('projects.show', $project->slug) }}"
               data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 80 }}">
                <img src="{{ $cover($project->cover_image) }}" alt="{{ $project->title }}">
                <div class="work-card__body">
                    <h2>{{ $project->title }}</h2>

                    @if($project->tech_stack)
                        <ul class="tech-chips">
                            @foreach(array_slice($project->tech_stack, 0, 4) as $tech)
                                <li>{{ trim($tech) }}</li>
                            @endforeach
                            @if(count($project->tech_stack) > 4)
                                <li>+{{ count($project->tech_stack) - 4 }}</li>
                            @endif
                        </ul>
                    @endif

                    <p>{{ Str::limit(strip_tags($project->description), 110) }}</p>
                    <span class="work-card__more">read more →</span>
                </div>
            </a>
        @empty
            <p class="empty-note">No projects published yet.</p>
        @endforelse
    </div>

    @if($projects->hasPages())
        <div class="pagination-wrap">
            {{ $projects->links() }}
        </div>
    @endif
</div>
@endsection
