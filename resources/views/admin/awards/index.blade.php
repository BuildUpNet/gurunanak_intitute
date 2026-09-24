@extends('admin.layouts.admin')

@section('title', 'Awards & Recognitions')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-awards.css') }}">
@endsection

@section('content')

<div class="page-title mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2>Awards &amp; Recognitions</h2>
            <p>Each active award is shown as one section on the About page (image and content alternate sides).</p>
        </div>
        <a href="{{ route('admin.awards.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Award
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
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
            <a href="{{ route('admin.awards.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="award-thead">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th class="award-action-col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($awards as $key => $award)
                        <tr>
                            <td>{{ ($awards->currentPage() - 1) * $awards->perPage() + $key + 1 }}</td>
                            <td>
                                @if($award->image)
                                    <img src="{{ asset('uploads/awards/' . $award->image) }}" alt="{{ $award->title }}" class="award-thumb">
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $award->title }}</td>
                            <td>{{ $award->subtitle ?: '—' }}</td>
                            <td>{{ $award->sort_order }}</td>
                            <td>
                                @if($award->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.awards.edit', $award) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.awards.destroy', $award) }}" method="POST"
                                          onsubmit="return confirm('Delete this award?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                No awards yet. <a href="{{ route('admin.awards.create') }}">Add the first one.</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $awards->links() }}
    </div>
</div>
@endsection
