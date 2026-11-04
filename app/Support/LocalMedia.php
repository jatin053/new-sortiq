<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class LocalMedia
{
    private const LEGACY_MIRRORED_PATHS = [
        'external/istockphoto/business-woman-with-finger-pressing-laravel-button-on-virtual-screens-21dff05275.webp' => 'frontend-assets/media/services/covers/laravel-development-cover.webp',
        'external/istockphoto/crm-on-digital-background-d75a06c5e0.webp' => 'frontend-assets/media/services/covers/zoho-crm-cover.webp',
        'external/istockphoto/man-hand-using-a-calculator-and-fill-in-the-income-tax-online-return-form-for-payment-a2934818c6.webp' => 'frontend-assets/media/services/covers/website-maintenance-cover.webp',
        'external/unsplash/photo-1450101499163-c8848c66ca85-eac8420083.webp' => 'frontend-assets/media/pages/terms/terms-hero.webp',
        'external/unsplash/photo-1485846234645-a62644f84728-a4e24398d8.webp' => 'frontend-assets/media/pages/videos/videos-hero.webp',
        'external/unsplash/photo-1497215728101-856f4ea42174-d6af247c66.webp' => 'frontend-assets/media/pages/portfolio/portfolio-hero.webp',
        'external/unsplash/photo-1497366216548-37526070297c-806688d06e.webp' => 'frontend-assets/media/pages/faq/faq-hero.webp',
        'external/unsplash/photo-1498050108023-c5249f4df085-8bde67640b.webp' => 'frontend-assets/media/pages/internship/internship-hero.webp',
        'external/unsplash/photo-1521737711867-e3b97375f902-5743808952.webp' => 'frontend-assets/media/pages/why-us/why-us-background.webp',
        'external/unsplash/photo-1522071820081-009f0129c71c-1419ff3b7a.webp' => 'frontend-assets/media/pages/about/about-hero.webp',
        'external/unsplash/photo-1522071820081-009f0129c71c-5dc5d482cb.webp' => 'frontend-assets/media/pages/shared/fresher-hiring-modal.webp',
        'external/unsplash/photo-1550751827-4bd374c3f58b-a81ceca5c3.webp' => 'frontend-assets/media/pages/internship/internship-technology-background.webp',
        'external/unsplash/photo-1557683316-973673baf926-71827985f9.webp' => 'frontend-assets/media/pages/internship/internship-offerings-background.webp',
        'external/unsplash/photo-1573496359142-b8d87734a5a2-a4e0d6f367.webp' => 'frontend-assets/media/pages/about/about-team-photo.webp',
        'external/unsplash/photo-1633356122544-f134324a6cee-7a4446c886.webp' => 'frontend-assets/media/services/covers/react-development-cover.webp',
        'external/unsplash/photo-1644088379091-d574269d422f-ea808660eb.webp' => 'frontend-assets/media/pages/expertise/expertise-background.webp',
        'external/unsplash/premium-photo-1661382011487-cd3d6b1d9dff-e8c660f03b.webp' => 'frontend-assets/media/services/covers/graphic-design-cover.webp',
        'external/unsplash/premium-photo-1673425238678-d478060d5813-0028c864e3.webp' => 'frontend-assets/media/services/backgrounds/why-choose-us-background.webp',
        'external/unsplash/premium-photo-1673425238678-d478060d5813-118744d4ac.webp' => 'frontend-assets/media/services/backgrounds/why-choose-us-background-alt.webp',
        'external/unsplash/premium-photo-1681487178876-a1156952ec60-022d875f52.webp' => 'frontend-assets/media/pages/careers/careers-hero.webp',
        'external/unsplash/premium-photo-1683288706414-e678ce71d7ac-6f100ab6dc.webp' => 'frontend-assets/media/services/covers/social-media-optimization-cover.webp',
        'external/unsplash/premium-photo-1684785618727-378a3a5e91c5-2bdc6ac5ae.webp' => 'frontend-assets/media/services/covers/ecommerce-development-cover.webp',
        'external/unsplash/premium-photo-1764691292167-7263c8b464c0-f572e71d32.webp' => 'frontend-assets/media/services/backgrounds/maintenance-why-choose-us-background.webp',
        'external/wixstatic/software-testing-cover-9e31885bfc.webp' => 'frontend-assets/media/services/covers/software-testing-cover.webp',
        'external/wixstatic/wordpress-cover-39381ef94c.webp' => 'frontend-assets/media/services/covers/wordpress-development-cover.webp',
        'flags/in.webp' => 'frontend-assets/media/flags/india.webp',
        'lottie/3oMb4N7959.lottie' => 'frontend-assets/media/animations/home/custom-software-development.lottie',
        'lottie/pvfI7Vi812.lottie' => 'frontend-assets/media/animations/home/web-mobile-app-development.lottie',
        'lottie/vhqqVoh2og.lottie' => 'frontend-assets/media/animations/home/digital-transformation.lottie',
        'sortiqsolutions/2025/01/Explore-our-Web-Desing-Development-Projects.webp' => 'frontend-assets/media/pages/home/portfolio-showcase.webp',
        'sortiqsolutions/2025/02/banner-design-cover.webp' => 'frontend-assets/media/services/covers/banner-design-cover.webp',
        'sortiqsolutions/2025/02/cms-icon.webp' => 'frontend-assets/media/pages/home/icons/cms-solutions-icon.webp',
        'sortiqsolutions/2025/02/cms-solution-icon.webp' => 'frontend-assets/media/pages/expertise/icons/cms-solutions-icon.webp',
        'sortiqsolutions/2025/02/codeIgniter-cover.webp' => 'frontend-assets/media/services/covers/codeigniter-development-cover.webp',
        'sortiqsolutions/2025/02/content-strategy-blue-icon.webp' => 'frontend-assets/media/pages/expertise/icons/content-strategy-icon.webp',
        'sortiqsolutions/2025/02/content-strategy-icon.webp' => 'frontend-assets/media/pages/home/icons/content-strategy-icon.webp',
        'sortiqsolutions/2025/02/crm-integration-vector.webp' => 'frontend-assets/media/pages/why-us/icons/crm-integration-icon.webp',
        'sortiqsolutions/2025/02/custom-theme-plugin-development.webp' => 'frontend-assets/media/pages/why-us/icons/custom-theme-plugin-icon.webp',
        'sortiqsolutions/2025/02/dark-background.webp' => 'frontend-assets/media/services/backgrounds/contact-cta-background.webp',
        'sortiqsolutions/2025/02/development-coding.webp' => 'frontend-assets/media/services/process/development-and-coding.webp',
        'sortiqsolutions/2025/02/digital-marketing-blue-icon.webp' => 'frontend-assets/media/pages/expertise/icons/digital-marketing-icon.webp',
        'sortiqsolutions/2025/02/digital-marketing-cover.webp' => 'frontend-assets/media/services/covers/digital-marketing-cover.webp',
        'sortiqsolutions/2025/02/digital-marketing-icon.webp' => 'frontend-assets/media/pages/home/icons/digital-marketing-icon.webp',
        'sortiqsolutions/2025/02/discover-and-strategy.webp' => 'frontend-assets/media/services/process/discovery-and-strategy.webp',
        'sortiqsolutions/2025/02/framework-blue-icon.webp' => 'frontend-assets/media/pages/expertise/icons/framework-icon.webp',
        'sortiqsolutions/2025/02/framework-development-icon.webp' => 'frontend-assets/media/pages/home/icons/framework-development-icon.webp',
        'sortiqsolutions/2025/02/graphic-design-blue-icon.webp' => 'frontend-assets/media/pages/expertise/icons/graphic-design-icon.webp',
        'sortiqsolutions/2025/02/graphic-design-icon.webp' => 'frontend-assets/media/pages/home/icons/graphic-design-icon.webp',
        'sortiqsolutions/2025/02/laravel-development-cover.webp' => 'frontend-assets/media/services/covers/hubspot-crm-cover.webp',
        'sortiqsolutions/2025/02/launch-icon.webp' => 'frontend-assets/media/services/process/launch-and-deployment.webp',
        'sortiqsolutions/2025/02/logo-design-cover.webp' => 'frontend-assets/media/services/covers/logo-design-cover.webp',
        'sortiqsolutions/2025/02/maintenance-and-optimization.webp' => 'frontend-assets/media/services/process/maintenance-and-optimization.webp',
        'sortiqsolutions/2025/02/mern-stack-development-blue-icon.webp' => 'frontend-assets/media/pages/expertise/icons/mern-stack-icon.webp',
        'sortiqsolutions/2025/02/mern-stack-development-icon.webp' => 'frontend-assets/media/pages/home/icons/mern-stack-development-icon.webp',
        'sortiqsolutions/2025/02/mernstack-cover.webp' => 'frontend-assets/media/services/covers/mern-development-cover.webp',
        'sortiqsolutions/2025/02/mobile-app-development-blue-icon.webp' => 'frontend-assets/media/pages/expertise/icons/mobile-app-development-icon.webp',
        'sortiqsolutions/2025/02/mobile-app-icon.webp' => 'frontend-assets/media/pages/home/icons/mobile-app-development-icon.webp',
        'sortiqsolutions/2025/02/php-cover.webp' => 'frontend-assets/media/services/covers/php-development-cover.webp',
        'sortiqsolutions/2025/02/product-management.webp' => 'frontend-assets/media/pages/why-us/icons/product-management-icon.webp',
        'sortiqsolutions/2025/02/seo-cover.webp' => 'frontend-assets/media/services/covers/seo-cover.webp',
        'sortiqsolutions/2025/02/shopify-cover.webp' => 'frontend-assets/media/services/covers/ecommerce-platform-cover.webp',
        'sortiqsolutions/2025/02/support-maintenance.webp' => 'frontend-assets/media/pages/why-us/icons/support-maintenance-icon.webp',
        'sortiqsolutions/2025/02/testing-assurance-image.webp' => 'frontend-assets/media/services/process/testing-and-assurance.webp',
        'sortiqsolutions/2025/02/web-design-blue-icon.webp' => 'frontend-assets/media/pages/expertise/icons/web-design-icon.webp',
        'sortiqsolutions/2025/02/web-design-cover.webp' => 'frontend-assets/media/services/covers/web-design-cover.webp',
        'sortiqsolutions/2025/02/web-development-cover.webp' => 'frontend-assets/media/services/covers/web-development-cover.webp',
        'sortiqsolutions/2025/02/website-development-blue-icon.webp' => 'frontend-assets/media/pages/expertise/icons/website-development-icon.webp',
        'sortiqsolutions/2025/02/website-development-icon.webp' => 'frontend-assets/media/pages/home/icons/website-development-icon.webp',
        'sortiqsolutions/2025/02/wireframing-design.webp' => 'frontend-assets/media/services/process/wireframing-and-design.webp',
        'sortiqsolutions/2025/03/app-development.webp' => 'frontend-assets/media/services/covers/app-development-cover.webp',
        'sortiqsolutions/2025/03/custom-solutions-image.webp' => 'frontend-assets/media/pages/home/conversion-driven-development.webp',
        'sortiqsolutions/2025/03/nodejs-for-backend.webp' => 'frontend-assets/media/services/covers/node-js-development-cover.webp',
        'sortiqsolutions/2025/03/online-support-icon.webp' => 'frontend-assets/media/pages/home/long-term-growth-partner.webp',
        'sortiqsolutions/2025/03/quality-and-timeless-image.webp' => 'frontend-assets/media/pages/home/data-driven-marketing.webp',
        'sortiqsolutions/2025/03/tech-expertise-image.webp' => 'frontend-assets/media/pages/home/strategy-first-approach.webp',
        'sortiqsolutions/2025/03/view-js-development.webp' => 'frontend-assets/media/services/covers/vue-js-development-cover.webp',
        'sortiqsolutions/2025/06/iso-certified-company-image.webp' => 'frontend-assets/media/brand/badges/iso-certified-badge.webp',
        'sortiqsolutions/2025/11/EN_legend_small.webp' => 'frontend-assets/media/brand/badges/wix-partner-badge.webp',
        'sortiqsolutions/2025/11/GF-min.webp' => 'frontend-assets/media/brand/badges/goodfirms-badge.webp',
        'sortiqsolutions/2025/11/cybersecurity.webp' => 'frontend-assets/media/services/covers/cyber-security-cover.webp',
        'sortiqsolutions/2025/11/digital-marketing-logo-min.webp' => 'frontend-assets/media/brand/badges/google-analytics-badge.webp',
        'sortiqsolutions/2025/11/upwork-logo-min.webp' => 'frontend-assets/media/brand/badges/upwork-badge.webp',
        'sortiqsolutions/2026/03/ASSA_Logo_FC_Grad.webp' => 'frontend-assets/media/brand/clients/australian-swim-schools-association-logo.webp',
        'sortiqsolutions/2026/03/Acknowlages-Google-analytics-300x300.webp' => 'frontend-assets/media/brand/certifications/google-analytics-certificate.webp',
        'sortiqsolutions/2026/03/Certified-by-wix-studio-300x300.webp' => 'frontend-assets/media/brand/certifications/certified-wix-studio-certificate.webp',
        'sortiqsolutions/2026/03/Perry.webp' => 'frontend-assets/media/brand/clients/perry-logo.webp',
        'sortiqsolutions/2026/03/Semrush-Academy-300x300.webp' => 'frontend-assets/media/brand/certifications/semrush-academy-certificate.webp',
        'sortiqsolutions/2026/03/Think-Decks.webp' => 'frontend-assets/media/brand/clients/think-decks-logo.webp',
        'sortiqsolutions/2026/03/Untitled-2-300x300.webp' => 'frontend-assets/media/brand/certifications/content-marketing-certificate.webp',
        'sortiqsolutions/2026/03/image.webp' => 'frontend-assets/media/brand/clients/moves-brands-wordmark.webp',
        'sortiqsolutions/2026/03/just-dial-300x300.webp' => 'frontend-assets/media/brand/certifications/justdial-certificate.webp',
        'sortiqsolutions/2026/03/logo-header-dark-2023@2x.png.webp' => 'frontend-assets/media/brand/clients/moves-brands-logo.webp',
        'sortiqsolutions/2026/03/mbc-rev-logo.webp' => 'frontend-assets/media/brand/clients/mbc-rev-logo.webp',
        'sortiqsolutions/2026/03/wix-studio-300x300.webp' => 'frontend-assets/media/brand/certifications/wix-studio-certificate.webp',
        'sortiqsolutions/2026/03/wix-web-designer-300x300.webp' => 'frontend-assets/media/brand/certifications/wix-web-designer-certificate.webp',
        'sortiqsolutions/2026/03/zeitgeist-z.webp' => 'frontend-assets/media/brand/clients/zeitgeist-logo.webp',
        'sortiqsolutions/elementor/thumbs/wix-partner-rendr7au0yttdewf0w3mmbcwpb2d3jpuj8vy8thjyc.webp' => 'frontend-assets/media/brand/partners/wix-partner-showcase.webp',
    ];

    public static function url(?string $value): ?string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return null;
        }

        if (! self::isRemote($value)) {
            return asset(ltrim($value, '/'));
        }

        $path = self::mirroredPath($value);

        if ($path === null || ! is_file(public_path($path))) {
            return null;
        }

        return asset($path);
    }

    public static function mirroredPath(?string $value): ?string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return null;
        }

        if (! self::isRemote($value)) {
            return ltrim($value, '/');
        }

        $normalizedUrl = self::normalizeUrl(html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        $host = strtolower((string) parse_url($normalizedUrl, PHP_URL_HOST));
        $path = (string) parse_url($normalizedUrl, PHP_URL_PATH);

        if ($host === '' || $path === '') {
            return null;
        }

        if ($host === 'sortiqsolutions.com' && Str::startsWith($path, '/wp-content/uploads/')) {
            $relativePath = Str::after($path, '/wp-content/uploads/');
            $legacyPath = 'sortiqsolutions/' . preg_replace('/\.[^.\/]+$/', '.webp', ltrim($relativePath, '/'));

            return self::remapLegacyMirroredPath(
                $legacyPath,
                'frontend-assets/media/imports/sortiqsolutions/' . basename($legacyPath)
            );
        }

        if ($host === 'lottie.host') {
            $basename = basename($path);

            return self::remapLegacyMirroredPath(
                'lottie/' . $basename,
                'frontend-assets/media/imports/lottie/' . $basename
            );
        }

        if ($host === 'flagcdn.com' && $path === '/w20/in.png') {
            return self::remapLegacyMirroredPath(
                'flags/in.webp',
                'frontend-assets/media/flags/india.webp'
            );
        }

        $provider = match (true) {
            Str::endsWith($host, 'unsplash.com') => 'unsplash',
            Str::endsWith($host, 'istockphoto.com') => 'istockphoto',
            Str::endsWith($host, 'wixstatic.com') => 'wixstatic',
            Str::contains($host, 'transparenttextures.com') => 'transparenttextures',
            default => Str::slug($host),
        };

        $filename = pathinfo($path, PATHINFO_FILENAME);
        $filename = $filename !== '' ? Str::slug($filename) : 'asset';

        $legacyPath = 'external/'
            . $provider
            . '/'
            . $filename
            . '-'
            . substr(sha1($normalizedUrl), 0, 10)
            . '.webp';

        return self::remapLegacyMirroredPath(
            $legacyPath,
            'frontend-assets/media/imports/external/' . $provider . '/' . basename($legacyPath)
        );
    }

    public static function legacyMirroredPathMap(): array
    {
        return self::LEGACY_MIRRORED_PATHS;
    }

    public static function storeUploadedFile(UploadedFile $file, string $directory, string $baseName): string
    {
        $directory = trim(str_replace('\\', '/', $directory), '/');
        $targetDirectory = public_path($directory);

        if (! is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }

        $extension = strtolower($file->getClientOriginalExtension()) ?: 'bin';
        $filename = self::generateUploadedFilename($targetDirectory, $baseName, $extension);

        $file->move($targetDirectory, $filename);

        return $directory . '/' . $filename;
    }

    public static function generateUploadedFilename(string $targetDirectory, string $baseName, string $extension): string
    {
        $extension = strtolower(trim($extension)) ?: 'bin';
        $baseSlug = self::normalizeUploadBaseName($baseName);
        $targetDirectory = rtrim($targetDirectory, "\\/ \t\n\r\0\x0B");
        $filename = $baseSlug . '.' . $extension;
        $suffix = 2;

        while (is_file($targetDirectory . DIRECTORY_SEPARATOR . $filename)) {
            $filename = $baseSlug . '-' . $suffix . '.' . $extension;
            $suffix++;
        }

        return $filename;
    }

    public static function deleteUploadedFile(?string $path): void
    {
        $path = trim((string) $path);

        if ($path === '' || self::isRemote($path) || ! Str::startsWith(ltrim($path, '/'), 'uploads/')) {
            return;
        }

        $absolutePath = public_path(ltrim($path, '/'));

        if (is_file($absolutePath)) {
            @unlink($absolutePath);
        }
    }

    private static function isRemote(string $value): bool
    {
        return Str::startsWith($value, ['http://', 'https://']);
    }

    private static function normalizeUrl(string $url): string
    {
        $extraPlusUrl = '://plus.unsplash.com/';
        $duplicateIndex = strpos($url, $extraPlusUrl, 10);

        if ($duplicateIndex !== false) {
            $url = substr($url, 0, $duplicateIndex);
        }

        return trim($url);
    }

    private static function normalizeUploadBaseName(string $baseName): string
    {
        $baseSlug = Str::slug($baseName ?: 'media');
        $baseSlug = trim(substr($baseSlug, 0, 60), '-');

        return $baseSlug !== '' ? $baseSlug : 'media';
    }

    private static function remapLegacyMirroredPath(string $legacyPath, string $fallbackPath): string
    {
        return self::LEGACY_MIRRORED_PATHS[$legacyPath] ?? ltrim($fallbackPath, '/');
    }
}
