@extends('layouts.app')

@section('title', 'Gallery Viewer | GNIMT')
@section('meta_description', 'Browse campus gallery images at GNIMT.')

@php
    // Clean (no "?") link back to the album
    $backCat = $selectedCategory ? \App\Models\GalleryCategory::find($selectedCategory) : null;
    $backSub = $backCat && $selectedSubCategory ? $backCat->subCategories()->find($selectedSubCategory) : null;
    $backUrl = $backSub ? route('gallery.sub', [$backCat->slug, $backSub->slug])
        : ($backCat ? route('gallery.category', $backCat->slug) : route('gallery'));

    $galleryJson = $images->map(function ($img) {
        return [
            'src'   => asset($img->image),
            'alt'   => $img->image_alt ?? $img->title ?? 'Gallery Image',
            'title' => $img->title ?? '',
            'desc'  => $img->description ?? '',
        ];
    })->values()->toArray();
@endphp

@section('content')

    {{-- Breadcrumb --}}
    <nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
        <div class="container-fluid px-4 px-lg-5">
            <a href="{{ route('home') }}">Home</a>
            <span class="sep">/</span>
            <a href="{{ $backUrl }}">Gallery</a>
            <span class="sep">/</span>
            <span class="current" id="bcTitle">Image View</span>
        </div>
    </nav>

    <section class="gv-section">
        <div class="container-fluid px-4 px-lg-5">

            {{-- Amazon-style layout: thumbnails | big image | info --}}
            <div class="gv-amz">

                {{-- LEFT: Vertical thumbnail rail --}}
                <div class="gv-thumbs" id="gvThumbs">
                    @foreach($images as $img)
                        <button type="button" class="gv-thumb"
                                onclick="selectImage({{ $loop->index }})"
                                title="{{ $img->title ?? 'Image ' . ($loop->index + 1) }}">
                            <img src="{{ asset($img->image) }}"
                                 alt="{{ $img->image_alt ?? $img->title ?? 'thumbnail' }}"
                                 loading="lazy">
                        </button>
                    @endforeach
                </div>

                {{-- CENTER: Big image --}}
                <div class="gv-main-card" id="gvMainCard">
                    <button type="button" class="gv-nav-btn gv-nav-left" onclick="navigate(-1)" aria-label="Previous">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <div class="gv-img-area" onclick="openLightbox()">
                        <img id="gvMainImg" src="" alt="" class="gv-main-img">
                        <div class="gv-zoom-hint">
                            <i class="fas fa-expand-alt me-1"></i> Click to view full screen
                        </div>
                    </div>

                    <button type="button" class="gv-nav-btn gv-nav-right" onclick="navigate(1)" aria-label="Next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                {{-- RIGHT: Title, description --}}
                <div class="gv-info-card">
                    <a href="{{ $backUrl }}" class="gv-back-btn">
                        <i class="fas fa-arrow-left me-2"></i>Back to Gallery
                    </a>
                    <div class="gv-info-counter" id="gvCounterRight"></div>
                    <h2 class="gv-info-title" id="gvTitle"></h2>
                    <div class="gv-info-divider"></div>
                    <p class="gv-info-desc" id="gvDesc"></p>
                    <div class="gv-info-keys">
                        <i class="fas fa-keyboard me-2"></i>
                        <small>Use arrow keys to navigate</small>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Fullscreen lightbox --}}
    <div id="gvLightbox" class="gv-lightbox" aria-hidden="true">
        <div class="gv-lb-top">
            <span class="gv-lb-counter" id="gvLbCounter"></span>
            <button type="button" class="gv-lb-close" onclick="closeLightbox()" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="gv-lb-stage" id="gvLbStage">
            <button type="button" class="gv-lb-nav gv-lb-prev" onclick="navigate(-1)" aria-label="Previous">
                <i class="fas fa-chevron-left"></i>
            </button>

            <img id="gvLightboxImg" src="" alt="" class="gv-lb-img">

            <button type="button" class="gv-lb-nav gv-lb-next" onclick="navigate(1)" aria-label="Next">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <div class="gv-lb-caption" id="gvLbCaption"></div>

        <div class="gv-lb-thumbs" id="gvLbThumbs">
            @foreach($images as $img)
                <button type="button" class="gv-lb-thumb" onclick="selectImage({{ $loop->index }})">
                    <img src="{{ asset($img->image) }}"
                         alt="{{ $img->image_alt ?? $img->title ?? 'thumbnail' }}"
                         loading="lazy">
                </button>
            @endforeach
        </div>
    </div>

    <script>
    const images   = {!! json_encode($galleryJson) !!};
    let current    = {{ (int) $startIndex }};

    const mainImg     = document.getElementById('gvMainImg');
    const titleEl     = document.getElementById('gvTitle');
    const descEl      = document.getElementById('gvDesc');
    const counterR    = document.getElementById('gvCounterRight');
    const thumbsEl    = document.getElementById('gvThumbs');
    const bcTitle     = document.getElementById('bcTitle');
    const lightbox    = document.getElementById('gvLightbox');
    const lightboxImg = document.getElementById('gvLightboxImg');
    const lbCounter   = document.getElementById('gvLbCounter');
    const lbCaption   = document.getElementById('gvLbCaption');
    const lbThumbsEl  = document.getElementById('gvLbThumbs');
    const lbStage     = document.getElementById('gvLbStage');

    function render(index, fade) {
        const item = images[index];

        if (fade) {
            mainImg.classList.add('gv-fade');
            setTimeout(function () {
                mainImg.src = item.src;
                mainImg.alt = item.alt;
                mainImg.classList.remove('gv-fade');
            }, 160);
        } else {
            mainImg.src = item.src;
            mainImg.alt = item.alt;
        }

        titleEl.textContent = item.title;
        titleEl.classList.toggle('d-none', !item.title);
        descEl.textContent  = item.desc;
        descEl.classList.toggle('d-none', !item.desc);

        const label = (index + 1).toString().padStart(2,'0') + ' / ' + images.length.toString().padStart(2,'0');
        counterR.textContent  = 'Photo ' + label;
        lbCounter.textContent = label;
        lbCaption.textContent = item.title;
        lbCaption.classList.toggle('d-none', !item.title);
        if (bcTitle) bcTitle.textContent = item.title || ('Image ' + (index + 1));

        thumbsEl.querySelectorAll('.gv-thumb').forEach(function (el, i) {
            el.classList.toggle('gv-active', i === index);
        });
        lbThumbsEl.querySelectorAll('.gv-lb-thumb').forEach(function (el, i) {
            el.classList.toggle('gv-active', i === index);
        });

        if (lightbox.classList.contains('gv-lb-open')) {
            lightboxImg.src = item.src;
            lightboxImg.alt = item.alt;
        }
    }

    function selectImage(index) {
        current = index;
        render(index, true);
        scrollThumbs(index);
    }

    function navigate(dir) {
        if (!images.length) return;
        selectImage((current + dir + images.length) % images.length);
    }

    // Scroll only inside the thumbnail containers, never the page
    function scrollInto(container, el) {
        if (!el) return;
        if (container.scrollHeight > container.clientHeight) {
            container.scrollTo({ top: el.offsetTop - container.clientHeight / 2 + el.offsetHeight / 2, behavior: 'smooth' });
        }
        if (container.scrollWidth > container.clientWidth) {
            container.scrollTo({ left: el.offsetLeft - container.clientWidth / 2 + el.offsetWidth / 2, behavior: 'smooth' });
        }
    }

    function scrollThumbs(index) {
        scrollInto(thumbsEl, thumbsEl.querySelectorAll('.gv-thumb')[index]);
        scrollInto(lbThumbsEl, lbThumbsEl.querySelectorAll('.gv-lb-thumb')[index]);
    }

    function openLightbox() {
        if (!images.length) return;
        lightboxImg.src = images[current].src;
        lightboxImg.alt = images[current].alt;
        lightbox.classList.add('gv-lb-open');
        lightbox.setAttribute('aria-hidden', 'false');
        document.body.classList.add('gv-no-scroll');
        scrollThumbs(current);
    }

    function closeLightbox() {
        lightbox.classList.remove('gv-lb-open');
        lightbox.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('gv-no-scroll');
    }

    // Click on the empty area around the image closes the lightbox
    lbStage.addEventListener('click', function (e) {
        if (e.target === lbStage) closeLightbox();
    });

    // Touch swipe left/right on main image and lightbox
    function enableSwipe(el) {
        let startX = null;
        el.addEventListener('touchstart', function (e) { startX = e.touches[0].clientX; }, { passive: true });
        el.addEventListener('touchend', function (e) {
            if (startX === null) return;
            const dx = e.changedTouches[0].clientX - startX;
            if (Math.abs(dx) > 50) navigate(dx < 0 ? 1 : -1);
            startX = null;
        });
    }
    enableSwipe(document.getElementById('gvMainCard'));
    enableSwipe(lbStage);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'ArrowRight') navigate(1);
        if (e.key === 'ArrowLeft')  navigate(-1);
        if (e.key === 'Escape') {
            if (lightbox.classList.contains('gv-lb-open')) closeLightbox();
            else window.location.href = '{{ $backUrl }}';
        }
    });

    window.addEventListener('DOMContentLoaded', function () {
        if (images.length) { render(current, false); scrollThumbs(current); }
    });
    </script>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/gallery-view.css') }}">
@endsection
