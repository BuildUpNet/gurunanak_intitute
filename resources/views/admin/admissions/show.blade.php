@extends('admin.layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-admissions-show.css') }}">
@endsection

@section('content')
<div class="page-title mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2>Admission Application Detail</h2>
            <p>View submitted admission form</p>
        </div>

        <div>
            <a href="{{ route('admin.admissions.detail') }}" class="btn btn-secondary">
                Back
            </a>

            <a href="{{ route('admissions.pdf', $application->id) }}" class="btn btn-danger">
                Download PDF
            </a>
        </div>
    </div>
</div>

<div class="panel-card" style="overflow-x:auto;">
    @include('pdf.admission-form-style')
    @include('pdf.admission-form-content', ['app' => $application])
</div>
@endsection