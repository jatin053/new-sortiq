
  <!doctype html>
@php
    $routeName = request()->route()?->getName();
    $requestPath = '/' . ltrim(request()->path(), '/');
    if (method_exists(\App\Support\Seo\PageMeta::class, 'isDraftRoute') && \App\Support\Seo\PageMeta::isDraftRoute($routeName, $requestPath)) {
        abort(404);
    }

    $contactApiUrl = route('api.contact-messages.store');
    $whatsappNumber = '919646522110';
    $recaptchaEnabled = \App\Support\Recaptcha::enabledForRequest(request());
    $usesDotLottie = request()->routeIs('frontend.home');
    $viteManifestPath = public_path('build/manifest.json');
    $viteManifestEntryFile = null;

    if (is_file($viteManifestPath)) {
        $viteManifest = json_decode(file_get_contents($viteManifestPath), true);
        $viteManifestEntryFile = data_get($viteManifest, 'resources/css/app.css.file');
    }

    $viteAssetsReady = is_string($viteManifestEntryFile)
        && $viteManifestEntryFile !== ''
        && is_file(public_path('build/' . ltrim($viteManifestEntryFile, '/')));
    $localTailwindCssExists = is_file(public_path('frontend-assets/css/tailwind-fallback.css'));
    $versionedAsset = static function (string $path): string {
        $absolutePath = public_path($path);

        if (! is_file($absolutePath)) {
            return asset($path);
        }

        return asset($path) . '?v=' . filemtime($absolutePath);
    };
    $isBlogShow = request()->routeIs('frontend.blog.show') || (isset($blog) && $blog instanceof \App\Models\Blog);
    $resolvedPageMeta = ($pageMeta ?? null) instanceof \App\Support\Seo\PageMeta
        ? $pageMeta
        : \App\Support\Seo\PageMeta::forRoute($routeName, $requestPath);
    $sectionTitle = trim($__env->yieldContent('title'));
    $routeTitle = trim((string) \App\Support\Seo\PageMeta::titleForRoute($routeName, $requestPath));
    $pageTitle = trim($resolvedPageMeta->title ?: $routeTitle ?: $sectionTitle ?: config('seo.default_title', 'Sortiq Solutions Pvt. Ltd.'));
    
    $adminDescription = trim($resolvedPageMeta->description ?? '');
    $sectionDescription = trim($__env->yieldContent('meta_description', ''));

    if ($isBlogShow) {
        $pageDescription = $sectionDescription !== '' ? $sectionDescription : ($adminDescription !== '' && $adminDescription !== config('seo.default_description') ? $adminDescription : config('seo.default_description'));
    } elseif ($adminDescription !== '' && $adminDescription !== config('seo.default_description')) {
        $pageDescription = $adminDescription;
    } elseif ($sectionDescription !== '') {
        $pageDescription = $sectionDescription;
    } elseif ($adminDescription !== '') {
        $pageDescription = $adminDescription;
    } else {
        $pageDescription = config('seo.default_description', 'Sortiq Solutions delivers high-performance web development, mobile applications, digital marketing, and IT consulting services.');
    }

    $adminKeywords = trim($resolvedPageMeta->keywords ?? '');
    $sectionKeywords = trim($__env->yieldContent('meta_keywords', ''));
    if ($isBlogShow) {
        $pageKeywords = $sectionKeywords !== '' ? $sectionKeywords : $adminKeywords;
    } else {
        $pageKeywords = $adminKeywords !== '' ? $adminKeywords : $sectionKeywords;
    }

    $pageImage = trim($__env->yieldContent('meta_image', $resolvedPageMeta->image));
    $pageType = trim($__env->yieldContent('meta_type', $resolvedPageMeta->type));
    $canonicalUrl = trim($__env->yieldContent('canonical', url()->current()));
    $customCode = \App\Models\SiteLayoutSetting::main()->data['custom_code'] ?? ['head' => '', 'body' => ''];
@endphp
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      @php
          $cleanTitle = trim($pageTitle);
      @endphp
      <title>{{ $cleanTitle }}</title>
      <meta name="description" content="{{ $pageDescription }}">
      @if ($pageKeywords)
        <meta name="keywords" content="{{ $pageKeywords }}">
      @endif
      <link rel="canonical" href="{{ $canonicalUrl }}">
      <meta property="og:type" content="{{ $pageType }}">
      <meta property="og:title" content="{{ $cleanTitle }}">
      <meta property="og:description" content="{{ $pageDescription }}">
      <meta property="og:url" content="{{ $canonicalUrl }}">
      <meta property="og:image" content="{{ $pageImage }}">
      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:title" content="{{ $cleanTitle }}">
      <meta name="twitter:description" content="{{ $pageDescription }}">
      <meta name="twitter:image" content="{{ $pageImage }}">

      <!-- Schema.org Structured Data -->
      {!! \App\Support\Seo\Schema::render($routeName, $requestPath) !!}
      @stack('schema')
      {!! $customCode['head'] ?? '' !!}
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css">
      @if ($viteAssetsReady)
        @vite('resources/css/app.css')
      @elseif ($localTailwindCssExists)
        <link rel="stylesheet" href="{{ $versionedAsset('frontend-assets/css/tailwind-fallback.css') }}">
      @else
        <script>
          window.tailwind = window.tailwind || {};
          window.tailwind.config = {
            theme: {
              extend: {
                fontFamily: {
                  sans: ['Nunito', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                  title: ['Poppins', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                  raleway: ['Nunito', 'ui-sans-serif', 'system-ui', 'sans-serif']
                }
              }
            }
          };
        </script>
        <script src="https://cdn.tailwindcss.com"></script>
      @endif
      @if ($recaptchaEnabled)
        <script>
          window.__sortiqRenderRecaptchas = () => {
            if (!window.grecaptcha?.render) return;

            document.querySelectorAll('.g-recaptcha').forEach((node) => {
              if (node.dataset.rendered === 'true') return;

              const siteKey = node.getAttribute('data-sitekey');
              if (!siteKey) return;

              window.grecaptcha.render(node, { sitekey: siteKey });
              node.dataset.rendered = 'true';
            });
          };
        </script>
        <script src="https://www.google.com/recaptcha/api.js?onload=__sortiqRenderRecaptchas&render=explicit" async defer></script>
      @endif
      <link rel="stylesheet" href="{{ $versionedAsset('frontend-assets/css/main.css') }}">
      <link rel="stylesheet" href="{{ $versionedAsset('frontend-assets/css/new-style.css') }}">
      @if (! $recaptchaEnabled)
        <style>
          .g-recaptcha {
            min-height: 78px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 14px 16px;
            border: 1px dashed #d1d5db;
            border-radius: 14px;
            background: #f9fafb;
            color: #6b7280;
            font-size: 13px;
            font-weight: 600;
            text-align: center;
          }
        </style>
      @endif
      <script>
        window.__sortiqRunWhenIdle = (callback) => {
          if ("requestIdleCallback" in window) {
            window.requestIdleCallback(callback, { timeout: 1800 });
            return;
          }

          window.setTimeout(callback, 600);
        };

        window.__sortiqInjectScript = (src, attributes = {}) => {
          if (!src || document.querySelector(`script[src="${src}"]`)) {
            return;
          }

          const script = document.createElement("script");
          script.src = src;

          Object.entries(attributes).forEach(([key, value]) => {
            if (value === true) {
              script.setAttribute(key, "");
              return;
            }

            script.setAttribute(key, String(value));
          });

          document.head.appendChild(script);
        };

        window.addEventListener("load", () => {
          window.__sortiqRunWhenIdle(() => {
            window.__sortiqInjectScript("https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js", {
              defer: true,
            });
          });

          @if ($usesDotLottie)
            window.__sortiqRunWhenIdle(() => {
              window.__sortiqInjectScript("https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs", {
                type: "module",
              });
            });
          @endif
        }, { once: true });
      </script>
      @include('components.frontend-data-scripts')
      {!! $customCode['head'] ?? '' !!}
      @stack('head')
    </head>
    <body
      data-contact-api-url="{{ $contactApiUrl }}"
      data-whatsapp-number="{{ $whatsappNumber }}"
      data-recaptcha-enabled="{{ $recaptchaEnabled ? 'true' : 'false' }}"
      @yield('body_attributes')
    >
      @include('layouts.partials.header')
  
      @yield('content')
      
  <div class="relative">
    <div id="chatbot-panel" class="chatbot-panel fixed bottom-24 right-4 md:right-8 z-[70] w-[calc(100%-2rem)] max-w-[350px] md:w-96 bg-white rounded-2xl shadow-2xl overflow-hidden origin-bottom-right border border-gray-100">
      <div class="bg-[#ff6600] p-4 flex justify-between items-center text-white">
        <div class="flex items-center gap-3">
          <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
          <span class="font-bold">Chat with us!</span>
        </div>
        <button type="button" id="chatbot-close" class="hover:rotate-90 transition-transform p-1" aria-label="Close chatbot">
          <iconify-icon icon="lucide:x" width="20" height="20"></iconify-icon>
        </button>
      </div>
      <div class="h-72 md:h-80 p-4 bg-gray-50 flex flex-col justify-end">
        <div class="bg-orange-100 text-[#000d23] p-3 rounded-t-lg rounded-br-lg text-sm max-w-[80%] self-start mb-4 shadow-sm">
          Hello! How can we help you today?
        </div>
      </div>
      <div class="p-4 border-t border-gray-100 bg-white flex gap-2">
        <input id="chatbot-input" type="text" placeholder="Type your message..." class="flex-1 text-sm text-[#000d23] outline-none p-2 bg-gray-100 rounded-lg focus:ring-1 focus:ring-[#ff6600] transition-all">
        <button type="button" id="chatbot-send" class="text-[#ff6600] p-2 hover:bg-orange-50 rounded-full transition-colors" aria-label="Send message">
          <iconify-icon icon="lucide:send" width="20" height="20"></iconify-icon>
        </button>
      </div>
    </div>

    <div id="chatbot-whatsapp" class="fixed bottom-24 right-8 z-[60]">
      <a href="https://wa.me/919646522110" target="_blank" rel="noopener noreferrer" class="group flex items-center gap-2 bg-[#25D366] text-white p-3 md:px-4 md:py-3 rounded-full shadow-lg hover:scale-110 transition-all border border-black/5">
        <iconify-icon icon="fa6-brands:whatsapp" width="24" height="24"></iconify-icon>
        <span class="font-bold text-sm hidden md:inline">Chat with us</span>
      </a>
    </div>

    <div class="fixed bottom-6 right-8 z-[60]">
      <button id="chatbot-toggle" type="button" aria-expanded="false" class="w-14 h-14 bg-[#ff6600] rounded-full flex items-center justify-center text-white shadow-[0_10px_25px_rgba(255,102,0,0.3)] hover:scale-110 transition-all duration-300 border border-black/5">
        <iconify-icon icon="lucide:message-circle" width="28" height="28"></iconify-icon>
      </button>
    </div>
  </div>

      
      @include('layouts.partials.footer')

      
  <div id="fresher-modal-shell" class="modal-shell fixed inset-0 z-[10000]" hidden>
    <div class="modal-overlay absolute inset-0 bg-black/85"></div>
    <div class="relative h-full flex items-center justify-center px-4 py-6">
      <div class="modal-panel fresher-connect-modal relative w-full overflow-hidden shadow-2xl">
        <div class="fresher-connect-image">
          <img src="{{ asset('frontend-assets/media/pages/shared/hiring-freshers-img.webp') }}" alt="Hiring" loading="lazy" decoding="async">
        </div>

        <div class="fresher-connect-form-panel">
          <button type="button" data-close-fresher class="fresher-connect-close" aria-label="Close hiring modal">
            <iconify-icon icon="lucide:x" width="28" height="28"></iconify-icon>
          </button>

          <h3 class="fresher-connect-title">Lets'Connect</h3>

          <form class="fresher-connect-form" enctype="multipart/form-data">
            <input type="hidden" name="country_code" value="+91">

            <div class="fresher-connect-grid">
              <label class="fresher-connect-field">
                <iconify-icon icon="fa6-solid:user" width="16" height="16"></iconify-icon>
                <input name="name" type="text" placeholder="Enter Your Name" autocomplete="name" required>
              </label>

              <label class="fresher-connect-field">
                <iconify-icon icon="fa6-solid:envelope" width="17" height="17"></iconify-icon>
                <input name="email" type="email" placeholder="Enter Your Email" autocomplete="email" required>
              </label>
            </div>

            <div class="fresher-connect-grid">
              <div class="fresher-connect-field fresher-connect-phone-field">
                <input id="fresher-phone" name="phone" type="tel" placeholder="Enter Your Phone Number" autocomplete="tel-national" required>
              </div>

              <label class="fresher-connect-field">
                <iconify-icon icon="fa6-solid:list" width="16" height="16"></iconify-icon>
                <input name="subject" type="text" placeholder="Subject" required>
              </label>
            </div>

            <label class="fresher-connect-file">
              <iconify-icon icon="fa6-solid:upload" width="17" height="17"></iconify-icon>
              <input id="fresher-file" name="resume" type="file">
            </label>

            <label class="fresher-connect-field fresher-connect-message-field">
              <iconify-icon icon="fa6-solid:comments" width="18" height="18"></iconify-icon>
              <textarea name="message" rows="4" placeholder="Enter your message" required></textarea>
            </label>

            <div class="fresher-connect-recaptcha">
              @include('components.recaptcha')
            </div>

            <button type="submit" class="fresher-connect-submit">
              Send Message
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js"></script>
      <script>
        document.addEventListener('DOMContentLoaded', function () {
          const phoneInput = document.getElementById('fresher-phone');
          const form = phoneInput?.closest('form');
          const countryCodeInput = form?.querySelector('input[name="country_code"]');

          if (!phoneInput || !countryCodeInput || typeof window.intlTelInput !== 'function') return;

          const phonePicker = window.intlTelInput(phoneInput, {
            initialCountry: 'in',
            separateDialCode: true,
            nationalMode: true,
            autoPlaceholder: 'aggressive',
            dropdownContainer: document.body,
          });

          const syncCountryCode = function () {
            const selectedCountry = phonePicker.getSelectedCountryData();
            countryCodeInput.value = selectedCountry?.dialCode
              ? '+' + selectedCountry.dialCode
              : '';
          };

          phoneInput.addEventListener('countrychange', syncCountryCode);
          form.addEventListener('submit', syncCountryCode);
          syncCountryCode();
        });
      </script>
      <script src="{{ $versionedAsset('frontend-assets/js/main.js') }}" defer></script>
      {!! $customCode['body'] ?? '' !!}
      @stack('scripts')
    </body>
  </html>

  
