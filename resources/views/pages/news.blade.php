@extends('layouts.app')

@section('title', 'News & Announcements | GNIMT')
@section('meta_description', 'Stay updated with the latest news, events, admission alerts, and announcements from Guru Nanak Institute of Medical Technology.')

@section('content')

<section class="page-hero" aria-label="News">
  <div class="container-fluid px-4 px-lg-5">
    <div class="gold-line"></div>
    <h1>News & Announcements</h1>
    <p>Latest updates and events from our campus.</p>
  </div>
</section>

<nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
  <div class="container-fluid px-4 px-lg-5">
    <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
    <span class="current">News</span>
  </div>
</nav>

<section class="section-py">
  <div class="container-fluid px-4 px-lg-5">
    <div class="row g-4">
      @foreach([
        ['Admissions Open 2025–26', 'Applications are now open for all B.Voc and Diploma programs. Apply early to secure your seat.', '15 May 2025', 'Admission'],
        ['100% Placement Drive Completed', 'GNIMT Patiala successfully placed its entire 2024 batch in top hospitals across India.', '10 Apr 2025', 'Placement'],
        ['International MOU Signed', 'GNIMT signs agreement with a leading Canadian institute for global education opportunities.', '28 Mar 2025', 'Global'],
        ['Free Health Checkup Camp', 'Our students and faculty successfully organized a free health camp in rural Patiala.', '05 Mar 2025', 'Event']
      ] as [$title, $excerpt, $date, $tag])
      <div class="col-lg-6">
        <div class="bg-white p-4 rounded-4 shadow-sm border-start border-4 h-100" style="border-color: var(--gold) !important;">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="badge text-navy" style="background: var(--light);">{{ $tag }}</span>
            <span class="text-muted small"><i class="fas fa-calendar-alt text-gold me-1" style="color:var(--gold)"></i> {{ $date }}</span>
          </div>
          <h3 class="fs-5 fw-bold text-navy mb-2">{{ $title }}</h3>
          <p class="text-muted">{{ $excerpt }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection
