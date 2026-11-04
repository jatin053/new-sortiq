@extends('admin.layouts.app')

@section('title', 'Edit Blog')

@section('content')
    @php
        $heroActions = [
            [
                'label' => 'View Website',
                'url' => route('frontend.blog.show', $blog['slug']),
                'class' => 'btn',
                'target' => '_blank',
            ],
            [
                'label' => 'Back to Blogs',
                'url' => route('admin.blogs.index'),
                'class' => 'btn',
            ],
            [
                'type' => 'button',
                'label' => 'Delete Post',
                'class' => 'btn btn-danger',
                'button_type' => 'button',
                'onclick' => "if(confirm('Are you sure you want to delete this blog post?')) { document.getElementById('delete-blog-form').submit(); }",
            ],
        ];
    @endphp

    <form id="delete-blog-form" action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    @include('admin.partials.page-hero', [
        'kicker' => 'Blogs',
        'title' => 'Edit blog post.',
        'description' => 'Update copy, category, image, and publishing details without leaving the dashboard flow.',
        'actions' => $heroActions,
    ])

    @include('admin.partials.overview-grid', [
        'columns' => 4,
        'items' => [
            ['label' => 'Status', 'value' => ucfirst($blog['status'] ?: 'draft')],
            ['label' => 'Category', 'value' => $blog['category'] ?: 'Not selected'],
            ['label' => 'Published', 'value' => $blog['published_label']],
            ['label' => 'Views', 'value' => $blog['views']],
        ],
    ])

    @if (session('status'))
        <div class="success-box">{{ session('status') }}</div>
    @endif

    <section class="admin-content-panel admin-form-shell">
        <div class="dashboard-panel-head">
            <div>
                <span class="panel-kicker">Editor</span>
                <h2>Blog content and publishing</h2>
            </div>
        </div>

        @include('admin.blogs.partials.form', [
            'action' => route('admin.blogs.update', $blog['slug']),
            'method' => 'PUT',
            'blog' => $blog,
            'permalink' => $permalink,
            'submitLabel' => 'Update',
        ])
    </section>
@endsection

