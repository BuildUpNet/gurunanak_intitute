@extends('layouts.app')
@section('title', 'Alumni | GNIMT')
@section('content')
<section class="page-hero"><div class="container-fluid px-4 px-lg-5"><div class="gold-line"></div><h1>Alumni</h1></div></section>

<nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
    <div class="container-fluid px-4 px-lg-5">
        <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
        <span class="current">Alumni</span>
    </div>
</nav>

<section class="section-py"><div class="container-fluid px-4 px-lg-5">
    <div class="bg-white p-4 p-md-5 border rounded-4 shadow-sm text-center">
        <h2 class="text-navy fw-bold fs-3 mb-3">Alumni Network — Coming Soon</h2>
        <p class="text-muted" style="line-height:1.8;">We're building a dedicated space to celebrate and connect with GNIMT alumni. Check back soon, or reach out via our <a href="{{ route('contact.patiala') }}">Contact page</a> in the meantime.</p>
    </div>
</div></section>
@endsection
