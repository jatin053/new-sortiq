@extends('admin.layouts.app')

@section('title', 'Fresher connect')

@section('content')
    @include('admin.partials.page-hero', [
        'kicker' => 'Fresher hiring details',
        'title' => 'Fresher Application',
        'description' => 'View the candidate application and uploaded resume.',
        'actions' => [
            [
                'label' => 'Back to List',
                'url' => route('admin.fresher-hirings.index'),
                'class' => 'btn',
            ],
            [
                'label' => 'Reply by Email',
                'url' => 'mailto:' . $fresher->email . '?subject=Re: Fresher Application',
                'class' => 'btn',
            ],
        ],
    ])

    @include('admin.partials.overview-grid', [
        'columns' => 4,
        'items' => [
            ['label' => 'Applicant', 'value' => $fresher->name],
            ['label' => 'Technology', 'value' => $fresher->technology ?: 'General'],
            ['label' => 'Phone', 'value' => $fresher->phone_label],
            ['label' => 'Received', 'value' => $fresher->created_at?->format('Y/m/d g:i a') ?? 'Not available'],
        ],
    ])

    <div class="settings-grid">
        <section class="admin-content-panel">
            <div class="dashboard-panel-head">
                <div>
                    <span class="panel-kicker">Manage status</span>
                    <h2>Applicant engagement</h2>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 16px;">
                <div>
                    <span style="font-size: 13px; font-weight: 600; color: #4b5563; display: block; margin-bottom: 6px;">Current Status</span>
                    @if($fresher->status === 'unread')
                        <span class="status-pill status-pill-muted" style="display: inline-block;">Unread</span>
                    @elseif($fresher->status === 'read')
                        <span class="status-pill status-pill-success" style="display: inline-block; background: #ecfdf5; color: #047857; border: 1px solid rgba(4, 120, 87, 0.2);">Read</span>
                    @elseif($fresher->status === 'connected')
                        <span class="status-pill" style="display: inline-block; background: #e0f2fe; color: #0369a1; border: 1px solid rgba(3, 105, 161, 0.2); font-weight: 600;">Connected</span>
                    @elseif($fresher->status === 'not_connected')
                        <span class="status-pill" style="display: inline-block; background: #fff7ed; color: #c2410c; border: 1px solid rgba(194, 65, 12, 0.2); font-weight: 600;">Not Connected</span>
                    @endif
                </div>

                <div style="border-top: 1px solid #f3f4f6; padding-top: 16px;">
                    <span style="font-size: 13px; font-weight: 600; color: #4b5563; display: block; margin-bottom: 12px;">Change Status To:</span>
                    <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                        <form action="{{ route('admin.fresher-hirings.update-status', $fresher) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="connected">
                            <button type="submit" class="small-btn" style="background: #e0f2fe; color: #0369a1; border: 1px solid rgba(3, 105, 161, 0.3); padding: 8px 16px; font-weight: 600; cursor: pointer; border-radius: 6px;">
                                <iconify-icon icon="lucide:check-circle" width="14" height="14" style="vertical-align: middle; margin-right: 4px;"></iconify-icon> Connected
                            </button>
                        </form>

                        <form action="{{ route('admin.fresher-hirings.update-status', $fresher) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="not_connected">
                            <button type="submit" class="small-btn" style="background: #fff7ed; color: #c2410c; border: 1px solid rgba(194, 65, 12, 0.3); padding: 8px 16px; font-weight: 600; cursor: pointer; border-radius: 6px;">
                                <iconify-icon icon="lucide:x-circle" width="14" height="14" style="vertical-align: middle; margin-right: 4px;"></iconify-icon> Not Connected
                            </button>
                        </form>

                        @if($fresher->status !== 'read')
                        <form action="{{ route('admin.fresher-hirings.update-status', $fresher) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="read">
                            <button type="submit" class="small-btn" style="background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; padding: 8px 16px; cursor: pointer; border-radius: 6px;">
                                Mark as Read
                            </button>
                        </form>
                        @endif
                    </div>
                </div>

                <div style="border-top: 1px solid #f3f4f6; padding-top: 16px;">
                    <span style="font-size: 13px; font-weight: 600; color: #4b5563; display: block; margin-bottom: 12px;">Direct Actions:</span>
                    <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                        @if($fresher->phone)
                        <a href="tel:{{ $fresher->clean_phone }}" class="btn" style="display: inline-flex; align-items: center; gap: 8px; background: #2563eb; color: #ffffff; padding: 10px 20px; font-weight: 600; border-radius: 6px; text-decoration: none;">
                            <iconify-icon icon="lucide:phone-call" width="16" height="16" style="vertical-align: middle;"></iconify-icon> Call Candidate
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $fresher->clean_phone) }}" target="_blank" rel="noopener noreferrer" class="btn" style="display: inline-flex; align-items: center; gap: 8px; background: #16a34a; color: #ffffff; padding: 10px 20px; font-weight: 600; border-radius: 6px; text-decoration: none;">
                            <iconify-icon icon="fa6-brands:whatsapp" width="16" height="16" style="vertical-align: middle;"></iconify-icon> WhatsApp Chat
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section class="admin-content-panel">
            <div class="dashboard-panel-head">
                <div>
                    <span class="panel-kicker">Education & Technology</span>
                    <h2>Candidate background</h2>
                </div>
            </div>

            <dl class="contact-message-meta">
                <div>
                    <dt>Name</dt>
                    <dd>{{ $fresher->name }}</dd>
                </div>
                <div>
                    <dt>Email</dt>
                    <dd><a href="mailto:{{ $fresher->email }}">{{ $fresher->email }}</a></dd>
                </div>
                <div>
                    <dt>Phone</dt>
                    <dd>{{ $fresher->phone_label }}</dd>
                </div>
                <div>
                    <dt>Institute</dt>
                    <dd>{{ $fresher->institute ?: 'Not specified' }}</dd>
                </div>
                <div>
                    <dt>Technology Preferred</dt>
                    <dd>{{ $fresher->technology ?: 'Not specified' }}</dd>
                </div>
                @if($fresher->url)
                <div>
                    <dt>Submitted From URL</dt>
                    <dd>
                        <a href="{{ $fresher->url }}" target="_blank" rel="noopener noreferrer" style="color: var(--blue); text-decoration: underline;">
                            {{ $fresher->url }}
                        </a>
                    </dd>
                </div>
                @endif
                @if($fresher->attachment)
                <div>
                    <dt>Resume / CV</dt>
                    <dd>
                        <a href="{{ route('admin.fresher-hirings.download', $fresher) }}" class="small-btn" style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #e3f9eb; color: #1f7a42; border: 1px solid rgba(31, 122, 66, 0.2); border-radius: 4px;">
                            <iconify-icon icon="lucide:download" width="14" height="14" style="vertical-align: middle;"></iconify-icon> Download Resume
                        </a>
                    </dd>
                </div>
                @endif
                <div>
                    <dt>Received At</dt>
                    <dd>{{ $fresher->created_at?->format('Y/m/d \a\t g:i a') ?? 'Not available' }}</dd>
                </div>
                <div>
                    <dt>Read At</dt>
                    <dd>{{ $fresher->read_at?->format('Y/m/d \a\t g:i a') ?? 'Not read yet' }}</dd>
                </div>
                <div>
                    <dt>IP Address</dt>
                    <dd>{{ $fresher->ip_address ?: 'Not captured' }}</dd>
                </div>
                <div>
                    <dt>User Agent</dt>
                    <dd class="contact-message-user-agent">{{ $fresher->user_agent ?: 'Not captured' }}</dd>
                </div>
            </dl>
        </section>
    </div>
@endsection
