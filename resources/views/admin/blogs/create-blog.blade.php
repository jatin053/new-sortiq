@extends('admin.layouts.app')

@section('title', 'Add Blog')

@section('content')
    @php
        $permalinkPath = parse_url($permalink, PHP_URL_PATH) ?: $permalink;
    @endphp

    @include('admin.partials.page-hero', [
        'kicker' => 'Blogs',
        'title' => 'Create a new blog post.',
        'description' => 'Write, organize, and publish website content using the same clean dashboard layout.',
        'actions' => [
            [
                'label' => 'Back to Blogs',
                'url' => route('admin.blogs.index'),
                'class' => 'btn',
            ],
        ],
    ])

    @include('admin.partials.overview-grid', [
        'columns' => 4,
        'items' => [
            ['label' => 'Section', 'value' => 'Blogs'],
            ['label' => 'Initial Status', 'value' => ucfirst($blog['status'] ?: 'draft')],
            ['label' => 'Permalink', 'value' => $permalinkPath],
            ['label' => 'Storage', 'value' => 'Database'],
        ],
    ])

    <section class="admin-content-panel admin-form-shell">
        <div class="dashboard-panel-head">
            <div>
                <span class="panel-kicker">Editor</span>
                <h2>Blog content and publishing</h2>
            </div>
        </div>

        @include('admin.blogs.partials.form', [
            'action' => route('admin.blogs.store'),
            'method' => 'POST',
            'blog' => $blog,
            'permalink' => $permalink,
            'submitLabel' => 'Publish',
        ])
    </section>
@endsection

