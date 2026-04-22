@extends('layouts.frontend')

@section('title', 'Photography')

@section('content')
<section class="page-header">
    <div class="container">
        <h1 class="display-4 playfair text-gold" data-aos="fade-down">Photography</h1>
        <p class="lead" data-aos="fade-up">Frozen moments in time.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <!-- Filter -->
        <div class="d-flex justify-content-center gap-3 mb-5 flex-wrap" data-aos="fade-up">
            <a href="{{ route('gallery.index') }}" class="btn {{ !request('category') ? 'btn-gold' : 'btn-outline-navy' }}">All</a>
            @foreach($categories as $cat)
            <a href="{{ route('gallery.index', ['category' => $cat->slug]) }}" class="btn {{ request('category') == $cat->slug ? 'btn-gold' : 'btn-outline-navy' }}">{{ $cat->name }}</a>
            @endforeach
        </div>

        <!-- Masonry Grid -->
        <div class="row g-4 masonry-grid" id="gallery">
            @forelse($photos as $photo)
            <div class="col-md-4 col-sm-6 masonry-item" data-aos="zoom-in">
                <a href="{{ \Illuminate\Support\Str::startsWith($photo->image_path, 'http') ? $photo->image_path : asset($photo->image_path) }}" class="gallery-link">
                    <div class="luxury-border p-2 bg-white">
                        <img src="{{ \Illuminate\Support\Str::startsWith($photo->image_path, 'http') ? $photo->image_path : asset($photo->image_path) }}" alt="{{ $photo->title }}" class="img-fluid w-100 shadow-sm">
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No photos found in this category.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<style>
    .btn-outline-navy {
        border-color: var(--navy);
        color: var(--navy);
    }
    .btn-outline-navy:hover {
        background-color: var(--navy);
        color: white;
    }
    .gallery-link img {
        transition: 0.3s;
    }
    .gallery-link:hover img {
        opacity: 0.8;
    }
</style>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.14.2/simple-lightbox.min.css">
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.14.2/simple-lightbox.min.js"></script>
<script>
    var lightbox = new SimpleLightbox('.gallery-link', { /* options */ });
</script>
@endpush
