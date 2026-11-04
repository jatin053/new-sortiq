{{-- Contributions by mrabhi2k3 (https://github.com/mrabhi2k3) --}}
@php
    $pageFilterGroups = collect(\App\Support\Seo\SeoPageCatalog::pages())
        ->groupBy('section')
        ->map(
            fn ($pages, $section) => [
                'section' => $section,
                'pages' => collect($pages)
                    ->map(
                        fn ($pageOption) => [
                            'label' => $pageOption['label'],
                            'route_name' => $pageOption['route_name'],
                        ]
                    )
                    ->values()
                    ->all(),
            ]
        )
        ->values()
        ->all();

    $selectedSidebarPage = request()->routeIs('admin.pages.*')
        ? trim((string) request()->query('page'))
        : '';

    $navigationItems = [
        [
            'label' => 'Dashboard',
            'route' => route('admin.dashboard'),
            'match' => 'admin.dashboard',
            'icon' => 'DB',
            'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z"/><path d="M12 12l3-3"/><circle cx="12" cy="12" r="2"/></svg>',
            'caption' => 'Overview, shortcuts, and admin pulse.',
        ],
        [
            'label' => 'Reviews',
            'route' => route('admin.reviews.index'),
            'match' => 'admin.reviews.*',
            'icon' => 'RV',
            'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',
            'caption' => 'Testimonials, ratings, and social proof.',
        ],
        [
            'label' => 'Blogs',
            'route' => route('admin.blogs.index'),
            'match' => 'admin.blogs.*',
            'icon' => 'BL',
            'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 17v5M9 2h6l-1 7h4l-8 8 1-8H7l2-7z"/></svg>',
            'caption' => 'Editorial content and publishing flow.',
            'children' => [
                ['label' => 'All Posts', 'route' => route('admin.blogs.index'), 'match' => 'admin.blogs.index'],
                ['label' => 'Add Post', 'route' => route('admin.blogs.create'), 'match' => 'admin.blogs.create'],
                ['label' => 'Categories', 'route' => route('admin.blogs.categories'), 'match' => 'admin.blogs.categories'],
                ['label' => 'Tags', 'route' => route('admin.blogs.tags'), 'match' => 'admin.blogs.tags'],
            ],
        ],
        [
            'label' => 'Portfolio',
            'route' => route('admin.portfolios.index'),
            'match' => 'admin.portfolios.*',
            'icon' => 'PF',
            'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>',
            'caption' => 'Projects, previews, and showcase order.',
            'children' => [
                ['label' => 'All Portfolio', 'route' => route('admin.portfolios.index'), 'match' => 'admin.portfolios.index'],
                ['label' => 'Add Portfolio', 'route' => route('admin.portfolios.create'), 'match' => 'admin.portfolios.create'],
                ['label' => 'Categories', 'route' => route('admin.portfolios.categories'), 'match' => 'admin.portfolios.categories'],
                ['label' => 'Tags', 'route' => route('admin.portfolios.tags'), 'match' => 'admin.portfolios.tags'],
            ],
        ],
        [
            'label' => 'Videos',
            'route' => route('admin.videos.index'),
            'match' => 'admin.videos.*',
            'icon' => 'VD',
            'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>',
            'caption' => 'Media entries and YouTube details.',
        ],
        [
            'label' => 'Client Logos',
            'route' => route('admin.client-logos.index'),
            'match' => 'admin.client-logos.*',
            'icon' => 'CL',
            'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>',
            'caption' => 'Brand assets and credibility blocks.',
        ],
        [
            'label' => 'Pages',
            'route' => route('admin.site-pages.index'),
            'match' => 'admin.site-pages.*',
            'icon' => 'PG',
            'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>',
            'caption' => 'Manage working site pages & Add New Page.',
            'children' => [
                ['label' => 'All Pages', 'route' => route('admin.site-pages.index'), 'match' => 'admin.site-pages.index'],
                ['label' => 'Add Page', 'route' => route('admin.site-pages.create'), 'match' => 'admin.site-pages.create'],
            ],
        ],
        [
            'label' => 'Inquiries',
            'route' => route('admin.contact-messages.index', ['filter' => 'inquiry']),
            'match' => 'admin.contact-messages.*',
            'filter' => 'inquiry',
            'icon' => 'IQ',
            'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>',
            'caption' => 'General contact messages and follow-up.',
        ],
        [
            'label' => 'Applications',
            'route' => route('admin.contact-messages.index', ['filter' => 'application']),
            'match' => 'admin.contact-messages.*',
            'filter' => 'application',
            'icon' => 'AP',
            'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>',
            'caption' => 'Careers applications and inquiries.',
        ],
        [
            'label' => 'Internships',
            'route' => route('admin.internship-applications.index'),
            'match' => 'admin.internship-applications.*',
            'icon' => 'IN',
            'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>',
            'caption' => 'Internship applications and student details.',
        ],
        [
            'label' => 'Fresher Connect',
            'route' => route('admin.fresher-hirings.index'),
            'match' => 'admin.fresher-hirings.*',
            'icon' => 'FH',
            'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
            'caption' => 'Fresher Connect applications and resumes.',
        ],
        [
            'label' => 'SEO',
            'route' => route('admin.pages.edit'),
            'match' => 'admin.pages.*|admin.site-layout.*|admin.robots-settings.*',
            'icon' => 'SEO',
            'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>',
            'caption' => 'SEO meta tags, site settings, custom scripts & sitemaps.',
            'children' => [
                ['label' => 'Meta Pages', 'route' => route('admin.pages.edit'), 'match' => 'admin.pages.*'],
                ['label' => 'Settings', 'route' => route('admin.site-layout.edit'), 'match' => 'admin.site-layout.edit'],
                ['label' => 'Custom JS / CSS', 'route' => route('admin.site-layout.custom-code.edit'), 'match' => 'admin.site-layout.custom-code.*'],
                ['label' => 'Robots.txt', 'route' => route('admin.robots-settings.edit'), 'match' => 'admin.robots-settings.edit'],
                ['label' => 'Sitemap', 'route' => route('admin.robots-settings.sitemap'), 'match' => 'admin.robots-settings.sitemap'],
            ],
        ],
    ];

    $currentSection = collect($navigationItems)->first(function (array $item) {
        if (request()->routeIs($item['match'])) {
            if (isset($item['filter'])) {
                return request()->query('filter', 'inquiry') === $item['filter'];
            }
            if ($item['label'] === 'Sitemap Manager') {
                return request()->query('view') === 'xml_urls';
            }
            if ($item['label'] === 'Meta Pages' || $item['label'] === 'Pages') {
                return request()->query('view') !== 'xml_urls';
            }
            return true;
        }
        return false;
    }) ?? $navigationItems[0];

    $userName = auth()->user()->name ?? 'Admin';
    $userEmail = auth()->user()->email ?? 'admin@sortiq.local';
    $versionedAdminCss = is_file(public_path('css/admin.css'))
        ? asset('css/admin.css') . '?v=' . filemtime(public_path('css/admin.css'))
        : asset('css/admin.css');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ trim($__env->yieldContent('title')) ? trim($__env->yieldContent('title')) . ' | ' : '' }}Sortiq Solutions Admin</title>
    @include('admin.partials.favicon-links')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ $versionedAdminCss }}">
</head>
<body>

<div class="admin-shell" data-admin-shell>
    <div class="admin-sidebar-overlay" data-admin-sidebar-close></div>

    <aside class="sidebar" id="admin-sidebar">
        <div class="admin-sidebar-mobile-head">
            <span class="sidebar-section-label">Navigation</span>
            <button type="button" class="admin-sidebar-close" data-admin-sidebar-close aria-label="Close admin sidebar">
                Close
            </button>
        </div>

        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand-link" aria-label="Sortiq Solutions Admin Panel">
                <img
                    src="{{ asset('frontend-assets/media/admin-use.png') }}"
                    alt="Sortiq Solutions"
                    height="38"
                    class="sidebar-brand-logo"
                >
            </a>

            <div class="sidebar-brand-copy">
                <span class="sidebar-brand-pill">Admin Workspace</span>
                <strong>Sortiq Control Room</strong>
                <p>Publishing, trust signals, and site settings in one polished workflow.</p>
            </div>
        </div>

        <div class="sidebar-section-head">
            <span class="sidebar-section-label">Main Menu</span>
            <span class="sidebar-section-count">{{ count($navigationItems) }} sections</span>
        </div>

        <ul class="sidebar-nav">
            @foreach ($navigationItems as $item)
                @if (! empty($item['children']))
                    @php
                        $isDropdownActive = request()->routeIs($item['match']);
                        $isParentCurrent = $isDropdownActive
                            && ! collect($item['children'])->contains(fn (array $child) => request()->routeIs($child['match']));
                    @endphp
                    <li class="{{ $isDropdownActive ? 'active is-submenu-open' : '' }}" data-sidebar-dropdown-item>
                        <div class="sidebar-dropdown-row">
                            <a href="{{ $item['route'] }}" class="sidebar-dropdown-link {{ $isParentCurrent ? 'is-current' : '' }}">
                                <span class="sidebar-link-main">
                                    <span class="nav-icon">{!! $item['svg'] ?? $item['icon'] !!}</span>
                                    <span class="sidebar-link-copy">
                                        <strong>{{ $item['label'] }}</strong>
                                        <small>{{ $item['caption'] }}</small>
                                    </span>
                                </span>
                            </a>
                            <button type="button" class="sidebar-dropdown-toggle" data-sidebar-dropdown-toggle aria-expanded="{{ $isDropdownActive ? 'true' : 'false' }}" aria-label="Toggle Robots.txt menu">
                                <span class="screen-reader-text">Toggle Robots.txt menu</span>
                                <span class="sidebar-link-arrow" aria-hidden="true">&#9662;</span>
                            </button>
                        </div>
                        <div class="sidebar-submenu">
                            <div class="sidebar-page-groups">
                                @foreach ($item['children'] as $child)
                                    <a href="{{ $child['route'] }}" class="sidebar-submenu-link sidebar-submenu-link--page {{ request()->routeIs($child['match']) ? 'is-current' : '' }}">{{ $child['label'] }}</a>
                                @endforeach
                            </div>
                        </div>
                    </li>
                @elseif (! empty($item['page_filter_groups']))
                    @php
                        $isDropdownActive = false;
                        if (request()->routeIs($item['match'])) {
                            $isDropdownActive = true;
                        }
                    @endphp
                    <li
                        class="{{ $isDropdownActive ? 'active is-submenu-open' : '' }}"
                        data-sidebar-dropdown-item
                    >
                        <div class="sidebar-dropdown-row">
                            <a
                                href="{{ route('admin.pages.edit') }}"
                                class="sidebar-dropdown-link {{ request()->routeIs('admin.pages.*') && $selectedSidebarPage === '' ? 'is-current' : '' }}"
                            >
                                <span class="sidebar-link-main">
                                    <span class="nav-icon">{!! $item['svg'] ?? $item['icon'] !!}</span>
                                    <span class="sidebar-link-copy">
                                        <strong>{{ $item['label'] }}</strong>
                                        <small>{{ $item['caption'] }}</small>
                                    </span>
                                </span>
                            </a>

                            <button
                                type="button"
                                class="sidebar-dropdown-toggle"
                                data-sidebar-dropdown-toggle
                                aria-expanded="{{ request()->routeIs($item['match']) ? 'true' : 'false' }}"
                                aria-label="Toggle page list"
                            >
                                <span class="screen-reader-text">Toggle page list</span>
                                <span class="sidebar-link-arrow" aria-hidden="true">&#9662;</span>
                            </button>
                        </div>

                        <div class="sidebar-submenu">
                            <div class="sidebar-page-groups">
                                @foreach ($item['page_filter_groups'] as $pageGroup)
                                    <div class="sidebar-page-group">
                                        <span class="sidebar-submenu-label">{{ $pageGroup['section'] }}</span>

                                        <div class="sidebar-page-links">
                                            @foreach ($pageGroup['pages'] as $pageOption)
                                                <a
                                                    href="{{ route('admin.pages.edit', ['page' => $pageOption['route_name']]) }}"
                                                    class="sidebar-submenu-link sidebar-submenu-link--page {{ $selectedSidebarPage === $pageOption['route_name'] ? 'is-current' : '' }}"
                                                >
                                                    {{ $pageOption['label'] }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </li>
                @else
                    @php
                        $isActive = false;
                        if (request()->routeIs($item['match'])) {
                            if (isset($item['filter'])) {
                                $isActive = request()->query('filter', 'inquiry') === $item['filter'];
                            } elseif ($item['label'] === 'Meta Pages' || $item['label'] === 'Pages') {
                                $isActive = true;
                            } else {
                                $isActive = true;
                            }
                        }
                    @endphp
                    <li class="{{ $isActive ? 'active' : '' }}">
                        <a href="{{ $item['route'] }}">
                            <span class="nav-icon">{!! $item['svg'] ?? $item['icon'] !!}</span>
                            <span class="sidebar-link-copy">
                                <strong>{{ $item['label'] }}</strong>
                                <small>{{ $item['caption'] }}</small>
                            </span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>

        <div class="sidebar-panel">
            <span class="sidebar-panel-label">Active Workspace</span>
            <strong>{{ $currentSection['label'] }}</strong>
            <p>{{ $currentSection['caption'] }}</p>

            <div class="sidebar-user">
                <span class="sidebar-user-avatar">
                    <img
                        src="{{ asset('frontend-assets/media/admin-user-mark.png') }}"
                        alt="Sortiq Solutions"
                        class="user-avatar-icon"
                        width="28"
                        height="28"
                    >
                </span>
                <div class="sidebar-user-copy">
                    <strong>{{ $userName }}</strong>
                    <span>{{ $userEmail }}</span>
                </div>
            </div>

            <div class="sidebar-panel-actions">
                <a href="{{ route('frontend.home') }}" class="btn sidebar-view-site" target="_blank" rel="noopener">
                    Open Website
                </a>

                <form method="post" action="{{ route('admin.logout') }}" class="sidebar-logout-form">
                    @csrf
                    <button type="submit" class="topbar-logout sidebar-logout">Logout</button>
                </form>
            </div>
        </div>
    </aside>

    <div class="admin-main">
        <div class="admin-mobile-bar">
            <div class="admin-mobile-brand-wrap">
                <a href="{{ route('admin.dashboard') }}" class="admin-mobile-brand" aria-label="Sortiq Solutions Admin Panel">
                    <img
                        src="{{ asset('frontend-assets/media/admin-use.png') }}"
                        alt="Sortiq Solutions"
                        width="185"
                        height="77"
                        class="admin-mobile-logo"
                    >
                </a>

                <div class="admin-mobile-copy">
                    <span>{{ $currentSection['label'] }}</span>
                    <strong>{{ $currentSection['caption'] }}</strong>
                </div>
            </div>

            <button
                type="button"
                class="admin-mobile-toggle"
                data-admin-sidebar-open
                aria-controls="admin-sidebar"
                aria-expanded="false"
            >
                Menu
            </button>
        </div>

        <main class="content">
            <x-admin.page-structure :current-section="$currentSection">
                @yield('content')
            </x-admin.page-structure>
        </main>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const shell = document.querySelector('[data-admin-shell]');
        const openButton = document.querySelector('[data-admin-sidebar-open]');
        const closeButtons = document.querySelectorAll('[data-admin-sidebar-close]');
        const navLinks = document.querySelectorAll('.sidebar a');
        const dropdownItems = document.querySelectorAll('[data-sidebar-dropdown-item]');
        const dropdownButtons = document.querySelectorAll('[data-sidebar-dropdown-toggle]');

        if (!shell || !openButton) {
            return;
        }

        const closeDropdown = (item) => {
            const button = item.querySelector('[data-sidebar-dropdown-toggle]');

            item.classList.remove('is-submenu-open');

            if (button) {
                button.setAttribute('aria-expanded', 'false');
            }
        };

        const openDropdown = (item) => {
            const button = item.querySelector('[data-sidebar-dropdown-toggle]');

            item.classList.add('is-submenu-open');

            if (button) {
                button.setAttribute('aria-expanded', 'true');
            }
        };

        const closeOtherDropdowns = (currentItem = null) => {
            dropdownItems.forEach((item) => {
                if (item === currentItem) {
                    return;
                }

                closeDropdown(item);
            });
        };

        const closeSidebar = () => {
            shell.classList.remove('is-sidebar-open');
            document.body.classList.remove('admin-sidebar-open');
            openButton.setAttribute('aria-expanded', 'false');
        };

        const openSidebar = () => {
            shell.classList.add('is-sidebar-open');
            document.body.classList.add('admin-sidebar-open');
            openButton.setAttribute('aria-expanded', 'true');
        };

        openButton.addEventListener('click', () => {
            if (shell.classList.contains('is-sidebar-open')) {
                closeSidebar();
                return;
            }

            openSidebar();
        });

        closeButtons.forEach((button) => {
            button.addEventListener('click', closeSidebar);
        });

        dropdownButtons.forEach((button) => {
            button.addEventListener('click', () => {
                const item = button.closest('[data-sidebar-dropdown-item]');

                if (!item) {
                    return;
                }

                const isOpen = item.classList.contains('is-submenu-open');

                closeOtherDropdowns(isOpen ? null : item);

                if (isOpen) {
                    closeDropdown(item);
                    return;
                }

                openDropdown(item);
            });
        });

        navLinks.forEach((link) => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 980) {
                    closeSidebar();
                }
            });
        });

        window.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeOtherDropdowns();
                closeSidebar();
            }
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth > 980) {
                closeSidebar();
            }
        });
    });
</script>

</body>
</html>
