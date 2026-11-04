@extends('admin.layouts.app')

@section('title', $review->name . ' Review')

@section('content')
    @php
        $statusLabel = ucfirst($review->status);
        $statusClass = $review->status === 'published' ? 'status-pill status-pill-success' : 'status-pill status-pill-muted';
        $reviewUrl = route('frontend.reviews.show', $review);
    @endphp

    @include('admin.partials.page-hero', [
        'kicker' => 'Reviews',
        'title' => $review->name,
        'description' => $review->summary ?: 'Review customer feedback, platform details, and publishing information from one clean screen.',
        'actions' => [
            [
                'label' => 'View Website',
                'url' => $reviewUrl,
                'class' => 'btn',
                'target' => '_blank',
            ],
            [
                'label' => 'Edit Review',
                'url' => route('admin.reviews.edit', $review),
                'class' => 'btn',
            ],
        ],
    ])

    @include('admin.partials.overview-grid', [
        'columns' => 4,
        'items' => [
            ['label' => 'Platform', 'value' => $review->platform ?: 'Not selected'],
            ['label' => 'Rating', 'value' => $review->rating . '/5'],
            ['label' => 'Status', 'value' => $statusLabel],
            ['label' => 'Views', 'value' => $review->views],
        ],
    ])

    <div class="admin-dashboard-grid admin-detail-layout">
        <section class="admin-content-panel">
            <div class="dashboard-panel-head">
                <div>
                    <span class="panel-kicker">Testimonial</span>
                    <h2>Customer review content</h2>
                </div>
            </div>

            <div class="admin-detail-stack">
                <div class="admin-detail-callout">
                    <span class="eyebrow">{{ $review->platform ?: 'Client Review' }}</span>
                    <h3>{{ $review->name }}</h3>
                    @if ($review->position)
                        <p>{{ $review->position }}</p>
                    @endif
                </div>

                <div class="admin-detail-copy">
                    <div class="stars large" aria-label="{{ $review->rating }} star rating">
                        @for ($star = 0; $star < $review->rating; $star++)
                            &#9733;
                        @endfor
                    </div>

                    @if ($review->summary)
                        <p class="admin-detail-lead">{{ $review->summary }}</p>
                    @endif

                    <div class="admin-rich-text">
                        {!! nl2br(e($review->content ?: 'No review content added yet.')) !!}
                    </div>
                </div>
            </div>
        </section>

        <section class="admin-content-panel admin-detail-side">
            <div class="dashboard-panel-head">
                <div>
                    <span class="panel-kicker">Details</span>
                    <h2>Publishing information</h2>
                </div>
            </div>

            <dl class="admin-detail-meta">
                <div>
                    <dt>Slug</dt>
                    <dd>{{ $review->slug }}</dd>
                </div>
                <div>
                    <dt>Platform</dt>
                    <dd>{{ $review->platform ?: 'Not assigned' }}</dd>
                </div>
                <div>
                    <dt>Status</dt>
                    <dd><span class="{{ $statusClass }}">{{ $statusLabel }}</span></dd>
                </div>
                <div>
                    <dt>Published</dt>
                    <dd>{{ $review->published_label }}</dd>
                </div>
                <div>
                    <dt>Views</dt>
                    <dd>{{ $review->views }}</dd>
                </div>
                <div>
                    <dt>Permalink</dt>
                    <dd><a href="{{ $reviewUrl }}" target="_blank" rel="noopener">{{ $reviewUrl }}</a></dd>
                </div>
            </dl>
        </section>
    </div>
@endsection

