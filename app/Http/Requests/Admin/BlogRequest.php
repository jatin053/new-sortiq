<?php

namespace App\Http\Requests\Admin;

use App\Models\Blog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $rawSlug = $this->input('slug');
        if (is_string($rawSlug) && trim($rawSlug) !== '') {
            $rawSlug = trim($rawSlug);
            if (Str::startsWith($rawSlug, ['http://', 'https://'])) {
                $path = parse_url($rawSlug, PHP_URL_PATH);
                $rawSlug = trim((string) $path, '/');
                if (str_contains($rawSlug, '/')) {
                    $parts = explode('/', $rawSlug);
                    $rawSlug = end($parts);
                }
            } else {
                $rawSlug = trim($rawSlug, '/');
                if (str_contains($rawSlug, '/')) {
                    $parts = explode('/', $rawSlug);
                    $rawSlug = end($parts);
                }
            }
            $slug = Str::slug($rawSlug);
        } else {
            $slug = Str::slug((string) $this->input('title'));
        }

        // Process multi-category input
        $rawCategories = $this->input('categories');
        $rawCategory = $this->input('category');

        $categoriesList = [];
        if (is_array($rawCategories)) {
            $categoriesList = array_values(array_filter(array_map('trim', $rawCategories)));
        } elseif (is_string($rawCategory) && trim($rawCategory) !== '') {
            $categoriesList = array_values(array_filter(array_map('trim', explode(',', $rawCategory))));
        }

        // Clean & deduplicate
        $categoriesList = array_values(array_unique($categoriesList));
        $categoryString = !empty($categoriesList) ? implode(', ', $categoriesList) : null;

        // Process tags input (array or comma-separated text)
        $rawTags = $this->input('tags');
        $rawTagsText = $this->input('tags_text');

        $tagsList = [];
        if (is_array($rawTags)) {
            $tagsList = array_merge($tagsList, $rawTags);
        }
        if (is_string($rawTagsText) && trim($rawTagsText) !== '') {
            $tagsList = array_merge($tagsList, explode(',', $rawTagsText));
        }

        $tagsList = collect($tagsList)
            ->map(fn ($t) => trim((string) $t))
            ->filter(fn ($t) => $t !== '')
            ->unique(fn ($t) => mb_strtolower($t))
            ->take(25)
            ->values()
            ->all();

        $this->merge([
            'slug' => $slug,
            'category' => $categoryString,
            'categories' => $categoriesList,
            'tags' => $tagsList,
            'tags_text' => implode(', ', $tagsList),
        ]);
    }

    public function rules(): array
    {
        $blogParam = $this->route('blog');
        $blogId = null;
        if ($blogParam instanceof Blog) {
            $blogId = $blogParam->id;
        } elseif (is_numeric($blogParam)) {
            $blogId = (int) $blogParam;
        } elseif (is_string($blogParam)) {
            $found = Blog::where('slug', $blogParam)->first();
            $blogId = $found?->id;
        }

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('blogs', 'slug')->ignore($blogId),
            ],
            'image' => ['nullable', 'string', 'max:255'],
            'delete_image' => ['nullable'],
            'image_file' => ['nullable', 'file', 'mimes:webp,png,jpg,jpeg', 'max:4096'],
            'category' => ['nullable', 'string', 'max:500'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['string', 'max:100'],
            'tags' => ['nullable', 'array', 'max:25'],
            'tags.*' => ['string', 'max:80'],
            'tags_text' => ['nullable', 'string', 'max:1000'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['required', 'string', 'min:5'],
            'published_at' => ['required', 'date'],
            'status' => ['required', 'in:draft,published'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:1000'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function attributes(): array
    {
        return [
            'published_at' => 'publish date',
        ];
    }
}
