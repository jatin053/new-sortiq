@extends('admin.layouts.app')

@section('title', 'Edit Client Logo')

@section('content')
    @php
        $heroActions = [
            [
                'label' => 'View Website',
                'url' => $clientLogo['website'] ?: url('clients#' . $clientLogo['slug']),
                'class' => 'btn',
                'target' => '_blank',
            ],
            [
                'label' => 'Back to Client Logos',
                'url' => route('admin.client-logos.index'),
                'class' => 'btn',
            ],
            [
                'type' => 'button',
                'label' => 'Delete Logo',
                'class' => 'btn btn-danger',
                'button_type' => 'button',
                'onclick' => "if(confirm('Are you sure you want to delete this client logo?')) { document.getElementById('delete-client-logo-form').submit(); }",
            ],
        ];
    @endphp

    <form id="delete-client-logo-form" action="{{ route('admin.client-logos.destroy', $clientLogo['slug']) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    @include('admin.partials.page-hero', [
        'kicker' => 'Client Logos',
        'title' => 'Edit client logo entry.',
        'description' => 'Update logo media, website details, and sort order with the same clean admin presentation.',
        'actions' => $heroActions,
    ])

    @include('admin.partials.overview-grid', [
        'columns' => 4,
        'items' => [
            ['label' => 'Status', 'value' => ucfirst($clientLogo['status'] ?: 'draft')],
            ['label' => 'Sort Order', 'value' => $clientLogo['sort_order']],
            ['label' => 'Website', 'value' => $clientLogo['website'] ?: 'Not added'],
            ['label' => 'Logo Source', 'value' => $clientLogo['logo'] ?: 'Upload pending'],
        ],
    ])

    @if (session('status'))
        <div class="success-box">{{ session('status') }}</div>
    @endif

    <section class="admin-content-panel admin-form-shell">
        <div class="dashboard-panel-head">
            <div>
                <span class="panel-kicker">Editor</span>
                <h2>Client logo details and publishing</h2>
            </div>
        </div>

        @include('admin.client-logos.partials.form', [
            'action' => route('admin.client-logos.update', $clientLogo['slug']),
            'method' => 'PUT',
            'clientLogo' => $clientLogo,
            'permalink' => $permalink,
            'submitLabel' => 'Update',
        ])
    </section>
@endsection
