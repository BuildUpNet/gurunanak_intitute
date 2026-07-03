@extends('layouts.app')

@section('title', 'School of Healthcare Management | GNIMT')
@section('meta_description', 'Explore programs offered by the School of Healthcare Management at GNIMT — Hospital Management, Hospital Administration, Patient Care, Community Health and more.')

@section('content')

{{-- ─── HERO ─── --}}
<section class="dept-hero">
    <div class="dept-hero__inner">
        <span class="dept-hero__eyebrow">
            <i class="fas fa-hospital-alt"></i> School of Healthcare Management &amp; Community Health
        </span>
        <h1 class="dept-hero__h1">Shaping Leaders in<br><span>Healthcare Management</span></h1>
        <p class="dept-hero__sub">Equipping students with the knowledge, skills, and professional competencies to manage and lead modern healthcare institutions — from hospitals to community health programmes.</p>
        <div class="dept-hero__meta">
            <span><i class="fas fa-book-open"></i> 9 Programs</span>
            <span><i class="fas fa-clock"></i> 6 Months – 3 Years</span>
            <span><i class="fas fa-check-circle"></i> 10+2 Any Stream</span>
            <span><i class="fas fa-briefcase"></i> 100% Placement Support</span>
        </div>
        <div class="dept-hero__ctas">
            <a href="{{ route('admissions.form') }}" class="dept-btn dept-btn--red">Apply Now <i class="fas fa-arrow-right"></i></a>
            <a href="#programs" class="dept-btn dept-btn--outline">Explore Programs</a>
        </div>
    </div>
    {{-- Sticky in-page nav --}}
    <nav class="dept-page-nav" id="deptPageNav" aria-label="Program navigation">
        @foreach([
            ['hospital-management',     'Hospital Management'],
            ['hospital-administration', 'Hospital Administration'],
            ['patient-care-management', 'Patient Care Management'],
            ['hospital-waste',          'Hospital Waste Mgmt'],
            ['health-sanitary',         'Health &amp; Sanitary Inspector'],
            ['mphw',                    'Multipurpose Health Worker'],
            ['community-care',          'Community Care Provider'],
            ['home-care',               'Home Care Provider'],
            ['nanny-training',          'Nanny Training'],
        ] as [$anchor, $label])
        <a href="#{{ $anchor }}" class="dept-nav-link">{!! $label !!}</a>
        @endforeach
    </nav>
</section>

<nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
    <div class="container-fluid px-4 px-lg-5">
        <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
        <a href="{{ route('academics') }}">Academics</a><span class="sep">/</span>
        <span class="current">School of Healthcare Management</span>
    </div>
</nav>

{{-- ─── PROGRAMS ─── --}}
<div class="dept-body" id="programs">

@php
$programs = [
  [
    'id'     => 'hospital-management',
    'icon'   => 'fas fa-hospital',
    'color'  => '#1a3566',
    'title'  => 'Hospital Management',
    'quote'  => 'Leadership in healthcare is not about managing people; it is about improving patient outcomes.',
    'overview' => 'The Hospital Management program prepares students for managerial roles within healthcare facilities, focusing on the practical and managerial skills required to oversee smooth hospital operations, patient care processes, staff management, and healthcare policies. It includes both classroom learning and practical exposure to hospital operations through internships and projects.',
    'durations' => [
        ['Diploma',          '1 Year'],
        ['Advanced Diploma', '2 Years'],
        ['B.Voc Degree',     '3 Years'],
    ],
    'eligibility' => '10+2 Any Stream',
    'jobs' => [
        'Private Hospitals and Nursing Homes',
        'Diagnostic and Imaging Centers',
        'Healthcare Consultancy Firms',
        'Health Insurance Companies',
        'Medical Tourism Organizations',
        'Rehabilitation and Wellness Centers',
        'NGOs and Public Health Organizations',
        'Telemedicine and Digital Health Companies',
        'Pharmaceutical and Healthcare Service Companies',
    ],
    'career' => 'Hospital Executive → Department Coordinator → Assistant Manager → Hospital Manager → Hospital Administrator → Healthcare Director',
  ],
  [
    'id'     => 'hospital-administration',
    'icon'   => 'fas fa-clinic-medical',
    'color'  => '#c0262d',
    'title'  => 'Hospital Administration',
    'quote'  => 'A great hospital administrator doesn\'t just manage systems — they create an environment where quality healthcare thrives.',
    'overview' => 'Hospital Administration is an undergraduate program designed to develop skilled healthcare management professionals capable of managing the administrative and operational functions of healthcare institutions. The program focuses on equipping students with the knowledge, practical skills, and professional competencies required to ensure the smooth functioning of hospitals, clinics, diagnostic centers, and other healthcare organizations.',
    'durations' => [
        ['Diploma',          '1 Year'],
        ['Advanced Diploma', '2 Years'],
        ['B.Voc Degree',     '3 Years'],
    ],
    'eligibility' => '10+2 Any Stream',
    'jobs' => [
        'Multi-Specialty Hospitals',
        'Government Hospitals',
        'Private Healthcare Organizations',
        'Diagnostic and Pathology Laboratories',
        'Nursing Homes and Clinics',
        'Health Insurance Companies',
        'Pharmaceutical Companies',
        'Rehabilitation and Wellness Centres',
        'Medical Tourism Companies',
        'NGOs and Public Health Organizations',
        'Healthcare Consultancy Firms',
    ],
    'career' => null,
  ],
  [
    'id'     => 'patient-care-management',
    'icon'   => 'fas fa-hand-holding-heart',
    'color'  => '#1d7a4a',
    'title'  => 'Patient Care Management',
    'quote'  => 'Patient care is not just about treating illness; it is about caring for people with compassion, dignity, and respect.',
    'overview' => 'The Patient Care Management program prepares students to provide quality patient care and support healthcare services in hospitals, clinics, nursing homes, and community healthcare settings. The course combines theoretical knowledge with practical clinical training, focusing on patient assistance, healthcare communication, infection control, emergency care, and hospital operations.',
    'durations' => [
        ['Diploma',          '1 Year'],
        ['Advanced Diploma', '2 Years'],
        ['B.Voc Degree',     '3 Years'],
    ],
    'eligibility' => '10+2 Any Stream',
    'jobs' => ['Hospitals', 'Clinics', 'Nursing Homes', 'Rehabilitation Centers', 'Home Healthcare Agencies', 'Community Health Centers', 'Elderly Care Facilities', 'Healthcare NGOs'],
    'career' => null,
  ],
  [
    'id'     => 'hospital-waste',
    'icon'   => 'fas fa-recycle',
    'color'  => '#6d28d9',
    'title'  => 'Hospital Waste Management',
    'quote'  => 'Hospital waste management is not just a duty — it is a commitment to public health.',
    'overview' => 'The Diploma in Hospital Waste Management is a specialized course focusing on the management of biomedical waste in healthcare settings. The course covers techniques for safe handling, segregation, transportation, treatment, and disposal of biomedical waste, ensuring compliance with regulatory standards.',
    'durations' => [
        ['Diploma', '1 Year'],
    ],
    'eligibility' => '10+2 Any Stream',
    'jobs' => [
        'Hospitals and Medical Colleges',
        'Nursing Homes and Clinics',
        'Diagnostic Laboratories',
        'Biomedical Waste Treatment Plants',
        'Public Health Departments',
        'Healthcare Quality and Safety Departments',
        'Environmental Health Organizations',
        'Government and Private Healthcare Institutions',
    ],
    'career' => null,
  ],
  [
    'id'     => 'health-sanitary',
    'icon'   => 'fas fa-shield-virus',
    'color'  => '#b45309',
    'title'  => 'Health &amp; Sanitary Inspector',
    'quote'  => 'A Health and Sanitary Inspector safeguards communities by ensuring that cleanliness, hygiene, and public health standards are maintained every day.',
    'overview' => 'The Diploma in Health and Sanitary Inspector (HSI) is a professional program designed to prepare students for careers in public health, sanitation, environmental hygiene, and disease prevention. The course focuses on maintaining healthy living conditions in communities by ensuring proper sanitation, waste management, water quality, food hygiene, and environmental health standards.',
    'durations' => [
        ['Diploma', '1 Year'],
    ],
    'eligibility' => '10+2 Medical / Non-Medical',
    'jobs' => [
        'Municipal Corporations and Nagar Nigams',
        'Government Health Departments',
        'Public Health Engineering Departments',
        'Hospitals and Healthcare Institutions',
        'Community Health Centers',
        'Food Safety Departments',
        'Water Supply and Sanitation Departments',
        'Railways, Airports, and Defence Establishments',
        'Industrial Health and Safety Departments',
        'NGOs and Public Health Organizations',
    ],
    'career' => null,
  ],
  [
    'id'     => 'mphw',
    'icon'   => 'fas fa-user-nurse',
    'color'  => '#0e7490',
    'title'  => 'Multipurpose Health Worker',
    'quote'  => 'MPHWs are the frontline healthcare professionals who bring essential health services directly to the community.',
    'overview' => 'The Multipurpose Health Worker (MPHW) program prepares students for providing essential preventive, promotive, and basic curative healthcare services at the community level. Students learn about community health, first aid, nutrition, environmental sanitation, communicable disease control, family welfare services, record maintenance, and health awareness programs.',
    'durations' => [
        ['Diploma', '1 Year'],
    ],
    'eligibility' => '10+2 Any Stream',
    'jobs' => [
        'Government Health Departments', 'Primary Health Centres (PHCs)', 'Community Health Centres (CHCs)',
        'Sub-Health Centres', 'District Hospitals', 'Civil Hospitals',
        'Rural and Urban Health Missions', 'Maternal and Child Health Clinics',
        'National Health Mission (NHM) Projects', 'School Health Services',
        'Non-Governmental Organizations (NGOs)', 'Family Welfare Centres',
    ],
    'career' => null,
  ],
  [
    'id'     => 'community-care',
    'icon'   => 'fas fa-people-carry',
    'color'  => '#1a3566',
    'title'  => 'Community Care Provider',
    'quote'  => 'Community healthcare is not just about treating illness; it is about empowering people to live healthier lives.',
    'overview' => 'The Diploma in Community Care Provider is a skill-oriented healthcare program designed to prepare students to deliver primary healthcare services, health education, and patient support at the community level. The course focuses on developing competent healthcare workers who can assist in disease prevention, health promotion, basic patient care, and community outreach activities.',
    'durations' => [
        ['Diploma', '1 Year'],
    ],
    'eligibility' => '10+2 Any Stream',
    'jobs' => [
        'Community Health Centres', 'Primary Health Centres', 'Government Health Departments',
        'Rural and Urban Health Programs', 'Hospitals and Clinics', 'NGOs',
        'Health and Wellness Centres', 'Old Age Care Homes', 'Rehabilitation Centres',
        'Home Healthcare Services', 'School Health Programs', 'Maternal and Child Health Services',
    ],
    'career' => null,
  ],
  [
    'id'     => 'home-care',
    'icon'   => 'fas fa-home',
    'color'  => '#c0262d',
    'title'  => 'Home Care Provider',
    'quote'  => 'Home care is more than assistance — it is providing comfort, dignity, independence, and quality of life where patients feel most secure: at home.',
    'overview' => 'The Diploma in Home Care Provider prepares individuals to provide compassionate, professional, and personalized care to elderly persons, chronically ill patients, individuals with disabilities, and those recovering from illness or surgery in a home-based setting. The program covers Activities of Daily Living (ADLs), basic nursing care, vital sign monitoring, geriatric care, palliative care, and rehabilitation support.',
    'durations' => [
        ['Diploma', '1 Year'],
    ],
    'eligibility' => '10+2 Any Stream',
    'jobs' => [
        'Home Healthcare Agencies', 'Hospitals and Nursing Homes', 'Assisted Living Facilities',
        'Old Age Homes and Senior Care Centres', 'Rehabilitation Centres', 'Palliative Care Units',
        'Community Health Programs', 'Disability Support Services', 'Hospice Care Organizations',
        'Healthcare NGOs', 'Long-Term Care Facilities',
    ],
    'career' => null,
  ],
  [
    'id'     => 'nanny-training',
    'icon'   => 'fas fa-baby',
    'color'  => '#1d7a4a',
    'title'  => 'Nanny Training',
    'quote'  => 'A nanny does more than care for a child — they nurture confidence, encourage growth, and help shape a brighter future.',
    'overview' => 'The Diploma in Nanny Care is a specialized childcare training program designed to prepare individuals for professional roles in child caregiving and development. The curriculum covers child growth and development, infant and toddler care, nutrition, health and hygiene, first aid, child safety, behaviour management, and early childhood learning activities.',
    'durations' => [
        ['Diploma', '1 Year'],
    ],
    'eligibility' => '10+2 Any Stream',
    'jobs' => [
        'Private Homes and Families', 'Childcare and Daycare Centres', 'Preschools and Early Learning Centres',
        'Nursery Schools', 'Child Development Centres', 'Hospitals and Pediatric Care Units',
        'Residential Childcare Facilities', 'NGOs Working for Child Welfare',
        'Play Schools and Crèches', 'Community Childcare Programs',
    ],
    'career' => null,
  ],
];
@endphp

@foreach($programs as $prog)
<section id="{{ $prog['id'] }}" class="dept-prog {{ $loop->even ? 'dept-prog--alt' : '' }}">
    <div class="dept-ctr">
        <div class="dept-prog__inner">

            {{-- Left: Info Column --}}
            <div class="dept-prog__left">
                <div class="dept-prog__icon-wrap" style="background:{{ $prog['color'] }}15; border:2px solid {{ $prog['color'] }}22;">
                    <i class="{{ $prog['icon'] }}" style="color:{{ $prog['color'] }}"></i>
                </div>
                <div class="dept-prog__meta-stack">
                    @foreach($prog['durations'] as [$type, $dur])
                    <div class="dept-prog__dur-badge" style="border-left:3px solid {{ $prog['color'] }}">
                        <span class="dept-dur-type">{{ $type }}</span>
                        <span class="dept-dur-val"><i class="fas fa-clock"></i> {{ $dur }}</span>
                    </div>
                    @endforeach
                </div>
                <div class="dept-prog__eligibility">
                    <i class="fas fa-check-circle" style="color:{{ $prog['color'] }}"></i>
                    <div>
                        <div class="dept-elig-label">Eligibility</div>
                        <div class="dept-elig-val">{!! $prog['eligibility'] !!}</div>
                    </div>
                </div>
                <a href="{{ route('admissions.form') }}" class="dept-prog__apply-btn" style="background:{{ $prog['color'] }}">
                    Apply for This Course <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            {{-- Right: Content --}}
            <div class="dept-prog__right">
                <div class="dept-prog__number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                <h2 class="dept-prog__title">{!! $prog['title'] !!}</h2>
                <blockquote class="dept-prog__quote" style="border-left-color:{{ $prog['color'] }}">
                    <i class="fas fa-quote-left" style="color:{{ $prog['color'] }}; opacity:.25"></i>
                    {!! $prog['quote'] !!}
                </blockquote>
                <p class="dept-prog__overview">{{ $prog['overview'] }}</p>

                {{-- Employment --}}
                <div class="dept-prog__section">
                    <h4 class="dept-prog__section-title" style="color:{{ $prog['color'] }}">
                        <i class="fas fa-briefcase"></i> Employment Opportunities
                    </h4>
                    <div class="dept-prog__jobs">
                        @foreach($prog['jobs'] as $job)
                        <span class="dept-job-tag"><i class="fas fa-angle-right"></i> {{ $job }}</span>
                        @endforeach
                    </div>
                </div>

                {{-- Career Path --}}
                @if($prog['career'])
                <div class="dept-prog__section">
                    <h4 class="dept-prog__section-title" style="color:{{ $prog['color'] }}">
                        <i class="fas fa-road"></i> Career Growth Path
                    </h4>
                    <div class="dept-career-path">
                        @foreach(explode(' → ', $prog['career']) as $ci => $step)
                        <span class="dept-career-step" style="border-color:{{ $prog['color'] }}22; color:{{ $prog['color'] }}">
                            {{ $step }}
                        </span>
                        @if(!$loop->last)<i class="fas fa-arrow-right dept-career-arr" style="color:{{ $prog['color'] }}"></i>@endif
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</section>
@endforeach

</div>{{-- /dept-body --}}

{{-- CTA Banner --}}
<section class="dept-cta-banner">
    <div class="dept-ctr" style="text-align:center">
        <h2 class="dept-cta-h2">Ready to Start Your Healthcare Career?</h2>
        <p class="dept-cta-sub">Join thousands of successful GNIMT alumni who are making a difference in healthcare across India and abroad.</p>
        <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;margin-top:28px">
            <a href="{{ route('admissions.form') }}" class="dept-btn dept-btn--red dept-btn--lg">Apply Now <i class="fas fa-arrow-right"></i></a>
            <a href="{{ route('contact.patiala') }}" class="dept-btn dept-btn--white-outline dept-btn--lg">Contact Us</a>
        </div>
    </div>
</section>

@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/pages/dept-healthcare.css') }}">
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var links = document.querySelectorAll('.dept-nav-link');
    var sections = Array.from(links).map(function(l){ return document.querySelector(l.getAttribute('href')); }).filter(Boolean);
    var hH = (document.querySelector('.site-header')||{offsetHeight:150}).offsetHeight;
    function setActive(){
        var sy = window.scrollY + hH + 60;
        var cur = sections[0];
        sections.forEach(function(s){ if(s.offsetTop <= sy) cur = s; });
        links.forEach(function(l){ l.classList.toggle('active', l.getAttribute('href')==='#'+cur.id); });
    }
    window.addEventListener('scroll', setActive, {passive:true});
    setActive();
});
</script>
@endsection
