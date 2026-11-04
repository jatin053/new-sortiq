@extends('admin.layouts.app')

@php
    $currentFilter = $currentFilter ?? 'inquiry';
    $titleLabel = ($currentFilter === 'application') ? 'Applications' : 'Contact Messages';
@endphp

@section('title', $titleLabel)

@php
    $searchTerm = $searchTerm ?? '';
    $activeStatus = $activeStatus ?? null;
    $tabCounts = array_replace([
        'all' => 0,
        'unread' => 0,
        'read' => 0,
    ], $tabCounts ?? []);
@endphp

@section('content')
    @include('admin.partials.page-hero', [
        'kicker' => ($currentFilter === 'application') ? 'Applications' : 'Inbox',
        'title' => ($currentFilter === 'application') ? 'Manage job & internship applications.' : 'Manage contact enquiries.',
        'description' => ($currentFilter === 'application') ? 'View resume attachments, technologies, and institute application details.' : 'Every message sent from the website contact form is stored here and can also be emailed through SMTP.',
    ])

    @include('admin.partials.overview-grid', [
        'items' => [
            ['label' => ($currentFilter === 'application') ? 'Total Applications' : 'Total Messages', 'value' => $stats['total']],
            ['label' => 'Unread', 'value' => $stats['unread']],
            ['label' => 'Read', 'value' => $stats['read']],
        ],
    ])

    <section class="admin-content-panel">
        @include('admin.partials.list-tools', [
            'tabs' => [
                [
                    'label' => 'All',
                    'count' => $tabCounts['all'],
                    'url' => route('admin.contact-messages.index', array_filter([
                        'search' => $searchTerm,
                        'filter' => $currentFilter,
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === null,
                ],
                [
                    'label' => 'Unread',
                    'count' => $tabCounts['unread'],
                    'url' => route('admin.contact-messages.index', array_filter([
                        'search' => $searchTerm,
                        'status' => 'unread',
                        'filter' => $currentFilter,
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === 'unread',
                ],
                [
                    'label' => 'Read',
                    'count' => $tabCounts['read'],
                    'url' => route('admin.contact-messages.index', array_filter([
                        'search' => $searchTerm,
                        'status' => 'read',
                        'filter' => $currentFilter,
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === 'read',
                ],
            ],
            'searchAction' => route('admin.contact-messages.index'),
            'searchValue' => $searchTerm,
            'searchAriaLabel' => ($currentFilter === 'application') ? 'Search applications' : 'Search contact messages',
            'searchPlaceholder' => ($currentFilter === 'application') ? 'Search applications' : 'Search enquiries',
            'hiddenFields' => ['status' => $activeStatus, 'filter' => $currentFilter],
        ])

        <div class="reviews-table-wrap">
            <table class="reviews-table">
                <thead>
                    <tr>
                        <th class="title-column">Sender</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Received</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($messages as $message)
                        <tr class="{{ $message->status === 'unread' ? 'unread-row' : '' }}">
                            <td class="title-column">
                                <a href="{{ route('admin.contact-messages.show', $message) }}" class="review-title">
                                    {{ $message->name }}
                                </a>
                                <div class="row-actions">
                                    <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                                    <span>|</span>
                                    <span>{{ $message->phone_label }}</span>
                                    @if($message->url)
                                        <span>|</span>
                                        <span style="color: var(--blue);">From: {{ parse_url($message->url, PHP_URL_PATH) ?: '/' }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div>{{ $message->subject }}</div>
                                <div style="display: flex; gap: 6px; flex-wrap: wrap; margin-top: 4px;">
                                    @if($message->type && $message->type !== 'contact')
                                        <span class="status-pill" style="font-size: 11px; padding: 2px 8px; background: var(--blue-light); color: var(--blue); border: 1px solid rgba(45, 110, 246, 0.2); border-radius: 4px;">
                                            {{ ucfirst($message->type) }}
                                        </span>
                                    @endif
                                    @if($message->attachment)
                                        <a href="{{ route('admin.contact-messages.download', $message) }}" class="status-pill" style="font-size: 11px; padding: 2px 8px; background: #e3f9eb; color: #1f7a42; border: 1px solid rgba(31, 122, 66, 0.2); border-radius: 4px; display: inline-flex; align-items: center; gap: 4px; text-decoration: none;">
                                            <iconify-icon icon="lucide:paperclip" width="10" height="10" style="vertical-align: middle;"></iconify-icon> Resume
                                        </a>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="status-pill {{ $message->status === 'unread' ? 'status-pill-muted' : 'status-pill-success' }}">
                                    {{ ucfirst($message->status) }}
                                </span>
                            </td>
                            <td>{{ $message->created_at?->format('Y/m/d \a\t g:i a') }}</td>
                            <td>
                                <a href="{{ route('admin.contact-messages.show', $message) }}" class="small-btn">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state-cell">No contact messages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @include('admin.partials.pagination', ['paginator' => $messages, 'label' => 'Contact messages pagination'])
    </section>
@endsection
