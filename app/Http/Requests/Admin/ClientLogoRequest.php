<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ClientLogoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $slug = $this->slug ? $this->slug : Str::slug($this->name);

        $this->merge([
            'slug' => $slug,
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
                Rule::unique('client_logos', 'slug')->ignore($this->route('clientLogo')),
            ],

            'logo' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,svg|max:2048',

            'website' => 'nullable|url|max:255',

            'description' => 'nullable|string|max:255',

            'sort_order' => 'required|integer|min:0|max:9999',

            'status' => 'required|in:draft,published',
        ];
    }
}