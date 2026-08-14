@extends('admin.layouts.admin')

@section('title', 'Add About Image')

@section('styles')
<style>
    .preview-box {
        width: 180px;
        height: 130px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px dashed #ccc;
        display: none;
        margin-top: 10px;
    }
</style>
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h4 class="mb-0"><i class="fas fa-plus-circle me-2 text-primary"></i>Add About Image</h4>
    <a href="{{ route('admin.about-images.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card shadow-sm" style="max-width:600px">
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.about-images.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Image <span class="text-danger">*</span></label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                       accept="image/*" id="imageInput" required>
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <img id="imagePreview" class="preview-box" alt="Preview">
                <div class="form-text">Accepted: JPG, PNG, WEBP. Max 2 MB.</div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Position <span class="text-danger">*</span></label>
                <select name="position" class="form-select @error('position') is-invalid @enderror" required>
                    <option value="">— Select Position —</option>
                    <option value="main"   {{ old('position') === 'main'   ? 'selected' : '' }}>Main (Large background image)</option>
                    <option value="accent" {{ old('position') === 'accent' ? 'selected' : '' }}>Accent (Small overlay image)</option>
                </select>
                @error('position') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Alt Text</label>
                <input type="text" name="alt_text" class="form-control @error('alt_text') is-invalid @enderror"
                       value="{{ old('alt_text') }}" placeholder="Describe the image for accessibility">
                @error('alt_text') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control"
                           value="{{ old('sort_order', 0) }}" min="0">
                    <div class="form-text">Lower number = shown first.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ old('status', '1') === '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Save Image
                </button>
                <a href="{{ route('admin.about-images.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('imageInput').addEventListener('change', function () {
        const preview = document.getElementById('imagePreview');
        if (this.files && this.files[0]) {
            preview.src = URL.createObjectURL(this.files[0]);
            preview.style.display = 'block';
        }
    });
</script>
@endsection
