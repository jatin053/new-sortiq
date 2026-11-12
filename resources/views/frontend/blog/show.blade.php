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
  <link rel="stylesheet" href="{{ asset('frontend-assets/css/blogs.css') }}?v={{ file_exists(public_path('frontend-assets/css/blogs.css')) ? filemtime(public_path('frontend-assets/css/blogs.css')) : time() }}">
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

        @php
          $singleCats = $blog->categories_list ?? [];
          if (empty($singleCats) && !empty($blog->category)) {
              $singleCats = is_array($blog->category) ? $blog->category : array_values(array_filter(array_map('trim', explode(',', (string) $blog->category))));
          }
        @endphp
        @if (!empty($singleCats))
          <div class="blog-single-meta mb-3 flex items-center flex-wrap gap-2" style="margin-top: 0; cursor: default;">
            <i class="fa-regular fa-folder-open text-blue-600" style="font-size: 16px;"></i>
            @foreach ($singleCats as $sc)
              <span class="text-blue-600 font-medium">{{ $sc }}</span>@if(!$loop->last) <span style="color: #94a3b8;">&bull;</span> @endif
            @endforeach
          </div>
        @elseif (!empty($blog['category']))
          <div class="blog-single-meta mb-3 flex items-center gap-2" style="margin-top: 0; cursor: default;">
            <i class="fa-regular fa-folder-open text-blue-600" style="font-size: 16px;"></i>
            <span class="text-blue-600 font-medium">{{ $blog['category'] }}</span>
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

        @php
          $blogHtml = (string) $blog->content;
          // Ensure any table is wrapped in responsive .blog-table-wrapper if not already wrapped
          if (str_contains($blogHtml, '<table')) {
              $blogHtml = preg_replace('/(?<!<div class="blog-table-wrapper">)\s*(<table\b[^>]*>.*?<\/table>)/is', '<div class="blog-table-wrapper">$1</div>', $blogHtml);
          }
        @endphp

        <div class="blog-single-content text-gray-700 leading-relaxed text-[15px] md:text-base space-y-6">
          {!! $blogHtml !!}
        </div>

        <script>
        (function initBlogContentTables() {
            function processTables() {
                var tables = document.querySelectorAll('.blog-single-content table');
                tables.forEach(function(tbl) {
                    if (!tbl.parentElement.classList.contains('blog-table-wrapper')) {
                        var wrap = document.createElement('div');
                        wrap.className = 'blog-table-wrapper';
                        tbl.parentNode.insertBefore(wrap, tbl);
                        wrap.appendChild(tbl);
                    }
                    tbl.removeAttribute('border');
                    tbl.removeAttribute('cellspacing');
                    tbl.removeAttribute('cellpadding');
                    tbl.removeAttribute('width');
                    tbl.style.border = '';
                    tbl.style.borderColor = '';
                    tbl.querySelectorAll('th, td').forEach(function(cell) {
                        cell.style.borderColor = '';
                        cell.style.borderWidth = '';
                    });
                });
            }
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', processTables);
            } else {
                processTables();
            }
        })();
        </script>

        @php
          $validFaqs = array_values(array_filter($blog->faqs_list ?? [], function ($item) {
              return is_array($item) && (!empty(trim((string) ($item['question'] ?? ''))) || !empty(trim((string) ($item['answer'] ?? ''))));
          }));
        @endphp

        @if (!empty($validFaqs))
          <!-- Blog FAQs Section -->
          <section class="blog-faq-section mt-12 pt-8 border-t border-gray-100" aria-labelledby="blog-faq-heading">
            <div class="blog-faq-head mb-6">
              <!-- <span class="inline-block text-[11px] font-extrabold tracking-wider uppercase text-[#ff6600] bg-orange-50 px-3 py-1 rounded-full mb-2">
                Got Questions?
              </span> -->
              <h2 id="blog-faq-heading" class="text-2xl md:text-3xl font-extrabold text-[#00173e] tracking-tight">
                Frequently Asked Questions
              </h2>
              <div class="w-12 h-1 bg-[#ff6600] rounded-full mt-3"></div>
            </div>

            <div class="blog-faq-accordion space-y-3.5">
              @foreach ($validFaqs as $fIndex => $faqItem)
                @php
                  $faqQ = trim((string) ($faqItem['question'] ?? ''));
                  $faqA = trim((string) ($faqItem['answer'] ?? ''));
                  $panelId = 'blog-faq-panel-' . $fIndex;
                  $buttonId = 'blog-faq-btn-' . $fIndex;
                @endphp
                @if ($faqQ !== '' && $faqA !== '')
                  <div class="blog-faq-card bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm transition-all duration-200 hover:shadow-md hover:border-orange-200">
                    <button
                      type="button"
                      id="{{ $buttonId }}"
                      data-blog-faq-target="{{ $panelId }}"
                      aria-expanded="false"
                      aria-controls="{{ $panelId }}"
                      class="blog-faq-trigger w-full flex items-center justify-between p-4 md:p-5 text-left transition-colors duration-200 outline-none cursor-pointer select-none"
                    >
                      <span class="blog-faq-q-text font-bold pr-4 leading-snug text-[15px] md:text-base text-[#00173e] transition-colors duration-200">
                        {{ $faqQ }}
                      </span>
                      <span class="blog-faq-icon-pill w-8 h-8 rounded-full flex items-center justify-center bg-gray-100 flex-shrink-0 transition-all duration-200 text-gray-500">
                        <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="blog-faq-chevron transition-transform duration-300"></iconify-icon>
                      </span>
                    </button>
                    <div
                      id="{{ $panelId }}"
                      role="region"
                      aria-labelledby="{{ $buttonId }}"
                      class="blog-faq-content px-4 md:px-5 pb-5 text-gray-600 text-sm md:text-[15px] leading-relaxed border-t border-gray-50"
                      style="display: none;"
                    >
                      <div class="pt-4 space-y-2 prose max-w-none text-gray-600">
                        {!! nl2br(e($faqA)) !!}
                      </div>
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
          </section>

          @php
            $schemaEntities = [];
            foreach ($validFaqs as $fItem) {
                if (!empty($fItem['question']) && !empty($fItem['answer'])) {
                    $schemaEntities[] = [
                        '@type' => 'Question',
                        'name' => $fItem['question'],
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => strip_tags((string) $fItem['answer']),
                        ],
                    ];
                }
            }
          @endphp
          @if (!empty($schemaEntities))
            <script type="application/ld+json">
            {!! json_encode([
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => $schemaEntities,
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
            </script>
          @endif

          <script>
          (function initBlogFaqAccordion() {
              function setupFaqToggle() {
                  var triggers = document.querySelectorAll('.blog-faq-trigger');
                  if (!triggers.length) return;

                  triggers.forEach(function(btn) {
                      // Avoid double binding
                      if (btn._faqBound) return;
                      btn._faqBound = true;

                      btn.addEventListener('click', function() {
                          var targetId = btn.getAttribute('data-blog-faq-target');
                          var panel = document.getElementById(targetId);
                          if (!panel) return;

                          var isExpanded = btn.getAttribute('aria-expanded') === 'true';

                          // Reset other items
                          triggers.forEach(function(otherBtn) {
                              if (otherBtn !== btn) {
                                  otherBtn.setAttribute('aria-expanded', 'false');
                                  var otherTargetId = otherBtn.getAttribute('data-blog-faq-target');
                                  var otherPanel = document.getElementById(otherTargetId);
                                  if (otherPanel) {
                                      otherPanel.style.display = 'none';
                                  }
                                  var otherTitle = otherBtn.querySelector('.blog-faq-q-text');
                                  if (otherTitle) otherTitle.style.color = '#00173e';
                                  var otherIconPill = otherBtn.querySelector('.blog-faq-icon-pill');
                                  if (otherIconPill) {
                                      otherIconPill.style.backgroundColor = '#f1f5f9';
                                      otherIconPill.style.color = '#64748b';
                                  }
                                  var otherChevron = otherBtn.querySelector('.blog-faq-chevron');
                                  if (otherChevron) otherChevron.style.transform = 'rotate(0deg)';
                                  var otherCard = otherBtn.closest('.blog-faq-card');
                                  if (otherCard) {
                                      otherCard.style.borderColor = '#e2e8f0';
                                      otherCard.style.boxShadow = '0 1px 3px rgba(0, 0, 0, 0.05)';
                                  }
                              }
                          });

                          // Toggle current item: if open -> close, if closed -> open
                          var title = btn.querySelector('.blog-faq-q-text');
                          var iconPill = btn.querySelector('.blog-faq-icon-pill');
                          var chevron = btn.querySelector('.blog-faq-chevron');
                          var card = btn.closest('.blog-faq-card');

                          if (isExpanded) {
                              // CLOSE
                              btn.setAttribute('aria-expanded', 'false');
                              panel.style.display = 'none';
                              if (title) title.style.color = '#00173e';
                              if (iconPill) {
                                  iconPill.style.backgroundColor = '#f1f5f9';
                                  iconPill.style.color = '#64748b';
                              }
                              if (chevron) chevron.style.transform = 'rotate(0deg)';
                              if (card) {
                                  card.style.borderColor = '#e2e8f0';
                                  card.style.boxShadow = '0 1px 3px rgba(0, 0, 0, 0.05)';
                              }
                          } else {
                              // OPEN
                              btn.setAttribute('aria-expanded', 'true');
                              panel.style.display = 'block';
                              if (title) title.style.color = '#ff6600';
                              if (iconPill) {
                                  iconPill.style.backgroundColor = '#ff6600';
                                  iconPill.style.color = '#ffffff';
                              }
                              if (chevron) chevron.style.transform = 'rotate(180deg)';
                              if (card) {
                                  card.style.borderColor = '#ff6600';
                                  card.style.boxShadow = '0 4px 14px rgba(255, 102, 0, 0.12)';
                              }
                          }
                      });
                  });
              }

              if (document.readyState === 'loading') {
                  document.addEventListener('DOMContentLoaded', setupFaqToggle);
              } else {
                  setupFaqToggle();
              }
          })();
          </script>
        @endif

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
                <div class="pl-[78px] -mt-1 flex">
              <a href="https://plus.google.com" target="_blank" rel="noopener noreferrer" class="blog-share-icon blog-share-icon--gplus font-extrabold text-sm tracking-tighter" aria-label="Share on Google Plus" style="text-decoration: none;">
                G+
              </a>
            </div>
              </div>
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
