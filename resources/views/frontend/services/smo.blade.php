@extends('layouts.frontend')

@section('title', 'Best SMO Services Company in Chandigarh - Sortiq Solutions')
@section('body_attributes') data-route="/smo-services" @endsection

@push('head')
@include('components.service-page-styles')
@endpush

@section('content')
@php
    $processCards = [
        [
            'title' => 'Social Profile Setup',
            'image' => 'discovery-and-strategy.webp',
            'text' => 'We audit your existing social profiles and set up or optimize new ones—ensuring consistent branding, complete information, and a strong first impression.',
        ],
        [
            'title' => 'Content That Feels Natural',
            'image' => 'wireframing-and-design.webp',
            'text' => 'We develop content calendars and create posts that feel natural, on-brand, and engaging—designed to connect with your target audience authentically.',
        ],
        [
            'title' => 'Managing Conversations',
            'image' => 'development-and-coding.webp',
            'text' => 'We help you stay connected with your audience by responding to comments and messages. This builds trust and shows people there’s a real team behind the brand.',
        ],
        [
            'title' => 'Paid Ads (When Needed)',
            'image' => 'testing-and-assurance.webp',
            'text' => 'If advertising makes sense for your goals, we run focused ad campaigns to reach people who are more likely to be interested in your service and drive measurable results.',
        ],
        [
            'title' => 'Honest Insights',
            'image' => 'launch-and-deployment.webp',
            'text' => 'You get clear updates on what’s working and what needs improvement. No confusing numbers, just useful insights to help you make better decisions.',
        ],
        [
            'title' => 'Brand Consistency & Growth',
            'image' => 'maintenance-and-optimization.webp',
            'text' => 'We make sure your messaging, visuals, and tone stay consistent across all platforms. This helps strengthen your brand identity and supports steady, long-term growth.',
        ],
    ];
    $serviceTestimonials = collect($frontendReviewFeed ?? [])->take(3)->values();
@endphp

<main class="service-pg font-raleway">
  <section class="sp-hero">
    <div class="sp-hero-shell">
      <div class="sp-hero-copy">
        <h1>Social Media Optimization<br>Services</h1>
        <p>Transform your social media presence into a lead-generation engine. At Sortiq Solutions Pvt. Ltd., we blend data-driven strategies with creative storytelling to boost your visibility, engagement, and ROI across all major platforms. We keep things clear, focused, and aligned with your business goals. Our approach ensures consistent growth, measurable results, and long-term brand impact.</p>
        <a href="/contact">Get Started Today</a>
      </div>
      <div class="sp-hero-media">
        <img src="{{ asset('frontend-assets/media/services/covers/social-media-optimization-cover.webp') }}" alt="Social Media Optimization">
      </div>
    </div>
  </section>

  <section class="sp-process">
    <div class="sp-section-heading">
      <h2>Our Services</h2>
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
      <h2>Why Choose Us for SMO Services?</h2>
      <div class="sp-why-bar"></div>
      <p>At Sortiq Solutions, we help businesses strengthen their social media presence with expert Social Media Optimization (SMO) services. Our team crafts engaging content, optimizes profiles, and implements data-driven strategies to enhance brand visibility and audience engagement. We tailor our approach for platforms like Facebook, Instagram, Twitter, LinkedIn, and more, ensuring maximum reach and impact. With a focus on increasing followers, boosting interactions, and driving traffic, we help you build a strong and influential social media presence. Choose us for SMO services that grow your brand and connect you with your audience.</p>
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
      <h2>Ready to enhance your Online presence?</h2>
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
