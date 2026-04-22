@extends('layouts.frontend')

@section('title', 'Contact')

@section('content')
<section class="page-header">
    <div class="container">
        <h1 class="display-4 playfair text-gold" data-aos="fade-down">Contact Me</h1>
        <p class="lead" data-aos="fade-up">Let's create something beautiful together.</p>
    </div>
</section>

<section class="py-5 my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6" data-aos="fade-right">
                <div class="card card-luxury p-5 h-100">
                    <h3 class="playfair mb-4">Send a Message</h3>
                    <form id="contactForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control luxury-input" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control luxury-input" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message" class="form-control luxury-input" rows="5" required></textarea>
                        </div>
                        <div id="responseMessage" class="mt-3"></div>
                        <button type="submit" id="submitBtn" class="btn btn-gold w-100 mt-4 py-3">SEND MESSAGE</button>
                    </form>
                </div>
            </div>
            <div class="col-md-4 mt-5 mt-md-0" data-aos="fade-left">
                <div class="mb-5">
                    <h4 class="playfair text-gold">Location</h4>
                    <p class="text-navy opacity-75">{{ $settings['address'] ?? 'Based in Bangladesh, Available Worldwide.' }}</p>
                </div>
                <div class="mb-5">
                    <h4 class="playfair text-gold">Collaboration</h4>
                    <p class="text-navy opacity-75">I'm always open to discussing new projects, creative ideas or opportunities to be part of your visions.</p>
                </div>
                <div>
                    <h4 class="playfair text-gold">Connect</h4>
                    <div class="d-flex gap-3 fs-5 mt-3">
                        @php $socials = \App\Models\Setting::whereIn('key', ['facebook', 'linkedin', 'github', 'whatsapp'])->pluck('value', 'key'); @endphp
                        @if($socials->get('facebook')) <a href="{{ $socials->get('facebook') }}" class="text-navy" target="_blank"><i class="fab fa-facebook-f"></i></a> @endif
                        @if($socials->get('linkedin')) <a href="{{ $socials->get('linkedin') }}" class="text-navy" target="_blank"><i class="fab fa-linkedin-in"></i></a> @endif
                        @if($socials->get('github')) <a href="{{ $socials->get('github') }}" class="text-navy" target="_blank"><i class="fab fa-github"></i></a> @endif
                        @if($socials->get('whatsapp')) <a href="https://wa.me/{{ $socials->get('whatsapp') }}" class="text-navy" target="_blank"><i class="fab fa-whatsapp"></i></a> @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .luxury-input {
        border-radius: 0;
        border: 1px solid #ddd;
        padding: 12px;
        transition: border-color 0.3s;
    }
    .luxury-input:focus {
        border-color: var(--gold);
        box-shadow: none;
    }
</style>
@endsection

@push('js')
<script>
$(document).ready(function() {
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        let btn = $('#submitBtn');
        let form = $(this);
        
        btn.prop('disabled', true).text('SENDING...');
        
        $.ajax({
            url: "{{ route('contact.store') }}",
            method: "POST",
            data: form.serialize(),
            success: function(response) {
                $('#responseMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                form[0].reset();
                btn.prop('disabled', false).text('SEND MESSAGE');
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let errorHtml = '<div class="alert alert-danger"><ul>';
                $.each(errors, function(key, val) {
                    errorHtml += '<li>' + val[0] + '</li>';
                });
                errorHtml += '</ul></div>';
                $('#responseMessage').html(errorHtml);
                btn.prop('disabled', false).text('SEND MESSAGE');
            }
        });
    });
});
</script>
@endpush
