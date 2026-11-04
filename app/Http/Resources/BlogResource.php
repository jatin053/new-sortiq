<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image,
            'image_url' => $this->image_url,
            'category' => $this->category,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'published_at' => $this->published_at?->toDateString(),
            'status' => $this->status,
            'views' => $this->views,
            'url' => route('frontend.blog.show', $this->slug),
        ];
    }
}
