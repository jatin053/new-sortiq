@extends('admin.layouts.app')

@section('title', $clientLogo['name'] . ' Client Logo')

@section('content')
    @php
        $statusLabel = ucfirst($clientLogo['status']);
        $statusClass = $clientLogo['status'] === 'published' ? 'status-pill status-pill-success' : 'status-pill status-pill-muted';
        $clientWebsite = $clientLogo['website'] ?: url('clients#' . $clientLogo['slug']);
    @endphp

    @include('admin.partials.page-hero', [
        'kicker' => 'Client Logos',
        'title' => $clientLogo['name'],
        'description' => $clientLogo['description'] ?: 'Review the client brand, website link, and publishing details from one consistent layout.',
        'actions' => [
            [
                'label' => 'View Website',
                'url' => $clientWebsite,
                'class' => 'btn',
                'target' => '_blank',
            ],
            [
                'label' => 'Edit Client Logo',
                'url' => route('admin.client-logos.edit', $clientLogo['slug']),
                'class' => 'btn',
            ],
        ],
    ])

    @include('admin.partials.overview-grid', [
        'columns' => 4,
        'items' => [
            ['label' => 'Status', 'value' => $statusLabel],
            ['label' => 'Sort Order', 'value' => $clientLogo['sort_order']],
            ['label' => 'Website', 'value' => parse_url($clientWebsite, PHP_URL_HOST) ?: 'Client link'],
            ['label' => 'Logo Source', 'value' => $clientLogo['logo'] ?: 'Text fallback'],
        ],
    ])

    <div class="admin-dashboard-grid admin-detail-layout">
        <section class="admin-content-panel">
            <div class="dashboard-panel-head">
                <div>
                    <span class="panel-kicker">Brand</span>
                    <h2>Client logo preview</h2>
                </div>
            </div>

            <div class="admin-detail-stack">
                <div class="admin-detail-media admin-detail-media-logo">
                    @if ($clientLogo->logo_url)
                        <img src="{{ $clientLogo->logo_url }}" alt="{{ $clientLogo['name'] }}">
                    @else
                        <span class="admin-detail-placeholder">{{ $clientLogo['name'] }}</span>
                    @endif
                </div>

                <div class="admin-detail-copy">
                    <p class="admin-detail-lead">{{ $clientLogo['description'] ?: 'No description added yet.' }}</p>
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
                    <dd>{{ $clientLogo['slug'] }}</dd>
                </div>
                <div>
                    <dt>Status</dt>
                    <dd><span class="{{ $statusClass }}">{{ $statusLabel }}</span></dd>
                </div>
                <div>
                    <dt>Sort Order</dt>
                    <dd>{{ $clientLogo['sort_order'] }}</dd>
                </div>
                <div>
                    <dt>Website</dt>
                    <dd><a href="{{ $clientWebsite }}" target="_blank" rel="noopener">{{ $clientWebsite }}</a></dd>
                </div>
                <div>
                    <dt>Logo Source</dt>
                    <dd>{{ $clientLogo['logo'] ?: 'Text fallback' }}</dd>
                </div>
            </dl>
        </section>
    </div>
@endsection
