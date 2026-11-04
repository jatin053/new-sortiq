@php
    $actions = $actions ?? [];
@endphp

<section class="admin-page-hero">
    <div class="admin-page-hero-copy">
        <span class="admin-page-kicker">{{ $kicker }}</span>
        <h1>{{ $title }}</h1>
        @if (! empty($description))
            <p>{{ $description }}</p>
        @endif
    </div>

    <div class="admin-page-hero-meta" aria-hidden="true">
        <span>Curated admin view</span>
        <strong>{{ now()->format('M d') }}</strong>
    </div>

    @if (! empty($actions))
        <div class="admin-page-hero-actions">
            @foreach ($actions as $action)
                @if (($action['type'] ?? 'link') === 'button')
                    <button
                        class="{{ $action['class'] ?? 'btn' }}"
                        type="{{ $action['button_type'] ?? 'button' }}"
                        @if (! empty($action['form'])) form="{{ $action['form'] }}" @endif
                        @if (! empty($action['onclick'])) onclick="{{ $action['onclick'] }}" @endif
                    >
                        {{ $action['label'] }}
                    </button>
                @else
                    @php
                        $target = $action['target'] ?? null;
                        $rel = $action['rel'] ?? ($target === '_blank' ? 'noopener' : null);
                    @endphp

                    <a
                        href="{{ $action['url'] ?? '#' }}"
                        class="{{ $action['class'] ?? 'btn' }}"
                        @if ($target) target="{{ $target }}" @endif
                        @if ($rel) rel="{{ $rel }}" @endif
                        @if (! empty($action['onclick'])) onclick="{{ $action['onclick'] }}" @endif
                    >
                        {{ $action['label'] }}
                    </a>
                @endif
            @endforeach
        </div>
    @endif
</section>
