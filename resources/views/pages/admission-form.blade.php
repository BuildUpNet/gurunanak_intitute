@extends('layouts.app')

@section('title', 'Admission Form 2025-26 | GNIMT')
@section('meta_description',
    'Apply online for admission at Guru Nanak Institute of Medical Technology, Patiala. Fill
    and submit the official admission form.')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/admission-form.css') }}">
@endsection

@section('content')

    <section class="page-hero" aria-label="Admission Form">
        <div class="container-fluid px-4 px-lg-5">
            <div class="gold-line"></div>
            <h1>Admission Form 2025-26</h1>
            <p>Fill in all details carefully as per your class 10<sup>th</sup> certificate.</p>
        </div>
    </section>

    <nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
        <div class="container-fluid px-4 px-lg-5">
            <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
            <a href="{{ route('admissions') }}">Admissions</a><span class="sep">/</span>
            <span class="current">Admission Form</span>
        </div>
    </nav>

    <div class="af-wrapper">
        <div class="af-container">

            {{-- Success message --}}
            @if (session('success'))
                <div class="af-success">
                    <i class="fas fa-check-circle"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            {{-- Error message --}}
            @if (session('error'))
                <div class="af-error-banner">
                    <i class="fas fa-triangle-exclamation"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            <div class="af-sheet">
                <div class="af-sheet-header">
                    <h2>Admission Form</h2>
                    <p>Guru Nanak Institute of Medical Technology &mdash; Patiala &amp; Karnal</p>
                </div>

                <div class="af-body">
                    <p class="af-req-note">Fields marked with <span>*</span> are required.</p>

                    <form method="POST" action="{{ route('admissions.form.store') }}" novalidate>
                        @csrf
                        @include('partials.honeypot')

                        {{-- ── BASIC INFORMATION ── --}}
                        <div class="af-section"><i class="fas fa-user-circle"></i> Basic Information</div>

                        <div class="af-row">
                            <div class="af-col-full">
                                <label class="af-label">1. Name of Candidate <span>*</span>
                                    <small style="font-weight:400;text-transform:none;">(as entered in class 10<sup>th</sup>
                                        certificate)</small>
                                </label>
                                <input type="text" name="candidate_name"
                                    class="af-input @error('candidate_name') is-invalid @enderror"
                                    value="{{ old('candidate_name') }}" placeholder="Full name as per 10th certificate"
                                    required>
                                @error('candidate_name')
                                    <div class="af-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="af-row">
                            <div class="af-col-full">
                                <label class="af-label">2. Name of Course <span>*</span></label>
                                <select name="course_name" class="af-input @error('course_name') is-invalid @enderror"
                                    required>
                                    <option value="">Select Course</option>

                                    @foreach ($courses as $course)
                                        <option value="{{ $course->title }}"
                                            {{ old('course_name') == $course->title ? 'selected' : '' }}>
                                            {{ $course->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('course_name')
                                    <div class="af-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="af-row">
                            <div class="af-col-half">
                                <label class="af-label">Gender <span>*</span></label>
                                <div class="af-check-row" style="margin-top:8px;">
                                    @foreach (['Male', 'Female', 'Other'] as $g)
                                        <label class="af-check-item">
                                            <input type="radio" name="gender" value="{{ $g }}"
                                                {{ old('gender') == $g ? 'checked' : '' }} required>
                                            {{ $g }}
                                        </label>
                                    @endforeach
                                </div>
                                @error('gender')
                                    <div class="af-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="af-col-half">
                                <label class="af-label">Category <span>*</span></label>
                                <div class="af-check-row" style="margin-top:8px; flex-wrap:wrap; gap:10px;">
                                    @foreach (['General', 'SC', 'ST', 'OBC', 'Other'] as $c)
                                        <label class="af-check-item">
                                            <input type="radio" name="category" value="{{ $c }}"
                                                {{ old('category') == $c ? 'checked' : '' }} required>
                                            {{ $c }}
                                        </label>
                                    @endforeach
                                </div>
                                <input type="text" name="category_other" class="af-input mt-2"
                                    value="{{ old('category_other') }}" placeholder="If Other, specify here"
                                    style="margin-top:8px;">
                                @error('category')
                                    <div class="af-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="af-row">
                            <div class="af-col-half">
                                <label class="af-label">3. Date of Birth <span>*</span></label>
                                <input type="date" name="dob" class="af-input @error('dob') is-invalid @enderror"
                                    value="{{ old('dob') }}" required>
                                @error('dob')
                                    <div class="af-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="af-col-half">
                                <label class="af-label">Place of Birth <span>*</span></label>
                                <input type="text" name="place_of_birth"
                                    class="af-input @error('place_of_birth') is-invalid @enderror"
                                    value="{{ old('place_of_birth') }}" placeholder="City / Town" required>
                                @error('place_of_birth')
                                    <div class="af-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="af-row">
                            <div class="af-col-half">
                                <label class="af-label">4. Aadhaar No. (UID) <span>*</span></label>
                                <input type="text" name="aadhaar_no"
                                    class="af-input @error('aadhaar_no') is-invalid @enderror"
                                    value="{{ old('aadhaar_no') }}" placeholder="12-digit Aadhaar number" maxlength="12"
                                    inputmode="numeric" pattern="\d{12}" required>
                                @error('aadhaar_no')
                                    <div class="af-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- ── CONTACT DETAILS ── --}}
                        <div class="af-section"><i class="fas fa-address-card"></i> Contact &amp; Address</div>

                        <div class="af-row">
                            <div class="af-col-half">
                                <label class="af-label">5. Nationality <span>*</span></label>
                                <input type="text" name="nationality"
                                    class="af-input @error('nationality') is-invalid @enderror"
                                    value="{{ old('nationality', 'Indian') }}" required>
                                @error('nationality')
                                    <div class="af-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="af-col-half">
                                <label class="af-label">Country of Citizenship <span>*</span></label>
                                <input type="text" name="country_citizenship"
                                    class="af-input @error('country_citizenship') is-invalid @enderror"
                                    value="{{ old('country_citizenship', 'India') }}" required>
                                @error('country_citizenship')
                                    <div class="af-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="af-row">
                            <div class="af-col-full">
                                <label class="af-label">6. Permanent Address <span>*</span></label>
                                <textarea name="permanent_address" class="af-textarea @error('permanent_address') is-invalid @enderror"
                                    placeholder="House No., Street, Village/City, District, State, PIN" required>{{ old('permanent_address') }}</textarea>
                                @error('permanent_address')
                                    <div class="af-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="af-row">
                            <div class="af-col-half">
                                <label class="af-label">7. Mobile No. (Self) <span>*</span></label>
                                <input type="tel" name="mobile"
                                    class="af-input @error('mobile') is-invalid @enderror" value="{{ old('mobile') }}"
                                    placeholder="10-digit mobile number" maxlength="10" inputmode="numeric" required>
                                <p class="af-hint">Inform the college if this number changes.</p>
                                @error('mobile')
                                    <div class="af-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="af-col-half">
                                <label class="af-label">Email ID</label>
                                <input type="email" name="email"
                                    class="af-input @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    placeholder="yourname@email.com">
                                @error('email')
                                    <div class="af-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- ── TERMS & DECLARATION ── --}}
                        <div class="af-section"><i class="fas fa-file-contract"></i> Terms &amp; Conditions</div>

                        <div class="af-terms-box">
                            <h6>Terms &amp; Conditions of Admission</h6>
                            <ol>
                                <li>We have taken due and reasonable care in obtaining the Guru Nanak Institute of Medical
                                    Technology status from the Government of Punjab and University Grants Commission (UGC).
                                    However we shall be bound by any change in the laws/government policy/judicial ruling
                                    affecting its status as such and shall have no liability in such an event.</li>
                                <li>The Guru Nanak Institute of Medical Technology reserves the right to cancel the
                                    admission of any candidate under any of the following circumstances:
                                    <ul>
                                        <li>a) If the fees is not deposited by the stipulated date.</li>
                                        <li>b) If the candidate does not join the particular programme by the stipulated
                                            date even though the Fee has been deposited.</li>
                                        <li>c) If the candidate fails to furnish the proof of the minimum eligible
                                            qualification required for admission into the programme/course within the
                                            stipulated time frame.</li>
                                        <li>d) If he/she indulge in Ragging Activities.</li>
                                    </ul>
                                </li>
                                <li>A candidate found indulging in drug/alcohol abuse, violence or improper behaviour and
                                    does not abide by the rules and regulation as are relevant from time to time, he/she
                                    will be rusticated.</li>
                                <li>Activities that have the effect or intention of interfering with education pursuit of
                                    knowledge, or fair evolution of a student's performance are prohibited and offenders
                                    shall be liable for appropriate punitive action.</li>
                                <li>The conditions laid herein are binding on the student and his/her admission to Guru
                                    Nanak Institute of Medical Technology if out of his/her own free will and consent and at
                                    his/her own return/risk.</li>
                            </ol>

                            <h6>Declaration by the Student</h6>
                            <ol>
                                <li>I am responsible for the information given above by me and it is true to the best of my
                                    knowledge and belief. Nothing has been concealed therein.</li>
                                <li>I am physically fit and do not suffer from any physical deformity/communicable disease.
                                </li>
                                <li>I do hereby agree to pay the cost of damage caused to the movable and immovable property
                                    of the GNIMT, Patiala.</li>
                                <li>I hereby agree to conform to all rules, acts and laws enforced by the Guru Nanak
                                    Institute of Medical Technology. Further, I hereby undertake that if I disobey any of
                                    the rules or regulations, disciplinary action may be taken against me, including
                                    expulsion from the Institute.</li>
                                <li>I know that if at any stage of my course, any discrepancy is found in my
                                    testimonials/documents/eligibility by the Guru Nanak Institute of Medical Technology or
                                    any other authority, the Institute will not be held responsible and I will own the
                                    responsibility. I shall not claim any refund from the Institute.</li>
                                <li>I hereby agree to pay the full fee of the course even if I discontinue my studies at any
                                    time during the course, as I am fully aware that the seat so vacated by me will be a
                                    loss to the Guru Nanak Institute of Medical Technology.</li>
                                <li>I understand that this is Non-NCTE seat and I am taking admission at my own risk and
                                    responsibility. In case of any issue, Guru Nanak Institute of Medical Technology will
                                    not be responsible for the same.</li>
                                <li>I bind myself to fulfil 75% attendance condition or attendance requirement as per the
                                    council, commission, or any other statutory body and clear the conditional tests to make
                                    myself eligible for the final exams as per the Guru Nanak Institute of Medical
                                    Technology rules.</li>
                                <li>I am fully aware that ragging is strictly prohibited/punished under law in the Guru
                                    Nanak Institute of Medical Technology. If I am found guilty of indulging in or abetting
                                    ragging, I shall be liable for punishment and expulsion from the Institute.</li>
                                <li>I would endeavour to excel in my studies &amp; other Guru Nanak Institute of Medical
                                    Technology Extra Curricular activities.</li>
                                <li>I will maintain highest degree of discipline &amp; will not be involved in any activity
                                    that harms or damages the dignity &amp; prestige of my esteemed Institute.</li>
                                <li>I understand and agree that any dispute arising about my admission, if not resolved
                                    mutually, the decision of the Director/Principal of Guru Nanak Institute of Medical
                                    Technology as sole arbitrator will be final and binding. However, jurisdiction of courts
                                    will be District Patiala only.</li>
                                <li>I have noted that the fees once paid by me is neither refundable nor adjustable in any
                                    circumstances and in case of any dispute between me and the Institute, the jurisdiction
                                    for legal proceeding will be Patiala only.</li>
                            </ol>
                        </div>

                        {{-- Declaration checkbox --}}
                        <div class="af-declaration">
                            <label>
                                <input type="checkbox" name="declaration" id="declarationCheck" value="1"
                                    {{ old('declaration') ? 'checked' : '' }}>
                                <span>I have read, understood, and agree to all the Terms &amp; Conditions and the
                                    Declaration stated above. I confirm that all the information provided by me is true and
                                    correct to the best of my knowledge. <strong style="color:#e3342f;">*</strong></span>
                            </label>
                            @error('declaration')
                                <div class="af-error" style="margin-top:8px;">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- reCAPTCHA --}}
                        <div class="af-recaptcha-row">
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') ?: '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI' }}"></div>
                        </div>

                        {{-- Submit --}}
                        <div class="af-submit-row">
                            <button type="submit" class="af-btn-submit" id="submitBtn">
                                <i class="fas fa-paper-plane"></i> Submit Application
                            </button>
                            <p class="af-submit-note">Once submitted, our team will review your application and contact you
                                within 24–48 hours.</p>
                        </div>

                    </form>
                </div>{{-- .af-body --}}
            </div>{{-- .af-sheet --}}

        </div>{{-- .af-container --}}
    </div>{{-- .af-wrapper --}}

    @include('partials.faq', [
        'title' => 'Admission Form — Frequently Asked Questions',
        'subtitle' => 'Quick answers to help you complete and submit your admission form.',
        'faqs' => $globalFaqs,
    ])

@endsection

@section('scripts')
    <script>
        const declCheck = document.getElementById('declarationCheck');
        const submitBtn = document.getElementById('submitBtn');

        // Initial state — disabled until declaration is checked
        function toggleSubmit() {
            if (declCheck.checked) {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
            } else {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.45';
                submitBtn.style.cursor = 'not-allowed';
            }
        }

        declCheck.addEventListener('change', toggleSubmit);
        toggleSubmit(); // run on page load

        // Prevent double-submit
        document.querySelector('form').addEventListener('submit', function() {
            if (!declCheck.checked) return false;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
        });

        // Scroll to first validation error
        const firstError = document.querySelector('.af-error');
        if (firstError) {
            firstError.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
    </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection
