@extends('admin.layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-announcement-edit.css') }}">
@endsection

@section('content')
<div class="page-title mb-4">
    <h2>Edit Announcement</h2>
    <p>Update announcement details</p>
</div>

<div class="panel-card hero-card">
    <form action="{{ route('admin.announcement.update', $announcement->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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
                    required>{{ old('title', $announcement->title) }}</textarea>

                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4 mb-4">
                <label class="form-label">Tag / Category</label>

                <input type="text"
                    name="tag"
                    value="{{ old('tag', $announcement->tag) }}"
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
                    value="{{ old('date', optional($announcement->date)->format('Y-m-d')) }}"
                    class="form-control custom-input">

                @error('date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4 mb-4">
                <label class="form-label">Featured Image</label>

                @if($announcement->image)
                    <div class="mb-2 d-flex align-items-center gap-2">
                        <img src="{{ asset($announcement->image) }}" alt="" style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                        <label class="d-flex align-items-center gap-1" style="font-size:.8rem;">
                            <input type="checkbox" name="remove_image" value="1"> Remove current image
                        </label>
                    </div>
                @endif

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
                    maxlength="500">{{ old('excerpt', $announcement->excerpt) }}</textarea>

                @error('excerpt')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-12 mb-4">
                <label class="form-label">Full Content (shown on the News detail page)</label>

                <textarea name="content"
                    rows="8"
                    class="form-control custom-textarea">{{ old('content', $announcement->content) }}</textarea>

                @error('content')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-12 mb-4">
                <label class="form-label">Link (Optional — external link for the header ticker only)</label>

                <input type="text"
                    name="link"
                    value="{{ old('link', $announcement->link) }}"
                    class="form-control custom-input"
                    placeholder="https://example.com">

                @error('link')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Sort Order</label>

                <input type="number"
                    name="sort_order"
                    value="{{ old('sort_order', $announcement->sort_order) }}"
                    class="form-control custom-input">
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Status</label>

                <select name="status" class="form-control custom-input">
                    <option value="1"
                        {{ old('status', $announcement->status) == 1 ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="0"
                        {{ old('status', $announcement->status) == 0 ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>

        </div>

        <div class="form-actions">
            <button type="submit" class="btn save-btn">
                <i class="fas fa-save"></i> Update Announcement
            </button>

            <a href="{{ route('admin.announcement.index') }}"
                class="btn back-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </form>
</div>

@endsection