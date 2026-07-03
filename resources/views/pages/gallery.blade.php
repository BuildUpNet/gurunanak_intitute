@extends('layouts.app')

@section('title', 'Campus Gallery | GNIMT')
@section('meta_description',
    'Take a virtual tour of GNIMT. Explore our modern clinical labs, smart classrooms, events,
    and campus life.')

@section('content')

    <section class="page-hero" aria-label="Gallery">
        <div class="container-fluid px-4 px-lg-5">
            <div class="gold-line"></div>
            <h1>Campus Gallery</h1>
            <p>Explore the vibrant life, infrastructure, and memories at GNIMT.</p>
        </div>
    </section>

    <nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
        <div class="container-fluid px-4 px-lg-5">
            <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
            <span class="current">Gallery</span>
        </div>
    </nav>

    <section class="section-py" style="background:var(--light);">
        <div class="container-fluid px-4 px-lg-5">
            <div class="row g-5">

                {{-- Sidebar --}}
                <div class="col-lg-3">
                    <div class="bg-white p-4 rounded-4 shadow-sm mb-4">
                        <h3 class="fs-5 fw-bold text-navy mb-3 pb-2 border-bottom">Categories</h3>
                        <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
                            <li>
                                <a href="{{ route('gallery') }}"
                                    class="text-decoration-none {{ !$selectedCategory ? 'text-danger fw-bold' : 'text-muted' }}">
                                    <i class="fas fa-angle-right me-2"></i>All Categories
                                </a>
                            </li>
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('gallery', ['category' => $category->id]) }}"
                                        class="text-decoration-none {{ $selectedCategory == $category->id ? 'text-danger fw-bold' : 'text-muted' }}">
                                        <i class="fas fa-angle-right me-2"></i>{{ $category->title }}
                                    </a>
                                    @if ($selectedCategory == $category->id && $category->subcategories->count())
                                        <ul class="list-unstyled ps-4 mt-2 d-flex flex-column gap-2">
                                            @foreach ($category->subcategories as $sub)
                                                <li>
                                                    <a href="{{ route('gallery', ['category' => $category->id, 'subcategory' => $sub->id]) }}"
                                                        class="text-decoration-none small {{ $selectedSubCategory == $sub->id ? 'text-danger fw-bold' : 'text-muted' }}">
                                                        <i class="fas fa-circle me-2"
                                                            style="font-size:7px;"></i>{{ $sub->title }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="bg-white p-4 rounded-4 shadow-sm">
                        <h3 class="fs-5 fw-bold text-navy mb-3 pb-2 border-bottom">Year</h3>
                        <div class="d-flex flex-wrap gap-2">
                            @php $currentCategory = $categories->firstWhere('id', $selectedCategory); @endphp
                            @if ($currentCategory && $currentCategory->subcategories->count())
                                @foreach ($currentCategory->subcategories as $sub)
                                    <a href="{{ route('gallery', ['category' => $currentCategory->id, 'subcategory' => $sub->id]) }}"
                                        class="badge text-decoration-none p-2 fs-6 {{ $selectedSubCategory == $sub->id ? 'bg-danger' : 'bg-light text-dark border' }}">
                                        {{ $sub->title }}
                                    </a>
                                @endforeach
                            @else
                                <span class="badge bg-light text-dark border p-2 fs-6">No Year Selected</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Image Grid --}}
                <div class="col-lg-9">
                    @php
                        $activeCategory = $categories->firstWhere('id', $selectedCategory);
                        $activeSub = $activeCategory
                            ? $activeCategory->subcategories->firstWhere('id', $selectedSubCategory)
                            : null;
                    @endphp

                    <h2 class="fs-4 fw-bold text-navy mb-4">
                        {{ $activeSub->title ?? ($activeCategory->title ?? 'All Gallery Images') }}
                        <span class="text-muted fs-5">({{ $images->total() }} Photos)</span>
                    </h2>

                    <div class="row g-4">
                        @forelse($images as $image)
                            @php
                                $params = array_filter([
                                    'category' => $selectedCategory,
                                    'subcategory' => $selectedSubCategory,
                                    'image' => $image->id,
                                ]);
                            @endphp
                            <div class="col-md-6 col-lg-4">
                                <a href="{{ route('gallery.view', $params) }}" class="gal-link">
                                    <div class="gal-card">
                                        <img src="{{ asset($image->image) }}"
                                            alt="{{ $image->image_alt ?? ($image->title ?? 'GNIMT Gallery Image') }}"
                                            class="gal-card-img" loading="lazy">
                                        <div class="gal-card-overlay">
                                            <i class="fas fa-search-plus"></i>
                                        </div>
                                        @if ($image->title)
                                            <div class="gal-card-label">{{ $image->title }}</div>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="bg-white rounded-4 shadow-sm p-5 text-center">
                                    <i class="fas fa-images fa-3x text-muted mb-3 d-block"></i>
                                    <h4 class="fw-bold text-navy">No Images Found</h4>
                                    <p class="text-muted mb-0">No gallery images available for this filter.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    @if ($images->hasPages())
                        <div class="mt-5 d-flex justify-content-center">
                            {{ $images->withQueryString()->links() }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </section>

    @include('partials.faq', [
        'title' => 'Gallery — Frequently Asked Questions',
        'subtitle' => 'Learn more about campus life, events, and facilities at GNIMT.',
        'faqs' => $globalFaqs,
    ])

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/gallery.css') }}">
@endsection
