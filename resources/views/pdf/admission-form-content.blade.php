<div class="ar-doc">

    {{-- ═══════════════════════════════
     PAGE 1
═══════════════════════════════ --}}
    <div class="page page-break">

        <div class="title">Admission Form</div>

        {{-- 1. Candidate Name --}}
        <div class="field">
            <span class="field-label">1. Name of Candidate:-</span>
            <span class="field-value"> {{ strtoupper($app->candidate_name) }}</span>
            <div style="font-size:10px; color:#555; margin-left:4px;">(as entered in class 10<sup>th</sup> certificate)
            </div>
            <span class="underline-full"></span>
        </div>

        {{-- 2. Course --}}
        <div class="field">
            <span class="field-label">2. Name of Course:-</span>
            <span class="field-value"> {{ $app->course_name }}</span>
            <span class="underline-full"></span>
        </div>

        {{-- 3. Gender & Category — each on its own full-width row so items never overflow --}}
        <div class="field">
            <div class="field-label">3. Tick the Appropriate Boxes:</div>
            <table class="tick-row" style="margin-top:6px;">
                <tr>
                    <td style="width:16%;"><span class="field-label">&#8226; Gender:</span></td>
                    @foreach (['Male', 'Female', 'Other'] as $g)
                        <td style="width:{{ (int) (84 / 3) }}%;">
                            <span class="tick-box {{ $app->gender == $g ? 'checked' : '' }}">{!! $app->gender == $g ? '<span class="tick-mark"></span>' : '' !!}</span> {{ $g }}
                        </td>
                    @endforeach
                </tr>
            </table>
            <table class="tick-row" style="margin-top:8px;">
                <tr>
                    <td style="width:16%;"><span class="field-label">&#8226; Category:</span></td>
                    @foreach (['General', 'SC', 'ST', 'OBC'] as $c)
                        <td style="width:14%;">
                            <span class="tick-box {{ $app->category == $c ? 'checked' : '' }}">{!! $app->category == $c ? '<span class="tick-mark"></span>' : '' !!}</span> {{ $c }}
                        </td>
                    @endforeach
                    <td style="width:28%;">
                        @if ($app->category == 'Other')
                            <span class="tick-box checked"><span class="tick-mark"></span></span> Other: {{ $app->category_other }}
                        @else
                            <span class="tick-box"></span> Any Other: ______
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        {{-- 4. DOB & Place of Birth --}}
        <div class="field">
            <table class="two-col">
                <tr>
                    <td style="width:55%;">
                        <span class="field-label">4. Date of Birth:-</span>&nbsp;
                        @php
                            $dob = $app->dob->format('d-m-Y');
                            $dobParts = str_split($dob);
                        @endphp
                        @foreach ($dobParts as $ch)
                            @if ($ch == '-')
                                <span class="box-sep"></span>
                            @else
                                <span class="char-box">{{ $ch }}</span>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <span class="field-label">Place of Birth:-</span>
                        <span class="underline-value" style="min-width:140px;"> {{ $app->place_of_birth }}</span>
                    </td>
                </tr>
            </table>
        </div>

        {{-- 5. Aadhaar --}}
        <div class="field">
            <span class="field-label">5. Aadhaar No. (UID):-</span>&nbsp;
            @php $aadhar = str_split($app->aadhaar_no); @endphp
            @foreach ($aadhar as $i => $ch)
                @if ($i > 0 && $i % 4 == 0)
                    <span class="box-sep"></span>
                @endif
                <span class="char-box">{{ $ch }}</span>
            @endforeach
        </div>

        {{-- 6. Family Details --}}
        <div class="section-head">6. Family Details</div>

        <table style="width:100%; border-collapse:collapse; margin-top:6px;">
            <tr>
                <td colspan="2" style="padding:6px 0; font-weight:bold; color:#1a3c8f;">
                    (a) Father's Details
                </td>
            </tr>

            <tr>
                <td style="width:50%; padding:6px 0;">
                    <span class="field-label">Father's Name:</span>
                    <span class="underline-value" style="min-width:170px;">{{ $app->father_name }}</span>
                </td>

                <td style="width:50%; padding:6px 0;">
                    <span class="field-label">Father's Occupation:</span>
                    <span class="underline-value" style="min-width:130px;">{{ $app->father_occupation ?? '' }}</span>
                </td>
            </tr>

            <tr>
                <td style="padding:6px 0;">
                    <span class="field-label">Father's Mobile No.:</span>
                    <span class="underline-value" style="min-width:150px;">{{ $app->father_mobile ?? '' }}</span>
                </td>
                <td></td>
            </tr>

            <tr>
                <td colspan="2" style="padding:12px 0 6px; font-weight:bold; color:#1a3c8f;">
                    (b) Mother's Details
                </td>
            </tr>

            <tr>
                <td style="width:50%; padding:6px 0;">
                    <span class="field-label">Mother's Name:</span>
                    <span class="underline-value" style="min-width:170px;">{{ $app->mother_name }}</span>
                </td>

                <td style="width:50%; padding:6px 0;">
                    <span class="field-label">Mother's Occupation:</span>
                    <span class="underline-value" style="min-width:130px;">{{ $app->mother_occupation ?? '' }}</span>
                </td>
            </tr>

            <tr>
                <td style="padding:6px 0;">
                    <span class="field-label">Mother's Mobile No.:</span>
                    <span class="underline-value" style="min-width:150px;">{{ $app->mother_mobile ?? '' }}</span>
                </td>
                <td></td>
            </tr>
        </table>
        {{-- 7. Nationality --}}
        <div class="field">
            <table class="two-col">
                <tr>
                    <td style="width:50%;">
                        <span class="field-label">7. Nationality:</span>
                        <span class="underline-value" style="min-width:120px;"> {{ $app->nationality }}</span>
                    </td>
                    <td>
                        <span class="field-label">Country Of Citizenship:</span>
                        <span class="underline-value" style="min-width:80px;"> {{ $app->country_citizenship }}</span>
                    </td>
                </tr>
            </table>
        </div>

        {{-- 8. Address --}}
        <div class="field">
            <span class="field-label">8. Permanent Address:</span>
            <span class="underline-full"> {{ $app->permanent_address }}</span>
        </div>

        {{-- 9. Mobile & Email --}}
        <div class="field">
            <table class="two-col">
                <tr>
                    <td style="width:50%;">
                        <span class="field-label">9. Mobile No. (Self):</span>
                        <span class="underline-value" style="min-width:100px;"> {{ $app->mobile }}</span>
                    </td>
                    <td>
                        <span class="field-label">Email Id:</span>
                        <span class="underline-value" style="min-width:120px;"> {{ $app->email ?? '' }}</span>
                    </td>
                </tr>
            </table>
            <div style="font-size:10px; color:#555;">(Inform the Change in number if any to the authorities)</div>
        </div>

        {{-- 10. Education --}}
        <div class="field" style="margin-top:6px;">
            <div class="field-label" style="margin-bottom:5px;">10. Summary of Education Qualifications:-</div>
            @php
                $eduLabels = ['Matric (10th)', '10+2', 'Graduation', 'Post-Graduation', 'Any Other'];
            @endphp
            <table class="edu-table">
                <thead>
                    <tr>
                        <th style="width:20%">Previous Exam Passed</th>
                        <th style="width:12%">Session</th>
                        <th>Name of School / College</th>
                        <th style="width:18%">Board / University</th>
                        <th style="width:12%">Percent or Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eduLabels as $i => $label)
                        <tr>
                            <td class="row-label">{{ $label }}</td>
                            <td>{{ $app->education[$i]['session'] ?? '' }}</td>
                            <td style="text-align:left;">{{ $app->education[$i]['school'] ?? '' }}</td>
                            <td>{{ $app->education[$i]['board'] ?? '' }}</td>
                            <td>{{ $app->education[$i]['percent'] ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- 11. How did you know --}}
        <div class="field" style="margin-top:12px;">
            <div class="field-label" style="margin-bottom:5px;">11. How did you come to know about Guru Nanak
                Institute of Medical Technology</div>
            @php
                $sources = ['Advertisement', 'Friends', 'Relatives', 'Radio', 'TV', 'Pamphlet'];
                $heard = $app->heard_from ?? [];
            @endphp
            <table class="tick-row">
                <tr>
                    @foreach (array_slice($sources, 0, 4) as $i => $src)
                        <td style="width:25%;">
                            <span class="tick-box {{ in_array($src, $heard) ? 'checked' : '' }}">{!! in_array($src, $heard) ? '<span class="tick-mark"></span>' : '' !!}</span>
                            ({{ chr(97 + $i) }}) {{ $src }}
                        </td>
                    @endforeach
                </tr>
                <tr>
                    @foreach (array_slice($sources, 4) as $j => $src)
                        @php($i = $j + 4)
                        <td style="width:25%;">
                            <span class="tick-box {{ in_array($src, $heard) ? 'checked' : '' }}">{!! in_array($src, $heard) ? '<span class="tick-mark"></span>' : '' !!}</span>
                            ({{ chr(97 + $i) }}) {{ $src }}
                        </td>
                    @endforeach
                    <td style="width:50%;" colspan="2">
                        @if ($app->heard_from_other)
                            (g) Others:- {{ $app->heard_from_other }}
                        @else
                            (g) Others:- ____________________
                        @endif
                    </td>
                </tr>
            </table>
        </div>

    </div>{{-- end page 1 --}}


    {{-- ═══════════════════════════════
     PAGE 2 — TERMS & DECLARATION
═══════════════════════════════ --}}
    <div class="page">

        <div class="terms-title">Terms &amp; Conditions of Admission</div>

        <ul class="terms-list">
            <li><strong>1.</strong> We have taken due and reasonable care in obtaining the Guru Nanak Institute of
                Medical Technology status from the Government of Punjab and University Grants Commission (UGC), However
                we shall be bound by any change in the laws/government policy/judicial ruling affecting its status as
                such and shall have no liability in such an event.</li>
            <li><strong>2.</strong> The Guru Nanak Institute of Medical Technology reserves the right to cancel the
                admission of any candidate under any of the following circumstances;
                <ul class="sub-list">
                    <li>a) If the fees is not deposited by the stipulated date.</li>
                    <li>b) If the candidates does not join the particular programme by the stipulated date even though
                        the Fee has been deposited.</li>
                    <li>c) If the candidates fails to furnish the proof of the minimum eligible qualification required
                        for admission into the programme/course within the stipulated time frame.</li>
                    <li>d) If he/she indulge in Ragging Activities.</li>
                </ul>
            </li>
            <li><strong>3.</strong> A candidate found indulging in drug/alcohol abuse, violence or improper behaviour
                and does not abide by the rules and regulation as are relevant from time to time, he/she will be
                rusticated.</li>
            <li><strong>4.</strong> Activities that have the effect or intention of interfering with education pursuit
                of knowledge, or fair evolution of a student's performance are prohibited and offenders shall be liable
                for appropriate punitive action.</li>
            <li><strong>5.</strong> The conditions laid herein are binding on the student and his/her admission to Guru
                Nanak Institute of Medical Technology if out of his/her own free will and consent and at his/her own
                return/risk.</li>
        </ul>

        <hr class="divider">

        <div class="decl-title">Declaration by the Student</div>

        <ul class="terms-list">
            <li><strong>1.</strong> I am responsible for the information given above by me and it is true to the best of
                my knowledge and belief. Nothing has been concealed therein.</li>
            <li><strong>2.</strong> I am physically fit and do not suffer from any physical deformity/communicable
                disease.</li>
            <li><strong>3.</strong> I do hereby agree to pay the cost of damage caused to the movable and immovable
                property of the GNIMT, Patiala.</li>
            <li><strong>4.</strong> I hereby agree to conform to all rules, acts and laws enforced by the Guru Nanak
                Institute of Medical Technology. Further, I hereby undertake that if I disobey any of the rules or
                regulations, disciplinary action may be taken against me, including expulsion from the Institute.</li>
            <li><strong>5.</strong> I know that if at any stage of my course, any discrepancy is found in my
                testimonials/documents/eligibility by the Guru Nanak Institute of Medical Technology or any other
                authority, the Institute will not be held responsible and I will own the responsibility. I shall not
                claim any refund from the Institute.</li>
            <li><strong>6.</strong> I hereby agree to pay the full fee of the course even if I discontinue my studies at
                any time during the course, as I am fully aware that the seat so vacated by me will be a loss to the
                Guru Nanak Institute of Medical Technology.</li>
            <li><strong>7.</strong> I understand that this is Non-NCTE seat and I am taking admission at my own risk and
                responsibility. In case of any issue, Guru Nanak Institute of Medical Technology will not be responsible
                for the same.</li>
            <li><strong>8.</strong> I bind myself to fulfil 75% attendance condition or attendance requirement as per
                the council, commission, or any other statuary body and clear the conditional tests to make myself
                eligible for the final exams as per the Guru Nanak Institute of Medical Technology rules.</li>
            <li><strong>9.</strong> I am fully aware that ragging is strictly prohibited/punished under law in the Guru
                Nanak Institute of Medical Technology. If I am found guilty of indulging in or abetting ragging, I shall
                be liable for punishment and expulsion from the Institute.</li>
            <li><strong>10.</strong> I would endeavour to excel in my studies &amp; other Guru Nanak Institute of
                Medical Technology Extra Curricular activities.</li>
            <li><strong>11.</strong> I will maintain highest degree of discipline &amp; will not be involved in any
                activity that harms or damages the dignity &amp; prestige of my esteemed Institute.</li>
            <li><strong>12.</strong> I understand and agree that any dispute arising about my admission, if not resolved
                mutually, the decision of the Director/Principal of Guru Nanak Institute of Medical Technology as sole
                arbitrator will be final and binding, However, jurisdiction of courts will be District Patiala only.
            </li>
            <li><strong>13.</strong> I have noted that the fees once paid by me is neither refundable nor adjustable in
                any circumstances and in case of any dispute between me and the Institute, the jurisdiction for legal
                proceeding will be Patiala only.</li>
        </ul>

        {{-- Signatures --}}
        <table class="sign-table">
            <tr>
                <td style="width:45%;">
                    <span class="sign-label">Date:-</span>
                    <span class="sign-line"></span>
                </td>
                <td style="width:10%;"></td>
                <td style="width:45%;">
                    <span class="sign-label">Signature of Candidate:-</span>
                    <span class="sign-line"></span>
                </td>
            </tr>
        </table>

        <table class="sign-table" style="margin-top:16px;">
            <tr>
                <td style="width:50%;">
                    <span class="sign-label">Signature of Parents/Guardian:-</span>
                    <span class="sign-line"></span>
                </td>
                <td></td>
            </tr>
        </table>

    </div>{{-- end page 2 --}}

</div>{{-- end .ar-doc --}}
