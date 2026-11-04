@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    @include('admin.partials.page-hero', [
        'kicker' => 'Overview',
        'title' => 'Welcome to the admin dashboard.',
        'description' => 'Use this panel to manage blogs, portfolio projects, reviews, client logos, and website settings from one place.',
        'actions' => [
            [
                'label' => 'Add Portfolio',
                'url' => route('admin.portfolios.create'),
                'class' => 'primary-btn',
            ],
            [
                'label' => 'New Blog',
                'url' => route('admin.blogs.create'),
                'class' => 'btn',
            ],
            [
                'label' => 'Site Settings',
                'url' => route('admin.site-layout.edit'),
                'class' => 'btn',
            ],
        ],
    ])

    @include('admin.partials.overview-grid', [
        'columns' => 4,
        'items' => [
            ['label' => 'Blogs', 'value' => $stats['blogs']],
            ['label' => 'Portfolio Projects', 'value' => $stats['portfolios']],
            ['label' => 'Reviews', 'value' => $stats['reviews']],
            ['label' => 'Client Logos', 'value' => $stats['clientLogos']],
        ],
    ])

    <div class="admin-dashboard-grid">
        <section class="admin-content-panel">
            <div class="dashboard-panel-head">
                <div>
                    <span class="panel-kicker">Quick Actions</span>
                    <h2>Go to the most common tasks.</h2>
                </div>
            </div>

            <div class="quick-links-grid">
                <a href="{{ route('admin.blogs.create') }}" class="quick-link-card">
                    <strong>Add blog</strong>
                    <span>Create a new blog post.</span>
                </a>

                <a href="{{ route('admin.portfolios.create') }}" class="quick-link-card">
                    <strong>Add portfolio</strong>
                    <span>Create a new portfolio project.</span>
                </a>

                <a href="{{ route('admin.reviews.create') }}" class="quick-link-card">
                    <strong>Add review</strong>
                    <span>Create a new customer review.</span>
                </a>

                <a href="{{ route('admin.client-logos.create') }}" class="quick-link-card">
                    <strong>Add client logo</strong>
                    <span>Upload or update a logo entry.</span>
                </a>

                <a href="{{ route('admin.videos.create') }}" class="quick-link-card">
                    <strong>Add video</strong>
                    <span>Publish a new video entry.</span>
                </a>

                <a href="{{ route('admin.site-layout.edit') }}" class="quick-link-card">
                    <strong>Edit settings</strong>
                    <span>Change header, footer, and website details.</span>
                </a>
            </div>
        </section>

        <section class="admin-content-panel">
            <div class="dashboard-panel-head">
                <div>
                    <span class="panel-kicker">Admin Notes</span>
                    <h2>How this panel is organized</h2>
                </div>
            </div>

            <div class="dashboard-note-card">
                <p>
                    The admin is grouped into simple sections so your team can find things quickly without extra clutter.
                </p>

                <div class="mini-status-list">
                    <span>Dashboard for overview</span>
                    <span>Portfolio for project work</span>
                    <span>Blogs for content</span>
                    <span>Reviews and logos for trust</span>
                    <span>Settings for website updates</span>
                </div>
            </div>
        </section>
    </div>
@endsection
