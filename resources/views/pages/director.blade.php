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
        <div class="p-3 border rounded-4 bg-white shadow-sm inline-block">
          <img src="{{ asset('images/director.jpg') }}" alt="Director of GNIMT" class="rounded-4 object-fit-cover w-100" style="max-height:350px;" onerror="this.src='https://images.unsplash.com/photo-1559839734-2b71ea197ec2?q=80&w=400';">
          <h3 class="fs-5 fw-bold text-navy mt-3 mb-1">Dr. (Director Name)</h3>
          <p class="text-gold small fw-bold m-0" style="color:var(--gold)">Director, GNIMT Patiala & Karnal</p>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="gold-line"></div>
        <h2 class="section-title mb-4">Shaping the Future of Allied Health Sciences</h2>
        <div class="text-muted d-flex flex-column gap-3" style="line-height:1.8;">
          <p>
            Welcome to the Guru Nanak Institute of Medical Technology. Since our inception in 1991, our core objective has been to deliver top-notch professional clinical training that transforms passionate students into highly skilled, compassionate healthcare practitioners.
          </p>
          <p>
            The global healthcare architecture is continuously evolving, demanding technically proficient professionals who can operate advanced diagnostic and surgical machinery with high precision. At GNIMT, we address this requirement by updating our dynamic training modules and modernizing our specialized clinical laboratories.
          </p>
          <p>
            Our deep strategic integrations with over 50 leading hospitals provide our students with premium clinical exposure during their coursework. We are immensely proud of our legacy of maintaining a stellar placement track record, placing our alumni into apex medical institutions across the nation and globally.
          </p>
          <p class="fw-bold text-navy mt-2">
            I invite you to explore our advanced vocational degree structures and embark on a rewarding professional journey with us.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
