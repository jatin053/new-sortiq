@extends('admin.layouts.app')

@section('title', $portfolio['title'] . ' Portfolio')

@section('content')
    @php
        $statusLabel = ucfirst($portfolio['status']);
        $statusClass = $portfolio['status'] === 'published' ? 'status-pill status-pill-success' : 'status-pill status-pill-muted';
        $heroActions = [
            [
                'label' => 'View Website',
                'url' => url('portfolio#' . $portfolio['slug']),
                'class' => 'btn',
                'target' => '_blank',
            ],
            [
                'label' => 'Edit Portfolio',
                'url' => route('admin.portfolios.edit', $portfolio),
                'class' => 'btn',
            ],
        ];

        if ($portfolio->website_href) {
            array_unshift($heroActions, [
                'label' => 'Open Project',
                'url' => $portfolio->website_href,
                'class' => 'btn',
                'target' => '_blank',
            ]);
        }

        $heroActions[] = [
            'type' => 'button',
            'label' => 'Delete Portfolio',
            'class' => 'btn btn-danger',
            'button_type' => 'button',
            'onclick' => "if(confirm('Are you sure you want to delete this portfolio project?')) { document.getElementById('delete-portfolio-details-form').submit(); }",
        ];
    @endphp

    <form id="delete-portfolio-details-form" action="{{ route('admin.portfolios.destroy', $portfolio) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    @include('admin.partials.page-hero', [
        'kicker' => 'Portfolio',
        'title' => $portfolio['title'],
        'description' => $portfolio['summary'] ?: 'Review project content, preview links, and publishing details from one clean layout.',
        'actions' => $heroActions,
    ])

    @include('admin.partials.overview-grid', [
        'columns' => 4,
        'items' => [
            ['label' => 'Category', 'value' => $portfolio['category_name'] ?: 'Portfolio'],
            ['label' => 'Status', 'value' => $statusLabel],
            ['label' => 'Published', 'value' => $portfolio['published_label']],
            ['label' => 'Sort Order', 'value' => $portfolio['sort_order']],
        ],
    ])

    <div class="admin-dashboard-grid admin-detail-layout">
        <section class="admin-content-panel">
            <div class="dashboard-panel-head">
                <div>
                    <span class="panel-kicker">Project</span>
                    <h2>Portfolio overview</h2>
                </div>
            </div>

            <div class="admin-detail-stack">
                @if ($portfolio->image_url)
                    <div class="admin-detail-media">
                        <img src="{{ $portfolio->image_url }}" alt="{{ $portfolio['title'] }}">
                    </div>
                @endif

                <div class="admin-detail-copy">
                    @if ($portfolio['summary'])
                        <p class="admin-detail-lead">{{ $portfolio['summary'] }}</p>
                    @endif

                    <div class="admin-rich-text">
                        {!! nl2br(e($portfolio['content'] ?: 'No project notes added yet.')) !!}
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
                    <dd>{{ $portfolio['slug'] }}</dd>
                </div>
                <div>
                    <dt>Category</dt>
                    <dd>{{ $portfolio['category_name'] ?: 'Not assigned' }}</dd>
                </div>
                <div>
                    <dt>Status</dt>
                    <dd><span class="{{ $statusClass }}">{{ $statusLabel }}</span></dd>
                </div>
                <div>
                    <dt>Published</dt>
                    <dd>{{ $portfolio['published_label'] }}</dd>
                </div>
                <div>
                    <dt>Sort Order</dt>
                    <dd>{{ $portfolio['sort_order'] }}</dd>
                </div>
                <div>
                    <dt>Project URL</dt>
                    <dd>
                        @if ($portfolio['website_url'])
                            <a href="{{ $portfolio->website_href ?: $portfolio['website_url'] }}" target="_blank" rel="noopener">{{ $portfolio['website_url'] }}</a>
                        @else
                            Not added
                        @endif
                    </dd>
                </div>
            </dl>
        </section>
    </div>
@endsection
@extends('admin.layouts.app')

@section('title', $portfolio['title'] . ' Portfolio')

@section('content')
    @php
        $statusLabel = ucfirst($portfolio['status']);
        $statusClass = $portfolio['status'] === 'published' ? 'status-pill status-pill-success' : 'status-pill status-pill-muted';
        $heroActions = [
            [
                'label' => 'View Website',
                'url' => url('portfolio#' . $portfolio['slug']),
                'class' => 'btn',
                'target' => '_blank',
            ],
            [
                'label' => 'Edit Portfolio',
                'url' => route('admin.portfolios.edit', $portfolio),
                'class' => 'btn',
            ],
        ];

        if ($portfolio->website_href) {
            array_unshift($heroActions, [
                'label' => 'Open Project',
                'url' => $portfolio->website_href,
                'class' => 'btn',
                'target' => '_blank',
            ]);
        }

        $heroActions[] = [
            'type' => 'button',
            'label' => 'Delete Portfolio',
            'class' => 'btn btn-danger',
            'button_type' => 'button',
            'onclick' => "if(confirm('Are you sure you want to delete this portfolio project?')) { document.getElementById('delete-portfolio-details-form').submit(); }",
        ];
    @endphp

    <form id="delete-portfolio-details-form" action="{{ route('admin.portfolios.destroy', $portfolio) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    @include('admin.partials.page-hero', [
        'kicker' => 'Portfolio',
        'title' => $portfolio['title'],
        'description' => $portfolio['summary'] ?: 'Review project content, preview links, and publishing details from one clean layout.',
        'actions' => $heroActions,
    ])

    @include('admin.partials.overview-grid', [
        'columns' => 4,
        'items' => [
            ['label' => 'Category', 'value' => $portfolio['category_name'] ?: 'Portfolio'],
            ['label' => 'Status', 'value' => $statusLabel],
            ['label' => 'Published', 'value' => $portfolio['published_label']],
            ['label' => 'Sort Order', 'value' => $portfolio['sort_order']],
        ],
    ])

    <div class="admin-dashboard-grid admin-detail-layout">
        <section class="admin-content-panel">
            <div class="dashboard-panel-head">
                <div>
                    <span class="panel-kicker">Project</span>
                    <h2>Portfolio overview</h2>
                </div>
            </div>

            <div class="admin-detail-stack">
                @if ($portfolio->image_url)
                    <div class="admin-detail-media">
                        <img src="{{ $portfolio->image_url }}" alt="{{ $portfolio['title'] }}">
                    </div>
                @endif

                <div class="admin-detail-copy">
                    @if ($portfolio['summary'])
                        <p class="admin-detail-lead">{{ $portfolio['summary'] }}</p>
                    @endif

                    <div class="admin-rich-text">
                        {!! nl2br(e($portfolio['content'] ?: 'No project notes added yet.')) !!}
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
                    <dd>{{ $portfolio['slug'] }}</dd>
                </div>
                <div>
                    <dt>Category</dt>
                    <dd>{{ $portfolio['category_name'] ?: 'Not assigned' }}</dd>
                </div>
                <div>
                    <dt>Status</dt>
                    <dd><span class="{{ $statusClass }}">{{ $statusLabel }}</span></dd>
                </div>
                <div>
                    <dt>Published</dt>
                    <dd>{{ $portfolio['published_label'] }}</dd>
                </div>
                <div>
                    <dt>Sort Order</dt>
                    <dd>{{ $portfolio['sort_order'] }}</dd>
                </div>
                <div>
                    <dt>Project URL</dt>
                    <dd>
                        @if ($portfolio['website_url'])
                            <a href="{{ $portfolio->website_href ?: $portfolio['website_url'] }}" target="_blank" rel="noopener">{{ $portfolio['website_url'] }}</a>
                        @else
                            Not added
                        @endif
                    </dd>
                </div>
            </dl>
        </section>
    </div>
@endsection
