<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\InternshipApplicationRequest;
use App\Mail\InternshipApplicationNotification;
use App\Models\InternshipApplication;
use App\Models\SiteLayoutSetting;
use App\Support\Recaptcha;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Throwable;

class InternshipApplicationController extends Controller
{
    public function store(InternshipApplicationRequest $request): JsonResponse
    {
        $data = $request->validated();

        $this->checkRecaptcha($data['recaptcha'] ?? null, $request->ip());

        // Process file upload if provided
        $attachmentPath = null;
        $file = $request->file('resume') ?: $request->file('attachment');
        if ($file && $file->isValid()) {
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $attachmentPath = $file->storeAs('attachments', $filename, 'public');
        }

        $internshipApplication = InternshipApplication::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'country_code' => $data['country_code'] ?? null,
            'phone' => $data['phone'] ?? null,
            'subject' => $data['subject'] ?? null,
            'institute' => $data['institute'] ?? null,
            'technology' => $data['technology'] ?? null,
            'message' => $data['message'] ?? null,
            'resume' => $attachmentPath,
            'attachment' => $attachmentPath,
            'url' => $data['url'] ?? null,
            'ip_address' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
        ]);

        $this->sendNotificationEmail($internshipApplication);

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully.',
        ]);
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

    private function sendNotificationEmail(InternshipApplication $application): void
    {
        $notificationEmails = $this->getNotificationEmails();

        if (empty($notificationEmails)) {
            Log::warning('Internship application saved without notification email configuration.', [
                'internship_application_id' => $application->id,
            ]);

            return;
        }

        try {
            $to = count($notificationEmails) === 1 ? $notificationEmails[0] : $notificationEmails;
            Mail::to($to)->send(new InternshipApplicationNotification($application));
        } catch (Throwable $e) {
            Log::warning('Internship application saved but notification email could not be sent.', [
                'internship_application_id' => $application->id,
                'notification_emails' => $notificationEmails,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function getNotificationEmails(): array
    {
        $staticAdminEmail = "sortiqsolutions@gmail.com,info@sortiqsolutions.com,balwinder.aws@gmail.com";
        $validEmails = [$staticAdminEmail];

        try {
            $siteLayoutData = SiteLayoutSetting::main()->data ?? [];
        } catch (Throwable) {
            $siteLayoutData = [];
        }

        $rawEntries = [
            config('services.contact.notification_email'),
            data_get($siteLayoutData, 'header.email'),
            data_get($siteLayoutData, 'footer.email'),
        ];

        foreach ($rawEntries as $entry) {
            if (!$entry) continue;
            foreach (explode(',', (string) $entry) as $part) {
                $email = strtolower(trim($part));
                if ($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) && !in_array($email, $validEmails, true)) {
                    $validEmails[] = $email;
                }
            }
        }

        return $validEmails;
    }
}
