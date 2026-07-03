@extends('admin.layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-announcement-create.css') }}">
@endsection

@section('content')
<div class="page-title mb-4">
    <h2>Add Announcement</h2>
    <p>Create new announcement for ticker</p>
</div>

<div class="panel-card hero-card">
    <form action="{{ route('admin.announcement.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-section-title">
            <i class="fas fa-bullhorn"></i>
            Announcement Information
        </div>
        <p class="text-muted" style="margin-top:-10px;">Shows as a scrolling ticker in the header, and (if Excerpt/Content are filled in) as a full News &amp; Announcements page entry.</p>

        <div class="row">

            <div class="col-md-12 mb-4">
                <label class="form-label">
                    Title / Ticker Text <span>*</span>
                </label>

                <textarea name="title"
                    rows="2"
                    class="form-control custom-textarea"
                    placeholder="Admissions Open 2025–26 – Limited seats available. Apply Early!"
                    required>{{ old('title') }}</textarea>

                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4 mb-4">
                <label class="form-label">Tag / Category</label>

                <input type="text"
                    name="tag"
                    value="{{ old('tag') }}"
                    class="form-control custom-input"
                    placeholder="Admission, Placement, Event...">

                @error('tag')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4 mb-4">
                <label class="form-label">Display Date</label>

                <input type="date"
                    name="date"
                    value="{{ old('date') }}"
                    class="form-control custom-input">

                @error('date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4 mb-4">
                <label class="form-label">Featured Image</label>

                <input type="file"
                    name="image"
                    accept="image/*"
                    class="form-control custom-input">

                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-12 mb-4">
                <label class="form-label">Excerpt (short summary shown on the News page card)</label>

                <textarea name="excerpt"
                    rows="2"
                    class="form-control custom-textarea"
                    maxlength="500"
                    placeholder="A short 1-2 line summary...">{{ old('excerpt') }}</textarea>

                @error('excerpt')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-12 mb-4">
                <label class="form-label">Full Content (shown on the News detail page)</label>

                <textarea name="content"
                    rows="8"
                    class="form-control custom-textarea"
                    placeholder="Full article text...">{{ old('content') }}</textarea>

                @error('content')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-12 mb-4">
                <label class="form-label">Link (Optional — external link for the header ticker only)</label>

                <input type="text"
                    name="link"
                    value="{{ old('link') }}"
                    class="form-control custom-input"
                    placeholder="https://example.com">
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Sort Order</label>

                <input type="number"
                    name="sort_order"
                    value="{{ old('sort_order',0) }}"
                    class="form-control custom-input">
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Status</label>

                <select name="status" class="form-control custom-input">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

        </div>

        <div class="form-actions">
            <button type="submit" class="btn save-btn">
                <i class="fas fa-save"></i> Save Announcement
            </button>

            <a href="{{ route('admin.announcement.index') }}"
                class="btn back-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </form>
</div>

@endsection