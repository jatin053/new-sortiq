<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FresherHiringRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $subject = $this->subject ? trim((string) $this->subject) : null;
        $message = $this->message ? trim((string) $this->message) : null;

        $this->merge([
            'name' => trim((string) $this->name),
            'email' => trim((string) $this->email),
            'country_code' => $this->country_code ? trim((string) $this->country_code) : null,
            'phone' => $this->phone ? preg_replace('/[^0-9]/', '', (string) $this->phone) : null,
            'institute' => $this->institute ? trim((string) $this->institute) : $message,
            'technology' => $this->technology ? trim((string) $this->technology) : $subject,
            'subject' => $subject,
            'message' => $message,
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
            'phone' => 'nullable|digits_between:7,15',
            'institute' => 'nullable|string|max:255',
            'technology' => 'nullable|string|max:150',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:5000',
            'url' => 'nullable|string|max:2048',
            'attachment' => 'nullable|file|max:25600',
            'resume' => 'nullable|file|max:25600',
            'recaptcha' => 'nullable|string|max:4096',
        ];
    }
}
