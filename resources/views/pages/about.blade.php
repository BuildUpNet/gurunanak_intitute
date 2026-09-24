{{-- resources/views/pages/about.blade.php --}}
{{-- All about-related sections consolidated here. Sub-page routes redirect here with anchors. --}}
@extends('layouts.app')

@section('title', 'About Us | GNIMT – Guru Nanak Institute of Medical Technology')
@section('meta_description',
    'Learn about GNIMT — established 1991, UGC recognised. Director\'s message, vision &
    mission, infrastructure, and rules & regulations.')

@section('content')

    {{-- ─── PAGE HERO ─── --}}
    <section class="abt-hero">
        <div class="abt-hero__inner">
            <span class="abt-hero__eyebrow">Est. 1991 &nbsp;·&nbsp; UGC Recognised &nbsp;·&nbsp; Patiala &amp; Karnal</span>
            <h1 class="abt-hero__h1">About <span>Guru Nanak Institute</span><br>of Medical Technology</h1>
            <p class="abt-hero__sub">Operating under the S.D. Public Health Educational and Research Society — three decades
                of excellence in allied health sciences.</p>
        </div>

    </section>

    {{-- ─── ABOUT GNIMT ─── --}}
    <section id="about" class="abt-section abt-section--white">
        <div class="abt-ctr">
            <div class="abt-split">

                <div class="abt-split__img abt-img-stack rvl">
                    <div class="abt-img-main">
                        @if($aboutMainImage)
                            <img src="{{ asset('storage/' . $aboutMainImage->image) }}"
                                 alt="{{ $aboutMainImage->alt_text ?? 'GNIMT Patiala Campus' }}" loading="lazy">
                        @else
                            <img src="{{ asset('images/slides/Slide-Img-2.jpg') }}"
                                 alt="GNIMT Patiala Campus" loading="lazy">
                        @endif
                    </div>
                    <div class="abt-img-accent">
                        @if($aboutAccentImage)
                            <img src="{{ asset('storage/' . $aboutAccentImage->image) }}"
                                 alt="{{ $aboutAccentImage->alt_text ?? 'GNIMT Students' }}" loading="lazy">
                        @else
                            <img src="{{ asset('images/slides/Slide-Img-3.jpg') }}"
                                 alt="GNIMT Students" loading="lazy">
                        @endif
                    </div>
                    <div class="abt-est-badge"><span class="abt-est-year">1991</span><span class="abt-est-label">Est.
                            Year</span></div>
                </div>

                <div class="abt-split__content rvr">
                    <span class="abt-eyebrow">Our Heritage &amp; Trust</span>
                    <h2 class="abt-heading">Punjab's Premier<br><span>Medical Technology</span> Institute</h2>
                    <p class="abt-body">Established in 1991 in Patiala, Punjab, Guru Nanak Institute of Medical Technology
                        stands as a premier institution in the field of paramedical and healthcare education. Operating
                        under the aegis of the S.D. Public Health Educational and Research Society, the institute has built
                        a distinguished legacy spanning more than three decades, marked by academic distinction,
                        professional integrity, and a sustained commitment to healthcare advancement.</p>
                    <p class="abt-body" style="margin-top:14px">GNIMT has played a pioneering role in redefining paramedical
                        education by creating inclusive, skill-oriented academic pathways — particularly for students from
                        10+2 Arts backgrounds — empowering thousands to transition into successful clinical and healthcare
                        careers, contributing significantly to a skilled healthcare workforce in India and abroad.</p>
                    <div class="abt-trust-row">
                        @foreach (['UGC Recognised', 'NAAC Accredited University', '99.9% Placement Support', 'International Tie-ups', '33+ Years of Excellence', '50+ Hospital Partners'] as $t)
                            <span class="abt-trust-badge"><i class="fas fa-check-circle"></i>{{ $t }}</span>
                        @endforeach
                    </div>
                    <div class="abt-actions">
                        <a href="{{ route('admissions') }}" class="abt-btn abt-btn--red">Apply Now <i
                                class="fas fa-arrow-right"></i></a>
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
                <p class="abt-body" style="margin:14px auto 0;text-align:center;max-width:600px">What makes Guru Nanak
                    Institute of Medical Technology a trusted name in paramedical education for over 35 years.</p>
            </div>
            <div class="abt-hl-grid rv d1">
                @foreach ([
            ['fas fa-history', 'Legacy of Excellence (Since 1991)', 'A distinguished institution with over 35 years of continuous contribution to paramedical education, academic quality, and healthcare skill development.'],
            ['fas fa-trophy', 'Pioneer in Paramedical Training', 'Recognized for its specialized focus on career-oriented paramedical programs designed to meet the evolving demands of the healthcare sector.'],
            ['fas fa-graduation-cap', 'Outcome-Based Education Model', 'A structured academic framework that integrates theoretical learning with intensive clinical and laboratory-based practical training.'],
            ['fas fa-hospital', 'Extensive Clinical Exposure', 'Students are trained in real-time hospital environments, diagnostic laboratories, and community healthcare settings to ensure professional competency.'],
            ['fas fa-users', 'Proven Track Record of Success', 'Thousands of trained professionals have graduated and are successfully contributing to healthcare systems nationally and internationally.'],
            ['fas fa-briefcase', 'Strong Employability & Placement Support', 'A dedicated approach toward career development ensuring every student is guided towards meaningful employment opportunities in healthcare.'],
            ['fas fa-chalkboard-teacher', 'Experienced & Qualified Faculty Team', 'Highly skilled educators and healthcare professionals committed to delivering academic excellence and professional mentorship.'],
            ['fas fa-hands-helping', 'Inclusive Educational Access', 'A strong commitment to providing quality education to students from diverse and economically weaker backgrounds.'],
            ['fas fa-book-open', 'Industry-Relevant Curriculum', 'Continuously updated academic programs aligned with current healthcare standards, technologies, and global best practices.'],
            ['fas fa-award', 'Recognition & Achievements', 'Recipient of multiple prestigious awards acknowledging excellence in paramedical education, training innovation, and institutional performance.'],
            ['fas fa-balance-scale', 'Ethics-Driven Learning Environment', 'Emphasis on discipline, compassion, professionalism, and ethical responsibility in healthcare practice.'],
            ['fas fa-user-graduate', 'Student-Centric Academic Ecosystem', 'A supportive learning environment focused on personal growth, confidence building, and lifelong career development.'],
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

    {{-- ─── AWARDS & RECOGNITIONS (dynamic — admin/awards, image side alternates per section) ─── --}}
    @if ($awards->isNotEmpty())
        <section id="awards" class="abt-section abt-section--white">
            <div class="abt-ctr">
                <div class="abt-sec-head abt-awards-head rv">
                    <span class="abt-eyebrow">Our Achievements</span>
                    <h2 class="abt-heading">Awards &amp; <span>Recognitions</span></h2>
                    <p class="abt-body">GNIMT's consistent contributions to healthcare education and skill development
                        have been recognized through several prestigious national and international honors.</p>
                </div>

                <div class="abt-award-list">
                    @foreach ($awards as $award)
                        <article class="abt-award-row {{ $loop->even ? 'abt-award-row--reverse' : '' }}">
                            <div class="abt-award-row__media {{ $loop->even ? 'rvr' : 'rvl' }}">
                                @if ($award->image)
                                    <img src="{{ asset('uploads/awards/' . $award->image) }}" alt="{{ $award->title }}"
                                        loading="lazy">
                                @else
                                    <div class="abt-award-row__placeholder"><i class="fas fa-award"></i></div>
                                @endif
                                <span class="abt-award-row__num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <div class="abt-award-row__content {{ $loop->even ? 'rvl' : 'rvr' }}">
                                @if ($award->subtitle)
                                    <span class="abt-award-row__tag">{{ $award->subtitle }}</span>
                                @endif
                                <h3 class="abt-award-row__title">{{ $award->title }}</h3>
                                @if ($award->description)
                                    <div class="abt-award-row__desc">{!! $award->description !!}</div>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

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
                        <p class="abt-dir-quote">It is a matter of great pride and privilege to serve as the Director of
                            Guru Nanak Institute of Medical Technology — a premier institution dedicated to excellence in
                            paramedical education for over 35 remarkable years. Since its establishment in 1991, the
                            institute has consistently upheld its mission of delivering quality education, skill-based
                            training, and professional excellence in the healthcare sector.</p>
                        <p class="abt-dir-quote">Over the decades, GNIMT has successfully trained thousands of students,
                            transforming them into skilled and confident healthcare professionals. Our alumni are proudly
                            serving in reputed hospitals, diagnostic laboratories, research centers, and healthcare
                            organizations across India and abroad. This strong legacy reflects our unwavering commitment to
                            academic excellence and practical, career-oriented learning.</p>
                        <p class="abt-dir-quote">Our core strength lies in paramedical education, where we emphasize a
                            balanced integration of theoretical knowledge and intensive hands-on clinical training. Through
                            structured exposure in hospitals, laboratories, and community healthcare settings, we ensure
                            that every student develops real-world competencies required in modern healthcare systems.</p>
                        <p class="abt-dir-quote">At GNIMT, every student is guided, mentored, and empowered to achieve
                            professional success. Our philosophy is clear — education must lead to opportunity, and
                            opportunity must lead to dignity and independence. No student who trains here is left without
                            direction or purpose; every effort is made to ensure they build a meaningful career in
                            healthcare.</p>
                        <blockquote class="abt-dir-signature-quote">"Success is not just about learning — it is about
                            transforming knowledge into service that changes lives."</blockquote>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ─── VISION & MISSION ─── --}}
    <section id="vision-mission" class="abt-section abt-section--navy">
        <div class="abt-ctr">

            <div class="abt-sec-head rv" style="text-align:center;display:block">
                <span class="abt-eyebrow abt-eyebrow--light" style="justify-content:center">Our Foundation</span>
                <h2 class="abt-heading abt-heading--white" style="margin-top:12px;text-align:center">Vision &amp; <span
                        style="color:#f87171">Mission</span></h2>
                <p style="text-align:center;color:rgba(255,255,255,.5);font-size:.88rem;margin:14px auto 0;max-width:560px;line-height:1.8;">The guiding principles behind three decades of excellence in paramedical education.</p>
            </div>

            <div class="vm-panel rv d1">

                {{-- Vision (dark panel) --}}
                <div class="vm-v">
                    <div class="vm-v__deco">"</div>
                    <div class="vm-v__icon"><i class="fas fa-eye"></i></div>
                    <p class="vm-v__label">Our Vision</p>
                    <p class="vm-v__text">To become a transformative hub of paramedical education, recognized for
                        producing globally competent healthcare professionals who combine scientific excellence with human
                        compassion.</p>
                    <div class="vm-v__foot">
                        <span class="vm-v__loc"><i class="fas fa-map-marker-alt"></i>&nbsp; Patiala &amp; Karnal</span>
                        <span class="vm-v__est">Est. 1991</span>
                    </div>
                </div>

                {{-- Mission (white panel) --}}
                <div class="vm-m">
                    <div class="vm-m__icon"><i class="fas fa-bullseye"></i></div>
                    <p class="vm-m__label">Our Mission</p>
                    <ol class="vm-mlist">
                        <li>To provide high-quality paramedical education that combines academic excellence with practical
                            clinical training.</li>
                        <li>To develop skilled, confident, and job-ready healthcare professionals capable of meeting global
                            healthcare standards.</li>
                        <li>To promote hands-on learning through hospital-based training, laboratory exposure, and community
                            healthcare programs.</li>
                        <li>To ensure inclusive education by supporting students from diverse and economically weaker
                            backgrounds.</li>
                        <li>To foster a culture of discipline, ethics, compassion, and lifelong learning in healthcare
                            practice.</li>
                        <li>To strengthen employability by guiding students toward successful careers in hospitals,
                            diagnostic centers, and healthcare institutions worldwide.</li>
                        <li>To continuously upgrade teaching methodologies in line with modern advancements in medical
                            science and technology.</li>
                    </ol>
                </div>

            </div>

            {{-- Core Values --}}
            <div class="abt-values rv d2">
                @foreach ([['fas fa-star', 'Excellence', 'Maintaining the highest standards in education and clinical training.'], ['fas fa-heart', 'Compassion', 'Producing healthcare professionals who lead with empathy and care.'], ['fas fa-flask', 'Innovation', 'Continuously modernizing labs and curriculum to meet industry demands.'], ['fas fa-handshake', 'Integrity', 'Upholding ethical conduct across all academic and professional interactions.']] as [$icon, $title, $desc])
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
                <h2 class="abt-heading" style="margin-top:12px;text-align:center">Advanced Training
                    <span>Infrastructure</span>
                </h2>
                <p class="abt-body" style="margin:14px auto 0;text-align:center;max-width:580px">Our laboratory systems
                    simulate real hospital operating environments, preparing students for critical clinical assignments from
                    day one.</p>
            </div>
            <div class="abt-infra-grid rv d1">
                @foreach ([
            ['fas fa-procedures', 'Operation Theatre Lab', 'Equipped with actual anesthesia setups, modern surgical lighting, autoclave machines, and vital tracking panels for advanced OT simulations.'],
            ['fas fa-vial', 'Medical Laboratory', 'Features advanced automated biochemistry setups, high-resolution micro-analysis arrays, histology apparatus, and clinical hematology tools.'],
            ['fas fa-x-ray', 'Radiology &amp; Diagnostic Imaging', 'Housing diagnostic imaging apparatus including mock X-ray systems, ultrasound modules, CT interfaces, and radiation safety protocol suites.'],
            ['fas fa-heartbeat', 'Cardiac Care Wing', 'Fitted with multi-lead ECG systems, cardiac tracking displays, defibrillator training assemblies, and intensive care monitoring infrastructure.'],
            ['fas fa-eye', 'Ophthalmic Lab', 'Complete ophthalmic equipment — slit lamp, retinoscope, tonometer, and visual acuity testing systems for eye care training.'],
            ['fas fa-tint', 'Dialysis Unit', 'Simulated haemodialysis setups, peritoneal dialysis training modules, and water treatment system training for dialysis technicians.'],
        ] as [$icon, $title, $desc])
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
                <h2 class="abt-heading" style="margin-top:12px;text-align:center">Rules &amp; <span>Regulations</span>
                </h2>
                <p class="abt-body" style="margin:14px auto 0;text-align:center;max-width:560px">Maintaining institutional
                    decorum, safety standards, and academic excellence across all campuses.</p>
            </div>
            <div class="abt-rules-grid rv d1">
                @foreach ([
            ['fas fa-user-check', 'Academic Attendance', 'Every student must secure a minimum of 75% attendance across all theoretical lectures and clinical training parameters to remain eligible for university examinations.'],
            ['fas fa-shield-virus', 'Laboratory Safety', 'Students must comply with clinical bio-safety codes. Proper laboratory coats, sterile protective equipment, and identification are mandatory within all training boundaries.'],
            ['fas fa-gavel', 'Professional Conduct', 'GNIMT operates strict anti-ragging measures. Any breach of campus decorum, damage to institutional infrastructure, or undisciplined behaviour faces strict disciplinary action.'],
            ['fas fa-clock', 'Punctuality', 'Strict punctuality in reporting to lectures, clinical labs, and hospital training rotations is expected and monitored by faculty supervisors.'],
            ['fas fa-mobile-alt', 'Device Policy', 'Mobile phones and personal devices are not permitted during clinical training sessions, lab work, or examinations. Violations result in disciplinary action.'],
            ['fas fa-id-badge', 'Dress Code', 'Institutional uniforms must be worn on campus at all times. During clinical postings, the prescribed uniform with ID card is compulsory.'],
        ] as [$icon, $title, $desc])
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

    @include('partials.faq', [
        'title' => 'About GNIMT — Your Questions Answered',
        'subtitle' => 'Learn more about our institute, leadership, infrastructure, and values.',
        'faqs' => $globalFaqs,
    ])

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/about.css') }}">
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            /* Scroll reveal */
            var ro = new IntersectionObserver(function(entries) {
                entries.forEach(function(e) {
                    if (e.isIntersecting) {
                        e.target.classList.add('vis');
                        ro.unobserve(e.target);
                    }
                });
            }, {
                threshold: 0.1
            });
            document.querySelectorAll('.rv,.rvl,.rvr').forEach(function(el) {
                ro.observe(el);
            });

            /* Active page-nav link on scroll */
            var links = document.querySelectorAll('.abt-nav-link');
            var sections = Array.from(links).map(function(l) {
                return document.querySelector(l.getAttribute('href'));
            }).filter(Boolean);
            var headerH = (document.querySelector('.site-header') || {
                offsetHeight: 140
            }).offsetHeight;

            function setActive() {
                var scrollY = window.scrollY + headerH + 40;
                var active = sections[0];
                sections.forEach(function(s) {
                    if (s.offsetTop <= scrollY) active = s;
                });
                links.forEach(function(l) {
                    l.classList.toggle('active', l.getAttribute('href') === '#' + active.id);
                });
            }
            window.addEventListener('scroll', setActive, {
                passive: true
            });
            setActive();
        });
    </script>
@endsection
