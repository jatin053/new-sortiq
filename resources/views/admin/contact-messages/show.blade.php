@extends('admin.layouts.app')

@section('title', 'Contact Message')

@section('content')
    @include('admin.partials.page-hero', [
        'kicker' => ($contactMessage->type === 'contact') ? 'Contact Message' : 'Application Details',
        'title' => $contactMessage->subject ?: 'Message Details',
        'description' => 'View the full contact enquiry and all stored sender details.',
        'actions' => [
            [
                'label' => ($contactMessage->type === 'contact') ? 'Back to Inbox' : 'Back to Applications',
                'url' => route('admin.contact-messages.index', ['filter' => ($contactMessage->type === 'contact') ? 'inquiry' : 'application']),
                'class' => 'btn',
            ],
            [
                'label' => 'Reply by Email',
                'url' => 'mailto:' . $contactMessage->email . '?subject=Re: ' . rawurlencode($contactMessage->subject),
                'class' => 'btn',
            ],
        ],
    ])

    @include('admin.partials.overview-grid', [
        'columns' => 4,
        'items' => [
            ['label' => 'Sender', 'value' => $contactMessage->name],
            ['label' => 'Status', 'value' => ucfirst($contactMessage->status)],
            ['label' => 'Phone', 'value' => $contactMessage->phone_label],
            ['label' => 'Received', 'value' => $contactMessage->created_at?->format('Y/m/d g:i a') ?? 'Not available'],
        ],
    ])

    <div class="settings-grid">
        <section class="admin-content-panel">
            <div class="dashboard-panel-head">
                <div>
                    <span class="panel-kicker">Message</span>
                    <h2>Full contact message</h2>
                </div>
            </div>

            <div class="contact-message-text">
                {!! nl2br(e($contactMessage->message ?: 'No message provided.')) !!}
            </div>
        </section>

        <section class="admin-content-panel">
            <div class="dashboard-panel-head">
                <div>
                    <span class="panel-kicker">Details</span>
                    <h2>Sender information</h2>
                </div>
            </div>

            <dl class="contact-message-meta">
                <div>
                    <dt>Name</dt>
                    <dd>{{ $contactMessage->name }}</dd>
                </div>
                <div>
                    <dt>Email</dt>
                    <dd><a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a></dd>
                </div>
                <div>
                    <dt>Phone</dt>
                    <dd>{{ $contactMessage->phone_label }}</dd>
                </div>
                <div>
                    <dt>Subject</dt>
                    <dd>{{ $contactMessage->subject ?: 'Not provided' }}</dd>
                </div>
                <div>
                    <dt>Status</dt>
                    <dd>{{ ucfirst($contactMessage->status) }}</dd>
                </div>
                @if($contactMessage->type)
                <div>
                    <dt>Form Type</dt>
                    <dd>
                        <span class="status-pill" style="background: var(--blue-light); color: var(--blue); border: 1px solid rgba(45, 110, 246, 0.2);">
                            {{ ucfirst($contactMessage->type) }}
                        </span>
                    </dd>
                </div>
                @endif
                @if($contactMessage->url)
                <div>
                    <dt>Submitted From URL</dt>
                    <dd>
                        <a href="{{ $contactMessage->url }}" target="_blank" rel="noopener noreferrer" style="color: var(--blue); text-decoration: underline;">
                            {{ $contactMessage->url }}
                        </a>
                    </dd>
                </div>
                @endif
                @if($contactMessage->institute)
                <div>
                    <dt>Institute</dt>
                    <dd>{{ $contactMessage->institute }}</dd>
                </div>
                @endif
                @if($contactMessage->technology)
                <div>
                    <dt>Technology</dt>
                    <dd>{{ $contactMessage->technology }}</dd>
                </div>
                @endif
                @if($contactMessage->attachment)
                <div>
                    <dt>Attachment / Resume</dt>
                    <dd>
                        <a href="{{ route('admin.contact-messages.download', $contactMessage) }}" class="small-btn" style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #e3f9eb; color: #1f7a42; border: 1px solid rgba(31, 122, 66, 0.2); border-radius: 4px;">
                            <iconify-icon icon="lucide:download" width="14" height="14" style="vertical-align: middle;"></iconify-icon> Download Resume
                        </a>
                    </dd>
                </div>
                @endif
                <div>
                    <dt>Received At</dt>
                    <dd>{{ $contactMessage->created_at?->format('Y/m/d \a\t g:i a') ?? 'Not available' }}</dd>
                </div>
                <div>
                    <dt>Read At</dt>
                    <dd>{{ $contactMessage->read_at?->format('Y/m/d \a\t g:i a') ?? 'Not read yet' }}</dd>
                </div>
                <div>
                    <dt>IP Address</dt>
                    <dd>{{ $contactMessage->ip_address ?: 'Not captured' }}</dd>
                </div>
                <div>
                    <dt>User Agent</dt>
                    <dd class="contact-message-user-agent">{{ $contactMessage->user_agent ?: 'Not captured' }}</dd>
                </div>
            </dl>
        </section>
    </div>
@endsection
