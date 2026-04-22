@extends('layouts.admin')

@section('page_title', 'Projects')

@section('content')
<div class="card card-luxury p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="playfair">All Projects</h4>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-gold">Add New Project</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Cover</th>
                    <th>Title</th>
                    <th>Tech Stack</th>
                    <th>Featured</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td>
                        <img src="{{ \Illuminate\Support\Str::startsWith($project->cover_image, 'http') ? $project->cover_image : asset($project->cover_image) }}" alt="" style="width: 60px; height: 40px; object-fit: cover;">
                    </td>
                    <td>{{ $project->title }}</td>
                    <td>
                        @foreach($project->tech_stack as $tech)
                            <span class="badge bg-light text-navy border">{{ trim($tech) }}</span>
                        @endforeach
                    </td>
                    <td>
                        @if($project->is_featured)
                            <span class="badge bg-success">Yes</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this project?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $projects->links() }}
    </div>
</div>
@endsection
