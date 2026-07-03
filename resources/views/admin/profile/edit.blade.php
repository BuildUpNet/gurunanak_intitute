@extends('admin.layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-profile-edit.css') }}">
@endsection

@section('content')
<div class="page-title mb-4">
    <h2>My Profile</h2>
    <p>Manage your profile information and password</p>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="panel-card profile-card">
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-section-title">
            <i class="fas fa-user"></i>
            Profile Information
        </div>

        <div class="row">
            <div class="col-md-4 mb-4 text-center">
                <label for="profilePhoto" class="profile-upload">
                    <input type="file" name="profile_photo" id="profilePhoto" hidden accept="image/*">

                    <img id="profilePreview"
                        src="{{ $user->profile_photo ? asset($user->profile_photo) : asset('admin-assets/images/default-user.png') }}"
                        alt="Profile Photo">

                    <div class="upload-overlay">
                        <i class="fas fa-camera"></i>
                        <span>Change Photo</span>
                    </div>
                </label>

                @error('profile_photo')
                    <small class="text-danger d-block mt-2">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-8">
                <div class="mb-4">
                    <label class="form-label">Name <span>*</span></label>
                    <input type="text" name="name" class="form-control custom-input"
                        value="{{ old('name', $user->name) }}" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Email <span>*</span></label>
                    <input type="email" name="email" class="form-control custom-input"
                        value="{{ old('email', $user->email) }}" required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <button type="submit" class="btn save-btn">
                    <i class="fas fa-save"></i> Update Profile
                </button>
            </div>
        </div>
    </form>
</div>

<div class="panel-card profile-card mt-4">
    <form action="{{ route('admin.profile.password') }}" method="POST">
        @csrf

        <div class="form-section-title">
            <i class="fas fa-lock"></i>
            Change Password
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <label class="form-label">Current Password <span>*</span></label>
                <input type="password" name="current_password" class="form-control custom-input" required>
                @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4 mb-4">
                <label class="form-label">New Password <span>*</span></label>
                <input type="password" name="password" class="form-control custom-input" required>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4 mb-4">
                <label class="form-label">Confirm Password <span>*</span></label>
                <input type="password" name="password_confirmation" class="form-control custom-input" required>
            </div>
        </div>

        <button type="submit" class="btn save-btn">
            <i class="fas fa-key"></i> Change Password
        </button>
    </form>
</div>

<script>
    document.getElementById('profilePhoto').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('profilePreview');

        if (file) {
            preview.src = URL.createObjectURL(file);
        }
    });
</script>
@endsection