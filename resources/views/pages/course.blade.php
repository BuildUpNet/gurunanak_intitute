@extends('layouts.app')

@section('title', $course['title'].' | GNIMT – Medical Technology Programs')
@section('meta_description', 'Enroll in '.$course['title'].' at GNIMT. '.$course['duration'].' program. Eligibility: '.$course['eligibility'].'. UGC Recognised. 99.9% Placement Support.')
@section('og_title', $course['title'].' – GNIMT')

@section('schema')
<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"Course",
  "name":"{{ $course['title'] }}",
  "description":"{{ $course['overview'] }}",
  "provider":{"@type":"EducationalOrganization","name":"Guru Nanak Institute of Medical Technology","url":"{{ url('/') }}"},
  "educationalCredentialAwarded":"Bachelor in Vocational Education (B.Voc)",
  "timeToComplete":"P{{ $course['duration'] }}"
}
</script>
@endsection

@section('content')

{{-- HERO --}}
<section class="page-hero" aria-label="{{ $course['title'] }}">
  <div class="container-fluid px-4 px-lg-5">
    <div class="gold-line"></div>
    <h1>{{ $course['title'] }}</h1>
    <p>UGC Recognised &nbsp;|&nbsp; {{ $course['duration'] }} &nbsp;|&nbsp; {{ $course['seats'] }} Seats Available</p>
  </div>
</section>

{{-- BREADCRUMB --}}
<nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
  <div class="container-fluid px-4 px-lg-5">
    <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
    <a href="{{ route('academics') }}">Academics</a><span class="sep">/</span>
    <span class="current">{{ $course['title'] }}</span>
  </div>
</nav>

<section class="section-py">
  <div class="container-fluid px-4 px-lg-5">
    <div class="row g-5">

      {{-- MAIN --}}
      <div class="col-lg-8">

        <div class="course-detail-card mb-4">
          <h2>Program Overview</h2>
          <p>{{ $course['overview'] }}</p>
        </div>

        <div class="row g-3 mb-4">
          @foreach([
            ['fas fa-clock','Duration',$course['duration']],
            ['fas fa-graduation-cap','Eligibility',$course['eligibility']],
            ['fas fa-chair','Total Seats',$course['seats'].' Seats'],
            ['fas fa-award','Degree','B.Voc (UGC Recognised)'],
          ] as [$icon,$label,$val])
          <div class="col-sm-6">
            <div class="course-meta-box">
              <i class="{{ $icon }}" aria-hidden="true"></i>
              <div><span class="meta-label">{{ $label }}</span><span class="meta-val">{{ $val }}</span></div>
            </div>
          </div>
          @endforeach
        </div>

        <div class="course-detail-card mb-4">
          <h2>Career Opportunities</h2>
          <div class="career-tags">
            @foreach($course['career'] as $career)
            <span class="career-tag"><i class="fas fa-check" aria-hidden="true"></i> {{ $career }}</span>
            @endforeach
          </div>
        </div>

        <div class="course-detail-card">
          <h2>Our Recruiters</h2>
          <div class="recruiter-list">
            @foreach($course['recruiters'] as $r)
            <div class="recruiter-badge"><i class="fas fa-building me-2" aria-hidden="true"></i>{{ $r }}</div>
            @endforeach
          </div>
        </div>
      </div>

      {{-- SIDEBAR --}}
      <div class="col-lg-4">
        {{-- Quick Apply --}}
        <div class="sidebar-card mb-4">
          <h3><i class="fas fa-file-alt me-2" style="color:var(--gold)" aria-hidden="true"></i>Apply for This Course</h3>
          <form action="{{ route('enquiry.store') }}" method="POST" novalidate>
            @csrf
            <input type="hidden" name="course" value="{{ $course['title'] }}">
            <input type="text" name="name" class="enq-input mb-2" placeholder="Full Name *" required autocomplete="name" aria-label="Full Name">
            <input type="tel" name="phone" class="enq-input mb-2" placeholder="Phone Number *" required autocomplete="tel" aria-label="Phone">
            <input type="email" name="email" class="enq-input mb-3" placeholder="Email Address" autocomplete="email" aria-label="Email">
            <button type="submit" class="btn-primary-gnimt w-100">Apply Now →</button>
          </form>
        </div>

        {{-- Contact --}}
        <div class="sidebar-card" style="background:var(--navy);color:#fff;">
          <h3 style="color:#fff;"><i class="fas fa-headset me-2" style="color:var(--gold)" aria-hidden="true"></i>Need Help?</h3>
          <p style="font-size:.82rem;opacity:.8;margin-top:8px;">Our counsellors are available Mon–Sat 9am–6pm</p>
          <a href="tel:8283929908" class="d-block mt-3" style="color:var(--gold);font-weight:700;text-decoration:none;"><i class="fas fa-phone me-2" aria-hidden="true"></i>+91-8283929908</a>
          <a href="tel:8150019000" class="d-block mt-1" style="color:var(--gold);font-weight:700;text-decoration:none;"><i class="fas fa-phone me-2" aria-hidden="true"></i>+91-8150019000</a>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- RELATED COURSES --}}
@if($related->count())
<section class="section-py" style="background:var(--light);" aria-label="Related Courses">
  <div class="container-fluid px-4 px-lg-5">
    <div class="gold-line"></div>
    <h2 class="section-title mb-4">Related Programs</h2>
    <div class="row g-4">
      @foreach($related as $rc)
      <div class="col-md-4">
        <div class="course-card">
          <div class="course-card-body pt-3">
            <span class="course-card-badge" style="position:static;display:inline-block;margin-bottom:8px;">{{ $rc['badge'] }}</span>
            <h3 class="course-card-title">{{ $rc['title'] }}</h3>
            <div class="course-card-meta">
              <span><i class="fas fa-clock" aria-hidden="true"></i>{{ $rc['duration'] }}</span>
            </div>
            <a href="{{ route('courses.show', $rc['slug']) }}" class="fc-cta">View Course →</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif

@endsection

@section('styles')
<style>
.course-detail-card{background:#fff;border-radius:12px;padding:28px;box-shadow:0 4px 20px rgba(26,53,102,.07);margin-bottom:0;}
.course-detail-card h2{font-family:'Playfair Display',serif;font-size:1.25rem;font-weight:800;color:var(--navy);margin-bottom:14px;padding-bottom:10px;border-bottom:2px solid var(--border);}
.course-detail-card p{font-size:.88rem;color:var(--muted);line-height:1.8;}
.course-meta-box{background:var(--light);border-radius:10px;padding:16px 18px;display:flex;align-items:center;gap:14px;}
.course-meta-box i{color:var(--gold);font-size:1.3rem;flex-shrink:0;}
.meta-label{display:block;font-size:.68rem;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);font-weight:600;}
.meta-val{display:block;font-size:.9rem;font-weight:700;color:var(--navy);}
.career-tags{display:flex;flex-wrap:wrap;gap:8px;}
.career-tag{background:var(--light);border:1px solid var(--border);color:var(--navy);font-size:.78rem;padding:6px 14px;border-radius:20px;display:flex;align-items:center;gap:6px;}
.career-tag i{color:var(--gold);font-size:.65rem;}
.recruiter-list{display:flex;flex-wrap:wrap;gap:10px;}
.recruiter-badge{background:rgba(26,53,102,.06);border:1px solid var(--border);color:var(--navy);font-size:.8rem;padding:7px 16px;border-radius:8px;}
.sidebar-card{background:#fff;border-radius:12px;padding:24px;box-shadow:0 4px 20px rgba(26,53,102,.08);}
.sidebar-card h3{font-family:'Playfair Display',serif;font-size:1rem;font-weight:800;color:var(--navy);margin-bottom:16px;}
.enq-input{width:100%;border:1.5px solid var(--border);border-radius:8px;padding:10px 14px;font-size:.83rem;font-family:'Poppins',sans-serif;outline:none;transition:border-color .2s;background:#fff;display:block;}
.enq-input:focus{border-color:var(--gold);}
</style>
@endsection
