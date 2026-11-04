<?php

namespace App\Models;

use App\Support\LocalMedia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    public const CATEGORY_OPTIONS = [
        'wordpress-development' => 'Wordpress development',
        'wix-development' => 'Wix development',
        'shopify' => 'Shopify',
        'react-js-development' => 'React js development',
        'elementor-page-builder' => 'ELEMENTOR page builder',
        'learndash' => 'Learndash',
        'woocommerce' => 'Woocommerce',
        'squarespace' => 'Squarespace',
        'webflow' => 'WebFlow',
        'show-it' => 'Showit',
        'laravel' => 'Laravel',
        'graphic-designing' => 'Graphic Designing',
        'ui-ux' => 'UI/UX',
    ];

    protected $fillable = [
        'title',
        'slug',
        'category_name',
        'category_slug',
        'tags',
        'image',
        'website_url',
        'summary',
        'content',
        'published_at',
        'status',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'sort_order' => 'integer',
            'tags' => 'array',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? $this->getRouteKeyName(), $value)
            ->orWhere('id', $value)
            ->firstOrFail();
    }

    public function scopePublished(Builder $query): Builder
    {
        $query->where('status', 'published');

        return $query;
    }

    public function scopeOrdered(Builder $query): Builder
    {
        $query->orderBy('sort_order', 'asc');
        $query->orderBy('published_at', 'desc');
        $query->orderBy('id', 'desc');

        return $query;
    }

    public function getImageUrlAttribute(): ?string
    {
        $image = trim((string) $this->image);

        if ($this->isMissingLocalUploadPath($image)) {
            return null;
        }

        return LocalMedia::url($image) ?: (Str::startsWith($image, ['http://', 'https://', '//']) ? $image : null);
    }

    public function getWebsiteHrefAttribute(): ?string
    {
        $websiteUrl = trim((string) $this->website_url);

        if ($websiteUrl === '') {
            return null;
        }

        if (Str::startsWith($websiteUrl, ['http://', 'https://', '//'])) {
            return $websiteUrl;
        }

        return url(ltrim($websiteUrl, '/'));
    }

    public function getPublishedLabelAttribute(): string
    {
        if ($this->published_at) {
            return $this->published_at->format('Y/m/d \a\t g:i a');
        }

        return 'Not published';
    }

    private function isMissingLocalUploadPath(string $image): bool
    {
        if ($image === '' || Str::startsWith($image, ['http://', 'https://', '//'])) {
            return false;
        }

        $relativePath = ltrim($image, '/');

        return Str::startsWith($relativePath, 'uploads/') && ! is_file(public_path($relativePath));
    }
}
