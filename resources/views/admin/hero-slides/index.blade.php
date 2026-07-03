@extends('admin.layouts.admin')

@section('content')

<div class="page-title mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2>Hero Slider</h2>
            <p>Manage hero slider records</p>
        </div>

        <a href="{{ route('admin.hero-slides.create') }}"
           class="btn"
           style="background:#0d47a1; color:#fff; border-radius:10px;">
            <i class="fas fa-plus"></i> Add Slide
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
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search alt text...">
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
            <a href="{{ route('admin.hero-slides.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead style="background:#f5f7fb;">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Alt Text</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th width="160">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($slides as $key => $slide)
                        <tr>
                            <td>{{ ($slides->currentPage() - 1) * $slides->perPage() + $key + 1 }}</td>

                            <td>
                                <img src="{{ asset('uploads/hero-slides/' . $slide->image) }}"
                                     alt="{{ $slide->alt_text }}"
                                     width="130"
                                     height="70"
                                     style="object-fit:cover; border-radius:8px;">
                            </td>

                            <td>{{ $slide->alt_text ?? 'N/A' }}</td>

                            <td>{{ $slide->sort_order }}</td>

                            <td>
                                @if($slide->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.hero-slides.edit', $slide->id) }}"
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.hero-slides.delete', $slide->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Delete this slide?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                No hero slides found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $slides->links() }}
        </div>

    </div>
</div>

@endsection