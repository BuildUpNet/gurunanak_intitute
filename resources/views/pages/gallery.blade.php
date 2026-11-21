@extends('layouts.app')

@section('title', 'Campus Gallery | GNIMT')
@section('meta_description',
    'Take a virtual tour of GNIMT. Explore our modern clinical labs, smart classrooms, events,
    and campus life.')

@section('content')

    {{-- ─── PAGE HERO (same style as About page) ─── --}}
    <section class="gal-hero" aria-label="Gallery">
        <div class="gal-hero__inner">
            <span class="gal-hero__eyebrow">Campus Life &nbsp;·&nbsp; Events &nbsp;·&nbsp; Infrastructure</span>
            <h1 class="gal-hero__h1">Campus <span>Gallery</span></h1>
            <p class="gal-hero__sub">Explore the vibrant life, infrastructure, and memories at Guru Nanak Institute of
                Medical Technology.</p>
            <div class="gal-hero__stats" id="galHeroStats">
                <span><i class="fas fa-images"></i> {{ $totalPhotos }} Photos</span>
                <span><i class="fas fa-layer-group"></i> {{ $categories->count() }} Albums</span>
            </div>
        </div>
    </section>

    <section class="section-py gal-section">
        <div class="container-fluid px-4 px-lg-5" id="galContent" aria-live="polite">

            {{-- Album filter --}}
            <div class="gal-filter" role="tablist" aria-label="Gallery albums">
                @foreach ($categories as $category)
                    <a href="{{ route('gallery.category', $category->slug) }}"
                        @class(['gal-pill', 'active' => $selectedCategory == $category->id])>
                        {{ $category->title }}
                        <span class="gal-pill__count">{{ $category->images_count }}</span>
                    </a>
                @endforeach
            </div>

            @if ($activeCategory && $activeCategory->subcategories->count())
                <div class="gal-subfilter" aria-label="Sub albums">
                    @foreach ($activeCategory->subcategories as $sub)
                        <a href="{{ route('gallery.sub', [$activeCategory->slug, $sub->slug]) }}"
                            @class(['gal-chip', 'active' => $selectedSubCategory == $sub->id])>{{ $sub->title }}</a>
                    @endforeach
                </div>
            @endif

            @if ($groupImages)
                {{-- Design 1: group photos — every card the same size, photo never cropped --}}
                <div class="gal-head">
                    <h2>{{ $activeSub ? $activeSub->displayTitle() : $activeCategory->title }}</h2>
                    <span class="gal-head__count">{{ $groupImages->total() }} Photos</span>
                </div>

                @if ($groupImages->count())
                    <div class="gal-group" id="galGrid">
                        @foreach ($groupImages as $image)
                            @php
                                $album = $image->subCategory->title ?? $activeCategory->title;
                                $alt = $image->image_alt ?: $album;
                            @endphp
                            <button type="button" class="gal-group__item" data-gal-open
                                data-src="{{ asset($image->image) }}" data-alt="{{ $alt }}"
                                aria-label="View larger photo">
                                <span class="gal-group__frame">
                                    <img src="{{ asset($image->image) }}" alt="{{ $alt }}" loading="lazy">
                                </span>
                                <span class="gal-group__overlay" aria-hidden="true">
                                    <span class="gal-group__zoom"><i class="fas fa-expand"></i></span>
                                </span>
                            </button>
                        @endforeach
                    </div>

                    @if ($groupImages->hasPages())
                        <div class="gal-pagination">
                            {{ $groupImages->onEachSide(1)->links('partials.gallery-pagination') }}
                        </div>
                    @endif
                @else
                    <div class="gal-empty">
                        <i class="fas fa-images"></i>
                        <h4>No Images Found</h4>
                        <p>No gallery images available for this album yet.</p>
                    </div>
                @endif
            @elseif ($blocks && $blocks->count())
                @php $photoNo = 0; @endphp
                <div id="galGrid">
                    @foreach ($blocks as $block)
                        @php
                            $count = $block->items->count();
                            $no = $block->noLabel ?: str_pad($blocks->firstItem() + $loop->index, 2, '0', STR_PAD_LEFT);
                        @endphp
                        <section class="gal-event" aria-label="{{ $block->title }}">
                            <header class="gal-event__head">
                                @if ($block->showNo)
                                    <span class="gal-event__no" aria-hidden="true">{{ $no }}</span>
                                @endif
                                <div class="gal-event__text">
                                    <div class="gal-event__top">
                                        <h2 class="gal-event__title">{{ $block->title }}</h2>
                                        @if ($block->date)
                                            <time class="gal-event__date" datetime="{{ $block->date->format('Y-m-d') }}">
                                                {{ $block->date->format('d F Y') }}
                                            </time>
                                        @endif
                                    </div>
                                    @if (!empty($block->desc))
                                        <p class="gal-event__desc">{{ $block->desc }}</p>
                                    @endif
                                </div>
                            </header>

                            {{-- Photos 2–5 = 2×2 on the right; left = photo 1 big, or photo 1 + 6, 7, 8 (admin Display Order) --}}
                            <div class="gal-mosaic gal-mosaic--n{{ min($count, 8) }}">
                                @foreach ($block->items as $image)
                                    @php $alt = $image->image_alt ?: $block->title; @endphp
                                    <button type="button" class="gal-tile" data-gal-open
                                        data-gal-index="{{ $photoNo++ }}"
                                        data-src="{{ asset($image->image) }}" data-alt="{{ $alt }}"
                                        aria-label="View larger photo">
                                        <img class="gal-tile__bg" src="{{ asset($image->image) }}" alt="" aria-hidden="true" loading="lazy">
                                        <img class="gal-tile__img" src="{{ asset($image->image) }}" alt="{{ $alt }}" loading="lazy">
                                        <span class="gal-tile__zoom" aria-hidden="true"><i class="fas fa-expand"></i></span>
                                    </button>
                                @endforeach
                            </div>
                        </section>
                    @endforeach
                </div>

                @if ($blocks->hasPages())
                    <div class="gal-pagination">
                        {{ $blocks->onEachSide(1)->links('partials.gallery-pagination') }}
                    </div>
                @endif
            @else
                <div class="gal-empty">
                    <i class="fas fa-images"></i>
                    <h4>No Images Found</h4>
                    <p>No gallery images available for this album yet.</p>
                </div>
            @endif

        </div>
    </section>

    {{-- ─── PHOTO VIEWER (opens on photo click, browses that event's photos) ─── --}}
    <div class="gal-lb" id="galLb" role="dialog" aria-modal="true" aria-label="Photo viewer" aria-hidden="true">
        <div class="gal-lb__bar">
            <span class="gal-lb__count" id="galLbCount"></span>
            <button type="button" class="gal-lb__close" id="galLbClose" aria-label="Close viewer">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="gal-lb__stage" id="galLbStage">
            <button type="button" class="gal-lb__nav gal-lb__nav--prev" id="galLbPrev" aria-label="Previous photo">
                <i class="fas fa-chevron-left"></i>
            </button>
            <img class="gal-lb__img" id="galLbImg" src="" alt="">
            <button type="button" class="gal-lb__nav gal-lb__nav--next" id="galLbNext" aria-label="Next photo">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>

    @include('partials.faq', [
        'title' => 'Gallery — Frequently Asked Questions',
        'subtitle' => 'Learn more about campus life, events, and facilities at GNIMT.',
        'faqs' => $globalFaqs,
    ])

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/gallery.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/pages/gallery.js') }}" defer></script>
@endsection
