@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/auth-login.css') }}">
@endsection

@section('content')
    <div class="login-wrapper">
        <div class="login-card">

            <div class="login-header">
                <div class="login-icon">
                    <i class="fas fa-user-shield"></i>
                </div>

                <h2>Admin Login</h2>
                <p>Enter your credentials to access admin panel</p>
            </div>

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <div class="form-group mb-3">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter Email"
                        value="{{ old('email') }}" autocomplete="username" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter Password"
                        autocomplete="current-password" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="login-btn">
                    Login Now
                </button>
            </form>

            <div class="back-link">
                <a href="{{ url('/') }}">
                    <i class="fas fa-arrow-left"></i> Back to Website
                </a>
            </div>

        </div>
    </div>

@endsection
