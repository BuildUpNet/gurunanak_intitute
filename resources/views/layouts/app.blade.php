<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <title>@yield('title', 'GNIMT – Guru Nanak Institute of Medical Technology')</title>
    <meta name="description" content="@yield('meta_description', 'Premier medical technology institute offering B.Voc & Diploma programs in OT, Radiology, MLT, Cardiac Care & more. UGC Recognised. Patiala & Karnal.')">
    <meta name="keywords" content="@yield('meta_keywords', 'GNIMT, medical technology, B.Voc, DMLT, OT technology, Patiala, UGC recognised')">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('og_title', 'GNIMT – Guru Nanak Institute of Medical Technology')">
    <meta property="og:description" content="@yield('og_description', 'Premier medical technology institute. UGC Recognised programs.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta name="twitter:card" content="summary_large_image">

    {{-- Schema --}}
    @yield('schema')

    {{-- Fonts & Icons --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    {{-- Global CSS --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<body>

    @include('partials.header')

    <main id="main-content">
        @yield('content')
    </main>

    @include('partials.footer')

    {{-- Fixed: Floating back-to-top --}}
    <button class="floating-top" id="floatingTop" aria-label="Back to top">
        <i class="fas fa-chevron-up"></i>
    </button>

    {{-- Fixed: Social media sidebar (right edge) --}}
    <div class="social-sidebar" aria-label="Follow us">
        <a href="https://www.facebook.com/Guru-Nanak-Institute-of-Medical-Technology-689772771089266" target="_blank" rel="noopener" aria-label="Facebook" class="ss-link ss-link--fb"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/gnimtpatiala/" target="_blank" rel="noopener" aria-label="Instagram" class="ss-link ss-link--ig"><i class="fab fa-instagram"></i></a>
        <a href="#" target="_blank" rel="noopener" aria-label="YouTube" class="ss-link ss-link--yt"><i class="fab fa-youtube"></i></a>
        <a href="https://wa.me/918283929908" target="_blank" rel="noopener" aria-label="WhatsApp" class="ss-link ss-link--wa"><i class="fab fa-whatsapp"></i></a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts'){{-- Page-specific CDN libs (e.g. Swiper) must load before main.js --}}
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
