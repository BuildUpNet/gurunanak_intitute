@extends('layouts.app')
@section('title', 'Terms of Use | GNIMT')
@section('content')
<section class="page-hero"><div class="container-fluid px-4 px-lg-5"><div class="gold-line"></div><h1>Terms of Use</h1></div></section>

<nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
    <div class="container-fluid px-4 px-lg-5">
        <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
        <span class="current">Terms of Use</span>
    </div>
</nav>

<section class="section-py"><div class="container-fluid px-4 px-lg-5"><div class="bg-white p-4 p-md-5 border rounded-4 shadow-sm">
    <h2 class="text-navy fw-bold fs-4 mb-3">Acceptance of Terms</h2>
    <p class="text-muted" style="line-height:1.8;">By accessing and using the Guru Nanak Institute of Medical Technology (GNIMT) website, you agree to be bound by these Terms of Use. If you do not agree with any part of these terms, please discontinue use of this website.</p>

    <h2 class="text-navy fw-bold fs-4 mb-3 mt-4">Use of Content</h2>
    <p class="text-muted" style="line-height:1.8;">All course information, program details, images, and other content published on this website are provided for general informational purposes only. GNIMT reserves the right to revise course structures, fee schedules, and admission criteria at any time without prior notice.</p>

    <h2 class="text-navy fw-bold fs-4 mb-3 mt-4">Intellectual Property</h2>
    <p class="text-muted" style="line-height:1.8;">The GNIMT name, logo, and all original content on this site are the property of Guru Nanak Institute of Medical Technology and may not be reproduced, distributed, or used without prior written permission.</p>

    <h2 class="text-navy fw-bold fs-4 mb-3 mt-4">Admissions &amp; Enquiries</h2>
    <p class="text-muted" style="line-height:1.8;">Submission of an enquiry or admission application through this website does not guarantee admission. All applications are subject to review and verification as per the institute's admission policy.</p>

    <h2 class="text-navy fw-bold fs-4 mb-3 mt-4">Limitation of Liability</h2>
    <p class="text-muted" style="line-height:1.8;">GNIMT makes reasonable efforts to keep information on this website accurate and up to date, but does not guarantee the completeness or accuracy of any content. GNIMT shall not be liable for any loss or damage arising from reliance on information published here.</p>

    <h2 class="text-navy fw-bold fs-4 mb-3 mt-4">Changes to These Terms</h2>
    <p class="text-muted" style="line-height:1.8;">These Terms of Use may be updated periodically. Continued use of the website after changes are posted constitutes acceptance of the revised terms.</p>

    <h2 class="text-navy fw-bold fs-4 mb-3 mt-4">Contact</h2>
    <p class="text-muted" style="line-height:1.8;">For questions regarding these Terms of Use, please reach out via our <a href="{{ route('contact.patiala') }}">Contact page</a>.</p>
</div></div></section>
@endsection
