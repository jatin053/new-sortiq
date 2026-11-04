<?php

namespace Tests\Feature;

use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FrontendBlogDatabaseOnlyTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_blog_detail_page_is_served_from_the_database(): void
    {
        $blog = Blog::query()->create([
            'title' => 'Database Blog Post',
            'slug' => 'database-blog-post',
            'category' => 'Technology',
            'excerpt' => 'This is a database-backed blog.',
            'content' => 'This blog content came from the database.',
            'published_at' => '2026-04-20',
            'status' => 'published',
        ]);

        $response = $this->get(route('frontend.blog.show', $blog->slug));

        $response->assertOk()
            ->assertSee('Database Blog Post')
            ->assertSee('This blog content came from the database.');
    }

    public function test_legacy_static_blog_slug_returns_not_found_when_it_does_not_exist_in_the_database(): void
    {
        $response = $this->get('/blog/website-security');

        $response->assertNotFound();
    }

    public function test_nonexistent_blog_slug_returns_not_found_without_redirect(): void
    {
        Blog::query()->create([
            'title' => 'Canonical Database Blog',
            'slug' => 'why-website-security-matters-for-your-business-growth',
            'category' => 'Technology',
            'excerpt' => 'Canonical database-backed blog.',
            'content' => 'Canonical database-backed blog content.',
            'published_at' => '2026-04-20',
            'status' => 'published',
        ]);

        $response = $this->get('/blog/website-security');

        $response->assertNotFound();
    }

    public function test_footer_recent_articles_are_loaded_from_published_database_blogs(): void
    {
        Blog::query()->create([
            'title' => 'Newest Footer Blog',
            'slug' => 'newest-footer-blog',
            'category' => 'Technology',
            'excerpt' => 'Newest published blog.',
            'content' => 'Newest published blog content.',
            'published_at' => '2026-04-20',
            'status' => 'published',
        ]);

        Blog::query()->create([
            'title' => 'Older Footer Blog',
            'slug' => 'older-footer-blog',
            'category' => 'Technology',
            'excerpt' => 'Older published blog.',
            'content' => 'Older published blog content.',
            'published_at' => '2026-04-18',
            'status' => 'published',
        ]);

        $response = $this->get(route('frontend.home'));

        $response->assertOk()
            ->assertSee('Newest Footer Blog')
            ->assertSee('Older Footer Blog')
            ->assertDontSee('Why Website Security Matters for Your Business Growth')
            ->assertDontSee('TOP IT Company in Chandigarh - Transforming Your Digital Presence');
    }
}
