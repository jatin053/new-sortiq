@extends('admin.layouts.app')

@section('title', 'Add Client Logo')

@section('content')
    @php
        $permalinkPath = parse_url($permalink, PHP_URL_PATH) ?: $permalink;
    @endphp

    @include('admin.partials.page-hero', [
        'kicker' => 'Client Logos',
        'title' => 'Create a new client logo entry.',
        'description' => 'Add a client brand, upload its logo, and control how it appears inside the same dashboard-style layout.',
        'actions' => [
            [
                'label' => 'Back to Client Logos',
                'url' => route('admin.client-logos.index'),
                'class' => 'btn',
            ],
        ],
    ])

    @include('admin.partials.overview-grid', [
        'columns' => 4,
        'items' => [
            ['label' => 'Section', 'value' => 'Client Logos'],
            ['label' => 'Initial Status', 'value' => ucfirst($clientLogo['status'] ?: 'draft')],
            ['label' => 'Permalink', 'value' => $permalinkPath],
            ['label' => 'Storage', 'value' => 'Database'],
        ],
    ])

    <section class="admin-content-panel admin-form-shell">
        <div class="dashboard-panel-head">
            <div>
                <span class="panel-kicker">Editor</span>
                <h2>Client logo details and publishing</h2>
            </div>
        </div>

        @include('admin.client-logos.partials.form', [
            'action' => route('admin.client-logos.store'),
            'method' => 'POST',
            'clientLogo' => $clientLogo,
            'permalink' => $permalink,
            'submitLabel' => 'Publish',
        ])
    </section>
@endsection
