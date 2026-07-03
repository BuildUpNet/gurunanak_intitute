@extends('layouts.app')

@section('title', 'Our Achievers & Placements | GNIMT')
@section('meta_description', 'Meet the successful alumni of GNIMT — placed in top hospitals, government jobs, and
    running their own clinics across India since 1991.')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/achievers.css') }}">
@endsection

@section('content')

    {{-- ══ HERO ══ --}}
    <section class="ach-hero" aria-label="Our Achievers">
        <div class="container-fluid px-4 px-lg-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <div class="ach-hero__eyebrow">Guru Nanak Institute of Medical Technology</div>
                    <h1>Our <span>Achievers</span> &amp;<br>Success Stories</h1>
                    <p>35,000+ graduates. Top hospitals, government posts, and thriving businesses across India and abroad —
                        every one of them a testament to GNIMT's legacy of excellence since 1991.</p>
                    <div class="ach-hero__stats">
                        <div>
                            <span class="ach-hero__stat-num">99.9%</span>
                            <span class="ach-hero__stat-label">Placement Rate</span>
                        </div>
                        <div>
                            <span class="ach-hero__stat-num">35,000+</span>
                            <span class="ach-hero__stat-label">Alumni Worldwide</span>
                        </div>
                        <div>
                            <span class="ach-hero__stat-num">200+</span>
                            <span class="ach-hero__stat-label">Govt. Job Holders</span>
                        </div>
                        <div>
                            <span class="ach-hero__stat-num">150+</span>
                            <span class="ach-hero__stat-label">Self Employed</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-flex justify-content-end">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;max-width:300px;">
                        @foreach ([['fas fa-hospital-alt', 'Hospital\nPlacements', '#1a3566'], ['fas fa-landmark', 'Govt.\nJobs', '#c0262d'], ['fas fa-store', 'Self\nEmployed', '#c0262d'], ['fas fa-globe', 'India &\nAbroad', '#1a3566']] as [$ic, $lb, $cl])
                            <div
                                style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);border-radius:16px;padding:20px;text-align:center;">
                                <i class="{{ $ic }}"
                                    style="font-size:1.6rem;color:{{ $cl }};display:block;margin-bottom:10px;"></i>
                                <span
                                    style="font-size:0.72rem;font-weight:600;color:rgba(255,255,255,0.7);line-height:1.4;white-space:pre-line;">{{ $lb }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Breadcrumb --}}
    <nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
        <div class="container-fluid px-4 px-lg-5">
            <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
            <span class="current">Our Achievers</span>
        </div>
    </nav>

    {{-- ══ STICKY TABS ══ --}}
    <div class="ach-tabs-wrap">
        <div class="container-fluid px-4 px-lg-5">
            <div class="ach-tabs">
                <a class="ach-tab active" href="#placements-section" data-target="placements-section">
                    <i class="fas fa-hospital-alt"></i> Hospital Placements
                </a>
                <a class="ach-tab" href="#govt-jobs" data-target="govt-jobs">
                    <i class="fas fa-landmark"></i> Govt. Jobs
                </a>
                <a class="ach-tab" href="#self-employed" data-target="self-employed">
                    <i class="fas fa-store"></i> Self Employed
                </a>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════
     SECTION 1 — HOSPITAL PLACEMENTS
══════════════════════════════ --}}
    <section class="ach-sec-white" style="padding:80px 0;" id="placements-section">
        <div class="container-fluid px-4 px-lg-5">

            <div class="ach-sec-head">
                <div class="ach-sec-eyebrow">Hospital Sector</div>
                <h2 class="ach-sec-title">Stellar <span>Hospital Placements</span></h2>
                <p class="ach-sec-sub">GNIMT maintains a consistent 99.9% placement record. Our graduates work in India's
                    leading private and government hospitals.</p>
            </div>

            <div class="row g-4">
                @foreach ([['Amanpreet Singh', 'B.Voc OT Technology', 'Fortis Hospital, Mohali', 'fas fa-user-md'], ['Priya Sharma', 'B.Voc Medical Lab Technology', 'SRL Diagnostics', 'fas fa-microscope'], ['Rahul Verma', 'Radiology Diploma', 'AIIMS Bathinda', 'fas fa-x-ray'], ['Neha Gupta', 'Cardiac Care Technology', 'Max Healthcare, Delhi', 'fas fa-heartbeat'], ['Simran Kaur', 'Hospital Management', 'Medanta, Gurugram', 'fas fa-hospital-user'], ['Vikram Jeet', 'Dialysis Technology', 'Apollo Hospitals', 'fas fa-clinic-medical'], ['Hardeep Kaur', 'B.Voc Physiotherapy', 'PGI Chandigarh', 'fas fa-running'], ['Gurpreet Singh', 'B.Voc Ophthalmic Technology', 'Narayana Health', 'fas fa-eye'], ['Manpreet Bains', 'B.Voc MLT Diploma', 'Dr Lal PathLabs', 'fas fa-vial']] as [$name, $course, $place, $icon])
                    <div class="col-sm-6 col-lg-4">
                        <div class="ach-place-card">
                            <div class="ach-place-card__avatar"><i class="{{ $icon }}"></i></div>
                            <div class="ach-place-card__name">{{ $name }}</div>
                            <div class="ach-place-card__course">{{ $course }}</div>
                            <div class="ach-place-card__badge">
                                <i class="fas fa-building"></i> {{ $place }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="ach-stats-strip">
                <div class="ach-stats-strip__item">
                    <span class="ach-stats-strip__num gold-num">99.9%</span>
                    <span class="ach-stats-strip__label">Placement Rate</span>
                </div>
                <div class="ach-stats-strip__item">
                    <span class="ach-stats-strip__num">50+</span>
                    <span class="ach-stats-strip__label">Hospital Partners</span>
                </div>
                <div class="ach-stats-strip__item">
                    <span class="ach-stats-strip__num">5,000+</span>
                    <span class="ach-stats-strip__label">Alumni Placed</span>
                </div>
                <div class="ach-stats-strip__item">
                    <span class="ach-stats-strip__num gold-num">10+</span>
                    <span class="ach-stats-strip__label">States Covered</span>
                </div>
            </div>

        </div>
    </section>

    {{-- ══════════════════════════════
     SECTION 2 — GOVT JOBS
══════════════════════════════ --}}
    <section class="ach-sec-light" style="padding:80px 0;" id="govt-jobs">
        <div class="container-fluid px-4 px-lg-5">

            <div class="ach-sec-head">
                <div class="ach-sec-eyebrow">Government Sector</div>
                <h2 class="ach-sec-title">Students at <span>Government Jobs</span></h2>
                <p class="ach-sec-sub">GNIMT graduates proudly serve in government hospitals, civil dispensaries, ESI
                    hospitals, and public health institutions across India.</p>
            </div>

            <div class="row g-4">
                @foreach ([['Rajwinder Kaur', 'B.Voc MLT', 'Lab Technician (Grade-II)', 'Govt. Medical College & Hospital, Patiala', 'fas fa-landmark'], ['Gurjot Singh', 'Radiology Diploma', 'X-Ray Technician', 'Civil Hospital, Ludhiana', 'fas fa-hospital'], ['Mandeep Sharma', 'OT Technology', 'OT Technician', 'AIIMS, New Delhi', 'fas fa-landmark'], ['Harpreet Brar', 'Cardiac Care Technology', 'Cardiac Technician', 'ESI Hospital, Chandigarh', 'fas fa-heartbeat'], ['Poonam Devi', 'B.Voc Physiotherapy', 'Physiotherapist', 'District Hospital, Karnal', 'fas fa-running'], ['Amritpal Singh', 'Dialysis Technology', 'Dialysis Technician', 'Civil Hospital, Amritsar', 'fas fa-clinic-medical']] as [$name, $course, $role, $org, $icon])
                    <div class="col-sm-6 col-lg-4">
                        <div class="ach-govt-card">
                            <div class="ach-govt-card__top">
                                <div class="ach-govt-card__icon-wrap"><i class="{{ $icon }}"></i></div>
                                <div>
                                    <div class="ach-govt-card__name">{{ $name }}</div>
                                    <div class="ach-govt-card__course">{{ $course }}</div>
                                </div>
                            </div>
                            <div class="ach-govt-card__divider"></div>
                            <div class="ach-govt-card__role"><i class="fas fa-id-badge"></i>{{ $role }}</div>
                            <div class="ach-govt-card__org"><i class="fas fa-map-marker-alt"
                                    style="margin-top:2px;flex-shrink:0;"></i>{{ $org }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="ach-stats-strip">
                <div class="ach-stats-strip__item">
                    <span class="ach-stats-strip__num gold-num">200+</span>
                    <span class="ach-stats-strip__label">Govt. Job Holders</span>
                </div>
                <div class="ach-stats-strip__item">
                    <span class="ach-stats-strip__num">15+</span>
                    <span class="ach-stats-strip__label">States Covered</span>
                </div>
                <div class="ach-stats-strip__item">
                    <span class="ach-stats-strip__num">50+</span>
                    <span class="ach-stats-strip__label">Govt. Institutions</span>
                </div>
                <div class="ach-stats-strip__item">
                    <span class="ach-stats-strip__num gold-num">33+</span>
                    <span class="ach-stats-strip__label">Years Track Record</span>
                </div>
            </div>

        </div>
    </section>

    {{-- ══════════════════════════════
     SECTION 3 — SELF EMPLOYED
══════════════════════════════ --}}
    <section class="ach-sec-white" style="padding:80px 0;" id="self-employed">
        <div class="container-fluid px-4 px-lg-5">

            <div class="ach-sec-head">
                <div class="ach-sec-eyebrow">Entrepreneurs</div>
                <h2 class="ach-sec-title">Self <span>Employed</span> Students</h2>
                <p class="ach-sec-sub">Visionary GNIMT alumni who turned their healthcare education into thriving
                    independent practices, clinics, labs, and businesses.</p>
            </div>

            <div class="row g-4">
                @foreach ([['Surinder Pal', 'DMLT Diploma', 'fas fa-flask', 'Surinder Diagnostics Lab, Patiala', 'Own Pathology Lab · Est. 2019', 'Pathology'], ['Navneet Kaur', 'B.Voc Physiotherapy', 'fas fa-spa', 'Navneet Physio Care Centre, Chandigarh', 'Physiotherapy Clinic · Est. 2021', 'Physiotherapy'], ['Jasvir Singh', 'Radiology Diploma', 'fas fa-x-ray', 'Jasvir X-Ray & Ultrasound Centre, Ludhiana', 'Radiology Centre · Est. 2020', 'Radiology'], ['Deepika Sharma', 'Hospital Management', 'fas fa-building', 'HealthFirst Wellness Pvt. Ltd., Karnal', 'Healthcare Startup · Est. 2022', 'Management'], ['Kulwinder Brar', 'Ophthalmic Technology', 'fas fa-eye', 'Clear Vision Eye Care, Bathinda', 'Eye Care Clinic · Est. 2020', 'Ophthalmic'], ['Ramneet Singh', 'Dialysis Technology', 'fas fa-clinic-medical', 'Singh Kidney Care Centre, Hoshiarpur', 'Dialysis Unit · Est. 2021', 'Dialysis']] as [$name, $course, $icon, $venture, $desc, $tag])
                    <div class="col-sm-6 col-lg-4">
                        <div class="ach-biz-card">
                            <div class="ach-biz-card__icon-wrap"><i class="{{ $icon }}"></i></div>
                            <div class="ach-biz-card__name">{{ $name }}</div>
                            <div class="ach-biz-card__course">{{ $course }}</div>
                            <div class="ach-biz-card__venture"><i class="fas fa-store"></i>{{ $venture }}</div>
                            <div class="ach-biz-card__desc"><i class="fas fa-info-circle"></i>{{ $desc }}</div>
                            <div style="margin-top:18px;">
                                <span class="ach-biz-card__tag"><i class="fas fa-tag"></i>{{ $tag }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="ach-stats-strip" style="background:linear-gradient(135deg,#6e1217,#c0262d,#e84a52);">
                <div class="ach-stats-strip__item">
                    <span class="ach-stats-strip__num">150+</span>
                    <span class="ach-stats-strip__label">Self Employed Alumni</span>
                </div>
                <div class="ach-stats-strip__item">
                    <span class="ach-stats-strip__num">80+</span>
                    <span class="ach-stats-strip__label">Own Clinics</span>
                </div>
                <div class="ach-stats-strip__item">
                    <span class="ach-stats-strip__num">30+</span>
                    <span class="ach-stats-strip__label">Pathology Labs</span>
                </div>
                <div class="ach-stats-strip__item">
                    <span class="ach-stats-strip__num">5+</span>
                    <span class="ach-stats-strip__label">Healthcare Startups</span>
                </div>
            </div>

        </div>
    </section>

    {{-- ══ CTA ══ --}}
    <section style="background:linear-gradient(135deg,#0d1f45,#1a3566);padding:72px 0;">
        <div class="container-fluid px-4 px-lg-5 text-center">
            <div class="ach-sec-eyebrow" style="color:rgba(255,255,255,0.5);justify-content:center;margin-bottom:16px;">
                <span style="display:inline-flex;align-items:center;gap:10px;">
                    <span
                        style="width:24px;height:2px;background:rgba(255,255,255,0.3);border-radius:2px;display:inline-block;"></span>
                    Join Our Legacy
                    <span
                        style="width:24px;height:2px;background:rgba(255,255,255,0.3);border-radius:2px;display:inline-block;"></span>
                </span>
            </div>
            <h2
                style="font-family:'Playfair Display',serif;font-size:clamp(1.8rem,3vw,2.6rem);font-weight:800;color:#fff;margin-bottom:16px;">
                Be Our Next <span style="color:#f0a0a5;">Achiever</span></h2>
            <p style="color:rgba(255,255,255,0.72);max-width:520px;margin:0 auto 36px;line-height:1.8;font-size:0.95rem;">
                Enroll today and join thousands of GNIMT graduates who built rewarding healthcare careers across India and
                abroad.</p>
            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('admissions.form') }}" class="hp-btn hp-btn--red">
                    <i class="fas fa-paper-plane"></i> Apply For Admission
                </a>
                <a href="{{ route('contact.patiala') }}" class="hp-btn hp-btn--outline-white">
                    <i class="fas fa-phone"></i> Talk to a Counsellor
                </a>
            </div>
        </div>
    </section>

    @include('partials.faq', [
        'title' => 'Achievers — Frequently Asked Questions',
        'subtitle' => 'Discover how GNIMT nurtures and celebrates student excellence.',
        'faqs' => $globalFaqs,
    ])

@endsection

@section('scripts')
    <script>
        (function() {
            /* Smooth-scroll + active tab on click */
            document.querySelectorAll('.ach-tab').forEach(function(tab) {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    var target = document.getElementById(this.dataset.target);
                    if (!target) return;
                    var offset = document.querySelector('.ach-tabs-wrap').offsetHeight + 8;
                    window.scrollTo({
                        top: target.getBoundingClientRect().top + window.scrollY - offset,
                        behavior: 'smooth'
                    });
                    document.querySelectorAll('.ach-tab').forEach(function(t) {
                        t.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });

            /* Highlight tab on scroll */
            var sections = ['placements-section', 'govt-jobs', 'self-employed'].map(function(id) {
                return document.getElementById(id);
            });
            window.addEventListener('scroll', function() {
                var scrollY = window.scrollY + 120;
                sections.forEach(function(sec, i) {
                    if (!sec) return;
                    if (sec.offsetTop <= scrollY && sec.offsetTop + sec.offsetHeight > scrollY) {
                        document.querySelectorAll('.ach-tab').forEach(function(t) {
                            t.classList.remove('active');
                        });
                        document.querySelectorAll('.ach-tab')[i] && document.querySelectorAll(
                            '.ach-tab')[i].classList.add('active');
                    }
                });
            }, {
                passive: true
            });
        })();
    </script>
@endsection
