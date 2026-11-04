@extends('admin.layouts.app')

@section('title', 'Pages')

@section('content')
    <div style="padding: 10px 0;">
        <div class="wp-pages-header">
            <h1 class="wp-heading-inline">Pages</h1>
            <a href="{{ route('admin.site-pages.create') }}" class="page-title-action">Add New Page</a>
        </div>

        @if (session('status'))
            <div style="padding: 10px 14px; background: #f0fdf4; border-left: 4px solid #16a34a; border: 1px solid #bbf7d0; font-size: 13px; color: #15803d; margin-bottom: 16px; font-weight: 600;">
                {{ session('status') }}
            </div>
        @endif

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; flex-wrap: wrap; gap: 12px;">
            <ul class="wp-subsubsub" style="margin: 0;">
                <li>
                    <a href="{{ route('admin.site-pages.index') }}" class="{{ ($currentStatus ?? 'all') === 'all' ? 'current' : '' }}">
                        All <span class="count">({{ $totalCount ?? count($allPages) }})</span>
                    </a> |
                </li>
                <li>
                    <a href="{{ route('admin.site-pages.index', ['status' => 'published']) }}" class="{{ ($currentStatus ?? 'all') === 'published' ? 'current' : '' }}">
                        Published <span class="count">({{ $publishedCount ?? 0 }})</span>
                    </a> |
                </li>
                <li>
                    <a href="{{ route('admin.site-pages.index', ['status' => 'draft']) }}" class="{{ ($currentStatus ?? 'all') === 'draft' ? 'current' : '' }}">
                        Drafts <span class="count">({{ $draftCount ?? 0 }})</span>
                    </a>
                </li>
            </ul>

            <!-- WordPress Search Box -->
            <form action="{{ route('admin.site-pages.index') }}" method="get" style="display: flex; gap: 6px; align-items: center;">
                @if (($currentStatus ?? 'all') !== 'all')
                    <input type="hidden" name="status" value="{{ $currentStatus ?? 'all' }}">
                @endif
                <input type="search" name="s" value="{{ $searchQuery ?? '' }}" placeholder="Search pages..." style="padding: 4px 8px; font-size: 13px; border: 1px solid #8c8f94; border-radius: 3px; width: 200px;">
                <button type="submit" style="padding: 4px 10px; font-size: 13px; background: #f6f7f7; border: 1px solid #2271b1; color: #2271b1; border-radius: 3px; cursor: pointer; font-weight: 600;">
                    Search Pages
                </button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="wp-list-table">
                <thead>
                    <tr>
                        <th style="width: 28%;">Title</th>
                        <th style="width: 14%;">Section</th>
                        <th style="width: 18%;">Slug / Path</th>
                        <th style="width: 12%;">Publish Status</th>
                        <th style="width: 14%;">SEO & Social Image</th>
                        <th style="width: 14%; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allPages as $page)
                        @php
                            $pageStatus = $page['status'] ?? 'published';
                            $isDraft = $pageStatus === 'draft';
                            $hasCustomTitle = !empty($page['current_meta']['title']);
                            $hasCustomDesc = !empty($page['current_meta']['description']);
                            $hasCustomImage = !empty($page['current_meta']['image']);
                            $isCustomPage = str_starts_with($page['route_name'], 'frontend.custom-') || !in_array($page['route_name'], [
                                'frontend.home', 'frontend.about', 'frontend.why-us', 'frontend.expertise', 'frontend.cases',
                                'frontend.careers', 'frontend.internship', 'frontend.faq', 'frontend.support', 'frontend.terms',
                                'frontend.contact', 'frontend.blog.index', 'frontend.portfolio', 'frontend.reviews', 'frontend.clients',
                                'frontend.videos', 'frontend.services.web', 'frontend.services.design',
                                'frontend.services.laravel', 'frontend.services.wordpress', 'frontend.services.ecommerce',
                                'frontend.services.marketing', 'frontend.services.seo', 'frontend.services.react',
                                'frontend.services.node', 'frontend.services.vue'
                            ]);
                        @endphp
                        <tr>
                            <td>
                                <div>
                                    <a href="{{ route('admin.pages.edit', ['page' => $page['route_name']]) }}" class="row-title">
                                        {{ $page['label'] }}
                                    </a>
                                    @if ($isDraft)
                                        <span style="font-size: 11px; background: #fef3c7; color: #b45309; padding: 1px 6px; border-radius: 3px; font-weight: 600; margin-left: 4px;">— Draft</span>
                                    @endif
                                    @if ($isCustomPage)
                                        <span style="font-size: 11px; background: #e0f2fe; color: #0369a1; padding: 1px 6px; border-radius: 3px; font-weight: 600; margin-left: 4px;">Custom</span>
                                    @endif

                                    <div class="row-actions">
                                        <a href="{{ route('admin.pages.edit', ['page' => $page['route_name']]) }}">Edit SEO</a>
                                        <span>|</span>

                                        <form action="{{ route('admin.site-pages.toggle-status') }}" method="post" style="display: inline;">
                                            @csrf
                                            <input type="hidden" name="route_name" value="{{ $page['route_name'] }}">
                                            <input type="hidden" name="target_status" value="{{ $isDraft ? 'published' : 'draft' }}">
                                            <button type="submit" style="background: none; border: none; padding: 0; color: #2271b1; font-size: 12px; cursor: pointer; font-family: inherit;">
                                                {{ $isDraft ? 'Publish' : 'Make Draft' }}
                                            </button>
                                        </form>

                                        <span>|</span>

                                        <form action="{{ route('admin.site-pages.delete') }}" method="post" onsubmit="return confirm('Move page to Trash / Draft?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="route_name" value="{{ $page['route_name'] }}">
                                            <button type="submit" style="background: none; border: none; padding: 0; color: #b32d2e; font-size: 12px; cursor: pointer; font-family: inherit;">Trash</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span style="font-size: 12px; color: #50575e; background: #f0f0f1; padding: 2px 8px; border-radius: 3px; border: 1px solid #dcdcde;">
                                    {{ $page['section'] }}
                                </span>
                            </td>
                            <td>
                                <code style="font-size: 12px; color: #2271b1; background: #f6f7f7; padding: 2px 6px; border-radius: 3px; border: 1px solid #dcdcde;">
                                    {{ $page['path'] }}
                                </code>
                            </td>
                            <td>
                                @if ($isDraft)
                                    <span style="font-size: 11px; background: #fef3c7; color: #b45309; padding: 2px 6px; border-radius: 3px; font-weight: 600;">Draft</span>
                                @else
                                    <span style="font-size: 11px; background: #dcfce7; color: #15803d; padding: 2px 6px; border-radius: 3px; font-weight: 600;">Published</span>
                                @endif
                            </td>
                            <td>
                                @if ($hasCustomImage)
                                    <img src="{{ $page['current_meta']['image'] }}" alt="OG Image" style="width: 36px; height: 24px; object-fit: cover; border-radius: 2px; border: 1px solid #c3c4c7;">
                                @else
                                    <span style="font-size: 11px; color: #a7aaad;">Default Image</span>
                                @endif
                            </td>
                            <td style="text-align: right;">
                                <form action="{{ route('admin.site-pages.toggle-status') }}" method="post" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="route_name" value="{{ $page['route_name'] }}">
                                    <input type="hidden" name="target_status" value="{{ $isDraft ? 'published' : 'draft' }}">
                                    <button type="submit" style="background: {{ $isDraft ? '#dcfce7' : '#fef3c7' }}; color: {{ $isDraft ? '#15803d' : '#b45309' }}; border: 1px solid {{ $isDraft ? '#86efac' : '#fde68a' }}; font-size: 11.5px; padding: 3px 8px; border-radius: 3px; cursor: pointer; font-weight: 600;">
                                        {{ $isDraft ? '✓ Publish' : '⏸ Make Draft' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 20px; color: #646970;">No pages found matching your search.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- WordPress Pagination Bar (10 per page) -->
        @php
            $_totalItems = $totalItems ?? count($allPages);
            $_currentPage = $currentPage ?? 1;
            $_lastPage = $lastPage ?? 1;
            $_perPage = $perPage ?? 10;
            $_status = $currentStatus ?? 'all';
            $_search = $searchQuery ?? '';
        @endphp
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 14px; padding: 6px 0; font-size: 13px; color: #646970;">
            <div>
                Showing <strong>{{ $_totalItems > 0 ? (($_currentPage - 1) * $_perPage) + 1 : 0 }}</strong> to <strong>{{ min($_currentPage * $_perPage, $_totalItems) }}</strong> of <strong>{{ $_totalItems }}</strong> items
            </div>

            @if ($_lastPage > 1)
                <div style="display: flex; gap: 4px; align-items: center;">
                    @if ($_currentPage > 1)
                        <a href="{{ route('admin.site-pages.index', ['status' => $_status, 's' => $_search, 'p' => 1]) }}" style="padding: 3px 8px; border: 1px solid #2271b1; color: #2271b1; border-radius: 3px; text-decoration: none; font-weight: 600;">« First</a>
                        <a href="{{ route('admin.site-pages.index', ['status' => $_status, 's' => $_search, 'p' => $_currentPage - 1]) }}" style="padding: 3px 8px; border: 1px solid #2271b1; color: #2271b1; border-radius: 3px; text-decoration: none; font-weight: 600;">‹ Prev</a>
                    @endif

                    <span style="padding: 3px 8px; color: #1d2327; font-weight: 600;">Page {{ $_currentPage }} of {{ $_lastPage }}</span>

                    @if ($_currentPage < $_lastPage)
                        <a href="{{ route('admin.site-pages.index', ['status' => $_status, 's' => $_search, 'p' => $_currentPage + 1]) }}" style="padding: 3px 8px; border: 1px solid #2271b1; color: #2271b1; border-radius: 3px; text-decoration: none; font-weight: 600;">Next ›</a>
                        <a href="{{ route('admin.site-pages.index', ['status' => $_status, 's' => $_search, 'p' => $_lastPage]) }}" style="padding: 3px 8px; border: 1px solid #2271b1; color: #2271b1; border-radius: 3px; text-decoration: none; font-weight: 600;">Last »</a>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
