@extends('admin.layouts.admin')

@section('title', $staff ? 'Edit User' : 'Add User')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-access-control.css') }}">
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h4 class="mb-0">
        <i class="fas {{ $staff ? 'fa-user-edit' : 'fa-user-plus' }} me-2 text-primary"></i>{{ $staff ? 'Edit User' : 'Add User' }}
    </h4>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card shadow-sm ac-form-card">
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($roles->isEmpty())
            <div class="alert alert-warning">
                No roles exist yet. <a href="{{ route('admin.roles.create') }}">Create a role</a> first.
            </div>
        @endif

        <form action="{{ $staff ? route('admin.users.update', $staff) : route('admin.users.store') }}" method="POST" autocomplete="off">
            @csrf
            @if($staff)
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" maxlength="150" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $staff ? $staff->name : '') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Login Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" maxlength="150" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $staff ? $staff->email : '') }}" autocomplete="off" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
                    @php($roleId = (string) old('role_id', $staff ? $staff->role_id : ''))
                    <select name="role_id" class="form-select @error('role_id') is-invalid @enderror" required>
                        <option value="">— Select Role —</option>
                        @foreach($roles as $r)
                            <option value="{{ $r->id }}" {{ $roleId === (string) $r->id ? 'selected' : '' }}>
                                {{ $r->name }}{{ $r->is_active ? '' : ' (disabled)' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Access <span class="text-danger">*</span></label>
                    @php($status = (string) old('is_active', $staff ? (int) $staff->is_active : 1))
                    <select name="is_active" class="form-select">
                        <option value="1" {{ $status === '1' ? 'selected' : '' }}>Enabled</option>
                        <option value="0" {{ $status === '0' ? 'selected' : '' }}>Disabled (cannot log in)</option>
                    </select>
                </div>
            </div>

            <div class="ac-password-box">
                <div class="fw-semibold mb-1">{{ $staff ? 'Reset Password' : 'Password' }}</div>
                <p class="text-muted small mb-3">
                    @if($staff)
                        Leave blank to keep the current password. A new password signs this user out everywhere.
                    @else
                        Share it with the user privately; they can change it from their Profile page.
                    @endif
                    Minimum 8 characters with upper &amp; lower case letters, a number and a symbol.
                </p>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password @unless($staff)<span class="text-danger">*</span>@endunless</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                               autocomplete="new-password" {{ $staff ? '' : 'required' }}>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Confirm Password @unless($staff)<span class="text-danger">*</span>@endunless</label>
                        <input type="password" name="password_confirmation" class="form-control"
                               autocomplete="new-password" {{ $staff ? '' : 'required' }}>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary" {{ $roles->isEmpty() ? 'disabled' : '' }}>
                    <i class="fas fa-save me-1"></i> {{ $staff ? 'Update User' : 'Create User' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
