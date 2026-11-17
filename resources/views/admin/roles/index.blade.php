@extends('admin.layouts.admin')

@section('title', 'Roles & Permissions')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-access-control.css') }}">
@endsection

@section('content')

<div class="page-title mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h2>Roles &amp; Permissions</h2>
            <p>Decide what each role can open in the admin panel. Changes apply to its users on their next click.</p>
        </div>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Role
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="panel-card mb-3 admin-filter-bar">
    <form method="GET" class="row g-2 align-items-center">
        <div class="col-md-9">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search role name...">
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary flex-fill"><i class="fas fa-filter me-1"></i>Filter</button>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="ac-thead">
                    <tr>
                        <th>#</th>
                        <th>Role</th>
                        <th>Permissions</th>
                        <th>Users</th>
                        <th>Status</th>
                        <th class="ac-action-col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $key => $role)
                        <tr>
                            <td>{{ ($roles->currentPage() - 1) * $roles->perPage() + $key + 1 }}</td>
                            <td>
                                <div class="fw-semibold">{{ $role->name }}</div>
                                @if($role->description)
                                    <small class="text-muted">{{ $role->description }}</small>
                                @endif
                            </td>
                            <td>
                                <div class="ac-perm-list">
                                    @foreach($role->permissions ?? [] as $perm)
                                        @if(isset($permissions[$perm]))
                                            <span class="ac-perm-badge">{{ $permissions[$perm]['label'] }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            </td>
                            <td>{{ $role->users_count }}</td>
                            <td>
                                @if($role->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Disabled</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.roles.toggle', $role) }}" method="POST"
                                          onsubmit="return confirm('{{ $role->is_active ? 'Disable this role? All its users lose access immediately.' : 'Enable this role?' }}')">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm {{ $role->is_active ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                                title="{{ $role->is_active ? 'Disable' : 'Enable' }}">
                                            <i class="fas {{ $role->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST"
                                          onsubmit="return confirm('Delete this role?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No roles found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $roles->links() }}
    </div>
</div>

@endsection
