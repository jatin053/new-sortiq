<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactMessageRequest;
use App\Mail\ContactMessageNotification;
use App\Models\ContactMessage;
use App\Models\SiteLayoutSetting;
use App\Support\Recaptcha;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Throwable;

class ContactMessageController extends Controller
{
    public function describe(): JsonResponse
    {
        return response()->json(ApiDocumentationController::contactEndpointDocumentation());
    }

    public function store(ContactMessageRequest $request): JsonResponse
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

        $type = $data['type'] ?? 'contact';
        $url = $data['url'] ?? null;
        $subject = $data['subject'] ?? null;
        $message = $data['message'] ?? null;

        if (empty($subject) || $subject === 'Case Study Consultation') {
            if ($type === 'case-study') {
                $subject = 'Case Study Consultation - ' . ($data['technology'] ?? 'Website Development');
            } elseif ($type === 'internship') {
                $subject = 'Internship Application - ' . ($data['technology'] ?? 'General');
            } elseif ($type === 'fresher') {
                $subject = 'Fresher Connect Application';
            } elseif ($type === 'careers') {
                $subject = 'Careers Page Application';
            } elseif (empty($subject)) {
                $subject = 'New Web Enquiry';
            }
        }

        if (empty($message)) {
            if ($type === 'case-study') {
                $message = 'Inquiry submitted from Case Studies consultation form.';
                if (!empty($data['technology'])) {
                    $message .= "\nRequested Service: " . $data['technology'];
                }
            } else {
                $message = 'Submission details filled in the form.';
            }
            if ($url) {
                $message .= "\nSubmitted from page: " . $url;
            }
        }

        $contactMessage = ContactMessage::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'country_code' => $data['country_code'] ?? null,
            'phone' => $data['phone'] ?? null,
            'subject' => $subject,
            'message' => $message,
            'type' => $type,
            'institute' => $data['institute'] ?? null,
            'technology' => $data['technology'] ?? null,
            'attachment' => $attachmentPath,
            'url' => $url,
            'ip_address' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
        ]);

        $this->sendNotificationEmail($contactMessage);

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully.',
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

    private function sendNotificationEmail(ContactMessage $contactMessage): void
    {
        $notificationEmails = $this->getNotificationEmails();

        if (empty($notificationEmails)) {
            Log::warning('Contact message saved without notification email configuration.', [
                'contact_message_id' => $contactMessage->id,
            ]);

            return;
        }

        try {
            Mail::to($notificationEmails)->send(new ContactMessageNotification($contactMessage));
        } catch (Throwable $e) {
            Log::warning('Contact message saved but notification email could not be sent.', [
                'contact_message_id' => $contactMessage->id,
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
