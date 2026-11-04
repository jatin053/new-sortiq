<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RobotsSetting extends Model
{
    protected $table = 'robots_settings';

    protected $fillable = [
        'crawling_mode',
        'allow_frontend',
        'block_backend',
        'block_api',
        'block_login',
        'include_sitemap',
        'block_images',
        'block_css',
        'block_js',
        'custom_rules',
    ];

    protected $casts = [
        'allow_frontend' => 'boolean',
        'block_backend' => 'boolean',
        'block_api' => 'boolean',
        'block_login' => 'boolean',
        'include_sitemap' => 'boolean',
        'block_images' => 'boolean',
        'block_css' => 'boolean',
        'block_js' => 'boolean',
    ];

    /**
     * Get recommended default settings.
     */
    public static function defaults(): array
    {
        return [
            'crawling_mode' => 'production',
            'allow_frontend' => true,
            'block_backend' => true,
            'block_api' => true,
            'block_login' => true,
            'include_sitemap' => true,
            'block_images' => false,
            'block_css' => false,
            'block_js' => false,
            'custom_rules' => null,
        ];
    }
}
