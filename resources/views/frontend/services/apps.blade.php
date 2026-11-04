@extends('layouts.frontend')

@section('title', 'Best App Development Company in Chandigarh - Sortiq Solutions')
@section('body_attributes') data-route="/app-development-company" @endsection

@push('head')
@include('components.service-page-styles')
@endpush

@section('content')
@php
    $processCards = [
        [
            'title' => 'Discovery & Strategy',
            'image' => 'discovery-and-strategy.webp',
            'text' => 'We begin by understanding your app goals, target users, and business requirements to create a clear roadmap before any development begins.',
        ],
        [
            'title' => 'Wireframing & Design',
            'image' => 'wireframing-and-design.webp',
            'text' => 'Our UX/UI designers create intuitive wireframes and stunning interfaces that ensure seamless user journeys and an exceptional visual experience.',
        ],
        [
            'title' => 'Development & Coding',
            'image' => 'development-and-coding.webp',
            'text' => 'We use modern frameworks and best practices to build clean, scalable, and high-performance mobile and web applications.',
        ],
        [
            'title' => 'Testing & Quality Assurance',
            'image' => 'testing-and-assurance.webp',
            'text' => 'Rigorous testing across devices and platforms ensures your app is bug-free, responsive, and ready for real-world use before launch.',
        ],
        [
            'title' => 'Deployment & Launch',
            'image' => 'launch-and-deployment.webp',
            'text' => 'We handle App Store and Play Store submissions, server deployment, and a smooth go-live process so your app reaches users without a hitch.',
        ],
        [
            'title' => 'Maintenance & Optimization',
            'image' => 'maintenance-and-optimization.webp',
            'text' => 'Post-launch, we provide ongoing updates, performance monitoring, and feature enhancements to keep your app running smoothly and competitively.',
        ],
    ];
    $serviceTestimonials = collect($frontendReviewFeed ?? [])->take(3)->values();
@endphp

<main class="service-pg font-raleway">
  <section class="sp-hero">
    <div class="sp-hero-shell">
      <div class="sp-hero-copy">
        <h1>App Development<br>Company</h1>
        <p>At Sortiq Solutions, we provide cutting-edge app development services to help businesses innovate and grow in the digital era. From native mobile apps to cross-platform solutions, we build fast, secure, and scalable applications that deliver exceptional user experiences and drive real business results.</p>
        <a href="/contact">Get Started Today</a>
      </div>
      <div class="sp-hero-media">
        <img src="{{ asset('frontend-assets/media/services/covers/app-development-cover.webp') }}" alt="App Development">
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
      <h2>Why Choose Us for App Development Services?</h2>
      <div class="sp-why-bar"></div>
      <p>At Sortiq Solutions, we offer innovative and customized app development services that help businesses thrive in the digital age. Our expert team delivers high-quality native and cross-platform applications with a focus on performance, security, and user experience. We follow an agile development process, ensuring transparent communication and timely delivery throughout the project.</p>
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
          <div class="hm-ts-card"><div class="hm-ts-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div><p class="hm-ts-quote">&ldquo; Sortiq Solutions brought thoughtful ideas, clear execution, and a polished result to our project. &rdquo;</p></div>
          <div class="hm-ts-card"><div class="hm-ts-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div><p class="hm-ts-quote">&ldquo; Separated by time zones, yet always in sync, Sortiq Solutions delivered exceptional service. Their expertise made them an invaluable partner to our business. &rdquo;</p></div>
          <div class="hm-ts-card"><div class="hm-ts-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div><p class="hm-ts-quote">&ldquo; The team handled our requirements smoothly and gave us a dependable, user-friendly experience. &rdquo;</p></div>
        </div>
      </div>
      <div class="hm-ts-dots-container">
        <div class="hm-ts-dots" id="spTsDots">
          <button class="hm-ts-thumb active"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2024/12/img1.jpg') }}" alt="David J.Martin"><span>David J.Martin</span></button>
          <button class="hm-ts-thumb"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2024/12/img2.jpg') }}" alt="David G. Mullins"><span>David G. Mullins</span></button>
          <button class="hm-ts-thumb"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2024/12/img3.jpg') }}" alt="Jordan D. Nelson"><span>Jordan D. Nelson</span></button>
        </div>
      </div>
    @endif
  </section>

  <section class="sp-cta">
    <div class="sp-cta-overlay"></div>
    <div class="sp-cta-content">
      <h2>Ready to build your next app?</h2>
      <p>Get in touch today to discuss your app idea and bring it to life. At Sortiq Solutions, we develop powerful, user-friendly applications that help your business grow and your users stay engaged.</p>
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
  var totalReal = cards.length, current = 1, isTransitioning = false;
  function getStep() { var s=window.getComputedStyle(allCards[0]); return allCards[0].offsetWidth+parseFloat(s.marginLeft||0)+parseFloat(s.marginRight||0); }
  function moveSlide(idx, anim) {
    if(anim===undefined)anim=true;
    if(isTransitioning&&anim)return;
    if(anim)isTransitioning=true;
    current=idx; var step=getStep(), sw=slider.offsetWidth, cw=allCards[current].offsetWidth;
    track.style.transition=anim?"transform .85s cubic-bezier(.16,1,.3,1)":"none";
    track.style.transform="translateX("+(sw/2-cw/2-current*step)+"px)";
    var ri=(current-1+totalReal)%totalReal;
    allCards.forEach(function(c,i){c.classList.toggle("active",i===current);});
    thumbs.forEach(function(t,i){
      var iC=i===ri,iP=i===(ri-1+totalReal)%totalReal,iN=i===(ri+1)%totalReal;
      t.classList.toggle("active",iC);
      if(iC||iP||iN){t.style.display="flex";t.style.opacity=iC?"1":"0.4";t.style.filter=iC?"blur(0)":"blur(1px)";t.style.order=iP?"1":iC?"2":"3";}
      else{t.style.display="none";}
    });
    var dc=document.getElementById("spTsDots");
    if(dc){dc.style.justifyContent="center";dc.style.transform="none";dc.style.width="auto";dc.style.margin="auto";}
  }
  track.addEventListener("transitionend",function(){isTransitioning=false;if(current===0)moveSlide(totalReal,false);else if(current===totalReal+1)moveSlide(1,false);});
  thumbs.forEach(function(t,i){t.addEventListener("click",function(){moveSlide(i+1);});});
  window.addEventListener("resize",function(){moveSlide(current,false);});
  moveSlide(1,false);
});
</script>
@endpush
@endsection
