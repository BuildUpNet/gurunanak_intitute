@extends('admin.layouts.admin')

@section('title', $role ? 'Edit Role' : 'Add Role')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-access-control.css') }}">
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h4 class="mb-0">
        <i class="fas {{ $role ? 'fa-edit' : 'fa-plus-circle' }} me-2 text-primary"></i>{{ $role ? 'Edit Role' : 'Add Role' }}
    </h4>
    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary btn-sm">
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

        <form action="{{ $role ? route('admin.roles.update', $role) : route('admin.roles.store') }}" method="POST">
            @csrf
            @if($role)
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Role Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" maxlength="100" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $role ? $role->name : '') }}" placeholder="e.g. Form Viewer" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    @php($status = (string) old('is_active', $role ? (int) $role->is_active : 1))
                    <select name="is_active" class="form-select">
                        <option value="1" {{ $status === '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $status === '0' ? 'selected' : '' }}>Disabled (users of this role can't log in)</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Description</label>
                <input type="text" name="description" maxlength="255" class="form-control"
                       value="{{ old('description', $role ? $role->description : '') }}" placeholder="What is this role for?">
            </div>

            <label class="form-label fw-semibold d-block">Permissions <span class="text-danger">*</span></label>
            <p class="text-muted small mb-3">Users of this role will only see and open the sections ticked here. Users, Roles and API Access always stay super-admin only.</p>

            @php($checked = old('permissions', $role ? ($role->permissions ?? []) : []))
            <div class="ac-perm-groups @error('permissions') ac-perm-groups--invalid @enderror">
                @foreach($permissionGroups as $group => $items)
                    <div class="ac-perm-group">
                        <div class="ac-perm-group-title">{{ $group }}</div>
                        @foreach($items as $key => $perm)
                            <label class="ac-perm-option">
                                <input type="checkbox" name="permissions[]" value="{{ $key }}" class="form-check-input"
                                       {{ in_array($key, $checked, true) ? 'checked' : '' }}>
                                <span>
                                    <strong>{{ $perm['label'] }}</strong>
                                    <small>{{ $perm['description'] }}</small>
                                </span>
                            </label>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> {{ $role ? 'Update Role' : 'Create Role' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
