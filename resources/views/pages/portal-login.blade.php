{{-- resources/views/pages/portal-login.blade.php --}}
@extends('layouts.app')

@section('title', 'Login Portal — Guru Nanak Institute of Medical Technology')
@section('meta_description', 'Access GNIMT portal — Student, Admin, Branch and Staff login for Guru Nanak Institute of Medical Technology.')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/pages/portal-login.css') }}">
@endsection

@section('content')
<div class="login-page">

    {{-- ── LEFT PANEL ── --}}
    <div class="lp-left">
        <div class="lp-accent-line"></div>

        <div class="lp-logo">
            <img src="{{ asset('images/logo.png') }}"
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
                Need help? Contact us at <a href="mailto:gnimt.official@gmail.com">gnimt.official@gmail.com</a><br>
                or call <a href="tel:8283929908">+91-8283929908</a> (Patiala) &nbsp;/&nbsp; <a href="tel:8150019000">+91-8150019000</a> (Karnal)
            </p>
        </div>
    </div>

</div>
@endsection
