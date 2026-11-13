<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FresherHiringRequest;
use App\Mail\FresherHiringNotification;
use App\Models\FresherHiring;
use App\Models\SiteLayoutSetting;
use App\Support\Recaptcha;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Throwable;

class FresherHiringController extends Controller
{
    public function store(FresherHiringRequest $request): JsonResponse
    {
        $data = $request->validated();

        $this->checkRecaptcha($data['recaptcha'] ?? null, $request->ip());

        // Process file upload (supports 'attachment' or 'resume' input name)
        $attachmentPath = null;
        $file = $request->file('attachment') ?: $request->file('resume');
        if ($file && $file->isValid()) {
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $attachmentPath = $file->storeAs('attachments', $filename, 'public');
        }

        $fresherHiring = FresherHiring::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'country_code' => $data['country_code'] ?? null,
            'phone' => $data['phone'] ?? null,
            'institute' => $data['institute'] ?? ($data['message'] ?? null),
            'technology' => $data['technology'] ?? ($data['subject'] ?? null),
            'attachment' => $attachmentPath,
            'url' => $data['url'] ?? null,
            'ip_address' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
        ]);

        $this->sendNotificationEmail($fresherHiring);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Application submitted successfully.',
                'redirect' => route('frontend.thank-you'),
            ]);
        }

        return redirect()->route('frontend.thank-you');
    }

    private function checkRecaptcha(?string $token, ?string $ip): void
    {
        if (!Recaptcha::enabledForRequest(request())) {
            return;
        }

        if (empty($token)) {
            throw ValidationException::withMessages([
                'recaptcha' => 'Please complete the reCAPTCHA check.',
            ]);
        }

        $secretKey = Recaptcha::secretKeyForRequest(request());

        if (empty($secretKey)) {
            throw ValidationException::withMessages([
                'recaptcha' => 'reCAPTCHA is not configured correctly.',
            ]);
        }

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secretKey,
            'response' => $token,
            'remoteip' => $ip,
        ]);

        if (!$response->ok()) {
            throw ValidationException::withMessages([
                'recaptcha' => 'reCAPTCHA verification failed.',
            ]);
        }

        $responseData = $response->json();

        if (empty($responseData['success'])) {
            throw ValidationException::withMessages([
                'recaptcha' => 'reCAPTCHA verification failed.',
            ]);
        }
    }

    private function sendNotificationEmail(FresherHiring $fresherHiring): void
    {
        $notificationEmails = $this->getNotificationEmails();

        if (empty($notificationEmails)) {
            Log::warning('Fresher hiring application saved without notification email configuration.', [
                'fresher_hiring_id' => $fresherHiring->id,
            ]);

            return;
        }

        try {
            Mail::to($notificationEmails)->send(new FresherHiringNotification($fresherHiring));
        } catch (Throwable $e) {
            Log::warning('Fresher hiring application saved but notification email could not be sent.', [
                'fresher_hiring_id' => $fresherHiring->id,
                'notification_emails' => $notificationEmails,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function getNotificationEmails(): array
    {
        try {
            $siteLayoutData = SiteLayoutSetting::main()->data ?? [];
        } catch (Throwable) {
            $siteLayoutData = [];
        }

        $rawEntries = [
            config('services.contact.notification_email', env('CONTACT_NOTIFICATION_EMAIL')),
            data_get($siteLayoutData, 'header.email'),
            data_get($siteLayoutData, 'footer.email'),
        ];

        $emails = [];
        foreach ($rawEntries as $entry) {
            if (!$entry) continue;
            foreach (explode(',', (string) $entry) as $part) {
                $email = strtolower(trim($part));
                if ($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) && !in_array($email, $emails, true)) {
                    $emails[] = $email;
                }
            }
        }

        return $emails;
    }
}
