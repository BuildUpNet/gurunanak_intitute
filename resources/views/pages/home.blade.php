@extends('layouts.app')

@section('title','GNIMT – Premier Medical Technology Institute | Patiala & Karnal')
@section('meta_description','Guru Nanak Institute of Medical Technology offers UGC recognised B.Voc & Diploma programs in OT, MLT, Radiology, Cardiac Care & more. 99.9% placement support. Patiala & Karnal.')
@section('og_title','GNIMT – Guru Nanak Institute of Medical Technology')

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
  "address":{"@type":"PostalAddress","addressLocality":"Patiala","addressRegion":"Punjab","postalCode":"147001","addressCountry":"IN"},
  "telephone":"+91-8283929908",
  "email":"info@gurunanakinstitute.com",
  "sameAs":["https://www.facebook.com/Guru-Nanak-Institute-of-Medical-Technology-689772771089266","https://www.instagram.com/gnimtpatiala/"]
}
</script>
@endsection

@section('content')

{{-- ① HERO --}}
<section class="hero-section" aria-label="Hero Banner">
  <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
    <div class="carousel-inner">
      @foreach([
        ['Shaping the Future of Healthcare','Join 20+ medical technology programs with hands-on clinical training and 99.9% placement support.','campus-1.jpg'],
        ['UGC Recognised Programs','B.Voc & Diploma courses accredited by leading universities. Build a career in Allied Health Sciences.','campus-2.jpg'],
        ['Your Career Starts Here','Real-world exposure, modern labs, and industry connections that give you an edge from day one.','campus-3.jpg'],
      ] as $i => [$h,$p,$img])
      <div class="carousel-item @if($i===0)active @endif">
        <div class="hero-slide" style="background-image:linear-gradient(135deg,rgba(26,53,102,.82) 0%,rgba(26,53,102,.55) 100%),url('{{ asset('images/'.$img) }}');background-size:cover;background-position:center;">
          <div class="container-fluid px-4 px-lg-5">
            <div class="hero-content">
              <div class="gold-line"></div>
              <h1>{{ $h }}</h1>
              <p>{{ $p }}</p>
              <div class="hero-btns">
                <a href="{{ route('admissions') }}" class="btn-primary-gnimt">Apply Now <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i></a>
                <a href="{{ route('academics') }}" class="btn-hero-outline">Explore Courses</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" aria-label="Previous slide"><span class="carousel-control-prev-icon"></span></button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" aria-label="Next slide"><span class="carousel-control-next-icon"></span></button>
  </div>
</section>

{{-- ② STATS --}}
<section class="section-py" style="background:var(--light);" aria-label="GNIMT at a Glance">
  <div class="container-fluid px-4 px-lg-5">
    <div class="text-center mb-5">
      <div class="gold-line mx-auto"></div>
      <h2 class="section-title">GNIMT At a Glance</h2>
      <p class="section-subtitle mx-auto mt-2">Three decades of excellence in healthcare education across Punjab & Haryana</p>
    </div>
    <div class="row g-4 justify-content-center">
      @foreach([
        ['fas fa-calendar-alt','30+','Years of Excellence','30'],
        ['fas fa-user-graduate','5000+','Alumni Placed','5000'],
        ['fas fa-hospital','50+','Hospital Tie-ups','50'],
        ['fas fa-university','10+','University Partners','10'],
      ] as [$icon,$num,$label,$target])
      <div class="col-6 col-md-3">
        <div class="stat-card">
          <div class="stat-icon"><i class="{{ $icon }}" aria-hidden="true"></i></div>
          <div class="stat-num" data-target="{{ $target }}">0</div>
          <div class="stat-label">{{ $label }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ③ WHY GNIMT --}}
<section class="section-py" aria-label="Why Choose GNIMT">
  <div class="container-fluid px-4 px-lg-5">
    <div class="row align-items-center g-5">
      <div class="col-lg-5">
        <div class="gold-line"></div>
        <h2 class="section-title">Why Choose GNIMT?</h2>
        <p class="section-subtitle mt-2">We don't just teach — we prepare you for a real career in healthcare with industry-grade exposure.</p>
        <div class="why-list mt-4">
          @foreach([
            ['fas fa-briefcase-medical','99.9% Placement Support','Dedicated placement cell with tie-ups to 50+ top hospitals.'],
            ['fas fa-flask','Modern Labs & Equipment','State-of-the-art clinical labs mirror actual hospital environments.'],
            ['fas fa-chalkboard-teacher','Expert Faculty','Practicing clinicians and experienced educators.'],
            ['fas fa-globe','International Programs','Tie-ups with Canadian institutions for global career options.'],
            ['fas fa-award','UGC Recognised','Degrees recognised by leading accredited universities.'],
            ['fas fa-hands-helping','Career Guidance','One-on-one counselling, resume building & interview prep.'],
          ] as [$icon,$title,$desc])
          <div class="why-item">
            <div class="why-icon"><i class="{{ $icon }}" aria-hidden="true"></i></div>
            <div><strong>{{ $title }}</strong><br><small class="text-muted">{{ $desc }}</small></div>
          </div>
          @endforeach
        </div>
      </div>
      <div class="col-lg-7">
        <div class="row g-3">
          @foreach([
            ['50+','Hospital Tie-Ups','fas fa-hospital-alt'],
            ['20+','Programs Offered','fas fa-book-medical'],
            ['99.9%','Placement Rate','fas fa-chart-line'],
            ['2','Branches','fas fa-map-marker-alt'],
          ] as [$n,$l,$ic])
          <div class="col-6">
            <div class="why-card">
              <i class="{{ $ic }}" aria-hidden="true"></i>
              <h3>{{ $n }}</h3>
              <p>{{ $l }}</p>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ④ FEATURED COURSES --}}
<section class="section-py" style="background:var(--light);" aria-label="Featured Courses">
  <div class="container-fluid px-4 px-lg-5">
    <div class="text-center mb-5">
      <div class="gold-line mx-auto"></div>
      <h2 class="section-title">Our Programs</h2>
      <p class="section-subtitle mx-auto mt-2">Choose from industry-aligned B.Voc and Diploma programs designed for real healthcare careers.</p>
    </div>
    <div class="row g-4">
      @foreach([
        ['Operation Theatre Technology','3 Years','10+2 Science','operation-theatre-technology','fas fa-procedures'],
        ['Medical Lab Technology','3 Years','10+2 Science (PCB)','medical-lab-technology','fas fa-vial'],
        ['Radiology & Imaging','3 Years','10+2 Science','radiology-imaging-technology','fas fa-x-ray'],
        ['Cardiac Care Technology','3 Years','10+2 Science (PCB)','cardiac-care-technology','fas fa-heartbeat'],
        ['Dialysis Technology','3 Years','10+2 Science','dialysis-technology','fas fa-tint'],
        ['Hospital Management','3 Years','10+2 Any Stream','hospital-management','fas fa-hospital'],
      ] as [$name,$dur,$eli,$slug,$icon])
      <div class="col-md-6 col-lg-4">
        <article class="course-card">
          <div class="course-card-img course-card-icon-bg">
            <div class="course-icon-wrap"><i class="{{ $icon }}" aria-hidden="true"></i></div>
            <span class="course-card-badge">B.Voc</span>
          </div>
          <div class="course-card-body">
            <h3 class="course-card-title">{{ $name }}</h3>
            <div class="course-card-meta">
              <span><i class="fas fa-clock" aria-hidden="true"></i>{{ $dur }}</span>
              <span><i class="fas fa-graduation-cap" aria-hidden="true"></i>{{ $eli }}</span>
            </div>
            <a href="{{ route('courses.show', $slug) }}" class="fc-cta">View Course →</a>
          </div>
        </article>
      </div>
      @endforeach
    </div>
    <div class="text-center mt-5">
      <a href="{{ route('academics') }}" class="btn-outline-gnimt">View All Programs</a>
    </div>
  </div>
</section>

{{-- ⑤ DIRECTOR MESSAGE --}}
<section class="section-py" aria-label="Director Message">
  <div class="container-fluid px-4 px-lg-5">
    <div class="row align-items-center g-5">
      <div class="col-lg-4 text-center">
        <div class="director-img-wrap">
          <img src="{{ asset('images/director.jpg') }}" alt="Director, Guru Nanak Institute of Medical Technology" class="director-img" loading="lazy" onerror="this.src='{{ asset('images/placeholder-person.jpg') }}'">
        </div>
      </div>
      <div class="col-lg-8">
        <div class="gold-line"></div>
        <h2 class="section-title">Director's Message</h2>
        <div class="director-quote mt-3">
          <p>At Guru Nanak Institute of Medical Technology, we believe that quality healthcare begins with quality education. Since 1991, our mission has been to equip students with not just technical knowledge, but the compassion, integrity, and clinical expertise that make truly great healthcare professionals.</p>
          <p class="mt-3">We are proud of our legacy of placing thousands of graduates in leading hospitals across India and abroad. Our state-of-the-art facilities, dedicated faculty, and industry partnerships ensure that every GNIMT student is career-ready from day one.</p>
        </div>
        <div class="director-sign mt-3">
          <strong style="color:var(--navy);font-size:1.05rem;">Dr. (Name)</strong><br>
          <small class="text-muted">Director, GNIMT Patiala & Karnal</small>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ⑥ TESTIMONIALS --}}
<section class="section-py" style="background:var(--navy);" aria-label="Student Testimonials">
  <div class="container-fluid px-4 px-lg-5">
    <div class="text-center mb-5">
      <div class="gold-line mx-auto"></div>
      <h2 class="section-title" style="color:#fff;">What Our Students Say</h2>
    </div>
    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
      <div class="carousel-inner">
        @foreach([
          ['Rajan Preet Singh','B.Voc OT Technology','The practical training at GNIMT was exceptional. Within a month of graduation, I was placed at Fortis Hospital, Mohali. The faculty\'s guidance made all the difference.'],
          ['Simranjit Kaur','B.Voc Medical Lab Technology','GNIMT gave me skills that no textbook can teach. Real clinical exposure from day one. I\'m now working at SRL Diagnostics and couldn\'t be prouder.'],
          ['Hardeep Kumar','B.Voc Radiology','The modern imaging lab at GNIMT prepared me for real hospital environments. My batch had 100% placement and I\'m now at AIIMS Bathinda.'],
        ] as $i => [$name,$course,$text])
        <div class="carousel-item @if($i===0)active @endif">
          <div class="testimonial-card mx-auto">
            <div class="testi-quote"><i class="fas fa-quote-left" aria-hidden="true"></i></div>
            <p class="testi-text">{{ $text }}</p>
            <div class="testi-author">
              <div class="testi-avatar">{{ substr($name,0,1) }}</div>
              <div><strong>{{ $name }}</strong><br><small>{{ $course }}</small></div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="carousel-indicators testi-indicators">
        @for($i=0;$i<3;$i++)
        <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="{{ $i }}" @if($i===0)class="active" aria-current="true" @endif aria-label="Testimonial {{ $i+1 }}"></button>
        @endfor
      </div>
    </div>
  </div>
</section>

{{-- ⑦ NEWS --}}
<section class="section-py" aria-label="News and Announcements">
  <div class="container-fluid px-4 px-lg-5">
    <div class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-3">
      <div>
        <div class="gold-line"></div>
        <h2 class="section-title">News & Announcements</h2>
      </div>
      <a href="{{ route('news') }}" class="btn-outline-gnimt">View All News</a>
    </div>
    <div class="row g-4">
      @foreach([
        ['Admissions Open 2025–26','Applications are now open for all B.Voc and Diploma programs. Limited seats available.','15 May 2025'],
        ['100% Placement Drive Completed','GNIMT Patiala successfully placed its entire 2024 batch in top hospitals across India.','10 Apr 2025'],
        ['International MOU Signed','GNIMT signs agreement with Canadian institute for global education opportunities.','28 Mar 2025'],
      ] as [$title,$excerpt,$date])
      <div class="col-md-4">
        <article class="news-card">
          <div class="news-date"><i class="fas fa-calendar-alt me-2" aria-hidden="true"></i>{{ $date }}</div>
          <h3 class="news-title">{{ $title }}</h3>
          <p class="news-excerpt">{{ $excerpt }}</p>
          <a href="{{ route('news') }}" class="news-link">Read More <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        </article>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ⑧ ENQUIRY FORM + CTA --}}
<section class="section-py" style="background:var(--light);" aria-label="Admission Enquiry">
  <div class="container-fluid px-4 px-lg-5">
    <div class="row g-5 align-items-center">
      <div class="col-lg-5">
        <div class="gold-line"></div>
        <h2 class="section-title">Start Your Application Today</h2>
        <p class="section-subtitle mt-2">Admissions are open. Fill the quick enquiry form and our team will guide you through the entire process.</p>
        <ul class="enq-checklist mt-4">
          @foreach(['UGC Recognised Programs','99.9% Placement Support','Hands-on Clinical Training','Modern Labs & Facilities','International Tie-ups Available'] as $item)
          <li><i class="fas fa-check-circle" aria-hidden="true"></i> {{ $item }}</li>
          @endforeach
        </ul>
      </div>
      <div class="col-lg-7">
        <div class="enq-form-card">
          <h3>Quick Admission Enquiry</h3>
          <form action="{{ route('enquiry.store') }}" method="POST" novalidate>
            @csrf
            <div class="row g-3">
              <div class="col-sm-6">
                <input type="text" name="name" class="enq-input" placeholder="Full Name *" required autocomplete="name" aria-label="Full Name">
              </div>
              <div class="col-sm-6">
                <input type="tel" name="phone" class="enq-input" placeholder="Phone Number *" required autocomplete="tel" aria-label="Phone Number">
              </div>
              <div class="col-sm-6">
                <input type="email" name="email" class="enq-input" placeholder="Email Address" autocomplete="email" aria-label="Email">
              </div>
              <div class="col-sm-6">
                <select name="course" class="enq-input" aria-label="Course Interested In">
                  <option value="">Course Interested In</option>
                  @foreach(['B.Voc OT Technology','B.Voc MLT','B.Voc Radiology','B.Voc Cardiac Care','B.Voc Dialysis','B.Voc Ophthalmic','B.Voc Hospital Management','B.Voc Physiotherapy','DMLT Diploma','X-Ray Technology Diploma'] as $c)
                  <option>{{ $c }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-12">
                <textarea name="message" class="enq-input" rows="3" placeholder="Your Message (Optional)" aria-label="Message"></textarea>
              </div>
              <div class="col-12">
                <button type="submit" class="btn-primary-gnimt w-100" style="padding:13px;font-size:.9rem;">
                  <i class="fas fa-paper-plane me-2" aria-hidden="true"></i>Submit Enquiry
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('styles')
<style>
/* HERO */
.hero-slide{min-height:88vh;display:flex;align-items:center;}
.hero-content{max-width:640px;padding:40px 0;}
.hero-content h1{font-family:'Playfair Display',serif;font-size:3rem;font-weight:800;color:#fff;line-height:1.2;margin-bottom:16px;}
.hero-content p{font-size:1.05rem;color:rgba(255,255,255,.85);line-height:1.7;margin-bottom:28px;}
.hero-btns{display:flex;gap:14px;flex-wrap:wrap;}
.btn-hero-outline{border:2px solid rgba(255,255,255,.7);color:#fff;font-size:.85rem;font-weight:700;padding:11px 26px;border-radius:25px;text-decoration:none;transition:all .22s;}
.btn-hero-outline:hover{background:#fff;color:var(--navy);}
@media(max-width:767px){.hero-slide{min-height:60vh;}.hero-content h1{font-size:1.9rem;}}

/* WHY */
.why-item{display:flex;gap:14px;align-items:flex-start;margin-bottom:18px;}
.why-icon{width:40px;height:40px;border-radius:10px;background:rgba(232,160,32,.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.why-icon i{color:var(--gold);font-size:1rem;}
.why-card{background:var(--navy);border-radius:14px;padding:28px 20px;text-align:center;color:#fff;}
.why-card i{font-size:2rem;color:var(--gold);margin-bottom:12px;}
.why-card h3{font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:800;margin-bottom:4px;}
.why-card p{font-size:.8rem;opacity:.75;}

/* COURSES */
.course-card-icon-bg{background:linear-gradient(135deg,var(--light) 0%,#dde9ff 100%);display:flex;align-items:center;justify-content:center;}
.course-icon-wrap i{font-size:3.5rem;color:var(--navy);opacity:.35;}

/* DIRECTOR */
.director-img-wrap{display:inline-block;border-radius:50%;padding:5px;background:linear-gradient(135deg,var(--gold),var(--red));}
.director-img{width:220px;height:220px;object-fit:cover;border-radius:50%;border:5px solid #fff;}
.director-quote p{font-size:.92rem;color:var(--muted);line-height:1.8;border-left:3px solid var(--gold);padding-left:18px;}

/* TESTIMONIALS */
.testimonial-card{background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);border-radius:16px;padding:36px 40px;max-width:720px;text-align:center;}
.testi-quote i{font-size:2rem;color:var(--gold);opacity:.6;margin-bottom:16px;}
.testi-text{font-size:.95rem;color:rgba(255,255,255,.85);line-height:1.8;margin-bottom:24px;}
.testi-author{display:flex;align-items:center;gap:14px;justify-content:center;}
.testi-avatar{width:46px;height:46px;border-radius:50%;background:var(--gold);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1.1rem;color:#fff;flex-shrink:0;}
.testi-author strong{color:#fff;font-size:.92rem;}
.testi-author small{color:rgba(255,255,255,.6);}
.testi-indicators{position:relative;margin-top:28px;}
.testi-indicators button{background:rgba(255,255,255,.35);width:10px;height:10px;border-radius:50%;border:none;}
.testi-indicators button.active{background:var(--gold);}

/* NEWS */
.news-card{background:var(--white);border-radius:12px;padding:24px;box-shadow:0 4px 20px rgba(26,53,102,.07);height:100%;border-top:3px solid var(--gold);transition:transform .22s;}
.news-card:hover{transform:translateY(-4px);}
.news-date{font-size:.73rem;color:var(--gold);font-weight:600;margin-bottom:8px;}
.news-title{font-size:.95rem;font-weight:700;color:var(--navy);margin-bottom:10px;line-height:1.4;}
.news-excerpt{font-size:.82rem;color:var(--muted);line-height:1.65;}
.news-link{display:inline-flex;align-items:center;gap:6px;font-size:.8rem;font-weight:700;color:var(--gold);text-decoration:none;margin-top:14px;}
.news-link:hover{color:var(--navy);}

/* ENQUIRY */
.enq-checklist{list-style:none;padding:0;display:flex;flex-direction:column;gap:10px;}
.enq-checklist li{display:flex;align-items:center;gap:10px;font-size:.88rem;}
.enq-checklist i{color:var(--gold);}
.enq-form-card{background:#fff;border-radius:16px;padding:36px;box-shadow:0 8px 40px rgba(26,53,102,.10);}
.enq-form-card h3{font-family:'Playfair Display',serif;font-size:1.3rem;font-weight:800;color:var(--navy);margin-bottom:22px;}
.enq-input{width:100%;border:1.5px solid var(--border);border-radius:8px;padding:11px 15px;font-size:.84rem;font-family:'Poppins',sans-serif;color:var(--txt);outline:none;transition:border-color .2s;background:#fff;}
.enq-input:focus{border-color:var(--gold);}
</style>
@endsection
