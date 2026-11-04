@extends('layouts.frontend')

@section('title', 'Video Gallery | Explore IT Insights by Sortiq Solutions')
@section('body_attributes') data-route="/videos" @endsection

@push('head')
<style>
:root {
  --sq-video-blue: #001f54;
  --sq-video-orange: #ff5a00;
}

.video-gallery-page {
  width: 100%;
  overflow-x: hidden;
  background: #ffffff;
  font-family: "Nunito", Arial, sans-serif;
}

.video-gallery-banner {
  background-color: #000000;
  min-height: 193px;
  padding: 52px 15px 44px;
  text-align: center;
  color: #ffffff;
  background:
    linear-gradient(rgba(0,0,0,.36), rgba(0,0,0,.36)),
    url("{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/video-background-multicolor.jpg') }}") center/cover no-repeat;
}

.video-gallery-banner h1 {
  margin: 0 0 18px;
  font-size: 40px;
  line-height: 1.2;
  font-weight: 700;
  letter-spacing: .2px;
  color: #ffffff !important;
}

.video-gallery-banner p {
  margin: 0;
  font-size: 20px;
  line-height: 1.35;
  font-weight: 500;
  color: #ffffff;
}

.video-gallery-container {
  width: min(1110px, calc(100% - 30px));
  margin: 80px auto 82px;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 30px;
}

.video-gallery-box {
  aspect-ratio: 1 / 1;
  position: relative;
  overflow: hidden;
  background: #ffffff;
  box-shadow: 0 4px 14px rgba(0,0,0,0.12);
  border: 12px solid #ffffff;
  display: block;
}

.video-gallery-box iframe,
.video-gallery-box video {
  width: 100%;
  height: 100%;
  border: 0;
  display: block;
  object-fit: cover;
}

.video-gallery-pagination {
  margin: 0 0 72px;
  text-align: center;
}

.video-gallery-pagination span,
.video-gallery-pagination a {
  width: 43px;
  height: 43px;
  margin: 0 5px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  vertical-align: middle;
  color: #ffffff;
  font-size: 15px;
  font-weight: 100;
  border-radius: 50%;
  background: var(--sq-video-orange);
  text-decoration: none;
  transition: background .22s ease, transform .22s ease;
  line-height: 1;
}

.video-gallery-pagination a:hover {
  background: var(--sq-video-blue);
  transform: translateY(-2px);
  font-weight: 200;
}

.video-gallery-pagination .current {
  background: var(--sq-video-blue);
  font-weight: 200;
}

@media (max-width: 768px) {
  .video-gallery-container {
    width: min(420px, calc(100% - 30px));
    margin-top: 42px;
    margin-bottom: 44px;
    grid-template-columns: 1fr;
    gap: 24px;
  }

  .video-gallery-banner h1 {
    font-size: 32px;
  }

  .video-gallery-banner p {
    font-size: 17px;
  }
}
</style>
@endpush

@section('content')
<main class="video-gallery-page">
    <section class="video-gallery-banner">
      <h1>Our Video Gallery</h1>
      <p>Explore our latest video content</p>
    </section>

    <section class="video-gallery-container" aria-label="Video gallery">
      @forelse ($videos as $video)
        @php
          $url = $video->playback_url;
          $isFile = $video->playback_type === 'file';
          if (!$isFile) {
              if (str_contains($url, 'youtube.com/watch?v=')) {
                  $parts = explode('v=', $url);
                  if (count($parts) > 1) {
                      $videoId = explode('&', $parts[1])[0];
                      $url = 'https://www.youtube.com/embed/' . $videoId;
                  }
              } elseif (str_contains($url, 'youtu.be/')) {
                  $parts = explode('youtu.be/', $url);
                  if (count($parts) > 1) {
                      $videoId = explode('?', $parts[1])[0];
                      $url = 'https://www.youtube.com/embed/' . $videoId;
                  }
              }
          }
        @endphp
        <div class="video-gallery-box">
          @if ($isFile)
            <video src="{{ $url }}" title="{{ $video->title }}" controls preload="metadata"></video>
          @else
            <iframe
              src="{{ $url }}{{ str_contains($url, '?') ? '&' : '?' }}rel=0&modestbranding=1"
              title="{{ $video->title }}"
              loading="lazy"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              allowfullscreen
            ></iframe>
          @endif
        </div>
      @empty
        <p style="grid-column: 1/-1; text-align: center;">No videos found.</p>
      @endforelse
    </section>

    <div class="video-gallery-pagination">
        @if ($videos->lastPage() > 1)
            @if ($videos->currentPage() > 1)
                <a href="{{ $videos->previousPageUrl() }}" aria-label="Previous video page">←</a>
            @endif

            @for ($i = 1; $i <= $videos->lastPage(); $i++)
                @if ($i == $videos->currentPage())
                    <span class="current" aria-current="page">{{ $i }}</span>
                @else
                    <a href="{{ $videos->url($i) }}" aria-label="Video page {{ $i }}">
                        {{ $i }}
                    </a>
                @endif
            @endfor

            @if ($videos->hasMorePages())
                <a href="{{ $videos->nextPageUrl() }}" aria-label="Next video page">→</a>
            @endif
        @endif
    </div>
</main>
@endsection