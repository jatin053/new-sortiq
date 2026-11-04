@extends('layouts.frontend')

@section('title', 'Sortiq Solutions Pvt. Ltd.')
@section('body_attributes') data-route="/" @endsection

@push('head')
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap">
      <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
      <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">
      </noscript>
      <style>
        .sortiq-home-slider-iframe {
          width: 100%;
          height: 600px;
          border: none;
          display: block;
        }
        @media (max-width: 991px) {
          .sortiq-home-slider-iframe {
            height: 520px;
          }
        }
        @media (max-width: 767px) {
          .sortiq-home-slider-iframe {
            height: 560px;
          }
        }
        .hm-cert-slider {
          position: relative;
          width: 100%;
          max-width: 1200px;
          margin: 0 auto;
          padding: 0 50px;
          box-sizing: border-box;
        }
        .hm-cert-viewport {
          position: relative;
          width: 100%;
          overflow: hidden !important;
          border-radius: 16px;
        }
        .hm-cert-track {
          display: flex !important;
          flex-direction: row !important;
          flex-wrap: nowrap !important;
          gap: 24px !important;
          padding: 0 !important;
          margin: 0 !important;
          will-change: transform;
          box-sizing: border-box;
        }
        .hm-cert-card {
          flex: 0 0 calc((100% - 48px) / 3) !important;
          width: calc((100% - 48px) / 3) !important;
          max-width: calc((100% - 48px) / 3) !important;
          min-width: calc((100% - 48px) / 3) !important;
          box-sizing: border-box !important;
          background: #ffffff;
          border-radius: 16px;
          overflow: hidden;
          box-shadow: 0 8px 24px rgba(0, 0, 0, 0.18);
          transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hm-cert-card:hover {
          transform: translateY(-4px);
          box-shadow: 0 14px 30px rgba(0, 0, 0, 0.28);
        }
        .hm-cert-card img {
          display: block !important;
          width: 100% !important;
          height: auto !important;
          aspect-ratio: 1 / 1;
          object-fit: cover !important;
          border-radius: 16px;
        }
        .hm-cert-nav {
          position: absolute;
          top: 50%;
          transform: translateY(-50%);
          width: 42px;
          height: 42px;
          border-radius: 50%;
          background: #00173e;
          border: 1.5px solid rgba(255, 255, 255, 0.25);
          color: #ffffff !important;
          cursor: pointer;
          z-index: 10;
          display: flex;
          align-items: center;
          justify-content: center;
          transition: all 0.25s ease;
          box-shadow: 0 4px 14px rgba(0, 0, 0, 0.3);
          padding: 0;
        }
        .hm-cert-nav:hover {
          background: #ff6600;
          border-color: #ff6600;
          transform: translateY(-50%) scale(1.08);
          box-shadow: 0 6px 18px rgba(255, 102, 0, 0.35);
        }
        .hm-cert-prev { left: 0; }
        .hm-cert-next { right: 0; }
        .hm-cert-dots {
          display: flex;
          justify-content: center;
          align-items: center;
          gap: 8px;
          margin-top: 26px;
        }
        .hm-cert-dot {
          appearance: none;
          width: 10px;
          height: 10px;
          padding: 0;
          border: 0;
          border-radius: 999px;
          background: rgba(255, 255, 255, 0.35);
          cursor: pointer;
          transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hm-cert-dot.active {
          width: 28px;
          background: #ff6600;
        }
        @media (max-width: 1023px) and (min-width: 640px) {
          .hm-cert-track { gap: 20px !important; }
          .hm-cert-card {
            flex: 0 0 calc((100% - 20px) / 2) !important;
            width: calc((100% - 20px) / 2) !important;
            max-width: calc((100% - 20px) / 2) !important;
            min-width: calc((100% - 20px) / 2) !important;
          }
        }
        @media (max-width: 639px) {
          .hm-cert-slider { padding: 0 38px; }
          .hm-cert-track { gap: 16px !important; }
          .hm-cert-card {
            flex: 0 0 100% !important;
            width: 100% !important;
            max-width: 100% !important;
            min-width: 100% !important;
          }
          .hm-cert-nav { width: 32px; height: 32px; }
          .hm-cert-nav svg { width: 16px; height: 16px; }
        }
        .hm-video-card {
          position: relative;
          background: #000;
          border-radius: 10px;
          overflow: hidden;
          aspect-ratio: 1 / 1;
          box-shadow: 0 8px 24px rgba(0, 0, 0, 0.18);
          transition: transform 0.28s ease, box-shadow 0.28s ease;
        }
        .hm-video-card:hover {
          transform: translateY(-3px);
          box-shadow: 0 14px 32px rgba(0, 0, 0, 0.28);
        }
        .hm-video-thumb {
          position: relative;
          width: 100%;
          height: 100%;
          background: #000;
          overflow: hidden;
          pointer-events: auto !important;
        }
        .hm-video-facade {
          position: absolute;
          inset: 0;
          width: 100%;
          height: 100%;
          padding: 0;
          margin: 0;
          border: 0;
          background: #000;
          cursor: pointer;
          display: block;
          text-align: left;
          z-index: 5;
          outline: none;
        }
        .hm-video-poster {
          width: 100%;
          height: 100%;
          object-fit: cover;
          display: block;
          transition: transform 0.4s ease, filter 0.3s ease;
        }
        .hm-video-card:hover .hm-video-poster,
        .hm-video-facade:focus-visible .hm-video-poster {
          transform: scale(1.05);
          filter: brightness(0.92);
        }
        .hm-video-overlay {
          position: absolute;
          inset: 0;
          background: linear-gradient(180deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.06) 40%, rgba(0,0,0,0.18) 65%, rgba(0,0,0,0.72) 100%);
          display: flex;
          flex-direction: column;
          justify-content: space-between;
          padding: 14px;
          box-sizing: border-box;
          transition: background 0.3s ease;
        }
        .hm-video-card:hover .hm-video-overlay {
          background: linear-gradient(180deg, rgba(0,0,0,0.78) 0%, rgba(0,0,0,0.02) 40%, rgba(0,0,0,0.1) 65%, rgba(0,0,0,0.82) 100%);
        }
        .hm-video-card-title {
          font-size: 13px;
          font-weight: 700;
          color: #ffffff;
          line-height: 1.35;
          margin: 0;
          display: -webkit-box;
          -webkit-line-clamp: 2;
          -webkit-box-orient: vertical;
          overflow: hidden;
          text-shadow: 0 2px 4px rgba(0,0,0,0.85);
          font-family: inherit;
        }
        .hm-video-play-wrap {
          align-self: center;
          display: flex;
          align-items: center;
          justify-content: center;
          transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
          filter: drop-shadow(0 6px 14px rgba(0,0,0,0.5));
        }
        .hm-video-play-svg {
          width: 58px;
          height: 40px;
          display: block;
        }
        .hm-video-play-svg .play-bg {
          fill: #ff0000;
          transition: fill 0.2s ease, opacity 0.2s ease;
          opacity: 0.92;
        }
        .hm-video-card:hover .hm-video-play-wrap,
        .hm-video-facade:focus-visible .hm-video-play-wrap {
          transform: scale(1.15);
        }
        .hm-video-card:hover .hm-video-play-svg .play-bg {
          opacity: 1;
        }
        .hm-video-bottom {
          display: flex;
          align-items: center;
          justify-content: space-between;
        }
        .hm-video-badge {
          display: inline-flex;
          align-items: center;
          gap: 5px;
          padding: 3px 9px;
          border-radius: 999px;
          background: rgba(0, 0, 0, 0.62);
          backdrop-filter: blur(4px);
          color: #fff;
          font-size: 11px;
          font-weight: 600;
          text-transform: uppercase;
          letter-spacing: 0.5px;
        }
        /* ---- Video Lightbox Modal ---- */
        .sq-video-modal {
          position: fixed;
          inset: 0;
          z-index: 999999;
          display: flex;
          align-items: center;
          justify-content: center;
          padding: 24px;
          opacity: 0;
          visibility: hidden;
          pointer-events: none;
          transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .sq-video-modal.is-active {
          opacity: 1;
          visibility: visible;
          pointer-events: auto;
        }
        .sq-video-modal-backdrop {
          position: absolute;
          inset: 0;
          background: rgba(0, 8, 24, 0.88);
          backdrop-filter: blur(8px);
          -webkit-backdrop-filter: blur(8px);
        }
        .sq-video-modal-dialog {
          position: relative;
          width: 100%;
          max-width: 980px;
          background: #000;
          border-radius: 16px;
          overflow: hidden;
          box-shadow: 0 25px 60px -10px rgba(0, 0, 0, 0.8), 0 0 0 1px rgba(255, 255, 255, 0.12);
          transform: scale(0.92) translateY(12px);
          transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
          z-index: 10;
        }
        .sq-video-modal.is-active .sq-video-modal-dialog {
          transform: scale(1) translateY(0);
        }
        .sq-video-modal-header {
          display: flex;
          align-items: center;
          justify-content: space-between;
          padding: 12px 18px;
          background: #071530;
          border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .sq-video-modal-title {
          font-size: 15px;
          font-weight: 600;
          color: #ffffff;
          margin: 0;
          white-space: nowrap;
          overflow: hidden;
          text-overflow: ellipsis;
          padding-right: 14px;
          font-family: inherit;
        }
        .sq-video-modal-close {
          display: inline-flex;
          align-items: center;
          justify-content: center;
          width: 36px;
          height: 36px;
          border-radius: 50%;
          background: rgba(255, 255, 255, 0.1);
          border: 0;
          color: #ffffff;
          cursor: pointer;
          flex-shrink: 0;
          transition: background 0.2s ease, transform 0.2s ease, color 0.2s ease;
        }
        .sq-video-modal-close:hover {
          background: #ff5a00;
          color: #fff;
          transform: scale(1.08);
        }
        .sq-video-responsive {
          position: relative;
          width: 100%;
          aspect-ratio: 16 / 9;
          background: #000;
        }
        .sq-video-responsive iframe,
        .sq-video-responsive video {
          position: absolute;
          inset: 0;
          width: 100%;
          height: 100%;
          border: 0;
          display: block;
        }
        @media (max-width: 767px) {
          .sq-video-modal {
            padding: 12px;
          }
          .sq-video-modal-dialog {
            border-radius: 12px;
          }
          .sq-video-modal-header {
            padding: 10px 14px;
          }
          .sq-video-modal-title {
            font-size: 13px;
          }
          .sq-video-modal-close {
            width: 32px;
            height: 32px;
          }
        }
        .hm-clients-section .hm-section-head {
          position: relative;
          z-index: 5;
        }
        .hm-clients-section .hm-clients-title {
          position: relative;
          z-index: 6;
          color: #101a1f !important;
          background: transparent !important;
          background-image: none !important;
          -webkit-background-clip: initial !important;
          background-clip: initial !important;
          -webkit-text-fill-color: #101a1f !important;
          font-weight: 700 !important;
          opacity: 1 !important;
          filter: none !important;
          mix-blend-mode: normal !important;
          -webkit-mask-image: none !important;
          mask-image: none !important;
        }
        .hm-clients-section .hm-clients-title .hm-orange {
          color: #ff5a00 !important;
          background: transparent !important;
          background-image: none !important;
          -webkit-text-fill-color: #ff5a00 !important;
          opacity: 1 !important;
          filter: none !important;
          mix-blend-mode: normal !important;
          -webkit-mask-image: none !important;
          mask-image: none !important;
        }
        .hm-testimonials-section .hm-ts-card {
          position: relative;
          overflow: visible !important;
          padding: 26px 24px 52px !important;
          border: 0 !important;
          border-radius: 0 !important;
          background: #fff !important;
          box-shadow: none !important;
        }
        .hm-testimonials-section .hm-ts-stars {
          display: none !important;
        }
        .hm-testimonials-section .hm-ts-quote {
          max-width: 1180px;
          margin: 0 auto !important;
          color: #171717 !important;
          font-size: clamp(16px, 1.35vw, 20px) !important;
          font-style: normal !important;
          font-weight: 400 !important;
          line-height: 1.65 !important;
          text-align: center !important;
          opacity: 1 !important;
        }
        .hm-testimonials-section .hm-ts-card::before {
          content: "";
          position: absolute;
          bottom: 22px;
          left: 50%;
          width: 266px;
          height: 1px;
          background: #c5c5c5;
          transform: translateX(-50%);
        }
        .hm-testimonials-section .hm-ts-card::after {
          content: "";
          position: absolute;
          bottom: 14px;
          left: 50%;
          width: 16px;
          height: 16px;
          border-bottom: 1px solid #c5c5c5;
          border-left: 1px solid #c5c5c5;
          background: #fff;
          transform: translateX(-50%) rotate(-45deg);
        }
        .hm-testimonials-section {
          min-height: 440px;
          padding: 54px 0 58px !important;
          background: #fff !important;
        }
        .hm-testimonials-section .hm-ts-inner {
          width: 100%;
          max-width: 1500px;
          margin: 0 auto;
          padding: 0 24px;
        }
        .hm-testimonials-section .hm-section-head {
          margin: 0 0 12px !important;
          text-align: center !important;
        }
        .hm-testimonials-section .hm-section-head h2 {
          margin: 0 !important;
          color: #001b48 !important;
          font-size: clamp(27px, 2vw, 35px) !important;
          font-weight: 600 !important;
          line-height: 1.25 !important;
          text-align: center !important;
        }
        .hm-testimonials-section .hm-section-head .hm-line {
          width: 40px !important;
          height: 3px !important;
          margin: 28px auto 20px !important;
          background: #ff5a00 !important;
        }
        .hm-testimonials-section .hm-ts-slider {
          width: 100%;
          overflow: hidden;
        }
        .hm-testimonials-section .hm-ts-track {
          display: flex;
          align-items: stretch;
        }
        .hm-testimonials-section .hm-ts-card {
          flex: 0 0 100% !important;
          width: 100% !important;
          min-width: 100% !important;
        }
        .hm-testimonials-section .hm-ts-quote {
          max-width: 1120px !important;
          min-height: 88px;
          display: flex;
          align-items: center;
          justify-content: center;
        }
        .hm-testimonials-section .hm-ts-dots-container {
          margin-top: 20px !important;
        }
        .hm-testimonials-section .hm-ts-dots {
          display: flex !important;
          align-items: center;
          justify-content: center;
          gap: clamp(35px, 6vw, 95px) !important;
        }
        .hm-testimonials-section .hm-ts-thumb {
          align-items: center !important;
          gap: 14px !important;
          padding: 0 !important;
          border: 0 !important;
          background: transparent !important;
          color: #ff5a00 !important;
          font-size: 18px !important;
          font-weight: 600 !important;
          white-space: nowrap;
          cursor: pointer;
        }
        .hm-testimonials-section .hm-ts-thumb img {
          width: 54px !important;
          height: 54px !important;
          border: 2px solid transparent;
          border-radius: 50% !important;
          object-fit: cover;
        }
        .hm-testimonials-section .hm-ts-thumb.active img {
          border-color: #ff5a00 !important;
        }
        @media (max-width: 767px) {
          .hm-testimonials-section { min-height: 0; padding: 42px 0 !important; }
          .hm-testimonials-section .hm-ts-inner { padding: 0 16px; }
          .hm-testimonials-section .hm-ts-card { padding: 20px 8px 48px !important; }
          .hm-testimonials-section .hm-ts-quote { min-height: 0; font-size: 16px !important; }
          .hm-testimonials-section .hm-ts-dots { gap: 16px !important; }
          .hm-testimonials-section .hm-ts-thumb span { display: none; }
        }
      </style>
@endpush

@section('content')
<main class="sortiq-home font-raleway"><div class="font-raleway">
<h1 class="sr-only">Sortiq Solutions | Leading Web Development, Mobile Apps &amp; Digital Marketing Company</h1>
<iframe src="https://slides-jatin-choudhary.vercel.app/" class="sortiq-home-slider-iframe" title="Sortiq Solutions - Web &amp; Mobile App Development" loading="lazy" scrolling="no"></iframe>
<section class="hm-why-section">
  <div class="max-w-[1200px] mx-auto px-4 w-full hm-why-container">
    <div class="hm-why-head">
      <h2>Why Choose Us</h2>
      <div class="hm-why-accent-bar" aria-hidden="true"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 lg:gap-10 justify-items-center w-full">
      <div class="w-full">
        <div class="hm-why-card">
          <div class="hm-why-icon"><img src="{{ asset('frontend-assets/media/home/why-us/tech-expertise-image.webp') }}" alt="Tech Expertise" loading="lazy" decoding="async"></div>
          <h3>Strategy-First Approach</h3>
          <p>We start with understanding your business goals and target audience. Every website and marketing campaign is built with a clear strategy to drive growth and leads.</p>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-why-card">
          <div class="hm-why-icon"><img src="{{ asset('frontend-assets/media/home/why-us/custom-solutions-image.webp') }}" alt="Custom Solutions" loading="lazy" decoding="async"></div>
          <h3>ConverDriven Development</h3>
          <p>Our websites are designed to do more than just look good. We create user-focused, SEO-friendly content that turns visitors into paying clients.</p>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-why-card">
          <div class="hm-why-icon"><img src="{{ asset('frontend-assets/media/home/why-us/quality-and-timeless-image.webp') }}" alt="Quality &amp; Timeliness" loading="lazy" decoding="async"></div>
          <h3>Data-Driven Marketing</h3>
          <p>To optimize campaigns, we rely on tracking, analytics, and actual performance data. Every decision is driven by insights to maximize ROI and reduce wasted ad spend.</p>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-why-card">
          <div class="hm-why-icon"><img src="{{ asset('frontend-assets/media/home/why-us/online-support-icon.webp') }}" alt="On-Going Support" loading="lazy" decoding="async"></div>
          <h3>Long-Term Growth Partner</h3>
          <p>We don’t disappear after launch. From ongoing optimization and support to scaling your digital presence, we work as a long-term partner in your business growth.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== WIX PARTNER + CERTIFICATIONS (navy, same copy as live site) ===================== -->
<section class="hm-wix-section">

  <div class="max-w-[1200px] mx-auto px-4 w-full hm-wix-why-row">

    <div class="hm-section-head text-center lg:px-12">
      <h2 style="color: #fff;">Proud to be a Wix Partner</h2>
      <div class="hm-line mx-auto"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-10 items-center w-full">

      <div class="w-full">
        <p class="hm-wix-text">
          At Sortiq Solutions Pvt. Ltd., we are honored to be recognized as a certified Wix Partner. This partnership empowers us to build high-performing, visually appealing, and fully responsive websites tailored to your business goals. With Wix’s powerful tools and our technical expertise, we bring your ideas to life—seamlessly, efficiently, and with stunning design precision.
        </p>

        <p class="hm-wix-text mb-0">
          Whether you’re a startup, SME, or an established brand, we’re here to create a digital presence that stands out. We simplify the digital journey so you can focus on growing your business. Let’s build something amazing together with Wix.
        </p>
      </div>

      <div class="w-full text-center">
        <div class="hm-wix-badge-wrap">
          <a href="https://www.wix.com/studio/community/partners/sortiq-solutions-pvt-ltd"
             target="_blank"
             rel="noopener noreferrer"
             aria-label="View Sortiq Solutions on Wix Studio">
            <img src="{{ asset('frontend-assets/media/home/badges/EN_legend_small.webp') }}"
                 alt="Wix Partner"
                 class="hm-wix-img"
                 loading="lazy"
                 decoding="async">
          </a>
        </div>
      </div>

    </div>

  </div>

  <!-- CERTIFICATION SECTION -->
  <div class="hm-certs-inner">

    <div class="hm-section-head text-center hm-certs-head">
      <h2 style="color: #fff;">Global Certifications &amp; Recognitions</h2>
      <div class="hm-line mx-auto"></div>
    </div>

    <div class="hm-cert-slider">
      <button type="button" class="hm-cert-nav hm-cert-prev" aria-label="Previous certificate">
        <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
      </button>

      <!-- SLIDER -->
      <div class="hm-cert-viewport">
        <div class="hm-cert-track">
          <!-- CARD -->
          <div class="hm-cert-card">
            <img src="{{ asset('frontend-assets/media/home/badges/wix-web-designer-300x300.jpg') }}" alt="Wix Web Designer" loading="lazy" decoding="async">
          </div>

          <div class="hm-cert-card">
            <img src="{{ asset('frontend-assets/media/home/badges/Digital-Advertising-300x300.jpg') }}" alt="Digital Advertising" loading="lazy" decoding="async">
          </div>

          <div class="hm-cert-card">
            <img src="{{ asset('frontend-assets/media/home/badges/social-media-certified-300x300.jpg') }}" alt="Social Media Certified" loading="lazy" decoding="async">
          </div>

          <div class="hm-cert-card">
            <img src="{{ asset('frontend-assets/media/home/badges/wix-studio-300x300.jpg') }}" alt="Wix Studio" loading="lazy" decoding="async">
          </div>
        </div>
      </div>

      <button type="button" class="hm-cert-nav hm-cert-next" aria-label="Next certificate">
        <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
      </button>

      <div class="hm-cert-dots" aria-label="Certificate slides"></div>
    </div>

  </div>

</section>

<!-- ===================== HOW WE MAKE IT HAPPEN (VIDEOS) ===================== -->
<section class="hm-videos-section">
  <div class="hm-videos-wrap">
    <div class="hm-section-head text-center hm-videos-head">
      <span class="hm-workflow-badge">Work Flow</span>
      <h2>How We Make It Happen</h2>
    </div>
    <div class="hm-video-grid">
      @foreach($homeVideos as $video)
        @php
          $videoTitle = $video->title ?: 'Sortiq Solutions Video';
          $thumbUrl = $video->thumbnail_url;
          $playbackUrl = $video->playback_url;
          $playbackType = $video->playback_type ?? 'youtube';
        @endphp
        <div class="hm-video-card">
          <div class="hm-video-thumb">
            <button type="button"
                    class="hm-video-facade"
                    data-video-open
                    data-playback-url="{{ $playbackUrl }}"
                    data-playback-type="{{ $playbackType }}"
                    data-video-title="{{ $videoTitle }}"
                    aria-label="Play video: {{ $videoTitle }}">
              <img
                src="{{ $thumbUrl }}"
                alt="{{ $videoTitle }}"
                class="hm-video-poster"
                loading="lazy"
                decoding="async"
              >
              <div class="hm-video-overlay">
                <div class="hm-video-top">
                  <h3 class="hm-video-card-title">{{ $videoTitle }}</h3>
                </div>
                <div class="hm-video-play-wrap" aria-hidden="true">
                  <svg class="hm-video-play-svg" viewBox="0 0 68 48">
                    <path class="play-bg" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z"></path>
                    <path d="M 45,24 27,14 27,34" fill="#ffffff"></path>
                  </svg>
                </div>
                <div class="hm-video-bottom">
                  <span class="hm-video-badge">Watch Video</span>
                </div>
              </div>
            </button>
          </div>
        </div>
      @endforeach
    </div>
    <div class="hm-videos-footer">
      <a href="https://www.youtube.com/@SortiqSolutions" target="_blank" rel="noopener" class="hm-btn-orange" aria-label="View all Sortiq Solutions portfolio and workflow videos on YouTube">VIEW ALL VIDEOS</a>
    </div>
  </div>
</section>

<!-- VIDEO LIGHTBOX MODAL -->
<div id="sqVideoModal" class="sq-video-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="sqVideoModalTitle">
  <div class="sq-video-modal-backdrop" data-close-video-modal></div>
  <div class="sq-video-modal-dialog">
    <div class="sq-video-modal-header">
      <div id="sqVideoModalTitle" class="sq-video-modal-title" role="heading" aria-level="3">Video Player</div>
      <button type="button" class="sq-video-modal-close" data-close-video-modal aria-label="Close video player">
        <svg viewBox="0 0 24 24" width="22" height="22" stroke="currentColor" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>
    <div class="sq-video-modal-body">
      <div id="sqVideoContainer" class="sq-video-responsive"></div>
    </div>
  </div>
</div>

<!-- ===================== WHAT WE OFFER (SERVICES) ===================== -->
<section class="hm-services-section hm-reveal-up">
  <div class="max-w-[1200px] mx-auto px-4 w-full">
    <div class="hm-section-head text-center">
      <h2 style="color: #00173E;">What We Offer</h2>
      <div class="hm-line mx-auto"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-10 justify-items-center w-full">
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/graphic-design-icon.png') }}" alt="Website Designing" loading="lazy" decoding="async"></div>
          <h3>Website Designing</h3>
          <p>We create visually stunning and user-friendly websites, tailored to meet your business needs and elevate your online presence.</p>
          <a href="{{ url('/website-design-services') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/website-development-icon.png') }}" alt="Website Development" loading="lazy" decoding="async"></div>
          <h3>Website Development</h3>
          <p>We provide customized, high-quality website development services to elevate your business online.</p>
          <a href="{{ url('/website-development-services') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/mobile-app-icon.png') }}" alt="Mobile App Dev" loading="lazy" decoding="async"></div>
          <h3>Mobile App Dev</h3>
          <p>Transforming ideas into reality with cutting-edge mobile app development solutions tailored to your business needs.</p>
          <a href="{{ url('/app-development-company') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/graphic-design-icon.png') }}" alt="Graphic Design" loading="lazy" decoding="async"></div>
          <h3>Graphic Design</h3>
          <p>Crafting visually stunning and impactful graphic designs to elevate your brand and captivate your audience.</p>
          <a href="{{ url('/graphic-design-services') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/digital-marketing-icon.png') }}" alt="Digital Marketing" loading="lazy" decoding="async"></div>
          <h3>Digital Marketing</h3>
          <p>Driving growth through strategic digital marketing solutions, tailored to boost your online presence and engagement.</p>
          <a href="{{ url('/digital-marketing') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/content-strategy-icon.png') }}" alt="Content Strategy" loading="lazy" decoding="async"></div>
          <h3>Content Strategy</h3>
          <p>Crafting impactful content strategies to effectively communicate your brand's story and engage your audience.</p>
          <a href="{{ url('/seo-services') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/framework-development-icon.png') }}" alt="Framework" loading="lazy" decoding="async"></div>
          <h3>Framework</h3>
          <p>Empowering web applications with robust frameworks like CodeIgniter and Laravel for seamless performance and scalability.</p>
          <a href="{{ url('/laravel-development-services') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/cms-icon.png') }}" alt="CMS Solutions" loading="lazy" decoding="async"></div>
          <h3>CMS Solutions</h3>
          <p>Providing tailored CMS solutions with platforms like WordPress, ensuring flexibility, user-friendliness, and scalability for your website.</p>
          <a href="{{ url('/wordpress-development-services') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/mern-stack-development-icon.png') }}" alt="Mern Stack" loading="lazy" decoding="async"></div>
          <h3>Mern Stack</h3>
          <p>We leverage the power of the MERN stack (MongoDB, Express.js, React.js, and Node.js) to build high-performance web applications.</p>
          <a href="{{ url('/mern-stack-development-company') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== TRUSTED CLIENTS ===================== -->
<section class="hm-clients-section">
  <div class="max-w-[1200px] mx-auto px-4 w-full">
    <div class="hm-section-head text-center">
      <span class="hm-sub-labelx">Worldwide Client Network</span>
      <h2 class="hm-clients-title">Our Trusted <span class="hm-orange">Clients</span></h2>
      <div class="hm-line mx-auto"></div>
    </div>
    <div class="hm-clients-wrap">
  <div class="hm-clients-track">

    <!-- Original Logos -->
      @foreach($homeClientLogos as $logo)
      <div class="hm-client-slide">
        <div class="hm-client-logo">
          <img src="{{ $logo->logo_url }}" alt="{{ !empty($logo->name) ? $logo->name : 'Sortiq Solutions Client Partner' }}" loading="lazy" decoding="async">
        </div>
      </div>
      @endforeach

      <!-- Duplicate Logos for Infinite Loop -->
      @foreach($homeClientLogos as $logo)
      <div class="hm-client-slide">
        <div class="hm-client-logo">
          <img src="{{ $logo->logo_url }}" alt="{{ !empty($logo->name) ? $logo->name : 'Sortiq Solutions Client Partner' }}" loading="lazy" decoding="async">
        </div>
      </div>
      @endforeach
    </div>
  </div>
      <div class="text-center mt-5">
      <a href="/clients" class="hm-btn-orange" aria-label="View all Sortiq Solutions global clients and partners">VIEW ALL CLIENTS</a>
    </div>
  </div>
</section>

<!-- ===================== EXPERTISE / BRINGING IDEAS TO LIFE ===================== -->
<section class="hm-expertise-section">
  <div class="max-w-[1200px] mx-auto px-4 w-full">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-10 items-center w-full">
      <div class="w-full text-center hm-expertise-image">
        <img src="{{ asset('frontend-assets/media/home/Explore-our-Web-Desing-Development-Projects.png') }}" alt="Our Expertise" class="img-fluid hm-expertise-img" loading="lazy" decoding="async">
      </div>
      <div class="w-full hm-expertise-copy">
        <span class="hm-sub-label">Our Expertise in IT Solutions</span>
        <h2 class="hm-expertise-title">Bringing <span class="hm-orange">Ideas to Life </span></h2>
        <!-- white accent line below heading -->
         <div class="hx-line" style="margin-bottom: 20px;"></div>
        <p class="hm-expertise-desc">Have a glimpse at the range of innovative IT solutions delivered by Sortiq Solutions Pvt Ltd. From cutting-edge web design to seamless development, we offer end-to-end services tailored to meet your business needs. Our team is dedicated to driving digital transformation through advanced technologies and creative strategies. With a focus on quality, we empower businesses to achieve sustainable growth.</p>
        <a href="/portfolios" class="hm-btn-dark mt-3 d-inline-flex">BROWSE OUR PORTFOLIO <iconify-icon icon="lucide:arrow-right" width="16"></iconify-icon></a>
      </div>
    </div>
  </div>
</section>

<!-- ===================== TESTIMONIALS ===================== -->
<section class="hm-testimonials-section">

  <div class="hm-ts-inner">

    <div class="hm-section-head">
      <h2>What Our Clients Are Saying</h2>
      <div class="hm-line"></div>
    </div>

    <div class="hm-ts-slider">

      <div class="hm-ts-track" id="hmTsTrack">

        @foreach($homeReviews as $testimonial)
          <div class="hm-ts-card">
            <div class="hm-ts-stars">
              @for($i = 0; $i < ($testimonial->rating ?? 5); $i++)&#9733;@endfor
            </div>
            <p class="hm-ts-quote">
              &ldquo; {{ strip_tags($testimonial->content) }} &rdquo;
            </p>
          </div>
          @endforeach</div>

    </div>

    <!-- USERS -->
    <div class="hm-ts-dots-container">
      <div class="hm-ts-dots" id="hmTsDots">

      @foreach($homeReviews as $index => $testimonial)
        <button class="hm-ts-thumb {{ $index === 0 ? 'active' : '' }}">
          <img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2024/12/img' . (($index % 6) + 1) . '.jpg') }}" alt="{{ !empty($testimonial->name) ? $testimonial->name : 'Client Reviewer ' . ($index + 1) }}" loading="lazy" decoding="async">
          <span>{{ $testimonial->name ?: 'Client' }}</span>
        </button>
      @endforeach
      </div>
    </div>
  </div>

</section>

<!-- ===================== STATS BANNER ===================== -->
<section class="hm-stats-section">
  <div class="max-w-[1200px] mx-auto px-4 w-full">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 justify-items-center text-center w-full">
      <div class="w-full">
        <div class="hm-stat-box">
          <div class="hm-stat-icon"><img src="{{ asset('frontend-assets/media/home/stats/projects-icon.png') }}" alt="Projects" loading="lazy" decoding="async"></div>
          <span class="hm-stat-num" data-target="750">0</span><span class="hm-stat-plus">+</span>
          <p>PROJECTS</p>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-stat-box">
          <div class="hm-stat-icon"><img src="{{ asset('frontend-assets/media/home/stats/happy-clients.png') }}" alt="Clients" loading="lazy" decoding="async"></div>
          <span class="hm-stat-num" data-target="225">0</span><span class="hm-stat-plus">+</span>
          <p>CLIENTS</p>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-stat-box">
          <div class="hm-stat-icon"><img src="{{ asset('frontend-assets/media/home/stats/country-vector.png') }}" alt="Countries" loading="lazy" decoding="async"></div>
          <span class="hm-stat-num" data-target="30">0</span><span class="hm-stat-plus">+</span>
          <p>COUNTRIES</p>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-stat-box">
          <div class="hm-stat-icon"><img src="{{ asset('frontend-assets/media/home/stats/happy-face-icon.png') }}" alt="Happy Clients" loading="lazy" decoding="async"></div>
          <span class="hm-stat-num" data-target="150">0</span><span class="hm-stat-plus">+</span>
          <p>HAPPY CLIENTS</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== LATEST INSIGHTS (BLOG) ===================== -->
<section class="hm-blog-section">
  <div class="max-w-[1200px] mx-auto px-4 w-full">
    <div class="hm-section-head text-center">
      <h2>Latest Insights</h2>
      <div class="hm-line mx-auto"></div>
    </div>
    <div class="hm-blog-grid-wrap mx-auto" style="max-width: 1100px;">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
        @foreach($homeInsights as $blog)
          @php
            $excerpt = $blog->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($blog->content), 100);
            $category = $blog->category ?: 'Uncategorized';
          @endphp
          <div class="w-full">
            <div class="hm-blog-card">
              <div class="hm-blog-img">
                <a href="{{ route('frontend.blog.show', $blog->slug) }}">
                  <img src="{{ $blog->image_url ?: asset('frontend-assets/media/blog-placeholder.jpg') }}" alt="{{ !empty($blog->title) ? $blog->title : 'Sortiq Solutions Tech Article' }}" loading="lazy" decoding="async">
                </a>
              </div>
              <div class="hm-blog-body">
                <div class="hm-blog-meta">
                  <span style="display: inline-flex; align-items: center; gap: 4px;">
                    <iconify-icon icon="lucide:clock" style="color: #ff6a00;"></iconify-icon>
                    {{ $blog->published_at ? $blog->published_at->format('F d, Y') : '' }}
                  </span>
                  <span style="display: inline-flex; align-items: center; gap: 4px; margin-left: 12px;">
                    <iconify-icon icon="lucide:folder" style="color: #ff6a00;"></iconify-icon>
                    {{ $category }}
                  </span>
                </div>
                <h3><a href="{{ route('frontend.blog.show', $blog->slug) }}">{{ $blog->title }}</a></h3>
                <p>{{ $excerpt }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
      <div class="text-center mt-5">
      <a href="/blog" class="hm-btn-orange" style="border-radius: 50px; padding: 8px 25px; font-weight: 700;" aria-label="View all latest technology and development blog insights">VIEW ALL INSIGHTS</a>
    </div>
  </div>
</section>
</div></main>
@endsection
@push('scripts')
<script>
/* ---- Video Lightbox Modal ---- */
(function() {
  var modal = document.getElementById('sqVideoModal');
  var container = document.getElementById('sqVideoContainer');
  var titleEl = document.getElementById('sqVideoModalTitle');
  if (!modal || !container) return;

  function openVideoModal(triggerEl) {
    var rawUrl = triggerEl.getAttribute('data-playback-url') || '';
    var type = triggerEl.getAttribute('data-playback-type') || 'youtube';
    var title = triggerEl.getAttribute('data-video-title') || 'Sortiq Solutions Video';

    if (!rawUrl) return;

    if (titleEl) {
      titleEl.textContent = title;
    }

    container.innerHTML = '';

    if (type === 'file') {
      var video = document.createElement('video');
      video.src = rawUrl;
      video.title = title;
      video.controls = true;
      video.autoplay = true;
      video.playsInline = true;
      video.setAttribute('playsinline', '');
      container.appendChild(video);
      video.play().catch(function() {});
    } else {
      var embedUrl = rawUrl;
      if (embedUrl.indexOf('youtube.com/watch?v=') !== -1) {
        var parts = embedUrl.split('v=');
        if (parts[1]) {
          var vId = parts[1].split('&')[0];
          embedUrl = 'https://www.youtube.com/embed/' + vId;
        }
      } else if (embedUrl.indexOf('youtu.be/') !== -1) {
        var parts = embedUrl.split('youtu.be/');
        if (parts[1]) {
          var vId = parts[1].split('?')[0];
          embedUrl = 'https://www.youtube.com/embed/' + vId;
        }
      }

      var sep = embedUrl.indexOf('?') === -1 ? '?' : '&';
      embedUrl += sep + 'autoplay=1&playsinline=1&rel=0&modestbranding=1';

      var iframe = document.createElement('iframe');
      iframe.src = embedUrl;
      iframe.title = title;
      iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
      iframe.allowFullscreen = true;
      iframe.setAttribute('allowfullscreen', '');
      container.appendChild(iframe);
    }

    modal.classList.add('is-active');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }

  function closeVideoModal() {
    modal.classList.remove('is-active');
    modal.setAttribute('aria-hidden', 'true');
    container.innerHTML = '';
    document.body.style.overflow = '';
  }

  document.querySelectorAll('[data-video-open]').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      openVideoModal(this);
    });
  });

  modal.querySelectorAll('[data-close-video-modal]').forEach(function(el) {
    el.addEventListener('click', function(e) {
      e.preventDefault();
      closeVideoModal();
    });
  });

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && modal.classList.contains('is-active')) {
      closeVideoModal();
    }
  });
})();


/* ============================================================
   HOMEPAGE SCRIPTS
   ============================================================ */

(function() {
  var track = document.querySelector('.hm-clients-track');
  if (!track) return;

  function scrollCards(direction) {
    var step = track.clientWidth * 0.8;
    var nextPos = direction === 'prev' ? track.scrollLeft - step : track.scrollLeft + step;
    if (nextPos >= track.scrollWidth - track.clientWidth) {
      nextPos = 0;
    }
    if (nextPos < 0) {
      nextPos = track.scrollWidth - track.clientWidth;
    }
    track.scrollTo({ left: nextPos, behavior: 'smooth' });
  }

  var autoId = setInterval(function() { scrollCards('next'); }, 3500);
  track.addEventListener('mouseenter', function() { clearInterval(autoId); });
  track.addEventListener('mouseleave', function() { autoId = setInterval(function() { scrollCards('next'); }, 3500); });
})();

/* ---- Counter Animation ---- */
(function() {
  var counters = document.querySelectorAll('.hm-stat-num');
  if (!counters.length) return;

  var observed = false;
  var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting && !observed) {
        observed = true;
        counters.forEach(function(el) {
          var target = parseInt(el.getAttribute('data-target'), 10);
          var duration = 1800;
          var step = Math.ceil(target / (duration / 16));
          var current = 0;
          var timer = setInterval(function() {
            current += step;
            if (current >= target) { current = target; clearInterval(timer); }
            el.textContent = current;
          }, 16);
        });
      }
    });
  }, { threshold: 0.4 });

  var statsSection = document.querySelector('.hm-stats-section');
  if (statsSection) observer.observe(statsSection);
})();

(function() {
  var section = document.querySelector('.hm-expertise-section');
  if (!section) return;
  var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        section.classList.add('is-visible');
        observer.unobserve(section);
      }
    });
  }, { threshold: 0.2 });
  observer.observe(section);
})();

/* ---- Services Reveal ---- */
(function() {
  var section = document.querySelector('.hm-services-section');
  if (!section) return;
  var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        section.classList.add('is-visible');
        observer.unobserve(section);
      }
    });
  }, { threshold: 0.15 });
  observer.observe(section);
})();

(function initCertSlider() {
  function start() {
    var track = document.querySelector(".hm-cert-track");
    var viewport = document.querySelector(".hm-cert-viewport");
    var dotsWrap = document.querySelector(".hm-cert-dots");
    var prevBtn = document.querySelector(".hm-cert-prev");
    var nextBtn = document.querySelector(".hm-cert-next");
    var slider = document.querySelector(".hm-cert-slider");

    if (!track || !viewport) return;
    if (track.dataset.certInitialized === "true") return;
    track.dataset.certInitialized = "true";

    var originalCards = Array.from(track.querySelectorAll(".hm-cert-card"));
    var N = originalCards.length;
    if (N === 0) return;

    // Clone all original cards before and after for true infinite sliding
    var firstOriginal = originalCards[0];
    originalCards.forEach(function (card) {
      var clone = card.cloneNode(true);
      clone.setAttribute("aria-hidden", "true");
      clone.classList.add("hm-cert-clone");
      track.insertBefore(clone, firstOriginal);
    });

    originalCards.forEach(function (card) {
      var clone = card.cloneNode(true);
      clone.setAttribute("aria-hidden", "true");
      clone.classList.add("hm-cert-clone");
      track.appendChild(clone);
    });

    // Track now has 3*N cards: [c0..c(N-1), o0..o(N-1), a0..a(N-1)]
    // Initial current index is N (pointing to the original set)
    var current = N;
    var isMoving = false;
    var timer = null;
    var unlockTimeout = null;

    function getStep() {
      var allCards = track.querySelectorAll(".hm-cert-card");
      if (allCards.length >= 2) {
        var diff = allCards[1].offsetLeft - allCards[0].offsetLeft;
        if (diff > 0) return diff;
      }
      var first = allCards[0];
      if (first && first.offsetWidth > 0) {
        var gap = parseFloat(window.getComputedStyle(track).gap) || 24;
        return first.offsetWidth + gap;
      }
      return viewport.clientWidth > 0 ? ((viewport.clientWidth + 24) / 3) : 380;
    }

    function setPosition(index, animate) {
      if (animate) {
        track.style.transition = "transform 0.65s cubic-bezier(0.25, 1, 0.5, 1)";
      } else {
        track.style.transition = "none";
      }
      var step = getStep();
      track.style.transform = "translateX(-" + (index * step) + "px)";
    }

    function getActiveDotIndex(idx) {
      return ((idx - N) % N + N) % N;
    }

    function updateDots() {
      if (!dotsWrap) return;
      var activeIdx = getActiveDotIndex(current);
      Array.from(dotsWrap.children).forEach(function (dot, i) {
        dot.classList.toggle("active", i === activeIdx);
      });
    }

    function renderDots() {
      if (!dotsWrap) return;
      dotsWrap.innerHTML = "";
      for (var i = 0; i < N; i++) {
        var dot = document.createElement("button");
        dot.type = "button";
        dot.className = "hm-cert-dot" + (i === 0 ? " active" : "");
        dot.setAttribute("aria-label", "Show certificate " + (i + 1));
        dot.dataset.index = i;
        dot.addEventListener("click", function () {
          if (isMoving) return;
          var target = Number(this.dataset.index);
          current = N + target;
          isMoving = true;
          setPosition(current, true);
          updateDots();
          restartAutoplay();
        });
        dotsWrap.appendChild(dot);
      }
    }

    function slideNext() {
      if (isMoving) return;
      isMoving = true;
      current++;
      setPosition(current, true);
      updateDots();

      clearTimeout(unlockTimeout);
      unlockTimeout = setTimeout(function () {
        if (isMoving) handleLoopReset();
      }, 700);
    }

    function slidePrev() {
      if (isMoving) return;
      isMoving = true;
      current--;
      setPosition(current, true);
      updateDots();

      clearTimeout(unlockTimeout);
      unlockTimeout = setTimeout(function () {
        if (isMoving) handleLoopReset();
      }, 700);
    }

    function handleLoopReset() {
      isMoving = false;
      clearTimeout(unlockTimeout);
      if (current >= 2 * N) {
        current = current - N;
        setPosition(current, false);
        void track.offsetHeight;
      } else if (current < N) {
        current = current + N;
        setPosition(current, false);
        void track.offsetHeight;
      }
      updateDots();
    }

    track.addEventListener("transitionend", function (e) {
      if (e.target !== track || e.propertyName !== "transform") return;
      handleLoopReset();
    });

    if (nextBtn) {
      nextBtn.addEventListener("click", function () {
        slideNext();
        restartAutoplay();
      });
    }

    if (prevBtn) {
      prevBtn.addEventListener("click", function () {
        slidePrev();
        restartAutoplay();
      });
    }

    function restartAutoplay() {
      clearInterval(timer);
      timer = setInterval(slideNext, 2500);
    }

    function pauseAutoplay() {
      clearInterval(timer);
    }

    if (slider) {
      slider.addEventListener("mouseenter", pauseAutoplay);
      slider.addEventListener("mouseleave", restartAutoplay);
    }

    // Touch Swipe
    var touchStartX = 0;
    var touchStartY = 0;
    viewport.addEventListener("touchstart", function (e) {
      pauseAutoplay();
      if (e.touches.length === 1) {
        touchStartX = e.touches[0].clientX;
        touchStartY = e.touches[0].clientY;
      }
    }, { passive: true });

    viewport.addEventListener("touchend", function (e) {
      if (e.changedTouches.length === 1) {
        var diffX = touchStartX - e.changedTouches[0].clientX;
        var diffY = touchStartY - e.changedTouches[0].clientY;
        if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 40) {
          if (diffX > 0) {
            slideNext();
          } else {
            slidePrev();
          }
        }
      }
      restartAutoplay();
    }, { passive: true });

    document.addEventListener("visibilitychange", function () {
      if (document.hidden) {
        pauseAutoplay();
      } else {
        restartAutoplay();
      }
    });

    window.addEventListener("resize", function () {
      setPosition(current, false);
    });

    window.addEventListener("load", function () {
      setPosition(current, false);
    });

    renderDots();
    setPosition(current, false);
    restartAutoplay();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", start);
  } else {
    start();
  }
})();

(function initTestimonialSlider() {
  function start() {
    var track = document.getElementById("hmTsTrack");
    var thumbs = document.querySelectorAll(".hm-ts-thumb");
    var cards = track ? Array.from(track.querySelectorAll(".hm-ts-card")) : [];
    var slider = document.querySelector(".hm-ts-slider");
    if (!track || !cards.length || !thumbs.length || !slider) return;
    if (track.dataset.tsInitialized === "true") return;
    track.dataset.tsInitialized = "true";

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

    window.addEventListener("resize", function() {
      moveSlide(current, false);
    });

    // Initial call
    moveSlide(1, false);

    // Auto-play
    setInterval(function() {
      if (!isTransitioning) moveSlide(current + 1);
    }, 6000);
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", start);
  } else {
    start();
  }
})();
</script>
@endpush