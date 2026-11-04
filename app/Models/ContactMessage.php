<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'country_code',
        'phone',
        'subject',
        'message',
        'type',
        'institute',
        'technology',
        'attachment',
        'url',
        'status',
        'read_at',
        'ip_address',
        'user_agent',
    ];

    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
        ];
    }

    public function scopeLatestFirst(Builder $query): Builder
    {
        return $query->orderByRaw("CASE WHEN status = 'unread' THEN 0 ELSE 1 END")
            ->latest();
    }

    public function markAsRead(): void
    {
        if ($this->status === 'read') {
            return;
        }

        $this->forceFill([
            'status' => 'read',
            'read_at' => now(),
        ])->save();
    }

    public function getPhoneLabelAttribute(): string
    {
        return trim(implode(' ', array_filter([
            $this->country_code,
            $this->phone,
        ]))) ?: 'Not provided';
    }
}
