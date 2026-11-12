@extends('admin.layouts.app')

@section('title', $blog['title'] . ' Blog')

@section('content')
    @php
        $statusLabel = ucfirst($blog['status']);
        $statusClass = $blog['status'] === 'published' ? 'status-pill status-pill-success' : 'status-pill status-pill-muted';
        $blogUrl = route('frontend.blog.show', $blog['slug']);
    @endphp

    @include('admin.partials.page-hero', [
        'kicker' => 'Blogs',
        'title' => $blog['title'],
        'description' => $blog['excerpt'] ?: 'Review the full blog content, publishing details, and website link from one place.',
        'actions' => [
            [
                'label' => 'View Website',
                'url' => $blogUrl,
                'class' => 'btn',
                'target' => '_blank',
            ],
            [
                'label' => 'Edit Blog',
                'url' => route('admin.blogs.edit', $blog['slug']),
                'class' => 'btn',
            ],
        ],
    ])

    @include('admin.partials.overview-grid', [
        'items' => [
            ['label' => 'Category', 'value' => $blog['category'] ?: 'Blog Post'],
            ['label' => 'Status', 'value' => $statusLabel],
            ['label' => 'Views', 'value' => $blog['views']],
        ],
    ])

    <section class="admin-content-panel">
        <div class="dashboard-panel-head">
            <div>
                <span class="panel-kicker">Content</span>
                <h2>Blog article</h2>
            </div>
        </div>

        <div class="admin-record-layout">
            <div class="admin-entry-stack">
                @if ($blog->image_url)
                    <div class="admin-detail-media">
                        <img src="{{ $blog->image_url }}" alt="{{ $blog['title'] }}">
                    </div>
                @endif

                @if ($blog['excerpt'])
                    <p class="admin-detail-lead">{{ $blog['excerpt'] }}</p>
                @endif

                <div class="admin-rich-text">
                    {!! $blog['content'] ?: 'No blog content added yet.' !!}
                </div>

                @if ($blog->hasFaqs())
                    <div style="margin-top: 30px; padding: 20px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px;">
                        <h3 style="margin: 0 0 16px 0; font-size: 16px; font-weight: 800; color: #00173e; display: flex; align-items: center; gap: 8px;">
                            <span>❓</span> Frequently Asked Questions ({{ count($blog->faqs_list) }})
                        </h3>
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            @foreach ($blog->faqs_list as $faq)
                                <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 8px; padding: 14px 16px;">
                                    <div style="font-weight: 700; color: #00173e; font-size: 14px; margin-bottom: 6px;">
                                        #{{ $loop->iteration }}. {{ $faq['question'] ?? '' }}
                                    </div>
                                    <div style="color: #475569; font-size: 13px; line-height: 1.5; white-space: pre-line;">
                                        {{ $faq['answer'] ?? '' }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="admin-entry-stack">
                <dl class="admin-detail-meta">
                    <div>
                        <dt>Slug</dt>
                        <dd>{{ $blog['slug'] }}</dd>
                    </div>
                    <div>
                        <dt>Category</dt>
                        <dd>{{ $blog['category'] ?: 'Not assigned' }}</dd>
                    </div>
                    <div>
                        <dt>Status</dt>
                        <dd><span class="{{ $statusClass }}">{{ $statusLabel }}</span></dd>
                    </div>
                    <div>
                        <dt>Published</dt>
                        <dd>{{ $blog['published_label'] }}</dd>
                    </div>
                    <div>
                        <dt>Views</dt>
                        <dd>{{ $blog['views'] }}</dd>
                    </div>
                    <div>
                        <dt>Permalink</dt>
                        <dd><a href="{{ $blogUrl }}" target="_blank" rel="noopener">{{ $blogUrl }}</a></dd>
                    </div>
                </dl>
            </div>
        </div>
    </section>
@endsection

