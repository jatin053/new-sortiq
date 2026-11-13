<form action="{{ $action }}" method="post" class="video-form" enctype="multipart/form-data" novalidate>
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    @php
        $categoriesList = $categories ?? [];
        if (empty($categoriesList)) {
            try {
                $categoriesList = \App\Models\Portfolio::CATEGORY_OPTIONS;
                $custom = \App\Models\SiteLayoutSetting::main()->data['admin_categories']['portfolios'] ?? [];
                foreach ($custom as $customName) {
                    if (is_string($customName) && trim($customName) !== '') {
                        $slug = \Illuminate\Support\Str::slug($customName);
                        if (!isset($categoriesList[$slug])) {
                            $categoriesList[$slug] = trim($customName);
                        }
                    }
                }
            } catch (\Throwable $e) {
                $categoriesList = \App\Models\Portfolio::CATEGORY_OPTIONS;
            }
        }

        // Selected Categories
        $categoryValue = old('category_name', $portfolio['category_name'] ?? ($portfolio->category_name ?? null));
        $selectedCategories = old('categories', $portfolio->categories_list ?? []);
        if (empty($selectedCategories) && !empty($categoryValue)) {
            $selectedCategories = array_values(array_filter(array_map('trim', explode(',', (string) $categoryValue))));
        }
        if (empty($selectedCategories) && !empty($portfolio['category_slug'])) {
            $matched = $categoriesList[$portfolio['category_slug']] ?? null;
            if ($matched) {
                $selectedCategories = [$matched];
            }
        }
        if (!is_array($selectedCategories)) {
            $selectedCategories = (array) $selectedCategories;
        }
        $selectedCategories = array_values(array_unique(array_filter(array_map('trim', $selectedCategories))));

        // Selected & Available Tags
        $tagsValue = old('tags_text', implode(', ', $portfolio->tags ?? []));
        $selectedTags = old('tags', $portfolio->tags ?? []);
        if (empty($selectedTags) && !empty($tagsValue)) {
            $selectedTags = array_values(array_filter(array_map('trim', explode(',', (string) $tagsValue))));
        }
        if (!is_array($selectedTags)) {
            $selectedTags = (array) $selectedTags;
        }
        $selectedTags = array_values(array_unique(array_filter(array_map('trim', $selectedTags))));

        $allAvailableTags = $availableTags ?? [];
        if (empty($allAvailableTags)) {
            try {
                $existing = \App\Models\Portfolio::query()->get()->flatMap(fn ($p) => $p->tags ?? [])->all();
                $custom = \App\Models\SiteLayoutSetting::main()->data['admin_tags']['portfolios'] ?? [];
                $allAvailableTags = collect([...$existing, ...$custom])
                    ->filter(fn ($t) => is_string($t) && trim($t) !== '')
                    ->map(fn ($t) => trim($t))
                    ->unique(fn ($t) => mb_strtolower($t))
                    ->values()
                    ->all();
            } catch (\Throwable $e) {
                $allAvailableTags = [];
            }
        }
        $allAvailableTags = collect([...$allAvailableTags, ...$selectedTags])
            ->filter(fn ($t) => is_string($t) && trim($t) !== '')
            ->map(fn ($t) => trim($t))
            ->unique(fn ($t) => mb_strtolower($t))
            ->values()
            ->all();
    @endphp

    <div class="review-edit-grid">
        <section class="review-editor-main">
            <label class="screen-reader-text" for="portfolio-title">Portfolio title</label>
            <input
                id="portfolio-title"
                class="title-input @error('title') is-invalid @enderror"
                name="title"
                type="text"
                value="{{ old('title', $portfolio['title']) }}"
                placeholder="Enter project title"
            >
            @error('title')
                <p class="field-error">{{ $message }}</p>
            @enderror

            <p class="permalink">
                Permalink:
                <a href="{{ $permalink }}">{{ $permalink }}</a>
                <span class="small-btn">Edit</span>
            </p>

            <input type="hidden" name="slug" value="{{ old('slug', $portfolio['slug']) }}">

            <div class="meta-box">
                <div class="meta-title">Project Summary</div>
                <div class="meta-body review-fields">
                    <label>
                        Short Description
                        <textarea
                            class="@error('summary') is-invalid @enderror"
                            name="summary"
                            placeholder="Short description shown in portfolio cards"
                        >{{ old('summary', $portfolio['summary']) }}</textarea>
                        @error('summary')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label>
                        Full Description
                        <textarea
                            class="@error('content') is-invalid @enderror"
                            name="content"
                            rows="8"
                            placeholder="Optional project details for admin reference"
                        >{{ old('content', $portfolio['content']) }}</textarea>
                        @error('content')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
            </div>
        </section>

        <aside class="review-side">
            @include('admin.portfolios.partials.publish-box', [
                'portfolio' => $portfolio,
                'submitLabel' => $submitLabel,
            ])

            <div class="meta-box">
                <div class="meta-title">Portfolio Details</div>
                <div class="meta-body review-fields">
                    <div class="form-group" style="margin-bottom: 16px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #1e293b; font-size: 13px;">Project Image</label>
                        <input type="hidden" name="image" id="portfolioCurrentHiddenImage" value="{{ old('image', $portfolio['image']) }}">

                        {{-- Current Image Display (if exists) --}}
                        @if (!empty($portfolio['image']) && $portfolio->image_url)
                            <div id="currentPortfolioImageCard" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px; margin-bottom: 10px;">
                                <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.5px; margin-bottom: 6px;">Current Image</div>
                                <div style="position: relative; max-width: 100%; border-radius: 6px; overflow: hidden; background: #0b132b; text-align: center; margin-bottom: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                                    <img 
                                        id="currentPortfolioImageImg"
                                        src="{{ $portfolio->image_url }}" 
                                        alt="{{ $portfolio->title ?: 'Portfolio image' }}" 
                                        style="max-width: 100%; max-height: 180px; width: auto; height: auto; object-fit: contain; display: block; margin: 0 auto; border-radius: 4px;"
                                    >
                                </div>
                                <div style="font-size: 11px; color: #64748b; word-break: break-all; margin-bottom: 4px; line-height: 1.4;">
                                    File: <strong style="color: #334155;">{{ $portfolio['image'] }}</strong>
                                </div>
                            </div>
                        @elseif (!empty($portfolio['image']))
                            <p class="current-logo-path" style="margin-bottom: 8px;">
                                Current file: <strong>{{ $portfolio['image'] }}</strong>
                            </p>
                        @endif

                        {{-- Live Preview for newly selected file --}}
                        <div id="newPortfolioImagePreviewCard" style="display: none; background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 10px; margin-bottom: 10px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #1d4ed8; letter-spacing: 0.5px;">New Image Selected</span>
                                <button type="button" id="btnCancelNewPortfolioImage" style="background: none; border: none; color: #64748b; font-size: 11px; font-weight: 600; cursor: pointer; text-decoration: underline;">Cancel</button>
                            </div>
                            <div style="position: relative; max-width: 100%; border-radius: 6px; overflow: hidden; background: #0f172a; text-align: center; margin-bottom: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                                <img id="newPortfolioImagePreviewImg" src="" alt="New preview" style="max-width: 100%; max-height: 180px; width: auto; height: auto; object-fit: contain; display: block; margin: 0 auto; border-radius: 4px;">
                            </div>
                            <div id="newPortfolioImageName" style="font-size: 11px; color: #1e40af; word-break: break-all;"></div>
                        </div>

                        {{-- File Input --}}
                        <input
                            id="portfolioImageFileInput"
                            class="@error('image_file') is-invalid @enderror"
                            name="image_file"
                            type="file"
                            accept="image/webp,image/png,image/jpeg,image/jpg,image/gif,image/avif"
                            style="width: 100%;"
                        >
                        <span class="field-help" style="display: block; margin-top: 4px; font-size: 11px; color: #64748b;">
                            Upload a local portfolio image (WebP, PNG, JPG). The current image stays in place until you replace it.
                        </span>
                        @error('image_file')
                            <span class="field-error" style="display: block; margin-top: 4px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <label>
                        Project Preview URL
                        <input
                            class="@error('website_url') is-invalid @enderror"
                            name="website_url"
                            type="text"
                            value="{{ old('website_url', $portfolio['website_url']) }}"
                            placeholder="https://project-site.com or /flipbook/docs/index.html"
                        >
                        @error('website_url')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    {{-- Multi-Category Manager --}}
                    <div class="multi-cat-container" id="portfolioMultiCatContainer">
                        <div class="multi-cat-header">
                            <span class="multi-cat-header-title">Category</span>
                            <span id="portfolioMultiCatSelectedCountBadge" class="multi-cat-header-badge">
                                {{ !empty($selectedCategories) ? count($selectedCategories) : 0 }} selected
                            </span>
                        </div>

                        {{-- Hidden inputs for backward compatibility --}}
                        <input type="hidden" name="category_name" id="portfolioCategoryHiddenName" value="{{ implode(', ', $selectedCategories) }}">
                        <input type="hidden" name="category_slug" id="portfolioCategoryHiddenSlug" value="{{ !empty($selectedCategories) ? \Illuminate\Support\Str::slug($selectedCategories[0]) : '' }}">

                        {{-- Dropdown Trigger Box --}}
                        <div id="portfolioMultiCatTrigger" tabindex="0" role="combobox" aria-expanded="false" aria-haspopup="listbox">
                            <div id="portfolioMultiCatPillsContainer">
                                @forelse ($selectedCategories as $cat)
                                    <span class="multi-cat-pill" data-cat="{{ $cat }}">
                                        <span>{{ $cat }}</span>
                                        <span class="multi-cat-remove-btn" data-cat="{{ $cat }}" title="Remove">&times;</span>
                                    </span>
                                @empty
                                    <span id="portfolioMultiCatPlaceholder">Select categories...</span>
                                @endforelse
                            </div>
                            <span class="multi-cat-trigger-arrow">
                                <svg id="portfolioMultiCatArrowIcon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </span>
                        </div>

                        {{-- Dropdown Panel --}}
                        <div id="portfolioMultiCatDropdown">
                            {{-- Search Input --}}
                            <div class="multi-cat-search-box">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                <input type="text" id="portfolioMultiCatSearchInput" placeholder="Search categories..." autocomplete="off">
                            </div>

                            {{-- Quick Actions --}}
                            <div class="multi-cat-options-bar">
                                <span>Options:</span>
                                <div style="display: flex; gap: 8px;">
                                    <button type="button" id="portfolioMultiCatSelectAllBtn">Select All</button>
                                    <span style="color: #cbd5e1;">|</span>
                                    <button type="button" id="portfolioMultiCatClearAllBtn">Clear All</button>
                                </div>
                            </div>

                            {{-- Scrollable Checkbox List --}}
                            <div class="multi-cat-list" id="portfolioMultiCatList">
                                @foreach ($categoriesList as $catSlug => $categoryLabel)
                                    @php
                                        $isChecked = in_array($categoryLabel, $selectedCategories, true) || in_array($catSlug, $selectedCategories, true);
                                    @endphp
                                    <div class="multi-cat-row {{ $isChecked ? 'is-checked' : '' }}" data-cat-name="{{ strtolower($categoryLabel) }}" data-cat-slug="{{ $catSlug }}">
                                        <input 
                                            type="checkbox" 
                                            id="port-cat-check-{{ $loop->index }}" 
                                            name="categories[]" 
                                            value="{{ $categoryLabel }}" 
                                            class="multi-cat-checkbox"
                                            @checked($isChecked)
                                        >
                                        <label for="port-cat-check-{{ $loop->index }}" class="multi-cat-text-label">{{ $categoryLabel }}</label>
                                    </div>
                                @endforeach
                                <div id="portfolioMultiCatNoMatch" style="display: none; padding: 12px; text-align: center; color: #94a3b8; font-size: 12px;">No matching categories found</div>
                            </div>
                        </div>

                        @error('category_name')
                            <span class="field-error" style="display: block; margin-top: 4px;">{{ $message }}</span>
                        @enderror
                        @error('category_slug')
                            <span class="field-error" style="display: block; margin-top: 4px;">{{ $message }}</span>
                        @enderror
                        @error('categories')
                            <span class="field-error" style="display: block; margin-top: 4px;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Interactive Tags Manager & Dropdown --}}
                    <div class="blog-tags-container" id="portfolioTagsContainer">
                        <div class="blog-tags-header">
                            <span class="blog-tags-header-title">Tags</span>
                            <span id="portfolioTagsSelectedCountBadge" class="blog-tags-header-badge">
                                {{ count($selectedTags) }} selected
                            </span>
                        </div>

                        {{-- Hidden input for backward compatibility with tags_text --}}
                        <input type="hidden" name="tags_text" id="portfolioTagsHiddenText" value="{{ implode(', ', $selectedTags) }}">

                        {{-- Trigger & Active Tags Box --}}
                        <div id="portfolioTagsTrigger" tabindex="0" role="combobox" aria-expanded="false" aria-haspopup="listbox">
                            <div id="portfolioTagsPillsContainer">
                                @foreach ($selectedTags as $tag)
                                    <span class="blog-tag-pill" data-tag="{{ $tag }}">
                                        <span>{{ $tag }}</span>
                                        <span class="blog-tag-remove-btn" data-tag="{{ $tag }}" title="Remove">&times;</span>
                                        <input type="hidden" name="tags[]" value="{{ $tag }}">
                                    </span>
                                @endforeach
                                <input 
                                    type="text" 
                                    id="portfolioTagsInlineInput" 
                                    class="blog-tags-inline-input" 
                                    placeholder="{{ empty($selectedTags) ? 'Add or select tag...' : '+ Add tag...' }}" 
                                    autocomplete="off"
                                >
                            </div>
                            <span class="blog-tags-trigger-arrow" id="portfolioTagsArrowBtn" title="Toggle tag dropdown">
                                <svg id="portfolioTagsArrowIcon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </span>
                        </div>

                        {{-- Dropdown Panel --}}
                        <div id="portfolioTagsDropdown" style="display: none;">
                            {{-- Quick Create New Tag Option --}}
                            <div id="portfolioTagCreateOption" class="blog-tag-create-row" style="display: none;">
                                <div style="display: flex; align-items: center; gap: 6px; color: #047857; font-weight: 600; font-size: 12px; min-width: 0; overflow: hidden;">
                                    <span style="font-size: 14px; font-weight: 700; line-height: 1;">+</span>
                                    <span style="white-space: nowrap;">Add "</span>
                                    <span id="portfolioTagCreateName" style="font-weight: 700; text-decoration: underline; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"></span>
                                    <span style="white-space: nowrap;">"</span>
                                </div>
                                <span style="font-size: 10.5px; color: #059669; font-weight: 700; background: #ecfdf5; padding: 2px 6px; border-radius: 4px; border: 1px solid #a7f3d0; white-space: nowrap; flex-shrink: 0;">Enter ↵</span>
                            </div>

                            {{-- Options Bar --}}
                            <div class="blog-tags-options-bar">
                                <span style="font-weight: 600; color: #475569; font-size: 11.5px;">Choose from tags:</span>
                                <div style="display: flex; gap: 8px; align-items: center;">
                                    <button type="button" id="portfolioTagsClearAllBtn">Clear All</button>
                                </div>
                            </div>

                            {{-- Scrollable Tags List --}}
                            <div class="blog-tags-list" id="portfolioTagsList">
                                @forelse ($allAvailableTags as $index => $availTag)
                                    @php
                                        $isSelected = in_array($availTag, $selectedTags, true);
                                    @endphp
                                    <div class="blog-tag-row {{ $isSelected ? 'is-selected' : '' }}" data-tag-name="{{ strtolower($availTag) }}" data-tag-value="{{ $availTag }}">
                                        <div class="blog-tag-checkbox-box">
                                            <svg class="blog-tag-check-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                        </div>
                                        <span class="blog-tag-row-label">{{ $availTag }}</span>
                                    </div>
                                @empty
                                    <div class="blog-tags-empty-state" id="portfolioTagsEmptyDefault">
                                        Type a tag name above and press <strong>Enter</strong> to create.
                                    </div>
                                @endforelse
                                <div id="portfolioTagsNoMatch" style="display: none; padding: 10px; text-align: center; color: #94a3b8; font-size: 12px;">
                                    No existing tag matches. Press <strong>Enter</strong> to create!
                                </div>
                            </div>

                            {{-- Dropdown Footer --}}
                            <div class="blog-tags-dropdown-footer">
                                <a href="{{ route('admin.portfolios.tags') }}" target="_blank" rel="noopener noreferrer" class="blog-tags-manage-link" title="Open Tags Manager in new tab">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                                    Manage all tags
                                </a>
                            </div>
                        </div>

                        @error('tags')
                            <span class="field-error" style="display: block; margin-top: 4px;">{{ $message }}</span>
                        @enderror
                        @error('tags_text')
                            <span class="field-error" style="display: block; margin-top: 4px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <style>
                        /* Common Multi-select & Tags Styles */
                        .multi-cat-container, .blog-tags-container {
                            position: relative !important;
                            margin-bottom: 16px !important;
                            width: 100% !important;
                            box-sizing: border-box !important;
                        }

                        .multi-cat-header, .blog-tags-header {
                            display: flex !important;
                            flex-direction: row !important;
                            justify-content: space-between !important;
                            align-items: center !important;
                            margin-bottom: 6px !important;
                            width: 100% !important;
                        }

                        .multi-cat-header-title, .blog-tags-header-title {
                            font-size: 12px !important;
                            font-weight: 700 !important;
                            color: var(--text, #1e293b) !important;
                            letter-spacing: 0.01em !important;
                        }

                        .multi-cat-header-badge, .blog-tags-header-badge {
                            font-size: 11px !important;
                            font-weight: 600 !important;
                            color: #2563eb !important;
                            background: #eff6ff !important;
                            padding: 1px 8px !important;
                            border-radius: 12px !important;
                            border: 1px solid #bfdbfe !important;
                            display: inline-block !important;
                            margin: 0 !important;
                        }

                        /* Trigger Boxes */
                        #portfolioMultiCatTrigger, #portfolioTagsTrigger {
                            display: flex !important;
                            flex-direction: row !important;
                            flex-wrap: wrap !important;
                            align-items: center !important;
                            gap: 5px !important;
                            min-height: 40px !important;
                            padding: 4px 34px 4px 8px !important;
                            background: #ffffff !important;
                            border: 1px solid #cbd5e1 !important;
                            border-radius: 6px !important;
                            cursor: pointer !important;
                            position: relative !important;
                            box-sizing: border-box !important;
                            transition: all 0.15s ease !important;
                            width: 100% !important;
                        }

                        #portfolioTagsTrigger {
                            cursor: text !important;
                        }

                        #portfolioMultiCatTrigger:hover, #portfolioTagsTrigger:hover {
                            border-color: #94a3b8 !important;
                        }

                        #portfolioMultiCatTrigger:focus, #portfolioMultiCatTrigger.is-open,
                        #portfolioTagsTrigger:focus-within, #portfolioTagsTrigger.is-open {
                            border-color: #2563eb !important;
                            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15) !important;
                            outline: none !important;
                        }

                        #portfolioMultiCatPillsContainer, #portfolioTagsPillsContainer {
                            display: flex !important;
                            flex-direction: row !important;
                            flex-wrap: wrap !important;
                            gap: 4px !important;
                            align-items: center !important;
                            flex: 1 !important;
                            width: auto !important;
                        }

                        #portfolioMultiCatPlaceholder {
                            color: #94a3b8 !important;
                            font-size: 13px !important;
                        }

                        .multi-cat-trigger-arrow, .blog-tags-trigger-arrow {
                            position: absolute !important;
                            right: 8px !important;
                            top: 50% !important;
                            transform: translateY(-50%) !important;
                            color: #64748b !important;
                            display: inline-flex !important;
                            align-items: center !important;
                            justify-content: center !important;
                            cursor: pointer !important;
                            padding: 4px !important;
                            border-radius: 4px !important;
                        }

                        #portfolioMultiCatArrowIcon, #portfolioTagsArrowIcon {
                            transition: transform 0.2s ease !important;
                        }

                        /* Pills */
                        .multi-cat-pill, .blog-tag-pill {
                            display: inline-flex !important;
                            flex-direction: row !important;
                            align-items: center !important;
                            gap: 4px !important;
                            background: #eff6ff !important;
                            color: #1d4ed8 !important;
                            border: 1px solid #bfdbfe !important;
                            font-size: 12px !important;
                            font-weight: 600 !important;
                            padding: 2px 7px !important;
                            border-radius: 4px !important;
                            line-height: 1.3 !important;
                            margin: 0 !important;
                        }

                        .multi-cat-pill:hover, .blog-tag-pill:hover {
                            background: #dbeafe !important;
                        }

                        .multi-cat-pill .multi-cat-remove-btn, .blog-tag-pill .blog-tag-remove-btn {
                            display: inline-flex !important;
                            align-items: center !important;
                            justify-content: center !important;
                            width: 14px !important;
                            height: 14px !important;
                            border-radius: 50% !important;
                            color: #3b82f6 !important;
                            font-size: 13px !important;
                            line-height: 1 !important;
                            cursor: pointer !important;
                        }

                        .multi-cat-pill .multi-cat-remove-btn:hover, .blog-tag-pill .blog-tag-remove-btn:hover {
                            background: #bfdbfe !important;
                            color: #1e3a8a !important;
                        }

                        /* Inline Tag Input - Total CSS Reset to eliminate inner borders */
                        .review-edit-grid input#portfolioTagsInlineInput,
                        #portfolioTagsContainer input#portfolioTagsInlineInput,
                        #portfolioTagsTrigger input#portfolioTagsInlineInput,
                        input#portfolioTagsInlineInput {
                            border: 0 !important;
                            border-width: 0 !important;
                            border-style: none !important;
                            outline: none !important;
                            box-shadow: none !important;
                            background: transparent !important;
                            background-color: transparent !important;
                            font-family: inherit !important;
                            font-size: 12.5px !important;
                            color: #1e293b !important;
                            padding: 0 4px !important;
                            margin: 0 !important;
                            height: 28px !important;
                            min-height: 28px !important;
                            line-height: 28px !important;
                            flex: 1 1 110px !important;
                            min-width: 90px !important;
                            max-width: 100% !important;
                            -webkit-appearance: none !important;
                        }

                        input#portfolioTagsInlineInput:focus {
                            border: 0 !important;
                            outline: none !important;
                            box-shadow: none !important;
                            background: transparent !important;
                        }

                        #portfolioTagsInlineInput::placeholder {
                            color: #94a3b8 !important;
                        }

                        /* Dropdowns */
                        #portfolioMultiCatDropdown, #portfolioTagsDropdown {
                            position: absolute !important;
                            top: calc(100% + 4px) !important;
                            left: 0 !important;
                            right: 0 !important;
                            background: #ffffff !important;
                            border: 1px solid #cbd5e1 !important;
                            border-radius: 8px !important;
                            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.12), 0 8px 10px -6px rgba(0,0,0,0.08) !important;
                            z-index: 1050 !important;
                            padding: 8px !important;
                            box-sizing: border-box !important;
                            flex-direction: column !important;
                            width: 100% !important;
                        }

                        /* Search inside Dropdowns */
                        .multi-cat-search-box {
                            position: relative !important;
                            margin-bottom: 6px !important;
                            width: 100% !important;
                            box-sizing: border-box !important;
                        }

                        .multi-cat-search-box svg {
                            position: absolute !important;
                            left: 9px !important;
                            top: 50% !important;
                            transform: translateY(-50%) !important;
                            color: #94a3b8 !important;
                            pointer-events: none !important;
                        }

                        #portfolioMultiCatSearchInput {
                            width: 100% !important;
                            box-sizing: border-box !important;
                            padding: 6px 10px 6px 30px !important;
                            font-size: 12.5px !important;
                            border: 1px solid #cbd5e1 !important;
                            border-radius: 5px !important;
                            outline: none !important;
                            height: 32px !important;
                            background: #f8fafc !important;
                            color: #1e293b !important;
                        }

                        #portfolioMultiCatSearchInput:focus {
                            background: #ffffff !important;
                            border-color: #2563eb !important;
                            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1) !important;
                        }

                        /* Options bar */
                        .multi-cat-options-bar, .blog-tags-options-bar {
                            display: flex !important;
                            flex-direction: row !important;
                            justify-content: space-between !important;
                            align-items: center !important;
                            padding: 0 2px 5px 2px !important;
                            margin-bottom: 5px !important;
                            border-bottom: 1px solid #f1f5f9 !important;
                            font-size: 11.5px !important;
                            color: #64748b !important;
                            width: 100% !important;
                            box-sizing: border-box !important;
                        }

                        .multi-cat-options-bar button, .blog-tags-options-bar button {
                            background: none !important;
                            border: none !important;
                            padding: 0 !important;
                            font-size: 11.5px !important;
                            font-weight: 600 !important;
                            cursor: pointer !important;
                        }

                        #portfolioMultiCatSelectAllBtn { color: #2563eb !important; }
                        #portfolioMultiCatClearAllBtn, #portfolioTagsClearAllBtn { color: #ef4444 !important; }
                        .multi-cat-options-bar button:hover, .blog-tags-options-bar button:hover { text-decoration: underline !important; }

                        /* Scrollable Lists */
                        .multi-cat-list, .blog-tags-list {
                            overflow-y: auto !important;
                            max-height: 180px !important;
                            display: flex !important;
                            flex-direction: column !important;
                            gap: 2px !important;
                            width: 100% !important;
                            box-sizing: border-box !important;
                            padding: 0 !important;
                            margin: 0 !important;
                        }

                        .multi-cat-list::-webkit-scrollbar, .blog-tags-list::-webkit-scrollbar { width: 5px; }
                        .multi-cat-list::-webkit-scrollbar-thumb, .blog-tags-list::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }

                        /* Row Items */
                        .multi-cat-row, .blog-tag-row {
                            display: flex !important;
                            flex-direction: row !important;
                            align-items: center !important;
                            justify-content: flex-start !important;
                            gap: 8px !important;
                            padding: 6px 8px !important;
                            border-radius: 5px !important;
                            cursor: pointer !important;
                            user-select: none !important;
                            transition: background-color 0.12s ease !important;
                            width: 100% !important;
                            box-sizing: border-box !important;
                        }

                        .multi-cat-row:hover, .blog-tag-row:hover { background-color: #f1f5f9 !important; }
                        .multi-cat-row.is-checked, .blog-tag-row.is-selected { background-color: #eff6ff !important; }

                        .multi-cat-row input[type="checkbox"], .multi-cat-row .multi-cat-checkbox {
                            width: 16px !important;
                            height: 16px !important;
                            accent-color: #2563eb !important;
                            cursor: pointer !important;
                            margin: 0 !important;
                            padding: 0 !important;
                            flex-shrink: 0 !important;
                        }

                        .multi-cat-row label.multi-cat-text-label, .blog-tag-row-label {
                            display: inline-block !important;
                            flex: 1 !important;
                            font-size: 13px !important;
                            font-weight: 500 !important;
                            color: #1e293b !important;
                            cursor: pointer !important;
                            margin: 0 !important;
                        }

                        .multi-cat-row.is-checked label.multi-cat-text-label,
                        .blog-tag-row.is-selected .blog-tag-row-label {
                            color: #1d4ed8 !important;
                            font-weight: 600 !important;
                        }

                        .blog-tag-checkbox-box {
                            width: 16px !important;
                            height: 16px !important;
                            min-width: 16px !important;
                            border: 1.5px solid #cbd5e1 !important;
                            border-radius: 3px !important;
                            display: flex !important;
                            align-items: center !important;
                            justify-content: center !important;
                            background: #ffffff !important;
                            box-sizing: border-box !important;
                        }

                        .blog-tag-row.is-selected .blog-tag-checkbox-box {
                            background: #2563eb !important;
                            border-color: #2563eb !important;
                        }

                        .blog-tag-check-icon { display: none !important; stroke: #ffffff !important; }
                        .blog-tag-row.is-selected .blog-tag-check-icon { display: block !important; }

                        /* Create Tag Row - only shown when actively typing */
                        .blog-tag-create-row {
                            display: none;
                            justify-content: space-between !important;
                            align-items: center !important;
                            background: #f0fdf4 !important;
                            border: 1px dashed #34d399 !important;
                            border-radius: 6px !important;
                            padding: 6px 9px !important;
                            margin-bottom: 6px !important;
                            cursor: pointer !important;
                        }

                        .blog-tag-create-row.is-visible { display: flex !important; }
                        .blog-tag-create-row:hover { background: #dcfce7 !important; border-color: #10b981 !important; }

                        .blog-tags-empty-state {
                            padding: 12px;
                            text-align: center;
                            color: #64748b;
                            font-size: 12px;
                            line-height: 1.4;
                        }

                        .blog-tags-dropdown-footer {
                            border-top: 1px solid #f1f5f9 !important;
                            padding-top: 6px !important;
                            margin-top: 5px !important;
                            text-align: right !important;
                            width: 100% !important;
                        }

                        .blog-tags-manage-link {
                            font-size: 11.5px !important;
                            color: #2563eb !important;
                            font-weight: 600 !important;
                            text-decoration: none !important;
                            display: inline-flex !important;
                            align-items: center !important;
                            gap: 4px !important;
                        }

                        .blog-tags-manage-link:hover {
                            text-decoration: underline !important;
                            color: #1d4ed8 !important;
                        }
                    </style>

                    <script>
                    (function initPortfolioCategoryAndTags() {
                        // 1. SETUP CATEGORY SELECTOR
                        function setupCategory() {
                            var container = document.getElementById('portfolioMultiCatContainer');
                            if (!container) return;

                            var trigger = document.getElementById('portfolioMultiCatTrigger');
                            var dropdown = document.getElementById('portfolioMultiCatDropdown');
                            var pillsContainer = document.getElementById('portfolioMultiCatPillsContainer');
                            var countBadge = document.getElementById('portfolioMultiCatSelectedCountBadge');
                            var hiddenName = document.getElementById('portfolioCategoryHiddenName');
                            var hiddenSlug = document.getElementById('portfolioCategoryHiddenSlug');
                            var searchInput = document.getElementById('portfolioMultiCatSearchInput');
                            var selectAllBtn = document.getElementById('portfolioMultiCatSelectAllBtn');
                            var clearAllBtn = document.getElementById('portfolioMultiCatClearAllBtn');
                            var arrowIcon = document.getElementById('portfolioMultiCatArrowIcon');
                            var rows = container.querySelectorAll('.multi-cat-row');
                            var checkboxes = container.querySelectorAll('.multi-cat-checkbox');
                            var noMatch = document.getElementById('portfolioMultiCatNoMatch');

                            function isOpen() { return dropdown.style.display === 'flex'; }

                            function setOpen(open) {
                                if (open) {
                                    dropdown.style.display = 'flex';
                                    trigger.classList.add('is-open');
                                    trigger.setAttribute('aria-expanded', 'true');
                                    if (arrowIcon) arrowIcon.style.transform = 'rotate(180deg)';
                                    if (searchInput) {
                                        searchInput.value = '';
                                        filterRows('');
                                        setTimeout(function() { searchInput.focus(); }, 40);
                                    }
                                } else {
                                    dropdown.style.display = 'none';
                                    trigger.classList.remove('is-open');
                                    trigger.setAttribute('aria-expanded', 'false');
                                    if (arrowIcon) arrowIcon.style.transform = 'rotate(0deg)';
                                }
                            }

                            function filterRows(query) {
                                var q = query.trim().toLowerCase();
                                var matched = 0;
                                rows.forEach(function(row) {
                                    var name = row.getAttribute('data-cat-name') || '';
                                    if (!q || name.indexOf(q) !== -1) {
                                        row.style.display = 'flex';
                                        matched++;
                                    } else {
                                        row.style.display = 'none';
                                    }
                                });
                                if (noMatch) {
                                    noMatch.style.display = matched === 0 ? 'block' : 'none';
                                }
                            }

                            function updateState() {
                                var selected = [];
                                var selectedSlugs = [];
                                checkboxes.forEach(function(cb) {
                                    var parentRow = cb.closest('.multi-cat-row');
                                    if (cb.checked) {
                                        selected.push(cb.value);
                                        var slug = parentRow ? parentRow.getAttribute('data-cat-slug') : '';
                                        if (slug) selectedSlugs.push(slug);
                                        if (parentRow) parentRow.classList.add('is-checked');
                                    } else {
                                        if (parentRow) parentRow.classList.remove('is-checked');
                                    }
                                });

                                if (countBadge) {
                                    countBadge.textContent = selected.length + ' selected';
                                }

                                if (hiddenName) {
                                    hiddenName.value = selected.join(', ');
                                }

                                if (hiddenSlug) {
                                    hiddenSlug.value = selectedSlugs[0] || (selected[0] ? selected[0].toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '') : '');
                                }

                                pillsContainer.innerHTML = '';
                                if (selected.length === 0) {
                                    var placeholder = document.createElement('span');
                                    placeholder.id = 'portfolioMultiCatPlaceholder';
                                    placeholder.textContent = 'Select categories...';
                                    pillsContainer.appendChild(placeholder);
                                } else {
                                    selected.forEach(function(cat) {
                                        var pill = document.createElement('span');
                                        pill.className = 'multi-cat-pill';
                                        pill.setAttribute('data-cat', cat);

                                        var textSpan = document.createElement('span');
                                        textSpan.textContent = cat;

                                        var removeBtn = document.createElement('span');
                                        removeBtn.className = 'multi-cat-remove-btn';
                                        removeBtn.setAttribute('data-cat', cat);
                                        removeBtn.innerHTML = '&times;';
                                        removeBtn.title = 'Remove ' + cat;

                                        pill.appendChild(textSpan);
                                        pill.appendChild(removeBtn);
                                        pillsContainer.appendChild(pill);
                                    });
                                }
                            }

                            rows.forEach(function(row) {
                                row.addEventListener('click', function(e) {
                                    if (e.target.tagName !== 'INPUT') {
                                        var cb = row.querySelector('.multi-cat-checkbox');
                                        if (cb) {
                                            cb.checked = !cb.checked;
                                            updateState();
                                        }
                                    }
                                });
                            });

                            trigger.addEventListener('click', function(e) {
                                if (e.target.closest('.multi-cat-remove-btn')) {
                                    var catToRemove = e.target.closest('.multi-cat-remove-btn').getAttribute('data-cat');
                                    if (catToRemove) {
                                        checkboxes.forEach(function(cb) {
                                            if (cb.value === catToRemove) {
                                                cb.checked = false;
                                            }
                                        });
                                        updateState();
                                    }
                                    e.stopPropagation();
                                    return;
                                }
                                setOpen(!isOpen());
                            });

                            if (searchInput) {
                                searchInput.addEventListener('input', function() {
                                    filterRows(this.value);
                                });
                                searchInput.addEventListener('keydown', function(e) {
                                    if (e.key === 'Escape') {
                                        setOpen(false);
                                        trigger.focus();
                                    }
                                });
                            }

                            checkboxes.forEach(function(cb) {
                                cb.addEventListener('change', updateState);
                            });

                            if (selectAllBtn) {
                                selectAllBtn.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    rows.forEach(function(row) {
                                        if (row.style.display !== 'none') {
                                            var cb = row.querySelector('.multi-cat-checkbox');
                                            if (cb) cb.checked = true;
                                        }
                                    });
                                    updateState();
                                });
                            }

                            if (clearAllBtn) {
                                clearAllBtn.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    checkboxes.forEach(function(cb) { cb.checked = false; });
                                    updateState();
                                });
                            }

                            document.addEventListener('click', function(e) {
                                if (!container.contains(e.target)) {
                                    setOpen(false);
                                }
                            });
                        }

                        // 2. SETUP TAGS SELECTOR
                        function setupTags() {
                            var container = document.getElementById('portfolioTagsContainer');
                            if (!container) return;

                            var trigger = document.getElementById('portfolioTagsTrigger');
                            var dropdown = document.getElementById('portfolioTagsDropdown');
                            var inlineInput = document.getElementById('portfolioTagsInlineInput');
                            var pillsContainer = document.getElementById('portfolioTagsPillsContainer');
                            var countBadge = document.getElementById('portfolioTagsSelectedCountBadge');
                            var hiddenText = document.getElementById('portfolioTagsHiddenText');
                            var clearAllBtn = document.getElementById('portfolioTagsClearAllBtn');
                            var arrowBtn = document.getElementById('portfolioTagsArrowBtn');
                            var arrowIcon = document.getElementById('portfolioTagsArrowIcon');
                            var createOption = document.getElementById('portfolioTagCreateOption');
                            var createNameSpan = document.getElementById('portfolioTagCreateName');
                            var tagsList = document.getElementById('portfolioTagsList');
                            var noMatch = document.getElementById('portfolioTagsNoMatch');

                            function isOpen() { return dropdown.style.display === 'flex'; }

                            function setOpen(open) {
                                if (open) {
                                    dropdown.style.display = 'flex';
                                    trigger.classList.add('is-open');
                                    trigger.setAttribute('aria-expanded', 'true');
                                    if (arrowIcon) arrowIcon.style.transform = 'rotate(180deg)';
                                    filterList(inlineInput.value);
                                } else {
                                    dropdown.style.display = 'none';
                                    trigger.classList.remove('is-open');
                                    trigger.setAttribute('aria-expanded', 'false');
                                    if (arrowIcon) arrowIcon.style.transform = 'rotate(0deg)';
                                    if (createOption) createOption.classList.remove('is-visible');
                                }
                            }

                            function getSelectedTags() {
                                var pills = pillsContainer.querySelectorAll('.blog-tag-pill');
                                var tags = [];
                                pills.forEach(function(pill) {
                                    var val = pill.getAttribute('data-tag');
                                    if (val && tags.indexOf(val) === -1) {
                                        tags.push(val);
                                    }
                                });
                                return tags;
                            }

                            function updateState() {
                                var selected = getSelectedTags();

                                if (countBadge) {
                                    countBadge.textContent = selected.length + ' selected';
                                }

                                if (hiddenText) {
                                    hiddenText.value = selected.join(', ');
                                }

                                if (inlineInput) {
                                    inlineInput.placeholder = selected.length === 0 
                                        ? 'Add or select tag...' 
                                        : '+ Add tag...';
                                }

                                var rows = tagsList.querySelectorAll('.blog-tag-row');
                                rows.forEach(function(row) {
                                    var rowVal = row.getAttribute('data-tag-value') || '';
                                    var isSel = selected.some(function(t) {
                                        return t.toLowerCase() === rowVal.toLowerCase();
                                    });
                                    if (isSel) {
                                        row.classList.add('is-selected');
                                    } else {
                                        row.classList.remove('is-selected');
                                    }
                                });
                            }

                            function addTag(tagName) {
                                var clean = (tagName || '').replace(/,/g, '').trim();
                                if (!clean) return;

                                var current = getSelectedTags();
                                var alreadyHas = current.some(function(t) {
                                    return t.toLowerCase() === clean.toLowerCase();
                                });

                                if (!alreadyHas) {
                                    var pill = document.createElement('span');
                                    pill.className = 'blog-tag-pill';
                                    pill.setAttribute('data-tag', clean);

                                    var textSpan = document.createElement('span');
                                    textSpan.textContent = clean;

                                    var removeBtn = document.createElement('span');
                                    removeBtn.className = 'blog-tag-remove-btn';
                                    removeBtn.setAttribute('data-tag', clean);
                                    removeBtn.innerHTML = '&times;';
                                    removeBtn.title = 'Remove ' + clean;

                                    var hiddenArrInput = document.createElement('input');
                                    hiddenArrInput.type = 'hidden';
                                    hiddenArrInput.name = 'tags[]';
                                    hiddenArrInput.value = clean;

                                    pill.appendChild(textSpan);
                                    pill.appendChild(removeBtn);
                                    pill.appendChild(hiddenArrInput);

                                    pillsContainer.insertBefore(pill, inlineInput);

                                    var existingRow = tagsList.querySelector('.blog-tag-row[data-tag-name="' + clean.toLowerCase() + '"]');
                                    if (!existingRow) {
                                        var newRow = document.createElement('div');
                                        newRow.className = 'blog-tag-row is-selected';
                                        newRow.setAttribute('data-tag-name', clean.toLowerCase());
                                        newRow.setAttribute('data-tag-value', clean);
                                        newRow.innerHTML = `
                                            <div class="blog-tag-checkbox-box">
                                                <svg class="blog-tag-check-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                            </div>
                                            <span class="blog-tag-row-label">${clean}</span>
                                        `;
                                        bindRowClick(newRow);
                                        tagsList.appendChild(newRow);

                                        var emptyDefault = document.getElementById('portfolioTagsEmptyDefault');
                                        if (emptyDefault) emptyDefault.style.display = 'none';
                                    }
                                }

                                inlineInput.value = '';
                                if (createOption) createOption.classList.remove('is-visible');
                                filterList('');
                                updateState();
                                inlineInput.focus();
                            }

                            function removeTag(tagName) {
                                var clean = (tagName || '').toLowerCase();
                                var pills = pillsContainer.querySelectorAll('.blog-tag-pill');
                                pills.forEach(function(pill) {
                                    var val = pill.getAttribute('data-tag') || '';
                                    if (val.toLowerCase() === clean) {
                                        pill.remove();
                                    }
                                });
                                updateState();
                            }

                            function bindRowClick(row) {
                                row.addEventListener('click', function(e) {
                                    var val = row.getAttribute('data-tag-value');
                                    if (!val) return;

                                    var current = getSelectedTags();
                                    var isSelected = current.some(function(t) {
                                        return t.toLowerCase() === val.toLowerCase();
                                    });

                                    if (isSelected) {
                                        removeTag(val);
                                    } else {
                                        addTag(val);
                                    }
                                });
                            }

                            var existingRows = tagsList.querySelectorAll('.blog-tag-row');
                            existingRows.forEach(function(row) {
                                bindRowClick(row);
                            });

                            function filterList(query) {
                                var q = (query || '').trim().toLowerCase();
                                var rows = tagsList.querySelectorAll('.blog-tag-row');
                                var matched = 0;
                                var exactMatch = false;

                                rows.forEach(function(row) {
                                    var name = row.getAttribute('data-tag-name') || '';
                                    if (!q || name.indexOf(q) !== -1) {
                                        row.style.display = 'flex';
                                        matched++;
                                    } else {
                                        row.style.display = 'none';
                                    }
                                    if (name === q) {
                                        exactMatch = true;
                                    }
                                });

                                if (noMatch) {
                                    noMatch.style.display = (matched === 0 && q) ? 'block' : 'none';
                                }

                                if (createOption && createNameSpan) {
                                    if (q.length > 0 && !exactMatch) {
                                        createNameSpan.textContent = query.trim();
                                        createOption.classList.add('is-visible');
                                    } else {
                                        createOption.classList.remove('is-visible');
                                    }
                                }
                            }

                            if (createOption) {
                                createOption.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    e.stopPropagation();
                                    if (inlineInput.value.trim()) {
                                        addTag(inlineInput.value);
                                    }
                                });
                            }

                            if (clearAllBtn) {
                                clearAllBtn.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    e.stopPropagation();
                                    var pills = pillsContainer.querySelectorAll('.blog-tag-pill');
                                    pills.forEach(function(pill) { pill.remove(); });
                                    updateState();
                                    inlineInput.focus();
                                });
                            }

                            inlineInput.addEventListener('input', function() {
                                var val = this.value;
                                if (val.indexOf(',') !== -1) {
                                    var parts = val.split(',');
                                    for (var i = 0; i < parts.length; i++) {
                                        if (parts[i].trim()) {
                                            addTag(parts[i]);
                                        }
                                    }
                                    this.value = '';
                                    return;
                                }

                                if (!isOpen()) {
                                    setOpen(true);
                                }
                                filterList(val);
                            });

                            inlineInput.addEventListener('keydown', function(e) {
                                if (e.key === 'Enter') {
                                    e.preventDefault();
                                    var val = this.value.trim();
                                    if (val) {
                                        addTag(val);
                                    } else if (isOpen()) {
                                        setOpen(false);
                                    }
                                } else if (e.key === 'Backspace' && !this.value) {
                                    var pills = pillsContainer.querySelectorAll('.blog-tag-pill');
                                    if (pills.length > 0) {
                                        var lastPill = pills[pills.length - 1];
                                        lastPill.remove();
                                        updateState();
                                    }
                                } else if (e.key === 'Escape') {
                                    setOpen(false);
                                } else if (e.key === 'ArrowDown') {
                                    if (!isOpen()) {
                                        setOpen(true);
                                    }
                                }
                            });

                            inlineInput.addEventListener('focus', function() {
                                if (!isOpen()) {
                                    setOpen(true);
                                }
                            });

                            trigger.addEventListener('click', function(e) {
                                if (e.target.closest('.blog-tag-remove-btn')) {
                                    var tagToRemove = e.target.closest('.blog-tag-remove-btn').getAttribute('data-tag');
                                    if (tagToRemove) {
                                        removeTag(tagToRemove);
                                    }
                                    e.stopPropagation();
                                    inlineInput.focus();
                                    return;
                                }

                                if (e.target === arrowBtn || arrowBtn.contains(e.target)) {
                                    e.stopPropagation();
                                    setOpen(!isOpen());
                                    return;
                                }

                                if (!isOpen()) {
                                    setOpen(true);
                                }
                                inlineInput.focus();
                            });

                            document.addEventListener('click', function(e) {
                                if (!container.contains(e.target)) {
                                    setOpen(false);
                                }
                            });

                            updateState();
                        }

                        // 3. SETUP IMAGE PREVIEW
                        function setupImagePreview() {
                            var input = document.getElementById('portfolioImageFileInput');
                            var previewCard = document.getElementById('newPortfolioImagePreviewCard');
                            var previewImg = document.getElementById('newPortfolioImagePreviewImg');
                            var nameEl = document.getElementById('newPortfolioImageName');
                            var cancelBtn = document.getElementById('btnCancelNewPortfolioImage');

                            if (!input || !previewCard || !previewImg) return;

                            input.addEventListener('change', function(e) {
                                var file = e.target.files && e.target.files[0];
                                if (file) {
                                    var reader = new FileReader();
                                    reader.onload = function(evt) {
                                        previewImg.src = evt.target.result;
                                        if (nameEl) {
                                            nameEl.textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
                                        }
                                        previewCard.style.display = 'block';
                                    };
                                    reader.readAsDataURL(file);
                                } else {
                                    previewCard.style.display = 'none';
                                }
                            });

                            if (cancelBtn) {
                                cancelBtn.addEventListener('click', function() {
                                    input.value = '';
                                    previewCard.style.display = 'none';
                                });
                            }
                        }

                        if (document.readyState === 'loading') {
                            document.addEventListener('DOMContentLoaded', function() {
                                setupCategory();
                                setupTags();
                                setupImagePreview();
                            });
                        } else {
                            setupCategory();
                            setupTags();
                            setupImagePreview();
                        }
                    })();
                    </script>

                    <label>
                        Publish Date
                        <input
                            class="@error('published_at') is-invalid @enderror"
                            name="published_at"
                            type="date"
                            value="{{ old('published_at', $portfolio->published_at?->format('Y-m-d')) }}"
                        >
                        @error('published_at')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label>
                        Display Order
                        <input
                            class="@error('sort_order') is-invalid @enderror"
                            name="sort_order"
                            type="number"
                            min="0"
                            value="{{ old('sort_order', $portfolio['sort_order']) }}"
                        >
                        @error('sort_order')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
            </div>
        </aside>
    </div>
</form>
