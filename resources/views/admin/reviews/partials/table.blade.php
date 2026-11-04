<div class="reviews-table-wrap">
    <table class="reviews-table">
        <thead>
            <tr>
                <th class="title-column">Customer</th>
                <th>Platform</th>
                <th>Rating</th>
                <th>Status</th>
                <th>Published</th>
                <th class="count-column">Views</th>
                <th style="width: 170px; text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reviews as $review)
                <tr>
                    <td class="review-title-cell">
                        <a href="{{ route('admin.reviews.show', $review) }}" class="review-title">
                            {{ $review->name }}
                        </a>
                        <div class="row-actions">
                            <a href="{{ route('admin.reviews.edit', $review) }}">Edit</a>
                            <span>|</span>
                            <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" style="display:inline; margin:0;" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-delete-btn" style="background:none; border:none; padding:0; cursor:pointer; color:#dc2626; font-size:12px; font-weight:500;">Delete</button>
                            </form>
                            <span>|</span>
                            <a href="{{ route('frontend.reviews.show', $review) }}" target="_blank" rel="noopener">View</a>
                        </div>
                    </td>
                    <td>{{ $review->platform }}</td>
                    <td>
                        <span class="stars" aria-label="{{ $review->rating }} star rating">
                            @for ($star = 0; $star < $review->rating; $star++)
                                &#9733;
                            @endfor
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.reviews.toggle-status', $review) }}" method="POST" style="display:inline; margin:0;">
                            @csrf
                            <button type="submit"
                                    class="status-pill {{ $review->status === 'published' ? 'status-pill-success' : 'status-pill-muted' }}"
                                    title="Click to toggle status to {{ $review->status === 'published' ? 'Draft' : 'Published' }}"
                                    style="cursor: pointer; border: 1px solid {{ $review->status === 'published' ? 'rgba(22, 163, 74, 0.3)' : 'var(--border)' }}; transition: transform 0.15s ease;">
                                {{ ucfirst($review->status) }}
                                <span style="font-size: 8px; margin-left: 3px; opacity: 0.8;">⇄</span>
                            </button>
                        </form>
                    </td>
                    <td>{{ $review->published_label }}</td>
                    <td class="count-column">{{ $review->views }}</td>
                    <td style="text-align: right; white-space: nowrap;">
                        <div style="display: inline-flex; align-items: center; justify-content: flex-end; gap: 5px;">
                            <!-- Edit Button -->
                            <a href="{{ route('admin.reviews.edit', $review) }}"
                               title="Edit review"
                               style="display: inline-flex; align-items: center; gap: 4px; padding: 5px 9px; font-size: 11px; font-weight: 700; border-radius: 4px; background: #eff6ff; color: #2563eb; border: 1px solid rgba(37, 99, 235, 0.25); text-decoration: none;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                Edit
                            </a>

                            <!-- Toggle Status Button -->
                            <form action="{{ route('admin.reviews.toggle-status', $review) }}" method="POST" style="margin: 0; display: inline;">
                                @csrf
                                @if ($review->status === 'published')
                                    <button type="submit"
                                            title="Unpublish review (Switch to Draft)"
                                            style="display: inline-flex; align-items: center; gap: 3px; padding: 5px 8px; font-size: 11px; font-weight: 700; border-radius: 4px; background: #fffbeb; color: #d97706; border: 1px solid rgba(217, 119, 6, 0.25); cursor: pointer;">
                                        Draft
                                    </button>
                                @else
                                    <button type="submit"
                                            title="Publish review now"
                                            style="display: inline-flex; align-items: center; gap: 3px; padding: 5px 8px; font-size: 11px; font-weight: 700; border-radius: 4px; background: #f0fdf4; color: #16a34a; border: 1px solid rgba(22, 163, 74, 0.25); cursor: pointer;">
                                        Publish
                                    </button>
                                @endif
                            </form>

                            <!-- Delete Button -->
                            <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" style="margin: 0; display: inline;" onsubmit="return confirm('Are you sure you want to delete review from \'{{ addslashes($review->name) }}\'?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        title="Delete review"
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
            @empty
                <tr>
                    <td colspan="7" class="empty-state-cell">No reviews found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
