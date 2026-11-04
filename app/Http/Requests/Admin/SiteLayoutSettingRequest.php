<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SiteLayoutSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Header
            'header' => 'required|array',
            'header.logo' => 'nullable|string|max:255',
            'header.logo_text' => 'required|string|max:80',
            'header.phone' => 'nullable|string|max:40',
            'header.email' => 'nullable|email|max:120',
            'header.apply_label' => 'nullable|string|max:80',
            'header.apply_url' => 'nullable|string|max:255',
            'header_logo_file' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,svg|max:2048',

            // Navigation
            'nav_links' => 'required|array|max:8',
            'nav_links.*.label' => 'nullable|string|max:80',
            'nav_links.*.url' => 'nullable|string|max:255',
            'nav_links.*.has_dropdown' => 'nullable|in:0,1',

            // Footer badges
            'footer_badges' => 'required|array|max:8',
            'footer_badges.*.label' => 'nullable|string|max:80',
            'footer_badges.*.image' => 'nullable|string|max:255',
            'footer_badge_files' => 'nullable|array',
            'footer_badge_files.*' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,svg|max:2048',

            // Footer main
            'footer' => 'required|array',
            'footer.address' => 'nullable|string|max:255',
            'footer.phone' => 'nullable|string|max:40',
            'footer.email' => 'nullable|email|max:120',
            'footer.certificate_text' => 'nullable|string|max:160',
            'footer.certificate_button_label' => 'nullable|string|max:80',
            'footer.certificate_url' => 'nullable|string|max:255',
            'footer.chat_label' => 'nullable|string|max:80',
            'footer.chat_url' => 'nullable|string|max:255',

            // Footer columns
            'footer_columns' => 'required|array',
            'footer_columns.*.title' => 'nullable|string|max:80',
            'footer_columns.*.links' => 'nullable|array|max:12',
            'footer_columns.*.links.*.label' => 'nullable|string|max:100',
            'footer_columns.*.links.*.url' => 'nullable|string|max:255',
        ];
    }
}