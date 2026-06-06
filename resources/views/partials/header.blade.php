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

        {{-- MEGA: ABOUT — Two-panel flyout --}}
        <div class="mega-panel mp2" id="mp-about" role="region" aria-label="About Us Menu">
            <div class="mp2-wrap">

                <nav class="mp2-cats" aria-label="About categories">
                    <div class="mp2-cat active" data-cat="mp2-institution" role="button" tabindex="0">
                        <i class="fas fa-university mp2-icon"></i>
                        <span>Our Institution</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>
                    <div class="mp2-cat" data-cat="mp2-media" role="button" tabindex="0">
                        <i class="fas fa-newspaper mp2-icon"></i>
                        <span>Media &amp; Updates</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>
                    <div class="mp2-cat" data-cat="mp2-achievements" role="button" tabindex="0">
                        <i class="fas fa-trophy mp2-icon"></i>
                        <span>Achievements</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>
                </nav>

                <div class="mp2-content">
                    {{-- Our Institution --}}
                    <div class="mp2-panel active" id="mp2-institution">
                        <div class="mp2-panel-hd"><i class="fas fa-university"></i><h4>Our Institution</h4></div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-2">
                            <a class="mlink" href="{{ route('about') }}#about"><i class="fas fa-dot-circle"></i> About GNIMT &amp; Patiala</a>
                            <a class="mlink" href="{{ route('about') }}#directors-message"><i class="fas fa-dot-circle"></i> Director's Message</a>
                            <a class="mlink" href="{{ route('about') }}#vision-mission"><i class="fas fa-dot-circle"></i> Vision &amp; Mission</a>
                            <a class="mlink" href="{{ route('about') }}#infrastructure"><i class="fas fa-dot-circle"></i> Infrastructure</a>
                            <a class="mlink" href="{{ route('about') }}#rules-regulations"><i class="fas fa-dot-circle"></i> Rules &amp; Regulations</a>
                        </div>
                        <div class="mp2-apply"><a href="{{ route('about') }}" class="fc-cta">Know More →</a></div>
                    </div>

                    {{-- Media & Updates --}}
                    <div class="mp2-panel" id="mp2-media">
                        <div class="mp2-panel-hd"><i class="fas fa-newspaper"></i><h4>Media &amp; Updates</h4></div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-2">
                            <a class="mlink" href="{{ route('media') }}"><i class="fas fa-dot-circle"></i> Media Coverage</a>
                            <a class="mlink" href="{{ route('news') }}"><i class="fas fa-dot-circle"></i> News &amp; Events</a>
                            <a class="mlink" href="{{ route('gallery') }}"><i class="fas fa-dot-circle"></i> GNIMT Gallery</a>
                            <a class="mlink" href="{{ route('announcements') }}"><i class="fas fa-dot-circle"></i> Announcements</a>
                        </div>
                        <div class="mp2-apply"><a href="{{ route('news') }}" class="fc-cta">Latest News →</a></div>
                    </div>

                    {{-- Achievements --}}
                    <div class="mp2-panel" id="mp2-achievements">
                        <div class="mp2-panel-hd"><i class="fas fa-trophy"></i><h4>Achievements</h4></div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-2">
                            <a class="mlink" href="{{ route('achievers') }}"><i class="fas fa-dot-circle"></i> Our Achievers</a>
                            <a class="mlink" href="{{ route('testimonials') }}"><i class="fas fa-dot-circle"></i> Testimonials</a>
                            <a class="mlink" href="{{ route('alumni') }}"><i class="fas fa-dot-circle"></i> Alumni Network</a>
                            <a class="mlink" href="{{ route('placements') }}"><i class="fas fa-dot-circle"></i> Placement Records</a>
                        </div>
                        <div class="mp2-apply"><a href="{{ route('achievers') }}" class="fc-cta">Our Achievers →</a></div>
                    </div>
                </div>

            </div>
        </div>

        {{-- MEGA: COURSES — Two-panel flyout (left: school categories | right: courses on hover) --}}
        <div class="mega-panel mp2" id="mp-courses" role="region" aria-label="Courses Menu">
            <div class="mp2-wrap">

                {{-- ── LEFT: School category list ── --}}
                <nav class="mp2-cats" aria-label="School categories">

                    <div class="mp2-cat active" data-cat="mp2-allied" role="button" tabindex="0">
                        <i class="fas fa-stethoscope mp2-icon"></i>
                        <span>School of Allied Health Sciences</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>

                    <div class="mp2-cat" data-cat="mp2-healthcare" role="button" tabindex="0">
                        <i class="fas fa-hospital mp2-icon"></i>
                        <span>School of Healthcare Management &amp; Community Health</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>

                    <div class="mp2-cat" data-cat="mp2-dental" role="button" tabindex="0">
                        <i class="fas fa-tooth mp2-icon"></i>
                        <span>School of Dental Sciences</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>

                    <div class="mp2-cat" data-cat="mp2-ayurveda" role="button" tabindex="0">
                        <i class="fas fa-leaf mp2-icon"></i>
                        <span>School of Ayurveda &amp; Wellness Sciences</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>

                    <div class="mp2-cat" data-cat="mp2-design" role="button" tabindex="0">
                        <i class="fas fa-palette mp2-icon"></i>
                        <span>School of Design &amp; Fashion Technology</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>

                    <div class="mp2-cat" data-cat="mp2-management" role="button" tabindex="0">
                        <i class="fas fa-chart-line mp2-icon"></i>
                        <span>School of Management &amp; Commerce</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>

                    <div class="mp2-cat" data-cat="mp2-computer" role="button" tabindex="0">
                        <i class="fas fa-laptop mp2-icon"></i>
                        <span>School of Computer Applications</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>

                    <div class="mp2-cat" data-cat="mp2-humanities" role="button" tabindex="0">
                        <i class="fas fa-book mp2-icon"></i>
                        <span>School of Humanities &amp; Social Sciences</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>

                    <div class="mp2-cat" data-cat="mp2-journalism" role="button" tabindex="0">
                        <i class="fas fa-newspaper mp2-icon"></i>
                        <span>School of Journalism &amp; Mass Communication</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>

                    <div class="mp2-cat" data-cat="mp2-library" role="button" tabindex="0">
                        <i class="fas fa-book-open mp2-icon"></i>
                        <span>School of Library &amp; Information Sciences</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>

                    <div class="mp2-cat" data-cat="mp2-hospitality" role="button" tabindex="0">
                        <i class="fas fa-hotel mp2-icon"></i>
                        <span>School of Hospitality, Tourism &amp; Travel Management</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>

                </nav>

                {{-- ── RIGHT: Course panels (shown on hover) ── --}}
                <div class="mp2-content">

                    {{-- Allied Health Sciences --}}
                    <div class="mp2-panel active" id="mp2-allied">
                        <div class="mp2-panel-hd">
                            <i class="fas fa-stethoscope"></i>
                            <h4>School of Allied Health Sciences</h4>
                        </div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid">
                            <a class="mlink" href="{{ route('courses.show', 'physiotherapy') }}"><i class="fas fa-dot-circle"></i> Physiotherapy</a>
                            <a class="mlink" href="{{ route('courses.show', 'medical-lab-technology') }}"><i class="fas fa-dot-circle"></i> Medical Lab Technology</a>
                            <a class="mlink" href="{{ route('courses.show', 'radiology-imaging-technology') }}"><i class="fas fa-dot-circle"></i> Radiology &amp; Medical Imaging Technology</a>
                            <a class="mlink" href="{{ route('courses.show', 'operation-theatre-technology') }}"><i class="fas fa-dot-circle"></i> OT &amp; Anaesthesia Technology</a>
                            <a class="mlink" href="{{ route('courses.show', 'cardiac-care-technology') }}"><i class="fas fa-dot-circle"></i> Cardiac Care Technology</a>
                            <a class="mlink" href="{{ route('courses.show', 'dialysis-technology') }}"><i class="fas fa-dot-circle"></i> Dialysis Technology</a>
                            <a class="mlink" href="{{ route('courses.show', 'ophthalmic-technology') }}"><i class="fas fa-dot-circle"></i> Optometry Technology</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Emergency &amp; Trauma Care</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Critical Care Management</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Hospital Sterilization Technology</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> CMS &amp; ED</a>
                        </div>
                        <div class="mp2-apply">
                            <a href="{{ route('academics') }}" class="fc-cta">View All Programs →</a>
                            <a href="{{ route('admissions') }}" class="fc-cta mp2-apply-enq">Apply Now →</a>
                        </div>
                    </div>

                    {{-- Healthcare Management --}}
                    <div class="mp2-panel" id="mp2-healthcare">
                        <div class="mp2-panel-hd">
                            <i class="fas fa-hospital"></i>
                            <h4>School of Healthcare Management &amp; Community Health</h4>
                        </div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid">
                            <a class="mlink" href="{{ route('courses.show', 'hospital-management') }}"><i class="fas fa-dot-circle"></i> Hospital Management</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Hospital Administration</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Patient Care Management</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Hospital Waste Management</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Health &amp; Sanitary Inspector</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Multipurpose Health Worker</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Community Care Provider</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Home Care Provider</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Nanny Training</a>
                        </div>
                        <div class="mp2-apply">
                            <a href="{{ route('academics') }}" class="fc-cta">View All Programs →</a>
                            <a href="{{ route('admissions') }}" class="fc-cta mp2-apply-enq">Apply Now →</a>
                        </div>
                    </div>

                    {{-- Dental Sciences --}}
                    <div class="mp2-panel" id="mp2-dental">
                        <div class="mp2-panel-hd">
                            <i class="fas fa-tooth"></i>
                            <h4>School of Dental Sciences</h4>
                        </div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-2">
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Dental Chair Side Assistant</a>
                        </div>
                        <div class="mp2-apply">
                            <a href="{{ route('admissions') }}" class="fc-cta mp2-apply-enq">Apply Now →</a>
                        </div>
                    </div>

                    {{-- Ayurveda & Wellness --}}
                    <div class="mp2-panel" id="mp2-ayurveda">
                        <div class="mp2-panel-hd">
                            <i class="fas fa-leaf"></i>
                            <h4>School of Ayurveda &amp; Wellness Sciences</h4>
                        </div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-2">
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Panchkarma</a>
                        </div>
                        <div class="mp2-apply">
                            <a href="{{ route('admissions') }}" class="fc-cta mp2-apply-enq">Apply Now →</a>
                        </div>
                    </div>

                    {{-- Design & Fashion --}}
                    <div class="mp2-panel" id="mp2-design">
                        <div class="mp2-panel-hd">
                            <i class="fas fa-palette"></i>
                            <h4>School of Design &amp; Fashion Technology</h4>
                        </div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-2">
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Fashion Technology</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Textile Designing</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Interior Designing</a>
                        </div>
                        <div class="mp2-apply">
                            <a href="{{ route('admissions') }}" class="fc-cta mp2-apply-enq">Apply Now →</a>
                        </div>
                    </div>

                    {{-- Management & Commerce --}}
                    <div class="mp2-panel" id="mp2-management">
                        <div class="mp2-panel-hd">
                            <i class="fas fa-chart-line"></i>
                            <h4>School of Management &amp; Commerce</h4>
                        </div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-2">
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Bachelor of Business Administration (BBA)</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Master of Business Administration (MBA)</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Bachelor of Commerce (B.Com.)</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Master of Commerce (M.Com.)</a>
                        </div>
                        <div class="mp2-apply">
                            <a href="{{ route('admissions') }}" class="fc-cta mp2-apply-enq">Apply Now →</a>
                        </div>
                    </div>

                    {{-- Computer Applications --}}
                    <div class="mp2-panel" id="mp2-computer">
                        <div class="mp2-panel-hd">
                            <i class="fas fa-laptop"></i>
                            <h4>School of Computer Applications</h4>
                        </div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-2">
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Master of Computer Applications (MCA)</a>
                        </div>
                        <div class="mp2-apply">
                            <a href="{{ route('admissions') }}" class="fc-cta mp2-apply-enq">Apply Now →</a>
                        </div>
                    </div>

                    {{-- Humanities & Social Sciences --}}
                    <div class="mp2-panel" id="mp2-humanities">
                        <div class="mp2-panel-hd">
                            <i class="fas fa-book"></i>
                            <h4>School of Humanities &amp; Social Sciences</h4>
                        </div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-2">
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Bachelor of Arts (BA)</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> MA in Hindi</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> MA in English</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> MA in Punjabi</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> MA in Political Science</a>
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> MA in History</a>
                        </div>
                        <div class="mp2-apply">
                            <a href="{{ route('admissions') }}" class="fc-cta mp2-apply-enq">Apply Now →</a>
                        </div>
                    </div>

                    {{-- Journalism & Mass Communication --}}
                    <div class="mp2-panel" id="mp2-journalism">
                        <div class="mp2-panel-hd">
                            <i class="fas fa-newspaper"></i>
                            <h4>School of Journalism &amp; Mass Communication</h4>
                        </div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-2">
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Master of Journalism &amp; Mass Communication (MJMC)</a>
                        </div>
                        <div class="mp2-apply">
                            <a href="{{ route('admissions') }}" class="fc-cta mp2-apply-enq">Apply Now →</a>
                        </div>
                    </div>

                    {{-- Library & Information Sciences --}}
                    <div class="mp2-panel" id="mp2-library">
                        <div class="mp2-panel-hd">
                            <i class="fas fa-book-open"></i>
                            <h4>School of Library &amp; Information Sciences</h4>
                        </div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-2">
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Master of Library &amp; Information Science (MLISc)</a>
                        </div>
                        <div class="mp2-apply">
                            <a href="{{ route('admissions') }}" class="fc-cta mp2-apply-enq">Apply Now →</a>
                        </div>
                    </div>

                    {{-- Hospitality, Tourism & Travel Management --}}
                    <div class="mp2-panel" id="mp2-hospitality">
                        <div class="mp2-panel-hd">
                            <i class="fas fa-hotel"></i>
                            <h4>School of Hospitality, Tourism &amp; Travel Management</h4>
                        </div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-2">
                            <a class="mlink" href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Master of Tourism &amp; Travel Management (MTTM)</a>
                        </div>
                        <div class="mp2-apply">
                            <a href="{{ route('admissions') }}" class="fc-cta mp2-apply-enq">Apply Now →</a>
                        </div>
                    </div>

                </div>{{-- /mp2-content --}}
            </div>{{-- /mp2-wrap --}}
        </div>{{-- /mp-courses --}}

        {{-- MEGA: ADMISSIONS — Two-panel flyout --}}
        <div class="mega-panel mp2" id="mp-adm" role="region" aria-label="Admissions Menu">
            <div class="mp2-wrap">

                <nav class="mp2-cats" aria-label="Admissions categories">
                    <div class="mp2-cat active" data-cat="mp2-process" role="button" tabindex="0">
                        <i class="fas fa-file-alt mp2-icon"></i>
                        <span>Admission Process</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>
                    <div class="mp2-cat" data-cat="mp2-info" role="button" tabindex="0">
                        <i class="fas fa-info-circle mp2-icon"></i>
                        <span>Important Info</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>
                    <div class="mp2-cat" data-cat="mp2-branches" role="button" tabindex="0">
                        <i class="fas fa-map-marker-alt mp2-icon"></i>
                        <span>Our Branches</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>
                </nav>

                <div class="mp2-content">
                    {{-- Admission Process --}}
                    <div class="mp2-panel active" id="mp2-process">
                        <div class="mp2-panel-hd"><i class="fas fa-file-alt"></i><h4>Admission Process</h4></div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-2">
                            <a class="mlink" href="{{ route('admissions') }}#how-to-apply"><i class="fas fa-dot-circle"></i> How to Apply?</a>
                            <a class="mlink" href="{{ route('admissions') }}#guidance"><i class="fas fa-dot-circle"></i> Admission Guidance</a>
                            <a class="mlink" href="{{ route('admissions') }}#eligibility"><i class="fas fa-dot-circle"></i> Eligibility Criteria</a>
                            <a class="mlink" href="{{ route('admissions') }}#fees"><i class="fas fa-dot-circle"></i> Fee Structure</a>
                        </div>
                        <div class="mp2-apply">
                            <a href="{{ route('admissions') }}" class="fc-cta">Apply Now →</a>
                        </div>
                    </div>

                    {{-- Important Info --}}
                    <div class="mp2-panel" id="mp2-info">
                        <div class="mp2-panel-hd"><i class="fas fa-info-circle"></i><h4>Important Info</h4></div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-2">
                            <a class="mlink" href="{{ route('admissions') }}#rules"><i class="fas fa-dot-circle"></i> Rules &amp; Regulations</a>
                            <a class="mlink" href="{{ route('admissions') }}#scholarship"><i class="fas fa-dot-circle"></i> Scholarship Info</a>
                            <a class="mlink" href="{{ route('admissions') }}#dates"><i class="fas fa-dot-circle"></i> Important Dates</a>
                            <a class="mlink" href="{{ route('admissions') }}#documents"><i class="fas fa-dot-circle"></i> Documents Required</a>
                        </div>
                        <div class="mp2-apply">
                            <a href="{{ route('admissions') }}" class="fc-cta">View Details →</a>
                        </div>
                    </div>

                    {{-- Our Branches --}}
                    <div class="mp2-panel" id="mp2-branches">
                        <div class="mp2-panel-hd"><i class="fas fa-map-marker-alt"></i><h4>Our Branches</h4></div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-2">
                            <a class="mlink" href="{{ route('contact') }}#patiala"><i class="fas fa-dot-circle"></i> Patiala Branch</a>
                            <a class="mlink" href="{{ route('contact') }}#karnal"><i class="fas fa-dot-circle"></i> Karnal Branch</a>
                        </div>
                        <div class="mp2-apply">
                            <a href="{{ route('contact') }}" class="fc-cta">Contact Us →</a>
                            <a href="{{ route('admissions') }}" class="fc-cta mp2-apply-enq">Apply Now →</a>
                        </div>
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

    {{-- ══════════════════════════════════════
     ANNOUNCEMENT TICKER  (rbuchd.in style)
══════════════════════════════════════ --}}
    <div class="ann-ticker" aria-label="Announcements">
        <div class="ann-label">
            <i class="fas fa-bullhorn"></i>
            <span>Announcement</span>
        </div>
        <div class="ann-marquee-wrap">
            <div class="ann-marquee">
                <span>Admissions Open 2025–26 – Limited seats available. Apply Early!</span>
                <span class="ann-sep">|</span>
                <span>GNIMT – <strong>Health Icon Award 2024</strong> Winner – Excellence in Paramedical Education</span>
                <span class="ann-sep">|</span>
                <span>Established 1991 – Trusted by <strong>35,000+ Students</strong> across India &amp; Abroad</span>
                <span class="ann-sep">|</span>
                <span>Punjab De No. 1 Paramedical Institute – <strong>UGC Recognised</strong></span>
                <span class="ann-sep">|</span>
                <span>Patiala Helpline: <a href="tel:8283929908">+91-8283929908</a> &nbsp;|&nbsp; Karnal Helpline: <a href="tel:8150019000">+91-8150019000</a></span>
                <span class="ann-sep">|</span>
                <span>Pioneer in Paramedical Education Award &amp; Global Achiever Award, Dubai (2014)</span>
                <span class="ann-sep">|</span>
                {{-- duplicate for seamless infinite loop --}}
                <span>Admissions Open 2025–26 – Limited seats available. Apply Early!</span>
                <span class="ann-sep">|</span>
                <span>GNIMT – <strong>Health Icon Award 2024</strong> Winner – Excellence in Paramedical Education</span>
                <span class="ann-sep">|</span>
                <span>Established 1991 – Trusted by <strong>35,000+ Students</strong> across India &amp; Abroad</span>
                <span class="ann-sep">|</span>
                <span>Punjab De No. 1 Paramedical Institute – <strong>UGC Recognised</strong></span>
                <span class="ann-sep">|</span>
                <span>Patiala Helpline: <a href="tel:8283929908">+91-8283929908</a> &nbsp;|&nbsp; Karnal Helpline: <a href="tel:8150019000">+91-8150019000</a></span>
                <span class="ann-sep">|</span>
                <span>Pioneer in Paramedical Education Award &amp; Global Achiever Award, Dubai (2014)</span>
                <span class="ann-sep">|</span>
            </div>
        </div>
    </div>

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
                    <div class="dms-h">School of Allied Health Sciences</div>
                    <a href="{{ route('courses.show', 'physiotherapy') }}"><i class="fas fa-dot-circle"></i> Physiotherapy</a>
                    <a href="{{ route('courses.show', 'medical-lab-technology') }}"><i class="fas fa-dot-circle"></i> Medical Lab Technology</a>
                    <a href="{{ route('courses.show', 'radiology-imaging-technology') }}"><i class="fas fa-dot-circle"></i> Radiology &amp; Medical Imaging</a>
                    <a href="{{ route('courses.show', 'operation-theatre-technology') }}"><i class="fas fa-dot-circle"></i> OT &amp; Anaesthesia Technology</a>
                    <a href="{{ route('courses.show', 'cardiac-care-technology') }}"><i class="fas fa-dot-circle"></i> Cardiac Care Technology</a>
                    <a href="{{ route('courses.show', 'dialysis-technology') }}"><i class="fas fa-dot-circle"></i> Dialysis Technology</a>
                    <a href="{{ route('courses.show', 'ophthalmic-technology') }}"><i class="fas fa-dot-circle"></i> Optometry Technology</a>
                    <a href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Emergency &amp; Trauma Care</a>
                    <a href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Critical Care Management</a>
                    <div class="dms-h">School of Healthcare Management</div>
                    <a href="{{ route('courses.show', 'hospital-management') }}"><i class="fas fa-dot-circle"></i> Hospital Management</a>
                    <a href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Hospital Administration</a>
                    <a href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Patient Care Management</a>
                    <a href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Nanny Training</a>
                    <div class="dms-h">Design, Management &amp; Others</div>
                    <a href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Fashion Technology</a>
                    <a href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> BBA / MBA / B.Com. / M.Com.</a>
                    <a href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> MCA</a>
                    <a href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Dental Chair Side Assistant</a>
                    <a href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Panchkarma</a>
                    <a href="{{ route('academics') }}" style="font-weight:700;color:var(--red)"><i class="fas fa-arrow-right"></i> View All Programs</a>
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
