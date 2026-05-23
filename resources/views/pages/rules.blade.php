@extends('layouts.app')

@section('title', 'Rules & Regulations | GNIMT')
@section('meta_description', 'Review the academic code of conduct, compulsory laboratory safety guidelines, and campus attendance rules at GNIMT.')

@section('content')

<section class="page-hero" aria-label="Campus Rules">
  <div class="container-fluid px-4 px-lg-5">
    <div class="gold-line"></div>
    <h1>Rules & Regulations</h1>
    <p>Maintaining institutional decorum, safety standards, and structural excellence across campuses.</p>
  </div>
</section>

<nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
  <div class="container-fluid px-4 px-lg-5">
    <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
    <span class="current">Rules & Regulations</span>
  </div>
</nav>

<section class="section-py">
  <div class="container-fluid px-4 px-lg-5">
    <div class="row g-4">
      @foreach([
        ['Academic Attendance Parameters', 'Every student must secure an absolute minimum of 75% attendance across all theoretical lectures and continuous hospital clinical training parameters to remain eligible for university examinations.', 'fas fa-user-check'],
        ['Laboratory Safety Directives', 'Students must rigidly comply with internal clinical bio-safety codes. Proper clinical white laboratory coats, sterile protective equipment, and identification parameters are entirely mandatory within training boundaries.', 'fas fa-shield-virus'],
        ['Code of Professional Conduct', 'GNIMT operates strict anti-ragging measures under standard apex regulatory declarations. Any breach of basic campus decorum, damage to institutional infrastructure, or undisciplined behavior faces strict action.', 'fas fa-gavel']
      ] as [$heading, $detail, $icon])
      <div class="col-12">
        <div class="p-4 border rounded-4 bg-white shadow-sm d-flex gap-4 flex-wrap flex-md-nowrap">
          <div class="p-3 rounded-circle bg-light d-flex align-items-center justify-content-center flex-shrink-0" style="width:60px; height:60px;"><i class="{{ $icon }} fs-4 text-gold" style="color:var(--gold)"></i></div>
          <div>
            <h3 class="fs-5 fw-bold text-navy mb-2">{{ $heading }}</h3>
            <p class="text-muted m-0 small" style="line-height:1.7;">{{ $detail }}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection
