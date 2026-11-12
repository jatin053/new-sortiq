<?php

namespace App\Models;

use App\Support\LocalMedia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public const CATEGORIES = [
        'Company',
        'Web Design',
        'Development',
        'Digital Marketing',
        'Technology',
        'News',
    ];

    protected $fillable = [
        'title',
        'slug',
        'image',
        'category',
        'tags',
        'excerpt',
        'content',
        'published_at',
        'status',
        'views',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'faqs',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'views' => 'integer',
            'tags' => 'array',
            'faqs' => 'array',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? $this->getRouteKeyName(), $value)
            ->when(is_numeric($value), fn (Builder $query) => $query->orWhere('id', (int) $value))
            ->firstOrFail();
    }

    public function scopePublished(Builder $query): Builder
    {
        $query->where('status', 'published');

        return $query;
    }

    public function scopeOrdered(Builder $query): Builder
    {
        $query->orderBy('published_at', 'desc');
        $query->orderBy('id', 'desc');

        return $query;
    }

    public function getImageUrlAttribute(): ?string
    {
        return LocalMedia::url($this->image) ?: (str_starts_with((string) $this->image, 'http') ? $this->image : null);
    }

    protected function categoriesList(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getCategoriesListAttribute()
        );
    }

    public function getCategoriesListAttribute(): array
    {
        if (is_array($this->category)) {
            return $this->category;
        }

        if (empty($this->category)) {
            return [];
        }

        if (str_starts_with(trim($this->category), '[') && str_ends_with(trim($this->category), ']')) {
            $decoded = json_decode($this->category, true);
            if (is_array($decoded)) {
                return array_values(array_filter(array_map('trim', $decoded)));
            }
        }

        return array_values(array_filter(array_map('trim', explode(',', (string) $this->category))));
    }

    public function hasCategory(string $categoryName): bool
    {
        return in_array(mb_strtolower(trim($categoryName)), array_map('mb_strtolower', $this->categories_list), true);
    }

    public static function cleanupDuplicateSlugs(): void
    {
        try {
            $dupBlogs = static::query()->where('slug', 'like', '%-dup-%')->get();
            foreach ($dupBlogs as $blog) {
                $cleanSlug = preg_replace('/-dup-\d+$/', '', (string) $blog->slug);
                if (empty($cleanSlug)) {
                    continue;
                }

                $conflict = static::query()->where('slug', $cleanSlug)->where('id', '!=', $blog->id)->first();
                if ($conflict) {
                    $cleanTitleSlug = \Illuminate\Support\Str::slug($blog->title);
                    $conflictTitleSlug = \Illuminate\Support\Str::slug($conflict->title);

                    if ($cleanTitleSlug === $cleanSlug && $conflictTitleSlug !== $cleanSlug) {
                        $targetConflict = $conflictTitleSlug ?: ('blog-' . $conflict->id);
                        if (static::query()->where('slug', $targetConflict)->where('id', '!=', $conflict->id)->exists()) {
                            $targetConflict = $targetConflict . '-' . $conflict->id;
                        }
                        $conflict->update(['slug' => $targetConflict]);
                        $blog->update(['slug' => $cleanSlug]);
                    } else {
                        $target = $cleanTitleSlug ?: ('blog-' . $blog->id);
                        if (static::query()->where('slug', $target)->where('id', '!=', $blog->id)->exists()) {
                            $target = $target . '-' . $blog->id;
                        }
                        $blog->update(['slug' => $target]);
                    }
                } else {
                    $blog->update(['slug' => $cleanSlug]);
                }
            }
        } catch (\Throwable $e) {
            // Silently avoid interrupting if connection is pending
        }
    }

    public function getFaqsListAttribute(): array
    {
        $faqs = $this->faqs;
        if (is_string($faqs)) {
            $decoded = json_decode($faqs, true);
            return is_array($decoded) ? array_values($decoded) : [];
        }
        if (is_array($faqs)) {
            return array_values($faqs);
        }

        return [];
    }

    public function hasFaqs(): bool
    {
        return !empty($this->faqs_list);
    }

    public static function ensureFaqsColumnExists(): void
    {
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('blogs') && !\Illuminate\Support\Facades\Schema::hasColumn('blogs', 'faqs')) {
                \Illuminate\Support\Facades\Schema::table('blogs', function (\Illuminate\Database\Schema\Blueprint $table) {
                    $table->json('faqs')->nullable()->after('content');
                });
            }
        } catch (\Throwable $e) {
            // Silently avoid interrupting if connection is pending
        }
    }

    protected static function booted(): void
    {
        static::cleanupDuplicateSlugs();
        static::ensureFaqsColumnExists();
    }

    public function getPublishedLabelAttribute(): string
    {
        if ($this->published_at) {
            return $this->published_at->format('Y/m/d \a\t g:i a');
        }

        return 'Not published';
    }
}
