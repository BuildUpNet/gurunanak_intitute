@extends('admin.layouts.admin')

@section('title', 'Edit Award Section')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-awards.css') }}">
@endsection

@section('content')

<div class="page-title mb-4 d-flex flex-wrap justify-content-between align-items-start gap-3">
    <div>
        <h2>{{ $section->title }}</h2>
        <p class="mb-0">Up to 4 images fill the row; from the 5th image the row scrolls with arrows.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('about.awards') }}#award-section-{{ $section->id }}" target="_blank" class="btn btn-outline-primary">
            <i class="fas fa-eye me-1"></i> View
        </a>
        <a href="{{ route('admin.awards.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> All Sections</a>
    </div>
</div>

@include('admin.awards._errors')

{{-- 1. Section heading / description / order / status --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <h5 class="award-card-title"><i class="fas fa-heading me-2 text-primary"></i>Section Details</h5>
        <form action="{{ route('admin.awards.update', $section) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.awards._section-fields')
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Details</button>
        </form>
    </div>
</div>

{{-- 2. Upload more images --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <h5 class="award-card-title"><i class="fas fa-cloud-upload-alt me-2 text-primary"></i>Add Images</h5>
        <form action="{{ route('admin.awards.images.store', $section) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="images[]" id="awardImagesInput" class="form-control" accept="image/*" multiple required>
            <div class="form-text">Select one or many images together (Ctrl / Shift + click). JPG, PNG or WEBP, max 4 MB each, up to 20 per upload.
                Portrait images (taller than wide) look best.</div>
            <div class="award-upload-preview" id="awardUploadPreview"></div>
            <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-upload me-1"></i> Upload Images</button>
        </form>
    </div>
</div>

{{-- 3. Existing images: order / visibility / delete --}}
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h5 class="award-card-title">
            <i class="fas fa-images me-2 text-primary"></i>Images
            <span class="badge bg-secondary ms-1">{{ $section->awards->count() }}</span>
        </h5>

        @if($section->awards->isEmpty())
            <p class="text-muted mb-0">No images yet. Upload some above — this section stays hidden on the website until at least one active image exists.</p>
        @else
            <form action="{{ route('admin.awards.images.update', $section) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="award-grid">
                    @foreach($section->awards as $award)
                        <div class="award-item {{ $award->status ? '' : 'award-item--off' }}">
                            <img src="{{ asset('uploads/awards/' . $award->image) }}" alt="{{ $award->title }}">
                            <div class="award-item__bar">
                                <label class="award-item__order" title="Order — lower number shows first">
                                    <i class="fas fa-sort-numeric-down"></i>
                                    <input type="number" name="order[{{ $award->id }}]" min="0" value="{{ $award->sort_order }}" class="form-control form-control-sm">
                                </label>
                                <label class="form-check form-switch award-item__switch" title="Show on website">
                                    <input type="checkbox" name="active[{{ $award->id }}]" value="1" class="form-check-input" {{ $award->status ? 'checked' : '' }}>
                                </label>
                                <button type="submit" form="awardDelete{{ $award->id }}" class="btn btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-success mt-3"><i class="fas fa-save me-1"></i> Save Order &amp; Visibility</button>
            </form>

            @foreach($section->awards as $award)
                <form id="awardDelete{{ $award->id }}" action="{{ route('admin.awards.images.destroy', $award) }}" method="POST"
                      onsubmit="return confirm('Delete this image?')">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
        @endif
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/admin/admin-awards.js') }}"></script>
@endsection
