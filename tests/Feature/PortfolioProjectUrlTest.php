<?php

namespace Tests\Feature;

use App\Models\Portfolio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioProjectUrlTest extends TestCase
{
    use RefreshDatabase;

    public function test_portfolios_page_is_served_from_plural_route_and_singular_route_redirects(): void
    {
        $this->get('/portfolios')
            ->assertOk();

        $this->get('/portfolio')
            ->assertRedirect('/portfolios');
    }

    public function test_portfolio_model_builds_absolute_project_url_for_relative_paths(): void
    {
        $portfolio = new Portfolio([
            'website_url' => '/flipbook/docs/index.html',
        ]);

        $this->assertSame(url('flipbook/docs/index.html'), $portfolio->website_href);
    }

    public function test_portfolios_page_uses_the_first_available_admin_category_and_shows_six_items(): void
    {
        foreach (range(1, 7) as $number) {
            Portfolio::query()->create([
                'title' => 'Wordpress Portfolio ' . $number,
                'slug' => 'wordpress-portfolio-' . $number,
                'category_name' => 'Wordpress development',
                'category_slug' => 'wordpress-development',
                'image' => 'uploads/portfolio/wordpress-portfolio-' . $number . '.jpg',
                'published_at' => now()->subMinutes($number),
                'status' => 'published',
                'sort_order' => $number,
            ]);
        }

        Portfolio::query()->create([
            'title' => 'Shopify Portfolio 1',
            'slug' => 'shopify-portfolio-1',
            'category_name' => 'Shopify',
            'category_slug' => 'shopify',
            'image' => 'uploads/portfolio/shopify-portfolio-1.jpg',
            'published_at' => now(),
            'status' => 'published',
            'sort_order' => 20,
        ]);

        $response = $this->get('/portfolios');

        $response->assertOk()
            ->assertViewHas('activePortfolioCategory', 'wordpress-development')
            ->assertViewHas('visiblePortfolioItems', function ($items): bool {
                return collect($items)->count() === 6
                    && collect($items)->pluck('title')->all() === [
                        'Wordpress Portfolio 1',
                        'Wordpress Portfolio 2',
                        'Wordpress Portfolio 3',
                        'Wordpress Portfolio 4',
                        'Wordpress Portfolio 5',
                        'Wordpress Portfolio 6',
                    ];
            })
            ->assertViewHas('visiblePortfolioTotalPages', 2);
    }

    public function test_portfolios_page_categories_come_from_published_admin_records(): void
    {
        Portfolio::query()->create([
            'title' => 'Shopify Portfolio 1',
            'slug' => 'shopify-portfolio-1',
            'category_name' => 'Shopify',
            'category_slug' => 'shopify',
            'image' => 'uploads/portfolio/shopify-portfolio-1.jpg',
            'published_at' => now(),
            'status' => 'published',
            'sort_order' => 1,
        ]);

        Portfolio::query()->create([
            'title' => 'Wix Portfolio 1',
            'slug' => 'wix-portfolio-1',
            'category_name' => 'Wix development',
            'category_slug' => 'wix-development',
            'image' => 'uploads/portfolio/wix-portfolio-1.jpg',
            'published_at' => now()->subMinute(),
            'status' => 'published',
            'sort_order' => 2,
        ]);

        $response = $this->get('/portfolios');

        $response->assertOk()
            ->assertViewHas('portfolioCategories', function ($categories): bool {
                return collect($categories)->pluck('slug')->all() === [
                    'wix-development',
                    'shopify',
                ];
            })
            ->assertViewHas('portfolioPagePayload', function ($payload): bool {
                return ($payload['activeCategory'] ?? null) === 'wix-development'
                    && ($payload['itemsPerPage'] ?? null) === 6;
            });
    }

    public function test_portfolios_page_defaults_to_the_only_available_admin_category(): void
    {
        Portfolio::query()->create([
            'title' => 'Shopify Portfolio 1',
            'slug' => 'shopify-portfolio-1',
            'category_name' => 'Shopify',
            'category_slug' => 'shopify',
            'image' => 'uploads/portfolio/shopify-portfolio-1.jpg',
            'published_at' => now(),
            'status' => 'published',
            'sort_order' => 1,
        ]);

        $response = $this->get('/portfolios');

        $response->assertOk()
            ->assertViewHas('activePortfolioCategory', 'shopify')
            ->assertViewHas('visiblePortfolioItems', function ($items): bool {
                return collect($items)->pluck('title')->all() === ['Shopify Portfolio 1'];
            });
    }

    public function test_portfolios_page_groups_records_by_admin_category_slug_even_when_names_differ(): void
    {
        Portfolio::query()->create([
            'title' => 'React Portfolio 1',
            'slug' => 'react-portfolio-1',
            'category_name' => 'React js development',
            'category_slug' => 'react-js-development',
            'image' => 'uploads/portfolio/react-portfolio-1.jpg',
            'published_at' => now(),
            'status' => 'published',
            'sort_order' => 1,
        ]);

        Portfolio::query()->create([
            'title' => 'React Portfolio 2',
            'slug' => 'react-portfolio-2',
            'category_name' => 'React Js Development',
            'category_slug' => 'react-js-development',
            'image' => 'uploads/portfolio/react-portfolio-2.jpg',
            'published_at' => now()->subMinute(),
            'status' => 'published',
            'sort_order' => 2,
        ]);

        $response = $this->get('/portfolios');

        $response->assertOk()
            ->assertViewHas('portfolioCategories', function ($categories): bool {
                $reactCategory = collect($categories)->firstWhere('slug', 'react-js-development');

                return is_array($reactCategory)
                    && ($reactCategory['name'] ?? null) === 'React js development'
                    && ($reactCategory['total'] ?? null) === 2;
            })
            ->assertViewHas('portfolioPagePayload', function ($payload): bool {
                return collect($payload['items'] ?? [])
                    ->where('category_slug', 'react-js-development')
                    ->pluck('title')
                    ->all() === ['React Portfolio 1', 'React Portfolio 2'];
            });
    }

    public function test_portfolio_image_url_falls_back_to_remote_image_when_local_mirror_is_missing(): void
    {
        $portfolio = new Portfolio([
            'image' => 'https://sortiqsolutions.com/wp-content/uploads/2026/04/remote-portfolio-card.jpg',
        ]);

        $this->assertSame(
            'https://sortiqsolutions.com/wp-content/uploads/2026/04/remote-portfolio-card.jpg',
            $portfolio->image_url
        );
    }
}
