@extends('admin.layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-gallery-images-index.css') }}">
@endsection

@php $maxImages = \App\Models\GallerySubCategory::MAX_IMAGES; @endphp

@section('content')

<div class="page-title mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h2>Gallery Images</h2>
            <p>One row per sub category (max {{ $maxImages }} photos). Click a row to change all its photos together.</p>
        </div>

        <a href="{{ route('admin.gallery-images.create') }}" class="btn gal-add-btn">
            <i class="fas fa-plus"></i> Add Images
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<div class="panel-card mb-3 admin-filter-bar">
    <form method="GET" class="row g-2 align-items-center">
        <div class="col-md-5">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search category / sub category...">
        </div>
        <div class="col-md-5">
            <select name="gallery_category_id" class="form-select">
                <option value="">— All Categories —</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('gallery_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary flex-fill"><i class="fas fa-filter"></i></button>
            <a href="{{ route('admin.gallery-images.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>
</div>

<div class="gal-groups">
    @forelse($groups as $group)
        @php
            $count = $group->images->count();
            $full = $group->sub && $count >= $maxImages;
        @endphp
        <a href="{{ $group->url }}" class="gal-group-row">
            <div class="gal-group-row__info">
                <span class="gal-group-row__cat">{{ $group->category->title }}</span>
                <strong class="gal-group-row__title">
                    @if ($group->sub)
                        {{ $group->sub->displayTitle() }}
                        @if ($group->sub->heading && $group->sub->heading !== $group->sub->title)
                            <small>({{ $group->sub->title }})</small>
                        @endif
                    @else
                        Photos without sub category
                    @endif
                </strong>
                <span class="gal-group-row__meta">
                    <span @class(['gal-badge', 'gal-badge--full' => $full, 'gal-badge--empty' => !$count])>
                        {{ $count }}{{ $group->sub ? ' / ' . $maxImages : '' }} photos
                    </span>
                    @if ($group->inactive)
                        <span class="gal-badge gal-badge--off">{{ $group->inactive }} inactive</span>
                    @endif
                    @if ($group->sub && !$group->sub->is_active)
                        <span class="gal-badge gal-badge--off">Sub category inactive</span>
                    @endif
                </span>
            </div>

            <div class="gal-group-row__thumbs">
                @forelse ($group->images->take($maxImages) as $image)
                    <img src="{{ asset($image->image) }}" alt="" loading="lazy" @class(['is-off' => !$image->is_active])>
                @empty
                    <span class="gal-group-row__empty"><i class="fas fa-plus"></i> No photos yet — click to add</span>
                @endforelse
                @if ($count > $maxImages)
                    <span class="gal-group-row__more">+{{ $count - $maxImages }}</span>
                @endif
            </div>

            <span class="gal-group-row__btn"><i class="fas fa-edit"></i> Edit Photos</span>
        </a>
    @empty
        <div class="panel-card text-center text-muted py-4">No Record Found</div>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $groups->links() }}
</div>

@endsection
