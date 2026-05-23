{{-- partials/header.blade.php --}}
{{-- TOP BAR --}}
<div class="top-bar">
  <div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-1">
      <div class="d-flex align-items-center flex-wrap gap-1">
        <i class="fas fa-phone-alt me-1"></i>
        <a href="tel:8283929908">Patiala: +91-8283929908</a>
        <span class="sep">|</span>
        <a href="tel:8150019000">Karnal: +91-8150019000</a>
        <span class="sep d-none d-md-inline">|</span>
        <a href="mailto:info@gurunanakinstitute.com" class="d-none d-md-inline">
          <i class="fas fa-envelope me-1"></i>info@gurunanakinstitute.com
        </a>
      </div>
      <div class="d-flex align-items-center gap-2">
        <span class="d-none d-sm-inline" style="font-size:.75rem;">Follow us:</span>
        <div class="soc">
          <a href="https://www.facebook.com/Guru-Nanak-Institute-of-Medical-Technology-689772771089266" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="https://www.instagram.com/gnimtpatiala/" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
          <a href="#" target="_blank" rel="noopener" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- STICKY WRAPPER --}}
<div id="sw">
  <nav class="main-nav" role="navigation" aria-label="Main Navigation">
    <div class="container-fluid px-3 px-lg-4 d-flex align-items-center justify-content-between w-100">

      <a class="navbar-brand" href="{{ route('home') }}" aria-label="GNIMT Home">
        {{-- <img src="{{ asset('images/logo.png') }}" alt="Guru Nanak Institute of Medical Technology Logo" width="58" height="58" loading="eager"> --}}
        <img src="https://www.gurunanakinstitute.com/wp-content/themes/GNIMT/images/logo.png" alt="Guru Nanak Institute of Medical Technology Logo" width="58" height="58" loading="eager">
        <div class="d-none d-sm-block">
          <div class="bn1">Guru Nanak Institute</div>
          <div class="bn2">of Medical Technology &nbsp;|&nbsp; UGC Recognised</div>
        </div>
      </a>

      {{-- Desktop Navigation --}}
      <ul class="nvl desk" id="mainNav" role="menubar">
        <li role="none"><a href="{{ route('home') }}" role="menuitem" @class(['active' => request()->routeIs('home')])>Home</a></li>

        <li class="hm" data-mp="mp-about" role="none">
          <a href="#" role="menuitem" aria-haspopup="true" aria-expanded="false">
            About Us <i class="fas fa-chevron-down arr" aria-hidden="true"></i>
          </a>
        </li>

        <li class="hm" data-mp="mp-courses" role="none">
          <a href="#" role="menuitem" aria-haspopup="true" aria-expanded="false">
            Courses <i class="fas fa-chevron-down arr" aria-hidden="true"></i>
          </a>
        </li>

        <li class="hm" data-mp="mp-adm" role="none">
          <a href="#" role="menuitem" aria-haspopup="true" aria-expanded="false">
            Admissions <i class="fas fa-chevron-down arr" aria-hidden="true"></i>
          </a>
        </li>

        <li class="hd" data-dp="dp-ach" role="none">
          <a href="#" role="menuitem" aria-haspopup="true" aria-expanded="false">
            Achievers <i class="fas fa-chevron-down arr" aria-hidden="true"></i>
          </a>
        </li>

        <li role="none"><a href="{{ route('results') }}" role="menuitem">Results</a></li>

        <li class="hd" data-dp="dp-con" role="none">
          <a href="#" role="menuitem" aria-haspopup="true" aria-expanded="false">
            Contact <i class="fas fa-chevron-down arr" aria-hidden="true"></i>
          </a>
        </li>

        <li class="hd" data-dp="dp-login" role="none">
          <a href="#" role="menuitem" aria-haspopup="true" aria-expanded="false">
            Login <i class="fas fa-chevron-down arr" aria-hidden="true"></i>
          </a>
        </li>
      </ul>

      <div class="d-flex align-items-center gap-2 ms-2">
        <a href="{{ route('contact') }}" class="btn-enq d-none d-lg-inline-block">Enquire Now</a>
        <a href="{{ route('admissions') }}" class="btn-app d-none d-sm-inline-block">Apply Now</a>
        <button class="ham" id="hamBtn" aria-label="Open mobile menu" aria-expanded="false">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>
  </nav>

  {{-- MEGA: ABOUT --}}
  <div class="mega-panel" id="mp-about" role="region" aria-label="About Us Menu">
    <div class="row g-4">
      <div class="col-lg-3">
        <div class="mch"><i class="fas fa-university" aria-hidden="true"></i> Our Institution</div>
        <a class="mlink" href="{{ route('about') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> About GNIMT & Patiala</a>
        <a class="mlink" href="{{ route('about.director') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Director's Message</a>
        <a class="mlink" href="{{ route('about.vision') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Vision & Mission</a>
        <a class="mlink" href="{{ route('about.infrastructure') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Infrastructure</a>
        <a class="mlink" href="{{ route('about.rules') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Rules & Regulations</a>
      </div>
      <div class="col-lg-3">
        <div class="mch"><i class="fas fa-newspaper" aria-hidden="true"></i> Media & Updates</div>
        <a class="mlink" href="{{ route('media') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Media Coverage</a>
        <a class="mlink" href="{{ route('news') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> News & Events</a>
        <a class="mlink" href="{{ route('gallery') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> GNIMT Gallery</a>
        <a class="mlink" href="{{ route('announcements') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Announcements</a>
      </div>
      <div class="col-lg-3">
        <div class="mch"><i class="fas fa-trophy" aria-hidden="true"></i> Achievements</div>
        <a class="mlink" href="{{ route('achievers') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Our Achievers</a>
        <a class="mlink" href="{{ route('testimonials') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Testimonials</a>
        <a class="mlink" href="{{ route('alumni') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Alumni Network</a>
        <a class="mlink" href="{{ route('placements') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Placement Records</a>
      </div>
      <div class="col-lg-3">
        <div class="fc">
          <img src="{{ asset('images/campus-1.jpg') }}" alt="GNIMT Campus Patiala" loading="lazy" onerror="this.style.display='none'">
          <h5><i class="fas fa-award me-2" style="color:var(--gold)" aria-hidden="true"></i>UGC Recognised</h5>
          <p>Decades of excellence in healthcare education. GNIMT produces skilled professionals placed in top hospitals across India.</p>
          <a href="{{ route('about') }}" class="fc-cta">Know More →</a>
        </div>
      </div>
    </div>
  </div>

  {{-- MEGA: COURSES --}}
  <div class="mega-panel" id="mp-courses" role="region" aria-label="Courses Menu">
    <div class="row g-4">
      <div class="col-lg-3">
        <div class="mch"><i class="fas fa-graduation-cap" aria-hidden="true"></i> Bachelor Degree (B.Voc.)</div>
        @foreach([
          ['Operation Theatre Technology','courses.show','operation-theatre-technology'],
          ['Medical Lab Technology','courses.show','medical-lab-technology'],
          ['Ophthalmic Technology','courses.show','ophthalmic-technology'],
          ['Cardiac Care Technology','courses.show','cardiac-care-technology'],
          ['Dialysis Technology','courses.show','dialysis-technology'],
          ['Radiology & Imaging Technology','courses.show','radiology-imaging-technology'],
          ['Hospital Management','courses.show','hospital-management'],
          ['B.Voc Physiotherapy','courses.show','physiotherapy'],
        ] as [$name, $route, $slug])
          <a class="mlink" href="{{ route($route, $slug) }}">
            <i class="fas fa-dot-circle" aria-hidden="true"></i> {{ $name }}
          </a>
        @endforeach
      </div>
      <div class="col-lg-3">
        <div class="mch"><i class="fas fa-certificate" aria-hidden="true"></i> Diploma Courses</div>
        @foreach([
          'Medical Lab Technology (DMLT)','Operation Theatre Technology',
          'X-Ray Technology','Ophthalmic Assistant','Cath Lab Technology',
          'Electro Cardiography Technology','CT Scan Technology','MRI Scan Technology'
        ] as $name)
          <a class="mlink" href="{{ route('academics') }}#diploma">
            <i class="fas fa-dot-circle" aria-hidden="true"></i> {{ $name }}
          </a>
        @endforeach
      </div>
      <div class="col-lg-3">
        <div class="mch"><i class="fas fa-globe" aria-hidden="true"></i> International Tie-up</div>
        @foreach([
          'Digital Media Studies Advanced Diploma','ICT With Co-op',
          'Business Fundamentals With Co-op','Business Hospitality Management',
          'Tourism, Hospitality & Services'
        ] as $name)
          <a class="mlink" href="{{ route('academics') }}#international">
            <i class="fas fa-dot-circle" aria-hidden="true"></i> {{ $name }}
          </a>
        @endforeach
        <div class="mch mt"><i class="fas fa-plus-circle" aria-hidden="true"></i> Other</div>
        <a class="mlink" href="{{ route('academics') }}#other"><i class="fas fa-dot-circle" aria-hidden="true"></i> Nanny Course</a>
        <a class="mlink" href="{{ route('academics') }}#other"><i class="fas fa-dot-circle" aria-hidden="true"></i> First Aid Specialist Diploma</a>
      </div>
      <div class="col-lg-3">
        <div class="fc">
          <img src="{{ asset('images/campus-2.jpg') }}" alt="GNIMT Medical Technology Courses" loading="lazy" onerror="this.style.display='none'">
          <h5><i class="fas fa-stethoscope me-2" style="color:var(--gold)" aria-hidden="true"></i>Start Your Medical Career</h5>
          <p>Choose from 20+ healthcare programs with hands-on clinical training and 99.9% placement support.</p>
          <a href="{{ route('academics') }}" class="fc-cta">View All Courses →</a>
        </div>
      </div>
    </div>
  </div>

  {{-- MEGA: ADMISSIONS --}}
  <div class="mega-panel" id="mp-adm" role="region" aria-label="Admissions Menu">
    <div class="row g-4">
      <div class="col-lg-3">
        <div class="mch"><i class="fas fa-file-alt" aria-hidden="true"></i> Admission Process</div>
        <a class="mlink" href="{{ route('admissions') }}#how-to-apply"><i class="fas fa-dot-circle" aria-hidden="true"></i> How to Apply?</a>
        <a class="mlink" href="{{ route('admissions') }}#guidance"><i class="fas fa-dot-circle" aria-hidden="true"></i> Admission Guidance</a>
        <a class="mlink" href="{{ route('admissions') }}#eligibility"><i class="fas fa-dot-circle" aria-hidden="true"></i> Eligibility Criteria</a>
        <a class="mlink" href="{{ route('admissions') }}#fees"><i class="fas fa-dot-circle" aria-hidden="true"></i> Fee Structure</a>
      </div>
      <div class="col-lg-3">
        <div class="mch"><i class="fas fa-info-circle" aria-hidden="true"></i> Important Info</div>
        <a class="mlink" href="{{ route('admissions') }}#rules"><i class="fas fa-dot-circle" aria-hidden="true"></i> Rules & Regulations</a>
        <a class="mlink" href="{{ route('admissions') }}#scholarship"><i class="fas fa-dot-circle" aria-hidden="true"></i> Scholarship Info</a>
        <a class="mlink" href="{{ route('admissions') }}#dates"><i class="fas fa-dot-circle" aria-hidden="true"></i> Important Dates</a>
        <a class="mlink" href="{{ route('admissions') }}#documents"><i class="fas fa-dot-circle" aria-hidden="true"></i> Documents Required</a>
      </div>
      <div class="col-lg-3">
        <div class="mch"><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Our Branches</div>
        <a class="mlink" href="{{ route('contact') }}#patiala"><i class="fas fa-dot-circle" aria-hidden="true"></i> Patiala Branch</a>
        <a class="mlink" href="{{ route('contact') }}#karnal"><i class="fas fa-dot-circle" aria-hidden="true"></i> Karnal Branch</a>
      </div>
      <div class="col-lg-3">
        <div class="fc">
          <img src="{{ asset('images/campus-3.jpg') }}" alt="GNIMT Admissions 2025-26" loading="lazy" onerror="this.style.display='none'">
          <h5><i class="fas fa-user-plus me-2" style="color:var(--gold)" aria-hidden="true"></i>Admissions Open 2025–26</h5>
          <p>Limited seats available. Apply early to secure your admission in your preferred healthcare program.</p>
          <a href="{{ route('admissions') }}" class="fc-cta">Apply Now →</a>
        </div>
      </div>
    </div>
  </div>

  {{-- SIMPLE DROPS --}}
  <div class="drop-panel" id="dp-ach" role="menu" aria-label="Achievers">
    <a href="{{ route('achievers') }}" role="menuitem"><i class="fas fa-medal" aria-hidden="true"></i> Our Achievers</a>
    <a href="{{ route('testimonials') }}" role="menuitem"><i class="fas fa-comment-alt" aria-hidden="true"></i> Testimonials</a>
    <a href="{{ route('achievers') }}#govt-jobs" role="menuitem"><i class="fas fa-briefcase" aria-hidden="true"></i> Students at Govt. Jobs</a>
    <a href="{{ route('achievers') }}#self-employed" role="menuitem"><i class="fas fa-user-tie" aria-hidden="true"></i> Self Employed Students</a>
  </div>

  <div class="drop-panel" id="dp-con" role="menu" aria-label="Contact">
    <a href="{{ route('contact') }}#patiala" role="menuitem"><i class="fas fa-map-pin" aria-hidden="true"></i> Patiala Branch</a>
    <a href="{{ route('contact') }}#karnal" role="menuitem"><i class="fas fa-map-pin" aria-hidden="true"></i> Karnal Branch</a>
  </div>

  <div class="drop-panel" id="dp-login" role="menu" aria-label="Login Options">
    <a href="https://portal.gurunanakinstitute.com/admin/login" role="menuitem"><i class="fas fa-user-shield" aria-hidden="true"></i> Admin Login</a>
    <a href="https://portal.gurunanakinstitute.com/student/login" role="menuitem"><i class="fas fa-user-graduate" aria-hidden="true"></i> Student Login</a>
    <a href="https://portal.gurunanakinstitute.com/branch/login" role="menuitem"><i class="fas fa-building" aria-hidden="true"></i> Branch Login</a>
    <a href="https://portal.gurunanakinstitute.com/branch/staff/login" role="menuitem"><i class="fas fa-users" aria-hidden="true"></i> Staff Login</a>
  </div>

</div>{{-- /sw --}}

{{-- MOBILE DRAWER --}}
<div class="d-ov" id="dov" aria-hidden="true"></div>
<div class="drawer" id="drawer" role="dialog" aria-label="Mobile Navigation" aria-modal="true">
  <div class="d-head">
    <img src="{{ asset('images/logo.png') }}" alt="GNIMT" height="44">
    <button class="d-close" id="dClose" aria-label="Close menu"><i class="fas fa-times" aria-hidden="true"></i></button>
  </div>
  <div class="d-body">
    <div class="dmi"><a class="dml" href="{{ route('home') }}">Home</a></div>

    <div class="dmi">
      <div class="dml" data-ds="ds-about">About Us <i class="fas fa-chevron-down da" aria-hidden="true"></i></div>
      <div class="dms" id="ds-about">
        <div class="dms-h">Institution</div>
        <a href="{{ route('about') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> About GNIMT</a>
        <a href="{{ route('about.director') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Director's Message</a>
        <a href="{{ route('about.vision') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Vision & Mission</a>
        <div class="dms-h">Media</div>
        <a href="{{ route('gallery') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Gallery</a>
        <a href="{{ route('news') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> News & Events</a>
        <a href="{{ route('achievers') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Achievements</a>
      </div>
    </div>

    <div class="dmi">
      <div class="dml" data-ds="ds-courses">Courses <i class="fas fa-chevron-down da" aria-hidden="true"></i></div>
      <div class="dms" id="ds-courses">
        <div class="dms-h">Bachelor Degree (B.Voc.)</div>
        <a href="{{ route('courses.show','operation-theatre-technology') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Operation Theatre Technology</a>
        <a href="{{ route('courses.show','medical-lab-technology') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Medical Lab Technology</a>
        <a href="{{ route('courses.show','ophthalmic-technology') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Ophthalmic Technology</a>
        <a href="{{ route('courses.show','cardiac-care-technology') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Cardiac Care Technology</a>
        <a href="{{ route('courses.show','dialysis-technology') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Dialysis Technology</a>
        <a href="{{ route('courses.show','radiology-imaging-technology') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Radiology & Imaging</a>
        <div class="dms-h">Diploma</div>
        <a href="{{ route('academics') }}#diploma"><i class="fas fa-dot-circle" aria-hidden="true"></i> DMLT</a>
        <a href="{{ route('academics') }}#diploma"><i class="fas fa-dot-circle" aria-hidden="true"></i> X-Ray Technology</a>
        <a href="{{ route('academics') }}#diploma"><i class="fas fa-dot-circle" aria-hidden="true"></i> CT / MRI Scan</a>
      </div>
    </div>

    <div class="dmi">
      <div class="dml" data-ds="ds-adm">Admissions <i class="fas fa-chevron-down da" aria-hidden="true"></i></div>
      <div class="dms" id="ds-adm">
        <a href="{{ route('admissions') }}#how-to-apply"><i class="fas fa-dot-circle" aria-hidden="true"></i> How to Apply?</a>
        <a href="{{ route('admissions') }}#eligibility"><i class="fas fa-dot-circle" aria-hidden="true"></i> Eligibility Criteria</a>
        <a href="{{ route('admissions') }}#fees"><i class="fas fa-dot-circle" aria-hidden="true"></i> Fee Structure</a>
        <a href="{{ route('admissions') }}#dates"><i class="fas fa-dot-circle" aria-hidden="true"></i> Important Dates</a>
      </div>
    </div>

    <div class="dmi">
      <div class="dml" data-ds="ds-ach">Achievers <i class="fas fa-chevron-down da" aria-hidden="true"></i></div>
      <div class="dms" id="ds-ach">
        <a href="{{ route('achievers') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Our Achievers</a>
        <a href="{{ route('testimonials') }}"><i class="fas fa-dot-circle" aria-hidden="true"></i> Testimonials</a>
        <a href="{{ route('achievers') }}#govt-jobs"><i class="fas fa-dot-circle" aria-hidden="true"></i> Govt. Job Students</a>
      </div>
    </div>

    <div class="dmi"><a class="dml" href="{{ route('results') }}">Results</a></div>

    <div class="dmi">
      <div class="dml" data-ds="ds-con">Contact <i class="fas fa-chevron-down da" aria-hidden="true"></i></div>
      <div class="dms" id="ds-con">
        <a href="{{ route('contact') }}#patiala"><i class="fas fa-map-pin" aria-hidden="true"></i> Patiala Branch</a>
        <a href="{{ route('contact') }}#karnal"><i class="fas fa-map-pin" aria-hidden="true"></i> Karnal Branch</a>
      </div>
    </div>

    <div class="dmi">
      <div class="dml" data-ds="ds-login">Login <i class="fas fa-chevron-down da" aria-hidden="true"></i></div>
      <div class="dms" id="ds-login">
        <a href="https://portal.gurunanakinstitute.com/admin/login"><i class="fas fa-user-shield" aria-hidden="true"></i> Admin Login</a>
        <a href="https://portal.gurunanakinstitute.com/student/login"><i class="fas fa-user-graduate" aria-hidden="true"></i> Student Login</a>
        <a href="https://portal.gurunanakinstitute.com/branch/login"><i class="fas fa-building" aria-hidden="true"></i> Branch Login</a>
        <a href="https://portal.gurunanakinstitute.com/branch/staff/login"><i class="fas fa-users" aria-hidden="true"></i> Staff Login</a>
      </div>
    </div>
  </div>
  <div class="d-cta">
    <a href="{{ route('contact') }}" class="btn-enq">Enquire Now</a>
    <a href="{{ route('admissions') }}" class="btn-app">Apply Now</a>
  </div>
</div>
