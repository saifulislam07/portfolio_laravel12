@extends('layouts.frontend')

@section('title', 'Contact')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/pages.css') }}">
@endpush

@section('content')
@php
    $socials = \App\Models\Setting::whereIn('key', ['facebook', 'linkedin', 'github', 'whatsapp'])->pluck('value', 'key');
@endphp

<div class="page-shell">

    <div class="page-head">
        <p class="prompt"><span class="sign">$ </span>ping me</p>
        <h1>Contact</h1>
        <p>Got a project, a role, or a question? Send it over — I read everything that lands here.</p>
    </div>

    <div class="contact-grid">
        <div class="form-card" data-aos="fade-right">
            <h2>Send a message</h2>

            <form id="contactForm">
                @csrf
                <div class="field">
                    <label for="cf-name">Full name</label>
                    <input id="cf-name" type="text" name="name" required>
                </div>
                <div class="field">
                    <label for="cf-email">Email address</label>
                    <input id="cf-email" type="email" name="email" required>
                </div>
                <div class="field">
                    <label for="cf-message">Message</label>
                    <textarea id="cf-message" name="message" rows="6" required></textarea>
                </div>

                <div id="responseMessage" class="form-note"></div>

                <button type="submit" id="submitBtn" class="btn-submit">SEND MESSAGE</button>
            </form>
        </div>

        <div data-aos="fade-left">
            @if(!empty($settings['email']))
                <div class="contact-block">
                    <h3>Email</h3>
                    <p><a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a></p>
                </div>
            @endif

            @if(!empty($settings['phone']))
                <div class="contact-block">
                    <h3>Phone</h3>
                    <p><a href="tel:{{ $settings['phone'] }}">{{ $settings['phone'] }}</a></p>
                </div>
            @endif

            <div class="contact-block">
                <h3>Location</h3>
                <p>{{ $settings['address'] ?? 'Based in Bangladesh, available worldwide.' }}</p>
            </div>

            <div class="contact-block">
                <h3>Collaboration</h3>
                <p>Open to new projects, creative ideas and opportunities to be part of something worth building.</p>
            </div>

            <div class="contact-block">
                <h3>Elsewhere</h3>
                <div class="contact-links">
                    @if($socials->get('github'))
                        <a href="{{ $socials->get('github') }}" target="_blank" rel="noopener">./github</a>
                    @endif
                    @if($socials->get('linkedin'))
                        <a href="{{ $socials->get('linkedin') }}" target="_blank" rel="noopener">./linkedin</a>
                    @endif
                    @if($socials->get('facebook'))
                        <a href="{{ $socials->get('facebook') }}" target="_blank" rel="noopener">./facebook</a>
                    @endif
                    @if($socials->get('whatsapp'))
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $socials->get('whatsapp')) }}" target="_blank" rel="noopener">./whatsapp</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
$(document).ready(function () {
    $('#contactForm').on('submit', function (e) {
        e.preventDefault();

        var btn = $('#submitBtn');
        var form = $(this);

        btn.prop('disabled', true).text('SENDING...');

        $.ajax({
            url: "{{ route('contact.store') }}",
            method: "POST",
            data: form.serialize(),
            success: function (response) {
                $('#responseMessage').html('<span class="ok">' + response.message + '</span>');
                form[0].reset();
                btn.prop('disabled', false).text('SEND MESSAGE');
            },
            error: function (xhr) {
                var errors = (xhr.responseJSON && xhr.responseJSON.errors) || {};
                var html = '<span class="bad"><ul>';
                $.each(errors, function (key, val) {
                    html += '<li>' + val[0] + '</li>';
                });
                if ($.isEmptyObject(errors)) {
                    html += '<li>Something went wrong. Please try again.</li>';
                }
                html += '</ul></span>';
                $('#responseMessage').html(html);
                btn.prop('disabled', false).text('SEND MESSAGE');
            }
        });
    });
});
</script>
@endpush
