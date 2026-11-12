@extends('layouts.frontend')

@section('title', 'Blogs on IT Web Design &amp; Web Development | Sortiq Solutions')
@section('body_attributes') data-route="/blog" @endsection

@push('head')
  <link rel="stylesheet" href="{{ asset('frontend-assets/css/blogs.css') }}?v={{ file_exists(public_path('frontend-assets/css/blogs.css')) ? filemtime(public_path('frontend-assets/css/blogs.css')) : time() }}">
@endpush

@section('content')
<main class="blog-page-wrapper">
  <h1 class="sr-only" style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0;">
    @if ($searchTerm)
      Search Results for &ldquo;{{ $searchTerm }}&rdquo; | Sortiq Solutions Blog
    @elseif ($activeCategory)
      {{ $activeCategory }} Articles | Sortiq Solutions Blog
    @else
      Blogs on IT, Web Design &amp; Web Development | Sortiq Solutions
    @endif
  </h1>
  <div class="blog-container">
    <div class="blog-main-content">
      <div class="blog-grid">
        @forelse ($blogs as $blog)
          @php
            $excerpt = $blog['excerpt'] ?: ($blog['meta_description'] ?: \Illuminate\Support\Str::limit(strip_tags($blog['content']), 140));
            $category = $blog['category'] ?? '';
          @endphp
          <article class="blog-card">
            <a href="{{ url('/' . $blog['slug']) }}" class="blog-card-image-wrapper">
              @if ($blog->image_url)
                <img src="{{ $blog->image_url }}" alt="{{ $blog['title'] }}" loading="lazy" decoding="async" class="blog-card-image">
              @else
                <div class="blog-card-image flex items-center justify-center bg-gradient-to-br from-[#002d5b] to-[#004080]">
                  <span class="text-white text-sm font-semibold px-4 text-center opacity-70 line-clamp-3">{{ $blog['title'] }}</span>
                </div>
              @endif
            </a>

            <div class="blog-card-content">
              @php
                $cardCats = $blog->categories_list ?? [];
                if (empty($cardCats) && !empty($blog->category)) {
                    $cardCats = is_array($blog->category) ? $blog->category : array_values(array_filter(array_map('trim', explode(',', (string) $blog->category))));
                }
              @endphp
              @if (!empty($cardCats))
                <div class="blog-card-meta" style="display: flex; flex-wrap: wrap; gap: 4px; align-items: center;">
                  <i class="fa-regular fa-folder-open text-blue-600"></i>
                  @foreach ($cardCats as $cc)
                    <a href="{{ route('frontend.blog.index', ['category' => \Illuminate\Support\Str::slug($cc)]) }}" class="hover:underline hover:text-[#ff6600] transition-colors" style="color: inherit; text-decoration: none;">{{ $cc }}</a>@if(!$loop->last)<span>,</span>@endif
                  @endforeach
                </div>
              @elseif ($category)
                <div class="blog-card-meta">
                  <i class="fa-regular fa-folder-open text-blue-600"></i>
                  <a href="{{ route('frontend.blog.index', ['category' => \Illuminate\Support\Str::slug($category)]) }}" class="hover:underline hover:text-[#ff6600] transition-colors" style="color: inherit; text-decoration: none;">{{ $category }}</a>
                </div>
              @endif
              <h3 class="blog-card-title">
                <a href="{{ url('/' . $blog['slug']) }}">{{ $blog['title'] }}</a>
              </h3>
              <p class="blog-card-excerpt">{{ $excerpt }}</p>
            </div>
          </article>
        @empty
          <div class="col-span-full py-20 text-center text-gray-500 font-bold bg-white rounded-lg shadow-sm border border-gray-100">
            No blogs found.
          </div>
        @endforelse
      </div>

      @if ($blogs->hasPages())
        <div class="blog-pagination-wrapper">
          @if ($blogs->onFirstPage())
            <span class="blog-page-item blog-page-arrow disabled">‹</span>
          @else
            <a href="{{ $blogs->previousPageUrl() }}" class="blog-page-item blog-page-arrow">‹</a>
          @endif

          {{-- Custom Pagination: 1 2 3 ... Last --}}
          @php
              $lastPage = $blogs->lastPage();
              $currentPage = $blogs->currentPage();
          @endphp

          @if ($lastPage > 4)
              @for ($i = 1; $i <= 3; $i++)
                  @if ($i == $currentPage)
                      <span class="blog-page-item active">{{ $i }}</span>
                  @else
                      <a href="{{ $blogs->url($i) }}" class="blog-page-item">{{ $i }}</a>
                  @endif
              @endfor

              <span class="blog-page-item disabled">...</span>

              @if ($currentPage > 3 && $currentPage < $lastPage)
                  <span class="blog-page-item active">{{ $currentPage }}</span>
                  <span class="blog-page-item disabled">...</span>
              @endif

              @if ($currentPage == $lastPage)
                  <span class="blog-page-item active">{{ $lastPage }}</span>
              @else
                  <a href="{{ $blogs->url($lastPage) }}" class="blog-page-item">{{ $lastPage }}</a>
              @endif
          @else
              @for ($i = 1; $i <= $lastPage; $i++)
                  @if ($i == $currentPage)
                      <span class="blog-page-item active">{{ $i }}</span>
                  @else
                      <a href="{{ $blogs->url($i) }}" class="blog-page-item">{{ $i }}</a>
                  @endif
              @endfor
          @endif

          @if ($blogs->hasMorePages())
            <a href="{{ $blogs->nextPageUrl() }}" class="blog-page-item blog-page-arrow">›</a>
          @else
            <span class="blog-page-item blog-page-arrow disabled">›</span>
          @endif
        </div>
      @endif
    </div>

    <div class="blog-sidebar">
      <form action="{{ route('frontend.blog.index') }}" method="get" class="blog-search-form">
        @if ($activeCategory)
          <input type="hidden" name="category" value="{{ $activeCategory }}">
        @endif
        <input name="search" value="{{ $searchTerm }}" type="text" placeholder="Search Here..." class="blog-search-input">
        <button type="submit" class="blog-search-button">
          <iconify-icon icon="lucide:search" width="18" height="18"></iconify-icon>
        </button>
      </form>

      <div class="blog-sidebar-widget">
        <h3 class="blog-sidebar-title">Recent Posts</h3>
        <ul class="blog-sidebar-list">
          @forelse ($recentBlogs as $recentBlog)
            <li class="blog-recent-post-item">
              <span class="blog-recent-post-dot">•</span>
              <a href="{{ route('frontend.blog.show', $recentBlog['slug']) }}" class="blog-recent-post-link">{{ $recentBlog['title'] }}</a>
            </li>
          @empty
            <li class="text-sm text-gray-500">No recent posts available.</li>
          @endforelse
        </ul>
      </div>

      <div class="blog-sidebar-widget">
        <h3 class="blog-sidebar-title">Categories</h3>
        <ul class="blog-sidebar-list">
          @forelse ($categories as $category)
            @php
              $isCatActive = ($activeCategory === $category->slug || (!empty($activeCategoryName) && strcasecmp($activeCategoryName, $category->name) === 0));
            @endphp
            <li class="blog-category-item {{ $isCatActive ? 'active' : '' }}">
              <a href="{{ route('frontend.blog.index', array_filter(['category' => $category->slug, 'search' => $searchTerm])) }}"
                 class="blog-category-link {{ $isCatActive ? 'text-[#ff6600] font-bold' : '' }}"
                 style="{{ $isCatActive ? 'color: #ff6600 !important; font-weight: 700;' : '' }}">
                <span class="blog-category-link-left">
                  <span class="blog-category-dot" style="{{ $isCatActive ? 'color: #ff6600;' : '' }}">•</span>
                  {{ $category->name }}
                </span>
                <span class="blog-category-count" style="{{ $isCatActive ? 'color: #ff6600; font-weight: 700;' : '' }}">({{ $category->total }})</span>
              </a>
            </li>
          @empty
            <li class="text-sm text-gray-500">No categories available.</li>
          @endforelse

          @if ($activeCategory || $searchTerm)
            <li class="mt-4 pt-4 border-t border-dashed border-gray-200 text-xs text-[#ff6600] font-bold text-center uppercase tracking-widest">
              <a href="{{ route('frontend.blog.index') }}" class="hover:underline" style="color: inherit; text-decoration: none;">Clear All Filters</a>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </div>
</main>
@endsection
