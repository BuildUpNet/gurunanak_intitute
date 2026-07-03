@extends('admin.layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-gallery-subcategories-edit.css') }}">
@endsection

@section('content')
<div class="page-title mb-4">
    <h2>Update Gallery Sub Category</h2>
    <p>Update gallery sub category details</p>
</div>

<div class="panel-card subcategory-card">
    <form action="{{ route('admin.gallery-subcategories.update', $subcategory->id) }}" method="POST">
        @csrf
        @method('PUT')

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
                            {{ old('gallery_category_id', $subcategory->gallery_category_id) == $category->id ? 'selected' : '' }}>
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
                       value="{{ old('title', $subcategory->title) }}"
                       class="form-control custom-input"
                       placeholder="Enter sub category title"
                       required>

                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-12 mb-4">
                <label class="status-box">
                    <input type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $subcategory->is_active) ? 'checked' : '' }}>
                    <div>
                        <strong>Active Status</strong>
                        <p>Show this sub category on frontend gallery page.</p>
                    </div>
                </label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn save-btn">
                <i class="fas fa-save"></i> Update Sub Category
            </button>

            <a href="{{ route('admin.gallery-subcategories.index') }}" class="btn back-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </form>
</div>

@endsection