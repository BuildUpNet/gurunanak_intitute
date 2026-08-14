@extends('layouts.app')

@section('title', $program->title . ' | GNIMT')
@section('meta_description', $program->short_name . ' at GNIMT — ' . $program->duration . ' ' . $program->level . ' program in ' . $program->school_name . '.')

@section('content')

    {{-- ════════════════════════════════════════════
     HERO
════════════════════════════════════════════ --}}
    <section class="lx-hero"
             style="background-image: url('{{ asset($program->hero_image ?? 'images/programs/bg1.jpg') }}')">
        <div class="lx-hero__layer lx-hero__layer--glow" aria-hidden="true"></div>
        <div class="lx-hero__layer lx-hero__layer--grid" aria-hidden="true"></div>

        {{-- Breadcrumb at top of hero --}}
        <div class="lx-hero__bc">
            <div class="lx-wrap">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <a href="{{ route('academics') }}">Academics</a>
                <span>/</span>
                <span class="lx-hero__bc-current">{{ $program->short_name }}</span>
            </div>
        </div>

        <div class="lx-wrap">
            <div class="lx-hero__grid">

                {{-- ── LEFT ── --}}
                <div class="lx-hero__left">

                    <div class="lx-hero__chip">
                        <span class="lx-hero__chip-dot"></span>
                        {{ $program->school_name }}
                    </div>

                    <h1 class="lx-hero__h1">
                        {{ Str::beforeLast($program->title, ' ') }}
                        <em>{{ Str::afterLast($program->title, ' ') }}</em>
                    </h1>

                    <div class="lx-hero__divline">
                        <span class="lx-hero__divline-bar"></span>
                        <span class="lx-hero__divline-tag">{{ $program->short_name }}</span>
                        <span class="lx-hero__divline-bar"></span>
                    </div>

                    <div class="lx-hero__meta">
                        <span><i class="fas fa-layer-group"></i> {{ $program->level }}</span>
                        <span><i class="fas fa-clock"></i> {{ $program->duration }}</span>
                        <span><i class="fas fa-map-marker-alt"></i> {!! $program->locations !!}</span>
                    </div>

                    <div class="lx-hero__actions">
                        <a href="{{ route('admissions.form') }}" class="lx-btn lx-btn--red lx-btn--lg">
                            <i class="fas fa-pen-nib"></i> Apply Now
                        </a>
                        <a href="#overview" class="lx-btn lx-btn--outline lx-btn--lg">
                            Explore Program
                        </a>
                    </div>

                </div>

                {{-- ── RIGHT: Info card ── --}}
                <div class="lx-hero__right">
                    <div class="lx-glass-card">
                        <div class="lx-glass-card__corner lx-glass-card__corner--tl" aria-hidden="true"></div>
                        <div class="lx-glass-card__corner lx-glass-card__corner--br" aria-hidden="true"></div>

                        <div class="lx-glass-card__badge">
                            <i class="fas fa-laptop-code"></i>
                            <span>Program at a Glance</span>
                        </div>

                        <div class="lx-glass-rows">
                            @php
                                $glanceItems = $program->glanceItems->isNotEmpty()
                                    ? $program->glanceItems
                                    : collect([(object) [
                                        'degree'      => $program->title,
                                        'duration'    => $program->duration,
                                        'eligibility' => $program->eligibility,
                                    ]]);
                            @endphp
                            @foreach ($glanceItems as $item)
                                <div class="lx-glass-group">
                                    @foreach ([
                                        ['Degree',      $item->degree],
                                        ['Duration',    $item->duration],
                                        ['Eligibility', $item->eligibility],
                                    ] as [$lbl, $val])
                                        @if($val)
                                            <div class="lx-glass-row">
                                                <span class="lx-glass-row__lbl">{{ $lbl }}</span>
                                                <span class="lx-glass-row__val">{{ $val }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                        <a href="{{ route('admissions.form') }}" class="lx-glass-apply">
                            <i class="fas fa-pen-nib"></i> Begin Application
                        </a>
                        <a href="{{ route('contact.patiala') }}" class="lx-glass-call">
                            <i class="fas fa-phone"></i> Speak to an Advisor
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <div class="lx-hero__slope" aria-hidden="true"></div>
    </section>


    {{-- ════════════════════════════════════════════
     OVERVIEW
════════════════════════════════════════════ --}}
    <section id="overview" class="lx-sec lx-sec--cream">
        <div class="lx-wrap">

            <div class="lx-sec-label">
                <span class="lx-sec-num">01</span>
                <span class="lx-sec-title">Program Overview</span>
            </div>

            <div class="lx-ov-grid">

                <div class="lx-ov__main">
                    <h2 class="lx-display-head">
                        About the<br>
                        <em>{{ $program->short_name }} Program</em>
                    </h2>

                    @if($program->quote)
                        <blockquote class="lx-pullquote">
                            <div class="lx-pullquote__mark">&ldquo;</div>
                            <p>{!! nl2br(e($program->quote)) !!}</p>
                            <div class="lx-pullquote__foot"><span></span></div>
                        </blockquote>
                    @endif

                    <div class="lx-body-copy">
                        @if($program->overview_1)<p>{!! $program->overview_1 !!}</p>@endif
                        @if($program->overview_2)<p>{!! $program->overview_2 !!}</p>@endif
                        @if($program->overview_3)<p>{!! $program->overview_3 !!}</p>@endif
                        @if($program->overview_4)<p>{!! $program->overview_4 !!}</p>@endif
                    </div>
                </div>

                <div class="lx-ov__aside">
                    <div class="lx-detail-card">
                        <div class="lx-detail-card__head">
                            <span class="lx-detail-card__ornament">◆</span>
                            <span>Program Details</span>
                        </div>
                        @foreach ([
                            ['fas fa-graduation-cap', 'Degree',   $program->title],
                            ['fas fa-hourglass-half', 'Duration', $program->duration],
                            ['fas fa-layer-group',    'Level',    $program->level],
                            ['fas fa-map-marker-alt', 'Campus',   $program->locations],
                        ] as [$icon, $lbl, $val])
                            <div class="lx-detail-row">
                                <div class="lx-detail-ico"><i class="{{ $icon }}"></i></div>
                                <div>
                                    <p class="lx-detail-lbl">{{ $lbl }}</p>
                                    <p class="lx-detail-val">{!! $val !!}</p>
                                </div>
                            </div>
                        @endforeach
                        <a href="{{ route('admissions.form') }}" class="lx-detail-btn">
                            Apply for {{ $program->short_name }} <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Ornamental divider --}}
    <div class="lx-divider" aria-hidden="true">
        <span></span>
        <i class="fas fa-diamond"></i>
        <i class="fas fa-diamond lx-divider__sm"></i>
        <i class="fas fa-diamond"></i>
        <span></span>
    </div>

    {{-- ════════════════════════════════════════════
     ELIGIBILITY
════════════════════════════════════════════ --}}
    @if($program->eligibility)
        <section id="eligibility" class="lx-sec lx-sec--white">
            <div class="lx-wrap">

                <div class="lx-sec-label">
                    <span class="lx-sec-num">02</span>
                    <span class="lx-sec-title">Eligibility Criteria</span>
                </div>

                <div class="lx-elig-layout">
                    <div class="lx-elig__head">
                        <h2 class="lx-display-head">
                            Who Can<br>
                            <em>Apply</em>
                        </h2>
                        <a href="{{ route('admissions.form') }}" class="lx-btn lx-btn--navy" style="margin-top:32px">
                            Apply Now <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="lx-elig__content">
                        <div class="lx-elig-box">
                            <div class="lx-elig-box__icon"><i class="fas fa-user-graduate"></i></div>
                            <p class="lx-elig-box__text">{!! $program->eligibility !!}</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    @endif

    {{-- ════════════════════════════════════════════
     EMPLOYMENT OPPORTUNITIES
════════════════════════════════════════════ --}}
    @if($opportunities->isNotEmpty())
        <section id="opportunities" class="lx-sec lx-sec--dark">
            <div class="lx-opp__bg-wm" aria-hidden="true">{{ $opportunities->count() }}</div>
            <div class="lx-wrap">

                <div class="lx-sec-label lx-sec-label--light">
                    <span class="lx-sec-num lx-sec-num--dim">03</span>
                    <span class="lx-sec-title lx-sec-title--light">Employment Opportunities</span>
                </div>

                <div class="lx-opp-header">
                    <h2 class="lx-display-head lx-display-head--white">
                        Career <em>Pathways</em>
                    </h2>
                    <p class="lx-opp-sub">
                        Employment opportunities after successful completion of the {{ $program->short_name }} program.
                    </p>
                </div>

                <div class="lx-opp-grid">
                    @foreach($opportunities as $i => $opp)
                        <div class="lx-opp-card">
                            <div class="lx-opp-card__num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
                            <div class="lx-opp-card__ico"><i class="{{ $opp->icon }}"></i></div>
                            <p class="lx-opp-card__name">{{ $opp->title }}</p>
                            <div class="lx-opp-card__shine" aria-hidden="true"></div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
    @endif

    {{-- ════════════════════════════════════════════
     AVAILABLE PROGRAM LEVELS
════════════════════════════════════════════ --}}
    @if($program->levels->isNotEmpty())
        <section id="levels" class="lx-sec lx-sec--white">
            <div class="lx-wrap">
                <div class="lx-sec-label">
                    <span class="lx-sec-num">04</span>
                    <span class="lx-sec-title">Available Program Levels</span>
                </div>
                <h2 class="lx-display-head">
                    Choose Your <em>Level</em>
                </h2>
                <p style="font-size:.85rem;color:#64748b;margin:12px 0 28px;">
                    {{ $program->short_name }} is offered at the following levels — same program, different duration.
                </p>
                <div class="lx-opp-grid">
                    @foreach($program->levels as $i => $lvl)
                        <div class="lx-opp-card">
                            <div class="lx-opp-card__num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
                            <div class="lx-opp-card__ico"><i class="fas fa-layer-group"></i></div>
                            <p class="lx-opp-card__name">{{ $lvl->category->title ?? 'Program' }}<br><strong>{{ $lvl->duration }}</strong></p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ════════════════════════════════════════════
     CAREER ROLES
════════════════════════════════════════════ --}}
    @if($program->careerRoles->isNotEmpty())
        <section id="career-roles" class="lx-sec lx-sec--cream">
            <div class="lx-wrap">
                <div class="lx-sec-label">
                    <span class="lx-sec-num">05</span>
                    <span class="lx-sec-title">Career Roles</span>
                </div>
                <h2 class="lx-display-head">
                    Roles You Can <em>Pursue</em>
                </h2>
                <div class="lx-opp-grid" style="margin-top:24px;">
                    @foreach($program->careerRoles as $i => $role)
                        <div class="lx-opp-card">
                            <div class="lx-opp-card__num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
                            <div class="lx-opp-card__ico"><i class="fas fa-user-tie"></i></div>
                            <p class="lx-opp-card__name">{{ $role->title }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ════════════════════════════════════════════
     GRADUATES WORK
════════════════════════════════════════════ --}}
    @if($program->graduatesWork->isNotEmpty())
        <section id="graduates-work" class="lx-sec lx-sec--white">
            <div class="lx-wrap">
                <div class="lx-sec-label">
                    <span class="lx-sec-num">06</span>
                    <span class="lx-sec-title">Where Our Graduates Work</span>
                </div>
                <h2 class="lx-display-head">
                    Recruiters &amp; <em>Employers</em>
                </h2>
                <div class="lx-opp-grid" style="margin-top:24px;">
                    @foreach($program->graduatesWork as $i => $work)
                        <div class="lx-opp-card">
                            <div class="lx-opp-card__num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
                            <div class="lx-opp-card__ico"><i class="fas fa-building"></i></div>
                            <p class="lx-opp-card__name">{{ $work->title }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ════════════════════════════════════════════
     COURSE FAQS — same accordion component used site-wide
════════════════════════════════════════════ --}}
    @include('partials.faq', [
        'faqs' => $program->faqs,
        'title' => $program->short_name . ' — Frequently Asked Questions',
        'subtitle' => 'Common questions about the ' . $program->title . ' program.',
    ])

    {{-- ════════════════════════════════════════════
     CTA
════════════════════════════════════════════ --}}
    <section class="lx-cta"
             style="background-image: url('{{ asset($program->cta_image ?? 'images/programs/bg2.jpg') }}')">
        <div class="lx-cta__glow" aria-hidden="true"></div>
        <div class="lx-cta__grid" aria-hidden="true"></div>
        <div class="lx-wrap">
            <div class="lx-cta__inner">

                <div class="lx-cta__kicker">
                    <span class="lx-cta__kicker-line"></span>
                    <span class="lx-cta__kicker-text">Guru Nanak Institute of Medical Technology</span>
                    <span class="lx-cta__kicker-line"></span>
                </div>

                <h2 class="lx-cta__h2">
                    Begin Your Journey<br>
                    <em>at GNIMT</em>
                </h2>

                <p class="lx-cta__sub">
                    {{ $program->title }} &nbsp;·&nbsp; {{ $program->level }} &nbsp;·&nbsp; {{ $program->duration }}
                </p>

                <div class="lx-cta__divider">
                    <span class="lx-cta__divider-line"></span>
                    <span class="lx-cta__divider-diamond">◆</span>
                    <span class="lx-cta__divider-line"></span>
                </div>

                <div class="lx-cta__btns">
                    <a href="{{ route('admissions.form') }}" class="lx-btn lx-btn--red lx-btn--lg">
                        <i class="fas fa-pen-nib"></i> Apply Now
                    </a>
                    <a href="{{ route('contact.patiala') }}" class="lx-btn lx-btn--outline lx-btn--lg">
                        <i class="fas fa-phone"></i> Talk to Advisor
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var links = document.querySelectorAll('.lx-nl');
            var sects = Array.from(links).map(function(l) {
                return document.querySelector(l.getAttribute('href'));
            }).filter(Boolean);
            var nav = document.getElementById('lxNav');

            function off() {
                return ((document.querySelector('.site-header') || {offsetHeight:0}).offsetHeight +
                        (nav ? nav.offsetHeight : 52) + 16);
            }

            function tick() {
                var sy = window.scrollY + off();
                var cur = sects[0];
                sects.forEach(function(s) { if (s && s.offsetTop <= sy) cur = s; });
                links.forEach(function(l) {
                    l.classList.toggle('active', l.getAttribute('href') === '#' + (cur && cur.id));
                });
            }
            if (sects.length) {
                window.addEventListener('scroll', tick, {passive: true});
                tick();
            }
        });
    </script>
@endsection
