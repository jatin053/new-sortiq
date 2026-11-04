<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\ClientLogo;
use App\Models\Review;
use App\Models\Video;
use Illuminate\View\View;
use Throwable;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('frontend.home.home-page', $this->pageData());
    }

    private function pageData(): array
    {
        try {
            return [
                'homeClientLogos' => ClientLogo::query()
                    ->published()
                    ->ordered()
                    ->get(),
                'homeInsights' => Blog::query()
                    ->published()
                    ->ordered()
                    ->limit(3)
                    ->get(),
                'homeVideos' => Video::query()
                    ->published()
                    ->ordered()
                    ->get()
                    ->filter(fn (Video $video) => filled($video->playback_url))
                    ->take(4)
                    ->values(),
                'homeReviews' => Review::query()
                    ->published()
                    ->ordered()
                    ->get(),
            ];
        } catch (Throwable $exception) {
            report($exception);

            return [
                'homeClientLogos' => collect(),
                'homeInsights' => collect(),
                'homeVideos' => collect(),
                'homeReviews' => collect(),
            ];
        }
    }
}
