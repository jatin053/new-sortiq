@extends('admin.layouts.app')

@section('title', 'Reviews')

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
        'kicker' => 'Reviews',
        'title' => 'Manage customer reviews.',
        'description' => 'Track review status, update details, and keep testimonials easy to find.',
        'actions' => [
            [
                'label' => 'Add Review',
                'url' => route('admin.reviews.create'),
                'class' => 'primary-btn',
            ],
        ],
    ])

    @if (session('status'))
        <div class="success-box">{{ session('status') }}</div>
    @endif

    @include('admin.partials.overview-grid', [
        'items' => [
            ['label' => 'Total Reviews', 'value' => $stats['total']],
            ['label' => 'Published', 'value' => $stats['published']],
            ['label' => 'Platforms', 'value' => $stats['platforms']],
        ],
    ])

    <section class="admin-content-panel">
        @include('admin.partials.list-tools', [
            'tabs' => [
                [
                    'label' => 'All',
                    'count' => $tabCounts['all'],
                    'url' => route('admin.reviews.index', array_filter([
                        'search' => $searchTerm,
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === null,
                ],
                [
                    'label' => 'Published',
                    'count' => $tabCounts['published'],
                    'url' => route('admin.reviews.index', array_filter([
                        'search' => $searchTerm,
                        'status' => 'published',
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === 'published',
                ],
                [
                    'label' => 'Draft',
                    'count' => $tabCounts['draft'],
                    'url' => route('admin.reviews.index', array_filter([
                        'search' => $searchTerm,
                        'status' => 'draft',
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === 'draft',
                ],
            ],
            'searchAction' => route('admin.reviews.index'),
            'searchValue' => $searchTerm,
            'searchAriaLabel' => 'Search reviews',
            'searchPlaceholder' => 'Search testimonials',
            'hiddenFields' => ['status' => $activeStatus],
        ])

        @include('admin.reviews.partials.table', ['reviews' => $reviews])
        @include('admin.partials.pagination', ['paginator' => $reviews, 'label' => 'Reviews pagination'])
    </section>
@endsection

