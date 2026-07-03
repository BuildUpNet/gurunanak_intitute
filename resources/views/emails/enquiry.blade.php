<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Enquiry Received</title>
</head>

<body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;color:#1f2937;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f9;padding:30px 0;">
    <tr>
        <td align="center">

            <table width="650" cellpadding="0" cellspacing="0"
                style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 5px 25px rgba(0,0,0,.08);">

                <tr>
                    <td align="center" style="background:#b91c1c;padding:30px;color:#fff;">
                        <img src="https://www.gurunanakinstitute.com/wp-content/themes/GNIMT/images/logo.png"
                             alt="GNIMT" width="80">

                        <h1 style="margin:15px 0 5px;font-size:26px;">
                            New Enquiry Received
                        </h1>

                        <p style="margin:0;color:#ffe6a7;font-size:14px;">
                            Guru Nanak Institute of Medical Technology
                        </p>
                    </td>
                </tr>

                <tr>
                    <td style="padding:35px;">
                        <h2 style="margin:0 0 20px;color:#0f172a;font-size:20px;">
                            Student Enquiry Details
                        </h2>

                        <table width="100%" cellpadding="12" cellspacing="0" style="border-collapse:collapse;font-size:14px;">
                            <tr>
                                <td width="35%" style="background:#f8fafc;font-weight:bold;border:1px solid #e5e7eb;">
                                    Full Name
                                </td>
                                <td style="border:1px solid #e5e7eb;">
                                    {{ $data['name'] ?? 'N/A' }}
                                </td>
                            </tr>

                            <tr>
                                <td style="background:#f8fafc;font-weight:bold;border:1px solid #e5e7eb;">
                                    Phone Number
                                </td>
                                <td style="border:1px solid #e5e7eb;">
                                    {{ $data['phone'] ?? 'N/A' }}
                                </td>
                            </tr>

                            <tr>
                                <td style="background:#f8fafc;font-weight:bold;border:1px solid #e5e7eb;">
                                    Email Address
                                </td>
                                <td style="border:1px solid #e5e7eb;">
                                    {{ $data['email'] ?? 'N/A' }}
                                </td>
                            </tr>

                            <tr>
                                <td style="background:#f8fafc;font-weight:bold;border:1px solid #e5e7eb;">
                                    Course Category
                                </td>
                                <td style="border:1px solid #e5e7eb;">
                                    {{ $data['course_category'] ?? 'N/A' }}
                                </td>
                            </tr>

                            <tr>
                                <td style="background:#f8fafc;font-weight:bold;border:1px solid #e5e7eb;">
                                    Course
                                </td>
                                <td style="border:1px solid #e5e7eb;">
                                    {{ $data['course'] ?? 'N/A' }}
                                </td>
                            </tr>

                            <tr>
                                <td style="background:#f8fafc;font-weight:bold;border:1px solid #e5e7eb;">
                                    Branch
                                </td>
                                <td style="border:1px solid #e5e7eb;">
                                    {{ $data['branch'] ?? 'N/A' }}
                                </td>
                            </tr>

                            <tr>
                                <td style="background:#f8fafc;font-weight:bold;border:1px solid #e5e7eb;">
                                    Message
                                </td>
                                <td style="border:1px solid #e5e7eb;line-height:1.6;">
                                    {{ $data['message'] ?? 'No message provided.' }}
                                </td>
                            </tr>
                        </table>

                        <div style="margin-top:25px;padding:15px;background:#fff8e1;border-left:4px solid #d4af37;font-size:13px;">
                            <strong>Note:</strong>
                            This enquiry was submitted through the GNIMT website enquiry form.
                        </div>
                    </td>
                </tr>

                <tr>
                    <td align="center" style="background:#0f172a;padding:25px;color:#cbd5e1;font-size:13px;">
                        <strong style="color:#fff;">
                            Guru Nanak Institute of Medical Technology
                        </strong>
                        <br><br>

                        📞 +91-8283929908 | +91-8150019000
                        <br>
                        🌐 www.gurunanakinstitute.com
                        <br><br>

                        © {{ date('Y') }} GNIMT. All Rights Reserved.
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>