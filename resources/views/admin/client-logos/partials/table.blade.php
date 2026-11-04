<div class="reviews-table-wrap">
    <table class="reviews-table client-logo-table">
        <thead>
            <tr>
                <th class="client-logo-column">Logo</th>
                <th class="title-column">Client</th>
                <th>Website</th>
                <th>Status</th>
                <th class="count-column">Order</th>
                <th style="width: 170px; text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clientLogos as $clientLogo)
                <tr>
                    <td>
                        <div class="client-logo-thumb">
                            @if ($clientLogo->logo_url)
                                <img src="{{ $clientLogo->logo_url }}" alt="{{ $clientLogo['name'] }}">
                            @else
                                <span>{{ $clientLogo['name'] }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="review-title-cell">
                        <a href="{{ route('admin.client-logos.show', $clientLogo['slug']) }}" class="review-title">
                            {{ $clientLogo['name'] }}
                        </a>
                        <div class="row-actions">
                            <a href="{{ route('admin.client-logos.edit', $clientLogo['slug']) }}">Edit</a>
                            <span>|</span>
                            <form action="{{ route('admin.client-logos.destroy', $clientLogo['slug']) }}" method="POST" style="display:inline; margin:0;" onsubmit="return confirm('Are you sure you want to delete this client logo?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-delete-btn" style="background:none; border:none; padding:0; cursor:pointer; color:#dc2626; font-size:12px; font-weight:500;">Delete</button>
                            </form>
                            <span>|</span>
                            <a href="{{ $clientLogo['website'] ?: url('clients#' . $clientLogo['slug']) }}" target="_blank" rel="noopener">View</a>
                        </div>
                    </td>
                    <td>
                        @if ($clientLogo['website'])
                            <a href="{{ $clientLogo['website'] }}" target="_blank" rel="noopener">
                                {{ parse_url($clientLogo['website'], PHP_URL_HOST) }}
                            </a>
                        @else
                            <span class="muted-text">Not added</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.client-logos.toggle-status', $clientLogo['slug']) }}" method="POST" style="display:inline; margin:0;">
                            @csrf
                            <button type="submit"
                                    class="status-pill {{ $clientLogo['status'] === 'published' ? 'status-pill-success' : 'status-pill-muted' }}"
                                    title="Click to toggle status to {{ $clientLogo['status'] === 'published' ? 'Draft' : 'Published' }}"
                                    style="cursor: pointer; border: 1px solid {{ $clientLogo['status'] === 'published' ? 'rgba(22, 163, 74, 0.3)' : 'var(--border)' }}; transition: transform 0.15s ease;">
                                {{ ucfirst($clientLogo['status']) }}
                                <span style="font-size: 8px; margin-left: 3px; opacity: 0.8;">⇄</span>
                            </button>
                        </form>
                    </td>
                    <td class="count-column">{{ $clientLogo['sort_order'] }}</td>
                    <td style="text-align: right; white-space: nowrap;">
                        <div style="display: inline-flex; align-items: center; justify-content: flex-end; gap: 5px;">
                            <!-- Edit Button -->
                            <a href="{{ route('admin.client-logos.edit', $clientLogo['slug']) }}"
                               title="Edit client logo"
                               style="display: inline-flex; align-items: center; gap: 4px; padding: 5px 9px; font-size: 11px; font-weight: 700; border-radius: 4px; background: #eff6ff; color: #2563eb; border: 1px solid rgba(37, 99, 235, 0.25); text-decoration: none;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                Edit
                            </a>

                            <!-- Toggle Status Button -->
                            <form action="{{ route('admin.client-logos.toggle-status', $clientLogo['slug']) }}" method="POST" style="margin: 0; display: inline;">
                                @csrf
                                @if ($clientLogo['status'] === 'published')
                                    <button type="submit"
                                            title="Unpublish client logo (Switch to Draft)"
                                            style="display: inline-flex; align-items: center; gap: 3px; padding: 5px 8px; font-size: 11px; font-weight: 700; border-radius: 4px; background: #fffbeb; color: #d97706; border: 1px solid rgba(217, 119, 6, 0.25); cursor: pointer;">
                                        Draft
                                    </button>
                                @else
                                    <button type="submit"
                                            title="Publish client logo now"
                                            style="display: inline-flex; align-items: center; gap: 3px; padding: 5px 8px; font-size: 11px; font-weight: 700; border-radius: 4px; background: #f0fdf4; color: #16a34a; border: 1px solid rgba(22, 163, 74, 0.25); cursor: pointer;">
                                        Publish
                                    </button>
                                @endif
                            </form>

                            <!-- Delete Button -->
                            <form action="{{ route('admin.client-logos.destroy', $clientLogo['slug']) }}" method="POST" style="margin: 0; display: inline;" onsubmit="return confirm('Are you sure you want to delete \'{{ addslashes($clientLogo['name']) }}\'?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        title="Delete client logo"
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
                    <td colspan="6" class="empty-state-cell">No client logos found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
