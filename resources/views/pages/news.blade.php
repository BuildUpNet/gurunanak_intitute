@extends('layouts.app')

@section('title', 'News & Announcements | GNIMT')
@section('meta_description', 'Stay updated with the latest news, events, admission alerts, and announcements from Guru
    Nanak Institute of Medical Technology.')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/news.css') }}">
@endsection

@section('content')

    <section class="page-hero" aria-label="News">
        <div class="container-fluid px-4 px-lg-5">
            <div class="gold-line"></div>
            <h1>News & Announcements</h1>
            <p>Latest updates and events from our campus.</p>
        </div>
    </section>

    <nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
        <div class="container-fluid px-4 px-lg-5">
            <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
            <span class="current">News</span>
        </div>
    </nav>

    <section class="section-py">
        <div class="container-fluid px-4 px-lg-5">
            <div class="nw-wrap">

                @if ($newsItems->isEmpty())
                    <p class="text-muted text-center py-5">No news or announcements have been posted yet. Check back soon.</p>
                @else
                    @php $featured = $newsItems->first(); $rest = $newsItems->slice(1); @endphp

                    {{-- ── Featured story ── --}}
                    <a href="{{ route('news.show', $featured->slug) }}" class="nw-featured">
                        <div class="nw-featured-label"><i class="fas fa-bolt"></i> Latest Update</div>
                        @if ($featured->tag)
                            <span class="nw-featured-tag">{{ $featured->tag }}</span>
                        @endif
                        <h2 class="nw-featured-title">{{ $featured->title }}</h2>
                        @if ($featured->excerpt)
                            <p class="nw-featured-excerpt">{{ $featured->excerpt }}</p>
                        @endif
                        <div class="nw-featured-date">
                            <i class="fas fa-calendar-alt"></i>
                            {{ ($featured->date ?? $featured->created_at)?->format('d M Y') }}
                        </div>
                    </a>

                    @if ($rest->isNotEmpty())
                        {{-- ── Remaining news list ── --}}
                        <h3 class="nw-list-heading">More Updates</h3>

                        @foreach ($rest as $item)
                            @php $itemDate = $item->date ?? $item->created_at; @endphp
                            <a href="{{ route('news.show', $item->slug) }}" class="nw-item">
                                <div class="nw-item-date">
                                    <span class="nw-day">{{ $itemDate?->format('d') }}</span>
                                    <span class="nw-month">{{ $itemDate?->format('M Y') }}</span>
                                </div>
                                <div class="nw-item-body">
                                    @if ($item->tag)
                                        <span class="nw-item-tag">{{ $item->tag }}</span>
                                    @endif
                                    <h4 class="nw-item-title">{{ $item->title }}</h4>
                                    @if ($item->excerpt)
                                        <p class="nw-item-excerpt">{{ $item->excerpt }}</p>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    @endif
                @endif

            </div>
        </div>
    </section>

    @include('partials.faq', [
        'title' => 'News &amp; Updates — FAQs',
        'subtitle' => 'Stay informed about announcements, notices, and events at GNIMT.',
        'faqs' => $globalFaqs,
    ])

@endsection
