@extends('admin.layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-gallery-images-create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/admin-gallery-image-size.css') }}">
@endsection

@php $maxImages = \App\Models\GallerySubCategory::MAX_IMAGES; @endphp

@section('content')
<div class="page-title mb-4">
    <h2>Add Gallery Images</h2>
    <p>Upload 1 to {{ $maxImages }} photos at once under a category (sub category is optional)</p>
</div>

<div class="panel-card image-card">
    <form action="{{ route('admin.gallery-images.store') }}" method="POST" enctype="multipart/form-data" id="galUploadForm">
        @csrf

        <div class="form-section-title">
            <i class="fas fa-images"></i>
            Gallery Images
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="form-label">Main Category <span>*</span></label>
                <select name="gallery_category_id" id="category" class="form-control custom-input" required
                        data-sub-url="{{ route('get-subcategories', ['categoryId' => '__ID__']) }}">
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
                <label class="form-label">Sub Category <small class="text-muted">(optional)</small></label>
                <select name="gallery_sub_category_id" id="subcategory" class="form-control custom-input"
                        data-old="{{ old('gallery_sub_category_id') }}">
                    <option value="">None — show under category only</option>
                </select>
                <small class="text-muted d-block mt-1" id="galSubRoom">A sub category can hold max {{ $maxImages }} photos.</small>
                @error('gallery_sub_category_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-12 mb-4">
                <label class="form-label">Photos <span>*</span> <small class="text-muted">(min 1, max {{ $maxImages }})</small></label>

                <label for="imageInput" class="upload-box upload-box--multi">
                    <div class="upload-preview">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <h5>Choose Photos</h5>
                        <p>Select 1 to {{ $maxImages }} JPG, PNG or WEBP photos together (max 4 MB each). You can click again to add more.</p>
                    </div>
                </label>

                <input type="file"
                       name="images[]"
                       id="imageInput"
                       class="d-none"
                       accept="image/png,image/jpeg,image/jpg,image/webp"
                       multiple
                       data-max="{{ $maxImages }}">

                <div class="gal-up-head" id="galUpHead" hidden>
                    <span><b id="galUpCount">0</b> / <span id="galUpLimit">{{ $maxImages }}</span> photos selected</span>
                    <button type="button" class="gal-up-clear" id="galUpClear"><i class="fas fa-times"></i> Remove all</button>
                </div>
                <div class="gal-up-msg" id="galUpMsg" aria-live="polite"></div>
                <div class="gal-up-list" id="galUpList"></div>

                @error('images') <small class="text-danger d-block mt-2">{{ $message }}</small> @enderror
                @foreach ($errors->get('images.*') as $messages)
                    <small class="text-danger d-block mt-1">{{ $messages[0] }}</small>
                @endforeach
                @foreach (array_merge($errors->get('alts.*'), $errors->get('orders.*')) as $messages)
                    <small class="text-danger d-block mt-1">{{ $messages[0] }}</small>
                @endforeach
            </div>

            <div class="col-md-12 mb-4">
                <div class="img-size-guide mt-0">
                    <div class="img-size-guide__title"><i class="fas fa-ruler-combined"></i> Image Size Guide</div>
                    <ul>
                        <li><span>Best shape</span> <b>Landscape 4:3</b> (e.g. 1600 × 1200 px)</li>
                        <li><span>Minimum</span> <b>1200 × 900 px</b></li>
                        <li><span>Maximum</span> <b>2400 × 1800 px</b></li>
                        <li><span>File size</span> <b>up to 4 MB</b> each · JPG, PNG or WEBP</li>
                    </ul>
                    <p>Photos are never cropped on the website. Other shapes (portrait / wide) show in full with soft blurred sides.</p>
                    <p class="mt-1"><b>Tip:</b> every tile on the gallery page is 4:3 landscape, so use 4:3 landscape photos for all photos of one sub category — they fill the tiles fully and the block looks even. Each chosen photo is checked below its name (green = good, amber = check, red = will be rejected).</p>
                    <p class="mt-1"><b>Order:</b> photos 2–5 = 2×2 on the right; photo 1 = big on the left, or with 6, 7, 8 = 2×2 on the left. 0 = no order (shown last, newest first).</p>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <label class="status-box">
                    <input type="checkbox" name="is_active" value="1" checked>
                    <div>
                        <strong>Active Status</strong>
                        <p>Show these photos on frontend gallery page.</p>
                    </div>
                </label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn save-btn">
                <i class="fas fa-save"></i> Save Photos
            </button>

            <a href="{{ route('admin.gallery-images.index') }}" class="btn back-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/admin/admin-gallery-images-create.js') }}" defer></script>
@endsection
