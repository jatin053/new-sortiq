@extends('layouts.frontend')

@section('title', 'Software Testing  Company - Sortiq Solutions')
@section('body_attributes') data-route="/software-testing-company" @endsection

@push('head')
@include('components.service-page-styles')
@endpush

@section('content')
@php
    $processCards = [
        [
            'title' => 'Requirements Analysis',
            'image' => 'discovery-and-strategy.webp',
            'text' => 'We study your application requirements and business rules to design comprehensive test cases that cover all critical user flows.',
        ],
        [
            'title' => 'Test Planning & Strategy',
            'image' => 'wireframing-and-design.webp',
            'text' => 'We develop a detailed test plan covering scope, tools, timelines, and testing types suited to your project and release schedule.',
        ],
        [
            'title' => 'Manual & Automated Testing',
            'image' => 'development-and-coding.webp',
            'text' => 'We perform thorough manual testing and build automation test suites to efficiently cover regression, functional, and integration testing.',
        ],
        [
            'title' => 'Performance & Load Testing',
            'image' => 'testing-and-assurance.webp',
            'text' => 'We stress-test your application to ensure it performs reliably under high traffic and identifies bottlenecks before they impact users.',
        ],
        [
            'title' => 'Bug Reporting & Fix Verification',
            'image' => 'launch-and-deployment.webp',
            'text' => 'We provide detailed bug reports with clear reproduction steps and verify all fixes before sign-off for deployment.',
        ],
        [
            'title' => 'Ongoing QA Support',
            'image' => 'maintenance-and-optimization.webp',
            'text' => 'We provide ongoing QA support for new releases, helping your team ship updates confidently with a consistent quality standard.',
        ],
    ];
    $serviceTestimonials = collect($frontendReviewFeed ?? [])->take(3)->values();
@endphp

<main class="service-pg font-raleway">
  <section class="sp-hero">
    <div class="sp-hero-shell">
      <div class="sp-hero-copy">
        <h1>Software Testing Company</h1>
        <p>As a trusted software testing company, Sortiq Solutions Pvt. Ltd. provides complete software testing services to make sure your applications work as they should. We carefully check for errors, performance issues, and usability problems so your software runs smoothly and remains secure. By using both manual and automated testing methods, we help improve quality, reduce risks, and ensure your users enjoy a reliable and positive experience every time. The result is a stable, dependable product that you can confidently launch, maintain, and scale.</p>
        <a href="/contact">Get Started Today</a>
      </div>
      <div class="sp-hero-media">
        <img src="{{ asset('frontend-assets/media/services/covers/software-testing-cover.webp') }}" alt="Software Testing  Company - Sortiq Solutions">
      </div>
    </div>
  </section>

  <section class="sp-process">
    <div class="sp-section-heading">
      <h2>Our Process</h2>
      <div class="sp-heading-bar"></div>
    </div>
    <div class="sp-process-grid">
      @foreach ($processCards as $card)
        <article class="sp-process-card">
          <div class="sp-process-icon">
            <img src="{{ asset('frontend-assets/media/services/process/' . $card['image']) }}" alt="{{ $card['title'] }}">
          </div>
          <h3>{{ $card['title'] }}</h3>
          <p>{{ $card['text'] }}</p>
        </article>
      @endforeach
    </div>
  </section>

  <section class="sp-why-band">
    <div class="sp-why-overlay"></div>
    <div class="sp-why-content">
      <h2>Why Choose Us for Testing Services?</h2>
      <div class="sp-why-bar"></div>
      <p></p>
    </div>
  </section>

  <section class="sp-testimonials">
    <div class="sp-section-heading">
      <h2>What Our Clients Are Saying</h2>
      <div class="sp-heading-bar"></div>
    </div>

    @if ($serviceTestimonials->isNotEmpty())
      <div class="hm-ts-slider" style="background: transparent;">
        <div class="hm-ts-track" id="spTsTrack">
          @foreach ($serviceTestimonials as $testimonial)
            <div class="hm-ts-card">
              <div class="hm-ts-stars">
                @for($i = 0; $i < ($testimonial['rating'] ?? 5); $i++)&#9733;@endfor
              </div>
              <p class="hm-ts-quote">
                &ldquo; {{ strip_tags($testimonial['content'] ?? $testimonial['post_content'] ?? 'Sortiq Solutions delivered exceptional service and reliable support throughout our project.') }} &rdquo;
              </p>
            </div>
          @endforeach
        </div>
      </div>
      <div class="hm-ts-dots-container">
        <div class="hm-ts-dots" id="spTsDots">
          @foreach ($serviceTestimonials as $index => $testimonial)
            <button class="hm-ts-thumb {{ $index === 0 ? 'active' : '' }}">
              <img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2024/12/img' . (($index % 6) + 1) . '.jpg') }}" alt="{{ $testimonial['title'] ?? 'Client' }}">
              <span>{{ $testimonial['title'] ?? 'Happy Client' }}</span>
            </button>
          @endforeach
        </div>
      </div>
    @else
      <div class="hm-ts-slider" style="background: transparent;">
        <div class="hm-ts-track" id="spTsTrack">
          <div class="hm-ts-card">
            <div class="hm-ts-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="hm-ts-quote">&ldquo; Sortiq Solutions brought thoughtful ideas, clear execution, and a polished result to our project. &rdquo;</p>
          </div>
          <div class="hm-ts-card">
            <div class="hm-ts-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="hm-ts-quote">&ldquo; Separated by time zones, yet always in sync, Sortiq Solutions delivered exceptional service. Their expertise made them an invaluable partner to our business. &rdquo;</p>
          </div>
          <div class="hm-ts-card">
            <div class="hm-ts-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="hm-ts-quote">&ldquo; The team handled our requirements smoothly and gave us a dependable, user-friendly experience. &rdquo;</p>
          </div>
        </div>
      </div>
      <div class="hm-ts-dots-container">
        <div class="hm-ts-dots" id="spTsDots">
          <button class="hm-ts-thumb active">
            <img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2024/12/img1.jpg') }}" alt="David J.Martin">
            <span>David J.Martin</span>
          </button>
          <button class="hm-ts-thumb">
            <img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2024/12/img2.jpg') }}" alt="David G. Mullins">
            <span>David G. Mullins</span>
          </button>
          <button class="hm-ts-thumb">
            <img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2024/12/img3.jpg') }}" alt="Jordan D. Nelson">
            <span>Jordan D. Nelson</span>
          </button>
        </div>
      </div>
    @endif
  </section>

  <section class="sp-cta">
    <div class="sp-cta-overlay"></div>
    <div class="sp-cta-content">
      <h2>Ready to enhance your  online presence?</h2>
      <p>Get in touch today to explore your web development goals and take your digital footprint to the next level. At Sortiq Solutions, we’re dedicated to crafting innovative, user-friendly, and high-performance websites tailored to your unique business needs. Let’s bring your vision to life and create an online experience that sets your business apart!</p>
      <a href="/contact">CONTACT US</a>
    </div>
  </section>
</main>

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
      } else { t.style.display = "none"; }
    });
    var dc = document.getElementById("spTsDots");
    if (dc) { dc.style.justifyContent = "center"; dc.style.transform = "none"; dc.style.width = "auto"; dc.style.margin = "auto"; }
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
@endsection