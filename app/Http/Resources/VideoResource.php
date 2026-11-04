<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'youtube_url' => $this->youtube_url,
            'youtube_id' => $this->youtube_id,
            'youtube_embed_url' => $this->youtube_embed_url,
            'embed_url' => $this->embed_url,
            'playback_type' => $this->playback_type,
            'playback_url' => $this->playback_url,
            'video_file' => $this->video_file,
            'video_file_url' => $this->video_file_url,
            'thumbnail' => $this->thumbnail,
            'thumbnail_url' => $this->thumbnail_url,
            'summary' => $this->summary,
            'published_at' => $this->published_at?->toDateString(),
            'status' => $this->status,
            'sort_order' => $this->sort_order,
            'views' => $this->views,
        ];
    }
}
