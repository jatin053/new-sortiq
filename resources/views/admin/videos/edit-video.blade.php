@extends('admin.layouts.app')

@section('title', 'Edit Video')

@section('content')
    @include('admin.partials.page-hero', [
        'kicker' => 'Videos',
        'title' => 'Edit video entry.',
        'description' => 'Update YouTube details, thumbnail settings, and publishing options in the same admin pattern.',
        'actions' => [
            [
                'label' => 'View Website',
                'url' => url('videos#' . $video['slug']),
                'class' => 'btn',
                'target' => '_blank',
            ],
            [
                'label' => 'Back to Videos',
                'url' => route('admin.videos.index'),
                'class' => 'btn',
            ],
        ],
    ])

    @include('admin.partials.overview-grid', [
        'items' => [
            ['label' => 'Status', 'value' => ucfirst($video['status'] ?: 'draft')],
            ['label' => 'Published', 'value' => $video['published_label']],
            ['label' => 'Views', 'value' => $video['views']],
        ],
    ])

    @if (session('status'))
        <div class="success-box">{{ session('status') }}</div>
    @endif

    <section class="admin-content-panel admin-form-shell">
        <div class="dashboard-panel-head">
            <div>
                <span class="panel-kicker">Editor</span>
                <h2>Video details and publishing</h2>
            </div>
        </div>

        @include('admin.videos.partials.form', [
            'action' => route('admin.videos.update', $video['slug']),
            'method' => 'PUT',
            'video' => $video,
            'permalink' => $permalink,
            'submitLabel' => 'Update',
        ])

        <div style="margin-top: 24px; padding-top: 18px; border-top: 1px solid var(--border); display: flex; justify-content: flex-end;">
            <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete &quot;{{ addslashes($video['title']) }}&quot;? This cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" style="background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 7px 16px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>
                    Delete Video Permanently
                </button>
            </form>
        </div>
    </section>
@endsection
