{{-- Shared section fields (create + edit). Expects $section. --}}
<div class="mb-3">
    <label class="form-label fw-semibold">Section Title <span class="text-danger">*</span></label>
    <input type="text" name="title" class="form-control" maxlength="200" required
           value="{{ old('title', $section->title) }}" placeholder="e.g. National Awards">
    <div class="form-text">The last word is shown in red (e.g. "National <span class="text-danger">Awards</span>").</div>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Description</label>
    <textarea name="description" rows="3" class="form-control" maxlength="2000">{{ old('description', $section->description) }}</textarea>
</div>
<div class="row g-3 mb-3">
    <div class="col-sm-4">
        <label class="form-label fw-semibold">Order</label>
        <input type="number" name="sort_order" min="0" class="form-control"
               value="{{ old('sort_order', $section->sort_order) }}">
        <div class="form-text">Lower number shows first on the page.</div>
    </div>
    <div class="col-sm-8 d-flex align-items-center">
        <div class="form-check form-switch mt-sm-3">
            <input type="checkbox" name="status" value="1" id="sectionStatus" class="form-check-input"
                   {{ old('status', $section->status) ? 'checked' : '' }}>
            <label for="sectionStatus" class="form-check-label">Show this section on the website</label>
        </div>
    </div>
</div>
