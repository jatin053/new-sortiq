<?php

namespace App\Http\Controllers;

use App\Models\RobotsSetting;
use Illuminate\Support\Facades\Cache;

class RobotsController extends Controller
{
    /**
     * Generate the robots.txt output dynamically.
     */
    public function __invoke()
    {
        $path = public_path('robots.txt');
        if (file_exists($path) && is_readable($path)) {
            $content = file_get_contents($path);
        } else {
            $settings = Cache::remember('robots_txt_settings', now()->addDay(), function () {
                return RobotsSetting::firstOrCreate(['id' => 1], RobotsSetting::defaults());
            });
            $content = $settings->custom_rules ?: $this->generateRobotsTxt($settings);
        }

        return response($content, 200)
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    /**
     * Build the robots.txt content according to settings.
     */
    protected function generateRobotsTxt(RobotsSetting $settings): string
    {
        $mode = $settings->crawling_mode;

        // If maintenance or development mode, block everything
        if ($mode === 'maintenance' || $mode === 'development') {
            return "User-agent: *\nDisallow: /";
        }

        // Under custom mode, if frontend crawling is disabled, block everything
        if ($mode === 'custom' && !$settings->allow_frontend) {
            return "User-agent: *\nDisallow: /";
        }

        // Otherwise, allow crawling and append specific disallow rules
        $rules = [];

        // Search Engines & Generative AI Crawlers (GEO compliance)
        $bots = [
            'Googlebot',
            'Bingbot',
            'Applebot',
            'Applebot-Extended',
            'GPTBot',
            'ChatGPT-User',
            'ClaudeBot',
            'Claude-Web',
            'PerplexityBot',
            'Amazonbot',
        ];
        foreach ($bots as $bot) {
            $rules[] = "User-agent: {$bot}";
            $rules[] = "Allow: /";
            $rules[] = "";
        }

        $rules[] = "User-agent: *";
        $rules[] = "Allow: /";

        // Block Backend / Admin
        if ($settings->block_backend) {
            $rules[] = "Disallow: /admin/";
            $rules[] = "Disallow: /sortiqadmin/";
        }

        // Block API
        if ($settings->block_api) {
            $rules[] = "Disallow: /api/";
        }

        // Block Login / Auth
        if ($settings->block_login) {
            $rules[] = "Disallow: /login";
            $rules[] = "Disallow: /logout";
            $rules[] = "Disallow: /register";
            $rules[] = "Disallow: /password/";
        }

        // Block Images
        if ($settings->block_images) {
            $rules[] = "Disallow: /images/";
            $rules[] = "Disallow: /storage/";
        }

        // Block CSS
        if ($settings->block_css) {
            $rules[] = "Disallow: /css/";
            $rules[] = "Disallow: /build/assets/*.css";
        }

        // Block JS
        if ($settings->block_js) {
            $rules[] = "Disallow: /js/";
            $rules[] = "Disallow: /build/assets/*.js";
        }

        // Custom Rules / Blocked Paths
        if ($settings->custom_rules) {
            $customLines = explode("\n", str_replace("\r", "", $settings->custom_rules));
            foreach ($customLines as $line) {
                $line = trim($line);
                if ($line === '') {
                    continue;
                }

                // If user wrote directive like Disallow: ... or Allow: ...
                if (preg_match('/^(Disallow|Allow):\s*(.*)$/i', $line, $matches)) {
                    $directive = ucfirst(strtolower($matches[1]));
                    $target = trim($matches[2]);
                    if (preg_match('/^https?:\/\//i', $target)) {
                        $parsedPath = parse_url($target, PHP_URL_PATH) ?: '/';
                        $rules[] = "{$directive}: {$parsedPath}";
                    } else {
                        $targetPath = str_starts_with($target, '/') ? $target : ('/' . $target);
                        $rules[] = "{$directive}: {$targetPath}";
                    }
                } elseif (preg_match('/^(Sitemap|User-agent):/i', $line)) {
                    $rules[] = $line;
                } else {
                    // Raw path or full URL pasted by user -> block it
                    if (preg_match('/^https?:\/\//i', $line)) {
                        $parsedPath = parse_url($line, PHP_URL_PATH) ?: '/';
                        $rules[] = "Disallow: " . $parsedPath;
                    } else {
                        $cleanPath = str_starts_with($line, '/') ? $line : ('/' . $line);
                        $rules[] = "Disallow: " . $cleanPath;
                    }
                }
            }
        }

        // Include Sitemap
        if ($settings->include_sitemap) {
            $siteUrl = rtrim(url('/'), '/');
            $rules[] = "Sitemap: {$siteUrl}/sitemap.xml";
        }

        return implode("\n", $rules);
    }
}
