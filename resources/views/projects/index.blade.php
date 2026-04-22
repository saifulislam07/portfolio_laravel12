@extends('layouts.frontend')

@section('title', 'Work')

@section('content')
<section class="page-header">
    <div class="container">
        <h1 class="display-4 playfair text-gold" data-aos="fade-down">My Work</h1>
        <p class="lead" data-aos="fade-up">A collection of systems I've built.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            @forelse($projects as $project)
            <div class="col-lg-6" data-aos="fade-up">
                <div class="row align-items-center g-4">
                    <div class="col-md-5">
                        <div class="luxury-border p-2">
                            <img src="{{ \Illuminate\Support\Str::startsWith($project->cover_image, 'http') ? $project->cover_image : asset($project->cover_image) }}" alt="{{ $project->title }}" class="img-fluid w-100 shadow">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <h4 class="playfair mb-3">{{ $project->title }}</h4>
                        <div class="mb-3">
                            @foreach($project->tech_stack as $tech)
                                <span class="badge rounded-0 border text-navy fw-normal me-1" style="font-size: 0.7rem;">{{ trim($tech) }}</span>
                            @endforeach
                        </div>
                        <p class="text-muted small">{{ Str::limit($project->description, 120) }}</p>
                        <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-sm btn-gold mt-2">VIEW DETAILS</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No projects found.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $projects->links() }}
        </div>
    </div>
</section>
@endsection
