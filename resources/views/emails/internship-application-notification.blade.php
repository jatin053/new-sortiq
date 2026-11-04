<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Internship Application - Sortiq Solutions</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1e293b; line-height: 1.6;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f1f5f9; padding: 30px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width: 660px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.06); border: 1px solid #e2e8f0;">
                    
                    <!-- Top Brand Accent Bar -->
                    <tr>
                        <td style="height: 5px; background: linear-gradient(90deg, #6366f1 0%, #4f46e5 50%, #2563eb 100%);"></td>
                    </tr>

                    <!-- Header with Site Logo and Badge -->
                    <tr>
                        <td style="padding: 24px 32px; background-color: #ffffff; border-bottom: 1px solid #f1f5f9;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td align="left" style="vertical-align: middle;">
                                        <a href="{{ url('/') }}" target="_blank" style="text-decoration: none; display: inline-block;">
                                            <img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/11/final-logo.png') }}" alt="Sortiq Solutions" height="42" style="max-height: 42px; width: auto; display: block; border: 0;">
                                        </a>
                                    </td>
                                    <td align="right" style="vertical-align: middle;">
                                        <span style="display: inline-block; padding: 6px 14px; background-color: #eef2ff; color: #4f46e5; border: 1px solid rgba(99, 102, 241, 0.3); font-size: 11px; font-weight: 700; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;">
                                            INTERNSHIP APPLICATION
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 30px 32px 24px 32px;">
                            
                            <h2 style="margin: 0 0 6px 0; color: #0f172a; font-size: 19px; font-weight: 700;">
                                New Internship & Training Application
                            </h2>
                            <p style="margin: 0 0 20px 0; color: #64748b; font-size: 13.5px;">
                                An applicant submitted an application for the Industrial Training &amp; Internship Program.
                            </p>

                            <!-- Highlighted Source URL Box (Always Visible) -->
                            <div style="background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%); border: 1px solid #c7d2fe; border-left: 4px solid #4f46e5; border-radius: 8px; padding: 14px 18px; margin-bottom: 22px;">
                                <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #3730a3; letter-spacing: 0.5px; margin-bottom: 4px;">
                                     Submitted From Page URL
                                </div>
                                <div style="font-size: 14px; font-weight: 600; word-break: break-all;">
                                    @if($application->url)
                                        <a href="{{ $application->url }}" target="_blank" rel="noopener noreferrer" style="color: #4338ca; text-decoration: underline;">
                                            {{ $application->url }}
                                        </a>
                                    @else
                                        <span style="color: #64748b; font-style: italic;">Internship Application Page</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Applicant Information Table -->
                            <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 20px; margin-bottom: 22px;">
                                <h3 style="margin: 0 0 12px 0; color: #0f172a; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px;">
                                    Applicant Information
                                </h3>
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 13.5px;">
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; width: 34%; font-weight: 500;">Applicant Name:</td>
                                        <td style="padding: 7px 0; color: #0f172a; font-weight: 600;">{{ $application->name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">Email Address:</td>
                                        <td style="padding: 7px 0; color: #2563eb; font-weight: 600;">
                                            <a href="mailto:{{ $application->email }}" style="color: #2563eb; text-decoration: none;">{{ $application->email }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">Phone Number:</td>
                                        <td style="padding: 7px 0; color: #0f172a; font-weight: 600;">
                                            @if($application->clean_phone)
                                                <a href="tel:{{ $application->clean_phone }}" style="color: #0f172a; text-decoration: none;">{{ $application->phone_label }}</a>
                                            @else
                                                {{ $application->phone_label }}
                                            @endif
                                        </td>
                                    </tr>

                                    @if($application->subject)
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">Subject / Objective:</td>
                                        <td style="padding: 7px 0; color: #0f172a; font-weight: 600;">{{ $application->subject }}</td>
                                    </tr>
                                    @endif

                                    @if($application->technology)
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">Technology / Domain:</td>
                                        <td style="padding: 7px 0; color: #4f46e5; font-weight: 700;">
                                            <span style="display: inline-block; padding: 2px 10px; background-color: #eef2ff; border: 1px solid rgba(99, 102, 241, 0.25); border-radius: 4px;">
                                                {{ $application->technology }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endif

                                    @if($application->institute)
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">College / Institute:</td>
                                        <td style="padding: 7px 0; color: #0f172a; font-weight: 600;">{{ $application->institute }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>

                            <!-- CV / Resume Section (If present) -->
                            @php
                                $resumePath = $application->resume ?: ($application->attachment ?? null);
                            @endphp
                            @if(!empty($resumePath))
                            <div style="background-color: #f0fdf4; border: 1px solid #bbf7d0; border-left: 4px solid #16a34a; border-radius: 8px; padding: 16px 20px; margin-bottom: 22px;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td>
                                            <div style="font-size: 13px; font-weight: 700; color: #166534;">
                                                📎 CV / Resume Document Attached
                                            </div>
                                            <div style="font-size: 12px; color: #15803d; margin-top: 3px;">
                                                File: <strong>{{ basename($resumePath) }}</strong> (attached directly to this email)
                                            </div>
                                        </td>
                                        <td align="right">
                                            <a href="{{ asset('storage/' . $resumePath) }}" target="_blank" style="display: inline-block; padding: 7px 16px; background-color: #16a34a; color: #ffffff; font-size: 12px; font-weight: 700; text-decoration: none; border-radius: 6px;">
                                                View / Download CV ↗
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            @endif

                            <!-- Cover Note / Message Section -->
                            @if($application->message)
                            <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 20px; margin-bottom: 22px;">
                                <h3 style="margin: 0 0 10px 0; color: #0f172a; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                                    Cover Note / Statement
                                </h3>
                                <div style="background-color: #f8fafc; border: 1px solid #cbd5e1; border-radius: 6px; padding: 14px 16px; color: #1e293b; font-size: 13.5px; line-height: 1.6; white-space: pre-wrap;">{{ $application->message }}</div>
                            </div>
                            @endif

                            <!-- Technical Audit Info -->
                            <div style="background-color: #f8fafc; border-radius: 6px; padding: 12px 16px; margin-bottom: 20px; font-size: 11.5px; color: #64748b;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td style="padding: 2px 0; width: 24%; font-weight: 600;">Received At:</td>
                                        <td style="padding: 2px 0; color: #334155;">{{ $application->created_at ? $application->created_at->format('d M Y, h:i A') : now()->format('d M Y, h:i A') }}</td>
                                    </tr>
                                    @if($application->ip_address)
                                    <tr>
                                        <td style="padding: 2px 0; font-weight: 600;">IP Address:</td>
                                        <td style="padding: 2px 0; color: #334155;">{{ $application->ip_address }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>

                            <p style="margin: 0; font-size: 12.5px; color: #94a3b8; text-align: center;">
                                <em>Tip: You can click <strong>Reply</strong> in your email client to directly reply to {{ $application->name }} ({{ $application->email }}).</em>
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 16px 32px; text-align: center; font-size: 11.5px; color: #94a3b8; line-height: 1.5;">
                            Sortiq Solutions Pvt. Ltd. &bull; Internship Notification System<br>
                            E-51, Phase 8, Industrial Area, Mohali, Punjab &bull; +91 9646522110
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
