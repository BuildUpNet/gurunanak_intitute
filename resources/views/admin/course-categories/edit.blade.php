@extends('admin.layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-course-categories-edit.css') }}">
@endsection

@section('content')
    <div class="page-title mb-4">
        <h2>Edit Course Category</h2>
        <p>Update course category details</p>
    </div>

    <div class="panel-card hero-card">
        <form action="{{ route('admin.course-categories.update', $courseCategory->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-section-title">
                <i class="fas fa-graduation-cap"></i>
                Course Category Information
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">Icon</label>
                    <div class="icon-pick-wrap">
                        <input type="text" name="icon" id="iconInput"
                               value="{{ old('icon', $courseCategory->icon ?: 'fas fa-stethoscope') }}"
                               class="icon-input" placeholder="Click to pick icon" readonly>
                        <button type="button" class="icon-pick-btn" data-target="iconInput">
                            <i class="fas fa-icons"></i> Pick Icon
                        </button>
                    </div>
                    @error('icon')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Category Title <span>*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $courseCategory->title) }}"
                        class="form-control custom-input" placeholder="Enter category title" required>

                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $courseCategory->slug) }}"
                        class="form-control custom-input" placeholder="course-category-slug">

                    @error('slug')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $courseCategory->sort_order) }}"
                        class="form-control custom-input" placeholder="Enter sort order">

                    @error('sort_order')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-12 mb-4">
                    <div class="icon-preview-box icon-picker-trigger" data-target="iconInput" style="cursor:pointer;" title="Click to change icon">
                        <div class="preview-icon">
                            <i id="iconPreview" class="{{ old('icon', $courseCategory->icon ?: 'fas fa-stethoscope') }}"></i>
                        </div>
                        <div class="flex-grow-1">
                            <strong>Icon Preview</strong>
                            <p>Click anywhere here to browse all icons</p>
                        </div>
                        <span style="font-size:12px;color:#0d47a1;font-weight:700;"><i class="fas fa-exchange-alt me-1"></i>Change</span>
                    </div>
                </div>

                <div class="col-md-12 mb-4">
                    <label class="status-box">
                        <input type="hidden" name="status" value="0">
                        <input type="checkbox" name="status" value="1"
                            {{ old('status', $courseCategory->status) == 1 ? 'checked' : '' }}>

                        <div>
                            <strong>Active Status</strong>
                            <p>Show this category on frontend course section.</p>
                        </div>
                    </label>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn save-btn">
                    <i class="fas fa-save"></i> Update Category
                </button>

                <a href="{{ route('admin.course-categories.index') }}" class="btn back-btn">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </form>
    </div>


    <script>
        document.getElementById('iconInput').addEventListener('input', function() {
            document.getElementById('iconPreview').className = this.value || 'fas fa-stethoscope';
        });
    </script>
    <script>
        document.getElementById('title').addEventListener('keyup', function() {

            let slug = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

            document.getElementById('slug').value = slug;
        });
    </script>
@endsection
