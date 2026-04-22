@extends('layouts.admin')

@section('page_title', 'Add Project')

@section('content')
<div class="card card-luxury p-4">
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Project Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Short Description</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Problem (Case Study)</label>
                    <textarea name="problem" class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Solution (Case Study)</label>
                    <textarea name="solution" class="form-control" rows="3"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Cover Image</label>
                    <input type="file" name="cover_image" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gallery Images (Multiple)</label>
                    <input type="file" name="gallery_images[]" class="form-control" multiple>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tech Stack (comma separated)</label>
                    <input type="text" name="tech_stack" class="form-control" placeholder="Laravel, Bootstrap, MySQL">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_featured" class="form-check-input" id="featured">
                    <label class="form-check-label" for="featured">Featured Project</label>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-gold w-100">Save Project</button>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-light w-100 mt-2">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
