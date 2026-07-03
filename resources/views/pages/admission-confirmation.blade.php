@extends('layouts.app')

@section('title', 'Application Submitted | GNIMT')
@section('meta_description', 'Your admission application has been submitted successfully to GNIMT.')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/pages/admission-confirmation.css') }}">
@endsection

@section('content')

<section class="page-hero" aria-label="Application Submitted">
  <div class="container-fluid px-4 px-lg-5">
    <div class="gold-line"></div>
    <h1>Application Submitted</h1>
    <p>Thank you for applying to Guru Nanak Institute of Medical Technology.</p>
  </div>
</section>

<nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
  <div class="container-fluid px-4 px-lg-5">
    <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
    <a href="{{ route('admissions') }}">Admissions</a><span class="sep">/</span>
    <span class="current">Application Confirmed</span>
  </div>
</nav>

<div class="conf-wrapper">
  <div class="conf-container">
    <div class="conf-card">

      {{-- Top success banner --}}
      <div class="conf-top">
        <div class="conf-icon"><i class="fas fa-check"></i></div>
        <h2>Application Submitted Successfully!</h2>
        <p>Your admission form has been received. Our team will contact you within 24–48 hours.</p>
        <div class="conf-app-id">Application ID: #{{ $application->id }}</div>
      </div>

      <div class="conf-body">

        {{-- Summary --}}
        <h4><i class="fas fa-user me-2"></i>Application Summary</h4>
        <div class="conf-grid">
          <div class="conf-item">
            <div class="conf-item-label">Candidate Name</div>
            <div class="conf-item-value">{{ $application->candidate_name }}</div>
          </div>
          <div class="conf-item">
            <div class="conf-item-label">Course Applied</div>
            <div class="conf-item-value">{{ $application->course_name }}</div>
          </div>
          <div class="conf-item">
            <div class="conf-item-label">Mobile Number</div>
            <div class="conf-item-value">{{ $application->mobile }}</div>
          </div>
          <div class="conf-item">
            <div class="conf-item-label">Email</div>
            <div class="conf-item-value">{{ $application->email ?: '—' }}</div>
          </div>
          <div class="conf-item">
            <div class="conf-item-label">Date of Birth</div>
            <div class="conf-item-value">{{ $application->dob->format('d M Y') }}</div>
          </div>
          <div class="conf-item">
            <div class="conf-item-label">Category</div>
            <div class="conf-item-value">{{ $application->category }}{{ $application->category_other ? ' — ' . $application->category_other : '' }}</div>
          </div>
        </div>

        {{-- Download button --}}
        <div style="text-align:center; padding: 8px 0 4px;">
          <a href="{{ route('admissions.pdf', $application->id) }}" class="conf-download">
            <i class="fas fa-file-pdf"></i> Download Filled Admission Form (PDF)
          </a>
          <p class="conf-note">
            Print the downloaded form, sign it, and bring it along with your documents at the time of admission.
          </p>
        </div>

        {{-- What's next --}}
        <div class="conf-steps">
          <h4><i class="fas fa-list-check me-2"></i>What Happens Next?</h4>
          <div class="step-row">
            <div class="step-num">1</div>
            <div class="step-text">
              <strong>Download &amp; Print Your Form</strong>
              <span>Click the button above to download your filled admission form as a PDF.</span>
            </div>
          </div>
          <div class="step-row">
            <div class="step-num">2</div>
            <div class="step-text">
              <strong>Sign the Form</strong>
              <span>Sign the form at the designated places along with your parent/guardian's signature.</span>
            </div>
          </div>
          <div class="step-row">
            <div class="step-num">3</div>
            <div class="step-text">
              <strong>Our Team Will Call You</strong>
              <span>An admission counsellor will call you on <strong>{{ $application->mobile }}</strong> within 24–48 hours.</span>
            </div>
          </div>
          <div class="step-row">
            <div class="step-num">4</div>
            <div class="step-text">
              <strong>Visit Campus with Documents</strong>
              <span>Bring your signed form, original documents, and photographs to confirm your seat.</span>
            </div>
          </div>
        </div>

        <div class="conf-back">
          <a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Back to Home</a>
          &nbsp;&nbsp;|&nbsp;&nbsp;
          <a href="{{ route('admissions.form') }}"><i class="fas fa-plus me-1"></i>Submit Another Application</a>
        </div>

      </div>{{-- .conf-body --}}
    </div>{{-- .conf-card --}}
  </div>
</div>

@endsection
