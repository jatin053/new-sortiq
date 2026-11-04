@props(['currentSection' => null])

@php
    $currentSection ??= [
        'label' => 'Dashboard',
        'caption' => 'Overview, shortcuts, and admin pulse.',
    ];

    $pageTitle = trim($__env->yieldContent('title')) ?: $currentSection['label'];
    $workspaceDate = now()->format('D, M d');
    $topbarSummary = request()->routeIs('admin.dashboard')
        ? 'Track the full admin panel from one place and move quickly into content, portfolio, and website updates.'
        : $currentSection['caption'];

    $userName = auth()->user()->name ?? 'Admin';
    $userEmail = auth()->user()->email ?? 'admin@sortiq.local';
@endphp

<div class="admin-page-frame">
    <header class="topbar">
        <div class="topbar-left">
            <span class="topbar-status-pill">Live Workspace</span>

            <div class="topbar-title-block">
                <span class="topbar-kicker">{{ $currentSection['label'] }}</span>
                <h2>{{ $pageTitle }}</h2>
                <p class="topbar-summary">{{ $topbarSummary }}</p>
            </div>
        </div>

        <div class="topbar-right">
            <div class="topbar-insight">
                <span>Today</span>
                <strong>{{ $workspaceDate }}</strong>
                <small>Sortiq admin</small>
            </div>

            <a href="{{ route('frontend.home') }}" class="topbar-link-pill" target="_blank" rel="noopener">
                View website
            </a>

            <div class="topbar-user-chip">
                <span class="user-avatar">
                    <img
                        src="{{ asset('frontend-assets/media/admin-user-mark.png') }}"
                        alt="Sortiq Solutions"
                        class="user-avatar-icon"
                        width="28"
                        height="28"
                    >
                </span>
                <span class="topbar-user-copy">
                    <strong>{{ $userName }}</strong>
                    <small>{{ $userEmail }}</small>
                </span>
            </div>
        </div>
    </header>

    @include('admin.partials.workspace-nav', ['currentSection' => $currentSection])

    <div class="admin-page-content">
        {{ $slot }}
    </div>
</div>
