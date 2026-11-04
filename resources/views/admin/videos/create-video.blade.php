@extends('admin.layouts.app')

@section('title', 'Add Video')

@section('content')
    @include('admin.partials.page-hero', [
        'kicker' => 'Videos',
        'title' => 'Create a new video entry.',
        'description' => 'Add YouTube content, thumbnail details, and publishing settings with the same dashboard-style layout.',
        'actions' => [
            [
                'label' => 'Back to Videos',
                'url' => route('admin.videos.index'),
                'class' => 'btn',
            ],
        ],
    ])

    @include('admin.partials.overview-grid', [
        'items' => [
            ['label' => 'Section', 'value' => 'Videos'],
            ['label' => 'Initial Status', 'value' => ucfirst($video['status'] ?: 'draft')],
            ['label' => 'Source', 'value' => 'YouTube'],
        ],
    ])

    <section class="admin-content-panel admin-form-shell">
        <div class="dashboard-panel-head">
            <div>
                <span class="panel-kicker">Editor</span>
                <h2>Video details and publishing</h2>
            </div>
        </div>

        @include('admin.videos.partials.form', [
            'action' => route('admin.videos.store'),
            'method' => 'POST',
            'video' => $video,
            'permalink' => $permalink,
            'submitLabel' => 'Publish',
        ])
    </section>
@endsection
