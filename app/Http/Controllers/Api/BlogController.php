<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;

class BlogController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        try {
            $blogs = Blog::query()
                ->where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->get();
        } catch (Throwable $exception) {
            report($exception);

            $blogs = collect();
        }

        return BlogResource::collection($blogs);
    }

    public function show(Blog $blog): BlogResource
    {
        if ($blog->status !== 'published') {
            abort(404);
        }

        return new BlogResource($blog);
    }
}