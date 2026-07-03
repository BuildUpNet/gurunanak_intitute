@extends('admin.layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-program-categories-form.css') }}">
@endsection

@section('content')
    <div class="page-title mb-4">
        <h2>{{ $programCategory ? 'Edit Program Category' : 'Add Program Category' }}</h2>
        <p>{{ $programCategory ? 'Update program category details' : 'Create a new category for the Programs menu' }}</p>
    </div>

    <div class="panel-card hero-card">
        <form action="{{ $programCategory ? route('admin.program-categories.update', $programCategory->id) : route('admin.program-categories.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if($programCategory)
                @method('PUT')
            @endif

            <div class="form-section-title">
                <i class="fas fa-layer-group"></i>
                Program Category Information
            </div>

            <div class="row">

                <div class="col-md-6 mb-4">
                    <label class="form-label">Category Title <span>*</span></label>
                    <input type="text" name="title" id="title"
                           value="{{ old('title', $programCategory->title ?? '') }}"
                           class="form-control custom-input"
                           placeholder="e.g. Under Graduate" required>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Icon</label>
                    <div class="icon-pick-wrap">
                        <input type="text" name="icon" id="iconInput"
                               value="{{ old('icon', $programCategory->icon ?? 'fas fa-layer-group') }}"
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
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order"
                           value="{{ old('sort_order', $programCategory->sort_order ?? 0) }}"
                           class="form-control custom-input"
                           placeholder="0">
                    @error('sort_order')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Card Background Image</label>
                    @if($programCategory?->image)
                        <div class="mb-2">
                            <img src="{{ asset($programCategory->image) }}" alt="Category Image"
                                 style="width:100%;max-height:130px;object-fit:cover;border-radius:10px;border:1px solid #e2e8f0;">
                            <div class="form-text mt-1">Current image. Upload new to replace.</div>
                        </div>
                    @endif
                    <input type="file" name="image" id="imageInput" class="form-control" accept="image/*">
                    <div class="form-text">Recommended: 600×400px · JPG/PNG/WebP · Max 2 MB</div>
                    <div id="imagePreviewBox" class="mt-2" style="display:none;">
                        <img id="imagePreview" src="" alt="Preview"
                             style="width:100%;max-height:130px;object-fit:cover;border-radius:10px;border:1px solid #e2e8f0;">
                    </div>
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-12 mb-4">
                    <div class="icon-preview-box icon-picker-trigger" data-target="iconInput" style="cursor:pointer;" title="Click to change icon">
                        <div class="preview-icon">
                            <i id="iconPreview" class="{{ old('icon', $programCategory->icon ?? 'fas fa-graduation-cap') }}"></i>
                        </div>
                        <div class="flex-grow-1">
                            <strong>Icon Preview</strong>
                            <p>Click anywhere here or "Pick Icon" to browse all icons</p>
                        </div>
                        <span style="font-size:12px;color:#0d47a1;font-weight:700;"><i class="fas fa-exchange-alt me-1"></i>Change</span>
                    </div>
                </div>

                <div class="col-md-12 mb-4">
                    <label class="status-box">
                        <input type="hidden" name="status" value="0">
                        <input type="checkbox" name="status" value="1"
                               {{ old('status', $programCategory->status ?? 1) ? 'checked' : '' }}>
                        <div>
                            <strong>Active Status</strong>
                            <p>Show this category in the Programs navigation menu.</p>
                        </div>
                    </label>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn save-btn">
                    <i class="fas fa-save"></i>
                    {{ $programCategory ? 'Update Category' : 'Save Category' }}
                </button>
                <a href="{{ route('admin.program-categories.index') }}" class="btn back-btn">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

        </form>
    </div>

    <script>
        document.getElementById('iconInput').addEventListener('input', function () {
            document.getElementById('iconPreview').className = this.value || 'fas fa-graduation-cap';
        });
        document.getElementById('imageInput').addEventListener('change', function () {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('imagePreviewBox').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
