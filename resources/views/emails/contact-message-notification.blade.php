<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Website Submission - Sortiq Solutions</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1e293b; line-height: 1.6;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f1f5f9; padding: 30px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width: 660px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.06); border: 1px solid #e2e8f0;">
                    
                    <!-- Top Brand Accent Bar -->
                    <tr>
                        <td style="height: 5px; background: linear-gradient(90deg, #ff6600 0%, #ff8533 50%, #2563eb 100%);"></td>
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
                                        <span style="display: inline-block; padding: 6px 14px; background-color: #fff4eb; color: #ff6600; border: 1px solid rgba(255, 102, 0, 0.25); font-size: 11px; font-weight: 700; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;">
                                            {{ strtoupper($contactMessage->type ?? 'ENQUIRY') }}
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
                                New Website Lead Received
                            </h2>
                            <p style="margin: 0 0 20px 0; color: #64748b; font-size: 13.5px;">
                                A visitor submitted a form on Sortiq Solutions website. All submitted details are below:
                            </p>

                            <!-- Highlighted Source URL Box (Always Visible) -->
                            <div style="background: linear-gradient(135deg, #f0f7ff 0%, #e0f2fe 100%); border: 1px solid #bae6fd; border-left: 4px solid #0284c7; border-radius: 8px; padding: 14px 18px; margin-bottom: 22px;">
                                <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #0369a1; letter-spacing: 0.5px; margin-bottom: 4px;">
                                     Submitted From Page URL
                                </div>
                                <div style="font-size: 14px; font-weight: 600; word-break: break-all;">
                                    @if($contactMessage->url)
                                        <a href="{{ $contactMessage->url }}" target="_blank" rel="noopener noreferrer" style="color: #0284c7; text-decoration: underline;">
                                            {{ $contactMessage->url }}
                                        </a>
                                    @else
                                        <span style="color: #64748b; font-style: italic;">Direct Website Form Submission</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Applicant / Sender Details Table -->
                            <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 20px; margin-bottom: 22px;">
                                <h3 style="margin: 0 0 12px 0; color: #0f172a; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px;">
                                    Sender Information
                                </h3>
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 13.5px;">
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; width: 34%; font-weight: 500;">Full Name:</td>
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

                                    @if($contactMessage->subject)
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">Subject / Reason:</td>
                                        <td style="padding: 7px 0; color: #0f172a; font-weight: 600;">{{ $contactMessage->subject }}</td>
                                    </tr>
                                    @endif

                                    @if($contactMessage->technology)
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">Service / Domain:</td>
                                        <td style="padding: 7px 0; color: #ff6600; font-weight: 700;">
                                            <span style="display: inline-block; padding: 2px 10px; background-color: #fff4eb; border: 1px solid rgba(255, 102, 0, 0.2); border-radius: 4px;">
                                                {{ $contactMessage->technology }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endif

                                    @if($contactMessage->institute)
                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">College / Institute:</td>
                                        <td style="padding: 7px 0; color: #0f172a; font-weight: 600;">{{ $contactMessage->institute }}</td>
                                    </tr>
                                    @endif

                                    <tr>
                                        <td style="padding: 7px 0; color: #64748b; font-weight: 500;">Form Type:</td>
                                        <td style="padding: 7px 0; color: #475569; font-weight: 600;">{{ ucfirst($contactMessage->type ?? 'Contact') }}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- CV / Attachment Section (If present) -->
                            @if($contactMessage->attachment)
                            <div style="background-color: #f0fdf4; border: 1px solid #bbf7d0; border-left: 4px solid #16a34a; border-radius: 8px; padding: 16px 20px; margin-bottom: 22px;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td>
                                            <div style="font-size: 13px; font-weight: 700; color: #166534; display: flex; align-items: center; gap: 6px;">
                                                📎 CV / Resume Document Attached
                                            </div>
                                            <div style="font-size: 12px; color: #15803d; margin-top: 3px;">
                                                File: <strong>{{ basename($contactMessage->attachment) }}</strong> (also attached to this email)
                                            </div>
                                        </td>
                                        <td align="right">
                                            <a href="{{ asset('storage/' . $contactMessage->attachment) }}" target="_blank" style="display: inline-block; padding: 7px 16px; background-color: #16a34a; color: #ffffff; font-size: 12px; font-weight: 700; text-decoration: none; border-radius: 6px;">
                                                View / Download CV ↗
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            @endif

                            <!-- Message Section -->
                            @if($contactMessage->message)
                            <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 20px; margin-bottom: 22px;">
                                <h3 style="margin: 0 0 10px 0; color: #0f172a; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                                    Message / Requirements
                                </h3>
                                <div style="background-color: #f8fafc; border: 1px solid #cbd5e1; border-radius: 6px; padding: 14px 16px; color: #1e293b; font-size: 13.5px; line-height: 1.6; white-space: pre-wrap;">{{ $contactMessage->message }}</div>
                            </div>
                            @endif

                            <!-- Technical Audit Info -->
                            <div style="background-color: #f8fafc; border-radius: 6px; padding: 12px 16px; margin-bottom: 20px; font-size: 11.5px; color: #64748b;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td style="padding: 2px 0; width: 24%; font-weight: 600;">Received At:</td>
                                        <td style="padding: 2px 0; color: #334155;">{{ $contactMessage->created_at ? $contactMessage->created_at->format('d M Y, h:i A') : now()->format('d M Y, h:i A') }}</td>
                                    </tr>
                                    @if($contactMessage->ip_address)
                                    <tr>
                                        <td style="padding: 2px 0; font-weight: 600;">IP Address:</td>
                                        <td style="padding: 2px 0; color: #334155;">{{ $contactMessage->ip_address }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>

                            <p style="margin: 0; font-size: 12.5px; color: #94a3b8; text-align: center;">
                                <em>Tip: You can click <strong>Reply</strong> in your email client to directly reply to {{ $contactMessage->name }} ({{ $contactMessage->email }}).</em>
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 16px 32px; text-align: center; font-size: 11.5px; color: #94a3b8; line-height: 1.5;">
                            Sortiq Solutions Pvt. Ltd. &bull; Automated Lead Notification System<br>
                            E-51, Phase 8, Industrial Area, Mohali, Punjab &bull; +91 9646522110
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
