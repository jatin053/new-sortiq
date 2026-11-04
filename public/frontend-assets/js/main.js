const bodyData = document.body?.dataset ?? {};
const CONTACT_API_URL = bodyData.contactApiUrl || "/api/contact-messages";
const FRESHER_API_URL = bodyData.fresherApiUrl || "/api/fresher-hirings";
const INTERNSHIP_API_URL = bodyData.internshipApiUrl || "/api/internship-applications";
const WHATSAPP_NUMBER = String(bodyData.whatsappNumber || "919646522110").replace(/\D+/g, "");
const RECAPTCHA_ENABLED = bodyData.recaptchaEnabled !== "false";

const $ = (selector, root = document) => root.querySelector(selector);
const $$ = (selector, root = document) => Array.from(root.querySelectorAll(selector));

const escapeHtml = (value = "") =>
  String(value)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;");

const parseJsonScript = (id) => {
  const node = document.getElementById(id);
  if (!node) return null;

  try {
    return JSON.parse(node.textContent);
  } catch {
    return null;
  }
};

const escapeHtmlAttribute = (value = "") => escapeHtml(value).replace(/'/g, "&#39;");

const portfolioFilterButtonClass = (active) =>
  `px-6 py-2 rounded-full text-sm font-bold transition-all border ${active
    ? "bg-[#001a3d] text-white border-[#001a3d]"
    : "bg-gray-100 text-gray-600 border-transparent hover:bg-gray-200"
  }`;

const renderPortfolioCard = (item = {}) => {
  const title = String(item.title || "").trim() || "Portfolio Project";
  const imageUrl = String(item.image_url || "").trim();

  return `
    <button
      type="button"
      data-portfolio-item
      data-portfolio-title="${escapeHtmlAttribute(title)}"
      data-portfolio-image="${escapeHtmlAttribute(imageUrl)}"
      class="group relative overflow-hidden rounded-2xl aspect-[4/3] cursor-pointer bg-gray-100 shadow-sm text-left"
    >
      ${imageUrl
      ? `<img src="${escapeHtmlAttribute(imageUrl)}" class="w-full h-full object-cover transition-transform group-hover:scale-105" alt="${escapeHtmlAttribute(title)}" loading="lazy" decoding="async">`
      : `<div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-900 to-slate-700 px-6 text-center text-white font-bold">${escapeHtml(title)}</div>`
    }
      <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-6">
        <h3 class="text-white font-bold">${escapeHtml(title)}</h3>
      </div>
    </button>
  `;
};

const renderPortfolioEmptyState = () => `
  <div class="col-span-full rounded-3xl border border-gray-200 bg-white px-6 py-16 text-center text-gray-500 shadow-sm">
    <h3 class="text-xl font-black text-[#001a3d]">No portfolio projects are available right now.</h3>
  </div>
`;

const renderPortfolioModalContent = ({ title, imageUrl }) => `
  <div class="overflow-y-auto max-h-[85vh]">
    ${imageUrl
    ? `<img src="${escapeHtmlAttribute(imageUrl)}" class="w-full" alt="${escapeHtmlAttribute(title)}">`
    : `<div class="min-h-[340px] flex items-center justify-center bg-gradient-to-br from-slate-900 to-slate-700 px-6 text-center text-2xl font-black text-white">${escapeHtml(title)}</div>`
  }
    <div class="p-6">
      <h2 class="text-2xl font-bold">${escapeHtml(title)}</h2>
    </div>
  </div>
`;

const setModalState = (shell, open) => {
  if (!shell) return;

  const panel = $(".modal-panel", shell);
  const overlay = $(".modal-overlay", shell);

  if (open) {
    shell.hidden = false;
    document.body.classList.add("overflow-hidden");
  }

  shell.classList.toggle("is-open", open);
  panel?.classList.toggle("is-open", open);
  overlay?.classList.toggle("is-open", open);

  if (open) return;

  window.setTimeout(() => {
    if (!shell.classList.contains("is-open")) {
      shell.hidden = true;
      document.body.classList.remove("overflow-hidden");
    }
  }, 300);
};

const initHeader = () => {
  // New premium header elements
  const newHeader = $(".sq-pro-header");
  const newToggle = $(".sq-mobile-open");
  const newClose = $(".sq-mobile-close");
  const newOverlay = $(".sq-mobile-overlay");
  const body = document.body;

  if (newHeader && newToggle) {
    if (!newToggle.dataset.drawerBound) {
      newToggle.dataset.drawerBound = "true";
      newToggle.addEventListener("click", (e) => {
        e.preventDefault();
        body.classList.add("sq-mobile-active");
      });
    }
    if (newClose && !newClose.dataset.drawerBound) {
      newClose.dataset.drawerBound = "true";
      newClose.addEventListener("click", (e) => {
        e.preventDefault();
        body.classList.remove("sq-mobile-active");
      });
    }
    if (newOverlay && !newOverlay.dataset.drawerBound) {
      newOverlay.dataset.drawerBound = "true";
      newOverlay.addEventListener("click", (e) => {
        e.preventDefault();
        body.classList.remove("sq-mobile-active");
      });
    }

    // Accordion for mobile menu
    const accs = $$(".sq-drawer-acc");
    accs.forEach((acc) => {
      if (acc.dataset.drawerBound) return;
      acc.dataset.drawerBound = "true";
      acc.addEventListener("click", function (e) {
        e.preventDefault();
        const wasActive = this.classList.contains("is-active");

        // Close other accordions in the drawer
        accs.forEach((otherAcc) => {
          if (otherAcc !== this) {
            otherAcc.classList.remove("is-active");
            otherAcc.setAttribute("aria-expanded", "false");
            const otherPanel = otherAcc.nextElementSibling;
            if (otherPanel && otherPanel.classList.contains("sq-drawer-panel")) {
              otherPanel.classList.remove("is-open");
            }
          }
        });

        // Toggle current accordion cleanly
        if (wasActive) {
          this.classList.remove("is-active");
          this.setAttribute("aria-expanded", "false");
          const panel = this.nextElementSibling;
          if (panel && panel.classList.contains("sq-drawer-panel")) {
            panel.classList.remove("is-open");
          }
        } else {
          this.classList.add("is-active");
          this.setAttribute("aria-expanded", "true");
          const panel = this.nextElementSibling;
          if (panel && panel.classList.contains("sq-drawer-panel")) {
            panel.classList.add("is-open");
          }
        }
      });
    });
    return;
  }

  // Fallback to old header navigation elements
  const header = $(".site-header");
  const drawer = $("#mobile-drawer");
  const overlay = $("#mobile-overlay");
  if (!header || !drawer || !overlay) return;

  let lastScrollY = window.scrollY;
  let ticking = false;

  const updateHeaderOnScroll = () => {
    const currentScrollY = Math.max(window.scrollY, 0);
    const delta = currentScrollY - lastScrollY;
    const drawerIsOpen = drawer.classList.contains("is-open");

    header.classList.toggle("site-header--scrolled", currentScrollY > 12);

    if (drawerIsOpen || currentScrollY < 90) {
      header.classList.remove("site-header--hidden");
    } else if (delta > 8) {
      header.classList.add("site-header--hidden");
    } else if (delta < -8) {
      header.classList.remove("site-header--hidden");
    }

    lastScrollY = currentScrollY;
    ticking = false;
  };

  window.addEventListener(
    "scroll",
    () => {
      if (ticking) return;
      ticking = true;
      window.requestAnimationFrame(updateHeaderOnScroll);
    },
    { passive: true }
  );

  const setDrawerState = (open) => {
    drawer.classList.toggle("is-open", open);
    overlay.classList.toggle("is-open", open);
    document.body.classList.toggle("overflow-hidden", open);
    document.body.classList.toggle("mobile-menu-open", open);
    if (open) header.classList.remove("site-header--hidden");
  };

  $("[data-mobile-open]")?.addEventListener("click", () => setDrawerState(true));
  $("[data-mobile-close]")?.addEventListener("click", () => setDrawerState(false));
  overlay.addEventListener("click", () => setDrawerState(false));

  $$("[data-mobile-accordion]").forEach((button) => {
    button.addEventListener("click", () => {
      const target = document.getElementById(button.getAttribute("data-mobile-accordion") || "");
      if (!target) return;

      const isOpen = button.getAttribute("aria-expanded") === "true";
      $$("[data-mobile-accordion]").forEach((item) => item.setAttribute("aria-expanded", "false"));
      $$("[data-mobile-accordion-panel]").forEach((panel) => panel.classList.add("hidden"));

      if (!isOpen) {
        button.setAttribute("aria-expanded", "true");
        target.classList.remove("hidden");
      }
    });
  });
};

const initChatbot = () => {
  const panel = $("#chatbot-panel");
  const toggle = $("#chatbot-toggle");
  const close = $("#chatbot-close");
  const send = $("#chatbot-send");
  const input = $("#chatbot-input");
  const whatsapp = $("#chatbot-whatsapp");
  if (!panel || !toggle || !whatsapp) return;

  const setChatState = (open) => {
    panel.classList.toggle("is-open", open);
    whatsapp.classList.toggle("hidden", open);
    toggle.setAttribute("aria-expanded", String(open));
  };

  toggle.addEventListener("click", () => setChatState(toggle.getAttribute("aria-expanded") !== "true"));
  close?.addEventListener("click", () => setChatState(false));
  send?.addEventListener("click", () => {
    const message = encodeURIComponent((input?.value || "Hello!").trim() || "Hello!");
    window.open(`https://wa.me/${WHATSAPP_NUMBER}?text=${message}`, "_blank", "noopener,noreferrer");
  });
};

const initFresherModal = () => {
  const shell = $("#fresher-modal-shell");
  if (!shell) return;

  $$("[data-open-fresher]").forEach((button) => {
    button.addEventListener("click", () => setModalState(shell, true));
  });
  $$("[data-close-fresher]").forEach((button) => {
    button.addEventListener("click", () => setModalState(shell, false));
  });
  $(".modal-overlay", shell)?.addEventListener("click", () => setModalState(shell, false));

  const fileInput = $("#fresher-file");
  const fileName = $("#fresher-file-name");
  fileInput?.addEventListener("change", () => {
    if (fileName) fileName.textContent = fileInput.files?.[0]?.name || "No file chosen";
  });
};

const getRecaptchaToken = (form) =>
  !RECAPTCHA_ENABLED ? "recaptcha-disabled" : form.querySelector('textarea[name="g-recaptcha-response"]')?.value || "";

const initRecaptchaFallback = () => {
  if (RECAPTCHA_ENABLED) return;

  $$(".g-recaptcha").forEach((node) => {
    if (node.childElementCount > 0 || node.textContent.trim()) return;
    node.innerHTML = '<span style="font-weight:700;color:#4b5563;letter-spacing:0.02em;">reCAPTCHA</span>';
  });
};

const initPhoneInputs = () => {
  $$('input[name="phone"]').forEach((input) => {
    const sanitize = () => {
      input.value = input.value.replace(/\D+/g, "");
    };

    input.setAttribute("inputmode", "numeric");
    input.setAttribute("autocomplete", "tel-national");
    input.setAttribute("pattern", "[0-9]*");
    input.addEventListener("input", sanitize);
    input.addEventListener("paste", () => window.setTimeout(sanitize, 0));
  });
};

const setButtonLoading = (form, loading, text) => {
  const button = $('button[type="submit"]', form);
  if (!button) return;

  button.dataset.originalText ||= button.textContent.trim();
  button.disabled = loading;
  button.textContent = loading ? text : button.dataset.originalText;
};

const showFormMessage = (form, message, type = "success") => {
  let msgEl = form.querySelector(".form-feedback-message");
  if (!msgEl) {
    msgEl = document.createElement("div");
    msgEl.className = "form-feedback-message";
    const submitBtn = form.querySelector('button[type="submit"]');
    if (submitBtn) {
      submitBtn.parentNode.insertBefore(msgEl, submitBtn);
    } else {
      form.appendChild(msgEl);
    }
  }

  msgEl.textContent = message;
  msgEl.className = `form-feedback-message form-feedback-message--${type}`;

  Object.assign(msgEl.style, {
    padding: "12px 16px",
    borderRadius: "6px",
    fontSize: "14px",
    fontWeight: "600",
    marginBottom: "16px",
    textAlign: "center",
    transition: "opacity 0.3s ease, transform 0.3s ease",
    opacity: "1",
    transform: "translateY(0)",
    display: "block",
  });

  if (type === "success") {
    Object.assign(msgEl.style, {
      background: "#d1fae5",
      color: "#065f46",
      border: "1px solid #10b981",
    });
  } else {
    Object.assign(msgEl.style, {
      background: "#fee2e2",
      color: "#991b1b",
      border: "1px solid #f87171",
    });
  }

  if (msgEl.timeoutId) {
    clearTimeout(msgEl.timeoutId);
  }

  msgEl.timeoutId = setTimeout(() => {
    msgEl.style.opacity = "0";
    msgEl.style.transform = "translateY(-5px)";
    msgEl.timeoutId = setTimeout(() => {
      msgEl.style.display = "none";
    }, 300);
  }, 2000);
};

window.showFormMessage = showFormMessage;

const serializeContactForm = (form) => {
  const data = new FormData(form);

  // Safely extract and format phone national value if present
  const phoneVal = form.elements.phone?.value || "";
  if (phoneVal) {
    data.set("phone", phoneVal.replace(/\D+/g, ""));
  }

  // Determine submission type if not already set in the form
  if (!data.has("type")) {
    const route = document.body?.dataset.route || "";
    if (form.classList.contains("internship-application-form") || route === "/internship") {
      data.append("type", "internship");
    } else if (form.classList.contains("fresher-connect-form")) {
      data.append("type", "fresher");
    } else if (form.classList.contains("career-form")) {
      data.append("type", "careers");
    } else {
      data.append("type", "contact");
    }
  }

  // Always append the current page URL
  data.append("url", window.location.href);

  // Append recaptcha token
  data.append("recaptcha", getRecaptchaToken(form) || "");

  return data;
};

const initForms = () => {
  $$("form").forEach((form) => {
    // Only target frontend forms submitting to api/contact-messages
    const action = form.getAttribute("action") || "";
    const isFrontendForm =
      form.classList.contains("contact-form") ||
      form.classList.contains("sq-form") ||
      form.classList.contains("internship-application-form") ||
      form.classList.contains("fresher-connect-form") ||
      form.id === "fresherHiringForm" ||
      form.classList.contains("career-form") ||
      action.includes("contact-messages");

    if (!isFrontendForm) return;

    form.addEventListener("submit", async (event) => {
      event.preventDefault();

      if (!getRecaptchaToken(form)) {
        showFormMessage(form, "Please complete the ReCAPTCHA check.", "error");
        return;
      }

      setButtonLoading(form, true, "Sending...");

      try {
        let submitUrl = CONTACT_API_URL;
        if (form.classList.contains("fresher-connect-form") || form.id === "fresherHiringForm") {
          submitUrl = FRESHER_API_URL;
        } else if (form.classList.contains("internship-application-form")) {
          submitUrl = INTERNSHIP_API_URL;
        }

        const response = await fetch(submitUrl, {
          method: "POST",
          headers: {
            Accept: "application/json",
            "X-Requested-With": "XMLHttpRequest",
          },
          body: serializeContactForm(form),
        });

        const raw = await response.text();
        let result = {};
        try {
          result = raw ? JSON.parse(raw) : {};
        } catch {
          throw new Error("Invalid response from server. Please try again.");
        }

        if (!response.ok) {
          const firstError = result.errors ? Object.values(result.errors).flat()[0] : null;
          throw new Error(firstError || result.message || "Unable to submit application.");
        }

        showFormMessage(form, result.message || "Submitted successfully!", "success");
        form.reset();

        // If it is the Fresher Hiring modal form, reset the file chosen label text and close modal
        if (form.classList.contains("fresher-connect-form") || form.id === "fresherHiringForm") {
          const nameNode = document.getElementById("fresher-file-name") || $("#fresher-file-name") || document.getElementById("uploadLabel");
          if (nameNode) {
            if (nameNode.id === "uploadLabel") {
              nameNode.innerHTML = '<span class="choose-btn">Choose File</span>No file chosen';
            } else {
              nameNode.textContent = "No file chosen";
            }
          }
          window.setTimeout(() => {
            if (typeof window.closeFresherModal === "function") {
              window.closeFresherModal();
            } else {
              setModalState($("#fresher-modal-shell"), false);
            }
          }, 2000);
        }

        try {
          window.grecaptcha?.reset();
        } catch {
          // Ignore routes without an active widget.
        }
      } catch (error) {
        showFormMessage(form, error.message || "Error submitting form.", "error");
      } finally {
        setButtonLoading(form, false, "Sending...");
      }
    });
  });
};

const initVideoCards = () => {
  $$("[data-video-src]").forEach((card) => {
    card.addEventListener("click", () => {
      const sourceUrl = card.getAttribute("data-video-src");
      const sourceType = card.getAttribute("data-video-type") || "file";
      const posterUrl = card.getAttribute("data-video-poster");
      const title = card.getAttribute("data-video-title") || "Sortiq video";
      if (!sourceUrl || card.dataset.loaded === "true") return;

      card.dataset.loaded = "true";

      if (sourceType === "youtube") {
        const autoplayUrl = `${sourceUrl}${sourceUrl.includes("?") ? "&" : "?"}autoplay=1&rel=0&modestbranding=1`;

        card.innerHTML = `
          <iframe
            src="${escapeHtml(autoplayUrl)}"
            title="${escapeHtml(title)}"
            class="w-full h-full border-0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
            loading="lazy"
          ></iframe>
        `;

        return;
      }

      card.innerHTML = `
        <video
          src="${escapeHtml(sourceUrl)}"
          ${posterUrl ? `poster="${escapeHtml(posterUrl)}"` : ""}
          title="${escapeHtml(title)}"
          class="w-full h-full object-cover"
          controls
          autoplay
          playsinline
          preload="metadata"
        ></video>
      `;
    });
  });
};

const initHeroSlider = () => {
  const data = parseJsonScript("hero-slides-data");
  if (!data?.slides?.length) return;

  const title = $("#hero-slide-title");
  const desc = $("#hero-slide-desc");
  const player = $("#hero-slide-player");
  let index = 0;

  const render = () => {
    const slide = data.slides[index];
    if (!slide) return;
    if (title) title.textContent = slide.title;
    if (desc) desc.textContent = slide.desc;
    if (player) player.setAttribute("src", slide.animation);
  };

  $("#hero-prev")?.addEventListener("click", () => {
    index = (index - 1 + data.slides.length) % data.slides.length;
    render();
  });
  $("#hero-next")?.addEventListener("click", () => {
    index = (index + 1) % data.slides.length;
    render();
  });

  render();
  window.setInterval(() => {
    index = (index + 1) % data.slides.length;
    render();
  }, 6000);
};

const initCertificationsSlider = () => {
  const slider = $("[data-certifications-slider]");
  const track = slider && $("[data-certifications-track]", slider);
  if (!slider || !track || window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

  const cards = Array.from(track.children).filter((node) => node instanceof HTMLElement);
  if (cards.length < 2 || cards.length % 2 !== 0) return;

  let offset = 0;
  let resetPoint = 0;
  let lastTime = 0;
  let paused = false;
  let inView = true;

  const speed = () => (window.innerWidth >= 1024 ? 72 : window.innerWidth >= 640 ? 58 : 44);
  const paint = () => {
    track.style.transform = `translate3d(-${offset}px,0,0)`;
  };
  const measure = () => {
    const midpoint = cards[Math.floor(cards.length / 2)];
    resetPoint = midpoint ? midpoint.offsetLeft - cards[0].offsetLeft : 0;
    if (resetPoint <= 0) return (track.style.transform = "");
    offset %= resetPoint;
    paint();
  };
  const resetClock = () => {
    lastTime = 0;
  };
  const tick = (time) => {
    if (!lastTime) lastTime = time;
    const delta = (time - lastTime) / 1000;
    lastTime = time;

    if (!paused && inView && document.visibilityState === "visible" && resetPoint > 0) {
      offset += speed() * delta;
      if (offset >= resetPoint) offset -= resetPoint;
      paint();
    }

    window.requestAnimationFrame(tick);
  };

  ["mouseenter", "focusin"].forEach((event) => slider.addEventListener(event, () => (paused = true)));
  ["mouseleave", "focusout"].forEach((event) =>
    slider.addEventListener(event, () => {
      paused = false;
      resetClock();
    })
  );

  document.addEventListener("visibilitychange", resetClock);
  window.addEventListener("resize", measure, { passive: true });
  window.addEventListener("load", measure, { once: true });
  if ("ResizeObserver" in window) new ResizeObserver(measure).observe(slider);
  if ("IntersectionObserver" in window) {
    new IntersectionObserver(
      ([entry]) => {
        inView = entry?.isIntersecting ?? true;
        if (inView) resetClock();
      },
      { threshold: 0.15 }
    ).observe(slider);
  }

  measure();
  window.requestAnimationFrame(tick);
};

const initStatsCounters = () => {
  const counters = $$("[data-count-end]");
  if (!counters.length) return;

  const revealCounter = (node) => {
    const end = Number(node.getAttribute("data-count-end") || "0");
    const start = performance.now();

    const step = (time) => {
      const progress = Math.min((time - start) / 2000, 1);
      node.textContent = `${Math.floor(progress * end)}+`;
      if (progress < 1) return window.requestAnimationFrame(step);
      node.textContent = `${end}+`;
    };

    window.requestAnimationFrame(step);
  };

  if (!("IntersectionObserver" in window)) {
    counters.forEach(revealCounter);
    return;
  }

  counters.forEach((node) => {
    const observer = new IntersectionObserver(([entry]) => {
      if (!entry?.isIntersecting) return;
      observer.disconnect();
      revealCounter(node);
    }, { threshold: 0.4 });

    observer.observe(node);
  });
};

const initTestimonials = () => {
  $$("[data-testimonials-section]").forEach((section) => {
    const viewport = $("[data-testimonial-viewport]", section);
    const track = $("[data-testimonial-track]", section);
    const panels = $$("[data-testimonial-panel]", section);
    const triggers = $$("[data-testimonial-trigger]", section);
    if (!viewport || !track || !panels.length || !triggers.length) return;

    let active = triggers.findIndex((trigger) => trigger.classList.contains("is-active"));
    if (active < 0) active = panels.findIndex((panel) => panel.classList.contains("is-active"));
    if (active < 0) active = 0;
    let autoplayId = null;
    let isPaused = false;
    const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    const centerActiveTrigger = () => {
      const activeTrigger = triggers[active];
      if (!activeTrigger) return;

      if (track.scrollWidth <= viewport.clientWidth) {
        track.style.transform = "translate3d(0, 0, 0)";
        return;
      }

      const offset = (viewport.clientWidth / 2) - (activeTrigger.offsetLeft + (activeTrigger.offsetWidth / 2));
      track.style.transform = `translate3d(${Math.round(offset)}px, 0, 0)`;
    };

    const render = () => {
      panels.forEach((panel, index) => {
        const isActive = index === active;
        panel.classList.toggle("is-active", isActive);
        panel.setAttribute("aria-hidden", String(!isActive));
      });

      triggers.forEach((trigger, index) => {
        const isActive = index === active;
        trigger.setAttribute("aria-pressed", String(isActive));
        trigger.classList.toggle("is-active", isActive);
      });

      centerActiveTrigger();
    };

    const stopAutoplay = () => {
      if (autoplayId !== null) {
        window.clearInterval(autoplayId);
        autoplayId = null;
      }
    };

    const startAutoplay = () => {
      if (prefersReducedMotion || panels.length < 2 || isPaused) return;

      stopAutoplay();
      autoplayId = window.setInterval(() => {
        active = (active + 1) % panels.length;
        render();
      }, 3000);
    };

    const moveTo = (nextIndex) => {
      active = (nextIndex + panels.length) % panels.length;
      render();
    };

    const pauseAutoplay = () => {
      isPaused = true;
      stopAutoplay();
    };

    const resumeAutoplay = () => {
      isPaused = false;
      startAutoplay();
    };

    triggers.forEach((button, index) => {
      button.addEventListener("click", () => {
        moveTo(index);
        startAutoplay();
      });

      button.addEventListener("keydown", (event) => {
        const currentIndex = Number(button.getAttribute("data-testimonial-index") || String(index));

        if (event.key === "ArrowRight") {
          event.preventDefault();
          moveTo(currentIndex + 1);
          triggers[active]?.focus();
        }

        if (event.key === "ArrowLeft") {
          event.preventDefault();
          moveTo(currentIndex - 1);
          triggers[active]?.focus();
        }
      });
    });

    section.addEventListener("mouseenter", pauseAutoplay);
    section.addEventListener("mouseleave", resumeAutoplay);
    section.addEventListener("focusin", pauseAutoplay);
    section.addEventListener("focusout", (event) => {
      if (event.relatedTarget instanceof Node && section.contains(event.relatedTarget)) return;
      resumeAutoplay();
    });

    window.addEventListener("resize", centerActiveTrigger);

    render();
    startAutoplay();
  });
};

const initWebTestimonials = () => {
  $$("[data-web-testimonials-section]").forEach((section) => {
    const copy = $("[data-web-testimonial-copy]", section);
    const people = $$("[data-web-testimonial-person]", section);
    if (!copy || people.length < 2 || window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

    let active = people.findIndex((person) => person.classList.contains("is-active"));
    if (active < 0) active = 0;
    let timer = null;
    let paused = false;

    const render = () => {
      people.forEach((person, index) => {
        const isActive = index === active;
        person.classList.toggle("is-active", isActive);
        person.setAttribute("aria-current", String(isActive));
      });

      const nextText = people[active]?.dataset.testimonialText;
      if (!nextText) return;

      copy.classList.remove("is-changing");
      window.requestAnimationFrame(() => {
        copy.classList.add("is-changing");
        window.setTimeout(() => {
          copy.textContent = `“${nextText}”`;
          copy.classList.remove("is-changing");
        }, 150);
      });
    };

    const start = () => {
      if (paused) return;
      window.clearInterval(timer);
      timer = window.setInterval(() => {
        active = (active + 1) % people.length;
        render();
      }, 3000);
    };

    people.forEach((person, index) => {
      person.addEventListener("click", () => {
        active = index;
        render();
        start();
      });
    });

    section.addEventListener("mouseenter", () => {
      paused = true;
      window.clearInterval(timer);
    });
    section.addEventListener("mouseleave", () => {
      paused = false;
      start();
    });

    render();
    start();
  });
};

const initPortfoliosPage = () => {
  const pageData = parseJsonScript("portfolio-page-data");
  const modal = $("#portfolio-modal");
  const contentNode = $("#portfolio-modal-content");
  const closeButton = $("#portfolio-modal-close");
  const grid = $("#portfolio-grid");
  const filterButtons = $$("[data-portfolio-filter]");
  const behanceWrap = $("#portfolio-behance-wrap");
  if (!modal || !contentNode || !grid || !filterButtons.length) return;

  const items = Array.isArray(pageData?.items) ? pageData.items : [];
  let activeCategory = String(pageData?.activeCategory || "").trim() || "wordpress-development";

  const closeModal = () => {
    modal.hidden = true;
    document.body.classList.remove("overflow-hidden");
    contentNode.innerHTML = "";
  };

  const openModal = (button) => {
    const title = button.getAttribute("data-portfolio-title")?.trim() || "Portfolio Project";
    const imageUrl = button.getAttribute("data-portfolio-image")?.trim() || "";

    modal.hidden = false;
    document.body.classList.add("overflow-hidden");
    contentNode.innerHTML = renderPortfolioModalContent({ title, imageUrl });
  };

  const bindPortfolioCardListeners = () => {
    $$("[data-portfolio-item]", grid).forEach((button) => {
      button.addEventListener("click", () => openModal(button));
    });
  };

  const filteredItems = () => items.filter((item) => String(item.category_slug || "").trim() === activeCategory);

  const updateFilterButtons = () => {
    filterButtons.forEach((button) => {
      const isActive = button.getAttribute("data-portfolio-filter") === activeCategory;
      button.className = portfolioFilterButtonClass(isActive);
    });
  };

  const renderPortfolioPage = () => {
    const categoryItems = filteredItems();

    grid.innerHTML = categoryItems.length
      ? categoryItems.map((item) => renderPortfolioCard(item)).join("")
      : renderPortfolioEmptyState();

    updateFilterButtons();
    bindPortfolioCardListeners();
  };

  filterButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const category = button.getAttribute("data-portfolio-filter");
      if (!category || category === activeCategory) return;

      activeCategory = category;
      renderPortfolioPage();
    });
  });

  closeButton?.addEventListener("click", closeModal);
  modal.addEventListener("click", (event) => {
    if (event.target === modal) closeModal();
  });
  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && !modal.hidden) closeModal();
  });

  renderPortfolioPage();
};

const initFaqPage = () => {
  const buttons = $$("[data-faq-button]");
  if (!buttons.length) return;

  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      const panel = document.getElementById(button.getAttribute("data-faq-button") || "");
      if (!panel) return;

      const expanded = button.getAttribute("aria-expanded") === "true";
      
      // Reset all buttons
      buttons.forEach((item) => {
        item.setAttribute("aria-expanded", "false");
        const titleSpan = item.querySelector("span");
        if (titleSpan) {
          titleSpan.classList.remove("text-[#ff6600]");
          titleSpan.classList.add("text-[#001a3d]");
        }
        const icon = item.querySelector("iconify-icon");
        if (icon) {
          icon.classList.remove("rotate-180", "text-[#ff6600]");
          icon.classList.add("text-gray-400");
        }
      });

      // Hide all panels
      $$(".faq-panel").forEach((item) => {
        item.hidden = true;
      });

      // If clicked button was not open, open it and apply active orange color
      if (!expanded) {
        button.setAttribute("aria-expanded", "true");
        panel.hidden = false;

        const activeSpan = button.querySelector("span");
        if (activeSpan) {
          activeSpan.classList.remove("text-[#001a3d]");
          activeSpan.classList.add("text-[#ff6600]");
        }

        const activeIcon = button.querySelector("iconify-icon");
        if (activeIcon) {
          activeIcon.classList.add("rotate-180", "text-[#ff6600]");
          activeIcon.classList.remove("text-gray-400");
        }
      }
    });
  });
};

document.addEventListener("DOMContentLoaded", () => {
  initHeader();
  initChatbot();
  initFresherModal();
  initRecaptchaFallback();
  initPhoneInputs();
  initForms();
  initVideoCards();
  initHeroSlider();
  initCertificationsSlider();
  initStatsCounters();
  initTestimonials();
  initWebTestimonials();
  initPortfoliosPage();
  initFaqPage();
});
