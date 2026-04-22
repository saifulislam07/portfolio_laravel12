@extends('layouts.admin')

@section('page_title', 'Site Settings')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-luxury p-4">
            <h4 class="playfair mb-4">General Settings</h4>
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Site Title</label>
                    <input type="text" name="site_title" class="form-control" value="{{ $settings['site_title'] ?? '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Logo</label>
                    <input type="file" name="logo" class="form-control">
                    @if(isset($settings['logo']))
                        <img src="{{ asset($settings['logo']) }}" alt="Logo" class="mt-2" style="height: 50px;">
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Hero Image (Home Page)</label>
                    <input type="file" name="hero_image" class="form-control">
                    @if(isset($settings['hero_image']))
                        <img src="{{ \Illuminate\Support\Str::startsWith($settings['hero_image'], 'http') ? $settings['hero_image'] : asset($settings['hero_image']) }}" alt="Hero Image" class="mt-2 border shadow-sm" style="height: 100px;">
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">About Page Image</label>
                    <input type="file" name="about_image" class="form-control">
                    @if(isset($settings['about_image']))
                        <img src="{{ \Illuminate\Support\Str::startsWith($settings['about_image'], 'http') ? $settings['about_image'] : asset($settings['about_image']) }}" alt="About Image" class="mt-2 border shadow-sm" style="height: 100px;">
                    @endif
                </div>

                <hr class="my-4">
                <h4 class="playfair mb-3">Bio & About</h4>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="bio_name" class="form-control" value="{{ $settings['bio_name'] ?? '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Title/Designation</label>
                    <input type="text" name="bio_title" class="form-control" value="{{ $settings['bio_title'] ?? '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Hero Tagline</label>
                    <input type="text" name="bio_tagline" class="form-control" value="{{ $settings['bio_tagline'] ?? '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">About Page Title</label>
                    <input type="text" name="about_title" class="form-control" value="{{ $settings['about_title'] ?? '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">About Page Subtitle</label>
                    <input type="text" name="about_subtitle" class="form-control" value="{{ $settings['about_subtitle'] ?? '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Bio Description</label>
                    <textarea name="bio_description" class="form-control" rows="5">{{ $settings['bio_description'] ?? '' }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Hobbies (comma separated)</label>
                    <input type="text" name="hobbies" class="form-control" value="{{ $settings['hobbies'] ?? '' }}" placeholder="e.g. Photography, Reading, Traveling">
                </div>

                <hr class="my-4">
                <h4 class="playfair mb-3">SEO & Analytics</h4>
                <div class="mb-3">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="3">{{ $settings['meta_description'] ?? '' }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" value="{{ $settings['meta_keywords'] ?? '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Google Analytics ID (G-XXXXXXX)</label>
                    <input type="text" name="google_analytics" class="form-control" value="{{ $settings['google_analytics'] ?? '' }}" placeholder="G-XXXXXXXXXX">
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_maintenance" id="maintSwitch" value="1" {{ ($settings['is_maintenance'] ?? '0') == '1' ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold text-danger" for="maintSwitch">Enable Maintenance Mode</label>
                    </div>
                    <small class="text-muted">When enabled, visitors will see the "Under Maintenance" page. Admins will still have access.</small>
                </div>

                <hr class="my-4">
                <h4 class="playfair mb-3">SMTP Settings</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mail Host</label>
                        <input type="text" name="mail_host" class="form-control" value="{{ $settings['mail_host'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mail Port</label>
                        <input type="text" name="mail_port" class="form-control" value="{{ $settings['mail_port'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mail Username</label>
                        <input type="text" name="mail_username" class="form-control" value="{{ $settings['mail_username'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mail Password</label>
                        <input type="password" name="mail_password" class="form-control" value="{{ $settings['mail_password'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Mail Encryption</label>
                        <input type="text" name="mail_encryption" class="form-control" value="{{ $settings['mail_encryption'] ?? '' }}" placeholder="tls/ssl">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Mail From Address</label>
                        <input type="text" name="mail_from_address" class="form-control" value="{{ $settings['mail_from_address'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Mail From Name</label>
                        <input type="text" name="mail_from_name" class="form-control" value="{{ $settings['mail_from_name'] ?? '' }}">
                    </div>
                </div>

                <hr class="my-4">
                <h4 class="playfair mb-3">Social Links</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Facebook</label>
                            <input type="text" name="facebook" class="form-control" value="{{ $settings['facebook'] ?? '' }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">LinkedIn</label>
                            <input type="text" name="linkedin" class="form-control" value="{{ $settings['linkedin'] ?? '' }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">WhatsApp</label>
                            <input type="text" name="whatsapp" class="form-control" value="{{ $settings['whatsapp'] ?? '' }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">GitHub</label>
                            <input type="text" name="github" class="form-control" value="{{ $settings['github'] ?? '' }}">
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-gold px-5">Save All Settings</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
