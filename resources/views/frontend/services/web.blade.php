@extends('layouts.frontend')

@section('title', 'Best Website Development IT company in chandigarh')
@section('body_attributes') data-route="/website-development-services" @endsection

@push('head')
@include('components.service-page-styles')
<style>
.service-web-page {
  background: #fff;
  color: #00142e;
  overflow: hidden;
}

.service-web-page .web-hero {
  background: #001a3d;
  padding: 60px 0;
}

.service-web-page .web-hero-shell {
  display: grid;
  grid-template-columns: minmax(0, 552px) minmax(0, 550px);
  align-items: center;
  justify-content: center;
  gap: 20px;
  width: min(1120px, calc(100% - 48px));
  margin: 0 auto;
}

.service-web-page .web-hero-copy {
  color: #fff;
}

.service-web-page .web-hero-copy h1 {
  margin: 0 0 26px;
  color: #fff;
  font-family: "Raleway", "Nunito", ui-sans-serif, system-ui, sans-serif;
  font-size: 40px;
  font-weight: 700;
  line-height: 1.36;
  letter-spacing: 0;
}

.service-web-page .web-hero-copy p {
  max-width: 580px;
  margin: 0 0 24px;
  color: #fff;
  font-size: 15.5px;
  font-weight: 400;
  line-height: 1.75;
  text-align: justify;
  letter-spacing: 0.1px;
  word-spacing: 0.2px;
  font-family: "Roboto", sans-serif;
}

.service-web-page .web-hero-copy a,
.service-web-page .web-cta-content a {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 169px;
  min-height: 39px;
  padding: 0 24px;
  background: #ff5a0a;
  color: #fff;
  border-radius: 2px;
  font-size: 15px;
  font-weight: 600;
  text-decoration: none;
  transition: background 0.2s ease;
}

.service-web-page .web-hero-copy a:hover,
.service-web-page .web-cta-content a:hover {
  background: #fff !important;
  color: #00173e !important;
}

.service-web-page .web-hero-media {
  border: 2px solid rgba(255, 255, 255, 0.78);
  box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.25);
}

.service-web-page .web-hero-media img {
  display: block;
  width: 546px;
  height: 364px;
  object-fit: cover;
}

.service-web-page .web-section-heading {
  text-align: center;
}

.service-web-page .web-section-heading h2 {
  margin: 0;
  color: #001a3d;
  font-family: "Raleway", "Nunito", ui-sans-serif, system-ui, sans-serif;
  font-size: 33px;
  font-weight: 700;
  line-height: 1.2;
}

.service-web-page .web-section-heading div {
  width: 40px;
  height: 3px;
  margin: 28px auto 0;
  background: #ff4f00;
}

.service-web-page .web-process {
  background: #fff;
  padding: 62px 0 46px;
}

.service-web-page .web-process-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 26px 19px;
  width: min(1099px, calc(100% - 48px));
  margin: 39px auto 0;
}

.service-web-page .web-process-card {
  min-height: 423px;
  padding: 55px 36px 32px;
  background: linear-gradient(145deg, #6657dc 0%, #884ee8 50%, #b238ef 100%);
  color: #fff;
  text-align: center;
  overflow: hidden;
}

.service-web-page .web-process-icon {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 80px;
  height: 80px;
  margin: 0 auto 17px;
  border-radius: 999px;
  background: #fff;
  isolation: isolate;
}

.service-web-page .web-process-icon::before,
.service-web-page .web-process-icon::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  border-radius: inherit;
  background: #fff;
  transform: scale(0.72);
  animation: service-icon-wave 2.8s ease-out infinite;
}

/* .service-web-page .web-process-icon::after {
  animation-delay: 1.4s;
} */

.service-web-page .web-process-icon img {
  display: block;
  width: 50px;
  height: 50px;
  object-fit: contain;
  filter: none;
  opacity: 1;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}


.service-web-page .web-process-card h3 {
  margin: 30px 0 18px;
  color: #fff;
  font-size: 19px !important;
  font-weight: 700 !important;
  font-family: "Nunito", sans-serif;
  line-height: 1.25;
}

.service-web-page .web-process-card p {
  margin: 0 auto;
  max-width: 275px;
  color: #fff;
  font-size: 16px;
  font-weight: 500;
    font-family: "Nunito", sans-serif;
  line-height: 1.74;
  text-align: center;
}

.service-web-page .web-why-band {
  position: relative;
  min-height: 389px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 54px 24px;
  background-image: url("{{ asset('frontend-assets/media/services/why-choose-sortiq-solutions.jpg') }}");
  background-position: center;
  background-size: cover;
  color: #fff;
  text-align: center;
}

.service-web-page .web-why-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.75);
}

.service-web-page .web-why-content {
  position: relative;
  z-index: 1;
  width: min(1035px, 100%);
  margin: 0 auto;
}

.service-web-page .web-why-content h2 {
  margin: 0;
  color: #fff;
  font-size: 32px;
  font-weight: 700;
  line-height: 1.25;
  font-family: 'Nunito', sans-serif;
  opacity: 0;
  transform: translateX(-70px);
  transition: opacity 0.75s ease 0.05s, transform 0.75s ease 0.05s;
}

.service-web-page .web-why-content.sp-animated h2 {
  opacity: 1;
  transform: translateX(0);
}

.service-web-page .web-why-content div {
  width: 40px;
  height: 3px;
  margin: 31px auto 28px;
  background: #fff;
  opacity: 0;
  transform: translateX(-50px);
  transition: opacity 0.65s ease 0.25s, transform 0.65s ease 0.25s;
}

.service-web-page .web-why-content.sp-animated div {
  opacity: 1;
  transform: translateX(0);
}

.service-web-page .web-why-content p {
  margin: 0 auto;
  color: #fff;
  font-size: 16px;
  font-weight: 500;
  line-height: 1.75;
  text-align: center;
  font-family: "Nunito", "Raleway", sans-serif;
  opacity: 0;
  transform: translateX(-55px);
  transition: opacity 0.75s ease 0.42s, transform 0.75s ease 0.42s;
}

.service-web-page .web-why-content.sp-animated p {
  opacity: 1;
  transform: translateX(0);
}

.service-web-page .web-testimonials {
  background: #fff;
  padding: 60px 24px 55px;
  text-align: center;
}

.service-web-page .web-testimonial-copy {
  max-width: 1130px;
  margin: 29px auto 20px;
  color: #222;
  font-size: 19px;
  font-weight: 400;
  line-height: 1.7;
  text-align: center;
  opacity: 1;
  transform: translateY(0);
  transition: opacity 0.3s ease, transform 0.3s ease;
}

.service-web-page .web-testimonial-divider {
  position: relative;
  width: 266px;
  height: 18px;
  margin: 0 auto 39px;
  border-top: 1px solid #c8c8c8;
}

.service-web-page .web-testimonial-divider::after {
  content: "";
  position: absolute;
  top: -1px;
  left: 50%;
  width: 18px;
  height: 18px;
  border-left: 1px solid #c8c8c8;
  border-bottom: 1px solid #c8c8c8;
  background: #fff;
  transform: translateX(-50%) rotate(-45deg);
}

.service-web-page .web-testimonial-people {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 84px;
}

.service-web-page .web-testimonial-person {
  display: inline-flex;
  align-items: center;
  gap: 18px;
  border: 0;
  padding: 0;
  background: transparent;
  color: rgba(255, 90, 10, 0.32);
  cursor: pointer;
  transition: color 0.3s ease, transform 0.3s ease;
}

.service-web-page .web-testimonial-person:hover {
  transform: translateY(-2px);
}

.service-web-page .web-testimonial-person img {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 55px;
  height: 55px;
  border-radius: 999px;
  object-fit: cover;
  transition: opacity 0.3s ease, filter 0.3s ease, transform 0.3s ease;
  opacity: 0.4;
  filter: grayscale(100%);
}

.service-web-page .web-testimonial-person.is-active img {
  opacity: 1;
  filter: grayscale(0%);
  transform: scale(1.03);
}

.service-web-page .web-testimonial-person strong {
  color: inherit;
  font-size: 21px;
  font-weight: 800;
  white-space: nowrap;
}

.service-web-page .web-testimonial-person.is-active {
  color: #ff4f00;
}

.service-web-page .web-cta {
  position: relative;
  min-height: 365px;
  padding: 63px 24px 62px;
  background-color: #303c8e;
  background-image: url("{{ asset('frontend-assets/media/services/backgrounds/contact-cta-background.webp') }}");
  background-position: center;
  background-size: cover;
  color: #fff;
  text-align: center;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
}

.service-web-page .web-cta-overlay {
  position: absolute;
  inset: 0;
  background: rgba(48, 60, 142, 0.94);
  opacity: 1;
}

.service-web-page .web-cta-content {
  position: relative;
  z-index: 1;
  width: min(1110px, 100%);
  max-width: 1110px;
  margin: 0 auto;
  padding: 0;
}

.service-web-page .web-cta-content h2 {
  margin: 0 0 34px;
  color: #fff;
  font-family: "Raleway", "Nunito", ui-sans-serif, system-ui, sans-serif;
  font-size: 33px;
  font-weight: 700;
  line-height: 1.25;
}

.service-web-page .web-cta-content p {
  max-width: 1110px;
  margin: 0 auto 28px;
  color: #fff;
  font-family: "Raleway", "Nunito", ui-sans-serif, system-ui, sans-serif;
  font-size: 16px;
  line-height: 1.75;
  text-align: center;
}

.service-web-page .web-cta-content a {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 203px;
  min-height: 56px;
  margin: 0;
  padding: 0 32px;
  border: 0;
  border-radius: 2px;
  background: #ff5a0a;
  color: #fff;
  font-size: 17px !important;
  font-weight: 600 !important;
  text-decoration: none;
  transition: background 0.2s ease;
}

.service-web-page .web-cta-content a:hover {
  background: #e94d00;
  color: #fff;
}

@keyframes slideInLeftWhy {
    0% {
      opacity: 0;
      transform: translateX(-100px);
    }
    100% {
      opacity: 1;
      transform: translateX(0);
    }
  }

@keyframes service-icon-wave {
  0% {
    opacity: 0.28;
    transform: scale(0.62);
  }

  70% {
    opacity: 0.08;
  }

  100% {
    opacity: 0;
    transform: scale(2.2);
  }
}

@media (max-width: 1023px) {
  .service-web-page .web-hero-shell,
  .service-web-page .web-process-grid {
    grid-template-columns: 1fr;
  }
  
  .service-web-page .web-hero-media img {
    width: 100%;
    height: auto;
    max-width: 100%;
    aspect-ratio: 546 / 364;
  }
  
  .service-web-page .web-testimonial-people {
    gap: 28px;
    flex-wrap: wrap;
  }
}

@media (max-width: 640px) {
  .service-web-page .web-hero {
    padding: 44px 0 !important;
  }
  
  .service-web-page .web-hero-shell {
    width: min(342px, calc(100% - 48px)) !important;
    max-width: min(342px, calc(100% - 48px)) !important;
    align-items: stretch !important;
    margin-right: auto !important;
    margin-left: auto !important;
    padding-right: 0 !important;
    padding-left: 0 !important;
  }
  
  .service-web-page .web-hero-copy h1,
  .service-web-page .web-section-heading h2,
  .service-web-page .web-why-content h2,
  .service-web-page .web-cta-content h2 {
    font-size: 28px;
  }
  
  .service-web-page .web-hero-copy,
  .service-web-page .web-hero-copy p {
    width: min(294px, calc(100vw - 48px)) !important;
    max-width: min(294px, calc(100vw - 48px)) !important;
    min-width: 0;
    align-self: stretch !important;
    justify-self: stretch !important;
    overflow-wrap: anywhere;
    text-align: left !important;
  }
  
  .service-web-page .web-process-card {
    min-height: auto;
    padding: 28px 24px;
  }
  
  .service-web-page .web-testimonial-person strong {
    font-size: 18px;
  }
}
</style>
@endpush

@section('content')
@php
    $processCards = [
        [
            'title' => 'Custom Web Development',
            'image' => 'discovery-and-strategy.webp',
            'text' => 'Our experts use cutting-edge technologies like node.js, Vue.js, Laravel, and PHP to create safe, responsive, and scalable solutions for both basic corporate websites and complex web applications.',
        ],
        [
            'title' => 'Content Management',
            'image' => 'wireframing-and-design.webp',
            'text' => 'From WordPress (custom themes, plugins, WooCommerce, migrations, performance tuning) to Shopify, Wix, or Squarespace, we create and optimize user-friendly, scalable websites.',
        ],
        [
            'title' => 'API Integration & Automation',
            'image' => 'development-and-coding.webp',
            'text' => 'Do you require marketing tools, payment gateways, analytics setup, or CRM integration? To optimize business efficiency and streamline processes, we integrate your website with third-party platforms.',
        ],
        [
            'title' => 'Performance Optimization',
            'image' => 'testing-and-assurance.webp',
            'text' => 'Your website will provide users with a dependable and seamless experience if it has quick loading times, optimized performance, clean code, and strong security measures.',
        ],
        [
            'title' => 'Digital Marketing Ready',
            'image' => 'launch-and-deployment.webp',
            'text' => 'From a clean URL structure to page speed and mobile compatibility, our websites are designed with SEO best practices in mind to make sure you start on the right foot.',
        ],
        [
            'title' => 'Ongoing Support',
            'image' => 'maintenance-and-optimization.webp',
            'text' => 'We provide continuous website support, regular updates, performance monitoring, and feature enhancements to ensure your website remains secure and up to date.',
        ],
    ];

    $serviceTestimonials = collect($frontendReviewFeed ?? [])->take(3)->values();
@endphp

<main class="service-web-page font-raleway">
  <section class="web-hero">
    <div class="web-hero-shell">
      <div class="web-hero-copy">
        <h1>Website Development<br>Company</h1>
        <p>Sortiq Solutions Pvt. Ltd. is a trusted website development company helping businesses build a strong online presence. We create websites that connect with your target audience and support real business growth. Our focus is on clear layouts, thoughtful design, and smooth functionality so visitors can easily understand what you offer. Every website we create is fast, easy to use, and built to grow with your business helping you attract the right customers.</p>
        <a href="/contact">Get Started Today</a>
      </div>
      <div class="web-hero-media">
        <img src="{{ asset('frontend-assets/media/services/covers/web-development-cover.webp') }}" alt="Web Development">
      </div>
    </div>
  </section>

  <section class="web-process">
    <div class="web-section-heading">
      <h2>Our Process</h2>
      <div></div>
    </div>

    <div class="web-process-grid">
      @foreach ($processCards as $card)
        <article class="web-process-card">
          <div class="web-process-icon">
            <img src="{{ asset('frontend-assets/media/services/process/' . $card['image']) }}" alt="{{ $card['title'] }}">
          </div>
          <h3>{{ $card['title'] }}</h3>
          <p>{{ $card['text'] }}</p>
        </article>
      @endforeach
    </div>
  </section>

  <section class="web-why-band">
    <div class="web-why-overlay"></div>
    <div class="web-why-content">
      <h2>Why Choose Us for Web Development Services?</h2>
      <div></div>
      <p>At Sortiq Solutions, we go beyond just building websites-we create digital experiences that drive success. Our expert team specializes in crafting custom, high-performance websites tailored to your business needs. We use the latest technologies to ensure your site is fast, secure, and scalable while prioritizing a seamless user experience. With a strong focus on SEO, mobile responsiveness, and intuitive design, we help your business stand out in a competitive online landscape. Plus, our reliable support and maintenance services ensure your website stays up-to-date and performs at its best. Partner with us and take your online presence to the next level!</p>
    </div>
  </section>

    <section class="hm-stats-section" style="background: #fff; padding: 60px 0;">
    <div class="web-section-heading" style="text-align: center; margin-bottom: 40px;">
      <h2>What Our Clients Are Saying</h2>
      <div style="width: 40px; height: 3px; margin: 28px auto 0; background: #ff4f00;"></div>
    </div>

    @if ($serviceTestimonials->isNotEmpty())
      <div class="hm-ts-slider" style="background: transparent;">
        <div class="hm-ts-track" id="webTsTrack">
          @foreach ($serviceTestimonials as $testimonial)
            <div class="hm-ts-card">
              <div class="hm-ts-stars">
                @for($i = 0; $i < ($testimonial['rating'] ?? 5); $i++)&#9733;@endfor
              </div>
              <p class="hm-ts-quote">
                &ldquo; {{ strip_tags($testimonial['content'] ?? $testimonial['post_content'] ?? 'Sortiq Solutions delivered exceptional service, seamless execution, and reliable support throughout our project.') }} &rdquo;
              </p>
            </div>
          @endforeach
        </div>
      </div>

      <div class="hm-ts-dots-container">
        <div class="hm-ts-dots" id="webTsDots">
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
        <div class="hm-ts-track" id="webTsTrack">
          <div class="hm-ts-card">
            <div class="hm-ts-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="hm-ts-quote">
              &ldquo; Sortiq Solutions brought thoughtful ideas, clear execution, and a polished result to our website project. &rdquo;
            </p>
          </div>
          <div class="hm-ts-card">
            <div class="hm-ts-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="hm-ts-quote">
              &ldquo; Separated by time zones, yet always in sync, Sortiq Solutions delivered exceptional service. Whether refining a solution or brainstorming new ideas, they handled every project with precision. Their expertise made them an invaluable partner to our business. &rdquo;
            </p>
          </div>
          <div class="hm-ts-card">
            <div class="hm-ts-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="hm-ts-quote">
              &ldquo; The team handled our requirements smoothly and gave us a dependable, user-friendly website experience. &rdquo;
            </p>
          </div>
        </div>
      </div>

      <div class="hm-ts-dots-container">
        <div class="hm-ts-dots" id="webTsDots">
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

  <section class="web-cta">
    <div class="web-cta-overlay"></div>
    <div class="web-cta-content">
      <h2>Ready to enhance your online presence?</h2>
      <p>Get in touch today to explore your web development goals and take your digital footprint to the next level. At Sortiq Solutions, we&rsquo;re dedicated to crafting innovative, user-friendly, and high-performance websites tailored to your unique business needs. Let&rsquo;s bring your vision to life and create an online experience that sets your business apart!</p>
      <a href="/contact">CONTACT US</a>
    </div>
  </section>
</main>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
  var track = document.getElementById("webTsTrack");
  var cards = track ? track.querySelectorAll(".hm-ts-card") : [];
  var thumbsContainer = document.getElementById("webTsDots");
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

  function moveSlide(index, animate = true) {
    if (isTransitioning && animate) return;
    if (animate) isTransitioning = true;

    current = index;
    var step = getStep();
    var sliderWidth = slider.offsetWidth;
    var cardWidth = allCards[current].offsetWidth;
    
    var mainTranslateX = (sliderWidth / 2) - (cardWidth / 2) - (current * step);
    
    track.style.transition = animate ? "transform .85s cubic-bezier(.16, 1, .3, 1)" : "none";
    track.style.transform = "translateX(" + mainTranslateX + "px)";

    var realIdx = (current - 1 + totalReal) % totalReal;
    
    allCards.forEach(function(card, idx) {
      card.classList.toggle("active", idx === current);
    });

    thumbs.forEach(function(thumb, idx) {
      var isCenter = (idx === realIdx);
      var isPrev = (idx === (realIdx - 1 + totalReal) % totalReal);
      var isNext = (idx === (realIdx + 1) % totalReal);
      
      thumb.classList.toggle("active", isCenter);
      
      if (isCenter || isPrev || isNext) {
        thumb.style.display = "flex";
        thumb.style.opacity = isCenter ? "1" : "0.4";
        thumb.style.filter = isCenter ? "blur(0)" : "blur(1px)";
        
        if (isPrev) thumb.style.order = "1";
        if (isCenter) thumb.style.order = "2";
        if (isNext) thumb.style.order = "3";
      } else {
        thumb.style.display = "none";
      }
    });

    var dotsContainer = document.getElementById("webTsDots");
    if (dotsContainer) {
      dotsContainer.style.justifyContent = "center";
      dotsContainer.style.transform = "none";
      dotsContainer.style.width = "auto";
      dotsContainer.style.margin = "auto";
    }
  }

  track.addEventListener("transitionend", function() {
    isTransitioning = false;
    if (current === 0) {
      moveSlide(totalReal, false);
    } else if (current === totalReal + 1) {
      moveSlide(1, false);
    }
  });

  thumbs.forEach(function(thumb, idx) {
    thumb.addEventListener("click", function() {
      clearInterval(autoPlay);
      moveSlide(idx + 1);
      autoPlay = setInterval(next, 4500);
    });
  });

  function next() { moveSlide(current + 1); }

  var autoPlay = setInterval(next, 4500);

  slider.addEventListener("mouseenter", function() { clearInterval(autoPlay); });
  slider.addEventListener("mouseleave", function() { autoPlay = setInterval(next, 4500); });

  window.addEventListener("resize", function() {
    moveSlide(current, false);
  });

  moveSlide(1, false);
});
</script>
@endpush
@endsection




