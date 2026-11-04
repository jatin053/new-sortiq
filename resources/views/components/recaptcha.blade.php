@php($recaptchaEnabled = \App\Support\Recaptcha::enabledForRequest(request()))
@php($siteKey = \App\Support\Recaptcha::siteKeyForRequest(request()))

@if ($recaptchaEnabled && $siteKey)
    <div class="g-recaptcha" data-sitekey="{{ $siteKey }}"></div>
@else
    <div
        class="rounded-[14px] border border-dashed border-gray-300 bg-gray-50 px-4 py-5 text-center text-sm font-semibold text-gray-500"
        aria-hidden="true"
    >
        reCAPTCHA
    </div>
@endif
