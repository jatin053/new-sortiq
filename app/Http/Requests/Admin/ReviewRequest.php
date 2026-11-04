<?php

namespace App\Http\Requests\Admin;

use App\Models\Review;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        
        $slug = $this->input('slug') ?: Str::slug($this->input('name'));

        
        $position = $this->filled('position') 
            ? trim($this->input('position')) 
            : null;

        $summary = $this->filled('summary') 
            ? trim($this->input('summary')) 
            : null;

        $this->merge([
            'slug' => $slug,
            'position' => $position,
            'summary' => $summary,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:120',

            'slug' => [
                'required',
                'alpha_dash',
                'max:160',
                Rule::unique('reviews', 'slug')
                    ->ignore(optional($this->route('review'))->getKey()),
            ],

            'platform' => [
                'required',
                Rule::in(Review::PLATFORMS),
            ],

            'position' => 'nullable|string|max:120',
            'rating' => 'required|integer|between:1,5',
            'published_at' => 'required|date',
            'status' => 'required|in:draft,published',
            'content' => 'required|string|min:20|max:2000',
            'summary' => 'nullable|string|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            'published_at' => 'review date',
        ];
    }
}