@extends('admin.layouts.admin')

@section('title', 'Admin Dashboard')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endsection

@section('content')


<div class="dashboard-wrapper">

    <div class="dash-page-title">
        <h2>Admin Dashboard</h2>
        <p>Manage Courses , Programs , Announcements and reports from one place.</p>
    </div>

   <div class="dash-stats-grid">

    <div class="dash-stat-card">
        <div class="dash-stat-card-icon">
            <i class="fas fa-book"></i>
        </div>
        <h3>{{ $totalCourses ?? 0 }}</h3>
        <span>Total Courses</span>
    </div>

    <div class="dash-stat-card red">
        <div class="dash-stat-card-icon">
            <i class="fas fa-layer-group"></i>
        </div>
        <h3>{{ $totalPrograms ?? 0 }}</h3>
        <span>Total Programs</span>
    </div>

    <div class="dash-stat-card">
        <div class="dash-stat-card-icon">
            <i class="fas fa-bullhorn"></i>
        </div>
        <h3>{{ $totalAnnouncements ?? 0 }}</h3>
        <span>Total Announcements</span>
    </div>

  <div class="dash-stat-card red">
    <div class="dash-stat-card-icon">
        <i class="fas fa-file-alt"></i>
    </div>
   <h3>{{ $totalAdmissions ?? 0 }}</h3>
<span>Admission Applications</span>
</div>

</div>

   <div class="dashboard-grid">

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

</div>

@endsection