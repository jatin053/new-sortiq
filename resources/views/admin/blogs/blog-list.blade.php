@extends('admin.layouts.app')

@section('title', 'Blogs')

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
        'kicker' => 'Blogs',
        'title' => $activeTag ? '#' . $activeTag . ' blog posts.' : ($activeCategory ? $activeCategory . ' blog posts.' : 'Manage blog posts.'),
        'description' => ($activeCategory || $activeTag) ? 'Showing only posts related to the selected filter.' : 'View all posts, check status, and create or update content from one place.',
        'actions' => [
            [
                'label' => 'Add Blog',
                'url' => route('admin.blogs.create'),
                'class' => 'primary-btn',
            ],
        ],
    ])

    @if (session('status'))
        <div class="success-box">{{ session('status') }}</div>
    @endif

    @include('admin.partials.overview-grid', [
        'items' => [
            ['label' => 'Total Posts', 'value' => $stats['total']],
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
                    'url' => route('admin.blogs.index', array_filter([
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
                    'url' => route('admin.blogs.index', array_filter([
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
                    'url' => route('admin.blogs.index', array_filter([
                        'search' => $searchTerm,
                        'category' => $activeCategory,
                        'tag' => $activeTag,
                        'date' => $activeDate,
                        'status' => 'draft',
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === 'draft',
                ],
            ],
            'searchAction' => route('admin.blogs.index'),
            'searchValue' => $searchTerm,
            'searchAriaLabel' => 'Search blogs',
            'searchPlaceholder' => 'Search blog posts',
            'hiddenFields' => ['status' => $activeStatus, 'category' => $activeCategory, 'tag' => $activeTag, 'date' => $activeDate],
            'categories' => $categories,
            'tagsList' => $tagsList ?? [],
            'dateOptions' => $dateOptions,
            'activeCategory' => $activeCategory,
            'activeTag' => $activeTag,
            'activeDate' => $activeDate,
            'bulkActionUrl' => route('admin.blogs.bulk-action'),
            'totalItems' => $blogs->total(),
        ])

        @include('admin.blogs.partials.table', ['blogs' => $blogs])
        @include('admin.partials.pagination', ['paginator' => $blogs, 'label' => 'Blogs pagination'])
    </section>
@endsection
