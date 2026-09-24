@extends('admin.layouts.admin')

@section('title', $award ? 'Edit Award' : 'Add Award')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-awards.css') }}">
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h4 class="mb-0">
        <i class="fas {{ $award ? 'fa-edit' : 'fa-plus-circle' }} me-2 text-primary"></i>{{ $award ? 'Edit Award' : 'Add Award' }}
    </h4>
    <a href="{{ route('admin.awards.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card shadow-sm award-form-card">
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

        <form action="{{ $award ? route('admin.awards.update', $award) : route('admin.awards.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if($award)
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title', $award?->title) }}" placeholder="e.g. Global Achiever Award" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Subtitle</label>
                <input type="text" name="subtitle" class="form-control @error('subtitle') is-invalid @enderror"
                       value="{{ old('subtitle', $award?->subtitle) }}" placeholder="e.g. 2014 · Dubai">
                <div class="form-text">Optional — year, place or presenting body. Shown as a small tag above the title.</div>
                @error('subtitle')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" id="awardDescription" rows="6" class="form-control @error('description') is-invalid @enderror">{{ old('description', $award?->description) }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Image @unless($award)<span class="text-danger">*</span>@endunless</label>
                @if($award?->image)
                    <div class="mb-2">
                        <img src="{{ asset('uploads/awards/' . $award->image) }}" alt="{{ $award->title }}" class="award-preview award-preview--show">
                        <div class="form-text">Upload a new image only if you want to replace this one.</div>
                    </div>
                @endif
                <input type="file" name="image" id="awardImageInput" accept="image/*"
                       class="form-control @error('image') is-invalid @enderror" {{ $award ? '' : 'required' }}>
                <img id="awardImagePreview" class="award-preview" alt="Preview">
                <div class="form-text">JPG, PNG or WEBP, max 2 MB. A landscape photo (about 4:3) looks best.</div>
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Sort Order</label>
                    <input type="number" name="sort_order" min="0" class="form-control"
                           value="{{ old('sort_order', $award?->sort_order ?? 0) }}">
                    <div class="form-text">Lower number = shown first. 1st section: image left, 2nd: image right, and so on.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    @php $status = (string) old('status', $award ? (int) $award->status : 1); @endphp
                    <select name="status" class="form-select">
                        <option value="1" {{ $status === '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $status === '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> {{ $award ? 'Update Award' : 'Save Award' }}
                </button>
                <a href="{{ route('admin.awards.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.getElementById('awardDescription'), {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', '|', 'bulletedList', 'numberedList', 'blockQuote', '|', 'undo', 'redo'],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading3', view: 'h3', title: 'Heading', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Sub Heading', class: 'ck-heading_heading4' }
            ]
        }
    }).catch(function (e) { console.error(e); });


    document.getElementById('awardImageInput').addEventListener('change', function () {
        var preview = document.getElementById('awardImagePreview');
        if (this.files && this.files[0]) {
            preview.src = URL.createObjectURL(this.files[0]);
            preview.classList.add('award-preview--show');
        }
    });
</script>
@endsection
