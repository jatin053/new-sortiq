@extends('layouts.frontend')

@section('title', $review['name'] . ' Review | Sortiq Solutions')
@section('body_attributes') data-route="/reviews" @endsection

@push('head')
<style>
    /* Hover Lift Transition for Single Review Article Card */
    .review-detail-card {
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
    }
    .review-detail-card:hover {
        transform: translateY(-6px) scale(1.008);
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.08);
    }

    /* Hover Lift Transition for More Reviews Listing Grid Links */
    .more-reviews-link {
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease, border-color 0.3s ease;
    }
    .more-reviews-link:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.08);
        border-color: #ff6600 !important;
    }
</style>
@endpush

@section('content')
<main class="font-raleway bg-gray-50 min-h-screen">
    <section class="bg-[#001a3d] text-white py-16 md:py-20">
        <div class="max-w-5xl mx-auto px-6">
            <a href="{{ route('frontend.reviews') }}" class="inline-flex items-center gap-2 text-orange-200 hover:text-white transition-colors">
                <span aria-hidden="true">←</span> Back to reviews
            </a>
            <h1 class="mt-6 text-4xl md:text-5xl font-black tracking-tight">{{ $review['name'] }}</h1>
            <div class="mt-4 flex flex-wrap gap-4 text-sm text-white/75">
                <span>{{ $review['platform'] }}</span>
                @if ($review->published_at)
                    <span>{{ $review->published_at->format('F d, Y') }}</span>
                @endif
                <span>{{ $review['views'] }} views</span>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-16">
        <div class="max-w-5xl mx-auto px-6">
            <article class="review-detail-card bg-white rounded-[2rem] border border-gray-200 shadow-sm p-8 md:p-10">
                <div class="flex flex-wrap items-start justify-between gap-6">
                    <div>
                        <p class="text-base font-black uppercase tracking-[0.2em] text-[#ff6600]">{{ $review['platform'] }}</p>
                        <h2 class="mt-3 text-3xl font-black text-[#00142e]">{{ $review['name'] }}</h2>
                        @if ($review['position'])
                            <p class="mt-2 text-gray-500">{{ $review['position'] }}</p>
                        @endif
                    </div>

                    <div class="text-yellow-400 text-sm tracking-[0.15em] mt-1" aria-label="{{ $review['rating'] }} out of 5 stars">
                        @for ($star = 0; $star < $review['rating']; $star++)
                            ★
                        @endfor
                    </div>
                </div>

                @if ($review['summary'])
                    <p class="mt-8 border-l-4 border-[#ff6600] pl-5 text-lg text-gray-600 leading-relaxed">
                        {{ $review['summary'] }}
                    </p>
                @endif

                <div class="mt-8 text-gray-700 leading-8 text-lg">
                    {!! nl2br(e($review['content'])) !!}
                </div>
            </article>

            @if ($recentReviews->count())
                <section class="mt-10">
                    <h2 class="text-2xl font-black text-[#00142e] mb-5">More reviews</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($recentReviews as $recentReview)
                            <a href="{{ route('frontend.reviews.show', $recentReview['slug']) }}" class="more-reviews-link block bg-white rounded-[1.5rem] border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
                                <div class="text-sm text-gray-500">{{ $recentReview['platform'] }}</div>
                                <div class="mt-2 text-lg font-extrabold text-[#00142e] hover:text-[#ff6600] transition-colors">
                                    {{ $recentReview['name'] }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </section>
</main>
@endsection
