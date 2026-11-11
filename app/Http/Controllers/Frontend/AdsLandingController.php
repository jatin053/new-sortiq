<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessageNotification;
use App\Models\ContactMessage;
use App\Models\Page;
use App\Models\SiteLayoutSetting;
use App\Rules\ValidPhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

class AdsLandingController extends Controller
{
    /**
     * Display the Ads Landing Page.
     */
    public function show(): View
    {
        try {
            $pageMeta = Page::query()
                ->where('route_name', 'frontend.ads-landing-page')
                ->orWhere('url_path', '/ads-landing-page')
                ->first();
        } catch (Throwable $e) {
            report($e);
            $pageMeta = null;
        }

        $feedbackCards = [
            [
                'name' => 'David J.Martin',
                'image' => 'frontend-assets/media/imports/sortiqsolutions/2024/12/img1.jpg',
                'quote' => 'From the coast of creativity to the mountains of strategy, Sortiq Solutions has always delivered. They combine innovative ideas with flawless execution, offering personalized services that go above and beyond. Their professionalism and dedication to our projects make them a trusted partner.',
            ],
            [
                'name' => 'Robin C. Miller',
                'image' => 'frontend-assets/media/imports/sortiqsolutions/2024/12/img3.jpg',
                'quote' => 'Separated by time zones, yet always in sync, Sortiq Solutions delivered exceptional service. Whether it was designing a complex solution or brainstorming new ideas, they handled every project with precision. Their expertise and responsiveness make them an invaluable partner to our business.',
            ],
            [
                'name' => 'David G. Mullins',
                'image' => 'frontend-assets/media/imports/sortiqsolutions/2024/12/img2.jpg',
                'quote' => 'Sortiq Solutions has consistently exceeded our expectations. Just as the blind texts live in the Bookmarks grove, their team lives in the details, bringing the perfect solutions to every challenge we face. They have made a huge impact on our growth and continue to provide outstanding results.',
            ],
            [
                'name' => 'Jordan D. Nelson',
                'image' => 'frontend-assets/media/imports/sortiqsolutions/2024/12/img6.jpg',
                'quote' => 'Far from ordinary, Sortiq Solutions stands out with their creativity, attention to detail, and commitment to customer satisfaction. They’ve taken our business to new heights, helping us grow through innovative strategies and seamless execution. It’s a pleasure working with such a professional team.',
            ],
            [
                'name' => 'Chester V. Buentello',
                'image' => 'frontend-assets/media/imports/sortiqsolutions/2024/12/img5.jpg',
                'quote' => 'Separated by time zones, yet always in sync, Sortiq Solutions delivered exceptional service. Whether it was designing a complex solution or brainstorming new ideas, they handled every project with precision. Their expertise and responsiveness make them an invaluable partner to our business.',
            ],
        ];

        return view('frontend.pages.ads-landing-page', [
            'pageMeta' => $pageMeta,
            'feedbackCards' => $feedbackCards,
            'siteSettings' => SiteLayoutSetting::main(),
        ]);
    }

    /**
     * Handle the AJAX inquiry form submission.
     */
    public function submit(Request $request): Response
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:120',
            'email' => 'required|email|max:160',
            'phone' => ['required', 'string', new ValidPhoneNumber],
            'technology' => 'required|string|max:120',
            'message' => 'required|string|max:3000',
        ]);

        try {
            $pageUrl = $request->input('url') ?: $request->headers->get('referer') ?: url('/ads-landing-page');

            $contactMessage = ContactMessage::create([
                'name' => $validated['full_name'],
                'email' => $validated['email'],
                'phone' => preg_replace('/[^0-9+]/', '', $validated['phone']),
                'subject' => 'Ads Landing Inquiry - ' . $validated['technology'],
                'technology' => $validated['technology'],
                'url' => $pageUrl,
                'message' => "Technology / Domain: " . $validated['technology'] . "\n\n" . $validated['message'],
                'type' => 'inquiry',
                'ip_address' => $request->ip(),
                'user_agent' => (string) $request->userAgent(),
            ]);

            $this->sendNotificationEmail($contactMessage);

            return response('Your inquiry has been submitted successfully! We will contact you soon.', 200);
        } catch (Throwable $e) {
            report($e);
            return response('Something went wrong. Please try again or call us directly.', 500);
        }
    }

    private function sendNotificationEmail(ContactMessage $contactMessage): void
    {
        $notificationEmails = $this->getNotificationEmails();

        if (empty($notificationEmails)) {
            Log::warning('Ads landing message saved without notification email configuration.', [
                'contact_message_id' => $contactMessage->id,
            ]);
            return;
        }

        try {
            $to = count($notificationEmails) === 1 ? $notificationEmails[0] : $notificationEmails;
            Mail::to($to)->send(new ContactMessageNotification($contactMessage));
        } catch (Throwable $e) {
            Log::warning('Ads landing notification email could not be sent.', [
                'contact_message_id' => $contactMessage->id,
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

