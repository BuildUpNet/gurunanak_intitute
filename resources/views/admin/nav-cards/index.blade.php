@extends('admin.layouts.admin')

@section('content')

<div class="page-title mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2>Nav Program Cards</h2>
            <p>Manage the 4 program level card images shown in the Programs mega menu</p>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-semibold">Program Level Card Images</h5>
        <p class="text-muted small mb-0 mt-1">
            Recommended: <strong>400×300px</strong> &nbsp;·&nbsp;
            Format: <strong>JPG / PNG / WebP</strong> &nbsp;·&nbsp;
            Max size: <strong>2 MB per image</strong> &nbsp;·&nbsp;
            Aspect ratio: <strong>4:3</strong>
        </p>
    </div>
    <div class="card-body">

        <form action="{{ route('admin.nav-cards.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">
                @foreach($cards as $card)
                <div class="col-md-6 col-xl-3">
                    <div class="border rounded-3 overflow-hidden h-100">

                        {{-- Current image preview --}}
                        <div class="position-relative" style="height:180px; background:#07182e;">
                            @if(!empty($settings[$card['key']]))
                                <img src="{{ asset($settings[$card['key']]) }}"
                                     alt="{{ $card['label'] }}"
                                     class="w-100 h-100"
                                     style="object-fit:cover; opacity:.85">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 text-white-50 flex-column gap-2">
                                    <i class="fas fa-image fa-2x"></i>
                                    <small>No image</small>
                                </div>
                            @endif
                            <span class="position-absolute bottom-0 start-0 m-2 badge"
                                  style="background:#c0262d; font-size:.65rem; letter-spacing:.06em">
                                {{ $card['label'] }}
                            </span>
                        </div>

                        {{-- Upload --}}
                        <div class="p-3">
                            <label class="form-label fw-semibold small mb-1">{{ $card['label'] }}</label>
                            <input type="file"
                                   name="images[{{ $card['key'] }}]"
                                   class="form-control form-control-sm @error('images.'.$card['key']) is-invalid @enderror"
                                   accept="image/jpeg,image/png,image/webp">
                            @error('images.'.$card['key'])
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if(!empty($settings[$card['key']]))
                                <p class="text-success small mt-1 mb-0">
                                    <i class="fas fa-check-circle"></i> Image uploaded
                                </p>
                            @endif
                        </div>

                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-4 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-danger px-4">
                    <i class="fas fa-save me-2"></i> Save Images
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary px-4">
                    Cancel
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
