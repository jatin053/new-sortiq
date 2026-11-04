<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Website Enquiry</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1e293b; line-height: 1.6;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f1f5f9; padding: 30px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width: 650px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.06); border: 1px solid #e2e8f0;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #0b132b 0%, #1c2541 100%); padding: 28px 36px;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td>
                                        <h1 style="margin: 0; color: #ffffff; font-size: 22px; font-weight: 700; letter-spacing: -0.3px;">Sortiq Solutions</h1>
                                        <p style="margin: 4px 0 0 0; color: #94a3b8; font-size: 13px;">New Web Form Submission Alert</p>
                                    </td>
                                    <td align="right">
                                        <span style="display: inline-block; padding: 6px 14px; background-color: #2563eb; color: #ffffff; font-size: 12px; font-weight: 600; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;">
                                            {{ strtoupper($contactMessage->type ?? 'ENQUIRY') }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 32px 36px 24px 36px;">
                            <h2 style="margin: 0 0 8px 0; color: #0f172a; font-size: 18px; font-weight: 700;">
                                New Enquiry Received
                            </h2>
                            <p style="margin: 0 0 20px 0; color: #64748b; font-size: 14px;">
                                A visitor submitted the form on your website. Here is the complete information:
                            </p>

                            <!-- Applicant Details Table -->
                            <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin-bottom: 24px;">
                                <h3 style="margin: 0 0 14px 0; color: #0f172a; font-size: 15px; font-weight: 600; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px;">
                                    Contact &amp; Personal Details
                                </h3>
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 14px;">
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; width: 32%; font-weight: 500;">Full Name:</td>
                                        <td style="padding: 7px 0; color: #0f172a; font-weight: 600;">{{ $contactMessage->name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">Email Address:</td>
                                        <td style="padding: 7px 0; color: #2563eb; font-weight: 600;">
                                            <a href="mailto:{{ $contactMessage->email }}" style="color: #2563eb; text-decoration: none;">{{ $contactMessage->email }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">Phone Number:</td>
                                        <td style="padding: 7px 0; color: #0f172a; font-weight: 600;">
                                            @if($contactMessage->clean_phone)
                                                <a href="tel:{{ $contactMessage->clean_phone }}" style="color: #0f172a; text-decoration: none;">{{ $contactMessage->phone_label }}</a>
                                            @else
                                                {{ $contactMessage->phone_label }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">Subject / Reason:</td>
                                        <td style="padding: 7px 0; color: #0f172a; font-weight: 600;">{{ $contactMessage->subject }}</td>
                                    </tr>
                                    @if($contactMessage->institute)
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">College / Institute:</td>
                                        <td style="padding: 7px 0; color: #0f172a;">{{ $contactMessage->institute }}</td>
                                    </tr>
                                    @endif
                                    @if($contactMessage->technology)
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">Technology / Domain:</td>
                                        <td style="padding: 7px 0; color: #0f172a;">{{ $contactMessage->technology }}</td>
                                    </tr>
                                    @endif
                                    @if($contactMessage->attachment)
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">Attachment:</td>
                                        <td style="padding: 7px 0; color: #16a34a; font-weight: 600;">
                                            &#128206; File Attached to this Email
                                        </td>
                                    </tr>
                                    @endif
                                </table>
                            </div>

                            <!-- Message Section -->
                            <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin-bottom: 24px;">
                                <h3 style="margin: 0 0 10px 0; color: #0f172a; font-size: 15px; font-weight: 600;">
                                    Message Content:
                                </h3>
                                <div style="background-color: #f8fafc; border: 1px solid #cbd5e1; border-radius: 6px; padding: 14px 16px; color: #1e293b; font-size: 14px; line-height: 1.6; white-space: pre-wrap;">{{ $contactMessage->message ?: 'No message text provided.' }}</div>
                            </div>

                            <!-- Meta / Source Info -->
                            <div style="background-color: #f1f5f9; border-radius: 8px; padding: 14px 18px; margin-bottom: 20px; font-size: 12px; color: #64748b;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    @if($contactMessage->url)
                                    <tr>
                                        <td style="padding: 3px 0; width: 28%; font-weight: 600;">Submitted From:</td>
                                        <td style="padding: 3px 0;"><a href="{{ $contactMessage->url }}" style="color: #2563eb; text-decoration: none;">{{ $contactMessage->url }}</a></td>
                                    </tr>
                                    @endif
                                    @if($contactMessage->ip_address)
                                    <tr>
                                        <td style="padding: 3px 0; font-weight: 600;">IP Address:</td>
                                        <td style="padding: 3px 0;">{{ $contactMessage->ip_address }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td style="padding: 3px 0; font-weight: 600;">Received At:</td>
                                        <td style="padding: 3px 0;">{{ $contactMessage->created_at ? $contactMessage->created_at->format('d M Y, h:i A') : now()->format('d M Y, h:i A') }}</td>
                                    </tr>
                                </table>
                            </div>

                            <p style="margin: 0; font-size: 13px; color: #94a3b8; text-align: center;">
                                <em>Tip: You can hit <strong>Reply</strong> in your email client to directly reply to {{ $contactMessage->name }} ({{ $contactMessage->email }}).</em>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 16px 36px; text-align: center; font-size: 12px; color: #94a3b8;">
                            Sortiq Solutions &bull; Automated Form Notification System
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
