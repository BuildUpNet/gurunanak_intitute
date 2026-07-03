@extends('admin.layouts.admin')

@section('content')

<div class="page-title mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2>Gallery Images</h2>
            <p>Manage gallery image records</p>
        </div>

    <a href="{{ route('admin.gallery-images.create') }}"
       class="btn"
       style="background:#0d47a1; color:#fff; border-radius:10px;">
        <i class="fas fa-plus"></i> Add Image
    </a>
</div>


</div>

@if(session('success')) <div class="alert alert-success">
{{ session('success') }} </div>
@endif

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

<div class="panel-card">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th width="90">Image</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Title</th>
                    <th>Image Alt</th>
                    <th>Status</th>
                    <th width="180">Action</th>
                </tr>
            </thead>


        <tbody>

            @forelse($images as $image)

                <tr>

                    <td>
                        @if($image->image)
                            <img src="{{ asset($image->image) }}"
                                 width="70"
                                 height="60"
                                 style="object-fit:cover;border-radius:8px;">
                        @endif
                    </td>

                    <td>
                        {{ $image->category->title ?? '-' }}
                    </td>

                    <td>
                        {{ $image->subCategory->title ?? '-' }}
                    </td>

                    <td>
                        {{ $image->title }}
                    </td>

                    <td>
                        {{ $image->image_alt }}
                    </td>

                    <td>
                        <span class="badge {{ $image->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $image->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>

                    <td>

                        <a href="{{ route('admin.gallery-images.edit',$image->id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('admin.gallery-images.destroy',$image->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete Image?')">

                                <i class="fas fa-trash"></i>

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        No Record Found
                    </td>
                </tr>

            @endforelse

        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        {{ $images->links() }}
    </div>
</div>


</div>

@endsection
