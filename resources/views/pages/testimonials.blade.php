@extends('layouts.app')

@section('title', 'Student Testimonials | GNIMT')
@section('meta_description', 'Read what GNIMT graduates say about their education, clinical training, and career success. Real stories from real students placed across India.')

@section('content')

<section class="page-hero" aria-label="Student Testimonials">
  <div class="container-fluid px-4 px-lg-5">
    <div class="gold-line"></div>
    <h1>Student Testimonials</h1>
    <p>Real stories from real achievers — students who built their healthcare careers at GNIMT.</p>
  </div>
</section>

<nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
  <div class="container-fluid px-4 px-lg-5">
    <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
    <a href="{{ route('achievers') }}">Achievers</a><span class="sep">/</span>
    <span class="current">Testimonials</span>
  </div>
</nav>

<section class="section-py">
  <div class="container-fluid px-4 px-lg-5">
    <div class="text-center mb-5">
      <div class="gold-line mx-auto"></div>
      <span class="hp-eyebrow" style="justify-content:center">Student Stories</span>
      <h2 class="section-title mt-2">What Our Graduates Say</h2>
      <p class="section-subtitle mx-auto mt-2">Over 35,000 students have passed through GNIMT. Here are some of their stories.</p>
    </div>

    <div class="row g-4">
      @foreach([
        ['R', 'Rajan Preet Singh', 'B.Voc OT Technology', 'Batch 2023', 'The practical training at GNIMT was exceptional. Within a month of graduation, I was placed at Fortis Hospital, Mohali. The faculty\'s guidance made all the difference in my career.', 'Fortis Hospital, Mohali'],
        ['S', 'Simranjit Kaur', 'B.Voc Medical Lab Technology', 'Batch 2022', 'GNIMT gave me skills no textbook can teach. Real clinical exposure from day one. I\'m now a senior lab technician at SRL Diagnostics and couldn\'t be prouder.', 'SRL Diagnostics'],
        ['H', 'Hardeep Kumar', 'B.Voc Radiology', 'Batch 2023', 'The modern imaging lab prepared me for real hospital environments. My batch had 100% placement — I\'m now posted at AIIMS Bathinda as a Radiographer.', 'AIIMS Bathinda'],
        ['P', 'Parveen Sharma', 'B.Voc Cardiac Care', 'Batch 2022', 'I was placed in a government hospital before my final exams. GNIMT\'s placement cell is extraordinary and the faculty prepared us extremely well for the job market.', 'Government Hospital Punjab'],
        ['A', 'Amandeep Gill', 'DMLT Diploma', 'Batch 2024', 'Within weeks of completing my diploma I had three job offers. The clinical skills and confidence I built at GNIMT are truly priceless.', 'Dr Lal PathLabs'],
        ['G', 'Gurpreet Bains', 'B.Voc Hospital Management', 'Batch 2021', 'GNIMT transformed my career. The management courses combined with hospital rotations gave me a unique edge. I\'m now managing operations at a 200-bed hospital.', 'Medanta, Gurugram'],
        ['M', 'Manpreet Kaur', 'B.Voc Physiotherapy', 'Batch 2023', 'The hands-on training under experienced physiotherapists made me industry-ready from day one. I now run my own physiotherapy centre in Chandigarh!', 'Own Practice, Chandigarh'],
        ['N', 'Navdeep Singh', 'Dialysis Technology', 'Batch 2022', 'I chose GNIMT because of its reputation and I was not disappointed. The placement support is real and the faculty genuinely cares about every student\'s future.', 'Apollo Hospitals, Delhi'],
        ['J', 'Jasleen Dhaliwal', 'Ophthalmic Technology', 'Batch 2024', 'From the labs to the faculty to the placements — everything at GNIMT exceeded my expectations. Proud to be a GNIMT alumnus.', 'Clear Vision Eye Hospital'],
      ] as [$initial, $name, $course, $batch, $text, $org])
      <div class="col-md-6 col-lg-4">
        <div class="tc bg-white h-100 shadow-sm rounded-4 p-4">
          <div class="tc__top d-flex justify-content-between align-items-center mb-3">
            <div class="tc__quote-icon"><i class="fas fa-quote-left"></i></div>
            <div class="tc__stars">★★★★★</div>
          </div>
          <p class="tc__text mb-3">{{ $text }}</p>
          <div class="tc__placed mb-3">
            <i class="fas fa-hospital-alt" aria-hidden="true"></i>
            <span>{{ $org }}</span>
          </div>
          <div class="tc__footer d-flex align-items-center gap-3 border-top pt-3">
            <div class="tc__avatar">{{ $initial }}</div>
            <div class="tc__info">
              <div class="tc__name">{{ $name }}</div>
              <div class="tc__meta">{{ $course }} &nbsp;·&nbsp; {{ $batch }}</div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@include('components.cta-section', [
    'title' => 'Write Your Own Success Story',
    'subtitle' => 'Join thousands of GNIMT graduates who built rewarding healthcare careers.',
    'btnText' => 'Apply For Admission',
    'btnLink' => route('admissions')
])

@endsection
