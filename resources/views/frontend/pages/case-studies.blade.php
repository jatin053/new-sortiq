@extends('layouts.frontend')

@section('title', 'Case Studies | Sortiq Solutions Project Results')
@section('body_attributes') data-route="/case-studies" @endsection

@push('head')
<style>
/* ==========================================================================
   CASE STUDIES PAGE STYLING
   ========================================================================== */
.cs-page {
  background-color: #fafbfd;
  color: #00163e;
  font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  padding: 40px 20px 90px;
}

.cs-container {
  max-width: 1040px;
  margin: 0 auto;
}

/* ---------- Header / Hero ---------- */
.cs-hero {
  text-align: center;
  margin-bottom: 55px;
}

.cs-breadcrumb {
  font-size: 13.5px;
  color: #64748b;
  margin-bottom: 22px;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px;
}

.cs-breadcrumb a {
  color: #64748b;
  text-decoration: none;
  transition: color 0.2s;
}

.cs-breadcrumb a:hover {
  color: #ff5800;
}

.cs-breadcrumb .cs-sep {
  font-size: 11px;
  opacity: 0.6;
}

.cs-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: rgba(255, 88, 0, 0.08);
  color: #ff5800;
  border: 1px solid rgba(255, 88, 0, 0.22);
  padding: 6px 16px;
  border-radius: 30px;
  font-size: 11.5px;
  font-weight: 800;
  letter-spacing: 1px;
  text-transform: uppercase;
  margin-bottom: 18px;
}

.cs-title {
  color: #00163e;
  font-size: 46px;
  font-weight: 800;
  margin: 0 0 16px;
  line-height: 1.2;
  letter-spacing: -0.5px;
}

.cs-subtitle {
  color: #64748b;
  font-size: 17px;
  line-height: 1.6;
  max-width: 650px;
  margin: 0 auto;
}

/* ---------- Case Study Card ---------- */
.cs-card {
  background: #ffffff;
  border: 1px solid #e5eaf2;
  border-radius: 20px;
  padding: 40px 45px;
  margin-bottom: 34px;
  box-shadow: 0 10px 30px rgba(0, 22, 62, 0.035);
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.cs-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 18px 40px rgba(0, 22, 62, 0.08);
}

.cs-card-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 14px;
  gap: 15px;
}

.cs-card-tag {
  color: #ff5800;
  font-size: 12px;
  font-weight: 800;
  letter-spacing: 1.2px;
  text-transform: uppercase;
}

.cs-card-metric {
  background: #fff6f0;
  color: #ff5800;
  border: 1px solid #fed7aa;
  padding: 6px 18px;
  border-radius: 20px;
  font-size: 14px;
  font-weight: 800;
  letter-spacing: 0.3px;
  white-space: nowrap;
}

.cs-card-title {
  color: #00163e;
  font-size: 27px;
  font-weight: 800;
  line-height: 1.35;
  margin: 0 0 28px;
}

/* Two-column Problem / Solution */
.cs-card-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 36px;
  margin-bottom: 30px;
}

.cs-card-col h4 {
  color: #64748b;
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 1.2px;
  text-transform: uppercase;
  margin: 0 0 8px;
}

.cs-card-col p {
  color: #334155;
  font-size: 15px;
  line-height: 1.65;
  margin: 0;
}

/* Bottom Results Checklist & CTA */
.cs-card-bottom {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  padding-top: 24px;
  border-top: 1px solid #f1f5f9;
  gap: 20px;
  flex-wrap: wrap;
}

.cs-checklist {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.cs-checklist li {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 14.5px;
  color: #1e293b;
  font-weight: 500;
}

.cs-check-icon {
  width: 20px;
  height: 20px;
  border-radius: 4px;
  background: #fff6f0;
  border: 1px solid #fed7aa;
  color: #ff5800;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  flex-shrink: 0;
}

.cs-card-btn {
  background: #ff5800;
  color: #ffffff !important;
  font-size: 14.5px;
  font-weight: 700;
  padding: 13px 26px;
  border-radius: 10px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.2s ease;
  white-space: nowrap;
  box-shadow: 0 4px 14px rgba(255, 88, 0, 0.28);
}

.cs-card-btn:hover {
  background: #e04e00;
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(255, 88, 0, 0.38);
}

/* ---------- Consultation Form Section ---------- */
.cs-form-wrap {
  margin-top: 60px;
  display: flex;
  justify-content: center;
}

.cs-form-card {
  background: #ffffff;
  border: 1px solid #e5eaf2;
  border-radius: 22px;
  padding: 45px 50px;
  width: 100%;
  max-width: 720px;
  box-shadow: 0 12px 35px rgba(0, 22, 62, 0.04);
}

.cs-form-head {
  text-align: center;
  margin-bottom: 30px;
}

.cs-form-head h3 {
  color: #00163e;
  font-size: 27px;
  font-weight: 800;
  margin: 12px 0 8px;
}

.cs-form-head p {
  color: #64748b;
  font-size: 15px;
  margin: 0;
}

.cs-form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
  margin-bottom: 16px;
}

.cs-field {
  display: flex;
  flex-direction: column;
  gap: 6px;
  margin-bottom: 16px;
}

.cs-field label {
  font-size: 13px;
  font-weight: 700;
  color: #334155;
}

.cs-field label span {
  color: #ff5800;
}

.cs-input-box {
  position: relative;
  display: flex;
  align-items: center;
}

.cs-input-box iconify-icon {
  position: absolute;
  left: 14px;
  color: #94a3b8;
  pointer-events: none;
}

.cs-input-box input,
.cs-input-box select,
.cs-field textarea {
  width: 100%;
  padding: 13px 14px;
  border: 1px solid #dbe2ea;
  border-radius: 10px;
  font-size: 15px;
  color: #0f172a;
  background: #fafbfd;
  outline: none;
  transition: all 0.2s ease;
  box-sizing: border-box;
  font-family: inherit;
}

.cs-input-box input {
  padding-left: 42px;
}

.cs-input-box input:focus,
.cs-input-box select:focus,
.cs-field textarea:focus {
  background: #ffffff;
  border-color: #ff5800;
  box-shadow: 0 0 0 3px rgba(255, 88, 0, 0.12);
}

.cs-field textarea {
  resize: vertical;
  min-height: 110px;
}

.cs-recaptcha-wrap {
  margin: 18px 0 20px;
  display: flex;
  justify-content: flex-start;
}

.cs-submit-btn {
  width: 100%;
  background: #ff5800;
  color: #ffffff;
  border: none;
  border-radius: 10px;
  padding: 15px;
  font-size: 16px;
  font-weight: 700;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  transition: all 0.25s ease;
  box-shadow: 0 4px 15px rgba(255, 88, 0, 0.3);
}

.cs-submit-btn:hover {
  background: #e04e00;
  box-shadow: 0 6px 20px rgba(255, 88, 0, 0.4);
}

.cs-submit-btn:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.cs-form-feedback {
  margin-top: 15px;
  font-size: 14.5px;
  font-weight: 600;
  text-align: center;
  display: none;
}

.cs-form-feedback.success {
  color: #0a8a00;
  display: block;
}

.cs-form-feedback.error {
  color: #d40000;
  display: block;
}

/* ---------- Responsive ---------- */
@media (max-width: 820px) {
  .cs-title {
    font-size: 34px;
  }
  .cs-card {
    padding: 30px 24px;
  }
  .cs-card-title {
    font-size: 22px;
  }
  .cs-card-grid {
    grid-template-columns: 1fr;
    gap: 20px;
  }
  .cs-card-bottom {
    flex-direction: column;
    align-items: stretch;
  }
  .cs-card-btn {
    justify-content: center;
    width: 100%;
  }
  .cs-form-card {
    padding: 30px 20px;
  }
  .cs-form-grid {
    grid-template-columns: 1fr;
    gap: 0;
  }
}
</style>
@endpush

@section('content')
<main class="cs-page">
  <div class="cs-container">

    {{-- Breadcrumb & Hero Header --}}
    <section class="cs-hero">
      <nav class="cs-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ url('/') }}">Home</a>
        <span class="cs-sep">&gt;</span>
        <span>Case Studies</span>
      </nav>

      <div class="cs-badge">
        <iconify-icon icon="lucide:zap" width="14" height="14"></iconify-icon>
        <span>PROVEN RESULTS</span>
      </div>

      <h1 class="cs-title">Case Studies</h1>
      <p class="cs-subtitle">
        Data-driven breakdowns of how our engineering and marketing strategies deliver exponential growth.
      </p>
    </section>

    {{-- =========================================================================
         CASE STUDY CARDS
         ========================================================================= --}}

    {{-- Card 1: E-Commerce --}}
    <article class="cs-card">
      <div class="cs-card-top">
        <span class="cs-card-tag">GLOBAL RETAIL BRAND</span>
        <span class="cs-card-metric">+210% ROI</span>
      </div>

      <h2 class="cs-card-title">Twice Profit Than Before: E-Commerce Architecture Modernization</h2>

      <div class="cs-card-grid">
        <div class="cs-card-col">
          <h4>THE CHALLENGE</h4>
          <p>High cart abandonment, sluggish checkout speeds on mobile, and poor SEO indexing.</p>
        </div>
        <div class="cs-card-col">
          <h4>OUR TECHNICAL SOLUTION</h4>
          <p>Migrated to a headless Next.js frontend with optimized checkout flows, CDN asset compression, and automated structured data.</p>
        </div>
      </div>

      <div class="cs-card-bottom">
        <ul class="cs-checklist">
          <li>
            <span class="cs-check-icon"><iconify-icon icon="lucide:check" width="13" height="13"></iconify-icon></span>
            <span>Checkout completion increased by 64%</span>
          </li>
          <li>
            <span class="cs-check-icon"><iconify-icon icon="lucide:check" width="13" height="13"></iconify-icon></span>
            <span>Page load times dropped from 4.8s to 0.9s</span>
          </li>
          <li>
            <span class="cs-check-icon"><iconify-icon icon="lucide:check" width="13" height="13"></iconify-icon></span>
            <span>Organic search conversions doubled within 90 days</span>
          </li>
        </ul>

        <a href="#consultation-form" class="cs-card-btn">
          <span>Discuss Similar Project</span>
          <iconify-icon icon="lucide:arrow-right" width="16" height="16"></iconify-icon>
        </a>
      </div>
    </article>

    {{-- Card 2: SaaS Platform --}}
    <article class="cs-card">
      <div class="cs-card-top">
        <span class="cs-card-tag">ENTERPRISE SAAS PLATFORM</span>
        <span class="cs-card-metric">1.2M+ Visitors</span>
      </div>

      <h2 class="cs-card-title">Million Visitor Growth: Scalable SaaS Infrastructure &amp; SEO</h2>

      <div class="cs-card-grid">
        <div class="cs-card-col">
          <h4>THE CHALLENGE</h4>
          <p>Server bottlenecks during traffic spikes and flat organic search impression curves.</p>
        </div>
        <div class="cs-card-col">
          <h4>OUR TECHNICAL SOLUTION</h4>
          <p>Engineered scalable cloud architecture with Redis caching, microservices API gateway, and deep technical SEO audits.</p>
        </div>
      </div>

      <div class="cs-card-bottom">
        <ul class="cs-checklist">
          <li>
            <span class="cs-check-icon"><iconify-icon icon="lucide:check" width="13" height="13"></iconify-icon></span>
            <span>Handled 75,000 concurrent requests with zero downtime</span>
          </li>
          <li>
            <span class="cs-check-icon"><iconify-icon icon="lucide:check" width="13" height="13"></iconify-icon></span>
            <span>Ranked #1 for 120+ target enterprise search terms</span>
          </li>
          <li>
            <span class="cs-check-icon"><iconify-icon icon="lucide:check" width="13" height="13"></iconify-icon></span>
            <span>Lowered server compute costs by 38%</span>
          </li>
        </ul>

        <a href="#consultation-form" class="cs-card-btn">
          <span>Discuss Similar Project</span>
          <iconify-icon icon="lucide:arrow-right" width="16" height="16"></iconify-icon>
        </a>
      </div>
    </article>

    {{-- Card 3: B2B Modern CMS --}}
    <article class="cs-card">
      <div class="cs-card-top">
        <span class="cs-card-tag">B2B PROFESSIONAL SERVICES</span>
        <span class="cs-card-metric">98/100 Lighthouse</span>
      </div>

      <h2 class="cs-card-title">Built Web Faster &amp; Better: Modern CMS &amp; Performance Overhaul</h2>

      <div class="cs-card-grid">
        <div class="cs-card-col">
          <h4>THE CHALLENGE</h4>
          <p>Outdated legacy site with poor mobile responsiveness and high bounce rate.</p>
        </div>
        <div class="cs-card-col">
          <h4>OUR TECHNICAL SOLUTION</h4>
          <p>Redesigned complete brand identity in Figma and delivered high-speed responsive web application with interactive widgets.</p>
        </div>
      </div>

      <div class="cs-card-bottom">
        <ul class="cs-checklist">
          <li>
            <span class="cs-check-icon"><iconify-icon icon="lucide:check" width="13" height="13"></iconify-icon></span>
            <span>Mobile bounce rate decreased by 46%</span>
          </li>
          <li>
            <span class="cs-check-icon"><iconify-icon icon="lucide:check" width="13" height="13"></iconify-icon></span>
            <span>Lighthouse performance score jumped to 98/100</span>
          </li>
          <li>
            <span class="cs-check-icon"><iconify-icon icon="lucide:check" width="13" height="13"></iconify-icon></span>
            <span>Lead form submissions increased by 83% in first month</span>
          </li>
        </ul>

        <a href="#consultation-form" class="cs-card-btn">
          <span>Discuss Similar Project</span>
          <iconify-icon icon="lucide:arrow-right" width="16" height="16"></iconify-icon>
        </a>
      </div>
    </article>

    {{-- =========================================================================
         INQUIRY / CONSULTATION FORM
         ========================================================================= --}}
    <section class="cs-form-wrap" id="consultation-form">
      <div class="cs-form-card">
        <div class="cs-form-head">
          <div class="cs-badge">
            <iconify-icon icon="lucide:zap" width="14" height="14"></iconify-icon>
            <span>QUICK CONSULTATION</span>
          </div>
          <h3>Ready to Scale Your Project?</h3>
          <p>Have a project in mind or need expert IT consulting? Get in touch with our team today.</p>
        </div>

        <form id="caseStudyInquiryForm" method="POST" action="{{ route('api.contact-messages.store') }}">
          @csrf
          <input type="hidden" name="type" value="case-study">
          <input type="hidden" name="subject" value="Case Study Consultation">
          <input type="hidden" name="url" value="{{ url()->current() }}">

          <div class="cs-form-grid">
            <div class="cs-field" style="margin-bottom: 0;">
              <label for="csName">Your Name <span>*</span></label>
              <div class="cs-input-box">
                <iconify-icon icon="lucide:user" width="17" height="17"></iconify-icon>
                <input type="text" id="csName" name="name" placeholder="Enter Name" autocomplete="name" required>
              </div>
            </div>

            <div class="cs-field" style="margin-bottom: 0;">
              <label for="csPhone">Your Phone <span>*</span></label>
              <div class="cs-input-box">
                <iconify-icon icon="lucide:phone" width="17" height="17"></iconify-icon>
                <input type="tel" id="csPhone" name="phone" placeholder="Enter Phone No." autocomplete="tel" required>
              </div>
            </div>
          </div>

          <div class="cs-field">
            <label for="csEmail">Your Email <span>*</span></label>
            <div class="cs-input-box">
              <iconify-icon icon="lucide:mail" width="17" height="17"></iconify-icon>
              <input type="email" id="csEmail" name="email" placeholder="contact@company.com" autocomplete="email" required>
            </div>
          </div>

          <div class="cs-field">
            <label for="csService">Service You Need <span>*</span></label>
            <div class="cs-input-box">
              <select id="csService" name="technology" required>
                <option value="Website Development" selected>Website Development</option>
                <option value="Web Designing">Web Designing</option>
                <option value="Mobile App Development">Mobile App Development</option>
                <option value="Digital Marketing & SEO">Digital Marketing &amp; SEO</option>
                <option value="SaaS & Custom Software">SaaS &amp; Custom Software</option>
                <option value="E-Commerce Solutions">E-Commerce Solutions</option>
                <option value="Cloud & DevOps">Cloud &amp; DevOps</option>
              </select>
            </div>
          </div>

          <div class="cs-field">
            <label for="csMessage">Project Details / Message</label>
            <textarea id="csMessage" name="message" placeholder="Tell us about your project requirements, scope or timeline..."></textarea>
          </div>

          <div class="cs-recaptcha-wrap">
            @include('components.recaptcha')
          </div>

          <button type="submit" id="csSubmitBtn" class="cs-submit-btn">
            <span>Send Enquiry</span>
            <iconify-icon icon="lucide:arrow-right" width="18" height="18"></iconify-icon>
          </button>

          <div id="csFormFeedback" class="cs-form-feedback"></div>
        </form>
      </div>
    </section>

  </div>
</main>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
  // Smooth scroll for "Discuss Similar Project" buttons
  document.querySelectorAll('a[href^="#consultation-form"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        const nameInput = target.querySelector('#csName');
        if (nameInput) setTimeout(() => nameInput.focus(), 600);
      }
    });
  });

  // Handle AJAX Form Submission
  const form = document.getElementById("caseStudyInquiryForm");
  const submitBtn = document.getElementById("csSubmitBtn");
  const feedback = document.getElementById("csFormFeedback");

  if (!form) return;

  form.addEventListener("submit", function(e) {
    e.preventDefault();

    feedback.style.display = "none";
    feedback.className = "cs-form-feedback";
    feedback.innerHTML = "";

    const phoneInput = form.querySelector('#csPhone');
    if (phoneInput && phoneInput.value.trim()) {
      const digits = phoneInput.value.replace(/\D+/g, "");
      if (digits.length !== 10 || !/^[6-9]\d{9}$/.test(digits)) {
        feedback.style.display = "block";
        feedback.className = "cs-form-feedback error";
        feedback.innerHTML = "Please enter a valid 10-digit Indian phone number starting with 6, 7, 8, or 9.";
        phoneInput.focus();
        return;
      }
    }

    submitBtn.disabled = true;
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = "<span>Sending Enquiry...</span>";

    const formData = new FormData(form);
    formData.set("url", window.location.href);

    fetch(form.action, {
      method: "POST",
      body: formData,
      headers: {
        "X-Requested-With": "XMLHttpRequest",
        "Accept": "application/json"
      }
    })
    .then(async response => {
      const data = await response.json().catch(() => ({}));
      if (response.ok) {
        feedback.className = "cs-form-feedback success";
        feedback.innerHTML = "✔ " + (data.message || "Thank you! Your enquiry has been sent successfully. We will get back to you shortly.");
        form.reset();
      } else {
        feedback.className = "cs-form-feedback error";
        let errMsg = data.message || "Please complete all required fields and try again.";
        if (data.errors && typeof data.errors === 'object') {
          const firstErr = Object.values(data.errors).flat()[0];
          if (firstErr) errMsg = firstErr;
        }
        feedback.innerHTML = "❌ " + errMsg;
      }
    })
    .catch(() => {
      feedback.className = "cs-form-feedback error";
      feedback.innerHTML = "❌ Something went wrong. Please check your network connection or call us directly.";
    })
    .finally(() => {
      submitBtn.disabled = false;
      submitBtn.innerHTML = originalText;
    });
  });
});
</script>
@endpush
