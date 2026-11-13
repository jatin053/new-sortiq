@props([
    'action' => route('api.contact-messages.store'),
    'title' => 'Partner with Sortiq Solutions!',
    'id' => null,
    'type' => 'contact',
    'buttonText' => 'Send Message'
])

<div class="sq-common-form-wrap">
  @if (!empty($title))
    <h2 class="sq-heading sq-lines">{{ $title }}</h2>
  @endif

  <form action="{{ $action }}" method="post" class="sq-form sortiq-contact-form" @if($id) id="{{ $id }}" @endif>
    @csrf
    <input type="hidden" name="action" value="sortiq_contact_form">
    <input type="hidden" name="country_code" value="+91">
    <input type="hidden" name="type" value="{{ $type }}">

    <div class="sq-form-row">
      <label class="sq-field">
        <iconify-icon icon="fa6-solid:user"></iconify-icon>
        <input class="sq-input" name="name" type="text" placeholder="Enter Your Name" autocomplete="name" required>
      </label>

      <label class="sq-field">
        <iconify-icon icon="fa6-solid:envelope"></iconify-icon>
        <input class="sq-input" name="email" type="email" placeholder="Enter Your Email" autocomplete="email" required>
      </label>
    </div>

    <div class="sq-form-row">
      <div class="sq-field sq-phone-field">
        <input class="sq-input" name="phone" type="tel" placeholder="Enter Phone No." autocomplete="tel" required>
      </div>

      <label class="sq-field">
        <iconify-icon icon="fa6-solid:list"></iconify-icon>
        <input class="sq-input" name="subject" type="text" placeholder="Subject" required>
      </label>
    </div>

    <label class="sq-field">
      <iconify-icon class="sq-textarea-icon" icon="fa6-solid:comments"></iconify-icon>
      <textarea class="sq-textarea" name="message" placeholder="Enter your message" required></textarea>
    </label>

    <div class="sq-recaptcha is-visible" aria-live="polite">
      @include('components.recaptcha')
    </div>

    <button type="submit" class="sq-submit">{{ $buttonText }}</button>
  </form>
</div>

@once
<style>
  .sq-common-form-wrap {
    width: 100%;
  }

  .sq-heading.sq-lines {
    font-size: 32px;
    font-weight: 700;
    color: #000;
    line-height: 1.25;
    margin: 0 0 20px;
    text-align: left;
  }

  .sq-heading.sq-lines::after {
    content: "";
    display: block;
    width: 40px;
    height: 3px;
    margin: 18px 0 24px;
    background: #ff6600;
  }

  .sq-form {
    display: grid;
    gap: 15px;
    width: 100%;
  }

  .sq-form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
  }

  .sq-field {
    position: relative;
    display: block;
    background: #fff;
    border: 1px solid #dcdcdc;
    border-radius: 4px;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }

  .sq-field:focus-within {
    border-color: #ff6600;
    box-shadow: 0 0 0 3px rgba(255, 102, 0, 0.15);
  }

  .sq-field iconify-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    z-index: 2;
    color: #ff6600;
    font-size: 18px;
    transform: translateY(-50%);
    pointer-events: none;
  }

  .sq-field .sq-textarea-icon {
    top: 24px;
    transform: none;
  }

  .sq-input,
  .sq-textarea {
    width: 100%;
    border: 0;
    border-radius: 4px;
    outline: none;
    color: #222;
    background: #fff;
    font-family: 'Nunito', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    font-size: 15px;
    box-sizing: border-box;
  }

  .sq-input {
    height: 56px;
    min-height: 56px;
    padding: 13px 15px 13px 45px;
  }

  .sq-textarea {
    min-height: 110px;
    padding: 18px 15px 15px 45px;
    resize: vertical;
  }

  .sq-input::placeholder,
  .sq-textarea::placeholder {
    color: #9c9c9c;
    opacity: 1;
    font-style: italic;
  }

  /* Phone Field */
  .sq-phone-field {
    position: relative;
    z-index: 50;
    min-height: 56px;
    border: 1px solid #dcdcdc;
    border-radius: 4px;
    background: #fff;
    overflow: visible;
  }

  .sq-phone-field:focus-within {
    border-color: #ff6600;
    box-shadow: 0 0 0 3px rgba(255, 102, 0, 0.15);
  }

  .sq-phone-field .iti {
    width: 100%;
    height: 100%;
    position: relative;
    display: block;
    font-family: 'Nunito', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  }

  .sq-phone-field input.sq-input {
    padding-left: 112px;
    height: 100%;
  }

  .sq-phone-field .iti__selected-flag {
    padding-left: 12px;
    cursor: pointer;
    touch-action: manipulation;
    -webkit-user-select: none;
    user-select: none;
    -webkit-touch-callout: none;
  }

  .sq-phone-field .iti__selected-dial-code {
    font-family: 'Nunito', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    font-weight: 600;
    pointer-events: none;
    -webkit-user-select: none;
    user-select: none;
    color: #222;
  }

  .sq-phone-field .iti__arrow {
    pointer-events: none;
    -webkit-user-select: none;
    user-select: none;
  }

  .sq-phone-field .iti__country-list,
  .sq-phone-field .iti__country-list.iti__country-list--dropup {
    top: 100%;
    bottom: auto;
    left: 0;
    margin-top: 4px;
    margin-bottom: 0;
    z-index: 99999;
    max-height: 240px;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    background-color: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
    font-family: 'Nunito', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  }

  @media (max-width: 640px) {
    .sq-phone-field .iti__country-list,
    .sq-phone-field .iti__country-list.iti__country-list--dropup {
      width: 100%;
      max-width: 100%;
      left: 0;
      right: 0;
    }
  }

  /* Recaptcha */
  .sq-recaptcha {
    width: 345px;
    min-height: 78px;
    max-width: 100%;
    overflow: hidden;
    display: none;
    margin-top: 10px;
  }

  .sq-recaptcha.is-visible {
    display: block;
  }

  /* Submit Button */
  .sq-submit {
    width: 100%;
    min-height: 52px;
    padding: 14px 24px;
    border: 0;
    border-radius: 999px;
    color: #fff;
    background: #ff6600;
    font-family: 'Nunito', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(255, 102, 0, 0.25);
    transition: all 0.25s ease;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .sq-submit:hover {
    background: #001b43;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(0, 27, 67, 0.3);
  }

  @media (max-width: 767px) {
    .sq-heading.sq-lines {
      font-size: 26px;
    }
    .sq-form-row {
      grid-template-columns: 1fr;
    }
  }

  @media (max-width: 575px) {
    .sq-recaptcha {
      width: 304px;
      transform: scale(.88);
      transform-origin: left top;
    }
  }
</style>

<script>
(function() {
  function initCommonPhonePickers() {
    if (typeof window.intlTelInput !== 'function') return;
    document.querySelectorAll('.sq-phone-field input[name="phone"]').forEach(function(phoneField) {
      if (phoneField.dataset.itiReady === '1' || (window.intlTelInputGlobals && window.intlTelInputGlobals.getInstance(phoneField))) return;
      phoneField.dataset.itiReady = '1';
      const form = phoneField.closest('form');
      const hiddenCode = form ? form.querySelector('input[name="country_code"]') : null;

      const phonePicker = window.intlTelInput(phoneField, {
        initialCountry: 'in',
        separateDialCode: true,
        nationalMode: true,
        autoPlaceholder: 'off',
        customPlaceholder: function() {
          return 'Enter Phone No.';
        },
        utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js'
      });

      phoneField.placeholder = 'Enter Phone No.';
      phoneField.setAttribute('placeholder', 'Enter Phone No.');

      phoneField.addEventListener('input', function() {
        this.value = this.value.replace(/[^\d]/g, '');
      });

      const syncCountry = function() {
        phoneField.placeholder = 'Enter Phone No.';
        phoneField.setAttribute('placeholder', 'Enter Phone No.');
        if (hiddenCode) {
          const countryData = phonePicker.getSelectedCountryData();
          hiddenCode.value = countryData?.dialCode ? '+' + countryData.dialCode : '+91';
        }
      };

      phoneField.addEventListener('countrychange', syncCountry);
      if (form) {
        form.addEventListener('submit', syncCountry);
      }
      syncCountry();
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCommonPhonePickers);
  } else {
    initCommonPhonePickers();
  }
})();
</script>
@endonce
