@extends('layouts.admin')

@section('page_title', 'Photography Gallery')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-luxury p-4 mb-4">
            <h4 class="playfair mb-4">Upload New Photos</h4>
            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Photos (Multiple)</label>
                        <input type="file" name="images[]" class="form-control" multiple required>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-gold w-100">Upload Gallery</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card card-luxury p-4">
            <h4 class="playfair mb-4">Gallery Photos</h4>
            <div class="row g-3">
                @foreach($photos as $photo)
                <div class="col-6 col-md-2 position-relative">
                    <img src="{{ asset($photo->image_path) }}" class="img-fluid border" style="height: 150px; width: 100%; object-fit: cover;">
                    <form action="{{ route('admin.galleries.destroy', $photo) }}" method="POST" class="position-absolute top-0 end-0 p-2">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger rounded-circle" onclick="return confirm('Delete photo?')">&times;</button>
                    </form>
                    <div class="small text-muted mt-1">{{ $photo->category->name }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
