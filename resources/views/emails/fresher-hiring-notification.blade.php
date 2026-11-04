<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Fresher Connect Application - Sortiq Solutions</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1e293b; line-height: 1.6;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f1f5f9; padding: 30px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width: 660px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.06); border: 1px solid #e2e8f0;">
                    
                    <!-- Top Brand Accent Bar -->
                    <tr>
                        <td style="height: 5px; background: linear-gradient(90deg, #10b981 0%, #059669 50%, #2563eb 100%);"></td>
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
                                        <span style="display: inline-block; padding: 6px 14px; background-color: #ecfdf5; color: #059669; border: 1px solid rgba(16, 185, 129, 0.3); font-size: 11px; font-weight: 700; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;">
                                            FRESHER CONNECT
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
                                New Fresher Candidate Application
                            </h2>
                            <p style="margin: 0 0 20px 0; color: #64748b; font-size: 13.5px;">
                                A new candidate submitted an application through the Fresher Connect modal form. Candidate details:
                            </p>

                            <!-- Highlighted Source URL Box (Always Visible) -->
                            <div style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 1px solid #bbf7d0; border-left: 4px solid #10b981; border-radius: 8px; padding: 14px 18px; margin-bottom: 22px;">
                                <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #065f46; letter-spacing: 0.5px; margin-bottom: 4px;">
                                    Submitted From Page URL
                                </div>
                                <div style="font-size: 14px; font-weight: 600; word-break: break-all;">
                                    @if($fresherHiring->url)
                                        <a href="{{ $fresherHiring->url }}" target="_blank" rel="noopener noreferrer" style="color: #047857; text-decoration: underline;">
                                            {{ $fresherHiring->url }}
                                        </a>
                                    @else
                                        <span style="color: #64748b; font-style: italic;">Fresher Hiring Modal (Global Website)</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Highlighted Source URL Box (Always Visible) -->
                            <div style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 1px solid #bbf7d0; border-left: 4px solid #10b981; border-radius: 8px; padding: 14px 18px; margin-bottom: 22px;">
                                <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #065f46; letter-spacing: 0.5px; margin-bottom: 4px;">
                                    📍 Submitted From Page URL
                                </div>
                                <div style="font-size: 14px; font-weight: 600; word-break: break-all;">
                                    @if($fresherHiring->url)
                                        <a href="{{ $fresherHiring->url }}" target="_blank" rel="noopener noreferrer" style="color: #047857; text-decoration: underline;">
                                            {{ $fresherHiring->url }}
                                        </a>
                                    @else
                                        <span style="color: #64748b; font-style: italic;">Fresher Hiring Modal (Global Website)</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Candidate Details Table -->
                            <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 20px; margin-bottom: 22px;">
                                <h3 style="margin: 0 0 12px 0; color: #0f172a; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px;">
                                    Candidate Profile
                                </h3>
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 13.5px;">
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; width: 34%; font-weight: 500;">Candidate Name:</td>
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

                                    @if($fresherHiring->technology)
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">Technology / Domain:</td>
                                        <td style="padding: 7px 0; color: #059669; font-weight: 700;">
                                            <span style="display: inline-block; padding: 2px 10px; background-color: #ecfdf5; border: 1px solid rgba(16, 185, 129, 0.25); border-radius: 4px;">
                                                {{ $fresherHiring->technology }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endif

                                    @if($fresherHiring->institute)
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">College / Institute:</td>
                                        <td style="padding: 7px 0; color: #0f172a; font-weight: 600;">{{ $fresherHiring->institute }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>

                            <!-- CV / Attachment Section (If present) -->
                            @if($fresherHiring->attachment)
                            <div style="background-color: #f0fdf4; border: 1px solid #bbf7d0; border-left: 4px solid #16a34a; border-radius: 8px; padding: 16px 20px; margin-bottom: 22px;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td>
                                            <div style="font-size: 13px; font-weight: 700; color: #166534;">
                                                📎 CV / Resume Document Attached
                                            </div>
                                            <div style="font-size: 12px; color: #15803d; margin-top: 3px;">
                                                File: <strong>{{ basename($fresherHiring->attachment) }}</strong> (attached directly to this email)
                                            </div>
                                        </td>
                                        <td align="right">
                                            <a href="{{ asset('storage/' . $fresherHiring->attachment) }}" target="_blank" style="display: inline-block; padding: 7px 16px; background-color: #16a34a; color: #ffffff; font-size: 12px; font-weight: 700; text-decoration: none; border-radius: 6px;">
                                                View / Download CV ↗
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            @endif

                            <!-- Technical Audit Info -->
                            <div style="background-color: #f8fafc; border-radius: 6px; padding: 12px 16px; margin-bottom: 20px; font-size: 11.5px; color: #64748b;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td style="padding: 2px 0; width: 24%; font-weight: 600;">Received At:</td>
                                        <td style="padding: 2px 0; color: #334155;">{{ $fresherHiring->created_at ? $fresherHiring->created_at->format('d M Y, h:i A') : now()->format('d M Y, h:i A') }}</td>
                                    </tr>
                                    @if($fresherHiring->ip_address)
                                    <tr>
                                        <td style="padding: 2px 0; font-weight: 600;">IP Address:</td>
                                        <td style="padding: 2px 0; color: #334155;">{{ $fresherHiring->ip_address }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>

                            <p style="margin: 0; font-size: 12.5px; color: #94a3b8; text-align: center;">
                                <em>Tip: You can click <strong>Reply</strong> in your email client to directly email {{ $fresherHiring->name }} ({{ $fresherHiring->email }}).</em>
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 16px 32px; text-align: center; font-size: 11.5px; color: #94a3b8; line-height: 1.5;">
                            Sortiq Solutions Pvt. Ltd. &bull; Fresher Connect Notification System<br>
                            E-51, Phase 8, Industrial Area, Mohali, Punjab &bull; +91 9646522110
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
