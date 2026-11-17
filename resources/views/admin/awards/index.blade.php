@extends('admin.layouts.admin')

@section('title', 'Awards & Recognitions')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-awards.css') }}">
@endsection

@section('content')

<div class="page-title mb-4 d-flex flex-wrap justify-content-between align-items-start gap-3">
    <div>
        <h2>Awards &amp; Recognitions</h2>
        <p class="mb-0">Sections shown on the <a href="{{ route('about.awards') }}" target="_blank">Awards &amp; Recognition page</a>.
            Page heading on top, then sections — each with its own title, description and images.</p>
    </div>
    <a href="{{ route('admin.awards.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Add Section
    </a>
</div>

@include('admin.awards._errors')

{{-- 1. Page heading (top of the page) --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <h5 class="award-card-title"><i class="fas fa-heading me-2 text-primary"></i>Page Heading</h5>
        <form action="{{ route('admin.awards.page') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold">Top Line</label>
                <input type="text" name="page_eyebrow" class="form-control" maxlength="200"
                       value="{{ old('page_eyebrow', $pageEyebrow) }}" placeholder="e.g. Est. 1991 · UGC Recognised · Patiala &amp; Karnal">
                <div class="form-text">Small text above the title. Leave empty to hide it.</div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Page Title <span class="text-danger">*</span></label>
                <input type="text" name="page_title" class="form-control" maxlength="200" required
                       value="{{ old('page_title', $pageTitle) }}">
                <div class="form-text">Main title at the top of the page (also used in the breadcrumb and browser tab).</div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Page Description</label>
                <textarea name="page_description" rows="2" class="form-control" maxlength="2000">{{ old('page_description', $pageDescription) }}</textarea>
                <div class="form-text">Optional short line under the page title. Leave empty to hide it.</div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Page Heading</button>
        </form>
    </div>
</div>

{{-- 2. Sections (each: title > description > images) --}}
<div class="card border-0 shadow-sm">
    <div class="card-body pb-0">
        <h5 class="award-card-title"><i class="fas fa-layer-group me-2 text-primary"></i>Sections</h5>
    </div>
    <div class="card-body">
        @if($sections->isEmpty())
            <p class="text-muted mb-0">No sections yet. Click <strong>Add Section</strong> to create the first one.</p>
        @else
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="award-col-order">Order</th>
                            <th>Section</th>
                            <th>Images</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sections as $section)
                            <tr>
                                <td>{{ $section->sort_order }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $section->title }}</div>
                                    @if($section->description)
                                        <div class="text-muted small award-desc-clip">{{ $section->description }}</div>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $section->awards_count }}</span>
                                    @if($section->awards_count !== $section->active_awards_count)
                                        <span class="small text-muted">({{ $section->active_awards_count }} visible)</span>
                                    @endif
                                </td>
                                <td>
                                    @if($section->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Hidden</span>
                                    @endif
                                </td>
                                <td class="text-end text-nowrap">
                                    <a href="{{ route('admin.awards.edit', $section) }}" class="btn btn-sm btn-primary" title="Edit section & images">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.awards.destroy', $section) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Delete this section and ALL its images?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p class="form-text mb-0 mt-3">A section shows on the website only when it is Active and has at least one visible image.</p>
        @endif
    </div>
</div>
@endsection
