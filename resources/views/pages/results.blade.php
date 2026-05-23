@extends('layouts.app')

@section('title', 'Academic Merit & Results | GNIMT')
@section('meta_description', 'View the stellar academic performance records, university examination merits, and batch outcomes of GNIMT students.')

@section('content')

<section class="page-hero" aria-label="Academic Results">
  <div class="container-fluid px-4 px-lg-5">
    <div class="gold-line"></div>
    <h1>Examination Results</h1>
    <p>Celebrating continuous academic excellence, top university merits, and high distinctions.</p>
  </div>
</section>

<nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
  <div class="container-fluid px-4 px-lg-5">
    <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
    <span class="current">Results</span>
  </div>
</nav>

<section class="section-py">
  <div class="container-fluid px-4 px-lg-5">
    <div class="text-center mb-5">
      <div class="gold-line mx-auto"></div>
      <h2 class="section-title">University Merit Track</h2>
      <p class="section-subtitle mx-auto mt-2">GNIMT students regularly secure top-tier ranks within final university examinations across allied vocational health tracks.</p>
    </div>

    <div class="row g-4 justify-content-center">
      @foreach([
        ['1st University Rank', 'B.Voc Operation Theatre Technology - Pass percentage metrics held a complete 100% across final assessments.', 'fas fa-trophy'],
        ['Distinction Logs', 'Over 82% of current program enrollments successfully cleared university parameters with dynamic distinction grades.', 'fas fa-medal'],
        ['Clinical Assessment Merits', 'Outstanding practical assessment scores acknowledged across major monitoring medical hospital teams.', 'fas fa-star']
      ] as [$title, $text, $icon])
      <div class="col-md-4">
        <div class="stat-card h-100">
          <div class="stat-icon"><i class="{{ $icon }}"></i></div>
          <h3 class="fs-5 fw-bold text-navy mb-2">{{ $title }}</h3>
          <p class="text-muted small m-0" style="line-height:1.6;">{{ $text }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection
