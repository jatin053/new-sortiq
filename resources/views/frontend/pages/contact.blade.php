@extends('layouts.frontend')

@section('title', 'contact us | sortiq solutions')
@section('body_attributes') data-route="/contact" @endsection

@push('head')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css">
  <style>
    .iti { width: 100%; display: block; }
    .iti__country-list { color: #333; text-align: left; }
    .iti__flag-container { border-right: 1px solid #ced4da; z-index: 2; }
    .contact-phone-field { padding-left: 0; overflow: visible !important; }
    .contact-phone-field input { padding-left: 54px !important; }
  </style>
@endpush

@section('content')
<main class="font-raleway">
  <div class="contact-page">
    <section class="contact-hero" aria-labelledby="contact-page-title">
      <div class="contact-hero-overlay"></div>
      <div class="contact-hero-content">
        <h1 id="contact-page-title">Contact Us</h1>
        <span></span>
      </div>
    </section>

    <section class="contact-main">
      <div class="contact-main-overlay"></div>
      <div class="inner-content">
        <div class="top-title">
          <h2>Get In Touch with Us!</h2>
          <p>We're here to assist</p>
          <div class="line-dec"></div>
        </div>

        <div class="contact-layout">
          <div class="contact-form-column">
            <form class="contact-form sortiq-contact-form" method="post" action="{{ route('api.contact-messages.store') }}">
              <input type="hidden" name="country_code" value="+91">

              <div class="contact-field-grid">
                <label class="contact-field">
                  <iconify-icon icon="fa6-solid:user" width="16" height="16"></iconify-icon>
                  <input name="name" type="text" placeholder="Enter Your Name" autocomplete="name" required>
                </label>

                <label class="contact-field">
                  <iconify-icon icon="fa6-solid:envelope" width="17" height="17"></iconify-icon>
                  <input name="email" type="email" placeholder="Enter Your Email" autocomplete="email" required>
                </label>
              </div>

              <div class="contact-field-grid">
                <div class="contact-field contact-phone-field">
                  <input id="contact-phone" name="phone" type="tel" inputmode="numeric" placeholder="Enter Your Phone Number" autocomplete="tel-national" required>
                </div>

                <label class="contact-field">
                  <iconify-icon icon="fa6-solid:list" width="16" height="16"></iconify-icon>
                  <input name="subject" type="text" placeholder="Subject" required>
                </label>
              </div>

              <label class="contact-field contact-message-field">
                <iconify-icon icon="fa6-solid:comments" width="18" height="18"></iconify-icon>
                <textarea name="message" rows="5" placeholder="Enter your message" required></textarea>
              </label>

              <div class="contact-recaptcha">
                @include('components.recaptcha')
              </div>

              <button type="submit" class="contact-submit">Send Message</button>
            </form>
          </div>

          <aside class="sidebar" aria-label="Contact details">
            <div class="item-b">
              <div class="ico-box">
                <iconify-icon icon="fa6-solid:phone" width="18" height="18" class="flip-ico"></iconify-icon>
              </div>
              <div>
                <h4>CALL US</h4>
                <p><a href="tel:+919646522110">+91 9646522110</a></p>
              </div>
            </div>

            <div class="item-b">
              <div class="ico-box">
                <iconify-icon icon="fa6-solid:envelope" width="18" height="18"></iconify-icon>
              </div>
              <div>
                <h4>WRITE US</h4>
                <p>
                  <a href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#105;&#110;&#102;&#111;&#64;&#115;&#111;&#114;&#116;&#105;&#113;&#115;&#111;&#108;&#117;&#116;&#105;&#111;&#110;&#115;&#46;&#99;&#111;&#109;">&#105;&#110;&#102;&#111;&#64;&#115;&#111;&#114;&#116;&#105;&#113;&#115;&#111;&#108;&#117;&#116;&#105;&#111;&#110;&#115;&#46;&#99;&#111;&#109;</a><br>
                  <a href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#115;&#111;&#114;&#116;&#105;&#113;&#115;&#111;&#108;&#117;&#116;&#105;&#111;&#110;&#115;&#64;&#103;&#109;&#97;&#105;&#108;&#46;&#99;&#111;&#109;">&#115;&#111;&#114;&#116;&#105;&#113;&#115;&#111;&#108;&#117;&#116;&#105;&#111;&#110;&#115;&#64;&#103;&#109;&#97;&#105;&#108;&#46;&#99;&#111;&#109;</a>
                </p>
              </div>
            </div>

            <div class="item-b">
              <div class="ico-box">
                <iconify-icon icon="fa6-solid:location-dot" width="18" height="18"></iconify-icon>
              </div>
              <div>
                <h4>VISIT US</h4>
                <p>E-51, Second Floor, Phase - 8, Industrial Area,<br>S.A.S. Nagar, Mohali, Punjab 160071</p>
              </div>
            </div>

            <div class="social-box">
              <a href="https://www.facebook.com/SortiqSolutions/" class="s-link" aria-label="Facebook" target="_blank" rel="noopener noreferrer"><iconify-icon icon="fa6-brands:facebook-f" width="15" height="15"></iconify-icon></a>
              <a href="https://www.linkedin.com/company/sortiq-solutions/" class="s-link" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer"><iconify-icon icon="fa6-brands:linkedin-in" width="15" height="15"></iconify-icon></a>
              <a href="https://www.instagram.com/sortiqsolutions/" class="s-link" aria-label="Instagram" target="_blank" rel="noopener noreferrer"><iconify-icon icon="fa6-brands:instagram" width="15" height="15"></iconify-icon></a>
              <a href="https://www.youtube.com/@SortiqSolutions" class="s-link" aria-label="YouTube" target="_blank" rel="noopener noreferrer"><iconify-icon icon="fa6-brands:youtube" width="15" height="15"></iconify-icon></a>
              <a href="https://x.com/SortiqSolutions" class="s-link" aria-label="Twitter" target="_blank" rel="noopener noreferrer"><iconify-icon icon="fa6-brands:twitter" width="15" height="15"></iconify-icon></a>
              <a href="https://www.google.com/search?q=Sortiq+Solutions+Pvt.+Ltd." class="s-link" aria-label="Google" target="_blank" rel="noopener noreferrer"><iconify-icon icon="fa6-brands:google" width="15" height="15"></iconify-icon></a>
            </div>
          </aside>
        </div>
      </div>
    </section>

    <section class="contact-map" aria-label="Sortiq Solutions location map">
      <iframe
        title="Sortiq Solutions Pvt. Ltd. location"
        src="https://www.google.com/maps?q=Sortiq+Solutions+Mohali&output=embed"
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        allowfullscreen
      ></iframe>
    </section>

    <style>
      .contact-page {
        background: #fff;
        color: #001a3d;
      }

      .contact-page * {
        font-family: "Raleway", "Nunito", ui-sans-serif, system-ui, sans-serif !important;
      }

      .contact-hero {
        position: relative;
        min-height: 204px;
        display: flex;
        align-items: center;
        justify-content: center;
        background:
          linear-gradient(rgba(0, 0, 0, 0.56), rgba(0, 0, 0, 0.56)),
          url("{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/contact-background.jpg') }}");
        background-position: center;
        background-size: cover;
        color: #fff;
        text-align: center;
        overflow: hidden;
      }

      .contact-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
          linear-gradient(120deg, rgba(0, 26, 61, 0.52), transparent 38%, rgba(255, 102, 0, 0.16) 57%, rgba(0, 0, 0, 0.36));
      }

      .contact-hero-content {
        position: relative;
        z-index: 1;
      }

      .contact-hero h1 {
        margin: 0;
        color: #fff;
        font-size: 34px;
        font-weight: 700;
        line-height: 1.2;
      }

      .contact-hero span {
        display: block;
        width: 40px;
        height: 3px;
        margin: 29px auto 0;
        background: #fff;
      }

      .contact-main {
        position: relative;
        padding: 60px 0 66px;
        background:
          linear-gradient(rgba(237, 245, 251, 0.86), rgba(237, 245, 251, 0.86)),
          url("{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/104041.jpg') }}");
        background-position: center;
        background-size: cover;
        overflow: hidden;
      }

      .contact-main::before,
      .contact-main::after {
        content: "";
        position: absolute;
        width: 520px;
        height: 450px;
        border: 18px solid rgba(255, 255, 255, 0.38);
        border-radius: 50%;
        pointer-events: none;
      }

      .contact-main::before {
        left: -380px;
        top: -42px;
      }

      .contact-main::after {
        right: -290px;
        bottom: -240px;
      }

      .contact-main-overlay {
        position: absolute;
        inset: 0;
        background:
          radial-gradient(circle at 0 22%, rgba(219, 249, 250, 0.8), transparent 30%),
          linear-gradient(110deg, rgba(255, 255, 255, 0.28), transparent 34%);
        pointer-events: none;
      }

      .contact-page .inner-content {
        position: relative;
        z-index: 1;
        width: min(1094px, calc(100% - 48px));
        margin: 0 auto;
      }

      .contact-page .top-title {
        text-align: center;
        margin-bottom: 39px;
      }

      .contact-page .top-title h2 {
        margin: 0 0 13px;
        color: #001a3d;
        font-size: 28px;
        font-weight: 700;
        line-height: 1.22;
      }

      .contact-page .top-title p {
        margin: 0;
        color: #001a3d;
        font-size: 22px;
        font-weight: 700;
        line-height: 1.2;
      }

      .contact-page .line-dec {
        width: 40px;
        height: 3px;
        background: #ff5a0a;
        margin: 28px auto 0;
      }

      .contact-page .contact-layout {
        display: grid;
        grid-template-columns: minmax(0, 540px) minmax(0, 500px);
        gap: 74px;
        align-items: start;
      }

      .contact-form {
        display: flex;
        flex-direction: column;
        gap: 16px;
      }

      .contact-field-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 30px;
      }

      .contact-field {
        position: relative;
        display: flex;
        align-items: center;
        min-height: 49px;
        border: 1px solid #c9cfd6;
        border-radius: 4px;
        background: rgba(255, 255, 255, 0.8);
        color: #ff5a0a;
        overflow: hidden;
      }

      .contact-field iconify-icon {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #ff5a0a;
        z-index: 1;
      }

      .contact-field input,
      .contact-field textarea {
        width: 100%;
        min-width: 0;
        border: 0;
        background: transparent;
        color: #001a3d;
        font-size: 16px;
        font-style: italic;
        font-weight: 500;
        outline: 0;
      }

      .contact-field input {
        height: 49px;
        padding: 0 14px 0 35px;
      }

      .contact-field textarea {
        min-height: 118px;
        padding: 13px 14px 13px 35px;
        resize: vertical;
      }

      .contact-field input::placeholder,
      .contact-field textarea::placeholder {
        color: #9aa0a6;
        opacity: 1;
      }

      .contact-field:focus-within {
        border-color: #ff5a0a;
        background: #fff;
      }

      .contact-message-field {
        min-height: 118px;
        align-items: flex-start;
      }

      .contact-message-field iconify-icon {
        top: auto;
        bottom: 60px;
        transform: none;
      }

      .contact-phone-prefix {
        position: absolute;
        left: 10px;
        top: 50%;
        z-index: 1;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        transform: translateY(-50%);
      }

      .contact-phone-flag {
        width: 22px;
        height: 15px;
        object-fit: cover;
        border-radius: 1px;
      }

      .contact-phone-caret {
        width: 0;
        height: 0;
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-top: 5px solid #4b5563;
      }

      .contact-phone-field input {
        padding-left: 52px;
      }

      .contact-recaptcha {
        padding-top: 13px;
      }

      .contact-recaptcha .g-recaptcha {
        justify-content: flex-start;
      }

      .contact-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        min-height: 52px;
        margin-top: 2px;
        border: 0;
        border-radius: 4px;
        background: #ff5a0a;
        color: #fff;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s ease;
      }

      .contact-submit:hover {
        background: #00173e;
      }

      .contact-page .sidebar {
        display: flex;
        flex-direction: column;
        gap: 29px;
        padding-top: 10px;
      }

      .contact-page .item-b {
        display: flex;
        align-items: flex-start;
        gap: 13px;
      }

      .contact-page .ico-box {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto;
        width: 42px;
        height: 42px;
        border-radius: 999px;
        background: #ff5a0a;
        color: #fff;
      }
      .contact-page .ico-box:hover{
        background: #00173e;
      }

      .contact-page .flip-ico {
        transform: scaleX(1);
      }

      .contact-page .item-b h4 {
        margin: 3px 0 8px;
        color: #001a3d;
        font-size: 25px;
        font-weight: 600;
        line-height: 1.1;
        font-family: Arial, sans-serif !important;
      }

      .contact-page .item-b p {
        margin: 0;
        color: #001a3d;
        font-size: 19px;
        font-weight: 600;
        line-height: 1.62;
      }

      .contact-page .item-b a {
        color: inherit;
        text-decoration: none;
      }

      .contact-page .item-b a:hover {
        color: #ff5a0a;
      }

      .contact-page .social-box {
        display: flex;
        flex-wrap: wrap;
        gap: 9px;
        margin-top: 40px;
      }

      .contact-page .s-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 999px;
        background: #ff5a0a;
        color: #fff;
        transition: background 0.2s ease, transform 0.2s ease;
      }

      .contact-page .s-link:hover {
        background: #001a3d;
        color: #fff;
        transform: translateY(-2px);
      }

      .contact-map {
        width: 100%;
        padding: 10px 12px 0;
        background: #fff;
        padding-bottom:20px !important;
      }

      .contact-map iframe {
        display: block;
        width: 100%;
        height: 520px;
        border: 0;
      }

      @media (max-width: 1023px) {
        .contact-page .contact-layout {
          grid-template-columns: 1fr;
          gap: 42px;
        }

        .contact-page .sidebar {
          padding-top: 0;
        }
      }

      @media (max-width: 767px) {
        .contact-hero {
          min-height: 170px;
        }

        .contact-hero h1 {
          font-size: 30px;
        }

        .contact-main {
          padding: 48px 0 52px;
        }

        .contact-page .inner-content {
          width: min(100% - 28px, 1094px);
        }

        .contact-page .top-title h2 {
          font-size: 26px;
        }

        .contact-page .top-title p {
          font-size: 20px;
        }

        .contact-field-grid {
          grid-template-columns: 1fr;
          gap: 16px;
        }

        .contact-page .item-b p {
          font-size: 16px;
        }

        .contact-page .item-b h4 {
          font-size: 19px;
        }

        .contact-map {
          padding-inline: 8px;
        }

        .contact-map iframe {
          height: 380px;
        }
      }
    </style>
  </div>
</main>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const phoneInputField = document.querySelector("#contact-phone");
    const countryCodeField = document.querySelector("input[name='country_code']");
    
    if (phoneInputField && window.intlTelInput) {
      const phoneInput = window.intlTelInput(phoneInputField, {
        initialCountry: "in",
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js",
      });

      // RESTRICT TO NUMBERS ONLY
      phoneInputField.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^\d]/g, '');
      });

      phoneInputField.addEventListener("countrychange", function() {
        if (countryCodeField) {
          countryCodeField.value = "+" + window.intlTelInputGlobals.getInstance(phoneInputField).getSelectedCountryData().dialCode;
        }
      });
    }
  });
</script>
@endpush
