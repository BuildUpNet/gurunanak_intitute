@extends('admin.layouts.admin')

@section('title', 'Program Details | Admin')

@section('content')
<div class="page-title mb-4">
    <h2>Program Details</h2>
    <p>Manage dynamic program pages (MCA, BCA, MBA, etc.)</p>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="panel-card mb-3 admin-filter-bar">
    <form method="GET" class="row g-2 align-items-center">
        <div class="col-md-3">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search title...">
        </div>
        <div class="col-md-3">
            <select name="course_category_id" class="form-select">
                <option value="">— All Schools —</option>
                @foreach($courseCategories as $school)
                    <option value="{{ $school->id }}" {{ request('course_category_id') == $school->id ? 'selected' : '' }}>{{ $school->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="program_category_id" class="form-select">
                <option value="">— All Program Categories —</option>
                @foreach($programCategoryOptions as $cat)
                    <option value="{{ $cat->id }}" {{ request('program_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary flex-fill"><i class="fas fa-filter me-1"></i>Filter</button>
            <a href="{{ route('admin.program-details.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>
</div>

<div class="panel-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0" style="color:#0b1f3a;font-weight:700;">All Programs</h5>
        <a href="{{ route('admin.program-details.create') }}" class="btn btn-danger btn-sm px-4">
            <i class="fas fa-plus me-1"></i> Add New Program
        </a>
    </div>

    @if($programs->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="fas fa-graduation-cap fa-3x mb-3 d-block" style="color:#e2e8f0"></i>
            No programs yet. <a href="{{ route('admin.program-details.create') }}">Add one now.</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle" style="font-size:.875rem;">
                <thead style="background:#f8fafc;font-size:.72rem;letter-spacing:.06em;text-transform:uppercase;color:#64748b;">
                    <tr>
                        <th class="py-3 ps-3">#</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Level</th>
                        <th>Duration</th>
                        <th>Opportunities</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($programs as $i => $prog)
                        <tr>
                            <td class="ps-3 text-muted" style="width:40px;">{{ ($programs->currentPage() - 1) * $programs->perPage() + $i + 1 }}</td>
                            <td>
                                <div style="font-weight:700;color:#0b1f3a;">{{ $prog->title }}</div>
                                <div style="font-size:.72rem;color:#94a3b8;">{{ $prog->school->title ?? $prog->school_name }}</div>
                            </td>
                            <td><code style="font-size:.78rem;color:#1a3566;">/programs/{{ $prog->slug }}</code></td>
                            <td style="color:#475569;">{{ $prog->level }}</td>
                            <td style="color:#475569;">{{ $prog->duration }}</td>
                            <td>
                                <span class="badge" style="background:#e0e7ff;color:#3730a3;font-size:.7rem;">
                                    {{ $prog->opportunities()->count() }} items
                                </span>
                            </td>
                            <td>
                                @if($prog->status)
                                    <span class="badge bg-success" style="font-size:.7rem;">Active</span>
                                @else
                                    <span class="badge bg-secondary" style="font-size:.7rem;">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end pe-3">
                                <a href="{{ route('admin.program-details.edit', $prog) }}"
                                   class="btn btn-outline-primary btn-sm me-1" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a href="{{ url('/programs/' . $prog->slug) }}" target="_blank"
                                   class="btn btn-outline-secondary btn-sm me-1" title="View Page">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.program-details.destroy', $prog) }}"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete this program? This cannot be undone.')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $programs->links() }}
        </div>
    @endif
</div>
@endsection
