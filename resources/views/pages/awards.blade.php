@extends('layouts.app')

{{-- Everything on this page comes from admin/awards (page heading + sections) --}}
@section('title', $pageTitle . ' | GNIMT')
@if ($pageDescription)
    @section('meta_description', \Illuminate\Support\Str::limit($pageDescription, 160))
@endif

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/awards.css') }}">
@endsection

@section('content')

    {{-- Page title (admin/awards → Page Heading) --}}
    {{-- Same hero design as the About page; last word of the title in red --}}
    @php
        $pageTitleWords = preg_split('/\s+/', trim($pageTitle));
        $pageTitleLast = count($pageTitleWords) > 1 ? array_pop($pageTitleWords) : null;
    @endphp
    <section class="awd-hero">
        <div class="awd-hero__inner">
            @if ($pageEyebrow)
                <span class="awd-hero__eyebrow">{{ $pageEyebrow }}</span>
            @endif
            <h1 class="awd-hero__h1">{{ implode(' ', $pageTitleWords) }}@if ($pageTitleLast) <span>{{ $pageTitleLast }}</span>@endif</h1>
            @if ($pageDescription)
                <p class="awd-hero__sub">{{ $pageDescription }}</p>
            @endif
        </div>
    </section>

    {{-- Sections (admin/awards) — each: title > description > images --}}
    <div class="awd-list">
        @foreach ($sections as $section)
            @php
                // Last word of the title is highlighted in red
                $titleWords = preg_split('/\s+/', trim($section->title));
                $titleLast = array_pop($titleWords);
            @endphp
            <section class="awd-section" id="award-section-{{ $section->id }}" data-awd-section>
                <div class="awd-ctr">
                    <div class="awd-head rv">
                        <h2 class="awd-heading">{{ implode(' ', $titleWords) }} <span>{{ $titleLast }}</span></h2>
                        @if ($section->description)
                            <p class="awd-desc">{{ $section->description }}</p>
                        @endif
                    </div>

                    <div class="awd-nav" data-awd-nav hidden>
                        <button type="button" class="awd-nav__btn" data-awd-prev aria-label="Previous images">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button type="button" class="awd-nav__btn" data-awd-next aria-label="Next images">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>

                    <div class="awd-track rv d1" data-awd-track>
                        @foreach ($section->activeAwards as $award)
                            <button type="button" class="awd-card" data-index="{{ $loop->index }}"
                                aria-label="View {{ $award->title }} full screen">
                                <img src="{{ asset('uploads/awards/' . $award->image) }}" alt="{{ $award->title }}"
                                    loading="lazy">
                                <span class="awd-card__zoom"><i class="fas fa-expand-alt"></i></span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </section>
        @endforeach
    </div>

    {{-- One shared full-screen popup; it shows the images of the section that was clicked --}}
    <div class="awd-lb" id="awdLb" role="dialog" aria-modal="true" aria-label="Award image" aria-hidden="true">
        <span class="awd-lb__counter" id="awdLbCounter"></span>
        <button type="button" class="awd-lb__btn awd-lb__close" id="awdLbClose" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
        <button type="button" class="awd-lb__btn awd-lb__nav awd-lb__prev" id="awdLbPrev" aria-label="Previous">
            <i class="fas fa-chevron-left"></i>
        </button>
        <img class="awd-lb__img" id="awdLbImg" src="" alt="">
        <button type="button" class="awd-lb__btn awd-lb__nav awd-lb__next" id="awdLbNext" aria-label="Next">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/pages/awards.js') }}" defer></script>
@endsection
