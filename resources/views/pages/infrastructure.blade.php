@extends('layouts.app')

@section('title', 'Campus Infrastructure & Labs | GNIMT')
@section('meta_description', 'Explore our state-of-the-art medical technology clinical labs, diagnostic equipment modules, and smart lecture halls at GNIMT.')

@section('content')

<section class="page-hero" aria-label="Campus Infrastructure">
  <div class="container-fluid px-4 px-lg-5">
    <div class="gold-line"></div>
    <h1>Our Infrastructure</h1>
    <p>World-class technology arrays and expert laboratory setups tailored for professional clinical workflows.</p>
  </div>
</section>

<nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
  <div class="container-fluid px-4 px-lg-5">
    <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
    <a href="{{ route('about') }}">About Us</a><span class="sep">/</span>
    <span class="current">Infrastructure</span>
  </div>
</nav>

<section class="section-py">
  <div class="container-fluid px-4 px-lg-5">
    <div class="text-center mb-5">
      <div class="gold-line mx-auto"></div>
      <h2 class="section-title">Advanced Training Labs</h2>
      <p class="section-subtitle mx-auto mt-2">Our laboratory systems simulate original hospital operating matrices, preparing students for critical actual assignments from day one.</p>
    </div>

    <div class="row g-4">
      @foreach([
        ['Advanced Operation Theatre Lab', 'Equipped with actual anesthesia setups, modern surgical lighting assemblies, autoclave machines, and complex vital tracking panels for advanced OT simulations.', 'fas fa-procedures'],
        ['Modern Medical Laboratory Matrix', 'Features advanced automated biochemistry setups, high-resolution micro-analysis arrays, histology tracking apparatus, and professional clinical hematology tools.', 'fas fa-vial'],
        ['Radiology & Diagnostic Imaging Bay', 'Housing structural models of diagnostic imaging apparatus including mock X-ray systems, advanced ultrasound modules, CT interfaces, and safety protocol suites.', 'fas fa-x-ray'],
        ['Cardiac Care Monitoring Wing', 'Fitted with advanced digital multi-lead ECG processing systems, modern diagnostic cardiac tracking displays, defibrillator training assemblies, and intensive care monitoring infrastructure.', 'fas fa-heartbeat']
      ] as [$title, $desc, $icon])
      <div class="col-md-6">
        <div class="p-4 border rounded-4 bg-white shadow-sm h-100 d-flex gap-3">
          <div class="p-3 rounded-3 bg-light text-center h-auto align-self-start"><i class="{{ $icon }} fs-3 text-gold" style="color:var(--gold); width:35px;"></i></div>
          <div>
            <h3 class="fs-5 fw-bold text-navy mb-2">{{ $title }}</h3>
            <p class="text-muted small m-0" style="line-height:1.6;">{{ $desc }}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection
