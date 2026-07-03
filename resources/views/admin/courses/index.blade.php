@extends('admin.layouts.admin')

@section('content')
    <div class="page-title mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>Courses</h2>
                <p>Manage course and program records</p>
            </div>

            <a href="{{ route('admin.courses.create') }}" class="btn px-4 py-2"
                style="background:#0d47a1; color:#fff; border-radius:10px;">
                <i class="fas fa-plus me-1"></i> Add Course
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="panel-card mb-3 admin-filter-bar">
        <form method="GET" class="row g-2 align-items-center">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search title...">
            </div>
            <div class="col-md-3">
                <select name="course_category_id" class="form-select">
                    <option value="">— All Categories —</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (string) request('course_category_id') === (string) $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">— All Status —</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill"><i class="fas fa-filter me-1"></i>Filter</button>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>

    <div class="panel-card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50">#</th>
                        <th>Course</th>
                        <th>Category</th>
                        <th>Slug</th>
                        <th>Duration</th>
                        <th>Eligibility</th>
                        <th>Status</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($courses as $key => $course)
                        <tr>
                            <td>{{ ($courses->currentPage() - 1) * $courses->perPage() + $key + 1 }}</td>
                            <td>
                                <strong>{{ $course->title }}</strong><br>

                                @if ($course->short_description)
                                    <small class="text-muted">
                                        {{ Str::limit($course->short_description, 55) }}
                                    </small>
                                @endif
                            </td>

                            <td>
                                @if ($course->category)
                                    <span class="badge bg-light text-dark border">
                                        {{ $course->category->title }}
                                    </span>
                                @else
                                    <span class="text-muted">No Category</span>
                                @endif
                            </td>

                            <td>{{ $course->slug }}</td>

                            <td>
                                @if ($course->duration_one)
                                    <small class="d-block">{{ $course->duration_one }}</small>
                                @endif

                                @if ($course->duration_two)
                                    <small class="d-block">{{ $course->duration_two }}</small>
                                @endif

                                @if (!$course->duration_one && !$course->duration_two)
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>

                            <td>
                                {{ $course->eligibility ?? 'N/A' }}
                            </td>

                            <td>
                                <span class="badge {{ $course->status ? 'bg-success' : 'bg-danger' }}">
                                    {{ $course->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('admin.courses.edit', $course->id) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.courses.destroy', $course->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete Course?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No Record Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $courses->links() }}
        </div>
    </div>
@endsection