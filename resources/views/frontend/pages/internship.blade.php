@extends('layouts.frontend')

@section('title', 'Best internship company in Chandigarh Mohali')

@section('body_attributes')
    data-route="/internship"
@endsection

@push('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css">
@endpush

@section('content')
<main class="font-raleway">
    <div class="w-full font-sans text-[#333] overflow-x-hidden">

        {{-- Hero Section --}}
        <section class="relative min-h-screen lg:min-h-[750px] flex items-center py-12 md:py-20 px-4 sm:px-8 lg:px-24 bg-cover bg-center bg-no-repeat"
                 style="background-image: url('{{ asset('frontend-assets/media/pages/internship/internship-banner.png') }}');">
            <div class="absolute inset-0 bg-black/80 md:bg-black/75 z-0"></div>

            <div class="relative z-10 max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-12 items-center">

                {{-- Left Content --}}
                <div class="text-left text-white px-2">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 uppercase tracking-tight leading-tight">
                        Why Join Our <br class="hidden sm:block"> Internship Program?
                    </h1>

                    <div class="w-16 h-1.5 bg-[#ff6600] mb-6 md:mb-8"></div>

                    <div class="space-y-4 md:space-y-6 text-gray-200 text-sm md:text-base leading-relaxed max-w-xl">
                        <p>
                            At Sortiq Solutions Pvt. Ltd., we believe in nurturing the next generation of IT professionals
                            by providing real-world experience in a dynamic and innovative environment.
                        </p>
                        <p>
                            We focus on equipping interns with industry-relevant expertise that enhances their employability.
                            By the end of the program, participants are prepared to step confidently into their professional careers.
                        </p>
                    </div>
                </div>

                {{-- Form --}}
                <div class="internship-form-shell">
                    <div class="internship-form-panel">

                        <form class="internship-application-form" method="post" action="{{ route('api.internship-applications.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="internship">
                            <input type="hidden" name="url" value="{{ url()->current() }}">
                            <!-- Name -->
                            <div class="custom-field">
                                <span class="field-icon">
                                    <iconify-icon icon="lucide:user" width="18" height="18" aria-hidden="true"></iconify-icon>
                                </span>
                                <input name="name" type="text" placeholder="Enter Your Name" autocomplete="name" required>
                            </div>

                            <!-- Email -->
                            <div class="custom-field">
                                <span class="field-icon">
                                    <iconify-icon icon="lucide:mail" width="18" height="18" aria-hidden="true"></iconify-icon>
                                </span>
                                <input name="email" type="email" placeholder="Enter Your Email" autocomplete="email" required>
                            </div>

                            <!-- Phone -->
                            <div class="phone-wrapper">
                                <input id="internship-phone" name="phone" type="tel" inputmode="tel"
                                    placeholder="Enter Your Phone Number" autocomplete="tel-national" required>
                                <input type="hidden" name="country_code" value="+91">
                            </div>

                            <!-- Subject -->
                            <div class="custom-field">
                                <span class="field-icon">
                                    <iconify-icon icon="fa6-solid:list" width="16" height="16" aria-hidden="true"></iconify-icon>
                                </span>
                                <input name="subject" type="text" placeholder="Subject" required>
                            </div>

                            <!-- Institute -->
                            <div class="custom-field">
                                <span class="field-icon">
                                    <iconify-icon icon="lucide:building-2" width="18" height="18" aria-hidden="true"></iconify-icon>
                                </span>
                                <input name="institute" type="text" placeholder="Enter Your Institute" required>
                            </div>

                            <!-- Technology -->
                            <div class="custom-field">
                                <span class="field-icon">
                                    <iconify-icon icon="lucide:code-2" width="18" height="18" aria-hidden="true"></iconify-icon>
                                </span>
                                <select name="technology" required>
                                    <option value="">Select Technology</option>
                                    <option>Web Designing</option>
                                    <option>Web Development</option>
                                    <option>Digital Marketing</option>
                                    <option>React JS</option>
                                    <option>Python</option>
                                    <option>Java</option>
                                    <option>.NET</option>
                                    <option>HR & Finance</option>
                                    <option>Networking</option>
                                    <option>Graphic Designing</option>
                                    <option>Android Development</option>
                                    <option>React Native</option>
                                    <option>Kotlin</option>
                                    <option>Machine learning/AI</option>
                                    <option>Data Science</option>
                                    <option>Shopify Development</option>
                                    <option>Cloud Computing</option>
                                    <option>CodeIgniter</option>
                                    <option>Software Testing</option>
                                </select>
                                <iconify-icon icon="lucide:chevron-down" width="16" height="16" class="select-caret" aria-hidden="true"></iconify-icon>
                            </div>

                            <!-- Message -->
                            <div class="custom-field textarea-field">
                                <span class="field-icon">
                                    <iconify-icon icon="fa6-solid:comments" width="18" height="18" aria-hidden="true"></iconify-icon>
                                </span>
                                <textarea name="message" placeholder="Enter your message" rows="4" required></textarea>
                            </div>

                            <!-- Recaptcha -->
                            <div class="recaptcha-wrap">
                                @include('components.recaptcha')
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="submit-btn">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        {{-- Internship Offerings --}}
        <section class="relative py-16 md:py-24 px-4 sm:px-8 lg:px-24 text-center">
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('frontend-assets/media/pages/internship/internship-offerings-background.webp') }}"
                     alt="Offerings Background"
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-white/95"></div>
            </div>

            <div class="relative z-10 max-w-7xl mx-auto">
                <h2 class="text-[#001a3d] text-2xl md:text-3xl font-bold mb-2 uppercase tracking-tight">
                    Comprehensive Internship Offerings
                </h2>

                <div class="w-16 h-0.5 bg-[#ff6600] mx-auto mb-8 md:mb-10"></div>

                <p class="max-w-4xl mx-auto text-gray-500 text-sm md:text-base leading-relaxed mb-12 md:mb-16">
                    At Sortiq Solutions Pvt. Ltd., we believe in nurturing the next generation of IT professionals by providing real-world experience in a dynamic and innovative environment. Our internship program is designed to help students and recent graduates develop technical and professional skills while working on live projects.
                </p>

                @php
                    $offerings = [
                        [
                            'title' => 'Innovative Environment',
                            'subtitle' => 'Work with cutting-edge technology and contribute to transformative IT solutions.',
                            'border' => '#5cbaba',
                            'bg' => '#e4f2f3',
                            'hover_bg' => '#3aa8a8',
                            'items' => [
                                'Ideal for students and freshers seeking quick industry insights',
                                'Hands-on experience with real-world IT projects',
                                'Guidance from experienced professionals',
                                'Completion certificate and recommendation letter'
                            ],
                        ],
                        [
                            'title' => 'Standard Internship',
                            'subtitle' => 'Practical Learning & Skill Development',
                            'border' => '#7c3aed',
                            'bg' => '#eeeefa',
                            'hover_bg' => '#5959b3',
                            'items' => [
                                'In-depth exposure to core IT services',
                                'Training on the latest technologies and industry best practices',
                                'Mentorship and structured learning sessions',
                                'Opportunity to work on live projects'
                            ],
                        ],
                        [
                            'title' => 'Advanced Internship',
                            'subtitle' => 'Work-Integrated Learning Experience',
                            'border' => '#2563eb',
                            'bg' => '#9bb4cb',
                            'hover_bg' => '#8cbee8',
                            'items' => [
                                'Designed for students seeking deep technical knowledge',
                                'Hands-on project development with industry experts',
                                'Performance-based pre-placement offers',
                                'Soft skills and career readiness training'
                            ],
                        ],
                        [
                            'title' => 'Long-Term Internship',
                            'subtitle' => 'Professional IT Career Acceleration',
                            'border' => '#e11d48',
                            'bg' => '#ecdcdb',
                            'hover_bg' => '#a6595d',
                            'items' => [
                                'Comprehensive industry training and project execution',
                                'Strong emphasis on leadership and problem-solving skills',
                                'Stipend-based Internship with performance incentives',
                                'High probability of full-time employment with Sortiq Solutions'
                            ],
                        ],
                    ];
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-12">
                    @foreach ($offerings as $offering)
                        <div class="offering-card border-2 border-dashed p-6 sm:p-10 text-left transition-all duration-300 hover:shadow-xl"
                             style="border-color: {{ $offering['border'] }}; background-color: {{ $offering['bg'] }}; --hover-bg: {{ $offering['hover_bg'] }};">

                            <h3 class="text-[#001a3d] text-xl md:text-2xl font-bold mb-2 text-center uppercase tracking-tighter">
                                {{ $offering['title'] }}
                            </h3>

                            <p class="text-[#333] text-xs font-bold text-center mb-6 pb-4">
                                {{ $offering['subtitle'] }}
                            </p>

                            <ul class="space-y-3 sm:space-y-4">
                                @foreach ($offering['items'] as $item)
                                    <li class="flex items-start gap-3 text-sm text-gray-700">
                                        <iconify-icon icon="lucide:check" width="16" height="16"
                                            class="mt-1 shrink-0 text-black font-bold"></iconify-icon>
                                        <span class="font-medium">{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Internship Areas --}}
        <section class="relative py-16 md:py-24 px-6 lg:px-24 overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('frontend-assets/media/pages/internship/2150061955.jpg') }}"
                     alt="Technology Background"
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-[#001a3d]/90"></div>
            </div>

            <div class="relative z-10 max-w-7xl mx-auto">
                <div class="text-center mb-12 md:mb-16">
                    <h2 class="text-white text-3xl font-bold mb-2 tracking-normal" style="font-family: 'Poppins', sans-serif;">
                        Internship Areas
                    </h2>
                    <div class="w-14 h-1 bg-[#ff6600] mx-auto"></div>
                </div>

                @php
                    $areas = [
                        ['Web Designing', 'Web Development', 'Digital Marketing', 'React JS', 'Python'],
                        ['Java', '.NET', 'HR & Finance', 'Networking', 'Graphic Designing'],
                        ['Android Development', 'React Native', 'Kotlin', 'Machine learning/AI', 'Networking'],
                        ['Data Science', 'Shopify Development', 'Cloud Computing', 'CodeIgniter', 'Software Testing'],
                    ];
                @endphp

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-6 sm:gap-y-10">
                    @foreach ($areas as $column)
                        <ul class="space-y-4 sm:space-y-5">
                            @foreach ($column as $area)
                                <li class="flex items-center gap-3 text-white text-sm font-medium group cursor-pointer" style="font-family: 'Poppins', sans-serif;">
                                    <iconify-icon icon="lucide:check" width="16" height="16"
                                        class="text-[#ff6600] stroke-[4px] shrink-0"></iconify-icon>
                                    <span class="group-hover:text-[#ff6600] transition-colors duration-200">
                                        {{ $area }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>
        </section>

    </div>
</main>
@endsection
                    
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const phoneField = document.getElementById('internship-phone');
    const form = phoneField?.closest('form');
    const countryCodeField = form?.querySelector('input[name="country_code"]');
    if (!phoneField || !form || !countryCodeField || !window.intlTelInput) return;

    const phonePicker = window.intlTelInput(phoneField, {
        initialCountry: 'in',
        separateDialCode: true,
        nationalMode: true,
        autoPlaceholder: 'aggressive',
        dropdownContainer: document.body,
        utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js',
    });

    const syncCountryCode = function () {
        const country = phonePicker.getSelectedCountryData();
        countryCodeField.value = country?.dialCode ? '+' + country.dialCode : '';
    };

    phoneField.addEventListener('countrychange', syncCountryCode);
    form.addEventListener('submit', syncCountryCode);
    syncCountryCode();
});
</script>
@endpush
