<?php

namespace App\Http\Requests\Admin;

use App\Models\Portfolio;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PortfolioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $categorySlug = (string) $this->category_slug;
        $allCategories = Portfolio::CATEGORY_OPTIONS;
        try {
            $custom = \App\Models\SiteLayoutSetting::main()->data['admin_categories']['portfolios'] ?? [];
            foreach ($custom as $c) {
                if (is_string($c) && trim($c) !== '') {
                    $allCategories[Str::slug($c)] = trim($c);
                }
            }
        } catch (\Throwable $e) {}

        $categoryName = $allCategories[$categorySlug] ?? $this->category_name ?? Str::headline($categorySlug);

        $slug = $this->slug ? Str::slug($this->slug) : Str::slug($this->title);
        $tags = collect(explode(',', (string) $this->input('tags_text')))
            ->map(fn (string $tag) => trim($tag))
            ->filter()
            ->unique(fn (string $tag) => mb_strtolower($tag))
            ->take(12)
            ->values()
            ->all();

        $this->merge([
            'slug' => $slug,
            'category_slug' => $categorySlug,
            'category_name' => $categoryName ? trim($categoryName) : null,
            'summary' => $this->summary ? trim($this->summary) : null,
            'content' => $this->content ? trim($this->content) : null,
            'image' => $this->image ? trim($this->image) : null,
            'website_url' => $this->website_url ? trim($this->website_url) : null,
            'tags' => $tags,
        ]);
    }

    public function rules(): array
    {
        $portfolioParam = $this->route('portfolio');
        $portfolioId = null;
        if ($portfolioParam instanceof Portfolio) {
            $portfolioId = $portfolioParam->id;
        } elseif (is_numeric($portfolioParam)) {
            $portfolioId = (int) $portfolioParam;
        } elseif (is_string($portfolioParam)) {
            $portfolioId = Portfolio::where('slug', $portfolioParam)->value('id');
        }

        return [
            'title' => 'required|string|max:160',

            'slug' => [
                'required',
                'max:180',
                Rule::unique('portfolios', 'slug')->ignore($portfolioId),
            ],

            'category_slug' => 'required|string|max:120',
            'category_name' => 'required|string|max:120',
            'tags' => 'nullable|array|max:12',
            'tags.*' => 'string|max:50',
            'tags_text' => 'nullable|string|max:700',

            'image' => 'required_without:image_file|string|max:255',
            'image_file' => 'nullable|file|mimes:webp,png,jpg,jpeg|max:4096',

            'website_url' => [
                'nullable',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    $url = trim((string) $value);

                    if ($url === '') {
                        return;
                    }

                    if (filter_var($url, FILTER_VALIDATE_URL)) {
                        return;
                    }

                    if (Str::startsWith($url, '/')) {
                        return;
                    }

                    $fail('The project URL must be a full URL or a site-relative path starting with "/".');
                },
            ],

            'summary' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'published_at' => 'required|date',
            'status' => 'required|in:draft,published',
            'sort_order' => 'required|integer|min:0|max:9999',
        ];
    }
}
