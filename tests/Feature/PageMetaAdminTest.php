<?php

namespace Tests\Feature;

use App\Models\SiteLayoutSetting;
use App\Models\User;
use App\Support\Seo\SeoPageCatalog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageMetaAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_open_page_metadata_screen(): void
    {
        $this->actingAs($this->adminUser())
            ->get(route('admin.pages.edit'))
            ->assertOk()
            ->assertSee('Choose one page to manage SEO.')
            ->assertSee('Select one page')
            ->assertSee('Choose a page to manage')
            ->assertViewHas('pageSections', []);
    }

    public function test_admin_can_open_one_selected_page_in_page_metadata_screen(): void
    {
        $this->actingAs($this->adminUser())
            ->get(route('admin.pages.edit', ['page' => 'frontend.services.seo']))
            ->assertOk()
            ->assertViewHas('selectedPage', 'frontend.services.seo')
            ->assertViewHas('pageSections', function (array $pageSections) {
                return isset($pageSections['Service Pages'])
                    && count($pageSections) === 1
                    && count($pageSections['Service Pages']) === 1
                    && $pageSections['Service Pages'][0]['route_name'] === 'frontend.services.seo';
            });
    }

    public function test_admin_can_save_page_metadata_for_public_pages(): void
    {
        $this->actingAs($this->adminUser())
            ->put(route('admin.pages.update'), [
                'pages' => $this->pagePayload(),
            ])
            ->assertRedirect(route('admin.pages.edit'))
            ->assertSessionHas('status', 'Page metadata updated successfully.');

        $setting = SiteLayoutSetting::main();

        $this->assertSame(
            'Custom Home SEO Title',
            $setting->data['page_meta']['frontend.home']['title'] ?? null
        );

        $this->get(route('frontend.home'))
            ->assertOk()
            ->assertSee('<title>Custom Home SEO Title</title>', false)
            ->assertSee(
                '<meta name="description" content="Custom home meta description from the admin pages screen.">',
                false
            );
    }

    public function test_admin_can_save_selected_page_without_overwriting_other_page_metadata(): void
    {
        SiteLayoutSetting::main()->update([
            'data' => [
                'page_meta' => [
                    'frontend.about' => [
                        'title' => 'Stored About Title',
                        'description' => 'Stored about description.',
                    ],
                ],
            ],
        ]);

        $this->actingAs($this->adminUser())
            ->put(route('admin.pages.update'), [
                'selected_page' => 'frontend.home',
                'pages' => [
                    [
                        'route_name' => 'frontend.home',
                        'title' => 'Selected Home Title',
                        'description' => 'Selected home description.',
                    ],
                ],
            ])
            ->assertRedirect(route('admin.pages.edit', ['page' => 'frontend.home']));

        $setting = SiteLayoutSetting::main();

        $this->assertSame('Selected Home Title', $setting->data['page_meta']['frontend.home']['title'] ?? null);
        $this->assertSame('Stored About Title', $setting->data['page_meta']['frontend.about']['title'] ?? null);
    }

    private function adminUser(): User
    {
        return User::factory()->create();
    }

    private function pagePayload(): array
    {
        $pages = [];

        foreach (SeoPageCatalog::pages() as $page) {
            $isHomePage = $page['route_name'] === 'frontend.home';

            $pages[] = [
                'route_name' => $page['route_name'],
                'title' => $isHomePage ? 'Custom Home SEO Title' : $page['title'],
                'description' => $isHomePage
                    ? 'Custom home meta description from the admin pages screen.'
                    : $page['description'],
            ];
        }

        return $pages;
    }
}
