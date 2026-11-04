<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;

class ReviewController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        try {
            $reviews = Review::query()
                ->where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->get();
        } catch (Throwable $exception) {
            report($exception);

            $reviews = collect();
        }

        return ReviewResource::collection($reviews);
    }

    public function show(Review $review): ReviewResource
    {
        if ($review->status !== 'published') {
            abort(404);
        }

        return new ReviewResource($review);
    }
}
