@extends('admin.layouts.admin')

@section('title', 'API Access')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-api-access.css') }}">
@endsection

@section('content')

<div class="page-title mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h2>API Access</h2>
            <p>Read-only API for website form submissions. Developers can fetch submissions (GET only). Nothing can be edited or deleted through the API.</p>
        </div>
        <a href="{{ route('admin.api-access.docs') }}" class="btn btn-primary">
            <i class="fas fa-book-open me-1"></i> API Documentation
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

{{-- Newly generated key — shown only once --}}
@if(session('new_api_key'))
    <div class="api-newkey mb-4">
        <div class="api-newkey__head"><i class="fas fa-key me-2"></i>Your new API key — copy it now, it will NOT be shown again</div>
        <div class="api-copy-row">
            <code class="api-code" id="newApiKey">{{ session('new_api_key') }}</code>
            <button type="button" class="btn btn-sm btn-dark api-copy-btn" data-copy="#newApiKey"><i class="fas fa-copy me-1"></i>Copy</button>
        </div>
    </div>
@endif

<div class="row g-4">

    {{-- ─── KEYS ─── --}}
    <div class="col-lg-5">
        <div class="panel-card h-100">
            <h6 class="api-card-title"><i class="fas fa-key text-danger me-2"></i>API Keys</h6>

            <form action="{{ route('admin.api-access.store') }}" method="POST" class="d-flex gap-2 mb-3">
                @csrf
                <input type="text" name="name" class="form-control form-control-sm" maxlength="100" required
                       placeholder="Key name, e.g. Client Portal">
                <button type="submit" class="btn btn-danger btn-sm text-nowrap"><i class="fas fa-plus me-1"></i>Generate Key</button>
            </form>

            <div class="table-responsive">
                <table class="table table-sm align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Key</th>
                            <th>Last Used</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($keys as $key)
                            <tr>
                                <td class="fw-semibold">{{ $key->name }}</td>
                                <td><code>{{ $key->key_prefix }}…</code></td>
                                <td class="text-muted small">{{ $key->last_used_at?->diffForHumans() ?? 'Never' }}</td>
                                <td>
                                    <span class="badge {{ $key->status ? 'bg-success' : 'bg-secondary' }}">{{ $key->status ? 'Active' : 'Disabled' }}</span>
                                </td>
                                <td class="text-nowrap">
                                    <form action="{{ route('admin.api-access.toggle', $key) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-secondary" title="{{ $key->status ? 'Disable' : 'Enable' }}">
                                            <i class="fas {{ $key->status ? 'fa-pause' : 'fa-play' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.api-access.destroy', $key) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Delete this key? Anything using it will stop working immediately.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted py-3">No API keys yet. Generate one to start using the API.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="api-note mt-3">
                <i class="fas fa-shield-alt me-1"></i>
                Give each client/developer their own key, so you can disable one without affecting the others.
                Keys are stored encrypted (hashed) — if a key is lost, delete it and generate a new one.
            </div>
        </div>
    </div>

    {{-- ─── HOW TO USE ─── --}}
    <div class="col-lg-7">
        <div class="panel-card h-100">
            <h6 class="api-card-title"><i class="fas fa-book text-danger me-2"></i>How to use</h6>

            <p class="mb-1 small fw-semibold">Base URL</p>
            <div class="api-copy-row mb-3">
                <code class="api-code" id="apiBaseUrl">{{ $baseUrl }}</code>
                <button type="button" class="btn btn-sm btn-outline-dark api-copy-btn" data-copy="#apiBaseUrl"><i class="fas fa-copy"></i></button>
            </div>

            <p class="mb-1 small fw-semibold">Authentication — send the key in a header with every request</p>
            <pre class="api-pre">X-API-KEY: your_api_key_here</pre>

            <p class="mb-1 small fw-semibold">Example request</p>
            <pre class="api-pre">curl -H "X-API-KEY: your_api_key_here" \
     "{{ $baseUrl }}/admissions?per_page=10&amp;from=2026-09-01"</pre>

            <p class="mb-1 small fw-semibold">Example response (list)</p>
            <pre class="api-pre">{
  "data": [ { "id": 12, "candidate_name": "...", "submitted_at": "2026-09-24T10:15:00+00:00", ... } ],
  "links": { "first": "...", "last": "...", "prev": null, "next": "..." },
  "meta":  { "current_page": 1, "last_page": 3, "per_page": 10, "total": 27 }
}</pre>

            <ul class="api-rules small mb-0">
                <li>Only <strong>GET</strong> requests — create / edit / delete is not possible.</li>
                <li>Limit: <strong>60 requests per minute</strong> per IP.</li>
                <li>Dates (<code>submitted_at</code>) are in UTC — add 5:30 hours for Indian time.</li>
                <li>Errors come back as JSON: <code>401</code> wrong/missing key, <code>404</code> record not found, <code>422</code> invalid filter, <code>429</code> too many requests.</li>
                <li>Use the key from a server (backend), not from JavaScript in a public web page — anyone who can see the page could copy the key.</li>
            </ul>
        </div>
    </div>
</div>

{{-- ─── ENDPOINT LIST ─── --}}
<div class="panel-card mt-4">
    <h6 class="api-card-title"><i class="fas fa-list text-danger me-2"></i>API List</h6>

    @foreach($endpoints as $ep)
        <div class="api-ep">
            <div class="api-ep__title"><i class="{{ $ep['icon'] }} me-2"></i>{{ $ep['title'] }}</div>

            <div class="api-ep__route">
                <span class="api-method">GET</span>
                <code>{{ $baseUrl }}{{ $ep['list'] }}</code>
                <span class="text-muted small ms-2">— list (paginated, newest first)</span>
            </div>
            <div class="api-ep__route">
                <span class="api-method">GET</span>
                <code>{{ $baseUrl }}{{ $ep['single'] }}</code>
                <span class="text-muted small ms-2">— one record</span>
            </div>

            <div class="row g-3 mt-1">
                <div class="col-md-6">
                    <p class="small fw-semibold mb-1">Filters (optional, for the list)</p>
                    <table class="table table-sm api-params mb-0">
                        @foreach($ep['params'] as [$param, , $desc])
                            <tr><td><code>{{ $param }}</code></td><td class="small text-muted">{{ $desc }}</td></tr>
                        @endforeach
                    </table>
                </div>
                <div class="col-md-6">
                    <p class="small fw-semibold mb-1">Fields returned</p>
                    <p class="small text-muted api-fields mb-0">{{ collect($ep['fields'])->pluck(0)->implode(', ') }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('.api-copy-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var el = document.querySelector(btn.dataset.copy);
            if (!el || !navigator.clipboard) return;
            navigator.clipboard.writeText(el.textContent.trim()).then(function () {
                var old = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check"></i> Copied';
                setTimeout(function () { btn.innerHTML = old; }, 1500);
            });
        });
    });
</script>
@endsection
