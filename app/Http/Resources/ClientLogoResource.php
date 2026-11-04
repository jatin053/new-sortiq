<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientLogoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'logo' => $this->logo,
            'logo_url' => $this->logo_url,
            'website' => $this->website,
            'description' => $this->description,
            'sort_order' => $this->sort_order,
            'status' => $this->status,
        ];
    }
}
