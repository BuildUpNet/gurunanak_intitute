@extends('admin.layouts.admin')

@section('content')

<div class="page-title mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2>Course Categories</h2>
            <p>Manage Course Category Records</p>
        </div>

        <a href="{{ route('admin.course-categories.create') }}"
            class="btn px-4 py-2"
            style="background:#0d47a1;color:#fff;border-radius:10px;">
            <i class="fas fa-plus me-1"></i>
            Add Category
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="panel-card mb-3 admin-filter-bar">
    <form method="GET" class="row g-2 align-items-center">
        <div class="col-md-6">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search title...">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">— All Status —</option>
                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary flex-fill"><i class="fas fa-filter me-1"></i>Filter</button>
            <a href="{{ route('admin.course-categories.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>
</div>

<div class="panel-card">

    <div class="table-responsive">

        <table class="table table-bordered align-middle">

            <thead class="table-light">
                <tr>
                    <th width="80">#</th>
                    <th width="100">Icon</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th width="120">Sort Order</th>
                    <th width="120">Status</th>
                    <th width="180">Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($coursecategories as $key => $category)

                    <tr>

                        <td>{{ ($coursecategories->currentPage() - 1) * $coursecategories->perPage() + $key + 1 }}</td>

                        <td>
                            @if($category->icon)

                                <div class="d-flex align-items-center justify-content-center"
                                    style="width:50px;height:50px;background:#f5f7ff;border-radius:10px;">

                                    <i class="{{ $category->icon }}"
                                        style="font-size:20px;color:#0d47a1;"></i>

                                </div>

                            @else

                                <span class="text-muted">N/A</span>

                            @endif
                        </td>

                        <td>
                            <strong>{{ $category->title }}</strong>
                        </td>

                        <td>
                            <code>{{ $category->slug }}</code>
                        </td>

                        <td>
                            {{ $category->sort_order }}
                        </td>

                        <td>

                            @if($category->status)

                                <span class="badge bg-success">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Inactive
                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('admin.course-categories.edit',$category->id) }}"
                                class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>

                            </a>

                            <form action="{{ route('admin.course-categories.destroy',$category->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="text-center text-muted py-4">

                            No Categories Found

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>
    <div class="d-flex justify-content-center mt-3">
        {{ $coursecategories->links() }}
    </div>

</div>

@endsection