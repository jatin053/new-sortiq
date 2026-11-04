<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PortfolioRequest;
use App\Models\Portfolio;
use App\Models\SiteLayoutSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(Request $request): View
    {
        $searchTerm = trim($request->query('search', ''));
        $status = $request->query('status');
        $category = $request->query('category');
        $tag = trim((string) $request->query('tag'));
        $date = trim((string) $request->query('date'));

        if ($status !== 'draft' && $status !== 'published') {
            $status = null;
        }

        if (!is_string($category) || !in_array($category, array_keys($this->availableCategories()), true)) {
            $category = null;
        }

        $query = Portfolio::query();

        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('category_name', 'like', "%{$searchTerm}%")
                    ->orWhere('summary', 'like', "%{$searchTerm}%")
                    ->orWhere('content', 'like', "%{$searchTerm}%");
            });
        }

        if ($category !== null) {
            $query->where('category_slug', $category);
        }

        if ($tag !== '') {
            $query->whereJsonContains('tags', $tag);
        }

        if ($date !== '' && preg_match('/^\d{4}-\d{2}$/', $date)) {
            [$year, $month] = explode('-', $date);
            $query->whereYear('published_at', (int) $year)->whereMonth('published_at', (int) $month);
        }

        $tabQuery = clone $query;

        if ($status) {
            $query->where('status', $status);
        }

        $portfolios = $query
            ->ordered()
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'total' => Portfolio::count(),
            'published' => Portfolio::where('status', 'published')->count(),
            'draft' => Portfolio::where('status', 'draft')->count(),
        ];

        $tabCounts = [
            'all' => $tabQuery->count(),
            'published' => (clone $tabQuery)->where('status', 'published')->count(),
            'draft' => (clone $tabQuery)->where('status', 'draft')->count(),
        ];

        $dateOptions = Portfolio::query()
            ->whereNotNull('published_at')
            ->selectRaw("DATE_FORMAT(published_at, '%Y-%m') as date_val, DATE_FORMAT(published_at, '%M %Y') as date_label")
            ->distinct()
            ->orderBy('date_val', 'desc')
            ->get()
            ->pluck('date_label', 'date_val')
            ->all();

        return view('admin.portfolios.portfolio-list', [
            'portfolios' => $portfolios,
            'searchTerm' => $searchTerm,
            'activeStatus' => $status,
            'activeCategory' => $category,
            'activeTag' => $tag !== '' ? $tag : null,
            'activeDate' => $date !== '' ? $date : null,
            'stats' => $stats,
            'tabCounts' => $tabCounts,
            'categories' => $this->availableCategoriesDetails(),
            'tagsList' => $this->availableTagsDetails(),
            'dateOptions' => $dateOptions,
        ]);
    }

    public function categories(Request $request): View
    {
        $search = trim((string) $request->query('search'));
        $categories = collect($this->availableCategoriesDetails());

        if ($search !== '') {
            $categories = $categories->filter(function ($item) use ($search) {
                return Str::contains(mb_strtolower($item['name']), mb_strtolower($search))
                    || Str::contains(mb_strtolower($item['slug']), mb_strtolower($search))
                    || Str::contains(mb_strtolower($item['description']), mb_strtolower($search));
            });
        }

        return view('admin.portfolios.categories', [
            'categories' => $categories->values(),
            'searchTerm' => $search,
            'totalCount' => $categories->count(),
        ]);
    }

    public function storeCategory(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'slug' => ['nullable', 'string', 'max:80'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $name = trim($data['name']);
        $slug = filled($data['slug']) ? Str::slug($data['slug']) : Str::slug($name);
        $description = trim((string) ($data['description'] ?? ''));

        if (collect($this->availableCategories())->contains(fn (string $category) => strcasecmp($category, $name) === 0)) {
            return back()->withErrors(['name' => 'This portfolio category already exists.'])->withInput();
        }

        $setting = SiteLayoutSetting::main();
        $settings = $setting->data ?? [];
        $settings['admin_categories']['portfolios'][] = $name;
        $settings['admin_categories_meta']['portfolios'][$name] = [
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
        ];
        $setting->update(['data' => $settings]);

        return redirect()->route('admin.portfolios.categories')->with('status', 'Portfolio category added successfully.');
    }

    public function updateCategory(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'original_name' => ['required', 'string'],
            'name' => ['required', 'string', 'max:80'],
            'slug' => ['nullable', 'string', 'max:80'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $originalName = trim($data['original_name']);
        $newName = trim($data['name']);
        $newSlug = filled($data['slug']) ? Str::slug($data['slug']) : Str::slug($newName);
        $description = trim((string) ($data['description'] ?? ''));

        $setting = SiteLayoutSetting::main();
        $settings = $setting->data ?? [];
        $customCategories = $settings['admin_categories']['portfolios'] ?? [];

        $isCustom = collect($customCategories)->contains(fn ($cat) => strcasecmp($cat, $originalName) === 0);

        if ($isCustom) {
            $updatedCustom = collect($customCategories)->map(fn ($cat) => strcasecmp($cat, $originalName) === 0 ? $newName : $cat)->values()->all();
            $settings['admin_categories']['portfolios'] = $updatedCustom;
        }

        if (!isset($settings['admin_categories_meta']['portfolios'])) {
            $settings['admin_categories_meta']['portfolios'] = [];
        }

        unset($settings['admin_categories_meta']['portfolios'][$originalName]);
        $settings['admin_categories_meta']['portfolios'][$newName] = [
            'name' => $newName,
            'slug' => $newSlug,
            'description' => $description,
        ];

        $setting->update(['data' => $settings]);

        if ($originalName !== $newName || $newSlug !== Str::slug($originalName)) {
            Portfolio::query()->where('category_name', $originalName)->update([
                'category_name' => $newName,
                'category_slug' => $newSlug,
            ]);
        }

        return redirect()->route('admin.portfolios.categories')->with('status', 'Category updated successfully.');
    }

    public function destroyCategory(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
        ]);

        $name = trim($data['name']);
        $setting = SiteLayoutSetting::main();
        $settings = $setting->data ?? [];

        if (isset($settings['admin_categories']['portfolios'])) {
            $settings['admin_categories']['portfolios'] = collect($settings['admin_categories']['portfolios'])
                ->reject(fn ($cat) => strcasecmp($cat, $name) === 0)
                ->values()
                ->all();
        }

        if (isset($settings['admin_categories_meta']['portfolios'][$name])) {
            unset($settings['admin_categories_meta']['portfolios'][$name]);
        }

        $setting->update(['data' => $settings]);

        return redirect()->route('admin.portfolios.categories')->with('status', 'Category deleted successfully.');
    }

    public function bulkAction(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'action' => ['required', 'string', 'in:delete,published,draft'],
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'exists:portfolios,id'],
        ]);

        $action = $data['action'];
        $ids = $data['ids'];

        if ($action === 'delete') {
            Portfolio::query()->whereIn('id', $ids)->delete();
            $msg = count($ids) . ' portfolio project(s) deleted successfully.';
        } else {
            Portfolio::query()->whereIn('id', $ids)->update(['status' => $action]);
            $msg = count($ids) . ' portfolio project(s) updated to ' . $action . '.';
        }

        return back()->with('status', $msg);
    }

    public function tags(Request $request): View
    {
        $search = trim((string) $request->query('search'));
        $tags = collect($this->availableTagsDetails());

        if ($search !== '') {
            $tags = $tags->filter(function ($item) use ($search) {
                return Str::contains(mb_strtolower($item['name']), mb_strtolower($search))
                    || Str::contains(mb_strtolower($item['slug']), mb_strtolower($search))
                    || Str::contains(mb_strtolower($item['description']), mb_strtolower($search));
            });
        }

        return view('admin.portfolios.tags', [
            'tags' => $tags->values(),
            'searchTerm' => $search,
            'totalCount' => $tags->count(),
        ]);
    }

    public function storeTag(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'slug' => ['nullable', 'string', 'max:80'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $name = trim($data['name']);
        $slug = filled($data['slug']) ? Str::slug($data['slug']) : Str::slug($name);
        $description = trim((string) ($data['description'] ?? ''));

        if (collect($this->availableTags())->contains(fn (string $t) => strcasecmp($t, $name) === 0)) {
            return back()->withErrors(['name' => 'This portfolio tag already exists.'])->withInput();
        }

        $setting = SiteLayoutSetting::main();
        $settings = $setting->data ?? [];
        $settings['admin_tags']['portfolios'][] = $name;
        $settings['admin_tags_meta']['portfolios'][$name] = [
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
        ];
        $setting->update(['data' => $settings]);

        return redirect()->route('admin.portfolios.tags')->with('status', 'Tag added successfully.');
    }

    public function updateTag(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'original_name' => ['required', 'string'],
            'name' => ['required', 'string', 'max:80'],
            'slug' => ['nullable', 'string', 'max:80'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $originalName = trim($data['original_name']);
        $newName = trim($data['name']);
        $newSlug = filled($data['slug']) ? Str::slug($data['slug']) : Str::slug($newName);
        $description = trim((string) ($data['description'] ?? ''));

        $setting = SiteLayoutSetting::main();
        $settings = $setting->data ?? [];
        $customTags = $settings['admin_tags']['portfolios'] ?? [];

        $isCustom = collect($customTags)->contains(fn ($t) => strcasecmp($t, $originalName) === 0);

        if ($isCustom) {
            $updatedCustom = collect($customTags)->map(fn ($t) => strcasecmp($t, $originalName) === 0 ? $newName : $t)->values()->all();
            $settings['admin_tags']['portfolios'] = $updatedCustom;
        }

        if (!isset($settings['admin_tags_meta']['portfolios'])) {
            $settings['admin_tags_meta']['portfolios'] = [];
        }

        unset($settings['admin_tags_meta']['portfolios'][$originalName]);
        $settings['admin_tags_meta']['portfolios'][$newName] = [
            'name' => $newName,
            'slug' => $newSlug,
            'description' => $description,
        ];

        $setting->update(['data' => $settings]);

        // Update existing portfolios with old tag name
        if ($originalName !== $newName) {
            Portfolio::query()->whereJsonContains('tags', $originalName)->get()->each(function (Portfolio $portfolio) use ($originalName, $newName) {
                $tags = collect($portfolio->tags ?? [])->map(fn ($t) => strcasecmp($t, $originalName) === 0 ? $newName : $t)->unique()->values()->all();
                $portfolio->update(['tags' => $tags]);
            });
        }

        return redirect()->route('admin.portfolios.tags')->with('status', 'Tag updated successfully.');
    }

    public function destroyTag(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
        ]);

        $name = trim($data['name']);
        $setting = SiteLayoutSetting::main();
        $settings = $setting->data ?? [];

        if (isset($settings['admin_tags']['portfolios'])) {
            $settings['admin_tags']['portfolios'] = collect($settings['admin_tags']['portfolios'])
                ->reject(fn ($t) => strcasecmp($t, $name) === 0)
                ->values()
                ->all();
        }

        if (isset($settings['admin_tags_meta']['portfolios'][$name])) {
            unset($settings['admin_tags_meta']['portfolios'][$name]);
        }

        $setting->update(['data' => $settings]);

        // Remove tag from existing portfolios
        Portfolio::query()->whereJsonContains('tags', $name)->get()->each(function (Portfolio $portfolio) use ($name) {
            $tags = collect($portfolio->tags ?? [])->reject(fn ($t) => strcasecmp($t, $name) === 0)->values()->all();
            $portfolio->update(['tags' => $tags]);
        });

        return redirect()->route('admin.portfolios.tags')->with('status', 'Tag deleted successfully.');
    }

    public function create(): View
    {
        $categories = $this->availableCategories();
        $defaultCategorySlug = array_key_first($categories) ?: 'graphic-designing';
        $defaultCategoryName = $categories[$defaultCategorySlug] ?? 'Graphic Designing';

        $portfolio = new Portfolio([
            'status' => 'published',
            'published_at' => now(),
            'sort_order' => 0,
            'category_slug' => $defaultCategorySlug,
            'category_name' => $defaultCategoryName,
        ]);

        return view('admin.portfolios.create-portfolio', [
            'portfolio' => $portfolio,
            'categories' => $categories,
            'permalink' => $this->getPermalink($portfolio),
        ]);
    }

    public function store(PortfolioRequest $request): RedirectResponse
    {
        $portfolio = Portfolio::create($this->payload($request));

        return redirect()
            ->route('admin.portfolios.edit', $portfolio)
            ->with('status', 'Portfolio created successfully.');
    }

    public function show(Portfolio $portfolio): View
    {
        return view('admin.portfolios.portfolio-details', [
            'portfolio' => $portfolio,
        ]);
    }

    public function edit(Portfolio $portfolio): View
    {
        return view('admin.portfolios.edit-portfolio', [
            'portfolio' => $portfolio,
            'categories' => $this->availableCategories(),
            'permalink' => $this->getPermalink($portfolio),
        ]);
    }

    public function update(PortfolioRequest $request, Portfolio $portfolio): RedirectResponse
    {
        $portfolio->update($this->payload($request, $portfolio));
        $portfolio->refresh();

        return redirect()
            ->route('admin.portfolios.edit', $portfolio)
            ->with('status', 'Portfolio updated successfully.');
    }

    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        if ($portfolio->image) {
            \App\Support\LocalMedia::deleteUploadedFile($portfolio->image);
        }

        $title = $portfolio->title ?: 'Portfolio project';
        $portfolio->delete();

        return redirect()
            ->route('admin.portfolios.index')
            ->with('status', "\"{$title}\" was deleted successfully.");
    }

    public function toggleStatus(Portfolio $portfolio): RedirectResponse
    {
        $newStatus = $portfolio->status === 'published' ? 'draft' : 'published';
        $portfolio->update(['status' => $newStatus]);

        $statusLabel = ucfirst($newStatus);
        return back()->with('status', "\"{$portfolio->title}\" status changed to {$statusLabel}.");
    }

    private function getPermalink(Portfolio $portfolio): string
    {
        $slug = $portfolio->slug;

        if (empty($slug)) {
            $slug = Str::slug($portfolio->title ?: 'new-portfolio');
        }

        return url('portfolio/' . $slug);
    }

    private function availableCategories(): array
    {
        $categories = Portfolio::CATEGORY_OPTIONS;
        $custom = SiteLayoutSetting::main()->data['admin_categories']['portfolios'] ?? [];

        foreach ($custom as $customName) {
            if (is_string($customName) && trim($customName) !== '') {
                $slug = Str::slug($customName);
                if (!isset($categories[$slug])) {
                    $categories[$slug] = trim($customName);
                }
            }
        }

        return $categories;
    }

    private function availableCategoriesDetails(): array
    {
        $customMeta = SiteLayoutSetting::main()->data['admin_categories_meta']['portfolios'] ?? [];
        $categoriesList = $this->availableCategories();

        return collect($categoriesList)->map(function (string $name, string $slug) use ($customMeta) {
            $meta = $customMeta[$name] ?? [];
            $catSlug = $meta['slug'] ?? $slug;
            $description = $meta['description'] ?? '—';
            $count = Portfolio::query()->where('category_slug', $catSlug)->orWhere('category_name', $name)->count();
            $isCustom = in_array($name, SiteLayoutSetting::main()->data['admin_categories']['portfolios'] ?? [], true);

            return [
                'name' => $name,
                'slug' => $catSlug,
                'description' => $description !== '' ? $description : '—',
                'count' => $count,
                'is_custom' => $isCustom,
            ];
        })->values()->all();
    }

    private function availableTags(): array
    {
        $existing = Portfolio::query()->get()->flatMap(fn (Portfolio $portfolio) => $portfolio->tags ?? [])->all();
        $custom = SiteLayoutSetting::main()->data['admin_tags']['portfolios'] ?? [];

        return collect([...$existing, ...$custom])
            ->filter(fn ($t) => is_string($t) && trim($t) !== '')
            ->map(fn (string $t) => trim($t))
            ->unique(fn (string $t) => mb_strtolower($t))
            ->values()
            ->all();
    }

    private function availableTagsDetails(): array
    {
        $customMeta = SiteLayoutSetting::main()->data['admin_tags_meta']['portfolios'] ?? [];
        $tagsList = $this->availableTags();

        return collect($tagsList)->map(function (string $name) use ($customMeta) {
            $meta = $customMeta[$name] ?? [];
            $slug = $meta['slug'] ?? Str::slug($name);
            $description = $meta['description'] ?? '—';
            $count = Portfolio::query()->whereJsonContains('tags', $name)->count();
            $isCustom = in_array($name, SiteLayoutSetting::main()->data['admin_tags']['portfolios'] ?? [], true);

            return [
                'name' => $name,
                'slug' => $slug,
                'description' => $description !== '' ? $description : '—',
                'count' => $count,
                'is_custom' => $isCustom,
            ];
        })->all();
    }

    private function payload(PortfolioRequest $request, ?Portfolio $portfolio = null): array
    {
        $data = $request->validated();

        unset($data['image_file'], $data['tags_text']);

        if ($request->hasFile('image_file')) {
            if ($portfolio) {
                \App\Support\LocalMedia::deleteUploadedFile($portfolio->image);
            }

            $data['image'] = \App\Support\LocalMedia::storeUploadedFile(
                $request->file('image_file'),
                'uploads/portfolios',
                $request->input('title', 'portfolio-image')
            );
        } elseif ($portfolio) {
            $data['image'] = $portfolio->image;
        }

        return $data;
    }
}
