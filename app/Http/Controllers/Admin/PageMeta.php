<?php

namespace App\Support\Seo;

use App\Models\Page;
use App\Models\SiteLayoutSetting;
use Illuminate\Support\Str;
use Throwable;

class PageMeta
{
    private static ?array $resolvedMetaMap = null;

    public function __construct(
        public readonly ?string $title,
        public readonly string $description,
        public readonly string $image,
        public readonly ?string $keywords = null,
        public readonly string $type = 'website',
    ) {
    }

    public static function forRoute(?string $routeName = null, ?string $path = null): self
    {
        $resolvedRoute = self::resolveRouteName($routeName, $path);

        return new self(
            title: self::titleForRoute($resolvedRoute, $path),
            description: self::descriptionForRoute($resolvedRoute, $path),
            image: self::imageForRoute($resolvedRoute, $path),
            keywords: self::keywordsForRoute($resolvedRoute, $path),
        );
    }

    public static function resolveRouteName(?string $routeName = null, ?string $path = null): ?string
    {
        if ($routeName && in_array($routeName, SeoPageCatalog::routeNames(), true)) {
            return $routeName;
        }

        if ($routeName && str_starts_with($routeName, 'frontend.')) {
            return $routeName;
        }

        if ($path === null && function_exists('request') && request()) {
            $path = request()->path();
        }

        $cleanPath = trim((string) $path, '/');

        if ($cleanPath === '' || $cleanPath === '/') {
            return 'frontend.home';
        }

        // 1. Direct match in services config
        $services = config('frontend-routes.services', []);
        if (isset($services[$cleanPath])) {
            return 'frontend.services.' . $services[$cleanPath];
        }

        // 2. Check legacy services alias (e.g. services/web-development => website-development-company)
        $legacyServices = config('frontend-routes.legacy_services', []);
        if (isset($legacyServices[$cleanPath])) {
            $canonicalSlug = $legacyServices[$cleanPath];
            if (isset($services[$canonicalSlug])) {
                return 'frontend.services.' . $services[$canonicalSlug];
            }
        }

        // 3. Known service slug aliases
        $serviceAliases = [
            'website-development-services' => 'frontend.services.web',

            'website-design-services' => 'frontend.services.design',

            'laravel-development-services' => 'frontend.services.laravel',

            'wordpress-development-services' => 'frontend.services.wordpress',

            'ecommerce-development-services' => 'frontend.services.ecommerce',

            'digital-marketing' => 'frontend.services.marketing',

            'seo-services' => 'frontend.services.seo',

            'smo-services' => 'frontend.services.smo',

            'graphic-design-services' => 'frontend.services.graphics',

            'banner-design-services' => 'frontend.services.banners',

            'logo-design-services' => 'frontend.services.logos',

            'website-maintenance-services' => 'frontend.services.maintenance',

            'bigcommerce-development-company' => 'frontend.services.bigcommerce',
            'big-commerce' => 'frontend.services.bigcommerce',
            'services/bigcommerce-development' => 'frontend.services.bigcommerce',
            'services/bigcommerce' => 'frontend.services.bigcommerce',

            'mern-stack-development-company' => 'frontend.services.mern',
            'services/mern-stack-development' => 'frontend.services.mern',
            'services/mern' => 'frontend.services.mern',

            'app-development-company' => 'frontend.services.apps',
            'services/app-development' => 'frontend.services.apps',
            'services/apps' => 'frontend.services.apps',

            'software-testing-company' => 'frontend.services.testing',
            'services/software-testing' => 'frontend.services.testing',
            'services/testing' => 'frontend.services.testing',

            'cyber-security-development' => 'frontend.services.security',
            'services/cyber-security' => 'frontend.services.security',
            'services/security' => 'frontend.services.security',

            'hubspot-crm-services' => 'frontend.services.hubspot',
            'services/hubspot-crm' => 'frontend.services.hubspot',
            'services/hubspot' => 'frontend.services.hubspot',

            'zoho-crm-services' => 'frontend.services.zoho',
            'zoho' => 'frontend.services.zoho',
            'services/zoho-crm' => 'frontend.services.zoho',
            'services/zoho' => 'frontend.services.zoho',

            'php-development-company' => 'frontend.services.php',
            'services/php-development' => 'frontend.services.php',
            'services/php' => 'frontend.services.php',

            'codeigniter-development-company' => 'frontend.services.codeigniter',
            'services/codeigniter-development' => 'frontend.services.codeigniter',
            'services/codeigniter' => 'frontend.services.codeigniter',

            'shopify-development-company' => 'frontend.services.shopify',
            'services/shopify-development' => 'frontend.services.shopify',
            'services/shopify' => 'frontend.services.shopify',

            'react-js-development-company' => 'frontend.services.react',
            'services/react-js-development' => 'frontend.services.react',
            'services/react-development' => 'frontend.services.react',
            'services/react' => 'frontend.services.react',

            'node-js-development-company' => 'frontend.services.node',
            'services/node-js-development' => 'frontend.services.node',
            'services/node-development' => 'frontend.services.node',
            'services/node' => 'frontend.services.node',

            'vue-js-development-company' => 'frontend.services.vue',
            'services/vue-js-development' => 'frontend.services.vue',
            'services/vue-development' => 'frontend.services.vue',
            'services/vue' => 'frontend.services.vue',

            'data-science-development' => 'frontend.services.data-science',
            'services/data-science-development' => 'frontend.services.data-science',
            'services/data-science' => 'frontend.services.data-science',

            'next-js-development' => 'frontend.services.next',
            'services/next-js-development' => 'frontend.services.next',
        ];

        if (isset($serviceAliases[$cleanPath])) {
            return $serviceAliases[$cleanPath];
        }

        // 4. Check static pages
        $pages = config('frontend-routes.pages', []);
        if (isset($pages[$cleanPath])) {
            $target = $pages[$cleanPath];
            return str_starts_with($target, 'frontend.') ? $target : 'frontend.' . $target;
        }

        // 5. Check legacy pages
        $legacyPages = config('frontend-routes.legacy_pages', []);
        if (isset($legacyPages[$cleanPath])) {
            $mapped = $legacyPages[$cleanPath];
            if (isset($pages[$mapped])) {
                $target = $pages[$mapped];
                return str_starts_with($target, 'frontend.') ? $target : 'frontend.' . $target;
            }
            return 'frontend.' . $mapped;
        }

        // 6. Common company page aliases
        $staticAliases = [
            'about-us' => 'frontend.about',
            'about' => 'frontend.about',
            'why-choose-us' => 'frontend.why-us',
            'why-us' => 'frontend.why-us',
            'our-career' => 'frontend.careers',
            'careers' => 'frontend.careers',
            'career' => 'frontend.careers',
            'our-expertise' => 'frontend.expertise',
            'expertise' => 'frontend.expertise',
            'case-studies' => 'frontend.cases',
            'cases' => 'frontend.cases',
            'internship' => 'frontend.best-it-internship',
            'best-it-internship-company-mohali-chandigarh' => 'frontend.best-it-internship',
            'best-it-internship' => 'frontend.best-it-internship',
            'best-it-company-in-chandigarh' => 'frontend.best-it-company-chandigarh',
            'best-it-company-in-mohali' => 'frontend.best-it-company-mohali',
            'faq' => 'frontend.faq',
            'faqs' => 'frontend.faq',
            'support' => 'frontend.support',
            'terms' => 'frontend.terms',
            'terms-and-conditions' => 'frontend.terms',
            'privacy-policy' => 'frontend.privacy-policy',
            'privacy' => 'frontend.privacy-policy',
            'contact' => 'frontend.contact',
            'contact-us' => 'frontend.contact',
            'ads-landing-page' => 'frontend.ads-landing-page',
            'certificate-authenticate' => 'frontend.certificate-authenticate',
            'certificate-verify' => 'frontend.certificate-authenticate',
            'reviews' => 'frontend.reviews',
            'reviews-old' => 'frontend.reviews',
            'reviews-latest' => 'frontend.reviews',
            'clients' => 'frontend.clients',
            'videos' => 'frontend.videos',
            'our_videos' => 'frontend.videos',
            'portfolios' => 'frontend.portfolio',
            'portfolio' => 'frontend.portfolio',
            'blog' => 'frontend.blog.index',
        ];

        if (isset($staticAliases[$cleanPath])) {
            return $staticAliases[$cleanPath];
        }

        // 7. Check database Page table by url_path
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('pages')) {
                $dbPage = Page::query()
                    ->where('url_path', '/' . $cleanPath)
                    ->orWhere('url_path', $cleanPath)
                    ->first();

                if ($dbPage && !empty($dbPage->route_name)) {
                    return $dbPage->route_name;
                }
            }
        } catch (Throwable $e) {}

        // 8. Check custom pages in SiteLayoutSetting
        try {
            $setting = SiteLayoutSetting::query()
                ->where('key', SiteLayoutSetting::MAIN_KEY)
                ->first();
            $customPages = is_array($setting?->data) ? ($setting->data['custom_pages'] ?? []) : [];
            foreach ($customPages as $rName => $cPage) {
                $slug = trim((string)($cPage['slug'] ?? ''), '/');
                if ($slug === $cleanPath) {
                    return $rName;
                }
            }
        } catch (Throwable $e) {}

        return $routeName ?: null;
    }

    public static function titleForRoute(?string $routeName, ?string $path = null): ?string
    {
        $resolvedRoute = self::resolveRouteName($routeName, $path);
        if (! $resolvedRoute) {
            return null;
        }

        $title = trim((string) data_get(self::metaForRoute($resolvedRoute, $path), 'title'));

        return $title !== '' ? $title : null;
    }

    public static function keywordsForRoute(?string $routeName, ?string $path = null): ?string
    {
        $resolvedRoute = self::resolveRouteName($routeName, $path);
        if (! $resolvedRoute) {
            return null;
        }

        $keywords = trim((string) data_get(self::metaForRoute($resolvedRoute, $path), 'keywords'));

        return $keywords !== '' ? $keywords : null;
    }

    public static function descriptionForRoute(?string $routeName, ?string $path = null): string
    {
        $resolvedRoute = self::resolveRouteName($routeName, $path);
        if (! $resolvedRoute) {
            return config('seo.default_description');
        }

        $description = trim((string) data_get(self::metaForRoute($resolvedRoute, $path), 'description'));

        return $description !== '' ? $description : config('seo.default_description');
    }

    public static function imageForRoute(?string $routeName, ?string $path = null): string
    {
        $resolvedRoute = self::resolveRouteName($routeName, $path);
        if ($resolvedRoute) {
            $image = trim((string) data_get(self::metaForRoute($resolvedRoute, $path), 'image'));
            if ($image !== '') {
                return $image;
            }
        }

        return asset(config('seo.default_image'));
    }

    public static function isDraftRoute(?string $routeName = null, ?string $path = null): bool
    {
        $resolvedRoute = self::resolveRouteName($routeName, $path);
        if (! $resolvedRoute) {
            return false;
        }

        $meta = self::metaForRoute($resolvedRoute, $path);
        $status = strtolower(trim((string) ($meta['status'] ?? 'published')));

        return in_array($status, ['draft', 'trashed', 'deleted'], true);
    }

    public static function custom(string $description, ?string $image = null, string $type = 'website', ?string $title = null, ?string $keywords = null): self
    {
        return new self(
            title: $title,
            description: trim($description),
            image: $image ?: asset(config('seo.default_image')),
            keywords: $keywords,
            type: $type,
        );
    }

    public static function article(?string $text, ?string $image = null, ?string $title = null, ?string $keywords = null): self
    {
        $cleanDescription = trim(strip_tags((string) $text));

        return new self(
            title: $title,
            description: $cleanDescription !== '' ? $cleanDescription : config('seo.default_description'),
            image: $image ?: asset(config('seo.default_image')),
            keywords: $keywords,
            type: 'article',
        );
    }

    public static function clearCache(): void
    {
        self::$resolvedMetaMap = null;
    }

    private static function metaForRoute(?string $routeName, ?string $path = null): array
    {
        $map = self::resolvedMetaMap();

        if ($routeName && isset($map[$routeName])) {
            return $map[$routeName];
        }

        if ($path !== null) {
            $cleanPath = trim($path, '/');
            if (isset($map[$cleanPath])) {
                return $map[$cleanPath];
            }
            if (isset($map['/' . $cleanPath])) {
                return $map['/' . $cleanPath];
            }
        }

        return [];
    }

    private static function resolvedMetaMap(): array
    {
        if (self::$resolvedMetaMap !== null) {
            return self::$resolvedMetaMap;
        }

        $metaMap = SeoPageCatalog::defaultMetaMap();

        // 1. Overlay Page table from database (if available)
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('pages')) {
                $dbPages = Page::all();
                foreach ($dbPages as $p) {
                    $rName = $p->route_name;
                    if (!$rName) {
                        continue;
                    }

                    if (!isset($metaMap[$rName])) {
                        $metaMap[$rName] = [
                            'title' => '',
                            'description' => '',
                            'keywords' => '',
                            'image' => '',
                            'status' => 'published',
                        ];
                    }

                    if (!empty($p->title)) {
                        $metaMap[$rName]['title'] = trim((string) $p->title);
                    }
                    if (!empty($p->description)) {
                        $metaMap[$rName]['description'] = trim((string) $p->description);
                    }
                    if (!empty($p->keywords)) {
                        $metaMap[$rName]['keywords'] = trim((string) $p->keywords);
                    }
                    if (!empty($p->social_image)) {
                        $metaMap[$rName]['image'] = trim((string) $p->social_image);
                    }
                    if (!empty($p->status)) {
                        $metaMap[$rName]['status'] = trim((string) $p->status);
                    }
                }
            }
        } catch (Throwable $exception) {}

        // 2. Overlay SiteLayoutSetting (Admin Page Meta overrides)
        try {
            $setting = SiteLayoutSetting::query()
                ->where('key', SiteLayoutSetting::MAIN_KEY)
                ->first();

            $overrides = is_array($setting?->data)
                ? ($setting->data['page_meta'] ?? [])
                : [];
        } catch (Throwable $exception) {
            $overrides = [];
        }

        foreach ($overrides as $routeName => $meta) {
            if (! is_array($meta)) {
                continue;
            }

            if (!isset($metaMap[$routeName])) {
                $metaMap[$routeName] = [
                    'title' => '',
                    'description' => '',
                    'keywords' => '',
                    'image' => '',
                    'status' => 'published',
                ];
            }

            $title = trim((string) ($meta['title'] ?? ''));
            $description = trim((string) ($meta['description'] ?? ''));
            $keywords = trim((string) ($meta['keywords'] ?? ''));
            $image = trim((string) ($meta['image'] ?? ''));
            $status = trim((string) ($meta['status'] ?? ''));

            if ($title !== '') {
                $metaMap[$routeName]['title'] = $title;
            }

            if ($description !== '') {
                $metaMap[$routeName]['description'] = $description;
            }

            if ($keywords !== '') {
                $metaMap[$routeName]['keywords'] = $keywords;
            }

            if ($image !== '') {
                $metaMap[$routeName]['image'] = $image;
            }

            if ($status !== '') {
                $metaMap[$routeName]['status'] = $status;
            }
        }

        return self::$resolvedMetaMap = $metaMap;
    }
}
