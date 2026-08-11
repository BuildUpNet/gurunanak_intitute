<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>New Admission Application</title>
</head>

<body style="margin:0;padding:0;background:#f5f7fb;font-family:Arial,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f5f7fb;padding:30px 0;">
        <tr>
            <td align="center">

                <table width="700" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:12px;overflow:hidden;border:1px solid #e5e7eb;">

                    <!-- Header -->
                    <tr>
                        <td style="background:#0D47A1;padding:25px;text-align:center;">
                            <h1 style="margin:0;color:#ffffff;font-size:28px;">
                                New Admission Application
                            </h1>
                            <p style="margin:8px 0 0;color:#dbeafe;font-size:14px;">
                                Guru Nanak Institute of Medical Technology
                            </p>
                        </td>
                    </tr>

                    <!-- Applicant Info -->
                    <tr>
                        <td style="padding:25px;">

                            <h2 style="color:#C62828;margin-top:0;border-bottom:2px solid #C62828;padding-bottom:8px;">
                                Applicant Details
                            </h2>

                            <table width="100%" cellpadding="10" cellspacing="0" style="border-collapse:collapse;">

                                <tr>
                                    <td width="35%"
                                        style="background:#f8fafc;font-weight:bold;color:#0D47A1;border:1px solid #e5e7eb;">
                                        Candidate Name
                                    </td>
                                    <td style="border:1px solid #e5e7eb;">
                                        {{ $application->candidate_name }}
                                    </td>
                                </tr>

                                <tr>
                                    <td
                                        style="background:#f8fafc;font-weight:bold;color:#0D47A1;border:1px solid #e5e7eb;">
                                        Course Applied
                                    </td>
                                    <td style="border:1px solid #e5e7eb;">
                                        {{ $application->course_name }}
                                    </td>
                                </tr>

                                <tr>
                                    <td
                                        style="background:#f8fafc;font-weight:bold;color:#0D47A1;border:1px solid #e5e7eb;">
                                        Gender
                                    </td>
                                    <td style="border:1px solid #e5e7eb;">
                                        {{ $application->gender }}
                                    </td>
                                </tr>

                                <tr>
                                    <td
                                        style="background:#f8fafc;font-weight:bold;color:#0D47A1;border:1px solid #e5e7eb;">
                                        Category
                                    </td>
                                    <td style="border:1px solid #e5e7eb;">
                                        {{ $application->category }}
                                    </td>
                                </tr>

                                <tr>
                                    <td
                                        style="background:#f8fafc;font-weight:bold;color:#0D47A1;border:1px solid #e5e7eb;">
                                        Date of Birth
                                    </td>
                                    <td style="border:1px solid #e5e7eb;">
                                        {{ \Carbon\Carbon::parse($application->dob)->format('d M Y') }}
                                    </td>
                                </tr>

                                <tr>
                                    <td
                                        style="background:#f8fafc;font-weight:bold;color:#0D47A1;border:1px solid #e5e7eb;">
                                        Mobile Number
                                    </td>
                                    <td style="border:1px solid #e5e7eb;">
                                        {{ $application->mobile }}
                                    </td>
                                </tr>

                                <tr>
                                    <td
                                        style="background:#f8fafc;font-weight:bold;color:#0D47A1;border:1px solid #e5e7eb;">
                                        Email Address
                                    </td>
                                    <td style="border:1px solid #e5e7eb;">
                                        {{ $application->email ?? 'N/A' }}
                                    </td>
                                </tr>
                            </table>

                            <!-- Address -->
                            <h2
                                style="color:#C62828;margin-top:30px;border-bottom:2px solid #C62828;padding-bottom:8px;">
                                Contact Information
                            </h2>

                            <div style="padding:15px;background:#f8fafc;border-left:4px solid #0D47A1;">
                                <strong style="color:#0D47A1;">Permanent Address:</strong><br>
                                {{ $application->permanent_address }}
                            </div>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#0D47A1;padding:18px;text-align:center;">
                            <p style="margin:0;color:#ffffff;font-size:13px;">
                                This admission enquiry was submitted through the GNIMT website.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
