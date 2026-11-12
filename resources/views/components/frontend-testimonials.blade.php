@php
    $testimonials = collect($frontendReviewFeed ?? [])
        ->map(function (array $testimonial) {
            $name = trim((string) ($testimonial['title'] ?? 'Happy Client'));
            $parts = preg_split('/\s+/', $name) ?: [];
            $initials = count($parts) > 1
                ? strtoupper(($parts[0][0] ?? 'S') . ($parts[count($parts) - 1][0] ?? ''))
                : strtoupper($parts[0][0] ?? 'S');

            return [
                'name' => $name !== '' ? $name : 'Happy Client',
                'text' => trim(strip_tags((string) ($testimonial['content'] ?? $testimonial['post_content'] ?? ''))),
                'initials' => $initials,
                'platform' => trim((string) ($testimonial['platform'] ?? '')),
                'position' => trim((string) ($testimonial['position'] ?? '')),
                'rating' => max(0, min(5, (int) ($testimonial['rating'] ?? 0))),
            ];
        })
        ->filter(fn (array $testimonial) => $testimonial['text'] !== '')
        ->values();
@endphp

@if($testimonials->isNotEmpty())
<section class="hm-testimonials-section">
  <div class="hm-ts-inner">
    <div class="hm-section-head">
      <h2>What Our Clients Are Saying</h2>
      <div class="hm-line"></div>
    </div>

    <div class="hm-ts-slider">
      <div class="hm-ts-track" id="hmTsTrack">
        @foreach($testimonials as $testimonial)
          <div class="hm-ts-card">
            <div class="hm-ts-stars">
              @for($i = 0; $i < ($testimonial['rating'] ?: 5); $i++)&#9733;@endfor
            </div>
            <p class="hm-ts-quote">
              &ldquo; {{ $testimonial['text'] }} &rdquo;
            </p>
          </div>
        @endforeach
      </div>
    </div>

    <!-- USERS -->
    <div class="hm-ts-dots-container">
      <div class="hm-ts-dots" id="hmTsDots">
        @foreach($testimonials as $index => $testimonial)
          <button class="hm-ts-thumb {{ $index === 0 ? 'active' : '' }}">
            <img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2024/12/img' . (($index % 6) + 1) . '.jpg') }}" alt="{{ $testimonial['name'] }}">
            <span>{{ $testimonial['name'] }}</span>
          </button>
        @endforeach
      </div>
    </div>

    <!-- PAGINATION DOTS -->
    <div class="hm-ts-pagination-dots" role="tablist" aria-label="Testimonial pagination">
      @foreach($testimonials as $index => $testimonial)
        <button type="button" class="hm-ts-bullet {{ $index === 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
      @endforeach
    </div>
  </div>
</section>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
  var track = document.getElementById("hmTsTrack");
  var thumbs = document.querySelectorAll(".hm-ts-thumb");
  var cards = track ? Array.from(track.querySelectorAll(".hm-ts-card")) : [];
  var slider = document.querySelector(".hm-ts-slider");
  if (!track || !cards.length || !thumbs.length || !slider) return;

  // INFINITE LOOP SETUP: Clone elements for seamless transition
  var firstClone = cards[0].cloneNode(true);
  var lastClone = cards[cards.length - 1].cloneNode(true);
  track.appendChild(firstClone);
  track.insertBefore(lastClone, track.firstChild);

  // Update cards array to include clones
  var allCards = Array.from(track.querySelectorAll(".hm-ts-card"));
  var totalReal = cards.length;
  var current = 1; // Start at the first real card (after the lastClone)
  var isTransitioning = false;

  function getStep() {
    var style = window.getComputedStyle(allCards[0]);
    var margin = parseFloat(style.marginLeft || 0) + parseFloat(style.marginRight || 0);
    return allCards[0].offsetWidth + margin;
  }

  function updateSliderHeight(animate) {
    if (!slider) return;
    var activeCard = allCards[current];
    if (!activeCard) return;

    var cardHeight = activeCard.offsetHeight;
    if (!cardHeight) {
      var quote = activeCard.querySelector(".hm-ts-quote");
      if (quote) {
        var cs = window.getComputedStyle(activeCard);
        var padTop = parseFloat(cs.paddingTop || 0);
        var padBottom = parseFloat(cs.paddingBottom || 0);
        cardHeight = quote.offsetHeight + padTop + padBottom;
      }
    }

    if (cardHeight > 0) {
      slider.style.transition = animate ? "height 0.4s ease" : "none";
      slider.style.height = cardHeight + "px";
    }
  }

  function moveSlide(index, animate = true) {
    if (isTransitioning && animate) return;
    if (animate) isTransitioning = true;

    current = index;
    var step = getStep();
    var sliderWidth = slider.offsetWidth;
    var cardWidth = allCards[current].offsetWidth;
    
    // Centering the current card
    var mainTranslateX = (sliderWidth / 2) - (cardWidth / 2) - (current * step);
    
    track.style.transition = animate ? "transform .85s cubic-bezier(.16, 1, .3, 1)" : "none";
    track.style.transform = "translateX(" + mainTranslateX + "px)";

    // Auto-set slider height to active card/paragraph height
    updateSliderHeight(animate);

    // Update active states
    var realIdx = (current - 1 + totalReal) % totalReal;
    
    allCards.forEach(function(card, idx) {
      card.classList.toggle("active", idx === current);
    });

    thumbs.forEach(function(thumb, idx) {
      var isCenter = (idx === realIdx);
      var isPrev = (idx === (realIdx - 1 + totalReal) % totalReal);
      var isNext = (idx === (realIdx + 1) % totalReal);
      
      thumb.classList.toggle("active", isCenter);
      
      // Only show current, previous and next
      if (isCenter || isPrev || isNext) {
        thumb.style.display = "flex";
        thumb.style.opacity = isCenter ? "1" : "0.4";
        thumb.style.filter = isCenter ? "blur(0)" : "blur(1px)";
        
        // Order them: prev, center, next
        if (isPrev) thumb.style.order = "1";
        if (isCenter) thumb.style.order = "2";
        if (isNext) thumb.style.order = "3";
      } else {
        thumb.style.display = "none";
      }
    });

    // Centers the 3-item dots container
    var dotsContainer = document.getElementById("hmTsDots");
    if (dotsContainer) {
      dotsContainer.style.justifyContent = "center";
      dotsContainer.style.transform = "none";
      dotsContainer.style.width = "auto";
      dotsContainer.style.margin = "auto";
    }

    // Sync pagination bullets
    var bullets = document.querySelectorAll(".hm-ts-bullet");
    if (bullets.length) {
      bullets.forEach(function(b, idx) {
        b.classList.toggle("active", idx === realIdx);
      });
    }
  }

  // Handle seamless snap-back at the end of transition
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
      moveSlide(idx + 1);
    });
  });

  var bullets = document.querySelectorAll(".hm-ts-bullet");
  bullets.forEach(function(bullet, idx) {
    bullet.addEventListener("click", function() {
      moveSlide(idx + 1);
    });
  });

  window.addEventListener("resize", function() {
    moveSlide(current, false);
  });

  // Initial call
  moveSlide(1, false);
  setTimeout(function() { updateSliderHeight(false); }, 150);
  window.addEventListener("load", function() { updateSliderHeight(false); });

  // Auto-play
  setInterval(function() {
    if (!isTransitioning) moveSlide(current + 1);
  }, 6000);
});
</script>
@endpush
@endif
