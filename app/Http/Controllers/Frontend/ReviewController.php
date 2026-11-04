<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Support\Seo\PageMeta;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class ReviewController extends Controller
{
    private const REVIEWS_PER_PAGE = 9;

    public function index(): View
    {
        return view('frontend.reviews.reviews-page', [
            'reviews' => $this->reviews(),
        ]);
    }

    public function show(string $slug): View|RedirectResponse
    {
        try {
            $review = Review::query()->where('slug', $slug)->first();
        } catch (Throwable $exception) {
            report($exception);

            return redirect()->route('frontend.reviews');
        }

        if (! $review || (! auth()->check() && $review->status !== 'published')) {
            abort(404);
        }

        $this->recordView($review);

        return view('frontend.reviews.show', [
            'review' => $review,
            'recentReviews' => $this->recentReviews($review),
            'pageMeta' => PageMeta::article(
                $review->summary ?: $review->content,
                null,
                "{$review->name} Review | Sortiq Solutions"
            ),
        ]);
    }

    private function reviews(): LengthAwarePaginator
    {
        try {
            return Review::query()
                ->published()
                ->ordered()
                ->paginate(self::REVIEWS_PER_PAGE);
        } catch (Throwable $exception) {
            report($exception);

            return $this->emptyReviewPaginator();
        }
    }

    private function recentReviews(Review $review)
    {
        try {
            return Review::query()
                ->published()
                ->whereKeyNot($review->getKey())
                ->ordered()
                ->limit(3)
                ->get();
        } catch (Throwable $exception) {
            report($exception);

            return collect();
        }
    }

    private function recordView(Review $review): void
    {
        try {
            $review->increment('views');
            $review->refresh();
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    private function emptyReviewPaginator(): LengthAwarePaginator
    {
        return new LengthAwarePaginator(
            collect(),
            0,
            self::REVIEWS_PER_PAGE,
            Paginator::resolveCurrentPage(),
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );
    }
}
