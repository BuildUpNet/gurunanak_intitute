@extends('admin.layouts.admin')

@section('title', 'FAQs')

@section('content')
    <div class="container-fluid">


        <div class="page-title mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2>FAQs Management</h2>
                    <p>Manage FAQs Management records</p>
                </div>

                <a href="{{ route('admin.faqs.create') }}" class="btn px-4 py-2"
                    style="background:#0d47a1; color:#fff; border-radius:10px;">
                    <i class="fas fa-plus me-1"></i> Add FAQ
                </a>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="panel-card mb-3 admin-filter-bar">
            <form method="GET" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                           placeholder="Search question...">
                </div>
                <div class="col-md-4">
                    <select name="page_name" class="form-select">
                        <option value="">— All Pages —</option>
                        @foreach ($pageNames as $pn)
                            <option value="{{ $pn }}" {{ request('page_name') == $pn ? 'selected' : '' }}>{{ $pn }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-fill"><i class="fas fa-filter me-1"></i>Filter</button>
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>

        <div class="panel-card">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Page Name</th>
                            <th>Question</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>


                    <tbody>
                        @forelse($faqs as $faq)
                            <tr>
                                <td>{{ ($faqs->currentPage() - 1) * $faqs->perPage() + $loop->iteration }}</td>
                                <td>{{ $faq->page_name }}</td>
                                <td>{{ $faq->question }}</td>
                                <td>{{ $faq->sort_order }}</td>
                                <td>
                                    @if ($faq->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete FAQ?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No Record Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $faqs->links() }}
            </div>
        </div>
    </div>
@endsection