<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>

    /* Modal Overlay */
    #fresherHiringModal{
        backdrop-filter:blur(10px);
        -webkit-backdrop-filter:blur(10px);
    }

    /* Hide scrollbars completely while maintaining smooth scrolling */
    #fresherHiringModal,
    #fresherHiringModalContent,
    .right-form-area {
        scrollbar-width: none !important;
        -ms-overflow-style: none !important;
    }

    #fresherHiringModal::-webkit-scrollbar,
    #fresherHiringModalContent::-webkit-scrollbar,
    .right-form-area::-webkit-scrollbar {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
        background: transparent !important;
    }

    /* Main Modal */
    #fresherHiringModalContent{
        background:linear-gradient(135deg,#00173e 0%,#00265f 100%);
        box-shadow:0 25px 60px rgba(0,0,0,0.45);
        overflow:hidden;
        min-height:650px;
        max-height:95vh;
        -webkit-overflow-scrolling: touch;
        overscroll-behavior: contain;
    }

    /* Left Image */
    .fresher-left{
        position:relative;
        overflow:hidden;
        min-height:650px;
    }

    .fresher-left img{
        width:100%;
        height:100%;
        object-fit:cover;
        display:block;
    }

    /* Overlay */
    .fresher-left::after{
        content:"";
        position:absolute;
        inset:0;
        background:linear-gradient(to bottom,rgba(0,0,0,0.15),rgba(0,0,0,0.45));
    }

    /* Hiring Freshers */
    .fresher-blink-title{
        position:absolute;
        top:26px;
        left:50%;
        transform:translateX(-50%);
        z-index:20;
        width:100%;
        text-align:center;
        color:#fff;
        font-size:34px;
        font-weight:800;
        font-family:'Roboto Slab', serif;
        letter-spacing:1px;
        text-transform:uppercase;
        text-shadow:0 0 15px rgba(255,87,34,0.9);
        animation:blinkFade 2s infinite;
        padding:0 10px;
    }

    @keyframes blinkFade{

        0%{
            opacity:1;
            transform:translateX(-50%) scale(1);
        }

        50%{
            opacity:0;
            transform:translateX(-50%) scale(0.95);
        }

        100%{
            opacity:1;
            transform:translateX(-50%) scale(1);
        }
    }

    /* Right Side */
    .right-form-area{
        min-height:650px;
        display:flex;
        flex-direction:column;
        justify-content:center;
    }

    /* Heading */
    .connect-heading{
        font-size:32px;
        font-weight:800;
        color:#fff;
        letter-spacing:1px;
        margin-bottom:0;
    }

    /* Fields */
    .custom-field{
        position:relative;
        height:52px;
        width:100%;
    }

    .custom-field input,
    .custom-field textarea{
        width:100%;
        border:none;
        outline:none;
        background:#fff;
        padding-left:46px;
        padding-right:14px;
        font-size:14px;
        color:#1f2937;
        transition:all .3s ease;
    }

    .custom-field input{
        height:100%;
    }

    .custom-field textarea{
        min-height:120px;
        padding-top:15px;
        padding-bottom:15px;
        resize:none;
        display:block;
    }

    .custom-field input:focus,
    .custom-field textarea:focus{
        box-shadow:0 0 0 3px rgba(255,87,34,0.18);
    }

    .field-icon{
        position:absolute;
        left:14px;
        top:50%;
        transform:translateY(-50%);
        color:#ff5722;
        z-index:5;
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .textarea-field{
        height:auto;
        min-height:120px;
        margin-bottom:5px;
    }

    .textarea-field .field-icon{
        top:18px;
        transform:none;
    }

    /* Phone */
    .phone-wrapper{
        display:flex;
        align-items:center;
        height:52px;
        background:#fff;
        overflow:hidden;
    }

    .phone-code{
        min-width:62px;
        height:100%;
        display:flex;
        align-items:center;
        justify-content:center;
        gap:3px;
        border-right:1px solid #e5e7eb;
        background:#f8fafc;
    }

    .phone-wrapper .iti{
        width:100%;
        height:100%;
    }

    .phone-wrapper input[type="tel"]{
        width:100%;
        border:none;
        outline:none;
        height:100%;
        font-size:14px;
        color:#1f2937;
    }

    .phone-wrapper .iti__selected-flag{
        background:#f8fafc;
        border-right:1px solid #e5e7eb;
        padding:0 12px;
    }

    .phone-wrapper .iti__country-list{
        color:#1f2937;
        text-align:left;
        z-index:10050;
    }

    /* Upload */
    .upload-box{
        position:relative;
        display:flex;
        align-items:center;
        height:52px;
        background:#fff;
        overflow:hidden;
    }

    .upload-icon{
        width:52px;
        height:100%;
        display:flex;
        align-items:center;
        justify-content:center;
        border-right:1px solid #e5e7eb;
        background:#f8fafc;
        color:#ff5722;
    }

    .upload-box input[type="file"]{
        position:absolute;
        inset:0;
        width:100%;
        height:100%;
        opacity:0;
        cursor:pointer;
        z-index:10;
    }

    .upload-label{
        display:flex;
        align-items:center;
        gap:10px;
        padding-left:14px;
        padding-right:10px;
        font-size:14px;
        color:#6b7280;
        overflow:hidden;
        text-overflow:ellipsis;
        white-space:nowrap;
    }

    .choose-btn{
        border:1px solid #d1d5db;
        background:#f3f4f6;
        padding:5px 10px;
        font-size:12px;
        color:#111827;
        font-weight:600;
    }

    .file-info-bar{
        font-size:12px;
        color:rgba(255,255,255,0.78);
        display:flex;
        align-items:center;
        justify-content:space-between;
        padding:4px 4px 0;
    }

    .file-info-bar strong{
        color:#ff7a45;
        font-weight:600;
    }

    .file-error-msg{
        font-size:12px;
        color:#ff7675;
        background:rgba(255,107,107,0.12);
        border:1px solid rgba(255,107,107,0.35);
        padding:7px 10px;
        border-radius:3px;
        margin-top:6px;
        display:flex;
        align-items:center;
        gap:6px;
        line-height:1.4;
    }

    /* Recaptcha */
    .recaptcha-wrap{
        width:100%;
        display:flex;
        align-items:flex-start;
        justify-content:flex-start;
        margin-top:4px;
    }

    /* Submit */
    .submit-btn{
        width:100%;
        height:54px;
        border:none;
        background:linear-gradient(135deg,#ff5722,#ff7a45);
        color:#fff;
        font-size:16px;
        font-weight:700;
        transition:all .3s ease;
        box-shadow:0 10px 25px rgba(255,87,34,0.35);
    }

    .submit-btn:hover{
        transform:translateY(-2px);
        background:linear-gradient(135deg,#e64a19,#ff5722);
    }

    /* Single Close Button */
    .modal-close-btn{
        width:38px;
        height:38px;
        border:none;
        background:#fff;
        color:#00173e;
        display:flex;
        align-items:center;
        justify-content:center;
        transition:all .3s ease;
        position:absolute;
        top:18px;
        right:18px;
        z-index:30;
    }

    .modal-close-btn:hover{
        background:#ff5722;
        color:#fff;
        transform:rotate(90deg);
    }

    /* Responsive */
    @media(max-width:991px){

        .fresher-blink-title{
            font-size:28px;
        }

        .connect-heading{
            font-size:28px;
        }
    }

    @media(max-width:767px){

        #fresherHiringModal{
            align-items:flex-start !important;
            justify-content:center !important;
            overflow-y:auto !important;
            padding:12px 10px !important;
            -webkit-overflow-scrolling:touch;
        }

        #fresherHiringModalContent{
            margin:auto !important;
            min-height:auto !important;
            max-height:calc(100dvh - 24px) !important;
            max-height:calc(100vh - 24px) !important;
            overflow-y:auto !important;
            -webkit-overflow-scrolling:touch;
            overscroll-behavior:contain;
            border-radius:6px;
        }

        .fresher-left{
            min-height:175px !important;
            max-height:185px !important;
            height:180px !important;
        }

        .fresher-left img{
            height:100% !important;
            object-fit:cover !important;
            object-position:center 20% !important;
        }

        .right-form-area{
            min-height:auto !important;
            padding:20px 16px 28px !important;
        }

        .fresher-blink-title{
            font-size:22px !important;
            top:14px !important;
        }

        .connect-heading{
            font-size:24px !important;
            margin-bottom:0 !important;
        }

        .modal-close-btn{
            position:sticky !important;
            top:10px !important;
            right:10px !important;
            align-self:flex-end !important;
            margin-top:10px !important;
            margin-right:10px !important;
            margin-bottom:-44px !important;
            z-index:50 !important;
            width:34px !important;
            height:34px !important;
            box-shadow:0 4px 12px rgba(0,0,0,0.4) !important;
            border-radius:4px !important;
        }
    }

    @media(max-width:480px){

        #fresherHiringModal{
            padding:8px 6px !important;
        }

        #fresherHiringModalContent{
            max-height:calc(100dvh - 16px) !important;
            max-height:calc(100vh - 16px) !important;
        }

        .fresher-left{
            min-height:150px !important;
            max-height:165px !important;
            height:155px !important;
        }

        .fresher-blink-title{
            font-size:19px !important;
            top:12px !important;
        }

        .right-form-area{
            padding:16px 14px 22px !important;
        }

        .connect-heading{
            font-size:22px !important;
        }

        .custom-field{
            height:48px;
        }

        .upload-box{
            height:48px;
        }

        .submit-btn{
            height:48px;
            font-size:15px;
        }

        .phone-wrapper{
            height:48px;
        }
    }


    /* International phone field layout */
    .phone-wrapper{
        overflow:visible;
        position:relative;
        z-index:20;
    }
    .phone-wrapper .iti{
        display:block;
        width:100%;
        height:100%;
    }
    .phone-wrapper .iti input[type="tel"]{
        width:100%!important;
        height:100%!important;
        box-sizing:border-box!important;
        padding-left:112px!important;
        padding-right:14px!important;
    }
    .phone-wrapper .iti__selected-flag{
        min-width:98px;
        padding:0 12px!important;
        justify-content:flex-start;
    }
    .iti__dropdown-content,
    .iti__country-list{
        z-index:10050!important;
        width:300px;
        max-width:calc(100vw - 32px);
        white-space:normal;
    }
</style>

<div id="fresherHiringModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/70 p-4 transition-all duration-300 opacity-0">

    <div id="fresherHiringModalContent" class="relative w-full max-w-6xl flex flex-col md:flex-row scale-95 transition-all duration-300">

        <!-- Single Close Button -->
        <button type="button" onclick="closeFresherModal()" class="modal-close-btn">
            <iconify-icon icon="lucide:x" width="20"></iconify-icon>
        </button>

        <!-- Left Side -->
        <div class="w-full md:w-1/2 fresher-left">

            <!-- Blink Heading -->
            <div class="fresher-blink-title">
                Hiring Freshers
            </div>

            <img src="{{ asset('frontend-assets/media/pages/shared/hiring-freshers-img.webp') }}" alt="Hiring Freshers">

        </div>

        <!-- Right Side -->
        <div class="w-full md:w-1/2 p-6 md:p-10 relative right-form-area">

            <!-- Heading -->
            <div class="text-center mb-7">
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

                        <input type="text" name="name" placeholder="Enter Your Name" required>

                    </div>

                    <!-- Email -->
                    <div class="custom-field">

                        <span class="field-icon">
                            <iconify-icon icon="lucide:mail" width="18"></iconify-icon>
                        </span>

                        <input type="email" name="email" placeholder="Enter Your Email" required>

                    </div>

                </div>

                <!-- Row -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <!-- Phone -->
                    <div class="phone-wrapper">

                        <input id="fresher-hiring-phone" type="tel" name="phone" placeholder="Enter Your Phone Number" autocomplete="tel" required>
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
                            No file chosen
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

                    <div class="bg-white p-2 inline-block">
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

    function initFresherPhonePicker(){
        const phoneInput = document.getElementById('fresher-hiring-phone');
        const form = phoneInput?.closest('form');
        const countryCodeInput = form?.querySelector('input[name="country_code"]');

        if (!phoneInput || !countryCodeInput || phoneInput.dataset.itiReady === 'true' || typeof window.intlTelInput !== 'function') return;

        const phonePicker = window.intlTelInput(phoneInput, {
            initialCountry: 'in',
            separateDialCode: true,
            nationalMode: true,
            autoPlaceholder: 'aggressive',
            dropdownContainer: document.body,
            utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js'
        });

        const syncCountryCode = function(){
            const country = phonePicker.getSelectedCountryData();
            countryCodeInput.value = country?.dialCode ? '+' + country.dialCode : '';
        };

        phoneInput.dataset.itiReady = 'true';
        phoneInput.addEventListener('countrychange', syncCountryCode);
        form.addEventListener('submit', syncCountryCode);
        syncCountryCode();
    }

    document.addEventListener('DOMContentLoaded', initFresherPhonePicker);
    function openFresherModal(e){

        if(e) e.preventDefault();

        document.body.classList.remove('sq-mobile-active');

        initFresherPhonePicker();

        const modal = document.getElementById('fresherHiringModal');
        const content = document.getElementById('fresherHiringModalContent');

        if(content) content.scrollTop = 0;
        if(modal) modal.scrollTop = 0;

        if(modal){
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            setTimeout(() => {
                modal.classList.remove('opacity-0');
                if(content){
                    content.classList.remove('scale-95');
                    content.classList.add('scale-100');
                }
            },10);
        }

        document.documentElement.style.overflow = 'hidden';
        document.body.style.overflow = 'hidden';
    }

    function closeFresherModal(){

        const modal = document.getElementById('fresherHiringModal');
        const content = document.getElementById('fresherHiringModalContent');

        if(modal) modal.classList.add('opacity-0');

        if(content){
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
        }

        setTimeout(()=>{

            if(modal){
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            document.documentElement.style.overflow = '';
            document.body.style.overflow = '';

        },300);
    }

    window.openFresherModal = openFresherModal;
    window.closeFresherModal = closeFresherModal;

    // Outside Click Close
    document.getElementById('fresherHiringModal').addEventListener('click',function(e){

        if(e.target===this){
            closeFresherModal();
        }

    });

    // File Upload Handler
    document.addEventListener('DOMContentLoaded', function(){
        const fileInput = document.getElementById('attachmentInput');
        const uploadLabel = document.getElementById('uploadLabel');
        const uploadBox = document.getElementById('uploadBox');
        const fileError = document.getElementById('fileUploadError');

        let errorTimer = null;
        let fadeTimer = null;

        function showError(msg) {
            if(errorTimer) {
                clearTimeout(errorTimer);
                errorTimer = null;
            }
            if(fadeTimer) {
                clearTimeout(fadeTimer);
                fadeTimer = null;
            }

            if(fileError) {
                fileError.innerHTML = `<iconify-icon icon="lucide:alert-circle" width="15" height="15"></iconify-icon> <span>${msg}</span>`;
                fileError.style.transition = 'opacity 0.25s ease';
                fileError.style.opacity = '1';
                fileError.style.display = 'flex';
            }
            if(uploadBox) {
                uploadBox.style.border = '1px solid #ff6b6b';
            }

            errorTimer = setTimeout(function(){
                if(fileError) {
                    fileError.style.opacity = '0';
                }
                fadeTimer = setTimeout(function(){
                    clearError();
                }, 300);
            }, 3000);
        }

        function clearError() {
            if(errorTimer) {
                clearTimeout(errorTimer);
                errorTimer = null;
            }
            if(fadeTimer) {
                clearTimeout(fadeTimer);
                fadeTimer = null;
            }
            if(fileError) {
                fileError.innerHTML = '';
                fileError.style.display = 'none';
                fileError.style.opacity = '1';
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
                        uploadLabel.innerHTML = `<span class="choose-btn">Choose File</span>No file chosen`;
                        return;
                    }

                    if(file.size > 10 * 1024 * 1024){
                        showError('File size exceeds the 10MB limit. Please upload a smaller document.');
                        fileInput.value = '';
                        uploadLabel.innerHTML = `<span class="choose-btn">Choose File</span>No file chosen`;
                        return;
                    }

                    fileName = file.name;
                }

                uploadLabel.innerHTML = `
                    <span class="choose-btn">Choose File</span>
                    ${fileName}
                `;
            });
        }
    });

</script>