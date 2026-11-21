@extends('admin.layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-gallery-images-create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/admin-gallery-image-size.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/admin-gallery-images-group.css') }}">
@endsection

@php
    $groupTitle = $subCategory ? $subCategory->displayTitle() : $category->title . ' — photos without sub category';
    $limited = (bool) $subCategory;
    $siteUrl = $category->slug
        ? ($subCategory && $subCategory->slug
            ? route('gallery.sub', [$category->slug, $subCategory->slug])
            : route('gallery.category', $category->slug))
        : null;
@endphp

@section('content')
<div class="page-title mb-4">
    <div class="gal-grp-top">
        <div>
            <div class="gal-grp-crumb">
                {{ $category->title }}
                @if ($subCategory)
                    <i class="fas fa-chevron-right"></i> {{ $subCategory->title }}
                @endif
            </div>
            <h2>{{ $groupTitle }}</h2>
            <p>Change all photos of this group together, then click <b>Save All</b>.</p>
        </div>
        <div class="gal-grp-actions">
            @if ($subCategory)
                <a href="{{ route('admin.gallery-subcategories.edit', $subCategory) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-heading"></i> Edit title &amp; description
                </a>
            @endif
            @if ($siteUrl)
                <a href="{{ $siteUrl }}" target="_blank" rel="noopener" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-external-link-alt"></i> View on website
                </a>
            @endif
            <a href="{{ route('admin.gallery-images.index') }}" class="btn back-btn btn-sm">
                <i class="fas fa-arrow-left"></i> All groups
            </a>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $message)
            <div>{{ $message }}</div>
        @endforeach
    </div>
@endif

<form action="{{ route('admin.gallery-images.group.update', [$category->id, $subCategory->id ?? 0]) }}"
      method="POST" enctype="multipart/form-data" id="galGroupForm"
      data-max="{{ $maxImages }}" data-limited="{{ $limited ? 1 : 0 }}">
    @csrf
    @method('PUT')

    <div class="panel-card image-card mb-4">
        <div class="gal-grp-head">
            <div class="form-section-title mb-0">
                <i class="fas fa-images"></i>
                Photos in this group
            </div>
            <span class="gal-grp-count" id="galGrpCount">
                <b id="galGrpUsed">{{ $images->count() }}</b>{{ $limited ? ' / ' . $maxImages : '' }} photos
            </span>
        </div>
        <p class="gal-grp-help">
            <b>Display Order:</b> photos 2–5 = 2×2 on the right; photo 1 = big on the left, or with 6, 7, 8 = 2×2 on the left.
            0 = no order (shown last). Tick <b>Remove</b> to delete a photo, <b>Replace</b> to change the picture.
        </p>

        @if ($images->count())
            <div class="gal-up-list">
                @foreach ($images as $image)
                    @php $row = 'photos[' . $image->id . ']'; @endphp
                    <div class="gal-up-item gal-grp-item" data-photo>
                        <div class="gal-up-thumb">
                            <img src="{{ asset($image->image) }}" alt="{{ $image->image_alt }}" data-thumb>
                            <span class="gal-up-no">{{ $loop->iteration }}</span>
                        </div>
                        <div class="gal-up-body">
                            <div class="gal-up-fields mt-0">
                                <label class="gal-up-field gal-up-field--alt"><span>Image Alt Text</span>
                                    <input type="text" name="{{ $row }}[alt]" maxlength="255" class="form-control custom-input"
                                           value="{{ old('photos.' . $image->id . '.alt', $image->image_alt) }}" placeholder="SEO alt text (optional)">
                                </label>
                                <label class="gal-up-field gal-up-field--order"><span>Display Order</span>
                                    <input type="number" name="{{ $row }}[order]" min="0" max="9999" class="form-control custom-input"
                                           value="{{ old('photos.' . $image->id . '.order', $image->sort_order) }}">
                                </label>
                            </div>
                            <div class="gal-grp-tools">
                                <label class="gal-grp-check">
                                    <input type="hidden" name="{{ $row }}[active]" value="0">
                                    <input type="checkbox" name="{{ $row }}[active]" value="1"
                                           @checked(old('photos.' . $image->id . '.active', $image->is_active))>
                                    Active
                                </label>
                                <label class="gal-grp-replace">
                                    <i class="fas fa-sync-alt"></i> Replace
                                    <input type="file" name="{{ $row }}[file]" class="d-none" data-replace
                                           accept="image/png,image/jpeg,image/jpg,image/webp">
                                </label>
                                <label class="gal-grp-check gal-grp-check--remove">
                                    <input type="checkbox" name="{{ $row }}[delete]" value="1" data-remove-photo
                                           @checked(old('photos.' . $image->id . '.delete'))>
                                    Remove
                                </label>
                            </div>
                            <span class="gal-grp-note" data-replace-note></span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted mb-0">No photos in this group yet — add them below.</p>
        @endif
    </div>

    <div class="panel-card image-card mb-4">
        <div class="form-section-title">
            <i class="fas fa-plus-circle"></i>
            Add more photos
        </div>

        <label for="imageInput" class="upload-box upload-box--multi">
            <div class="upload-preview">
                <i class="fas fa-cloud-upload-alt"></i>
                <h5>Choose Photos</h5>
                <p id="galGrpRoom">
                    @if ($limited)
                        This group can hold max {{ $maxImages }} photos. JPG, PNG or WEBP, max 4 MB each.
                    @else
                        Up to {{ $maxImages }} photos at once. JPG, PNG or WEBP, max 4 MB each.
                    @endif
                </p>
            </div>
        </label>

        <input type="file"
               name="images[]"
               id="imageInput"
               class="d-none"
               accept="image/png,image/jpeg,image/jpg,image/webp"
               multiple
               data-max="{{ $maxImages }}"
               data-limited="{{ $limited ? 1 : 0 }}"
               data-used="{{ $images->count() }}"
               data-order-start="{{ $images->count() }}">

        <div class="gal-up-head" id="galUpHead" hidden>
            <span><b id="galUpCount">0</b> / <span id="galUpLimit">{{ $maxImages }}</span> new photos selected</span>
            <button type="button" class="gal-up-clear" id="galUpClear"><i class="fas fa-times"></i> Remove all new</button>
        </div>
        <div class="gal-up-msg" id="galUpMsg" aria-live="polite"></div>
        <div class="gal-up-list" id="galUpList"></div>

        <div class="img-size-guide">
            <div class="img-size-guide__title"><i class="fas fa-ruler-combined"></i> Image Size Guide</div>
            <ul>
                <li><span>Best shape</span> <b>Landscape 4:3</b> (e.g. 1600 × 1200 px)</li>
                <li><span>Minimum</span> <b>1200 × 900 px</b></li>
                <li><span>Maximum</span> <b>2400 × 1800 px</b></li>
                <li><span>File size</span> <b>up to 4 MB</b> each · JPG, PNG or WEBP</li>
            </ul>
            <p>Photos are never cropped on the website. Other shapes (portrait / wide) show in full with soft blurred sides.</p>
            <p class="mt-1"><b>Tip:</b> every tile on the gallery page is 4:3 landscape, so use 4:3 landscape photos for all photos of one sub category — they fill the tiles fully and the block looks even.</p>
        </div>
    </div>

    <div class="gal-grp-save">
        <button type="submit" class="btn save-btn">
            <i class="fas fa-save"></i> Save All
        </button>
        <a href="{{ route('admin.gallery-images.index') }}" class="btn back-btn">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</form>
@endsection

@section('scripts')
    <script src="{{ asset('js/admin/admin-gallery-images-create.js') }}" defer></script>
    <script src="{{ asset('js/admin/admin-gallery-images-group.js') }}" defer></script>
@endsection
