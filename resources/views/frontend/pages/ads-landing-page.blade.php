@extends('layouts.frontend')

@section('title', 'Inquiry | Sortiq Solutions Pvt Ltd')
@section('body_attributes') data-route="/ads-landing-page" @endsection

@push('head')
<meta name="robots" content="index, nofollow">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* Hide standard global header on Ads Landing Page */
.sq-pro-header {
  display: none !important;
}

/* Base Font & Container Fixes for Ads Landing Page */
.ads-landing-page {
  font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", "Liberation Sans", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  color: #212529;
  background: #fff;
  line-height: 1.5;
}

.ads-landing-page a {
  text-decoration: none;
}

/* ========== LOGO HEADER ========= */
.ads-landing-page .site-header {
  position: absolute;
  top: 25px;
  left: 30px;
  z-index: 2000;
}

.ads-landing-page .site-header img {
  height: 55px;
  width: auto;
  object-fit: contain;
}

/* ========== HERO SECTION ========= */
.ads-landing-page .hero-section {
  background: url("{{ asset('frontend-assets/media/pages/ads-landing/internship.avif') }}") center/cover no-repeat;
  padding: 130px 0 100px;
  position: relative;
  color: #fff;
  z-index: 1;
}

.ads-landing-page .hero-section::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.58);
  z-index: -1;
  pointer-events: none !important;
}

.ads-landing-page .hero-content {
  position: relative;
  z-index: 2;
  padding-right: 40px;
}

.ads-landing-page .hero-content h1 {
  font-size: 42px;
  font-weight: 800;
  margin-bottom: 18px;
  line-height: 1.25;
  color: #fff;
}

.ads-landing-page .hero-content p {
  font-size: 18px;
  margin-bottom: 30px;
  line-height: 1.6;
  color: #f0f0f0;
}

.ads-landing-page .hero-btn {
  background: #ff5800;
  border: none;
  border-radius: 40px;
  color: #fff !important;
  padding: 14px 38px;
  font-size: 18px;
  font-weight: 600;
  text-decoration: none;
  display: inline-block;
  transition: all 0.25s ease;
  box-shadow: 0 4px 15px rgba(255, 88, 0, 0.4);
}

.ads-landing-page .hero-btn:hover {
  background: #e04e00;
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(255, 88, 0, 0.5);
}

/* ========== FORM DESIGN ========== */
.ads-landing-page .form-box {
  background: #fff;
  padding: 30px 25px;
  border-radius: 14px;
  z-index: 2;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
  color: #00163e;
}

.ads-landing-page .form-box h3 {
  font-size: 21px;
  margin-bottom: 25px;
  color: #00163e;
  font-weight: 700;
  line-height: 1.35;
}

.ads-landing-page form input,
.ads-landing-page form textarea,
.ads-landing-page form select {
  width: 100%;
  padding: 13px 15px;
  border-radius: 10px;
  border: 1px solid #d8d8d8;
  font-size: 15px;
  background: #fafafa;
  color: #212529;
  transition: border-color 0.2s, background-color 0.2s;
  box-sizing: border-box;
}

.ads-landing-page form input:focus,
.ads-landing-page form textarea:focus,
.ads-landing-page form select:focus {
  outline: none;
  border-color: #ff5800;
  background: #fff;
}

.ads-landing-page form select {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right 1rem center;
  background-size: 16px 12px;
  appearance: none;
}

.ads-landing-page form textarea {
  height: 140px !important;
  resize: none;
}

.ads-landing-page .form-submit {
  background: #ff5800;
  color: #fff;
  border: none;
  width: 100%;
  padding: 15px;
  font-size: 17px;
  border-radius: 10px;
  font-weight: 600;
  cursor: pointer;
  margin-top: 5px;
  transition: all 0.25s ease;
}

.ads-landing-page .form-submit:hover {
  background: #e04e00;
  opacity: 0.95;
}

/* ========== SECTIONS ========== */
.ads-landing-page .section {
  padding: 70px 0;
}

.ads-landing-page .section-title {
  font-size: 32px;
  font-weight: 700;
  color: #00163e;
  text-align: center;
  margin-bottom: 25px;
}

.ads-landing-page .section-desc {
  font-size: 16px;
  color: #4a5568;
  text-align: center;
  max-width: 980px;
  margin: 0 auto 45px;
  line-height: 1.75;
}

.ads-landing-page .info-box {
  background: #fff;
  padding: 30px 24px;
  border-radius: 14px;
  text-align: center;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.ads-landing-page .info-box:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
}

.ads-landing-page .info-box i {
  font-size: 42px;
  color: #003972;
  margin-bottom: 15px;
  display: inline-block;
}

.ads-landing-page .info-box h5 {
  font-size: 20px;
  font-weight: 700;
  color: #00163e;
  margin-bottom: 12px;
}

.ads-landing-page .info-box p {
  font-size: 15px;
  color: #555;
  line-height: 1.6;
  margin-bottom: 0;
}

/* ========== CORE SERVICES AREA ========== */
.ads-landing-page .services-area {
  background: #00163e;
  padding: 75px 0;
  color: #fff;
}

.ads-landing-page .services-area h2 {
  font-size: 32px;
  font-weight: 700;
  color: #fff;
  margin-bottom: 20px;
}

.ads-landing-page .services-area p {
  font-size: 16px;
  color: #d0d8e8;
  max-width: 860px;
  margin: 0 auto 35px;
  line-height: 1.7;
}

.ads-landing-page .services-area ul {
  list-style: disc;
  padding-left: 24px;
  margin: 0;
}

.ads-landing-page .services-area li {
  font-size: 16px;
  margin-bottom: 10px;
  color: #fff;
  line-height: 1.4;
}

/* ========== CLIENT FEEDBACK ========== */
.ads-landing-page .feedback-box {
  background: #fff;
  padding: 28px 24px;
  border-radius: 14px;
  text-align: center;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
  transition: transform 0.3s ease;
  height: 100%;
}

.ads-landing-page .feedback-box:hover {
  transform: translateY(-5px);
}

.ads-landing-page .feedback-box img {
  width: 90px;
  height: 90px;
  border-radius: 50%;
  margin-bottom: 15px;
  object-fit: cover;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}

.ads-landing-page .feedback-box p {
  font-size: 14.5px;
  color: #444;
  line-height: 1.7;
  margin-bottom: 16px;
  font-style: normal;
}

.ads-landing-page .feedback-box strong {
  font-size: 16px;
  color: #00163e;
  display: block;
}

/* ========== RESPONSIVE ========== */
@media (max-width: 991px) {
  .ads-landing-page .hero-content {
    text-align: center;
    padding-right: 0;
    margin-bottom: 40px;
  }
  .ads-landing-page .hero-btn {
    margin: auto;
    display: inline-block;
  }
  .ads-landing-page .hero-content h1 {
    font-size: 32px;
  }
  .ads-landing-page .hero-section {
    padding: 100px 0 70px;
  }
  .ads-landing-page .site-header img {
    height: 45px;
  }
}

@media (max-width: 576px) {
  .ads-landing-page .hero-content h1 {
    font-size: 26px;
  }
  .ads-landing-page .hero-content p {
    font-size: 16px;
  }
  .ads-landing-page .form-box {
    padding: 22px 16px;
  }
  .ads-landing-page .section {
    padding: 50px 0;
  }
  .ads-landing-page .section-title {
    font-size: 26px;
  }
  .ads-landing-page .site-header {
    top: 15px;
    left: 15px;
  }
}
</style>
@endpush

@section('content')
<main class="ads-landing-page">

  {{-- Top Floating Logo Header --}}
  <div class="site-header">
    <a href="{{ url('/') }}" aria-label="Sortiq Solutions">
      <img src="{{ asset('frontend-assets/media/pages/ads-landing/ss-logo.png') }}" alt="Sortiq Solutions">
    </a>
  </div>

  {{-- Hero Section --}}
  <section class="hero-section">
    <div class="container">
      <div class="row align-items-center">

        {{-- Hero Left Content --}}
        <div class="col-lg-6 hero-content">
          <h1>Web Development, Design &amp; Digital Marketing Services</h1>
          <p>Scalable Digital Solutions for USA, Canada, UK, Australia &amp; Israel</p>
          <a href="tel:+919646522110" class="hero-btn">Call Now</a>
        </div>

        {{-- Hero Right Form --}}
        <div class="col-lg-5 offset-lg-1" id="form">
          <div class="form-box">
            <h3 class="text-center">For all your website needs, lines are open 24X7, Monday to Sunday</h3>

            <form id="adsInquiryForm" method="POST" action="{{ route('frontend.ads-landing-page.submit') }}">
              @csrf
              <input type="hidden" name="url" value="{{ url()->current() }}">
              <div class="row g-3">
                <div class="col-md-6">
                  <input type="text" name="full_name" placeholder="Full Name" autocomplete="name" required>
                </div>

                <div class="col-md-6">
                  <input type="email" name="email" placeholder="Email" autocomplete="email" required>
                </div>

                <div class="col-md-6">
                  <input type="tel" name="phone" placeholder="Enter Phone No." autocomplete="tel" required>
                </div>

                <div class="col-md-6">
                  <select name="technology" required>
                    <option value="" disabled selected>Select Technology / Domain</option>
                    <option value="Web Designing">Web Designing</option>
                    <option value="Web Development">Web Development</option>
                    <option value="Digital Marketing">Digital Marketing</option>
                    <option value="React JS">React JS</option>
                    <option value="Python">Python</option>
                    <option value="Graphics">Graphics</option>
                    <option value="Graphic Designing">Graphic Designing</option>
                    <option value="WordPress (PHP)">WordPress (PHP)</option>
                    <option value="PHP Full Stack">PHP Full Stack</option>
                    <option value="Laravel">Laravel</option>
                    <option value="Software Testing">Software Testing</option>
                    <option value="Shopify Dev">Shopify Dev</option>
                    <option value="CodeIgniter">CodeIgniter</option>
                    <option value="Testing">Testing</option>
                    <option value="MERN Full Stack">MERN Full Stack</option>
                    <option value="Node JS">Node JS</option>
                    <option value="DevOps">DevOps</option>
                  </select>
                </div>

                <div class="col-md-12">
                  <textarea name="message" placeholder="Message(mandatory)" required></textarea>
                </div>

                <div class="col-12 text-center">
                  <button type="submit" class="form-submit" id="submitBtn">Submit Inquiry</button>
                </div>

                <div class="col-12 text-center">
                  <div id="formMessage" style="margin-top: 15px; font-weight: 600;"></div>
                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- Section 2: Why Join / Grow Your Business --}}
  <section class="section">
    <div class="container">
      <h2 class="section-title">Grow Your Business with High-Performance Digital Solutions</h2>
      <p class="section-desc">
        We help businesses across the USA, Canada, UK, Australia, and Israel build strong, results-driven digital experiences. From custom web development and modern website design to data-driven SEO, PPC, and social media marketing, our solutions are designed to attract the right audience, boost conversions, and deliver measurable business growth.
        <br><br>
        Whether you’re a startup or an established enterprise, we develop digital solutions that align with your market, customers, and long-term objectives
      </p>

      <div class="row g-4 text-center">
        <div class="col-md-4">
          <div class="info-box">
            <i class="bi bi-cpu"></i>
            <h5>Tech Expertises</h5>
            <p>We leverage the latest technologies to build scalable, high-performance solutions that meet your goals..</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="info-box">
            <i class="bi bi-briefcase"></i>
            <h5>Custom Solutions</h5>
            <p>Our team creates tailored strategies to fit your unique business needs, ensuring optimal results.</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="info-box">
            <i class="bi bi-award"></i>
            <h5>Quality &amp; Timeliness</h5>
            <p>We focus on delivering top-quality solutions on time, ensuring your projects run smoothly and efficiently.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Section 3: Core Services Areas --}}
  <section class="services-area">
    <div class="container text-center">
      <h2>Our Core Services</h2>
      <p>
        In order to provide greater engagement and measurable results, our solutions are tailored for the USA, Canada, UK, Australia, and Israel, taking into account user behavior, performance expectations, and market standards.
      </p>

      <div class="row mt-4 g-4 text-start mx-auto" style="max-width: 900px;">
        <div class="col-md-4">
          <ul>
            <li>Web Designing</li>
            <li>Web Development</li>
            <li>Digital Marketing</li>
            <li>React JS</li>
            <li>Python</li>
            <li>Graphics</li>
            <li>Graphic Designing</li>
            <li>WordPress (PHP)</li>
            <li>Mobile Development</li>
          </ul>
        </div>

        <div class="col-md-4">
          <ul>
            <li>Java</li>
            <li>.NET</li>
            <li>HR &amp; Finance</li>
            <li>Networking</li>
            <li>Android Dev</li>
            <li>React Native</li>
            <li>PHP Full Stack</li>
            <li>Laravel</li>
            <li>Software Testing</li>
            <li>Flutter</li>
          </ul>
        </div>

        <div class="col-md-4">
          <ul>
            <li>AI / ML</li>
            <li>Machine Learning</li>
            <li>Data Science</li>
            <li>Shopify Dev</li>
            <li>Cloud</li>
            <li>CodeIgniter</li>
            <li>Testing</li>
            <li>MERN Full Stack</li>
            <li>Node JS</li>
            <li>DevOps</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  {{-- Section 4: Clients Feedback --}}
  <section class="section" style="background: #f7f7f7;">
    <div class="container">
      <h2 class="section-title">Clients Feedback</h2>

      <div class="row g-4 text-center justify-content-center">
        @foreach ($feedbackCards as $card)
          <div class="col-md-4">
            <div class="feedback-box">
              <img src="{{ asset($card['image']) }}" alt="{{ $card['name'] }}" loading="lazy" width="90" height="90">
              <p>&ldquo; {{ $card['quote'] }} &rdquo;</p>
              <strong>- {{ $card['name'] }}</strong>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

</main>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById("adsInquiryForm");
  const msgBox = document.getElementById("formMessage");
  const submitBtn = document.getElementById("submitBtn");

  if (!form) return;

  form.addEventListener("submit", function(e) {
    e.preventDefault();
    msgBox.innerHTML = "";

    const phoneInput = form.querySelector('input[name="phone"]');
    if (phoneInput && phoneInput.value.trim()) {
      const digits = phoneInput.value.replace(/\D+/g, "");
      if (digits.length !== 10 || !/^[6-9]\d{9}$/.test(digits)) {
        msgBox.innerHTML = "<span style='color: red;'>Please enter a valid 10-digit Indian phone number starting with 6, 7, 8, or 9.</span>";
        phoneInput.focus();
        return;
      }
    }

    submitBtn.disabled = true;
    submitBtn.textContent = "Submitting...";

    const formData = new FormData(form);
    formData.set("url", window.location.href);

    fetch(form.action, {
      method: "POST",
      body: formData,
      headers: {
        "X-Requested-With": "XMLHttpRequest",
        "Accept": "text/html, application/json, text/plain"
      }
    })
    .then(async response => {
      const text = await response.text();
      if (response.ok) {
        msgBox.innerHTML = "<span style='color: green;'>✔ " + text + "</span>";
        form.reset();
      } else {
        msgBox.innerHTML = "<span style='color: red;'>Failed to submit inquiry: " + (text || "Please check the required fields.") + "</span>";
      }
    })
    .catch(error => {
      msgBox.innerHTML = "<span style='color: red;'>Something went wrong. Please check your network connection or call us directly.</span>";
    })
    .finally(() => {
      submitBtn.disabled = false;
      submitBtn.textContent = "Submit Inquiry";
    });
  });
});
</script>
@endpush

