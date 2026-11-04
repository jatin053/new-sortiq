<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPageSmokeTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_admin_pages_render_successfully(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $pages = [
            route('admin.dashboard'),
            route('admin.pages.edit'),
            route('admin.blogs.index'),
            route('admin.portfolios.index'),
            route('admin.videos.index'),
            route('admin.client-logos.index'),
            route('admin.reviews.index'),
            route('admin.contact-messages.index'),
        ];

        foreach ($pages as $page) {
            $response = $this->get($page);

            $this->assertTrue(
                $response->isOk(),
                "Expected [{$page}] to load successfully, but received status [{$response->getStatusCode()}]."
            );
        }
    }
}
