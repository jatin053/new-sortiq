<?php

namespace App\Models;

use App\Support\LocalMedia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class Video extends Model
{
    protected static ?bool $videoFileColumnExists = null;

    protected $fillable = [
        'title',
        'slug',
        'youtube_url',
        'video_file',
        'thumbnail',
        'summary',
        'published_at',
        'status',
        'sort_order',
        'views',
    ];

    protected $casts = [
        'published_at' => 'date',
        'sort_order' => 'integer',
        'views' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
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

    public function getYoutubeIdAttribute(): ?string
    {
        $url = trim((string) $this->youtube_url);

        if ($url === '') {
            return null;
        }

        if (preg_match('/^[A-Za-z0-9_-]{11}$/', $url) === 1) {
            return $url;
        }

        $parts = parse_url($url);
        $host = Str::lower((string) ($parts['host'] ?? ''));
        $path = trim((string) ($parts['path'] ?? ''), '/');

        parse_str((string) ($parts['query'] ?? ''), $query);

        $candidateIds = [
            $query['v'] ?? null,
            str_contains($host, 'youtu.be') ? Str::before($path, '/') : null,
            str_starts_with($path, 'embed/') ? Str::before(Str::after($path, 'embed/'), '/') : null,
            str_starts_with($path, 'shorts/') ? Str::before(Str::after($path, 'shorts/'), '/') : null,
        ];

        foreach ($candidateIds as $candidateId) {
            $candidateId = trim((string) $candidateId);

            if (preg_match('/^[A-Za-z0-9_-]{11}$/', $candidateId) === 1) {
                return $candidateId;
            }
        }

        return null;
    }

    public function getEmbedUrlAttribute(): ?string
    {
        return $this->playback_url;
    }

    public function getVideoFileUrlAttribute(): ?string
    {
        if (! self::supportsVideoFileUploads()) {
            return null;
        }

        return LocalMedia::url($this->video_file);
    }

    public function getYoutubeEmbedUrlAttribute(): ?string
    {
        if (! $this->youtube_id) {
            return null;
        }

        return 'https://www.youtube.com/embed/' . $this->youtube_id;
    }

    public function getPlaybackTypeAttribute(): ?string
    {
        if ($this->video_file_url) {
            return 'file';
        }

        if ($this->youtube_embed_url) {
            return 'youtube';
        }

        return null;
    }

    public function getPlaybackUrlAttribute(): ?string
    {
        return $this->video_file_url ?: $this->youtube_embed_url;
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        $thumbnailUrl = LocalMedia::url($this->thumbnail);

        if ($thumbnailUrl) {
            return $thumbnailUrl;
        }

        if ($this->youtube_id) {
            return 'https://img.youtube.com/vi/' . $this->youtube_id . '/hqdefault.jpg';
        }

        return asset('frontend-assets/media/video-placeholder.svg');
    }

    public function getPublishedLabelAttribute(): string
    {
        if ($this->published_at) {
            return $this->published_at->format('Y/m/d \a\t g:i a');
        }

        return 'Not published';
    }

    public static function supportsVideoFileUploads(): bool
    {
        if (self::$videoFileColumnExists !== null) {
            return self::$videoFileColumnExists;
        }

        try {
            self::$videoFileColumnExists = Schema::hasColumn((new self())->getTable(), 'video_file');
        } catch (\Throwable) {
            self::$videoFileColumnExists = false;
        }

        return self::$videoFileColumnExists;
    }
}
