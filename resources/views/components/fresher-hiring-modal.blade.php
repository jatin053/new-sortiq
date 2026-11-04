<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>

    /* Modal Overlay */
    #fresherHiringModal{
        backdrop-filter:blur(10px);
        -webkit-backdrop-filter:blur(10px);
    }

    /* Main Modal */
    #fresherHiringModalContent{
        background:linear-gradient(135deg,#00173e 0%,#00265f 100%);
        box-shadow:0 25px 60px rgba(0,0,0,0.45);
        overflow:hidden;
        min-height:650px;
        max-height:95vh;
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

        #fresherHiringModalContent{
            min-height:auto;
            max-height:95vh;
            overflow-y:auto;
        }

        .fresher-left{
            min-height:280px;
        }

        .right-form-area{
            min-height:auto;
        }

        .fresher-blink-title{
            font-size:24px;
            top:18px;
        }

        .connect-heading{
            font-size:24px;
        }
    }

    @media(max-width:480px){

        .fresher-blink-title{
            font-size:20px;
        }

        .custom-field{
            height:50px;
        }

        .upload-box{
            height:50px;
        }

        .submit-btn{
            height:50px;
            font-size:15px;
        }

        .phone-wrapper{
            height:50px;
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
            <form action="#" method="POST" enctype="multipart/form-data" class="fresher-connect-form space-y-4">

                @csrf

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
                <div class="upload-box">

                    <div class="upload-icon">
                        <iconify-icon icon="lucide:upload" width="18"></iconify-icon>
                    </div>

                    <input type="file" name="attachment" id="attachmentInput">

                    <div class="upload-label" id="uploadLabel">
                        <span class="choose-btn">Choose File</span>
                        No file chosen
                    </div>

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

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        setTimeout(() => {

            modal.classList.remove('opacity-0');

            content.classList.remove('scale-95');
            content.classList.add('scale-100');

        },10);

        document.body.style.overflow='hidden';
    }

    function closeFresherModal(){

        const modal=document.getElementById('fresherHiringModal');
        const content=document.getElementById('fresherHiringModalContent');

        modal.classList.add('opacity-0');

        content.classList.remove('scale-100');
        content.classList.add('scale-95');

        setTimeout(()=>{

            modal.classList.add('hidden');
            modal.classList.remove('flex');

            document.body.style.overflow='';

        },300);
    }

    // Outside Click Close
    document.getElementById('fresherHiringModal').addEventListener('click',function(e){

        if(e.target===this){
            closeFresherModal();
        }

    });

    // File Upload Name
    document.addEventListener('DOMContentLoaded',function(){

        const fileInput=document.getElementById('attachmentInput');
        const uploadLabel=document.getElementById('uploadLabel');

        if(fileInput){

            fileInput.addEventListener('change',function(e){

                let fileName='No file chosen';

                if(e.target.files.length>0){
                    fileName=e.target.files[0].name;
                }

                uploadLabel.innerHTML=`
                    <span class="choose-btn">Choose File</span>
                    ${fileName}
                `;
            });
        }
    });

</script>