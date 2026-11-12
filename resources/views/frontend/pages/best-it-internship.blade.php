             @extends('layouts.frontend')

@section('title', 'Best IT Internship Company in Mohali Chandigarh | Sortiq Solutions')
@section('body_attributes') data-route="/best-it-internship-company-mohali-chandigarh" @endsection

@push('head')
@include('components.service-page-styles')
<link rel="preload" as="image" href="{{ asset('frontend-assets/media/pages/internship/internship-hero.webp') }}" type="image/webp" fetchpriority="high">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css">
<style>
.service-pg .sp-hero-copy .sp-hero-bar {
  width: 44px;
  height: 3px;
  background: #ff5a0a;
  margin: 0 0 24px;
}
.service-pg .sp-hero-media picture,
.service-pg .sp-hero-media img {
  display: block;
  border-radius: 2px;
}
.service-pg .sp-why-band {
  background-attachment: scroll;
}
.sp-internship-section {
  background: #001a3d;
  padding: 80px 20px;
  position: relative;
  overflow: hidden;
}
.sp-internship-inner {
  max-width: 900px;
  margin: 0 auto;
}
.sp-internship-head {
  text-align: center;
  margin-bottom: 36px;
}
.sp-internship-head h2 {
  color: #ffffff;
  font-size: 32px;
  font-weight: 700;
  margin-bottom: 12px;
  font-family: 'Poppins', sans-serif;
  letter-spacing: -0.5px;
}
.sp-internship-head .sp-heading-bar {
  width: 44px;
  height: 3px;
  background: #ff5a0a;
  margin: 0 auto 16px;
}
.sp-internship-head p {
  color: #cbd5e1;
  font-size: 15px;
  max-width: 620px;
  margin: 0 auto;
  line-height: 1.6;
}
.sp-internship-section .internship-form-shell {
  max-width: 100%;
  margin: 0 auto;
}
@media (max-width: 767px) {
  .sp-internship-section {
    padding: 50px 16px;
  }
  .sp-internship-head h2 {
    font-size: 24px;
  }
  .internship-application-form .custom-field input,
  .internship-application-form .custom-field select,
  .internship-application-form .custom-field textarea,
  .internship-application-form .phone-wrapper .iti input[type="tel"] {
    font-size: 16px !important;
  }
}
</style>
@endpush

@section('content')
<main class="service-pg font-raleway">

  {{-- Hero Section --}}
  <section class="sp-hero">
    <div class="sp-hero-shell">
      <div class="sp-hero-copy">
        <h1>Best IT Internship Company<br>in Mohali Chandigarh</h1>
        <div class="sp-hero-bar"></div>
        <p>Join Sortiq Solutions Pvt. Ltd. for industry-oriented internship and industrial training programs in Mohali Chandigarh. Gain practical experience through live projects, professional mentorship, real-time learning and skill development in trending technologies.</p>
        <p>Whether you are a B.Tech, BCA, MCA, MBA, Polytechnic student or fresher, our internship programs are designed to help you become industry-ready with practical exposure and hands-on implementation.</p>
        <a href="#internship-form" class="sp-hero-btn">Apply For Internship</a>
      </div>
      <div class="sp-hero-media">
        <picture>
          <source srcset="{{ asset('frontend-assets/media/pages/internship/internship-hero.webp') }}" type="image/webp">
          <source srcset="{{ asset('frontend-assets/media/pages/internship/internship-hero.jpg') }}" type="image/jpeg">
          <img src="{{ asset('frontend-assets/media/pages/internship/internship-hero.jpg') }}" 
               alt="Best IT Internship Company in Mohali Chandigarh - Sortiq Solutions"
               loading="eager"
               fetchpriority="high"
               width="546"
               height="364"
               onerror="this.onerror=null;this.src='{{ asset('frontend-assets/media/pages/internship/internship-hero.webp') }}';">
        </picture>
      </div>
    </div>
  </section>

  {{-- Section 2: How We Deliver Success --}}
  <section class="sp-process">
    <div class="sp-section-heading">
      <h2>How We Deliver Success</h2>
      <div class="sp-heading-bar"></div>
    </div>
    <div class="sp-process-grid">
      @foreach ($processCards as $card)
        <article class="sp-process-card">
          <div class="sp-process-icon">
            <img src="{{ asset('frontend-assets/media/services/process/' . $card['image']) }}" 
                 alt="{{ $card['title'] }}"
                 loading="lazy"
                 width="50"
                 height="50">
          </div>
          <h3>{{ $card['title'] }}</h3>
          <p>{{ $card['text'] }}</p>
        </article>
      @endforeach
    </div>
  </section>

  {{-- Section 3: Why Choose Sortiq Solutions for Internship? --}}
  <section class="sp-why-band" style="background-image: url('{{ asset('frontend-assets/media/pages/internship/why-choose-us-network-bg.jpg') }}');">
    <div class="sp-why-overlay"></div>
    <div class="sp-why-content">
      <h2>Why Choose Sortiq Solutions for Internship?</h2>
      <div class="sp-why-bar"></div>
      <p>At Sortiq Solutions Pvt. Ltd., students get practical learning experience instead of only theoretical training. Our internship program focuses on skill development, project execution, teamwork and professional growth. The company provides exposure to modern IT technologies and real business workflows.</p>
    </div>
  </section>

  {{-- Section 4: What Our Clients Are Saying (Dynamic Reviews) --}}
  @php
    $testimonialsList = collect($reviews ?? [])->isNotEmpty()
        ? collect($reviews)
        : collect($frontendReviewFeed ?? []);
  @endphp

  <section class="sp-testimonials">
    <div class="sp-section-heading">
      <h2>What Our Clients Are Saying</h2>
      <div class="sp-heading-bar"></div>
    </div>

    @if ($testimonialsList->isNotEmpty())
      <div class="hm-ts-slider" style="background: transparent;">
        <div class="hm-ts-track" id="spTsTrack">
          @foreach ($testimonialsList as $testimonial)
            @php
              $quoteText = is_object($testimonial)
                  ? ($testimonial->content ?? $testimonial->post_content ?? '')
                  : ($testimonial['content'] ?? $testimonial['post_content'] ?? '');
              $rating = is_object($testimonial)
                  ? ($testimonial->rating ?? 5)
                  : ($testimonial['rating'] ?? 5);
            @endphp
            <div class="hm-ts-card">
              <div class="hm-ts-stars">
                @for($i = 0; $i < max(1, min(5, (int) $rating)); $i++)&#9733;@endfor
              </div>
              <p class="hm-ts-quote">
                &ldquo; {{ strip_tags($quoteText ?: 'Sortiq Solutions stands out with their creativity, dedication, and reliable support throughout our project.') }} &rdquo;
              </p>
            </div>
          @endforeach
        </div>
      </div>

      <div class="hm-ts-dots-container">
        <div class="hm-ts-dots" id="spTsDots">
          @foreach ($testimonialsList as $index => $testimonial)
            @php
              $clientName = is_object($testimonial)
                  ? ($testimonial->title ?? 'Happy Client')
                  : ($testimonial['title'] ?? 'Happy Client');
              $avatarNumber = (($index % 6) + 1);
            @endphp
            <button class="hm-ts-thumb {{ $index === 0 ? 'active' : '' }}" type="button" aria-label="Review by {{ $clientName }}">
              <img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2024/12/img' . $avatarNumber . '.jpg') }}" 
                   alt="{{ $clientName }}"
                   loading="lazy"
                   width="60"
                   height="60">
              <span>{{ $clientName }}</span>
            </button>
          @endforeach
        </div>
      </div>
    @endif
  </section>

  {{-- Section: Apply for Internship Application Form --}}
  <section id="internship-form" class="sp-internship-section">
    <div class="sp-internship-inner">
      <div class="sp-internship-head">
        <h2>Apply For Internship</h2>
        <div class="sp-heading-bar"></div>
        <p>Take the first step toward building a successful career in IT. Submit your application below to join our live project internship program in Mohali Chandigarh.</p>
      </div>

      <div class="internship-form-shell">
        <div class="internship-form-panel">
          <form class="internship-application-form" method="post" action="{{ route('api.internship-applications.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="type" value="internship">
            <input type="hidden" name="url" value="{{ url()->current() }}">

            <!-- Name -->
            <div class="custom-field">
              <span class="field-icon">
                <iconify-icon icon="lucide:user" width="18" height="18" aria-hidden="true"></iconify-icon>
              </span>
              <input name="name" type="text" placeholder="Enter Your Name" autocomplete="name" required>
            </div>

            <!-- Email -->
            <div class="custom-field">
              <span class="field-icon">
                <iconify-icon icon="lucide:mail" width="18" height="18" aria-hidden="true"></iconify-icon>
              </span>
              <input name="email" type="email" placeholder="Enter Your Email" autocomplete="email" required>
            </div>

            <!-- Phone -->
            <div class="phone-wrapper">
              <input id="internship-phone" name="phone" type="tel" inputmode="tel"
                placeholder="Enter Phone No." autocomplete="tel-national" required>
              <input type="hidden" name="country_code" value="+91">
            </div>

            <!-- Subject -->
            <div class="custom-field">
              <span class="field-icon">
                <iconify-icon icon="fa6-solid:list" width="16" height="16" aria-hidden="true"></iconify-icon>
              </span>
              <input name="subject" type="text" placeholder="Subject" required>
            </div>

            <!-- Institute -->
            <div class="custom-field">
              <span class="field-icon">
                <iconify-icon icon="lucide:building-2" width="18" height="18" aria-hidden="true"></iconify-icon>
              </span>
              <input name="institute" type="text" placeholder="Enter Your Institute" required>
            </div>

            <!-- Technology -->
            <div class="custom-field">
              <span class="field-icon">
                <iconify-icon icon="lucide:code-2" width="18" height="18" aria-hidden="true"></iconify-icon>
              </span>
              <select name="technology" required>
                <option value="">Select Technology</option>
                <option>Web Designing</option>
                <option>Web Development</option>
                <option>Digital Marketing</option>
                <option>React JS</option>
                <option>Python</option>
                <option>Java</option>
                <option>.NET</option>
                <option>HR & Finance</option>
                <option>Networking</option>
                <option>Graphic Designing</option>
                <option>Android Development</option>
                <option>React Native</option>
                <option>Kotlin</option>
                <option>Machine learning/AI</option>
                <option>Data Science</option>
                <option>Shopify Development</option>
                <option>Cloud Computing</option>
                <option>CodeIgniter</option>
                <option>Software Testing</option>
              </select>
              <iconify-icon icon="lucide:chevron-down" width="16" height="16" class="select-caret" aria-hidden="true"></iconify-icon>
            </div>

            <!-- Message -->
            <div class="custom-field textarea-field">
              <span class="field-icon">
                <iconify-icon icon="fa6-solid:comments" width="18" height="18" aria-hidden="true"></iconify-icon>
              </span>
              <textarea name="message" placeholder="Enter your message" rows="4" required></textarea>
            </div>

            <!-- Recaptcha -->
            <div class="recaptcha-wrap">
              @include('components.recaptcha')
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn">
              Apply Now
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  {{-- Section 5: Call to Action --}}
  <section class="sp-cta" style="background-image: url('{{ asset('frontend-assets/media/pages/it-company/cta-banner-bg.jpg') }}'); background-size: cover; background-position: center;">
    <div class="sp-cta-overlay" style="background: rgba(10, 20, 50, 0.45);"></div>
    <div class="sp-cta-content">
      <h2>Ready to kickstart your IT career?</h2>
      <p>Join Sortiq Solutions for practical internship training and live project experience in Mohali Chandigarh. Gain hands-on exposure, professional mentorship, and career readiness in trending technologies. Start your journey with us today!</p>
      <a href="#internship-form">APPLY FOR INTERNSHIP</a>
    </div>
  </section>

</main>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  // Smooth scroll to internship form for all hash anchors
  document.querySelectorAll('a[href^="#internship-form"], a[href$="#internship-form"]').forEach(function(anchor) {
    anchor.addEventListener('click', function(e) {
      var currentPath = window.location.pathname.replace(/\/$/, "");
      var targetPath = (anchor.getAttribute('href') || '').split('#')[0].replace(/\/$/, "");
      if (!targetPath || targetPath === currentPath) {
        var target = document.getElementById('internship-form');
        if (target) {
          e.preventDefault();
          var headerOffset = 90;
          var elementPosition = target.getBoundingClientRect().top;
          var offsetPosition = elementPosition + window.pageYOffset - headerOffset;
          window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
          });
        }
      }
    });
  });

  // Check URL hash on page load
  if (window.location.hash === '#internship-form') {
    setTimeout(function() {
      var target = document.getElementById('internship-form');
      if (target) {
        var headerOffset = 90;
        var elementPosition = target.getBoundingClientRect().top;
        var offsetPosition = elementPosition + window.pageYOffset - headerOffset;
        window.scrollTo({ top: offsetPosition, behavior: 'smooth' });
      }
    }, 300);
  }

  // Initialize intl-tel-input on phone field
  var phoneField = document.getElementById('internship-phone');
  var form = phoneField ? phoneField.closest('form') : null;
  var countryCodeField = form ? form.querySelector('input[name="country_code"]') : null;
  if (phoneField && form && countryCodeField && window.intlTelInput) {
    var phonePicker = window.intlTelInput(phoneField, {
      initialCountry: 'in',
      separateDialCode: true,
      nationalMode: true,
      autoPlaceholder: 'off',
      customPlaceholder: function() {
        return 'Enter Phone No.';
      },
      dropdownContainer: document.body,
      utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js',
    });

    phoneField.placeholder = 'Enter Phone No.';
    phoneField.setAttribute('placeholder', 'Enter Phone No.');

    var syncCountryCode = function() {
      phoneField.placeholder = 'Enter Phone No.';
      phoneField.setAttribute('placeholder', 'Enter Phone No.');
      var country = phonePicker.getSelectedCountryData();
      countryCodeField.value = country && country.dialCode ? '+' + country.dialCode : '';
    };

    phoneField.addEventListener('countrychange', syncCountryCode);
    form.addEventListener('submit', syncCountryCode);
    syncCountryCode();
  }

  var track = document.getElementById("spTsTrack");
  var cards = track ? track.querySelectorAll(".hm-ts-card") : [];
  var thumbsContainer = document.getElementById("spTsDots");
  var thumbs = thumbsContainer ? thumbsContainer.querySelectorAll(".hm-ts-thumb") : [];
  var slider = track ? track.closest(".hm-ts-slider") : null;
  if (!track || !cards.length || !thumbs.length || !slider) return;

  var firstClone = cards[0].cloneNode(true);
  var lastClone = cards[cards.length - 1].cloneNode(true);
  track.appendChild(firstClone);
  track.insertBefore(lastClone, track.firstChild);

  var allCards = Array.from(track.querySelectorAll(".hm-ts-card"));
  var totalReal = cards.length;
  var current = 1;
  var isTransitioning = false;

  function getStep() {
    var style = window.getComputedStyle(allCards[0]);
    var margin = parseFloat(style.marginLeft || 0) + parseFloat(style.marginRight || 0);
    return allCards[0].offsetWidth + margin;
  }

  function moveSlide(index, animate) {
    if (animate === undefined) animate = true;
    if (isTransitioning && animate) return;
    if (animate) isTransitioning = true;
    current = index;
    var step = getStep();
    var sliderWidth = slider.offsetWidth;
    var cardWidth = allCards[current].offsetWidth;
    var tx = (sliderWidth / 2) - (cardWidth / 2) - (current * step);
    track.style.transition = animate ? "transform .85s cubic-bezier(.16, 1, .3, 1)" : "none";
    track.style.transform = "translateX(" + tx + "px)";
    var realIdx = (current - 1 + totalReal) % totalReal;
    allCards.forEach(function(c, i) { c.classList.toggle("active", i === current); });
    thumbs.forEach(function(t, i) {
      var isC = i === realIdx, isP = i === (realIdx - 1 + totalReal) % totalReal, isN = i === (realIdx + 1) % totalReal;
      t.classList.toggle("active", isC);
      if (isC || isP || isN) {
        t.style.display = "flex";
        t.style.opacity = isC ? "1" : "0.4";
        t.style.filter = isC ? "blur(0)" : "blur(1px)";
        t.style.order = isP ? "1" : isC ? "2" : "3";
      } else { 
        t.style.display = "none"; 
      }
    });
    var dc = document.getElementById("spTsDots");
    if (dc) { 
      dc.style.justifyContent = "center"; 
      dc.style.transform = "none"; 
      dc.style.width = "auto"; 
      dc.style.margin = "auto"; 
    }
  }

  track.addEventListener("transitionend", function() {
    isTransitioning = false;
    if (current === 0) moveSlide(totalReal, false);
    else if (current === totalReal + 1) moveSlide(1, false);
  });

  thumbs.forEach(function(t, i) {
    t.addEventListener("click", function() {
      clearInterval(autoPlay);
      moveSlide(i + 1);
      autoPlay = setInterval(next, 4500);
    });
  });

  function next() { moveSlide(current + 1); }

  var autoPlay = setInterval(next, 4500);

  slider.addEventListener("mouseenter", function() { clearInterval(autoPlay); });
  slider.addEventListener("mouseleave", function() { autoPlay = setInterval(next, 4500); });

  window.addEventListener("resize", function() { moveSlide(current, false); });
  moveSlide(1, false);
});
</script>
@endpush

