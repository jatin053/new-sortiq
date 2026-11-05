<?php

namespace App\Models;

use App\Support\LocalMedia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected function categoriesList(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getCategoriesListAttribute()
        );
    }

    public function getCategoriesListAttribute(): array
    {
        if (empty($this->category_name)) {
            return [];
        }

        if (str_starts_with(trim($this->category_name), '[') && str_ends_with(trim($this->category_name), ']')) {
            $decoded = json_decode($this->category_name, true);
            if (is_array($decoded)) {
                return array_values(array_filter(array_map('trim', $decoded)));
            }
        }

        return array_values(array_filter(array_map('trim', explode(',', (string) $this->category_name))));
    }

    public function hasCategory(string $categoryName): bool
    {
        return in_array(mb_strtolower(trim($categoryName)), array_map('mb_strtolower', $this->categories_list), true);
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
