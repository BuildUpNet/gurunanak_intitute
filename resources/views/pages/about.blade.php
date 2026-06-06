{{-- resources/views/pages/about.blade.php --}}
{{-- All about-related sections consolidated here. Sub-page routes redirect here with anchors. --}}
@extends('layouts.app')

@section('title', 'About Us | GNIMT – Guru Nanak Institute of Medical Technology')
@section('meta_description', 'Learn about GNIMT — established 1991, UGC recognised. Director\'s message, vision & mission, infrastructure, and rules & regulations.')

@section('content')

{{-- ─── PAGE HERO ─── --}}
<section class="abt-hero">
  <div class="abt-hero__inner">
    <span class="abt-hero__eyebrow">Est. 1991 &nbsp;·&nbsp; UGC Recognised &nbsp;·&nbsp; Patiala &amp; Karnal</span>
    <h1 class="abt-hero__h1">About <span>Guru Nanak Institute</span><br>of Medical Technology</h1>
    <p class="abt-hero__sub">Operating under the S.D. Public Health Educational and Research Society — three decades of excellence in allied health sciences.</p>
  </div>
  {{-- Inline section navigation --}}
  <nav class="abt-page-nav" aria-label="About page sections">
    <a href="#about"             class="abt-nav-link">About GNIMT</a>
    <a href="#highlights"        class="abt-nav-link">Key Highlights</a>
    <a href="#awards"            class="abt-nav-link">Awards</a>
    <a href="#directors-message" class="abt-nav-link">Director's Message</a>
    <a href="#vision-mission"    class="abt-nav-link">Vision &amp; Mission</a>
    <a href="#infrastructure"    class="abt-nav-link">Infrastructure</a>
    <a href="#rules-regulations" class="abt-nav-link">Rules &amp; Regulations</a>
  </nav>
</section>

{{-- ─── ABOUT GNIMT ─── --}}
<section id="about" class="abt-section abt-section--white">
  <div class="abt-ctr">
    <div class="abt-split">

      <div class="abt-split__img abt-img-stack rvl">
        <div class="abt-img-main">
          <img src="{{ asset('images/slides/Slide-Img-2.jpg') }}" alt="GNIMT Patiala Campus" loading="lazy">
        </div>
        <div class="abt-img-accent">
          <img src="{{ asset('images/slides/Slide-Img-3.jpg') }}" alt="GNIMT Students" loading="lazy">
        </div>
        <div class="abt-est-badge"><span class="abt-est-year">1991</span><span class="abt-est-label">Est. Year</span></div>
      </div>

      <div class="abt-split__content rvr">
        <span class="abt-eyebrow">Our Heritage &amp; Trust</span>
        <h2 class="abt-heading">Punjab's Premier<br><span>Medical Technology</span> Institute</h2>
        <p class="abt-body">Established in 1991 in Patiala, Punjab, Guru Nanak Institute of Medical Technology stands as a premier institution in the field of paramedical and healthcare education. Operating under the aegis of the S.D. Public Health Educational and Research Society, the institute has built a distinguished legacy spanning more than three decades, marked by academic distinction, professional integrity, and a sustained commitment to healthcare advancement.</p>
        <p class="abt-body" style="margin-top:14px">GNIMT has played a pioneering role in redefining paramedical education by creating inclusive, skill-oriented academic pathways — particularly for students from 10+2 Arts backgrounds — empowering thousands to transition into successful clinical and healthcare careers, contributing significantly to a skilled healthcare workforce in India and abroad.</p>
        <div class="abt-trust-row">
          @foreach(['UGC Recognised','NAAC Accredited University','99.9% Placement Support','International Tie-ups','33+ Years of Excellence','50+ Hospital Partners'] as $t)
            <span class="abt-trust-badge"><i class="fas fa-check-circle"></i>{{ $t }}</span>
          @endforeach
        </div>
        <div class="abt-actions">
          <a href="{{ route('admissions') }}" class="abt-btn abt-btn--red">Apply Now <i class="fas fa-arrow-right"></i></a>
          <a href="#directors-message" class="abt-btn abt-btn--outline">Director's Message</a>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ─── KEY HIGHLIGHTS ─── --}}
<section id="highlights" class="abt-section abt-section--light">
  <div class="abt-ctr">
    <div class="abt-sec-head rv" style="text-align:center;display:block">
      <span class="abt-eyebrow" style="justify-content:center">Why Choose GNIMT</span>
      <h2 class="abt-heading" style="margin-top:12px;text-align:center">Key <span>Highlights</span></h2>
      <p class="abt-body" style="margin:14px auto 0;text-align:center;max-width:600px">What makes Guru Nanak Institute of Medical Technology a trusted name in paramedical education for over 35 years.</p>
    </div>
    <div class="abt-hl-grid rv d1">
      @foreach([
        ['fas fa-history',           'Legacy of Excellence (Since 1991)',        'A distinguished institution with over 35 years of continuous contribution to paramedical education, academic quality, and healthcare skill development.'],
        ['fas fa-trophy',            'Pioneer in Paramedical Training',           'Recognized for its specialized focus on career-oriented paramedical programs designed to meet the evolving demands of the healthcare sector.'],
        ['fas fa-graduation-cap',    'Outcome-Based Education Model',            'A structured academic framework that integrates theoretical learning with intensive clinical and laboratory-based practical training.'],
        ['fas fa-hospital',          'Extensive Clinical Exposure',              'Students are trained in real-time hospital environments, diagnostic laboratories, and community healthcare settings to ensure professional competency.'],
        ['fas fa-users',             'Proven Track Record of Success',           'Thousands of trained professionals have graduated and are successfully contributing to healthcare systems nationally and internationally.'],
        ['fas fa-briefcase',         'Strong Employability & Placement Support', 'A dedicated approach toward career development ensuring every student is guided towards meaningful employment opportunities in healthcare.'],
        ['fas fa-chalkboard-teacher','Experienced & Qualified Faculty Team',     'Highly skilled educators and healthcare professionals committed to delivering academic excellence and professional mentorship.'],
        ['fas fa-hands-helping',     'Inclusive Educational Access',             'A strong commitment to providing quality education to students from diverse and economically weaker backgrounds.'],
        ['fas fa-book-open',         'Industry-Relevant Curriculum',             'Continuously updated academic programs aligned with current healthcare standards, technologies, and global best practices.'],
        ['fas fa-award',             'Recognition & Achievements',               'Recipient of multiple prestigious awards acknowledging excellence in paramedical education, training innovation, and institutional performance.'],
        ['fas fa-balance-scale',     'Ethics-Driven Learning Environment',       'Emphasis on discipline, compassion, professionalism, and ethical responsibility in healthcare practice.'],
        ['fas fa-user-graduate',     'Student-Centric Academic Ecosystem',       'A supportive learning environment focused on personal growth, confidence building, and lifelong career development.'],
      ] as [$icon, $title, $desc])
        <div class="abt-hl-card">
          <div class="abt-hl-icon"><i class="{{ $icon }}"></i></div>
          <h3 class="abt-hl-title">{{ $title }}</h3>
          <p class="abt-hl-desc">{{ $desc }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ─── AWARDS & RECOGNITIONS ─── --}}
<section id="awards" class="abt-section abt-section--white">
  <div class="abt-ctr">
    <div class="abt-sec-head rv" style="text-align:center;display:block">
      <span class="abt-eyebrow" style="justify-content:center">Our Achievements</span>
      <h2 class="abt-heading" style="margin-top:12px;text-align:center">Awards &amp; <span>Recognitions</span></h2>
      <p class="abt-body" style="margin:14px auto 0;text-align:center;max-width:600px">GNIMT's consistent contributions to healthcare education and skill development have been recognized through several prestigious national and international honors.</p>
    </div>
    <div class="abt-awards-row rv d1">
      @foreach([
        ['fas fa-medal',     '#c0262d', 'Punjab De No. 1 Award',                          '2009', 'Recognized as Punjab\'s premier paramedical institution, celebrating decades of educational excellence and lasting community impact.'],
        ['fas fa-globe',     '#1a3566', 'Global Achiever Award',                          '2014', 'Received at Dubai for global contributions to paramedical education, training innovation, and international healthcare development.'],
        ['fas fa-star',      '#c0262d', 'Pioneer in Paramedical Education Award',         '',     'Honoured for pioneering career-oriented paramedical programs and creating inclusive academic pathways for healthcare aspirants.'],
        ['fas fa-heartbeat', '#1a3566', 'Health Icon Award',                              '2024', 'Latest recognition for excellence in paramedical education, training innovation, and commitment to community service.'],
        ['fas fa-award',     '#c0262d', 'Excellence in Paramedical Educational Institute Award', '', 'Awarded for the unwavering pursuit of excellence, innovation in paramedical training, and institutional performance.'],
      ] as [$icon, $color, $title, $year, $desc])
        <div class="abt-award-card">
          <div class="abt-award-icon" style="background:{{ $color }}"><i class="{{ $icon }}"></i></div>
          @if($year)<span class="abt-award-year">{{ $year }}</span>@endif
          <h3 class="abt-award-title">{{ $title }}</h3>
          <p class="abt-award-desc">{{ $desc }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ─── DIRECTOR'S MESSAGE ─── --}}
<section id="directors-message" class="abt-section abt-section--light">
  <div class="abt-ctr">
    <div class="abt-split abt-split--dir">

      <div class="abt-dir-img rvl">
        <div class="abt-dir-frame">
          <img src="{{ asset('images/Dr.-Subhash-Dawar.jpg') }}" alt="Director — GNIMT" loading="lazy"
               onerror="this.src='{{ asset('images/slides/Slide-Img-1.jpg') }}'">
        </div>
        <div class="abt-dir-corner abt-dir-corner--tl"></div>
        <div class="abt-dir-corner abt-dir-corner--br"></div>
        <div class="abt-dir-name-card">
          <div class="abt-dir-name">S. Dr. Subhash Dawar</div>
          <div class="abt-dir-role">Director, GNIMT Patiala &amp; Karnal</div>
        </div>
      </div>

      <div class="abt-dir-content rvr">
        <span class="abt-eyebrow">Director's Message</span>
        <h2 class="abt-heading">Shaping the Future of<br><span>Allied Health Sciences</span></h2>
        <div class="abt-quote-mark" aria-hidden="true">"</div>
        <div class="abt-dir-quotes">
          <p class="abt-dir-quote">It is a matter of great pride and privilege to serve as the Director of Guru Nanak Institute of Medical Technology — a premier institution dedicated to excellence in paramedical education for over 35 remarkable years. Since its establishment in 1991, the institute has consistently upheld its mission of delivering quality education, skill-based training, and professional excellence in the healthcare sector.</p>
          <p class="abt-dir-quote">Over the decades, GNIMT has successfully trained thousands of students, transforming them into skilled and confident healthcare professionals. Our alumni are proudly serving in reputed hospitals, diagnostic laboratories, research centers, and healthcare organizations across India and abroad. This strong legacy reflects our unwavering commitment to academic excellence and practical, career-oriented learning.</p>
          <p class="abt-dir-quote">Our core strength lies in paramedical education, where we emphasize a balanced integration of theoretical knowledge and intensive hands-on clinical training. Through structured exposure in hospitals, laboratories, and community healthcare settings, we ensure that every student develops real-world competencies required in modern healthcare systems.</p>
          <p class="abt-dir-quote">At GNIMT, every student is guided, mentored, and empowered to achieve professional success. Our philosophy is clear — education must lead to opportunity, and opportunity must lead to dignity and independence. No student who trains here is left without direction or purpose; every effort is made to ensure they build a meaningful career in healthcare.</p>
          <blockquote class="abt-dir-signature-quote">"Success is not just about learning — it is about transforming knowledge into service that changes lives."</blockquote>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ─── VISION & MISSION ─── --}}
<section id="vision-mission" class="abt-section abt-section--navy">
  <div class="abt-ctr">
    <div class="abt-sec-head rv">
      <span class="abt-eyebrow abt-eyebrow--light">Our Foundation</span>
      <h2 class="abt-heading abt-heading--white" style="margin-top:12px">Vision &amp; <span style="color:#f87171">Mission</span></h2>
    </div>
    <div class="abt-vm-grid rv d1">
      <div class="abt-vm-card">
        <div class="abt-vm-icon"><i class="fas fa-eye"></i></div>
        <h3 class="abt-vm-title">Our Vision</h3>
        <p class="abt-vm-text">To become a transformative hub of paramedical education, recognized for producing globally competent healthcare professionals who combine scientific excellence with human compassion.</p>
      </div>
      <div class="abt-vm-card">
        <div class="abt-vm-icon"><i class="fas fa-bullseye"></i></div>
        <h3 class="abt-vm-title">Our Mission</h3>
        <ul class="abt-vm-list">
          <li>To provide high-quality paramedical education that combines academic excellence with practical clinical training.</li>
          <li>To develop skilled, confident, and job-ready healthcare professionals capable of meeting global healthcare standards.</li>
          <li>To promote hands-on learning through hospital-based training, laboratory exposure, and community healthcare programs.</li>
          <li>To ensure inclusive education by supporting students from diverse and economically weaker backgrounds.</li>
          <li>To foster a culture of discipline, ethics, compassion, and lifelong learning in healthcare practice.</li>
          <li>To strengthen employability by guiding students toward successful careers in hospitals, diagnostic centers, and healthcare institutions worldwide.</li>
          <li>To continuously upgrade teaching methodologies in line with modern advancements in medical science and technology.</li>
        </ul>
      </div>
    </div>
    <div class="abt-values rv d2">
      @foreach([
        ['fas fa-star','Excellence','Maintaining the highest standards in education and clinical training.'],
        ['fas fa-heart','Compassion','Producing healthcare professionals who lead with empathy and care.'],
        ['fas fa-flask','Innovation','Continuously modernizing labs and curriculum to meet industry demands.'],
        ['fas fa-handshake','Integrity','Upholding ethical conduct across all academic and professional interactions.'],
      ] as [$icon,$title,$desc])
        <div class="abt-value-item">
          <div class="abt-value-icon"><i class="{{ $icon }}"></i></div>
          <div class="abt-value-title">{{ $title }}</div>
          <div class="abt-value-desc">{{ $desc }}</div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ─── INFRASTRUCTURE ─── --}}
<section id="infrastructure" class="abt-section abt-section--white">
  <div class="abt-ctr">
    <div class="abt-sec-head rv" style="text-align:center;display:block">
      <span class="abt-eyebrow" style="justify-content:center">Our Facilities</span>
      <h2 class="abt-heading" style="margin-top:12px;text-align:center">Advanced Training <span>Infrastructure</span></h2>
      <p class="abt-body" style="margin:14px auto 0;text-align:center;max-width:580px">Our laboratory systems simulate real hospital operating environments, preparing students for critical clinical assignments from day one.</p>
    </div>
    <div class="abt-infra-grid rv d1">
      @foreach([
        ['fas fa-procedures','Operation Theatre Lab','Equipped with actual anesthesia setups, modern surgical lighting, autoclave machines, and vital tracking panels for advanced OT simulations.'],
        ['fas fa-vial','Medical Laboratory','Features advanced automated biochemistry setups, high-resolution micro-analysis arrays, histology apparatus, and clinical hematology tools.'],
        ['fas fa-x-ray','Radiology &amp; Diagnostic Imaging','Housing diagnostic imaging apparatus including mock X-ray systems, ultrasound modules, CT interfaces, and radiation safety protocol suites.'],
        ['fas fa-heartbeat','Cardiac Care Wing','Fitted with multi-lead ECG systems, cardiac tracking displays, defibrillator training assemblies, and intensive care monitoring infrastructure.'],
        ['fas fa-eye','Ophthalmic Lab','Complete ophthalmic equipment — slit lamp, retinoscope, tonometer, and visual acuity testing systems for eye care training.'],
        ['fas fa-tint','Dialysis Unit','Simulated haemodialysis setups, peritoneal dialysis training modules, and water treatment system training for dialysis technicians.'],
      ] as [$icon,$title,$desc])
        <div class="abt-infra-card">
          <div class="abt-infra-icon"><i class="{{ $icon }}"></i></div>
          <h3 class="abt-infra-title">{!! $title !!}</h3>
          <p class="abt-infra-desc">{!! $desc !!}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ─── RULES & REGULATIONS ─── --}}
<section id="rules-regulations" class="abt-section abt-section--light">
  <div class="abt-ctr">
    <div class="abt-sec-head rv" style="text-align:center;display:block">
      <span class="abt-eyebrow" style="justify-content:center">Campus Guidelines</span>
      <h2 class="abt-heading" style="margin-top:12px;text-align:center">Rules &amp; <span>Regulations</span></h2>
      <p class="abt-body" style="margin:14px auto 0;text-align:center;max-width:560px">Maintaining institutional decorum, safety standards, and academic excellence across all campuses.</p>
    </div>
    <div class="abt-rules-grid rv d1">
      @foreach([
        ['fas fa-user-check','Academic Attendance','Every student must secure a minimum of 75% attendance across all theoretical lectures and clinical training parameters to remain eligible for university examinations.'],
        ['fas fa-shield-virus','Laboratory Safety','Students must comply with clinical bio-safety codes. Proper laboratory coats, sterile protective equipment, and identification are mandatory within all training boundaries.'],
        ['fas fa-gavel','Professional Conduct','GNIMT operates strict anti-ragging measures. Any breach of campus decorum, damage to institutional infrastructure, or undisciplined behaviour faces strict disciplinary action.'],
        ['fas fa-clock','Punctuality','Strict punctuality in reporting to lectures, clinical labs, and hospital training rotations is expected and monitored by faculty supervisors.'],
        ['fas fa-mobile-alt','Device Policy','Mobile phones and personal devices are not permitted during clinical training sessions, lab work, or examinations. Violations result in disciplinary action.'],
        ['fas fa-id-badge','Dress Code','Institutional uniforms must be worn on campus at all times. During clinical postings, the prescribed uniform with ID card is compulsory.'],
      ] as [$icon,$title,$desc])
        <div class="abt-rule-card">
          <div class="abt-rule-icon"><i class="{{ $icon }}"></i></div>
          <div class="abt-rule-body">
            <h3 class="abt-rule-title">{{ $title }}</h3>
            <p class="abt-rule-desc">{{ $desc }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

@endsection

@section('styles')
<style>
/* ═══════ ABOUT PAGE — Dedicated CSS ═══════ */
/* Scroll offset for sticky header (~140px) */
section[id] { scroll-margin-top: 145px; }

/* Container */
.abt-ctr { max-width: 1280px; margin: 0 auto; padding: 0 60px; }

/* Eyebrow */
.abt-eyebrow {
    display: inline-flex; align-items: center; gap: 10px;
    font-size: .64rem; font-weight: 700; letter-spacing: .18em;
    text-transform: uppercase; color: #c0262d;
}
.abt-eyebrow::before {
    content: ''; width: 22px; height: 2px;
    background: #c0262d; border-radius: 1px; flex-shrink: 0;
}
.abt-eyebrow--light { color: rgba(255,255,255,.55); }
.abt-eyebrow--light::before { background: rgba(255,255,255,.45); }

/* Headings */
.abt-heading {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.9rem, 3vw, 2.7rem);
    font-weight: 700; color: #111827; line-height: 1.15;
    letter-spacing: -.018em; margin-top: 14px;
}
.abt-heading span { color: #c0262d; }
.abt-heading--white { color: #fff; }
.abt-body { font-size: .9rem; color: #4b5675; line-height: 1.85; }
.abt-sec-head { margin-bottom: 52px; }

/* Buttons */
.abt-btn {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: .84rem; font-weight: 600; padding: 13px 28px;
    border-radius: 5px; border: 2px solid transparent;
    text-decoration: none; transition: all .22s;
}
.abt-btn--red { background: #c0262d; border-color: #c0262d; color: #fff; }
.abt-btn--red:hover { background: #9b1e24; border-color: #9b1e24; color: #fff; transform: translateY(-2px); }
.abt-btn--outline { background: transparent; border-color: #1a3566; color: #1a3566; }
.abt-btn--outline:hover { background: #1a3566; color: #fff; }
.abt-actions { display: flex; gap: 12px; flex-wrap: wrap; margin-top: 28px; }

/* Reveal animations */
.rv  { opacity: 0; transform: translateY(28px); transition: opacity .7s cubic-bezier(.16,1,.3,1), transform .7s cubic-bezier(.16,1,.3,1); }
.rvl { opacity: 0; transform: translateX(-28px); transition: opacity .7s cubic-bezier(.16,1,.3,1), transform .7s cubic-bezier(.16,1,.3,1); }
.rvr { opacity: 0; transform: translateX(28px);  transition: opacity .7s cubic-bezier(.16,1,.3,1), transform .7s cubic-bezier(.16,1,.3,1); }
.rv.vis, .rvl.vis, .rvr.vis { opacity: 1; transform: none; }
.d1 { transition-delay: .12s } .d2 { transition-delay: .22s }

/* ── HERO ── */
.abt-hero {
    background: linear-gradient(135deg, #0b1f3a 0%, #1a3566 60%, #2a3f7a 100%);
    padding: 80px 0 0;
    position: relative;
    overflow: hidden;
}
.abt-hero::before {
    content: ''; position: absolute; top: -100px; right: -100px;
    width: 380px; height: 380px; border-radius: 50%;
    background: radial-gradient(circle, rgba(192,38,45,.2), transparent 70%);
    pointer-events: none;
}
.abt-hero__inner {
    max-width: 1280px; margin: 0 auto;
    padding: 0 60px 60px;
    position: relative; z-index: 1;
}
.abt-hero__eyebrow {
    font-size: .64rem; font-weight: 700; letter-spacing: .16em;
    text-transform: uppercase; color: rgba(255,255,255,.55);
    display: block; margin-bottom: 20px;
}
.abt-hero__h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.2rem, 4vw, 3.5rem);
    font-weight: 700; color: #fff;
    line-height: 1.1; letter-spacing: -.02em;
    margin-bottom: 18px;
}
.abt-hero__h1 span { color: #f87171; }
.abt-hero__sub {
    font-size: .92rem; color: rgba(255,255,255,.58);
    line-height: 1.8; max-width: 600px;
}

/* Page inline nav */
.abt-page-nav {
    max-width: 1280px; margin: 0 auto;
    padding: 0 60px;
    display: flex; align-items: center;
    border-top: 1px solid rgba(255,255,255,.1);
    overflow-x: auto;
    scrollbar-width: none;
}
.abt-page-nav::-webkit-scrollbar { display: none; }
.abt-nav-link {
    display: inline-block;
    padding: 16px 22px;
    font-size: .78rem; font-weight: 600;
    color: rgba(255,255,255,.55);
    text-decoration: none; white-space: nowrap;
    border-bottom: 3px solid transparent;
    transition: color .2s, border-color .2s;
    flex-shrink: 0;
}
.abt-nav-link:hover,
.abt-nav-link.active { color: #fff; border-bottom-color: #c0262d; }

/* ── SECTION backgrounds ── */
.abt-section { padding: 100px 0; }
.abt-section--white { background: #fff; }
.abt-section--light { background: #f4f7fd; border-top: 1px solid #dce5f5; }
.abt-section--navy  { background: #0b1f3a; }

/* ── SPLIT layout ── */
.abt-split {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
}
.abt-split--dir { grid-template-columns: 1fr 2fr; }

/* ── About image stack ── */
.abt-img-stack { position: relative; height: 500px; }
.abt-img-main {
    position: absolute; left: 0; top: 0;
    width: 76%; height: 86%;
    border-radius: 8px; overflow: hidden;
    box-shadow: 0 28px 72px rgba(11,31,58,.14);
}
.abt-img-main img, .abt-img-accent img { width: 100%; height: 100%; object-fit: cover; display: block; }
.abt-img-accent {
    position: absolute; right: 0; bottom: 0;
    width: 48%; height: 54%;
    border-radius: 8px; overflow: hidden;
    border: 6px solid #fff;
    box-shadow: 0 14px 44px rgba(11,31,58,.16);
}
.abt-img-stack::before {
    content: ''; position: absolute; left: -16px; top: 40px;
    width: 5px; height: 70%;
    background: #c0262d; border-radius: 3px;
}
.abt-est-badge {
    position: absolute; left: 18px; bottom: 86px;
    background: #c0262d; color: #fff;
    border-radius: 8px; padding: 18px 22px;
    text-align: center;
    box-shadow: 0 12px 40px rgba(192,38,45,.3);
    z-index: 2;
}
.abt-est-year {
    display: block; font-family: 'Playfair Display', serif;
    font-size: 2.1rem; font-weight: 700; line-height: 1;
}
.abt-est-label {
    display: block; font-size: .6rem; opacity: .88;
    letter-spacing: .1em; text-transform: uppercase; margin-top: 3px;
}

/* Trust badges */
.abt-trust-row { display: flex; flex-wrap: wrap; gap: 8px; margin: 26px 0 0; }
.abt-trust-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: #eef3fb; border: 1px solid #dce5f5;
    color: #1a3566; font-size: .72rem; font-weight: 600;
    padding: 7px 13px; border-radius: 4px;
}
.abt-trust-badge i { color: #c0262d; font-size: .73rem; }

/* ── Director section ── */
.abt-dir-img { position: relative; }
.abt-dir-frame { border-radius: 10px; overflow: hidden; height: 520px; }
.abt-dir-frame img { width: 100%; height: 100%; object-fit: cover; object-position: top; display: block; }
.abt-dir-corner { position: absolute; width: 54px; height: 54px; }
.abt-dir-corner--tl { top: -12px; left: -12px; border-top: 3px solid #c0262d; border-left: 3px solid #c0262d; }
.abt-dir-corner--br { bottom: -12px; right: -12px; border-bottom: 3px solid #c0262d; border-right: 3px solid #c0262d; }
.abt-dir-name-card {
    position: absolute; bottom: 24px; left: 50%;
    transform: translateX(-50%);
    background: rgba(11,31,58,.9); backdrop-filter: blur(8px);
    color: #fff; border-radius: 6px; padding: 14px 20px;
    text-align: center; white-space: nowrap;
    border-top: 3px solid #c0262d;
    min-width: 220px;
}
.abt-dir-name { font-family: 'Playfair Display', serif; font-size: 1.05rem; font-weight: 700; }
.abt-dir-role { font-size: .65rem; color: rgba(255,255,255,.6); letter-spacing: .08em; text-transform: uppercase; margin-top: 4px; }
.abt-quote-mark {
    font-family: 'Playfair Display', serif; font-size: 6rem;
    color: #c0262d; opacity: .12; line-height: .7;
    display: block; margin-bottom: 6px;
}
.abt-dir-quotes { display: flex; flex-direction: column; gap: 14px; }
.abt-dir-quote {
    font-size: .9rem; color: #4b5675; line-height: 1.9;
    border-left: 4px solid #c0262d; padding-left: 20px;
    margin: 0;
}

/* ── Vision & Mission ── */
.abt-vm-grid {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 24px; margin-bottom: 52px;
}
.abt-vm-card {
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 10px; padding: 40px 34px;
    transition: background .25s, transform .25s;
}
.abt-vm-card:hover { background: rgba(255,255,255,.1); transform: translateY(-4px); }
.abt-vm-icon {
    width: 60px; height: 60px; border-radius: 50%;
    background: rgba(192,38,45,.18);
    border: 2px solid rgba(192,38,45,.3);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem; color: #f87171;
    margin-bottom: 22px;
}
.abt-vm-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.35rem; font-weight: 700;
    color: #fff; margin-bottom: 14px;
}
.abt-vm-text { font-size: .88rem; color: rgba(255,255,255,.58); line-height: 1.88; }
/* Values row */
.abt-values {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 20px; padding-top: 20px;
    border-top: 1px solid rgba(255,255,255,.08);
}
.abt-value-item { text-align: center; padding: 24px 16px; }
.abt-value-icon {
    width: 52px; height: 52px; border-radius: 50%;
    background: rgba(255,255,255,.07);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem; color: rgba(255,255,255,.7);
    margin: 0 auto 14px;
}
.abt-value-title { font-size: .9rem; font-weight: 700; color: #fff; margin-bottom: 6px; }
.abt-value-desc  { font-size: .76rem; color: rgba(255,255,255,.45); line-height: 1.65; }

/* ── Infrastructure ── */
.abt-infra-grid {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 22px; margin-top: 52px;
}
.abt-infra-card {
    background: #f4f7fd; border: 1px solid #dce5f5;
    border-radius: 10px; padding: 32px 26px;
    transition: transform .25s, box-shadow .25s, background .25s;
    position: relative; overflow: hidden;
}
.abt-infra-card::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0;
    height: 3px; background: #c0262d;
    transform: scaleX(0); transition: transform .3s;
}
.abt-infra-card:hover { transform: translateY(-6px); box-shadow: 0 18px 50px rgba(11,31,58,.1); background: #fff; }
.abt-infra-card:hover::before { transform: scaleX(1); }
.abt-infra-icon {
    width: 56px; height: 56px; border-radius: 10px;
    background: linear-gradient(135deg, #0b1f3a, #1a3566);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem; color: #fff; margin-bottom: 18px;
    transition: background .25s;
}
.abt-infra-card:hover .abt-infra-icon { background: linear-gradient(135deg, #c0262d, #9b1e24); }
.abt-infra-title { font-size: .96rem; font-weight: 700; color: #111827; margin-bottom: 10px; }
.abt-infra-desc  { font-size: .79rem; color: #4b5675; line-height: 1.75; }

/* ── Key Highlights Grid (12 cards, 4-col) ── */
.abt-hl-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px; margin-top: 52px;
}
.abt-hl-card {
    background: #fff; border: 1px solid #dce5f5;
    border-radius: 10px; padding: 28px 22px;
    transition: transform .24s, box-shadow .24s;
    text-align: center;
}
.abt-hl-card:hover { transform: translateY(-5px); box-shadow: 0 14px 40px rgba(11,31,58,.1); }
.abt-hl-icon {
    width: 54px; height: 54px; border-radius: 50%;
    background: linear-gradient(135deg, #c0262d, #9b1e24);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.15rem; color: #fff;
    margin: 0 auto 16px;
}
.abt-hl-title { font-size: .88rem; font-weight: 700; color: #111827; margin-bottom: 8px; line-height: 1.35; }
.abt-hl-desc  { font-size: .76rem; color: #4b5675; line-height: 1.72; margin: 0; }

/* ── Awards Row (5 cards) ── */
.abt-awards-row {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 20px; margin-top: 52px;
}
.abt-award-card {
    background: #f4f7fd; border: 1px solid #dce5f5;
    border-radius: 10px; padding: 28px 20px 24px;
    text-align: center;
    transition: transform .24s, box-shadow .24s, background .24s;
    position: relative; overflow: hidden;
}
.abt-award-card::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0;
    height: 3px; background: #c0262d;
    transform: scaleX(0); transition: transform .3s;
}
.abt-award-card:hover { transform: translateY(-5px); box-shadow: 0 16px 44px rgba(11,31,58,.1); background: #fff; }
.abt-award-card:hover::before { transform: scaleX(1); }
.abt-award-icon {
    width: 60px; height: 60px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem; color: #fff;
    margin: 0 auto 14px;
}
.abt-award-year {
    display: inline-block;
    background: #1a3566; color: #fff;
    font-size: .62rem; font-weight: 700;
    letter-spacing: .1em; padding: 3px 10px;
    border-radius: 20px; margin-bottom: 10px;
}
.abt-award-title { font-size: .88rem; font-weight: 700; color: #111827; margin-bottom: 10px; line-height: 1.35; }
.abt-award-desc  { font-size: .75rem; color: #4b5675; line-height: 1.7; margin: 0; }

/* ── Director signature quote ── */
.abt-dir-signature-quote {
    font-family: 'Playfair Display', serif;
    font-size: 1.05rem; font-weight: 700;
    color: #c0262d; font-style: italic;
    border-left: none; padding: 18px 24px;
    background: rgba(192,38,45,.06);
    border-radius: 6px; margin: 8px 0 0;
    line-height: 1.6;
}

/* ── Mission list ── */
.abt-vm-list {
    list-style: none; padding: 0; margin: 0;
    display: flex; flex-direction: column; gap: 10px;
}
.abt-vm-list li {
    font-size: .84rem; color: rgba(255,255,255,.62);
    line-height: 1.7; padding-left: 20px;
    position: relative;
}
.abt-vm-list li::before {
    content: '›'; position: absolute; left: 0;
    color: #f87171; font-weight: 700; font-size: 1rem;
}

/* ── Rules ── */
.abt-rules-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 52px; }
.abt-rule-card {
    background: #fff; border: 1px solid #dce5f5;
    border-radius: 10px; padding: 28px 26px;
    display: flex; align-items: flex-start; gap: 18px;
    transition: transform .24s, box-shadow .24s;
}
.abt-rule-card:hover { transform: translateY(-4px); box-shadow: 0 12px 36px rgba(11,31,58,.09); }
.abt-rule-icon {
    width: 50px; height: 50px; border-radius: 50%;
    background: #c0262d; color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem; flex-shrink: 0;
}
.abt-rule-title { font-size: .94rem; font-weight: 700; color: #111827; margin-bottom: 8px; }
.abt-rule-desc  { font-size: .8rem; color: #4b5675; line-height: 1.75; margin: 0; }

/* ─── RESPONSIVE ─── */
@media (max-width: 1200px) {
    .abt-ctr { padding: 0 32px; }
    .abt-hero__inner, .abt-page-nav { padding-left: 32px; padding-right: 32px; }
}
@media (max-width: 1024px) {
    .abt-split, .abt-split--dir { grid-template-columns: 1fr; gap: 48px; }
    .abt-infra-grid { grid-template-columns: 1fr 1fr; }
    .abt-vm-grid { grid-template-columns: 1fr; }
    .abt-values { grid-template-columns: repeat(2, 1fr); }
    .abt-img-stack { height: 360px; }
    .abt-dir-frame { height: 380px; }
    .abt-hl-grid { grid-template-columns: repeat(3, 1fr); }
    .abt-awards-row { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 768px) {
    .abt-ctr { padding: 0 20px; }
    .abt-hero__inner, .abt-page-nav { padding-left: 20px; padding-right: 20px; }
    .abt-section { padding: 68px 0; }
    .abt-infra-grid { grid-template-columns: 1fr; }
    .abt-rules-grid { grid-template-columns: 1fr; }
    .abt-values { grid-template-columns: 1fr 1fr; }
    .abt-dir-name-card { white-space: normal; min-width: unset; }
    section[id] { scroll-margin-top: 160px; }
    .abt-hl-grid { grid-template-columns: repeat(2, 1fr); }
    .abt-awards-row { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 480px) {
    .abt-values { grid-template-columns: 1fr 1fr; }
    .abt-hero__h1 { font-size: clamp(1.8rem, 6vw, 2.4rem); }
    .abt-hl-grid { grid-template-columns: 1fr; }
    .abt-awards-row { grid-template-columns: 1fr; }
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    /* Scroll reveal */
    var ro = new IntersectionObserver(function(entries) {
        entries.forEach(function(e) { if (e.isIntersecting) { e.target.classList.add('vis'); ro.unobserve(e.target); } });
    }, { threshold: 0.1 });
    document.querySelectorAll('.rv,.rvl,.rvr').forEach(function(el) { ro.observe(el); });

    /* Active page-nav link on scroll */
    var links = document.querySelectorAll('.abt-nav-link');
    var sections = Array.from(links).map(function(l) { return document.querySelector(l.getAttribute('href')); }).filter(Boolean);
    var headerH = (document.querySelector('.site-header') || { offsetHeight: 140 }).offsetHeight;

    function setActive() {
        var scrollY = window.scrollY + headerH + 40;
        var active = sections[0];
        sections.forEach(function(s) { if (s.offsetTop <= scrollY) active = s; });
        links.forEach(function(l) {
            l.classList.toggle('active', l.getAttribute('href') === '#' + active.id);
        });
    }
    window.addEventListener('scroll', setActive, { passive: true });
    setActive();
});
</script>
@endsection
