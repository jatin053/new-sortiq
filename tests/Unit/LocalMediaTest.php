<?php

namespace Tests\Unit;

use App\Support\LocalMedia;
use PHPUnit\Framework\TestCase;

class LocalMediaTest extends TestCase
{
    private string $tempDirectory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tempDirectory = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'local-media-test-' . bin2hex(random_bytes(6));

        mkdir($this->tempDirectory, 0755, true);
    }

    protected function tearDown(): void
    {
        $this->deleteDirectory($this->tempDirectory);

        parent::tearDown();
    }

    public function test_generate_uploaded_filename_uses_a_simple_slugged_name(): void
    {
        $filename = LocalMedia::generateUploadedFilename(
            $this->tempDirectory,
            'Shopify Store Redesign',
            'WEBP'
        );

        $this->assertSame('shopify-store-redesign.webp', $filename);
    }

    public function test_generate_uploaded_filename_adds_a_small_numeric_suffix_when_needed(): void
    {
        touch($this->tempDirectory . DIRECTORY_SEPARATOR . 'shopify-store-redesign.webp');
        touch($this->tempDirectory . DIRECTORY_SEPARATOR . 'shopify-store-redesign-2.webp');

        $filename = LocalMedia::generateUploadedFilename(
            $this->tempDirectory,
            'Shopify Store Redesign',
            'webp'
        );

        $this->assertSame('shopify-store-redesign-3.webp', $filename);
    }

    public function test_generate_uploaded_filename_keeps_long_names_short(): void
    {
        $filename = LocalMedia::generateUploadedFilename(
            $this->tempDirectory,
            'This is a very long file name for a portfolio image that should stay short and relevant',
            'png'
        );

        $this->assertLessThanOrEqual(60, strlen(pathinfo($filename, PATHINFO_FILENAME)));
        $this->assertStringEndsWith('.png', $filename);
    }

    public function test_mirrored_path_maps_legacy_sortiq_uploads_to_the_new_library(): void
    {
        $path = LocalMedia::mirroredPath(
            'https://sortiqsolutions.com/wp-content/uploads/2025/02/dark-background.jpg'
        );

        $this->assertSame(
            'frontend-assets/media/services/backgrounds/contact-cta-background.webp',
            $path
        );
    }

    public function test_legacy_mirrored_path_map_exposes_known_external_asset_remaps(): void
    {
        $map = LocalMedia::legacyMirroredPathMap();

        $this->assertSame(
            'frontend-assets/media/pages/portfolio/portfolio-hero.webp',
            $map['external/unsplash/photo-1497215728101-856f4ea42174-d6af247c66.webp']
        );
    }

    public function test_mirrored_path_maps_the_india_flag_to_the_new_flags_directory(): void
    {
        $path = LocalMedia::mirroredPath('https://flagcdn.com/w20/in.png');

        $this->assertSame('frontend-assets/media/flags/india.webp', $path);
    }

    private function deleteDirectory(string $directory): void
    {
        if (! is_dir($directory)) {
            return;
        }

        $items = scandir($directory);

        if ($items === false) {
            return;
        }

        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $path = $directory . DIRECTORY_SEPARATOR . $item;

            if (is_dir($path)) {
                $this->deleteDirectory($path);
                continue;
            }

            @unlink($path);
        }

        @rmdir($directory);
    }
}
