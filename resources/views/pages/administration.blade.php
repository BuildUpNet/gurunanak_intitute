@extends('layouts.app')

@section('title', 'Administration | GNIMT')
@section('meta_description', 'Meet the administrative team of Guru Nanak Institute of Medical Technology — the dedicated people driving excellence in education and operations.')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/administration.css') }}">
@endsection

@section('content')

    <section class="page-hero" aria-label="Administration">
        <div class="container-fluid px-4 px-lg-5">
            <div class="gold-line"></div>
            <h1>Administration</h1>
            <p>The people driving excellence behind the scenes at GNIMT.</p>
        </div>
    </section>

    <nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
        <div class="container-fluid px-4 px-lg-5">
            <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
            <a href="{{ route('about') }}">About Us</a><span class="sep">/</span>
            <span class="current">Administration</span>
        </div>
    </nav>

    {{-- ── Intro Banner ── --}}
    <div class="adm-banner">
        <div class="container-fluid px-4 px-lg-5">
            <div class="adm-banner-inner">
                <div class="adm-banner-label">Administrative Excellence</div>
                <h2 class="adm-banner-heading">Driven By Leadership,<br>Built On Excellence.</h2>
                <p class="adm-banner-sub">Our administrative team works tirelessly to ensure seamless operations, student support, and institutional growth at every level.</p>
            </div>
        </div>
    </div>

    {{-- ── Team Table ── --}}
    <section class="section-py" style="background: var(--light);">
        <div class="container-fluid px-4 px-lg-5">

            <div class="adm-table-wrap">

                {{-- Table Header --}}
                <div class="adm-table-head">
                    <div class="adm-col-person">Administrator</div>
                    <div class="adm-col-desig">Designation</div>
                    <div class="adm-col-contact">Contact Information</div>
                </div>

                {{-- Coordinator --}}
                <div class="adm-row" id="coordinator">
                    <div class="adm-col-person">
                        <div class="adm-avatar" style="background: #0b1f3a;">CO</div>
                        <div class="adm-name-wrap">
                            <span class="adm-name">Coordinator Name</span>
                            <span class="adm-dept">Administration</span>
                        </div>
                    </div>
                    <div class="adm-col-desig">
                        <span class="adm-designation">Coordinator</span>
                    </div>
                    <div class="adm-col-contact">
                        <a href="mailto:coordinator@gurunanakinstitute.com" class="adm-email">
                            <i class="fas fa-envelope"></i>
                            coordinator@gurunanakinstitute.com
                        </a>
                    </div>
                </div>

                {{-- Accounts --}}
                <div class="adm-row" id="accounts">
                    <div class="adm-col-person">
                        <div class="adm-avatar" style="background: #c0262d;">AC</div>
                        <div class="adm-name-wrap">
                            <span class="adm-name">Accounts Name</span>
                            <span class="adm-dept">Finance &amp; Accounts</span>
                        </div>
                    </div>
                    <div class="adm-col-desig">
                        <span class="adm-designation">Accounts Officer</span>
                    </div>
                    <div class="adm-col-contact">
                        <a href="mailto:accounts@gurunanakinstitute.com" class="adm-email">
                            <i class="fas fa-envelope"></i>
                            accounts@gurunanakinstitute.com
                        </a>
                    </div>
                </div>

                {{-- Computer Operator --}}
                <div class="adm-row" id="computer-operator">
                    <div class="adm-col-person">
                        <div class="adm-avatar" style="background: #b8860b;">CP</div>
                        <div class="adm-name-wrap">
                            <span class="adm-name">Computer Operator Name</span>
                            <span class="adm-dept">IT &amp; Operations</span>
                        </div>
                    </div>
                    <div class="adm-col-desig">
                        <span class="adm-designation">Computer Operator</span>
                    </div>
                    <div class="adm-col-contact">
                        <a href="mailto:it@gurunanakinstitute.com" class="adm-email">
                            <i class="fas fa-envelope"></i>
                            it@gurunanakinstitute.com
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>


@endsection
