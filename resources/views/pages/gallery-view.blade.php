@extends('layouts.app')

@section('title', 'Gallery Viewer | GNIMT')
@section('meta_description', 'Browse campus gallery images at GNIMT.')

@php
    $backUrl = route('gallery');
    if ($selectedCategory)    $backUrl .= '?category=' . $selectedCategory;
    if ($selectedSubCategory) $backUrl .= ($selectedCategory ? '&' : '?') . 'subcategory=' . $selectedSubCategory;

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

    <section class="section-py" style="background: var(--light);">
        <div class="container-fluid px-4 px-lg-5">

            {{-- Top bar: back button + counter --}}
            <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
                <a href="{{ $backUrl }}" class="gv-back-btn">
                    <i class="fas fa-arrow-left me-2"></i>Back to Gallery
                </a>
                <span class="gv-counter-pill" id="gvCounter"></span>
            </div>

            {{-- Main layout: image left, info right --}}
            <div class="row g-4 align-items-start">

                {{-- LEFT: Big image + thumbnail strip --}}
                <div class="col-lg-8">

                    {{-- Big image card --}}
                    <div class="gv-main-card">

                        <button class="gv-nav-btn gv-nav-left" onclick="navigate(-1)" aria-label="Previous">
                            <i class="fas fa-chevron-left"></i>
                        </button>

                        <div class="gv-img-area" onclick="openLightbox()">
                            <img id="gvMainImg" src="" alt="" class="gv-main-img">
                            <div class="gv-zoom-hint">
                                <i class="fas fa-expand-alt"></i>
                            </div>
                        </div>

                        <button class="gv-nav-btn gv-nav-right" onclick="navigate(1)" aria-label="Next">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>

                    {{-- Thumbnail strip --}}
                    <div class="gv-thumbs-wrap mt-3">
                        <div class="gv-thumbs" id="gvThumbs">
                            @foreach($images as $img)
                                <button class="gv-thumb"
                                        onclick="selectImage({{ $loop->index }})"
                                        title="{{ $img->title ?? 'Image ' . ($loop->index + 1) }}">
                                    <img src="{{ asset($img->image) }}"
                                         alt="{{ $img->image_alt ?? $img->title ?? 'thumbnail' }}"
                                         loading="lazy">
                                </button>
                            @endforeach
                        </div>
                    </div>

                </div>

                {{-- RIGHT: Title, description, counter --}}
                <div class="col-lg-4">
                    <div class="gv-info-card">
                        <div class="gv-info-counter" id="gvCounterRight"></div>
                        <h2 class="gv-info-title" id="gvTitle"></h2>
                        <div class="gv-info-divider"></div>
                        <p class="gv-info-desc" id="gvDesc"></p>
                        <div class="gv-info-keys mt-4">
                            <i class="fas fa-keyboard me-2 text-muted"></i>
                            <small class="text-muted">Use arrow keys to navigate</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Fullscreen lightbox --}}
    <div id="gvLightbox" class="gv-lightbox">
        <div class="gv-lightbox-backdrop" onclick="closeLightbox()"></div>

        <button class="gv-lb-close" onclick="closeLightbox()">
            <i class="fas fa-times"></i>
        </button>

        <button class="gv-lb-nav gv-lb-prev" onclick="navigate(-1)">
            <i class="fas fa-chevron-left"></i>
        </button>

        <img id="gvLightboxImg" src="" alt="" class="gv-lb-img">

        <button class="gv-lb-nav gv-lb-next" onclick="navigate(1)">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>

    <script>
    const images   = {!! json_encode($galleryJson) !!};
    let current    = {{ (int) $startIndex }};

    const mainImg    = document.getElementById('gvMainImg');
    const titleEl    = document.getElementById('gvTitle');
    const descEl     = document.getElementById('gvDesc');
    const counterEl  = document.getElementById('gvCounter');
    const counterR   = document.getElementById('gvCounterRight');
    const thumbsEl   = document.getElementById('gvThumbs');
    const bcTitle    = document.getElementById('bcTitle');
    const lightbox   = document.getElementById('gvLightbox');
    const lightboxImg= document.getElementById('gvLightboxImg');

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

        titleEl.textContent   = item.title;
        titleEl.style.display = item.title ? '' : 'none';
        descEl.textContent    = item.desc;
        descEl.style.display  = item.desc ? '' : 'none';

        const label = (index + 1).toString().padStart(2,'0') + ' / ' + images.length.toString().padStart(2,'0');
        counterEl.textContent  = label;
        counterR.textContent   = 'Photo ' + label;
        if (bcTitle) bcTitle.textContent = item.title || ('Image ' + (index + 1));

        thumbsEl.querySelectorAll('.gv-thumb').forEach(function (el, i) {
            el.classList.toggle('gv-active', i === index);
        });

        if (lightbox.classList.contains('gv-lb-open')) {
            lightboxImg.src = item.src;
        }
    }

    function selectImage(index) {
        current = index;
        render(index, true);
        scrollThumb(index);
    }

    function navigate(dir) {
        current = (current + dir + images.length) % images.length;
        render(current, true);
        scrollThumb(current);
    }

    function scrollThumb(index) {
        const t = thumbsEl.querySelectorAll('.gv-thumb')[index];
        if (t) t.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
    }

    function openLightbox() {
        lightboxImg.src = images[current].src;
        lightbox.classList.add('gv-lb-open');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        lightbox.classList.remove('gv-lb-open');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'ArrowRight') navigate(1);
        if (e.key === 'ArrowLeft')  navigate(-1);
        if (e.key === 'Escape') {
            if (lightbox.classList.contains('gv-lb-open')) closeLightbox();
            else window.location.href = '{{ $backUrl }}';
        }
    });

    window.addEventListener('DOMContentLoaded', function () {
        if (images.length) { render(current, false); scrollThumb(current); }
    });
    </script>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/gallery-view.css') }}">
@endsection
