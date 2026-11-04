@extends('layouts.frontend')

@section('title', 'Our Clients | Sortiq Solutions pvt ltd')
@section('body_attributes') data-route="/clients" @endsection

@push('head')
<style>
    :root {
      --sq-blue: #00173e;
      --sq-orange: #ff5800;
      --sq-white: #ffffff;
      --sq-text: #192225;
      --sq-soft: #f7f9fc;
    }

    .sq-clients-page {
      width: 100%;
      min-height: 100vh;
      overflow-x: hidden;
      background: var(--sq-white);
    }

    .banner-section {
      padding: 70px 15px;
      position: relative;
      overflow: hidden;
      text-align: center;
      color: var(--sq-white);
      background: url("{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/multi-color-background.png') }}") no-repeat center center;
      background-size: cover;
    }

    .banner-section::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
    }

    .banner-section h1,
    .banner-section p {
      position: relative;
      z-index: 1;
    }

    .banner-section h1 {
      margin: 0 0 10px;
      color: var(--sq-white);
      font-size: 32px;
      line-height: 1.2;
      font-weight: 700;
      letter-spacing: 0;
    }

    .banner-section p {
      margin: 0;
      color: rgba(255, 255, 255, 0.9);
      font-size: 19px;
      line-height: 1.5;
      font-weight: 400;
    }

    .LogoMainDiv {
      width: min(1200px, calc(100% - 30px));
      min-height: 492px;
      margin: 4em auto;
      padding: 20px;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      justify-content: center;
      align-items: stretch;
      transition: opacity 0.22s ease, transform 0.22s ease;
    }

    .LogoMainDiv.is-changing {
      opacity: 0;
      transform: translateY(8px);
    }

    .ClientlogoDiv {
      min-height: 132px;
      margin-bottom: 30px;
      padding: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: var(--sq-white);
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .ClientlogoDiv:hover {
      transform: scale(1.05);
      box-shadow: 0 12px 28px rgba(0, 23, 62, 0.12);
    }

    .post-thumbnail {
      width: 100%;
      height: 100%;
      min-height: 110px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .post-thumbnail img {
      max-width: 100%;
      max-height: 96px;
      width: auto;
      height: auto;
      display: block;
      object-fit: contain;
      border-radius: 5px;
    }

    .paginationLogo {
      margin: 50px 0 100px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      text-align: center;
    }

    .paginationLogo button {
      min-width: 45px;
      height: 45px;
      padding: 10px 15px;
      color: var(--sq-white);
      font-size: 18px;
      font-weight: 700;
      line-height: 1;
      border: 0;
      border-radius: 50%;
      background: var(--sq-orange);
      cursor: pointer;
      transition: all 0.4s ease;
    }

    .paginationLogo button:hover {
      color: var(--sq-white);
      background: var(--sq-blue);
      transform: scale(1.2);
    }

    .paginationLogo button.current {
      background: var(--sq-blue);
      color: var(--sq-white);
      font-weight: 700;
      cursor: default;
    }

    .paginationLogo button.current:hover {
      transform: none;
    }

    .paginationLogo button.is-hidden {
      visibility: hidden;
      pointer-events: none;
    }

    @media screen and (max-width: 1024px) {
      .LogoMainDiv {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    @media screen and (max-width: 768px) {
      .banner-section {
        padding: 50px 15px;
      }

      .banner-section h1 {
        font-size: 24px;
      }

      .LogoMainDiv {
        grid-template-columns: repeat(2, 1fr);
        margin: 2em auto 0;
        padding-bottom: 0;
      }

      .paginationLogo {
        margin-top: 25px;
        margin-bottom: 50px;
      }
    }

    @media screen and (max-width: 480px) {
      .LogoMainDiv {
        grid-template-columns: 1fr;
      }
    }
</style>
@endpush

@section('content')
<main class="sq-clients-page">
    <div class="banner-section">
      <h1>Our Clients</h1>
      <p>We are proud to showcase the brands that trust us</p>
    </div>

    <div class="LogoMainDiv" id="clients-grid" aria-live="polite"></div>

    @php
        $chunks = $clientLogos->chunk(12);
        $totalPages = $chunks->count();
    @endphp

    @if ($totalPages > 1)
        <div class="paginationLogo" aria-label="Client logo pages">
            <button type="button" id="clients-prev" aria-label="Previous page">&lt;</button>
            @for ($i = 0; $i < $totalPages; $i++)
                <button type="button" data-clients-page="{{ $i }}" aria-label="Page {{ $i + 1 }}">{{ $i + 1 }}</button>
            @endfor
            <button type="button" id="clients-next" aria-label="Next page">&gt;</button>
        </div>
    @endif

    <script type="application/json" id="clients-pages-data">
        {
            "pages": {!! json_encode($chunks->map(function($chunk) {
                return $chunk->map(function($logo) {
                    return [
                        'url' => $logo->logo_url,
                        'alt' => !empty($logo->name) ? $logo->name : 'Sortiq Solutions Client Partner'
                    ];
                })->values();
            })->values()) !!}
        }
    </script>
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
      const grid = document.getElementById('clients-grid');
      const dataNode = document.getElementById('clients-pages-data');
      const prev = document.getElementById('clients-prev');
      const next = document.getElementById('clients-next');
      const pageButtons = Array.from(document.querySelectorAll('[data-clients-page]'));

      if (!grid || !dataNode) return;

      function escapeHtml(value) {
        return String(value || '').replace(/[&<>"']/g, function (character) {
          return {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
          }[character];
        });
      }

      let data;
      try {
        data = JSON.parse(dataNode.textContent || '{}');
      } catch (error) {
        return;
      }

      if (!Array.isArray(data.pages) || !data.pages.length) return;

      let currentPage = 0;

      function renderPage() {
        const logos = data.pages[currentPage] || [];
        grid.classList.add('is-changing');

        window.setTimeout(function () {
          grid.innerHTML = logos.map(function (logo) {
            return '<div class="ClientlogoDiv">' +
              '<div class="post-thumbnail">' +
                '<img loading="lazy" decoding="async" src="' + escapeHtml(logo.url) + '" alt="' + escapeHtml(logo.alt || 'Client Logo') + '">' +
              '</div>' +
            '</div>';
          }).join('');

          pageButtons.forEach(function (button) {
            const index = Number(button.getAttribute('data-clients-page') || '0');
            button.classList.toggle('current', index === currentPage);
            if (index === currentPage) {
              button.setAttribute('aria-current', 'page');
            } else {
              button.removeAttribute('aria-current');
            }
          });

          if (prev) {
            prev.classList.toggle('is-hidden', currentPage === 0);
          }
          if (next) {
            next.classList.toggle('is-hidden', currentPage === data.pages.length - 1);
          }

          grid.classList.remove('is-changing');
        }, 120);
      }

      pageButtons.forEach(function (button) {
        button.addEventListener('click', function () {
          currentPage = Number(button.getAttribute('data-clients-page') || '0');
          renderPage();
        });
      });

      if (prev) {
        prev.addEventListener('click', function () {
          if (currentPage <= 0) return;
          currentPage -= 1;
          renderPage();
        });
      }

      if (next) {
        next.addEventListener('click', function () {
          if (currentPage >= data.pages.length - 1) return;
          currentPage += 1;
          renderPage();
        });
      }

      renderPage();
    });
</script>
@endpush
