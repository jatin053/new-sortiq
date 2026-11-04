<link rel="stylesheet" href="{{ asset('frontend-assets/css/service-pages.css') }}">
<script>
document.addEventListener('DOMContentLoaded', function () {
  /* ── Why-Choose-Us scroll animation ── */
  /* Works for both shared service pages (.sp-why-content) and web.blade.php (.web-why-content) */
  var whyEls = document.querySelectorAll('.service-pg .sp-why-content, .service-web-page .web-why-content');
  if (whyEls.length) {
    if ('IntersectionObserver' in window) {
      var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('sp-animated');
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.18 });
      whyEls.forEach(function(el) { observer.observe(el); });
    } else {
      whyEls.forEach(function(el) { el.classList.add('sp-animated'); });
    }
  }

  /* ── Testimonials auto-play (works for all service pages) ── */
  setTimeout(function () {
    var dotsEl = document.querySelector('.hm-ts-dots');
    var sliderEl = document.querySelector('.hm-ts-slider');
    if (!dotsEl || !sliderEl) return;

    var autoTimer = null;

    function playNext() {
      var thumbs = dotsEl.querySelectorAll('.hm-ts-thumb');
      if (!thumbs.length) return;
      var activeIdx = 0;
      thumbs.forEach(function (t, i) {
        if (t.classList.contains('active')) activeIdx = i;
      });
      var nextIdx = (activeIdx + 1) % thumbs.length;
      thumbs[nextIdx].dispatchEvent(new MouseEvent('click', { bubbles: true }));
    }

    function startAuto() {
      clearInterval(autoTimer);
      autoTimer = setInterval(playNext, 4000);
    }

    sliderEl.addEventListener('mouseenter', function () { clearInterval(autoTimer); });
    sliderEl.addEventListener('mouseleave', startAuto);

    startAuto();
  }, 350);
});
</script>