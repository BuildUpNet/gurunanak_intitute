@extends('admin.layouts.admin')

@section('title', 'About Section Images')

@section('styles')
<style>
    /* ── page wrapper ── */
    .ai-page { padding: 24px; }

    /* ── filter card ── */
    .ai-filter-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 1px 6px rgba(0,0,0,.07);
        padding: 14px 16px;
        margin-bottom: 20px;
    }
    .ai-filter-card form {
        display: flex;
        align-items: center;
        gap: 0;
        flex-wrap: nowrap;
        border: 1px solid #dde3ee;
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
    }
    .ai-filter-card .form-control {
        flex: 1 1 0;
        border: none;
        border-right: 1px solid #dde3ee;
        border-radius: 0;
        font-size: 13.5px;
        height: 44px;
        background: #fff;
        padding: 0 16px;
        box-shadow: none;
        outline: none;
        color: #374151;
    }
    .ai-filter-card .form-control:focus { box-shadow: none; background: #fff; }
    .ai-filter-card .form-control::placeholder { color: #b0b8cc; }
    .ai-filter-card .form-select {
        flex: 0 0 220px;
        border: none;
        border-right: 1px solid #dde3ee;
        border-radius: 0;
        font-size: 13.5px;
        height: 44px;
        background: #fff;
        padding: 0 16px;
        box-shadow: none;
        outline: none;
        color: #374151;
        cursor: pointer;
    }
    .ai-filter-card .form-select:focus { box-shadow: none; background: #fff; }
    .btn-filter {
        flex: 0 0 110px;
        background: #1657d5;
        color: #fff;
        border: none;
        border-radius: 0;
        height: 44px;
        font-size: 13.5px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        cursor: pointer;
        white-space: nowrap;
    }
    .btn-filter:hover { background: #1245b5; color: #fff; }
    .btn-reset {
        flex: 0 0 70px;
        background: #fff;
        color: #374151;
        border: none;
        border-left: 1px solid #dde3ee;
        border-radius: 0;
        height: 44px;
        font-size: 13.5px;
        font-weight: 500;
        text-align: center;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
    }
    .btn-reset:hover { background: #f3f4f6; color: #111; }

    /* ── table card ── */
    .ai-table-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 1px 6px rgba(0,0,0,.07);
        overflow: hidden;
    }
    .ai-table-card table { margin: 0; }
    .ai-table-card thead tr {
        background: transparent;
        border-bottom: 2px solid #e9edf5;
    }
    .ai-table-card thead th {
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: #6b7a99;
        padding: 14px 18px;
        background: transparent;
        border: none;
    }
    .ai-table-card tbody tr { border-bottom: 1px solid #f0f3f9; }
    .ai-table-card tbody tr:last-child { border-bottom: none; }
    .ai-table-card tbody td {
        padding: 14px 18px;
        font-size: 14px;
        color: #1e2640;
        vertical-align: middle;
        border: none;
    }
    .ai-table-card tbody tr:hover { background: #f7f9fd; }

    /* row number */
    .ai-table-card tbody td:first-child { color: #6b7a99; font-weight: 600; }

    /* candidate/alt name bold */
    .td-name { font-weight: 700; color: #1e2640; }

    /* image thumb */
    .img-thumb {
        width: 82px;
        height: 56px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
    }

    /* pill badge for position */
    .pill {
        display: inline-block;
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    .pill-main   { background: #dbeafe; color: #1d4ed8; }
    .pill-accent { background: #fee2e2; color: #b91c1c; }
    .pill-active   { background: #dcfce7; color: #15803d; }
    .pill-inactive { background: #f1f5f9; color: #64748b; }

    /* action buttons */
    .btn-act-edit {
        background: #1657d5;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 6px 14px;
        font-size: 13px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
    }
    .btn-act-edit:hover { background: #1245b5; color: #fff; }
    .btn-act-del {
        background: #dc2626;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 6px 14px;
        font-size: 13px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
    }
    .btn-act-del:hover { background: #b91c1c; color: #fff; }
    .actions-cell { display: flex; gap: 6px; align-items: center; }

    /* add button */
    .btn-add {
        background: #1657d5;
        color: #fff;
        border: none;
        border-radius: 7px;
        height: 38px;
        padding: 0 20px;
        font-size: 13.5px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }
    .btn-add:hover { background: #1245b5; color: #fff; }

    /* toast alert */
    .ai-toast {
        position: fixed;
        top: 22px;
        right: 24px;
        z-index: 9999;
        min-width: 280px;
        max-width: 380px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 18px rgba(0,0,0,.13);
        padding: 14px 18px;
        display: flex;
        align-items: center;
        gap: 12px;
        border-left: 4px solid #16a34a;
        animation: slideIn .3s ease;
    }
    .ai-toast .toast-icon { color: #16a34a; font-size: 18px; flex-shrink: 0; }
    .ai-toast .toast-msg  { font-size: 13.5px; color: #1e2640; flex: 1; }
    .ai-toast .toast-close {
        background: none; border: none; color: #9ca3af;
        font-size: 16px; cursor: pointer; padding: 0; line-height: 1;
    }
    @keyframes slideIn {
        from { opacity: 0; transform: translateX(40px); }
        to   { opacity: 1; transform: translateX(0); }
    }

    /* info strip */
    .ai-info {
        margin-top: 16px;
        font-size: 12.5px;
        color: #6b7a99;
        padding: 10px 16px;
        background: #f0f5ff;
        border-radius: 8px;
        border-left: 3px solid #1657d5;
    }

    /* empty state */
    .empty-state { padding: 48px 20px; text-align: center; color: #9ca3af; }
    .empty-state i { font-size: 36px; margin-bottom: 12px; display: block; }
</style>
@endsection

@section('content')

{{-- Toast notification (auto-dismiss) --}}
@if(session('success'))
<div class="ai-toast" id="aiToast">
    <i class="fas fa-check-circle toast-icon"></i>
    <span class="toast-msg">{{ session('success') }}</span>
    <button class="toast-close" onclick="document.getElementById('aiToast').remove()">
        <i class="fas fa-times"></i>
    </button>
</div>
<script>
    setTimeout(function () {
        var t = document.getElementById('aiToast');
        if (t) { t.style.transition = 'opacity .4s'; t.style.opacity = '0'; setTimeout(() => t.remove(), 400); }
    }, 3500);
</script>
@endif

<div class="ai-page">

    {{-- Page heading --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0 fw-bold" style="font-size:20px; color:#1e2640;">
            About Section Images
        </h4>
        <a href="{{ route('admin.about-images.create') }}" class="btn-add">
            <i class="fas fa-plus"></i> Add Image
        </a>
    </div>

    {{-- Filter bar --}}
    <div class="ai-filter-card">
        <form method="GET" class="d-flex align-items-center gap-3" style="flex-wrap:nowrap">
            <input type="text" name="search" class="form-control"
                   placeholder="Search alt text…" value="{{ request('search') }}">
            <select name="status" class="form-select">
                <option value="">— All Status —</option>
                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
            </select>
            <button type="submit" class="btn-filter">
                <i class="fas fa-filter"></i> Filter
            </button>
            <a href="{{ route('admin.about-images.index') }}" class="btn-reset">Reset</a>
        </form>    </div>

    {{-- Table --}}
    <div class="ai-table-card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width:48px">#</th>
                        <th>Image</th>
                        <th>Alt Text</th>
                        <th>Position</th>
                        <th>Sort</th>
                        <th>Status</th>
                        <th style="text-align:right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($images as $img)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $img->image) }}"
                                 alt="{{ $img->alt_text }}" class="img-thumb">
                        </td>
                        <td class="td-name">{{ $img->alt_text ?? '—' }}</td>
                        <td>
                            <span class="pill {{ $img->position === 'main' ? 'pill-main' : 'pill-accent' }}">
                                {{ ucfirst($img->position) }}
                            </span>
                        </td>
                        <td>{{ $img->sort_order }}</td>
                        <td>
                            @if($img->status)
                                <span class="pill pill-active">Active</span>
                            @else
                                <span class="pill pill-inactive">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions-cell justify-content-end">
                                <a href="{{ route('admin.about-images.edit', $img) }}" class="btn-act-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.about-images.destroy', $img) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this image?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-act-del">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fas fa-image"></i>
                                No about images found.
                                <a href="{{ route('admin.about-images.create') }}" style="color:#1657d5">Add one now.</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $images->links() }}
    </div>

    {{-- Info strip --}}
    <div class="ai-info">
        <i class="fas fa-info-circle me-1"></i>
        <strong>Position guide:</strong>
        <span class="pill pill-main" style="font-size:11px">Main</span> = large background image (left side).
        <span class="pill pill-accent" style="font-size:11px">Accent</span> = smaller overlapping image (bottom-right overlay).
        Only the first active image of each position is displayed on the front end.
    </div>

</div>
@endsection
