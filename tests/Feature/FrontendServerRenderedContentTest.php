<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\ClientLogo;
use App\Models\Review;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FrontendServerRenderedContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_renders_latest_insights_from_the_database(): void
    {
        Blog::query()->create([
            'title' => 'Fresh Insight',
            'slug' => 'fresh-insight',
            'category' => 'Technology',
            'excerpt' => 'Fresh insight excerpt.',
            'content' => 'Fresh insight content.',
            'published_at' => '2026-04-22',
            'status' => 'published',
        ]);

        $response = $this->get(route('frontend.home'));

        $response->assertOk()
            ->assertSee('Latest Insights')
            ->assertSee('Fresh Insight');
    }

    public function test_support_page_renders_testimonials_from_published_reviews(): void
    {
        Review::query()->create([
            'name' => 'Ava Brooks',
            'slug' => 'ava-brooks-review',
            'platform' => 'Upwork',
            'rating' => 5,
            'published_at' => '2026-04-22',
            'status' => 'published',
            'content' => 'Support page testimonial from the database.',
            'summary' => 'Support page testimonial.',
        ]);

        $response = $this->get('/support');

        $response->assertOk()
            ->assertSee('Client Success Stories')
            ->assertSee('Ava Brooks')
            ->assertSee('Support page testimonial from the database.');
    }

    public function test_frontend_layout_uses_https_urls_when_request_is_forwarded_as_https(): void
    {
        $response = $this
            ->withServerVariables([
                'HTTP_HOST' => 'sortiqsolutions.onrender.com',
                'HTTP_X_FORWARDED_HOST' => 'sortiqsolutions.onrender.com',
                'HTTP_X_FORWARDED_PROTO' => 'https',
            ])
            ->get('/');

        $response->assertOk()
            ->assertSee('https://sortiqsolutions.onrender.com', false)
            ->assertDontSee('http://sortiqsolutions.onrender.com', false);
    }

    public function test_home_page_uses_local_static_media_references(): void
    {
        $response = $this->get(route('frontend.home'));

        $response->assertOk()
            ->assertDontSee('sortiqsolutions.com/wp-content/uploads', false)
            ->assertDontSee('images.unsplash.com', false)
            ->assertDontSee('plus.unsplash.com', false)
            ->assertDontSee('media.istockphoto.com', false)
            ->assertDontSee('static.wixstatic.com', false)
            ->assertDontSee('lottie.host', false)
            ->assertDontSee('frontend-assets/media/vercel', false)
            ->assertSee('frontend-assets/media/pages/home', false);
    }

    public function test_home_page_does_not_render_broken_deleted_client_logo_uploads(): void
    {
        ClientLogo::query()->create([
            'name' => 'BrightPath Health',
            'slug' => 'brightpath-health',
            'logo' => 'uploads/client-logos/brightpath-health.svg',
            'website' => '',
            'description' => null,
            'sort_order' => 1,
            'status' => 'published',
        ]);

        $response = $this->get(route('frontend.home'));

        $response->assertOk()
            ->assertSee('Client logos will appear here after they are added from the admin panel.')
            ->assertDontSee('uploads/client-logos/brightpath-health.svg', false);
    }

    public function test_clients_page_paginates_published_logos(): void
    {
        foreach (range(1, 13) as $index) {
            ClientLogo::query()->create([
                'name' => 'Client ' . $index,
                'slug' => 'client-' . $index,
                'logo' => '',
                'website' => '',
                'description' => null,
                'sort_order' => $index,
                'status' => 'published',
            ]);
        }

        $this->get(route('frontend.clients'))
            ->assertOk()
            ->assertSee('Client 1')
            ->assertSee('Client 13')
            ->assertSee('data-clients-page="1"', false);
    }

    public function test_videos_page_renders_local_video_files_from_the_database(): void
    {
        Video::query()->create([
            'title' => 'Local Demo Video',
            'slug' => 'local-demo-video',
            'youtube_url' => '',
            'video_file' => 'uploads/videos/local-demo-video.mp4',
            'thumbnail' => 'uploads/videos/thumbnails/local-demo-video.webp',
            'summary' => 'A locally managed demo video.',
            'published_at' => '2026-04-22',
            'status' => 'published',
            'sort_order' => 0,
            'views' => 0,
        ]);

        $response = $this->get(route('frontend.videos'));

        $response->assertOk()
            ->assertSee('uploads/videos/local-demo-video.mp4', false)
            ->assertSee('uploads/videos/thumbnails/local-demo-video.webp', false)
            ->assertDontSee('img.youtube.com', false);
    }

    public function test_home_page_renders_legacy_youtube_videos_from_the_database(): void
    {
        Video::query()->create([
            'title' => 'Legacy YouTube Video',
            'slug' => 'legacy-youtube-video',
            'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'video_file' => '',
            'thumbnail' => null,
            'summary' => 'A legacy video that still uses a YouTube URL.',
            'published_at' => '2026-04-22',
            'status' => 'published',
            'sort_order' => 0,
            'views' => 0,
        ]);

        $response = $this->get(route('frontend.home'));

        $response->assertOk()
            ->assertSee('Legacy YouTube Video')
            ->assertSee('data-video-type="youtube"', false)
            ->assertSee('https://www.youtube.com/embed/dQw4w9WgXcQ', false)
            ->assertSee('https://img.youtube.com/vi/dQw4w9WgXcQ/hqdefault.jpg', false)
            ->assertDontSee('frontend-assets/media/video-placeholder.svg', false)
            ->assertDontSee('Workflow videos will appear here after they are added from the admin panel.');
    }

    public function test_home_page_keeps_playable_videos_even_when_first_ordered_records_have_no_source(): void
    {
        foreach (range(0, 3) as $index) {
            Video::query()->create([
                'title' => 'Empty Video ' . $index,
                'slug' => 'empty-video-' . $index,
                'youtube_url' => '',
                'video_file' => '',
                'thumbnail' => null,
                'summary' => null,
                'published_at' => '2026-04-22',
                'status' => 'published',
                'sort_order' => $index,
                'views' => 0,
            ]);
        }

        Video::query()->create([
            'title' => 'Playable Workflow Video',
            'slug' => 'playable-workflow-video',
            'youtube_url' => 'https://youtu.be/9bZkp7q19f0',
            'video_file' => '',
            'thumbnail' => 'uploads/videos/thumbnails/playable-workflow-video.webp',
            'summary' => 'Playable fallback video.',
            'published_at' => '2026-04-22',
            'status' => 'published',
            'sort_order' => 10,
            'views' => 0,
        ]);

        $response = $this->get(route('frontend.home'));

        $response->assertOk()
            ->assertSee('Playable Workflow Video')
            ->assertDontSee('Workflow videos will appear here after they are added from the admin panel.');
    }
}
