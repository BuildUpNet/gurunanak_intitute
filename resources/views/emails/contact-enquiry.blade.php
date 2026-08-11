<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Enquiry Received</title>
</head>

<body style="margin:0;padding:0;background:#f1f3f8;font-family:Arial,Helvetica,sans-serif;color:#222;">
    <table width="100%" cellpadding="0" cellspacing="0" style="padding:30px 0;background:#f1f3f8;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#fff;border-radius:0 0 8px 8px;overflow:hidden;">

                    <tr>
                        <td align="center" style="background:#b91c1c;padding:22px 30px;color:#fff;">
                            <img src="{{ asset('images/logo.png') }}"
                                alt="GNIMT" width="80">
                            <h2 style="margin:0;font-size:22px;font-weight:700;">New Enquiry Received</h2>
                            <p style="margin:8px 0 0;font-size:12px;">Guru Nanak Institute of Medical Technology</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:30px;">
                            <h3 style="margin:0 0 18px;font-size:18px;color:#1f2937;">Student Enquiry Details</h3>

                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="border-collapse:collapse;font-size:13px;">
                                <tr>
                                    <td
                                        style="border:1px solid #ddd;background:#f5f6f8;padding:12px;font-weight:bold;width:35%;">
                                        Full Name</td>
                                    <td style="border:1px solid #ddd;padding:12px;">{{ $data['name'] }}</td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #ddd;background:#f5f6f8;padding:12px;font-weight:bold;">
                                        Phone Number</td>
                                    <td style="border:1px solid #ddd;padding:12px;">{{ $data['phone'] }}</td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #ddd;background:#f5f6f8;padding:12px;font-weight:bold;">
                                        Email Address</td>
                                    <td style="border:1px solid #ddd;padding:12px;">
                                        {{ $data['email'] ?? 'N/A' }}
                                    </td>
                                </tr>
                                @if (!empty($data['branch']))
                                    <tr>
                                        <td
                                            style="border:1px solid #ddd;background:#f5f6f8;padding:12px;font-weight:bold;">
                                            Branch
                                        </td>
                                        <td style="border:1px solid #ddd;padding:12px;">
                                            {{ $data['branch'] }}
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($data['course_category']))
                                    <tr>
                                        <td
                                            style="border:1px solid #ddd;background:#f5f6f8;padding:12px;font-weight:bold;">
                                            Department
                                        </td>
                                        <td style="border:1px solid #ddd;padding:12px;">
                                            {{ $data['course_category'] }}
                                        </td>
                                    </tr>
                                @endif

                                @if (!empty($data['course']))
                                    <tr>
                                        <td
                                            style="border:1px solid #ddd;background:#f5f6f8;padding:12px;font-weight:bold;">
                                            Course
                                        </td>
                                        <td style="border:1px solid #ddd;padding:12px;">
                                            {{ $data['course'] }}
                                        </td>
                                    </tr>
                                @endif
                                @if (isset($data['subject']))
                                    <tr>
                                        <td
                                            style="border:1px solid #ddd;background:#f5f6f8;padding:12px;font-weight:bold;">
                                            Subject</td>
                                        <td style="border:1px solid #ddd;padding:12px;">{{ $data['subject'] }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td style="border:1px solid #ddd;background:#f5f6f8;padding:12px;font-weight:bold;">
                                        Message</td>
                                    <td style="border:1px solid #ddd;padding:12px;">{{ $data['message'] ?? 'N/A' }}</td>
                                </tr>
                            </table>

                            <div
                                style="margin-top:24px;background:#fff8dd;border-left:4px solid #d4a017;padding:14px;font-size:12px;color:#333;">
                                <strong>Note:</strong> This enquiry was submitted through the GNIMT website enquiry
                                form.
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="background:#0f172a;color:#fff;padding:25px 30px;font-size:12px;">
                            <p style="margin:0 0 15px;font-weight:bold;">Guru Nanak Institute of Medical Technology</p>
                            <p style="margin:0 0 6px;">📞 +91-8283299808 | +91-8150019000</p>
                            <p style="margin:0 0 15px;">
                                🌐 <a href="https://gurunanakinstitute.com"
                                    style="color:#38bdf8;text-decoration:none;">www.gurunanakinstitute.com</a>
                            </p>
                            <p style="margin:0;">© {{ date('Y') }} GNIMT. All Rights Reserved.</p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
