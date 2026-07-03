@extends('admin.layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-gallery-images-create.css') }}">
@endsection

@section('content')
<div class="page-title mb-4">
    <h2>Add Gallery Image</h2>
    <p>Create new gallery image under category and sub category</p>
</div>

<div class="panel-card image-card">
    <form action="{{ route('admin.gallery-images.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

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
                        <option value="{{ $category->id }}" {{ old('gallery_category_id') == $category->id ? 'selected' : '' }}>
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
                </select>
                @error('gallery_sub_category_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Title</label>
                <input type="text"
                       name="title"
                       value="{{ old('title') }}"
                       class="form-control custom-input"
                       placeholder="Enter  title">
                @error('title') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Image Alt Text</label>
                <input type="text"
                       name="image_alt"
                       value="{{ old('image_alt') }}"
                       class="form-control custom-input"
                       placeholder="Enter SEO image alt text">
                @error('image_alt') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-12 mb-4">
                <label class="form-label">Description</label>
                <textarea name="description"
                          class="form-control custom-input"
                          rows="3"
                          placeholder="Enter image description (shown on gallery page)">{{ old('description') }}</textarea>
                @error('description') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Gallery Image <span>*</span></label>

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
                       accept="image/png,image/jpeg,image/jpg,image/webp"
                       required>

                @error('image') <small class="text-danger d-block mt-2">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-12 mb-4">
                <label class="status-box">
                    <input type="checkbox" name="is_active" value="1" checked>
                    <div>
                        <strong>Active Status</strong>
                        <p>Show this gallery image on frontend gallery page.</p>
                    </div>
                </label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn save-btn">
                <i class="fas fa-save"></i> Save Image
            </button>

            <a href="{{ route('admin.gallery-images.index') }}" class="btn back-btn">
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


    const category = document.getElementById('category');
    const subcategory = document.getElementById('subcategory');

    category.addEventListener('change', function () {
        let categoryId = this.value;

        subcategory.innerHTML = '<option value="">Loading...</option>';

        if (!categoryId) {
            subcategory.innerHTML = '<option value="">Select Sub Category</option>';
            return;
        }

        let url = "{{ route('get-subcategories', ['categoryId' => ':id']) }}";
        url = url.replace(':id', categoryId);

        fetch(url)
            .then(response => response.json())
            .then(data => {
                let html = '<option value="">Select Sub Category</option>';

                if (data.length > 0) {
                    data.forEach(item => {
                        html += `<option value="${item.id}">${item.title}</option>`;
                    });
                } else {
                    html += '<option value="">No Sub Category Found</option>';
                }

                subcategory.innerHTML = html;
            })
            .catch(error => {
                subcategory.innerHTML = '<option value="">Error loading sub category</option>';
                console.log(error);
            });
    });

});
</script>
@endsection