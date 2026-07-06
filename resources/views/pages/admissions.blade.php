@extends('layouts.app')

@section('title', 'Admissions 2025-26 | GNIMT')
@section('meta_description', 'Apply now for B.Voc and Diploma courses at GNIMT. Check eligibility criteria, admission
    process, and fee structure for the 2025-26 academic session.')

@section('content')

    <section class="page-hero" aria-label="Admissions">
        <div class="container-fluid px-4 px-lg-5">
            <div class="gold-line"></div>
            <h1>Admissions 2025-26</h1>
            <p>Your journey towards a successful healthcare career starts here.</p>
        </div>
    </section>

    <nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
        <div class="container-fluid px-4 px-lg-5">
            <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
            <span class="current">Admissions</span>
        </div>
    </nav>

    <section class="section-py" id="how-to-apply">
        <div class="container-fluid px-4 px-lg-5">
            <div class="text-center mb-5">
                <div class="gold-line mx-auto"></div>
                <h2 class="section-title">Admission Process</h2>
                <p class="section-subtitle mx-auto mt-2">A simple, transparent, and hassle-free 4-step process to secure
                    your seat.</p>
            </div>

            <div class="row g-4 justify-content-center">
                @foreach ([['1', 'Submit Enquiry', 'Fill out our online application or quick enquiry form with your basic details and course preference.', 'fas fa-laptop'], ['2', 'Counselling Session', 'Our admission counsellors will call you to discuss your career goals and guide you to the right course.', 'fas fa-headset'], ['3', 'Document Verification', 'Submit your 10th/12th marksheets, ID proof, and passport size photographs at our campus or online.', 'fas fa-file-alt'], ['4', 'Fee Payment & Confirmation', 'Pay the initial admission fee to confirm your seat. Welcome to the GNIMT family!', 'fas fa-check-circle']] as [$step, $title, $desc, $icon])
                    <div class="col-md-6 col-lg-3">
                        <div class="stat-card h-100 position-relative">
                            <div class="position-absolute top-0 start-50 translate-middle badge bg-gold rounded-circle p-2"
                                style="background: var(--gold); width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; font-weight: bold; border: 3px solid #fff;">
                                {{ $step }}</div>
                            <div class="stat-icon mt-3"><i class="{{ $icon }}"></i></div>
                            <h3 class="fs-5 fw-bold text-navy mb-2">{{ $title }}</h3>
                            <p class="text-muted small">{{ $desc }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-py" style="background:var(--light);" id="eligibility">
        <div class="container-fluid px-4 px-lg-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="gold-line"></div>
                    <h2 class="section-title">Eligibility & Documents</h2>
                    <p class="mt-3 text-muted" style="line-height: 1.8;">
                        We welcome dedicated students who are passionate about healthcare. Most of our B.Voc programs
                        require a science background, but we also offer management courses for other streams.
                    </p>

                    <h4 class="fs-5 fw-bold text-navy mt-4 mb-3"><i class="fas fa-folder-open text-gold me-2"
                            style="color:var(--gold)"></i> Required Documents</h4>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> 10th & 12th Marksheets (Original &
                            Photocopy)</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Aadhaar Card or Valid ID Proof
                        </li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Migration / Transfer Certificate
                        </li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> 4 Passport Size Recent Photographs
                        </li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Category Certificate (if
                            applicable)</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm border-top border-4"
                        style="border-color: var(--gold) !important;">
                        <h3 class="fs-4 fw-bold text-navy mb-4 text-center">Quick Application</h3>
                        @if (session('success'))
                            <div class="alert alert-success mb-4">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger mb-4">{{ session('error') }}</div>
                        @endif
                        <form action="{{ route('enquiry.store') }}" method="POST">
                            @csrf
                            @include('partials.honeypot')
                            <div class="mb-3">
                                <input type="text" name="name" class="form-control px-3 py-2"
                                    placeholder="Full Name *" required>
                            </div>
                            <div class="mb-3">
                                <input type="tel" name="phone" class="form-control px-3 py-2"
                                    placeholder="Phone Number *" required>
                            </div>
                            <div class="mb-3">
                                <select name="course_category_id" id="adm_course_category_id" class="form-select px-3 py-2">
                                    <option value="">Select Department</option>
                                    @foreach ($courseCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <select name="course_id" id="adm_course_id" class="form-select px-3 py-2" required>
                                    <option value="">Select Course *</option>
                                </select>
                            </div>
                            <div class="g-recaptcha mb-3" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
                            <button type="submit" class="btn-primary-gnimt w-100 py-3 mt-2">Submit Application <i
                                    class="fas fa-arrow-right ms-2"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.faq', [
        'title' => 'Admissions — Frequently Asked Questions',
        'subtitle' => 'Everything you need to know before applying to GNIMT for session 2025-26.',
        'faqs' => $globalFaqs,
    ])

@endsection

@section('scripts')
    <script>
        const admCoursesByCategory = @json($courseCategories->mapWithKeys(function ($cat) {
            return [$cat->id => $cat->courses->map(fn($c) => ['id' => $c->id, 'title' => $c->title])];
        }));
        const admAllCourses = Object.values(admCoursesByCategory).flat();
        function admRenderCourses(list) {
            const sel = document.getElementById('adm_course_id');
            sel.innerHTML = '<option value="">Select Course *</option>';
            list.forEach(c => {
                sel.innerHTML += `<option value="${c.id}">${c.title}</option>`;
            });
        }
        admRenderCourses(admAllCourses);
        document.getElementById('adm_course_category_id').addEventListener('change', function () {
            admRenderCourses(this.value ? (admCoursesByCategory[this.value] || []) : admAllCourses);
        });
    </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection
