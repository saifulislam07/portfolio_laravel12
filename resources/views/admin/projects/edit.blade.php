@extends('layouts.admin')

@section('page_title', 'Edit Project')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card card-luxury p-4">
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Project Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $project->title }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Short Description</label>
                    <textarea name="description" class="form-control" rows="3" required>{{ $project->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Problem (Case Study)</label>
                    <textarea name="problem" class="form-control" rows="3">{{ $project->problem }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Solution (Case Study)</label>
                    <textarea name="solution" class="form-control" rows="3">{{ $project->solution }}</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Cover Image</label>
                    <input type="file" name="cover_image" class="form-control">
                    @if($project->cover_image)
                        <div class="mt-2">
                            <img src="{{ \Illuminate\Support\Str::startsWith($project->cover_image, 'http') ? $project->cover_image : asset($project->cover_image) }}" alt="" style="width: 100px;">
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Gallery Images (Multiple)</label>
                    <input type="file" name="gallery_images[]" class="form-control" multiple>
                    <div class="mt-2 d-flex gap-3 flex-wrap">
                        @foreach($project->images as $img)
                            <div class="position-relative border p-1 bg-white shadow-sm" style="width: 80px; height: 60px;">
                                <img src="{{ \Illuminate\Support\Str::startsWith($img->image_path, 'http') ? $img->image_path : asset($img->image_path) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                <button type="button" class="btn btn-danger btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center position-absolute" 
                                        style="top: -10px; right: -10px; z-index: 10; width: 22px; height: 22px; border: 2px solid white;" 
                                        onclick="if(confirm('Remove this image?')) document.getElementById('delete-image-{{ $img->id }}').submit();">
                                    <i class="fas fa-times" style="font-size: 10px;"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tech Stack (comma separated)</label>
                    <input type="text" name="tech_stack" class="form-control" value="{{ is_array($project->tech_stack) ? implode(', ', $project->tech_stack) : $project->tech_stack }}" placeholder="Laravel, Bootstrap, MySQL">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_featured" class="form-check-input" id="featured" {{ $project->is_featured ? 'checked' : '' }}>
                    <label class="form-check-label" for="featured">Featured Project</label>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-gold w-100">Update Project</button>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-light w-100 mt-2">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- Hidden forms for image deletion --}}
@foreach($project->images as $img)
    <form id="delete-image-{{ $img->id }}" action="{{ route('admin.projects.deleteImage', $img->id) }}" method="POST" style="display: none;">
        @csrf @method('DELETE')
    </form>
@endforeach

@endsection
