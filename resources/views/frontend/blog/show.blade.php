@extends('layouts.frontend')

@php
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
        : trim((string) ($blog->excerpt ?: \Illuminate\Support\Str::limit(strip_tags((string) $blog->content), 160)));
@endphp

@section('title', $blogMetaTitle)
@section('meta_description', $blogMetaDescription)
@section('canonical', url('/' . $blog->slug))
@if(!empty($blog->meta_keywords))
  @section('meta_keywords', $blog->meta_keywords)
@endif
@section('body_attributes') data-route="/blog" @endsection

@push('head')
  <link rel="stylesheet" href="{{ asset('frontend-assets/css/blogs.css') }}">
@endpush

@section('content')
<main class="blog-page-wrapper">
  <div class="blog-container">
    
    <!-- Left Column: Main Blog Content -->
    <div class="blog-main-content">

      <article class="blog-single-article">
        @if ($blog->image_url)
          <img src="{{ $blog->image_url }}" alt="{{ $blog['title'] }}" class="blog-single-image w-full mb-6">
        @endif

        @if (!empty($blog['category']))
          <div class="blog-single-meta mb-3 flex items-center gap-2" style="margin-top: 0;">
            <i class="fa-regular fa-folder-open text-blue-600" style="font-size: 16px;"></i>
            <span>{{ $blog['category'] }}</span>
          </div>
        @endif

        <h1 class="blog-single-title text-2xl md:text-4xl font-extrabold text-black mb-4">
          {{ $blog['title'] }}
        </h1>

        @php
          $visibleExcerpt = $blog['excerpt'] ?: $blog['meta_description'];
        @endphp
        @if ($visibleExcerpt)
          <p class="blog-single-excerpt text-gray-600 italic text-base leading-relaxed my-6">
            {{ $visibleExcerpt }}
          </p>
        @endif

        <div class="blog-single-content text-gray-700 leading-relaxed text-[15px] md:text-base space-y-6">
          {!! $blog->content !!}
        </div>

        <!-- Share Buttons Widget inside the main article container -->
        <div class="blog-share-section mt-12 pt-6 border-t border-gray-100">
          <div class="flex flex-col gap-2">
            <div class="flex items-center gap-6">
              <span class="blog-share-label font-extrabold text-[#00173e] text-lg">Share :</span>
              <div class="flex items-center gap-6">
                <a href="https://www.facebook.com/SortiqSolutions/" target="_blank" rel="noopener noreferrer" class="blog-share-icon blog-share-icon--facebook" aria-label="Share on Facebook">
                  <iconify-icon icon="fa6-brands:facebook-f" width="18" height="18"></iconify-icon>
                </a>
                <a href="https://x.com/SortiqSolutions" target="_blank" rel="noopener noreferrer" class="blog-share-icon blog-share-icon--twitter" aria-label="Share on Twitter">
                  <iconify-icon icon="fa6-brands:x-twitter" width="18" height="18"></iconify-icon>
                </a>
                <a href="https://www.linkedin.com/company/sortiq-solutions/" target="_blank" rel="noopener noreferrer" class="blog-share-icon blog-share-icon--linkedin" aria-label="Share on LinkedIn">
                  <iconify-icon icon="fa6-brands:linkedin-in" width="18" height="18"></iconify-icon>
                </a>
                <a href="https://in.pinterest.com/sortiqsolutions/" target="_blank" rel="noopener noreferrer" class="blog-share-icon blog-share-icon--pinterest" aria-label="Share on Pinterest">
                  <iconify-icon icon="fa6-brands:pinterest" width="22" height="22"></iconify-icon>
                </a>
              </div>
            </div>
            <div class="pl-[78px] -mt-1 flex">
              <a href="https://plus.google.com" target="_blank" rel="noopener noreferrer" class="blog-share-icon blog-share-icon--gplus font-extrabold text-sm tracking-tighter" aria-label="Share on Google Plus" style="text-decoration: none;">
                G+
              </a>
            </div>
          </div>
        </div>
      </article>

      <!-- Previous & Next Posts Navigation Widget -->
      @if ($prevBlog || $nextBlog)
        <div class="blog-navigation-container mt-12 bg-white border border-gray-200 rounded-xl p-6 md:p-8 flex flex-col md:flex-row gap-6 md:gap-0 relative">
          
          <!-- Left Column: Previous Post -->
          <div class="flex-1 md:pr-8 flex flex-col justify-between text-left {{ !$prevBlog ? 'invisible' : '' }}">
            @if ($prevBlog)
              <a href="{{ url('/' . $prevBlog['slug']) }}" class="group block" style="text-decoration: none;">
                <h4 class="blog-nav-title text-base md:text-lg font-extrabold text-[#00173e] mb-3 leading-snug group-hover:text-orange-500 transition-colors">
                  {{ $prevBlog['title'] }}
                </h4>
                <span class="blog-nav-arrow inline-flex items-center gap-2 text-sm font-bold text-blue-600 group-hover:text-orange-500 transition-colors">
                  ← Previous Post
                </span>
              </a>
            @endif
          </div>

          <!-- Vertical Divider -->
          @if ($prevBlog && $nextBlog)
            <div class="hidden md:block w-px bg-gray-200 self-stretch"></div>
          @endif

          <!-- Right Column: Next Post -->
          <div class="flex-1 md:pl-8 flex flex-col justify-between text-right {{ !$nextBlog ? 'invisible' : '' }}">
            @if ($nextBlog)
              <a href="{{ url('/' . $nextBlog['slug']) }}" class="group block" style="text-decoration: none;">
                <h4 class="blog-nav-title text-base md:text-lg font-extrabold text-[#00173e] mb-3 leading-snug text-center group-hover:text-orange-500 transition-colors">
                  {{ $nextBlog['title'] }}
                </h4>
                <span class="blog-nav-arrow inline-flex items-center justify-end gap-2 text-sm font-bold text-blue-600 group-hover:text-orange-500 transition-colors w-full">
                  Next Post →
                </span>
              </a>
            @endif
          </div>

        </div>
      @endif

    </div>

    <!-- Right Column: Sidebar (matching blog-list exactly) -->
    <div class="blog-sidebar">
      
      <!-- Search Bar Widget -->
      <form action="{{ route('frontend.blog.index') }}" method="get" class="blog-search-form">
        <input name="search" type="text" placeholder="Search Here..." class="blog-search-input">
        <button type="submit" class="blog-search-button">
          <iconify-icon icon="lucide:search" width="18" height="18"></iconify-icon>
        </button>
      </form>

      <!-- Recent Posts Widget -->
      <div class="blog-sidebar-widget">
        <h3 class="blog-sidebar-title">Recent Posts</h3>
        <ul class="blog-sidebar-list">
          @forelse ($recentBlogs as $recentBlog)
            <li class="blog-recent-post-item">
              <span class="blog-recent-post-dot">•</span>
              <a href="{{ url('/' . $recentBlog['slug']) }}" class="blog-recent-post-link">{{ $recentBlog['title'] }}</a>
            </li>
          @empty
            <li class="text-sm text-gray-500">No recent posts available.</li>
          @endforelse
        </ul>
      </div>

      <!-- Categories Widget -->
      <div class="blog-sidebar-widget">
        <h3 class="blog-sidebar-title">Categories</h3>
        <ul class="blog-sidebar-list">
          @forelse ($categories as $category)
            <li class="blog-category-item">
              <a href="{{ route('frontend.blog.index', ['category' => $category->slug]) }}" class="blog-category-link">
                <span class="blog-category-link-left">
                  <span class="blog-category-dot">•</span>
                  {{ $category->name }}
                </span>
                <span class="blog-category-count">({{ $category->total }})</span>
              </a>
            </li>
          @empty
            <li class="text-sm text-gray-500">No categories available.</li>
          @endforelse
        </ul>
      </div>

    </div>

  </div>
</main>
@endsection
