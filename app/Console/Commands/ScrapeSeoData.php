<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Blog;
use App\Support\Seo\PageMetaController;
use App\Support\Seo\SeoPageCatalog;
use App\Models\SiteLayoutSetting;
use Illuminate\Support\Facades\Http;

class ScrapeSeoData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrape-seo-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape title and description from live site and update local database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Fetching Sitemaps...");
        
        $sitemaps = [
            'https://sortiqsolutions.com/post-sitemap.xml',
            'https://sortiqsolutions.com/page-sitemap.xml'
        ];

        $urls = [];

        foreach ($sitemaps as $sitemapUrl) {
            $this->info("Loading $sitemapUrl ...");
            $response = Http::get($sitemapUrl);
            if ($response->successful()) {
                $xml = simplexml_load_string($response->body());
                if ($xml && isset($xml->url)) {
                    foreach ($xml->url as $urlNode) {
                        $urls[] = (string) $urlNode->loc;
                    }
                }
            }
        }

        $this->info("Found " . count($urls) . " URLs to scrape.");

        $pagesCatalog = SeoPageCatalog::pages();
        // flatten pages catalog for easy lookup by path
        $routeToPathMap = [];
        foreach ($pagesCatalog as $page) {
            // To get the path, we can resolve the route
            try {
                $path = route($page['route'], [], false);
                $routeToPathMap[trim($path, '/')] = $page['route'];
            } catch (\Exception $e) {
                // skip routes with required parameters that we can't resolve easily
            }
        }

        // load existing main layout settings to update page metas
        $layoutSetting = SiteLayoutSetting::firstOrCreate(
            ['key' => 'main_layout'],
            ['data' => []]
        );
        $settings = $layoutSetting->data ?? [];
        if (!is_array($settings)) {
            $settings = [];
        }
        if (!isset($settings['page_meta'])) {
            $settings['page_meta'] = [];
        }

        foreach ($urls as $url) {
            $this->info("Scraping: $url");
            $response = Http::timeout(10)->get($url);
            if (!$response->successful()) {
                $this->error("Failed to fetch $url");
                continue;
            }

            $html = $response->body();
            
            // Extract Title
            $title = '';
            if (preg_match('/<title[^>]*>(.*?)<\/title>/is', $html, $matches)) {
                $title = trim($matches[1]);
                $title = html_entity_decode($title);
            }

            // Extract Meta Description
            $description = '';
            if (preg_match('/<meta[^>]*name="description"[^>]*content="([^"]*)"[^>]*>/is', $html, $matches) || 
                preg_match('/<meta[^>]*content="([^"]*)"[^>]*name="description"[^>]*>/is', $html, $matches)) {
                $description = trim($matches[1]);
                $description = html_entity_decode($description);
            } elseif (preg_match('/<meta property="og:description" content="([^"]*)"/i', $html, $matches)) {
                $description = trim($matches[1]);
                $description = html_entity_decode($description);
            }

            // Auto-generate focus keyphrase (keywords) since it's hidden
            // We can just use the first few significant words of the title
            $keywords = '';
            if ($title) {
                $cleanTitle = preg_replace('/[^a-zA-Z0-9\s]/', '', $title);
                $words = array_filter(explode(' ', strtolower($cleanTitle)), function($w) {
                    return strlen($w) > 3 && !in_array($w, ['sortiq', 'solutions', 'with', 'from', 'this', 'that', 'best']);
                });
                $keywords = implode(', ', array_slice($words, 0, 4));
            }

            $this->line(" - Title: $title");
            $this->line(" - Desc: " . substr($description, 0, 50) . '...');
            $this->line(" - Generated Keywords: $keywords");

            $parsedUrl = parse_url($url);
            $path = trim($parsedUrl['path'] ?? '', '/');

            // Is it a blog?
            $slug = basename($path);
            if (!$slug) {
                $slug = 'home'; // home page
            }

            $blog = Blog::where('slug', $slug)->first();
            if ($blog) {
                $blog->meta_title = $title ?: $blog->title;
                $blog->meta_description = $description;
                $blog->meta_keywords = $keywords;
                $blog->save();
                $this->info("   -> Updated Blog: {$blog->title}");
                continue;
            }

            // Is it a page?
            $localPath = $path === '' ? '' : $path; // empty string for home
            if (isset($routeToPathMap[$localPath])) {
                $routeName = $routeToPathMap[$localPath];
                $settings['page_meta'][$routeName] = [
                    'title' => $title,
                    'description' => $description,
                    'keywords' => $keywords,
                ];
                $this->info("   -> Updated Page Meta for route: $routeName");
                continue;
            }

            $this->warn("   -> No local blog or page matched path: /$path (slug: $slug)");
        }

        // save page meta updates
        $layoutSetting->data = $settings;
        $layoutSetting->save();

        $this->info("Done! SEO data scraped and updated locally.");
    }
}
