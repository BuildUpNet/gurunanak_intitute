{{-- partials/header.blade.php --}}
<header class="site-header" id="siteHeader">

    {{-- ══════════════════════════════════════
     TOP UTILITY BAR — email + social + login
══════════════════════════════════════ --}}
    <div class="top-bar-premium">
        <div class="tbp-inner">
            <div class="tbp-left">
                <a href="mailto:info@gurunanakinstitute.com" class="tbp-email">
                    <i class="fas fa-envelope"></i>
                    <span class="d-none d-md-inline">info@gurunanakinstitute.com</span>
                </a>
                <div class="tbp-socials">
                    <a href="https://www.facebook.com/Guru-Nanak-Institute-of-Medical-Technology-689772771089266"
                        target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/gnimtpatiala/" target="_blank" rel="noopener"
                        aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" target="_blank" rel="noopener" aria-label="YouTube"><i
                            class="fab fa-youtube"></i></a>
                    <a href="#" target="_blank" rel="noopener" aria-label="Twitter/X"><i
                            class="fab fa-twitter"></i></a>
                </div>
            </div>
            <div class="tbp-right">
                <a href="{{ route('portal.login') }}" class="tbp-login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
                {{-- Admission Helpline — full-height red blocks on far right (like Screenshot1.png) --}}
                <div class="nav-helpline" aria-label="Admission Contact">
                    <a href="tel:8283929908" class="nav-helpline-block">
                        <div class="nav-helpline-icon"><i class="fas fa-phone-alt"></i></div>
                        <div class="nav-helpline-text">
                            <span class="nav-helpline-label">Admission Helpline</span>
                            <span class="nav-helpline-num">+91-8283929908</span>
                            <span class="nav-helpline-city">Patiala</span>
                        </div>
                    </a>
                    <a href="tel:8150019000" class="nav-helpline-block">
                        <div class="nav-helpline-icon"><i class="fas fa-phone-alt"></i></div>
                        <div class="nav-helpline-text">
                            <span class="nav-helpline-label">Admission Helpline</span>
                            <span class="nav-helpline-num">+91-8150019000</span>
                            <span class="nav-helpline-city">Karnal</span>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>

    {{-- ══════════════════════════════════════
     MAIN NAV — with full-height helpline blocks on right
══════════════════════════════════════ --}}
    <div id="sw">
        <nav class="main-nav" role="navigation" aria-label="Main Navigation">

            {{-- Logo + Links + Hamburger container --}}
            <div class="container-fluid px-3 px-lg-4 d-flex align-items-center justify-content-between w-100">

                <a class="navbar-brand" href="{{ route('home') }}" aria-label="GNIMT Home">
                    <img src="https://www.gurunanakinstitute.com/wp-content/themes/GNIMT/images/logo.png"
                        alt="Guru Nanak Institute of Medical Technology" width="56" height="56" loading="eager">
                    <div class="d-none d-sm-block">
                        <div class="bn1">Guru Nanak Institute</div>
                        <div class="bn2">of Medical Technology &nbsp;|&nbsp; UGC Recognised</div>
                    </div>
                </a>

                {{-- Desktop Nav Links --}}
                <ul class="nvl desk" id="mainNav" role="menubar">
                    <li role="none"><a href="{{ route('home') }}" role="menuitem"
                            @class(['active' => request()->routeIs('home')])>Home</a></li>
                    <li class="hm" data-mp="mp-about" role="none">
                        <a href="#" role="menuitem" aria-haspopup="true" aria-expanded="false">About Us <i
                                class="fas fa-chevron-down arr"></i></a>
                    </li>
                    <li class="hm" data-mp="mp-courses" role="none">
                        <a href="#" role="menuitem" aria-haspopup="true" aria-expanded="false">Courses <i
                                class="fas fa-chevron-down arr"></i></a>
                    </li>
                    <li class="hm" data-mp="mp-adm" role="none">
                        <a href="#" role="menuitem" aria-haspopup="true" aria-expanded="false">Admissions <i
                                class="fas fa-chevron-down arr"></i></a>
                    </li>
                    <li class="hd" data-dp="dp-ach" role="none">
                        <a href="#" role="menuitem" aria-haspopup="true" aria-expanded="false">Achievers <i
                                class="fas fa-chevron-down arr"></i></a>
                    </li>
                    {{-- <li role="none"><a href="{{ route('results') }}" role="menuitem">Results</a></li> --}}
                    <li class="hd" data-dp="dp-con" role="none">
                        <a href="#" role="menuitem" aria-haspopup="true" aria-expanded="false">Contact <i
                                class="fas fa-chevron-down arr"></i></a>
                    </li>
                </ul>

                {{-- Mobile: Apply + Hamburger --}}
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('admissions') }}" class="btn-app d-none d-sm-inline-block d-xl-none">Apply
                        Now</a>
                    <button class="ham" id="hamBtn" aria-label="Open menu" aria-expanded="false">
                        <span></span><span></span><span></span>
                    </button>
                </div>

            </div>



        </nav>

        {{-- MEGA: ABOUT --}}
        <div class="mega-panel" id="mp-about" role="region" aria-label="About Us Menu">
            <div class="row g-4">
                <div class="col-lg-3">
                    <div class="mch"><i class="fas fa-university"></i> Our Institution</div>
                    <a class="mlink" href="{{ route('about') }}#about"><i class="fas fa-dot-circle"></i> About GNIMT
                        &amp; Patiala</a>
                    <a class="mlink" href="{{ route('about') }}#directors-message"><i class="fas fa-dot-circle"></i>
                        Director's Message</a>
                    <a class="mlink" href="{{ route('about') }}#vision-mission"><i class="fas fa-dot-circle"></i>
                        Vision &amp; Mission</a>
                    <a class="mlink" href="{{ route('about') }}#infrastructure"><i class="fas fa-dot-circle"></i>
                        Infrastructure</a>
                    <a class="mlink" href="{{ route('about') }}#rules-regulations"><i class="fas fa-dot-circle"></i>
                        Rules &amp; Regulations</a>
                </div>
                <div class="col-lg-3">
                    <div class="mch"><i class="fas fa-newspaper"></i> Media &amp; Updates</div>
                    <a class="mlink" href="{{ route('media') }}"><i class="fas fa-dot-circle"></i> Media
                        Coverage</a>
                    <a class="mlink" href="{{ route('news') }}"><i class="fas fa-dot-circle"></i> News &amp;
                        Events</a>
                    <a class="mlink" href="{{ route('gallery') }}"><i class="fas fa-dot-circle"></i> GNIMT
                        Gallery</a>
                    <a class="mlink" href="{{ route('announcements') }}"><i class="fas fa-dot-circle"></i>
                        Announcements</a>
                </div>
                <div class="col-lg-3">
                    <div class="mch"><i class="fas fa-trophy"></i> Achievements</div>
                    <a class="mlink" href="{{ route('achievers') }}"><i class="fas fa-dot-circle"></i> Our
                        Achievers</a>
                    <a class="mlink" href="{{ route('testimonials') }}"><i class="fas fa-dot-circle"></i>
                        Testimonials</a>
                    <a class="mlink" href="{{ route('alumni') }}"><i class="fas fa-dot-circle"></i> Alumni
                        Network</a>
                    <a class="mlink" href="{{ route('placements') }}"><i class="fas fa-dot-circle"></i> Placement
                        Records</a>
                </div>
                <div class="col-lg-3">
                    <div class="fc">
                        <img src="{{ asset('images/campus-1.jpg') }}" alt="GNIMT Campus" loading="lazy"
                            onerror="this.style.display='none'">
                        <h5><i class="fas fa-award me-2"></i>UGC Recognised</h5>
                        <p>Decades of excellence. GNIMT produces skilled professionals placed in top hospitals across
                            India.</p>
                        <a href="{{ route('about') }}" class="fc-cta">Know More →</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- MEGA: COURSES --}}
        <div class="mega-panel" id="mp-courses" role="region" aria-label="Courses Menu">
            <div class="row g-4">
                <div class="col-lg-3">
                    <div class="mch"><i class="fas fa-graduation-cap"></i> Bachelor Degree (B.Voc.)</div>
                    @foreach ([['Operation Theatre Technology', 'courses.show', 'operation-theatre-technology'], ['Medical Lab Technology', 'courses.show', 'medical-lab-technology'], ['Ophthalmic Technology', 'courses.show', 'ophthalmic-technology'], ['Cardiac Care Technology', 'courses.show', 'cardiac-care-technology'], ['Dialysis Technology', 'courses.show', 'dialysis-technology'], ['Radiology &amp; Imaging', 'courses.show', 'radiology-imaging-technology'], ['Hospital Management', 'courses.show', 'hospital-management'], ['B.Voc Physiotherapy', 'courses.show', 'physiotherapy']] as [$name, $route, $slug])
                        <a class="mlink" href="{{ route($route, $slug) }}"><i class="fas fa-dot-circle"></i>
                            {!! $name !!}</a>
                    @endforeach
                </div>
                <div class="col-lg-3">
                    <div class="mch"><i class="fas fa-certificate"></i> Diploma Courses</div>
                    @foreach (['Medical Lab Technology (DMLT)', 'Operation Theatre Technology', 'X-Ray Technology', 'Ophthalmic Assistant', 'Cath Lab Technology', 'Electro Cardiography Technology', 'CT Scan Technology', 'MRI Scan Technology'] as $name)
                        <a class="mlink" href="{{ route('academics') }}#diploma"><i class="fas fa-dot-circle"></i>
                            {{ $name }}</a>
                    @endforeach
                </div>
                <div class="col-lg-3">
                    <div class="mch"><i class="fas fa-globe"></i> International Tie-up</div>
                    @foreach (['Digital Media Studies Advanced Diploma', 'ICT With Co-op', 'Business Fundamentals With Co-op', 'Business Hospitality Management', 'Tourism, Hospitality &amp; Services'] as $name)
                        <a class="mlink" href="{{ route('academics') }}#international"><i
                                class="fas fa-dot-circle"></i> {!! $name !!}</a>
                    @endforeach
                    <div class="mch mt"><i class="fas fa-plus-circle"></i> Other</div>
                    <a class="mlink" href="{{ route('academics') }}#other"><i class="fas fa-dot-circle"></i> Nanny
                        Course</a>
                    <a class="mlink" href="{{ route('academics') }}#other"><i class="fas fa-dot-circle"></i> First
                        Aid Specialist Diploma</a>
                </div>
                <div class="col-lg-3">
                    <div class="fc">
                        <img src="{{ asset('images/campus-2.jpg') }}" alt="GNIMT Courses" loading="lazy"
                            onerror="this.style.display='none'">
                        <h5><i class="fas fa-stethoscope me-2"></i>Start Your Medical Career</h5>
                        <p>Choose from 20+ healthcare programs with hands-on clinical training and 99.9% placement
                            support.</p>
                        <a href="{{ route('academics') }}" class="fc-cta">View All Courses →</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- MEGA: ADMISSIONS --}}
        <div class="mega-panel" id="mp-adm" role="region" aria-label="Admissions Menu">
            <div class="row g-4">
                <div class="col-lg-3">
                    <div class="mch"><i class="fas fa-file-alt"></i> Admission Process</div>
                    <a class="mlink" href="{{ route('admissions') }}#how-to-apply"><i
                            class="fas fa-dot-circle"></i> How to Apply?</a>
                    <a class="mlink" href="{{ route('admissions') }}#guidance"><i class="fas fa-dot-circle"></i>
                        Admission Guidance</a>
                    <a class="mlink" href="{{ route('admissions') }}#eligibility"><i class="fas fa-dot-circle"></i>
                        Eligibility Criteria</a>
                    <a class="mlink" href="{{ route('admissions') }}#fees"><i class="fas fa-dot-circle"></i> Fee
                        Structure</a>
                </div>
                <div class="col-lg-3">
                    <div class="mch"><i class="fas fa-info-circle"></i> Important Info</div>
                    <a class="mlink" href="{{ route('admissions') }}#rules"><i class="fas fa-dot-circle"></i> Rules
                        &amp; Regulations</a>
                    <a class="mlink" href="{{ route('admissions') }}#scholarship"><i class="fas fa-dot-circle"></i>
                        Scholarship Info</a>
                    <a class="mlink" href="{{ route('admissions') }}#dates"><i class="fas fa-dot-circle"></i>
                        Important Dates</a>
                    <a class="mlink" href="{{ route('admissions') }}#documents"><i class="fas fa-dot-circle"></i>
                        Documents Required</a>
                </div>
                <div class="col-lg-3">
                    <div class="mch"><i class="fas fa-map-marker-alt"></i> Our Branches</div>
                    <a class="mlink" href="{{ route('contact') }}#patiala"><i class="fas fa-dot-circle"></i>
                        Patiala Branch</a>
                    <a class="mlink" href="{{ route('contact') }}#karnal"><i class="fas fa-dot-circle"></i> Karnal
                        Branch</a>
                </div>
                <div class="col-lg-3">
                    <div class="fc">
                        <img src="{{ asset('images/campus-3.jpg') }}" alt="GNIMT Admissions" loading="lazy"
                            onerror="this.style.display='none'">
                        <h5><i class="fas fa-user-plus me-2"></i>Admissions Open 2025–26</h5>
                        <p>Limited seats available. Apply early to secure your admission in your preferred healthcare
                            program.</p>
                        <a href="{{ route('admissions') }}" class="fc-cta">Apply Now →</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- SIMPLE DROPS --}}
        <div class="drop-panel" id="dp-ach" role="menu">
            <a href="{{ route('achievers') }}" role="menuitem"><i class="fas fa-medal"></i> Our Achievers</a>
            <a href="{{ route('testimonials') }}" role="menuitem"><i class="fas fa-comment-alt"></i>
                Testimonials</a>
            <a href="{{ route('achievers') }}#govt-jobs" role="menuitem"><i class="fas fa-briefcase"></i> Students
                at Govt. Jobs</a>
            <a href="{{ route('achievers') }}#self-employed" role="menuitem"><i class="fas fa-user-tie"></i> Self
                Employed Students</a>
        </div>
        <div class="drop-panel" id="dp-con" role="menu">
            <a href="{{ route('contact') }}#patiala" role="menuitem"><i class="fas fa-map-pin"></i> Patiala
                Branch</a>
            <a href="{{ route('contact') }}#karnal" role="menuitem"><i class="fas fa-map-pin"></i> Karnal Branch</a>
        </div>

    </div>{{-- /sw --}}

    {{-- MOBILE DRAWER --}}
    <div class="d-ov" id="dov" aria-hidden="true"></div>
    <div class="drawer" id="drawer" role="dialog" aria-label="Mobile Navigation" aria-modal="true">
        <div class="d-head">
            <img src="{{ asset('images/logo.png') }}" alt="GNIMT" height="44"
                onerror="this.src='https://www.gurunanakinstitute.com/wp-content/themes/GNIMT/images/logo.png'">
            <button class="d-close" id="dClose" aria-label="Close menu"><i class="fas fa-times"></i></button>
        </div>
        <div class="d-body">
            <div class="dmi"><a class="dml" href="{{ route('home') }}">Home</a></div>
            <div class="dmi">
                <div class="dml" data-ds="ds-about">About Us <i class="fas fa-chevron-down da"></i></div>
                <div class="dms" id="ds-about">
                    <div class="dms-h">Institution</div>
                    <a href="{{ route('about') }}#about"><i class="fas fa-dot-circle"></i> About GNIMT</a>
                    <a href="{{ route('about') }}#directors-message"><i class="fas fa-dot-circle"></i> Director's
                        Message</a>
                    <a href="{{ route('about') }}#vision-mission"><i class="fas fa-dot-circle"></i> Vision &amp;
                        Mission</a>
                    <a href="{{ route('about') }}#infrastructure"><i class="fas fa-dot-circle"></i>
                        Infrastructure</a>
                    <a href="{{ route('about') }}#rules-regulations"><i class="fas fa-dot-circle"></i> Rules &amp;
                        Regulations</a>
                    <div class="dms-h">Media</div>
                    <a href="{{ route('gallery') }}"><i class="fas fa-dot-circle"></i> Gallery</a>
                    <a href="{{ route('news') }}"><i class="fas fa-dot-circle"></i> News &amp; Events</a>
                </div>
            </div>
            <div class="dmi">
                <div class="dml" data-ds="ds-courses">Courses <i class="fas fa-chevron-down da"></i></div>
                <div class="dms" id="ds-courses">
                    <div class="dms-h">Bachelor Degree (B.Voc.)</div>
                    <a href="{{ route('courses.show', 'operation-theatre-technology') }}"><i
                            class="fas fa-dot-circle"></i> OT Technology</a>
                    <a href="{{ route('courses.show', 'medical-lab-technology') }}"><i class="fas fa-dot-circle"></i>
                        Medical Lab Technology</a>
                    <a href="{{ route('courses.show', 'radiology-imaging-technology') }}"><i
                            class="fas fa-dot-circle"></i> Radiology &amp; Imaging</a>
                    <a href="{{ route('courses.show', 'cardiac-care-technology') }}"><i
                            class="fas fa-dot-circle"></i>
                        Cardiac Care</a>
                    <div class="dms-h">Diploma</div>
                    <a href="{{ route('academics') }}#diploma"><i class="fas fa-dot-circle"></i> DMLT</a>
                    <a href="{{ route('academics') }}#diploma"><i class="fas fa-dot-circle"></i> CT / MRI Scan</a>
                </div>
            </div>
            <div class="dmi">
                <div class="dml" data-ds="ds-adm">Admissions <i class="fas fa-chevron-down da"></i></div>
                <div class="dms" id="ds-adm">
                    <a href="{{ route('admissions') }}#how-to-apply"><i class="fas fa-dot-circle"></i> How to
                        Apply?</a>
                    <a href="{{ route('admissions') }}#eligibility"><i class="fas fa-dot-circle"></i> Eligibility</a>
                    <a href="{{ route('admissions') }}#fees"><i class="fas fa-dot-circle"></i> Fee Structure</a>
                </div>
            </div>
            <div class="dmi">
                <div class="dml" data-ds="ds-ach">Achievers <i class="fas fa-chevron-down da"></i></div>
                <div class="dms" id="ds-ach">
                    <a href="{{ route('achievers') }}"><i class="fas fa-dot-circle"></i> Our Achievers</a>
                    <a href="{{ route('testimonials') }}"><i class="fas fa-dot-circle"></i> Testimonials</a>
                </div>
            </div>
            <div class="dmi"><a class="dml" href="{{ route('results') }}">Results</a></div>
            <div class="dmi">
                <div class="dml" data-ds="ds-con">Contact <i class="fas fa-chevron-down da"></i></div>
                <div class="dms" id="ds-con">
                    <a href="{{ route('contact') }}#patiala"><i class="fas fa-map-pin"></i> Patiala</a>
                    <a href="{{ route('contact') }}#karnal"><i class="fas fa-map-pin"></i> Karnal</a>
                </div>
            </div>
            <div class="dmi"><a class="dml" href="{{ route('portal.login') }}"><i
                        class="fas fa-sign-in-alt"></i> Login Portal</a></div>
            <div class="dmi" style="padding:8px 20px;">
                <a href="tel:8283929908"
                    style="display:flex;align-items:center;gap:8px;color:#c0262d;font-weight:700;font-size:.85rem;text-decoration:none;">
                    <i class="fas fa-phone-alt"></i> Patiala: +91-8283929908
                </a>
            </div>
            <div class="dmi" style="padding:8px 20px 16px;">
                <a href="tel:8150019000"
                    style="display:flex;align-items:center;gap:8px;color:#c0262d;font-weight:700;font-size:.85rem;text-decoration:none;">
                    <i class="fas fa-phone-alt"></i> Karnal: +91-8150019000
                </a>
            </div>
        </div>
        <div class="d-cta">
            <a href="{{ route('admissions') }}" class="btn-app">Apply Now</a>
        </div>
    </div>

</header>
