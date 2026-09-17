@extends('admin.layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-enquiries-index.css') }}">
@endsection

@section('content')
<div class="page-title mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h2>Quick Admission Enquiries</h2>
        <p>Manage homepage enquiry records</p>
    </div>
    <a href="{{ route('admin.enquiries.export', request()->query()) }}" class="btn btn-success">
        <i class="fas fa-file-excel me-1"></i> Download Excel
    </a>
</div>

<div class="panel-card mb-3 admin-filter-bar">
    <form method="GET" class="row g-2 align-items-center">
        <div class="col-md-5">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search name, phone, or email...">
        </div>
        <div class="col-md-4">
            <select name="branch" class="form-select">
                <option value="">— All Branches —</option>
                <option value="Patiala" {{ request('branch') == 'Patiala' ? 'selected' : '' }}>Patiala</option>
                <option value="Karnal" {{ request('branch') == 'Karnal' ? 'selected' : '' }}>Karnal</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary flex-fill"><i class="fas fa-filter me-1"></i>Filter</button>
            <a href="{{ route('admin.enquiries.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>
</div>

<div class="panel-card">
    <div class="table-responsive">
        <table class="table align-middle quick-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Phone</th>
                    <th>Branch</th>
                    <th>Course</th>
                    <th>Date</th>
                    <th class="text-center">Detail</th>
                </tr>
            </thead>

            <tbody>
                @forelse($enquiries as $key => $enquiry)
                    <tr class="quick-row"
                        data-bs-toggle="collapse"
                        data-bs-target="#quickDetail{{ $enquiry->id }}">

                        <td>{{ $enquiries->firstItem() + $key }}</td>

                        <td>
                            <div class="student-name">{{ $enquiry->name }}</div>
                            <small class="text-muted">{{ $enquiry->email ?? 'No email' }}</small>
                        </td>

                        <td>{{ $enquiry->phone }}</td>

                        <td>
                            <span class="branch-badge">
                                {{ $enquiry->branch ?? '-' }}
                            </span>
                        </td>

                        <td>
                            <span class="course-badge">
                                {{ $enquiry->course ?? '-' }}
                            </span>
                        </td>

                        <td>{{ $enquiry->created_at->format('d M Y') }}</td>

                        <td class="text-center">
                            <span class="toggle-icon">+</span>
                        </td>
                    </tr>

                    <tr class="collapse" id="quickDetail{{ $enquiry->id }}">
                        <td colspan="7">
                            <div class="quick-detail-box">
                                <div class="detail-grid">
                                    <div class="detail-item">
                                        <span class="detail-label">Full Name</span>
                                        <div class="detail-value">{{ $enquiry->name }}</div>
                                    </div>

                                    <div class="detail-item">
                                        <span class="detail-label">Phone</span>
                                        <div class="detail-value">{{ $enquiry->phone }}</div>
                                    </div>

                                    <div class="detail-item">
                                        <span class="detail-label">Email</span>
                                        <div class="detail-value">{{ $enquiry->email ?? '-' }}</div>
                                    </div>

                                    <div class="detail-item">
                                        <span class="detail-label">Branch</span>
                                        <div class="detail-value">{{ $enquiry->branch ?? '-' }}</div>
                                    </div>

                                    <div class="detail-item">
                                        <span class="detail-label">Course Category</span>
                                        <div class="detail-value">{{ $enquiry->courseCategory->title ?? '-' }}</div>
                                    </div>

                                    <div class="detail-item">
                                        <span class="detail-label">Course</span>
                                        <div class="detail-value">{{ $enquiry->course ?? '-' }}</div>
                                    </div>

                                    <div class="detail-item">
                                        <span class="detail-label">Submitted On</span>
                                        <div class="detail-value">{{ $enquiry->created_at->format('d M Y h:i A') }}</div>
                                    </div>

                                    <div class="detail-item full">
                                        <span class="detail-label">Message</span>
                                        <div class="detail-value">{{ $enquiry->message ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            No enquiries found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($enquiries->hasPages())
        <div class="custom-pagination-wrap">
            <div class="pagination-info">
                Showing {{ $enquiries->firstItem() }} to {{ $enquiries->lastItem() }} of {{ $enquiries->total() }} enquiries
            </div>

            <div class="custom-pagination">
                @if ($enquiries->onFirstPage())
                    <span class="pg-btn disabled">‹ Prev</span>
                @else
                    <a href="{{ $enquiries->previousPageUrl() }}" class="pg-btn">‹ Prev</a>
                @endif

                @foreach ($enquiries->getUrlRange(1, $enquiries->lastPage()) as $page => $url)
                    @if ($page == $enquiries->currentPage())
                        <span class="pg-number active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pg-number">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($enquiries->hasMorePages())
                    <a href="{{ $enquiries->nextPageUrl() }}" class="pg-btn">Next ›</a>
                @else
                    <span class="pg-btn disabled">Next ›</span>
                @endif
            </div>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.quick-row').forEach(function(row){
        row.addEventListener('click', function(){
            const icon = this.querySelector('.toggle-icon');
            const target = document.querySelector(this.dataset.bsTarget);

            setTimeout(function(){
                icon.textContent = target.classList.contains('show') ? '−' : '+';
            }, 150);
        });
    });
});
</script>
@endsection