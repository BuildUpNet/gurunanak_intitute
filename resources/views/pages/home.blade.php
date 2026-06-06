{{-- resources/views/pages/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Guru Nanak Institute of Medical Technology | Patiala & Karnal')
@section('meta_description',
    'Premier medical technology institute in Punjab offering UGC recognised B.Voc & Diploma
    programs in OT, MLT, Radiology, Cardiac Care & more. 99.9% placement. Patiala & Karnal.')

@section('schema')
    <script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"EducationalOrganization",
  "name":"Guru Nanak Institute of Medical Technology",
  "alternateName":"GNIMT",
  "url":"{{ url('/') }}",
  "logo":"{{ asset('images/logo.png') }}",
  "description":"Premier medical technology institute offering UGC recognised programs since 1991.",
  "address":{"@type":"PostalAddress","streetAddress":"Near Civil Hospital","addressLocality":"Patiala","addressRegion":"Punjab","postalCode":"147001","addressCountry":"IN"},
  "telephone":"+91-8283929908",
  "email":"info@gurunanakinstitute.com",
  "foundingDate":"1991"
}
</script>
@endsection

@section('content')
    <div class="hp">

        {{-- ─────────────────────────── HERO ─────────────────────────── --}}
        <section class="hp-hero" aria-label="GNIMT Campus">
            <div class="swiper hp-hero__swiper">
                <div class="swiper-wrapper">
                    @php
                        $slides = [
                            ['src' => asset('images/slides/Slide-Img-1.jpg'), 'alt' => 'GNIMT Patiala Campus'],
                            ['src' => asset('images/slides/Slide-Img-2.jpg'), 'alt' => 'GNIMT Medical Labs'],
                            ['src' => asset('images/slides/Slide-Img-3.jpg'), 'alt' => 'GNIMT Convocation'],
                            ['src' => asset('images/slides/Slide-Img-4.jpg'), 'alt' => 'GNIMT Placement Drive'],
                        ];
                    @endphp
                    @foreach ($slides as $slide)
                        <div class="swiper-slide hp-hero__slide">
                            <img src="{{ $slide['src'] }}" alt="{{ $slide['alt'] }}"
                                loading="{{ $loop->first ? 'eager' : 'lazy' }}">
                            <div class="hp-hero__overlay"></div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination hp-hero__dots"></div>
                <div class="swiper-button-prev hp-hero__prev" aria-label="Previous"></div>
                <div class="swiper-button-next hp-hero__next" aria-label="Next"></div>
            </div>
            <div class="hp-hero__counter" aria-hidden="true">
                <span class="hp-hero__cnum" id="heroSlideNum">01</span>
                <div class="hp-hero__ctrack"><span class="hp-hero__cbar"></span></div>
                <span class="hp-hero__ctotal">/ 04</span>
            </div>
        </section>

        {{-- ─────────────────────────── WELCOME ─────────────────────────── --}}
        <section class="hp-welcome" aria-label="Welcome to GNIMT">
            <div class="hp-ctr">
                <div class="hp-welcome__grid">
                    <div class="hp-welcome__left rv">
                        <span class="hp-eyebrow">UGC Recognised &nbsp;·&nbsp; Est. 1991 &nbsp;·&nbsp; Patiala &amp;
                            Karnal</span>
                        <h1 class="hp-welcome__h1">Where <em>Medical Careers</em><br>Are Built for Life</h1>
                        <p class="hp-welcome__body">Guru Nanak Institute of Medical Technology offers industry-leading B.Voc
                            &amp; Diploma programs in allied health sciences. Hands-on clinical training, modern labs, and
                            99.9% placement support across two campuses.</p>
                        <div class="hp-welcome__actions">
                            <a href="{{ route('admissions') }}" class="hp-btn hp-btn--red">Apply Now <i
                                    class="fas fa-arrow-right"></i></a>
                            <a href="{{ route('academics') }}" class="hp-btn hp-btn--ghost">Explore Programs <i
                                    class="fas fa-compass"></i></a>
                        </div>
                    </div>
                    <div class="hp-welcome__right">
                        @foreach ([['fas fa-calendar-check', '33+', 'Years of Excellence'], ['fas fa-user-graduate', '5000+', 'Alumni Placed'], ['fas fa-hospital-alt', '50+', 'Hospital Tie-Ups'], ['fas fa-book-medical', '20+', 'Programs Offered']] as [$icon, $num, $label])
                            <div class="hp-welcome__badge rv">
                                <div class="hp-welcome__badge-icon"><i class="{{ $icon }}" aria-hidden="true"></i>
                                </div>
                                <span class="hp-welcome__badge-num">{{ $num }}</span>
                                <span class="hp-welcome__badge-label">{{ $label }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Stats shown in welcome section above — no duplicate section --}}

        {{-- ─────────────────────────── ABOUT ─────────────────────────── --}}
        <section class="hp-about" aria-label="About GNIMT">
            <div class="hp-ctr">
                <div class="hp-about__grid">
                    <div class="hp-about__images rvl">
                        <div class="hp-about__img-main">
                            <img src="{{ asset('images/slides/Slide-Img-2.jpg') }}" alt="GNIMT Institute Patiala"
                                loading="lazy">
                        </div>
                        <div class="hp-about__img-accent">
                            <img src="{{ asset('images/slides/Slide-Img-3.jpg') }}" alt="GNIMT Students at Training"
                                loading="lazy">
                        </div>
                        <div class="hp-about__est-badge">
                            <span class="hp-about__est-year">1991</span>
                            <span class="hp-about__est-label">Est. Year</span>
                        </div>
                    </div>
                    <div class="hp-about__content rvr">
                        <span class="hp-eyebrow">About GNIMT</span>
                        <h2 class="hp-heading" style="margin-top:14px">Punjab's Premier<br><span>Medical Technology</span>
                            Institute</h2>
                        <p class="hp-subtext" style="margin-top:16px">Guru Nanak Institute of Medical Technology was
                            established in 1991 under the S.D. Public Health Educational and Research Society. Dedicated to
                            promoting quality Para-Medical education, we help students from all backgrounds access
                            world-class healthcare training.</p>
                        <p class="hp-subtext" style="margin-top:10px">With affiliations to leading UGC-recognised
                            universities and a relentless focus on clinical training, our graduates are among the most
                            sought-after healthcare professionals across India and abroad.</p>
                        <div class="hp-about__trust">
                            @foreach (['UGC Recognised', 'NAAC Accredited University', '99.9% Placement Support', 'International Tie-ups'] as $t)
                                <span class="hp-trust-badge"><i class="fas fa-check-circle"
                                        aria-hidden="true"></i>{{ $t }}</span>
                            @endforeach
                        </div>
                        <div class="hp-about__actions">
                            <a href="{{ route('about') }}" class="hp-btn hp-btn--red">Know More <i
                                    class="fas fa-arrow-right"></i></a>
                            <a href="#enquiry" class="hp-btn hp-btn--outline">Enquire Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ─────────────────────────── ACHIEVEMENTS & AWARDS ─────────────────────────── --}}
        <section class="hp-awards" aria-label="Achievements and Awards">

            {{-- Header --}}
            <div class="hp-awards__header">
                <div class="hp-ctr">
                    <span class="hp-eyebrow rv" style="justify-content:center">Achievements &amp; Awards</span>
                    <h2 class="hp-heading rv d1" style="margin-top:12px;text-align:center">Recognition That <span>Defines
                            Excellence</span></h2>
                    <p class="hp-subtext rv d2" style="margin:14px auto 0;text-align:center">Three decades of
                        accreditations, awards, and milestones that cement our place as Punjab's premier healthcare
                        education institution.</p>
                </div>
            </div>

            {{-- Recognition tiles --}}
            <div class="hp-awards__tiles rv d1">
                <div class="hp-awards__tile" data-bg="UGC">
                    <div class="hp-awards__tile-icon hp-awards__tile-icon--red"><i class="fas fa-university"
                            aria-hidden="true"></i></div>
                    <span class="hp-awards__tile-stat">UGC <span>Recognised</span></span>
                    <h3 class="hp-awards__tile-title">Government Approved</h3>
                    <p class="hp-awards__tile-desc">Affiliated to UGC recognised universities — ensuring nationally
                        accepted, industry-approved B.Voc degrees for every graduate.</p>
                </div>
                <div class="hp-awards__tile" data-bg="NAAC">
                    <div class="hp-awards__tile-icon hp-awards__tile-icon--navy"><i class="fas fa-award"
                            aria-hidden="true"></i></div>
                    <span class="hp-awards__tile-stat">NAAC <span>Accredited</span></span>
                    <h3 class="hp-awards__tile-title">Quality Assured</h3>
                    <p class="hp-awards__tile-desc">Our partner universities are NAAC accredited — a nationally recognized
                        mark of academic quality and institutional excellence.</p>
                </div>
                <div class="hp-awards__tile" data-bg="MOU">
                    <div class="hp-awards__tile-icon hp-awards__tile-icon--red"><i class="fas fa-globe"
                            aria-hidden="true"></i></div>
                    <span class="hp-awards__tile-stat">5+ <span>Countries</span></span>
                    <h3 class="hp-awards__tile-title">International MOU</h3>
                    <p class="hp-awards__tile-desc">Signed MOU with Canadian institutes for global education pathways and
                        international placement opportunities for eligible students.</p>
                </div>
                <div class="hp-awards__tile" data-bg="33">
                    <div class="hp-awards__tile-icon hp-awards__tile-icon--navy"><i class="fas fa-medal"
                            aria-hidden="true"></i></div>
                    <span class="hp-awards__tile-stat">33+ <span>Years</span></span>
                    <h3 class="hp-awards__tile-title">Proven Legacy</h3>
                    <p class="hp-awards__tile-desc">Over three decades of uninterrupted excellence in producing skilled,
                        job-ready healthcare professionals across India and abroad.</p>
                </div>
            </div>

            {{-- Stats strip --}}
            {{-- <div class="hp-awards__stats-bar">
    @foreach ([['fas fa-calendar-check', '33', 'Years of Excellence'], ['fas fa-user-graduate', '5000', 'Alumni Placed'], ['fas fa-hospital-alt', '50', 'Hospital Tie-Ups'], ['fas fa-book-medical', '20', 'Programs Offered']] as [$icon, $num, $label])
      <div class="hp-awards__stat rv">
        <div class="hp-awards__stat-icon"><i class="{{ $icon }}" aria-hidden="true"></i></div>
        <span class="hp-awards__stat-num" data-target="{{ $num }}">0</span><span class="hp-awards__stat-plus">+</span>
        <span class="hp-awards__stat-label">{{ $label }}</span>
      </div>
    @endforeach
  </div> --}}

            {{-- Hospital ticker --}}
            <div class="hp-ctr" style="padding-top:60px;padding-bottom:60px;">
                <p class="hp-awards__logos-label rv" style="text-align:center">Our Alumni Work At</p>
                <div class="hp-awards__logos-track rv d1">
                    <div class="hp-awards__logos-inner">
                        @php
                            $recruiters = [
                                ['fas fa-hospital', 'AIIMS'],
                                ['fas fa-hospital', 'Fortis Healthcare'],
                                ['fas fa-hospital', 'Apollo Hospitals'],
                                ['fas fa-hospital', 'Max Healthcare'],
                                ['fas fa-hospital', 'PGI Chandigarh'],
                                ['fas fa-hospital', 'Civil Hospital Patiala'],
                                ['fas fa-vial', 'SRL Diagnostics'],
                                ['fas fa-vial', 'Dr Lal PathLabs'],
                                ['fas fa-vial', 'Thyrocare'],
                                ['fas fa-hospital', 'Medanta'],
                                ['fas fa-hospital', 'Narayana Health'],
                                ['fas fa-hospital', 'Asian Heart Institute'],
                                ['fas fa-hospital', 'Global Hospitals'],
                                ['fas fa-hospital', 'Dhanyaa Hospital'],
                            ];
                        @endphp
                        @foreach (array_merge($recruiters, $recruiters) as $r)
                            <div class="hp-awards__pill"><i class="{{ $r[0] }}"
                                    aria-hidden="true"></i>{{ $r[1] }}</div>
                        @endforeach
                    </div>
                </div>
                <div style="text-align:center;margin-top:32px" class="rv d2">
                    <a href="{{ route('achievers') }}" class="hp-btn hp-btn--outline">View All Achievers <i
                            class="fas fa-arrow-right"></i></a>
                </div>
            </div>

        </section>

        {{-- ─────────────────────────── WHY CHOOSE GNIMT ─────────────────────────── --}}
        <section class="hp-why" aria-label="Why Choose GNIMT">
            <div class="hp-ctr">
                <div class="hp-why__grid">
                    <div class="hp-why__left">
                        <span class="hp-eyebrow hp-eyebrow--light rv">Why Choose Us</span>
                        <h2 class="hp-why__h2 rv d1">The GNIMT <span>Difference</span></h2>
                        <p class="hp-why__body rv d2">We go far beyond the classroom. From day one, you train in real
                            clinical environments — building not just knowledge, but the confidence and skill to lead.</p>
                        <div class="hp-why__features rv d2">
                            @foreach ([['fas fa-briefcase-medical', '99.9% Placements', 'Dedicated placement cell with 50+ hospital partners across India.'], ['fas fa-flask', 'Modern Labs', 'State-of-the-art clinical labs mirroring real hospital environments.'], ['fas fa-chalkboard-teacher', 'Expert Faculty', 'Practicing clinicians and experienced healthcare educators.'], ['fas fa-globe', 'Global Programs', 'Canadian tie-ups for international career opportunities.'], ['fas fa-award', 'UGC Recognised', 'Degrees from leading nationally accredited universities.'], ['fas fa-hands-helping', 'Career Guidance', 'Resume building, interview prep &amp; personalised counselling.']] as [$icon, $title, $desc])
                                <div class="hp-why__feat">
                                    <div class="hp-why__feat-icon"><i class="{{ $icon }}"
                                            aria-hidden="true"></i></div>
                                    <div>
                                        <div class="hp-why__feat-title">{{ $title }}</div>
                                        <div class="hp-why__feat-desc">{!! $desc !!}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="hp-why__right rvr">
                        <div class="hp-why__img-frame">
                            <img src="{{ asset('images/slides/Slide-Img-3.jpg') }}" alt="GNIMT Clinical Training"
                                loading="lazy">
                        </div>
                        <div class="hp-why__stat-float">
                            <div class="hp-why__stat-icon"><i class="fas fa-trophy" aria-hidden="true"></i></div>
                            <div>
                                <div class="hp-why__stat-num">99.9%</div>
                                <div class="hp-why__stat-label">Placement Rate</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ─────────────────────────── DIRECTOR'S MESSAGE ─────────────────────────── --}}
        {{-- <section class="hp-director" aria-label="Director's Message">
            <div class="hp-ctr">
                <div class="hp-director__grid">
                    <div class="hp-director__img-wrap rvl">
                        <div class="hp-director__img-frame">
                            <img src="{{ asset('images/Dr.-Subhash-Dawar.jpg') }}" alt="Director GNIMT" loading="lazy"
                                onerror="this.src='{{ asset('images/slides/Slide-Img-1.jpg') }}'">
                        </div>
                        <div class="hp-director__corner hp-director__corner--tl" aria-hidden="true"></div>
                        <div class="hp-director__corner hp-director__corner--br" aria-hidden="true"></div>
                    </div>
                    <div class="hp-director__content rvr">
                        <span class="hp-eyebrow">Director's Message</span>
                        <h2 class="hp-heading" style="margin-top:14px">A Message from<br>Our <span>Director</span></h2>
                        <div class="hp-director__quote-mark" aria-hidden="true">"</div>
                        <p class="hp-director__quote">At Guru Nanak Institute of Medical Technology, we believe quality
                            healthcare begins with quality education. Since 1991, our mission has been to equip students
                            with not just technical knowledge, but the compassion, integrity, and clinical expertise that
                            make truly great healthcare professionals.</p>
                        <p class="hp-director__quote" style="margin-top:14px">We are proud of our legacy — thousands of
                            graduates placed in leading hospitals across India and abroad. At GNIMT, every student matters,
                            and every career is our commitment.</p>
                        <div class="hp-director__meta">
                            <div class="hp-director__name">S. Dr. Subhash Dawar</div>
                            <div class="hp-director__role">Director, GNIMT Patiala &amp; Karnal</div>
                        </div>
                        <a href="{{ route('about.director') }}" class="hp-btn hp-btn--outline"
                            style="margin-top:28px;display:inline-flex">Read Full Message <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </section> --}}

        {{-- ─────────────────────────── TESTIMONIALS ─────────────────────────── --}}
        <section class="hp-testi" aria-label="Student Testimonials">
            <div class="hp-ctr">
                <div class="hp-sec-head rv">
                    <div>
                        <span class="hp-eyebrow">Student Stories</span>
                        <h2 class="hp-heading" style="margin-top:12px">What Our <span>Graduates</span> Say</h2>
                    </div>
                    <a href="{{ route('testimonials') }}" class="hp-view-all">All Testimonials <i
                            class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="hp-ctr">
                <div class="hp-testi__wrap">
                    <div class="swiper hp-testi__swiper">
                        <div class="swiper-wrapper">
                            @php
                                $testimonials = [
                                    [
                                        'R',
                                        'Rajan Preet Singh',
                                        'B.Voc OT Technology',
                                        'Batch 2023',
                                        'The practical training at GNIMT was exceptional. Within a month of graduation, I was placed at Fortis Hospital, Mohali. The faculty\'s guidance made all the difference.',
                                        'Fortis Hospital, Mohali',
                                    ],
                                    [
                                        'S',
                                        'Simranjit Kaur',
                                        'B.Voc Medical Lab Technology',
                                        'Batch 2022',
                                        'GNIMT gave me skills no textbook can teach. Real clinical exposure from day one. I\'m now a senior lab technician at SRL Diagnostics.',
                                        'SRL Diagnostics',
                                    ],
                                    [
                                        'H',
                                        'Hardeep Kumar',
                                        'B.Voc Radiology',
                                        'Batch 2023',
                                        'The modern imaging lab prepared me for real hospital environments. My batch had 100% placement — I\'m now posted at AIIMS Bathinda as a Radiographer.',
                                        'AIIMS Bathinda',
                                    ],
                                    [
                                        'P',
                                        'Parveen Sharma',
                                        'B.Voc Cardiac Care',
                                        'Batch 2022',
                                        'I was placed in a government hospital before my final exams. GNIMT\'s placement cell is extraordinary and the faculty prepared us extremely well.',
                                        'Government Hospital Punjab',
                                    ],
                                    [
                                        'A',
                                        'Amandeep Gill',
                                        'DMLT Diploma',
                                        'Batch 2024',
                                        'Within weeks of completing my diploma I had three job offers. The clinical skills and confidence I built here are truly priceless.',
                                        'Dr Lal PathLabs',
                                    ],
                                ];
                            @endphp
                            @foreach ($testimonials as $t)
                                <div class="swiper-slide" style="height:auto">
                                    <div class="tc">
                                        <div class="tc__top">
                                            <div class="tc__quote-icon" aria-hidden="true"><i
                                                    class="fas fa-quote-left"></i></div>
                                            <div class="tc__stars" aria-label="5 stars">★★★★★</div>
                                        </div>
                                        <p class="tc__text">{{ $t[4] }}</p>
                                        <div class="tc__placed">
                                            <i class="fas fa-hospital-alt" aria-hidden="true"></i>
                                            <span>{{ $t[5] }}</span>
                                        </div>
                                        <div class="tc__footer">
                                            <div class="tc__avatar" aria-hidden="true">{{ $t[0] }}</div>
                                            <div class="tc__info">
                                                <div class="tc__name">{{ $t[1] }}</div>
                                                <div class="tc__meta">{{ $t[2] }} &nbsp;·&nbsp;
                                                    {{ $t[3] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination hp-testi__dots" style="position:relative;margin-top:32px;"></div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ─────────────────────────── NEWS & ANNOUNCEMENTS ─────────────────────────── --}}
        <section class="hp-news" aria-label="News and Announcements">
            <div class="hp-ctr">
                <div class="hp-sec-head rv">
                    <div>
                        <span class="hp-eyebrow">Latest Updates</span>
                        <h2 class="hp-heading" style="margin-top:12px">News &amp; <span>Announcements</span></h2>
                    </div>
                    <a href="{{ route('news') }}" class="hp-view-all">All News <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="hp-news__grid rv d1">
                    <div class="hp-news__featured">
                        <span class="hp-news__feat-tag">Admissions</span>
                        <h3 class="hp-news__feat-title">Admissions Open 2025–26 — Limited Seats Across All B.Voc &amp;
                            Diploma Programs</h3>
                        <p class="hp-news__feat-date"><i class="fas fa-calendar-alt" aria-hidden="true"></i> 15 May 2025
                        </p>
                        <a href="{{ route('news') }}" class="hp-news__feat-link">Read More <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="hp-news__col">
                        <div class="hp-news__card">
                            <span class="hp-news__card-tag">Placement</span>
                            <h3 class="hp-news__card-title">100% Placement Drive Completed for Batch 2024</h3>
                            <p class="hp-news__card-excerpt">GNIMT Patiala successfully placed its entire 2024 batch in top
                                hospitals across Punjab, Haryana and Delhi NCR.</p>
                            <div class="hp-news__card-date"><i class="fas fa-calendar-alt" aria-hidden="true"></i> 10
                                April 2025</div>
                        </div>
                        <div class="hp-news__card">
                            <span class="hp-news__card-tag hp-news__card-tag--red">MOU</span>
                            <h3 class="hp-news__card-title">International MOU Signed with Canadian Institute</h3>
                            <p class="hp-news__card-excerpt">GNIMT signs a landmark agreement for global education and
                                placement for eligible students.</p>
                            <div class="hp-news__card-date"><i class="fas fa-calendar-alt" aria-hidden="true"></i> 28
                                March 2025</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ─────────────────────────── 360 VIRTUAL TOUR ─────────────────────────── --}}
        <section class="hp-tour" aria-label="360 Virtual Campus Tour">
            <div class="hp-ctr">
                <div class="hp-sec-head rv" style="text-align:center;display:block">
                    <span class="hp-eyebrow" style="justify-content:center">Virtual Campus Tour</span>
                    <h2 class="hp-heading" style="margin-top:12px;text-align:center">Welcome To <span>Guru Nanak
                            Institute</span><br>of Medical Technology</h2>
                    <p class="hp-subtext" style="margin:14px auto 0;text-align:center">Experience our world-class
                        facilities from anywhere in the world. Take an immersive 360° virtual tour of our Patiala campus.
                    </p>
                </div>
                <div class="hp-tour__frame rv d1">
                    <div class="hp-tour__placeholder">
                        <div class="hp-tour__spin-icon" aria-hidden="true"><i class="fas fa-street-view"></i></div>
                        <h3 class="hp-tour__placeholder-h">360° Campus Tour</h3>
                        <p class="hp-tour__placeholder-p">Explore GNIMT Patiala in an immersive virtual experience</p>
                        <a href="https://www.gurunanakinstitute.com/" target="_blank" rel="noopener"
                            class="hp-btn hp-btn--red">
                            <i class="fas fa-vr-cardboard"></i> Launch Virtual Tour
                        </a>
                    </div>
                </div>
                <div class="hp-tour__pills rv d2">
                    @foreach ([['fas fa-flask', 'Modern Labs'], ['fas fa-chalkboard', 'Smart Classrooms'], ['fas fa-hospital', 'Clinical Training'], ['fas fa-dumbbell', 'Sports &amp; Wellness'], ['fas fa-book', 'Digital Library']] as [$icon, $label])
                        <div class="hp-tour__pill"><i class="{{ $icon }}" aria-hidden="true"></i>
                            {!! $label !!}</div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ─────────────────────────── ADMISSION PROCESS ─────────────────────────── --}}
        <section class="hp-admission" aria-label="Admission Process">
            <div class="hp-ctr">
                <div class="hp-sec-head rv" style="text-align:center;display:block">
                    <span class="hp-eyebrow" style="justify-content:center">Admission Process</span>
                    <h2 class="hp-heading" style="margin-top:12px;text-align:center">Your Journey to <span>GNIMT</span>
                        Starts Here!</h2>
                    <p class="hp-subtext" style="margin:14px auto 0;text-align:center">Follow our simple step-by-step
                        admission process and secure your future in healthcare.</p>
                </div>
                <div class="hp-admission__steps rv d1">
                    @foreach ([['fas fa-file-alt', 'Register &amp; Apply', 'Fill out the online admission form with your personal and academic details.'], ['fas fa-folder-open', 'Submit Documents', 'Upload required documents — 10+2 marksheet, ID proof and passport photo.'], ['fas fa-credit-card', 'Application Fee Payment', 'Pay the nominal application fee to proceed with your admission.'], ['fas fa-graduation-cap', 'Confirm &amp; Pay Fees', 'Pay tuition fees, confirm your seat. Welcome to the GNIMT family!']] as $i => [$icon, $title, $desc])
                        <div
                            class="hp-admission__step @if ($i === 3) hp-admission__step--active @endif">
                            <div class="hp-admission__step-label">Step {{ $i + 1 }}</div>
                            <div class="hp-admission__step-circle">
                                <i class="{{ $icon }}" aria-hidden="true"></i>
                            </div>
                            <h3 class="hp-admission__step-title">{!! $title !!}</h3>
                            <p class="hp-admission__step-desc">{!! $desc !!}</p>
                        </div>
                    @endforeach
                </div>
                <div class="hp-admission__cta rv d2">
                    <div class="hp-admission__divider">Admissions Open 2025–26</div>
                    <div class="hp-admission__btns">
                        <a href="{{ route('admissions') }}" class="hp-btn hp-btn--red"><i class="fas fa-paper-plane"
                                aria-hidden="true"></i> Apply Today</a>
                        <a href="tel:8283929908" class="hp-btn hp-btn--outline-navy"><i class="fas fa-phone"
                                aria-hidden="true"></i> Call for Guidance</a>
                    </div>
                </div>
            </div>
        </section>

        {{-- ─────────────────────────── CTA / ENQUIRY FORM ─────────────────────────── --}}
        <section class="hp-enquiry" id="enquiry" aria-label="Admission Enquiry">
            <div class="hp-ctr">
                <div class="hp-enquiry__grid">

                    <div class="hp-enquiry__left rv">
                        <span class="hp-eyebrow hp-eyebrow--light">Get in Touch</span>
                        <h2 class="hp-enquiry__h2">Start Your<br><span>Medical Career</span> Today</h2>
                        <p class="hp-enquiry__sub">Admissions are open. Fill the quick form and our counsellors will guide
                            you through every step.</p>
                        <ul class="hp-enquiry__list">
                            @foreach (['UGC Recognised Programs', '99.9% Placement Support', 'Hands-on Clinical Training', 'Modern Labs &amp; Equipment', 'International Tie-ups Available', 'Scholarship for Deserving Students'] as $item)
                                <li><i class="fas fa-check-circle" aria-hidden="true"></i>{!! $item !!}</li>
                            @endforeach
                        </ul>
                        <div class="hp-enquiry__phones">
                            <div class="hp-enquiry__phone-item">
                                <span class="hp-enquiry__phone-loc">Patiala Branch</span>
                                <a href="tel:8283929908" class="hp-enquiry__phone-num"><i class="fas fa-phone"
                                        aria-hidden="true"></i>+91-8283929908</a>
                            </div>
                            <div class="hp-enquiry__phone-item">
                                <span class="hp-enquiry__phone-loc">Karnal Branch</span>
                                <a href="tel:8150019000" class="hp-enquiry__phone-num"><i class="fas fa-phone"
                                        aria-hidden="true"></i>+91-8150019000</a>
                            </div>
                        </div>
                    </div>

                    <div class="hp-enquiry__right rvr">
                        <div class="hp-enquiry__form-box">
                            <h3 class="hp-enquiry__form-title">Quick Admission <span>Enquiry</span></h3>
                            <form action="{{ route('enquiry.store') }}" method="POST" novalidate>
                                @csrf
                                @if (session('success'))
                                    <div class="hp-enquiry__success">
                                        <i class="fas fa-check-circle" aria-hidden="true"></i> {{ session('success') }}
                                    </div>
                                @endif
                                <div class="hp-form__row">
                                    <input type="text" name="name" class="hp-form__field"
                                        placeholder="Full Name *" required autocomplete="name" aria-label="Full Name">
                                    <input type="tel" name="phone" class="hp-form__field"
                                        placeholder="Phone Number *" required autocomplete="tel" aria-label="Phone">
                                </div>
                                <input type="email" name="email" class="hp-form__field" placeholder="Email Address"
                                    autocomplete="email" aria-label="Email" style="width:100%;margin-bottom:12px;">
                                <div class="hp-form__row">
                                    <select name="course" class="hp-form__field" aria-label="Course">
                                        <option value="">Course Interested In</option>
                                        @foreach (['B.Voc Operation Theatre Technology', 'B.Voc Medical Lab Technology', 'B.Voc Radiology &amp; Imaging', 'B.Voc Cardiac Care Technology', 'B.Voc Dialysis Technology', 'B.Voc Ophthalmic Technology', 'B.Voc Hospital Management', 'B.Voc Physiotherapy', 'DMLT Diploma', 'X-Ray Technology Diploma', 'CT Scan', 'MRI Scan'] as $c)
                                            <option>{{ $c }}</option>
                                        @endforeach
                                    </select>
                                    <select name="branch" class="hp-form__field" aria-label="Branch">
                                        <option value="">Select Branch</option>
                                        <option>Patiala Branch</option>
                                        <option>Karnal Branch</option>
                                    </select>
                                </div>
                                <textarea name="message" class="hp-form__field" rows="3" placeholder="Your Message (Optional)"
                                    aria-label="Message" style="width:100%;margin-bottom:14px;resize:vertical;"></textarea>
                                <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"
                                    style="margin-bottom:14px;"></div>
                                <button type="submit" class="hp-btn hp-btn--red hp-btn--full">
                                    <i class="fas fa-paper-plane" aria-hidden="true"></i> Submit Enquiry
                                </button>
                                <p class="hp-form__privacy"><i class="fas fa-lock" aria-hidden="true"></i> Your
                                    information is safe. We'll contact you within 24 hours.</p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </div>{{-- /hp --}}
@endsection

@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection
