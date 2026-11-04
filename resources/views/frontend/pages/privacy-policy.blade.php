@extends('layouts.frontend')

@section('title', 'Privacy Policy | Sortiq Solutions Pvt. Ltd.')
@section('meta_description', 'Read Sortiq Solutions Privacy Policy to learn how we collect, protect, and handle your personal and business data. Effective Date: May 15, 2026.')
@section('body_attributes') data-route="/privacy-policy" @endsection

@push('head')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Privacy Policy",
  "url": "{{ url('/privacy-policy') }}",
  "description": "Read Sortiq Solutions Privacy Policy to learn how we collect, protect, and handle your personal and business data.",
  "inLanguage": "en",
  "datePublished": "2026-05-15",
  "dateModified": "2026-05-15",
  "publisher": {
    "@type": "Organization",
    "name": "Sortiq Solutions Pvt. Ltd.",
    "url": "https://sortiqsolutions.com",
    "logo": "{{ asset('frontend-assets/media/logo.png') }}"
  },
  "breadcrumb": {
    "@type": "BreadcrumbList",
    "itemListElement": [
      {
        "@type": "ListItem",
        "position": 1,
        "name": "Home",
        "item": "{{ url('/') }}"
      },
      {
        "@type": "ListItem",
        "position": 2,
        "name": "Privacy Policy",
        "item": "{{ url('/privacy-policy') }}"
      }
    ]
  }
}
</script>
<style>
  .sq-privacy-hero {
    position: relative;
    background: linear-gradient(135deg, #00173e 0%, #002d6b 60%, #0a3d82 100%);
    padding: 70px 20px 80px;
    text-align: center;
    color: #ffffff;
    overflow: hidden;
  }
  .sq-privacy-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
    background-size: 24px 24px;
    opacity: 0.6;
    pointer-events: none;
  }
  .sq-privacy-hero-inner {
    position: relative;
    max-width: 900px;
    margin: 0 auto;
    z-index: 2;
  }
  .sq-privacy-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.25);
    padding: 6px 16px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #ffb076;
    margin-bottom: 20px;
  }
  .sq-privacy-hero h1 {
    font-size: 42px;
    font-weight: 900;
    margin: 0 0 12px;
    color: #ffffff;
    letter-spacing: -0.02em;
    line-height: 1.2;
  }
  .sq-privacy-hero p.sq-sub {
    font-size: 18px;
    color: rgba(255, 255, 255, 0.85);
    margin: 0 auto 20px;
    max-width: 650px;
  }
  .sq-privacy-divider {
    width: 70px;
    height: 4px;
    background: #ff6600;
    margin: 0 auto 24px;
    border-radius: 2px;
  }
  .sq-privacy-meta-bar {
    display: inline-flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 16px;
    font-size: 13px;
    color: rgba(255, 255, 255, 0.75);
    background: rgba(0, 0, 0, 0.25);
    padding: 8px 20px;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.1);
  }
  .sq-privacy-meta-bar span {
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  /* Layout Container */
  .sq-privacy-wrap {
    max-width: 1240px;
    margin: 0 auto;
    padding: 60px 20px 90px;
  }
  .sq-privacy-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 40px;
  }
  @media (min-width: 1024px) {
    .sq-privacy-grid {
      grid-template-columns: 320px 1fr;
      align-items: start;
    }
  }

  /* Sidebar */
  .sq-privacy-sidebar {
    position: sticky;
    top: 90px;
    display: flex;
    flex-direction: column;
    gap: 24px;
  }
  .sq-toc-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
  }
  .sq-toc-card h3 {
    font-size: 16px;
    font-weight: 800;
    color: #00173e;
    margin: 0 0 16px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f1f5f9;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }
  .sq-toc-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 8px;
  }
  .sq-toc-link {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13.5px;
    color: #475569;
    text-decoration: none;
    padding: 7px 10px;
    border-radius: 8px;
    transition: all 0.2s ease;
    font-weight: 600;
  }
  .sq-toc-link:hover {
    background: #f1f5f9;
    color: #ff6600;
    transform: translateX(3px);
  }
  .sq-toc-num {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 22px;
    height: 22px;
    background: #f1f5f9;
    color: #00173e;
    font-size: 11px;
    font-weight: 700;
    border-radius: 6px;
  }

  .sq-support-card {
    background: linear-gradient(135deg, #00173e 0%, #002d6b 100%);
    color: #ffffff;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 8px 24px rgba(0, 23, 62, 0.15);
  }
  .sq-support-card h4 {
    font-size: 16px;
    font-weight: 800;
    margin: 0 0 8px;
    color: #ffffff;
  }
  .sq-support-card p {
    font-size: 13px;
    color: rgba(255, 255, 255, 0.8);
    margin: 0 0 16px;
    line-height: 1.5;
  }
  .sq-support-card a.sq-btn-light {
    display: block;
    text-align: center;
    background: #ff6600;
    color: #ffffff;
    font-size: 13px;
    font-weight: 700;
    padding: 10px 16px;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.25s ease;
  }
  .sq-support-card a.sq-btn-light:hover {
    background: #e65c00;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 102, 0, 0.35);
  }

  /* Content Column */
  .sq-privacy-content {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 32px 24px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
  }
  @media (min-width: 768px) {
    .sq-privacy-content {
      padding: 48px 44px;
    }
  }

  /* Intro Box */
  .sq-intro-box {
    background: #f8fafc;
    border-left: 4px solid #ff6600;
    border-radius: 0 12px 12px 0;
    padding: 24px 28px;
    margin-bottom: 40px;
  }
  .sq-intro-box p {
    font-size: 15px;
    line-height: 1.75;
    color: #334155;
    margin: 0 0 12px;
  }
  .sq-intro-box p:last-child {
    margin-bottom: 0;
  }

  /* Section Styling */
  .sq-policy-section {
    padding-top: 36px;
    margin-top: 36px;
    border-top: 1px solid #f1f5f9;
  }
  .sq-policy-section:first-of-type {
    padding-top: 0;
    margin-top: 0;
    border-top: none;
  }
  .sq-policy-section h2 {
    font-size: 22px;
    font-weight: 800;
    color: #00173e;
    margin: 0 0 8px;
    line-height: 1.35;
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .sq-section-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #e0f2fe;
    color: #0284c7;
    font-size: 13px;
    font-weight: 800;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    flex-shrink: 0;
  }
  .sq-sec-lead {
    font-size: 15px;
    color: #475569;
    margin: 8px 0 20px;
    line-height: 1.65;
  }

  /* Cards Grid */
  .sq-collect-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 18px;
    margin-top: 20px;
  }
  @media (min-width: 640px) {
    .sq-collect-grid {
      grid-template-columns: repeat(3, 1fr);
    }
  }
  .sq-collect-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 20px;
    transition: all 0.25s ease;
  }
  .sq-collect-card:hover {
    border-color: #cbd5e1;
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05);
  }
  .sq-collect-card h3 {
    font-size: 15px;
    font-weight: 700;
    color: #00173e;
    margin: 0 0 12px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .sq-collect-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 8px;
  }
  .sq-collect-list li {
    font-size: 13px;
    color: #64748b;
    position: relative;
    padding-left: 16px;
    line-height: 1.5;
  }
  .sq-collect-list li::before {
    content: '•';
    position: absolute;
    left: 4px;
    color: #ff6600;
    font-size: 16px;
    line-height: 1;
  }

  /* Checkmark Lists */
  .sq-check-list {
    list-style: none;
    padding: 0;
    margin: 16px 0 0;
    display: grid;
    grid-template-columns: 1fr;
    gap: 12px;
  }
  @media (min-width: 640px) {
    .sq-check-list {
      grid-template-columns: 1fr 1fr;
    }
  }
  .sq-check-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    background: #f8fafc;
    border: 1px solid #f1f5f9;
    padding: 12px 16px;
    border-radius: 10px;
    font-size: 14px;
    color: #334155;
    line-height: 1.5;
  }
  .sq-check-item iconify-icon {
    color: #10b981;
    flex-shrink: 0;
    margin-top: 3px;
  }

  /* Callout Banner */
  .sq-callout-safe {
    background: #ecfdf5;
    border: 1.5px solid #a7f3d0;
    border-radius: 12px;
    padding: 18px 22px;
    margin: 20px 0;
    display: flex;
    align-items: flex-start;
    gap: 14px;
  }
  .sq-callout-safe iconify-icon {
    color: #059669;
    font-size: 24px;
    flex-shrink: 0;
    margin-top: 2px;
  }
  .sq-callout-safe strong {
    display: block;
    font-size: 15px;
    color: #065f46;
    margin-bottom: 4px;
  }
  .sq-callout-safe p {
    font-size: 13.5px;
    color: #047857;
    margin: 0;
    line-height: 1.55;
  }

  /* Rights Grid */
  .sq-rights-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 14px;
    margin-top: 16px;
  }
  @media (min-width: 640px) {
    .sq-rights-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  .sq-right-card {
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 14px 18px;
    background: #ffffff;
  }
  .sq-right-card strong {
    display: block;
    font-size: 14px;
    color: #00173e;
    margin-bottom: 4px;
  }
  .sq-right-card span {
    font-size: 13px;
    color: #64748b;
    line-height: 1.45;
  }

  /* Contact Details Box */
  .sq-contact-box {
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    border-radius: 14px;
    padding: 26px;
    margin-top: 20px;
  }
  .sq-contact-info-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 16px;
    margin-top: 16px;
  }
  @media (min-width: 640px) {
    .sq-contact-info-grid {
      grid-template-columns: 1fr 1fr;
    }
  }
  .sq-contact-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
  }
  .sq-contact-item-icon {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    background: #00173e;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }
  .sq-contact-item-text span {
    display: block;
    font-size: 11.5px;
    text-transform: uppercase;
    font-weight: 700;
    color: #64748b;
    letter-spacing: 0.05em;
  }
  .sq-contact-item-text a,
  .sq-contact-item-text p {
    font-size: 14px;
    font-weight: 600;
    color: #00173e;
    text-decoration: none;
    margin: 2px 0 0;
    line-height: 1.4;
  }
  .sq-contact-item-text a:hover {
    color: #ff6600;
  }
</style>
@endpush

@section('content')
<main class="font-raleway">

  <!-- ======================== HERO SECTION ======================== -->
  <header class="sq-privacy-hero">
    <div class="sq-privacy-hero-inner">
      <div class="sq-privacy-badge">
        <iconify-icon icon="lucide:shield-check" width="15" height="15"></iconify-icon>
        Legal &amp; Privacy Transparency
      </div>
      <h1>Privacy Policy</h1>
      <p class="sq-sub">Sortiq Solutions Pvt. Ltd. &bull; Protecting Your Information &amp; Personal Data</p>
      <div class="sq-privacy-divider"></div>

      <div class="sq-privacy-meta-bar">
        <span><iconify-icon icon="lucide:calendar-days" width="14" height="14"></iconify-icon> Effective Date: May 15, 2026</span>
        <span>&bull;</span>
        <span><iconify-icon icon="lucide:shield" width="14" height="14"></iconify-icon> Compliant with Global Privacy Best Practices</span>
      </div>
    </div>
  </header>

  <!-- ======================== MAIN CONTAINER ======================== -->
  <div class="sq-privacy-wrap">
    <div class="sq-privacy-grid">

      <!-- ======================== STICKY SIDEBAR ======================== -->
      <aside class="sq-privacy-sidebar">
        <!-- Table of Contents -->
        <nav class="sq-toc-card" aria-label="Table of contents">
          <h3>Table of Contents</h3>
          <ul class="sq-toc-list">
            <li><a href="#collect" class="sq-toc-link"><span class="sq-toc-num">1</span> Information We Collect</a></li>
            <li><a href="#use" class="sq-toc-link"><span class="sq-toc-num">2</span> How We Use Information</a></li>
            <li><a href="#cookies" class="sq-toc-link"><span class="sq-toc-num">3</span> Cookies &amp; Tracking</a></li>
            <li><a href="#sharing" class="sq-toc-link"><span class="sq-toc-num">4</span> Information Sharing</a></li>
            <li><a href="#security" class="sq-toc-link"><span class="sq-toc-num">5</span> Data Security</a></li>
            <li><a href="#third-party" class="sq-toc-link"><span class="sq-toc-num">6</span> Third-Party Services</a></li>
            <li><a href="#retention" class="sq-toc-link"><span class="sq-toc-num">7</span> Data Retention</a></li>
            <li><a href="#rights" class="sq-toc-link"><span class="sq-toc-num">8</span> Your Rights</a></li>
            <li><a href="#children" class="sq-toc-link"><span class="sq-toc-num">9</span> Children’s Privacy</a></li>
            <li><a href="#changes" class="sq-toc-link"><span class="sq-toc-num">10</span> Policy Changes</a></li>
            <li><a href="#contact" class="sq-toc-link"><span class="sq-toc-num">11</span> Contact Us</a></li>
          </ul>
        </nav>

        <!-- Quick Summary Box -->
        <div class="sq-support-card">
          <h4>Need Assistance?</h4>
          <p>Have questions about how your personal data is handled or wish to submit a data removal request?</p>
          <a href="mailto:sortiqsolutions@gmail.com" class="sq-btn-light">Contact Privacy Officer</a>
          <div style="margin-top: 14px; text-align: center;">
            <a href="{{ url('/terms/') }}" style="color: rgba(255,255,255,0.75); font-size: 12px; text-decoration: underline;">Read Terms of Service</a>
          </div>
        </div>
      </aside>

      <!-- ======================== CONTENT ARTICLE ======================== -->
      <article class="sq-privacy-content">

        <!-- Introduction Statement -->
        <div class="sq-intro-box">
          <p>
            Welcome to <a href="https://sortiqsolutions.com/" style="color:#00173e; font-weight:700; text-decoration:underline;">Sortiq Solutions Pvt. Ltd.</a> (&ldquo;Company&rdquo;, &ldquo;we&rdquo;, &ldquo;our&rdquo;, or &ldquo;us&rdquo;). We are committed to protecting your privacy and ensuring that your personal information is handled in a safe and responsible manner.
          </p>
          <p>
            This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website <a href="https://sortiqsolutions.com/" style="color:#ff6600; font-weight:600;">https://sortiqsolutions.com</a> and use our IT, software, and digital services.
          </p>
          <p style="font-weight: 600; color: #00173e;">
            By accessing or using our website, you agree to the terms of this Privacy Policy.
          </p>
        </div>

        <!-- 1. Information We Collect -->
        <section id="collect" class="sq-policy-section">
          <h2><span class="sq-section-badge">1</span> Information We Collect</h2>
          <p class="sq-sec-lead">We may collect the following categories of information when you interact with our website, inquire about projects, or utilize our services:</p>

          <div class="sq-collect-grid">
            <div class="sq-collect-card">
              <h3>
                <iconify-icon icon="lucide:user" width="18" height="18" style="color:#ff6600;"></iconify-icon>
                Personal Information
              </h3>
              <p style="font-size:12.5px; color:#64748b; margin:0 0 10px;">Information you voluntarily provide to us, including:</p>
              <ul class="sq-collect-list">
                <li>Full name</li>
                <li>Email address</li>
                <li>Phone number</li>
                <li>Company or business name</li>
                <li>Billing and payment details</li>
                <li>Details submitted via forms, consultations, or job inquiries</li>
              </ul>
            </div>

            <div class="sq-collect-card">
              <h3>
                <iconify-icon icon="lucide:laptop" width="18" height="18" style="color:#0284c7;"></iconify-icon>
                Technical &amp; Usage
              </h3>
              <p style="font-size:12.5px; color:#64748b; margin:0 0 10px;">Automatically collected when browsing, including:</p>
              <ul class="sq-collect-list">
                <li>IP address and geolocation</li>
                <li>Browser type and version</li>
                <li>Device information and screen size</li>
                <li>Operating system</li>
                <li>Referral URLs and landing pages</li>
                <li>Session duration, clicks, and analytics data</li>
                <li>Cookies and tracking tags</li>
              </ul>
            </div>

            <div class="sq-collect-card">
              <h3>
                <iconify-icon icon="lucide:folder-git-2" width="18" height="18" style="color:#10b981;"></iconify-icon>
                Project-Related
              </h3>
              <p style="font-size:12.5px; color:#64748b; margin:0 0 10px;">Collected during contract execution, including:</p>
              <ul class="sq-collect-list">
                <li>Website credentials and server/hosting logins</li>
                <li>Design assets, branding files, and mockups</li>
                <li>Business requirements and technical documentation</li>
                <li>Content and copy provided for development or marketing</li>
              </ul>
            </div>
          </div>
        </section>

        <!-- 2. How We Use Your Information -->
        <section id="use" class="sq-policy-section">
          <h2><span class="sq-section-badge">2</span> How We Use Your Information</h2>
          <p class="sq-sec-lead">We use collected information exclusively for legitimate and lawful business purposes, including:</p>

          <div class="sq-check-list">
            <div class="sq-check-item">
              <iconify-icon icon="lucide:check-circle-2" width="18" height="18"></iconify-icon>
              <span>Providing web development, mobile apps, software, and digital marketing services</span>
            </div>
            <div class="sq-check-item">
              <iconify-icon icon="lucide:check-circle-2" width="18" height="18"></iconify-icon>
              <span>Responding promptly to contact inquiries, proposals, and support tickets</span>
            </div>
            <div class="sq-check-item">
              <iconify-icon icon="lucide:check-circle-2" width="18" height="18"></iconify-icon>
              <span>Managing ongoing client milestones, contracts, and deliverable communications</span>
            </div>
            <div class="sq-check-item">
              <iconify-icon icon="lucide:check-circle-2" width="18" height="18"></iconify-icon>
              <span>Processing verified invoices, statements, and payment transactions</span>
            </div>
            <div class="sq-check-item">
              <iconify-icon icon="lucide:check-circle-2" width="18" height="18"></iconify-icon>
              <span>Improving website performance, page loading speeds, and overall user experience</span>
            </div>
            <div class="sq-check-item">
              <iconify-icon icon="lucide:check-circle-2" width="18" height="18"></iconify-icon>
              <span>Monitoring platform security, cyber protection, and preventing fraudulent activity</span>
            </div>
            <div class="sq-check-item">
              <iconify-icon icon="lucide:check-circle-2" width="18" height="18"></iconify-icon>
              <span>Conducting performance tracking, analytics, and targeted marketing campaigns</span>
            </div>
            <div class="sq-check-item">
              <iconify-icon icon="lucide:check-circle-2" width="18" height="18"></iconify-icon>
              <span>Complying with statutory, tax, legal, and regulatory requirements</span>
            </div>
          </div>
        </section>

        <!-- 3. Cookies & Tracking Technologies -->
        <section id="cookies" class="sq-policy-section">
          <h2><span class="sq-section-badge">3</span> Cookies &amp; Tracking Technologies</h2>
          <p class="sq-sec-lead">Our website uses cookies, pixels, and similar web tracking mechanisms to enhance your browsing experience. Specifically, they are used to:</p>

          <ul style="color:#475569; font-size:14.5px; line-height:1.75; padding-left:24px; margin-bottom:16px;">
            <li>Improve website speed and caching performance</li>
            <li>Remember user preferences and locale settings</li>
            <li>Analyze visitor patterns and conversion funnels</li>
            <li>Deliver relevant insights and support advertising efforts</li>
          </ul>

          <div style="background:#f1f5f9; border-radius:10px; padding:14px 18px; font-size:13.5px; color:#475569; line-height:1.6;">
            <strong>Cookie Control:</strong> You can choose to disable or clear cookies through your browser settings at any time. Please note that disabling certain essential cookies may affect some features or interactivity of the website.
          </div>
        </section>

        <!-- 4. Information Sharing & Disclosure -->
        <section id="sharing" class="sq-policy-section">
          <h2><span class="sq-section-badge">4</span> Information Sharing &amp; Disclosure</h2>

          <div class="sq-callout-safe">
            <iconify-icon icon="lucide:shield-alert"></iconify-icon>
            <div>
              <strong>We Do Not Sell Your Data</strong>
              <p>Sortiq Solutions Pvt. Ltd. does not sell, trade, rent, or monetize your personal information to third parties under any circumstances.</p>
            </div>
          </div>

          <p style="font-size:14.5px; color:#475569; line-height:1.7; margin-bottom:12px;">
            We may share necessary data strictly with trusted third-party service providers who assist us in operations under rigorous confidentiality standards, including:
          </p>

          <ul style="color:#475569; font-size:14px; line-height:1.75; padding-left:24px;">
            <li><strong>Cloud &amp; Hosting Infrastructure:</strong> Reliable web hosting and database providers</li>
            <li><strong>Payment Gateways:</strong> Secure, PCI-DSS compliant payment processing platforms</li>
            <li><strong>Analytics &amp; Diagnostics:</strong> Industry-standard analytics (e.g. Google Analytics)</li>
            <li><strong>Communication Systems:</strong> Secure email and customer notification systems</li>
            <li><strong>Legal &amp; Law Enforcement:</strong> Only when legally mandated by subpoena, court order, or applicable law</li>
          </ul>
        </section>

        <!-- 5. Data Security -->
        <section id="security" class="sq-policy-section">
          <h2><span class="sq-section-badge">5</span> Data Security</h2>
          <p class="sq-sec-lead">
            We implement comprehensive technical, administrative, and organizational measures to safeguard your data against unauthorized access, loss, misuse, modification, disclosure, or destruction.
          </p>
          <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:18px 22px; font-size:13.5px; color:#475569; line-height:1.65;">
            Our defenses include SSL/TLS encryption protocols, firewalls, role-based access management, and regular security audits. While we employ commercially accepted industry standards to protect your information, no electronic transmission over the internet or digital storage can be guaranteed 100% impenetrable.
          </div>
        </section>

        <!-- 6. Third-Party Links & Services -->
        <section id="third-party" class="sq-policy-section">
          <h2><span class="sq-section-badge">6</span> Third-Party Links &amp; Services</h2>
          <p class="sq-sec-lead">
            Our website may contain links to external sites, platforms, partner portals, or third-party tools. Sortiq Solutions is not responsible for the privacy practices, policies, or content of these external sites.
          </p>
          <p style="font-size:14px; color:#64748b; line-height:1.6;">
            We encourage users to read the individual privacy notices of any external websites or services they visit through external links.
          </p>
        </section>

        <!-- 7. Data Retention -->
        <section id="retention" class="sq-policy-section">
          <h2><span class="sq-section-badge">7</span> Data Retention</h2>
          <p class="sq-sec-lead">
            We retain your personal information only for as long as is necessary to fulfill the operational purposes outlined in this Privacy Policy, satisfy contract obligations, resolve legal disputes, and enforce our agreements. Once data is no longer required, it is safely deleted or anonymized.
          </p>
        </section>

        <!-- 8. Your Rights -->
        <section id="rights" class="sq-policy-section">
          <h2><span class="sq-section-badge">8</span> Your Rights</h2>
          <p class="sq-sec-lead">Depending on your location and applicable privacy laws, you possess legal rights regarding your personal data:</p>

          <div class="sq-rights-grid">
            <div class="sq-right-card">
              <strong>Right to Access</strong>
              <span>Request a copy of the personal information we hold about you.</span>
            </div>
            <div class="sq-right-card">
              <strong>Right to Rectification</strong>
              <span>Request corrections to inaccurate, incomplete, or outdated data.</span>
            </div>
            <div class="sq-right-card">
              <strong>Right to Erasure (&ldquo;Be Forgotten&rdquo;)</strong>
              <span>Request the deletion of your personal records from our databases.</span>
            </div>
            <div class="sq-right-card">
              <strong>Right to Withdraw Consent</strong>
              <span>Opt out of marketing communications and promotional emails anytime.</span>
            </div>
            <div class="sq-right-card" style="grid-column: 1 / -1;">
              <strong>Right to Restrict or Object</strong>
              <span>Object to or limit specific automated data processing activities.</span>
            </div>
          </div>

          <p style="font-size:13.5px; color:#475569; margin-top:16px;">
            To exercise any of these privacy rights, please reach out directly to our privacy desk at <a href="mailto:sortiqsolutions@gmail.com" style="color:#0b63e5; font-weight:700; text-decoration:underline;">sortiqsolutions@gmail.com</a>.
          </p>
        </section>

        <!-- 9. Children's Privacy -->
        <section id="children" class="sq-policy-section">
          <h2><span class="sq-section-badge">9</span> Children&rsquo;s Privacy</h2>
          <p class="sq-sec-lead">
            Our IT and digital services are not directed to individuals under the age of 13. We do not knowingly solicit or collect personal identifiable information from children.
          </p>
          <p style="font-size:13.5px; color:#64748b; line-height:1.6;">
            If we learn that we have mistakenly collected personal information from a minor without parental consent, we will take immediate measures to permanently delete that information from our servers.
          </p>
        </section>

        <!-- 10. Changes to This Privacy Policy -->
        <section id="changes" class="sq-policy-section">
          <h2><span class="sq-section-badge">10</span> Changes to This Privacy Policy</h2>
          <p class="sq-sec-lead">
            We reserve the right to revise, update, or modify this Privacy Policy at our discretion to reflect evolving legal, technological, or operational standards.
          </p>
          <p style="font-size:13.5px; color:#475569; line-height:1.65;">
            Any modifications will be published on this page accompanied by an updated &ldquo;Effective Date&rdquo;. Your continued use of our website or services following any revisions indicates your acknowledgment and acceptance of the revised terms.
          </p>
        </section>

        <!-- 11. Contact Us -->
        <section id="contact" class="sq-policy-section">
          <h2><span class="sq-section-badge">11</span> Contact Us</h2>
          <p class="sq-sec-lead">
            If you have questions, feedback, or concerns regarding this Privacy Policy, or wish to submit a data inquiry, please get in touch with our team:
          </p>

          <div class="sq-contact-box">
            <h3 style="font-size:18px; font-weight:800; color:#00173e; margin:0 0 16px;">Sortiq Solutions Pvt. Ltd.</h3>

            <div class="sq-contact-info-grid">
              <div class="sq-contact-item">
                <div class="sq-contact-item-icon">
                  <iconify-icon icon="lucide:globe" width="18" height="18"></iconify-icon>
                </div>
                <div class="sq-contact-item-text">
                  <span>Official Website</span>
                  <a href="https://sortiqsolutions.com/" target="_blank" rel="noopener noreferrer">www.sortiqsolutions.com</a>
                </div>
              </div>

              <div class="sq-contact-item">
                <div class="sq-contact-item-icon">
                  <iconify-icon icon="lucide:mail" width="18" height="18"></iconify-icon>
                </div>
                <div class="sq-contact-item-text">
                  <span>Privacy Email</span>
                  <a href="mailto:sortiqsolutions@gmail.com">sortiqsolutions@gmail.com</a>
                </div>
              </div>

              <div class="sq-contact-item">
                <div class="sq-contact-item-icon">
                  <iconify-icon icon="lucide:phone" width="18" height="18"></iconify-icon>
                </div>
                <div class="sq-contact-item-text">
                  <span>Telephone</span>
                  <a href="tel:+919646522110">+91 9646522110</a>
                </div>
              </div>

              <div class="sq-contact-item">
                <div class="sq-contact-item-icon">
                  <iconify-icon icon="lucide:map-pin" width="18" height="18"></iconify-icon>
                </div>
                <div class="sq-contact-item-text">
                  <span>Registered Office</span>
                  <p>E-51, Second Floor, Phase 8, Industrial Area, S.A.S. Nagar, Mohali, Punjab – 160071, India</p>
                </div>
              </div>
            </div>
          </div>
        </section>

      </article>

    </div>
  </div>

</main>
@endsection
