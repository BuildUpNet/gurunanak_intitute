@extends('admin.layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-hero-slides-create.css') }}">
@endsection

@section('content')
    <div class="page-title mb-4">
        <h2>Add Hero Slide</h2>
        <p>Create new hero slider image for homepage</p>
    </div>

    <div class="panel-card hero-card">
        <form action="{{ route('admin.hero-slides.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-section-title">
                <i class="fas fa-images"></i>
                Hero Slide Information
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">Alt Text</label>
                    <input type="text" name="alt_text" value="{{ old('alt_text') }}" class="form-control custom-input"
                        placeholder="Enter image alt text">

                    @error('alt_text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                        class="form-control custom-input" placeholder="Enter sort order">

                    @error('sort_order')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Slide Image <span>*</span></label>

                    <label for="imageUpload" class="upload-box">
                        <input type="file" id="imageUpload" name="image" accept="image/jpeg,image/png,image/webp"
                            hidden required>

                        <div class="upload-content" id="uploadContent">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <h4>Upload Image</h4>
                            <p>Click here to choose JPG, PNG or WEBP image</p>
                        </div>

                        <img id="imagePreview" class="preview-image" alt="Image Preview">
                    </label>

                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="col-md-12 mb-4">
                    <label class="status-box">
                        <input type="checkbox" name="status" value="1" checked>
                        <div>
                            <strong>Active Status</strong>
                            <p>Show this slide on homepage hero slider.</p>
                        </div>
                    </label>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn save-btn">
                    <i class="fas fa-save"></i> Save Slide
                </button>

                <a href="{{ route('admin.hero-slides.index') }}" class="btn back-btn">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

        </form>
    </div>


    <script>
        document.getElementById('imageUpload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');
            const content = document.getElementById('uploadContent');

            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
                content.style.display = 'none';
            }
        });
    </script>
@endsection
