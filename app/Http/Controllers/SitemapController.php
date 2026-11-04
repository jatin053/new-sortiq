<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $items = [];
        $registeredRoutes = \Illuminate\Support\Facades\Route::getRoutes()->getRoutes();

        // Load admin-defined sitemap exclusion settings
        try {
            $settings = \App\Models\SiteLayoutSetting::main();
            $storedPageMeta = (is_array($settings->data) && is_array($settings->data['page_meta'] ?? null))
                ? $settings->data['page_meta']
                : [];
            $blockedUrls = (is_array($settings->data) && is_array($settings->data['blocked_sitemap_urls'] ?? null))
                ? $settings->data['blocked_sitemap_urls']
                : [];
        } catch (\Throwable $e) {
            $storedPageMeta = [];
            $blockedUrls = [];
        }

        foreach ($registeredRoutes as $route) {
            $name = $route->getName();
            
            // Only include GET routes named 'frontend.*'
            if (!$name || !str_starts_with($name, 'frontend.') || !in_array('GET', $route->methods())) {
                continue;
            }

            $uri = $route->uri();
            $cleanUri = trim($uri, '/');
            $path = '/' . $cleanUri;

            // Skip if excluded via Admin Panel SEO settings
            if (isset($storedPageMeta[$name]['exclude_sitemap']) && $storedPageMeta[$name]['exclude_sitemap']) {
                continue;
            }
            if (in_array($path, $blockedUrls)) {
                continue;
            }

            // Skip any route that looks like a backend, admin, auth, or API route
            if (
                str_starts_with($cleanUri, 'sortiqadmin') ||
                str_starts_with($cleanUri, 'admin') ||
                str_starts_with($cleanUri, 'api') ||
                in_array($cleanUri, ['login', 'logout', 'register']) ||
                str_contains($cleanUri, 'password/')
            ) {
                continue;
            }

            // Skip routes with parameters (like blog/{slug}) - these are handled dynamically
            if (str_contains($uri, '{')) {
                continue;
            }

            // Skip json feeds or specific other extensions
            if (str_ends_with($uri, '.json')) {
                continue;
            }

            // Determine changefreq and priority based on URI
            $priority = '0.8';
            $changefreq = 'weekly';
            
            if ($cleanUri === '') {
                $priority = '1.0';
                $changefreq = 'daily';
            } elseif (in_array($cleanUri, ['terms', 'faq', 'support'])) {
                $priority = '0.5';
                $changefreq = 'monthly';
            } elseif (in_array($name, [
                'frontend.clients', 
                'frontend.videos', 
                'frontend.reviews', 
                'frontend.portfolio', 
                'frontend.services', 
                'frontend.blog.index'
            ])) {
                $priority = '0.9';
                $changefreq = 'daily';
            }

            // Try to find the view template for the last modified timestamp
            $viewName = $route->defaults['view'] ?? null;
            
            // Fallback: look up in config/frontend-routes.php if view is not in route defaults
            if (!$viewName) {
                $configRoutes = config('frontend-routes');
                if (isset($configRoutes['pages'][$cleanUri])) {
                    $viewName = $configRoutes['pages'][$cleanUri];
                } elseif (isset($configRoutes['services'][$cleanUri])) {
                    $viewName = 'frontend.services.' . $configRoutes['services'][$cleanUri];
                }
            }
            
            if (!$viewName && $cleanUri === '') {
                $viewName = 'frontend.home.home-page';
            }

            $lastModified = null;
            if ($viewName) {
                $lastModified = $this->getViewLastModified($viewName);
            }

            $items[] = [
                'location' => url('/' . $cleanUri),
                'last_modified' => $lastModified,
                'changefreq' => $changefreq,
                'priority' => $priority,
            ];
        }

        $urls = collect($items);

        try {
            Blog::cleanupDuplicateSlugs();

            $blogs = Blog::query()
                ->published()
                ->whereNotNull('slug')
                ->where('slug', '!=', '')
                ->where('slug', 'not like', '%-dup-%')
                ->get(['slug', 'updated_at', 'published_at'])
                ->map(fn (Blog $blog) => [
                    'location' => route('frontend.blog.show', $blog->slug),
                    'last_modified' => ($blog->updated_at ?? $blog->published_at)?->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.7',
                ]);
        } catch (\Throwable $e) {
            logger()->warning('Database query failed in SitemapController: ' . $e->getMessage());
            $blogs = collect();
        }

        $finalUrls = $urls->concat($blogs)
            ->unique('location')
            ->reject(fn ($item) => $this->isExcluded($item['location'], $blockedUrls));

        return response()
            ->view('sitemap', ['urls' => $finalUrls])
            ->header('Content-Type', 'application/xml; charset=UTF-8')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    private function isExcluded(string $location, array $blockedUrls = []): bool
    {
        $excludeUrls = config('seo.exclude_urls', []);
        $path = '/' . ltrim(str_replace(url('/'), '', $location), '/');

        if (in_array($path, $blockedUrls)) {
            return true;
        }

        foreach ($excludeUrls as $exclude) {
            $excludePattern = '/' . ltrim($exclude, '/');
            if (fnmatch($excludePattern, $path) || $excludePattern === $path) {
                return true;
            }
        }
        return false;
    }

    private function getViewLastModified(string $viewName): ?string
    {
        $path = resource_path('views/' . str_replace('.', '/', $viewName) . '.blade.php');
        if (is_file($path)) {
            return date('Y-m-d\TH:i:sP', filemtime($path));
        }
        return null;
    }
}