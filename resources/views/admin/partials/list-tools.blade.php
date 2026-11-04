@php
    $tabs = $tabs ?? [];
    $hiddenFields = $hiddenFields ?? [];
    $searchAction = $searchAction ?? url()->current();
    $searchValue = $searchValue ?? '';
    $searchAriaLabel = $searchAriaLabel ?? 'Search records';
    $searchPlaceholder = $searchPlaceholder ?? 'Search';
    $categories = $categories ?? [];
    $tagsList = $tagsList ?? [];
    $dateOptions = $dateOptions ?? [];
    $activeCategory = $activeCategory ?? null;
    $activeTag = $activeTag ?? null;
    $activeDate = $activeDate ?? null;
    $bulkActionUrl = $bulkActionUrl ?? null;
    $totalItems = $totalItems ?? null;
@endphp

<div class="wp-list-tools-container">
    @if (! empty($tabs))
        <div class="wp-subsubsub">
            @foreach ($tabs as $index => $tab)
                <a href="{{ $tab['url'] ?? '#' }}" class="{{ ! empty($tab['active']) ? 'current' : '' }}">
                    {{ $tab['label'] }}
                    @if (array_key_exists('count', $tab))
                        <span class="count">({{ $tab['count'] }})</span>
                    @endif
                </a>
                @if(!$loop->last)
                    <span class="separator">|</span>
                @endif
            @endforeach
        </div>
    @endif

    <div class="wp-tablenav top">
        @if($bulkActionUrl)
            <div class="alignleft actions bulkactions">
                <select name="action" id="bulk-action-select">
                    <option value="">Bulk actions</option>
                    <option value="published">Mark Published</option>
                    <option value="draft">Mark Draft</option>
                    <option value="delete">Delete Permanently</option>
                </select>
                <button type="button" class="button action secondary-btn" id="doaction" onclick="applyBulkAction('{{ $bulkActionUrl }}')">Apply</button>
            </div>
        @endif

        <form action="{{ $searchAction }}" method="get" class="wp-filter-form alignleft actions">
            @if(filled($searchValue))
                <input type="hidden" name="search" value="{{ $searchValue }}">
            @endif

            @if(!empty($dateOptions))
                <select name="date" class="wp-select-filter">
                    <option value="">All dates</option>
                    @foreach($dateOptions as $val => $label)
                        <option value="{{ $val }}" {{ $activeDate === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            @endif

            @if(!empty($categories))
                <select name="category" class="wp-select-filter">
                    <option value="">Show All Categories</option>
                    @foreach($categories as $cat)
                        @php
                            $catVal = $cat['slug'] ?? $cat['name'];
                            $isSelected = ($activeCategory === $catVal || $activeCategory === $cat['name']);
                        @endphp
                        <option value="{{ $catVal }}" {{ $isSelected ? 'selected' : '' }}>
                            {{ $cat['name'] }}
                        </option>
                    @endforeach
                </select>
            @endif

            @if(!empty($tagsList))
                <select name="tag" class="wp-select-filter">
                    <option value="">Show All Tags</option>
                    @foreach($tagsList as $tagItem)
                        @php
                            $tagVal = is_array($tagItem) ? ($tagItem['name'] ?? '') : $tagItem;
                            $isSelected = ($activeTag === $tagVal);
                        @endphp
                        <option value="{{ $tagVal }}" {{ $isSelected ? 'selected' : '' }}>
                            {{ $tagVal }}
                        </option>
                    @endforeach
                </select>
            @endif

            <button type="submit" class="button secondary-btn">Filter</button>
        </form>

        <form class="search-box alignright" action="{{ $searchAction }}" method="get">
            @foreach ($hiddenFields as $name => $value)
                @if (filled($value))
                    <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                @endif
            @endforeach

            <input
                type="search"
                name="search"
                value="{{ $searchValue }}"
                aria-label="{{ $searchAriaLabel }}"
                placeholder="{{ $searchPlaceholder }}"
            >
            <button type="submit" class="secondary-btn">Search</button>
            @if($totalItems !== null)
                <span class="wp-items-count-badge">{{ $totalItems }} {{ \Illuminate\Support\Str::plural('item', $totalItems) }}</span>
            @endif
        </form>
    </div>
</div>
    