@extends('admin.layouts.app')

@section('title', 'Pages')

@section('content')
    <div style="padding: 10px 0;">
        <div class="wp-pages-header">
            <h1 class="wp-heading-inline">Pages</h1>
        </div>

        @if (session('status'))
            <div style="padding: 10px 14px; background: #f0fdf4; border-left: 4px solid #16a34a; border: 1px solid #bbf7d0; font-size: 13px; color: #15803d; margin-bottom: 16px; font-weight: 600;">
                {{ session('status') }}
            </div>
        @endif

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; flex-wrap: wrap; gap: 12px;">
            <div style="font-size: 13px; color: #50575e; font-weight: 600;">
                All Pages <span class="count" style="color: #646970; font-weight: normal;">({{ $totalCount ?? count($allPages) }})</span>
            </div>

            <!-- WordPress Search Box -->
            <form action="{{ route('admin.site-pages.index') }}" method="get" style="display: flex; gap: 6px; align-items: center;">
                <input type="search" name="s" value="{{ $searchQuery ?? '' }}" placeholder="Search pages..." style="padding: 4px 8px; font-size: 13px; border: 1px solid #8c8f94; border-radius: 3px; width: 220px;">
                <button type="submit" style="padding: 4px 10px; font-size: 13px; background: #f6f7f7; border: 1px solid #2271b1; color: #2271b1; border-radius: 3px; cursor: pointer; font-weight: 600;">
                    Search Pages
                </button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="wp-list-table">
                <thead>
                    <tr>
                        <th style="width: 32%;">Title</th>
                        <th style="width: 15%;">Section</th>
                        <th style="width: 23%;">Slug / Path</th>
                        <th style="width: 15%;">SEO & Social Image</th>
                        <th style="width: 15%; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allPages as $page)
                        @php
                            $hasCustomTitle = !empty($page['current_meta']['title']);
                            $hasCustomDesc = !empty($page['current_meta']['description']);
                            $hasCustomImage = !empty($page['current_meta']['image']);
                            $isCustomPage = str_starts_with($page['route_name'], 'frontend.custom-') || ($page['section'] ?? '') === 'Custom Pages';
                        @endphp
                        <tr>
                            <td>
                                <div>
                                    <a href="{{ route('admin.pages.edit', ['page' => $page['route_name']]) }}" class="row-title">
                                        {{ $page['label'] }}
                                    </a>
                                    @if ($isCustomPage)
                                        <span style="font-size: 11px; background: #e0f2fe; color: #0369a1; padding: 1px 6px; border-radius: 3px; font-weight: 600; margin-left: 4px;">Custom</span>
                                    @endif

                                    <div class="row-actions">
                                        <a href="{{ route('admin.pages.edit', ['page' => $page['route_name']]) }}">Edit SEO</a>
                                        <span>|</span>
                                        <a href="{{ url($page['path']) }}" target="_blank" rel="noopener">View Page ↗</a>
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
                                @if ($hasCustomImage)
                                    <img src="{{ $page['current_meta']['image'] }}" alt="OG Image" style="width: 36px; height: 24px; object-fit: cover; border-radius: 2px; border: 1px solid #c3c4c7;">
                                @else
                                    <span style="font-size: 11px; color: #a7aaad;">Default Image</span>
                                @endif
                            </td>
                            <td style="text-align: right; white-space: nowrap;">
                                <a href="{{ route('admin.pages.edit', ['page' => $page['route_name']]) }}" style="background: #2271b1; color: #ffffff; border: 1px solid #2271b1; font-size: 12px; padding: 4px 10px; border-radius: 3px; cursor: pointer; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center;">
                                    Edit SEO
                                </a>
                                <a href="{{ url($page['path']) }}" target="_blank" rel="noopener" style="background: #f6f7f7; color: #2271b1; border: 1px solid #dcdcde; font-size: 12px; padding: 4px 8px; border-radius: 3px; cursor: pointer; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; margin-left: 4px;" title="View page on website">
                                    ↗
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 20px; color: #646970;">No pages found matching your search.</td>
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
            $_search = $searchQuery ?? '';
        @endphp
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 14px; padding: 6px 0; font-size: 13px; color: #646970;">
            <div>
                Showing <strong>{{ $_totalItems > 0 ? (($_currentPage - 1) * $_perPage) + 1 : 0 }}</strong> to <strong>{{ min($_currentPage * $_perPage, $_totalItems) }}</strong> of <strong>{{ $_totalItems }}</strong> items
            </div>

            @if ($_lastPage > 1)
                <div style="display: flex; gap: 4px; align-items: center;">
                    @if ($_currentPage > 1)
                        <a href="{{ route('admin.site-pages.index', ['s' => $_search, 'p' => 1]) }}" style="padding: 3px 8px; border: 1px solid #2271b1; color: #2271b1; border-radius: 3px; text-decoration: none; font-weight: 600;">« First</a>
                        <a href="{{ route('admin.site-pages.index', ['s' => $_search, 'p' => $_currentPage - 1]) }}" style="padding: 3px 8px; border: 1px solid #2271b1; color: #2271b1; border-radius: 3px; text-decoration: none; font-weight: 600;">‹ Prev</a>
                    @endif

                    <span style="padding: 3px 8px; color: #1d2327; font-weight: 600;">Page {{ $_currentPage }} of {{ $_lastPage }}</span>

                    @if ($_currentPage < $_lastPage)
                        <a href="{{ route('admin.site-pages.index', ['s' => $_search, 'p' => $_currentPage + 1]) }}" style="padding: 3px 8px; border: 1px solid #2271b1; color: #2271b1; border-radius: 3px; text-decoration: none; font-weight: 600;">Next ›</a>
                        <a href="{{ route('admin.site-pages.index', ['s' => $_search, 'p' => $_lastPage]) }}" style="padding: 3px 8px; border: 1px solid #2271b1; color: #2271b1; border-radius: 3px; text-decoration: none; font-weight: 600;">Last »</a>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
