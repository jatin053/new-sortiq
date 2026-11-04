@extends('layouts.frontend')

@section('title', 'FAQ | Sortiq Solutions')
@section('body_attributes') data-route="/faq" @endsection

@section('content')
<main class="font-raleway">
    <div class="w-full font-sans bg-gray-50 antialiased">
      <script type="application/ld+json">{"@@context":"https://schema.org","@type":"FAQPage","mainEntity":[{"@type":"Question","name":"What services does Sortiq Solutions provide?","acceptedAnswer":{"@type":"Answer","text":"Sortiq Solutions specializes in a wide range of digital services including Web Development, App Development, Software Development, Graphic Designing, and Digital Marketing (SEO/SMO)."}},{"@type":"Question","name":"How can I apply for an internship?","acceptedAnswer":{"@type":"Answer","text":"You can apply for an internship by clicking the 'Apply Internship' link in our header or by using the 'Fresher Hiring' portal on our website."}},{"@type":"Question","name":"Where is your office located?","acceptedAnswer":{"@type":"Answer","text":"Our office is located at E-51, Second Floor, Phase - 8, Industrial Area, S.A.S. Nagar, Mohali, Punjab 160071."}},{"@type":"Question","name":"How do I get a project quote?","acceptedAnswer":{"@type":"Answer","text":"You can get a project quote by filling out the 'Get In Touch' form with your requirements, or by calling us directly at +91 9646522110."}}]}</script>
      <header class="relative w-full h-48 md:h-64 lg:h-[280px] overflow-hidden">
        <img src="{{ asset('frontend-assets/media/pages/faq/faq-hero.webp') }}" alt="Sortiq Solutions Office - FAQ Support" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-[#001a3d]/75 flex flex-col justify-center items-center text-center p-6">
          <h1 class="text-white text-3xl md:text-5xl font-extrabold mb-3 tracking-tight">FAQ</h1>
          <div class="w-16 h-1.5 bg-[#ff6600]"></div>
        </div>
      </header>

      <main class="max-w-7xl mx-auto px-4 sm:px-6 py-10 md:py-20 grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
        <section class="lg:col-span-2 order-2 lg:order-1">
          <div class="mb-10 text-center lg:text-left">
            <h2 class="text-[#001a3d] text-2xl md:text-3xl font-extrabold">Frequently Asked Questions</h2>
            <div class="w-12 h-1 bg-[#ff6600] mt-3 mx-auto lg:mx-0"></div>
          </div>
          <div class="space-y-4">
            
              <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                <button type="button" data-faq-button="faq-panel-0" aria-expanded="false" class="w-full flex items-center justify-between p-5 md:p-6 text-left transition-colors outline-none cursor-pointer">
                  <span class="font-bold pr-4 leading-snug md:text-lg text-[#001a3d] transition-colors">What services does Sortiq Solutions provide?</span>
                  <iconify-icon icon="lucide:chevron-down" width="20" height="20" class="text-gray-400 transition-transform"></iconify-icon>
                </button>
                <div id="faq-panel-0" class="faq-panel px-5 md:px-6 pb-6 text-gray-600 text-sm md:text-base leading-relaxed border-t border-gray-50 animate-fadeIn" hidden>
                  <p class="mt-4">Sortiq Solutions specializes in a wide range of digital services including Web Development, App Development, Software Development, Graphic Designing, and Digital Marketing (SEO/SMO).</p>
                </div>
              </div>
            
              <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                <button type="button" data-faq-button="faq-panel-1" aria-expanded="false" class="w-full flex items-center justify-between p-5 md:p-6 text-left transition-colors outline-none cursor-pointer">
                  <span class="font-bold pr-4 leading-snug md:text-lg text-[#001a3d] transition-colors">How can I apply for an internship?</span>
                  <iconify-icon icon="lucide:chevron-down" width="20" height="20" class="text-gray-400 transition-transform"></iconify-icon>
                </button>
                <div id="faq-panel-1" class="faq-panel px-5 md:px-6 pb-6 text-gray-600 text-sm md:text-base leading-relaxed border-t border-gray-50 animate-fadeIn" hidden>
                  <p class="mt-4">You can apply for an internship by clicking the 'Apply Internship' link in our header or by using the 'Fresher Hiring' portal on our website.</p>
                </div>
              </div>
            
              <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                <button type="button" data-faq-button="faq-panel-2" aria-expanded="false" class="w-full flex items-center justify-between p-5 md:p-6 text-left transition-colors outline-none cursor-pointer">
                  <span class="font-bold pr-4 leading-snug md:text-lg text-[#001a3d] transition-colors">Where is your office located?</span>
                  <iconify-icon icon="lucide:chevron-down" width="20" height="20" class="text-gray-400 transition-transform"></iconify-icon>
                </button>
                <div id="faq-panel-2" class="faq-panel px-5 md:px-6 pb-6 text-gray-600 text-sm md:text-base leading-relaxed border-t border-gray-50 animate-fadeIn" hidden>
                  <p class="mt-4">Our office is located at E-51, Second Floor, Phase - 8, Industrial Area, S.A.S. Nagar, Mohali, Punjab 160071.</p>
                </div>
              </div>
            
              <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                <button type="button" data-faq-button="faq-panel-3" aria-expanded="false" class="w-full flex items-center justify-between p-5 md:p-6 text-left transition-colors outline-none cursor-pointer">
                  <span class="font-bold pr-4 leading-snug md:text-lg text-[#001a3d] transition-colors">How do I get a project quote?</span>
                  <iconify-icon icon="lucide:chevron-down" width="20" height="20" class="text-gray-400 transition-transform"></iconify-icon>
                </button>
                <div id="faq-panel-3" class="faq-panel px-5 md:px-6 pb-6 text-gray-600 text-sm md:text-base leading-relaxed border-t border-gray-50 animate-fadeIn" hidden>
                  <p class="mt-4">You can get a project quote by filling out the 'Get In Touch' form with your requirements, or by calling us directly at +91 9646522110.</p>
                </div>
              </div>
            
          </div>
        </section>

        <aside class="lg:col-span-1 space-y-6 order-1 lg:order-2">
          <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-gray-100 sticky top-10">
            <h3 class="text-[#001a3d] text-xl font-extrabold mb-8 border-b border-gray-100 pb-4">Contact Info</h3>
            <div class="space-y-8">
              <div class="flex gap-4 group">
                <div class="bg-[#ff6600] p-3 rounded-xl text-white h-fit shadow-lg shadow-orange-100 transition-transform group-hover:scale-110"><iconify-icon icon="lucide:phone" width="20" height="20"></iconify-icon></div>
                <div>
                  <p class="font-extrabold text-[#001a3d] text-xs uppercase tracking-widest mb-1">CALL US</p>
                  <a href="tel:+919646522110" class="text-gray-600 font-semibold hover:text-[#ff6600] transition-colors">+91 9646522110</a>
                </div>
              </div>
              <div class="flex gap-4 group">
                <div class="bg-[#ff6600] p-3 rounded-xl text-white h-fit shadow-lg shadow-orange-100 transition-transform group-hover:scale-110"><iconify-icon icon="lucide:mail" width="20" height="20"></iconify-icon></div>
                <div>
                  <p class="font-extrabold text-[#001a3d] text-xs uppercase tracking-widest mb-1">WRITE US</p>
                  <a href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#105;&#110;&#102;&#111;&#64;&#115;&#111;&#114;&#116;&#105;&#113;&#115;&#111;&#108;&#117;&#116;&#105;&#111;&#110;&#115;&#46;&#99;&#111;&#109;" class="text-gray-600 font-semibold block hover:text-[#ff6600] transition-colors break-all">&#105;&#110;&#102;&#111;&#64;&#115;&#111;&#114;&#116;&#105;&#113;&#115;&#111;&#108;&#117;&#116;&#105;&#111;&#110;&#115;&#46;&#99;&#111;&#109;</a>
                  <a href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#115;&#111;&#114;&#116;&#105;&#113;&#115;&#111;&#108;&#117;&#116;&#105;&#111;&#110;&#115;&#64;&#103;&#109;&#97;&#105;&#108;&#46;&#99;&#111;&#109;" class="text-gray-600 font-semibold block hover:text-[#ff6600] transition-colors break-all">&#115;&#111;&#114;&#116;&#105;&#113;&#115;&#111;&#108;&#117;&#116;&#105;&#111;&#110;&#115;&#64;&#103;&#109;&#97;&#105;&#108;&#46;&#99;&#111;&#109;</a>
                </div>
              </div>
              <div class="flex gap-4 group">
                <div class="bg-[#ff6600] p-3 rounded-xl text-white h-fit shadow-lg shadow-orange-100 transition-transform group-hover:scale-110"><iconify-icon icon="lucide:map-pin" width="20" height="20"></iconify-icon></div>
                <div>
                  <p class="font-extrabold text-[#001a3d] text-xs uppercase tracking-widest mb-1">VISIT US</p>
                  <address class="text-gray-600 font-semibold not-italic leading-snug">E-51, Second Floor, Phase - 8,<br>Industrial Area, S.A.S. Nagar,<br>Mohali, Punjab 160071</address>
                </div>
              </div>
            </div>
            <div class="sq-faq-socials" style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 7px; margin-top: 32px; padding-top: 24px; border-top: 1px solid #f1f5f9; align-items: center; width: 100%;">
              
                <a href="https://www.facebook.com/SortiqSolutions/" target="_blank" rel="noopener noreferrer" aria-label="Follow us on Facebook" class="sq-faq-social-btn" style="aspect-ratio: 1; border-radius: 9px; background: #ff6600; color: #ffffff; display: flex; align-items: center; justify-content: center; text-decoration: none; box-shadow: 0 4px 10px rgba(255, 102, 0, 0.22); transition: all 0.25s ease;">
                  <iconify-icon icon="fa6-brands:facebook-f" width="15" height="15" style="color: #ffffff;"></iconify-icon>
                </a>
              
                <a href="https://www.linkedin.com/company/sortiq-solutions/" target="_blank" rel="noopener noreferrer" aria-label="Follow us on LinkedIn" class="sq-faq-social-btn" style="aspect-ratio: 1; border-radius: 9px; background: #ff6600; color: #ffffff; display: flex; align-items: center; justify-content: center; text-decoration: none; box-shadow: 0 4px 10px rgba(255, 102, 0, 0.22); transition: all 0.25s ease;">
                  <iconify-icon icon="fa6-brands:linkedin-in" width="15" height="15" style="color: #ffffff;"></iconify-icon>
                </a>
              
                <a href="https://www.instagram.com/sortiqsolutions/" target="_blank" rel="noopener noreferrer" aria-label="Follow us on Instagram" class="sq-faq-social-btn" style="aspect-ratio: 1; border-radius: 9px; background: #ff6600; color: #ffffff; display: flex; align-items: center; justify-content: center; text-decoration: none; box-shadow: 0 4px 10px rgba(255, 102, 0, 0.22); transition: all 0.25s ease;">
                  <iconify-icon icon="fa6-brands:instagram" width="15" height="15" style="color: #ffffff;"></iconify-icon>
                </a>
              
                <a href="https://www.youtube.com/@SortiqSolutions" target="_blank" rel="noopener noreferrer" aria-label="Follow us on YouTube" class="sq-faq-social-btn" style="aspect-ratio: 1; border-radius: 9px; background: #ff6600; color: #ffffff; display: flex; align-items: center; justify-content: center; text-decoration: none; box-shadow: 0 4px 10px rgba(255, 102, 0, 0.22); transition: all 0.25s ease;">
                  <iconify-icon icon="fa6-brands:youtube" width="15" height="15" style="color: #ffffff;"></iconify-icon>
                </a>
              
                <a href="https://x.com/SortiqSolutions" target="_blank" rel="noopener noreferrer" aria-label="Follow us on Twitter" class="sq-faq-social-btn" style="aspect-ratio: 1; border-radius: 9px; background: #ff6600; color: #ffffff; display: flex; align-items: center; justify-content: center; text-decoration: none; box-shadow: 0 4px 10px rgba(255, 102, 0, 0.22); transition: all 0.25s ease;">
                  <iconify-icon icon="fa6-brands:x-twitter" width="15" height="15" style="color: #ffffff;"></iconify-icon>
                </a>
              
                <a href="https://in.pinterest.com/sortiqsolutions/" target="_blank" rel="noopener noreferrer" aria-label="Follow us on Pinterest" class="sq-faq-social-btn" style="aspect-ratio: 1; border-radius: 9px; background: #ff6600; color: #ffffff; display: flex; align-items: center; justify-content: center; text-decoration: none; box-shadow: 0 4px 10px rgba(255, 102, 0, 0.22); transition: all 0.25s ease;">
                  <iconify-icon icon="fa6-brands:pinterest-p" width="15" height="15" style="color: #ffffff;"></iconify-icon>
                </a>
              
                <a href="https://medium.com/@sortiqsolutions" target="_blank" rel="noopener noreferrer" aria-label="Follow us on Medium" class="sq-faq-social-btn" style="aspect-ratio: 1; border-radius: 9px; background: #ff6600; color: #ffffff; display: flex; align-items: center; justify-content: center; text-decoration: none; box-shadow: 0 4px 10px rgba(255, 102, 0, 0.22); transition: all 0.25s ease;">
                  <iconify-icon icon="fa6-brands:medium" width="15" height="16" style="color: #ffffff;"></iconify-icon>
                </a>
              
            </div>
            <style>
              .sq-faq-social-btn:hover {
                background: #001a3d !important;
                transform: translateY(-2px);
                box-shadow: 0 6px 14px rgba(0, 26, 61, 0.25) !important;
              }
            </style>
          </div>
        </aside>
      </main>
@endsection
