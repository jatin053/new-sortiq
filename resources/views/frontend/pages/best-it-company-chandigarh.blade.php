@extends('layouts.frontend')

@section('title', 'Best IT Company in Chandigarh | Sortiq Solutions')
@section('body_attributes') data-route="/best-it-company-in-chandigarh" @endsection

@push('head')
@include('components.service-page-styles')
<style>
.service-pg .sp-hero-copy .sp-hero-bar {
  width: 44px;
  height: 3px;
  background: #ff5a0a;
  margin: 0 0 24px;
}
.service-pg .sp-hero-media img {
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
        <h1>Best IT Company in<br>Chandigarh</h1>
        <div class="sp-hero-bar"></div>
        <p>At Sortiq Solutions Pvt. Ltd., we offer end-to-end IT solutions that simplify and strengthen your business operations. We begin by understanding your goals, asking the right questions, and creating practical digital solutions that align with your needs&mdash;without unnecessary features or technical complexity. As a trusted IT company in Chandigarh, we deliver secure, scalable, and performance-focused services including web development, software solutions, and digital transformation. Partner with us to turn your ideas into reliable, future-ready digital solutions that drive real business growth.</p>
        <a href="{{ url('/contact') }}" class="sp-hero-btn">Get Started Today</a>
      </div>
      <div class="sp-hero-media">
        <img src="{{ asset('frontend-assets/media/pages/it-company/best-it-company-hero.jpg') }}" 
             alt="Best IT Company in Chandigarh - Sortiq Solutions"
             loading="eager"
             width="546"
             height="364">
      </div>
    </div>
  </section>

  {{-- Section 2: Our Process --}}
  <section class="sp-process">
    <div class="sp-section-heading">
      <h2>Our Process</h2>
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

  {{-- Section 3: Why Choose Sortiq Solutions for IT Services? --}}
  <section class="sp-why-band" style="background-image: url('{{ asset('frontend-assets/media/pages/it-company/why-choose-us-network-bg.jpg') }}');">
    <div class="sp-why-overlay"></div>
    <div class="sp-why-content">
      <h2>Why Choose Sortiq Solutions for IT Services?</h2>
      <div class="sp-why-bar"></div>
      <p>At Sortiq Solutions, we specialize in providing smart and reliable IT solutions that empower businesses in Chandigarh and beyond. Our expert team delivers secure, scalable, and high-performance web and software applications designed to meet your unique goals. We focus on practical solutions, seamless integrations, and user-friendly designs that make technology work effortlessly for you. Whether it's custom web development, enterprise software, or digital transformation projects, we provide innovative solutions with ongoing support to ensure your business stays ahead. Choose Sortiq Solutions as your trusted IT partner to drive growth, efficiency, and long-term success.</p>
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
                &ldquo; {{ strip_tags($quoteText ?: 'Behind the scenes of every successful project, Sortiq Solutions works tirelessly to bring visions to life. Their team is skilled, reliable, and always exceeds expectations.') }} &rdquo;
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

