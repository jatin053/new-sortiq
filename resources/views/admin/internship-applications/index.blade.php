@extends('admin.layouts.app')

@section('title', 'Internship Applications')

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
        'kicker' => 'Internship management',
        'title' => 'Manage internship applications.',
        'description' => 'View technologies, institute, subject, and student application details for internships.',
    ])

    @include('admin.partials.overview-grid', [
        'columns' => 5,
        'items' => [
            ['label' => 'Total Applications', 'value' => $stats['total']],
            ['label' => 'Unread', 'value' => $stats['unread']],
            ['label' => 'Read', 'value' => $stats['read']],
            ['label' => 'Connected', 'value' => $stats['connected']],
            ['label' => 'Not Connected', 'value' => $stats['not_connected']],
        ],
    ])

    <section class="admin-content-panel">
        @include('admin.partials.list-tools', [
            'tabs' => [
                [
                    'label' => 'All',
                    'count' => $tabCounts['all'],
                    'url' => route('admin.internship-applications.index', array_filter([
                        'search' => $searchTerm,
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === null,
                ],
                [
                    'label' => 'Unread',
                    'count' => $tabCounts['unread'],
                    'url' => route('admin.internship-applications.index', array_filter([
                        'search' => $searchTerm,
                        'status' => 'unread',
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === 'unread',
                ],
                [
                    'label' => 'Read',
                    'count' => $tabCounts['read'],
                    'url' => route('admin.internship-applications.index', array_filter([
                        'search' => $searchTerm,
                        'status' => 'read',
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === 'read',
                ],
                [
                    'label' => 'Connected',
                    'count' => $tabCounts['connected'],
                    'url' => route('admin.internship-applications.index', array_filter([
                        'search' => $searchTerm,
                        'status' => 'connected',
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === 'connected',
                ],
                [
                    'label' => 'Not Connected',
                    'count' => $tabCounts['not_connected'],
                    'url' => route('admin.internship-applications.index', array_filter([
                        'search' => $searchTerm,
                        'status' => 'not_connected',
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === 'not_connected',
                ],
            ],
            'searchAction' => route('admin.internship-applications.index'),
            'searchValue' => $searchTerm,
            'searchAriaLabel' => 'Search applications',
            'searchPlaceholder' => 'Search applications',
            'hiddenFields' => ['status' => $activeStatus],
        ])

        <div class="reviews-table-wrap">
            <table class="reviews-table">
                <thead>
                    <tr>
                        <th class="title-column">Applicant</th>
                        <th>Technology & Institute</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Received</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($applications as $application)
                        <tr class="{{ $application->status === 'unread' ? 'unread-row' : '' }}">
                            <td class="title-column">
                                <a href="{{ route('admin.internship-applications.show', $application) }}" class="review-title">
                                    {{ $application->name }}
                                </a>
                                <div class="row-actions" style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap; margin-top: 4px;">
                                    <a href="mailto:{{ $application->email }}" title="Email applicant" style="display: inline-flex; align-items: center; gap: 4px;">
                                        <iconify-icon icon="lucide:mail" width="13" height="13" style="vertical-align: middle;"></iconify-icon> {{ $application->email }}
                                    </a>
                                    <span style="color: #d1d5db;">|</span>
                                    <span style="display: inline-flex; align-items: center; gap: 4px; color: #4b5563;">
                                        <iconify-icon icon="lucide:phone" width="13" height="13" style="vertical-align: middle;"></iconify-icon> {{ $application->phone_label }}
                                    </span>
                                    @if($application->phone)
                                        <span style="color: #d1d5db;">|</span>
                                        <a href="tel:{{ $application->clean_phone }}" title="Call applicant" style="display: inline-flex; align-items: center; gap: 4px; color: #2563eb; font-weight: 600;">
                                            <iconify-icon icon="lucide:phone-call" width="13" height="13" style="vertical-align: middle;"></iconify-icon> Call
                                        </a>
                                        <span style="color: #d1d5db;">|</span>
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $application->clean_phone) }}" target="_blank" rel="noopener noreferrer" title="WhatsApp applicant" style="display: inline-flex; align-items: center; gap: 4px; color: #16a34a; font-weight: 600;">
                                            <iconify-icon icon="fa6-brands:whatsapp" width="13" height="13" style="vertical-align: middle;"></iconify-icon> WhatsApp
                                        </a>
                                    @endif
                                    @if($application->url)
                                        <span style="color: #d1d5db;">|</span>
                                        <span style="color: var(--blue);">From: {{ parse_url($application->url, PHP_URL_PATH) ?: '/' }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div style="display: flex; gap: 6px; flex-wrap: wrap; align-items: center;">
                                    @if($application->technology)
                                        <span class="status-pill" style="font-size: 11px; padding: 2px 8px; background: #e0f2fe; color: #0369a1; border: 1px solid rgba(3, 105, 161, 0.2); border-radius: 4px;">
                                            {{ $application->technology }}
                                        </span>
                                    @endif
                                    @if($application->institute)
                                        <span class="status-pill" style="font-size: 11px; padding: 2px 8px; background: #f3e8ff; color: #6b21a8; border: 1px solid rgba(107, 33, 168, 0.2); border-radius: 4px; max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $application->institute }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span style="font-size: 13px; color: #374151; font-weight: 500;">
                                    {{ $application->subject ?: 'General' }}
                                </span>
                            </td>
                            <td>
                                @if($application->status === 'unread')
                                    <span class="status-pill status-pill-muted">Unread</span>
                                @elseif($application->status === 'read')
                                    <span class="status-pill status-pill-success" style="background: #ecfdf5; color: #047857; border: 1px solid rgba(4, 120, 87, 0.2);">Read</span>
                                @elseif($application->status === 'connected')
                                    <span class="status-pill" style="background: #e0f2fe; color: #0369a1; border: 1px solid rgba(3, 105, 161, 0.2); font-weight: 600;">Connected</span>
                                @elseif($application->status === 'not_connected')
                                    <span class="status-pill" style="background: #fff7ed; color: #c2410c; border: 1px solid rgba(194, 65, 12, 0.2); font-weight: 600;">Not Connected</span>
                                @else
                                    <span class="status-pill">{{ ucfirst($application->status) }}</span>
                                @endif
                            </td>
                            <td>{{ $application->created_at?->format('Y/m/d \a\t g:i a') }}</td>
                            <td>
                                <a href="{{ route('admin.internship-applications.show', $application) }}" class="small-btn">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state-cell">No internship applications found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @include('admin.partials.pagination', ['paginator' => $applications, 'label' => 'Internship applications pagination'])
    </section>
@endsection
