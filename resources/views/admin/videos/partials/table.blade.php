<form id="bulk-action-form" action="{{ route('admin.videos.bulk-action') }}" method="post">
    @csrf
    <input type="hidden" name="action" id="bulk-action-input" value="">
    <div class="reviews-table-wrap">
        <table class="reviews-table videos-table">
            <thead>
                <tr>
                    <th class="cb-col" style="width: 38px; text-align: center;"><input type="checkbox" id="select-all-videos" title="Select All"></th>
                    <th class="video-thumb-column" style="width: 100px;">Preview</th>
                    <th class="title-column">Title</th>
                    <th style="width: 130px;">Published</th>
                    <th style="width: 110px; text-align: center;">Status</th>
                    <th class="count-column" style="width: 60px;">Order</th>
                    <th class="count-column" style="width: 60px;">Views</th>
                    <th style="width: 190px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($videos as $video)
                    <tr>
                        <td class="cb-col" style="text-align: center;">
                            <input type="checkbox" name="ids[]" value="{{ $video->id }}" class="video-cb">
                        </td>
                        <td>
                            <div class="video-admin-thumb">
                                @if ($video->thumbnail_url)
                                    <img src="{{ $video->thumbnail_url }}" alt="{{ $video['title'] }}">
                                @else
                                    <span>No Preview</span>
                                @endif
                            </div>
                        </td>
                        <td class="review-title-cell">
                            <a href="{{ route('admin.videos.edit', $video['slug']) }}" class="review-title">
                                <strong>{{ $video['title'] }}</strong>
                            </a>
                            <div class="row-actions">
                                <a href="{{ route('admin.videos.edit', $video['slug']) }}" style="color: #2563eb;">Edit</a>
                                <span>|</span>
                                <form action="{{ route('admin.videos.toggle-status', $video) }}" method="POST" style="display:inline; margin:0;">
                                    @csrf
                                    <button type="submit" style="background:none; border:none; padding:0; font-size:inherit; font-family:inherit; cursor:pointer; color: {{ $video['status'] === 'published' ? '#d97706' : '#16a34a' }}; font-weight:700;">
                                        {{ $video['status'] === 'published' ? 'Switch to Draft' : 'Publish' }}
                                    </button>
                                </form>
                                <span>|</span>
                                <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" style="display:inline; margin:0;" onsubmit="return confirm('Are you sure you want to delete this video?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:none; border:none; padding:0; font-size:inherit; font-family:inherit; cursor:pointer; color: #dc2626; font-weight:700;">
                                        Delete
                                    </button>
                                </form>
                                <span>|</span>
                                <a href="{{ url('videos#' . $video['slug']) }}" target="_blank" rel="noopener" style="color: #16a34a;">View</a>
                            </div>
                        </td>
                        <td>{{ $video['published_label'] }}</td>
                        <td style="text-align: center;">
                            <form action="{{ route('admin.videos.toggle-status', $video) }}" method="POST" style="display:inline; margin:0;">
                                @csrf
                                <button type="submit"
                                        class="status-pill {{ $video['status'] === 'published' ? 'status-pill-success' : 'status-pill-muted' }}"
                                        title="Click to toggle status to {{ $video['status'] === 'published' ? 'Draft' : 'Published' }}"
                                        style="cursor: pointer; border: 1px solid {{ $video['status'] === 'published' ? 'rgba(22, 163, 74, 0.3)' : 'var(--border)' }}; transition: transform 0.15s ease;">
                                    {{ ucfirst($video['status']) }}
                                    <span style="font-size: 8px; margin-left: 3px; opacity: 0.8;">⇄</span>
                                </button>
                            </form>
                        </td>
                        <td class="count-column">{{ $video['sort_order'] }}</td>
                        <td class="count-column">{{ $video['views'] }}</td>
                        <td style="text-align: right; white-space: nowrap;">
                            <div style="display: inline-flex; align-items: center; justify-content: flex-end; gap: 5px;">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.videos.edit', $video['slug']) }}"
                                   title="Edit video"
                                   style="display: inline-flex; align-items: center; gap: 3px; padding: 4px 8px; font-size: 11px; font-weight: 700; border-radius: 4px; background: #eff6ff; color: #2563eb; border: 1px solid rgba(37, 99, 235, 0.25); text-decoration: none;">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    Edit
                                </a>

                                <!-- Quick Toggle Status Button -->
                                <form action="{{ route('admin.videos.toggle-status', $video) }}" method="POST" style="margin: 0; display: inline;">
                                    @csrf
                                    @if ($video['status'] === 'published')
                                        <button type="submit"
                                                title="Unpublish video (Switch to Draft)"
                                                style="display: inline-flex; align-items: center; gap: 3px; padding: 4px 8px; font-size: 11px; font-weight: 700; border-radius: 4px; background: #fffbeb; color: #d97706; border: 1px solid rgba(217, 119, 6, 0.25); cursor: pointer;">
                                            Draft
                                        </button>
                                    @else
                                        <button type="submit"
                                                title="Publish video now"
                                                style="display: inline-flex; align-items: center; gap: 3px; padding: 4px 8px; font-size: 11px; font-weight: 700; border-radius: 4px; background: #f0fdf4; color: #16a34a; border: 1px solid rgba(22, 163, 74, 0.25); cursor: pointer;">
                                            Publish
                                        </button>
                                    @endif
                                </form>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" style="margin: 0; display: inline;" onsubmit="return confirm('Are you sure you want to permanently delete &quot;{{ addslashes($video['title']) }}&quot;?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            title="Delete video"
                                            style="display: inline-flex; align-items: center; gap: 3px; padding: 4px 7px; font-size: 11px; font-weight: 700; border-radius: 4px; background: #fef2f2; color: #dc2626; border: 1px solid rgba(220, 38, 38, 0.25); cursor: pointer;">
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
                @empty
                    <tr>
                        <td colspan="8" class="empty-state-cell">No videos found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</form>

<script>
    document.getElementById('select-all-videos')?.addEventListener('change', function(e) {
        const checkboxes = document.querySelectorAll('.video-cb');
        checkboxes.forEach(cb => cb.checked = e.target.checked);
    });

    function applyBulkAction(url) {
        const action = document.getElementById('bulk-action-select')?.value;
        const checked = document.querySelectorAll('.video-cb:checked');

        if (!action) {
            alert('Please select a bulk action from the dropdown.');
            return;
        }

        if (checked.length === 0) {
            alert('Please select at least one video using the checkboxes.');
            return;
        }

        if (action === 'delete' && !confirm('Are you sure you want to permanently delete the selected video(s)? This cannot be undone.')) {
            return;
        }

        const form = document.getElementById('bulk-action-form');
        form.action = url;
        document.getElementById('bulk-action-input').value = action;
        form.submit();
    }
</script>
