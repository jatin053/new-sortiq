@extends('admin.layouts.app')

@section('title', $video['title'] . ' Video')

@section('content')
    @php
        $statusLabel = ucfirst($video['status']);
        $statusClass = $video['status'] === 'published' ? 'status-pill status-pill-success' : 'status-pill status-pill-muted';
        $videoUrl = url('videos#' . $video['slug']);
        $sourceLabel = match ($video->playback_type) {
            'file' => 'Local upload',
            'youtube' => 'Legacy YouTube',
            default => 'No source',
        };
    @endphp

    @include('admin.partials.page-hero', [
        'kicker' => 'Videos',
        'title' => $video['title'],
        'description' => $video['summary'] ?: 'Review video details, thumbnail media, and publishing information from one place.',
        'actions' => [
            [
                'label' => 'View Website',
                'url' => $videoUrl,
                'class' => 'btn',
                'target' => '_blank',
            ],
            [
                'label' => 'Edit Video',
                'url' => route('admin.videos.edit', $video['slug']),
                'class' => 'btn',
            ],
        ],
    ])

    @include('admin.partials.overview-grid', [
        'items' => [
            ['label' => 'Status', 'value' => $statusLabel],
            ['label' => 'Source', 'value' => $sourceLabel],
            ['label' => 'Published', 'value' => $video['published_label']],
            ['label' => 'Views', 'value' => $video['views']],
        ],
    ])

    <section class="admin-content-panel">
        <div class="dashboard-panel-head">
            <div>
                <span class="panel-kicker">Video Details</span>
                <h2>Video overview</h2>
            </div>
        </div>

        <div class="admin-record-layout">
            <div class="admin-entry-stack">
                <div class="admin-detail-media">
                    @if ($video->thumbnail_url)
                        <img src="{{ $video->thumbnail_url }}" alt="{{ $video['title'] }}">
                    @else
                        <span class="admin-detail-placeholder">No thumbnail available</span>
                    @endif
                </div>

                @if ($video['summary'])
                    <p class="admin-detail-lead">{{ $video['summary'] }}</p>
                @endif

                <div class="admin-link-strip">
                    <span>Video Source</span>
                    @if ($video['video_file'])
                        <strong>{{ $video['video_file'] }}</strong>
                    @elseif ($video['youtube_url'])
                        <strong>{{ $video['youtube_url'] }}</strong>
                    @else
                        <strong>No video source saved yet.</strong>
                    @endif
                </div>

                @if ($video->video_file_url)
                    <div class="admin-detail-media">
                        <video src="{{ $video->video_file_url }}" controls preload="metadata" class="w-full rounded-xl"></video>
                    </div>
                @elseif ($video->youtube_embed_url)
                    <div class="admin-detail-media">
                        <iframe
                            src="{{ $video->youtube_embed_url }}"
                            title="{{ $video['title'] }}"
                            class="w-full rounded-xl aspect-video"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                        ></iframe>
                    </div>
                @endif

                <div class="admin-link-strip">
                    <span>Thumbnail File</span>
                    @if ($video['thumbnail'])
                        <strong>{{ $video['thumbnail'] }}</strong>
                    @else
                        <strong>Using the local placeholder.</strong>
                    @endif
                </div>
            </div>

            <div class="admin-entry-stack">
                <dl class="admin-detail-meta">
                    <div>
                        <dt>Slug</dt>
                        <dd>{{ $video['slug'] }}</dd>
                    </div>
                    <div>
                        <dt>Status</dt>
                        <dd><span class="{{ $statusClass }}">{{ $statusLabel }}</span></dd>
                    </div>
                    <div>
                        <dt>Published</dt>
                        <dd>{{ $video['published_label'] }}</dd>
                    </div>
                    <div>
                        <dt>Sort Order</dt>
                        <dd>{{ $video['sort_order'] }}</dd>
                    </div>
                    <div>
                        <dt>Views</dt>
                        <dd>{{ $video['views'] }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </section>
@endsection
