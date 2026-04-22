@extends('layouts.admin')

@section('page_title', 'My Profile')

@section('content')
<div class="row g-4">
    <!-- Profile Information -->
    <div class="col-md-8">
        <div class="card card-luxury p-4 mb-4 shadow-sm border-0">
            <h4 class="playfair mb-1">Profile Information</h4>
            <p class="text-muted small mb-4">Update your account's profile information and email address.</p>

            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="mb-3">
                    <label class="form-label small fw-bold text-uppercase">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                    @if($errors->has('name'))
                        <div class="text-danger small mt-1">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-uppercase">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
                    @if($errors->has('email'))
                        <div class="text-danger small mt-1">{{ $errors->first('email') }}</div>
                    @endif

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-2">
                            <p class="text-sm text-dark">
                                Your email address is unverified.
                                <button form="send-verification" class="btn btn-link p-0 small text-decoration-none text-gold">Click here to re-send the verification email.</button>
                            </p>
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-success">A new verification link has been sent to your email address.</p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="mt-4 d-flex align-items-center gap-3">
                    <button type="submit" class="btn btn-black px-4">SAVE CHANGES</button>
                    @if (session('status') === 'profile-updated')
                        <span class="text-success small"><i class="fas fa-check-circle me-1"></i> Saved.</span>
                    @endif
                </div>
            </form>
            
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>
        </div>

        <!-- Update Password -->
        <div class="card card-luxury p-4 mb-4 shadow-sm border-0">
            <h4 class="playfair mb-1">Update Password</h4>
            <p class="text-muted small mb-4">Ensure your account is using a long, random password to stay secure.</p>

            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label class="form-label small fw-bold text-uppercase">Current Password</label>
                    <input type="password" name="current_password" class="form-control" autocomplete="current-password">
                    @if($errors->updatePassword->has('current_password'))
                        <div class="text-danger small mt-1">{{ $errors->updatePassword->first('current_password') }}</div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-uppercase">New Password</label>
                    <input type="password" name="password" class="form-control" autocomplete="new-password">
                    @if($errors->updatePassword->has('password'))
                        <div class="text-danger small mt-1">{{ $errors->updatePassword->first('password') }}</div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-uppercase">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                    @if($errors->updatePassword->has('password_confirmation'))
                        <div class="text-danger small mt-1">{{ $errors->updatePassword->first('password_confirmation') }}</div>
                    @endif
                </div>

                <div class="mt-4 d-flex align-items-center gap-3">
                    <button type="submit" class="btn btn-black px-4">UPDATE PASSWORD</button>
                    @if (session('status') === 'password-updated')
                        <span class="text-success small"><i class="fas fa-check-circle me-1"></i> Updated.</span>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Account -->
    <div class="col-md-4">
        <div class="card card-luxury p-4 shadow-sm border-0">
            <h4 class="playfair mb-1 text-danger">Delete Account</h4>
            <p class="text-muted small mb-4">Once your account is deleted, all of its resources and data will be permanently deleted.</p>

            <button type="button" class="btn btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                DELETE ACCOUNT
            </button>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content card-luxury">
            <div class="modal-header border-0">
                <h5 class="modal-title playfair text-danger">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <p class="text-muted small">Are you sure you want to delete your account? Please enter your password to confirm you would like to permanently delete your account.</p>
                    <div class="mt-3">
                        <label class="form-label small fw-bold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                        @if($errors->userDeletion->has('password'))
                            <div class="text-danger small mt-1">{{ $errors->userDeletion->first('password') }}</div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger px-4">DELETE PERMANENTLY</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
