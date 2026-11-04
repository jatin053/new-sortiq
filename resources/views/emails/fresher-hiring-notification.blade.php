<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Fresher Connect Application</title>
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
                                        <p style="margin: 4px 0 0 0; color: #94a3b8; font-size: 13px;">Fresher Connect Application</p>
                                    </td>
                                    <td align="right">
                                        <span style="display: inline-block; padding: 6px 14px; background-color: #10b981; color: #ffffff; font-size: 12px; font-weight: 600; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;">
                                            FRESHER
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
                                New Fresher Candidate Submission
                            </h2>
                            <p style="margin: 0 0 20px 0; color: #64748b; font-size: 14px;">
                                A new candidate has registered through the Fresher Connect form. Here is the full candidate profile:
                            </p>

                            <!-- Candidate Details Table -->
                            <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin-bottom: 24px;">
                                <h3 style="margin: 0 0 14px 0; color: #0f172a; font-size: 15px; font-weight: 600; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px;">
                                    Candidate Details
                                </h3>
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 14px;">
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; width: 32%; font-weight: 500;">Candidate Name:</td>
                                        <td style="padding: 7px 0; color: #0f172a; font-weight: 600;">{{ $fresherHiring->name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">Email Address:</td>
                                        <td style="padding: 7px 0; color: #2563eb; font-weight: 600;">
                                            <a href="mailto:{{ $fresherHiring->email }}" style="color: #2563eb; text-decoration: none;">{{ $fresherHiring->email }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">Phone Number:</td>
                                        <td style="padding: 7px 0; color: #0f172a; font-weight: 600;">
                                            @if($fresherHiring->clean_phone)
                                                <a href="tel:{{ $fresherHiring->clean_phone }}" style="color: #0f172a; text-decoration: none;">{{ $fresherHiring->phone_label }}</a>
                                            @else
                                                {{ $fresherHiring->phone_label }}
                                            @endif
                                        </td>
                                    </tr>
                                    @if($fresherHiring->institute)
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">College / Institute:</td>
                                        <td style="padding: 7px 0; color: #0f172a; font-weight: 600;">{{ $fresherHiring->institute }}</td>
                                    </tr>
                                    @endif
                                    @if($fresherHiring->technology)
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">Technology / Domain:</td>
                                        <td style="padding: 7px 0; color: #0f172a; font-weight: 600;">{{ $fresherHiring->technology }}</td>
                                    </tr>
                                    @endif
                                    @if($fresherHiring->attachment)
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">Resume / File:</td>
                                        <td style="padding: 7px 0; color: #16a34a; font-weight: 600;">
                                            &#128206; Attached to this Email
                                        </td>
                                    </tr>
                                    @endif
                                </table>
                            </div>

                            <!-- Meta / Source Info -->
                            <div style="background-color: #f1f5f9; border-radius: 8px; padding: 14px 18px; margin-bottom: 20px; font-size: 12px; color: #64748b;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    @if($fresherHiring->url)
                                    <tr>
                                        <td style="padding: 3px 0; width: 28%; font-weight: 600;">Submitted From:</td>
                                        <td style="padding: 3px 0;"><a href="{{ $fresherHiring->url }}" style="color: #2563eb; text-decoration: none;">{{ $fresherHiring->url }}</a></td>
                                    </tr>
                                    @endif
                                    @if($fresherHiring->ip_address)
                                    <tr>
                                        <td style="padding: 3px 0; font-weight: 600;">IP Address:</td>
                                        <td style="padding: 3px 0;">{{ $fresherHiring->ip_address }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td style="padding: 3px 0; font-weight: 600;">Received At:</td>
                                        <td style="padding: 3px 0;">{{ $fresherHiring->created_at ? $fresherHiring->created_at->format('d M Y, h:i A') : now()->format('d M Y, h:i A') }}</td>
                                    </tr>
                                </table>
                            </div>

                            <p style="margin: 0; font-size: 13px; color: #94a3b8; text-align: center;">
                                <em>Tip: You can hit <strong>Reply</strong> to directly contact {{ $fresherHiring->name }} ({{ $fresherHiring->email }}).</em>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 16px 36px; text-align: center; font-size: 12px; color: #94a3b8;">
                            Sortiq Solutions &bull; Fresher Connect Notification System
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
