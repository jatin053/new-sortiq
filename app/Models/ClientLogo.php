<?php

namespace App\Models;

use App\Support\LocalMedia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ClientLogo extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'website',
        'description',
        'sort_order',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
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
        $query->orderBy('name', 'asc');

        return $query;
    }

    public function getLogoUrlAttribute(): ?string
    {
        $logo = trim((string) $this->logo);

        if ($logo === '') {
            return null;
        }

        $relativePath = ltrim($logo, '/');

        if (
            ! Str::startsWith($logo, ['http://', 'https://'])
            && Str::startsWith($relativePath, 'uploads/')
            && ! is_file(public_path($relativePath))
        ) {
            return null;
        }

        return LocalMedia::url($this->logo);
    }
}
