@extends('admin.layouts.admin')

@section('title', 'Add Award Section')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-awards.css') }}">
@endsection

@section('content')

<div class="page-title mb-4 d-flex flex-wrap justify-content-between align-items-start gap-3">
    <div>
        <h2>Add Award Section</h2>
        <p class="mb-0">A new section on the Awards &amp; Recognition page — its own heading, description and images.</p>
    </div>
    <a href="{{ route('admin.awards.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Back</a>
</div>

@include('admin.awards._errors')

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.awards.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.awards._section-fields')

            <div class="mb-3">
                <label class="form-label fw-semibold">Images</label>
                <input type="file" name="images[]" id="awardImagesInput" class="form-control" accept="image/*" multiple>
                <div class="form-text">Optional now — you can also add images later. Select one or many (Ctrl / Shift + click).
                    JPG, PNG or WEBP, max 4 MB each, up to 20 per upload.</div>
                <div class="award-upload-preview" id="awardUploadPreview"></div>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Create Section</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/admin/admin-awards.js') }}"></script>
@endsection
