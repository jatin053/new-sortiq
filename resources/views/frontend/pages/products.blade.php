@extends('layouts.frontend')

@section('title', 'Our Products & Digital SaaS Platforms | Sortiq Solutions')
@section('meta_description', 'Discover Sortiq Solutions suite of enterprise-grade digital products, turnkey SaaS platforms, smart IoT systems, and custom business solutions built for speed, scale, and 100% source code ownership.')
@section('meta_keywords', 'software products, enterprise ERP, SaaS platforms, custom software products, ready-to-deploy solutions, Sortiq products, fintech software, ecommerce engine, digital products Mohali Chandigarh')
@section('body_attributes') data-route="/products" @endsection

@push('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css">
<style>
  /* -------------------------------------------------------------
     SORTIQ PRODUCTS PAGE - ROBUST FULL-RESPONSIVE STYLING (320px - 1440px)
  ------------------------------------------------------------- */
  :root {
    --sq-navy: #00173e;
    --sq-navy-dark: #000d23;
    --sq-navy-card: #041d48;
    --sq-orange: #ff6600;
    --sq-orange-hover: #ff7a1a;
    --sq-orange-light: #fff3ec;
    --sq-slate-50: #f8fafd;
    --sq-slate-100: #f1f5f9;
    --sq-slate-200: #e2e8f0;
    --sq-slate-400: #94a3b8;
    --sq-slate-600: #475569;
    --sq-slate-700: #334155;
    --sq-slate-900: #0f172a;
    --sq-white: #ffffff;
  }

  /* Universal reset & word wrap prevention against 320px horizontal overflow */
  .sq-products-page {
    font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    color: var(--sq-slate-900);
    background: #ffffff;
    width: 100%;
    max-width: 100%;
    overflow-x: hidden;
    line-height: 1.5;
    box-sizing: border-box;
    word-break: break-word;
    overflow-wrap: break-word;
  }

  .sq-products-page *,
  .sq-products-page *::before,
  .sq-products-page *::after {
    box-sizing: border-box;
    max-width: 100%;
  }

  .sq-font-title {
    font-family: 'Poppins', 'Nunito', sans-serif;
    word-break: break-word;
    overflow-wrap: break-word;
  }

  .sq-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 16px;
    box-sizing: border-box;
  }

  @media (min-width: 768px) {
    .sq-container {
      padding: 0 24px;
    }
  }

  /* ---------------- SECTION 1: HERO ---------------- */
  .sq-prod-hero {
    position: relative;
    background: linear-gradient(135deg, #000917 0%, #00173e 50%, #00225d 100%) !important;
    color: #ffffff !important;
    padding: 50px 0 55px;
    overflow: hidden;
  }

  @media (min-width: 768px) {
    .sq-prod-hero {
      padding: 70px 0 65px;
    }
  }

  .sq-prod-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: 
      radial-gradient(circle at 15% 25%, rgba(255, 102, 0, 0.18) 0%, transparent 45%),
      radial-gradient(circle at 85% 75%, rgba(14, 165, 233, 0.16) 0%, transparent 45%);
    pointer-events: none;
  }

  .sq-prod-hero-grid {
    position: absolute;
    inset: 0;
    background-size: 36px 36px;
    background-image: 
      linear-gradient(to right, rgba(255, 255, 255, 0.04) 1px, transparent 1px),
      linear-gradient(to bottom, rgba(255, 255, 255, 0.04) 1px, transparent 1px);
    pointer-events: none;
  }

  .sq-breadcrumb {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #94a3b8;
    margin-bottom: 20px;
    position: relative;
    z-index: 2;
  }

  .sq-breadcrumb a {
    color: #cbd5e1;
    text-decoration: none;
    transition: color 0.2s ease;
  }

  .sq-breadcrumb a:hover {
    color: #ffffff;
  }

  .sq-breadcrumb span.active {
    color: #ff944d;
  }

  .sq-hero-layout {
    display: grid;
    grid-template-columns: 1.15fr 0.85fr;
    gap: 36px;
    align-items: center;
    position: relative;
    z-index: 2;
  }

  @media (max-width: 991px) {
    .sq-hero-layout {
      grid-template-columns: 100%;
      gap: 32px;
    }
  }

  .sq-badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 14px;
    border-radius: 9999px;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    background: rgba(255, 102, 0, 0.15);
    color: #ff944d;
    border: 1px solid rgba(255, 102, 0, 0.35);
    margin-bottom: 16px;
  }

  .sq-badge-pill .pulse-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #ff6600;
    box-shadow: 0 0 10px #ff6600;
    animation: sqPillPulse 2s infinite ease-in-out;
    flex-shrink: 0;
  }

  @keyframes sqPillPulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.4; transform: scale(1.3); }
  }

  .sq-hero-title {
    font-size: clamp(24px, 5.5vw, 42px);
    line-height: 1.25;
    font-weight: 800;
    color: #ffffff;
    margin: 0 0 16px 0;
  }

  .sq-hero-title span {
    color: #ff6600;
  }

  .sq-hero-desc {
    font-size: clamp(14px, 3.2vw, 16px);
    line-height: 1.6;
    color: #cbd5e1;
    margin: 0 0 26px 0;
    max-width: 620px;
  }

  .sq-hero-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 12px;
  }

  @media (max-width: 480px) {
    .sq-hero-actions {
      flex-direction: column;
      align-items: stretch;
    }
    .sq-hero-actions a {
      width: 100%;
      text-align: center;
      justify-content: center;
    }
  }

  .sq-btn-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: #ff6600;
    color: #ffffff !important;
    font-weight: 600;
    font-size: 13.5px;
    padding: 12px 28px;
    border-radius: 999px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(255, 102, 0, 0.25);
    transition: all 0.25s ease;
  }

  .sq-btn-primary:hover {
    background: #001b43;
    color: #ffffff !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(0, 27, 67, 0.3);
  }

  .sq-btn-outline-white {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.08);
    color: #ffffff !important;
    font-weight: 600;
    font-size: 13.5px;
    padding: 12px 24px;
    border-radius: 999px;
    text-decoration: none;
    border: 1px solid rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(8px);
    transition: all 0.25s ease;
  }

  .sq-btn-outline-white:hover {
    background: rgba(255, 255, 255, 0.16);
    border-color: rgba(255, 255, 255, 0.45);
    transform: translateY(-2px);
  }

  /* Hero Stat Cards */
  .sq-hero-stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
  }

  @media (max-width: 420px) {
    .sq-hero-stats-grid {
      grid-template-columns: 1fr;
    }
  }

  .sq-hero-stat-card {
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 16px;
    padding: 18px 16px;
    transition: transform 0.3s ease, border-color 0.3s ease;
  }

  .sq-hero-stat-card .stat-val {
    font-size: 26px;
    font-weight: 800;
    color: #ffffff;
    line-height: 1.1;
    margin: 6px 0 4px;
  }

  .sq-hero-stat-card .stat-lbl {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    color: #94a3b8;
  }

  .sq-hero-stat-card .stat-sub {
    font-size: 11px;
    color: #cbd5e1;
    margin-top: 4px;
    line-height: 1.4;
  }

  /* ---------------- SECTION 2: ECOSYSTEM (SCREENSHOT EVOLUTION) ---------------- */
  .sq-ecosystem-section {
    padding: 60px 0;
    background: #ffffff;
  }

  @media (min-width: 768px) {
    .sq-ecosystem-section {
      padding: 85px 0;
    }
  }

  .sq-section-header {
    text-align: center;
    max-width: 720px;
    margin: 0 auto 40px;
  }

  .sq-section-tag {
    display: inline-block;
    color: #ff6600;
    font-weight: 800;
    font-size: 11.5px;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    background: #fff3ec;
    border: 1px solid #ffd4be;
    padding: 4px 12px;
    border-radius: 9999px;
    margin-bottom: 12px;
  }

  .sq-section-title {
    font-size: clamp(21px, 5vw, 34px);
    font-weight: 800;
    color: #00173e;
    line-height: 1.25;
    margin: 0 0 10px 0;
  }

  .sq-section-line {
    width: 44px;
    height: 3px;
    background: #ff6600;
    margin: 0 auto 14px;
    border-radius: 2px;
  }

  .sq-section-desc {
    font-size: clamp(13px, 3vw, 15px);
    color: #475569;
    line-height: 1.55;
    margin: 0;
  }

  .sq-ecosystem-layout {
    display: grid;
    grid-template-columns: 340px 1fr;
    gap: 26px;
    align-items: stretch;
  }

  @media (max-width: 991px) {
    .sq-ecosystem-layout {
      grid-template-columns: 100%;
    }
  }

  /* Left Spotlight Card */
  .sq-spotlight-card {
    position: relative;
    background: linear-gradient(165deg, #010b1a 0%, #00173e 65%, #002766 100%);
    border-radius: 20px;
    overflow: hidden;
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.12);
    box-shadow: 0 16px 40px rgba(0, 23, 62, 0.22);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 30px 22px;
  }

  @media (max-width: 480px) {
    .sq-spotlight-card {
      padding: 24px 16px;
    }
  }

  .sq-spotlight-bg {
    position: absolute;
    inset: 0;
    opacity: 0.16;
    background-size: cover;
    background-position: center;
    mix-blend-mode: overlay;
  }

  .sq-spotlight-content {
    position: relative;
    z-index: 2;
  }

  .sq-spotlight-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 10px;
    border-radius: 9999px;
    background: rgba(255, 255, 255, 0.1);
    color: #ff944d;
    font-size: 10.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 16px;
    border: 1px solid rgba(255, 255, 255, 0.15);
  }

  .sq-spotlight-title {
    font-size: clamp(20px, 4.5vw, 26px);
    font-weight: 800;
    color: #ffffff;
    line-height: 1.3;
    margin: 0 0 12px 0;
  }

  .sq-spotlight-desc {
    font-size: 13px;
    color: #cbd5e1;
    line-height: 1.55;
    margin: 0 0 20px 0;
  }

  .sq-spotlight-checklist {
    list-style: none;
    padding: 0;
    margin: 0 0 24px 0;
  }

  .sq-spotlight-checklist li {
    display: flex;
    align-items: center;
    gap: 9px;
    font-size: 12px;
    font-weight: 600;
    color: #e2e8f0;
    margin-bottom: 9px;
  }

  .sq-spotlight-checklist li iconify-icon {
    color: #ff6600;
    flex-shrink: 0;
  }

  /* Right 6 Cards Grid */
  .sq-sol-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
  }

  @media (max-width: 991px) {
    .sq-sol-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 580px) {
    .sq-sol-grid {
      grid-template-columns: 100%;
    }
  }

  .sq-sol-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 20px 18px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 14px rgba(0, 23, 62, 0.04);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
  }

  .sq-sol-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: transparent;
    transition: background 0.3s ease;
  }

  .sq-sol-card:hover {
    transform: translateY(-4px);
    border-color: rgba(255, 102, 0, 0.35);
    box-shadow: 0 12px 26px rgba(0, 23, 62, 0.08);
  }

  .sq-sol-card:hover::before {
    background: linear-gradient(90deg, #ff6600, #ff944d);
  }

  .sq-sol-icon-box {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 14px;
    font-size: 20px;
    flex-shrink: 0;
  }

  .sq-sol-card-title {
    font-size: 16px;
    font-weight: 700;
    color: #00173e;
    margin: 0 0 6px 0;
  }

  .sq-sol-card-desc {
    font-size: 12px;
    color: #64748b;
    line-height: 1.5;
    margin: 0 0 16px 0;
  }

  .sq-sol-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    padding-top: 12px;
    border-top: 1px solid #f1f5f9;
  }

  .sq-sol-pill {
    font-size: 10.5px;
    font-weight: 600;
    padding: 3px 8px;
    border-radius: 5px;
    background: #f1f5f9;
    color: #475569;
  }

  .sq-sol-card:hover .sq-sol-pill {
    background: #fff3ec;
    color: #ff6600;
  }

  /* ---------------- SECTION 3: FLAGSHIP PRODUCTS CATALOG ---------------- */
  .sq-flagship-section {
    padding: 60px 0;
    background: #f8fafd;
    border-top: 1px solid #eef2f7;
    border-bottom: 1px solid #eef2f7;
  }

  @media (min-width: 768px) {
    .sq-flagship-section {
      padding: 85px 0;
    }
  }

  .sq-flagship-top {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 34px;
  }

  .sq-filter-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
  }

  .sq-filter-btn {
    padding: 8px 14px;
    border-radius: 9999px;
    font-size: 12px;
    font-weight: 700;
    border: 1.5px solid #cbd5e1;
    background: #ffffff;
    color: #475569;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .sq-filter-btn:hover {
    color: #ff6600;
    border-color: rgba(255, 102, 0, 0.4);
  }

  .sq-filter-btn.active {
    background: #00173e;
    color: #ffffff;
    border-color: #00173e;
    box-shadow: 0 4px 12px rgba(0, 23, 62, 0.2);
  }

  .sq-prod-catalog-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 28px;
    max-width: 1040px;
    margin: 0 auto;
  }

  @media (max-width: 840px) {
    .sq-prod-catalog-grid {
      grid-template-columns: 100%;
      max-width: 580px;
    }
  }

  .sq-product-item-card {
    background: #ffffff;
    border-radius: 18px;
    border: 1px solid #e2e8f0;
    overflow: hidden;
    box-shadow: 0 5px 18px rgba(0, 23, 62, 0.04);
    display: flex;
    flex-direction: column;
    transition: all 0.25s ease;
  }

  .sq-product-item-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 14px 30px rgba(0, 23, 62, 0.09);
    border-color: rgba(255, 102, 0, 0.35);
  }

  .sq-card-header {
    padding: 20px 20px 14px;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px;
  }

  .sq-card-cat-badge {
    font-size: 10.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    padding: 3px 8px;
    border-radius: 9999px;
  }

  .sq-card-name {
    font-size: 18px;
    font-weight: 800;
    color: #00173e;
    margin: 6px 0 0 0;
  }

  .sq-status-pill {
    font-size: 10.5px;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 9999px;
    white-space: nowrap;
    flex-shrink: 0;
  }

  .sq-card-body {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .sq-card-summary {
    font-size: 12.5px;
    color: #475569;
    line-height: 1.5;
    margin: 0 0 16px 0;
  }

  .sq-feature-list {
    list-style: none;
    padding: 0;
    margin: 0 0 18px 0;
  }

  .sq-feature-list li {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    font-size: 12.5px;
    color: #334155;
    line-height: 1.4;
    margin-bottom: 8px;
  }

  .sq-feature-list li iconify-icon {
    color: #ff6600;
    font-size: 15px;
    margin-top: 2px;
    flex-shrink: 0;
  }

  .sq-stack-row {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    margin-bottom: 18px;
  }

  .sq-tech-badge {
    font-size: 10.5px;
    font-weight: 700;
    padding: 3px 7px;
    border-radius: 5px;
    background: #f1f5f9;
    color: #334155;
    border: 1px solid #e2e8f0;
  }

  .sq-card-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    padding-top: 14px;
    border-top: 1px solid #f1f5f9;
  }

  @media (max-width: 380px) {
    .sq-card-actions {
      grid-template-columns: 1fr;
    }
  }

  .sq-btn-blueprint {
    padding: 8px 18px;
    border-radius: 999px;
    border: 1.5px solid #cbd5e1;
    background: #ffffff;
    color: #00173e;
    font-size: 12px;
    font-weight: 700;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .sq-btn-blueprint:hover {
    background: #f8fafc;
    border-color: #00173e;
  }

  .sq-btn-demo {
    padding: 8px 18px;
    border-radius: 999px;
    background: #ff6600;
    color: #ffffff !important;
    font-size: 12px;
    font-weight: 700;
    text-align: center;
    text-decoration: none;
    border: none;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(255, 102, 0, 0.25);
    transition: all 0.25s ease;
  }

  .sq-btn-demo:hover {
    background: #001b43;
    color: #ffffff !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0, 27, 67, 0.3);
  }

  /* ---------------- SECTION 4: COMPARISON MATRIX ---------------- */
  .sq-matrix-section {
    padding: 60px 0;
    background: #ffffff;
  }

  @media (min-width: 768px) {
    .sq-matrix-section {
      padding: 85px 0;
    }
  }

  .sq-matrix-wrapper {
    overflow-x: auto;
    width: 100%;
    -webkit-overflow-scrolling: touch;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0, 23, 62, 0.05);
  }

  .sq-matrix-table {
    width: 100%;
    min-width: 680px;
    border-collapse: separate;
    border-spacing: 0;
    background: #ffffff;
    border: 1px solid #e2e8f0;
  }

  .sq-matrix-table th,
  .sq-matrix-table td {
    padding: 14px 16px;
    text-align: left;
    font-size: 13.5px;
    border-bottom: 1px solid #edf2f7;
  }

  .sq-matrix-table th {
    background: #00173e;
    color: #ffffff;
    font-weight: 700;
  }

  .sq-matrix-table th.col-highlight {
    background: #ff6600;
    color: #ffffff;
  }

  .sq-matrix-table tr:last-child td {
    border-bottom: none;
  }

  .sq-matrix-table td.col-highlight {
    background: #fff8f4;
    border-left: 2px solid #ffd4be;
    border-right: 2px solid #ffd4be;
  }

  /* ---------------- SECTION 5: PROCESS STEPS (SCREENSHOT 1 FIX) ---------------- */
  .sq-process-section {
    padding: 60px 0 !important;
    background: #000d23 !important;
    color: #ffffff !important;
    position: relative !important;
    overflow: hidden !important;
  }

  @media (min-width: 768px) {
    .sq-process-section {
      padding: 85px 0 !important;
    }
  }

  .sq-process-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: 
      radial-gradient(circle at 10% 20%, rgba(255, 102, 0, 0.12) 0%, transparent 40%),
      radial-gradient(circle at 90% 80%, rgba(56, 189, 248, 0.1) 0%, transparent 40%);
    pointer-events: none;
  }

  .sq-process-section .sq-section-title {
    color: #ffffff !important;
  }

  .sq-process-section .sq-section-desc {
    color: #cbd5e1 !important;
  }

  .sq-process-grid {
    display: grid !important;
    grid-template-columns: repeat(5, 1fr) !important;
    gap: 16px !important;
    position: relative !important;
    z-index: 2 !important;
  }

  @media (max-width: 1024px) {
    .sq-process-grid {
      grid-template-columns: repeat(3, 1fr) !important;
    }
  }

  @media (max-width: 640px) {
    .sq-process-grid {
      grid-template-columns: 100% !important;
      gap: 22px !important;
    }
  }

  .sq-process-card {
    background: #00173e !important;
    border: 1px solid rgba(255, 255, 255, 0.15) !important;
    border-radius: 16px !important;
    padding: 24px 18px 18px !important;
    position: relative !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: space-between !important;
    box-shadow: 0 8px 22px rgba(0, 0, 0, 0.3) !important;
  }

  .sq-process-badge {
    position: absolute !important;
    top: -11px !important;
    left: 18px !important;
    background: #ff6600 !important;
    color: #ffffff !important;
    font-size: 10.5px !important;
    font-weight: 800 !important;
    padding: 2px 10px !important;
    border-radius: 9999px !important;
    border: 2px solid #000d23 !important;
  }

  .sq-process-icon {
    font-size: 24px !important;
    margin-bottom: 10px !important;
    margin-top: 4px !important;
  }

  .sq-process-name {
    font-size: 15px !important;
    font-weight: 800 !important;
    color: #ffffff !important;
    margin: 0 0 6px 0 !important;
    line-height: 1.3 !important;
    display: block !important;
  }

  .sq-process-text {
    font-size: 12px !important;
    color: #cbd5e1 !important;
    line-height: 1.5 !important;
    margin: 0 0 12px 0 !important;
  }

  .sq-process-time {
    font-size: 11px !important;
    font-weight: 700 !important;
    color: #ff944d !important;
    display: block !important;
    padding-top: 8px !important;
    border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
  }

  /* ---------------- SECTION 6: DEMO FORM (RESPONSIVE + PHONE FIX) ---------------- */
  .sq-demo-section {
    padding: 55px 0;
    background: #f8fafd;
  }

  @media (min-width: 768px) {
    .sq-demo-section {
      padding: 85px 0;
    }
  }

  .sq-demo-layout {
    display: grid;
    grid-template-columns: minmax(430px, 470px) 1fr;
    gap: 36px;
    align-items: flex-start;
  }

  @media (max-width: 991px) {
    .sq-demo-layout {
      grid-template-columns: 100%;
      gap: 28px;
    }
  }

  .sq-demo-info-box {
    display: flex;
    flex-direction: column;
    gap: 18px;
  }

  .sq-demo-benefit-card {
    display: flex;
    align-items: flex-start;
    gap: 12px;
  }

  .sq-demo-benefit-icon {
    width: 30px;
    height: 30px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    flex-shrink: 0;
    margin-top: 2px;
  }

  .sq-demo-benefit-title {
    font-size: 13.5px;
    font-weight: 700;
    color: #00173e;
    margin: 0 0 2px 0;
  }

  .sq-demo-benefit-desc {
    font-size: 12px;
    color: #64748b;
    line-height: 1.4;
    margin: 0;
  }

  /* Quick contact phone / whatsapp / email box - two clean side-by-side columns on all screens */
  .sq-demo-call-box {
    background: #ffffff;
    border-radius: 14px;
    padding: 16px 18px;
    border: 1px solid #e2e8f0;
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    gap: 16px;
    box-shadow: 0 4px 14px rgba(0, 23, 62, 0.04);
  }

  .sq-demo-call-item {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    min-width: 0;
    width: 100%;
  }

  .sq-demo-call-label {
    font-size: 10.5px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    white-space: nowrap;
    display: flex;
    align-items: center;
    gap: 4px;
    margin-bottom: 3px;
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .sq-demo-call-num {
    font-size: 14px;
    font-weight: 800;
    color: #00173e;
    text-decoration: none;
    display: inline-block;
    white-space: nowrap;
    transition: color 0.2s ease;
  }

  .sq-demo-call-num:hover {
    color: #ff6600;
  }

  .sq-demo-email-num {
    font-size: 12.5px;
    font-weight: 700;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: 100%;
    display: block;
  }

  .sq-whatsapp-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    background: #25D366;
    color: #ffffff !important;
    font-size: 12px;
    font-weight: 700;
    padding: 7px 14px;
    border-radius: 999px;
    text-decoration: none;
    box-shadow: 0 2px 8px rgba(37, 211, 102, 0.3);
    transition: all 0.2s ease;
    white-space: nowrap;
    margin-top: 10px;
  }

  .sq-whatsapp-pill:hover {
    background: #1ebc59;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
  }

  .sq-email-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    background: #ff6600;
    color: #ffffff !important;
    font-size: 12px;
    font-weight: 700;
    padding: 7px 14px;
    border-radius: 999px;
    text-decoration: none;
    box-shadow: 0 2px 8px rgba(255, 102, 0, 0.25);
    transition: all 0.2s ease;
    white-space: nowrap;
    margin-top: 10px;
  }

  .sq-email-pill:hover {
    background: #001b43;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 27, 67, 0.3);
  }

  @media (max-width: 480px) {
    .sq-demo-call-box {
      /*grid-template-columns: repeat(2, minmax(0, 1fr)) !important;*/
      padding: 12px 10px !important;
      gap: 10px !important;
    }

    .sq-demo-call-label {
      font-size: 8.5px !important;
      letter-spacing: 0.2px !important;
    }

    .sq-demo-call-num {
      font-size: 12px !important;
    }

    .sq-demo-email-num {
      font-size: 10.5px !important;
    }

    .sq-whatsapp-pill,
    .sq-email-pill {
      font-size: 11px !important;
      padding: 6px 10px !important;
      gap: 4px !important;
      margin-top: 8px !important;
    }
  }

  /* Form Container */
  .sq-form-panel {
    background: #ffffff;
    border-radius: 20px;
    padding: 30px 24px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 10px 32px rgba(0, 23, 62, 0.06);
    width: 100%;
    box-sizing: border-box;
  }

  @media (max-width: 480px) {
    .sq-form-panel {
      padding: 20px 14px;
      border-radius: 16px;
    }
  }

  .sq-form-title {
    font-size: 20px;
    font-weight: 800;
    color: #00173e;
    margin: 0 0 4px 0;
  }

  .sq-form-subtitle {
    font-size: 12.5px;
    color: #64748b;
    margin: 0 0 20px 0;
  }

  .sq-form-group {
    margin-bottom: 16px;
    width: 100%;
  }

  .sq-form-label {
    display: block;
    font-size: 11.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    color: #475569;
    margin-bottom: 6px;
  }

  .sq-form-label span.req {
    color: #ef4444;
  }

  .sq-input-wrapper {
    position: relative;
    width: 100%;
  }

  .sq-input-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    pointer-events: none;
    font-size: 15px;
    z-index: 2;
  }

  .sq-form-control {
    width: 100%;
    padding: 12px 14px 12px 40px;
    font-size: 13.5px;
    border: 1.5px solid #cbd5e1;
    border-radius: 10px;
    background: #f8fafc;
    color: #00173e;
    outline: none;
    transition: all 0.2s ease;
    font-family: inherit;
    box-sizing: border-box;
  }

  .sq-form-control:focus {
    background: #ffffff;
    border-color: #ff6600;
    box-shadow: 0 0 0 3px rgba(255, 102, 0, 0.12);
  }

  .sq-form-select {
    width: 100%;
    padding: 12px 36px 12px 14px;
    font-size: 13.5px;
    border: 1.5px solid #cbd5e1;
    border-radius: 10px;
    background: #f8fafc;
    color: #00173e;
    font-weight: 600;
    outline: none;
    cursor: pointer;
    appearance: none;
    font-family: inherit;
    box-sizing: border-box;
  }

  .sq-form-select:focus {
    background: #ffffff;
    border-color: #ff6600;
    box-shadow: 0 0 0 3px rgba(255, 102, 0, 0.12);
  }

  .sq-select-arrow {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    pointer-events: none;
  }

  .sq-form-textarea {
    width: 100%;
    padding: 12px 14px;
    font-size: 13.5px;
    border: 1.5px solid #cbd5e1;
    border-radius: 10px;
    background: #f8fafc;
    color: #00173e;
    outline: none;
    resize: vertical;
    min-height: 90px;
    font-family: inherit;
    box-sizing: border-box;
  }

  .sq-form-textarea:focus {
    background: #ffffff;
    border-color: #ff6600;
    box-shadow: 0 0 0 3px rgba(255, 102, 0, 0.12);
  }

  /* ---------------- PHONE NUMBER FIELD - PERFECT ALIGNMENT (FIX FOR IMAGE 2) ---------------- */
  .sq-phone-wrap {
    position: relative;
    width: 100%;
    box-sizing: border-box;
  }

  .sq-phone-wrap .iti {
    width: 100% !important;
    display: block !important;
    position: relative !important;
  }

  /* The flag dropdown container on the left */
  .sq-phone-wrap .iti__flag-container {
    position: absolute !important;
    top: 0 !important;
    bottom: 0 !important;
    left: 0 !important;
    padding: 0 8px 0 10px !important;
    border-right: 1.5px solid #cbd5e1 !important;
    background: #f1f5f9 !important;
    border-top-left-radius: 10px !important;
    border-bottom-left-radius: 10px !important;
    z-index: 3 !important;
    display: flex !important;
    align-items: center !important;
    transition: background 0.2s ease !important;
  }

  .sq-phone-wrap .iti__flag-container:hover {
    background: #e2e8f0 !important;
  }

  .sq-phone-wrap .iti__selected-dial-code {
    font-size: 13.5px !important;
    font-weight: 700 !important;
    color: #00173e !important;
    margin-left: 6px !important;
    line-height: 1 !important;
  }

  /* The actual input text field - generous 96px left padding so numbers and cursor never overlap */
  .sq-phone-wrap input[type="tel"] {
    width: 100% !important;
    height: 48px !important;
    padding-left: 96px !important;
    padding-right: 14px !important;
    padding-top: 10px !important;
    padding-bottom: 10px !important;
    font-size: 14px !important;
    border: 1.5px solid #cbd5e1 !important;
    border-radius: 10px !important;
    background: #f8fafc !important;
    color: #00173e !important;
    outline: none !important;
    transition: all 0.2s ease !important;
    box-sizing: border-box !important;
    font-family: inherit !important;
  }

  .sq-phone-wrap input[type="tel"]:focus {
    background: #ffffff !important;
    border-color: #ff6600 !important;
    box-shadow: 0 0 0 3px rgba(255, 102, 0, 0.12) !important;
  }

  .sq-phone-wrap .iti__country-list {
    color: #00173e !important;
    font-size: 13px !important;
    border-radius: 10px !important;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2) !important;
    max-width: 300px !important;
    z-index: 1000 !important;
  }

  .sq-form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
  }

  @media (max-width: 580px) {
    .sq-form-row {
      grid-template-columns: 100%;
    }
  }

  .sq-submit-btn {
    width: 100%;
    padding: 14px 28px;
    background: #ff6600;
    color: #ffffff !important;
    border: none;
    border-radius: 999px;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(255, 102, 0, 0.25);
    transition: all 0.25s ease;
  }

  .sq-submit-btn:hover {
    background: #001b43;
    color: #ffffff !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(0, 27, 67, 0.3);
  }

  /* ---------------- SECTION 7: FAQ ---------------- */
  .sq-faq-section {
    padding: 60px 0;
    background: #ffffff;
  }

  @media (min-width: 768px) {
    .sq-faq-section {
      padding: 85px 0;
    }
  }

  .sq-faq-container {
    max-width: 800px;
    margin: 0 auto;
  }

  .sq-faq-item {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    margin-bottom: 10px;
    overflow: hidden;
    transition: border-color 0.2s ease;
  }

  .sq-faq-item.is-active {
    border-color: #ff6600;
    box-shadow: 0 4px 14px rgba(255, 102, 0, 0.08);
  }

  .sq-faq-btn {
    width: 100%;
    padding: 16px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    background: transparent;
    border: none;
    cursor: pointer;
    text-align: left;
    font-weight: 700;
    font-size: 14.5px;
    color: #00173e;
  }

  .sq-faq-panel {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease, padding 0.3s ease;
    padding: 0 18px;
    color: #475569;
    font-size: 13.5px;
    line-height: 1.55;
  }

  .sq-faq-item.is-active .sq-faq-panel {
    padding: 0 18px 18px;
    max-height: 380px;
  }

  .sq-faq-icon {
    transition: transform 0.25s ease;
    font-size: 18px;
    flex-shrink: 0;
  }

  .sq-faq-item.is-active .sq-faq-icon {
    transform: rotate(180deg);
    color: #ff6600;
  }

  /* ---------------- SECTION 8: BOTTOM CTA ---------------- */
  .sq-cta-section {
    padding: 55px 0;
    background: linear-gradient(135deg, #000c1e 0%, #00173e 55%, #0a2558 100%) !important;
    color: #ffffff !important;
    position: relative;
    overflow: hidden;
  }

  .sq-cta-layout {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 24px;
    position: relative;
    z-index: 2;
  }

  .sq-cta-content {
    max-width: 620px;
  }

  .sq-cta-title {
    font-size: clamp(20px, 4.8vw, 32px);
    font-weight: 800;
    color: #ffffff;
    margin: 8px 0 10px 0;
    line-height: 1.25;
  }

  .sq-cta-desc {
    font-size: 14px;
    color: #cbd5e1;
    margin: 0;
    line-height: 1.55;
  }

  .sq-cta-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 12px;
  }

  @media (max-width: 580px) {
    .sq-cta-actions {
      flex-direction: column;
      width: 100%;
    }
    .sq-cta-actions a {
      width: 100%;
      justify-content: center;
      text-align: center;
    }
  }

  /* ---------------- MODAL BLUEPRINT ---------------- */
  .sq-modal-blueprint {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 99999;
    align-items: center;
    justify-content: center;
    padding: 14px;
  }

  .sq-modal-blueprint.is-open {
    display: flex;
  }

  .sq-modal-backdrop {
    position: absolute;
    inset: 0;
    background: rgba(0, 13, 35, 0.85);
    backdrop-filter: blur(8px);
  }

  .sq-modal-content {
    position: relative;
    background: #ffffff;
    border-radius: 20px;
    width: 100%;
    max-width: 760px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.45);
    z-index: 10;
  }

  .sq-modal-header {
    padding: 20px 22px;
    background: #00173e;
    color: #ffffff;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
  }

  .sq-modal-close-btn {
    background: transparent;
    border: none;
    color: #ffffff;
    font-size: 24px;
    cursor: pointer;
    padding: 4px;
    border-radius: 6px;
    flex-shrink: 0;
  }

  .sq-modal-body {
    padding: 22px;
  }
</style>
@endpush

@section('content')
<main class="sq-products-page">

  {{-- 1. HERO SECTION --}}
  <section class="sq-prod-hero" aria-labelledby="products-hero-title">
    <div class="sq-prod-hero-grid"></div>

    <div class="sq-container">
      {{-- Breadcrumb --}}
      <nav class="sq-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ url('/') }}">Home</a>
        <iconify-icon icon="lucide:chevron-right" width="14" height="14"></iconify-icon>
        <span class="active">Our Products</span>
      </nav>

      <div class="sq-hero-layout">
        <div>
          <div class="sq-badge-pill">
            <span class="pulse-dot"></span>
            <span>Sortiq Product Studio &amp; Labs</span>
          </div>

          <h1 id="products-hero-title" class="sq-font-title sq-hero-title">
            Scalable Software Products &amp; Turnkey Platforms <span>Engineered for Scale</span>
          </h1>

          <p class="sq-hero-desc">
            Why rebuild the wheel? Sortiq delivers battle-tested, modular software architectures and ready-to-deploy platforms tailored specifically for your operational workflows. 100% full IP ownership, no restrictive subscriptions, and high-velocity deployment.
          </p>

          <div class="sq-hero-actions">
            <a href="#featured-products" class="sq-btn-primary">
              <span>Explore Products</span>
              <iconify-icon icon="lucide:arrow-down" width="18" height="18"></iconify-icon>
            </a>

            <a href="#request-demo" class="sq-btn-outline-white">
              <iconify-icon icon="lucide:play-circle" width="18" height="18" style="color: #ff944d;"></iconify-icon>
              <span>Schedule Architecture Walkthrough</span>
            </a>
          </div>
        </div>

        {{-- Metrics & Trust Highlights --}}
        <div class="sq-hero-stats-grid">
          <div class="sq-hero-stat-card">
            <div style="color: #ff944d;">
              <iconify-icon icon="lucide:shield-check" width="26" height="26"></iconify-icon>
            </div>
            <div class="stat-val">100%</div>
            <div class="stat-lbl">Source Code Ownership</div>
            <div class="stat-sub">Full IP and database control. Zero vendor lock-in.</div>
          </div>

          <div class="sq-hero-stat-card">
            <div style="color: #38bdf8;">
              <iconify-icon icon="lucide:zap" width="26" height="26"></iconify-icon>
            </div>
            <div class="stat-val">4x Faster</div>
            <div class="stat-lbl">Time-to-Market</div>
            <div class="stat-sub">Pre-built mature modules slash build time by 75%.</div>
          </div>

          <div class="sq-hero-stat-card">
            <div style="color: #4ade80;">
              <iconify-icon icon="lucide:server" width="26" height="26"></iconify-icon>
            </div>
            <div class="stat-val">99.99%</div>
            <div class="stat-lbl">Uptime Architecture</div>
            <div class="stat-sub">Containerized, microservices-ready cloud orchestration.</div>
          </div>

          <div class="sq-hero-stat-card">
            <div style="color: #f59e0b;">
              <iconify-icon icon="lucide:award" width="26" height="26"></iconify-icon>
            </div>
            <div class="stat-val">ISO 9001</div>
            <div class="stat-lbl">Certified Quality</div>
            <div class="stat-sub">Tested, audit-proof code quality and security standards.</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- 2. CORE PRODUCT ECOSYSTEM SHOWCASE (Elevating the User's Screenshot Design) --}}
  <section class="sq-ecosystem-section" id="ecosystem" aria-labelledby="ecosystem-title">
    <div class="sq-container">

      {{-- Section Header --}}
      <div class="sq-section-header">
        <span class="sq-section-tag">Integrated Digital Solutions</span>
        <h2 id="ecosystem-title" class="sq-font-title sq-section-title">
          Core Product Suites &amp; Technology Stack
        </h2>
        <div class="sq-section-line"></div>
        <p class="sq-section-desc">
          From full-fledged enterprise management engines to IoT telematics and intelligent AI workflows, our modular software ecosystem powers organizations globally.
        </p>
      </div>

      {{-- The Elevated Screenshot Layout: Left Feature Spotlight + Right 6-Grid Categories --}}
      <div class="sq-ecosystem-layout">

        {{-- Left Spotlight Feature Card --}}
        <div class="sq-spotlight-card">
          <div class="sq-spotlight-bg" style="background-image: url('{{ asset('frontend-assets/media/pages/about/2149151159.jpg') }}');"></div>

          <div class="sq-spotlight-content">
            <div class="sq-spotlight-badge">
              <iconify-icon icon="lucide:sparkles" style="color: #ff944d;"></iconify-icon>
              <span>Enterprise Foundation</span>
            </div>

            <h3 class="sq-font-title sq-spotlight-title">
              Sortiq Modular Product Ecosystem
            </h3>

            <p class="sq-spotlight-desc">
              Avoid multi-year development delays and high overhead. Our pre-engineered product modules provide up to 80% out-of-the-box maturity with 100% custom tailoring for your exact business model.
            </p>

            <ul class="sq-spotlight-checklist">
              <li>
                <iconify-icon icon="lucide:check-circle-2" width="16" height="16"></iconify-icon>
                <span>Multi-Tenant &amp; Role-Based Access Control</span>
              </li>
              <li>
                <iconify-icon icon="lucide:check-circle-2" width="16" height="16"></iconify-icon>
                <span>Modular Microservices &amp; RESTful APIs</span>
              </li>
              <li>
                <iconify-icon icon="lucide:check-circle-2" width="16" height="16"></iconify-icon>
                <span>On-Premise or Private Cloud Deployment</span>
              </li>
              <li>
                <iconify-icon icon="lucide:check-circle-2" width="16" height="16"></iconify-icon>
                <span>Automated CI/CD &amp; Disaster Recovery</span>
              </li>
            </ul>

            <div style="padding-top: 16px; border-top: 1px solid rgba(255, 255, 255, 0.12);">
              <a href="#featured-products" class="sq-btn-primary" style="width: 100%; margin-bottom: 10px;">
                <span>Explore All Products</span>
                <iconify-icon icon="lucide:arrow-right" width="16" height="16"></iconify-icon>
              </a>
              <div style="display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 11px; color: #cbd5e1;">
                <span style="width: 7px; height: 7px; border-radius: 50%; background: #4ade80; display: inline-block;"></span>
                <span>Ready for Custom Deployment</span>
              </div>
            </div>
          </div>
        </div>

        {{-- Right 6-Category Grid (Matches user's screenshot categories with modern experience design) --}}
        <div class="sq-sol-grid">

          {{-- 1. Enterprise Services --}}
          <div class="sq-sol-card">
            <div>
              <div class="sq-sol-icon-box" style="background: #eff6ff; color: #2563eb;">
                <iconify-icon icon="lucide:smartphone"></iconify-icon>
              </div>
              <h4 class="sq-font-title sq-sol-card-title">Enterprise Services</h4>
              <p class="sq-sol-card-desc">
                Multi-device business platforms, workflow automation engines, and cross-platform mobile ecosystems for distributed operations.
              </p>
            </div>
            <div class="sq-sol-tags">
              <span class="sq-sol-pill">Mobile Apps</span>
              <span class="sq-sol-pill">Web Portals</span>
              <span class="sq-sol-pill">ERP Sync</span>
              <span class="sq-sol-pill">Microservices</span>
            </div>
          </div>

          {{-- 2. Emerging Technologies --}}
          <div class="sq-sol-card">
            <div>
              <div class="sq-sol-icon-box" style="background: #faf5ff; color: #9333ea;">
                <iconify-icon icon="lucide:cpu"></iconify-icon>
              </div>
              <h4 class="sq-font-title sq-sol-card-title">Emerging Tech &amp; AI</h4>
              <p class="sq-sol-card-desc">
                Autonomous AI agents, predictive business analytics, tamper-proof blockchain ledgers, and interactive immersive 3D interfaces.
              </p>
            </div>
            <div class="sq-sol-tags">
              <span class="sq-sol-pill">Generative AI</span>
              <span class="sq-sol-pill">Blockchain</span>
              <span class="sq-sol-pill">AR / VR</span>
              <span class="sq-sol-pill">Predictive ML</span>
            </div>
          </div>

          {{-- 3. Internet of Things (IoT) --}}
          <div class="sq-sol-card">
            <div>
              <div class="sq-sol-icon-box" style="background: #f0f9ff; color: #0284c7;">
                <iconify-icon icon="lucide:network"></iconify-icon>
              </div>
              <h4 class="sq-font-title sq-sol-card-title">Internet of Things</h4>
              <p class="sq-sol-card-desc">
                End-to-end telemetry architectures, smart sensor dashboards, connected fleet telematics, and digital signage engines.
              </p>
            </div>
            <div class="sq-sol-tags">
              <span class="sq-sol-pill">Smart Fleet</span>
              <span class="sq-sol-pill">Digital Signage</span>
              <span class="sq-sol-pill">Smart Parking</span>
              <span class="sq-sol-pill">Hardware APIs</span>
            </div>
          </div>

          {{-- 4. Consulting & Discovery --}}
          <div class="sq-sol-card">
            <div>
              <div class="sq-sol-icon-box" style="background: #fffbeb; color: #d97706;">
                <iconify-icon icon="lucide:compass"></iconify-icon>
              </div>
              <h4 class="sq-font-title sq-sol-card-title">Consulting &amp; Discovery</h4>
              <p class="sq-sol-card-desc">
                Strategic software roadmaps, interactive Figma prototypes, UX architecture, compliance advisory, and technical MVP scoping.
              </p>
            </div>
            <div class="sq-sol-tags">
              <span class="sq-sol-pill">Product Strategy</span>
              <span class="sq-sol-pill">UX Architecture</span>
              <span class="sq-sol-pill">MVP Blueprint</span>
              <span class="sq-sol-pill">Compliance</span>
            </div>
          </div>

          {{-- 5. Cloud & DevOps --}}
          <div class="sq-sol-card">
            <div>
              <div class="sq-sol-icon-box" style="background: #f1f5f9; color: #334155;">
                <iconify-icon icon="lucide:cloud"></iconify-icon>
              </div>
              <h4 class="sq-font-title sq-sol-card-title">Cloud &amp; DevOps</h4>
              <p class="sq-sol-card-desc">
                Resilient cloud infrastructure with automated containerization, blue-green deployment pipelines, auto-scaling, and active monitoring.
              </p>
            </div>
            <div class="sq-sol-tags">
              <span class="sq-sol-pill">Amazon AWS</span>
              <span class="sq-sol-pill">Docker &amp; K8s</span>
              <span class="sq-sol-pill">CI/CD Jenkins</span>
              <span class="sq-sol-pill">Terraform</span>
            </div>
          </div>

          {{-- 6. Web / CMS & PWA --}}
          <div class="sq-sol-card">
            <div>
              <div class="sq-sol-icon-box" style="background: #ecfdf5; color: #059669;">
                <iconify-icon icon="lucide:monitor"></iconify-icon>
              </div>
              <h4 class="sq-font-title sq-sol-card-title">Web / CMS &amp; PWA</h4>
              <p class="sq-sol-card-desc">
                High-speed headless web applications, progressive web applications (PWA) with offline caching, and omnichannel commerce platforms.
              </p>
            </div>
            <div class="sq-sol-tags">
              <span class="sq-sol-pill">Laravel / PHP</span>
              <span class="sq-sol-pill">Headless CMS</span>
              <span class="sq-sol-pill">Fast PWAs</span>
              <span class="sq-sol-pill">Tailwind UI</span>
            </div>
          </div>

        </div>

      </div>

    </div>
  </section>

  {{-- 3. FLAGSHIP PRODUCTS SHOWCASE (Filterable Product Catalog) --}}
  <section class="sq-flagship-section" id="featured-products" aria-labelledby="flagship-title">
    <div class="sq-container">

      {{-- Section Title & Subtitle --}}
      <div class="sq-flagship-top">
        <div>
          <span class="sq-section-tag">Ready-to-Deploy Products</span>
          <h2 id="flagship-title" class="sq-font-title sq-section-title" style="margin: 0; text-align: left;">
            Flagship Platforms &amp; Software Suites
          </h2>
          <p class="sq-section-desc" style="margin-top: 6px; text-align: left;">
            Choose from our pre-validated digital platforms. Each product is engineered with clean code architecture, fully customizable, and ready for rapid rollout.
          </p>
        </div>

        {{-- Filter Buttons --}}
        <div class="sq-filter-tabs" id="product-filters" role="tablist">
          <button type="button" class="sq-filter-btn active" data-filter="all">All Products (2)</button>
          <button type="button" class="sq-filter-btn" data-filter="education">Education &amp; Campus</button>
          <button type="button" class="sq-filter-btn" data-filter="content">Listings &amp; Content</button>
        </div>
      </div>

      {{-- Product Cards --}}
      <div class="sq-prod-catalog-grid" id="products-catalog">

        {{-- Product 1: CampusEdge Pro --}}
        <div class="sq-product-item-card" data-category="education">
          <div class="sq-card-header">
            <div>
              <span class="sq-card-cat-badge" style="background: #eff6ff; color: #2563eb;">
                Education &amp; Campus Management
              </span>
              <h3 class="sq-font-title sq-card-name">CampusEdge Pro</h3>
            </div>
            <span class="sq-status-pill" style="background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0;">
              Ready to Deploy
            </span>
          </div>

          <div class="sq-card-body">
            <div>
              <p class="sq-card-summary">
                Campus ERP for schools, colleges and coaching institutes. It runs admissions, fees, attendance, exams and staff records in one system, with portals for students, parents and teachers.
              </p>

              <div style="font-size: 11px; font-weight: 800; text-transform: uppercase; color: #94a3b8; margin-bottom: 8px;">Key Capabilities</div>
              <ul class="sq-feature-list">
                <li>
                  <iconify-icon icon="lucide:check-circle-2"></iconify-icon>
                  <span>Online admissions, student records and fee collection with receipts</span>
                </li>
                <li>
                  <iconify-icon icon="lucide:check-circle-2"></iconify-icon>
                  <span>Attendance, timetables, exam results and report cards</span>
                </li>
                <li>
                  <iconify-icon icon="lucide:check-circle-2"></iconify-icon>
                  <span>Student, parent and teacher portals with instant notices</span>
                </li>
                <li>
                  <iconify-icon icon="lucide:check-circle-2"></iconify-icon>
                  <span>Staff payroll and role-based access with audit trails</span>
                </li>
              </ul>
            </div>

            <div>
              <div class="sq-stack-row">
                <span class="sq-tech-badge">Laravel 11</span>
                <span class="sq-tech-badge">React</span>
                <span class="sq-tech-badge">PostgreSQL</span>
                <span class="sq-tech-badge">REST API</span>
              </div>

              <div class="sq-card-actions">
                <a href="https://campusedgepro.com/" target="_blank" rel="noopener noreferrer" class="sq-btn-blueprint">
                  View Blueprint
                </a>
                <a href="#request-demo" class="sq-btn-demo" onclick="preselectProduct('CampusEdge Pro')">
                  Request Demo
                </a>
              </div>
            </div>
          </div>
        </div>

        {{-- Product 2: Blogerzworld --}}
        <div class="sq-product-item-card" data-category="content">
          <div class="sq-card-header">
            <div>
              <span class="sq-card-cat-badge" style="background: #faf5ff; color: #7c3aed;">
                Listings &amp; Content Platform
              </span>
              <h3 class="sq-font-title sq-card-name">Blogerzworld</h3>
            </div>
            <span class="sq-status-pill" style="background: #fff7ed; color: #c2410c; border: 1px solid #fed7aa;">
              Approval-Based
            </span>
          </div>

          <div class="sq-card-body">
            <div>
              <p class="sq-card-summary">
                A listing and blog platform where only approved listings, stories and comments reach the public site. Visitors browse by category, while your team reviews and publishes from one admin panel.
              </p>

              <div style="font-size: 11px; font-weight: 800; text-transform: uppercase; color: #94a3b8; margin-bottom: 8px;">Key Capabilities</div>
              <ul class="sq-feature-list">
                <li>
                  <iconify-icon icon="lucide:check-circle-2"></iconify-icon>
                  <span>Simple flow to post listings and share blog stories</span>
                </li>
                <li>
                  <iconify-icon icon="lucide:check-circle-2"></iconify-icon>
                  <span>Approval workflow for listings, blogs and comments</span>
                </li>
                <li>
                  <iconify-icon icon="lucide:check-circle-2"></iconify-icon>
                  <span>Organized categories for easy browsing by topic</span>
                </li>
                <li>
                  <iconify-icon icon="lucide:check-circle-2"></iconify-icon>
                  <span>Central admin control for moderation and visibility</span>
                </li>
              </ul>
            </div>

            <div>
              <div class="sq-stack-row">
                <span class="sq-tech-badge">Laravel 11</span>
                <span class="sq-tech-badge">Tailwind CSS</span>
                <span class="sq-tech-badge">MySQL</span>
                <span class="sq-tech-badge">REST API</span>
              </div>

              <div class="sq-card-actions">
                <a href="https://blogerzworld.sortiqsolutions.com/home" target="_blank" rel="noopener noreferrer" class="sq-btn-blueprint">
                  View Blueprint
                </a>
                <a href="#request-demo" class="sq-btn-demo" onclick="preselectProduct('Blogerzworld')">
                  Request Demo
                </a>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  {{-- 4. COMPARISON MATRIX: Why Choose Sortiq Products --}}
  <section class="sq-matrix-section" aria-labelledby="comparison-title">
    <div class="sq-container">
      <div class="sq-section-header">
        <span class="sq-section-tag">Executive Comparison</span>
        <h2 id="comparison-title" class="sq-font-title sq-section-title">
          Why Modern Enterprises Choose Sortiq Products
        </h2>
        <div class="sq-section-line"></div>
        <p class="sq-section-desc">
          Compare the strategic advantage of deploying Sortiq's pre-built architectures versus conventional development models.
        </p>
      </div>

      <div class="sq-matrix-wrapper">
        <table class="sq-matrix-table" aria-label="Feature Comparison Matrix">
          <thead>
            <tr>
              <th style="width: 28%;">Decision Criteria</th>
              <th style="width: 26%;" class="col-highlight">
                <div style="display: flex; align-items: center; gap: 8px;">
                  <iconify-icon icon="lucide:check-circle" width="18" height="18"></iconify-icon>
                  <span>Sortiq Ready Products</span>
                </div>
              </th>
              <th style="width: 23%;">Building from Scratch</th>
              <th style="width: 23%;">Off-The-Shelf SaaS</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="font-weight: 700; color: #00173e;">Time-to-Production</td>
              <td class="col-highlight">
                <strong style="color: #047857;">2 to 4 Weeks</strong>
                <div style="font-size: 11px; color: #64748b;">Rapid customization &amp; deployment</div>
              </td>
              <td style="color: #475569;">9 to 18 Months (High Risk)</td>
              <td style="color: #475569;">Immediate, but highly rigid</td>
            </tr>
            <tr>
              <td style="font-weight: 700; color: #00173e;">Source Code Ownership</td>
              <td class="col-highlight">
                <strong style="color: #047857;">100% Full Ownership</strong>
                <div style="font-size: 11px; color: #64748b;">Your IP, your repos, zero lock-in</div>
              </td>
              <td style="color: #475569;">Full ownership (at high cost)</td>
              <td style="color: #e11d48; font-weight: 600;">0% Ownership (Rented code)</td>
            </tr>
            <tr>
              <td style="font-weight: 700; color: #00173e;">Licensing &amp; Recurring Cost</td>
              <td class="col-highlight">
                <strong style="color: #047857;">Zero Per-Seat Fees</strong>
                <div style="font-size: 11px; color: #64748b;">Fixed, predictable investment</div>
              </td>
              <td style="color: #475569;">Massive initial CAPEX + Dev team</td>
              <td style="color: #e11d48; font-weight: 600;">Expensive perpetual per-user tax</td>
            </tr>
            <tr>
              <td style="font-weight: 700; color: #00173e;">Custom Workflow Flexibility</td>
              <td class="col-highlight">
                <strong style="color: #047857;">100% Tailored</strong>
                <div style="font-size: 11px; color: #64748b;">Custom modules for your exact needs</div>
              </td>
              <td style="color: #475569;">Unlimited, but slow to iterate</td>
              <td style="color: #e11d48; font-weight: 600;">Strictly restricted feature gates</td>
            </tr>
            <tr>
              <td style="font-weight: 700; color: #00173e;">Data Privacy &amp; Hosting</td>
              <td class="col-highlight">
                <strong style="color: #047857;">Self-Hosted or Private Cloud</strong>
                <div style="font-size: 11px; color: #64748b;">You own the database and servers</div>
              </td>
              <td style="color: #475569;">Flexible infrastructure</td>
              <td style="color: #d97706; font-weight: 600;">Shared multi-tenant public cloud</td>
            </tr>
            <tr>
              <td style="font-weight: 700; color: #00173e;">Dedicated SLA Support</td>
              <td class="col-highlight">
                <strong style="color: #047857;">Direct Engineering Team</strong>
                <div style="font-size: 11px; color: #64748b;">24/7 priority developer SLA</div>
              </td>
              <td style="color: #475569;">Depends on internal hires</td>
              <td style="color: #475569;">Generic tier-1 helpdesk bot</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  {{-- 5. ENGINEERING & DEPLOYMENT LIFECYCLE (SCREENSHOT 1 FIX - 100% SOLID DARK NAVY & CRISP TEXT) --}}
  <section class="sq-process-section" aria-labelledby="process-title">
    <div class="sq-container" style="position: relative; z-index: 2;">
      <div class="sq-section-header">
        <span class="sq-section-tag" style="background: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.2); color: #ff944d;">
          Structured Delivery
        </span>
        <h2 id="process-title" class="sq-font-title sq-section-title">
          How We Customize &amp; Deploy Your Product
        </h2>
        <div class="sq-section-line"></div>
        <p class="sq-section-desc">
          Our refined 5-step engineering framework ensures guaranteed go-live timelines with zero disruption to your daily operations.
        </p>
      </div>

      <div class="sq-process-grid">
        {{-- Step 1 --}}
        <div class="sq-process-card">
          <span class="sq-process-badge">01</span>
          <div>
            <div class="sq-process-icon" style="color: #ff944d;">
              <iconify-icon icon="lucide:git-pull-request"></iconify-icon>
            </div>
            <h3 class="sq-font-title sq-process-name">Workflow Mapping</h3>
            <p class="sq-process-text">
              We map your existing operations, data entities, team roles, and third-party software integrations.
            </p>
          </div>
          <span class="sq-process-time">Timeline: 2-3 Days</span>
        </div>

        {{-- Step 2 --}}
        <div class="sq-process-card">
          <span class="sq-process-badge">02</span>
          <div>
            <div class="sq-process-icon" style="color: #38bdf8;">
              <iconify-icon icon="lucide:layout"></iconify-icon>
            </div>
            <h3 class="sq-font-title sq-process-name">Tailored Prototyping</h3>
            <p class="sq-process-text">
              Our UI/UX team styles the interface with your brand palette, typography, and tailored dashboard widgets.
            </p>
          </div>
          <span class="sq-process-time">Timeline: 4-6 Days</span>
        </div>

        {{-- Step 3 --}}
        <div class="sq-process-card">
          <span class="sq-process-badge">03</span>
          <div>
            <div class="sq-process-icon" style="color: #4ade80;">
              <iconify-icon icon="lucide:code-2"></iconify-icon>
            </div>
            <h3 class="sq-font-title sq-process-name">Custom Modules</h3>
            <p class="sq-process-text">
              Engineers configure specific business logic, unique calculations, custom APIs, and automated reports.
            </p>
          </div>
          <span class="sq-process-time">Timeline: 1-2 Weeks</span>
        </div>

        {{-- Step 4 --}}
        <div class="sq-process-card">
          <span class="sq-process-badge">04</span>
          <div>
            <div class="sq-process-icon" style="color: #f59e0b;">
              <iconify-icon icon="lucide:shield-check"></iconify-icon>
            </div>
            <h3 class="sq-font-title sq-process-name">Data Migration &amp; QA</h3>
            <p class="sq-process-text">
              Legacy data sanitized and migrated. Rigorous penetration testing, load testing, and staff training.
            </p>
          </div>
          <span class="sq-process-time">Timeline: 4-5 Days</span>
        </div>

        {{-- Step 5 --}}
        <div class="sq-process-card">
          <span class="sq-process-badge">05</span>
          <div>
            <div class="sq-process-icon" style="color: #c084fc;">
              <iconify-icon icon="lucide:rocket"></iconify-icon>
            </div>
            <h3 class="sq-font-title sq-process-name">Go-Live &amp; SLA</h3>
            <p class="sq-process-text">
              Smooth transition into production with active hypercare monitoring, team onboarding, and ongoing SLAs.
            </p>
          </div>
          <span class="sq-process-time">Ongoing Support</span>
        </div>
      </div>
    </div>
  </section>

  <section class="sq-demo-section" id="request-demo" aria-labelledby="demo-form-title">
    <div class="sq-container">
      <div class="sq-demo-layout">

        {{-- Left Column: Guidance & Quick Contact --}}
        <div class="sq-demo-info-box">
          <div>
            <span class="sq-section-tag">Get Direct Guidance</span>
            <h2 id="demo-form-title" class="sq-font-title sq-section-title" style="text-align: left; margin: 10px 0 12px 0;">
              Schedule a Live Architecture &amp; Product Walkthrough
            </h2>
            <p class="sq-section-desc" style="text-align: left; margin-bottom: 22px;">
              Speak directly with a Principal Product Architect. We will evaluate your business requirements, showcase a live interactive demo, and provide a comprehensive implementation roadmap.
            </p>
          </div>

          <div style="display: flex; flex-direction: column; gap: 14px;">
            <div class="sq-demo-benefit-card">
              <div class="sq-demo-benefit-icon" style="background: #fff3ec; color: #ff6600;">
                <iconify-icon icon="lucide:check"></iconify-icon>
              </div>
              <div>
                <h4 class="sq-demo-benefit-title">Live Screen-Share Demo</h4>
                <p class="sq-demo-benefit-desc">Explore the admin console, employee portals, and mobile app in action.</p>
              </div>
            </div>

            <div class="sq-demo-benefit-card">
              <div class="sq-demo-benefit-icon" style="background: #eff6ff; color: #2563eb;">
                <iconify-icon icon="lucide:check"></iconify-icon>
              </div>
              <div>
                <h4 class="sq-demo-benefit-title">Architecture &amp; Security Review</h4>
                <p class="sq-demo-benefit-desc">Discuss hosting topology, database security, and custom integrations.</p>
              </div>
            </div>

            <div class="sq-demo-benefit-card">
              <div class="sq-demo-benefit-icon" style="background: #ecfdf5; color: #059669;">
                <iconify-icon icon="lucide:check"></iconify-icon>
              </div>
              <div>
                <h4 class="sq-demo-benefit-title">Transparent Timeline &amp; Cost</h4>
                <p class="sq-demo-benefit-desc">Receive a detailed scope document with zero hidden fees or license gotchas.</p>
              </div>
            </div>
          </div>

          {{-- Direct Phone, Email & WhatsApp Callout (Side-by-Side Symmetrical Columns) --}}
          <div class="sq-demo-call-box">
            <div class="sq-demo-call-item">
              <div class="sq-demo-call-label">
                <iconify-icon icon="lucide:phone" width="12" height="12" style="color: #ff6600;"></iconify-icon>
                <span>Prefer a quick call?</span>
              </div>
              <a href="tel:+919646522110" class="sq-demo-call-num">
                +91 9646522110
              </a>
              <a href="https://wa.me/919646522110?text=Hello%20Sortiq,%20I%20would%20like%20to%20inquire%20about%20your%20products." target="_blank" rel="noopener" class="sq-whatsapp-pill">
                <iconify-icon icon="fa6-brands:whatsapp" width="15" height="15"></iconify-icon>
                <span>WhatsApp Us</span>
              </a>
            </div>

            <div class="sq-demo-call-item">
              <div class="sq-demo-call-label">
                <iconify-icon icon="lucide:mail" width="12" height="12" style="color: #ff6600;"></iconify-icon>
                <span>Prefer to email us?</span>
              </div>
              <a href="mailto:info@sortiqsolutions.com" class="sq-demo-call-num sq-demo-email-num">
                info@sortiqsolutions.com
              </a>
              <a href="mailto:info@sortiqsolutions.com" class="sq-email-pill">
                <iconify-icon icon="lucide:mail" width="14" height="14"></iconify-icon>
                <span>Email Us</span>
              </a>
            </div>
          </div>
        </div>

        {{-- Right Column: Lead Capture Form --}}
        <div>
          <div class="sq-form-panel">
            <h3 class="sq-font-title sq-form-title">Request Product Consultation</h3>
            <p class="sq-form-subtitle">Fill out the details below and an architect will respond within 4 business hours.</p>

            <form class="sortiq-contact-form" method="post" action="{{ route('api.contact-messages.store') }}">
              <input type="hidden" name="country_code" value="+91">
              
              {{-- Product of Interest Selection --}}
              <div class="sq-form-group">
                <label class="sq-form-label" for="product_select">
                  Platform or Product of Interest <span class="req">*</span>
                </label>
                <div class="sq-input-wrapper">
                  <select id="product_select" name="subject" class="sq-form-select" required>
                    <option value="CampusEdge Pro Demo Inquiry">CampusEdge Pro (Education &amp; Campus Management)</option>
                    <option value="Blogerzworld Demo Inquiry">Blogerzworld (Listings &amp; Content Platform)</option>
                    <option value="Custom Product Architecture Inquiry">Custom Product Architecture from Scratch</option>
                  </select>
                  <iconify-icon icon="lucide:chevron-down" width="18" height="18" class="sq-select-arrow"></iconify-icon>
                </div>
              </div>

              {{-- Name & Email Grid --}}
              <div class="sq-form-row sq-form-group">
                <div>
                  <label class="sq-form-label" for="client_name">
                    Full Name <span class="req">*</span>
                  </label>
                  <div class="sq-input-wrapper">
                    <iconify-icon icon="fa6-solid:user" class="sq-input-icon"></iconify-icon>
                    <input id="client_name" name="name" type="text" placeholder="Enter Name" class="sq-form-control" required>
                  </div>
                </div>

                <div>
                  <label class="sq-form-label" for="client_email">
                    Business Email <span class="req">*</span>
                  </label>
                  <div class="sq-input-wrapper">
                    <iconify-icon icon="fa6-solid:envelope" class="sq-input-icon"></iconify-icon>
                    <input id="client_email" name="email" type="email" placeholder="Enter Email" class="sq-form-control" required>
                  </div>
                </div>
              </div>

              {{-- Phone Number (Fix for Image 2) --}}
              <div class="sq-form-group">
                <label class="sq-form-label" for="product-phone">
                  Phone Number (WhatsApp Preferred) <span class="req">*</span>
                </label>
                <div class="sq-phone-wrap">
                  <input id="product-phone" name="phone" type="tel" placeholder="Enter Phone No." required autocomplete="tel-national">
                </div>
              </div>

              {{-- Key Requirements / Message --}}
              <div class="sq-form-group">
                <label class="sq-form-label" for="client_msg">
                  Key Requirements / Custom Needs <span class="req">*</span>
                </label>
                <textarea id="client_msg" name="message" rows="4" placeholder="Briefly describe your business, estimated user volume, or special custom workflows required..." class="sq-form-textarea" required></textarea>
              </div>

              {{-- Recaptcha Container --}}
              <div style="margin-bottom: 18px;">
                @include('components.recaptcha')
              </div>

              {{-- Submit Button --}}
              <button type="submit" class="sq-submit-btn">
                Request Demo
              </button>

              <div style="text-align: center; margin-top: 12px; font-size: 11px; color: #94a3b8; line-height: 1.4;">
                🔒 Guaranteed confidential. We sign Non-Disclosure Agreements (NDA) prior to technical calls.
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- 7. FREQUENTLY ASKED QUESTIONS (FAQ Accordion) --}}
  <section class="sq-faq-section" aria-labelledby="faq-title">
    <div class="sq-container">
      <div class="sq-section-header">
        <span class="sq-section-tag">Clarity &amp; Confidence</span>
        <h2 id="faq-title" class="sq-font-title sq-section-title">
          Frequently Asked Questions
        </h2>
        <div class="sq-section-line"></div>
        <p class="sq-section-desc">
          Everything you need to know about adopting and licensing Sortiq software platforms.
        </p>
      </div>

      <div class="sq-faq-container" id="sq-faq-accordion">

        {{-- FAQ 1 --}}
        <div class="sq-faq-item is-active">
          <button type="button" class="sq-faq-btn" aria-expanded="true">
            <span>Can Sortiq products be customized for our exact operational workflows?</span>
            <iconify-icon icon="lucide:chevron-down" class="sq-faq-icon"></iconify-icon>
          </button>
          <div class="sq-faq-panel">
            Yes, absolutely. Unlike rigid commercial SaaS vendors, Sortiq products are engineered on modular microservices. Our engineers adapt the database schema, business logic, user roles, UI design system, and custom reports to reflect your unique operating model 100%.
          </div>
        </div>

        {{-- FAQ 2 --}}
        <div class="sq-faq-item">
          <button type="button" class="sq-faq-btn" aria-expanded="false">
            <span>Who owns the source code and the databases once deployed?</span>
            <iconify-icon icon="lucide:chevron-down" class="sq-faq-icon"></iconify-icon>
          </button>
          <div class="sq-faq-panel">
            You maintain 100% full Intellectual Property (IP) and data ownership. Once tailored and deployed, you receive the full source code repositories and complete database schemas. There are zero perpetual seat taxes or arbitrary vendor restrictions.
          </div>
        </div>

        {{-- FAQ 3 --}}
        <div class="sq-faq-item">
          <button type="button" class="sq-faq-btn" aria-expanded="false">
            <span>Where will our software and data be hosted?</span>
            <iconify-icon icon="lucide:chevron-down" class="sq-faq-icon"></iconify-icon>
          </button>
          <div class="sq-faq-panel">
            You have full hosting flexibility. We can deploy directly into your existing enterprise cloud accounts (AWS, Google Cloud, Microsoft Azure, DigitalOcean) or onto your private on-premise physical servers, complete with automated disaster recovery and backup scripts.
          </div>
        </div>

        {{-- FAQ 4 --}}
        <div class="sq-faq-item">
          <button type="button" class="sq-faq-btn" aria-expanded="false">
            <span>Can these products connect with our existing legacy systems &amp; third-party APIs?</span>
            <iconify-icon icon="lucide:chevron-down" class="sq-faq-icon"></iconify-icon>
          </button>
          <div class="sq-faq-panel">
            Yes. All Sortiq platforms feature comprehensive RESTful and webhook APIs. We routinely connect with payment gateways (Stripe, Razorpay), ERPs (SAP, Tally, Zoho), courier aggregators (Shiprocket, FedEx), WhatsApp Business API, and biometric machines.
          </div>
        </div>

        {{-- FAQ 5 --}}
        <div class="sq-faq-item">
          <button type="button" class="sq-faq-btn" aria-expanded="false">
            <span>What kind of ongoing maintenance, upgrades, and SLA support do you provide?</span>
            <iconify-icon icon="lucide:chevron-down" class="sq-faq-icon"></iconify-icon>
          </button>
          <div class="sq-faq-panel">
            Every deployment includes dedicated hypercare support after launch. Furthermore, we offer comprehensive annual maintenance contracts (AMC) and 24/7 SLA tiers covering security updates, server monitoring, bug resolution, and continuous feature additions.
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- 8. BOTTOM HIGH-IMPACT CALL TO ACTION --}}
  <section class="sq-cta-section">
    <div class="sq-container">
      <div class="sq-cta-layout">
        <div class="sq-cta-content">
          <span class="sq-section-tag" style="background: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.2); color: #ff944d;">
            Accelerate Your Roadmap
          </span>
          <h2 class="sq-font-title sq-cta-title">
            Ready to Build on a Battle-Tested Product Foundation?
          </h2>
          <p class="sq-cta-desc">
            Book an obligation-free 30-minute discovery session with our Lead Solutions Architect and explore custom product blueprints.
          </p>
        </div>

        <div class="sq-cta-actions">
          <a href="#request-demo" class="sq-btn-primary" style="padding: 14px 26px; font-size: 13.5px; text-transform: uppercase;">
            <span>Book Discovery Session</span>
            <iconify-icon icon="lucide:arrow-right" width="18" height="18"></iconify-icon>
          </a>

          <a href="tel:+919646522110" class="sq-btn-outline-white" style="padding: 14px 22px;">
            <iconify-icon icon="lucide:phone" width="18" height="18"></iconify-icon>
            <span>+91 9646522110</span>
          </a>
        </div>
      </div>
    </div>
  </section>

</main>
@endsection

@push('scripts')
<script>
  // Product Filter Tabs
  document.addEventListener('DOMContentLoaded', function () {
    const filterButtons = document.querySelectorAll('.sq-filter-btn');
    const productCards = document.querySelectorAll('.sq-product-item-card');

    filterButtons.forEach(btn => {
      btn.addEventListener('click', function () {
        filterButtons.forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        const filter = this.getAttribute('data-filter');

        productCards.forEach(card => {
          const category = card.getAttribute('data-category');
          if (filter === 'all' || category === filter) {
            card.style.display = 'flex';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });

    // FAQ Accordion
    const faqButtons = document.querySelectorAll('.sq-faq-btn');
    faqButtons.forEach(btn => {
      btn.addEventListener('click', function () {
        const item = this.closest('.sq-faq-item');
        const isActive = item.classList.contains('is-active');

        document.querySelectorAll('.sq-faq-item').forEach(i => {
          i.classList.remove('is-active');
          const b = i.querySelector('.sq-faq-btn');
          if (b) b.setAttribute('aria-expanded', 'false');
        });

        if (!isActive) {
          item.classList.add('is-active');
          this.setAttribute('aria-expanded', 'true');
        }
      });
    });

    // Blueprint Modal Triggers
    const blueprintTriggers = document.querySelectorAll('.sq-blueprint-trigger');
    blueprintTriggers.forEach(btn => {
      btn.addEventListener('click', function () {
        const name = this.dataset.name;
        const tag = this.dataset.tag;
        const desc = this.dataset.desc;
        const stack = this.dataset.stack;
        const features = (this.dataset.features || '').split(';');

        document.getElementById('modal-prod-title').textContent = name;
        document.getElementById('modal-prod-tag').textContent = tag;
        document.getElementById('modal-prod-desc').textContent = desc;
        document.getElementById('modal-prod-stack').textContent = stack;

        const featureContainer = document.getElementById('modal-prod-features');
        featureContainer.innerHTML = '';
        features.forEach(feat => {
          if (feat.trim()) {
            const div = document.createElement('div');
            div.style.cssText = 'display:flex;align-items:center;gap:8px;padding:8px 10px;border-radius:8px;background:#f8fafc;border:1px solid #e2e8f0;font-size:11.5px;font-weight:700;color:#334155;';
            div.innerHTML = `<iconify-icon icon="lucide:check-circle-2" style="color:#ff6600;" width="15" height="15"></iconify-icon><span>${feat.trim()}</span>`;
            featureContainer.appendChild(div);
          }
        });

        document.getElementById('modal-demo-btn').onclick = function () {
          closeBlueprintModal();
          preselectProduct(name);
        };

        const modal = document.getElementById('blueprint-modal');
        modal.classList.add('is-open');
        document.body.style.overflow = 'hidden';
      });
    });

    // Phone Picker Initialization (Fix for Image 2)
    const phoneInput = document.getElementById('product-phone');
    if (phoneInput && typeof window.intlTelInput === 'function') {
      const form = phoneInput.closest('form');
      const countryCodeInput = form ? form.querySelector('input[name="country_code"]') : null;

      const phonePicker = window.intlTelInput(phoneInput, {
        initialCountry: 'in',
        separateDialCode: true,
        autoPlaceholder: 'off', 
        customPlaceholder: function() {
          return 'Enter Phone No.';
        },
        utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js',
      });

      phoneInput.placeholder = 'Enter Phone No.';
      phoneInput.setAttribute('placeholder', 'Enter Phone No.');

      const syncPhoneCode = function () {
        phoneInput.placeholder = 'Enter Phone No.';
        phoneInput.setAttribute('placeholder', 'Enter Phone No.');
        const countryData = phonePicker.getSelectedCountryData();
        if (countryCodeInput && countryData && countryData.dialCode) {
          countryCodeInput.value = '+' + countryData.dialCode;
        }
      };

      phoneInput.addEventListener('countrychange', syncPhoneCode);
      if (form) form.addEventListener('submit', syncPhoneCode);
      syncPhoneCode();
    }
  });

  function preselectProduct(productName) {
    const select = document.getElementById('product_select');
    if (!select) return;

    for (let i = 0; i < select.options.length; i++) {
      if (select.options[i].text.includes(productName) || select.options[i].value.includes(productName)) {
        select.selectedIndex = i;
        break;
      }
    }
  }
</script>
@endpush
