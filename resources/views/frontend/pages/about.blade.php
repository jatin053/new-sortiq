@extends('layouts.frontend')



@section('title', 'About Us - Sortiq Solutions')

@section('body_attributes') data-route="/about-us" @endsection



@push('head')

<link rel="preload" as="image" href="{{ asset('frontend-assets/media/pages/about/about_us_background.webp') }}" type="image/webp" fetchpriority="high">

<style>

  :root  {

    --sq-bg: #f2f2f2;

    --sq-card-blue: #202846;

  }

  .sq-page  {

    width: 100%;

    overflow: hidden;

    background: var(--sq-bg);

  }

  .sq-container  {

    width: min(1145px, calc(100% - 30px));

    margin: 0 auto;

  }

  .sq-heading  {

    margin: 0;

    color: var(--sq-blue);

    font-size: 38px;

    line-height: 1.15;

    font-weight: 700;

  }

  .sq-line::after  {

    content: "";

    display: block;

    width: 40px;

    height: 3px;

    margin: 28px 0 0;

    background: var(--sq-orange);

  }

  .sq-lines::after  {

    content: "";

    display: block;

    width: 40px;

    height: 3px;

    margin: 28px 0 0 12vw;

    background: var(--sq-orange);

  }

  .sq-line-center::after  {

    margin-left: auto;

    margin-right: auto;

  }

  .sq-line-white::after  {

    background: #fff;

  }



  .about-hero  {

    position: relative;

    min-height: 200px;

    display: flex;

    align-items: center;

    justify-content: center;

    text-align: center;

    background-image: linear-gradient(rgba(0, 0, 0, .7), rgba(0, 0, 0, .7)), url("{{ asset('frontend-assets/media/pages/about/about_us_background.webp') }}");

    background-position: center;

    background-size: cover;

    background-repeat: no-repeat;

}



  .about-hero h1  {

    margin: 0;

    color: #fff !important;

    font-size: 36px;

    line-height: 1.08;

    font-weight: 700;

    text-shadow: 0 2px 4px rgba(0, 0, 0, .45);

}



  .about-hero .sq-line::after  {

    margin-top: 33px;

}



  .about-main  {

    padding: 58px 0 92px;

    background: var(--sq-bg);

}



  .about-intro  {

    display: grid;

    grid-template-columns: 1fr 1fr;

    gap: 32px;

    align-items: start;

}



  .about-copy  {

    padding-top: 5px;

    max-width: 100%;

}



  .about-copy .sq-heading  {

    font-size: 32px;

}



  .about-copy p  {

    font-family: 'Roboto', 'Nunito', sans-serif !important;

    margin: 32px 0 0;

    color: #111;

    font-size: 15.5px;

    line-height: 1.75;

    font-weight: 400 !important;

    text-align: justify;

    letter-spacing: 0.1px;

    word-spacing: 0.2px;

}



  .about-copy a  {

    color: #1b65c9;

    text-decoration: none;

}



  .about-image-wrap  {

    position: relative;

    width: 100%;

    display: flex;

    justify-content: center;

    align-items: center;

    margin-top: 0;

}



  .about-image-card  {

    position: relative;

    width: 100%;

    max-width: 650px;

    padding: 0;

    background: transparent;

    border-radius: 0;

    box-shadow: none;

    overflow: hidden;

}



  .about-image-card::before  {

    display: none;

}



  .about-image  {

    display: block;

    width: 100%;

    height: auto;

    border-radius: 0;

    box-shadow: none;

    object-fit: cover;

}



  .about-pillars  {

    display: grid;

    grid-template-columns: 1fr 1fr 1fr;

    gap: 24px;

    margin-top: 78px;

    content-visibility: auto;

    contain-intrinsic-size: 374px;

}



  .pillar-card  {

    aspect-ratio: 1 / 1;

   /* Force Square shape */

    display: flex;

    flex-direction: column;

    justify-content: center;

    padding: 30px;

   /* Reduced padding to fit square */

    color: #fff;

    background: var(--sq-card-blue);

    box-shadow: 0 0 8px rgba(0, 0, 0, .35);

    transition: color .28s ease, background-color .28s ease, transform .28s ease;

}



  .pillar-card h2  {

    font-family: 'Roboto', 'Nunito', sans-serif !important;

    margin: 0 0 15px;

    color: inherit;

    font-size: 30px;

   /* Reduced size for square */

    line-height: 1.15;

    text-align: center;

}



  .pillar-card p  {

    font-family: 'Roboto', 'Nunito', sans-serif !important;

    margin: 12px;

    line-height: 1.75;

    font-weight: 400 !important;

    text-align: justify;

    font-size: 15px;

    letter-spacing: 0.1px;

    word-spacing: 0.2px;

}



  .pillar-card.left  {

    border-bottom-right-radius: 70px;

}



  .pillar-card.right  {

    border-bottom-right-radius: 70px;

}



  .pillar-card.middle  {

    color: #000;

    background: #ebcbbd;

    border-top-left-radius: 70px;

    border-top-right-radius: 70px;

}



  .pillar-card:hover  {

    color: #fff;

    background: #9C52B3;

    transform: translateY(-4px);

}



  .pillar-card.middle:hover  {

    transform: translateY(-6px);

}



  .about-lower  {

    display: grid;

    grid-template-columns: 1fr 1fr;

    gap: 60px;

    align-items: start;

    margin-top: 137px;

}



  .why-about .sq-heading,

  .partner-form .sq-heading  {

    font-size: 32px;

}



  .why-about p  {

    font-family: 'Roboto', 'Nunito', sans-serif !important;

    margin: 34px 0 0;

    color: #111;

    font-size: 15.9px;

    line-height: 1.75;

    font-weight: 400 !important;

    text-align: justify;

    letter-spacing: 0.1px;

    word-spacing: 0.2px;

}



  .why-list  {

    display: grid;

    gap: 12px;

    margin-top: 26px;

}



  .why-list p  {

    position: relative;

    margin: 0;

    text-align: justify;

    line-height: 1.75;

    font-family: 'Roboto', 'Nunito', sans-serif !important;

    font-weight: 400 !important;

    font-size: 15px;

}



  .why-list p::before  {

    content: "\2713";

    display: inline-block;

    margin-right: 10px;

    color: #111;

    font-size: 18px;

    line-height: 1;

    font-weight: 900;

}



  .partner-form  {

    text-align: left;

}



  .partner-form .sq-heading  {

    text-align: left;

}



  .partner-form .sq-form  {

    margin-top: 38px;

}



  .sq-form  {

    display: grid;

    gap: 15px;

}



  .sq-form-row  {

    display: grid;

    grid-template-columns: 1fr 1fr;

    gap: 20px;

}



  .sq-field  {

    position: relative;

    display: block;

    background: #fff;

    border: 1px solid #dcdcdc;  

}



  .sq-field iconify-icon  {

    position: absolute;

    left: 14px;

    top: 50%;

    z-index: 2;

    color: var(--sq-orange);

    font-size: 18px;

    transform: translateY(-50%);

    pointer-events: none;

}



  .sq-field .sq-textarea-icon  {

    top: 58px;

    transform: none;

}



  .sq-input,

  .sq-textarea  {

    width: 100%;

    border: 0;

    border-radius: 0;

    outline: none;

    color: #222;

    background: #fff;

    font-family: inherit;

    font-size: 15px;

    font-style: italic;

}



  .sq-input  {

    height: 56px;

    min-height: 56px;

    padding: 13px 15px 13px 45px;

}



  .sq-textarea  {

    min-height: 110px;

    padding: 20px 15px 15px 60px;

    resize: none;

}



  .sq-input::placeholder,

  .sq-textarea::placeholder  {

    color: #9c9c9c;

    opacity: 1;

}



  .iti  {

    width: 100%;

}



  .sq-phone-field  {

    min-height: 56px;

}



  #sq-phone  {

    padding-left: 112px !important;

}



  .iti__selected-flag  {

    padding-left: 12px !important;

}



  .iti__country-list  {

    z-index: 9999 !important;

}



  .sq-recaptcha  {

    width: 345px;

    min-height: 78px;

    max-width: 100%;

    overflow: hidden;

    display: none;

    margin-top: 10px;

}



  .sq-recaptcha.is-visible  {

    display: block;

}



  .sq-submit  {

    width: 100%;

    min-height: 52px;

    padding: 14px 24px;

    border: 0;

    border-radius: 999px;

    color: #fff;

    background: #ff6600;

    font-size: 15px;

    font-weight: 600;

    cursor: pointer;

    box-shadow: 0 4px 14px rgba(255, 102, 0, 0.25);

    transition: all .25s ease;

}



  .sq-submit:hover  {

    background: #001b43;

    transform: translateY(-2px);

    box-shadow: 0 6px 18px rgba(0, 27, 67, 0.3);

}



  .join-band  {

    position: relative;

    min-height: 365px;

    display: flex;

    align-items: center;

    color: #fff;

    text-align: center;

    background-image: linear-gradient(rgba(0, 0, 0, .76), rgba(0, 0, 0, .76)), url("{{ asset('frontend-assets/media/pages/about/join-us-background.jpg') }}");

    background-position: center;

    background-size: cover;

    background-repeat: no-repeat;

    content-visibility: auto;

    contain-intrinsic-size: 428px;

}



  .join-band h2  {

    margin: 0;

    color: #fff !important;

    font-size: 26px;

    line-height: 1.2;

    font-weight: 700;

}



  .join-band .sq-line::after  {

    margin-top: 29px;

}



  .join-band p  {

    max-width: 1285px;

    letter-spacing: 0.1px;

    word-spacing: 0.2px;

    margin: 25px auto 0;

    color: #fff;

    font-family: 'Roboto', 'Nunito', sans-serif !important;

    font-size: 15.9px;

    line-height: 1.75;

    font-weight: 400 !important;

}



  .sq-reveal  {

    opacity: 0;

    transform: translateY(28px);

    transition: opacity .65s ease, transform .65s ease;

}



  .sq-reveal.is-visible  {

    opacity: 1;

    transform: translateY(0);

}



  



  @media (max-width: 991px)  {

    .about-intro,

    .about-pillars,

    .about-lower,

    .sq-form-row  {

      grid-template-columns: 1fr;

}



    .about-hero  {

      min-height: 180px;

}



    .about-image  {

      height: auto;

      aspect-ratio: 494 / 370;

}



    .about-main  {

      padding: 45px 0 65px;

}



    .about-intro,

    .about-lower  {

      gap: 42px;

}



    .about-pillars  {

      margin-top: 50px;

      contain-intrinsic-size: 1180px;

}



    .about-lower  {

      contain-intrinsic-size: 1240px;

}



    .pillar-card,

    .pillar-card.middle  {

      min-height: auto;

      padding: 40px 28px;

      border-radius: 0 0 54px 0;

      box-shadow: none;

      transition: none;

      aspect-ratio: auto;

}



    .pillar-card:hover,

    .pillar-card.middle:hover  {

      transform: none;

}



    .sq-submit  {

      transition: none;

}



    .sq-heading,

    .about-copy .sq-heading,

    .why-about .sq-heading,

    .partner-form .sq-heading  {

      font-size: 30px;

}



}

  @media (max-width: 575px)  {

    .about-lower  {

      margin-top: 70px;

}



    .sq-recaptcha  {

      width: 304px;

      transform: scale(.88);

      transform-origin: left top;

}



    .join-band  {

      min-height: 360px;

      padding: 60px 0 66px;

}



    .join-band p  {

      font-size: 15px;

      line-height: 1.5;

}



}

</style>

@endpush



@section('content')

<main class="sq-page">

  <section class="about-hero">

    <div class="sq-container">

      <h1 class="sq-line sq-line-center sq-line-white">About Us</h1>

    </div>

  </section>



  <section class="about-main">

    <div class="sq-container">

      <div class="about-intro sq-reveal">

        <div class="about-copy">

          <h2 class="sq-heading sq-line">About Us</h2>

          <p>At Sortiq Solutions Pvt. Ltd., innovation, excellence and customer success are at the heart of everything we do. We work closely with our clients to have an in-depth understanding of their business challenges and deliver tailored<a href="/"> IT solutions</a> that add significant value. With a strong foundation of providing IT services since 2016, our approach goes beyond technology we believe in ethics, transparency and responsibility, ensuring our work positively impacts both businesses and the people they serve.

          <br> Our approach goes beyond technology, we believe in ethics, transparency and responsibility ensuring our work positively impacts both businesses and the people they serve.

By consistently delivering reliable, high-quality solutions, we focus on building long-term partnerships rather than one-time projects. We stay ahead of emerging technologies to help businesses confidently navigate digital transformation, improve operational efficiency, and secure scalability. Our team has vast industry experience in designing tailor-made, future-proof solutions that grow with our clients needs to foster sustainable development.</p>

        </div>



        <div class="about-image-wrap">

          <div class="about-image-card">

            <img class="about-image" src="{{ asset('frontend-assets/media/pages/about/about-image.png') }}" alt="About Image" width="600" height="494" sizes="(max-width: 991px) calc(100vw - 30px), 552px" loading="lazy" decoding="async" fetchpriority="low">

          </div>

        </div>

      </div>



      <div class="about-pillars sq-reveal">

        <article class="pillar-card left">

          <h2>Our Vision</h2>

          <p>Our vision is to become a trusted global technology partner by enabling businesses of all sizes to embrace digital transformation with confidence. We care about performance, how experience feels and actual results that guide your business forward.</p>

        </article>



        <article class="pillar-card middle">

          <h2>Our Mission</h2>

          <p>Our mission is to deliver innovative, reliable, and scalable IT solutions that simplify digital challenges and help businesses achieve measurable growth. Our goal is to develop value-driven solutions that improve productivity, effectiveness, and long-term success.</p>

        </article>



        <article class="pillar-card right">

          <h2>Our Core Values</h2>

          <p>The core values of all we do are integrity, innovation, transparency, and customer success. These values guide our decisions, strengthen client relationships, and guarantee that we provide superior solutions that have a long-lasting effect.</p>

        </article>

      </div>



      <div class="about-lower sq-reveal">

        <section class="why-about">

          <h2 class="sq-heading sq-line">Why Choose Us?</h2>

          <p>At Sortiq Solutions Pvt. Ltd., we don&rsquo;t just offer IT service, we create practical solutions that help businesses grow and perform better. What makes us different is our clear focus on results, quality, and long-term value.</p>

          <div class="why-list">

            <p><strong>Expertise with Vision &ndash;</strong> Our experts stay updated with the latest technologies and industry practices to deliver smart, secure, and scalable solutions.</p>

            <p><strong>Client-Centric Approach &ndash;</strong> We take time to understand your business, challenges, and goals so we can build solutions that truly fit your needs.</p>

            <p><strong>Reliable &amp; Scalable Solutions &ndash;</strong> Whether you are a growing startup or an established enterprise, our solutions are built to adapt and scale as your business grows.</p>

            <p><strong>Commitment to Quality &ndash;</strong> We follow high standards across every project to ensure reliability, performance, and long-term stability.</p>

          </div>

        </section>



        <section class="partner-form">

          <h2 class="sq-heading sq-lines">Partner with Sortiq Solutions!</h2>

          <form action="{{ route('api.contact-messages.store') }}" method="post" class="sq-form sortiq-contact-form">

            @csrf

            <input type="hidden" name="action" value="sortiq_contact_form">

            <div class="sq-form-row">

              <label class="sq-field">

                <iconify-icon icon="fa6-solid:user"></iconify-icon>

                <input class="sq-input" name="name" type="text" placeholder="Enter Your Name" required>

              </label>

              <label class="sq-field">

                <iconify-icon icon="fa6-solid:envelope"></iconify-icon>

                <input class="sq-input" name="email" type="email" placeholder="Enter Your Email" required>

              </label>

            </div>

            <div class="sq-form-row">

              <div class="sq-field sq-phone-field">

                <input class="sq-input" id="sq-phone" name="phone" type="tel" placeholder="Enter Phone No." required>

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

            <div class="sq-recaptcha is-visible" id="recaptcha-container" aria-live="polite">
              @include('components.recaptcha')
            </div>

            <button type="submit" class="sq-submit">Send Message</button>

          </form>

        </section>

      </div>

    </div>

  </section>



  <section class="join-band">

    <div class="sq-container sq-reveal">

      <h2 class="sq-line sq-line-center sq-line-white">Join Us at Sortiq Solutions!</h2>

      <p>Join Sortiq Solutions Pvt. Ltd. and take a step toward success! Whether you&rsquo;re an aspiring IT professional looking to break into the industry, a seasoned expert seeking to enhance your skills, or a business owner aiming to leverage technology for growth, we are here to support your journey. Our expert-led training programs provide in-depth knowledge, while hands-on learning ensures you gain practical experience. We also offer career guidance, including resume assistance, to help you stand out in the competitive job market. For businesses, we provide customized IT solutions to streamline operations and drive innovation. At Sortiq Solutions, we believe in empowering individuals and organizations with the right tools and expertise to excel in the ever-evolving world of technology. Take control of your future and join us today!</p>

    </div>

  </section>

</main>



@endsection



@push('scripts')

<script>

(function() {

  const revealItems = document.querySelectorAll('.sq-reveal');

  if (revealItems.length) {

    if ('IntersectionObserver' in window) {

      const revealObserver = new IntersectionObserver(function(entries) {

        entries.forEach(function(entry) {

          if (entry.isIntersecting) {

            entry.target.classList.add('is-visible');

            revealObserver.unobserve(entry.target);

          }

        });

      }, { threshold: .12, rootMargin: '0px 0px -50px' });



      revealItems.forEach(function(item) { revealObserver.observe(item); });

    } else {

      revealItems.forEach(function(item) { item.classList.add('is-visible'); });

    }

  }



  document.addEventListener('DOMContentLoaded', function() {
    const phoneInputField = document.querySelector("#sq-phone");
    const form = phoneInputField?.closest('form');
    let phoneInput = null;

    if (phoneInputField && window.intlTelInput) {
      phoneInput = window.intlTelInput(phoneInputField, {
        initialCountry: 'in',
        separateDialCode: true,
        nationalMode: true,
        autoPlaceholder: 'off',
        customPlaceholder: function() {
          return 'Enter Phone No.';
        },
        dropdownContainer: document.body,
        utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js'
      });
      phoneInputField.placeholder = 'Enter Phone No.';
      phoneInputField.setAttribute('placeholder', 'Enter Phone No.');
    }
  });

})();

</script>

@endpush



