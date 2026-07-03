@extends('admin.layouts.admin')

@section('content')
    <div class="page-title mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>Announcements</h2>
                <p>Manage announcement ticker records</p>
            </div>

            <a href="{{ route('admin.announcement.create') }}" class="btn px-4 py-2"
                style="background:#0d47a1;color:#fff;border-radius:10px;">
                <i class="fas fa-plus me-1"></i> Add Announcement
            </a>
        </div>
    </div>

    @if (session('success'))
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
                <a href="{{ route('admin.announcement.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>

    <div class="panel-card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Announcement</th>
                        <th>Tag</th>
                        <th>Date</th>
                        <th>News Page</th>
                        <th>Sort Order</th>
                        <th>Status</th>
                        <th width="220">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($announcements as $announcement)
                        <tr>
                            <td>
                                {{ \Illuminate\Support\Str::limit($announcement->title, 80) }}
                            </td>

                            <td>{{ $announcement->tag ?: '-' }}</td>

                            <td>{{ optional($announcement->date)->format('d M Y') ?: '-' }}</td>

                            <td>
                                @if ($announcement->slug && $announcement->status)
                                    <a href="{{ route('news.show', $announcement->slug) }}"
                                        target="_blank"
                                        class="btn btn-info btn-sm text-white"
                                        title="View on News page">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <td>{{ $announcement->sort_order }}</td>

                            <td>
                                @if ((int) $announcement->status === 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.announcement.edit', $announcement->id) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                              

                                <form action="{{ route('admin.announcement.destroy', $announcement->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete Announcement?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                No Announcements Found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $announcements->links() }}
        </div>
    </div>
@endsection