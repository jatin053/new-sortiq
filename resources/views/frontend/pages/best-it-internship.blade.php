             @extends('layouts.frontend')

@section('title', 'Best IT Internship Company in Mohali Chandigarh | Sortiq Solutions')
@section('body_attributes') data-route="/best-it-internship-company-mohali-chandigarh" @endsection

@push('head')
@include('components.service-page-styles')
<link rel="preload" as="image" href="{{ asset('frontend-assets/media/pages/internship/internship-hero.webp') }}" type="image/webp" fetchpriority="high">
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
        <a href="{{ url('/contact') }}" class="sp-hero-btn">Get Started Today</a>
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

  {{-- Section 5: Call to Action --}}
  <section class="sp-cta" style="background-image: url('{{ asset('frontend-assets/media/pages/it-company/cta-banner-bg.jpg') }}'); background-size: cover; background-position: center;">
    <div class="sp-cta-overlay" style="background: rgba(10, 20, 50, 0.45);"></div>
    <div class="sp-cta-content">
      <h2>Ready to enhance your online presence?</h2>
      <p>Get in touch today to explore your web development goals and take your digital footprint to the next level. At Sortiq Solutions, we&rsquo;re dedicated to crafting innovative, user-friendly, and high-performance websites tailored to your unique business needs. Let&rsquo;s bring your vision to life and create an online experience that sets your business apart!</p>
      <a href="{{ url('/contact') }}">CONTACT US</a>
    </div>
  </section>

</main>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
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

