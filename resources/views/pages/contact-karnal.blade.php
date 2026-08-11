@extends('layouts.app')

@section('title', 'Contact Karnal Branch | GNIMT – Guru Nanak Institute of Medical Technology')
@section('meta_description',
    'Reach GNIMT Karnal at Ujala Cygnus – Sanjiv Bansal Hospital Campus, Railway Road, Karnal – 132001. Call
    +91-8150019000 | +91-8950019000')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/contact-karnal.css') }}">
@endsection

@section('content')

    {{-- ══ HERO ══ --}}
    <section class="gc-hero">
        <div class="container-fluid px-4 px-lg-5">
            <div class="gc-hero__tag"><i class="fas fa-map-marker-alt"></i> Karnal Branch</div>
            <h1 class="gc-hero__title">Contact <em>Karnal</em><br>Campus</h1>
            <div class="gc-hero__meta">
                <i class="fas fa-map-marker-alt"></i>
                <span>Ujala Cygnus – Sanjiv Bansal Hospital Campus,<br>Railway Road, Karnal, Haryana – 132001</span>
            </div>
            <div class="gc-hero__btns">
                <a href="tel:8150019000" class="gc-btn-red"><i class="fas fa-phone-alt"></i> +91-8150019000</a>
                <a href="{{ route('contact.patiala') }}" class="gc-btn-outline"><i class="fas fa-building"></i> Patiala
                    Branch</a>
            </div>
        </div>
    </section>

    {{-- ══ BREADCRUMB ══ --}}
    <nav class="gc-breadcrumb">
        <div class="container-fluid px-4 px-lg-5">
            <a href="{{ route('home') }}">Home</a>
            <span class="sep">/</span>
            <span class="cur">Contact — Karnal Branch</span>
        </div>
    </nav>

    {{-- ══ PILLARS ══ --}}
    <div class="gc-pillars">
        <a href="tel:8150019000" class="gc-pillar">
            <div class="gc-pillar__icon"><i class="fas fa-phone-alt"></i></div>
            <div><span class="gc-pillar__lbl">Helpline</span><span class="gc-pillar__val">+91-8150019000</span></div>
        </a>
        <a href="tel:8950019000" class="gc-pillar">
            <div class="gc-pillar__icon"><i class="fas fa-phone"></i></div>
            <div><span class="gc-pillar__lbl">Alternate</span><span class="gc-pillar__val">+91-8950019000</span></div>
        </a>
        <a href="tel:01842260019" class="gc-pillar">
            <div class="gc-pillar__icon"><i class="fas fa-phone-square-alt"></i></div>
            <div><span class="gc-pillar__lbl">Landline</span><span class="gc-pillar__val">0184-2260019</span></div>
        </a>
        <a href="mailto:info@gurunanakinstitute.com" class="gc-pillar">
            <div class="gc-pillar__icon"><i class="fas fa-envelope"></i></div>
            <div><span class="gc-pillar__lbl">Email</span><span class="gc-pillar__val">info@gurunanakinstitute.com</span>
            </div>
        </a>
        <a href="https://wa.me/918150019000" target="_blank" class="gc-pillar">
            <div class="gc-pillar__icon wa"><i class="fab fa-whatsapp"></i></div>
            <div><span class="gc-pillar__lbl">WhatsApp</span><span class="gc-pillar__val">+91-8150019000</span></div>
        </a>
    </div>

    {{-- ══ MAP + INFO ══ --}}
    <section style="padding:72px 0;background:#f8fafc;">
        <div class="container-fluid px-4 px-lg-5">
            <div class="row g-5">

                {{-- Map --}}
                <div class="col-lg-7">
                    <div class="gc-sec-label"><span></span> Campus on Map</div>
                    <h2 class="gc-sec-heading">How to <em>Reach Us</em></h2>
                    <div class="gc-map-box">
                        <iframe src="https://maps.google.com/maps?q=29.6921,76.9935&z=16&output=embed" width="100%"
                            height="420" frameborder="0" style="border:0;" allowfullscreen loading="lazy"
                            title="GNIMT Karnal Campus"></iframe>
                    </div>
                    <div class="gc-map-link">
                        <i class="fas fa-map-marker-alt fa-lg"></i>
                        <address>
                            <strong>GNIMT Karnal Campus</strong>
                            Ujala Cygnus – Sanjiv Bansal Hospital Campus, Railway Road, Karnal, Haryana – 132001
                        </address>
                        <a href="https://maps.google.com/?q=29.6921,76.9935" target="_blank" rel="noopener"
                            style="display:inline-flex;align-items:center;gap:6px;color:#c0262d;font-size:0.8rem;font-weight:700;text-decoration:none;white-space:nowrap;flex-shrink:0;">
                            <i class="fas fa-external-link-alt"></i> Open
                        </a>
                    </div>
                </div>

                {{-- Info --}}
                <div class="col-lg-5">
                    <div class="gc-sec-label"><span></span> Branch Details</div>
                    <h2 class="gc-sec-heading">Karnal <em>Office Info</em></h2>
                    <div class="gc-info-row">
                        <div class="gc-info-block">
                            <div class="gc-info-block__title"><i class="fas fa-map-marker-alt"></i> Address</div>
                            <div class="gc-info-block__body">
                                Ujala Cygnus – Sanjiv Bansal Hospital Campus,<br>
                                Railway Road, Karnal, Haryana – 132001
                            </div>
                        </div>
                        <div class="gc-info-block">
                            <div class="gc-info-block__title"><i class="fas fa-phone-alt"></i> Phone Numbers</div>
                            <div class="gc-info-block__body">
                                <a href="tel:8150019000">+91-8150019000</a>
                                <a href="tel:8950019000">+91-8950019000</a>
                                <a href="tel:01842260019">0184-2260019 (Landline)</a>
                            </div>
                        </div>
                        <div class="gc-info-block">
                            <div class="gc-info-block__title"><i class="fas fa-envelope"></i> Email &amp; WhatsApp</div>
                            <div class="gc-info-block__body">
                                <a href="mailto:info@gurunanakinstitute.com">info@gurunanakinstitute.com</a>
                                <a href="https://wa.me/918150019000" target="_blank">
                                    <i class="fab fa-whatsapp" style="color:#25d366;"></i> +91-8150019000
                                </a>
                            </div>
                        </div>
                        <div class="gc-info-block" style="border-left-color:#0f2557;">
                            <div class="gc-info-block__title" style="color:#0f2557;"><i class="fas fa-clock"></i> Office
                                Hours</div>
                            <div class="gc-info-block__body"
                                style="display:grid;grid-template-columns:1fr 1fr;gap:4px 12px;font-size:0.83rem;">
                                <span style="font-weight:500;color:#475569;">Mon – Saturday</span>
                                <span style="color:#0f2557;">9:00 AM – 5:00 PM</span>
                                <span style="font-weight:500;color:#475569;">Sunday</span>
                                <span style="color:#94a3b8;">Closed</span>
                            </div>
                        </div>
                    </div>

                    <div class="gc-director mt-4">
                        <div class="gc-director__avatar"><i class="fas fa-user-tie"></i></div>
                        <div class="gc-director__info">
                            <div class="gc-director__name">Dr. Subhash Dawar</div>
                            <div class="gc-director__role">Director — GNIMT Karnal Campus</div>
                            <div class="gc-director__quote">
                                "Karnal campus extends our mission of quality allied-health education to Haryana, bringing
                                world-class training closer to students across the region."
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ══ FORM ══ --}}
    <section style="padding:72px 0;background:#fff;">
        <div class="container-fluid px-4 px-lg-5">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-7 text-center">
                    <div class="gc-sec-label justify-content-center"><span></span> Get in Touch <span></span></div>
                    <h2 class="gc-sec-heading" style="margin-bottom:10px;">Send a Message to<br><em>Karnal Branch</em>
                    </h2>
                    <p style="font-size:0.88rem;color:#64748b;">Our team responds within 24 working hours. For urgent
                        queries, call <a href="tel:8150019000" style="color:#c0262d;font-weight:700;">+91-8150019000</a>.
                    </p>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="gc-form-card">
                        <div class="gc-form-card__title">Enquiry Form</div>
                        <div class="gc-form-card__sub">Karnal Campus — All fields marked * are required.</div>

                        @if (session('success'))
                            <div class="alert alert-success mb-4">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger mb-4">{{ session('error') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger mb-4">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            @include('partials.honeypot')
                            <input type="hidden" name="branch" value="Karnal">
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <label class="gc-label" for="kn_name">Full Name *</label>
                                    <input type="text" id="kn_name" name="name" class="gc-input" required
                                        placeholder="Your full name">
                                </div>
                                <div class="col-sm-6">
                                    <label class="gc-label" for="kn_phone">Phone Number *</label>
                                    <input type="tel" id="kn_phone" name="phone" class="gc-input" required
                                        placeholder="+91-XXXXXXXXXX">
                                </div>
                                <div class="col-sm-6">
                                    <label class="gc-label" for="kn_email">Email Address</label>
                                    <input type="email" id="kn_email" name="email" class="gc-input"
                                        placeholder="your@email.com">
                                </div>
                                <div class="col-sm-6">
                                    <label class="gc-label">Department</label>
                                    <select name="course_category_id" id="kn_course_category_id" class="gc-input">
                                        <option value="">— Select Department —</option>
                                        @foreach ($courseCategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="gc-label">Course Interested In</label>
                                    <select name="course_id" id="kn_course_id" class="gc-input">
                                        <option value="">— Select Course —</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="gc-label" for="kn_subject">Subject</label>
                                    <input type="text" id="kn_subject" name="subject" class="gc-input"
                                        placeholder="How can we help you?">
                                </div>
                                <div class="col-12">
                                    <label class="gc-label" for="kn_message">Message *</label>
                                    <textarea id="kn_message" name="message" class="gc-input" rows="5" required
                                        placeholder="Write your query here..."></textarea>
                                </div>
                                <div class="col-12">
                                    <div class="g-recaptcha mb-3" data-sitekey="{{ config('services.recaptcha.site_key') ?: '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI' }}"></div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="gc-submit">
                                        <i class="fas fa-paper-plane"></i> Send Message to Karnal Branch
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="gc-sidebar">
                        <div class="gc-sidebar__title">Quick Navigation</div>
                        @foreach ([['fas fa-paper-plane', 'Apply for Admission', route('admissions.form')], ['fas fa-book-open', 'View All Courses', route('academics')], ['fas fa-user-graduate', 'Our Achievers', route('achievers')], ['fas fa-images', 'Campus Gallery', route('gallery')], ['fas fa-building', 'Patiala Branch', route('contact.patiala')]] as [$ic, $lb, $hr])
                            <a href="{{ $hr }}" class="gc-sidebar__link"><i class="{{ $ic }}"></i>
                                {{ $lb }}</a>
                        @endforeach
                        <div class="gc-sidebar__hours">
                            <div class="gc-sidebar__hours-title">Office Hours</div>
                            <div class="gc-sidebar__hours-row"><strong>Mon – Sat</strong><span>9 AM – 5 PM</span></div>
                            <div class="gc-sidebar__hours-row"><strong>Sunday</strong><span
                                    style="color:rgba(255,255,255,0.4);">Closed</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══ OTHER BRANCH CALLOUT ══ --}}
    <section style="padding:40px 0;background:#f8fafc;border-top:1px solid #e2e8f0;">
        <div class="container-fluid px-4 px-lg-5">
            <div class="gc-branch-callout">
                <div class="gc-branch-callout__left">
                    <h4>Also Looking for Patiala Branch?</h4>
                    <p>576-A/5-1, Main Road, Near Bus Stand, Upkar Nagar, Patiala &nbsp;|&nbsp;
                        <a href="tel:8283929908"
                            style="color:#c0262d;font-weight:700;text-decoration:none;">+91-8283929908</a>
                    </p>
                </div>
                <a href="{{ route('contact.patiala') }}" class="gc-btn-red"><i class="fas fa-building"></i> Patiala Branch
                    →</a>
            </div>
        </div>
    </section>

    @include('partials.faq', [
        'title' => 'Karnal Branch — Frequently Asked Questions',
        'subtitle' => 'Common questions about the GNIMT Karnal campus.',
        'faqs' => [
            ['q' => 'Where is the GNIMT Karnal campus located?', 'a' => 'GNIMT Karnal is located at Ujala Cygnus – Sanjiv Bansal Hospital Campus, Railway Road, Karnal, Haryana – 132001. It is easily accessible from Railway Road near Karnal railway station.'],
            ['q' => 'What are the contact numbers for Karnal branch?', 'a' => 'Primary: <a href="tel:8150019000">+91-8150019000</a> | Alternate: <a href="tel:8950019000">+91-8950019000</a> | Landline: <a href="tel:01842260019">0184-2260019</a>'],
            ['q' => 'When is the Karnal admission office open?', 'a' => 'Monday to Saturday, 9:00 AM – 5:00 PM. Closed on Sundays and public holidays.'],
            ['q' => 'Who heads the Karnal campus?', 'a' => 'The Karnal campus is headed by Dr. Subhash Dawar, Director of GNIMT.'],
            ['q' => 'How can I apply for admission at Karnal?', 'a' => 'Apply online at <a href="' . route('admissions.form') . '">our admission form</a> or call <a href="tel:8150019000">+91-8150019000</a>.'],
            ['q' => 'Can I contact Karnal branch via WhatsApp?', 'a' => 'Yes, WhatsApp us at <a href="https://wa.me/918150019000" target="_blank">+91-8150019000</a> during office hours.'],
        ],
    ])

    <script>
        const knCoursesByCategory = @json($courseCategories->mapWithKeys(function ($cat) {
            return [$cat->id => $cat->courses->map(fn($c) => ['id' => $c->id, 'title' => $c->title])];
        }));
        const knAllCourses = Object.values(knCoursesByCategory).flat();
        function knRenderCourses(list) {
            const sel = document.getElementById('kn_course_id');
            sel.innerHTML = '<option value="">— Select Course —</option>';
            list.forEach(c => {
                sel.innerHTML += `<option value="${c.id}">${c.title}</option>`;
            });
        }
        knRenderCourses(knAllCourses);
        document.getElementById('kn_course_category_id').addEventListener('change', function () {
            knRenderCourses(this.value ? (knCoursesByCategory[this.value] || []) : knAllCourses);
        });
    </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection
