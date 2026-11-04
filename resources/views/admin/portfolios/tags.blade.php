    @extends('admin.layouts.app')

@section('title', 'Portfolio Tags')

@section('content')
    @include('admin.partials.page-hero', [
        'kicker' => 'Portfolio',
        'title' => 'Portfolio Tags',
        'description' => 'Manage portfolio tags, slugs, and descriptions in WordPress style.',
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
        <!-- Left Column: Add New Tag Form -->
        <div class="wp-category-form-col">
            <div class="settings-panel">
                <div class="settings-panel-header">
                    <h2>Add New Tag</h2>
                </div>
                <div class="settings-panel-body">
                    <form action="{{ route('admin.portfolios.tags.store') }}" method="post" class="wp-admin-form">
                        @csrf
                        <div class="settings-field">
                            <label for="tag-name"><strong>Name</strong></label>
                            <input type="text" id="tag-name" name="name" value="{{ old('name') }}" placeholder="Tag name" required>
                            <span class="field-help">The name is how it appears on your site.</span>
                            @error('name')<span class="field-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="settings-field">
                            <label for="tag-slug"><strong>Slug</strong></label>
                            <input type="text" id="tag-slug" name="slug" value="{{ old('slug') }}" placeholder="tag-slug">
                            <span class="field-help">The "slug" is the URL-friendly version of the name.</span>
                            @error('slug')<span class="field-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="settings-field">
                            <label for="tag-description"><strong>Description</strong></label>
                            <textarea id="tag-description" name="description" rows="5" placeholder="Description...">{{ old('description') }}</textarea>
                            <span class="field-help">The description is optional. Some themes may display it.</span>
                            @error('description')<span class="field-error">{{ $message }}</span>@enderror
                        </div>

                        <button class="primary-btn" type="submit" style="margin-top: 8px;">Add New Tag</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column: Tags Table -->
        <div class="wp-category-table-col">
            <div class="wp-table-header-tools">
                <form action="{{ route('admin.portfolios.tags') }}" method="get" class="wp-search-box">
                    <input type="search" name="search" value="{{ $searchTerm ?? '' }}" placeholder="Search Tags" aria-label="Search Tags">
                    <button type="submit" class="secondary-btn">Search Tags</button>
                </form>
                <div class="wp-items-count">{{ $totalCount ?? count($tags) }} {{ \Illuminate\Support\Str::plural('item', $totalCount ?? count($tags)) }}</div>
            </div>

            <div class="reviews-table-wrap">
                <table class="reviews-table wp-category-table">
                    <thead>
                        <tr>
                            <th class="cb-col" style="width: 40px;"><input type="checkbox" id="select-all-tags"></th>
                            <th class="sortable">Name <span class="sort-icon">▲</span></th>
                            <th>Description</th>
                            <th class="sortable">Slug <span class="sort-icon">▲</span></th>
                            <th class="sortable count-column">Count <span class="sort-icon">▲</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tags as $index => $tag)
                            <tr id="tag-row-{{ $index }}" class="cat-row">
                                <td class="cb-col"><input type="checkbox" name="tag_ids[]" value="{{ $tag['name'] }}"></td>
                                <td class="cat-name-cell">
                                    <a href="{{ route('admin.portfolios.index', ['tag' => $tag['name']]) }}" class="cat-title-link">
                                        #{{ $tag['name'] }}
                                    </a>
                                    <div class="row-actions wp-row-actions">
                                        <a href="javascript:void(0)" onclick="toggleQuickEditTag({{ $index }})" class="action-quick-edit">Quick Edit</a>
                                        @if(!empty($tag['is_custom']))
                                            <span>|</span>
                                            <form action="{{ route('admin.portfolios.tags.destroy') }}" method="post" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this tag?');">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="name" value="{{ $tag['name'] }}">
                                                <button type="submit" class="action-delete-btn">Delete</button>
                                            </form>
                                        @endif
                                        <span>|</span>
                                        <a href="{{ route('admin.portfolios.index', ['tag' => $tag['name']]) }}">View</a>
                                    </div>
                                </td>
                                <td class="cat-desc-cell">{{ $tag['description'] ?? '—' }}</td>
                                <td class="cat-slug-cell"><code>{{ $tag['slug'] }}</code></td>
                                <td class="count-column">
                                    <a href="{{ route('admin.portfolios.index', ['tag' => $tag['name']]) }}" class="count-link">{{ $tag['count'] }}</a>
                                </td>
                            </tr>

                            <!-- Quick Edit Row -->
                            <tr id="quick-edit-tag-row-{{ $index }}" class="quick-edit-row" style="display: none;">
                                <td colspan="5">
                                    <form action="{{ route('admin.portfolios.tags.update') }}" method="post" class="quick-edit-form">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="original_name" value="{{ $tag['name'] }}">
                                        <h4 class="quick-edit-heading">Quick Edit Tag</h4>
                                        <div class="quick-edit-fields">
                                            <label>Name
                                                <input type="text" name="name" value="{{ $tag['name'] }}" required>
                                            </label>
                                            <label>Slug
                                                <input type="text" name="slug" value="{{ $tag['slug'] }}">
                                            </label>
                                            <label class="full-width">Description
                                                <input type="text" name="description" value="{{ $tag['description'] !== '—' ? $tag['description'] : '' }}">
                                            </label>
                                        </div>
                                        <div class="quick-edit-buttons">
                                            <button type="button" class="secondary-btn" onclick="toggleQuickEditTag({{ $index }})">Cancel</button>
                                            <button type="submit" class="primary-btn">Update Tag</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-state-cell">No tags found. Add tags using the form on the left.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function toggleQuickEditTag(index) {
            const row = document.getElementById('quick-edit-tag-row-' + index);
            if (row.style.display === 'none' || row.style.display === '') {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        }

        document.getElementById('select-all-tags')?.addEventListener('change', function(e) {
            const checkboxes = document.querySelectorAll('input[name="tag_ids[]"]');
            checkboxes.forEach(cb => cb.checked = e.target.checked);
        });
    </script>
@endsection
