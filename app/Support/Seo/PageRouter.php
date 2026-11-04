<?php

namespace App\Support\Seo;

use App\Models\Page;
use App\Models\SiteLayoutSetting;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Throwable;

class PageRouter
{
    private static ?array $customPathsCache = null;
    private static ?array $draftRoutesCache = null;

    /**
     * Get all custom path overrides mapped by route name.
     */
    public static function customPaths(): array
    {
        if (self::$customPathsCache !== null) {
            return self::$customPathsCache;
        }

        $paths = [];

        try {
            $setting = SiteLayoutSetting::query()->where('key', 'main')->first();
            $data = is_array($setting?->data) ? $setting->data : [];
            $pageMeta = $data['page_meta'] ?? [];
            $customPages = $data['custom_pages'] ?? [];

            // 1. Database Page records
            if (Schema::hasTable('pages')) {
                foreach (Page::all() as $p) {
                    if (!empty($p->url_path)) {
                        $paths[$p->route_name] = '/' . ltrim($p->url_path, '/');
                    }
                }
            }

            // 2. Custom dynamic pages
            foreach ($customPages as $routeName => $cp) {
                if (!empty($cp['slug'])) {
                    $paths[$routeName] = '/' . ltrim($cp['slug'], '/');
                }
            }

            // 3. Explicit page_meta custom paths
            foreach ($pageMeta as $routeName => $meta) {
                if (!empty($meta['custom_path'])) {
                    $paths[$routeName] = '/' . ltrim($meta['custom_path'], '/');
                }
            }
        } catch (Throwable $e) {
            // Fail safe during early boot, migrations or artisan commands
        }

        return self::$customPathsCache = $paths;
    }

    /**
     * Get all routes marked as draft.
     */
    public static function draftRoutes(): array
    {
        if (self::$draftRoutesCache !== null) {
            return self::$draftRoutesCache;
        }

        $drafts = [];

        try {
            $setting = SiteLayoutSetting::query()->where('key', 'main')->first();
            $data = is_array($setting?->data) ? $setting->data : [];
            $pageMeta = $data['page_meta'] ?? [];
            $customPages = $data['custom_pages'] ?? [];

            foreach ($pageMeta as $rName => $m) {
                if (($m['status'] ?? 'published') === 'draft') {
                    $drafts[$rName] = true;
                }
            }

            foreach ($customPages as $rName => $cp) {
                if (($cp['status'] ?? 'published') === 'draft') {
                    $drafts[$rName] = true;
                }
            }

            if (Schema::hasTable('pages')) {
                foreach (Page::where('status', 'draft')->get(['route_name']) as $p) {
                    if (!empty($p->route_name)) {
                        $drafts[$p->route_name] = true;
                    }
                }
            }
        } catch (Throwable $e) {
            // Fail safe
        }

        return self::$draftRoutesCache = $drafts;
    }

    /**
     * Check if a route is marked as draft.
     */
    public static function isDraft(string $routeName): bool
    {
        return isset(self::draftRoutes()[$routeName]);
    }

    /**
     * Resolve the active path for a route name, falling back to default.
     */
    public static function path(string $routeName, string $defaultPath = '/'): string
    {
        $customPaths = self::customPaths();
        $path = $customPaths[$routeName] ?? $defaultPath;

        return '/' . ltrim($path, '/');
    }

    /**
     * Register a view route with dynamic slug override, draft 404, and automatic 301 redirect.
     */
    public static function view(string $routeName, string $defaultPath, string $view): void
    {
        $defaultPath = '/' . ltrim($defaultPath, '/');
        $routePath = self::path($routeName, $defaultPath);

        if (self::isDraft($routeName)) {
            Route::get($routePath, fn () => abort(404))->name($routeName);
        } else {
            Route::view($routePath, $view)->name($routeName);
        }
    }

    /**
     * Register all dynamic custom pages created via admin workspace.
     */
    public static function registerCustomPages(): void
    {
        try {
            $setting = SiteLayoutSetting::query()->where('key', 'main')->first();
            $data = is_array($setting?->data) ? $setting->data : [];
            $customPages = $data['custom_pages'] ?? [];
            $customPaths = self::customPaths();

            foreach ($customPages as $routeName => $page) {
                $slug = $customPaths[$routeName] ?? ($page['slug'] ?? str_replace('frontend.', '', $routeName));
                $path = '/' . ltrim($slug, '/');

                if (self::isDraft($routeName)) {
                    Route::get($path, fn () => abort(404))->name($routeName);
                } else {
                    Route::get($path, fn () => view('frontend.home'))->name($routeName);
                }
            }

            if (Schema::hasTable('pages')) {
                $dbCustomPages = Page::where('route_name', 'like', 'frontend.custom-%')->get();
                foreach ($dbCustomPages as $cp) {
                    if (!isset($customPages[$cp->route_name])) {
                        $slug = $customPaths[$cp->route_name] ?? $cp->url_path;
                        $path = '/' . ltrim($slug, '/');

                        if (self::isDraft($cp->route_name)) {
                            Route::get($path, fn () => abort(404))->name($cp->route_name);
                        } else {
                            Route::get($path, fn () => view('frontend.home'))->name($cp->route_name);
                        }
                    }
                }
            }
        } catch (Throwable $e) {
            // Fail safe
        }
    }

    /**
     * Clear memory caches.
     */
    public static function clearCache(): void
    {
        self::$customPathsCache = null;
        self::$draftRoutesCache = null;
    }
}
