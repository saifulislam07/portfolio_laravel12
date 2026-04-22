@extends('layouts.admin')

@section('page_title', 'Skills Management')

@section('content')
<div class="row">
    <!-- List Skills -->
    <div class="col-md-7">
        <div class="card card-luxury p-4">
            <h4 class="playfair mb-4">Current Skills</h4>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Skill Name</th>
                            <th>Proficiency</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($skills as $skill)
                        <tr>
                            <td>{{ $skill->name }}</td>
                            <td>
                                <div class="progress rounded-0" style="height: 5px; width: 100px;">
                                    <div class="progress-bar bg-gold" style="width: {{ $skill->percentage }}%"></div>
                                </div>
                                <small>{{ $skill->percentage }}%</small>
                            </td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-outline-primary edit-skill-btn" data-id="{{ $skill->id }}" data-name="{{ $skill->name }}" data-percentage="{{ $skill->percentage }}" data-bs-toggle="modal" data-bs-target="#editSkillModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete skill?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No skills added yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Skill Form -->
    <div class="col-md-5">
        <div class="card card-luxury p-4">
            <h4 class="playfair mb-4">Add New Skill</h4>
            <form action="{{ route('admin.skills.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Skill Name</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Laravel" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Proficiency (%)</label>
                    <input type="number" name="percentage" class="form-control" min="0" max="100" value="80" required>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-gold w-100">ADD SKILL</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Skill Modal -->
<div class="modal fade" id="editSkillModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content card-luxury">
            <div class="modal-header border-0">
                <h5 class="modal-title playfair">Edit Skill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editSkillForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Skill Name</label>
                        <input type="text" name="name" id="edit_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Proficiency (%)</label>
                        <input type="number" name="percentage" id="edit_percentage" class="form-control" min="0" max="100" required>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-gold">UPDATE SKILL</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
$(document).ready(function() {
    $('.edit-skill-btn').on('click', function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const percentage = $(this).data('percentage');
        
        $('#edit_name').val(name);
        $('#edit_percentage').val(percentage);
        $('#editSkillForm').attr('action', `/admin/skills/${id}`);
    });
});
</script>
@endpush
@endsection
