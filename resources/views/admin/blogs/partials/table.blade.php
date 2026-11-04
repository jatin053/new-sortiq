<form id="bulk-action-form" action="{{ route('admin.blogs.bulk-action') }}" method="post">
    @csrf
    <input type="hidden" name="action" id="bulk-action-input" value="">
    <div class="reviews-table-wrap">
        <table class="reviews-table blog-table wp-post-table">
            <thead>
                <tr>
                    <th class="cb-col" style="width: 40px;"><input type="checkbox" id="select-all-posts" title="Select All"></th>
                    <th class="blog-image-column" style="width: 60px;">Image</th>
                    <th class="title-column">Title</th>
                    <th>Category</th>
                    <th style="width: 60px; text-align: center;">SEO</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th class="count-column">Views</th>
                    <th style="width: 170px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($blogs as $index => $blog)
                    <tr id="post-row-{{ $index }}">
                        <td class="cb-col">
                            <input type="checkbox" name="ids[]" value="{{ $blog->id }}" class="post-cb">
                        </td>
                        <td>
                            @if ($blog->image_url)
                                <img class="blog-thumb" src="{{ $blog->image_url }}" alt="{{ $blog['title'] }}">
                            @else
                                <span class="blog-thumb blog-thumb-empty">No Image</span>
                            @endif
                        </td>
                        <td class="blog-title-cell">
                            <a href="{{ route('admin.blogs.edit', $blog['slug']) }}" class="review-title">
                                <strong>{{ $blog['title'] }}</strong>
                                @if($blog['status'] === 'draft')
                                    <span class="post-state">— Draft</span>
                                @endif
                            </a>
                            <div class="row-actions wp-row-actions">
                                <a href="{{ route('admin.blogs.edit', $blog['slug']) }}">Edit</a>
                                <span>|</span>
                                <a href="javascript:void(0)" onclick="toggleQuickEditPost({{ $index }})" class="action-quick-edit">Quick Edit</a>
                                <span>|</span>
                                <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" style="display:inline; margin:0;" onsubmit="return confirm('Are you sure you want to move this post to trash?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-delete-btn" style="background:none; border:none; padding:0; cursor:pointer; color:#dc2626; font-size:12px; font-weight:500;">Trash</button>
                                </form>
                                <span>|</span>
                                <a href="{{ route('frontend.blog.show', $blog['slug']) }}" target="_blank" rel="noopener">View</a>
                            </div>
                        </td>
                        <td>
                            @if($blog['category'])
                                <a href="{{ route('admin.blogs.index', ['category' => $blog['category']]) }}" class="cat-link-badge">
                                    {{ $blog['category'] }}
                                </a>
                            @else
                                <span class="muted-text">Uncategorized</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <span class="wp-seo-indicator dot-green" title="SEO: Good"></span>
                            <span class="wp-seo-indicator dot-grey" title="Readability: OK"></span>
                        </td>
                        <td>
                            <form action="{{ route('admin.blogs.toggle-status', $blog) }}" method="POST" style="display:inline; margin:0;">
                                @csrf
                                <button type="submit"
                                        class="status-pill {{ $blog['status'] === 'published' ? 'status-pill-success' : 'status-pill-muted' }}"
                                        title="Click to toggle status to {{ $blog['status'] === 'published' ? 'Draft' : 'Published' }}"
                                        style="cursor: pointer; border: 1px solid {{ $blog['status'] === 'published' ? 'rgba(22, 163, 74, 0.3)' : 'var(--border)' }}; transition: transform 0.15s ease;">
                                    {{ ucfirst($blog['status']) }}
                                    <span style="font-size: 8px; margin-left: 3px; opacity: 0.8;">⇄</span>
                                </button>
                            </form>
                        </td>
                        <td class="date-cell">
                            <span class="date-label">{{ $blog->published_at ? $blog->published_at->format('Y/m/d') : 'Unpublished' }}</span>
                            <br><small class="muted-text">{{ ucfirst($blog['status']) }}</small>
                        </td>
                        <td class="count-column"><strong>{{ $blog['views'] }}</strong></td>
                        <td style="text-align: right; white-space: nowrap;">
                            <div style="display: inline-flex; align-items: center; justify-content: flex-end; gap: 5px;">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.blogs.edit', $blog['slug']) }}"
                                   title="Edit blog post"
                                   style="display: inline-flex; align-items: center; gap: 4px; padding: 5px 9px; font-size: 11px; font-weight: 700; border-radius: 4px; background: #eff6ff; color: #2563eb; border: 1px solid rgba(37, 99, 235, 0.25); text-decoration: none;">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    Edit
                                </a>

                                <!-- Quick Toggle Status Button -->
                                <form action="{{ route('admin.blogs.toggle-status', $blog) }}" method="POST" style="margin: 0; display: inline;">
                                    @csrf
                                    @if ($blog['status'] === 'published')
                                        <button type="submit"
                                                title="Unpublish post (Switch to Draft)"
                                                style="display: inline-flex; align-items: center; gap: 3px; padding: 5px 8px; font-size: 11px; font-weight: 700; border-radius: 4px; background: #fffbeb; color: #d97706; border: 1px solid rgba(217, 119, 6, 0.25); cursor: pointer;">
                                            Draft
                                        </button>
                                    @else
                                        <button type="submit"
                                                title="Publish post now"
                                                style="display: inline-flex; align-items: center; gap: 3px; padding: 5px 8px; font-size: 11px; font-weight: 700; border-radius: 4px; background: #f0fdf4; color: #16a34a; border: 1px solid rgba(22, 163, 74, 0.25); cursor: pointer;">
                                            Publish
                                        </button>
                                    @endif
                                </form>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" style="margin: 0; display: inline;" onsubmit="return confirm('Are you sure you want to delete \'{{ addslashes($blog->title) }}\'?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            title="Delete blog post"
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
                    <tr id="quick-edit-post-row-{{ $index }}" class="quick-edit-row" style="display: none;">
                        <td colspan="9">
                            <div class="quick-edit-form wp-quick-edit-container">
                                <h4 class="quick-edit-heading">Quick Edit Post</h4>
                                <div class="quick-edit-fields">
                                    <label>Title
                                        <input type="text" id="qe-title-{{ $index }}" value="{{ $blog->title }}" readonly>
                                    </label>
                                    <label>Slug
                                        <input type="text" id="qe-slug-{{ $index }}" value="{{ $blog->slug }}" readonly>
                                    </label>
                                    <label>Category
                                        <input type="text" id="qe-cat-{{ $index }}" value="{{ $blog->category }}" readonly>
                                    </label>
                                    <label>Status
                                        <input type="text" value="{{ ucfirst($blog->status) }}" readonly>
                                    </label>
                                </div>
                                <div class="quick-edit-buttons">
                                    <button type="button" class="secondary-btn" onclick="toggleQuickEditPost({{ $index }})">Close</button>
                                    <a href="{{ route('admin.blogs.edit', $blog['slug']) }}" class="primary-btn">Full Edit Page</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="empty-state-cell">No blog posts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</form>

<script>
    document.getElementById('select-all-posts')?.addEventListener('change', function(e) {
        const checkboxes = document.querySelectorAll('.post-cb');
        checkboxes.forEach(cb => cb.checked = e.target.checked);
    });

    function applyBulkAction(url) {
        const action = document.getElementById('bulk-action-select').value;
        const checked = document.querySelectorAll('.post-cb:checked');

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

    function toggleQuickEditPost(index) {
        const row = document.getElementById('quick-edit-post-row-' + index);
        if (row.style.display === 'none' || row.style.display === '') {
            row.style.display = 'table-row';
        } else {
            row.style.display = 'none';
        }
    }
</script>
