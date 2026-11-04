@extends('admin.layouts.app')

@section('title', 'Add Review')

@section('content')
    @php
        $permalinkPath = parse_url($permalink, PHP_URL_PATH) ?: $permalink;
    @endphp

    @include('admin.partials.page-hero', [
        'kicker' => 'Reviews',
        'title' => 'Create a new customer review.',
        'description' => 'Add testimonial content, platform details, and publish settings in the same dashboard style.',
        'actions' => [
            [
                'label' => 'Back to Reviews',
                'url' => route('admin.reviews.index'),
                'class' => 'btn',
            ],
        ],
    ])

    @include('admin.partials.overview-grid', [
        'columns' => 4,
        'items' => [
            ['label' => 'Section', 'value' => 'Reviews'],
            ['label' => 'Initial Status', 'value' => ucfirst($review['status'] ?: 'draft')],
            ['label' => 'Permalink', 'value' => $permalinkPath],
            ['label' => 'Default Rating', 'value' => (int) ($review['rating'] ?: 5)],
        ],
    ])

    <section class="admin-content-panel admin-form-shell">
        <div class="dashboard-panel-head">
            <div>
                <span class="panel-kicker">Editor</span>
                <h2>Review content and publishing</h2>
            </div>
        </div>

        @include('admin.reviews.partials.form', [
            'action' => route('admin.reviews.store'),
            'method' => 'POST',
            'review' => $review,
            'permalink' => $permalink,
            'submitLabel' => 'Publish',
        ])
    </section>
@endsection

