@extends('layouts.app')

@section('title', 'Campus Gallery & Infrastructure | GNIMT')
@section('meta_description', 'Take a virtual tour of GNIMT. Explore our modern clinical labs, smart classrooms, and campus life at Patiala and Karnal branches.')

@section('content')

<section class="page-hero" aria-label="Gallery">
  <div class="container-fluid px-4 px-lg-5">
    <div class="gold-line"></div>
    <h1>Campus Gallery</h1>
    <p>Experience the vibrant life and world-class infrastructure at GNIMT.</p>
  </div>
</section>

<nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
  <div class="container-fluid px-4 px-lg-5">
    <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
    <span class="current">Gallery</span>
  </div>
</nav>

<section class="section-py" style="background:var(--light);">
  <div class="container-fluid px-4 px-lg-5">

    <div class="row g-4">
      @for($i=1; $i<=6; $i++)
      <div class="col-md-6 col-lg-4">
        <div class="rounded-4 overflow-hidden shadow-sm" style="height: 250px;">
          <img src="{{ asset('images/campus-'.($i%3 == 0 ? 3 : ($i%2 == 0 ? 2 : 1)).'.jpg') }}" alt="GNIMT Campus Feature {{ $i }}" class="w-100 h-100 object-fit-cover" style="transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" loading="lazy">
        </div>
      </div>
      @endfor
    </div>

    <div class="mt-5 text-center">
      <p class="text-muted">Want to see our campus in person?</p>
      <a href="{{ route('contact') }}" class="btn-outline-gnimt">Schedule a Campus Visit</a>
    </div>
  </div>
</section>

@endsection
