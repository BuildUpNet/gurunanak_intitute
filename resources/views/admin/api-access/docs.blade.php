@extends('admin.layouts.admin')

@section('title', 'API Documentation')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-api-access.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/admin-api-docs.css') }}">
@endsection

@section('content')
@php
    $sampleKey = 'gnimt_YOUR_API_KEY';
    $firstList = $baseUrl . $endpoints[0]['list'];
@endphp

<div class="page-title mb-4 apidoc-noprint">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h2>API Documentation</h2>
            <p>Complete guide for developers — how to connect to the GNIMT form-submission API.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.api-access.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to API Access
            </a>
            <button type="button" class="btn btn-primary" id="apidocPrint">
                <i class="fas fa-print me-1"></i> Print / Save as PDF
            </button>
        </div>
    </div>
</div>

<div class="apidoc">

    {{-- ─── Table of contents ─── --}}
    <nav class="apidoc-toc apidoc-noprint" aria-label="Contents">
        <div class="apidoc-toc__title">Contents</div>
        <a href="#overview">1. Overview</a>
        <a href="#quick-start">2. Quick start</a>
        <a href="#api-key">3. Getting an API key</a>
        <a href="#auth">4. Authentication</a>
        <a href="#endpoints">5. All endpoints</a>
        @foreach($endpoints as $i => $ep)
            <a href="#ep-{{ $ep['key'] }}" class="apidoc-toc__sub">5.{{ $i + 1 }} {{ $ep['title'] }}</a>
        @endforeach
        <a href="#pagination">6. Pagination</a>
        <a href="#examples">7. Code examples</a>
        <a href="#postman">8. Testing with Postman</a>
        <a href="#errors">9. Errors</a>
        <a href="#rules">10. Limits &amp; security</a>
        <a href="#faq">11. FAQ / Troubleshooting</a>
    </nav>

    <div class="apidoc-body">

        <div class="apidoc-printhead">
            <h1>GNIMT Form Submissions API — Developer Guide</h1>
            <p>Guru Nanak Institute of Medical Technology · Version 1 · Generated {{ now()->format('d M Y') }}</p>
        </div>

        {{-- 1 --}}
        <section id="overview" class="apidoc-sec">
            <h3>1. Overview</h3>
            <p>This API lets an authorised developer or client portal <strong>read</strong> the forms submitted on the GNIMT website:</p>
            <ul>
                @foreach($endpoints as $ep)
                    <li><strong>{{ $ep['title'] }}</strong> — {{ $ep['about'] }}</li>
                @endforeach
            </ul>
            <div class="apidoc-callout apidoc-callout--info">
                <i class="fas fa-lock me-2"></i>The API is <strong>read-only</strong>. Only <code>GET</code> requests work — nothing can be created, edited or deleted through it.
                All responses are <strong>JSON</strong>.
            </div>
        </section>

        {{-- 2 --}}
        <section id="quick-start" class="apidoc-sec">
            <h3>2. Quick start (3 steps)</h3>
            <ol class="apidoc-steps">
                <li><strong>Get an API key</strong> from the GNIMT admin (see section 3).</li>
                <li><strong>Send a GET request</strong> to an endpoint with the key in the <code>X-API-KEY</code> header.</li>
                <li><strong>Read the JSON</strong> — records are in <code>data</code>, page info is in <code>meta</code>.</li>
            </ol>
            <pre class="api-pre">curl -H "X-API-KEY: {{ $sampleKey }}" "{{ $firstList }}"</pre>
        </section>

        {{-- 3 --}}
        <section id="api-key" class="apidoc-sec">
            <h3>3. Getting an API key (done by the GNIMT admin)</h3>
            <ol class="apidoc-steps">
                <li>Log in to the admin panel and open <strong>API Access</strong> from the left menu.</li>
                <li>In the <strong>API Keys</strong> box, type a name for who will use the key (e.g. <em>Client Portal</em>) and click <strong>Generate Key</strong>.</li>
                <li>The full key appears <strong>once</strong> in a yellow box — click <strong>Copy</strong> and send it to the developer securely.</li>
                <li>To stop access later, click <i class="fas fa-pause"></i> (disable) or <i class="fas fa-trash"></i> (delete) next to that key. It stops working immediately.</li>
            </ol>
            <div class="apidoc-callout apidoc-callout--warn">
                <i class="fas fa-exclamation-triangle me-2"></i>The key cannot be viewed again after the page is refreshed — only a hash is stored.
                If a key is lost, delete it and generate a new one. Give every developer / system its own key.
            </div>
        </section>

        {{-- 4 --}}
        <section id="auth" class="apidoc-sec">
            <h3>4. Authentication</h3>
            <p>Send the key with <strong>every</strong> request, in either of these headers:</p>
            <pre class="api-pre">X-API-KEY: {{ $sampleKey }}</pre>
            <p class="mb-1">or</p>
            <pre class="api-pre">Authorization: Bearer {{ $sampleKey }}</pre>
            <p>A missing, wrong or disabled key returns <code>401</code>:</p>
            <pre class="api-pre">{ "success": false, "message": "Invalid or missing API key. Send it in the X-API-KEY header." }</pre>
        </section>

        {{-- 5 --}}
        <section id="endpoints" class="apidoc-sec">
            <h3>5. All endpoints</h3>
            <p>Base URL: <code>{{ $baseUrl }}</code></p>
            <table class="table table-sm table-bordered apidoc-table">
                <thead><tr><th>Form</th><th>Method</th><th>URL</th><th>Returns</th></tr></thead>
                <tbody>
                    @foreach($endpoints as $ep)
                        <tr>
                            <td rowspan="2" class="fw-semibold">{{ $ep['title'] }}</td>
                            <td><span class="api-method">GET</span></td>
                            <td><code>{{ $ep['list'] }}</code></td>
                            <td>List (paginated, newest first)</td>
                        </tr>
                        <tr>
                            <td><span class="api-method">GET</span></td>
                            <td><code>{{ $ep['single'] }}</code></td>
                            <td>One record by ID</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @foreach($endpoints as $i => $ep)
                <div id="ep-{{ $ep['key'] }}" class="apidoc-ep">
                    <h4><i class="{{ $ep['icon'] }} me-2"></i>5.{{ $i + 1 }} {{ $ep['title'] }}</h4>
                    <p class="text-muted">{{ $ep['about'] }}</p>

                    <div class="api-ep__route"><span class="api-method">GET</span><code>{{ $baseUrl }}{{ $ep['list'] }}</code></div>
                    <div class="api-ep__route mb-3"><span class="api-method">GET</span><code>{{ $baseUrl }}{{ $ep['single'] }}</code></div>

                    <h5>Filters (query parameters for the list — all optional)</h5>
                    <table class="table table-sm table-bordered apidoc-table">
                        <thead><tr><th>Parameter</th><th>Type</th><th>Description</th><th>Example</th></tr></thead>
                        <tbody>
                            @foreach($ep['params'] as [$param, $type, $desc, $example])
                                <tr><td><code>{{ $param }}</code></td><td>{{ $type }}</td><td>{{ $desc }}</td><td><code>{{ $example }}</code></td></tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="small text-muted">Filters can be combined, e.g. <code>{{ $ep['list'] }}?from=2026-09-01&amp;to=2026-09-30&amp;per_page=100</code></p>

                    <h5>Fields in each record</h5>
                    <table class="table table-sm table-bordered apidoc-table">
                        <thead><tr><th>Field</th><th>Type</th><th>Description</th></tr></thead>
                        <tbody>
                            @foreach($ep['fields'] as [$field, $type, $desc])
                                <tr><td><code>{{ $field }}</code></td><td>{{ $type }}</td><td>{{ $desc }}</td></tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h5>Example — list response</h5>
                    <pre class="api-pre">{{ json_encode([
                        'data'  => [$ep['sample']],
                        'links' => ['first' => $baseUrl . $ep['list'] . '?page=1', 'last' => $baseUrl . $ep['list'] . '?page=3', 'prev' => null, 'next' => $baseUrl . $ep['list'] . '?page=2'],
                        'meta'  => ['current_page' => 1, 'from' => 1, 'last_page' => 3, 'per_page' => 20, 'to' => 20, 'total' => 57],
                    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) }}</pre>

                    <h5>Example — single record (<code>{{ str_replace('{id}', $ep['sample']['id'], $ep['single']) }}</code>)</h5>
                    <pre class="api-pre">{{ json_encode(['data' => $ep['sample']], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) }}</pre>
                </div>
            @endforeach
        </section>

        {{-- 6 --}}
        <section id="pagination" class="apidoc-sec">
            <h3>6. Pagination</h3>
            <p>List endpoints return records in pages (newest first). Default is 20 per page, maximum 100.</p>
            <ul>
                <li><code>meta.total</code> — total records matching your filters.</li>
                <li><code>meta.current_page</code> / <code>meta.last_page</code> — where you are.</li>
                <li><code>links.next</code> — full URL of the next page (<code>null</code> on the last page). Keep requesting it until it is <code>null</code> to fetch everything.</li>
            </ul>
            <p><strong>Tip — fetch only new records:</strong> save the date of your last sync and call with <code>?from=YYYY-MM-DD</code>.</p>
        </section>

        {{-- 7 --}}
        <section id="examples" class="apidoc-sec">
            <h3>7. Code examples</h3>

            <h5>cURL (command line)</h5>
            <pre class="api-pre">curl -H "X-API-KEY: {{ $sampleKey }}" \
     "{{ $firstList }}?per_page=50&amp;from=2026-09-01"</pre>

            <h5>PHP</h5>
            <pre class="api-pre">&lt;?php
$apiKey = '{{ $sampleKey }}';
$url    = '{{ $firstList }}?per_page=50';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['X-API-KEY: ' . $apiKey, 'Accept: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$status   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($status === 200) {
    $result = json_decode($response, true);
    foreach ($result['data'] as $row) {
        echo $row['id'] . ' - ' . $row['candidate_name'] . PHP_EOL;
    }
} else {
    echo 'Error ' . $status . ': ' . $response;
}</pre>

            <h5>Laravel (HTTP client)</h5>
            <pre class="api-pre">$result = Http::withHeaders(['X-API-KEY' => '{{ $sampleKey }}'])
    ->get('{{ $firstList }}', ['per_page' => 50])
    ->throw()
    ->json();

$records = $result['data'];</pre>

            <h5>JavaScript (Node.js 18+ / server side)</h5>
            <pre class="api-pre">const res = await fetch('{{ $firstList }}?per_page=50', {
  headers: { 'X-API-KEY': process.env.GNIMT_API_KEY }
});
if (!res.ok) throw new Error('API error ' + res.status);
const { data, meta } = await res.json();
console.log(`Got ${data.length} of ${meta.total} records`);</pre>

            <h5>Python</h5>
            <pre class="api-pre">import requests

r = requests.get(
    "{{ $firstList }}",
    headers={"X-API-KEY": "{{ $sampleKey }}"},
    params={"per_page": 50},
)
r.raise_for_status()
for row in r.json()["data"]:
    print(row["id"], row["candidate_name"])</pre>

            <h5>Fetch ALL pages (PHP)</h5>
            <pre class="api-pre">$url = '{{ $firstList }}?per_page=100';
$all = [];
while ($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['X-API-KEY: {{ $sampleKey }}']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $page = json_decode(curl_exec($ch), true);
    curl_close($ch);

    $all = array_merge($all, $page['data']);
    $url = $page['links']['next'];   // null on the last page
}</pre>
        </section>

        {{-- 8 --}}
        <section id="postman" class="apidoc-sec">
            <h3>8. Testing with Postman (no coding)</h3>
            <p class="small text-muted">Opening the URL directly in a browser will show a 401 error, because a browser address bar cannot send the key header. Use Postman (free) instead:</p>
            <ol class="apidoc-steps">
                <li>Download and open <strong>Postman</strong> (postman.com) and click <strong>New → HTTP Request</strong>.</li>
                <li>Keep the method as <strong>GET</strong> and paste the URL, e.g. <code>{{ $firstList }}</code></li>
                <li>Open the <strong>Headers</strong> tab. Key: <code>X-API-KEY</code>, Value: your API key.</li>
                <li>Optional: add filters in the <strong>Params</strong> tab (e.g. <code>per_page</code> = <code>10</code>).</li>
                <li>Click <strong>Send</strong>. The records appear below as JSON.</li>
            </ol>
        </section>

        {{-- 9 --}}
        <section id="errors" class="apidoc-sec">
            <h3>9. Errors</h3>
            <p>Errors are always JSON with an HTTP status code:</p>
            <table class="table table-sm table-bordered apidoc-table">
                <thead><tr><th>Status</th><th>Meaning</th><th>What to do</th></tr></thead>
                <tbody>
                    <tr><td><code>200</code></td><td>Success</td><td>—</td></tr>
                    <tr><td><code>401</code></td><td>API key missing, wrong or disabled</td><td>Check the <code>X-API-KEY</code> header; ask the admin whether the key is active.</td></tr>
                    <tr><td><code>404</code></td><td>Record ID or URL does not exist</td><td>Check the ID / endpoint spelling.</td></tr>
                    <tr><td><code>405</code></td><td>Method not allowed (POST, PUT, DELETE ...)</td><td>Use GET only — the API is read-only.</td></tr>
                    <tr><td><code>422</code></td><td>Invalid filter value</td><td>Read <code>errors</code> in the response, e.g. dates must be <code>YYYY-MM-DD</code>.</td></tr>
                    <tr><td><code>429</code></td><td>Too many requests</td><td>Wait a minute and retry (limit: 60 per minute).</td></tr>
                    <tr><td><code>500</code></td><td>Server error</td><td>Retry later; contact the GNIMT website team if it continues.</td></tr>
                </tbody>
            </table>
            <p class="mb-1">Example <code>422</code>:</p>
            <pre class="api-pre">{ "message": "The from field must match the format Y-m-d.", "errors": { "from": ["The from field must match the format Y-m-d."] } }</pre>
        </section>

        {{-- 10 --}}
        <section id="rules" class="apidoc-sec">
            <h3>10. Limits &amp; security</h3>
            <ul>
                <li><strong>Rate limit:</strong> 60 requests per minute per IP address.</li>
                <li><strong>Dates/times</strong> (<code>submitted_at</code>) are in <strong>UTC</strong> — add 5 hours 30 minutes for Indian time (IST).</li>
                <li><strong>Keep the key secret.</strong> Call the API from your server (backend). Never put the key in JavaScript of a public web page or mobile app — anyone could copy it.</li>
                <li>The data contains personal information (phone, email, address, Aadhaar). Store it securely and use it only for GNIMT admission work.</li>
                <li>If a key is leaked, tell the GNIMT admin immediately so it can be disabled.</li>
            </ul>
        </section>

        {{-- 11 --}}
        <section id="faq" class="apidoc-sec">
            <h3>11. FAQ / Troubleshooting</h3>
            <dl class="apidoc-faq">
                <dt>I get 401 even though I have a key.</dt>
                <dd>Make sure the header name is exactly <code>X-API-KEY</code>, there are no spaces before/after the key, and the key is <em>Active</em> in Admin → API Access. A key created on a local/test site does not work on the live site.</dd>

                <dt>Opening the URL in Chrome shows an error.</dt>
                <dd>Normal — a browser cannot send the key header. Use Postman, cURL or code.</dd>

                <dt>Can I add or update a submission through the API?</dt>
                <dd>No. The API is read-only by design.</dd>

                <dt>How do I get only today's submissions?</dt>
                <dd>Use <code>?from={{ now()->format('Y-m-d') }}&amp;to={{ now()->format('Y-m-d') }}</code> (UTC dates).</dd>

                <dt>How many records can I get in one call?</dt>
                <dd>Up to 100 with <code>per_page=100</code>. Follow <code>links.next</code> for more.</dd>
            </dl>
        </section>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('apidocPrint').addEventListener('click', function () { window.print(); });
</script>
@endsection
