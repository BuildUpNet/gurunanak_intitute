{{-- resources/views/pages/anti-ragging.blade.php --}}
@extends('layouts.app')

@section('title', 'Anti-Ragging Policy | GNIMT – Guru Nanak Institute of Medical Technology')
@section('meta_description',
    'GNIMT strictly prohibits ragging in any form. Read our Anti-Ragging Policy, committee
    details, complaint mechanism, and UGC helpline numbers.')

@section('content')

    {{-- ─── HERO ─── --}}
    <section class="ar-hero">
        <div class="ar-hero__inner">
            <span class="ar-hero__eyebrow">Zero Tolerance &nbsp;·&nbsp; UGC Mandated &nbsp;·&nbsp; GNIMT Patiala &amp;
                Karnal</span>
            <h1 class="ar-hero__h1">Anti-Ragging <span>Policy</span></h1>
            <p class="ar-hero__sub">Guru Nanak Institute of Medical Technology is committed to maintaining a safe,
                respectful, and inclusive campus environment. Ragging in any form is strictly prohibited and will be dealt
                with as per UGC Regulations and applicable law.</p>
        </div>
    </section>

    {{-- ─── WHAT IS RAGGING ─── --}}
    <section class="ar-section ar-section--white">
        <div class="ar-ctr">
            <div class="ar-sec-head">
                <span class="ar-eyebrow">Definition</span>
                <h2 class="ar-heading">What Constitutes <span>Ragging?</span></h2>
            </div>
            <p class="ar-lead">As per UGC Regulations on Curbing the Menace of Ragging in Higher Educational Institutions,
                2009, ragging includes any act that:</p>
            <div class="ar-what-grid">
                @foreach ([['fas fa-exclamation-triangle', '#c0262d', 'Physical Abuse', 'Any act of physical harm, assault, or forcing students to perform demeaning acts against their will.'], ['fas fa-comments', '#1a3566', 'Verbal Abuse', 'Using abusive language, intimidating speech, threats, or humiliation directed at any student.'], ['fas fa-user-slash', '#c0262d', 'Mental Harassment', 'Acts that cause psychological harm, instil fear, or affect the mental health and dignity of a student.'], ['fas fa-film', '#1a3566', 'Digital Ragging', 'Cyber-bullying, sending offensive messages, or posting humiliating content online targeting any student.'], ['fas fa-running', '#c0262d', 'Forced Activity', 'Compelling a student to perform tasks that are degrading, harmful, or contrary to their wishes.'], ['fas fa-ban', '#1a3566', 'Obstruction', 'Preventing a student from pursuing academic activities, accessing campus facilities, or attending classes.']] as [$icon, $color, $title, $desc])
                    <div class="ar-what-card">
                        <div class="ar-what-icon" style="background: {{ $color }}"><i
                                class="{{ $icon }}"></i></div>
                        <h3 class="ar-what-title">{{ $title }}</h3>
                        <p class="ar-what-desc">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─── LEGAL FRAMEWORK ─── --}}
    <section class="ar-section ar-section--navy">
        <div class="ar-ctr">
            <div class="ar-sec-head ar-sec-head--light">
                <span class="ar-eyebrow ar-eyebrow--light">Legal Backing</span>
                <h2 class="ar-heading ar-heading--white">Regulatory <span style="color:#f87171">Framework</span></h2>
            </div>
            <div class="ar-law-grid">
                <div class="ar-law-card">
                    <div class="ar-law-num">01</div>
                    <h3 class="ar-law-title">UGC Regulations 2009</h3>
                    <p class="ar-law-desc">The University Grants Commission's Regulations on Curbing the Menace of Ragging
                        in Higher Educational Institutions, 2009, mandates every institution to constitute an Anti-Ragging
                        Committee and Anti-Ragging Squad, display undertakings, and submit compliance reports.</p>
                </div>
                <div class="ar-law-card">
                    <div class="ar-law-num">02</div>
                    <h3 class="ar-law-title">Supreme Court Mandate</h3>
                    <p class="ar-law-desc">The Hon'ble Supreme Court of India in <em>Vishwa Jagriti Mission v. Central
                            Government</em> directed all educational institutions to implement strict anti-ragging measures
                        and ensure every student submits a signed anti-ragging undertaking at the time of admission.</p>
                </div>
                <div class="ar-law-card">
                    <div class="ar-law-num">03</div>
                    <h3 class="ar-law-title">State Legislation</h3>
                    <p class="ar-law-desc">The Punjab Prevention of Ragging Act and other applicable state laws prescribe
                        criminal penalties, including imprisonment and fines, for acts of ragging in educational
                        institutions across Punjab and Haryana.</p>
                </div>
                <div class="ar-law-card">
                    <div class="ar-law-num">04</div>
                    <h3 class="ar-law-title">Consequences &amp; Penalties</h3>
                    <p class="ar-law-desc">Proven acts of ragging attract suspension, expulsion from the institution,
                        withholding of marks/transcripts, debarring from examinations, FIR registration under IPC, and
                        denial of future admission to any HEI in India.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ─── ANTI-RAGGING COMMITTEE ─── --}}
    <section class="ar-section ar-section--light">
        <div class="ar-ctr">
            <div class="ar-sec-head">
                <span class="ar-eyebrow">Governance</span>
                <h2 class="ar-heading">Anti-Ragging <span>Committee</span></h2>
                <p class="ar-sub">The institute has constituted an Anti-Ragging Committee as per UGC Regulations. The
                    committee is responsible for monitoring, investigating complaints, and recommending action against
                    offenders.</p>
            </div>
            <div class="ar-table-wrap">
                <table class="ar-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name &amp; Designation</th>
                            <th>Role in Committee</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><strong>S. Dr. Subhash Dawar</strong><br><span>Director, GNIMT</span></td>
                            <td>Chairperson</td>
                            <td>director@gnimt.edu.in</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><strong>Senior Faculty Representative</strong><br><span>Academic Department</span></td>
                            <td>Member</td>
                            <td>info@gnimt.edu.in</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><strong>Administrative Officer</strong><br><span>Administration</span></td>
                            <td>Member Secretary</td>
                            <td>admin@gnimt.edu.in</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><strong>Student Representative</strong><br><span>Student Body</span></td>
                            <td>Student Member</td>
                            <td>info@gnimt.edu.in</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td><strong>Parent Representative</strong><br><span>Parent-Teacher Association</span></td>
                            <td>Parent Member</td>
                            <td>info@gnimt.edu.in</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- ─── COMPLAINT MECHANISM ─── --}}
    <section class="ar-section ar-section--white">
        <div class="ar-ctr">
            <div class="ar-sec-head">
                <span class="ar-eyebrow">Report &amp; Seek Help</span>
                <h2 class="ar-heading">Complaint <span>Mechanism</span></h2>
                <p class="ar-sub">Any student who faces or witnesses ragging can report it through the following channels.
                    All complaints are treated with strict confidentiality.</p>
            </div>
            <div class="ar-steps">
                <div class="ar-step">
                    <div class="ar-step-num">1</div>
                    <div class="ar-step-body">
                        <h3 class="ar-step-title">Contact the Anti-Ragging Committee</h3>
                        <p class="ar-step-desc">Approach any member of the Anti-Ragging Committee directly or submit a
                            written complaint to the Administrative Office. Your identity will be kept confidential
                            throughout the process.</p>
                    </div>
                </div>
                <div class="ar-step">
                    <div class="ar-step-num">2</div>
                    <div class="ar-step-body">
                        <h3 class="ar-step-title">Call the UGC Anti-Ragging Helpline</h3>
                        <p class="ar-step-desc">Dial the national toll-free helpline <strong>1800-180-5522</strong> operated
                            24×7 by the UGC. You can also register your complaint at <strong>www.antiragging.in</strong></p>
                    </div>
                </div>
                <div class="ar-step">
                    <div class="ar-step-num">3</div>
                    <div class="ar-step-body">
                        <h3 class="ar-step-title">Email the Institute</h3>
                        <p class="ar-step-desc">Send a detailed complaint to <strong>info@gnimt.edu.in</strong> with subject
                            line "Anti-Ragging Complaint". The committee will acknowledge and respond within 24 hours.</p>
                    </div>
                </div>
                <div class="ar-step">
                    <div class="ar-step-num">4</div>
                    <div class="ar-step-body">
                        <h3 class="ar-step-title">Police / Emergency</h3>
                        <p class="ar-step-desc">In case of immediate physical danger, contact local police by dialling
                            <strong>112</strong>. The institute will extend full cooperation to law enforcement authorities.
                        </p>
                    </div>
                </div>
            </div>

            {{-- <div class="ar-helpline-box">
                <div class="ar-helpline-icon"><i class="fas fa-phone-alt"></i></div>
                <div class="ar-helpline-body">
                    <div class="ar-helpline-label">UGC Anti-Ragging Toll-Free Helpline</div>
                    <div class="ar-helpline-number">1800-180-5522</div>
                    <div class="ar-helpline-note">Available 24 hours · 7 days · Free of cost · www.antiragging.in</div>
                </div>
            </div> --}}
        </div>
    </section>

    {{-- ─── PLEDGE ─── --}}
    <section class="ar-section ar-section--navy" style="padding: 72px 0">
        <div class="ar-ctr" style="text-align:center">
            <div class="ar-pledge-icon"><i class="fas fa-shield-alt"></i></div>
            <h2 class="ar-heading ar-heading--white" style="text-align:center;margin-top:20px">Our Commitment to a <span
                    style="color:#f87171">Safe Campus</span></h2>
            <p style="color:rgba(255,255,255,.6);font-size:.92rem;line-height:1.9;max-width:680px;margin:18px auto 0;">GNIMT
                pledges to uphold the dignity and well-being of every student. The institute maintains a <strong
                    style="color:#fff;">zero-tolerance policy</strong> towards ragging. Ragging in any form is strictly
                prohibited, and strict disciplinary action will be taken against offenders. Students are encouraged to
                report any incident immediately. Every student, faculty member, and staff is responsible for reporting any
                incident of ragging and ensuring the campus remains a safe place for learning and growth.</p>
            {{-- <a href="{{ route('contact.patiala') }}" class="ar-pledge-btn"><i class="fas fa-envelope"></i>&nbsp; Contact the
                Administration</a> --}}
        </div>
    </section>

    @include('partials.faq', [
        'title' => 'Anti-Ragging — Frequently Asked Questions',
        'subtitle' => 'Answers to common questions about our anti-ragging policy and complaint process.',
        'faqs' => $globalFaqs,
    ])

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/anti-ragging.css') }}">
@endsection
