<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RobotsSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => ['nullable', 'string', 'max:50000'],
            'custom_rules' => ['nullable', 'string', 'max:50000'],
            'crawling_mode' => ['nullable', 'string'],
        ];
    }
}
