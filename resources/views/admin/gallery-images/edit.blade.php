@extends('admin.layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-gallery-images-edit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/admin-gallery-image-size.css') }}">
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
                <label class="form-label">Sub Category <small class="text-muted">(optional)</small></label>
                <select name="gallery_sub_category_id" id="subcategory" class="form-control custom-input">
                    <option value="">None — show under category only</option>
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
                       placeholder="Short title — up to 40 characters fit in one line">
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
                          id="galDescInput"
                          data-two-lines="100"
                          placeholder="Up to 100 characters fit in 2 lines on the gallery page. Longer text is kept in full — visitors see a &quot;Read more&quot; link.">{{ old('description', $image->description) }}</textarea>
                <div class="gal-desc-meter" id="galDescMeter" aria-live="polite">
                    <span class="gal-desc-meter__count"><b id="galDescCount">0</b> / 100 characters (2 lines)</span>
                    <span class="gal-desc-meter__note" id="galDescNote">Longer text will show a "Read more" link.</span>
                </div>
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
                            <p>Click here to choose JPG, PNG or WEBP image (max 4 MB)</p>
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

            <div class="col-md-6 mb-4">
                <label class="form-label">Display Order</label>
                <input type="number"
                       name="sort_order"
                       min="0"
                       max="9999"
                       value="{{ old('sort_order', $image->sort_order) }}"
                       class="form-control custom-input">
                <small class="text-muted d-block mt-1">
                    1 = big photo of the event, 2–5 = small photos on the right, 6+ = next rows. 0 = no order (shown last, newest first).
                </small>
                @error('sort_order') <small class="text-danger d-block">{{ $message }}</small> @enderror

                <div class="img-size-guide">
                    <div class="img-size-guide__title"><i class="fas fa-ruler-combined"></i> Image Size Guide</div>
                    <ul>
                        <li><span>Best shape</span> <b>Landscape 4:3</b> (e.g. 1600 × 1200 px)</li>
                        <li><span>Minimum</span> <b>1200 × 900 px</b></li>
                        <li><span>Maximum</span> <b>2400 × 1800 px</b></li>
                        <li><span>File size</span> <b>up to 4 MB</b> · JPG, PNG or WEBP</li>
                    </ul>
                    <p>Photos are never cropped on the website. Other shapes (portrait / wide) show in full with soft blurred sides.</p>
                    <div class="img-size-check" id="imgSizeCheck" aria-live="polite"></div>
                </div>
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
// Description: live count against the 2-line limit (never blocks typing)
(function () {
    const descInput = document.getElementById('galDescInput');
    const descMeter = document.getElementById('galDescMeter');
    const descCount = document.getElementById('galDescCount');
    if (!descInput || !descMeter || !descCount) return;
    const limit = parseInt(descInput.dataset.twoLines, 10) || 100;
    const updateDescMeter = function () {
        const len = descInput.value.trim().length;
        descCount.textContent = len;
        descMeter.classList.toggle('is-over', len > limit);
    };
    descInput.addEventListener('input', updateDescMeter);
    updateDescMeter();
})();

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
        subcategory.innerHTML = '<option value="">None — show under category only</option>';
        return;
    }

    fetch("{{ url('admin/get-subcategories') }}/" + categoryId)
        .then(response => response.json())
        .then(data => {
            let html = '<option value="">None — show under category only</option>';

            data.forEach(function(item) {
                html += `<option value="${item.id}">${item.title}</option>`;
            });

            subcategory.innerHTML = html;
        });
});
</script>
@endsection

@section('scripts')
    <script src="{{ asset('js/admin/admin-gallery-image-size.js') }}" defer></script>
@endsection
