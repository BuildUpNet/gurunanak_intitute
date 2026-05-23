@extends('layouts.app')

@section('title', 'Vision & Mission | GNIMT')
@section('meta_description', 'Explore the foundational parameters, core vision, and academic missions of Guru Nanak Institute of Medical Technology.')

@section('content')

<section class="page-hero" aria-label="Vision and Mission">
  <div class="container-fluid px-4 px-lg-5">
    <div class="gold-line"></div>
    <h1>Vision & Mission</h1>
    <p>The core values and strategic pathways that define our institution.</p>
  </div>
</section>

<nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
  <div class="container-fluid px-4 px-lg-5">
    <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
    <a href="{{ route('about') }}">About Us</a><span class="sep">/</span>
    <span class="current">Vision & Mission</span>
  </div>
</nav>

<section class="section-py">
  <div class="container-fluid px-4 px-lg-5">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="p-4 p-lg-5 border rounded-4 bg-white shadow-sm h-100">
          <div class="mb-4 text-center text-md-start"><i class="fas fa-eye fs-1 text-gold" style="color:var(--gold)"></i></div>
          <h2 class="section-title fs-3 mb-3">Our Vision</h2>
          <p class="text-muted m-0" style="line-height:1.8;">
            To be internationally recognized as a premier educational matrix in Allied Health Sciences, driving innovation, practical knowledge transfer, and academic excellence to foster highly specialized healthcare professionals dedicated to transforming patient care metrics globally.
          </p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="p-4 p-lg-5 border rounded-4 bg-white shadow-sm h-100">
          <div class="mb-4 text-center text-md-start"><i class="fas fa-bullseye fs-1 text-gold" style="color:var(--gold)"></i></div>
          <h2 class="section-title fs-3 mb-3">Our Mission</h2>
          <p class="text-muted m-0" style="line-height:1.8;">
            To administer state-of-the-art educational methodologies combining practical clinical operations with absolute ethical guidelines. We aim to install expert skill sets, promote deep industry integrations with premier medical institutions, and provide comprehensive ecosystem support to execute successful employment outcomes for every individual student.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
