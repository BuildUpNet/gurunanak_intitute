@extends('admin.layouts.admin')

@section('title', ($program ? 'Edit' : 'Add') . ' Program | Admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-program-details-form.css') }}">
@endsection

@section('content')
<div class="page-title mb-4">
    <h2>{{ $program ? 'Edit Program' : 'Add New Program' }}</h2>
    <p>{{ $program ? 'Update program page details, content and opportunities.' : 'Create a new dynamic program page.' }}</p>
</div>

@if($errors->any())
    <div class="alert alert-danger mb-4">
        <strong>Please fix the following errors:</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
    </div>
@endif

<form method="POST"
      action="{{ $program ? route('admin.program-details.update', $program) : route('admin.program-details.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($program) @method('PUT') @endif

    {{-- ─── BASIC INFO ─── --}}
    <div class="panel-card mb-4">
        <h6 class="fw-bold mb-4" style="color:#0b1f3a;border-bottom:1px solid #f1f5f9;padding-bottom:12px;">
            <i class="fas fa-info-circle text-danger me-2"></i>Basic Information
        </h6>
        <div class="row g-3">
            <div class="col-md-12">
                <label class="form-label fw-semibold">School <span class="text-danger">*</span></label>
                <select name="course_category_id" class="form-select" required>
                    <option value="">— Select School —</option>
                    @foreach($courseCategories as $school)
                        <option value="{{ $school->id }}"
                            {{ old('course_category_id', $program?->course_category_id) == $school->id ? 'selected' : '' }}>
                            {{ $school->title }}
                        </option>
                    @endforeach
                </select>
                <div class="form-text">The School (department) this course belongs to. Same School regardless of which Program level the course is offered at — see Program Levels below.</div>
            </div>
            <div class="col-md-8">
                <label class="form-label fw-semibold">Program Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title', $program?->title) }}"
                       placeholder="e.g. Master of Computer Applications">
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Short Name <span class="text-muted fw-normal">(optional)</span></label>
                <input type="text" name="short_name" class="form-control @error('short_name') is-invalid @enderror"
                       value="{{ old('short_name', $program?->short_name) }}"
                       placeholder="e.g. MCA" maxlength="20">
                @error('short_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">URL Slug <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text text-muted" style="font-size:.82rem;">/programs/</span>
                    <input type="text" name="slug" id="slugInput"
                           class="form-control @error('slug') is-invalid @enderror"
                           value="{{ old('slug', $program?->slug) }}"
                           placeholder="mca" pattern="[a-z0-9\-]+"
                           {{ $program ? '' : '' }}>
                </div>
                <div class="form-text">Lowercase letters, numbers and hyphens only.</div>
                @error('slug')<div class="text-danger" style="font-size:.82rem;">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Level <span class="text-danger">*</span></label>
                <input type="text" name="level" class="form-control @error('level') is-invalid @enderror"
                       value="{{ old('level', $program?->level) }}"
                       placeholder="e.g. Post Graduation Degree">
                <div class="form-text">General descriptor shown on the course page. Specific Program-Category + Duration combinations are set in "Program Levels" below.</div>
                @error('level')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Locations <span class="text-danger">*</span></label>
                <input type="text" name="locations" class="form-control @error('locations') is-invalid @enderror"
                       value="{{ old('locations', $program?->locations) }}"
                       placeholder="e.g. Patiala &amp; Karnal">
                @error('locations')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select">
                    <option value="1" {{ old('status', $program?->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $program?->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Sort Order</label>
                <input type="number" name="sort_order" class="form-control"
                       value="{{ old('sort_order', $program?->sort_order ?? 0) }}" min="0">
            </div>
        </div>
    </div>

    {{-- ─── IMAGES ─── --}}
    <div class="panel-card mb-4">
        <h6 class="fw-bold mb-4" style="color:#0b1f3a;border-bottom:1px solid #f1f5f9;padding-bottom:12px;">
            <i class="fas fa-image text-danger me-2"></i>Page Images
        </h6>
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Hero Background Image</label>
                @php $hasCustomHero = $program?->hero_image && $program->hero_image !== \App\Models\ProgramDetail::DEFAULT_HERO_IMAGE; @endphp
                <div class="mb-2">
                    <img src="{{ asset($program ? $program->heroImagePath() : \App\Models\ProgramDetail::DEFAULT_HERO_IMAGE) }}"
                         alt="Hero" class="pd-hero-preview">
                    <div class="form-text mt-1">
                        {{ $hasCustomHero ? 'Current custom image. Upload new to replace.' : 'Default hero image — used automatically when no image is uploaded.' }}
                    </div>
                    @if($hasCustomHero)
                        <div class="form-check mt-1">
                            <input class="form-check-input" type="checkbox" name="remove_hero_image" value="1" id="removeHeroImage">
                            <label class="form-check-label" for="removeHeroImage">Remove this image and use the default hero image</label>
                        </div>
                    @endif
                </div>
                <input type="file" name="hero_image" class="form-control @error('hero_image') is-invalid @enderror"
                       accept="image/*">
                <div class="form-text">Recommended: 1920×800px · JPG/PNG/WebP · Max 2 MB</div>
                @error('hero_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">CTA Section Background Image</label>
                @if($program?->cta_image)
                    <div class="mb-2">
                        <img src="{{ asset($program->cta_image) }}" alt="CTA"
                             style="width:100%;max-height:160px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0;">
                        <div class="form-text mt-1">Current image. Upload new to replace.</div>
                    </div>
                @endif
                <input type="file" name="cta_image" class="form-control @error('cta_image') is-invalid @enderror"
                       accept="image/*">
                <div class="form-text">Recommended: 1920×600px · JPG/PNG/WebP · Max 2 MB</div>
                @error('cta_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    {{-- ─── OVERVIEW CONTENT ─── --}}
    <div class="panel-card mb-4">
        <h6 class="fw-bold mb-4" style="color:#0b1f3a;border-bottom:1px solid #f1f5f9;padding-bottom:12px;">
            <i class="fas fa-align-left text-danger me-2"></i>Overview Content
        </h6>
        <div class="mb-3">
            <label class="form-label fw-semibold">Pull Quote</label>
            <input type="text" name="quote" class="form-control"
                   value="{{ old('quote', $program?->quote) }}"
                   placeholder="e.g. Turn Challenges Into Solutions Through Technology.">
            <div class="form-text">Short inspiring quote displayed prominently in the overview section.</div>
        </div>
        @foreach(['overview_1' => '1st', 'overview_2' => '2nd', 'overview_3' => '3rd', 'overview_4' => '4th'] as $field => $label)
            <div class="mb-3">
                <label class="form-label fw-semibold">Overview Paragraph — {{ $label }}</label>
                <textarea name="{{ $field }}" class="form-control" rows="4"
                          placeholder="Overview paragraph {{ $label }}...">{{ old($field, $program?->$field) }}</textarea>
            </div>
        @endforeach
    </div>

    {{-- ─── PROGRAM LEVELS ─── --}}
    <div class="panel-card mb-4">
        <div class="d-flex justify-content-between align-items-center mb-4"
             style="border-bottom:1px solid #f1f5f9;padding-bottom:12px;">
            <h6 class="fw-bold mb-0" style="color:#0b1f3a;">
                <i class="fas fa-layer-group text-danger me-2"></i>Program Levels
            </h6>
            <button type="button" id="addLevelBtn" class="btn btn-outline-danger btn-sm px-3">
                <i class="fas fa-plus me-1"></i> Add Level
            </button>
        </div>
        <div class="form-text mb-3">Which Program Categories (Undergraduate, Postgraduate, Diploma, etc.) this course is offered under, and the duration for each. This course's page and content stay the same across all levels — only the duration shown differs.</div>

        <div id="levelContainer">
            @php $levelRows = $program ? $program->levels : collect(); @endphp
            @if($levelRows->isNotEmpty())
                @foreach($levelRows as $idx => $lvl)
                    <div class="level-row row g-2 mb-2 align-items-center">
                        <div class="col-md-6">
                            <select name="levels[{{ $idx }}][program_category_id]" class="form-select form-select-sm">
                                <option value="">— Select Program Category —</option>
                                @foreach($programCategories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old("levels.$idx.program_category_id", $lvl->program_category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <input type="text" name="levels[{{ $idx }}][duration]"
                                   class="form-control form-control-sm"
                                   value="{{ old("levels.$idx.duration", $lvl->duration) }}"
                                   placeholder="e.g. 3 Year">
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-outline-danger btn-sm level-del-btn" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="level-row row g-2 mb-2 align-items-center">
                    <div class="col-md-6">
                        <select name="levels[0][program_category_id]" class="form-select form-select-sm">
                            <option value="">— Select Program Category —</option>
                            @foreach($programCategories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input type="text" name="levels[0][duration]" class="form-control form-control-sm" placeholder="e.g. 3 Year">
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-outline-danger btn-sm level-del-btn" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- ─── HERO BADGES (small chips under the title in the page hero) ─── --}}
    <div class="panel-card mb-4">
        <div class="d-flex justify-content-between align-items-center mb-4"
             style="border-bottom:1px solid #f1f5f9;padding-bottom:12px;">
            <h6 class="fw-bold mb-0" style="color:#0b1f3a;">
                <i class="fas fa-tags text-danger me-2"></i>Hero Badges
            </h6>
            <button type="button" id="addBadgeBtn" class="btn btn-outline-danger btn-sm px-3">
                <i class="fas fa-plus me-1"></i> Add Badge
            </button>
        </div>
        <div class="form-text mb-3">Small boxes shown under the program title in the page hero (e.g. "Recognized Program", "3 Year", "Patiala &amp; Karnal"). Add as many as you need — empty rows are ignored. Click the icon button to pick an icon.</div>

        <div id="badgeContainer">
            @php $badgeRows = $program ? $program->heroBadges : collect(); @endphp
            @forelse($badgeRows as $idx => $badge)
                <div class="badge-row row g-2 mb-2 align-items-center">
                    <div class="col-auto pd-icon-col">
                        <div class="icon-pick-wrap-sm icon-pick-wrap">
                            <input type="text" name="hero_badges[{{ $idx }}][icon]" class="icon-input"
                                   value="{{ old("hero_badges.$idx.icon", $badge->icon) }}" placeholder="fas fa-check-circle" readonly>
                            <button type="button" class="icon-pick-btn" title="Pick Icon"><i class="fas fa-icons"></i></button>
                        </div>
                    </div>
                    <div class="col">
                        <input type="text" name="hero_badges[{{ $idx }}][text]" class="form-control form-control-sm"
                               value="{{ old("hero_badges.$idx.text", $badge->text) }}" placeholder="e.g. 3 Year">
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-outline-danger btn-sm badge-del-btn" title="Remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            @empty
                <div class="badge-row row g-2 mb-2 align-items-center">
                    <div class="col-auto pd-icon-col">
                        <div class="icon-pick-wrap-sm icon-pick-wrap">
                            <input type="text" name="hero_badges[0][icon]" class="icon-input"
                                   value="fas fa-check-circle" placeholder="fas fa-check-circle" readonly>
                            <button type="button" class="icon-pick-btn" title="Pick Icon"><i class="fas fa-icons"></i></button>
                        </div>
                    </div>
                    <div class="col">
                        <input type="text" name="hero_badges[0][text]" class="form-control form-control-sm" placeholder="e.g. 3 Year">
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-outline-danger btn-sm badge-del-btn" title="Remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    {{-- ─── PROGRAM AT A GLANCE ─── --}}
    <div class="panel-card mb-4">
        <div class="d-flex justify-content-between align-items-center mb-4"
             style="border-bottom:1px solid #f1f5f9;padding-bottom:12px;">
            <h6 class="fw-bold mb-0" style="color:#0b1f3a;">
                <i class="fas fa-id-card text-danger me-2"></i>Program at a Glance
            </h6>
            <button type="button" id="addGlanceBtn" class="btn btn-outline-danger btn-sm px-3">
                <i class="fas fa-plus me-1"></i> Add Row
            </button>
        </div>
        <div class="form-text mb-3">Shown in the "Program at a Glance" card on the course page (Degree, Duration, Eligibility). Add one row for a normal course, or multiple rows if this course offers different Degree/Duration/Eligibility per year — each row is shown as its own group in the same card.</div>

        <div id="glanceContainer">
            @php $glanceRows = $program ? $program->glanceItems : collect(); @endphp
            @if($glanceRows->isNotEmpty())
                @foreach($glanceRows as $idx => $gi)
                    <div class="glance-row row g-2 mb-2 align-items-center">
                        <div class="col-md-4">
                            <input type="text" name="glance_items[{{ $idx }}][degree]"
                                   class="form-control form-control-sm"
                                   value="{{ old("glance_items.$idx.degree", $gi->degree) }}"
                                   placeholder="Degree, e.g. Physiotherapy">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="glance_items[{{ $idx }}][duration]"
                                   class="form-control form-control-sm"
                                   value="{{ old("glance_items.$idx.duration", $gi->duration) }}"
                                   placeholder="Duration, e.g. 3 Year">
                        </div>
                        <div class="col">
                            <input type="text" name="glance_items[{{ $idx }}][eligibility]"
                                   class="form-control form-control-sm"
                                   value="{{ old("glance_items.$idx.eligibility", $gi->eligibility) }}"
                                   placeholder="Eligibility, e.g. 10+2 with PCB">
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-outline-danger btn-sm glance-del-btn" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="glance-row row g-2 mb-2 align-items-center">
                    <div class="col-md-4">
                        <input type="text" name="glance_items[0][degree]" class="form-control form-control-sm" placeholder="Degree, e.g. Physiotherapy">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="glance_items[0][duration]" class="form-control form-control-sm" placeholder="Duration, e.g. 3 Year">
                    </div>
                    <div class="col">
                        <input type="text" name="glance_items[0][eligibility]" class="form-control form-control-sm" placeholder="Eligibility, e.g. 10+2 with PCB">
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-outline-danger btn-sm glance-del-btn" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- ─── ELIGIBILITY ─── --}}
    <div class="panel-card mb-4">
        <h6 class="fw-bold mb-4" style="color:#0b1f3a;border-bottom:1px solid #f1f5f9;padding-bottom:12px;">
            <i class="fas fa-user-graduate text-danger me-2"></i>Eligibility Criteria
        </h6>
        <textarea name="eligibility" class="form-control" rows="4"
                  placeholder="Describe the eligibility criteria for this program...">{{ old('eligibility', $program?->eligibility) }}</textarea>
        <div class="form-text">This text appears in the "Who Can Apply" section. You may include HTML like &lt;em&gt; for italics.</div>
    </div>

    {{-- ─── OPPORTUNITIES ─── --}}
    <div class="panel-card mb-4">
        <div class="d-flex justify-content-between align-items-center mb-4"
             style="border-bottom:1px solid #f1f5f9;padding-bottom:12px;">
            <h6 class="fw-bold mb-0" style="color:#0b1f3a;">
                <i class="fas fa-briefcase text-danger me-2"></i>Employment Opportunities
            </h6>
            <button type="button" id="addOppBtn" class="btn btn-outline-danger btn-sm px-3">
                <i class="fas fa-plus me-1"></i> Add Row
            </button>
        </div>
        <div class="form-text mb-3">Each opportunity appears as a card in the Career Pathways section. Click the icon button to pick an icon visually.</div>

        <div id="oppContainer">
            @if($program && $program->opportunities->isNotEmpty())
                @foreach($program->opportunities as $idx => $opp)
                    <div class="opp-row row g-2 mb-2 align-items-center">
                        <div class="col-auto" style="width:230px;">
                            <div class="icon-pick-wrap-sm icon-pick-wrap">
                                <input type="text" name="opportunities[{{ $idx }}][icon]"
                                       class="icon-input"
                                       value="{{ old("opportunities.$idx.icon", $opp->icon) }}"
                                       placeholder="fas fa-briefcase" readonly>
                                <button type="button" class="icon-pick-btn" title="Pick Icon">
                                    <i class="fas fa-icons"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col">
                            <input type="text" name="opportunities[{{ $idx }}][title]"
                                   class="form-control form-control-sm"
                                   value="{{ old("opportunities.$idx.title", $opp->title) }}"
                                   placeholder="Job role or industry title">
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-outline-danger btn-sm opp-del-btn" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="opp-row row g-2 mb-2 align-items-center">
                    <div class="col-auto" style="width:230px;">
                        <div class="icon-pick-wrap-sm icon-pick-wrap">
                            <input type="text" name="opportunities[0][icon]"
                                   class="icon-input"
                                   value="fas fa-briefcase" placeholder="fas fa-briefcase" readonly>
                            <button type="button" class="icon-pick-btn" title="Pick Icon">
                                <i class="fas fa-icons"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col">
                        <input type="text" name="opportunities[0][title]"
                               class="form-control form-control-sm" placeholder="Job role or industry title">
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-outline-danger btn-sm opp-del-btn" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- ─── CAREER ROLES ─── --}}
    <div class="panel-card mb-4">
        <h6 class="fw-bold mb-4" style="color:#0b1f3a;border-bottom:1px solid #f1f5f9;padding-bottom:12px;">
            <i class="fas fa-user-tie text-danger me-2"></i>Career Roles
        </h6>
        <div id="careerWrapper">
            @php $careerRows = $program && $program->careerRoles->isNotEmpty() ? $program->careerRoles->pluck('title') : collect(['']); @endphp
            @foreach($careerRows as $title)
                <div class="input-group mb-2">
                    <input type="text" name="career_roles[]" class="form-control" value="{{ $title }}" placeholder="e.g. Physiotherapist">
                    <button type="button" class="btn btn-outline-danger btn-sm addCareer">+</button>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ─── GRADUATES WORK ─── --}}
    <div class="panel-card mb-4">
        <h6 class="fw-bold mb-4" style="color:#0b1f3a;border-bottom:1px solid #f1f5f9;padding-bottom:12px;">
            <i class="fas fa-building text-danger me-2"></i>Where Our Graduates Work
        </h6>
        <div id="graduateWrapper">
            @php $graduateRows = $program && $program->graduatesWork->isNotEmpty() ? $program->graduatesWork->pluck('title') : collect(['']); @endphp
            @foreach($graduateRows as $title)
                <div class="input-group mb-2">
                    <input type="text" name="graduates_work[]" class="form-control" value="{{ $title }}" placeholder="e.g. Apollo Hospital">
                    <button type="button" class="btn btn-outline-danger btn-sm addGraduate">+</button>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ─── FAQS ─── --}}
    <div class="panel-card mb-4">
        <h6 class="fw-bold mb-4" style="color:#0b1f3a;border-bottom:1px solid #f1f5f9;padding-bottom:12px;">
            <i class="fas fa-question-circle text-danger me-2"></i>Course FAQs
        </h6>
        <div id="faqWrapper">
            @php $faqRows = $program ? $program->faqs : collect(); @endphp
            @if($faqRows->isNotEmpty())
                @foreach($faqRows as $idx => $faq)
                    <div class="faq-box mb-3 p-3" style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:12px;">
                        <input type="text" name="faqs[{{ $idx }}][question]" class="form-control mb-2" value="{{ $faq->question }}" placeholder="Question">
                        <textarea name="faqs[{{ $idx }}][answer]" class="form-control" rows="3" placeholder="Answer">{{ $faq->answer }}</textarea>
                    </div>
                @endforeach
            @else
                <div class="faq-box mb-3 p-3" style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:12px;">
                    <input type="text" name="faqs[0][question]" class="form-control mb-2" placeholder="Question">
                    <textarea name="faqs[0][answer]" class="form-control" rows="3" placeholder="Answer"></textarea>
                </div>
            @endif
        </div>
        <button type="button" id="addFaq" class="btn btn-outline-danger btn-sm px-3">
            <i class="fas fa-plus me-1"></i> Add FAQ
        </button>
    </div>

    {{-- ─── SUBMIT ─── --}}
    <div class="d-flex gap-3">
        <button type="submit" class="btn btn-danger px-5 py-2 fw-bold">
            <i class="fas fa-save me-2"></i>{{ $program ? 'Update Program' : 'Create Program' }}
        </button>
        <a href="{{ route('admin.program-details.index') }}" class="btn btn-outline-secondary px-4 py-2">
            Cancel
        </a>
    </div>
</form>
@endsection

@section('scripts')
<script>
(function() {
    var counter = {{ $program ? $program->opportunities->count() : 1 }};

    document.getElementById('addOppBtn').addEventListener('click', function() {
        var container = document.getElementById('oppContainer');
        var row = document.createElement('div');
        row.className = 'opp-row row g-2 mb-2 align-items-center';
        row.innerHTML =
            '<div class="col-auto" style="width:230px;">' +
                '<div class="icon-pick-wrap-sm icon-pick-wrap">' +
                    '<input type="text" name="opportunities[' + counter + '][icon]" ' +
                    'class="icon-input" value="fas fa-briefcase" placeholder="fas fa-briefcase" readonly>' +
                    '<button type="button" class="icon-pick-btn" title="Pick Icon">' +
                    '<i class="fas fa-icons"></i></button>' +
                '</div>' +
            '</div>' +
            '<div class="col">' +
                '<input type="text" name="opportunities[' + counter + '][title]" ' +
                'class="form-control form-control-sm" placeholder="Job role or industry title">' +
            '</div>' +
            '<div class="col-auto">' +
                '<button type="button" class="btn btn-outline-danger btn-sm opp-del-btn" title="Remove">' +
                '<i class="fas fa-times"></i></button>' +
            '</div>';
        container.appendChild(row);
        counter++;
    });

    document.getElementById('oppContainer').addEventListener('click', function(e) {
        var btn = e.target.closest('.opp-del-btn');
        if (btn) btn.closest('.opp-row').remove();
    });

    // ─── Program Levels repeater ───
    var levelCounter = {{ $levelRows->count() ?: 1 }};
    @php
        $categoryOptionsHtml = '<option value="">— Select Program Category —</option>';
        foreach ($programCategories as $cat) {
            $categoryOptionsHtml .= '<option value="' . $cat->id . '">' . e($cat->title) . '</option>';
        }
    @endphp
    var programCategoryOptions = {!! json_encode($categoryOptionsHtml) !!};

    document.getElementById('addLevelBtn').addEventListener('click', function() {
        var container = document.getElementById('levelContainer');
        var row = document.createElement('div');
        row.className = 'level-row row g-2 mb-2 align-items-center';
        row.innerHTML =
            '<div class="col-md-6">' +
                '<select name="levels[' + levelCounter + '][program_category_id]" class="form-select form-select-sm">' +
                programCategoryOptions +
                '</select>' +
            '</div>' +
            '<div class="col">' +
                '<input type="text" name="levels[' + levelCounter + '][duration]" ' +
                'class="form-control form-control-sm" placeholder="e.g. 3 Year">' +
            '</div>' +
            '<div class="col-auto">' +
                '<button type="button" class="btn btn-outline-danger btn-sm level-del-btn" title="Remove">' +
                '<i class="fas fa-times"></i></button>' +
            '</div>';
        container.appendChild(row);
        levelCounter++;
    });

    document.getElementById('levelContainer').addEventListener('click', function(e) {
        var btn = e.target.closest('.level-del-btn');
        if (btn) btn.closest('.level-row').remove();
    });

    // ─── Hero Badges repeater ───
    var badgeCounter = {{ $badgeRows->count() ?: 1 }};

    document.getElementById('addBadgeBtn').addEventListener('click', function() {
        var row = document.createElement('div');
        row.className = 'badge-row row g-2 mb-2 align-items-center';
        row.innerHTML =
            '<div class="col-auto pd-icon-col">' +
                '<div class="icon-pick-wrap-sm icon-pick-wrap">' +
                    '<input type="text" name="hero_badges[' + badgeCounter + '][icon]" ' +
                    'class="icon-input" value="fas fa-check-circle" placeholder="fas fa-check-circle" readonly>' +
                    '<button type="button" class="icon-pick-btn" title="Pick Icon"><i class="fas fa-icons"></i></button>' +
                '</div>' +
            '</div>' +
            '<div class="col">' +
                '<input type="text" name="hero_badges[' + badgeCounter + '][text]" ' +
                'class="form-control form-control-sm" placeholder="e.g. 3 Year">' +
            '</div>' +
            '<div class="col-auto">' +
                '<button type="button" class="btn btn-outline-danger btn-sm badge-del-btn" title="Remove">' +
                '<i class="fas fa-times"></i></button>' +
            '</div>';
        document.getElementById('badgeContainer').appendChild(row);
        badgeCounter++;
    });

    document.getElementById('badgeContainer').addEventListener('click', function(e) {
        var btn = e.target.closest('.badge-del-btn');
        if (btn) btn.closest('.badge-row').remove();
    });

    // ─── Program at a Glance repeater ───
    var glanceCounter = {{ $glanceRows->count() ?: 1 }};

    document.getElementById('addGlanceBtn').addEventListener('click', function() {
        var container = document.getElementById('glanceContainer');
        var row = document.createElement('div');
        row.className = 'glance-row row g-2 mb-2 align-items-center';
        row.innerHTML =
            '<div class="col-md-4">' +
                '<input type="text" name="glance_items[' + glanceCounter + '][degree]" ' +
                'class="form-control form-control-sm" placeholder="Degree, e.g. Physiotherapy">' +
            '</div>' +
            '<div class="col-md-3">' +
                '<input type="text" name="glance_items[' + glanceCounter + '][duration]" ' +
                'class="form-control form-control-sm" placeholder="Duration, e.g. 3 Year">' +
            '</div>' +
            '<div class="col">' +
                '<input type="text" name="glance_items[' + glanceCounter + '][eligibility]" ' +
                'class="form-control form-control-sm" placeholder="Eligibility, e.g. 10+2 with PCB">' +
            '</div>' +
            '<div class="col-auto">' +
                '<button type="button" class="btn btn-outline-danger btn-sm glance-del-btn" title="Remove">' +
                '<i class="fas fa-times"></i></button>' +
            '</div>';
        container.appendChild(row);
        glanceCounter++;
    });

    document.getElementById('glanceContainer').addEventListener('click', function(e) {
        var btn = e.target.closest('.glance-del-btn');
        if (btn) btn.closest('.glance-row').remove();
    });

    // ─── Career Roles / Graduates Work repeaters ───
    document.getElementById('careerWrapper').addEventListener('click', function(e) {
        if (!e.target.classList.contains('addCareer')) return;
        document.getElementById('careerWrapper').insertAdjacentHTML('beforeend',
            '<div class="input-group mb-2">' +
                '<input type="text" name="career_roles[]" class="form-control" placeholder="e.g. Physiotherapist">' +
                '<button type="button" class="btn btn-outline-danger btn-sm removeItem">X</button>' +
            '</div>');
    });

    document.getElementById('graduateWrapper').addEventListener('click', function(e) {
        if (!e.target.classList.contains('addGraduate')) return;
        document.getElementById('graduateWrapper').insertAdjacentHTML('beforeend',
            '<div class="input-group mb-2">' +
                '<input type="text" name="graduates_work[]" class="form-control" placeholder="e.g. Apollo Hospital">' +
                '<button type="button" class="btn btn-outline-danger btn-sm removeItem">X</button>' +
            '</div>');
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('removeItem')) {
            e.target.closest('.input-group').remove();
        }
    });

    // ─── FAQs repeater ───
    var faqIndex = {{ $faqRows->count() ?: 1 }};
    document.getElementById('addFaq').addEventListener('click', function() {
        document.getElementById('faqWrapper').insertAdjacentHTML('beforeend',
            '<div class="faq-box mb-3 p-3" style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:12px;">' +
                '<input type="text" name="faqs[' + faqIndex + '][question]" class="form-control mb-2" placeholder="Question">' +
                '<textarea name="faqs[' + faqIndex + '][answer]" class="form-control" rows="3" placeholder="Answer"></textarea>' +
            '</div>');
        faqIndex++;
    });

    // Auto-generate slug from title on create
    @if(!$program)
    var titleInput = document.querySelector('input[name="title"]');
    var slugInput  = document.getElementById('slugInput');
    var slugDirty  = false;
    slugInput.addEventListener('input', function() { slugDirty = true; });
    titleInput.addEventListener('input', function() {
        if (slugDirty) return;
        slugInput.value = titleInput.value
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    });
    @endif
})();
</script>
@endsection
