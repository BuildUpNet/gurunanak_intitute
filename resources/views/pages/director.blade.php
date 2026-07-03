@extends('layouts.app')

@section('title', "Director's Message | GNIMT")
@section('meta_description', "Read the official message from the Director of Guru Nanak Institute of Medical Technology regarding our academic vision and healthcare training programs.")

@section('content')

<section class="page-hero" aria-label="Director Message">
  <div class="container-fluid px-4 px-lg-5">
    <div class="gold-line"></div>
    <h1>Director's Message</h1>
    <p>A message of excellence, commitment, and vision for future healthcare leaders.</p>
  </div>
</section>

<nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
  <div class="container-fluid px-4 px-lg-5">
    <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
    <a href="{{ route('about') }}">About Us</a><span class="sep">/</span>
    <span class="current">Director's Message</span>
  </div>
</nav>

<section class="section-py">
  <div class="container-fluid px-4 px-lg-5">
    <div class="row g-5 align-items-start">
      <div class="col-lg-4 text-center">
        <div class="p-3 border rounded-4 bg-white shadow-sm">
          <img src="{{ asset('images/Dr.-Subhash-Dawar.jpg') }}" alt="Dr. Subhash Dawar — Director, GNIMT" class="rounded-4 object-fit-cover w-100" style="max-height:380px;object-position:top;" onerror="this.src='{{ asset('images/slides/Slide-Img-1.jpg') }}'">
          <h3 class="fs-5 fw-bold text-navy mt-3 mb-1">Dr. Subhash Dawar</h3>
          <p class="small fw-bold m-0" style="color:var(--gold)">Principal / Director, GNIMT Patiala &amp; Karnal</p>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="gold-line"></div>
        <h2 class="section-title mb-4">Shaping the Future of Allied Health Sciences</h2>
        <div class="text-muted d-flex flex-column gap-3" style="line-height:1.85;">
          <p>
            It is a matter of great pride and privilege to serve as the Director of Guru Nanak Institute of Medical Technology — a premier institution dedicated to excellence in paramedical education for over 35 remarkable years. Since its establishment in 1991, the institute has consistently upheld its mission of delivering quality education, skill-based training, and professional excellence in the healthcare sector.
          </p>
          <p>
            Over the decades, GNIMT has successfully trained thousands of students, transforming them into skilled and confident healthcare professionals. Our alumni are proudly serving in reputed hospitals, diagnostic laboratories, research centers, and healthcare organizations across India and abroad. This strong legacy reflects our unwavering commitment to academic excellence and practical, career-oriented learning.
          </p>
          <p>
            Our core strength lies in paramedical education, where we emphasize a balanced integration of theoretical knowledge and intensive hands-on clinical training. Through structured exposure in hospitals, laboratories, and community healthcare settings, we ensure that every student develops real-world competencies required in modern healthcare systems.
          </p>
          <p>
            We take immense pride in our consistent record of successful placements. At GNIMT, every student is guided, mentored, and empowered to achieve professional success. Our philosophy is clear — education must lead to opportunity, and opportunity must lead to dignity and independence. No student who trains here is left without direction or purpose; every effort is made to ensure they build a meaningful career in healthcare.
          </p>
          <blockquote class="p-3 rounded-3 fst-italic fw-semibold mb-0" style="border-left:4px solid var(--red);background:rgba(192,38,45,.05);color:var(--red);">
            "Success is not just about learning — it is about transforming knowledge into service that changes lives."
          </blockquote>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
