@extends('admin.layouts.admin')

@section('content')

<div class="page-title mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2>Program Items</h2>
            <p>Manage Program Item Records</p>
        </div>

        <a href="{{ route('admin.program-items.create') }}"
            class="btn px-4 py-2"
            style="background:#0d47a1;color:#fff;border-radius:10px;">
            <i class="fas fa-plus me-1"></i>
            Add Program Item
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
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search title...">
        </div>
        <div class="col-md-3">
            <select name="program_category_id" class="form-select">
                <option value="">— All Categories —</option>
                @foreach($programCategories as $category)
                    <option value="{{ $category->id }}" {{ (string) request('program_category_id') === (string) $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
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
            <a href="{{ route('admin.program-items.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>
</div>

<div class="panel-card">

    <div class="table-responsive">

        <table class="table table-bordered align-middle">

            <thead class="table-light">
                <tr>
                    <th width="60">#</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>URL</th>
                    <th width="120">Sort Order</th>
                    <th width="120">Status</th>
                    <th width="180">Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($programItems as $key => $item)

                    <tr>

                        <td>{{ ($programItems->currentPage() - 1) * $programItems->perPage() + $key + 1 }}</td>

                        <td>
                            <span class="badge" style="background:#f3f6ff;color:#0d47a1;font-size:13px;font-weight:700;">
                                {{ $item->programCategory->title ?? 'N/A' }}
                            </span>
                        </td>

                        <td>
                            <strong>{{ $item->title }}</strong>
                        </td>

                        <td>
                            <code style="font-size:13px;">{{ $item->url }}</code>
                        </td>

                        <td>
                            {{ $item->sort_order }}
                        </td>

                        <td>

                            @if($item->status)

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

                            <a href="{{ route('admin.program-items.edit', $item->id) }}"
                                class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>

                            </a>

                            <form action="{{ route('admin.program-items.destroy', $item->id) }}"
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

                            No Program Items Found

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $programItems->links() }}
    </div>

</div>

@endsection
