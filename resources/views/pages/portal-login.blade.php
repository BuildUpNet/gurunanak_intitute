{{-- resources/views/pages/portal-login.blade.php --}}
@extends('layouts.app')

@section('title', 'Login Portal — Guru Nanak Institute of Medical Technology')
@section('meta_description', 'Access GNIMT portal — Student, Admin, Branch and Staff login for Guru Nanak Institute of Medical Technology.')

@section('styles')
<style>
    /* ══════════════════════════════════════════
       GNIMT LOGIN PAGE — Premium Design
    ══════════════════════════════════════════ */
    body { margin: 0; }

    .login-page {
        min-height: 100vh;
        display: grid;
        grid-template-columns: 1fr 1fr;
        font-family: 'Poppins', sans-serif;
    }

    /* ── LEFT PANEL ── */
    .lp-left {
        position: relative;
        background: #0d1f3c;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 80px 70px;
        overflow: hidden;
    }

    /* Background campus image with overlay */
    .lp-left::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: url('https://www.gurunanakinstitute.com/wp-content/themes/GNIMT/images/top_bg.jpg');
        background-size: cover;
        background-position: center;
        opacity: .12;
    }

    /* Diagonal red accent */
    .lp-left::after {
        content: '';
        position: absolute;
        bottom: -80px;
        left: -80px;
        width: 320px;
        height: 320px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(192,38,45,.35), transparent 70%);
        pointer-events: none;
    }

    /* Top decorative line */
    .lp-accent-line {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #c0262d, #1a3566, #c0262d);
    }

    .lp-logo {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 64px;
    }

    .lp-logo img {
        width: 60px;
        height: 60px;
        object-fit: contain;
        filter: brightness(0) invert(1);
    }

    .lp-logo-text .lp-logo-name {
        font-size: .9rem;
        font-weight: 700;
        color: #fff;
        line-height: 1.2;
    }

    .lp-logo-text .lp-logo-sub {
        font-size: .68rem;
        color: rgba(255,255,255,.5);
        letter-spacing: .06em;
    }

    .lp-headline {
        position: relative;
        z-index: 2;
    }

    .lp-tag {
        display: inline-block;
        background: rgba(192,38,45,.85);
        color: #fff;
        font-size: .64rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
        padding: 5px 14px;
        border-radius: 2px;
        margin-bottom: 28px;
    }

    .lp-h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.2rem, 3.5vw, 3.2rem);
        font-weight: 700;
        color: #fff;
        line-height: 1.1;
        letter-spacing: -.02em;
        margin-bottom: 10px;
    }

    .lp-h1 span {
        color: #e8304a;
    }

    .lp-sub {
        font-size: .82rem;
        color: rgba(255,255,255,.5);
        letter-spacing: .12em;
        text-transform: uppercase;
        margin-bottom: 48px;
    }

    .lp-divider {
        width: 52px;
        height: 3px;
        background: #c0262d;
        border-radius: 2px;
        margin-bottom: 32px;
    }

    .lp-info {
        display: flex;
        flex-direction: column;
        gap: 14px;
        position: relative;
        z-index: 2;
    }

    .lp-info-item {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: .8rem;
        color: rgba(255,255,255,.65);
    }

    .lp-info-item i {
        color: rgba(192,38,45,.85);
        font-size: .9rem;
        flex-shrink: 0;
    }

    .lp-bottom {
        position: absolute;
        bottom: 32px;
        left: 70px;
        right: 70px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        z-index: 2;
    }

    .lp-year {
        font-family: 'Playfair Display', serif;
        font-size: 4.5rem;
        font-weight: 700;
        color: rgba(255,255,255,.04);
        line-height: 1;
        letter-spacing: -.04em;
        pointer-events: none;
    }

    .lp-back {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-size: .74rem;
        color: rgba(255,255,255,.45);
        text-decoration: none;
        transition: color .2s;
    }

    .lp-back:hover { color: rgba(255,255,255,.85); }

    /* ── RIGHT PANEL ── */
    .lp-right {
        background: #f5f7fc;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 80px 60px;
        position: relative;
    }

    .lp-right-inner {
        width: 100%;
        max-width: 500px;
    }

    .lp-right-tag {
        display: block;
        font-size: .68rem;
        font-weight: 600;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: #c0262d;
        margin-bottom: 10px;
    }

    .lp-right-h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.6rem, 2.5vw, 2rem);
        font-weight: 700;
        color: #0e1c33;
        margin-bottom: 8px;
        line-height: 1.2;
    }

    .lp-right-sub {
        font-size: .82rem;
        color: #6b7a99;
        margin-bottom: 48px;
        line-height: 1.65;
    }

    /* Login option cards */
    .lp-options {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .lp-option-card {
        background: #fff;
        border: 2px solid #e2e8f5;
        border-radius: 10px;
        padding: 28px 22px;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 14px;
        transition: all .28s cubic-bezier(.16,1,.3,1);
        position: relative;
        overflow: hidden;
    }

    .lp-option-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: #c0262d;
        transform: scaleX(0);
        transition: transform .28s;
    }

    .lp-option-card:hover {
        border-color: #c0262d;
        transform: translateY(-5px);
        box-shadow: 0 16px 48px rgba(192,38,45,.12);
        text-decoration: none;
    }

    .lp-option-card:hover::before {
        transform: scaleX(1);
    }

    .lp-opt-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1a3566, #0d2247);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: #fff;
        flex-shrink: 0;
        transition: background .28s, transform .28s;
        position: relative;
    }

    /* Campus image ring around icon */
    .lp-opt-icon::after {
        content: '';
        position: absolute;
        inset: -4px;
        border-radius: 50%;
        border: 2px solid rgba(192,38,45,.2);
        transition: border-color .28s;
    }

    .lp-option-card:hover .lp-opt-icon {
        background: linear-gradient(135deg, #c0262d, #8a0f14);
        transform: scale(1.08);
    }

    .lp-option-card:hover .lp-opt-icon::after {
        border-color: rgba(192,38,45,.5);
    }

    .lp-opt-title {
        font-size: .9rem;
        font-weight: 700;
        color: #0e1c33;
        line-height: 1.25;
    }

    .lp-opt-desc {
        font-size: .72rem;
        color: #8a96ae;
        line-height: 1.5;
    }

    .lp-opt-arrow {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: .72rem;
        font-weight: 600;
        color: #c0262d;
        margin-top: 4px;
        opacity: 0;
        transform: translateY(4px);
        transition: opacity .25s, transform .25s;
    }

    .lp-option-card:hover .lp-opt-arrow {
        opacity: 1;
        transform: none;
    }

    .lp-footer-note {
        margin-top: 36px;
        text-align: center;
        font-size: .74rem;
        color: #9aa3b8;
        line-height: 1.65;
    }

    .lp-footer-note a {
        color: #1a3566;
        font-weight: 600;
        text-decoration: none;
    }

    .lp-footer-note a:hover { color: #c0262d; }

    /* Responsive */
    @media(max-width: 900px) {
        .login-page {
            grid-template-columns: 1fr;
        }

        .lp-left {
            padding: 60px 32px 80px;
            min-height: 360px;
        }

        .lp-bottom { left: 32px; right: 32px; }

        .lp-right {
            padding: 60px 24px;
        }
    }

    @media(max-width: 480px) {
        .lp-options {
            grid-template-columns: 1fr;
        }

        .lp-option-card {
            flex-direction: row;
            text-align: left;
            gap: 18px;
        }

        .lp-opt-icon { flex-shrink: 0; }
    }
</style>
@endsection

@section('content')
<div class="login-page">

    {{-- ── LEFT PANEL ── --}}
    <div class="lp-left">
        <div class="lp-accent-line"></div>

        <div class="lp-logo">
            <img src="{{ asset('images/logo.png') }}"
                 onerror="this.src='https://www.gurunanakinstitute.com/wp-content/themes/GNIMT/images/logo.png'"
                 alt="GNIMT Logo">
            <div class="lp-logo-text">
                <div class="lp-logo-name">Guru Nanak Institute<br>of Medical Technology</div>
                <div class="lp-logo-sub">UGC Recognised &nbsp;·&nbsp; Est. 1991</div>
            </div>
        </div>

        <div class="lp-headline">
            <span class="lp-tag">Student &amp; Staff Portal</span>
            <h1 class="lp-h1">
                One Mission.<br>
                <span>Countless</span><br>
                Careers Built.
            </h1>
            <p class="lp-sub">Aspirations to Reality</p>
            <div class="lp-divider"></div>
        </div>

        <div class="lp-info">
            <div class="lp-info-item">
                <i class="fas fa-shield-alt"></i>
                <span>Secure encrypted portal access</span>
            </div>
            <div class="lp-info-item">
                <i class="fas fa-map-marker-alt"></i>
                <span>Patiala &amp; Karnal branches connected</span>
            </div>
            <div class="lp-info-item">
                <i class="fas fa-headset"></i>
                <span>Support: <a href="tel:8283929908" style="color:rgba(255,255,255,.75);text-decoration:none;">+91-8283929908</a></span>
            </div>
        </div>

        <div class="lp-bottom">
            <span class="lp-year">1991</span>
            <a href="{{ route('home') }}" class="lp-back">
                <i class="fas fa-arrow-left"></i> Back to Website
            </a>
        </div>
    </div>

    {{-- ── RIGHT PANEL ── --}}
    <div class="lp-right">
        <div class="lp-right-inner">
            <span class="lp-right-tag">Choose Your Portal</span>
            <h2 class="lp-right-h2">Select Login Section</h2>
            <p class="lp-right-sub">Access your respective portal below. Each section has dedicated tools, resources and records.</p>

            <div class="lp-options">

                <a href="https://portal.gurunanakinstitute.com/student/login" class="lp-option-card" target="_blank" rel="noopener">
                    <div class="lp-opt-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div>
                        <div class="lp-opt-title">Student Login</div>
                        <div class="lp-opt-desc">Access results, attendance &amp; notices</div>
                        <div class="lp-opt-arrow">Enter Portal <i class="fas fa-arrow-right"></i></div>
                    </div>
                </a>

                <a href="https://portal.gurunanakinstitute.com/admin/login" class="lp-option-card" target="_blank" rel="noopener">
                    <div class="lp-opt-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div>
                        <div class="lp-opt-title">Admin Login</div>
                        <div class="lp-opt-desc">Institute administration &amp; management</div>
                        <div class="lp-opt-arrow">Enter Portal <i class="fas fa-arrow-right"></i></div>
                    </div>
                </a>

                <a href="https://portal.gurunanakinstitute.com/branch/login" class="lp-option-card" target="_blank" rel="noopener">
                    <div class="lp-opt-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div>
                        <div class="lp-opt-title">Branch Login</div>
                        <div class="lp-opt-desc">Patiala &amp; Karnal branch access</div>
                        <div class="lp-opt-arrow">Enter Portal <i class="fas fa-arrow-right"></i></div>
                    </div>
                </a>

                <a href="https://portal.gurunanakinstitute.com/branch/staff/login" class="lp-option-card" target="_blank" rel="noopener">
                    <div class="lp-opt-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div>
                        <div class="lp-opt-title">Staff Login</div>
                        <div class="lp-opt-desc">Faculty &amp; staff portal access</div>
                        <div class="lp-opt-arrow">Enter Portal <i class="fas fa-arrow-right"></i></div>
                    </div>
                </a>

            </div>

            <p class="lp-footer-note">
                Need help? Contact us at <a href="mailto:info@gurunanakinstitute.com">info@gurunanakinstitute.com</a><br>
                or call <a href="tel:8283929908">+91-8283929908</a> (Patiala) &nbsp;/&nbsp; <a href="tel:8150019000">+91-8150019000</a> (Karnal)
            </p>
        </div>
    </div>

</div>
@endsection
