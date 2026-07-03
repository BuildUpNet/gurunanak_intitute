@extends('layouts.app')
@section('title', 'Disclaimer | GNIMT')
@section('content')
<section class="page-hero"><div class="container-fluid px-4 px-lg-5"><div class="gold-line"></div><h1>Disclaimer</h1></div></section>

<nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
    <div class="container-fluid px-4 px-lg-5">
        <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
        <span class="current">Disclaimer</span>
    </div>
</nav>

<section class="section-py"><div class="container-fluid px-4 px-lg-5"><div class="bg-white p-4 p-md-5 border rounded-4 shadow-sm">
    <h2 class="text-navy fw-bold fs-4 mb-3">General Information</h2>
    <p class="text-muted" style="line-height:1.8;">The information provided on the Guru Nanak Institute of Medical Technology (GNIMT) website — including course details, fee structures, faculty information, placement statistics, and gallery content — is published in good faith for general informational purposes only.</p>

    <h2 class="text-navy fw-bold fs-4 mb-3 mt-4">No Warranties</h2>
    <p class="text-muted" style="line-height:1.8;">GNIMT makes no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, or availability of the information, products, or services contained on this website. Any reliance you place on such information is strictly at your own risk.</p>

    <h2 class="text-navy fw-bold fs-4 mb-3 mt-4">External Links</h2>
    <p class="text-muted" style="line-height:1.8;">This website may contain links to external websites (such as social media platforms and affiliated portals) that are not provided or maintained by GNIMT. We do not guarantee the accuracy, relevance, or completeness of any information on these external sites.</p>

    <h2 class="text-navy fw-bold fs-4 mb-3 mt-4">Placement &amp; Career Outcomes</h2>
    <p class="text-muted" style="line-height:1.8;">Placement figures, career opportunities, and graduate outcomes mentioned on this website reflect historical data and are not a guarantee of future employment or admission outcomes for any individual student.</p>

    <h2 class="text-navy fw-bold fs-4 mb-3 mt-4">Changes to Programs</h2>
    <p class="text-muted" style="line-height:1.8;">Course curricula, durations, eligibility criteria, and fee structures are subject to change as per university/regulatory body guidelines and institute policy, without prior notice.</p>

    <h2 class="text-navy fw-bold fs-4 mb-3 mt-4">Contact</h2>
    <p class="text-muted" style="line-height:1.8;">For clarification on any content published on this website, please reach out via our <a href="{{ route('contact.patiala') }}">Contact page</a>.</p>
</div></div></section>
@endsection
