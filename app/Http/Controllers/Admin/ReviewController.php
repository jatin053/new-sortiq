<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReviewRequest;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(Request $request): View
    {
        $searchTerm = trim($request->query('search', ''));
        $status = $request->query('status');

        if ($status !== 'draft' && $status !== 'published') {
            $status = null;
        }

        $query = Review::query();

        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('platform', 'like', "%{$searchTerm}%")
                    ->orWhere('position', 'like', "%{$searchTerm}%")
                    ->orWhere('summary', 'like', "%{$searchTerm}%")
                    ->orWhere('content', 'like', "%{$searchTerm}%");
            });
        }

        $tabQuery = clone $query;

        if ($status) {
            $query->where('status', $status);
        }

        $reviews = $query
            ->ordered()
            ->paginate(10)
            ->withQueryString();

        $stats = [
            'total' => Review::count(),
            'published' => Review::where('status', 'published')->count(),
            'draft' => Review::where('status', 'draft')->count(),
            'platforms' => Review::whereNotNull('platform')->distinct()->count('platform'),
        ];

        $tabCounts = [
            'all' => $tabQuery->count(),
            'published' => (clone $tabQuery)->where('status', 'published')->count(),
            'draft' => (clone $tabQuery)->where('status', 'draft')->count(),
        ];

        return view('admin.reviews.review-list', [
            'reviews' => $reviews,
            'searchTerm' => $searchTerm,
            'activeStatus' => $status,
            'stats' => $stats,
            'tabCounts' => $tabCounts,
        ]);
    }

    public function create(): View
    {
        $review = new Review([
            'rating' => 5,
            'published_at' => now(),
            'status' => 'draft',
            'views' => 0,
        ]);

        return view('admin.reviews.create-review', [
            'review' => $review,
            'platforms' => Review::PLATFORMS,
            'permalink' => $this->getPermalink($review),
        ]);
    }

    public function store(ReviewRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $review = Review::create($data);

        return redirect()
            ->route('admin.reviews.edit', $review)
            ->with('status', 'Review created successfully.');
    }

    public function show(Review $review): View
    {
        return view('admin.reviews.review-details', [
            'review' => $review,
        ]);
    }

    public function edit(Review $review): View
    {
        return view('admin.reviews.edit-review', [
            'review' => $review,
            'platforms' => Review::PLATFORMS,
            'permalink' => $this->getPermalink($review),
        ]);
    }

    public function update(ReviewRequest $request, Review $review): RedirectResponse
    {
        $data = $request->validated();

        $review->update($data);
        $review->refresh();

        return redirect()
            ->route('admin.reviews.edit', $review)
            ->with('status', 'Review updated successfully.');
    }

    public function destroy(Review $review): RedirectResponse
    {
        $name = $review->name ?: 'Review';
        $review->delete();

        return redirect()
            ->route('admin.reviews.index')
            ->with('status', "\"{$name}\" was deleted successfully.");
    }

    public function toggleStatus(Review $review): RedirectResponse
    {
        $newStatus = $review->status === 'published' ? 'draft' : 'published';
        $review->update(['status' => $newStatus]);

        $statusLabel = ucfirst($newStatus);
        return back()->with('status', "\"{$review->name}\" status changed to {$statusLabel}.");
    }

    private function getPermalink(Review $review): string
    {
        $slug = $review->slug;

        if (empty($slug)) {
            $slug = Str::slug($review->name ?: 'new-review');
        }

        return route('frontend.reviews.show', $slug);
    }
}
