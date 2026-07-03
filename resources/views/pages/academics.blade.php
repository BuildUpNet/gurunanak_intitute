@extends('layouts.app')

@section('title', 'Academics — GNIMT')

@section('content')

{{-- ── Hero ── --}}
<section class="ac-hero">
    <div class="ac-hero__inner">
        <span class="ac-hero__eyebrow">Guru Nanak Institute of Medical Technology</span>
        <h1 class="ac-hero__h1">Academics</h1>
        <p class="ac-hero__sub">Explore our full range of Paramedical, Health Science, Management &amp; Technology programs — designed for the careers of tomorrow.</p>
    </div>
</section>

{{-- ── Programs Section ── --}}
@if($programCategories->isNotEmpty())
<section class="ac-section" id="programs">
    <div class="ac-wrap">
        <div class="ac-sec-hd">
            <h2>Programs</h2>
            <p>Full-detail program pages with eligibility, career paths &amp; more</p>
        </div>

        @foreach($programCategories as $pc)
            @if($pc->programLevels->isNotEmpty())
            <div class="ac-cat-block" id="{{ $pc->slug }}">
                <div class="ac-cat-hd">
                    @if($pc->icon)<i class="{{ $pc->icon }}"></i>@endif
                    <h3>{{ $pc->title }}</h3>
                </div>
                <div class="ac-prog-grid">
                    @foreach($pc->programLevels as $lvl)
                        @continue(!$lvl->programDetail)
                        @php($pd = $lvl->programDetail)
                        <a href="{{ route('program.show', $pd->slug) }}" class="ac-prog-card">
                            <div class="ac-prog-card__badge">{{ $pd->short_name }}</div>
                            <div class="ac-prog-card__title">{{ $pd->title }}</div>
                            <div class="ac-prog-card__meta">
                                <span><i class="fas fa-clock"></i> {{ $lvl->duration }}</span>
                                <span><i class="fas fa-map-marker-alt"></i> {{ $pd->locations }}</span>
                            </div>
                            <div class="ac-prog-card__level">{{ $pd->level }}</div>
                            <div class="ac-prog-card__arrow"><i class="fas fa-arrow-right"></i></div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif
        @endforeach
    </div>
</section>
@endif

{{-- ── Courses / Departments Section ── --}}
@if($courseCategories->isNotEmpty())
<section class="ac-section ac-section--alt" id="departments">
    <div class="ac-wrap">
        <div class="ac-sec-hd">
            <h2>Departments &amp; Courses</h2>
            <p>Browse courses by school or department</p>
        </div>

        @foreach($courseCategories as $cc)
            @if($cc->programDetails->isNotEmpty())
            <div class="ac-cat-block" id="{{ $cc->slug ?? \Illuminate\Support\Str::slug($cc->title) }}">
                <div class="ac-cat-hd">
                    @if($cc->icon)<i class="{{ $cc->icon }}"></i>@endif
                    <h3>{{ $cc->title }}</h3>
                </div>
                <div class="ac-course-grid">
                    @foreach($cc->programDetails as $course)
                        <a href="{{ route('program.show', $course->slug) }}" class="ac-course-card">
                            <div class="ac-course-card__title">{{ $course->title }}</div>
                            <span class="ac-course-card__badge">{{ $course->short_name }}</span>
                            <div class="ac-course-card__arrow"><i class="fas fa-arrow-right"></i></div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif
        @endforeach
    </div>
</section>
@endif

{{-- Empty state --}}
@if($programCategories->isEmpty() && $courseCategories->isEmpty())
<section class="ac-section">
    <div class="ac-wrap" style="text-align:center;padding:80px 20px;">
        <i class="fas fa-graduation-cap" style="font-size:3rem;color:#cbd5e1;"></i>
        <h3 style="color:#64748b;margin-top:16px;">Programs coming soon</h3>
        <p style="color:#94a3b8;">Check back shortly or contact us for more information.</p>
        <a href="{{ route('contact.patiala') }}" class="ac-cta-btn">Contact Us</a>
    </div>
</section>
@endif

{{-- ── CTA ── --}}
<section class="ac-cta-band">
    <div class="ac-wrap">
        <div class="ac-cta-band__inner">
            <div>
                <h3>Ready to start your journey?</h3>
                <p>Limited seats available — apply early for the 2025–26 academic year.</p>
            </div>
            <a href="{{ route('admissions.form') }}" class="ac-cta-btn">Apply Now →</a>
        </div>
    </div>
</section>

@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/pages/academics.css') }}">
@endsection
