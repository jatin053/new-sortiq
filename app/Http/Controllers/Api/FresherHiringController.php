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

    private function sendNotificationEmail(FresherHiring $fresherHiring): void
    {
        $adminEmail = 'jatinchoudhary053@gmail.com';

        try {
            Mail::to($adminEmail)->send(new FresherHiringNotification($fresherHiring));
        } catch (Throwable $e) {
            Log::error('Fresher connect saved but notification email could not be sent to ' . $adminEmail, [
                'fresher_hiring_id' => $fresherHiring->id,
                'admin_email' => $adminEmail,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
