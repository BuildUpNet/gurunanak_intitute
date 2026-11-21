@extends('admin.layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-gallery-subcategories-create.css') }}">
@endsection

@section('content')
<div class="page-title mb-4">
    <h2>Add Gallery Sub Category</h2>
    <p>Create new gallery sub category under main gallery category</p>
</div>

<div class="panel-card subcategory-card">
    <form action="{{ route('admin.gallery-subcategories.store') }}" method="POST">
        @csrf

        <div class="form-section-title">
            <i class="fas fa-layer-group"></i>
            Sub Category Information
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="form-label">Main Category <span>*</span></label>

                <select name="gallery_category_id" class="form-control custom-input" required>
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('gallery_category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>

                @error('gallery_category_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Sub Category Title <span>*</span></label>

                <input type="text"
                       id="title"
                       name="title"
                       value="{{ old('title') }}"
                       class="form-control custom-input"
                       placeholder="Enter sub category title"
                       required>

                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-12 mb-4">
                <label class="form-label">Display Title <small class="text-muted">(optional)</small></label>
                <input type="text"
                       name="heading"
                       value="{{ old('heading') }}"
                       class="form-control custom-input"
                       maxlength="255"
                       placeholder="e.g. Annual Sports Meet 2026">
                <small class="text-muted d-block mt-1">Shown as the main title above the photos on the gallery page. Leave empty to show the sub category title. Max {{ \App\Models\GallerySubCategory::MAX_IMAGES }} photos per sub category.</small>
                @error('heading')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-12 mb-4">
                <label class="form-label">Number before the title</label>
                <div class="gal-num-opt">
                    <label class="gal-num-opt__check">
                        <input type="checkbox" name="show_number" value="1" @checked(old('show_number', true))>
                        Show number
                    </label>
                    <input type="text"
                           name="number_label"
                           value="{{ old('number_label', '') }}"
                           class="form-control custom-input gal-num-opt__input"
                           maxlength="6"
                           placeholder="Auto: 01, 02 …">
                </div>
                <small class="text-muted d-block mt-1">Ticked + empty box = automatic number (01, 02 …). Type your own text (max 6 characters, e.g. 2026 or A1) to show that instead. Untick to hide the number.</small>
                @error('number_label')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-8 mb-4">
                <label class="form-label">Event Description <small class="text-muted">(optional)</small></label>
                <textarea name="description"
                          rows="2"
                          class="form-control custom-input"
                          placeholder="One line shown under the event title on the gallery page">{{ old('description') }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4 mb-4">
                <label class="form-label">Event Date <small class="text-muted">(optional)</small></label>
                <input type="date"
                       name="event_date"
                       value="{{ old('event_date') }}"
                       class="form-control custom-input">
                <small class="text-muted d-block mt-1">Shown on the right of the event title (e.g. 05 April 2026).</small>
                @error('event_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-12 mb-4">
                <label class="status-box">
                    <input type="checkbox" name="is_active" value="1" checked>
                    <div>
                        <strong>Active Status</strong>
                        <p>Show this sub category on frontend gallery page.</p>
                    </div>
                </label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn save-btn">
                <i class="fas fa-save"></i> Save Sub Category
            </button>

            <a href="{{ route('admin.gallery-subcategories.index') }}" class="btn back-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </form>
</div>

@endsection