@php
    $columns = $columns ?? count($items ?? []);
@endphp

<section class="admin-overview-grid{{ $columns === 4 ? ' admin-overview-grid--four' : '' }}">
    @foreach ($items as $item)
        <article class="overview-card">
            <span class="overview-card-label">{{ $item['label'] }}</span>
            <strong class="overview-card-value">{{ $item['value'] }}</strong>
            @if (! empty($item['description']))
                <p class="overview-card-description">{{ $item['description'] }}</p>
            @endif
            @if (! empty($item['link_url']))
                <a href="{{ $item['link_url'] }}" class="overview-card-link">{{ $item['link_label'] ?? 'Open' }}</a>
            @endif
        </article>
    @endforeach
</section>
