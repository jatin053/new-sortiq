<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public const PLATFORMS = [
        'Upwork',
        'Fiverr',
        'Google',
        'Clutch',
    ];

    protected $fillable = [
        'name',
        'slug',
        'platform',
        'position',
        'rating',
        'published_at',
        'status',
        'content',
        'summary',
        'views',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'rating' => 'integer',
            'views' => 'integer',
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
        $query->orderBy('published_at', 'desc');
        $query->orderBy('id', 'desc');

        return $query;
    }

    public function getPublishedLabelAttribute(): string
    {
        if ($this->published_at) {
            return $this->published_at->format('Y/m/d \a\t g:i a');
        }

        return 'Not published';
    }
}