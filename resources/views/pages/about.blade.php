@extends('layouts.app')

@section('title', 'About Us | GNIMT – Premier Medical Technology Institute')
@section('meta_description', 'Established in 1991, Guru Nanak Institute of Medical Technology is a premier institution operating under the guidance of the S.D. Public Health Educational and Research Society.')

@section('content')

<section class="page-hero" aria-label="About GNIMT">
  <div class="container-fluid px-4 px-lg-5">
    <div class="gold-line"></div>
    <h1>About GNIMT</h1>
    <p>Operating under the prestigious S.D. Public Health Educational and Research Society.</p>
  </div>
</section>

<nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
  <div class="container-fluid px-4 px-lg-5">
    <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
    <span class="current">About Us</span>
  </div>
</nav>

<section class="section-py">
  <div class="container-fluid px-4 px-lg-5">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <div class="gold-line"></div>
        <h2 class="section-title">Our Heritage & Trust</h2>
        <p class="mt-4 text-muted" style="line-height: 1.8;">
          Established in 1991, Guru Nanak Institute of Medical Technology is a premier institution operating under the guidance of the S.D. Public Health Educational and Research Society. Over the last three decades, we have committed ourselves to providing top-tier healthcare education, producing skilled professionals for leading hospitals across India and abroad.
        </p>
        <p class="mt-3 text-muted" style="line-height: 1.8;">
          Our academic structure is strictly industry-aligned, ensuring that theoretical foundations are seamlessly combined with extensive practical experience in live hospital environments.
        </p>
        <div class="row g-3 mt-4">
          <div class="col-sm-6">
            <div class="p-3 border rounded-3 bg-light d-flex align-items-center gap-3">
              <i class="fas fa-award fs-3 text-gold" style="color:var(--gold)"></i>
              <div><strong class="text-navy d-block">UGC Recognized</strong><small class="text-muted">Approved Programs</small></div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="p-3 border rounded-3 bg-light d-flex align-items-center gap-3">
              <i class="fas fa-chart-line fs-3 text-gold" style="color:var(--gold)"></i>
              <div><strong class="text-navy d-block">99.9% Placement</strong><small class="text-muted">Dedicated Support</small></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="position-relative p-2 border rounded-4 bg-white shadow-sm">
          <img src="{{ asset('images/campus-1.jpg') }}" alt="Guru Nanak Institute of Medical Technology Building" class="w-100 rounded-4 object-fit-cover" style="height:400px;" onerror="this.src='https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=600';">
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
