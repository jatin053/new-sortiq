<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'section',
        'label',
        'route_name',
        'url_path',
        'title',
        'description',
        'keywords',
        'status',
        'view_name',
        'social_image',
    ];

    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
