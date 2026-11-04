<?php

namespace App\Http\Requests\Admin;

use App\Support\Seo\SeoPageCatalog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageMetaSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'selected_page' => ['nullable', 'string', Rule::in(SeoPageCatalog::routeNames())],
            'pages' => ['required', 'array'],
            'pages.*.route_name' => ['required', 'string', Rule::in(SeoPageCatalog::routeNames())],
            'pages.*.custom_path' => ['nullable', 'string', 'max:255'],
            'pages.*.title' => ['nullable', 'string', 'max:255'],
            'pages.*.description' => ['nullable', 'string', 'max:320'],
            'pages.*.keywords' => ['nullable', 'string', 'max:500'],
            'pages.*.exclude_sitemap' => ['nullable', 'boolean'],
        ];
    }
}
