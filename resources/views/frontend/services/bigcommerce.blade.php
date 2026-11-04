@extends('layouts.frontend')

@section('title', 'BigCommerce Development  Company - Sortiq Solutions')
@section('body_attributes') data-route="/bigcommerce-development-company" @endsection

@push('head')
@include('components.service-page-styles')
@endpush

@section('content')
@php
    $processCards = [
        [
            'title' => 'Discovery & Store Planning',
            'image' => 'discovery-and-strategy.webp',
            'text' => 'We study your business model, product catalog, and target market to plan the perfect BigCommerce store structure.',
        ],
        [
            'title' => 'Store Design & Theme Setup',
            'image' => 'wireframing-and-design.webp',
            'text' => 'We design or customize BigCommerce themes to give your store a professional, brand-consistent look that converts visitors.',
        ],
        [
            'title' => 'Development & Configuration',
            'image' => 'development-and-coding.webp',
            'text' => 'We configure your BigCommerce store, set up product catalogs, categories, shipping rules, taxes, and all critical store settings.',
        ],
        [
            'title' => 'Payment & App Integration',
            'image' => 'testing-and-assurance.webp',
            'text' => 'We integrate payment gateways, shipping providers, ERP systems, and marketing tools to streamline your store operations.',
        ],
        [
            'title' => 'Testing & Launch',
            'image' => 'launch-and-deployment.webp',
            'text' => 'We thoroughly test all store flows—checkout, payments, mobile—before launching so your customers get a flawless experience from day one.',
        ],
        [
            'title' => 'Ongoing Support & Growth',
            'image' => 'maintenance-and-optimization.webp',
            'text' => 'After launch, we provide continuous support, performance optimization, and feature development to help your store scale.',
        ],
    ];
    $serviceTestimonials = collect($frontendReviewFeed ?? [])->take(3)->values();
@endphp

<main class="service-pg font-raleway">
  <section class="sp-hero">
    <div class="sp-hero-shell">
      <div class="sp-hero-copy">
        <h1>BigCommerce Development <br>Company</h1>
        <p>Create a powerful BigCommerce online store designed for performance, usability, and growth. BigCommerce development company, Sortiq Solutions Pvt. Ltd. design, develop, and optimize secure, scalable BigCommerce solutions that help brands grow faster, sell smarter, and deliver exceptional shopping experiences. From setting up products and payments to improving speed and usability, we create shopping experiences that are simple, trustworthy, helping you sell confidently and scale with ease.</p>
        <a href="/contact">Get Started Today</a>
      </div>
      <div class="sp-hero-media">
        <img src="{{ asset('frontend-assets/media/services/covers/ecommerce-platform-cover.webp') }}" alt="BigCommerce Development  Company - Sortiq Solutions">
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
      <h2>Why Choose Us for BigCommerce Development Services?</h2>
      <div class="sp-why-bar"></div>
      <p>At Sortiq Solutions, we specialize in delivering exceptional BigCommerce development services that cater to your unique business needs. Our team of experienced developers leverages advanced tools and strategies to create scalable, secure, and high-performing online stores. With a focus on customization, seamless integration, and optimized user experience, we help you enhance customer engagement and boost conversions. Our agile approach, 24/7 support, and proven track record make us the ideal partner for your BigCommerce success.</p>
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