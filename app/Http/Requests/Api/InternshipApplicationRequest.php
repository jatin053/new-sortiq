<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class InternshipApplicationRequest extends FormRequest
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
            'subject' => trim((string) $this->subject),
            'institute' => trim((string) $this->institute),
            'technology' => trim((string) $this->technology),
            'message' => trim((string) $this->message),
            'url' => $this->url ? trim((string) $this->url) : ($this->header('referer') ?: url()->previous() ?: null),
            'recaptcha' => $this->recaptcha ? trim((string) $this->recaptcha) : ($this->input('g-recaptcha-response') ? trim((string) $this->input('g-recaptcha-response')) : null),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:160',
            'country_code' => 'nullable|string|max:10',
            'phone' => 'required|digits_between:7,15',
            'subject' => 'required|string|max:255',
            'institute' => 'required|string|max:255',
            'technology' => 'required|string|max:150',
            'message' => 'required|string',
            'url' => 'nullable|string|max:2048',
            'resume' => 'nullable|file|max:10240|mimes:pdf,doc,docx',
            'attachment' => 'nullable|file|max:10240|mimes:pdf,doc,docx',
            'recaptcha' => 'nullable|string|max:4096',
        ];
    }
}
