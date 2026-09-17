@extends('admin.layouts.admin')

@section('content')
    <div class="page-title mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>Gallery Categories</h2>
                <p>Manage gallery category records</p>
            </div>

            <a href="{{ route('admin.gallery-categories.create') }}" class="btn px-4 py-2"
                style="background:#0d47a1; color:#fff; border-radius:10px;">
                <i class="fas fa-plus me-1"></i> Add Category
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="panel-card mb-3 admin-filter-bar">
        <form method="GET" class="row g-2 align-items-center">
            <div class="col-md-9">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search title...">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill"><i class="fas fa-filter me-1"></i>Filter</button>
                <a href="{{ route('admin.gallery-categories.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>

    <div class="panel-card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th class="sortable-th">
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'title', 'direction' => $sort === 'title' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                                Title
                                @if ($sort === 'title')
                                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                @else
                                    <i class="fas fa-sort text-muted"></i>
                                @endif
                            </a>
                        </th>
                        <th class="sortable-th">
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'slug', 'direction' => $sort === 'slug' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                                Slug
                                @if ($sort === 'slug')
                                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                @else
                                    <i class="fas fa-sort text-muted"></i>
                                @endif
                            </a>
                        </th>
                        <th class="sortable-th">
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'is_active', 'direction' => $sort === 'is_active' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                                Status
                                @if ($sort === 'is_active')
                                    <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                @else
                                    <i class="fas fa-sort text-muted"></i>
                                @endif
                            </a>
                        </th>
                        <th width="180">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>
                                @if ($category->image)
                                    <img src="{{ asset($category->image) }}" width="70" height="55"
                                        style="object-fit:cover;border-radius:10px;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>

                            <td>
                                <strong>{{ $category->title }}</strong><br>
                                <small class="text-muted">{{ Str::limit($category->short_description, 45) }}</small>
                            </td>

                            <td>{{ $category->slug }}</td>

                            <td>
                                <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('admin.gallery-categories.edit', $category->id) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.gallery-categories.destroy', $category->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete Category?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No Record Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
