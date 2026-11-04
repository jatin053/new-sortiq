@extends('admin.layouts.app')

@section('title', 'Portfolio')

@php
    $searchTerm = $searchTerm ?? '';
    $activeStatus = $activeStatus ?? null;
    $activeCategory = $activeCategory ?? null;
    $activeTag = $activeTag ?? null;
    $activeDate = $activeDate ?? null;
    $categories = $categories ?? [];
    $dateOptions = $dateOptions ?? [];
    $tabCounts = array_replace([
        'all' => 0,
        'published' => 0,
        'draft' => 0,
    ], $tabCounts ?? []);
@endphp

@section('content')
    @include('admin.partials.page-hero', [
        'kicker' => 'Portfolio',
        'title' => $activeTag ? '#' . $activeTag . ' portfolio projects.' : ($activeCategory ? 'Filtered portfolio projects.' : 'Manage portfolio projects.'),
        'description' => ($activeCategory || $activeTag) ? 'Showing only projects related to the selected filter.' : 'Create, organize, and publish portfolio items that appear on the website.',
        'actions' => [
            [
                'label' => 'Add Portfolio',
                'url' => route('admin.portfolios.create'),
                'class' => 'primary-btn',
            ],
        ],
    ])

    @if (session('status'))
        <div class="success-box">{{ session('status') }}</div>
    @endif

    @include('admin.partials.overview-grid', [
        'items' => [
            ['label' => 'Total Projects', 'value' => $stats['total']],
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
                    'url' => route('admin.portfolios.index', array_filter([
                        'search' => $searchTerm,
                        'category' => $activeCategory,
                        'tag' => $activeTag,
                        'date' => $activeDate,
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === null,
                ],
                [
                    'label' => 'Published',
                    'count' => $tabCounts['published'],
                    'url' => route('admin.portfolios.index', array_filter([
                        'search' => $searchTerm,
                        'category' => $activeCategory,
                        'tag' => $activeTag,
                        'date' => $activeDate,
                        'status' => 'published',
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === 'published',
                ],
                [
                    'label' => 'Draft',
                    'count' => $tabCounts['draft'],
                    'url' => route('admin.portfolios.index', array_filter([
                        'search' => $searchTerm,
                        'category' => $activeCategory,
                        'tag' => $activeTag,
                        'date' => $activeDate,
                        'status' => 'draft',
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === 'draft',
                ],
            ],
            'searchAction' => route('admin.portfolios.index'),
            'searchValue' => $searchTerm,
            'searchAriaLabel' => 'Search portfolio',
            'searchPlaceholder' => 'Search portfolio projects',
            'hiddenFields' => ['status' => $activeStatus, 'category' => $activeCategory, 'tag' => $activeTag, 'date' => $activeDate],
            'categories' => $categories,
            'tagsList' => $tagsList ?? [],
            'dateOptions' => $dateOptions,
            'activeCategory' => $activeCategory,
            'activeTag' => $activeTag,
            'activeDate' => $activeDate,
            'bulkActionUrl' => route('admin.portfolios.bulk-action'),
            'totalItems' => $portfolios->total(),
        ])

        @include('admin.portfolios.partials.table', ['portfolios' => $portfolios])
        @include('admin.partials.pagination', ['paginator' => $portfolios, 'label' => 'Portfolio pagination'])
    </section>
@endsection
