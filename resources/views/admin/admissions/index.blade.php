@extends('admin.layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-admissions-index.css') }}">
@endsection

@section('content')
    <div class="page-title mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>Admission Applications</h2>
                <p>Manage all Admission Application records</p>
            </div>
            <a href="{{ route('admin.admissions.export', request()->query()) }}" class="btn btn-success">
                <i class="fas fa-file-excel me-1"></i> Download Excel
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
            <div class="col-md-5">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search name, mobile, or email...">
            </div>
            <div class="col-md-4">
                <select name="course_name" class="form-select">
                    <option value="">— All Courses —</option>
                    @foreach ($courseNames as $cn)
                        <option value="{{ $cn }}" {{ request('course_name') == $cn ? 'selected' : '' }}>{{ $cn }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill"><i class="fas fa-filter me-1"></i>Filter</button>
                <a href="{{ route('admin.admissions.detail') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>

    <div class="panel-card">
        <div class="table-responsive">
            <table class="table align-middle app-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Candidate</th>
                        <th>Course</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($applications as $key => $app)
                        <tr>
                            <td>{{ $applications->firstItem() + $key }}</td>

                            <td>
                                <div class="candidate-name">{{ $app->candidate_name }}</div>
                            </td>

                            <td>
                                <span class="course-badge">
                                    {{ $app->course_name ?? '-' }}
                                </span>
                            </td>

                            <td>{{ $app->mobile }}</td>
                            <td>{{ $app->email ?? '-' }}</td>
                            <td>{{ $app->created_at->format('d M Y') }}</td>

                            <td>
                                @if($app->is_viewed)
                               <span class="status viewed">Viewed</span>
                                @else
                               <span class="status pending">Pending</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.admissions.showlist', $app->id) }}" class="btn-view">
                                        <i class="fas fa-eye"></i> View
                                    </a>

                                    <a href="{{ route('admissions.pdf', $app->id) }}" class="btn-pdf">
                                        <i class="fas fa-file-pdf"></i> PDF
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                No applications found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($applications->hasPages())
            <div class="custom-pagination-wrap">
                <div class="pagination-info">
                    Showing {{ $applications->firstItem() }} to {{ $applications->lastItem() }} of
                    {{ $applications->total() }} applications
                </div>

                <div class="custom-pagination">
                    @if ($applications->onFirstPage())
                        <span class="pg-btn disabled">‹ Prev</span>
                    @else
                        <a href="{{ $applications->previousPageUrl() }}" class="pg-btn">‹ Prev</a>
                    @endif

                    @foreach ($applications->getUrlRange(1, $applications->lastPage()) as $page => $url)
                        @if ($page == $applications->currentPage())
                            <span class="pg-number active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="pg-number">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($applications->hasMorePages())
                        <a href="{{ $applications->nextPageUrl() }}" class="pg-btn">Next ›</a>
                    @else
                        <span class="pg-btn disabled">Next ›</span>
                    @endif
                </div>
            </div>
        @endif
    </div>
@endsection
