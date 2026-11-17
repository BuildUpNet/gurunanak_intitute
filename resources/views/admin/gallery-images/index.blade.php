@extends('admin.layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-gallery-images-index.css') }}">
@endsection

@section('content')

<div class="page-title mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2>Gallery Images</h2>
            <p>Manage gallery image records</p>
        </div>

        <a href="{{ route('admin.gallery-images.create') }}" class="btn gal-add-btn">
            <i class="fas fa-plus"></i> Add Image
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<div class="gal-order-help">
    <i class="fas fa-sort-numeric-down"></i>
    <div>
        <strong>Photo order on the gallery page</strong>
        <p>
            Filter by Category / Sub Category (event), type the order numbers and click <b>Save Order</b>.
            <b>1</b> = big photo on the left, <b>2–5</b> = the 4 small photos on the right,
            <b>6+</b> = next rows from the left. Leave <b>0</b> for no order (shown after the numbered photos, newest first).
        </p>
    </div>
</div>

<div class="panel-card mb-3 admin-filter-bar">
    <form method="GET" class="row g-2 align-items-center">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search title...">
        </div>
        <div class="col-md-3">
            <select name="gallery_category_id" class="form-select">
                <option value="">— All Categories —</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('gallery_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="gallery_sub_category_id" class="form-select">
                <option value="">— All Sub Categories —</option>
                @foreach($subCategories as $sub)
                    <option value="{{ $sub->id }}" {{ request('gallery_sub_category_id') == $sub->id ? 'selected' : '' }}>{{ $sub->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary flex-fill"><i class="fas fa-filter"></i></button>
            <a href="{{ route('admin.gallery-images.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>
</div>

{{-- Order inputs in the table belong to this form (via form="galOrderForm"),
     so the per-row delete forms stay separate --}}
<form id="galOrderForm" action="{{ route('admin.gallery-images.order') }}" method="POST">
    @csrf
    @method('PUT')
</form>

<div class="panel-card">
    @if($images->count())
        <div class="gal-order-bar">
            <span>Showing {{ $images->firstItem() }}–{{ $images->lastItem() }} of {{ $images->total() }}</span>
            <button type="submit" form="galOrderForm" class="btn gal-order-save">
                <i class="fas fa-save"></i> Save Order
            </button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th class="sortable-th gal-col-order">
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'sort_order', 'direction' => $sort === 'sort_order' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                            Order
                            @if ($sort === 'sort_order')
                                <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort text-muted"></i>
                            @endif
                        </a>
                    </th>
                    <th class="gal-col-img">Image</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th class="sortable-th">
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'title', 'direction' => $sort === 'title' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                            Title
                            @if ($sort === 'title')
                                <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort text-muted"></i>
                            @endif
                        </a>
                    </th>
                    <th>Image Alt</th>
                    <th class="sortable-th">
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'is_active', 'direction' => $sort === 'is_active' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                            Status
                            @if ($sort === 'is_active')
                                <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort text-muted"></i>
                            @endif
                        </a>
                    </th>
                    <th class="gal-col-action">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($images as $image)
                    <tr>
                        <td>
                            <input type="number"
                                   name="order[{{ $image->id }}]"
                                   form="galOrderForm"
                                   value="{{ $image->sort_order }}"
                                   min="0"
                                   max="9999"
                                   class="form-control form-control-sm gal-order-input"
                                   aria-label="Order for {{ $image->title ?: 'image ' . $image->id }}">
                        </td>

                        <td>
                            @if($image->image)
                                <img src="{{ asset($image->image) }}" class="gal-thumb" alt="{{ $image->image_alt }}">
                            @endif
                        </td>

                        <td>{{ $image->category->title ?? '-' }}</td>

                        <td>{{ $image->subCategory->title ?? '-' }}</td>

                        <td>{{ $image->title }}</td>

                        <td>{{ $image->image_alt }}</td>

                        <td>
                            <span class="badge {{ $image->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $image->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <td>
                            <a href="{{ route('admin.gallery-images.edit', $image->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('admin.gallery-images.destroy', $image->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Delete Image?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            No Record Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $images->links() }}
    </div>
</div>

@endsection
