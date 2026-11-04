@extends('admin.layouts.app')

@section('title', 'Sitemap Manager')

@section('content')
    @include('admin.partials.page-hero', [
        'kicker' => 'Robots.txt Settings',
        'title' => 'Sitemap Manager.',
        'description' => 'Manage which public URLs are included in your XML sitemap.',
        'actions' => [[
            'type' => 'link',
            'label' => 'Robots.txt Settings',
            'class' => 'secondary-btn',
            'url' => route('admin.robots-settings.edit'),
        ]],
    ])

    @if (session('status'))
        <div class="success-box">{{ session('status') }}</div>
    @endif

    <section class="settings-panel">
        <div class="settings-panel-title">
            <span>XML Sitemap URLs</span>
            <strong>{{ $totalUrls }} public URLs</strong>
        </div>

        <div class="settings-panel-body">
            <div class="reviews-table-wrap">
                <table class="reviews-table">
                    <thead>
                        <tr>
                            <th>URL Path</th>
                            <th>Type / Section</th>
                            <th>Sitemap Status</th>
                            <th style="text-align: right; padding-right: 20px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($xmlUrls as $url)
                            <tr>
                                <td style="padding: 15px 10px;">
                                    <a href="{{ url($url['path']) }}" target="_blank" rel="noopener" class="review-title" style="font-weight: 600; font-size: 15px; color: #3182ce; text-decoration: underline;">
                                        {{ $url['path'] }}
                                    </a>
                                    <div style="font-size: 12px; color: #718096; margin-top: 2px;">{{ $url['label'] }}</div>
                                    <div style="margin-top: 8px; font-size: 12px; color: #4a5568; background: #f7fafc; padding: 8px 12px; border-radius: 4px; border: 1px solid #edf2f7; line-height: 1.4; text-align: left;">
                                        <div><strong>Title:</strong> {{ $url['title'] ?? '(None)' }}</div>
                                        <div><strong>Description:</strong> {{ $url['description'] ?? '(None)' }}</div>
                                        @if (!empty($url['keywords']))<div><strong>Keywords:</strong> {{ $url['keywords'] }}</div>@endif
                                    </div>
                                </td>
                                <td style="padding: 15px 10px;"><span style="font-size: 14px; color: #4a5568; font-weight: 500;">{{ $url['section'] }}</span></td>
                                <td style="padding: 15px 10px;">
                                    @if ($url['exclude_sitemap'])
                                        <span class="status-pill" style="background: #fed7d7; color: #c53030;">Blocked</span>
                                    @else
                                        <span class="status-pill" style="background: #c6f6d5; color: #22543d;">Active (Indexed)</span>
                                    @endif
                                </td>
                                <td style="text-align: right; padding: 15px 20px 15px 10px;">
                                    <div style="display: flex; gap: 8px; justify-content: flex-end; align-items: center;">
                                        <form action="{{ route('admin.pages.toggle-sitemap-url') }}" method="post" style="margin: 0;">
                                            @csrf
                                            <input type="hidden" name="path" value="{{ $url['path'] }}">
                                            <button type="submit" class="btn btn-sm" style="padding: 6px 12px; font-size: 12px; border-radius: 4px; background: {{ $url['exclude_sitemap'] ? '#3182ce' : '#e53e3e' }}; color: white; border: none; cursor: pointer; font-weight: 600;">
                                                {{ $url['exclude_sitemap'] ? 'Include' : 'Block' }}
                                            </button>
                                        </form>
                                        @if ($url['type'] === 'static')
                                            <a href="{{ route('admin.pages.edit', ['page' => $url['route_name']]) }}" style="font-size: 13px; font-weight: 600; color: #3182ce;">Edit Meta</a>
                                        @elseif ($url['type'] === 'blog')
                                            <a href="{{ route('admin.blogs.edit', ['blog' => $url['blog_slug']]) }}" style="font-size: 13px; font-weight: 600; color: #3182ce;">Edit Post</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="empty-state-cell" style="padding: 20px; text-align: center; color: #718096;">No XML sitemap URLs found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($lastPage > 1)
                <nav aria-label="Sitemap pages" style="display: flex; gap: 8px; align-items: center; justify-content: flex-end; margin-top: 22px;">
                    @if ($currentPage > 1)
                        <a class="btn" href="{{ route('admin.robots-settings.sitemap', ['page' => $currentPage - 1]) }}">Previous</a>
                    @endif
                    <span style="font-size: 14px; color: #64748b;">Page {{ $currentPage }} of {{ $lastPage }}</span>
                    @if ($currentPage < $lastPage)
                        <a class="btn" href="{{ route('admin.robots-settings.sitemap', ['page' => $currentPage + 1]) }}">Next</a>
                    @endif
                </nav>
            @endif
        </div>
    </section>
@endsection
