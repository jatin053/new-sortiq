<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Review;
use App\Models\SiteLayoutSetting;
use Illuminate\View\View;
use Throwable;

class ItCompanyController extends Controller
{
    /**
     * Display the Best IT Company in Chandigarh page.
     */
    public function show(): View
    {
        try {
            $reviews = Review::query()
                ->published()
                ->ordered()
                ->get();
        } catch (Throwable $e) {
            report($e);
            $reviews = collect();
        }

        try {
            $pageMeta = Page::query()
                ->where('route_name', 'frontend.best-it-company-chandigarh')
                ->orWhere('url_path', '/best-it-company-in-chandigarh')
                ->first();
        } catch (Throwable $e) {
            report($e);
            $pageMeta = null;
        }

        $processCards = [
            [
                'title' => 'Understand Your Goals',
                'image' => 'discovery-and-strategy.webp',
                'text' => 'We start with a discussion to understand your business, your audience, and what you want to achieve. This ensures every solution is aligned with your vision from day one.',
            ],
            [
                'title' => 'Plan the Right Approach',
                'image' => 'wireframing-and-design.webp',
                'text' => 'Once your goals are clear, we map out the project structure, key features, and workflow so everyone knows exactly what will be built and why.',
            ],
            [
                'title' => 'Design with Users in Mind',
                'image' => 'development-and-coding.webp',
                'text' => 'Our team creates intuitive and user-friendly designs that make navigation simple and interactions smooth, keeping your customers\' experience at the forefront.',
            ],
            [
                'title' => 'Develop with Best Practices',
                'image' => 'launch-and-deployment.webp',
                'text' => 'We build your solution using modern technologies, ensuring the code is clean, scalable, and reliable for easy updates and long-term growth.',
            ],
            [
                'title' => 'Test Before Going Live',
                'image' => 'testing-and-assurance.webp',
                'text' => 'Before launch, we rigorously test the application to guarantee it works flawlessly across devices and meets your expectations.',
            ],
            [
                'title' => 'Launch & Ongoing Support',
                'image' => 'maintenance-and-optimization.webp',
                'text' => 'We help you go live seamlessly and provide continuous support, updates, and improvements as your business evolves.',
            ],
        ];

        return view('frontend.pages.best-it-company-chandigarh', [
            'pageMeta' => $pageMeta,
            'reviews' => $reviews,
            'processCards' => $processCards,
            'siteSettings' => SiteLayoutSetting::main(),
        ]);
    }

    /**
     * Display the Best IT Company in Mohali page.
     */
    public function mohali(): View
    {
        try {
            $reviews = Review::query()
                ->published()
                ->ordered()
                ->get();
        } catch (Throwable $e) {
            report($e);
            $reviews = collect();
        }

        try {
            $pageMeta = Page::query()
                ->where('route_name', 'frontend.best-it-company-mohali')
                ->orWhere('url_path', '/best-it-company-in-mohali')
                ->first();
        } catch (Throwable $e) {
            report($e);
            $pageMeta = null;
        }

        $processCards = [
            [
                'title' => 'Understanding Your Business',
                'image' => 'discovery-and-strategy.webp',
                'text' => 'We start by learning about your goals and challenges so that our solutions match your exact needs.',
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
                'text' => 'Every solution is thoroughly tested to ensure it works perfectly. We then launch it smoothly so you can go live without any issues.',
            ],
            [
                'title' => 'Support and Improvement',
                'image' => 'maintenance-and-optimization.webp',
                'text' => 'After launch, we continue to support and improve your solutions, keeping them up-to-date and effective as your business grows.',
            ],
        ];

        return view('frontend.pages.best-it-company-mohali', [
            'pageMeta' => $pageMeta,
            'reviews' => $reviews,
            'processCards' => $processCards,
            'siteSettings' => SiteLayoutSetting::main(),
        ]);
    }
}

