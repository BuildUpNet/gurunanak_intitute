@extends('admin.layouts.admin')

@section('content')
    @php use Illuminate\Support\Str; @endphp

    <div class="page-title mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>Gallery Sub Categories</h2>
                <p>Manage gallery sub category records</p>
            </div>

            <a href="{{ route('admin.gallery-subcategories.create') }}" class="btn"
                style="background:#0d47a1; color:#fff; border-radius:10px;">
                <i class="fas fa-plus"></i> Add Sub Category
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="panel-card mb-3 admin-filter-bar">
        <form method="GET" class="row g-2 align-items-center">
            <div class="col-md-5">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search title...">
            </div>
            <div class="col-md-4">
                <select name="gallery_category_id" class="form-select">
                    <option value="">— All Categories —</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('gallery_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill"><i class="fas fa-filter me-1"></i>Filter</button>
                <a href="{{ route('admin.gallery-subcategories.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>

    <div class="panel-card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($subcategories as $subcategory)
                        <tr>

                            <td>{{ $subcategory->category->title ?? '-' }}</td>

                            <td>
                                <strong>{{ $subcategory->title }}</strong><br>
                                <small class="text-muted">{{ Str::limit($subcategory->short_description, 45) }}</small>
                            </td>


                            <td>
                                <span class="badge {{ $subcategory->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $subcategory->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('admin.gallery-subcategories.edit', $subcategory->id) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.gallery-subcategories.destroy', $subcategory->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete Sub Category?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No Record Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $subcategories->links() }}
        </div>
    </div>
@endsection
