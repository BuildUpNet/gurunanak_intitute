@extends('layouts.app')

@section('title', $news->title . ' | GNIMT News')
@section('meta_description', Str::limit(strip_tags($news->excerpt ?? $news->content ?? $news->title), 155))

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/news-show.css') }}">
@endsection

@section('content')

    <section class="page-hero" aria-label="News">
        <div class="container-fluid px-4 px-lg-5">
            <div class="gold-line"></div>
            <h1>News & Announcements</h1>
        </div>
    </section>

    <nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
        <div class="container-fluid px-4 px-lg-5">
            <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
            <a href="{{ route('news') }}">News</a><span class="sep">/</span>
            <span class="current">{{ Str::limit($news->title, 40) }}</span>
        </div>
    </nav>

    <section class="section-py">
        <div class="container-fluid px-4 px-lg-5">
            <div class="nws-wrap">

                <a href="{{ route('news') }}" class="nws-back"><i class="fas fa-arrow-left"></i> Back to all News</a>

                <div class="nws-meta">
                    @if ($news->tag)
                        <span class="nws-tag">{{ $news->tag }}</span>
                    @endif
                    <span class="nws-date">
                        <i class="fas fa-calendar-alt"></i>
                        {{ ($news->date ?? $news->created_at)?->format('d M Y') }}
                    </span>
                </div>

                <h1 class="nws-title">{{ $news->title }}</h1>

                @if ($news->image)
                    <img src="{{ asset($news->image) }}" alt="{{ $news->title }}" class="nws-image">
                @endif

                <div class="nws-content">
                    @if ($news->content)
                        @foreach (preg_split('/\r?\n\r?\n/', trim($news->content)) as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    @elseif ($news->excerpt)
                        <p>{{ $news->excerpt }}</p>
                    @endif
                </div>

                @if ($related->isNotEmpty())
                    <div class="nws-related">
                        <h3 class="nws-related-heading">More News</h3>
                        @foreach ($related as $item)
                            <a href="{{ route('news.show', $item->slug) }}" class="nws-related-item">
                                <span class="nws-related-date">{{ ($item->date ?? $item->created_at)?->format('d M Y') }}</span>
                                <span class="nws-related-title">{{ $item->title }}</span>
                            </a>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </section>

@endsection
