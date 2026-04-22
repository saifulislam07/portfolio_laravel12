@extends('layouts.admin')

@section('page_title', 'Hobbies Management')

@section('content')
<div class="row">
    <!-- List Hobbies -->
    <div class="col-md-7">
        <div class="card card-luxury p-4">
            <h4 class="playfair mb-4">Current Hobbies</h4>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Hobby Name</th>
                            <th>Icon Class</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($hobbies as $hobby)
                        <tr>
                            <td>
                                <i class="{{ $hobby->icon ?? 'fas fa-star' }} text-gold me-2"></i>
                                {{ $hobby->name }}
                            </td>
                            <td><code>{{ $hobby->icon ?? 'fas fa-star' }}</code></td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-outline-primary edit-hobby-btn" 
                                        data-id="{{ $hobby->id }}" 
                                        data-name="{{ $hobby->name }}" 
                                        data-icon="{{ $hobby->icon }}" 
                                        data-bs-toggle="modal" data-bs-target="#editHobbyModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.hobbies.destroy', $hobby) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete hobby?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No hobbies added yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Hobby Form -->
    <div class="col-md-5">
        <div class="card card-luxury p-4">
            <h4 class="playfair mb-4">Add New Hobby</h4>
            <form action="{{ route('admin.hobbies.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Hobby Name</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Photography" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Icon Class (FontAwesome)</label>
                    <input type="text" name="icon" class="form-control" placeholder="e.g. fas fa-camera" value="fas fa-star">
                    <small class="text-muted">Use <a href="https://fontawesome.com/v5/search?m=free" target="_blank">FontAwesome 5</a> classes.</small>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-gold w-100">ADD HOBBY</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Hobby Modal -->
<div class="modal fade" id="editHobbyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content card-luxury">
            <div class="modal-header border-0">
                <h5 class="modal-title playfair">Edit Hobby</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editHobbyForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Hobby Name</label>
                        <input type="text" name="name" id="edit_hobby_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon Class</label>
                        <input type="text" name="icon" id="edit_hobby_icon" class="form-control">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-gold">UPDATE HOBBY</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
$(document).ready(function() {
    $('.edit-hobby-btn').on('click', function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const icon = $(this).data('icon');
        
        $('#edit_hobby_name').val(name);
        $('#edit_hobby_icon').val(icon);
        $('#editHobbyForm').attr('action', `/admin/hobbies/${id}`);
    });
});
</script>
@endpush
@endsection
