<?php

namespace App\Http\Requests\Api;

use App\Rules\ValidPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class ContactMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $resolvedUrl = $this->url ? trim((string) $this->url) : ($this->header('referer') ?: url()->previous());
        $recaptchaToken = $this->recaptcha ? trim((string) $this->recaptcha) : ($this->input('g-recaptcha-response') ? trim((string) $this->input('g-recaptcha-response')) : null);

        $this->merge([
            'name' => trim((string) $this->name),
            'email' => trim((string) $this->email),
            'country_code' => $this->country_code ? trim((string) $this->country_code) : null,
            'phone' => $this->phone ? trim((string) $this->phone) : null,
            'subject' => $this->subject ? trim((string) $this->subject) : null,
            'message' => $this->message ? trim((string) $this->message) : null,
            'type' => $this->type ? trim((string) $this->type) : 'contact',
            'institute' => $this->institute ? trim((string) $this->institute) : null,
            'technology' => $this->technology ? trim((string) $this->technology) : null,
            'url' => $resolvedUrl,
            'recaptcha' => $recaptchaToken,
        ]);
    }

    public function rules(): array
    {
        $isCaseStudy = $this->input('type') === 'case-study';
        $phoneRules = $isCaseStudy
            ? ['required', 'string', new ValidPhoneNumber]
            : ['nullable', 'string', new ValidPhoneNumber];

        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'country_code' => ['nullable', 'string', 'max:10'],
            'phone' => $phoneRules,
            'subject' => ['nullable', 'string', 'max:160'],
            'message' => ['nullable', 'string', 'max:3000'],
            'type' => ['nullable', 'string', 'max:30'],
            'institute' => ['nullable', 'string', 'max:255'],
            'technology' => $isCaseStudy ? ['required', 'string', 'max:150'] : ['nullable', 'string', 'max:150'],
            'url' => ['nullable', 'string', 'max:2048'],
            'attachment' => ['nullable', 'file', 'max:10240', 'mimes:pdf,doc,docx'],
            'resume' => ['nullable', 'file', 'max:10240', 'mimes:pdf,doc,docx'],
            'recaptcha' => ['nullable', 'string', 'max:4096'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'Please enter your phone number.',
            'phone.min' => 'Please enter a valid phone number (at least 7 digits).',
            'technology.required' => 'Please select the service you need.',
        ];
    }
}
