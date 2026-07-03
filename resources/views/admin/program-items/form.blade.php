@extends('admin.layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-program-items-form.css') }}">
@endsection

@section('content')
    <div class="page-title mb-4">
        <h2>{{ isset($programItem) ? 'Edit Program Item' : 'Add Program Item' }}</h2>
        <p>{{ isset($programItem) ? 'Update program item details' : 'Create a new item for the Programs mega-menu' }}</p>
    </div>

    <div class="panel-card hero-card">
        <form action="{{ isset($programItem) ? route('admin.program-items.update', $programItem->id) : route('admin.program-items.store') }}"
              method="POST">
            @csrf
            @if(isset($programItem))
                @method('PUT')
            @endif

            <div class="form-section-title">
                <i class="fas fa-link"></i>
                Program Item Information
            </div>

            <div class="row">

                <div class="col-md-6 mb-4">
                    <label class="form-label">Category <span>*</span></label>
                    <select name="program_category_id" class="form-control custom-input" required>
                        <option value="">-- Select Category --</option>
                        @foreach($programCategories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('program_category_id', $programItem->program_category_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('program_category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Title <span>*</span></label>
                    <input type="text" name="title"
                           value="{{ old('title', $programItem->title ?? '') }}"
                           class="form-control custom-input"
                           placeholder="Enter item title" required>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">URL <span>*</span></label>
                    <input type="text" name="url"
                           value="{{ old('url', $programItem->url ?? '') }}"
                           class="form-control custom-input"
                           placeholder="/academics#undergraduate" required>
                    @error('url')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order"
                           value="{{ old('sort_order', $programItem->sort_order ?? 0) }}"
                           class="form-control custom-input"
                           placeholder="Enter sort order">
                    @error('sort_order')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-12 mb-4">
                    <label class="status-box">
                        <input type="hidden" name="status" value="0">
                        <input type="checkbox" name="status" value="1"
                               {{ old('status', $programItem->status ?? 1) ? 'checked' : '' }}>
                        <div>
                            <strong>Active Status</strong>
                            <p>Show this item in the Programs navigation menu.</p>
                        </div>
                    </label>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn save-btn">
                    <i class="fas fa-save"></i>
                    {{ isset($programItem) ? 'Update Item' : 'Save Item' }}
                </button>
                <a href="{{ route('admin.program-items.index') }}" class="btn back-btn">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

        </form>
    </div>

@endsection
