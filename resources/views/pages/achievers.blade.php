@extends('layouts.app')

@section('title', 'Our Achievers & Placements | GNIMT')
@section('meta_description', 'Meet the successful alumni of GNIMT. Our graduates are placed in top hospitals across India including Fortis, Max Healthcare, and AIIMS.')

@section('content')

<section class="page-hero" aria-label="Our Achievers">
  <div class="container-fluid px-4 px-lg-5">
    <div class="gold-line"></div>
    <h1>Our Achievers</h1>
    <p>Proud alumni serving in the world's best healthcare institutions.</p>
  </div>
</section>

<nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
  <div class="container-fluid px-4 px-lg-5">
    <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
    <span class="current">Our Achievers</span>
  </div>
</nav>

<section class="section-py">
  <div class="container-fluid px-4 px-lg-5">
    <div class="text-center mb-5">
      <div class="gold-line mx-auto"></div>
      <h2 class="section-title">Stellar Placements</h2>
      <p class="section-subtitle mx-auto mt-2">GNIMT maintains a consistent 99.9% placement record across all allied health science programs.</p>
    </div>

    <div class="row g-4">
      @foreach([
        ['Amanpreet Singh', 'B.Voc OT Technology', 'Placed at Fortis Hospital, Mohali', 'fas fa-user-md'],
        ['Priya Sharma', 'B.Voc MLT', 'Placed at SRL Diagnostics', 'fas fa-microscope'],
        ['Rahul Verma', 'Radiology Diploma', 'Placed at AIIMS Bathinda', 'fas fa-x-ray'],
        ['Neha Gupta', 'Cardiac Care', 'Placed at Max Healthcare', 'fas fa-heartbeat'],
        ['Simran Kaur', 'Hospital Management', 'Placed at Medanta', 'fas fa-hospital-user'],
        ['Vikram Jeet', 'Dialysis Technology', 'Govt. Hospital, Patiala', 'fas fa-clinic-medical']
      ] as [$name, $course, $placement, $icon])
      <div class="col-md-6 col-lg-4">
        <div class="bg-white border rounded-4 p-4 text-center shadow-sm h-100 transition-all hover-lift">
          <div class="mx-auto rounded-circle bg-light d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
            <i class="{{ $icon }} fs-1 text-gold" style="color: var(--gold);"></i>
          </div>
          <h3 class="fs-5 fw-bold text-navy mb-1">{{ $name }}</h3>
          <p class="text-muted small fw-semibold mb-2">{{ $course }}</p>
          <div class="badge bg-navy-light text-navy px-3 py-2 rounded-pill" style="background: var(--light);">
            <i class="fas fa-building me-1"></i> {{ $placement }}
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@include('components.cta-section', [
    'title' => 'Be Our Next Achiever',
    'subtitle' => 'Enroll today and secure your future in the healthcare industry.',
    'btnText' => 'Apply For Admission',
    'btnLink' => route('admissions')
])

@endsection
