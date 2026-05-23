@extends('layouts.app')

@section('title', 'Placement Statistics & Records | GNIMT')
@section('meta_description', 'Explore the comprehensive clinical placement records, annual recruitment logs, and corporate healthcare partners of GNIMT.')

@section('content')

<section class="page-hero" aria-label="Placement Cell">
  <div class="container-fluid px-4 px-lg-5">
    <div class="gold-line"></div>
    <h1>Placement Records</h1>
    <p>A consistent track record of 99.9% professional career placement across key healthcare institutions.</p>
  </div>
</section>

<nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
  <div class="container-fluid px-4 px-lg-5">
    <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
    <span class="current">Placements</span>
  </div>
</nav>

<section class="section-py">
  <div class="container-fluid px-4 px-lg-5">
    <div class="text-center mb-5">
      <div class="gold-line mx-auto"></div>
      <h2 class="section-title">Our Recruitment Partners</h2>
      <p class="section-subtitle mx-auto mt-2">Our alumni serve inside top diagnostic structures, multi-specialty setups, and central corporate hospitals.</p>
    </div>

    <div class="row g-3 justify-content-center">
      @foreach(['Fortis Healthcare', 'Max Healthcare', 'Apollo Hospitals', 'Medanta The Medicity', 'SRL Diagnostics', 'Thyrocare Laboratories', 'Dr Lal PathLabs', 'PGI Medical Arrays', 'AIIMS Network Units'] as $hospital)
      <div class="col-6 col-sm-4 col-md-3">
        <div class="p-4 border rounded-3 bg-white shadow-sm text-center font-weight-bold text-navy h-100 d-flex align-items-center justify-content-center">
          <span class="fw-bold text-navy" style="font-size: 0.9rem;"><i class="fas fa-hospital text-gold me-2" style="color:var(--gold)"></i>{{ $hospital }}</span>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection
