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
        $allCategories = Portfolio::CATEGORY_OPTIONS;
        try {
            $custom = \App\Models\SiteLayoutSetting::main()->data['admin_categories']['portfolios'] ?? [];
            foreach ($custom as $c) {
                if (is_string($c) && trim($c) !== '') {
                    $allCategories[Str::slug($c)] = trim($c);
                }
            }
        } catch (\Throwable $e) {}

        // Multi-category handling
        $rawCategories = $this->input('categories');
        $rawCategorySlug = $this->input('category_slug');
        $rawCategoryName = $this->input('category_name');

        $categoriesList = [];
        if (is_array($rawCategories)) {
            $categoriesList = array_values(array_filter(array_map('trim', $rawCategories)));
        } elseif (is_string($rawCategoryName) && trim($rawCategoryName) !== '') {
            $categoriesList = array_values(array_filter(array_map('trim', explode(',', $rawCategoryName))));
        } elseif (is_string($rawCategorySlug) && trim($rawCategorySlug) !== '') {
            $matchedName = $allCategories[$rawCategorySlug] ?? Str::headline($rawCategorySlug);
            $categoriesList = [$matchedName];
        }

        $categoriesList = array_values(array_unique($categoriesList));
        $primaryCategoryName = $categoriesList[0] ?? ($allCategories[$rawCategorySlug] ?? 'Graphic Designing');
        $primaryCategorySlug = Str::slug($primaryCategoryName);

        $slug = $this->slug ? Str::slug($this->slug) : Str::slug($this->title);

        // Tags handling: support tags[] array or tags_text comma-separated
        $rawTags = $this->input('tags');
        $rawTagsText = $this->input('tags_text');

        $tagsList = [];
        if (is_array($rawTags)) {
            $tagsList = array_merge($tagsList, $rawTags);
        }
        if (is_string($rawTagsText) && trim($rawTagsText) !== '') {
            $tagsList = array_merge($tagsList, explode(',', $rawTagsText));
        }

        $tags = collect($tagsList)
            ->map(fn (string $tag) => trim($tag))
            ->filter()
            ->unique(fn (string $tag) => mb_strtolower($tag))
            ->take(25)
            ->values()
            ->all();

        $categoryNameString = !empty($categoriesList) ? implode(', ', $categoriesList) : $primaryCategoryName;

        $this->merge([
            'slug' => $slug,
            'category_slug' => $primaryCategorySlug,
            'category_name' => $categoryNameString,
            'categories' => $categoriesList,
            'summary' => $this->summary ? trim($this->summary) : null,
            'content' => $this->content ? trim($this->content) : null,
            'image' => $this->image ? trim($this->image) : null,
            'website_url' => $this->website_url ? trim($this->website_url) : null,
            'tags' => $tags,
            'tags_text' => implode(', ', $tags),
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
            'category_name' => 'required|string|max:500',
            'categories' => 'nullable|array',
            'categories.*' => 'string|max:100',
            'tags' => 'nullable|array|max:25',
            'tags.*' => 'string|max:60',
            'tags_text' => 'nullable|string|max:1000',

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
