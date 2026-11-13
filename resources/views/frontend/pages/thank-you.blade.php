@extends('layouts.frontend')

@section('title', 'Thank You | Sortiq Solutions')
@section('body_attributes') data-route="/thank-you" @endsection

@push('head')
<style>
  .thank-you-page {
    background: #ffffff;
    color: #001a3d;
    overflow-x: hidden;
  }

  .thank-you-hero {
    position: relative;
    padding: 70px 20px 40px;
    text-align: center;
    background: 
      radial-gradient(circle at 50% 0%, rgba(255, 102, 0, 0.08) 0%, transparent 60%),
      radial-gradient(circle at 85% 20%, rgba(0, 26, 61, 0.05) 0%, transparent 40%),
      linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
  }

  .thank-you-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 18px;
    border-radius: 9999px;
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.3);
    color: #059669;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    margin-bottom: 20px;
  }

  .thank-you-title {
    font-size: clamp(30px, 4.5vw, 52px);
    font-weight: 900;
    line-height: 1.15;
    color: #001a3d;
    margin: 0 auto 16px;
    max-width: 900px;
    letter-spacing: -0.02em;
  }

  .thank-you-title span {
    color: #ff6600;
  }

  .thank-you-desc {
    font-size: clamp(15px, 1.8vw, 18px);
    color: #475569;
    max-width: 680px;
    margin: 0 auto 30px;
    line-height: 1.7;
    font-weight: 400;
  }

  /* Center Banner Frame */
  .thank-you-banner-wrapper {
    max-width: 1040px;
    margin: 0 auto 55px;
    padding: 0 16px;
  }

  .thank-you-banner-card {
    position: relative;
    border-radius: 24px;
    overflow: hidden;
    background: #00142e;
    box-shadow: 
      0 20px 50px -10px rgba(0, 26, 61, 0.35),
      0 0 0 1px rgba(255, 255, 255, 0.15),
      0 0 35px rgba(255, 102, 0, 0.12);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
  }

  .thank-you-banner-card:hover {
    transform: translateY(-3px);
    box-shadow: 
      0 26px 60px -10px rgba(0, 26, 61, 0.45),
      0 0 0 1px rgba(255, 102, 0, 0.4),
      0 0 45px rgba(255, 102, 0, 0.22);
  }

  .thank-you-banner-img {
    display: block;
    width: 100%;
    height: auto;
    object-fit: cover;
    transition: transform 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
  }

  .thank-you-banner-card:hover .thank-you-banner-img {
    transform: scale(1.02);
  }

  .thank-you-banner-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 55%, rgba(0, 20, 46, 0.85) 100%);
    pointer-events: none;
  }

  .thank-you-banner-footer {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 24px 28px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    color: #ffffff;
    z-index: 2;
  }

  .thank-you-banner-footer h3 {
    margin: 0;
    font-size: clamp(16px, 2.2vw, 22px);
    font-weight: 800;
    letter-spacing: -0.01em;
    color: #ffffff;
  }

  .thank-you-banner-footer p {
    margin: 2px 0 0;
    font-size: 13px;
    color: #ff944d;
    font-weight: 600;
    letter-spacing: 0.05em;
    text-transform: uppercase;
  }

  .thank-you-banner-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.25);
    padding: 8px 16px;
    border-radius: 9999px;
    font-size: 13px;
    font-weight: 600;
    color: #ffffff;
  }

  /* Next Steps Cards */
  .thank-you-steps-section {
    max-width: 1100px;
    margin: 0 auto 60px;
    padding: 0 20px;
  }

  .steps-title {
    text-align: center;
    margin-bottom: 34px;
  }

  .steps-title h2 {
    font-size: 26px;
    font-weight: 800;
    color: #001a3d;
    margin: 0 0 8px;
  }

  .steps-title p {
    font-size: 15px;
    color: #64748b;
    margin: 0;
  }

  .steps-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
  }

  @media (max-width: 860px) {
    .steps-grid {
      grid-template-columns: 1fr;
      gap: 18px;
    }
  }

  .step-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 28px 24px;
    position: relative;
    transition: all 0.3s ease;
  }

  .step-card:hover {
    background: #ffffff;
    border-color: #ff6600;
    transform: translateY(-3px);
    box-shadow: 0 12px 30px -10px rgba(255, 102, 0, 0.2);
  }

  .step-num {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: #001a3d;
    color: #ff6600;
    font-weight: 800;
    font-size: 16px;
    margin-bottom: 16px;
  }

  .step-card:hover .step-num {
    background: #ff6600;
    color: #ffffff;
  }

  .step-card h4 {
    font-size: 18px;
    font-weight: 700;
    color: #001a3d;
    margin: 0 0 8px;
  }

  .step-card p {
    font-size: 14px;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
  }

  /* Actions */
  .thank-you-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    gap: 16px;
    margin-bottom: 75px;
    padding: 0 20px;
  }

  .btn-primary-home {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #ff6600;
    color: #ffffff !important;
    padding: 14px 30px;
    border-radius: 9999px;
    font-weight: 700;
    font-size: 15px;
    box-shadow: 0 10px 22px rgba(255, 102, 0, 0.32);
    transition: all 0.25s ease;
    text-decoration: none;
  }

  .btn-primary-home:hover {
    background: #001a3d;
    transform: translateY(-2px);
    box-shadow: 0 12px 28px rgba(0, 26, 61, 0.35);
  }

  .btn-secondary-services {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #ffffff;
    color: #001a3d !important;
    padding: 13px 28px;
    border-radius: 9999px;
    font-weight: 700;
    font-size: 15px;
    border: 2px solid #001a3d;
    transition: all 0.25s ease;
    text-decoration: none;
  }

  .btn-secondary-services:hover {
    background: #001a3d;
    color: #ffffff !important;
    transform: translateY(-2px);
  }

  .btn-whatsapp-chat {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #25D366;
    color: #ffffff !important;
    padding: 14px 28px;
    border-radius: 9999px;
    font-weight: 700;
    font-size: 15px;
    box-shadow: 0 10px 22px rgba(37, 211, 102, 0.3);
    transition: all 0.25s ease;
    text-decoration: none;
  }

  .btn-whatsapp-chat:hover {
    background: #1eb757;
    transform: translateY(-2px);
    box-shadow: 0 12px 26px rgba(37, 211, 102, 0.4);
  }

  /* Bottom Moving Slider (Marquee Ticker) */
  .moving-slider-section {
    background: linear-gradient(135deg, #001026 0%, #001a3d 50%, #00142e 100%);
    padding: 38px 0;
    overflow: hidden;
    position: relative;
    border-top: 3px solid #ff6600;
    box-shadow: inset 0 8px 20px rgba(0, 0, 0, 0.4);
  }

  .moving-slider-section::before,
  .moving-slider-section::after {
    content: "";
    position: absolute;
    top: 0;
    bottom: 0;
    width: 120px;
    z-index: 5;
    pointer-events: none;
  }

  .moving-slider-section::before {
    left: 0;
    background: linear-gradient(to right, #001026, transparent);
  }

  .moving-slider-section::after {
    right: 0;
    background: linear-gradient(to left, #001026, transparent);
  }

  .marquee-track-wrapper {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .marquee-row {
    display: flex;
    width: max-content;
    white-space: nowrap;
    will-change: transform;
  }

  .marquee-forward {
    animation: marquee-forward-anim 32s linear infinite;
  }

  .marquee-reverse {
    animation: marquee-reverse-anim 36s linear infinite;
  }

  .marquee-row:hover {
    animation-play-state: paused;
  }

  @keyframes marquee-forward-anim {
    0% {
      transform: translate3d(0, 0, 0);
    }
    100% {
      transform: translate3d(-50%, 0, 0);
    }
  }

  @keyframes marquee-reverse-anim {
    0% {
      transform: translate3d(-50%, 0, 0);
    }
    100% {
      transform: translate3d(0, 0, 0);
    }
  }

  .marquee-item {
    display: inline-flex;
    align-items: center;
    gap: 16px;
    padding: 0 20px;
    font-size: clamp(14px, 1.8vw, 17px);
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #ffffff;
    user-select: none;
  }

  .marquee-item.accent {
    color: #ff8833;
  }

  .marquee-item .sep {
    color: #ff6600;
    font-size: 18px;
    opacity: 0.85;
  }

  .marquee-pill {
    background: rgba(255, 102, 0, 0.16);
    border: 1px solid rgba(255, 102, 0, 0.4);
    padding: 4px 14px;
    border-radius: 9999px;
    color: #ff8833;
  }
</style>
@endpush

@section('content')
<main class="thank-you-page font-raleway">
  <!-- Hero Section -->
  <section class="thank-you-hero">
    <div class="thank-you-badge">
      <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-ping"></span>
      Application Received Successfully
    </div>

    <h1 class="thank-you-title">
      Thank You for Connecting with <span>Sortiq Solutions</span>!
    </h1>

    <p class="thank-you-desc">
      We appreciate your interest in our team. Your application has been successfully recorded in our hiring system. Our talent acquisition specialists will review your qualifications and connect with you shortly.
    </p>

    <!-- Centerpiece Image Uploaded by User -->
    <div class="thank-you-banner-wrapper">
      <div class="thank-you-banner-card">
        <img 
          src="{{ asset('frontend-assets/media/thank-you.webp') }}" 
          alt="Thank You - Sortiq Solutions" 
          class="thank-you-banner-img"
          loading="eager"
        >
      </div>
    </div>
  </section>

  <!-- Bottom Moving Slider / Continuous Marquee Ticker -->
  <section class="moving-slider-section" aria-label="Sortiq Core Capabilities">
    <div class="marquee-track-wrapper">
      <!-- Row 1: Forward Direction -->
      <div class="marquee-row marquee-forward">
        <div class="marquee-item"><span class="marquee-pill">Innovation</span></div>
        <div class="marquee-item"> Full-Stack Web Development</div>
        <div class="marquee-item accent"> Cloud Computing & DevOps</div>
        <div class="marquee-item"> Creative UI/UX Design</div>
        <div class="marquee-item"> Data Science & Analytics</div>
        <div class="marquee-item accent"> AI & Machine Learning</div>
        <div class="marquee-item"> Internship Excellence</div>
        <div class="marquee-item"> Career Growth & Mentorship</div>
        <div class="marquee-item accent"> Quality Assurance</div>
        <div class="marquee-item"> Enterprise Software</div>
        <!-- Duplicate for infinite seamless loop -->
        <div class="marquee-item"><span class="marquee-pill">Innovation</span></div>
        <div class="marquee-item"> Full-Stack Web Development</div>
        <div class="marquee-item accent"> Cloud Computing & DevOps</div>
        <div class="marquee-item"> Creative UI/UX Design</div>
        <div class="marquee-item"> Data Science & Analytics</div>
        <div class="marquee-item accent"> AI & Machine Learning</div>
        <div class="marquee-item"> Internship Excellence</div>
        <div class="marquee-item"> Career Growth & Mentorship</div>
        <div class="marquee-item accent"> Quality Assurance</div>
        <div class="marquee-item"> Enterprise Software</div>
      </div>

      <!-- Row 2: Reverse Direction -->
      <div class="marquee-row marquee-reverse">
        <div class="marquee-item"> Collaborative Culture</div>
        <div class="marquee-item accent"> Passion for Technology</div>
        <div class="marquee-item"> Digital Transformation</div>
        <div class="marquee-item"><span class="marquee-pill">Dedication</span></div>
        <div class="marquee-item"> Live Client Projects</div>
        <div class="marquee-item accent"> Technical Leadership</div>
        <div class="marquee-item"> Agile Development</div>
        <div class="marquee-item"> Global Standards</div>
        <div class="marquee-item accent"> Client Satisfaction</div>
        <div class="marquee-item"> Sortiq Solutions Mohali</div>
        <!-- Duplicate for infinite seamless loop -->
        <div class="marquee-item"> Collaborative Culture</div>
        <div class="marquee-item accent"> Passion for Technology</div>
        <div class="marquee-item"> Digital Transformation</div>
        <div class="marquee-item"><span class="marquee-pill">Dedication</span></div>
        <div class="marquee-item"> Live Client Projects</div>
        <div class="marquee-item accent"> Technical Leadership</div>
        <div class="marquee-item"> Agile Development</div>
        <div class="marquee-item"> Global Standards</div>
        <div class="marquee-item accent"> Client Satisfaction</div>
        <div class="marquee-item"> Sortiq Solutions Mohali</div>
      </div>
    </div>
  </section>
</main>
@endsection

