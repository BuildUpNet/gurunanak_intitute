{{-- partials/header.blade.php --}}
<header class="site-header" id="siteHeader">

    {{-- ══════════════════════════════════════
     TOP UTILITY BAR — email + social + login
══════════════════════════════════════ --}}
    <div class="top-bar-premium">
        <div class="tbp-inner">
            <div class="tbp-left">
                <a href="mailto:gnimt.official@gmail.com" class="tbp-email">
                    <i class="fas fa-envelope"></i>
                    <span class="d-none d-md-inline">gnimt.official@gmail.com</span>
                </a>
                <div class="tbp-socials">
                    <a href="https://www.facebook.com/gurunanakinstitutepatiala" target="_blank" rel="noopener"
                        aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/gnimtpatiala/" target="_blank" rel="noopener"
                        aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    {{-- No YouTube channel link provided yet — re-enable once available:
                    <a href="#" target="_blank" rel="noopener" aria-label="YouTube"><i
                            class="fab fa-youtube"></i></a>
                    --}}
                    <a href="https://x.com/GuruPatiala" target="_blank" rel="noopener" aria-label="Twitter/X"><i
                            class="fab fa-twitter"></i></a>
                </div>
            </div>
            <div class="tbp-right">
                <a href="{{ route('portal.login') }}" class="tbp-login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
                {{-- Admission Helpline — full-height red blocks on far right (like Screenshot1.png) --}}
                <div class="nav-helpline" aria-label="Admission Contact">
                    <a href="tel:8283929908" class="nav-helpline-block">
                        <div class="nav-helpline-icon"><i class="fas fa-phone-alt"></i></div>
                        <div class="nav-helpline-text">
                            <span class="nav-helpline-label">Admission Helpline Patiala</span>
                            <span class="nav-helpline-num">+91-8283929908</span>
                        </div>
                    </a>
                    <a href="tel:8150019000" class="nav-helpline-block">
                        <div class="nav-helpline-icon"><i class="fas fa-phone-alt"></i></div>
                        <div class="nav-helpline-text">
                            <span class="nav-helpline-label">Admission Helpline Karnal</span>
                            <span class="nav-helpline-num">+91-8150019000</span>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>

    {{-- ══════════════════════════════════════
     MAIN NAV — with full-height helpline blocks on right
══════════════════════════════════════ --}}
    <div id="sw">
        <nav class="main-nav" role="navigation" aria-label="Main Navigation">

            {{-- Logo + Links + Hamburger container --}}
            <div class="container-fluid px-3 px-lg-4 d-flex align-items-center justify-content-between w-100">

                <a class="navbar-brand" href="{{ route('home') }}" aria-label="GNIMT Home">
                    <img src="{{ asset('images/logo.png') }}" alt="Guru Nanak Institute of Medical Technology"
                        width="56" height="56" loading="eager">
                    <div>
                        <div class="bn1">Guru Nanak Institute</div>
                        <div class="bn2">of Medical Technology<span class="bn2-extra"> &nbsp;|&nbsp; UGC
                                Recognised</span></div>
                    </div>
                </a>

                {{-- Desktop Nav Links --}}
                <ul class="nvl desk" id="mainNav" role="menubar">
                    <li role="none"><a href="{{ route('home') }}" role="menuitem"
                            @class(['active' => request()->routeIs('home')])>Home</a></li>
                    <li class="hm" data-mp="mp-about" role="none">
                        <a href="#" role="menuitem" aria-haspopup="true" aria-expanded="false">About Us <i
                                class="fas fa-chevron-down arr"></i></a>
                    </li>
                    <li class="hm" data-mp="mp-courses" role="none">
                        <a href="#" role="menuitem" aria-haspopup="true" aria-expanded="false">Departments <i
                                class="fas fa-chevron-down arr"></i></a>
                    </li>
                    <li class="hm" data-mp="mp-programs" role="none">
                        <a href="#" role="menuitem" aria-haspopup="true" aria-expanded="false">Programs <i
                                class="fas fa-chevron-down arr"></i></a>
                    </li>
                    <li class="hm" data-mp="mp-gallery" role="none">
                        <a href="#" role="menuitem" aria-haspopup="true" aria-expanded="false">Campus life <i
                                class="fas fa-chevron-down arr"></i></a>
                    </li>

                    <li class="hd" data-dp="dp-ach" role="none">
                        <a href="#" role="menuitem" aria-haspopup="true" aria-expanded="false">Achievers <i
                                class="fas fa-chevron-down arr"></i></a>
                    </li>
                    {{-- <li role="none"><a href="{{ route('results') }}" role="menuitem">Results</a></li> --}}

                    <li class="hm" data-mp="mp-adm" role="none">
                        <a href="#" role="menuitem" aria-haspopup="true" aria-expanded="false">Admissions <i
                                class="fas fa-chevron-down arr"></i></a>
                    </li>

                    <li class="hd" data-dp="dp-con" role="none">
                        <a href="{{ route('contact.patiala') }}" role="menuitem" aria-haspopup="true"
                            aria-expanded="false">Contact <i class="fas fa-chevron-down arr"></i>
                        </a>
                    </li>
                </ul>

                {{-- Mobile: Apply + Hamburger --}}
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('admissions.form') }}" class="btn-app d-none d-sm-inline-block d-xl-none">Apply
                        Now</a>
                    <button class="ham" id="hamBtn" aria-label="Open menu" aria-expanded="false">
                        <span></span><span></span><span></span>
                    </button>
                </div>

            </div>



        </nav>

        {{-- MEGA: ABOUT --}}
        <div class="mega-panel mp2" id="mp-about" role="region" aria-label="About Us Menu">
            <div class="mp2-wrap">

                <nav class="mp2-cats" aria-label="About categories">
                    <div class="mp2-cat active" data-cat="mp2-overview" role="button" tabindex="0">
                        <i class="fas fa-university mp2-icon"></i>
                        <span>Overview</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>
                    <div class="mp2-cat" data-cat="mp2-leadership" role="button" tabindex="0">
                        <i class="fas fa-user-tie mp2-icon"></i>
                        <span>Leadership</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>
                    <div class="mp2-cat" data-cat="mp2-affiliations" role="button" tabindex="0">
                        <i class="fas fa-handshake mp2-icon"></i>
                        <span>Affiliations &amp; Partnerships</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>
                    <a class="mp2-cat-link" href="{{ route('about') }}#awards">
                        <i class="fas fa-trophy mp2-icon"></i>
                        <span>Awards &amp; Recognition</span>
                        <i class="fas fa-external-link-alt mp2-arr" style="font-size:0.65rem;opacity:.5;"></i>
                    </a>
                    <a class="mp2-cat-link" href="{{ route('about.administration') }}">
                        <i class="fas fa-users-cog mp2-icon"></i>
                        <span>Administration</span>
                        <i class="fas fa-external-link-alt mp2-arr" style="font-size:0.65rem;opacity:.5;"></i>
                    </a>
                </nav>

                <div class="mp2-content">
                    {{-- Overview --}}
                    <div class="mp2-panel active" id="mp2-overview">
                        <div class="mp2-panel-hd"><i class="fas fa-university"></i>
                            <h4>Overview</h4>
                        </div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-2">
                            <a class="mlink" href="{{ route('about') }}#history"><i class="fas fa-dot-circle"></i>
                                History</a>
                            <a class="mlink" href="{{ route('about') }}#vision-mission"><i
                                    class="fas fa-dot-circle"></i> Mission &amp; Vision</a>
                            <a class="mlink" href="{{ route('about') }}#rules-regulations"><i
                                    class="fas fa-dot-circle"></i> Rules &amp; Regulations</a>
                            {{-- <a class="mlink" href="{{ route('about.anti-ragging') }}"><i
                                    class="fas fa-dot-circle"></i> Anti Ragging Policy</a> --}}
                            <a class="mlink" href="{{ route('about') }}#infrastructure"><i
                                    class="fas fa-dot-circle"></i> Infrastructure</a>
                        </div>
                        <div class="mp2-apply"><a href="{{ route('about') }}" class="fc-cta">Know More →</a></div>
                    </div>

                    {{-- Leadership --}}
                    <div class="mp2-panel" id="mp2-leadership">
                        <div class="mp2-panel-hd"><i class="fas fa-user-tie"></i>
                            <h4>Leadership</h4>
                        </div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-1">
                            <a class="mlink" href="{{ route('about') }}#directors-message"><i
                                    class="fas fa-dot-circle"></i> Director's Message</a>
                        </div>
                        <div class="mp2-apply"><a href="{{ route('about') }}#directors-message" class="fc-cta">Read
                                Message →</a></div>
                    </div>

                    {{-- Affiliations & Partnerships --}}
                    <div class="mp2-panel" id="mp2-affiliations">
                        <div class="mp2-panel-hd"><i class="fas fa-handshake"></i>
                            <h4>Affiliations &amp; Partnerships</h4>
                        </div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-2">
                            <a class="mlink" href="{{ route('about') }}#academic-affiliations"><i
                                    class="fas fa-dot-circle"></i> Academic Affiliations</a>
                            <a class="mlink" href="{{ route('about') }}#industry-partners"><i
                                    class="fas fa-dot-circle"></i> Industry Partners</a>
                        </div>
                        <div class="mp2-apply"><a href="{{ route('about') }}" class="fc-cta">View Details →</a>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        {{-- MEGA: COURSES — Dynamic --}}
        <div class="mega-panel mp2" id="mp-courses" role="region" aria-label="Courses Menu">
            <div class="mp2-wrap">

                <nav class="mp2-cats" aria-label="School categories">
                    @forelse($courseCategories as $category)
                        <div class="mp2-cat {{ $loop->first ? 'active' : '' }}"
                            data-cat="mp2-cat-{{ $category->id }}" role="button" tabindex="0">

                            <i class="{{ $category->icon ?? 'fas fa-graduation-cap' }} mp2-icon"></i>
                            <span>{{ $category->title }}</span>
                            <i class="fas fa-chevron-right mp2-arr"></i>
                        </div>
                    @empty
                        <div class="mp2-cat active">
                            <i class="fas fa-graduation-cap mp2-icon"></i>
                            <span>No Categories Found</span>
                            <i class="fas fa-chevron-right mp2-arr"></i>
                        </div>
                    @endforelse
                </nav>

                <div class="mp2-content">
                    @forelse($courseCategories as $category)
                        <div class="mp2-panel {{ $loop->first ? 'active' : '' }}" id="mp2-cat-{{ $category->id }}">

                            <div class="mp2-panel-hd">
                                <i class="{{ $category->icon ?? 'fas fa-graduation-cap' }}"></i>
                                <h4>{{ $category->title }}</h4>
                            </div>

                            <div class="mp2-divider"></div>

                            <div class="mp2-grid">
                                @forelse($category->programDetails as $course)
                                    <a class="mlink" href="{{ route('program.show', $course->slug) }}">
                                        <i class="fas fa-dot-circle"></i>
                                        {{ $course->title }}
                                    </a>
                                @empty
                                    <a class="mlink" href="{{ route('academics') }}">
                                        <i class="fas fa-dot-circle"></i>
                                        No courses found
                                    </a>
                                @endforelse
                            </div>

                            <div class="mp2-apply">
                                <a href="{{ route('academics') }}" class="fc-cta">View All Programs →</a>
                                <a href="{{ route('admissions.form') }}" class="fc-cta mp2-apply-enq">Apply Now →</a>
                            </div>
                        </div>
                    @empty
                        <div class="mp2-panel active">
                            <div class="mp2-panel-hd">
                                <i class="fas fa-graduation-cap"></i>
                                <h4>No Course Categories Found</h4>
                            </div>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>

        {{-- MEGA: GALLERY --}}
        @php
            $firstGalleryCatWithSub = $categories->first(function ($c) {
                return $c->subcategories->isNotEmpty();
            });
        @endphp
        <div class="mega-panel mp3" id="mp-gallery" role="region" aria-label="Gallery Menu">
            <div class="mp3-wrap">

                {{-- Column 1: Categories --}}
                <nav class="mp3-cats" aria-label="Gallery Categories">
                    @forelse($categories as $key => $category)
                        @if ($category->subcategories->isEmpty())
                            <a href="{{ route('gallery', ['category' => $category->id]) }}" class="mp3-cat-link">
                                <i class="fas fa-images mp2-icon"></i>
                                <span>{{ $category->title }}</span>
                                <i class="fas fa-external-link-alt mp2-arr" style="font-size:0.65rem;opacity:.5;"></i>
                            </a>
                        @else
                            <div class="mp3-cat {{ optional($firstGalleryCatWithSub)->id === $category->id ? 'active' : '' }}"
                                data-gallery-target="gal-category-{{ $category->id }}"
                                data-preview="preview-category-{{ $category->id }}"
                                onmouseover="switchGalleryCat('gal-category-{{ $category->id }}', this)">

                                <i class="fas fa-images mp2-icon"></i>
                                <span>{{ $category->title }}</span>
                                <i class="fas fa-chevron-right mp2-arr"></i>
                            </div>
                        @endif
                    @empty
                        <div class="mp3-cat active">
                            <i class="fas fa-images mp2-icon"></i>
                            <span>No Category Found</span>
                        </div>
                    @endforelse
                </nav>

                {{-- Column 2: Sub Categories (only for categories that have them) --}}
                <div class="mp3-years-container">
                    @forelse($categories as $key => $category)
                        @continue($category->subcategories->isEmpty())
                        <div class="mp3-years-list {{ optional($firstGalleryCatWithSub)->id === $category->id ? 'active' : '' }}"
                            id="gal-category-{{ $category->id }}">

                            @foreach ($category->subcategories as $sub)
                                <a href="{{ route('gallery', ['category' => $category->id, 'subcategory' => $sub->id]) }}"
                                    class="mlink">
                                    <i class="fas fa-folder-open"></i>
                                    {{ $sub->title }}
                                </a>
                            @endforeach
                        </div>
                    @empty
                        <div class="mp3-years-list active">
                            <div class="mp3-years-hd">Sub Categories</div>
                            <a href="{{ route('gallery') }}" class="mlink">
                                <i class="fas fa-folder-open"></i>
                                View Gallery
                            </a>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
        {{-- MEGA: PROGRAMS --}}
        <div class="mega-panel mp-prog-panel" id="mp-programs" role="region" aria-label="Programs Menu">
            <div class="mp-prog">

                {{-- Search Row --}}
                <div class="mp-prog__search-row">
                    <div class="mp-prog__search-box">
                        <i class="fas fa-search mp-prog__si"></i>
                        <input type="text" class="mp-prog__sinput" id="progSearch"
                            placeholder="Search programs, courses, specializations..." autocomplete="off">
                        <kbd class="mp-prog__esc" id="progSearchEsc">ESC</kbd>
                    </div>
                    <a href="{{ route('academics') }}" class="mp-prog__browse-all">
                        <i class="fas fa-th-large"></i> Browse All
                    </a>
                </div>

                {{-- Category Tabs — single row across the top --}}
                <div class="mp-prog__cats-row">
                    @forelse($programCategories as $pc)
                        <a href="javascript:void(0)"
                            class="mp-prog__card {{ $loop->first ? 'mp-prog__card--active' : '' }}"
                            data-progcat="prog-cat-{{ $pc->id }}"
                            onclick="switchProgCat('prog-cat-{{ $pc->id }}', this)"
                            @if ($pc->image) style="background-image: url('{{ asset($pc->image) }}')" @endif>
                            <div class="mp-prog__card-inner">
                                <span class="mp-prog__card-bar"></span>
                                <span class="mp-prog__card-label">{{ $pc->title }}</span>
                            </div>
                        </a>
                    @empty
                        <a href="{{ route('academics') }}" class="mp-prog__card mp-prog__card--active">
                            <div class="mp-prog__card-inner">
                                <span class="mp-prog__card-bar"></span>
                                <span class="mp-prog__card-label">Programs</span>
                            </div>
                        </a>
                    @endforelse
                </div>

                {{-- Body --}}
                <div class="mp-prog__body">

                    {{-- Programs grouped by category (panel per category) --}}
                    <div class="mp-prog__right" id="progCatsArea">

                        @forelse($programCategories as $pc)
                            <div class="mp-prog__cat-panel {{ $loop->first ? 'mp-prog__cat-panel--active' : '' }}"
                                id="prog-cat-{{ $pc->id }}">
                                <p class="mp-prog__right-hd">{{ $pc->title }}</p>
                                <p class="mp-prog__right-sub">Click a program to view full details, eligibility &amp;
                                    careers</p>
                                <div class="mp-prog__cat-grid">
                                    @php $visibleCount = 0; @endphp
                                    @forelse($pc->programLevels as $lvl)
                                        @continue(!$lvl->programDetail)
                                        @php $visibleCount++; @endphp
                                        <a class="mp-prog__cat-link mp-prog__cat-link--detail {{ $visibleCount > 4 ? 'mp-prog__cat-link--extra' : '' }}"
                                            href="{{ route('program.show', $lvl->programDetail->slug) }}"
                                            data-search="{{ strtolower($lvl->programDetail->title . ' ' . $lvl->programDetail->short_name . ' ' . $lvl->duration) }}">
                                            <span class="mp-prog__cat-badge">{{ $lvl->duration }}</span>
                                            {{ $lvl->programDetail->title }}
                                        </a>
                                    @empty
                                        <div class="mp-prog__empty-state">
                                            <i class="fas fa-graduation-cap"></i>
                                            <p>No programs added yet</p>
                                        </div>
                                    @endforelse
                                    @if ($visibleCount > 4)
                                        <a href="{{ route('academics') }}#{{ $pc->slug }}"
                                            class="mp-prog__view-more">
                                            View More <i class="fas fa-arrow-right"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="mp-prog__cat-panel mp-prog__cat-panel--active">
                                <p class="mp-prog__right-hd">Programs</p>
                                <p class="mp-prog__right-sub">Click a program to view full details, eligibility &amp;
                                    careers</p>
                                <div class="mp-prog__cat-grid">
                                    @foreach ($programPageDetails as $pd)
                                        <a class="mp-prog__cat-link mp-prog__cat-link--detail"
                                            href="{{ route('program.show', $pd->slug) }}"
                                            data-search="{{ strtolower($pd->title . ' ' . $pd->short_name . ' ' . $pd->level) }}">
                                            <span class="mp-prog__cat-badge">{{ $pd->short_name }}</span>
                                            {{ $pd->title }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforelse

                        {{-- No Search Results --}}
                        <div class="mp-prog__no-res" id="progNoRes" style="display:none;">
                            <i class="fas fa-search"></i>
                            <p>No programs found for "<strong id="progSearchTerm"></strong>"</p>
                            <a href="{{ route('academics') }}">Browse all programs →</a>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        {{-- MEGA: ADMISSIONS --}}
        <div class="mega-panel mp2" id="mp-adm" role="region" aria-label="Admissions Menu">
            <div class="mp2-wrap">

                <nav class="mp2-cats" aria-label="Admissions categories">
                    <div class="mp2-cat active" data-cat="mp2-adm-qualify" role="button" tabindex="0">
                        <i class="fas fa-user-graduate mp2-icon"></i>
                        <span>Admission</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>
                    <div class="mp2-cat" data-cat="mp2-adm-process" role="button" tabindex="0">
                        <i class="fas fa-file-alt mp2-icon"></i>
                        <span>Admission Process</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>
                    <div class="mp2-cat" data-cat="mp2-adm-corner" role="button" tabindex="0">
                        <i class="fas fa-book-open mp2-icon"></i>
                        <span>Student Corner</span>
                        <i class="fas fa-chevron-right mp2-arr"></i>
                    </div>
                </nav>

                <div class="mp2-content">
                    {{-- Admission by Qualification --}}
                    <div class="mp2-panel active" id="mp2-adm-qualify">
                        <div class="mp2-panel-hd"><i class="fas fa-user-graduate"></i>
                            <h4>Admission</h4>
                        </div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-1">
                            <a class="mlink" href="{{ route('admissions') }}#after-10th"><i
                                    class="fas fa-dot-circle"></i> Courses after 10th</a>
                            <a class="mlink" href="{{ route('admissions') }}#after-12th"><i
                                    class="fas fa-dot-circle"></i> Courses after 12th</a>
                            <a class="mlink" href="{{ route('admissions') }}#after-graduation"><i
                                    class="fas fa-dot-circle"></i> Courses after Graduation</a>
                        </div>
                        <div class="mp2-apply">
                            <a href="{{ route('admissions.form') }}" class="fc-cta"
                                style="background:var(--red);color:#fff;padding:10px 20px;border-radius:8px;font-weight:700;text-decoration:none;">Apply
                                Now →</a>
                        </div>
                    </div>

                    {{-- Admission Process --}}
                    <div class="mp2-panel" id="mp2-adm-process">
                        <div class="mp2-panel-hd"><i class="fas fa-file-alt"></i>
                            <h4>Admission Process</h4>
                        </div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-2">
                            <a class="mlink" href="{{ route('admissions') }}#how-to-apply"><i
                                    class="fas fa-dot-circle"></i> How to Apply?</a>
                            <a class="mlink" href="{{ route('admissions') }}#eligibility"><i
                                    class="fas fa-dot-circle"></i> Eligibility Criteria</a>
                            <a class="mlink" href="{{ route('admissions') }}#fees"><i
                                    class="fas fa-dot-circle"></i> Fee Structure</a>
                            <a class="mlink" href="{{ route('admissions') }}#rules"><i
                                    class="fas fa-dot-circle"></i> Rules &amp; Regulations</a>
                        </div>
                        <div class="mp2-apply">
                            <a href="{{ route('admissions') }}" class="fc-cta">View Details →</a>
                        </div>
                    </div>

                    {{-- Student Corner --}}
                    <div class="mp2-panel" id="mp2-adm-corner">
                        <div class="mp2-panel-hd"><i class="fas fa-book-open"></i>
                            <h4>Student Corner</h4>
                        </div>
                        <div class="mp2-divider"></div>
                        <div class="mp2-grid mp2-grid-2">
                            <a class="mlink" href="{{ route('admissions') }}#academic-calendar"><i
                                    class="fas fa-dot-circle"></i> Academic Calendar</a>
                            <a class="mlink" href="{{ route('admissions') }}#exam-calendar"><i
                                    class="fas fa-dot-circle"></i> Examination Calendar</a>
                            <a class="mlink" href="{{ route('admissions') }}#refund-policy"><i
                                    class="fas fa-dot-circle"></i> Fees Refund Policy</a>
                            <a class="mlink" href="{{ route('admissions') }}#faqs"><i
                                    class="fas fa-dot-circle"></i> FAQs</a>
                            <a class="mlink" href="{{ route('admissions') }}#grievance"><i
                                    class="fas fa-dot-circle"></i> Grievance Redressal</a>
                        </div>
                        <div class="mp2-apply">
                            <a href="{{ route('admissions.form') }}" class="fc-cta mp2-apply-enq">Apply Now →</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- SIMPLE DROPS --}}
        <div class="drop-panel" id="dp-ach" role="menu">
            <a href="{{ route('achievers') }}" role="menuitem"><i class="fas fa-medal"></i> Our Achievers</a>
            <a href="{{ route('testimonials') }}" role="menuitem"><i class="fas fa-comment-alt"></i>
                Testimonials</a>
            <a href="{{ route('achievers') }}#govt-jobs" role="menuitem"><i class="fas fa-briefcase"></i> Students
                at Govt. Jobs</a>
            <a href="{{ route('achievers') }}#self-employed" role="menuitem"><i class="fas fa-user-tie"></i> Self
                Employed Students</a>
        </div>
        <div class="drop-panel" id="dp-con" role="menu">
            {{-- <a href="{{ route('contact') }}" role="menuitem"><i class="fas fa-envelope"></i> Contact Us</a> --}}
            <a href="{{ route('contact.patiala') }}" role="menuitem"><i class="fas fa-map-pin"></i> Patiala
                Branch</a>
            <a href="{{ route('contact.karnal') }}" role="menuitem"><i class="fas fa-map-pin"></i> Karnal Branch</a>
        </div>

    </div>{{-- /sw --}}

    {{-- ══════════════════════════════════════
     ANNOUNCEMENT TICKER
══════════════════════════════════════ --}}
    @if (isset($announcements) && $announcements->count() > 0)
        <div class="ann-ticker" aria-label="Announcements">
            <div class="ann-label">
                <i class="fas fa-bullhorn"></i>
                <span>Announcement</span>
            </div>

            <div class="ann-marquee-wrap">
                <div class="ann-marquee">

                    @foreach ($announcements as $announcement)
                        <span>
                            <a
                                href="{{ $announcement->link ?: ($announcement->slug ? route('news.show', $announcement->slug) : '#') }}">
                                {!! $announcement->title !!}
                            </a>
                        </span>

                        <span class="ann-sep">|</span>
                    @endforeach

                    {{-- duplicate for seamless infinite loop --}}
                    @foreach ($announcements as $announcement)
                        <span>
                            <a
                                href="{{ $announcement->link ?: ($announcement->slug ? route('news.show', $announcement->slug) : '#') }}">
                                {!! $announcement->title !!}
                            </a>
                        </span>

                        <span class="ann-sep">|</span>
                    @endforeach

                </div>
            </div>
        </div>
    @endif
    {{-- MOBILE DRAWER --}}
    <div class="d-ov" id="dov" aria-hidden="true"></div>
    <div class="drawer" id="drawer" role="dialog" aria-label="Mobile Navigation" aria-modal="true">
        <div class="d-head">
            <div class="d-head__brand">
                <img src="{{ asset('images/logo.png') }}" alt="GNIMT" height="44">
                <div>
                    <div class="d-head__bn1">Guru Nanak Institute</div>
                    <div class="d-head__bn2">of Medical Technology</div>
                </div>
            </div>
            <button class="d-close" id="dClose" aria-label="Close menu"><i class="fas fa-times"></i></button>
        </div>
        <div class="d-body">
            <div class="dmi"><a class="dml" href="{{ route('home') }}">Home</a></div>
            <div class="dmi">
                <div class="dml" data-ds="ds-about">About Us <i class="fas fa-chevron-down da"></i></div>
                <div class="dms" id="ds-about">
                    <div class="dms-h">Overview</div>
                    <a href="{{ route('about') }}#history"><i class="fas fa-dot-circle"></i> History</a>
                    <a href="{{ route('about') }}#vision-mission"><i class="fas fa-dot-circle"></i> Mission &amp;
                        Vision</a>
                    <a href="{{ route('about') }}#rules-regulations"><i class="fas fa-dot-circle"></i> Rules &amp;
                        Regulations</a>
                    {{-- <a href="{{ route('about.anti-ragging') }}"><i class="fas fa-dot-circle"></i> Anti Ragging
                        Policy</a> --}}
                    <a href="{{ route('about') }}#infrastructure"><i class="fas fa-dot-circle"></i>
                        Infrastructure</a>
                    <div class="dms-h">Leadership</div>
                    <a href="{{ route('about') }}#directors-message"><i class="fas fa-dot-circle"></i> Director's
                        Message</a>
                    <div class="dms-h">Affiliations &amp; Partnerships</div>
                    <a href="{{ route('about') }}#academic-affiliations"><i class="fas fa-dot-circle"></i> Academic
                        Affiliations</a>
                    <a href="{{ route('about') }}#industry-partners"><i class="fas fa-dot-circle"></i> Industry
                        Partners</a>
                    <div class="dms-h">Awards &amp; Recognition</div>
                    <a href="{{ route('about') }}#awards"><i class="fas fa-dot-circle"></i> Awards &amp;
                        Recognition</a>
                    <div class="dms-h">Administration</div>
                    <a href="{{ route('about.administration') }}"><i class="fas fa-dot-circle"></i> Administrative
                        Team</a>
                </div>
            </div>
            <div class="dmi">
                <div class="dml" data-ds="ds-courses">Courses <i class="fas fa-chevron-down da"></i></div>
                <div class="dms" id="ds-courses">
                    <div class="dms-h">School of Allied Health Sciences</div>
                    <a href="{{ route('program.show', 'physiotherapy') }}"><i class="fas fa-dot-circle"></i>
                        Physiotherapy</a>
                    <a href="{{ route('program.show', 'medical-lab-technology') }}"><i
                            class="fas fa-dot-circle"></i>
                        Medical Lab Technology</a>
                    <a href="{{ route('program.show', 'radiology-medical-imaging-technology') }}"><i
                            class="fas fa-dot-circle"></i> Radiology &amp; Medical Imaging</a>
                    <a href="{{ route('program.show', 'operation-theatre-anaesthesia-technology') }}"><i
                            class="fas fa-dot-circle"></i> OT &amp; Anaesthesia Technology</a>
                    <a href="{{ route('program.show', 'cardiac-care-technology') }}"><i
                            class="fas fa-dot-circle"></i> Cardiac Care Technology</a>
                    <a href="{{ route('program.show', 'dialysis-technology') }}"><i class="fas fa-dot-circle"></i>
                        Dialysis Technology</a>
                    <a href="{{ route('program.show', 'optometry-technology') }}"><i class="fas fa-dot-circle"></i>
                        Optometry Technology</a>
                    <a href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Emergency &amp; Trauma
                        Care</a>
                    <a href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Critical Care
                        Management</a>
                    <div class="dms-h">School of Healthcare Management</div>
                    <a href="{{ route('program.show', 'hospital-management') }}"><i class="fas fa-dot-circle"></i>
                        Hospital Management</a>
                    <a href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Hospital Administration</a>
                    <a href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Patient Care Management</a>
                    <a href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Nanny Training</a>
                    <div class="dms-h">Design, Management &amp; Others</div>
                    <a href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Fashion Technology</a>
                    <a href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> BBA / MBA / B.Com. /
                        M.Com.</a>
                    <a href="{{ route('program.show', 'mca') }}"><i class="fas fa-dot-circle"></i> MCA</a>
                    <a href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Dental Chair Side
                        Assistant</a>
                    <a href="{{ route('academics') }}"><i class="fas fa-dot-circle"></i> Panchkarma</a>
                    <a href="{{ route('academics') }}" style="font-weight:700;color:var(--red)"><i
                            class="fas fa-arrow-right"></i> View All Programs</a>
                </div>
            </div>
            <div class="dmi">
                <div class="dml" data-ds="ds-programs">Programs <i class="fas fa-chevron-down da"></i></div>
                <div class="dms" id="ds-programs">
                    @if ($programPageDetails->isNotEmpty())
                        <div class="dms-h">Program Detail Pages</div>
                        @foreach ($programPageDetails as $pd)
                            <a href="{{ route('program.show', $pd->slug) }}">
                                <i class="fas fa-dot-circle"></i> {{ $pd->short_name }} — {{ $pd->title }}
                            </a>
                        @endforeach
                    @endif
                    <div class="dms-h">Degree Programs</div>
                    <a href="{{ route('academics') }}#undergraduate"><i class="fas fa-dot-circle"></i> Undergraduate
                        (UG)</a>
                    <a href="{{ route('academics') }}#postgraduate"><i class="fas fa-dot-circle"></i> Postgraduate
                        (PG)</a>
                    <a href="{{ route('academics') }}#diploma-1"><i class="fas fa-dot-circle"></i> Diploma — I
                        Year</a>
                    <a href="{{ route('academics') }}#diploma-2"><i class="fas fa-dot-circle"></i> Diploma — II
                        Year</a>
                    <div class="dms-h">Short-term &amp; Online</div>
                    <a href="{{ route('academics') }}#certificate"><i class="fas fa-dot-circle"></i> Certificate
                        Program (6 months)</a>
                    <a href="{{ route('academics') }}#online"><i class="fas fa-dot-circle"></i> Online Programs</a>
                    <a href="{{ route('academics') }}" style="font-weight:700;color:var(--red)"><i
                            class="fas fa-arrow-right"></i> View All Programs</a>
                </div>
            </div>
            <div class="dmi">
                <div class="dml" data-ds="ds-adm">Admissions <i class="fas fa-chevron-down da"></i></div>
                <div class="dms" id="ds-adm">
                    <div class="dms-h">Admission</div>
                    <a href="{{ route('admissions') }}#after-10th"><i class="fas fa-dot-circle"></i> Courses after
                        10th</a>
                    <a href="{{ route('admissions') }}#after-12th"><i class="fas fa-dot-circle"></i> Courses after
                        12th</a>
                    <a href="{{ route('admissions') }}#after-graduation"><i class="fas fa-dot-circle"></i> Courses
                        after Graduation</a>
                    <div class="dms-h">Admission Process</div>
                    <a href="{{ route('admissions') }}#how-to-apply"><i class="fas fa-dot-circle"></i> How to
                        Apply?</a>
                    <a href="{{ route('admissions') }}#eligibility"><i class="fas fa-dot-circle"></i> Eligibility
                        Criteria</a>
                    <a href="{{ route('admissions') }}#fees"><i class="fas fa-dot-circle"></i> Fee Structure</a>
                    <a href="{{ route('admissions') }}#rules"><i class="fas fa-dot-circle"></i> Rules &amp;
                        Regulations</a>
                    <div class="dms-h">Student Corner</div>
                    <a href="{{ route('admissions') }}#academic-calendar"><i class="fas fa-dot-circle"></i> Academic
                        Calendar</a>
                    <a href="{{ route('admissions') }}#exam-calendar"><i class="fas fa-dot-circle"></i> Examination
                        Calendar</a>
                    <a href="{{ route('admissions') }}#refund-policy"><i class="fas fa-dot-circle"></i> Fees Refund
                        Policy</a>
                    <a href="{{ route('admissions') }}#faqs"><i class="fas fa-dot-circle"></i> FAQs</a>
                    <a href="{{ route('admissions') }}#grievance"><i class="fas fa-dot-circle"></i> Grievance
                        Redressal</a>
                    <a href="{{ route('admissions.form') }}" style="font-weight:700;color:var(--red)"><i
                            class="fas fa-arrow-right"></i> Apply Now</a>
                </div>
            </div>
            <div class="dmi">
                <div class="dml" data-ds="ds-ach">Achievers <i class="fas fa-chevron-down da"></i></div>
                <div class="dms" id="ds-ach">
                    <a href="{{ route('achievers') }}"><i class="fas fa-dot-circle"></i> Our Achievers</a>
                    <a href="{{ route('testimonials') }}"><i class="fas fa-dot-circle"></i> Testimonials</a>
                </div>
            </div>
            <div class="dmi"><a class="dml" href="{{ route('results') }}">Results</a></div>
            <div class="dmi">
                <div class="dml" data-ds="ds-con">Contact <i class="fas fa-chevron-down da"></i></div>
                <div class="dms" id="ds-con">
                    <a href="{{ route('contact.patiala') }}"><i class="fas fa-map-pin"></i> Patiala Branch</a>
                    <a href="{{ route('contact.karnal') }}"><i class="fas fa-map-pin"></i> Karnal Branch</a>
                </div>
            </div>
            <div class="dmi"><a class="dml" href="{{ route('portal.login') }}"><i
                        class="fas fa-sign-in-alt"></i> Login Portal</a></div>
            <div class="dmi" style="padding:8px 20px;">
                <a href="tel:8283929908"
                    style="display:flex;align-items:center;gap:8px;color:#c0262d;font-weight:700;font-size:.85rem;text-decoration:none;">
                    <i class="fas fa-phone-alt"></i> Patiala: +91-8283929908
                </a>
            </div>
            <div class="dmi" style="padding:8px 20px 16px;">
                <a href="tel:8150019000"
                    style="display:flex;align-items:center;gap:8px;color:#c0262d;font-weight:700;font-size:.85rem;text-decoration:none;">
                    <i class="fas fa-phone-alt"></i> Karnal: +91-8150019000
                </a>
            </div>
        </div>
        <div class="d-cta">
            <a href="{{ route('admissions.form') }}" class="btn-app">Apply Now</a>
        </div>
    </div>

</header>
