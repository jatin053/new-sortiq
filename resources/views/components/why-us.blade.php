@extends('layouts.frontend')

@section('title', 'Why Choose Us | Sortiq Solutions')
@section('body_attributes') data-route="/why-us" @endsection

@push('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css">
<style>
    :root {
      --sq-blue: #00173e;
      --sq-orange: #ff5a00;
      --sq-soft: #f1f1f1;
      --sq-text: #333333;
      --sq-muted: #666666;
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

    /* --- HERO SECTION (FULL WIDTH VECTOR) --- */
    .sq-hero-title {
      position: relative;
      min-height: 204px;
      padding: 0;
      color: var(--sq-white);
      text-align: center;
      background-color: var(--sq-blue);
      background-image: url("{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/blue-technology-vector.png') }}");
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat;
      overflow: hidden;
    }

    .sq-hero-title::before {
      content: "";
      position: absolute;
      inset: 0;
      background: #000; 
      z-index: 1;
      opacity: 0.6;
    }

    .sq-hero-title .sq-container {
      position: relative;
      z-index: 2;
      min-height: 204px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .sq-heading {
      margin: 0;
      color: #000;
      font-size: 30px;
      line-height: 1.2;
      font-weight: 700;
      text-align: center;
      letter-spacing: 0;
    }

    .sq-headingt {
      margin: 0;
      color: #00173e;
      font-size: 36px;
      line-height: 1.2;
      font-weight: 700;
      text-align: center;
      letter-spacing: 0;
    }
    
    .sq-headingx {
      margin: 0;
      color: #000;
      font-size: 47px;
      line-height: 1.2;
      font-weight: 800;
      text-align: center;
      letter-spacing: 0;
    }

    .sq-hero-heading {
      color: var(--sq-white);
    }

    .sq-line::after {
      content: "";
      display: block;
      width: 40px;
      height: 3px;
      margin: 28px auto 0;
      background: var(--sq-orange);
    }

    .sq-line-white::after {
      background: var(--sq-white);
    }

    .sq-why-intro {
      padding: 62px 0 0;
      background: var(--sq-soft);
      text-align: center;
    }

    .sq-reason-area {
      padding: 30px 0 0;
      background: var(--sq-soft);
    }

    .sq-reason-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      max-width: 1140px;
      margin: 0 0 65px auto;
    }

    .sq-reason-card {
      min-height: 350px;
      padding: 50px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      background: var(--sq-blue);
      box-shadow: 0 16px 34px rgba(0, 23, 62, 0.12);
      transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .sq-reason-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 16px 36px rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    .sq-radius-tl { border-top-left-radius: 100px; }
    .sq-radius-tr { border-top-right-radius: 100px; }
    .sq-radius-bl { border-bottom-left-radius: 100px; }
    .sq-radius-br { border-bottom-right-radius: 100px; }

    .sq-reason-card h2 {
      margin: 0 0 16px;
      color: var(--sq-white);
      font-family: 'Roboto', sans-serif;
      font-size: 28px;
      line-height: 1.25;
      font-weight: 700;
    }

    .sq-reason-card p {
      margin: 0;
      color: rgba(255, 255, 255, 0.9);
      font-family: inherit;
      font-size: 16px;
      line-height: 1.65;
    }

    /* --- Form Field Styles --- */
    .sq-form-card {
      padding: 0;
      background: transparent;
      border: none;
      box-shadow: none;
    }

    .sq-form {
      display: grid;
      gap: 16px;
      font-family: inherit;
      width: 100%;
    }

    .sq-form-row {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 16px 30px;
    }

    .sq-field {
      position: relative;
      display: block;
    }

    .sq-phone-field {
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
      min-height: 50px;
      padding: 11px 14px 11px 42px;
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

    /* Multi-flag Phone Dropdown Overrides */
    .sq-phone-field { position: relative; z-index: 50; }
    .sq-phone-field .iti { width: 100%; display: block; position: relative; }
    .sq-phone-field .iti__flag-container { z-index: 60 !important; pointer-events: auto !important; }
    .sq-phone-field .iti__selected-flag {
      z-index: 60 !important;
      pointer-events: auto !important;
      cursor: pointer !important;
      touch-action: manipulation !important;
      -webkit-tap-highlight-color: transparent !important;
      -webkit-user-select: none !important;
      -moz-user-select: none !important;
      -ms-user-select: none !important;
      user-select: none !important;
    }
    .sq-phone-field .iti__selected-flag * {
      pointer-events: none !important;
      -webkit-user-select: none !important;
      -moz-user-select: none !important;
      -ms-user-select: none !important;
      user-select: none !important;
    }
    .sq-phone-field .iti__country-list,
    .sq-phone-field .iti__country-list.iti__country-list--dropup {
      position: absolute !important;
      top: 100% !important;
      bottom: auto !important;
      left: 0 !important;
      right: auto !important;
      margin-top: 6px !important;
      margin-bottom: 0 !important;
      z-index: 999999 !important;
      width: min(360px, calc(100vw - 32px)) !important;
      min-width: 280px !important;
      max-width: calc(100vw - 24px) !important;
      max-height: 240px !important;
      overflow-y: auto !important;
      -webkit-overflow-scrolling: touch !important;
      color: #111827 !important;
      text-align: left !important;
      background-color: #ffffff !important;
      border: 1px solid #cbd5e1 !important;
      border-radius: 8px !important;
      box-shadow: 0 12px 30px -5px rgba(0, 0, 0, 0.22), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
    }
    @media (max-width: 640px) {
      .sq-phone-field .iti__country-list,
      .sq-phone-field .iti__country-list.iti__country-list--dropup {
        position: absolute !important;
        top: 100% !important;
        bottom: auto !important;
        left: 0 !important;
        right: auto !important;
        width: min(340px, calc(100vw - 32px)) !important;
        min-width: 280px !important;
        max-width: calc(100vw - 20px) !important;
      }
    }
    #sq-phone { 
      padding-left: 95px !important; 
    }

    .sq-recaptcha {
      padding: 4px 0;
      overflow-x: auto;
      margin-bottom: 1px;
    }

    .sq-recaptcha > div {
      max-width: 302px;
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
      border-radius: 999px;
      background: #ff6600;
      cursor: pointer;
      box-shadow: 0 4px 14px rgba(255, 102, 0, 0.25);
      transition: all 0.25s ease;
    }

    .sq-submit:hover {
      background: #001b43;
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(0, 27, 67, 0.3);
    }

    /* --- Clients & Work Sections --- */
    .sq-clients {
      position: relative;
      padding: 25px 0;
      text-align: center;
      background-color: #fff;
      background-image: url("{{ asset('frontend-assets/media/imports/sortiqsolutions/2024/12/map_overlay.png') }}");
      background-position: center;
      background-repeat: no-repeat;
      background-size: 80%; 
    }

    .sq-clients-title {
      margin-bottom: 40px;
      font-family: 'Roboto', sans-serif;
    }

    .sq-clients-title span {
      color: var(--sq-orange);
    }

    .sq-carousel {
      position: relative;
      width: 100%;
      overflow: hidden;
      padding: 10px 0;
    }

    .sq-carousel-track {
      display: flex;
      align-items: stretch;
      will-change: transform;
    }

    .sq-client-slide {
      flex: 0 0 auto;
      padding: 14px 28px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-sizing: border-box;
    }

    .sq-client-slide img {
      max-height: 75px;
      max-width: 100%;
      object-fit: contain;
      transition: transform 0.3s ease;
    }

    .sq-client-slide:hover img {
      filter: grayscale(0%);
      opacity: 1;
      transform: scale(1.08);
    }

    .sq-work {
      position: relative;
      left: 50%;
      margin-left: -50vw;
      width: 100vw;
      padding: 70px 0;
      background: url("{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/102581.jpg') }}");
      background-size: cover;
      background-position: right center;
      background-repeat: no-repeat;
      text-align: center;
    }

    .sq-work .sq-container {
      max-width: 100%;
      width: 100%;
      padding: 0 40px;
    }

    .sq-work::before {
      content: "";
      position: absolute;

      inset: 0;
      background: #000000;
      opacity: 0.6;
      transition: background 0.3s, border-radius 0.3s, opacity 0.3s;
    }

    .sq-work .sq-container {
      position: relative;
      z-index: 1;
    }

    .sq-work h2 {
      margin: 0 0 12px;
      color: #fff;
      font-size: 32px;
      font-weight: 700;
      font-family: 'Roboto', sans-serif !important;
    }

    .sq-work p {
      max-width: 1080px;
      margin: 0 auto;
      color: #fff;
      font-size: 17px;
      line-height: 1.8;
      font-weight: 400;
    }

    .sq-solutions {
      padding: 54px 0 70px;
      background: var(--sq-soft);
    }
    
    .sq-solutions-grid {
      display: grid;
      grid-template-columns: 520px 570px;
      gap: 40px;
      align-items: start;
      max-width: 1130px;
      margin: 96px auto 0;
    }

    .sq-solution-list {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 24px 36px;
    }

    .sq-solution-item {
      text-align: left;
    }

    .sq-solution-item img {
      width: 45px;
      height: 45px;
      margin: 0 0 18px 0;
      object-fit: contain;
    }

    .sq-solution-item h3 {
      margin: 0 0 12px;
      color: var(--sq-blue);
      font-family: inherit;
      font-size: 18px;
      line-height: 1.35;
      font-weight: 700;
    }

    .sq-solution-item p {
      margin: 0;
      color: #00173e;
      font-family: inherit;
      font-size: 16px;
      line-height: 1.62;
      text-align: left;
    }

    @media (max-width: 1024px) {
      .sq-container { width: min(960px, calc(100% - 30px)); }
      .sq-reason-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        max-width: 900px;
      }
      .sq-reason-card { min-height: 320px; }
      .sq-client-slide { flex-basis: 33.333%; min-width: 33.333%; }
      .sq-solutions-grid {
        grid-template-columns: 1fr;
        max-width: 760px;
      }
    }

    @media (max-width: 767px) {
      .sq-hero-title {
        margin-top: 0;
        min-height: 170px;
      }

      .sq-hero-title .sq-container {
        min-height: 170px;
      }

      .sq-why-intro {
        padding: 42px 15px 0;
      }

      .sq-reason-area {
        padding: 25px 15px 0;
      }

      .sq-reason-grid {
        grid-template-columns: 1fr;
        max-width: 767px;
        gap: 20px;
      }
      .sq-reason-card {
        min-height: auto;
        padding: 40px 24px;
      }
      .sq-radius-tl,
      .sq-radius-tr,
      .sq-radius-bl,
      .sq-radius-br {
        border-radius: 0;
      }
      .sq-solution-list, .sq-form-row { grid-template-columns: 1fr; }
      .sq-solutions-grid {
        margin-top: 56px;
      }
      .sq-client-slide { flex-basis: 50%; min-width: 50%; }
      .sq-work { padding: 50px 0; }
    }
</style>
@endpush

@section('content')
<main class="sq-page">
    <section class="sq-hero-title">
      <div class="sq-container">
        <h1 class="sq-headingt sq-hero-heading sq-line sq-line-white">Why Choose Us</h1>
      </div>
    </section>

    <section class="sq-why-intro">
      <div class="sq-container">
        <h2 class="sq-heading sq-line">Why Choose Us?</h2>
      </div>
    </section>

    <section class="sq-reason-area">
      <div class="sq-container">
        <div class="sq-reason-grid">
          <article class="sq-reason-card sq-radius-tl">
            <h2>Innovative Approach</h2>
            <p>We seamlessly integrate responsible business practices with cutting-edge technology, ensuring sustainable growth, ethical innovation, and long-lasting impact for businesses.</p>
          </article>
          <article class="sq-reason-card">
            <h2>Digital Transformation</h2>
            <p>We empower businesses with comprehensive digital strategies, integrating the latest technologies and best practices to streamline operations and drive sustainable growth.</p>
          </article>
          <article class="sq-reason-card sq-radius-tr">
            <h2>Smart<br> Solutions</h2>
            <p>We provide innovative, efficient, and scalable technology solutions tailored to optimize your business operations, enhance productivity, and drive long-term success.</p>
          </article>
          <article class="sq-reason-card sq-radius-bl">
            <h2>Future-Ready Technology</h2>
            <p>We stay ahead of industry trends, providing innovative solutions that keep your business competitive in a rapidly evolving digital landscape.</p>
          </article>
          <article class="sq-reason-card">
            <h2>Client-Centric Approach</h2>
            <p>Your success is our priority—we offer personalized strategies, dedicated support, and long-term partnerships to help you achieve your goals.</p>
          </article>
          <article class="sq-reason-card sq-radius-br">
            <h2>End-to-End Support</h2>
            <p>From consultation to implementation, our team provides seamless support to keep your business running smoothly.</p>
          </article>
        </div>
      </div>
    </section>

    <section class="sq-clients">
      <div class="sq-container">
        <h2 class="sq-headingx sq-clients-title">Our Trusted <span>Clients</span></h2>
        <div class="sq-carousel" data-sq-carousel>
          <div class="sq-carousel-track">
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/Kebaonish-logo.webp') }}" alt="Kebaonish Logo"></div>
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/helium-logo.webp') }}" alt="Helium Logo"></div>
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/agentiiv-logo.webp') }}" alt="Agentiiv Logo"></div>
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/koretraining-logo.webp') }}" alt="Kore Training Logo"></div>
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/korelife-logo.webp') }}" alt="Korelife Logo"></div>
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/Inspiration-logo.webp') }}" alt="Island Inspiration Logo"></div>
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/coogee-logo.webp') }}" alt="Coogee Logo"></div>
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/wattman-logo.webp') }}" alt="Wattman Logo"></div>
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/bondi-business-women-logo.webp') }}" alt="Bondi Business Women"></div>
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/royal-crest-logo.webp') }}" alt="Royal Crest Logo"></div>
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/dover-heights-community-logo.webp') }}" alt="Dover Heights Community Logo"></div>
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/beachlander-logo.webp') }}" alt="Beachlander Logo"></div>
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/advanatge-plus-tax-logo.webp') }}" alt="Advantage Plus Tax Logo"></div>
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/01/logo.webp') }}" alt="Byron Shire Respite Service Portfolio"></div>
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/01/cropped-PregnancyBirth_Parenting-1-450x110-1.png') }}" alt="Pregnancy Birth & Parenting Logo"></div>
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/01/cropped-hba-big-logo11-min-1.webp') }}" alt="Hypnobirthing Australia Logo"></div>
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/01/cropped-cropped-floydglass_logo-1.png') }}" alt="Floyd Glass Logo"></div>
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/01/Group-3@2x.png') }}" alt="BWP Bahamas Wedding Planner Logo"></div>
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/01/cropped-thesitecoach_logo_final-2048x683-1.png') }}" alt="The Site Coach Logo"></div>
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/01/logo.png') }}" alt="Reddy People Logo"></div>
            <div class="sq-client-slide"><img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/01/cropped-Pinstripe-Logo-WHITE.jpg') }}" alt="Pinstripe Recruitment Logo"></div>
          </div>
        </div>
      </div>
    </section>

    <section class="sq-work">
      <div class="sq-container">
        <h2>Let's Work Together</h2>
        <div class="w-16 h-1.5 bg-[#ff6600] mx-auto mt-3 mb-6 relative z-10" style="width: 64px; height: 6px; background-color: #ff6600; margin: 12px auto 22px; position: relative; z-index: 1;"></div>
        <p>
          At Sortiq Solutions Pvt. Ltd., we believe that the right technology can drive meaningful change.
          Partner with us to unlock cutting-edge solutions designed specifically to meet your unique business needs.
          Whether you’re aiming to streamline operations, fortify cybersecurity, or scale your business to new heights,
          our team of experts is here to support you at every stage of your journey. With a deep understanding of
          industry trends and a commitment to innovation, we work alongside you to develop strategies that enhance
          efficiency, boost productivity, and future-proof your business. Let’s collaborate and pave the way for a
          smarter, more resilient future—together!
        </p>
      </div>
    </section>

    <section class="sq-solutions">
      <div class="sq-container">
        <h2 class="sq-heading sq-line">Get Custom Solutions for Your Business</h2>
        <div class="sq-solutions-grid">
          <div class="sq-solution-list">
            <div class="sq-solution-item">
              <img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/custom-theme-plugin-development.png') }}" alt="Custom Themes & Plugins">
              <h3>Custom Themes &amp; Plugins</h3>
              <p>Develop tailored WordPress themes and plugins that enhance functionality and align perfectly with your business needs.</p>
            </div>
            <div class="sq-solution-item">
              <img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/crm-integration-vector.png') }}" alt="CRM Integration Icon">
              <h3>Seamless CRM Integration</h3>
              <p>Integrate your website with leading CRM systems to automate workflows, streamline customer management, and boost efficiency.</p>
            </div>
            <div class="sq-solution-item">
              <img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/product-management.png') }}" alt="Product Management">
              <h3>Product Management</h3>
              <p>Get a user-friendly &amp; advanced product management tools, making it effortless to update, organize, and showcase your offerings.</p>
            </div>
            <div class="sq-solution-item">
              <img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/support-maintenance.png') }}" alt="Support Maintenance">
              <h3>24/7 Support &amp; Maintenance</h3>
              <p>Ensure your website runs smoothly with continuous support, regular updates, security enhancements, and performance optimizations.</p>
            </div>
          </div>

          <div class="sq-form-card">
            <form method="post" action="{{ route('api.contact-messages.store') }}" class="sq-form sortiq-contact-form">
              @csrf
              <input type="hidden" name="form_type" value="Why Choose Us Form">
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
                <div class="sq-phone-field">
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
(function () {
  const carousel = document.querySelector('[data-sq-carousel]');
  if (!carousel) return;

  const track = carousel.querySelector('.sq-carousel-track');
  const originalSlides = Array.from(track.children);

  originalSlides.forEach((slide) => {
    track.appendChild(slide.cloneNode(true));
  });

  let position = 0;
  let isDragging = false;
  let startX = 0;
  let currentPosition = 0;
  const autoSpeed = 0.6;

  function getLimit() {
    return track.scrollWidth / 2;
  }

  function setTransform() {
    track.style.transition = 'none';
    track.style.transform = 'translateX(' + position + 'px)';
  }

  function normalizePosition() {
    const limit = getLimit();

    if (position <= -limit) {
      position = 0;
    }

    if (position > 0) {
      position = -limit;
    }
  }

  function animate() {
    if (!isDragging) {
      position -= autoSpeed;
      normalizePosition();
      setTransform();
    }

    requestAnimationFrame(animate);
  }

  carousel.addEventListener('mousedown', function (e) {
    isDragging = true;
    startX = e.pageX;
    currentPosition = position;
  });

  window.addEventListener('mousemove', function (e) {
    if (!isDragging) return;

    position = currentPosition + (e.pageX - startX);
    normalizePosition();
    setTransform();
  });

  window.addEventListener('mouseup', function () {
    isDragging = false;
  });

  carousel.addEventListener('touchstart', function (e) {
    isDragging = true;
    startX = e.touches[0].pageX;
    currentPosition = position;
  });

  carousel.addEventListener('touchmove', function (e) {
    if (!isDragging) return;

    position = currentPosition + (e.touches[0].pageX - startX);
    normalizePosition();
    setTransform();
  });

  carousel.addEventListener('touchend', function () {
    isDragging = false;
  });

  animate();
})();

const phoneInput = document.querySelector("#sq-phone");

if (phoneInput && window.intlTelInput) {
  const sqPicker = window.intlTelInput(phoneInput, {
    initialCountry: "in",
    separateDialCode: true,
    nationalMode: true,
    autoPlaceholder: "off",
    customPlaceholder: function() {
      return "Enter Phone No.";
    },
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js"
  });

  const selectedFlag = phoneInput.closest('.iti')?.querySelector('.iti__selected-flag');
  if (selectedFlag) {
    selectedFlag.setAttribute('tabindex', '0');
    selectedFlag.setAttribute('role', 'button');
    selectedFlag.setAttribute('aria-label', 'Select country');
  }

  const updateSqPhoneLayout = function() {
    phoneInput.placeholder = "Enter Phone No.";
    phoneInput.setAttribute("placeholder", "Enter Phone No.");
    const flag = phoneInput.closest('.iti')?.querySelector('.iti__selected-flag');
    if (flag) {
      const flagWidth = flag.offsetWidth;
      if (flagWidth > 0) {
        phoneInput.style.setProperty('padding-left', (flagWidth + 8) + 'px', 'important');
      }
    }
  };

  const syncSqCountryCode = function() {
    updateSqPhoneLayout();
    const form = phoneInput.closest('form');
    const hiddenCode = form ? form.querySelector('input[name="country_code"]') : null;
    if (hiddenCode) {
      const dialCode = sqPicker.getSelectedCountryData().dialCode;
      hiddenCode.value = dialCode ? "+" + dialCode : "+91";
    }
  };

  phoneInput.addEventListener('countrychange', syncSqCountryCode);
  syncSqCountryCode();
  setTimeout(updateSqPhoneLayout, 50);
  setTimeout(updateSqPhoneLayout, 250);
  
  // RESTRICT TO NUMBERS ONLY
  phoneInput.addEventListener('input', function(e) {
    this.value = this.value.replace(/[^\d]/g, '');
  });

  // Always force dropdown downwards
  phoneInput.addEventListener('open:countrydropdown', function() {
    var countryList = phoneInput.closest('.iti')?.querySelector('.iti__country-list');
    if (countryList) {
      countryList.classList.remove('iti__country-list--dropup');
      countryList.style.top = '100%';
      countryList.style.bottom = 'auto';
    }
  });
}
</script>
@endpush
