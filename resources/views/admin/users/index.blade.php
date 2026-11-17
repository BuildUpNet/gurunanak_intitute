@extends('admin.layouts.admin')

@section('title', 'Users & Access')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-access-control.css') }}">
@endsection

@section('content')

<div class="page-title mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h2>Users &amp; Access</h2>
            <p>Staff logins for the admin panel. Each user only gets the access of their role.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-user-shield"></i> Manage Roles
            </a>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Add User
            </a>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="panel-card mb-3 admin-filter-bar">
    <form method="GET" class="row g-2 align-items-center">
        <div class="col-md-5">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search name or email...">
        </div>
        <div class="col-md-2">
            <select name="role_id" class="form-select">
                <option value="">— All Roles —</option>
                @foreach($roles as $r)
                    <option value="{{ $r->id }}" {{ (string) request('role_id') === (string) $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">— All Status —</option>
                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Disabled</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary flex-fill"><i class="fas fa-filter me-1"></i>Filter</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Reset</a>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Last Login</th>
                        <th>Access</th>
                        <th class="ac-action-col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $key => $u)
                        <tr>
                            <td>{{ ($users->currentPage() - 1) * $users->perPage() + $key + 1 }}</td>
                            <td class="fw-semibold">{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>
                                @if($u->staffRole)
                                    <span class="ac-perm-badge">{{ $u->staffRole->name }}</span>
                                    @unless($u->staffRole->is_active)
                                        <small class="text-danger d-block">Role disabled</small>
                                    @endunless
                                @else
                                    <span class="text-danger">No role</span>
                                @endif
                            </td>
                            <td>
                                @if($u->last_login_at)
                                    {{ $u->last_login_at->format('d M Y, h:i A') }}
                                    <small class="text-muted d-block">{{ $u->last_login_ip }}</small>
                                @else
                                    <span class="text-muted">Never</span>
                                @endif
                            </td>
                            <td>
                                @if($u->is_active)
                                    <span class="badge bg-success">Enabled</span>
                                @else
                                    <span class="badge bg-danger">Disabled</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.users.edit', $u) }}" class="btn btn-sm btn-warning" title="Edit / Change Role">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.users.toggle', $u) }}" method="POST"
                                          onsubmit="return confirm('{{ $u->is_active ? 'Disable access for this user? They will be signed out.' : 'Enable access for this user?' }}')">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm {{ $u->is_active ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                                title="{{ $u->is_active ? 'Disable Access' : 'Enable Access' }}">
                                            <i class="fas {{ $u->is_active ? 'fa-user-lock' : 'fa-user-check' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.destroy', $u) }}" method="POST"
                                          onsubmit="return confirm('Delete this user permanently?')">
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
                            <td colspan="7" class="text-center text-muted py-4">No staff users yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $users->links() }}
    </div>
</div>

@endsection
