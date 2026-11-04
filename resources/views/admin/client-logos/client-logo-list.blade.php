@extends('admin.layouts.app')

@section('title', 'Client Logos')

@php
    $searchTerm = $searchTerm ?? '';
    $activeStatus = $activeStatus ?? null;
    $tabCounts = array_replace([
        'all' => 0,
        'published' => 0,
        'draft' => 0,
    ], $tabCounts ?? []);
@endphp

@section('content')
    @include('admin.partials.page-hero', [
        'kicker' => 'Client Logos',
        'title' => 'Manage client logos.',
        'description' => 'Keep partner logos organized and ready to display on the website.',
        'actions' => [
            [
                'label' => 'Add Client Logo',
                'url' => route('admin.client-logos.create'),
                'class' => 'primary-btn',
            ],
        ],
    ])

    @if (session('status'))
        <div class="success-box">{{ session('status') }}</div>
    @endif

    @include('admin.partials.overview-grid', [
        'items' => [
            ['label' => 'Total Logos', 'value' => $stats['total']],
            ['label' => 'Published', 'value' => $stats['published']],
            ['label' => 'Drafts', 'value' => $stats['draft']],
        ],
    ])

    <section class="admin-content-panel">
        @include('admin.partials.list-tools', [
            'tabs' => [
                [
                    'label' => 'All',
                    'count' => $tabCounts['all'],
                    'url' => route('admin.client-logos.index', array_filter([
                        'search' => $searchTerm,
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === null,
                ],
                [
                    'label' => 'Published',
                    'count' => $tabCounts['published'],
                    'url' => route('admin.client-logos.index', array_filter([
                        'search' => $searchTerm,
                        'status' => 'published',
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === 'published',
                ],
                [
                    'label' => 'Draft',
                    'count' => $tabCounts['draft'],
                    'url' => route('admin.client-logos.index', array_filter([
                        'search' => $searchTerm,
                        'status' => 'draft',
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === 'draft',
                ],
            ],
            'searchAction' => route('admin.client-logos.index'),
            'searchValue' => $searchTerm,
            'searchAriaLabel' => 'Search client logos',
            'searchPlaceholder' => 'Search client brands',
            'hiddenFields' => ['status' => $activeStatus],
        ])

        @include('admin.client-logos.partials.table', ['clientLogos' => $clientLogos])
        @include('admin.partials.pagination', ['paginator' => $clientLogos, 'label' => 'Client logos pagination'])
    </section>
@endsection

