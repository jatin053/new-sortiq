@extends('admin.layouts.app')

@section('title', 'Edit Review')

@section('content')
    @php
        $heroActions = [
            [
                'label' => 'View Website',
                'url' => route('frontend.reviews.show', $review),
                'class' => 'btn',
                'target' => '_blank',
            ],
            [
                'label' => 'Back to Reviews',
                'url' => route('admin.reviews.index'),
                'class' => 'btn',
            ],
            [
                'type' => 'button',
                'label' => 'Delete Review',
                'class' => 'btn btn-danger',
                'button_type' => 'button',
                'onclick' => "if(confirm('Are you sure you want to delete this review?')) { document.getElementById('delete-review-form').submit(); }",
            ],
        ];
    @endphp

    <form id="delete-review-form" action="{{ route('admin.reviews.destroy', $review) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    @include('admin.partials.page-hero', [
        'kicker' => 'Reviews',
        'title' => 'Edit customer review.',
        'description' => 'Update testimonial text, platform details, and visibility with the same consistent admin layout.',
        'actions' => $heroActions,
    ])

    @include('admin.partials.overview-grid', [
        'columns' => 4,
        'items' => [
            ['label' => 'Status', 'value' => ucfirst($review['status'] ?: 'draft')],
            ['label' => 'Platform', 'value' => $review['platform'] ?: 'Not selected'],
            ['label' => 'Published', 'value' => $review['published_label']],
            ['label' => 'Views', 'value' => $review['views']],
        ],
    ])

    @if (session('status'))
        <div class="success-box">{{ session('status') }}</div>
    @endif

    <section class="admin-content-panel admin-form-shell">
        <div class="dashboard-panel-head">
            <div>
                <span class="panel-kicker">Editor</span>
                <h2>Review content and publishing</h2>
            </div>
        </div>

        @include('admin.reviews.partials.form', [
            'action' => route('admin.reviews.update', $review),
            'method' => 'PUT',
            'review' => $review,
            'permalink' => $permalink,
            'submitLabel' => 'Update',
        ])
    </section>
@endsection

