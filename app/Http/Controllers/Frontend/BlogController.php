<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Support\Seo\PageMeta;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class BlogController extends Controller
{
    private const BLOGS_PER_PAGE = 4;

    public function index(Request $request): Response
    {
        $searchTerm = trim((string) $request->query('search'));
        $rawCategory = trim((string) $request->query('category'));
        $categories = $this->categories();

        $categoryMap = [];
        foreach ($categories as $category) {
            $categoryMap[$category->slug] = $category->name;
            $categoryMap[mb_strtolower($category->name)] = $category->name;
            $categoryMap[$category->name] = $category->name;
        }

        $activeCategorySlug = '';
        $activeCategoryName = '';

        if ($rawCategory !== '') {
            $slugKey = Str::slug($rawCategory);
            $lowerKey = mb_strtolower($rawCategory);
            if (isset($categoryMap[$slugKey])) {
                $activeCategoryName = $categoryMap[$slugKey];
                $activeCategorySlug = $slugKey;
            } elseif (isset($categoryMap[$lowerKey])) {
                $activeCategoryName = $categoryMap[$lowerKey];
                $activeCategorySlug = Str::slug($categoryMap[$lowerKey]);
            } elseif (isset($categoryMap[$rawCategory])) {
                $activeCategoryName = $categoryMap[$rawCategory];
                $activeCategorySlug = Str::slug($categoryMap[$rawCategory]);
            }
        }

        return response()
            ->view('frontend.blog.blog-list', [
                'blogs' => $this->blogs($searchTerm, $activeCategoryName),
                'categories' => $categories,
                'recentBlogs' => $this->recentBlogs(),
                'searchTerm' => $searchTerm,
                'activeCategory' => $activeCategorySlug,
                'activeCategoryName' => $activeCategoryName,
            ])
            ->header('Cache-Control', 'no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache');
    }

    public function feed(): JsonResponse
    {
        try {
            $blogs = $this->publishedBlogsQuery()
                ->get()
                ->map(function (Blog $blog) {
                    $cats = $blog->categories_list;
                    if (empty($cats)) {
                        $cats = ['General'];
                    }

                    return [
                        'title' => $blog->title,
                        'slug' => $blog->slug,
                        'image' => $blog->image_url,
                        'excerpt' => $blog->excerpt ?: Str::limit(strip_tags($blog->content), 140),
                        'date' => $blog->published_at?->toDateString(),
                        'categories' => array_map(fn ($c) => [
                            'name' => $c,
                            'slug' => Str::slug($c),
                        ], $cats),
                    ];
                })
                ->values();
        } catch (Throwable $exception) {
            report($exception);

            $blogs = collect();
        }

        return response()->json($blogs);
    }

    public function show(string $slug): Response|RedirectResponse
    {
        try {
            $blog = Blog::query()
                ->when(
                    ! auth()->check(),
                    fn (Builder $query) => $query->published(),
                )
                ->where('slug', $slug)
                ->first();
        } catch (Throwable $exception) {
            report($exception);

            return redirect()->route('frontend.blog.index');
        }

        if (! $blog) {
            if (str_contains($slug, '-dup-')) {
                $cleanSlug = preg_replace('/-dup-\d+$/', '', $slug);
                $targetBlog = Blog::query()->where('slug', $cleanSlug)->first();
                if ($targetBlog) {
                    return redirect()->to(url('/' . $cleanSlug), 301);
                }
            }

            abort(404);
        }

        $this->recordBlogView($blog);

        $prevBlog = null;
        $nextBlog = null;

        try {
            // Previous chronological post (newer)
            $prevBlog = Blog::query()
                ->when(
                    ! auth()->check(),
                    fn (Builder $query) => $query->published(),
                )
                ->where(function ($query) use ($blog) {
                    $query->where('published_at', '>', $blog->published_at)
                        ->orWhere(function ($query) use ($blog) {
                            $query->where('published_at', $blog->published_at)
                                ->where('id', '>', $blog->id);
                        });
                })
                ->orderBy('published_at', 'asc')
                ->orderBy('id', 'asc')
                ->first();

            // Next chronological post (older)
            $nextBlog = Blog::query()
                ->when(
                    ! auth()->check(),
                    fn (Builder $query) => $query->published(),
                )
                ->where(function ($query) use ($blog) {
                    $query->where('published_at', '<', $blog->published_at)
                        ->orWhere(function ($query) use ($blog) {
                            $query->where('published_at', $blog->published_at)
                                ->where('id', '<', $blog->id);
                        });
                })
                ->ordered()
                ->first();
        } catch (Throwable $exception) {
            report($exception);
        }

        $rawMetaTitle = trim((string) ($blog->meta_title ?: ''));
        if ($rawMetaTitle !== '') {
            $blogMetaTitle = $rawMetaTitle;
        } else {
            $blogMetaTitle = trim((string) $blog->title);
            if (! str_contains(strtolower($blogMetaTitle), 'sortiq')) {
                $blogMetaTitle .= ' | Sortiq Solutions';
            }
        }

        $rawMetaDescription = trim((string) ($blog->meta_description ?: ''));
        $blogMetaDescription = $rawMetaDescription !== ''
            ? $rawMetaDescription
            : trim((string) ($blog->excerpt ?: Str::limit(strip_tags((string) $blog->content), 160)));

        $blogMetaKeywords = trim((string) ($blog->meta_keywords ?? ''));

        return response()
            ->view('frontend.blog.show', [
                'blog' => $blog,
                'pageMeta' => PageMeta::article(
                    $blogMetaDescription,
                    $blog->image_url,
                    $blogMetaTitle,
                    $blogMetaKeywords !== '' ? $blogMetaKeywords : null
                ),
                'recentBlogs' => $this->recentBlogs($blog, 5),
                'categories' => $this->categories(),
                'prevBlog' => $prevBlog,
                'nextBlog' => $nextBlog,
                'searchTerm' => '',
                'activeCategory' => '',
                'activeCategoryName' => '',
            ])
            ->header('Cache-Control', 'no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache');
    }

    private function categories()
    {
        try {
            $blogs = Blog::query()
                ->published()
                ->whereNotNull('category')
                ->where('category', '!=', '')
                ->get(['category']);

            $counts = [];
            foreach ($blogs as $blog) {
                $cats = $blog->categories_list;
                foreach ($cats as $cat) {
                    $counts[$cat] = ($counts[$cat] ?? 0) + 1;
                }
            }

            ksort($counts);

            return collect($counts)->map(function ($total, $name) {
                return (object) [
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'total' => $total,
                ];
            })->values();
        } catch (Throwable $exception) {
            report($exception);

            return collect();
        }
    }

    private function categoryMap($categories): array
    {
        $categoryMap = [];

        foreach ($categories as $category) {
            $categoryMap[$category->slug] = $category->name;
        }

        return $categoryMap;
    }

    private function blogs(string $searchTerm, string $activeCategoryName): LengthAwarePaginator
    {
        try {
            $blogsQuery = $this->publishedBlogsQuery();

            if ($searchTerm !== '') {
                $blogsQuery->where(function ($query) use ($searchTerm) {
                    $query->where('title', 'like', "%{$searchTerm}%")
                        ->orWhere('excerpt', 'like', "%{$searchTerm}%")
                        ->orWhere('content', 'like', "%{$searchTerm}%")
                        ->orWhere('category', 'like', "%{$searchTerm}%");
                });
            }

            if ($activeCategoryName !== '') {
                $blogsQuery->where(function ($q) use ($activeCategoryName) {
                    $q->where('category', $activeCategoryName)
                        ->orWhere('category', 'like', "%, {$activeCategoryName}%")
                        ->orWhere('category', 'like', "%{$activeCategoryName},%")
                        ->orWhere('category', 'like', "%\"{$activeCategoryName}\"%")
                        ->orWhere('category', 'like', "%{$activeCategoryName}%");
                });
            }

            return $blogsQuery
                ->paginate(self::BLOGS_PER_PAGE)
                ->withQueryString();
        } catch (Throwable $exception) {
            report($exception);

            return $this->emptyBlogsPaginator();
        }
    }

    private function recentBlogs(?Blog $blog = null, int $limit = 5)
    {
        try {
            $recentBlogsQuery = $this->publishedBlogsQuery();

            if ($blog) {
                $recentBlogsQuery->whereKeyNot($blog->getKey());
            }

            return $recentBlogsQuery
                ->limit($limit)
                ->get();
        } catch (Throwable $exception) {
            report($exception);

            return collect();
        }
    }

    private function recordBlogView(Blog $blog): void
    {
        try {
            $blog->increment('views');
            $blog->refresh();
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    private function publishedBlogsQuery(): Builder
    {
        return Blog::query()
            ->published()
            ->ordered();
    }

    private function emptyBlogsPaginator(): LengthAwarePaginator
    {
        return new LengthAwarePaginator(
            collect(),
            0,
            self::BLOGS_PER_PAGE,
            Paginator::resolveCurrentPage(),
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );
    }
}
