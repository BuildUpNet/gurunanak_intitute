@extends('admin.layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-gallery-images-edit.css') }}">
@endsection

@section('content')
<div class="page-title mb-4">
    <h2>Update Gallery Image</h2>
    <p>Update gallery image details</p>
</div>

<div class="panel-card image-card">
    <form action="{{ route('admin.gallery-images.update', $image->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-section-title">
            <i class="fas fa-image"></i>
            Gallery Image Information
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="form-label">Main Category <span>*</span></label>
                <select name="gallery_category_id" id="category" class="form-control custom-input" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('gallery_category_id', $image->gallery_category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
                @error('gallery_category_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Sub Category <span>*</span></label>
                <select name="gallery_sub_category_id" id="subcategory" class="form-control custom-input" required>
                    <option value="">Select Sub Category</option>
                    @foreach($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}"
                            {{ old('gallery_sub_category_id', $image->gallery_sub_category_id) == $subcategory->id ? 'selected' : '' }}>
                            {{ $subcategory->title }}
                        </option>
                    @endforeach
                </select>
                @error('gallery_sub_category_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Image Title</label>
                <input type="text"
                       name="title"
                       value="{{ old('title', $image->title) }}"
                       class="form-control custom-input"
                       placeholder="Enter image title">
                @error('title') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Image Alt</label>
                <input type="text"
                       name="image_alt"
                       value="{{ old('image_alt', $image->image_alt) }}"
                       class="form-control custom-input"
                       placeholder="Enter image alt text">
                @error('image_alt') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-12 mb-4">
                <label class="form-label">Description</label>
                <textarea name="description"
                          class="form-control custom-input"
                          rows="3"
                          placeholder="Enter image description (shown on gallery page)">{{ old('description', $image->description) }}</textarea>
                @error('description') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Gallery Image</label>

                <label for="imageInput" class="upload-box">
                    @if($image->image)
                        <img src="{{ asset($image->image) }}"
                             id="imagePreview"
                             class="preview-image"
                             alt="{{ $image->image_alt }}">
                    @else
                        <div class="upload-preview" id="previewBox">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <h5>Upload Image</h5>
                            <p>Click here to choose JPG, PNG or WEBP image</p>
                        </div>

                        <img id="imagePreview" class="preview-image d-none" alt="Image Preview">
                    @endif
                </label>

                <input type="file"
                       name="image"
                       id="imageInput"
                       class="d-none"
                       accept="image/png,image/jpeg,image/jpg,image/webp">

                @error('image') <small class="text-danger d-block mt-2">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-12 mb-4">
                <label class="status-box">
                    <input type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $image->is_active) ? 'checked' : '' }}>
                    <div>
                        <strong>Active Status</strong>
                        <p>Show this image on frontend gallery page.</p>
                    </div>
                </label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn save-btn">
                <i class="fas fa-save"></i> Update Image
            </button>

            <a href="{{ route('admin.gallery-images.index') }}" class="btn back-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </form>
</div>


<script>
document.getElementById('imageInput').addEventListener('change', function(event) {
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            let preview = document.getElementById('imagePreview');
            preview.src = e.target.result;
            preview.classList.remove('d-none');

            let box = document.getElementById('previewBox');
            if (box) box.classList.add('d-none');
        };

        reader.readAsDataURL(file);
    }
});

document.getElementById('category').addEventListener('change', function() {
    let categoryId = this.value;
    let subcategory = document.getElementById('subcategory');

    subcategory.innerHTML = '<option value="">Loading...</option>';

    if (!categoryId) {
        subcategory.innerHTML = '<option value="">Select Sub Category</option>';
        return;
    }

    fetch("{{ url('admin/get-subcategories') }}/" + categoryId)
        .then(response => response.json())
        .then(data => {
            let html = '<option value="">Select Sub Category</option>';

            data.forEach(function(item) {
                html += `<option value="${item.id}">${item.title}</option>`;
            });

            subcategory.innerHTML = html;
        });
});
</script>
@endsection