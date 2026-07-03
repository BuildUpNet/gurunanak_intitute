<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap + FontAwesome --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/admin/layout-base.css') }}">

    @yield('styles')

    <link rel="stylesheet" href="{{ asset('css/admin/layout-icon-picker.css') }}">

</head>

<body>
    <div class="admin-wrapper">

        <aside class="admin-sidebar">
            <div class="admin-brand">
                <div class="admin-brand-icon">A</div>
                <div>
                    <h4>Admin Panel</h4>
                    <span>Institute Management</span>
                </div>
            </div>

            <ul class="admin-menu">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li
                    class="menu-item {{ request()->routeIs('admin.gallery-categories.*') || request()->routeIs('admin.gallery-subcategories.*') || request()->routeIs('admin.gallery-images.*') ? 'open active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link">
                        <i class="fas fa-images"></i>
                        <span>Gallery Management</span>
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>

                    <ul class="submenu">
                        <li>
                            <a href="{{ route('admin.gallery-categories.index') }}"
                                class="{{ request()->routeIs('admin.gallery-categories.*') ? 'active' : '' }}">
                                Gallery Categories
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.gallery-subcategories.index') }}"
                                class="{{ request()->routeIs('admin.gallery-subcategories.*') ? 'active' : '' }}">
                                Gallery Sub Categories
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.gallery-images.index') }}"
                                class="{{ request()->routeIs('admin.gallery-images.*') ? 'active' : '' }}">
                                Gallery Images
                            </a>
                        </li>

                    </ul>
                </li>
                <li
                    class="menu-item {{ request()->routeIs('admin.course-categories.*') || request()->routeIs('admin.program-categories.*') || request()->routeIs('admin.program-details.*') ? 'open active' : '' }}">

                    <a href="javascript:void(0);" class="menu-link">
                        <i class="fas fa-layer-group"></i>
                        <span>Programs Management</span>
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>

                    <ul class="submenu">

                        <li>
                            <a href="{{ route('admin.program-categories.index') }}"
                                class="{{ request()->routeIs('admin.program-categories.*') ? 'active' : '' }}">
                                Program Categories
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.course-categories.index') }}"
                                class="{{ request()->routeIs('admin.course-categories.*') ? 'active' : '' }}">
                                Schools
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.program-details.index') }}"
                                class="{{ request()->routeIs('admin.program-details.*') ? 'active' : '' }}">
                                Program Detail Pages
                            </a>
                        </li>

                    </ul>
                </li>
                 <li class="{{ request()->routeIs('admin.announcement.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.announcement.index') }}">
                        <i class="fas fa-bullhorn"></i>
                        <span>Announcement</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.hero-slides.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.hero-slides.index') }}">
                        <i class="fas fa-images"></i>
                        <span>Hero Slider</span>
                    </a>
                </li>
<li>
    <a href="{{ route('admin.faqs.index') }}">
        <i class="fas fa-question-circle"></i>
        <span>FAQs</span>
    </a>
</li>
                <li class="{{ request()->routeIs('admin.admissions.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.admissions.detail') }}">
                        <i class="fas fa-file-alt"></i>
                        <span>Admissions</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/contact-enquiries') ? 'active' : '' }}">
                    <a href="{{ route('admin.contact-enquiries.index') }}">
                        <i class="fas fa-envelope"></i>
                        <span>Contact Enquiries</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/enquiries') ? 'active' : '' }}">
                    <a href="{{ route('admin.enquiries.index') }}">
                        <i class="fas fa-inbox"></i>
                        <span>Quick Enquiries</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.profile.edit') }}">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
            </ul>
        </aside>

        <main class="admin-main">
            <div class="admin-topbar">
                <form class="admin-search" method="GET" action="{{ url()->current() }}">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search on this page...">
                </form>

                <div class="admin-profile">
                    <div class="text-end">
                        <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
                    </div>

                    <div class="admin-user-avatar">
                        @if (auth()->check() && auth()->user()->profile_photo)
                            <img src="{{ asset(auth()->user()->profile_photo) }}" alt="{{ auth()->user()->name }}">
                        @else
                            <div class="avatar">
                                {{ strtoupper(substr(optional(auth()->user())->name ?? 'A', 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="logout-btn">Logout</button>
                    </form>
                </div>
            </div>

            <section class="admin-content">
                @yield('content')
            </section>
        </main>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.menu-link').forEach(function(link) {
                link.addEventListener('click', function() {
                    const menuItem = this.closest('.menu-item');
                    menuItem.classList.toggle('open');
                });
            });
        });
    </script>

    <script src="{{ asset('js/icon-picker.js') }}"></script>
    @yield('scripts')
</body>

</html>
