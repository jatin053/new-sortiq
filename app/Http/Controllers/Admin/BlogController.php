<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Models\Blog;
use App\Models\SiteLayoutSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $searchTerm = trim((string) $request->query('search'));
        $status = $request->query('status');
        $category = $request->query('category');
        $tag = trim((string) $request->query('tag'));
        $date = trim((string) $request->query('date'));

        if (!in_array($status, ['draft', 'published'], true)) {
            $status = null;
        }

        if ($category !== null && !in_array($category, $this->availableCategories(), true)) {
            $category = null;
        }

        $blogQuery = Blog::query();

        if ($searchTerm !== '') {
            $blogQuery->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('category', 'like', '%' . $searchTerm . '%')
                    ->orWhere('excerpt', 'like', '%' . $searchTerm . '%')
                    ->orWhere('content', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($category !== null) {
            $blogQuery->where(function ($q) use ($category) {
                $q->where('category', $category)
                    ->orWhere('category', 'like', "%, {$category}%")
                    ->orWhere('category', 'like', "%{$category},%")
                    ->orWhere('category', 'like', "%{$category}%");
            });
        }

        if ($tag !== '') {
            $blogQuery->whereJsonContains('tags', $tag);
        }

        if ($date !== '' && preg_match('/^\d{4}-\d{2}$/', $date)) {
            [$year, $month] = explode('-', $date);
            $blogQuery->whereYear('published_at', (int) $year)->whereMonth('published_at', (int) $month);
        }

        $blogsQuery = clone $blogQuery;

        if ($status !== null) {
            $blogsQuery->where('status', $status);
        }

        $blogs = $blogsQuery->ordered()
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'total' => Blog::query()->count(),
            'published' => Blog::query()->published()->count(),
            'draft' => Blog::query()->where('status', 'draft')->count(),
        ];

        $tabCounts = [
            'all' => (clone $blogQuery)->count(),
            'published' => (clone $blogQuery)->where('status', 'published')->count(),
            'draft' => (clone $blogQuery)->where('status', 'draft')->count(),
        ];

        $dateOptions = Blog::query()
            ->whereNotNull('published_at')
            ->selectRaw("DATE_FORMAT(published_at, '%Y-%m') as date_val, DATE_FORMAT(published_at, '%M %Y') as date_label")
            ->distinct()
            ->orderBy('date_val', 'desc')
            ->get()
            ->pluck('date_label', 'date_val')
            ->all();

        return view('admin.blogs.blog-list', [
            'blogs' => $blogs,
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

        return view('admin.blogs.categories', [
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
            return back()->withErrors(['name' => 'This blog category already exists.'])->withInput();
        }

        $setting = SiteLayoutSetting::main();
        $settings = $setting->data ?? [];

        if (isset($settings['deleted_categories']['blogs'])) {
            $settings['deleted_categories']['blogs'] = collect($settings['deleted_categories']['blogs'])
                ->reject(fn ($cat) => strcasecmp($cat, $name) === 0)
                ->values()
                ->all();
        }

        $custom = $settings['admin_categories']['blogs'] ?? [];
        if (!collect($custom)->contains(fn ($cat) => strcasecmp($cat, $name) === 0)) {
            $custom[] = $name;
        }
        $settings['admin_categories']['blogs'] = array_values(array_unique($custom));

        $settings['admin_categories_meta']['blogs'][$name] = [
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
        ];
        $setting->update(['data' => $settings]);

        return redirect()->route('admin.blogs.categories')->with('status', 'Blog category added successfully.');
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
        $customCategories = $settings['admin_categories']['blogs'] ?? [];

        // Check if updating built-in category
        $isBuiltIn = collect(Blog::CATEGORIES)->contains(fn ($cat) => strcasecmp($cat, $originalName) === 0);
        if ($isBuiltIn && strcasecmp($originalName, $newName) !== 0) {
            $deleted = $settings['deleted_categories']['blogs'] ?? [];
            if (!collect($deleted)->contains(fn ($cat) => strcasecmp($cat, $originalName) === 0)) {
                $deleted[] = $originalName;
            }
            $settings['deleted_categories']['blogs'] = array_values(array_unique($deleted));
        }

        if (isset($settings['deleted_categories']['blogs'])) {
            $settings['deleted_categories']['blogs'] = collect($settings['deleted_categories']['blogs'])
                ->reject(fn ($cat) => strcasecmp($cat, $newName) === 0)
                ->values()
                ->all();
        }

        $updatedCustom = collect($customCategories)
            ->reject(fn ($cat) => strcasecmp($cat, $originalName) === 0)
            ->values()
            ->all();
        $updatedCustom[] = $newName;
        $settings['admin_categories']['blogs'] = array_values(array_unique($updatedCustom));

        if (!isset($settings['admin_categories_meta']['blogs'])) {
            $settings['admin_categories_meta']['blogs'] = [];
        }

        unset($settings['admin_categories_meta']['blogs'][$originalName]);
        $settings['admin_categories_meta']['blogs'][$newName] = [
            'name' => $newName,
            'slug' => $newSlug,
            'description' => $description,
        ];

        $setting->update(['data' => $settings]);

        // Update existing blogs with old category name
        if ($originalName !== $newName) {
            $blogsWithCat = Blog::query()->where(function ($q) use ($originalName) {
                $q->where('category', $originalName)
                    ->orWhere('category', 'like', "%, {$originalName}%")
                    ->orWhere('category', 'like', "%{$originalName},%")
                    ->orWhere('category', 'like', "%{$originalName}%");
            })->get();

            foreach ($blogsWithCat as $b) {
                $cats = $b->categories_list;
                $updated = false;
                foreach ($cats as $idx => $c) {
                    if (strcasecmp($c, $originalName) === 0) {
                        $cats[$idx] = $newName;
                        $updated = true;
                    }
                }
                if ($updated) {
                    $b->update(['category' => implode(', ', array_unique($cats))]);
                }
            }
        }

        return redirect()->route('admin.blogs.categories')->with('status', 'Category updated successfully.');
    }

    public function destroyCategory(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
        ]);

        $name = trim($data['name']);
        $setting = SiteLayoutSetting::main();
        $settings = $setting->data ?? [];

        if (isset($settings['admin_categories']['blogs'])) {
            $settings['admin_categories']['blogs'] = collect($settings['admin_categories']['blogs'])
                ->reject(fn ($cat) => strcasecmp($cat, $name) === 0)
                ->values()
                ->all();
        }

        if (isset($settings['admin_categories_meta']['blogs'][$name])) {
            unset($settings['admin_categories_meta']['blogs'][$name]);
        }

        // Always track deleted categories so built-in Blog::CATEGORIES are filtered out as well
        $deleted = $settings['deleted_categories']['blogs'] ?? [];
        if (!collect($deleted)->contains(fn ($cat) => strcasecmp($cat, $name) === 0)) {
            $deleted[] = $name;
        }
        $settings['deleted_categories']['blogs'] = array_values(array_unique($deleted));

        $setting->update(['data' => $settings]);

        // Reset posts category if deleted
        $blogsWithCat = Blog::query()->where(function ($q) use ($name) {
            $q->where('category', $name)
                ->orWhere('category', 'like', "%, {$name}%")
                ->orWhere('category', 'like', "%{$name},%")
                ->orWhere('category', 'like', "%{$name}%");
        })->get();

        foreach ($blogsWithCat as $b) {
            $cats = array_filter($b->categories_list, fn ($c) => strcasecmp($c, $name) !== 0);
            $b->update(['category' => !empty($cats) ? implode(', ', $cats) : null]);
        }

        return redirect()->route('admin.blogs.categories')->with('status', 'Category deleted successfully.');
    }

    public function bulkAction(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'action' => ['required', 'string', 'in:delete,published,draft'],
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'exists:blogs,id'],
        ]);

        $action = $data['action'];
        $ids = $data['ids'];

        if ($action === 'delete') {
            Blog::query()->whereIn('id', $ids)->delete();
            $msg = count($ids) . ' blog(s) deleted successfully.';
        } else {
            Blog::query()->whereIn('id', $ids)->update(['status' => $action]);
            $msg = count($ids) . ' blog(s) updated to ' . $action . '.';
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

        return view('admin.blogs.tags', [
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
            return back()->withErrors(['name' => 'This blog tag already exists.'])->withInput();
        }

        $setting = SiteLayoutSetting::main();
        $settings = $setting->data ?? [];
        $settings['admin_tags']['blogs'][] = $name;
        $settings['admin_tags_meta']['blogs'][$name] = [
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
        ];
        $setting->update(['data' => $settings]);

        return redirect()->route('admin.blogs.tags')->with('status', 'Tag added successfully.');
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
        $customTags = $settings['admin_tags']['blogs'] ?? [];

        $isCustom = collect($customTags)->contains(fn ($t) => strcasecmp($t, $originalName) === 0);

        if ($isCustom) {
            $updatedCustom = collect($customTags)->map(fn ($t) => strcasecmp($t, $originalName) === 0 ? $newName : $t)->values()->all();
            $settings['admin_tags']['blogs'] = $updatedCustom;
        }

        if (!isset($settings['admin_tags_meta']['blogs'])) {
            $settings['admin_tags_meta']['blogs'] = [];
        }

        unset($settings['admin_tags_meta']['blogs'][$originalName]);
        $settings['admin_tags_meta']['blogs'][$newName] = [
            'name' => $newName,
            'slug' => $newSlug,
            'description' => $description,
        ];

        $setting->update(['data' => $settings]);

        // Update existing blogs with old tag name
        if ($originalName !== $newName) {
            Blog::query()->whereJsonContains('tags', $originalName)->get()->each(function (Blog $blog) use ($originalName, $newName) {
                $tags = collect($blog->tags ?? [])->map(fn ($t) => strcasecmp($t, $originalName) === 0 ? $newName : $t)->unique()->values()->all();
                $blog->update(['tags' => $tags]);
            });
        }

        return redirect()->route('admin.blogs.tags')->with('status', 'Tag updated successfully.');
    }

    public function destroyTag(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
        ]);

        $name = trim($data['name']);
        $setting = SiteLayoutSetting::main();
        $settings = $setting->data ?? [];

        if (isset($settings['admin_tags']['blogs'])) {
            $settings['admin_tags']['blogs'] = collect($settings['admin_tags']['blogs'])
                ->reject(fn ($t) => strcasecmp($t, $name) === 0)
                ->values()
                ->all();
        }

        if (isset($settings['admin_tags_meta']['blogs'][$name])) {
            unset($settings['admin_tags_meta']['blogs'][$name]);
        }

        $setting->update(['data' => $settings]);

        // Remove tag from existing blogs
        Blog::query()->whereJsonContains('tags', $name)->get()->each(function (Blog $blog) use ($name) {
            $tags = collect($blog->tags ?? [])->reject(fn ($t) => strcasecmp($t, $name) === 0)->values()->all();
            $blog->update(['tags' => $tags]);
        });

        return redirect()->route('admin.blogs.tags')->with('status', 'Tag deleted successfully.');
    }

    public function create(): View
    {
        $blog = new Blog([
            'published_at' => now(),
            'status' => 'draft',
            'views' => 0,
        ]);

        return view('admin.blogs.create-blog', [
            'blog' => $blog,
            'categories' => $this->availableCategories(),
            'availableTags' => $this->availableTags(),
            'permalink' => $this->permalink($blog),
        ]);
    }

    public function store(BlogRequest $request): RedirectResponse
    {
        $blog = Blog::create($this->payload($request));

        return redirect()
            ->route('admin.blogs.edit', $blog)
            ->with('status', 'Blog created successfully.');
    }

    public function show(Blog $blog): View
    {
        return view('admin.blogs.blog-details', [
            'blog' => $blog,
        ]);
    }

    public function edit(Blog $blog): View
    {
        return view('admin.blogs.edit-blog', [
            'blog' => $blog,
            'categories' => $this->availableCategories(),
            'availableTags' => $this->availableTags(),
            'permalink' => $this->permalink($blog),
        ]);
    }

    public function update(BlogRequest $request, Blog $blog): RedirectResponse
    {
        $payload = $this->payload($request, $blog);

        if (!empty($payload['slug'])) {
            $targetSlug = Str::limit($payload['slug'], 255, '');
            $conflict = Blog::query()
                ->where('slug', $targetSlug)
                ->where('id', '!=', $blog->id)
                ->first();

            if ($conflict) {
                $conflict->update([
                    'slug' => Str::limit($targetSlug, 200, '') . '-dup-' . $conflict->id,
                ]);
            }
            $payload['slug'] = $targetSlug;
        }

        $blog->update($payload);
        $blog->refresh();

        return redirect()
            ->route('admin.blogs.edit', $blog)
            ->with('status', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        if ($blog->image) {
            \App\Support\LocalMedia::deleteUploadedFile($blog->image);
        }

        $title = $blog->title ?: 'Blog post';
        $blog->delete();

        return redirect()
            ->route('admin.blogs.index')
            ->with('status', "\"{$title}\" was deleted successfully.");
    }

    public function toggleStatus(Blog $blog): RedirectResponse
    {
        $newStatus = $blog->status === 'published' ? 'draft' : 'published';
        $blog->update(['status' => $newStatus]);

        $statusLabel = ucfirst($newStatus);
        return back()->with('status', "\"{$blog->title}\" status changed to {$statusLabel}.");
    }

    public function deleteImage(Blog $blog): JsonResponse
    {
        if ($blog->image) {
            \App\Support\LocalMedia::deleteUploadedFile($blog->image);
            $blog->update(['image' => null]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Featured image deleted successfully.',
        ]);
    }

    public function updateSlug(Request $request, $blog): JsonResponse
    {
        $blogModel = null;
        if ($blog instanceof Blog) {
            $blogModel = $blog;
        } elseif (is_numeric($blog)) {
            $blogModel = Blog::find((int) $blog);
        } elseif (is_string($blog)) {
            $blogModel = Blog::where('slug', $blog)->first();
        }

        if (!$blogModel && $request->filled('blog_id')) {
            $blogModel = Blog::find($request->input('blog_id'));
        }

        if (!$blogModel) {
            return response()->json([
                'success' => false,
                'message' => 'Blog post not found.',
            ], 404);
        }

        $rawSlug = $request->input('slug');
        if (is_string($rawSlug) && trim($rawSlug) !== '') {
            $rawSlug = trim($rawSlug);
            if (Str::startsWith($rawSlug, ['http://', 'https://'])) {
                $path = parse_url($rawSlug, PHP_URL_PATH);
                $rawSlug = trim((string) $path, '/');
                if (str_contains($rawSlug, '/')) {
                    $parts = explode('/', $rawSlug);
                    $rawSlug = end($parts);
                }
            } else {
                $rawSlug = trim($rawSlug, '/');
                if (str_contains($rawSlug, '/')) {
                    $parts = explode('/', $rawSlug);
                    $rawSlug = end($parts);
                }
            }
            $slug = Str::slug($rawSlug);
        } else {
            $slug = Str::slug((string) $blogModel->title);
        }

        // Support long slugs up to 255 characters
        $slug = Str::limit($slug, 255, '');

        if ($slug === '') {
            $slug = 'blog-' . $blogModel->id;
        }

        // If another blog post has this exact slug, free it up so this post gets it!
        $conflict = Blog::query()
            ->where('slug', $slug)
            ->where('id', '!=', $blogModel->id)
            ->first();

        if ($conflict) {
            $conflict->update([
                'slug' => Str::limit($slug, 200, '') . '-dup-' . $conflict->id,
            ]);
        }

        $blogModel->update(['slug' => $slug]);
        $blogModel->refresh();

        return response()->json([
            'success' => true,
            'message' => 'Slug updated successfully!',
            'slug' => $blogModel->slug,
            'permalink' => url('/' . $blogModel->slug),
            'edit_url' => route('admin.blogs.edit', $blogModel),
        ]);
    }

    private function permalink(Blog $blog): string
    {
        $slug = $blog->slug;

        if (!$slug) {
            $slug = Str::slug($blog->title ?: 'new-blog');
        }

        return url('/' . ltrim($slug, '/'));
    }

    private function availableCategories(): array
    {
        $settings = SiteLayoutSetting::main()->data ?? [];
        $custom = $settings['admin_categories']['blogs'] ?? [];
        $deleted = $settings['deleted_categories']['blogs'] ?? [];

        return collect([...Blog::CATEGORIES, ...$custom])
            ->filter(fn ($category) => is_string($category) && trim($category) !== '')
            ->map(fn (string $category) => trim($category))
            ->reject(fn (string $category) => in_array(mb_strtolower($category), array_map('mb_strtolower', $deleted), true))
            ->unique(fn (string $category) => mb_strtolower($category))
            ->values()
            ->all();
    }

    private function availableCategoriesDetails(): array
    {
        $customMeta = SiteLayoutSetting::main()->data['admin_categories_meta']['blogs'] ?? [];
        $categoriesList = $this->availableCategories();

        return collect($categoriesList)->map(function (string $name) use ($customMeta) {
            $meta = $customMeta[$name] ?? [];
            $slug = $meta['slug'] ?? Str::slug($name);
            $description = $meta['description'] ?? '—';
            $count = Blog::query()->where(function ($q) use ($name) {
                $q->where('category', $name)
                    ->orWhere('category', 'like', "%, {$name}%")
                    ->orWhere('category', 'like', "%{$name},%")
                    ->orWhere('category', 'like', "%{$name}%");
            })->count();

            return [
                'name' => $name,
                'slug' => $slug,
                'description' => $description !== '' ? $description : '—',
                'count' => $count,
                'is_custom' => true,
            ];
        })->all();
    }

    private function availableTags(): array
    {
        $existing = Blog::query()->get()->flatMap(fn (Blog $blog) => $blog->tags ?? [])->all();
        $custom = SiteLayoutSetting::main()->data['admin_tags']['blogs'] ?? [];

        return collect([...$existing, ...$custom])
            ->filter(fn ($t) => is_string($t) && trim($t) !== '')
            ->map(fn (string $t) => trim($t))
            ->unique(fn (string $t) => mb_strtolower($t))
            ->values()
            ->all();
    }

    private function availableTagsDetails(): array
    {
        $customMeta = SiteLayoutSetting::main()->data['admin_tags_meta']['blogs'] ?? [];
        $tagsList = $this->availableTags();

        return collect($tagsList)->map(function (string $name) use ($customMeta) {
            $meta = $customMeta[$name] ?? [];
            $slug = $meta['slug'] ?? Str::slug($name);
            $description = $meta['description'] ?? '—';
            $count = Blog::query()->whereJsonContains('tags', $name)->count();
            $isCustom = in_array($name, SiteLayoutSetting::main()->data['admin_tags']['blogs'] ?? [], true);

            return [
                'name' => $name,
                'slug' => $slug,
                'description' => $description !== '' ? $description : '—',
                'count' => $count,
                'is_custom' => $isCustom,
            ];
        })->all();
    }

    private function payload(BlogRequest $request, ?Blog $blog = null): array
    {
        Blog::ensureFaqsColumnExists();

        $data = $request->validated();

        unset($data['image_file'], $data['tags_text'], $data['categories']);

        if (!empty($data['excerpt'])) {
            $data['excerpt'] = Str::limit($data['excerpt'], 250, '');
        }

        // Auto-register any new tags into SiteLayoutSetting admin_tags so they are saved system-wide
        if (!empty($data['tags']) && is_array($data['tags'])) {
            try {
                $setting = SiteLayoutSetting::main();
                $settings = $setting->data ?? [];
                $customTags = $settings['admin_tags']['blogs'] ?? [];
                $hasNewTag = false;

                foreach ($data['tags'] as $tag) {
                    $trimmed = trim((string) $tag);
                    if ($trimmed === '') continue;
                    $alreadyExists = collect($customTags)->contains(fn ($t) => strcasecmp($t, $trimmed) === 0);
                    if (!$alreadyExists) {
                        $customTags[] = $trimmed;
                        $hasNewTag = true;
                    }
                }

                if ($hasNewTag) {
                    $settings['admin_tags']['blogs'] = array_values(array_unique($customTags));
                    $setting->update(['data' => $settings]);
                }
            } catch (\Throwable $e) {
                // Ignore failure if settings table is unavailable
            }
        }

        $deleteImage = $request->boolean('delete_image') || $request->input('delete_image') === '1' || $request->input('delete_image') === 1;

        if ($request->hasFile('image_file')) {
            if ($blog && $blog->image) {
                \App\Support\LocalMedia::deleteUploadedFile($blog->image);
            }

            $data['image'] = \App\Support\LocalMedia::storeUploadedFile(
                $request->file('image_file'),
                'uploads/blogs',
                $request->input('title', 'blog-image')
            );
        } elseif ($deleteImage) {
            if ($blog && $blog->image) {
                \App\Support\LocalMedia::deleteUploadedFile($blog->image);
            }
            $data['image'] = null;
        } elseif ($blog) {
            $data['image'] = $blog->image;
        }

        return $data;
    }
}
