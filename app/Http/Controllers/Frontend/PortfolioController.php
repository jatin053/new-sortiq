<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Throwable;

class PortfolioController extends Controller
{
    private const PORTFOLIOS_PER_PAGE = 6;

    public function index(): View
    {
        $portfolioCategories = $this->portfolioCategories();
        $portfolioItems = $this->portfolioItems();
        $activeCategory = (string) ($portfolioCategories->first()['slug'] ?? '');
        $visiblePortfolioItems = $this->visiblePortfolioItems($portfolioItems, $activeCategory);
        $visiblePortfolioTotalPages = $this->visiblePortfolioTotalPages($portfolioItems, $activeCategory);

        return view('frontend.portfolio.portfolio-page', [
            'activePortfolioCategory' => $activeCategory,
            'portfolioCategories' => $portfolioCategories,
            'portfolioItems' => $portfolioItems,
            'visiblePortfolioItems' => $visiblePortfolioItems,
            'visiblePortfolioTotalPages' => $visiblePortfolioTotalPages,
            'portfolioPagePayload' => [
                'activeCategory' => $activeCategory,
                'categories' => $portfolioCategories->all(),
                'items' => $portfolioItems->all(),
                'itemsPerPage' => self::PORTFOLIOS_PER_PAGE,
            ],
        ]);
    }

    private function portfolioCategories(): Collection
    {
        try {
            $portfolioCategories = Portfolio::query()
                ->published()
                ->whereNotNull('category_slug')
                ->whereNotNull('category_name')
                ->where('category_slug', '!=', '')
                ->where('category_name', '!=', '')
                ->selectRaw('category_slug, MIN(category_name) as category_name, COUNT(*) as total')
                ->groupBy('category_slug')
                ->get()
                ->map(fn (Portfolio $portfolio) => [
                    'name' => Portfolio::CATEGORY_OPTIONS[$portfolio->category_slug] ?? $portfolio->category_name,
                    'slug' => $portfolio->category_slug,
                    'total' => (int) $portfolio->total,
                ]);

            return $this->orderedPortfolioCategories($portfolioCategories);
        } catch (Throwable $exception) {
            report($exception);

            return collect();
        }
    }

    private function portfolioItems(): Collection
    {
        try {
            return Portfolio::query()
                ->published()
                ->ordered()
                ->get()
                ->map(fn (Portfolio $portfolio) => [
                    'id' => $portfolio->getKey(),
                    'title' => $portfolio->title,
                    'image_url' => $portfolio->image_url,
                    'category_slug' => $portfolio->category_slug,
                    'category_name' => Portfolio::CATEGORY_OPTIONS[$portfolio->category_slug] ?? $portfolio->category_name,
                ])
                ->filter(fn (array $portfolio) => filled($portfolio['category_slug']))
                ->values();
        } catch (Throwable $exception) {
            report($exception);

            return collect();
        }
    }

    private function orderedPortfolioCategories(Collection $portfolioCategories): Collection
    {
        $categoriesBySlug = $portfolioCategories->keyBy('slug');

        $orderedCategories = collect(Portfolio::CATEGORY_OPTIONS)
            ->map(function (string $defaultName, string $slug) use ($categoriesBySlug) {
                $category = $categoriesBySlug->get($slug);

                if (! is_array($category)) {
                    return null;
                }

                return [
                    'slug' => $slug,
                    'name' => $category['name'] ?: $defaultName,
                    'total' => $category['total'],
                ];
            })
            ->filter();

        $remainingCategories = $portfolioCategories
            ->reject(fn (array $category) => array_key_exists($category['slug'], Portfolio::CATEGORY_OPTIONS))
            ->sortBy('name')
            ->values();

        return $orderedCategories
            ->concat($remainingCategories)
            ->values();
    }

    private function visiblePortfolioItems(Collection $portfolioItems, string $activeCategory): Collection
    {
        return $portfolioItems
            ->filter(fn (array $portfolio) => $portfolio['category_slug'] === $activeCategory)
            ->values();
    }

    private function visiblePortfolioTotalPages(Collection $portfolioItems, string $activeCategory): int
    {
        $portfolioCount = $portfolioItems
            ->filter(fn (array $portfolio) => $portfolio['category_slug'] === $activeCategory)
            ->count();

        return (int) ceil($portfolioCount / self::PORTFOLIOS_PER_PAGE);
    }
}
