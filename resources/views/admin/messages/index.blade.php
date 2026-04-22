@extends('layouts.admin')

@section('page_title', 'Contact Messages')

@section('content')
<div class="card card-luxury p-4">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                <tr id="message-row-{{ $message->id }}" class="{{ $message->is_read ? '' : 'fw-bold' }}">
                    <td id="status-{{ $message->id }}">
                        @if($message->is_read)
                            <span class="badge bg-light text-muted border">Read</span>
                        @else
                            <span class="badge bg-gold">New</span>
                        @endif
                    </td>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->created_at->format('M d, Y') }}</td>
                    <td class="text-end">
                        <button type="button" class="btn btn-sm btn-outline-primary view-msg-btn" 
                                data-id="{{ $message->id }}"
                                data-name="{{ $message->name }}"
                                data-email="{{ $message->email }}"
                                data-message="{{ $message->message }}"
                                data-bs-toggle="modal" data-bs-target="#viewMessageModal">
                            View
                        </button>
                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete message?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Dynamic Message Modal -->
<div class="modal fade" id="viewMessageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content card-luxury">
            <div class="modal-header border-0">
                <h5 class="modal-title playfair" id="modalName">Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong class="text-muted small text-uppercase">From:</strong> <span id="modalEmail"></span></p>
                <hr class="my-3">
                <div id="modalContent" class="lead fs-6" style="white-space: pre-line;"></div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
$(document).ready(function() {
    $('.view-msg-btn').on('click', function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const email = $(this).data('email');
        const message = $(this).data('message');
        
        $('#modalName').text('Message from ' + name);
        $('#modalEmail').text(email);
        $('#modalContent').text(message);
        
        // Mark as read via AJAX if it's currently unread
        const row = $('#message-row-' + id);
        if (row.hasClass('fw-bold')) {
            $.ajax({
                url: `/admin/messages/mark-read/${id}`,
                method: 'POST',
                data: { _token: '{{ csrf_token() }}' },
                success: function() {
                    row.removeClass('fw-bold');
                    $('#status-' + id).html('<span class="badge bg-light text-muted border">Read</span>');
                }
            });
        }
    });
});
</script>
@endpush
@endsection
