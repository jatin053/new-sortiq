<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'platform' => $this->platform,
            'position' => $this->position,
            'rating' => $this->rating,
            'summary' => $this->summary,
            'content' => $this->content,
            'published_at' => $this->published_at?->toDateString(),
            'status' => $this->status,
            'views' => $this->views,
            'url' => route('frontend.reviews.show', $this->slug),
        ];
    }
}
