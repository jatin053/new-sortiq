@extends('admin.layouts.app')

@section('title', 'Pages')

@section('content')
    @php
        $pageHeroActions = $selectedPageDetails
            ? [[
                'type' => 'button',
                'label' => 'Save Changes',
                'class' => 'primary-btn',
                'button_type' => 'submit',
                'form' => 'page-meta-form',
            ]]
            : [];
    @endphp

    @include('admin.partials.page-hero', [
        'kicker' => 'Page SEO',
        'title' => $selectedPageDetails ? 'Manage page titles and descriptions.' : 'Choose one page to manage SEO.',
        'description' => $selectedPageDetails
            ? 'Update the current SEO title and meta description for the selected public page.'
            : 'Pick one page from the dropdown to manage its current SEO title and meta description without loading a long list.',
        'actions' => $pageHeroActions,
    ])

    @if (session('status'))
        <div class="success-box">{{ session('status') }}</div>
    @endif

    <form id="page-meta-filter-form" action="{{ route('admin.pages.edit') }}" method="get" class="site-settings-form" novalidate>
        <section class="settings-panel">
            <div class="settings-panel-title">
                <span>Page Filter</span>
                <strong>{{ $selectedPageDetails ? 'Editing one selected page' : 'Pick a page to edit' }}</strong>
            </div>

            <div class="settings-panel-body">
                <div class="page-meta-filter-bar">
                    <div class="page-meta-filter-copy">
                        <p class="page-meta-help">
                            @if ($selectedPageDetails)
                                You are editing the current SEO details for <strong>{{ $selectedPageDetails['label'] }}</strong>. Use the dropdown to switch to another page any time.
                            @else
                                Choose one page from the dropdown to open its SEO title and meta description. The editor stays focused on one page so this screen does not get too long.
                            @endif
                        </p>
                    </div>

                    <div class="page-meta-filter-actions">
                        <label class="settings-field">
                            Select Page
                            <select name="page" class="page-meta-select">
                                <option value="">Select one page</option>
                                @foreach ($pageOptions as $pageOption)
                                    <option value="{{ $pageOption['route_name'] }}" @selected($selectedPage === $pageOption['route_name'])>
                                        {{ $pageOption['section'] }} - {{ $pageOption['label'] }}
                                    </option>
                                @endforeach
                            </select>
                        </label>

                        <div class="page-meta-filter-buttons">
                            <button type="submit" class="btn">{{ $selectedPageDetails ? 'Open Another Page' : 'Open Page' }}</button>

                            @if ($selectedPage)
                                <a href="{{ route('admin.pages.edit', ['view' => request('view')]) }}" class="btn">Back to Picker</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

    @if ($selectedPageDetails)
        <form id="page-meta-form" action="{{ route('admin.pages.update') }}" method="post" class="site-settings-form" novalidate>
            @csrf
            @method('PUT')
            <input type="hidden" name="selected_page" value="{{ $selectedPage }}">
            <input type="hidden" name="return_view" value="{{ request('view') }}">

            <div class="page-meta-groups">
                @foreach ($pageSections as $section => $sectionPages)
                    <section class="settings-panel">
                        <div class="settings-panel-title">
                            <span>{{ $section }}</span>
                            <strong>Current SEO for {{ $selectedPageDetails['label'] }}</strong>
                        </div>

                        <div class="settings-panel-body">
                            <div class="page-meta-grid">
                                @foreach ($sectionPages as $page)
                                    <div class="settings-row page-meta-row">
                                        <div class="page-meta-row-head">
                                            <div>
                                                <strong>{{ $page['label'] }}</strong>
                                                <span class="page-meta-path">{{ $page['path'] }}</span>
                                            </div>

                                            <span class="page-meta-route">{{ $page['route_name'] }}</span>
                                        </div>

                                        <input type="hidden" name="pages[{{ $page['input_index'] }}][route_name]" value="{{ $page['route_name'] }}">

                                        <div class="page-meta-fields">
                                            <label class="settings-field">
                                                Page URL Path (slug)
                                                <input
                                                    type="text"
                                                    name="pages[{{ $page['input_index'] }}][custom_path]"
                                                    value="{{ old("pages.{$page['input_index']}.custom_path", $page['custom_path'] ?? '') }}"
                                                    placeholder="e.g. {{ $page['default_path'] ?? '' }}"
                                                    class="page-meta-path-input @error("pages.{$page['input_index']}.custom_path") is-invalid @enderror"
                                                >
                                                @error("pages.{$page['input_index']}.custom_path")
                                                    <span class="field-error">{{ $message }}</span>
                                                @enderror
                                                <span style="font-size: 11px; color: #718096; margin-top: 4px; display: block;">
                                                    Default: <code>{{ $page['default_path'] ?? '' }}</code>. Leave blank to use default path.
                                                </span>
                                            </label>

                                            <label class="settings-field">
                                                SEO Title
                                                <input
                                                    type="text"
                                                    name="pages[{{ $page['input_index'] }}][title]"
                                                    value="{{ old("pages.{$page['input_index']}.title", $page['title']) }}"
                                                    class="page-meta-title-input @error("pages.{$page['input_index']}.title") is-invalid @enderror"
                                                >
                                                @error("pages.{$page['input_index']}.title")
                                                    <span class="field-error">{{ $message }}</span>
                                                @enderror
                                            </label>

                                            <label class="settings-field">
                                                Meta Description
                                                <textarea
                                                    name="pages[{{ $page['input_index'] }}][description]"
                                                    class="page-meta-description @error("pages.{$page['input_index']}.description") is-invalid @enderror"
                                                >{{ old("pages.{$page['input_index']}.description", $page['description']) }}</textarea>
                                                @error("pages.{$page['input_index']}.description")
                                                    <span class="field-error">{{ $message }}</span>
                                                @enderror
                                            </label>

                                            <label class="settings-field">
                                                Meta Keywords
                                                <textarea
                                                    name="pages[{{ $page['input_index'] }}][keywords]"
                                                    class="page-meta-keywords @error("pages.{$page['input_index']}.keywords") is-invalid @enderror"
                                                >{{ old("pages.{$page['input_index']}.keywords", $page['keywords']) }}</textarea>
                                                @error("pages.{$page['input_index']}.keywords")
                                                    <span class="field-error">{{ $message }}</span>
                                                @enderror
                                            </label>

                                            <label class="settings-field checkbox-field" style="flex-direction: row; align-items: center; gap: 8px; margin-top: 10px; cursor: pointer;">
                                                <input
                                                    type="checkbox"
                                                    name="pages[{{ $page['input_index'] }}][exclude_sitemap]"
                                                    value="1"
                                                    id="exclude-sitemap-{{ $page['input_index'] }}"
                                                    @checked(old("pages.{$page['input_index']}.exclude_sitemap", $page['exclude_sitemap'] ?? false))
                                                    style="width: 16px; height: 16px; margin: 0; cursor: pointer;"
                                                >
                                                <span style="font-weight: 500; font-size: 14px; user-select: none; cursor: pointer;">Exclude this page from the XML Sitemap</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>  
                @endforeach
            </div>

            <div class="settings-save-bar">
                <button type="submit" class="primary-btn">Save Page Metadata</button>
            </div>
        </form>
    @elseif (false)
        <section class="settings-panel">
            <div class="settings-panel-title">
                <span>Site Pages & Sitemap Directory</span>
                <strong>Manage sitemap visibility and view page SEO stats</strong>
            </div>

            <div class="settings-panel-body">
                <div class="sitemap-view-toggles" style="margin-bottom: 20px; display: flex; gap: 10px;">
                    <a href="{{ route('admin.pages.edit', ['view' => 'catalog']) }}" 
                       class="btn" 
                       style="padding: 8px 16px; font-size: 14px; font-weight: 600; text-decoration: none; border-radius: 4px; display: inline-flex; align-items: center; justify-content: center; height: 38px; background: {{ request('view', 'catalog') === 'catalog' ? '#3182ce' : '#edf2f7' }}; color: {{ request('view', 'catalog') === 'catalog' ? 'white' : '#4a5568' }}; border: {{ request('view', 'catalog') === 'catalog' ? 'none' : '1px solid #cbd5e0' }}; cursor: pointer; transition: all 0.2s;">
                        Show Catalog Pages
                    </a>
                    <a href="{{ route('admin.pages.edit', ['view' => 'xml_urls']) }}" 
                       class="btn" 
                       style="padding: 8px 16px; font-size: 14px; font-weight: 600; text-decoration: none; border-radius: 4px; display: inline-flex; align-items: center; justify-content: center; height: 38px; background: {{ request('view') === 'xml_urls' ? '#3182ce' : '#edf2f7' }}; color: {{ request('view') === 'xml_urls' ? 'white' : '#4a5568' }}; border: {{ request('view') === 'xml_urls' ? 'none' : '1px solid #cbd5e0' }}; cursor: pointer; transition: all 0.2s;">
                        Show All XML Sitemap URLs ({{ count($xmlUrls) }})
                    </a>
                </div>

                @if (request('view') === 'xml_urls')
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
                                            <div style="font-size: 12px; color: #718096; margin-top: 2px;">
                                                {{ $url['label'] }}
                                            </div>
                                            <div style="margin-top: 8px; font-size: 12px; color: #4a5568; background: #f7fafc; padding: 8px 12px; border-radius: 4px; border: 1px solid #edf2f7; line-height: 1.4; text-align: left;">
                                                <div style="margin-bottom: 2px;"><strong>Title:</strong> <span style="color: #2d3748;">{{ $url['title'] ?? '(None)' }}</span></div>
                                                <div style="margin-bottom: 2px;"><strong>Description:</strong> <span style="color: #4a5568;">{{ $url['description'] ?? '(None)' }}</span></div>
                                                @if(!empty($url['keywords']))
                                                    <div><strong>Keywords:</strong> <span style="color: #718096;">{{ $url['keywords'] }}</span></div>
                                                @endif
                                            </div>
                                        </td>
                                        <td style="padding: 15px 10px;">
                                            <span style="font-size: 14px; color: #4a5568; font-weight: 500;">{{ $url['section'] }}</span>
                                        </td>
                                        <td style="padding: 15px 10px;">
                                            @if ($url['exclude_sitemap'])
                                                <span class="status-pill" style="background: #fed7d7; color: #c53030; font-weight: 600; padding: 4px 8px; border-radius: 9999px; font-size: 12px;">Blocked</span>
                                            @else
                                                <span class="status-pill" style="background: #c6f6d5; color: #22543d; font-weight: 600; padding: 4px 8px; border-radius: 9999px; font-size: 12px;">Active (Indexed)</span>
                                            @endif
                                        </td>
                                        <td style="text-align: right; padding: 15px 20px 15px 10px;">
                                            <div style="display: flex; gap: 8px; justify-content: flex-end; align-items: center;">
                                                <form action="{{ route('admin.pages.toggle-sitemap-url') }}" method="post" style="margin: 0;">
                                                    @csrf
                                                    <input type="hidden" name="path" value="{{ $url['path'] }}">
                                                    <button type="submit" class="btn btn-sm" style="padding: 6px 12px; font-size: 12px; border-radius: 4px; background: {{ $url['exclude_sitemap'] ? '#3182ce' : '#e53e3e' }}; color: white; border: none; cursor: pointer; font-weight: 600; transition: background 0.2s;">
                                                        {{ $url['exclude_sitemap'] ? 'Include' : 'Block' }}
                                                    </button>
                                                </form>
                                                @if ($url['type'] === 'static')
                                                    <span style="color: #cbd5e0;">|</span>
                                                    <a href="{{ route('admin.pages.edit', ['page' => $url['route_name'], 'view' => 'xml_urls']) }}" style="font-size: 13px; font-weight: 600; color: #3182ce; text-decoration: none; padding: 6px 12px; border: 1px solid #e2e8f0; border-radius: 4px; background: white; transition: all 0.2s;">
                                                        Edit Meta
                                                    </a>
                                                @elseif ($url['type'] === 'blog')
                                                    <span style="color: #cbd5e0;">|</span>
                                                    <a href="{{ route('admin.blogs.edit', ['blog' => $url['blog_slug']]) }}" style="font-size: 13px; font-weight: 600; color: #3182ce; text-decoration: none; padding: 6px 12px; border: 1px solid #e2e8f0; border-radius: 4px; background: white; transition: all 0.2s;">
                                                        Edit Post
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="empty-state-cell" style="padding: 20px; text-align: center; color: #718096;">No XML sitemap URLs found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="reviews-table-wrap">
                        <table class="reviews-table">
                            <thead>
                                <tr>
                                    <th>Page / Section</th>
                                    <th>URL Path</th>
                                    <th>Sitemap Status</th>
                                    <th style="text-align: right; padding-right: 20px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($allPages as $page)
                                    <tr>
                                        <td style="padding: 15px 10px;">
                                            <a href="{{ route("admin.pages.edit", ["page" => $page["route_name"], "view" => "catalog"]) }}" class="review-title" style="font-weight: 600; font-size: 15px; color: #2d3748; text-decoration: none;">
                                                {{ $page["label"] }}
                                            </a>
                                            <div style="font-size: 12px; color: #718096; margin-top: 2px;">
                                                {{ $page["section"] }}
                                            </div>
                                            <div style="margin-top: 8px; font-size: 12px; color: #4a5568; background: #f7fafc; padding: 8px 12px; border-radius: 4px; border: 1px solid #edf2f7; line-height: 1.4; text-align: left;">
                                                <div style="margin-bottom: 2px;"><strong>Title:</strong> <span style="color: #2d3748;">{{ $page['title'] ?? '(None)' }}</span></div>
                                                <div style="margin-bottom: 2px;"><strong>Description:</strong> <span style="color: #4a5568;">{{ $page['description'] ?? '(None)' }}</span></div>
                                                @if(!empty($page['keywords']))
                                                    <div><strong>Keywords:</strong> <span style="color: #718096;">{{ $page['keywords'] }}</span></div>
                                                @endif
                                            </div>
                                        </td>
                                        <td style="padding: 15px 10px;">
                                            <a href="{{ url($page["path"]) }}" target="_blank" rel="noopener" class="page-meta-path" style="text-decoration: underline; color: #3182ce; font-size: 14px;">
                                                {{ $page["path"] }}
                                            </a>
                                        </td>
                                        <td style="padding: 15px 10px;">
                                            @if ($page["exclude_sitemap"])
                                                <span class="status-pill" style="background: #fed7d7; color: #c53030; font-weight: 600; padding: 4px 8px; border-radius: 9999px; font-size: 12px;">Blocked</span>
                                            @else
                                                <span class="status-pill" style="background: #c6f6d5; color: #22543d; font-weight: 600; padding: 4px 8px; border-radius: 9999px; font-size: 12px;">Active (Indexed)</span>
                                            @endif
                                        </td>
                                        <td style="text-align: right; padding: 15px 20px 15px 10px;">
                                            <div style="display: flex; gap: 8px; justify-content: flex-end; align-items: center;">
                                                <form action="{{ route("admin.pages.toggle-sitemap") }}" method="post" style="margin: 0;">
                                                    @csrf
                                                    <input type="hidden" name="route_name" value="{{ $page["route_name"] }}">
                                                    <button type="submit" class="btn btn-sm" style="padding: 6px 12px; font-size: 12px; border-radius: 4px; background: {{ $page["exclude_sitemap"] ? "#3182ce" : "#e53e3e" }}; color: white; border: none; cursor: pointer; font-weight: 600; transition: background 0.2s;">
                                                        {{ $page["exclude_sitemap"] ? "Include" : "Block" }}
                                                    </button>
                                                </form>
                                                <span style="color: #cbd5e0;">|</span>
                                                <a href="{{ route("admin.pages.edit", ["page" => $page["route_name"], "view" => "catalog"]) }}" style="font-size: 13px; font-weight: 600; color: #3182ce; text-decoration: none; padding: 6px 12px; border: 1px solid #e2e8f0; border-radius: 4px; background: white; transition: all 0.2s;">
                                                    Edit Meta
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="empty-state-cell" style="padding: 20px; text-align: center; color: #718096;">No pages found in catalog.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </section>
    @endif
@endsection
