@extends('admin.layouts.app')

@section('title', 'Add Portfolio')

@section('content')
    @php
        $permalinkPath = parse_url($permalink, PHP_URL_PATH) ?: $permalink;
    @endphp

    @include('admin.partials.page-hero', [
        'kicker' => 'Portfolio',
        'title' => 'Create a new portfolio project.',
        'description' => 'Add project information, preview links, and publish settings using the same dashboard structure.',
        'actions' => [
            [
                'label' => 'Back to Portfolio',
                'url' => route('admin.portfolios.index'),
                'class' => 'btn',
            ],
        ],
    ])

    @include('admin.partials.overview-grid', [
        'columns' => 4,
        'items' => [
            ['label' => 'Section', 'value' => 'Portfolio'],
            ['label' => 'Initial Status', 'value' => ucfirst($portfolio['status'] ?: 'draft')],
            ['label' => 'Permalink', 'value' => $permalinkPath],
            ['label' => 'Storage', 'value' => 'Database'],
        ],
    ])

    <section class="admin-content-panel admin-form-shell">
        <div class="dashboard-panel-head">
            <div>
                <span class="panel-kicker">Editor</span>
                <h2>Project details and publishing</h2>
            </div>
        </div>

        @include('admin.portfolios.partials.form', [
            'action' => route('admin.portfolios.store'),
            'method' => 'POST',
            'portfolio' => $portfolio,
            'categories' => $categories,
            'permalink' => $permalink,
            'submitLabel' => 'Publish',
        ])
    </section>
@endsection
