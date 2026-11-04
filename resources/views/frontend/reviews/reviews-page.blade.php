@extends('layouts.frontend')

@section('title', 'Client Reviews &amp; Testimonials | Sortiq Solutions')
@section('body_attributes') data-route="/reviews" @endsection

@section('content')
<main class="reviews-page font-raleway">
    <section class="reviews-hero">
        <h1>Reviews</h1>
        <p>What Our Clients Say About Us</p>
        <div></div>
    </section>

    <section class="reviews-list-section">
        @if ($reviews->count())
            <div class="reviews-grid">
                @foreach ($reviews as $review)
                    @php
                        $summary = $review->summary ?: \Illuminate\Support\Str::limit(strip_tags($review->content), 210);
                        $platformLabel = strtolower($review->platform ?: 'upwork');
                        $rating = max(0, min(5, (int) $review->rating));
                    @endphp

                    <article class="review-card">
                        <div class="review-card-body">
                            <span class="review-quote review-quote-open" aria-hidden="true">&ldquo;</span>
                            <p class="{{ $loop->first ? 'is-italic' : '' }}">{{ $summary }}</p>
                            <span class="review-quote review-quote-close" aria-hidden="true">&rdquo;</span>
                        </div>

                        <div class="review-card-footer">
                            <h2>
                                {{ $review->name }}
                            </h2>

                            <div class="review-platform">
                                <span>{{ $platformLabel }}</span>
                                <div class="review-stars" aria-label="{{ $rating }} out of 5 stars">
                                    @for ($star = 1; $star <= 5; $star++)
                                        <span class="{{ $star <= $rating ? 'is-filled' : '' }}" aria-hidden="true">&#9733;</span>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            @if ($reviews->hasPages())
                <div class="blog-pagination-wrapper">
                    @if ($reviews->onFirstPage())
                        <span class="blog-page-item blog-page-arrow disabled">‹</span>
                    @else
                        <a href="{{ $reviews->previousPageUrl() }}" class="blog-page-item blog-page-arrow">‹</a>
                    @endif

                    @foreach ($reviews->getUrlRange(1, $reviews->lastPage()) as $page => $url)
                        @if ($page === $reviews->currentPage())
                            <span class="blog-page-item active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="blog-page-item">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($reviews->hasMorePages())
                        <a href="{{ $reviews->nextPageUrl() }}" class="blog-page-item blog-page-arrow">›</a>
                    @else
                        <span class="blog-page-item blog-page-arrow disabled">›</span>
                    @endif
                </div>
            @endif
        @else
            <div class="reviews-empty">No reviews have been published yet.</div>
        @endif
    </section>

    <style>
        .reviews-page {
            background: #fff;
            color: #001a3d;
            min-height: 100vh;
            overflow: hidden;
        }

        .reviews-page * {
            font-family: "Raleway", "Nunito", ui-sans-serif, system-ui, sans-serif !important;
        }

        .reviews-hero {
            min-height: 169px;
            padding: 13px 24px 0;
            background: #7f8080;
            color: #fff;
            text-align: center;
        }

        .reviews-hero h1 {
            margin: 50px 0 22px;
            color: #fff;
            font-size: 35px;
            font-weight: 700;
            line-height: 1.1;
            letter-spacing: 0;
        }

        .reviews-hero p {
            margin: 0;
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            line-height: 1.35;
        }

        .reviews-hero div {
            width: 120px;
            height: 4px;
            margin: 72px auto 0;
            background: #ff5a0a;
        }

        .reviews-list-section {
            width: min(1160px, calc(100% - 48px));
            margin: 0 auto;
            padding: 82px 0 70px;
        }

        .reviews-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 32px;
        }

        .review-card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-height: 421px;
            border-left: 4px solid #ff5a0a;
            border-radius: 9px 9px 0 0;
            background: #fff;
            box-shadow: 0 10px 36px rgba(15, 23, 42, 0.08);
            overflow: hidden;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .review-card:hover {
            transform: translateY(-8px) scale(1.015);
            box-shadow: 0 20px 48px rgba(15, 23, 42, 0.12);
        }

        .review-card-body {
            position: relative;
            flex: 1;
            min-height: 344px;
            padding: 79px 29px 56px;
        }

        .review-card-body p {
            margin: 0;
            color: #1f2937;
            font-size: 16px;
            font-weight: 500;
            line-height: 1.6;
        }

        .review-card-body p.is-italic {
            font-style: italic;
        }

        .review-quote {
            position: absolute;
            color: #ff5a0a;
            font-family: Georgia, "Times New Roman", serif !important;
            font-size: 32px;
            font-weight: 800;
            line-height: 1;
        }

        .review-quote-open {
            top: 30px;
            left: 29px;
        }

        .review-quote-close {
            right: 29px;
            bottom: 27px;
        }

        .review-card-footer {
            position: relative;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 18px;
            min-height: 76px;
            padding: 17px 31px 9px 29px;
            border-top: 1px solid #eeeeee;
        }

        .review-card-footer h2 {
            margin: 0 0 3px;
            min-width: 0;
            color: #001a3d;
            font-size: 16px;
            font-weight: 700;
            line-height: 1.2;
        }

        .review-platform {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            flex: 0 0 auto;
            line-height: 1;
        }

        .review-platform span {
            color: #14a83b;
            font-family: "Nunito", sans-serif !important;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.06em;
            text-decoration: none;
        }

        .review-stars {
            display: flex;
            gap: 2px;
            margin-top: 8px;
            color: #ffb400;
            font-size: 13px;
            letter-spacing: 1px;
        }

        .review-stars span {
            color: #d7dce2;
        }

        .review-stars span.is-filled {
            color: #ffb400;
        }

        /* Pagination style matched exactly to blogs.css */
        .blog-pagination-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 3rem;
            justify-content: center;
            align-items: center;
        }

        .blog-page-item {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Nunito', sans-serif !important;
            font-size: 0.875rem;
            font-weight: 700;
            border: 1px solid #e5e7eb;
            background-color: #ffffff;
            color: #6b7280;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .blog-page-item:not(.disabled):not(.active):hover {
            background-color: #ff6600;
            border-color: #ff6600;
            color: #ffffff;
        }

        .blog-page-item.active,
        .blog-page-item.active:hover {
            background-color: #00173e;
            border-color: #00173e;
            color: #ffffff;
        }

        .blog-page-item.disabled {
            opacity: 0.3;
            pointer-events: none;
        }

        .blog-page-arrow {
            font-weight: 300;
            font-size: 1.5rem;
            font-family: sans-serif !important;
            color: #ff6600;
        }

        .blog-page-arrow:not(.disabled):hover {
            background-color: #00173e;
            border-color: #ff6600;
            color: #ffffff;
        }

        .reviews-empty {
            max-width: 720px;
            margin: 0 auto;
            padding: 38px;
            border: 1px solid #edf1f7;
            border-radius: 12px;
            background: #fff;
            color: #64748b;
            text-align: center;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        }

        @media (max-width: 1199px) {
            .reviews-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 767px) {
            .reviews-hero h1 {
                font-size: 31px;
            }

            .reviews-hero p {
                font-size: 16px;
            }

            .reviews-list-section {
                width: min(100% - 28px, 1160px);
                padding: 50px 0 56px;
            }

            .reviews-grid {
                grid-template-columns: 1fr;
            }

            .review-card {
                min-height: 0;
            }

            .review-card-body {
                min-height: 260px;
                padding: 68px 24px 50px;
            }

            .review-card-footer {
                padding-inline: 24px;
            }
        }
    </style>
</main>
@endsection
