@extends('admin.layouts.admin')

@section('title', 'Admin Dashboard')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endsection

@section('content')


<div class="dashboard-wrapper">

    <div class="dash-page-title">
        <h2>{{ auth()->user()->isSuperAdmin() ? 'Admin Dashboard' : 'Welcome, ' . auth()->user()->name }}</h2>
        <p>
            @if(auth()->user()->isSuperAdmin())
                Manage Courses , Programs , Announcements and reports from one place.
            @else
                You are signed in as <strong>{{ optional(auth()->user()->staffRole)->name }}</strong>. Use the menu on the left to open the sections you have access to.
            @endif
        </p>
    </div>

   <div class="dash-stats-grid">

    @if(!is_null($totalCourses))
    <div class="dash-stat-card">
        <div class="dash-stat-card-icon">
            <i class="fas fa-book"></i>
        </div>
        <h3>{{ $totalCourses }}</h3>
        <span>Total Courses</span>
    </div>

    <div class="dash-stat-card red">
        <div class="dash-stat-card-icon">
            <i class="fas fa-layer-group"></i>
        </div>
        <h3>{{ $totalPrograms }}</h3>
        <span>Total Programs</span>
    </div>
    @endif

    @if(!is_null($totalAnnouncements))
    <div class="dash-stat-card">
        <div class="dash-stat-card-icon">
            <i class="fas fa-bullhorn"></i>
        </div>
        <h3>{{ $totalAnnouncements }}</h3>
        <span>Total Announcements</span>
    </div>
    @endif

    @if(!is_null($totalAdmissions))
  <div class="dash-stat-card red">
    <div class="dash-stat-card-icon">
        <i class="fas fa-file-alt"></i>
    </div>
   <h3>{{ $totalAdmissions }}</h3>
<span>Admission Applications</span>
</div>
    @endif

    @if(!is_null($totalGalleryImages))
    <div class="dash-stat-card">
        <div class="dash-stat-card-icon">
            <i class="fas fa-images"></i>
        </div>
        <h3>{{ $totalGalleryImages }}</h3>
        <span>Gallery Images</span>
    </div>

    <div class="dash-stat-card red">
        <div class="dash-stat-card-icon">
            <i class="fas fa-folder-open"></i>
        </div>
        <h3>{{ $totalGalleryCategories }}</h3>
        <span>Gallery Categories</span>
    </div>
    @endif

</div>

   <div class="dashboard-grid">

    @if(!is_null($latestAnnouncements))
    <div class="dash-panel-card">
        <h4>Latest Announcements</h4>

        @forelse($latestAnnouncements as $announcement)
            <div class="dash-activity-item">
                <div class="dash-activity-dot"></div>
                <div>
                    <p>{{ $announcement->title ?? 'No Title' }}</p>
                    <small>
                        {{ $announcement->created_at ? $announcement->created_at->format('d M Y') : '' }}
                    </small>
                </div>
            </div>
        @empty
            <p>No announcements found.</p>
        @endforelse
    </div>
    @endif

    @if(!is_null($latestAdmissions))
    <div class="dash-panel-card">
        <h4>Latest Admission Applications</h4>

        @forelse($latestAdmissions as $application)
            <div class="dash-activity-item">
                <div class="dash-activity-dot"></div>
                <div>
                    <p>{{ $application->candidate_name }}</p>
                    <small>
                    {{ $application->email }} |  {{ $application->mobile }} | {{ $application->status }}
                    </small>
                </div>
            </div>
        @empty
            <p>No admission applications found.</p>
        @endforelse
    </div>
    @endif

</div>

@endsection
