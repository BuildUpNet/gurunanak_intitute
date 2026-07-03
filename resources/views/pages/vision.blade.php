@extends('layouts.app')

@section('title', 'Vision & Mission | GNIMT')
@section('meta_description', 'Explore the core vision and mission of Guru Nanak Institute of Medical Technology —
    committed to producing globally competent healthcare professionals.')

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
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="p-4 p-lg-5 border rounded-4 bg-white shadow-sm h-100">
                        <div class="mb-4 text-center text-md-start"><i class="fas fa-eye fs-1"
                                style="color:var(--gold)"></i></div>
                        <h2 class="section-title fs-3 mb-3">Our Vision</h2>
                        <p class="text-muted m-0" style="line-height:1.8;">
                            To become a transformative hub of paramedical education, recognized for producing globally
                            competent healthcare professionals who combine scientific excellence with human compassion.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 p-lg-5 border rounded-4 bg-white shadow-sm h-100">
                        <div class="mb-4 text-center text-md-start"><i class="fas fa-bullseye fs-1"
                                style="color:var(--gold)"></i></div>
                        <h2 class="section-title fs-3 mb-3">Our Mission</h2>
                        <ul class="text-muted m-0 ps-3" style="line-height:2;">
                            <li>To provide high-quality paramedical education that combines academic excellence with
                                practical clinical training.</li>
                            <li>To develop skilled, confident, and job-ready healthcare professionals capable of meeting
                                global healthcare standards.</li>
                            <li>To promote hands-on learning through hospital-based training, laboratory exposure, and
                                community healthcare programs.</li>
                            <li>To ensure inclusive education by supporting students from diverse and economically weaker
                                backgrounds.</li>
                            <li>To foster a culture of discipline, ethics, compassion, and lifelong learning in healthcare
                                practice.</li>
                            <li>To strengthen employability by guiding students toward successful careers in hospitals,
                                diagnostic centers, and healthcare institutions worldwide.</li>
                            <li>To continuously upgrade teaching methodologies in line with modern advancements in medical
                                science and technology.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-2">
                @foreach ([['fas fa-star', 'var(--red)', 'Excellence', 'Maintaining the highest standards in education and clinical training.'], ['fas fa-heart', 'var(--gold)', 'Compassion', 'Producing healthcare professionals who lead with empathy and care.'], ['fas fa-flask', 'var(--navy)', 'Innovation', 'Continuously modernizing labs and curriculum to meet industry demands.'], ['fas fa-handshake', 'var(--red)', 'Integrity', 'Upholding ethical conduct across all academic and professional interactions.']] as [$icon, $color, $title, $desc])
                    <div class="col-6 col-md-3">
                        <div class="p-4 border rounded-4 bg-white shadow-sm text-center h-100">
                            <i class="{{ $icon }} fs-2 mb-3 d-block" style="color:{{ $color }}"></i>
                            <h5 class="fw-bold text-navy mb-2">{{ $title }}</h5>
                            <p class="text-muted small m-0" style="line-height:1.7;">{{ $desc }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
