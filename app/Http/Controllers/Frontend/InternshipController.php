<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Review;
use App\Models\SiteLayoutSetting;
use Illuminate\View\View;
use Throwable;

class InternshipController extends Controller
{
    /**
     * Display the Best IT Internship Company in Mohali Chandigarh landing page.
     */
    public function landing(): View
    {
        try {
            $dbReviews = Review::query()
                ->published()
                ->ordered()
                ->get();
        } catch (Throwable $e) {
            report($e);
            $dbReviews = collect();
        }

        $pageMeta = \App\Support\Seo\PageMeta::forRoute('frontend.best-it-internship', '/best-it-internship-company-mohali-chandigarh');

        $processCards = [
            [
                'title' => 'Understanding Your Business',
                'image' => 'discovery-and-strategy.webp',
                'text' => 'We start by learning about your goals and challenges so that our solution matches your exact needs.',
            ],
            [
                'title' => 'Planning the Right Strategy',
                'image' => 'wireframing-and-design.webp',
                'text' => 'We create a clear roadmap with the best tools, technologies, and timelines to achieve your business objectives efficiently.',
            ],
            [
                'title' => 'Designing for Users',
                'image' => 'development-and-coding.webp',
                'text' => 'Our team designs clean, user-friendly interfaces that look great and are easy for your customers to navigate.',
            ],
            [
                'title' => 'Building Reliable Solutions',
                'image' => 'launch-and-deployment.webp',
                'text' => 'We develop websites, apps, and software that are fast, secure, and scalable to support your business growth.',
            ],
            [
                'title' => 'Testing and Launching',
                'image' => 'testing-and-assurance.webp',
                'text' => 'Every solution is thoroughly tested to ensure it works perfectly. We then launch it smoothly so you can go live without any hassle.',
            ],
            [
                'title' => 'Support and Improvement',
                'image' => 'maintenance-and-optimization.webp',
                'text' => 'After launch, we continue to support and improve your solutions, keeping them up-to-date and effective as your business grows.',
            ],
        ];

        return view('frontend.pages.best-it-internship', [
            'pageMeta' => $pageMeta,
            'reviews' => $dbReviews,
            'processCards' => $processCards,
            'siteSettings' => SiteLayoutSetting::main(),
        ]);
    }
}

