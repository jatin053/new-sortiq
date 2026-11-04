@extends('admin.layouts.app')

@section('title', 'Videos')

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
        'kicker' => 'Videos',
        'title' => 'Manage website videos.',
        'description' => 'Update the gallery shown on the public videos page and control video order, status, and links.',
        'actions' => [
            [
                'label' => 'Add Video',
                'url' => route('admin.videos.create'),
                'class' => 'primary-btn',
            ],
        ],
    ])

    @if (session('status'))
        <div class="success-box">{{ session('status') }}</div>
    @endif

    @include('admin.partials.overview-grid', [
        'items' => [
            ['label' => 'Total Videos', 'value' => $stats['total']],
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
                    'url' => route('admin.videos.index', array_filter([
                        'search' => $searchTerm,
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === null,
                ],
                [
                    'label' => 'Published',
                    'count' => $tabCounts['published'],
                    'url' => route('admin.videos.index', array_filter([
                        'search' => $searchTerm,
                        'status' => 'published',
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === 'published',
                ],
                [
                    'label' => 'Draft',
                    'count' => $tabCounts['draft'],
                    'url' => route('admin.videos.index', array_filter([
                        'search' => $searchTerm,
                        'status' => 'draft',
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === 'draft',
                ],
            ],
            'bulkActionUrl' => route('admin.videos.bulk-action'),
            'searchAction' => route('admin.videos.index'),
            'searchValue' => $searchTerm,
            'searchAriaLabel' => 'Search videos',
            'searchPlaceholder' => 'Search videos',
            'hiddenFields' => ['status' => $activeStatus],
        ])

        @include('admin.videos.partials.table', ['videos' => $videos])
        @include('admin.partials.pagination', ['paginator' => $videos, 'label' => 'Videos pagination'])
    </section>
@endsection
