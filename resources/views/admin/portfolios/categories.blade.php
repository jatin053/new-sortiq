@extends('admin.layouts.app')

@section('title', 'Portfolio Categories')

@section('content')
    @include('admin.partials.page-hero', [
        'kicker' => 'Portfolio',
        'title' => 'Categories',
        'description' => 'Manage portfolio categories, slugs, and descriptions in WordPress style.',
        'actions' => [[
            'label' => 'Add Portfolio Project',
            'url' => route('admin.portfolios.create'),
            'class' => 'primary-btn',
        ]],
    ])

    @if (session('status'))
        <div class="success-box" style="margin-bottom: 20px;">{{ session('status') }}</div>
    @endif

    <div class="wp-category-layout">
        <!-- Left Column: Add New Category Form -->
        <div class="wp-category-form-col">
            <div class="settings-panel">
                <div class="settings-panel-header">
                    <h2>Add New Category</h2>
                </div>
                <div class="settings-panel-body">
                    <form action="{{ route('admin.portfolios.categories.store') }}" method="post" class="wp-admin-form">
                        @csrf
                        <div class="settings-field">
                            <label for="cat-name"><strong>Name</strong></label>
                            <input type="text" id="cat-name" name="name" value="{{ old('name') }}" placeholder="Category name" required>
                            <span class="field-help">The name is how it appears on your site.</span>
                            @error('name')<span class="field-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="settings-field">
                            <label for="cat-slug"><strong>Slug</strong></label>
                            <input type="text" id="cat-slug" name="slug" value="{{ old('slug') }}" placeholder="category-slug">
                            <span class="field-help">The "slug" is the URL-friendly version of the name.</span>
                            @error('slug')<span class="field-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="settings-field">
                            <label for="cat-description"><strong>Description</strong></label>
                            <textarea id="cat-description" name="description" rows="5" placeholder="Description...">{{ old('description') }}</textarea>
                            <span class="field-help">The description is optional. Some themes may display it.</span>
                            @error('description')<span class="field-error">{{ $message }}</span>@enderror
                        </div>

                        <button class="primary-btn" type="submit" style="margin-top: 8px;">Add New Category</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column: Categories Table -->
        <div class="wp-category-table-col">
            <div class="wp-table-header-tools">
                <form action="{{ route('admin.portfolios.categories') }}" method="get" class="wp-search-box">
                    <input type="search" name="search" value="{{ $searchTerm ?? '' }}" placeholder="Search Categories" aria-label="Search Categories">
                    <button type="submit" class="secondary-btn">Search Categories</button>
                </form>
                <div class="wp-items-count">{{ $totalCount ?? count($categories) }} {{ \Illuminate\Support\Str::plural('item', $totalCount ?? count($categories)) }}</div>
            </div>

            <div class="reviews-table-wrap">
                <table class="reviews-table wp-category-table">
                    <thead>
                        <tr>
                            <th class="cb-col" style="width: 40px;"><input type="checkbox" id="select-all-cats"></th>
                            <th class="sortable">Name <span class="sort-icon">▲</span></th>
                            <th>Description</th>
                            <th style="width: 60px; text-align: center;">SEO</th>
                            <th class="sortable">Slug <span class="sort-icon">▲</span></th>
                            <th class="sortable count-column">Count <span class="sort-icon">▲</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $index => $cat)
                            <tr id="cat-row-{{ $index }}" class="cat-row">
                                <td class="cb-col"><input type="checkbox" name="cat_ids[]" value="{{ $cat['name'] }}"></td>
                                <td class="cat-name-cell">
                                    <a href="{{ route('admin.portfolios.index', ['category' => $cat['slug']]) }}" class="cat-title-link">
                                        {{ $cat['name'] }}
                                    </a>
                                    <div class="row-actions wp-row-actions">
                                        <a href="javascript:void(0)" onclick="toggleQuickEdit({{ $index }})" class="action-quick-edit">Quick Edit</a>
                                        @if(!empty($cat['is_custom']))
                                            <span>|</span>
                                            <form action="{{ route('admin.portfolios.categories.destroy') }}" method="post" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="name" value="{{ $cat['name'] }}">
                                                <button type="submit" class="action-delete-btn">Delete</button>
                                            </form>
                                        @endif
                                        <span>|</span>
                                        <a href="{{ route('admin.portfolios.index', ['category' => $cat['slug']]) }}">View</a>
                                    </div>
                                </td>
                                <td class="cat-desc-cell">{{ $cat['description'] ?? '—' }}</td>
                                <td class="seo-col" style="text-align: center;">
                                    <span class="wp-seo-indicator dot-green" title="SEO: Good"></span>
                                    <span class="wp-seo-indicator dot-grey" title="Readability: OK"></span>
                                </td>
                                <td class="cat-slug-cell"><code>{{ $cat['slug'] }}</code></td>
                                <td class="count-column">
                                    <a href="{{ route('admin.portfolios.index', ['category' => $cat['slug']]) }}" class="count-link">{{ $cat['count'] }}</a>
                                </td>
                            </tr>

                            <!-- Quick Edit Row -->
                            <tr id="quick-edit-row-{{ $index }}" class="quick-edit-row" style="display: none;">
                                <td colspan="6">
                                    <form action="{{ route('admin.portfolios.categories.update') }}" method="post" class="quick-edit-form">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="original_name" value="{{ $cat['name'] }}">
                                        <h4 class="quick-edit-heading">Quick Edit Category</h4>
                                        <div class="quick-edit-fields">
                                            <label>Name
                                                <input type="text" name="name" value="{{ $cat['name'] }}" required>
                                            </label>
                                            <label>Slug
                                                <input type="text" name="slug" value="{{ $cat['slug'] }}">
                                            </label>
                                            <label class="full-width">Description
                                                <input type="text" name="description" value="{{ $cat['description'] !== '—' ? $cat['description'] : '' }}">
                                            </label>
                                        </div>
                                        <div class="quick-edit-buttons">
                                            <button type="button" class="secondary-btn" onclick="toggleQuickEdit({{ $index }})">Cancel</button>
                                            <button type="submit" class="primary-btn">Update Category</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-state-cell">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function toggleQuickEdit(index) {
            const row = document.getElementById('quick-edit-row-' + index);
            if (row.style.display === 'none' || row.style.display === '') {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        }

        document.getElementById('select-all-cats')?.addEventListener('change', function(e) {
            const checkboxes = document.querySelectorAll('input[name="cat_ids[]"]');
            checkboxes.forEach(cb => cb.checked = e.target.checked);
        });
    </script>
@endsection
