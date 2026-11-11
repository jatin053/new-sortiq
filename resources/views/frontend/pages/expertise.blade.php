@extends('layouts.frontend')

@section('title', 'Our Expertise | Web, Apps, Design & Digital Solutions')
@section('body_attributes') data-route="/expertise" @endsection

@push('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css">
<style>
    :root {
      --sq-blue: #00173e;
      --sq-orange: #ff5a00;
      --sq-soft: #f9f9f9; 
      --sq-text: #192225;
      --sq-muted: #6a6a6a;
      --sq-white: #ffffff;
    }

    .sq-page {
      width: 100%;
      overflow-x: hidden;
      background: var(--sq-white);
      font-family: "Nunito", Arial, sans-serif;
    }

    .sq-container {
      width: min(1140px, calc(100% - 30px));
      margin: 0 auto;
    }

    .sq-top-image {
      position: relative;
      min-height: 197px;
      padding: 0;
      color: var(--sq-white);
      text-align: center;
      background-image: url("{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/our-expertise-background.jpg') }}");
      background-position: center;
      background-size: cover;
      overflow: hidden;
    }

    .sq-top-image::before,
    .sq-cta::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.63);
    }

    .sq-top-image .sq-container,
    .sq-cta .sq-container {
      position: relative;
      z-index: 1;
    }

    .sq-top-image .sq-container {
      min-height: 197px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .sq-heading {
      margin: 0;
      color: var(--sq-blue);
      font-size: 36px;
      line-height: 1.2;
      font-weight: 700;
      text-align: center;
      letter-spacing: 0;
    }

    .sq-heading-white {
      color: var(--sq-white);
    }

    .sq-line::after {
      content: "";
      display: block;
      width: 50px;
      height: 3px;
      margin: 16px auto 0;
      background: var(--sq-orange);
    }

    .sq-line-white::after {
      background: var(--sq-white);
    }

    .sq-intro-title {
      padding: 62px 0 0;
      background: var(--sq-white);
    }

    .sq-intro-copy {
      padding: 30px 0 20px;
      background: var(--sq-white);
      text-align: center;
    }

    .sq-intro-copy p {
      max-width: 1100px;
      margin: 0 auto;
      color: #000000;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 16px;
      line-height: 1.72;
      font-weight: 400;
      text-align: center;
      -webkit-font-smoothing: antialiased;
      text-rendering: optimizeLegibility;
    }

    .sq-intro-copy a {
      color: #005eff;
      text-decoration: none;
    }

    .sq-services {
      padding: 0 0 50px;
      background: var(--sq-white);
    }

    .sq-service-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 28px 30px;
    }

    .sq-service-card {
      min-height: 270px;
      padding: 40px 28px 34px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      text-align: center;
      background: var(--sq-blue);
      color: var(--sq-white);
      border-radius: 0;
      box-shadow: 0 16px 34px rgba(0, 23, 62, 0.12);
      transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .sq-service-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 22px 42px hsla(218, 100%, 12%, 0.18);
    }

    .sq-service-icon {
      position: relative;
      width: 92px;
      height: 92px;
      margin: 0 auto 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: var(--sq-white);
      border-radius: 50%;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .sq-service-icon::before {
      content: '';
      position: absolute;
      inset: 0;
      border-radius: 50%;
      box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
      animation: pulseWhiteShadow 3s infinite ease-out;
      z-index: 1;
      pointer-events: none;
    }

    @keyframes pulseWhiteShadow {
      0% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
      }
      70% {
        transform: scale(1);
        box-shadow: 0 0 0 40px rgba(255, 255, 255, 0);
      }
      100% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
      }
    }

    .sq-service-icon img {
      position: relative;
      z-index: 2;
      width: 58px;
      max-height: 58px;
      object-fit: contain;
    }

    .sq-service-card h3 {
      margin: 0 0 12px;
      color: var(--sq-white);
      font-size: 20px;
      line-height: 1.3;
      font-weight: 700;
    }

    .sq-service-card p {
      margin: 18px 0 0;
      color: var(--sq-white);
      font-size: 15px;
      line-height: 1.65;
    }

    .sq-cta {
      position: relative;
      padding: 50px 0;
      color: var(--sq-white);
      text-align: center;
      background-image: url("{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/our-expertise-image.jpg') }}");
      background-position: center;
      background-size: cover;
      overflow: hidden;
    }

    .sq-cta::before {
      opacity: 0.64;
    }

    .sq-cta p {
      max-width: 960px;
      margin: 0 auto 30px;
      color: var(--sq-white);
      font-size: 18px;
      line-height: 1.7333333333;
      letter-spacing: 0;
    }

    .sq-cta-button {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      min-height: 45px;
      padding: 12px 25px;
      color: var(--sq-white);
      background: var(--sq-orange);
      border-radius: 3px;
      font-family: inherit;
      font-size: 15px;
      font-weight: 500;
      line-height: 1;
      text-transform: uppercase;
      transition: background 0.2s ease, transform 0.2s ease;
    }

    .sq-cta-button:hover {
      color: var(--sq-white);
      background: var(--sq-blue);
      transform: translateY(-1px);
    }

    /* Target UI Exact Match CSS */
    .sq-build-heading {
      padding: 50px 0 0;
      background: var(--sq-soft);
      text-align: center;
    }

    .sq-subtitle {
      margin: 0 0 6px;
      color: var(--sq-orange);
      font-size: 26px;
      line-height: 1.25;
      font-weight: 600;
    }

    .sq-build-heading .sq-heading {
      font-size: 26px;
    }

    .sq-form-section {
      padding: 0 0 50px;
      background: var(--sq-soft);
    }

    .sq-form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 50px; 
      align-items: flex-start;
      padding-top: 40px;
    }

    /* Checklist exact match */
    .sq-check-list {
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .sq-check-list li {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      color: #222222;
      font-family: "Roboto Slab", Georgia, "Times New Roman", serif;
      font-size: 18px; 
      font-weight: 400;
      line-height: 1.6; 
      margin-bottom: 9px; 
    }

    .sq-check-list iconify-icon {
      flex: 0 0 auto;
      margin-top: 4px;
      color: var(--sq-orange);
      font-size: 18px;
    }

    /* Form Styles */
    .sq-form-card {
      padding: 0;
      background: transparent;
      border: none;
      box-shadow: none;
    }

    .sq-form {
      display: grid;
      gap: 16px; 
      width: 100%;
      font-family: inherit;
    }

    .sq-form-row {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 16px; 
    }

    .sq-field {
      position: relative;
      display: block;
    }

    .sq-field iconify-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--sq-orange);
      pointer-events: none;
      font-size: 16px;
      z-index: 1;
    }

    .sq-field .sq-textarea-icon {
      top: 22px;
      transform: none;
    }

    .sq-input,
    .sq-textarea {
      width: 100%;
      min-height: 48px;
      padding: 12px 14px 12px 42px; 
      color: #333333;
      font: inherit;
      border: 1px solid #dcdcdc; 
      border-radius: 4px;
      background: #ffffff;
      outline: none;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .sq-textarea {
      min-height: 120px;
      resize: vertical;
    }

    .sq-input::placeholder,
    .sq-textarea::placeholder {
      color: #aaaaaa;
      font-style: italic; 
      font-weight: 400;
    }

    .sq-input:focus,
    .sq-textarea:focus {
      border-color: var(--sq-orange);
      box-shadow: 0 0 0 2px rgba(255, 90, 0, 0.1);
    }

    /* EXACT Multi-flag Phone Dropdown Overrides */
    .iti { width: 100%; display: block; }
    .iti__country-list { color: #333; text-align: left; }
    .iti__flag-container { z-index: 2; }
    
    .iti__selected-flag {
      border-right: 1px solid #dcdcdc; 
      padding-right: 8px !important;
      margin-right: 8px;
    }
    
    #sq-phone { 
      padding-left: 70px !important; 
    }

    .sq-recaptcha {
      padding: 4px 0;
      overflow-x: auto;
      margin-bottom: 5px;
    }

    .sq-submit {
      width: 100%;
      min-height: 50px;
      padding: 12px 20px;
      color: var(--sq-white);
      font-family: inherit;
      font-size: 16px;
      font-weight: 600;
      text-transform: none; 
      border: 0;
      border-radius: 4px;
      background: var(--sq-orange);
      cursor: pointer;
      transition: background 0.2s ease, transform 0.2s ease;
    }

    .sq-submit:hover {
      background: #e65100;
      transform: translateY(-1px);
    }

    @media (max-width: 1024px) {
      .sq-container { width: min(960px, calc(100% - 30px)); }
      .sq-service-grid { grid-template-columns: repeat(2, 1fr); }
      .sq-form-grid { grid-template-columns: 1fr; gap: 40px; }
    }

    @media (max-width: 767px) {
      .sq-banner { min-height: 210px; }
      .sq-banner-title { font-size: 34px; }
      .sq-top-image { min-height: 170px; padding: 0 15px; }
      .sq-top-image .sq-container { min-height: 170px; }
      .sq-heading { font-size: 31px; }
      .sq-intro-title { padding: 42px 15px 0; }
      .sq-intro-copy { padding-inline: 15px; text-align: center; }
      .sq-service-grid, .sq-form-row { grid-template-columns: 1fr; }
      .sq-service-card { min-height: 230px; }
      .sq-cta p { margin-inline: 15px; text-align: justify; }
      .sq-form-section { padding-inline: 15px; }
      .sq-check-list li { font-size: 15px; }
    }
</style>
@endpush

@section('content')
<main class="sq-page">
    <section class="sq-top-image">
      <div class="sq-container">
        <h1 class="sq-heading sq-heading-white sq-line sq-line-white">Our Expertise</h1>
      </div>
    </section>

    <section class="sq-intro-title">
      <div class="sq-container">
        <h2 class="sq-heading sq-line">Areas of Expertise</h2>
      </div>
    </section>

    <section class="sq-intro-copy">
      <div class="sq-container">
        <p>We are a leading technology solutions firm with expertise across industry in providing business solutions that enable businesses to grow, innovate, and operate more efficiently. As one of the <a href="{{ route('frontend.home') }}">best IT service providers</a>, a team of experienced professionals are here to help you to meet the unique needs of businesses of all sizes. We ensure the smooth adoption of technology that boosts performance, increases productivity, and promotes long-term digital success by adopting a planned and comprehensive strategy</p>
      </div>
    </section>

    <section class="sq-services">
      <div class="sq-container">
        <div class="sq-service-grid">
          <article class="sq-service-card">
            <div class="sq-service-icon"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/web-design-blue-icon.png') }}" alt="Web Design"></div>
            <h3>Website Designing</h3>
            <p>Explore our expertise in web designing&mdash;crafting stunning, user-friendly websites tailored to your business needs.</p>
          </article>

          <article class="sq-service-card">
            <div class="sq-service-icon"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/website-development-blue-icon.png') }}" alt="Website Development"></div>
            <h3>Website Development</h3>
            <p>We specialize in website development, creating high-performing, secure, and user-friendly websites that enhance brand presence.</p>
          </article>

          <article class="sq-service-card">
            <div class="sq-service-icon"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/mobile-app-development-blue-icon.png') }}" alt="Mobile App Development"></div>
            <h3>Mobile App Dev</h3>
            <p>Transforming ideas into reality with cutting-edge mobile app development solutions tailored to your business needs.</p>
          </article>

          <article class="sq-service-card">
            <div class="sq-service-icon"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/graphic-design-blue-icon.png') }}" alt="Graphic Design"></div>
            <h3>Graphic Design</h3>
            <p>Crafting visually stunning and impactful graphic designs to elevate your brand and captivate your audience.</p>
          </article>

          <article class="sq-service-card">
            <div class="sq-service-icon"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/digital-marketing-blue-icon.png') }}" alt="Digital Marketing"></div>
            <h3>Digital Marketing</h3>
            <p>Driving growth through strategic digital marketing solutions, tailored to boost your online presence and engagement.</p>
          </article>

          <article class="sq-service-card">
            <div class="sq-service-icon"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/content-strategy-blue-icon.png') }}" alt="Content Strategy"></div>
            <h3>Content Strategy</h3>
            <p>Crafting impactful content strategies to effectively communicate your brand&rsquo;s story and engage your audience.</p>
          </article>

          <article class="sq-service-card">
            <div class="sq-service-icon"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/framework-blue-icon.png') }}" alt="Framework"></div>
            <h3>Framework</h3>
            <p>Empowering web applications with robust frameworks like CodeIgniter and Laravel for seamless performance and scalability.</p>
          </article>

          <article class="sq-service-card">
            <div class="sq-service-icon"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/cms-solution-icon.png') }}" alt="CMS Solution"></div>
            <h3>CMS Solutions</h3>
            <p>Providing tailored CMS solutions with platforms like WordPress, ensuring flexibility, user-friendliness, and scalability for your website.</p>
          </article>

          <article class="sq-service-card">
            <div class="sq-service-icon"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/mern-stack-development-blue-icon.png') }}" alt="Mern Stack Development"></div>
            <h3>Mern Stack</h3>
            <p>At Sortiq Solutions, we leverage the power of the MERN stack (MongoDB, Express.js, React.js, and Node.js) to build high-performance.</p>
          </article>
        </div>
      </div>
    </section>

    <section class="sq-cta">
      <div class="sq-container">
        <p>At Sortiq Solutions Pvt. Ltd, we specialize in delivering cutting-edge IT solutions tailored to your business needs. From advanced web development to customized e-commerce solutions and professional IT training, we empower businesses with technology-driven excellence. Our expertise ensures seamless digital transformation, enhanced security, and optimized performance for your success.</p>
        <a class="sq-cta-button" href="#expertiseForm" style="font-weight: 700; font-size: 16px;">
          <span>Partner With Us</span>
          <iconify-icon icon="fa6-solid:arrow-down" width="16" height="16"></iconify-icon>
        </a>
      </div>
    </section>

    <section class="sq-build-heading">
      <div class="sq-container">
        <h3 class="sq-subtitle">Let&rsquo;s Build Something Amazing Together!</h3>
        <h2 class="sq-heading sq-line">Ready to take your business to the next level? Get in touch with us today.</h2>
      </div>
    </section>

    <section class="sq-form-section" id="expertiseForm">
      <div class="sq-container">
        <div class="sq-form-grid">
          
          <ul class="sq-check-list">
            <li><iconify-icon icon="fa6-regular:square-check" width="18" height="18"></iconify-icon><span>Expertise in cutting-edge technologies and advanced tools.</span></li>
            <li><iconify-icon icon="fa6-regular:square-check" width="18" height="18"></iconify-icon><span>Commitment to Quality and top-notch Security standards.</span></li>
            <li><iconify-icon icon="fa6-regular:square-check" width="18" height="18"></iconify-icon><span>Scalable &amp; Future-Ready Solutions for business growth.</span></li>
            <li><iconify-icon icon="fa6-regular:square-check" width="18" height="18"></iconify-icon><span>Industry-Specific Expertise and in-depth knowledge.</span></li>
            <li><iconify-icon icon="fa6-regular:square-check" width="18" height="18"></iconify-icon><span>End-to-End IT Services and innovative solutions.</span></li>
            <li><iconify-icon icon="fa6-regular:square-check" width="18" height="18"></iconify-icon><span>Dedicated Customer-Centric Approach and support.</span></li>
            <li><iconify-icon icon="fa6-regular:square-check" width="18" height="18"></iconify-icon><span>Cost-Effective &amp; ROI-Driven Strategies and business plans.</span></li>
            <li><iconify-icon icon="fa6-regular:square-check" width="18" height="18"></iconify-icon><span>AI &amp; Automation Expertise for intelligent innovation.</span></li>
            <li><iconify-icon icon="fa6-regular:square-check" width="18" height="18"></iconify-icon><span>Cross-Platform Compatibility and seamless performance.</span></li>
            <li><iconify-icon icon="fa6-regular:square-check" width="18" height="18"></iconify-icon><span>Agile &amp; Flexible Development Process and efficient execution.</span></li>
            <li><iconify-icon icon="fa6-regular:square-check" width="18" height="18"></iconify-icon><span>SEO &amp; Digital Marketing Integration with proven strategies.</span></li>
            <li><iconify-icon icon="fa6-regular:square-check" width="18" height="18"></iconify-icon><span>Data-Driven Decision Making and actionable insights.</span></li>
            <li><iconify-icon icon="fa6-regular:square-check" width="18" height="18"></iconify-icon><span>Robust Cybersecurity Measures and Compliance policies.</span></li>
          </ul>

          <div class="sq-form-card">
            <form method="post" action="{{ route('api.contact-messages.store') }}" class="sq-form sortiq-contact-form">
              @csrf
              <input type="hidden" name="form_type" value="Expertise Contact Form">
              <input type="hidden" name="country_code" value="+91">

              <div class="sq-form-row">
                <label class="sq-field">
                  <iconify-icon icon="fa6-solid:user" width="16" height="16"></iconify-icon>
                  <input class="sq-input" name="name" type="text" placeholder="Enter Your Name" required>
                </label>
                <label class="sq-field">
                  <iconify-icon icon="fa6-solid:envelope" width="16" height="16"></iconify-icon>
                  <input class="sq-input" name="email" type="email" placeholder="Enter Your Email" required>
                </label>
              </div>

              <div class="sq-form-row">
                <div style="position: relative; display: block;">
                  <input class="sq-input" id="sq-phone" name="phone" type="tel" placeholder="Enter Phone No." required>
                </div>

                <label class="sq-field">
                  <iconify-icon icon="fa6-solid:list-ul" width="16" height="16"></iconify-icon>
                  <input class="sq-input" name="subject" type="text" placeholder="Subject" required>
                </label>
              </div>

              <label class="sq-field">
                <iconify-icon class="sq-textarea-icon" icon="fa6-solid:comments" width="16" height="16"></iconify-icon>
                <textarea class="sq-textarea" name="message" rows="5" placeholder="Enter your message" required></textarea>
              </label>

              <div class="sq-recaptcha">
                @include('components.recaptcha')
              </div>

              <button type="submit" class="sq-submit">Send Message</button>
            </form>
          </div>
        </div>
      </div>
    </section>
</main>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js"></script>
<script>
    document.addEventListener('click', function (event) {
      const link = event.target.closest('a[href="#expertiseForm"]');
      if (!link) return;

      const form = document.getElementById('expertiseForm');
      if (!form) return;

      event.preventDefault();
      form.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });

    const phoneInput = document.querySelector("#sq-phone");
    if (phoneInput && window.intlTelInput) {
      window.intlTelInput(phoneInput, {
        initialCountry: "in",
        autoPlaceholder: "off",
        customPlaceholder: function() {
          return "Enter Phone No.";
        },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js"
      });

      phoneInput.placeholder = "Enter Phone No.";
      phoneInput.setAttribute("placeholder", "Enter Phone No.");
      
      phoneInput.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^\d]/g, '');
      });

      phoneInput.addEventListener('countrychange', function() {
         phoneInput.placeholder = "Enter Phone No.";
         phoneInput.setAttribute("placeholder", "Enter Phone No.");
         var form = phoneInput.closest('form');
         var hiddenCode = form ? form.querySelector('input[name="country_code"]') : null;
         if (hiddenCode) {
            var instance = window.intlTelInputGlobals.getInstance(phoneInput);
            hiddenCode.value = "+" + instance.getSelectedCountryData().dialCode;
         }
      });
    }
</script>
@endpush
