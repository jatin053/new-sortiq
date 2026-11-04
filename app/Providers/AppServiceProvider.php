<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Review;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        View::composer(['frontend.*', 'layouts.frontend'], function ($view): void {
            try {
                $reviews = Review::query()
                    ->published()
                    ->ordered()
                    ->limit(18)
                    ->get(['name', 'content', 'platform', 'position', 'rating', 'slug'])
                    ->map(fn (Review $review) => [
                        'title' => $review->name,
                        'content' => $review->content,
                        'platform' => $review->platform,
                        'position' => $review->position,
                        'rating' => $review->rating,
                        'slug' => $review->slug,
                    ])
                    ->all();

                $footerRecentBlogs = Blog::query()
                    ->published()
                    ->ordered()
                    ->limit(3)
                    ->get(['title', 'slug', 'published_at']);
            } catch (Throwable $exception) {
                report($exception);

                $reviews = [];
                $footerRecentBlogs = collect();
            }

            $view->with([
                'frontendReviewFeed' => $reviews,
                'footerRecentBlogs' => $footerRecentBlogs,
            ]);
        });
    }
}
