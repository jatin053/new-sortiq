<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ContactMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim((string) $this->name),
            'email' => trim((string) $this->email),
            'country_code' => $this->country_code ? trim((string) $this->country_code) : null,
            'phone' => $this->phone ? preg_replace('/[^0-9]/', '', (string) $this->phone) : null,
            'subject' => $this->subject ? trim((string) $this->subject) : null,
            'message' => $this->message ? trim((string) $this->message) : null,
            'type' => $this->type ? trim((string) $this->type) : 'contact',
            'institute' => $this->institute ? trim((string) $this->institute) : null,
            'technology' => $this->technology ? trim((string) $this->technology) : null,
            'url' => $this->url ? trim((string) $this->url) : null,
            'recaptcha' => $this->recaptcha ? trim((string) $this->recaptcha) : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:160',
            'country_code' => 'nullable|string|max:10',
            'phone' => 'nullable|digits_between:7,15',
            'subject' => 'nullable|string|max:160',
            'message' => 'nullable|string|max:3000',
            'type' => 'nullable|string|max:30',
            'institute' => 'nullable|string|max:255',
            'technology' => 'nullable|string|max:150',
            'url' => 'nullable|string|max:2048',
            'attachment' => 'nullable|file|max:10240|mimes:pdf,doc,docx',
            'resume' => 'nullable|file|max:10240|mimes:pdf,doc,docx',
            'recaptcha' => 'nullable|string|max:4096',
        ];
    }
}