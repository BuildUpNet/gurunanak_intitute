@extends('admin.layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-gallery-categories-create.css') }}">
@endsection

@section('content')
<div class="page-title mb-4">
    <h2>Add Gallery Category</h2>
    <p>Create new gallery category</p>
</div>

<div class="panel-card category-card">
    <form action="{{ route('admin.gallery-categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-section-title">
            <i class="fas fa-folder-open"></i>
            Gallery Category Information
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="form-label">Title <span>*</span></label>
                <input type="text"
                       id="title"
                       name="title"
                       value="{{ old('title') }}"
                       class="form-control custom-input"
                       placeholder="Enter category title"
                       required>
                @error('title') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Slug</label>
                <input type="text"
                       id="slug"
                       name="slug"
                       value="{{ old('slug') }}"
                       class="form-control custom-input"
                       placeholder="category-slug">
                @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-12 mb-4">
                <label class="form-label">Short Description</label>
                <textarea name="short_description"
                          rows="4"
                          class="form-control custom-textarea"
                          placeholder="Enter short description">{{ old('short_description') }}</textarea>
                @error('short_description') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Category Image</label>

                <label for="imageInput" class="upload-box">
                    <div class="upload-preview" id="previewBox">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <h5>Upload Image</h5>
                        <p>Click here to choose JPG, PNG or WEBP image</p>
                    </div>

                    <img id="imagePreview" class="preview-image d-none" alt="Image Preview">
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
                    <input type="checkbox" name="is_active" value="1" checked>
                    <div>
                        <strong>Active Status</strong>
                        <p>Show this gallery category on frontend gallery page.</p>
                    </div>
                </label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn save-btn">
                <i class="fas fa-save"></i> Save Category
            </button>

            <a href="{{ route('admin.gallery-categories.index') }}" class="btn back-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </form>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const previewBox = document.getElementById('previewBox');

    imageInput.addEventListener('change', function (event) {
        const file = event.target.files[0];

        if (!file) {
            imagePreview.classList.add('d-none');
            previewBox.classList.remove('d-none');
            return;
        }

        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

        if (!allowedTypes.includes(file.type)) {
            alert('Please select JPG, PNG or WEBP image only.');
            imageInput.value = '';
            imagePreview.classList.add('d-none');
            previewBox.classList.remove('d-none');
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            imagePreview.classList.remove('d-none');
            previewBox.classList.add('d-none');
        };

        reader.readAsDataURL(file);
    });


    let slugEdited = false;

    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');

    slugInput.addEventListener('input', function () {
        slugEdited = true;
    });

    titleInput.addEventListener('keyup', function () {
        if (slugEdited) return;

        let slug = this.value
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');

        slugInput.value = slug;
    });

});
</script>
@endsection