<?php

namespace App\Console\Commands;

use App\Models\Blog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SyncWordPressBlogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:wordpress-blogs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch latest blog posts from the custom sortiqsolutions API and sync them to the local database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $apiUrl = 'https://sortiqsolutions.com/wp-json/seocify/v1/blogs';
        
        $this->info("Fetching blogs from: {$apiUrl}");

        try {
            $page = 1;
            $totalPages = 1;
            $syncedCount = 0;

            do {
                $this->info("Fetching page {$page}...");
                
                $response = Http::get($apiUrl, [
                    'page' => $page,
                    'per_page' => 20,
                ]);

                if ($response->failed()) {
                    $this->error('Failed to connect to the WordPress API. Status: ' . $response->status());
                    return static::FAILURE;
                }

                $data = $response->json();
                
                // Set total pages from the first request
                if ($page === 1 && isset($data['total_pages'])) {
                    $totalPages = $data['total_pages'];
                }

                $posts = $data['posts'] ?? [];

                foreach ($posts as $post) {
                    $excerpt = strip_tags($post['excerpt'] ?? '');

                    // Extract the first category if available
                    $category = 'News';
                    if (!empty($post['categories_names'])) {
                        $category = $post['categories_names'][0];
                    }

                    Blog::updateOrCreate(
                        ['slug' => $post['slug']], // Search by slug to avoid duplicates
                        [
                            'title' => html_entity_decode($post['title'] ?? ''),
                            'content' => $post['content'] ?? '',
                            'excerpt' => Str::limit(html_entity_decode($excerpt), 150),
                            'image' => $post['featured_media_url'] ?? null,
                            'published_at' => Carbon::parse($post['date']),
                            'status' => 'published',
                            'category' => $category,
                        ]
                    );

                    $syncedCount++;
                }

                $page++;
            } while ($page <= $totalPages);

            $this->newLine();
            $this->info("Successfully synced {$syncedCount} blogs from the custom API!");

            return static::SUCCESS;

        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
            return static::FAILURE;
        }
    }
}
