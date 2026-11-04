<form id="bulk-action-form" action="{{ route('admin.portfolios.bulk-action') }}" method="post">
    @csrf
    <input type="hidden" name="action" id="bulk-action-input" value="">
    <div class="reviews-table-wrap">
        <table class="reviews-table blog-table wp-post-table">
            <thead>
                <tr>
                    <th class="cb-col" style="width: 40px;"><input type="checkbox" id="select-all-portfolios" title="Select All"></th>
                    <th class="blog-image-column" style="width: 60px;">Image</th>
                    <th class="title-column">Project</th>
                    <th>Category</th>
                    <th style="width: 60px; text-align: center;">SEO</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th class="count-column">Order</th>
                    <th style="width: 170px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($portfolios as $index => $portfolio)
                    <tr id="portfolio-row-{{ $index }}">
                        <td class="cb-col">
                            <input type="checkbox" name="ids[]" value="{{ $portfolio->id }}" class="portfolio-cb">
                        </td>
                        <td>
                            @if ($portfolio->image_url)
                                <img class="blog-thumb" src="{{ $portfolio->image_url }}" alt="{{ $portfolio['title'] }}">
                            @else
                                <span class="blog-thumb blog-thumb-empty">No Image</span>
                            @endif
                        </td>
                        <td class="blog-title-cell">
                            <a href="{{ route('admin.portfolios.edit', $portfolio) }}" class="review-title">
                                <strong>{{ $portfolio['title'] }}</strong>
                                @if($portfolio['status'] === 'draft')
                                    <span class="post-state">— Draft</span>
                                @endif
                            </a>
                            <div class="row-actions wp-row-actions">
                                <a href="{{ route('admin.portfolios.edit', $portfolio) }}">Edit</a>
                                <span>|</span>
                                <a href="javascript:void(0)" onclick="toggleQuickEditPortfolio({{ $index }})" class="action-quick-edit">Quick Edit</a>
                                <span>|</span>
                                <form action="{{ route('admin.portfolios.destroy', $portfolio) }}" method="POST" style="display:inline; margin:0;" onsubmit="return confirm('Are you sure you want to move this project to trash?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-delete-btn" style="background:none; border:none; padding:0; cursor:pointer; color:#dc2626; font-size:12px; font-weight:500;">Trash</button>
                                </form>
                                <span>|</span>
                                <a href="{{ url('portfolio#' . $portfolio['slug']) }}" target="_blank" rel="noopener">View</a>
                                @if ($portfolio->website_href)
                                    <span>|</span>
                                    <a href="{{ $portfolio->website_href }}" target="_blank" rel="noopener">Site</a>
                                @endif
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('admin.portfolios.index', ['category' => $portfolio['category_slug']]) }}" class="cat-link-badge">
                                {{ $portfolio['category_name'] }}
                            </a>
                        </td>
                        <td style="text-align: center;">
                            <span class="wp-seo-indicator dot-green" title="SEO: Good"></span>
                            <span class="wp-seo-indicator dot-grey" title="Readability: OK"></span>
                        </td>
                        <td>
                            <form action="{{ route('admin.portfolios.toggle-status', $portfolio) }}" method="POST" style="display:inline; margin:0;">
                                @csrf
                                <button type="submit"
                                        class="status-pill {{ $portfolio['status'] === 'published' ? 'status-pill-success' : 'status-pill-muted' }}"
                                        title="Click to toggle status to {{ $portfolio['status'] === 'published' ? 'Draft' : 'Published' }}"
                                        style="cursor: pointer; border: 1px solid {{ $portfolio['status'] === 'published' ? 'rgba(22, 163, 74, 0.3)' : 'var(--border)' }}; transition: transform 0.15s ease;">
                                    {{ ucfirst($portfolio['status']) }}
                                    <span style="font-size: 8px; margin-left: 3px; opacity: 0.8;">⇄</span>
                                </button>
                            </form>
                        </td>
                        <td class="date-cell">
                            <span class="date-label">{{ $portfolio->published_at ? $portfolio->published_at->format('Y/m/d') : 'Unpublished' }}</span>
                            <br><small class="muted-text">{{ ucfirst($portfolio['status']) }}</small>
                        </td>
                        <td class="count-column"><strong>{{ $portfolio['sort_order'] }}</strong></td>
                        <td style="text-align: right; white-space: nowrap;">
                            <div style="display: inline-flex; align-items: center; justify-content: flex-end; gap: 5px;">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.portfolios.edit', $portfolio) }}"
                                   title="Edit portfolio project"
                                   style="display: inline-flex; align-items: center; gap: 4px; padding: 5px 9px; font-size: 11px; font-weight: 700; border-radius: 4px; background: #eff6ff; color: #2563eb; border: 1px solid rgba(37, 99, 235, 0.25); text-decoration: none;">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    Edit
                                </a>

                                <!-- Quick Toggle Status Button -->
                                <form action="{{ route('admin.portfolios.toggle-status', $portfolio) }}" method="POST" style="margin: 0; display: inline;">
                                    @csrf
                                    @if ($portfolio['status'] === 'published')
                                        <button type="submit"
                                                title="Unpublish project (Switch to Draft)"
                                                style="display: inline-flex; align-items: center; gap: 3px; padding: 5px 8px; font-size: 11px; font-weight: 700; border-radius: 4px; background: #fffbeb; color: #d97706; border: 1px solid rgba(217, 119, 6, 0.25); cursor: pointer;">
                                            Draft
                                        </button>
                                    @else
                                        <button type="submit"
                                                title="Publish project now"
                                                style="display: inline-flex; align-items: center; gap: 3px; padding: 5px 8px; font-size: 11px; font-weight: 700; border-radius: 4px; background: #f0fdf4; color: #16a34a; border: 1px solid rgba(22, 163, 74, 0.25); cursor: pointer;">
                                            Publish
                                        </button>
                                    @endif
                                </form>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.portfolios.destroy', $portfolio) }}" method="POST" style="margin: 0; display: inline;" onsubmit="return confirm('Are you sure you want to delete \'{{ addslashes($portfolio->title) }}\'?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            title="Delete portfolio project"
                                            style="display: inline-flex; align-items: center; gap: 4px; padding: 5px 9px; font-size: 11px; font-weight: 700; border-radius: 4px; background: #fef2f2; color: #dc2626; border: 1px solid rgba(220, 38, 38, 0.25); cursor: pointer;">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Quick Edit Row -->
                    <tr id="quick-edit-portfolio-row-{{ $index }}" class="quick-edit-row" style="display: none;">
                        <td colspan="9">
                            <div class="quick-edit-form wp-quick-edit-container">
                                <h4 class="quick-edit-heading">Quick Edit Project</h4>
                                <div class="quick-edit-fields">
                                    <label>Title
                                        <input type="text" value="{{ $portfolio->title }}" readonly>
                                    </label>
                                    <label>Slug
                                        <input type="text" value="{{ $portfolio->slug }}" readonly>
                                    </label>
                                    <label>Category
                                        <input type="text" value="{{ $portfolio->category_name }}" readonly>
                                    </label>
                                    <label>Status
                                        <input type="text" value="{{ ucfirst($portfolio->status) }}" readonly>
                                    </label>
                                </div>
                                <div class="quick-edit-buttons">
                                    <button type="button" class="secondary-btn" onclick="toggleQuickEditPortfolio({{ $index }})">Close</button>
                                    <a href="{{ route('admin.portfolios.edit', $portfolio) }}" class="primary-btn">Full Edit Page</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="empty-state-cell">No portfolio projects found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</form>

<script>
    document.getElementById('select-all-portfolios')?.addEventListener('change', function(e) {
        const checkboxes = document.querySelectorAll('.portfolio-cb');
        checkboxes.forEach(cb => cb.checked = e.target.checked);
    });

    function applyBulkAction(url) {
        const action = document.getElementById('bulk-action-select').value;
        const checked = document.querySelectorAll('.portfolio-cb:checked');

        if (!action) {
            alert('Please select a bulk action.');
            return;
        }

        if (checked.length === 0) {
            alert('Please select at least one item.');
            return;
        }

        if (action === 'delete' && !confirm('Are you sure you want to delete the selected items?')) {
            return;
        }

        const form = document.getElementById('bulk-action-form');
        form.action = url;
        document.getElementById('bulk-action-input').value = action;
        form.submit();
    }

    function toggleQuickEditPortfolio(index) {
        const row = document.getElementById('quick-edit-portfolio-row-' + index);
        if (row.style.display === 'none' || row.style.display === '') {
            row.style.display = 'table-row';
        } else {
            row.style.display = 'none';
        }
    }
</script>
