<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* Modal Overlay */
    #fresherHiringModal {
        position: fixed;
        inset: 0;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100vw;
        height: 100vh;
        height: 100dvh;
        z-index: 9999999;
        background: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 16px;
        box-sizing: border-box;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
    }

    #fresherHiringModal.is-open,
    #fresherHiringModal.flex {
        display: flex;
        pointer-events: auto;
    }

    #fresherHiringModal.is-visible {
        opacity: 1;
    }

    #fresherHiringModalContent {
        transform: scale(0.95);
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease;
        opacity: 0;
    }

    #fresherHiringModal.is-visible #fresherHiringModalContent,
    #fresherHiringModalContent.scale-100 {
        transform: scale(1);
        opacity: 1;
    }

    /* Hide scrollbars */
    #fresherHiringModal,
    #fresherHiringModalContent,
    .right-form-area {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    #fresherHiringModal::-webkit-scrollbar,
    #fresherHiringModalContent::-webkit-scrollbar,
    .right-form-area::-webkit-scrollbar {
        display: none;
        width: 0;
        height: 0;
        background: transparent;
    }

    /* Main Modal */
    #fresherHiringModalContent {
        background: linear-gradient(135deg, #00173e 0%, #00265f 100%);
        box-shadow: 0 25px 60px rgba(0,0,0,0.45);
        overflow: hidden;
        min-height: 650px;
        max-height: 95vh;
        -webkit-overflow-scrolling: touch;
        overscroll-behavior: contain;
        border-radius: 8px;
    }

    /* Left Image */
    .fresher-left {
        position: relative;
        overflow: hidden;
        min-height: 650px;
    }

    .fresher-left img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Overlay */
    .fresher-left::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.15), rgba(0,0,0,0.45));
    }

    /* Hiring Freshers Title */
    .fresher-blink-title {
        position: absolute;
        top: 26px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 20;
        width: 100%;
        text-align: center;
        color: #fff;
        font-size: 34px;
        font-weight: 800;
        font-family: 'Roboto Slab', serif;
        letter-spacing: 1px;
        text-transform: uppercase;
        text-shadow: 0 0 15px rgba(255,87,34,0.9);
        animation: blinkFade 2s infinite;
        padding: 0 10px;
    }

    @keyframes blinkFade {
        0% {
            opacity: 1;
            transform: translateX(-50%) scale(1);
        }
        50% {
            opacity: 0;
            transform: translateX(-50%) scale(0.95);
        }
        100% {
            opacity: 1;
            transform: translateX(-50%) scale(1);
        }
    }

    /* Right Side */
    .right-form-area {
        min-height: 650px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* Heading */
    .connect-heading {
        font-size: 32px;
        font-weight: 800;
        color: #fff;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }

    /* Fields */
    .custom-field {
        position: relative;
        height: 52px;
        width: 100%;
    }

    .custom-field input,
    .custom-field textarea {
        width: 100%;
        border: none;
        outline: none;
        background: #fff;
        padding-left: 46px;
        padding-right: 14px;
        font-size: 14px;
        color: #1f2937;
        border-radius: 4px;
        box-sizing: border-box;
        transition: all .3s ease;
    }

    .custom-field input {
        height: 100%;
    }

    .custom-field textarea {
        min-height: 120px;
        padding-top: 15px;
        padding-bottom: 15px;
        resize: none;
        display: block;
        font-family: inherit;
    }

    .custom-field input:focus,
    .custom-field textarea:focus {
        box-shadow: 0 0 0 3px rgba(255,87,34,0.18);
    }

    .field-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #ff5722;
        z-index: 5;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
    }

    .textarea-field {
        height: auto;
        min-height: 120px;
        margin-bottom: 5px;
    }

    .textarea-field .field-icon {
        top: 18px;
        transform: none;
    }

    /* Phone */
    .phone-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        height: 52px;
        background: #fff;
        border-radius: 4px;
        box-sizing: border-box;
        overflow: visible;
        z-index: 20;
    }

    .phone-wrapper .iti {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
    }

    .phone-wrapper input[type="tel"] {
        width: 100%;
        border: none;
        outline: none;
        height: 100%;
        font-size: 14px;
        color: #1f2937;
        background: transparent;
        padding-left: 96px;
        padding-right: 14px;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .phone-wrapper input[type="tel"]:focus {
        box-shadow: 0 0 0 3px rgba(255,87,34,0.18);
    }

    .phone-wrapper .iti__selected-flag {
        background: #f8fafc;
        border-right: 1px solid #e5e7eb;
        padding: 0 12px;
        height: 100%;
        display: flex;
        align-items: center;
        gap: 4px;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }

    .phone-wrapper .iti__country-list {
        color: #1f2937;
        text-align: left;
        z-index: 10050;
        width: 300px;
        max-width: calc(100vw - 32px);
        white-space: normal;
    }

    /* Upload */
    .upload-box {
        position: relative;
        display: flex;
        align-items: center;
        height: 52px;
        background: #fff;
        border-radius: 4px;
        overflow: hidden;
        box-sizing: border-box;
        transition: border 0.2s ease;
    }

    .upload-icon {
        width: 52px;
        min-width: 52px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        border-right: 1px solid #e5e7eb;
        background: #f8fafc;
        color: #ff5722;
    }

    .upload-box input[type="file"] {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 10;
    }

    .upload-label {
        display: flex;
        align-items: center;
        gap: 10px;
        padding-left: 14px;
        padding-right: 10px;
        font-size: 14px;
        color: #6b7280;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        pointer-events: none;
    }

    .choose-btn {
        border: 1px solid #d1d5db;
        background: #f3f4f6;
        padding: 5px 10px;
        font-size: 12px;
        color: #111827;
        font-weight: 600;
        border-radius: 3px;
        white-space: nowrap;
    }

    .file-info-bar {
        font-size: 12px;
        color: rgba(255,255,255,0.78);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 6px 4px 0;
    }

    .file-info-bar strong {
        color: #ff7a45;
        font-weight: 600;
    }

    .file-error-msg {
        font-size: 12px;
        color: #ff7675;
        background: rgba(255,107,107,0.12);
        border: 1px solid rgba(255,107,107,0.35);
        padding: 7px 10px;
        border-radius: 3px;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
        line-height: 1.4;
    }

    /* Recaptcha */
    .recaptcha-wrap {
        width: 100%;
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        margin-top: 4px;
    }

    /* Submit */
    .submit-btn {
        width: 100%;
        height: 54px;
        border: none;
        border-radius: 999px;
        background: #ff6600;
        color: #fff;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 4px 14px rgba(255,102,0,0.25);
        transition: all .25s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        background: #001b43;
        box-shadow: 0 6px 18px rgba(0,27,67,0.3);
    }

    /* Single Close Button */
    .modal-close-btn {
        width: 38px;
        height: 38px;
        border: none;
        background: #fff;
        color: #00173e;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all .3s ease;
        position: absolute;
        top: 18px;
        right: 18px;
        z-index: 30;
        border-radius: 4px;
        cursor: pointer;
    }

    .modal-close-btn:hover {
        background: #ff5722;
        color: #fff;
        transform: rotate(90deg);
    }

    /* Responsive */
    @media(max-width: 991px) {
        .fresher-blink-title {
            font-size: 28px;
        }
        .connect-heading {
            font-size: 28px;
        }
    }

    @media(max-width: 767px) {
        #fresherHiringModal {
            align-items: center;
            justify-content: center;
            overflow-y: auto;
            padding: 8px 6px;
            -webkit-overflow-scrolling: touch;
        }

        #fresherHiringModalContent {
            margin: auto;
            min-height: auto;
            max-height: calc(100dvh - 16px);
            max-height: calc(100vh - 16px);
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
            overscroll-behavior: contain;
            border-radius: 8px;
            width: 100%;
            max-width: 440px;
        }

        .fresher-left {
            display: none;
        }

        .right-form-area {
            min-height: auto;
            padding: 16px 14px 18px;
        }

        .fresher-blink-title {
            font-size: 20px;
            top: 12px;
        }

        .connect-heading {
            font-size: 22px;
            margin-bottom: 4px;
        }

        .modal-close-btn {
            top: 8px;
            right: 8px;
            z-index: 50;
            width: 32px;
            height: 32px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.4);
            border-radius: 6px;
        }

        .fresher-connect-form.space-y-4 > :not([hidden]) ~ :not([hidden]) {
            margin-top: 8px;
        }

        .custom-field,
        .phone-wrapper,
        .upload-box {
            height: 42px;
        }

        .custom-field input,
        .phone-wrapper input[type="tel"] {
            height: 42px;
            font-size: 14px;
        }

        .upload-icon {
            width: 42px;
            min-width: 42px;
        }

        .file-info-bar {
            font-size: 11px;
            padding: 2px 2px 0;
        }

        .custom-field.textarea-field {
            min-height: 56px;
            height: 56px;
            margin-bottom: 0;
        }

        .custom-field.textarea-field textarea {
            min-height: 56px;
            height: 56px;
            padding-top: 8px;
            padding-bottom: 8px;
            font-size: 14px;
        }

        .textarea-field .field-icon {
            top: 12px;
        }

        .recaptcha-wrap {
            margin-top: 2px;
            margin-bottom: 2px;
            display: flex;
            justify-content: flex-start;
        }

        .recaptcha-wrap > div {
            transform: scale(0.85);
            transform-origin: left center;
            margin: -4px 0;
            padding: 2px;
        }

        .submit-btn {
            height: 44px;
            font-size: 15px;
            margin-top: 4px;
        }
    }
</style>

<div id="fresherHiringModal" class="fixed inset-0 hidden items-center justify-center p-4">

    <div id="fresherHiringModalContent" class="relative w-full max-w-6xl flex flex-col md:flex-row">

        <!-- Single Close Button -->
        <button type="button" onclick="closeFresherModal()" class="modal-close-btn" aria-label="Close modal">
            <iconify-icon icon="lucide:x" width="20"></iconify-icon>
        </button>

        <!-- Left Side -->
        <div class="hidden md:block w-full md:w-1/2 fresher-left">

            <!-- Blink Heading -->
            <div class="fresher-blink-title">
                Hiring Freshers
            </div>

            <img src="{{ asset('frontend-assets/media/pages/shared/hiring-freshers-img.webp') }}" alt="Hiring Freshers">

        </div>

        <!-- Right Side -->
        <div class="w-full md:w-1/2 p-6 md:p-10 relative right-form-area">

            <!-- Heading -->
            <div class="text-center mb-2 md:mb-7">
                <h2 class="connect-heading">Let's Connect</h2>
            </div>

            <!-- Form -->
            <form action="{{ route('api.fresher-hirings.store') }}" method="POST" enctype="multipart/form-data" class="fresher-connect-form space-y-4">
                @csrf
                <input type="hidden" name="type" value="fresher">
                <input type="hidden" name="url" value="{{ url()->current() }}">

                <!-- Row -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <!-- Name -->
                    <div class="custom-field">

                        <span class="field-icon">
                            <iconify-icon icon="lucide:user" width="18"></iconify-icon>
                        </span>

                        <input type="text" name="name" placeholder="Enter Your Name" autocomplete="name" required>

                    </div>

                    <!-- Email -->
                    <div class="custom-field">

                        <span class="field-icon">
                            <iconify-icon icon="lucide:mail" width="18"></iconify-icon>
                        </span>

                        <input type="email" name="email" placeholder="Enter Your Email" autocomplete="email" required>

                    </div>

                </div>

                <!-- Row -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <!-- Phone -->
                    <div class="phone-wrapper">

                        <input id="fresher-hiring-phone" type="tel" name="phone" placeholder="Enter Phone No." autocomplete="tel" required>
                        <input type="hidden" name="country_code" value="+91">

                    </div>

                    <!-- Subject -->
                    <div class="custom-field">

                        <span class="field-icon">
                            <iconify-icon icon="lucide:list" width="18"></iconify-icon>
                        </span>

                        <input type="text" name="subject" placeholder="Subject">

                    </div>

                </div>

                <!-- Upload -->
                <div class="upload-container">
                    <div class="upload-box" id="uploadBox">
                        <div class="upload-icon">
                            <iconify-icon icon="lucide:upload" width="18"></iconify-icon>
                        </div>
                        <input type="file" name="attachment" id="attachmentInput" accept=".pdf,.doc,.docx">
                        <div class="upload-label" id="uploadLabel">
                            <span class="choose-btn">Choose File</span>
                            <span class="file-chosen-text">No file chosen</span>
                        </div>
                    </div>
                    <div class="file-info-bar">
                        <span>Allowed format: <strong>PDF, DOC, DOCX</strong></span>
                        <span>Max limit: <strong>10MB</strong></span>
                    </div>
                    <div id="fileUploadError" class="file-error-msg" style="display:none;"></div>
                </div>

                <!-- Message -->
                <div class="custom-field textarea-field">

                    <span class="field-icon">
                        <iconify-icon icon="lucide:message-square" width="18"></iconify-icon>
                    </span>

                    <textarea name="message" placeholder="Enter your message"></textarea>

                </div>

                <!-- Recaptcha -->
                <div class="recaptcha-wrap">

                    <div class="bg-white p-2 inline-block rounded">
                        @include('components.recaptcha')
                    </div>

                </div>

                <!-- Submit -->
                <button type="submit" class="submit-btn">
                    Send Message
                </button>

            </form>

        </div>

    </div>

</div>

<script>
    function adjustFresherPhonePadding(){
        const phoneInput = document.getElementById('fresher-hiring-phone');
        if (!phoneInput) return;
        const selectedFlag = phoneInput.closest('.iti')?.querySelector('.iti__selected-flag');
        if (selectedFlag) {
            const flagWidth = selectedFlag.offsetWidth;
            if (flagWidth > 0) {
                phoneInput.style.paddingLeft = (flagWidth + 10) + 'px';
            }
        }
    }

    function initFresherPhonePicker(){
        try {
            const phoneInput = document.getElementById('fresher-hiring-phone');
            const form = phoneInput?.closest('form');
            const countryCodeInput = form?.querySelector('input[name="country_code"]');

            if (!phoneInput || !countryCodeInput || phoneInput.dataset.itiReady === 'true' || typeof window.intlTelInput !== 'function') {
                adjustFresherPhonePadding();
                return;
            }

            const phonePicker = window.intlTelInput(phoneInput, {
                initialCountry: 'in',
                separateDialCode: true,
                nationalMode: true,
                autoPlaceholder: 'off',
                customPlaceholder: function() {
                    return 'Enter Phone No.';
                },
                utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js'
            });

            phoneInput.placeholder = 'Enter Phone No.';
            phoneInput.setAttribute('placeholder', 'Enter Phone No.');

            phoneInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^\d]/g, '');
            });

            const syncCountryCode = function(){
                phoneInput.placeholder = 'Enter Phone No.';
                phoneInput.setAttribute('placeholder', 'Enter Phone No.');
                const country = phonePicker.getSelectedCountryData();
                countryCodeInput.value = country?.dialCode ? '+' + country.dialCode : '+91';
                adjustFresherPhonePadding();
            };

            phoneInput.dataset.itiReady = 'true';
            phoneInput.addEventListener('countrychange', syncCountryCode);
            phoneInput.addEventListener('open:countrydropdown', function () {
                const list = phoneInput.closest('.iti')?.querySelector('.iti__country-list');
                if (list) {
                    list.classList.remove('iti__country-list--dropup');
                    list.style.top = '100%';
                    list.style.bottom = 'auto';
                }
            });

            form.addEventListener('submit', syncCountryCode);
            syncCountryCode();
            adjustFresherPhonePadding();
        } catch (err) {
            console.warn('initFresherPhonePicker error:', err);
        }
    }

    function openFresherModal(e){
        if(e && typeof e.preventDefault === 'function') e.preventDefault();

        document.body.classList.remove('sq-mobile-active');

        const modal = document.getElementById('fresherHiringModal');
        const content = document.getElementById('fresherHiringModalContent');

        if(!modal) return;

        if(modal.parentElement !== document.body){
            document.body.appendChild(modal);
        }

        if(content) content.scrollTop = 0;
        modal.scrollTop = 0;

        modal.classList.remove('hidden');
        modal.classList.add('flex', 'is-open');

        requestAnimationFrame(() => {
            modal.classList.remove('opacity-0');
            modal.classList.add('is-visible');
            adjustFresherPhonePadding();
        });

        document.documentElement.style.overflow = 'hidden';
        document.body.style.overflow = 'hidden';

        setTimeout(() => {
            initFresherPhonePicker();
            adjustFresherPhonePadding();
        }, 50);
    }

    function closeFresherModal(){
        const modal = document.getElementById('fresherHiringModal');

        if(modal){
            modal.classList.remove('is-visible');
            modal.classList.add('opacity-0');
        }

        setTimeout(()=>{
            if(modal){
                modal.classList.remove('flex', 'is-open');
                modal.classList.add('hidden');
            }

            document.documentElement.style.overflow = '';
            document.body.style.overflow = '';
        }, 300);
    }

    window.openFresherModal = openFresherModal;
    window.closeFresherModal = closeFresherModal;

    document.addEventListener('DOMContentLoaded', function(){
        const modal = document.getElementById('fresherHiringModal');
        if(modal && modal.parentElement !== document.body){
            document.body.appendChild(modal);
        }

        if(modal){
            modal.addEventListener('click', function(e){
                if(e.target === this){
                    closeFresherModal();
                }
            });
        }

        document.addEventListener('keydown', function(e){
            if(e.key === 'Escape' && modal && modal.classList.contains('is-open')){
                closeFresherModal();
            }
        });

        document.querySelectorAll('[data-open-fresher]').forEach(function(btn){
            btn.addEventListener('click', openFresherModal);
        });

        initFresherPhonePicker();
    });

    // File Upload Handler
    document.addEventListener('DOMContentLoaded', function(){
        const fileInput = document.getElementById('attachmentInput');
        const uploadLabel = document.getElementById('uploadLabel');
        const uploadBox = document.getElementById('uploadBox');
        const fileError = document.getElementById('fileUploadError');

        let errorTimer = null;

        function showError(msg) {
            if(errorTimer) clearTimeout(errorTimer);
            if(fileError) {
                fileError.innerHTML = '<iconify-icon icon="lucide:alert-circle" width="15" height="15"></iconify-icon> <span>' + msg + '</span>';
                fileError.style.display = 'flex';
            }
            if(uploadBox) {
                uploadBox.style.border = '1px solid #ff6b6b';
            }

            errorTimer = setTimeout(clearError, 3500);
        }

        function clearError() {
            if(errorTimer) clearTimeout(errorTimer);
            if(fileError) {
                fileError.innerHTML = '';
                fileError.style.display = 'none';
            }
            if(uploadBox) {
                uploadBox.style.border = 'none';
            }
        }

        if(fileInput && uploadLabel){
            fileInput.addEventListener('change', function(e){
                clearError();
                let fileName = 'No file chosen';

                if(e.target.files.length > 0){
                    const file = e.target.files[0];
                    const ext = file.name.split('.').pop().toLowerCase();
                    const validExts = ['pdf', 'doc', 'docx'];

                    if(!validExts.includes(ext)){
                        showError('Only PDF, DOC, and DOCX resume files are allowed.');
                        fileInput.value = '';
                        uploadLabel.innerHTML = '<span class="choose-btn">Choose File</span> <span class="file-chosen-text">No file chosen</span>';
                        return;
                    }

                    if(file.size > 10 * 1024 * 1024){
                        showError('File size exceeds the 10MB limit. Please upload a smaller document.');
                        fileInput.value = '';
                        uploadLabel.innerHTML = '<span class="choose-btn">Choose File</span> <span class="file-chosen-text">No file chosen</span>';
                        return;
                    }

                    fileName = file.name;
                }

                uploadLabel.innerHTML = '<span class="choose-btn">Choose File</span> <span class="file-chosen-text" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">' + fileName + '</span>';
            });
        }
    });
</script>