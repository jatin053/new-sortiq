@extends('layouts.frontend')



@section('title', 'Careers | Sortiq Solutions')

@section('body_attributes') data-route="/careers" @endsection



@push('head')

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700;800;900&family=Raleway:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css">

<style>

:root {

  --sq-blue:#00173e;

  --sq-orange:#ff5800;

  --sq-light:#f1f1f1;

  --sq-border:#d9d9d9;

  --sq-shadow:0 7px 24px rgba(0,0,0,.12);

  --sq-white:#ffffff;

  --sq-text:#111111;

}



* {

  box-sizing:border-box;

}



html {

  scroll-behavior:smooth;

}



body {

  margin:0;

  color:var(--sq-blue);

  font-family:"Nunito";

  background:#fff;

}



a {

  color:inherit;

  text-decoration:none;

}



img {

  display:block;

  max-width:100%;

  height:auto;

}



button,input,textarea {

  font:inherit;

}



iconify-icon {

  display:inline-flex;

  align-items:center;

  justify-content:center;

  vertical-align:middle;

}



/* ===== Header + Footer from provided reference code - WordPress safe ===== */

  /* Header */

  .sq-pro-header  {

    position: sticky;

    top: 0;

    z-index: 9999;

    width: 100%;

    background: #fff;

    font-family: 'Nunito', Arial, sans-serif;

    box-shadow: 0 2px 12px rgba(0, 0, 0, .08);

}



  .sq-pro-wrap  {

    max-width: 1536px;

    margin: 0 auto;

}



  .sq-pro-top  {

    background: #001a3d;

    color: #fff;

    font-size: 12px;

    font-weight: 500;

    line-height: 1;

}



  .sq-pro-top-inner  {

    min-height: 34px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding-left: 146px;

    padding-right: 180px;

}



  .sq-pro-top-left,

  .sq-pro-social  {

    display: flex;

    align-items: center;

    gap: 21px;

}



  .sq-pro-top a,

  .sq-pro-social a  {

    color: #fff;

    text-decoration: none;

    display: inline-flex;

    align-items: center;

    gap: 8px;

    transition: color .25s ease, transform .25s ease;

}



  .sq-pro-social a:hover  {

    color: #ff6600;

    transform: translateY(-1px);

}



  .sq-pro-sep  {

    opacity: .25;

}



  .sq-pro-apply  {

    font-weight: 700;

}



.sq-pro-apply span {

    color: #fff;

    animation: blink-effect 1s infinite;

}



@keyframes blink-effect {

    50% {

        opacity: 0;

    }

}



  .sq-pro-apply iconify-icon  {

    transform: rotate(-20deg);

}



  @keyframes sqPulseText  {

    0%, 100%  {

      opacity: 1;

      text-shadow: 0 0 0 rgba(255, 255, 255, 0);

}



    50%  {

      opacity: .58;

      text-shadow: 0 0 10px rgba(255, 255, 255, .65);

}



}



  @keyframes sqBounce  {

    0%, 100%  {

      transform: translateY(0) rotate(-20deg);

}



    50%  {

      transform: translateY(-4px) rotate(-20deg);

}



}



  .sq-pro-nav  {

    min-height: 98px;

    display: flex;

    align-items: center;

    gap: 38px;

    background: #fff;

    padding-left: 24px;

    padding-right: 24px;

}



  .sq-pro-logo  {

    display: inline-flex;

    align-items: center;

    flex-shrink: 0;

}



  .sq-pro-logo img  {

    width: 145px;

    height: auto;

    display: block;

    transition: transform .25s ease;

}



  .sq-pro-logo:hover img  {

    transform: scale(1.04);

}



  .sq-pro-menu  {

    list-style: none;

    margin: 0;

    padding: 0;

    display: flex;

    align-items: center;

    gap: 27px;

    font-size: 16px;

    font-weight: 700;

    color: #222;

}



  .sq-pro-menu > li  {

    position: relative !important;

    display: flex;

    align-items: center;

    min-height: 76px;

    overflow: visible !important;

}



  .sq-pro-menu a,

  .sq-pro-menu span  {

    color: #222;

    text-decoration: none;

    transition: color .22s ease;

}



  .sq-pro-menu > li:hover > a,

  .sq-pro-menu > li:hover > span,

  .sq-pro-menu a:hover,

  .sq-pro-menu .active  {

    color: #ff6600;

}



  .sq-pro-menu iconify-icon  {

    transition: transform .25s ease;

}



  .sq-pro-menu > li:hover > .sq-pro-down  {

    transform: rotate(180deg);

}



  .sq-pro-dd-holder  {

    position: absolute !important;

    top: 100% !important;

    left: 0 !important;

    z-index: 99999 !important;

    padding-top: 0 !important;

    opacity: 0 !important;

    visibility: hidden !important;

    transform: translateY(10px) !important;

    transition: opacity .22s ease, visibility .22s ease, transform .22s ease !important;

}



  .sq-pro-menu > li:hover .sq-pro-dd-holder,

  .sq-pro-menu > li:focus-within .sq-pro-dd-holder  {

    opacity: 1 !important;

    visibility: visible !important;

    transform: translateY(0) !important;

}



  .sq-pro-dd  {

    width: 453px !important;

    background: #fff !important;

    border-radius: 0 !important;

    box-shadow: 0 10px 28px rgba(0, 0, 0, .14) !important;

    padding: 13px 27px 14px !important;

    display: grid !important;

    grid-template-columns: 1fr 1fr !important;

    column-gap: 34px !important;

    row-gap: 0 !important;

}



  .sq-pro-dd.services  {

    width: 560px !important;

}



  .sq-pro-menu > li:nth-child(4) .sq-pro-dd  {

    width: 200px !important;

    display: block !important;

}



  .sq-pro-dd a  {

    display: flex !important;

    align-items: center !important;

    gap: 15px !important;

    min-height: 47px !important;

    height: 47px !important;

    padding: 0 !important;

    margin: 0 !important;

    border-bottom: 1px solid #eee !important;

    border-radius: 0 !important;

    background: transparent !important;

    color: #2b2b2b !important;

    font-size: 14px !important;

    font-weight: 500 !important;

    line-height: 1.15 !important;

    white-space: nowrap !important;

    text-decoration: none !important;

    transition: color .22s ease, transform .22s ease !important;

}



  .sq-pro-dd a:nth-last-child(-n+2)  {

    border-bottom: 0 !important;

}



  .sq-pro-menu > li:nth-child(4) .sq-pro-dd a:last-child  {

    border-bottom: 0 !important;

}



  .sq-pro-dd a iconify-icon  {

    width: 18px !important;

    height: 18px !important;

    min-width: 18px !important;

    color: #ff5a00 !important;

    font-size: 14px !important;

}



  .sq-pro-dd a:hover  {

    color: #ff5a00 !important;

    transform: translateX(3px) !important;

}



  .sq-pro-actions  {

    margin-left: auto;

    display: flex;

    align-items: center;

    gap: 16px;

    flex-shrink: 0;

}



  .sq-pro-review  {

    display: inline-flex;

    align-items: center;

    gap: 10px;

    color: #ff6600;

    text-decoration: none;

    font-weight: 700;

    font-size: 15px;

}



  .sq-pro-review-dot  {

    position: relative;

    width: 9px;

    height: 9px;

    border-radius: 50%;

    background: #ff6600;

}



  .sq-pro-review-dot:after  {

    content: '';

    position: absolute;

    inset: -5px;

    border-radius: 50%;

    background: #ff6600;

    animation: sqPing 1.2s cubic-bezier(0, 0, .2, 1) infinite;

    opacity: .55;

}



  @keyframes sqPing  {

    75%, 100%  {

      transform: scale(2.1);

      opacity: 0;

}



}



  .sq-pro-btn  {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    min-height: 42px;

    padding: 12px 24px;

    border-radius: 999px;

    color: #fff !important;

    text-decoration: none;

    font-size: 14px;

    font-weight: 700;

    box-shadow: 0 8px 20px rgba(0, 0, 0, .12);

    transition: background .25s ease, transform .25s ease, box-shadow .25s ease;

}



  .sq-pro-btn.orange  {

    background: #ff6600;

}



  .sq-pro-btn.blue  {

    background: #001a3d;

}



  .sq-pro-btn:hover  {

    transform: translateY(-2px);

    box-shadow: 0 14px 28px rgba(0, 0, 0, .18);

}



  .sq-pro-btn.orange:hover  {

    background: #001a3d;

}



  /* Mobile menu */

  .sq-mobile-open  {

    display: none;

    margin-left: auto;

    border: 0;

    background: transparent;

    color: #001a3d;

    padding: 8px;

    cursor: pointer;

}



  .sq-mobile-overlay  {

    position: fixed;

    inset: 0;

    background: rgba(0, 0, 0, .6);

    z-index: 10000;

    opacity: 0;

    visibility: hidden;

    transition: .25s;

}



  .sq-mobile-drawer  {

    position: fixed;

    top: 0;

    left: 0;

    width: min(380px, calc(100% - 42px));

    height: 100vh;

    background: #fff;

    z-index: 10001;

    transform: translateX(-105%);

    transition: transform .3s ease;

    box-shadow: 18px 0 40px rgba(0, 0, 0, .2);

    display: flex;

    flex-direction: column;

}



  .sq-mobile-active .sq-mobile-overlay  {

    opacity: 1;

    visibility: visible;

}



  .sq-mobile-active .sq-mobile-drawer  {

    transform: translateX(0);

}



  .sq-drawer-head  {

    height: 76px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 16px 20px;

    border-bottom: 1px solid #eee;

}



  .sq-drawer-head img  {

    width: 120px;

}



  .sq-mobile-close  {

    border: 0;

    border-radius: 50%;

    background: #f3f4f6;

    width: 40px;

    height: 40px;

    display: grid;

    place-items: center;

    color: #001a3d;

    cursor: pointer;

}



  .sq-drawer-menu  {

    padding: 16px;

    overflow: auto;

}



  .sq-drawer-menu a,

  .sq-drawer-acc  {

    width: 100%;

    border: 0;

    background: transparent;

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 14px 16px;

    border-bottom: 1px solid #eee;

    border-radius: 8px;

    text-decoration: none;

    color: #222;

    font-weight: 700;

}



  .sq-drawer-menu a:hover,

  .sq-drawer-acc:hover  {

    background: #fff1e8;

    color: #ff6600;

}



  .sq-drawer-panel  {

    display: none;

    background: #f8fafc;

    margin: 8px;

    border-radius: 10px;

    padding: 6px;

}



  .sq-drawer-panel.is-open  {

    display: block;

}



  .sq-drawer-panel a  {

    font-size: 13px;

    justify-content: flex-start;

    gap: 10px;

    border: 0;

    padding: 11px 12px;

}



  .sq-drawer-panel a iconify-icon {

    color: #ff6600;

    font-size: 18px;

}



  .sq-drawer-panel a:hover {

    color: #ff6600 !important;

}



  .sq-drawer-actions  {

    margin-top: auto;

    padding: 16px;

    border-top: 1px solid #eee;

    display: grid;

    gap: 12px;

}



  .sq-pro-footer  {

  background: #001d4c;

  color: #fff;

  font-family: 'Nunito', sans-serif;

}



.sq-pro-footer a  {

  color: inherit;

  text-decoration: none;

}



.sq-pro-footer a:hover  {

  color: #ff6600;

}

.sq-pro-footer  {

  background: #001d4c;

  color: #fff;

  font-family: 'Nunito', sans-serif;

}



.sq-pro-footer a  {

  color: inherit;

  text-decoration: none;

}



.sq-pro-footer a:hover  {

  color: #ff6600;

}



.sq-footer-wrap  {

  max-width: 1280px;

  margin: 0 auto;

  padding: 48px 48px 0;

}



.sq-footer-top  {

  display: flex;

  align-items: center;

  justify-content: space-between;

  gap: 42px;

  padding-bottom: 38px;

  border-bottom: 1px solid rgba(255, 255, 255, .1);

}



.sq-footer-badges  {

  display: flex;

  align-items: center;

  gap: 22px;

  flex-wrap: wrap;

}



.sq-footer-badges img  {

  width: 44px;

  height: 44px;

  max-width: 44px;

  max-height: 44px;

  object-fit: contain;

  object-position: center;

  flex-shrink: 0;

  display: block;

  transition: transform .25s ease, filter .25s ease;

}



.sq-footer-badges img:hover  {

  transform: scale(1.1);

  filter: brightness(1.15);

}



.sq-footer-badges img:nth-child(2)  {

  transform: scale(1.4);

  transform-origin: center center;

}



.sq-footer-badges img:nth-child(2):hover  {

  transform: scale(1.28);

  filter: brightness(1.15);

}



.sq-footer-contact-row  {

  display: flex;

  align-items: center;

  justify-content: flex-end;

  gap: 46px;

  color: #e5e7eb;

  font-size: 15px;

  line-height: 1.55;

}



.sq-footer-contact-row a,

.sq-footer-contact-row div  {

  display: flex;

  gap: 12px;

  align-items: center;

}



.sq-footer-contact-row a:hover  {

  color: #ff6600;

}



.sq-footer-grid-pro  {

  display: grid;

  grid-template-columns: repeat(4, 1fr);

  gap: 58px;

  padding: 42px 0 58px;

}





  .sq-verify-pro  {

    margin-top: 30px;

    border: 1px solid rgba(255, 255, 255, .75);

    padding: 24px;

    text-align: center;

}



  .sq-verify-pro p  {

    margin: 0 0 18px;

    color: #fff;

    font-size: 16px;

    font-weight: 400;

}



  .sq-verify-pro a  {

    display: inline-flex;

    background: #ff6600;

    color: #fff !important;

    border-radius: 999px;

    padding: 11px 22px;

    font-weight: 700;

    font-size: 13px;

    transition: .25s;

}



    .sq-article  {

    color: #e5e7eb;

    font-size: 16px;

    font-weight: 600;

    line-height: 1.45;

    margin-bottom: 18px;

}



  .sq-article:hover  {

    color: #ff6600 !important;

}



  .sq-article-date  {

    display: flex;

    align-items: center;

    gap: 8px;

    color: #8ee3c0;

    font-size: 12px;

    margin-top: 8px;

}





.sq-footer-col-pro h3  {

  margin: 0 0 28px;

  color: #fff;

  font-size: 22px;

  font-weight: 700;

}



.sq-footer-list  {

  display: grid;

  gap: 15px;

}



.sq-footer-link  {

  display: flex;

  align-items: center;

  gap: 12px;

  color: #ffffff !important;

  font-size: 16.5px;

  font-weight: 600;

  line-height: 1.25;

}



.sq-footer-link:hover  {

  transform: translateX(6px);

  color: #ff6600 !important;

}



.sq-footer-link a  {

  color: #fff !important;

  transition: background .22s ease, color .22s ease, transform .22s ease;

}



.sq-footer-link a:hover  {

  color: #ff6600 !important;

}



.sq-footer-arrow  {

  width: 20px;

  height: 20px;

  min-width: 20px;

  border-radius: 50%;

  background: #fff;

  color: #001a3d;

  display: grid;

  place-items: center;

  transition: background .22s ease, color .22s ease, transform .22s ease;

}



.sq-footer-link:hover .sq-footer-arrow  {

  background: #ff6600;

  color: #fff;

  transform: translateX(6px);

}



.sq-footer-bottom-pro  {

  background: #00173e;

  padding: 22px 0;

}



.sq-footer-bottom-inner  {

  max-width: 1280px;

  margin: 0 auto;

  padding: 0 48px;

  display: flex;

  align-items: center;

  justify-content: space-between;

  gap: 18px;

  color: #fff;

  font-weight: 500;

}



.sq-footer-socials  {

  display: flex;

  align-items: center;

  gap: 5px;

}



.sq-footer-socials a  {

  width: 36px;

  height: 36px;

  border-radius: 50%;

  background: #000;

  color: #fff;

  display: grid;

  place-items: center;

  transition: .25s;

}  



.sq-footer-socials a:hover  {

  background: #fff;

  color: #ff5800;

  transform: translateY(-3px) scale(1.08);

}



.sq-floating-chat  {

  position: fixed;

  right: 25px;

  bottom: 30px;

  display: grid;

  gap: 12px;

  align-items: end;

  z-index: 10001;

}



.sq-whatsapp, .sq-chat-dot  {

  display: inline-flex;

  align-items: center;

  justify-content: center;

  border-radius: 999px;

  padding: 14px 16px;

  text-decoration: none;

  color: #fff;

  box-shadow: 0 16px 32px rgba(0, 0, 0, .16);

  transition: transform .25s ease, box-shadow .25s ease;

}



.sq-whatsapp  {

  background: #25D366;

  gap: 10px;

}



.sq-chat-dot  {

  width: 52px;

  height: 52px;

  background: #ec6800;

}



.sq-whatsapp:hover, .sq-chat-dot:hover  {

  transform: translateY(-2px);

  box-shadow: 0 22px 34px rgba(0, 0, 0, .2);

}



  @media(max-width:1200px)  {

    .sq-pro-menu,

    .sq-pro-actions  {

      display: none;

}



    .sq-mobile-open  {

      display: grid;

}



    .sq-pro-nav  {

      gap: 20px;

}



    .sq-pro-wrap  {

      padding-left: 24px;

      padding-right: 24px;

}



    .sq-pro-top-inner  {

      padding-left: 24px;

      padding-right: 24px;

}



    .sq-footer-top,

    .sq-footer-contact-row  {

      flex-direction: column;

      text-align: center;

      align-items: center;

}



    .sq-footer-contact-row  {

      gap: 18px;

}



    .sq-footer-grid-pro  {

      grid-template-columns: repeat(2, 1fr);

}



}



  @media(max-width:991px)  {

    .sq-hero-title  {

      min-height: 180px;

      padding: 68px 0;

}



    .sq-hero-title h2,

    .sq-heading  {

      font-size: 32px;

}



    .sq-reason-grid,

    .sq-solutions-grid,

    .sq-solution-list,

    .sq-form-row  {

      grid-template-columns: 1fr;

}



    .sq-reason-area  {

      contain-intrinsic-size: 1980px;

}



    .sq-reason-card  {

      min-height: auto;

      padding: 40px 28px;

      border-radius: 0 0 54px 0;

      box-shadow: none;

}



    .sq-reason-card:hover  {

      transform: none;

}



    .sq-clients  {

      padding: 62px 0;

}



    .sq-work  {

      padding: 75px 0;

      min-height: 360px;

}



    .sq-work h2  {

      font-size: 30px;

}



    .sq-solutions  {

      padding: 65px 0;

      contain-intrinsic-size: 1050px;

}



}



  @media(max-width:767px)  {

    .sq-pro-top  {

      /* display: none; */

}



    .sq-pro-nav  {

      min-height: 68px;

}



    .sq-pro-logo img  {

      width: 128px;

}



    .sq-footer-wrap  {

      padding: 38px 24px 0;

}



    .sq-footer-grid-pro  {

      grid-template-columns: 1fr;

      gap: 34px;

}



    .sq-footer-bottom-inner  {

      flex-direction: column;

      text-align: center;

      padding: 0 24px;

}



    .sq-footer-badges  {

      justify-content: flex-start;

      flex-wrap: nowrap;

      overflow-x: auto;

      -webkit-overflow-scrolling: touch;

      gap: 12px;

      padding-bottom: 4px;

}



    .sq-footer-badges img  {

      width: 38px;

      height: 38px;

      max-width: 38px;

      max-height: 38px;

      flex-shrink: 0;

}



    .sq-footer-contact-row  {

      font-size: 13px;

}



}



  @media(max-width:1200px) {

  .sq-pro-menu,.sq-pro-actions {

  display:none

}



.sq-mobile-open {

  display:grid

}



.sq-pro-nav {

  gap:20px

}



.sq-pro-wrap {

  padding-left:24px;

  padding-right:24px

}



.sq-pro-top-left {

  margin-left:0

}



.sq-pro-social {

  margin-right:0

}



.sq-footer-top,.sq-footer-contact-row {

  flex-direction:column;

  text-align:center;

  align-items:center

}



.sq-footer-contact-row {

  gap:18px

}



.sq-footer-grid-pro {

  grid-template-columns:repeat(2,1fr)

}



}



  @media(max-width:767px) {

  .sq-pro-top {

  display:none

}



.sq-pro-nav {

  min-height:68px

}



.sq-pro-logo img {

  width:128px

}



.sq-footer-wrap {

  padding:38px 24px 0

}



.sq-footer-grid-pro {

  grid-template-columns:1fr;

  gap:34px

}



.sq-footer-bottom-inner {

  flex-direction:column;

  text-align:center;

  padding:0 24px

}



.sq-footer-badges {

  justify-content:center

}



.sq-footer-badges img {

  width:44px;

  height:44px;

  max-width:44px;

  max-height:44px

}



.sq-footer-contact-row {

  font-size:13px

}



}



:root  {

  --sq-blue: #00173e;

  --sq-orange: #ff5800;

  --sq-light: #f1f1f1;

  --sq-border: #d9d9d9;

  --sq-shadow: 0 7px 24px rgba(0, 0, 0, 0.12);

}



*  {

  box-sizing: border-box;

}



body  {

  margin: 0;

  color: var(--sq-blue);

  font-family: "Nunito";

}



a  {

  color: inherit;

  text-decoration: none;

}



.sq-page  {

  overflow: hidden;

  background: #fff;

}



.sq-container  {

  width: min(1140px, calc(100% - 32px));

  margin: 0 auto;

}



/* HERO */

.career-hero  {

  position: relative;

  min-height: 180px;

  margin-top: 0;

  padding: 42px 0;

  display: flex;

  align-items: center;

  justify-content: center;

  text-align: center;

  color: #fff !important;

  background-image: linear-gradient(rgba(0,0,0,.7), rgba(0,0,0,.7)), url("{{ asset('frontend-assets/media/imports/sortiqsolutions/2025/02/career-background-image.png') }}");

  background-position: center left;

  background-size: cover;

  background-repeat: no-repeat;

}



.career-hero h1  {

  margin: 0;

  color: #fff !important;

  font-family: "Nunito";

  font-size: 36px;

  line-height: 1.25;

  font-weight: 700;

}



.title-line  {

  width: 40px;

  height: 3px;

  margin: 18px auto 0;

  background: #fff;

}



/* CAREERS */

.career-openings  {

  padding: 62px 0 58px;

  background: #fff;

}



.career-title  {

  font-family: 'Poppins',sans-serif;

  margin: 0 0 62px;

  text-align: center;

  color: var(--sq-blue);

  font-size: 50px;

  line-height: 1.4em;

  font-weight: 700;

}



.career-title span  {

  color: var(--sq-orange);

}



.career-accordion  {

  max-width: 945px;

  margin: 0 auto;

}



.career-item  {

  margin-bottom: 20px;

  padding: 0;

  background: #fff;

  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.11);

}



.career-toggle  {

  width: 100%;

  min-height: 58px;

  border: 0;

  background: #fff;

  color: #00173E;

  display: flex;

  align-items: center;

  justify-content: flex-start;

  padding: 18px 27px;

  cursor: pointer;

  text-align: left;

  font-family: "Open Sans", Sans-serif;

  font-size: 16px;

  line-height: 1.25;

  font-weight: 700

}



.career-toggle iconify-icon  {

  display: none;

}



.career-item.is-open .career-toggle iconify-icon  {

  display: none;

}



.career-panel  {

  font-family: "Open Sans", Sans-serif;

  display: none;

  padding: 0 32px 33px;

  color: #777;

  font-size: 16px;

  line-height: 1.74;

}



.career-item.is-open .career-panel  {

  display: block;

}



.career-job-title  {

  margin: 0;

  color: black;

}



.career-panel h3  {

  margin: 17px 0 17px;

  color: var(--sq-blue);

  font-size: 18px;

  line-height: 1.25;

  font-weight: 700

}



.career-panel ul  {

  margin: 8px 0 22px 20px;

  padding: 0;

  list-style: disc;

}



.career-panel li  {

  padding-left: 0;

  margin-bottom: 8px;

}



.career-panel li::before  {

  content: none;

}



.career-panel p  {

  margin: 0 0 16px;

}



.career-check  {

  position: relative;

  padding-left: 22px;

}



.career-check::before  {

  content: "\2713";

  position: absolute;

  left: 0;

  top: 2px;

  width: 13px;

  height: 13px;

  border-radius: 2px;

  background: #78bf4a;

  color: #ffffff;

  font-size: 10px;

  line-height: 13px;

  text-align: center;

  font-weight: 700

}



.job-meta  {

  display: block;

  margin: 0 0 20px 20px;

  padding: 0;

  background: transparent;

  border: 0;

}



.job-meta strong  {

  color: #555;

}



/* FORM HEADING */

.apply-heading  {

  padding: 49px 0 11px;

  background: var(--sq-light);

  text-align: center;

}



.apply-kicker  {

  margin: 0 0 13px;

  color: var(--sq-orange);

  font-size: 28px;

  line-height: 1.1;

  font-weight: 600;

}



.apply-heading h2  {

  max-width: 900px;

  margin: 0 auto;

  color: var(--sq-blue);

  font-size: 18px;

  font-weight: 700

  line-height: 1.5;

}



.orange-line  {

  width: 40px;

  height: 3px;

  margin: 23px auto 0;

  background: var(--sq-orange);

}



/* APPLY SECTION */

.apply-section  {

  padding: 28px 0 54px;

  background: var(--sq-light);

}



.apply-grid  {

  display: grid;

  grid-template-columns: 0.9fr 1.1fr;

  gap: 76px;

  align-items: start;

  max-width: 905px;

}



/* CONTACT */

.contact-list  {

  display: grid;

  gap: 27px;

  padding-top: 8px;

}



.contact-item  {

  display: grid;

  grid-template-columns: 42px 1fr;

  gap: 12px;

  align-items: start;

}



.contact-icon,

.social-link  {

  background: var(--sq-orange);

  color: #fff;

  border-radius: 50%;

  display: flex;

  align-items: center;

  justify-content: center;

}



.contact-icon  {

  width: 39px;

  height: 39px;

  font-size: 20px;

}

.contact-icon:hover  {

  background: var(--sq-blue);

}



.contact-item h3  {

  font-family: "Roboto", Sans-serif;

  margin: 0 0 5px;

  color: var(--sq-blue);

  font-size: 22px;

  font-weight: 700

}



.contact-item p  {

  margin: 0;

  color: var(--sq-blue);

  font-size: 18px;

  line-height: 1.55;

}



.socials  {

  display: flex;

  flex-wrap: wrap;

  gap: 13px;

  margin-top: 35px;

}



.social-link  {

  width: 40px;

  height: 40px;

  font-size: 16px;

}



.social-link:hover  {

  background: var(--sq-blue);

}



/* FORM */

.career-form  {

  width: 100%;

}



.form-grid  {

  display: grid;

  grid-template-columns: repeat(2, 1fr);

  gap: 15px 25px;

}



.full  {

  grid-column: 1 / -1;

}



.input-box,

.file-box  {

  min-height: 45px;

  border: 1px solid var(--sq-border);

  background: #fff;

  border-radius: 2px;

  display: flex;

  align-items: center;

  gap: 10px;

  padding: 0 12px;

}



.input-box iconify-icon,

.file-box iconify-icon  {

  color: var(--sq-orange);

  font-size: 21px;

  flex-shrink: 0;

}



.input-box input,

.input-box textarea  {

  width: 100%;

  border: none;

  outline: none;

  background: transparent;

  font-size: 14px;

  color: #222;

  font-family: inherit;

}



.input-box input::placeholder,

.input-box textarea::placeholder  {

  color: #999;

  font-style: italic;

}



.textarea-box  {

  min-height: 116px;

  align-items: flex-start;

  padding-top: 14px;

}



.textarea-box textarea  {

  min-height: 88px;

  resize: none;

}



.file-box  {

  padding: 9px 12px;

}



.file-box input  {

  font-size: 15px;

}



.file-box input[type="file"]::file-selector-button {

  border: 1px solid var(--sq-border);

  background: var(--sq-light);

  padding: 6px 12px;

  border-radius: 4px;

  cursor: pointer;

  margin-right: 12px;

  color: var(--sq-text);

  font-weight: 500;

  transition: all 0.2s ease;

}



.file-box input[type="file"]::file-selector-button:hover {

  background: #e2e2e2;

  border-color: #c0c0c0;

}



/* Multi-flag Phone Dropdown Overrides */

.iti  {

   width: 100%;

   display: block;

}



.iti__country-list  {

   color: #333;

   text-align: left;

}



.iti__flag-container  {

   z-index: 2;

}



.iti__arrow {

  display: inline-block !important;

  width: 0;

  height: 0;

  border-left: 4px solid transparent;

  border-right: 4px solid transparent;

  border-top: 5px solid #ff5800;

  margin-left: 5px;

  vertical-align: middle;

  cursor: pointer;

  transition: transform .2s ease;

}



.iti__arrow--up {

  border-top: none;

  border-bottom: 5px solid #ff5800;

}



.iti__selected-flag  {

  border-right: 1px solid var(--sq-border);

  padding-right: 8px !important;

  margin-right: 8px;

  padding-left: 12px !important;

}



#sq-phone  {

  width: 100%;

  min-height: 45px;

  border: 1px solid var(--sq-border);

  background: #fff;

  border-radius: 2px;

  outline: none;

  font-size: 15px;

  color: #222;

  font-family: inherit;

  padding: 0 12px 0 70px !important;

}



#sq-phone::placeholder  {

  color: #999;

  font-style: italic;

}



.captcha-row  {

  display: flex;

  justify-content: flex-start;

  overflow: hidden;

  width: 304px;

  max-width: 100%;

}



.captcha-row .g-recaptcha  {

  transform-origin: 0 0;

}



.submit-btn  {

  width: 100%;

  min-height: 52px;

  border: none;

  border-radius: 2px;

  background: var(--sq-orange);

  color: #fff;

  font-size: 16px;

  cursor: pointer;

}



.submit-btn:hover  {

  background: var(--sq-blue);

}



/* ===== RESPONSIVE ===== */

@media (max-width: 900px) {

  .apply-grid {

    grid-template-columns: 1fr;

    gap: 35px;

    max-width: 100%;

  }



  .form-grid {

    grid-template-columns: 1fr;

  }



  .job-meta {

    grid-template-columns: 1fr;

  }



  .contact-item p {

    font-size: 16px;

  }



  .sq-solutions-grid {

    grid-template-columns: 1fr;

  }



  .career-accordion {

    max-width: 100%;

  }



  .career-title {

    font-size: 38px;

  }



  .career-hero h1 {

    font-size: 30px;

  }



  .apply-heading h2 {

    font-size: 16px;

  }



  .apply-kicker {

    font-size: 22px;

  }

}



@media (max-width: 768px) {

  .career-openings {

    padding: 42px 0 38px;

  }



  .career-title {

    font-size: 30px;

    margin-bottom: 38px;

  }



  .career-item {

    margin-bottom: 14px;

  }



  .career-toggle {

    padding: 16px 18px;

    font-size: 15px;

  }



  .career-panel {

    padding: 0 18px 22px;

    font-size: 15px;

  }



  .career-panel h3 {

    font-size: 16px;

    margin: 13px 0 11px;

  }



  .apply-heading {

    padding: 36px 0 10px;

  }



  .apply-kicker {

    font-size: 20px;

  }



  .apply-heading h2 {

    font-size: 15px;

    line-height: 1.55;

  }



  .apply-section {

    padding: 22px 0 40px;

  }



  .apply-grid {

    gap: 26px;

  }



  .contact-list {

    gap: 20px;

  }



  .contact-item {

    gap: 10px;

  }



  .contact-item h3 {

    font-size: 18px;

  }



  .contact-item p {

    font-size: 15px;

  }



  .socials {

    margin-top: 22px;

  }



  .social-link {

    width: 36px;

    height: 36px;

  }



  .input-box,

  #sq-phone {

    min-height: 42px;

  }



  .submit-btn {

    min-height: 48px;

    font-size: 15px;

  }

}



/* Hidden + lazy reCAPTCHA, same form UI preserved */

.captcha-row.is-visible {

  display: flex;

}



@media (max-width: 600px) {

  .career-hero {

    min-height: 140px;

    padding: 32px 16px;

  }



  .career-hero h1 {

    font-size: 26px;

  }



  .title-line {

    margin: 12px auto 0;

  }



  .career-title {

    font-size: 26px;

    line-height: 1.3;

    margin-bottom: 28px;

  }



  .career-openings {

    padding: 34px 0 28px;

  }



  .career-toggle {

    padding: 14px 16px;

    font-size: 14px;

  }



  .career-panel {

    padding: 0 14px 18px;

    font-size: 14px;

    line-height: 1.65;

  }



  .apply-heading {

    padding: 28px 0 8px;

  }



  .apply-kicker {

    font-size: 18px;

  }



  .apply-heading h2 {

    font-size: 14px;

  }



  .form-grid {

    gap: 12px 0;

  }



  .input-box,

  #sq-phone {

    min-height: 40px;

    font-size: 13px;

  }



  .textarea-box {

    min-height: 90px;

  }



  .submit-btn {

    min-height: 44px;

    font-size: 14px;

  }



  .contact-icon {

    width: 34px;

    height: 34px;

    font-size: 17px;

  }



  .contact-item h3 {

    font-size: 16px;

  }



  .contact-item p,

  .contact-item a {

    font-size: 14px;

  }



  .captcha-row {

    width: 100%;

  }



  .captcha-row .g-recaptcha {

    transform: scale(0.88);

    transform-origin: 0 0;

  }

}





</style>

@endpush



@section('content')

<main class="sq-page">



  <section class="career-hero">

    <div class="sq-container">

      <h1>Join Our Team at Sortiq Solutions</h1>

      <div class="title-line"></div>

    </div>

  </section>



  <section class="career-openings">

    <div class="sq-container">

      <h2 class="career-title">Careers at <span>Sortiq Solutions</span></h2>



      <div class="career-accordion" data-career-accordion>



        <article class="career-item">

          <button class="career-toggle" type="button" aria-expanded="false">

            <span class="career-job-title">Business Development</span>

          </button>

          <div class="career-panel">

            <p><strong>Key Responsibilities:</strong></p>

            <p class="career-check">As a BDE one should have clear understanding of Technical requirements and the time-frame to be worked on while converting clients both Online(e.g. Upwork, Guru, Freelancer etc.) and offline (through various public directories, direct, telephonic).</p>

            <p class="career-check">The Business Development Executive should be capable and aware of International Sales and International Marketing.</p>

            <p>Client Interaction, Negotiations, Closing the deal.</p>

            <ul>

              <li>Excellent communication skills both verbal and written.</li>

              <li>Able to set up strong portfolios.</li>

            </ul>

            <h3>Job Details:</h3>

            <p><strong>How to Apply:</strong> If you believe that you have the capability to help us and you wish to build your Career with Aron Web Solutions, then, send your <span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">CV</span> at the mail id <a style="color: #1464db; text-align: center;" href="mailto:sortiqsolutions@gmail.com">sortiqsolutions@gmail.com</a> and a <span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">Cover Email</span> telling us why you are the ideal candidate for the job.</p>

            <p><strong>Role Category:</strong> Pre sales</p>

            <p><strong>Role:</strong> Business Development Executive</p>

            <p><strong>Employment Type:</strong> Permanent and a Full-Time Job</p>

            <p><strong>Education:</strong></p>

            <p><strong>UG:</strong> Any Graduate – Any Specialization, B.Tech/B.E. – Any Specialization</p>

            <p><strong>PG:</strong> M.Tech – Any Specialization, MCA – Computers</p>

            <p><strong>Experience:</strong> 2+ years</p>

            <p><strong>Vacancies:</strong> 5</p>

          </div>

        </article>



        <article class="career-item">

          <button class="career-toggle" type="button" aria-expanded="false">

            <span class="career-job-title">HR Manager</span>

          </button>

          <div class="career-panel">

            <p><strong>Key Responsibilities:</strong></p>

            <p>As an HR Executive, you will be responsible for managing key aspects of recruitment, employee relations, and performance management within the organization. Your key responsibilities will include:</p>

            <p class="career-check"><strong>Understanding Organizational Needs:</strong> Gain a clear understanding of the technical and cultural requirements of the company to help build a strong, capable workforce.</p>

            <p class="career-check"><strong>Talent Acquisition:</strong> Handle both <span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">online</span> (e.g., job portals, LinkedIn) and <span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">offline</span> (through job fairs, public directories, direct recruitment) sourcing for top talent.</p>

            <p class="career-check"><strong>Recruitment and Onboarding:</strong> Lead recruitment efforts, managing the entire hiring process from screening to interview scheduling, and conducting onboarding for new hires.</p>

            <p class="career-check"><strong>Employee Engagement:</strong> Maintain strong communication with employees, ensuring a productive, happy work environment.</p>

            <p class="career-check"><strong>HR Documentation:</strong> Ensure all employee data is accurately maintained and up to date, while complying with company policies.</p>

            <p class="career-check"><strong>Negotiations &amp; Offer Closure:</strong> Manage salary negotiations, offer letter generation, and finalizing employment agreements.</p>

            <p class="career-check"><strong>Training and Development:</strong> Identify and coordinate employee training needs to enhance skills and performance.</p>

            <p><strong>Job Details:</strong></p>

            <ul>

              <li><strong>Role:</strong> Human Resource Executive (HR)</li>

              <li><strong>Role Category:</strong> Recruitment &amp; Employee Relations</li>

              <li><strong>Employment Type:</strong> Permanent, Full-Time</li>

              <li><strong>Experience:</strong> 1+ years</li>

              <li><strong>Vacancies:</strong> 1</li>

            </ul>

            <p><strong>Education:</strong></p>

            <ul>

              <li><strong>UG:</strong> Any Graduate – Any Specialization, B.Tech/B.E. – Any Specialization</li>

              <li><strong>PG:</strong> M.Tech (Any Specialization), MBA (HR), or relevant HR qualifications</li>

            </ul>

            <p><strong>How to Apply:</strong></p>

            <p>If you have the skills, passion, and desire to help us build a talented workforce, please send your <span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">CV</span> and a <span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">Cover Email</span> explaining why you’re the perfect fit for the HR Executive role to: <br><span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">📧 Email:</span> <a href="mailto:sortiqsolutions@gmail.com">sortiqsolutions@gmail.com</a></p>

          </div>

        </article>



        <article class="career-item">

          <button class="career-toggle" type="button" aria-expanded="false">

            <span class="career-job-title">Web Designer</span>

          </button>

          <div class="career-panel">

            <p><strong>Key Responsibilities:</strong></p>

            <p>As a <strong>Web Designer</strong>, you will be responsible for creating visually appealing, user-friendly websites that align with our clients’ brand and functional requirements. Your key responsibilities will include:</p>

            <p class="career-check"><strong>Designing User-Centric Websites:</strong> Develop responsive and visually attractive website designs using the latest web design principles and technologies.</p>

            <p class="career-check"><strong>Collaborating with Development Teams:</strong> Work closely with developers to ensure that designs are implemented accurately, and functionality is optimized across different platforms.</p>

            <p class="career-check"><strong>Creating Wireframes &amp; Mockups:</strong> Design wireframes, prototypes, and high-fidelity mockups to communicate design concepts clearly and effectively.</p>

            <p class="career-check"><strong>Maintaining Design Consistency:</strong> Ensure a consistent brand presence across all web interfaces, maintaining style guides and design standards.</p>

            <p class="career-check"><strong>Optimizing for User Experience:</strong> Focus on improving the overall user experience (UX), making sure the websites are intuitive and easy to navigate.</p>

            <p class="career-check"><strong>Cross-Browser and Mobile Testing:</strong> Test web pages for compatibility across different browsers and devices to ensure they look great everywhere.</p>

            <p class="career-check"><strong>Staying Updated with Design Trends:</strong> Keep up with the latest trends in web design, UX/UI, and emerging technologies.</p>

            <p><strong>Job Details:</strong></p>

            <ul>

              <li><strong>Role:</strong> Web Designer</li>

              <li><strong>Role Category:</strong> Design</li>

              <li><strong>Employment Type:</strong> Permanent, Full-Time</li>

              <li><strong>Experience:</strong> 1+ years</li>

              <li><strong>Vacancies:</strong> 1</li>

            </ul>

            <p><strong>Education:</strong></p>

            <ul>

              <li><strong>UG:</strong> Any Graduate – Any Specialization, B.Tech/B.E. – Any Specialization</li>

              <li><strong>PG:</strong> M.Tech (Any Specialization), MCA – Computers, or relevant design qualifications</li>

            </ul>

            <p><strong>How to Apply:</strong></p>

            <p>If you are a creative individual with a passion for web design and want to contribute to building exceptional user experiences, please send your <span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">online portfolio</span> and a cover email explaining why you’re the perfect fit for this role to:<br><span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">📧 Email:</span> <a href="mailto:sortiqsolutions@gmail.com">sortiqsolutions@gmail.com</a></p>

          </div>

        </article>



        <article class="career-item">

          <button class="career-toggle" type="button" aria-expanded="false">

            <span class="career-job-title">PHP Developer</span>

          </button>

          <div class="career-panel">

            <p><strong>Key Responsibilities:</strong></p>

            <p>As a <strong>PHP Developer</strong>, you will be responsible for designing, developing, and maintaining dynamic web applications. Your key responsibilities will include:</p>

            <p class="career-check"><strong>Understanding Project Requirements:</strong> Collaborate with team members and clients to understand technical requirements and project specifications for PHP-based applications.</p>

            <p class="career-check"><strong>Development and Maintenance:</strong> Write clean, scalable, and efficient code for the development of websites and web applications using PHP and related technologies.</p>

            <p class="career-check"><strong>Integration:</strong> Integrate front-end components with server-side logic, ensuring seamless user experiences.</p>

            <p class="career-check"><strong>Bug Fixing and Troubleshooting:</strong> Diagnose and troubleshoot application issues, ensuring minimal downtime and a seamless experience for users.</p>

            <p class="career-check"><strong>Collaborative Work:</strong> Work closely with front-end developers, designers, and other team members to develop well-rounded solutions.</p>

            <p class="career-check"><strong>Database Management:</strong> Utilize MySQL and other databases for managing and storing data effectively.</p>

            <p class="career-check"><strong>Security and Best Practices:</strong> Implement and maintain web security standards and follow best coding practices to ensure scalability, maintainability, and security.</p>

            <p><strong>Job Details:</strong></p>

            <ul>

              <li><strong>Role:</strong> PHP Developer</li>

              <li><strong>Role Category:</strong> Development</li>

              <li><strong>Employment Type:</strong> Permanent, Full-Time</li>

              <li><strong>Experience:</strong> 2+ years</li>

              <li><strong>Vacancies:</strong> 2</li>

            </ul>

            <p><strong>Education:</strong></p>

            <ul>

              <li><strong>UG:</strong> Any Graduate – Any Specialization, B.Tech/B.E. – Computer Science or related fields</li>

              <li><strong>PG:</strong> M.Tech (Any Specialization), MCA – Computers, or relevant qualifications</li>

            </ul>

            <p><strong>How to Apply:</strong></p>

            <p>If you are passionate about web development and looking to contribute your expertise as a PHP Developer, please send your <span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">CV</span> and a <span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">Cover Email</span> explaining why you’re the ideal candidate for this role to:<br><span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">📧 Email:</span> <a href="mailto:sortiqsolutions@gmail.com">sortiqsolutions@gmail.com</a></p>

          </div>

        </article>



        <article class="career-item">

          <button class="career-toggle" type="button" aria-expanded="false">

            <span class="career-job-title">WordPress Developer</span>

          </button>

          <div class="career-panel">

            <p><strong>Key Responsibilities:</strong></p>

            <p>As a <strong>WordPress Developer</strong>, you will be responsible for designing, developing, and maintaining WordPress-based websites and web applications. Your key responsibilities will include:</p>

            <p class="career-check"><strong>Custom WordPress Development:</strong> Develop custom themes and plugins to enhance website functionality and user experience.</p>

            <p class="career-check"><strong>Understanding Project Requirements:</strong> Collaborate with team members and clients to understand technical specifications for WordPress projects.</p>

            <p class="career-check"><strong>Front-End &amp; Back-End Integration:</strong> Work with HTML, CSS, JavaScript, and PHP to build responsive, high-performance WordPress websites.</p>

            <p class="career-check"><strong>Website Optimization:</strong> Improve website speed, SEO, and overall performance using best practices.</p>

            <p class="career-check"><strong>Bug Fixing &amp; Troubleshooting:</strong> Diagnose and resolve website issues, ensuring smooth functionality.</p>

            <p class="career-check"><strong>Security &amp; Best Practices:</strong> Implement security measures to protect websites from vulnerabilities and follow coding best practices.</p>

            <p class="career-check"><strong>Database Management:</strong> Manage MySQL databases efficiently for data storage and retrieval.</p>

            <h3>Job Details:</h3>

            <ul>

              <li><strong>Role:</strong> WordPress Developer</li>

              <li><strong>Role Category:</strong> Development</li>

              <li><strong>Employment Type:</strong> Permanent, Full-Time</li>

              <li><strong>Experience:</strong> 2+ years</li>

              <li><strong>Vacancies:</strong> 2</li>

            </ul>

            <h3>Education:</h3>

            <ul>

              <li><strong>UG:</strong> Any Graduate – Any Specialization, B.Tech/B.E. – Computer Science or related fields</li>

              <li><strong>PG:</strong> M.Tech (Any Specialization), MCA – Computers, or relevant qualifications</li>

            </ul>

            <h3>How to Apply:</h3>

            <p>If you’re passionate about WordPress development and eager to contribute your skills, send your <span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">CV</span> and a <span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">Cover Email</span> explaining why you’re the ideal candidate for this role to:</p>

            <p><span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">📧 Email:</span> <a href="mailto:sortiqsolutions@gmail.com">sortiqsolutions@gmail.com</a></p>

          </div>

        </article>



        <article class="career-item">

          <button class="career-toggle" type="button" aria-expanded="false">

            <span class="career-job-title">Wix Developer</span>

          </button>

          <div class="career-panel">

            <h3>Key Responsibilities:</h3>

            <p>As a <strong>Wix Developer</strong>, you will be responsible for designing, developing, and maintaining websites using Wix Studio and Wix Velo. Your key responsibilities will include:</p>

            <p class="career-check"><strong>Custom Wix Website Development:</strong> Build responsive and visually appealing websites using Wix Studio and Editor X.</p>

            <p class="career-check"><strong>Understanding Project Requirements:</strong> Collaborate with clients and team members to understand technical requirements for Wix-based projects.</p>

            <p class="career-check"><strong>Velo by Wix Scripting:</strong> Use JavaScript and Wix Velo (Corvid) to develop custom functionalities and dynamic web applications.</p>

            <p class="career-check"><strong>Database Management:</strong> Work with Wix Data Collections to structure and manage website content effectively.</p>

            <p class="career-check"><strong>Third-Party Integrations:</strong> Connect APIs, payment gateways, and external services with Wix websites.</p>

            <p class="career-check"><strong>Website Optimization:</strong> Improve site performance, SEO, and loading speeds using Wix tools and best practices.</p>

            <p class="career-check"><strong>Troubleshooting &amp; Bug Fixing:</strong> Diagnose and resolve website issues, ensuring a seamless user experience.</p>

            <p class="career-check"><strong>Security &amp; Best Practices:</strong> Implement best practices to maintain website security and functionality.</p>

            <h3>Job Details:</h3>

            <ul>

              <li><strong>Role:</strong> Wix Developer</li>

              <li><strong>Role Category:</strong> Web Development</li>

              <li><strong>Employment Type:</strong> Permanent, Full-Time</li>

              <li><strong>Experience:</strong> 2+ years</li>

              <li><strong>Vacancies:</strong> 2</li>

            </ul>

            <h3>Education:</h3>

            <ul>

              <li><strong>UG:</strong> Any Graduate – Any Specialization, B.Tech/B.E. – Computer Science or related fields</li>

              <li><strong>PG:</strong> M.Tech (Any Specialization), MCA – Computers, or relevant qualifications</li>

            </ul>

            <h3>How to Apply:</h3>

            <p>If you’re passionate about Wix development and eager to contribute your skills, send your <span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">CV</span> and a <span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">Cover Email</span> explaining why you’re the ideal candidate for this role to:</p>

            <p><span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">📧 Email:</span> <a href="mailto:sortiqsolutions@gmail.com">sortiqsolutions@gmail.com</a></p>

          </div>

        </article>



        <article class="career-item">

          <button class="career-toggle" type="button" aria-expanded="false">

            <span class="career-job-title">Laravel Developer</span>

          </button>

          <div class="career-panel">

            <h3>Key Responsibilities:</h3>

            <p>As a <strong>Laravel Developer</strong>, you will be responsible for designing, developing, and maintaining scalable web applications using the Laravel PHP framework. Your key responsibilities will include:</p>

            <p class="career-check"><strong>Application Development:</strong> Develop and maintain high-quality web applications using Laravel and related technologies.</p>

            <p class="career-check"><strong>Understanding Project Requirements:</strong> Collaborate with team members and clients to understand technical specifications and project goals.</p>

            <p class="career-check"><strong>API Development &amp; Integration:</strong> Build and integrate RESTful APIs for seamless data exchange with front-end applications and third-party services.</p>

            <p class="career-check"><strong>Database Management:</strong> Design, optimize, and manage MySQL/PostgreSQL databases for efficient data storage and retrieval.</p>

            <p class="career-check"><strong>Authentication &amp; Security:</strong> Implement user authentication, authorization, and security best practices in Laravel applications.</p>

            <p class="career-check"><strong>Code Optimization &amp; Performance:</strong> Write clean, efficient, and scalable code while following best coding practices.</p>

            <p class="career-check"><strong>Troubleshooting &amp; Debugging:</strong> Diagnose and resolve application issues to ensure smooth performance.</p>

            <p class="career-check"><strong>Version Control &amp; Deployment:</strong> Use Git for version control and deploy applications on cloud servers or hosting platforms.</p>

            <h3>Job Details:</h3>

            <ul>

              <li><strong>Role:</strong> Laravel Developer</li>

              <li><strong>Role Category:</strong> Web Development</li>

              <li><strong>Employment Type:</strong> Permanent, Full-Time</li>

              <li><strong>Experience:</strong> 2+ years</li>

              <li><strong>Vacancies:</strong> 2</li>

            </ul>

            <h3>Education:</h3>

            <ul>

              <li><strong>UG:</strong> Any Graduate – Any Specialization, B.Tech/B.E. – Computer Science or related fields</li>

              <li><strong>PG:</strong> M.Tech (Any Specialization), MCA – Computers, or relevant qualifications</li>

            </ul>

            <h3>How to Apply:</h3>

            <p>If you’re passionate about Laravel development and eager to contribute your skills, send your <span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">CV</span> and a <span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">Cover Email</span> explaining why you’re the ideal candidate for this role to:</p>

            <p><span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">📧 Email:</span> <a href="mailto:sortiqsolutions@gmail.com">sortiqsolutions@gmail.com</a></p>

          </div>

        </article>



        <article class="career-item">

          <button class="career-toggle" type="button" aria-expanded="false">

            <span class="career-job-title">MERN Stack Developer</span>

          </button>

          <div class="career-panel">

            <h3>Key Responsibilities:</h3>

            <p>As a <strong>MERN Stack Developer</strong>, you will be responsible for designing, developing, and maintaining full-stack web applications using MongoDB, Express.js, React.js, and Node.js. Your key responsibilities will include:</p>

            <p class="career-check"><strong>Full-Stack Development:</strong> Build and maintain scalable web applications using MERN stack technologies.</p>

            <p class="career-check"><strong>Understanding Project Requirements:</strong> Collaborate with team members and clients to define technical requirements and project goals.</p>

            <p class="career-check"><strong>Front-End Development:</strong> Develop responsive and dynamic user interfaces using React.js with modern frameworks like Redux, Context API, and Tailwind CSS.</p>

            <p class="career-check"><strong>Back-End Development:</strong> Implement server-side logic, RESTful APIs, and authentication using Node.js and Express.js.</p>

            <p class="career-check"><strong>Database Management:</strong> Design, optimize, and manage MongoDB databases for efficient data storage and retrieval.</p>

            <p class="career-check"><strong>API Integration:</strong> Work with third-party APIs and integrate external services into applications.</p>

            <p class="career-check"><strong>Performance Optimization:</strong> Improve application speed, responsiveness, and security.</p>

            <p class="career-check"><strong>Troubleshooting &amp; Debugging:</strong> Diagnose and fix bugs, optimize performance, and ensure smooth application functionality.</p>

            <p class="career-check"><strong>Version Control &amp; Deployment:</strong> Use Git/GitHub for version control and deploy applications on cloud platforms like AWS, Vercel, or Heroku.</p>

            <h3>Job Details:</h3>

            <ul>

              <li><strong>Role:</strong> MERN Stack Developer</li>

              <li><strong>Role Category:</strong> Full-Stack Development</li>

              <li><strong>Employment Type:</strong> Permanent, Full-Time</li>

              <li><strong>Experience:</strong> 2+ years</li>

              <li><strong>Vacancies:</strong> 2</li>

            </ul>

            <h3>Education:</h3>

            <ul>

              <li><strong>UG:</strong> Any Graduate – Any Specialization, B.Tech/B.E. – Computer Science or related fields</li>

              <li><strong>PG:</strong> M.Tech (Any Specialization), MCA – Computers, or relevant qualifications</li>

            </ul>

            <h3>How to Apply:</h3>

            <p>If you’re passionate about MERN Stack development and eager to contribute your expertise, send your <span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">CV</span> and a <span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">Cover Email</span> explaining why you’re the ideal candidate for this role to:</p>

            <p><span style="color: #666666 !important; font-weight: 600 !important; font-size: 16px !important;">📧 Email:</span> <a href="mailto:sortiqsolutions@gmail.com">sortiqsolutions@gmail.com</a></p>

          </div>

        </article>



      </div>

    </div>

  </section>



  <section class="apply-heading">

    <div class="sq-container">

      <p class="apply-kicker">Join Our Team</p>

      <h2>Explore exciting opportunities &amp; take the next step in your career with us. Submit your application below!</h2>

      <div class="orange-line"></div>

    </div>

  </section>



  <section class="apply-section" id="career-application">

    <div class="sq-container apply-grid">



      <div class="contact-area">

        <div class="contact-list">



          <div class="contact-item">

            <span class="contact-icon"><iconify-icon icon="mdi:phone"></iconify-icon></span>

            <div>

              <h3>CALL US</h3>

              <p><a href="tel:+919646522110">+91 9646522110</a></p>

            </div>

          </div>



          <div class="contact-item">

            <span class="contact-icon"><iconify-icon icon="mdi:email-outline"></iconify-icon></span>

            <div>

              <h3>WRITE US</h3>

              <p>

                <a href="mailto:info@sortiqsolutions.com">info@sortiqsolutions.com</a><br>

                <a href="mailto:sortiqsolutions@gmail.com">sortiqsolutions@gmail.com</a>

              </p>

            </div>

          </div>



          <div class="contact-item">

            <span class="contact-icon"><iconify-icon icon="mdi:map-marker-outline"></iconify-icon></span>

            <div>

              <h3>VISIT US</h3>

              <p>E-51, Second Floor, Phase - 8, Industrial Area,<br>S.A.S. Nagar, Mohali, Punjab 160071</p>

            </div>

          </div>



        </div>



        <div class="socials">

          <a class="social-link" href="https://www.facebook.com/SortiqSolutions/" target="_blank"><iconify-icon icon="mdi:facebook"></iconify-icon></a>

          <a class="social-link" href="https://www.linkedin.com/company/sortiq-solutions/" target="_blank"><iconify-icon icon="mdi:linkedin"></iconify-icon></a>

          <a class="social-link" href="https://www.instagram.com/sortiqsolutions/" target="_blank"><iconify-icon icon="mdi:instagram"></iconify-icon></a>

          <a class="social-link" href="https://www.youtube.com/@sortiqsolutions" target="_blank"><iconify-icon icon="mdi:youtube"></iconify-icon></a>

          <a class="social-link" href="https://twitter.com/sortiqsolutions" target="_blank"><iconify-icon icon="mdi:twitter"></iconify-icon></a>

          <a class="social-link" href="https://www.google.com/search?q=Sortiq+Solutions" target="_blank"><iconify-icon icon="mdi:google"></iconify-icon></a>

          <a class="social-link" href="#"><iconify-icon icon="mdi:skype"></iconify-icon></a>

        </div>

      </div>



      <form class="career-form" method="post" action="{{ route('api.contact-messages.store') }}" enctype="multipart/form-data">

        <input type="hidden" name="action" value="sortiq_contact_form">

        <input type="hidden" name="form_type" value="Career Application">

        <input type="hidden" name="country_code" value="+91">

        @csrf



        <div class="form-grid">



          <div class="input-box">

            <iconify-icon icon="mdi:account"></iconify-icon>

            <input type="text" name="name" placeholder="Enter Your Name" required>

          </div>



          <div class="input-box">

            <iconify-icon icon="mdi:email"></iconify-icon>

            <input type="email" name="email" placeholder="Enter Your Email" required>

          </div>



          <!-- CLEAN PHONE INPUT USING THE PLUGIN WITH DIVIDER -->

          <div style="position: relative; display: block; grid-column: auto;">

            <input id="sq-phone" name="phone" type="tel" placeholder="Enter Your Phone Number" required>

          </div>



          <div class="input-box">

            <iconify-icon icon="mdi:format-list-bulleted"></iconify-icon>

            <input type="text" name="subject" placeholder="Subject">

          </div>



          <div class="input-box textarea-box full">

            <iconify-icon icon="fa6-solid:comments"></iconify-icon>

            <textarea name="message" placeholder="Enter your message" required></textarea>

          </div>



          <div class="file-box full">

            <iconify-icon icon="mdi:upload"></iconify-icon>

            <input type="file" name="resume" accept=".pdf,.doc,.docx">

          </div>



          <div class="captcha-row full" id="recaptcha-container">

            @include('components.recaptcha')

          </div>



          <div class="full">

            <button class="submit-btn" type="submit">Send Message</button>

          </div>



        </div>

      </form>



    </div>

  </section>



</main>

@endsection



@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js"></script>

<script>

  document.addEventListener("DOMContentLoaded", function() {

    const accordions = document.querySelectorAll("[data-career-accordion]");

    accordions.forEach(acc => {

      acc.addEventListener("click", function(e) {

        const button = e.target.closest(".career-toggle");

        if (!button) return;

        

        const item = button.closest(".career-item");

        const isOpen = item.classList.contains("is-open");

        

        // Close all

        acc.querySelectorAll(".career-item").forEach(el => {

          el.classList.remove("is-open");

          el.querySelector(".career-toggle").setAttribute("aria-expanded", "false");

        });

        

        // Open clicked

        if (!isOpen) {

          item.classList.add("is-open");

          button.setAttribute("aria-expanded", "true");

        }

      });

    });



    const phoneInput = document.querySelector("#sq-phone");

    if (phoneInput && window.intlTelInput) {

      window.intlTelInput(phoneInput, {

        initialCountry: "in",

        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js"

      });



      phoneInput.addEventListener('input', function(e) {

        this.value = this.value.replace(/[^\d]/g, '');

      });

      

      phoneInput.addEventListener('countrychange', function() {

         var form = phoneInput.closest('form');

         var hiddenCode = form ? form.querySelector('input[name="country_code"]') : null;

         if (hiddenCode) {

            var instance = window.intlTelInputGlobals.getInstance(phoneInput);

            hiddenCode.value = "+" + instance.getSelectedCountryData().dialCode;

         }

      });

    }



    document.querySelectorAll('.career-form').forEach(function(form) {

      form.addEventListener('submit', function() {

        const submitBtn = form.querySelector('.submit-btn');

        if (submitBtn) {

          submitBtn.disabled = true;

          submitBtn.style.opacity = '0.7';

          submitBtn.style.cursor = 'not-allowed';

          submitBtn.innerText = 'Sending...';

        }

      });

    });

  });

</script>

@endpush





