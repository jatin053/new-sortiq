@extends('admin.layouts.app')

@section('title', 'Edit Portfolio')

@section('content')
    @php
        $heroActions = [
            [
                'label' => 'View Website',
                'url' => url('portfolio#' . $portfolio['slug']),
                'class' => 'btn',
                'target' => '_blank',
            ],
            [
                'label' => 'Back to Portfolio',
                'url' => route('admin.portfolios.index'),
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
            'label' => 'Delete Project',
            'class' => 'btn btn-danger',
            'button_type' => 'button',
            'onclick' => "if(confirm('Are you sure you want to delete this portfolio project?')) { document.getElementById('delete-portfolio-form').submit(); }",
        ];
    @endphp

    <form id="delete-portfolio-form" action="{{ route('admin.portfolios.destroy', $portfolio) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    @include('admin.partials.page-hero', [
        'kicker' => 'Portfolio',
        'title' => 'Edit portfolio project.',
        'description' => 'Update project copy, category, preview URL, and publishing settings from one consistent screen.',
        'actions' => $heroActions,
    ])

    @include('admin.partials.overview-grid', [
        'columns' => 4,
        'items' => [
            ['label' => 'Status', 'value' => ucfirst($portfolio['status'] ?: 'draft')],
            ['label' => 'Category', 'value' => $portfolio['category_name'] ?: 'Not selected'],
            ['label' => 'Published', 'value' => $portfolio['published_label']],
            ['label' => 'Sort Order', 'value' => $portfolio['sort_order']],
        ],
    ])

    @if (session('status'))
        <div class="success-box">{{ session('status') }}</div>
    @endif

    <section class="admin-content-panel admin-form-shell">
        <div class="dashboard-panel-head">
            <div>
                <span class="panel-kicker">Editor</span>
                <h2>Project details and publishing</h2>
            </div>
        </div>

        @include('admin.portfolios.partials.form', [
            'action' => route('admin.portfolios.update', $portfolio),
            'method' => 'PUT',
            'portfolio' => $portfolio,
            'categories' => $categories,
            'permalink' => $permalink,
            'submitLabel' => 'Update',
        ])
    </section>
@endsection
