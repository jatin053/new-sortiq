@extends('layouts.frontend')

@section('title', 'Support | Sortiq Solutions')
@section('body_attributes') data-route="/support" @endsection

@push('head')
<style>
  /* ==========================================================================
     SUPPORT PAGE CUSTOM STYLING (Unminified & Easy to Customize)
     ========================================================================== */

  /* --- Main Container & Base Typography --- */
  .support-page-container {
    background-color: #ffffff;
    color: #333333;
    min-height: 100vh;
    box-sizing: border-box;
    /* You can set your custom font family here: */
    font-family: "Nunito", "Roboto", "Poppins", sans-serif;
  }

  .support-page-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    padding: 60px 24px 80px;
    box-sizing: border-box;
  }

  /* --- Heading Section --- */
  .support-heading-section {
    text-align: center;
    margin-bottom: 60px;
  }

  .support-title {
    font-size: 32px;
    font-weight: 800;
    color: #001a3d;
    letter-spacing: -0.02em;
    margin: 0 0 16px;
    text-transform: uppercase;
  }

  .support-title .highlight {
    color: #2563eb;
  }

  .support-title-bar {
    width: 48px;
    height: 4px;
    background-color: #2563eb;
    margin: 0 auto;
    border-radius: 2px;
  }

  /* --- FAQ Categories Layout (2x2 Grid) --- */
  .support-faq-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    column-gap: 60px;
    row-gap: 50px;
    margin-bottom: 80px;
  }

  @media (max-width: 768px) {
    .support-faq-grid {
      grid-template-columns: 1fr;
      row-gap: 40px;
    }
  }

  .faq-category {
    display: flex;
    flex-direction: column;
  }

  .faq-category-title {
    font-size: 20px;
    font-weight: 800;
    color: #1e293b;
    margin: 0 0 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f1f5f9;
  }

  .faq-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  /* --- Rectangular FAQ Cards (Matches attached image) --- */
  .faq-item {
    background-color: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    transition: border-color 0.25s ease, box-shadow 0.25s ease;
  }

  .faq-item:hover {
    border-color: #2563eb;
    box-shadow: 0 3px 6px rgba(37, 99, 235, 0.05);
  }

  .faq-trigger {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: transparent;
    border: none;
    padding: 16px 20px;
    margin: 0;
    text-align: left;
    cursor: pointer;
    outline: none;
    transition: color 0.25s ease;
  }

  .faq-question {
    font-size: 15px;
    font-weight: 700;
    color: #1e293b;
    line-height: 1.4;
    padding-right: 16px;
    transition: color 0.25s ease;
  }

  .faq-trigger:hover .faq-question {
    color: #2563eb;
  }

  .faq-arrow {
    color: #94a3b8;
    flex-shrink: 0;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), color 0.25s ease;
  }

  .faq-trigger:hover .faq-arrow {
    color: #2563eb;
  }

  /* Arrow rotation handled by main.js triggers */
  .faq-trigger[aria-expanded="true"] .faq-arrow {
    transform: rotate(180deg);
    color: #ff6600; /* Main accordion active color */
  }

  .faq-answer {
    padding: 0 20px 20px;
    font-size: 14.5px;
    line-height: 1.6;
    color: #64748b;
    box-sizing: border-box;
  }

  /* Fade-in Animation for FAQ Answer */
  @keyframes faqFadeIn {
    from {
      opacity: 0;
      transform: translateY(-6px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-fadeIn {
    animation: faqFadeIn 0.35s cubic-bezier(0.4, 0, 0.2, 1) !important;
  }

  /* --- "ASK A QUESTION" Form Container --- */
  .ask-form-container {
    max-width: 760px;
    margin: 0 auto;
    background-color: #f8fafc;
    padding: 48px;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
    box-sizing: border-box;
  }

  @media (max-width: 640px) {
    .ask-form-container {
      padding: 30px 20px;
    }
  }

  .ask-form-header {
    text-align: center;
    margin-bottom: 36px;
  }

  .ask-form-subtitle {
    font-size: 12px;
    font-weight: 800;
    color: #2563eb;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    display: block;
    margin-bottom: 8px;
  }

  .ask-form-title {
    font-size: 28px;
    font-weight: 800;
    color: #0f172a;
    text-transform: uppercase;
    margin: 0;
    letter-spacing: -0.01em;
  }

  .ask-form-title .highlight {
    color: #2563eb;
  }

  .ask-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .ask-form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
  }

  @media (max-width: 640px) {
    .ask-form-row {
      grid-template-columns: 1fr;
      gap: 20px;
    }
  }

  .ask-form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .ask-form-label {
    font-size: 12px;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  .ask-form-input,
  .ask-form-textarea {
    width: 100%;
    box-sizing: border-box;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 15px;
    color: #1e293b;
    background-color: #ffffff;
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }

  .ask-form-input {
    height: 48px;
  }

  .ask-form-textarea {
    min-height: 140px;
    resize: vertical;
    font-family: inherit;
  }

  .ask-form-input:focus,
  .ask-form-textarea:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
  }

  .ask-form-recaptcha {
    margin: 12px 0;
    display: flex;
    justify-content: flex-start;
  }

  @media (max-width: 640px) {
    .ask-form-recaptcha {
      justify-content: center;
      overflow-x: auto;
    }
  }

  .ask-form-submit-panel {
    text-align: left;
  }

  @media (max-width: 640px) {
    .ask-form-submit-panel {
      text-align: center;
    }
  }

  .ask-form-submit-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 48px;
    padding: 0 40px;
    border: none;
    border-radius: 999px;
    background-color: #ff6600;
    color: #ffffff !important;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(255, 102, 0, 0.25);
    transition: all 0.25s ease;
    outline: none;
  }

  .ask-form-submit-btn:hover {
    background-color: #001b43;
    color: #ffffff !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(0, 27, 67, 0.3);
  }

  /* ==========================================================================
     CUSTOM TESTIMONIAL SLIDER STYLES
     ========================================================================== */
  .support-testimonials-section {
    margin-top: 100px;
    text-align: center;
    width: 100%;
    box-sizing: border-box;
  }

  .testimonial-section-head {
    margin-bottom: 50px;
  }

  .testimonial-section-subtitle {
    font-size: 13px;
    font-weight: 700;
    color: #2563eb;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    display: block;
    margin-bottom: 8px;
  }

  .testimonial-section-title {
    font-size: 32px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
  }

  .testimonial-section-line {
    width: 48px;
    height: 4px;
    background-color: #2563eb;
    margin: 16px auto 0;
    border-radius: 2px;
  }

  .sup-ts-slider {
    position: relative;
    max-width: 900px;
    margin: 0 auto;
    overflow: hidden;
    padding: 10px 0;
    box-sizing: border-box;
  }

  .sup-ts-track {
    display: flex;
    transition: transform 0.85s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .sup-ts-card {
    flex: 0 0 100%;
    width: 100%;
    padding: 0 24px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }

  .sup-ts-quote-icon {
    font-size: 120px;
    font-family: Georgia, serif;
    color: #f1f5f9;
    line-height: 0.6;
    margin-bottom: -15px;
    user-select: none;
  }

  .sup-ts-quote {
    font-size: 19px;
    font-weight: 400;
    line-height: 1.74;
    color: #475569;
    margin: 0 0 35px;
    max-width: 800px;
    text-align: center;
    font-style: italic;
  }

  .sup-ts-dots-container {
    margin-top: 30px;
    display: flex;
    justify-content: center;
    width: 100%;
  }

  .sup-ts-dots {
    display: flex;
    gap: 40px;
    align-items: center;
    justify-content: center;
  }

  .sup-ts-thumb {
    display: flex;
    flex-direction: column;
    align-items: center;
    background: transparent;
    border: none;
    cursor: pointer;
    outline: none;
    transition: all 0.3s ease;
    opacity: 0.35;
    filter: blur(1px);
    width: 160px;
  }

  .sup-ts-thumb.active {
    opacity: 1;
    filter: blur(0);
    transform: scale(1.08);
  }

  .sup-ts-avatar {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 12px;
    border: 2px solid #e2e8f0;
    transition: border-color 0.3s ease;
  }

  .sup-ts-thumb.active .sup-ts-avatar {
    border-color: #2563eb;
  }

  .sup-ts-name {
    font-size: 15px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 2px;
    transition: color 0.3s ease;
  }

  .sup-ts-thumb.active .sup-ts-name {
    color: #2563eb;
  }

  .sup-ts-role {
    font-size: 12px;
    color: #64748b;
  }
</style>
@endpush

@section('content')
@php
  // Custom Editable Testimonials Array (Matches your specified quotes and roles perfectly)
  $customTestimonials = [
    [
      'quote' => 'We work systematically to integrated corporate responsibility in our corein business and make',
      'author' => 'Sir Pobon',
      'role' => 'CEO, Pranklin Agency',
      'image' => 'img1.jpg'
    ],
    [
      'quote' => 'We work systematically to integrated corporate responsibility in our corein business and make our expertise available for the benefit We work systematically to integrated corporate responsibility in our corein business',
      'author' => 'Sir Pobon',
      'role' => 'Finance Head',
      'image' => 'img2.jpg'
    ],
    [
      'quote' => 'We work systematically to integrated corporate responsibility in our corein business and make our expertise available for the benefit',
      'author' => 'Sir Pobon',
      'role' => 'Finance Head',
      'image' => 'img3.jpg'
    ],
    [
      'quote' => 'We work systematically to integrated corporate responsibility in our corein business and make our expertise available for the benefit',
      'author' => 'Sir Pobon',
      'role' => 'CEO, Pranklin Agency',
      'image' => 'img4.jpg'
    ],
    [
      'quote' => 'We work systematically to integrated corporate responsibility',
      'author' => 'Sir Pobon',
      'role' => 'CEO, Pranklin Agency',
      'image' => 'img5.jpg'
    ],
    [
      'quote' => 'We work systematically to integrated corporate responsibility in our corein business and make',
      'author' => 'Sir Pobon',
      'role' => 'CEO, Pranklin Agency',
      'image' => 'img6.jpg'
    ],
    [
      'quote' => 'We work systematically to integrated corporate responsibility in our corein business and make our expertise available for the benefit We work systematically to integrated corporate responsibility in our corein business',
      'author' => 'Sir Pobon',
      'role' => 'Finance Head',
      'image' => 'img1.jpg'
    ]
  ];
@endphp

<main class="support-page-container">
  <div class="support-page-wrapper">
    
    <!-- Heading Section -->
    <div class="support-heading-section">
      <h1 class="support-title">
        GENERAL <span class="highlight">QUESTION</span>
      </h1>
      <div class="support-title-bar"></div>
    </div>

    <!-- FAQ Categories Grid -->
    <div class="support-faq-grid">
      
      <!-- Category 1: Shared Hosting -->
      <div class="faq-category">
        <h3 class="faq-category-title">Shared Hosting</h3>
        <div class="faq-list">
          
          <div class="faq-item">
            <button type="button" data-faq-button="support-panel-0-0" aria-expanded="false" class="faq-trigger">
              <span class="faq-question">Do you offer managed hosting?</span>
              <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="faq-arrow"></iconify-icon>
            </button>
            <div id="support-panel-0-0" class="faq-panel faq-answer animate-fadeIn" hidden>
              No, its completely unmanaged – if you experience issues with your server, you can reach out to our support team.
            </div>
          </div>

          <div class="faq-item">
            <button type="button" data-faq-button="support-panel-0-1" aria-expanded="false" class="faq-trigger">
              <span class="faq-question">How to buy a domain in cheap price?</span>
              <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="faq-arrow"></iconify-icon>
            </button>
            <div id="support-panel-0-1" class="faq-panel faq-answer animate-fadeIn" hidden>
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod brunch
            </div>
          </div>

          <div class="faq-item">
            <button type="button" data-faq-button="support-panel-0-2" aria-expanded="false" class="faq-trigger">
              <span class="faq-question">How do I set up a URL redirect for a domain?</span>
              <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="faq-arrow"></iconify-icon>
            </button>
            <div id="support-panel-0-2" class="faq-panel faq-answer animate-fadeIn" hidden>
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod brunch
            </div>
          </div>

          <div class="faq-item">
            <button type="button" data-faq-button="support-panel-0-3" aria-expanded="false" class="faq-trigger">
              <span class="faq-question">How can I change the nameservers for my domain?</span>
              <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="faq-arrow"></iconify-icon>
            </button>
            <div id="support-panel-0-3" class="faq-panel faq-answer animate-fadeIn" hidden>
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod brunch
            </div>
          </div>

          <div class="faq-item">
            <button type="button" data-faq-button="support-panel-0-4" aria-expanded="false" class="faq-trigger">
              <span class="faq-question">How do I generate a CSR code?</span>
              <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="faq-arrow"></iconify-icon>
            </button>
            <div id="support-panel-0-4" class="faq-panel faq-answer animate-fadeIn" hidden>
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod brunch. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin.
            </div>
          </div>

        </div>
      </div>

      <!-- Category 2: Dedicated Hosting -->
      <div class="faq-category">
        <h3 class="faq-category-title">Dedicated Hosting</h3>
        <div class="faq-list">

          <div class="faq-item">
            <button type="button" data-faq-button="support-panel-1-0" aria-expanded="false" class="faq-trigger">
              <span class="faq-question">How to set up Free Email Forwarding</span>
              <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="faq-arrow"></iconify-icon>
            </button>
            <div id="support-panel-1-0" class="faq-panel faq-answer animate-fadeIn" hidden>
              No, its completely unmanaged – if you experience issues with your server, you can reach out to our support team.
            </div>
          </div>

          <div class="faq-item">
            <button type="button" data-faq-button="support-panel-1-1" aria-expanded="false" class="faq-trigger">
              <span class="faq-question">How do I transfer a domain?</span>
              <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="faq-arrow"></iconify-icon>
            </button>
            <div id="support-panel-1-1" class="faq-panel faq-answer animate-fadeIn" hidden>
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod brunch
            </div>
          </div>

          <div class="faq-item">
            <button type="button" data-faq-button="support-panel-1-2" aria-expanded="false" class="faq-trigger">
              <span class="faq-question">How to transfer an existing hosting account?</span>
              <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="faq-arrow"></iconify-icon>
            </button>
            <div id="support-panel-1-2" class="faq-panel faq-answer animate-fadeIn" hidden>
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod brunch
            </div>
          </div>

          <div class="faq-item">
            <button type="button" data-faq-button="support-panel-1-3" aria-expanded="false" class="faq-trigger">
              <span class="faq-question">How do I renew my domain?</span>
              <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="faq-arrow"></iconify-icon>
            </button>
            <div id="support-panel-1-3" class="faq-panel faq-answer animate-fadeIn" hidden>
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod brunch
            </div>
          </div>

          <div class="faq-item">
            <button type="button" data-faq-button="support-panel-1-4" aria-expanded="false" class="faq-trigger">
              <span class="faq-question">How does WhoisGuard work for keep secure?</span>
              <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="faq-arrow"></iconify-icon>
            </button>
            <div id="support-panel-1-4" class="faq-panel faq-answer animate-fadeIn" hidden>
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod brunch. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin.
            </div>
          </div>

        </div>
      </div>

      <!-- Category 3: Dedicated Hosting (2nd Block) -->
      <div class="faq-category">
        <h3 class="faq-category-title">Dedicated Hosting</h3>
        <div class="faq-list">

          <div class="faq-item">
            <button type="button" data-faq-button="support-panel-2-0" aria-expanded="false" class="faq-trigger">
              <span class="faq-question">How to set up Free Email Forwarding</span>
              <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="faq-arrow"></iconify-icon>
            </button>
            <div id="support-panel-2-0" class="faq-panel faq-answer animate-fadeIn" hidden>
              No, its completely unmanaged – if you experience issues with your server, you can reach out to our support team.
            </div>
          </div>

          <div class="faq-item">
            <button type="button" data-faq-button="support-panel-2-1" aria-expanded="false" class="faq-trigger">
              <span class="faq-question">How do I transfer a domain?</span>
              <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="faq-arrow"></iconify-icon>
            </button>
            <div id="support-panel-2-1" class="faq-panel faq-answer animate-fadeIn" hidden>
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod brunch
            </div>
          </div>

          <div class="faq-item">
            <button type="button" data-faq-button="support-panel-2-2" aria-expanded="false" class="faq-trigger">
              <span class="faq-question">How to transfer an existing hosting account?</span>
              <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="faq-arrow"></iconify-icon>
            </button>
            <div id="support-panel-2-2" class="faq-panel faq-answer animate-fadeIn" hidden>
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod brunch
            </div>
          </div>

          <div class="faq-item">
            <button type="button" data-faq-button="support-panel-2-3" aria-expanded="false" class="faq-trigger">
              <span class="faq-question">How do I renew my domain?</span>
              <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="faq-arrow"></iconify-icon>
            </button>
            <div id="support-panel-2-3" class="faq-panel faq-answer animate-fadeIn" hidden>
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod brunch
            </div>
          </div>

          <div class="faq-item">
            <button type="button" data-faq-button="support-panel-2-4" aria-expanded="false" class="faq-trigger">
              <span class="faq-question">How does WhoisGuard work for keep secure?</span>
              <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="faq-arrow"></iconify-icon>
            </button>
            <div id="support-panel-2-4" class="faq-panel faq-answer animate-fadeIn" hidden>
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod brunch. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin.
            </div>
          </div>

        </div>
      </div>

      <!-- Category 4: VPS Hosting -->
      <div class="faq-category">
        <h3 class="faq-category-title">VPS Hosting</h3>
        <div class="faq-list">

          <div class="faq-item">
            <button type="button" data-faq-button="support-panel-3-0" aria-expanded="false" class="faq-trigger">
              <span class="faq-question">How to set up Free Email Forwarding</span>
              <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="faq-arrow"></iconify-icon>
            </button>
            <div id="support-panel-3-0" class="faq-panel faq-answer animate-fadeIn" hidden>
              No, its completely unmanaged – if you experience issues with your server, you can reach out to our support team.
            </div>
          </div>

          <div class="faq-item">
            <button type="button" data-faq-button="support-panel-3-1" aria-expanded="false" class="faq-trigger">
              <span class="faq-question">How do I transfer a domain?</span>
              <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="faq-arrow"></iconify-icon>
            </button>
            <div id="support-panel-3-1" class="faq-panel faq-answer animate-fadeIn" hidden>
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod brunch
            </div>
          </div>

          <div class="faq-item">
            <button type="button" data-faq-button="support-panel-3-2" aria-expanded="false" class="faq-trigger">
              <span class="faq-question">How to transfer an existing hosting account?</span>
              <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="faq-arrow"></iconify-icon>
            </button>
            <div id="support-panel-3-2" class="faq-panel faq-answer animate-fadeIn" hidden>
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod brunch
            </div>
          </div>

          <div class="faq-item">
            <button type="button" data-faq-button="support-panel-3-3" aria-expanded="false" class="faq-trigger">
              <span class="faq-question">How do I renew my domain?</span>
              <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="faq-arrow"></iconify-icon>
            </button>
            <div id="support-panel-3-3" class="faq-panel faq-answer animate-fadeIn" hidden>
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod brunch
            </div>
          </div>

          <div class="faq-item">
            <button type="button" data-faq-button="support-panel-3-4" aria-expanded="false" class="faq-trigger">
              <span class="faq-question">How does WhoisGuard work for keep secure?</span>
              <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="faq-arrow"></iconify-icon>
            </button>
            <div id="support-panel-3-4" class="faq-panel faq-answer animate-fadeIn" hidden>
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod brunch. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin.
            </div>
          </div>

        </div>
      </div>

    </div>

    <!-- "ASK A QUESTION" Form Container -->
    <div class="ask-form-container">
      <div class="ask-form-header">
        <span class="ask-form-subtitle">Have question?</span>
        <h2 class="ask-form-title">
          ASK <span class="highlight">A QUESTION</span>
        </h2>
      </div>

      <form class="ask-form sortiq-contact-form" method="post" action="{{ route('api.contact-messages.store') }}">
        @csrf
        <input type="hidden" name="type" value="support">
        <input type="hidden" name="url" value="{{ url()->current() }}">
        <div class="ask-form-row">
          <div class="ask-form-group">
            <label class="ask-form-label">Your name</label>
            <input name="name" type="text" placeholder="Enter Name" required class="ask-form-input">
          </div>

          <div class="ask-form-group">
            <label class="ask-form-label">Your email</label>
            <input name="email" type="email" placeholder="Enter Email" required class="ask-form-input">
          </div>
        </div>

        <div class="ask-form-group">
          <label class="ask-form-label">Subject</label>
          <input name="subject" type="text" required class="ask-form-input">
        </div>

        <div class="ask-form-group">
          <label class="ask-form-label">Your message (optional)</label>
          <textarea name="message" placeholder="How can we help?" class="ask-form-textarea"></textarea>
        </div>

        <div class="ask-form-recaptcha">
          @include('components.recaptcha')
        </div>

        <div class="ask-form-submit-panel">
          <button type="submit" class="ask-form-submit-btn">
            Submit Question
          </button>
        </div>
      </form>
    </div>

    <!-- Custom Static Testimonials Section -->
    <section class="support-testimonials-section">
      <div class="testimonial-section-head">
        <span class="testimonial-section-subtitle">Client’s love</span>
        <h2 class="testimonial-section-title">Love from Clients</h2>
        <div class="testimonial-section-line"></div>
      </div>

      <div class="sup-ts-slider">
        <div class="sup-ts-track" id="supTsTrack">
          @foreach($customTestimonials as $testimonial)
            <div class="sup-ts-card">
              <span class="sup-ts-quote-icon">&ldquo;</span>
              <p class="sup-ts-quote">
                {{ $testimonial['quote'] }}
              </p>
            </div>
          @endforeach
        </div>
      </div>

      <!-- Clients Bottom Navigator Stack -->
      <div class="sup-ts-dots-container">
        <div class="sup-ts-dots" id="supTsDots">
          @foreach($customTestimonials as $index => $testimonial)
            <button class="sup-ts-thumb {{ $index === 0 ? 'active' : '' }}">
              <img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2024/12/img' . (($index % 6) + 1) . '.jpg') }}" class="sup-ts-avatar" alt="{{ $testimonial['author'] }}">
              <span class="sup-ts-name">{{ $testimonial['author'] }}</span>
              <span class="sup-ts-role">{{ $testimonial['role'] }}</span>
            </button>
          @endforeach
        </div>
      </div>
    </section>

  </div>
</main>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
  var track = document.getElementById("supTsTrack");
  var thumbsContainer = document.getElementById("supTsDots");
  var thumbs = thumbsContainer ? thumbsContainer.querySelectorAll(".sup-ts-thumb") : [];
  var cards = track ? Array.from(track.querySelectorAll(".sup-ts-card")) : [];
  var slider = document.querySelector(".sup-ts-slider");
  if (!track || !cards.length || !thumbs.length || !slider) return;

  var total = cards.length;
  var current = 0;
  var isTransitioning = false;

  function moveSlide(index) {
    current = index;
    var translateX = -current * 100;
    track.style.transform = "translateX(" + translateX + "%)";

    thumbs.forEach(function(thumb, idx) {
      var isCenter = (idx === current);
      var isPrev = (idx === (current - 1 + total) % total);
      var isNext = (idx === (current + 1) % total);
      
      thumb.classList.toggle("active", isCenter);
      
      if (isCenter || isPrev || isNext) {
        thumb.style.display = "flex";
        thumb.style.opacity = isCenter ? "1" : "0.35";
        thumb.style.filter = isCenter ? "blur(0)" : "blur(1px)";
        
        if (isPrev) thumb.style.order = "1";
        if (isCenter) thumb.style.order = "2";
        if (isNext) thumb.style.order = "3";
      } else {
        thumb.style.display = "none";
      }
    });

    if (thumbsContainer) {
      thumbsContainer.style.justifyContent = "center";
      thumbsContainer.style.width = "auto";
      thumbsContainer.style.margin = "auto";
    }
  }

  thumbs.forEach(function(thumb, idx) {
    thumb.addEventListener("click", function() {
      clearInterval(autoPlay);
      moveSlide(idx);
      autoPlay = setInterval(next, 5500);
    });
  });

  function next() {
    moveSlide((current + 1) % total);
  }

  var autoPlay = setInterval(next, 5500);

  slider.addEventListener("mouseenter", function() {
    clearInterval(autoPlay);
  });

  slider.addEventListener("mouseleave", function() {
    autoPlay = setInterval(next, 5500);
  });

  // Initial display
  moveSlide(0);
});
</script>
@endpush