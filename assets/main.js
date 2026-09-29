/* Southern Learn – progressive enhancement. The site works without this file. */
(() => {
  const root = document.documentElement;
  root.classList.add("js");
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  // 1. Header shrinks and darkens after scrolling.
  const header = document.querySelector(".site-header");
  const onScroll = () =>
    header && header.classList.toggle("is-scrolled", window.scrollY > 20);
  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();

  // 2. Scroll reveal with a small stagger. Works on the home, courses and single course pages.
  const revealTargets = document.querySelectorAll(
    [
      ".hero > *",
      ".section > :not(.wp-block-query):not(.course-layout)",
      ".course-card",
      ".course-body > *",
      ".course-sidebar-card",
      ".faq-item",
      ".cta > *",
    ].join(","),
  );

  revealTargets.forEach((el) => {
    el.classList.add("reveal");
    const item = el.closest("li") || el;
    const siblings = item.parentElement
      ? Array.from(item.parentElement.children)
      : [];
    el.style.setProperty(
      "--i",
      Math.min(Math.max(siblings.indexOf(item), 0), 5),
    );
  });

  const io = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        const el = entry.target;
        el.classList.add("is-visible");
        io.unobserve(el);
        // Once faded in, remove the helper classes so hover effects work normally.
        el.addEventListener(
          "transitionend",
          (e) => {
            if (e.propertyName !== "opacity") return;
            el.classList.remove("reveal", "is-visible");
            el.style.removeProperty("--i");
          },
          { once: true },
        );
      });
    },
    { threshold: 0.1 },
  );

  // Wait two frames so the hidden state is painted first; otherwise items already
  // on screen at page load would skip their entrance animation.
  requestAnimationFrame(() =>
    requestAnimationFrame(() => {
      revealTargets.forEach((el) => io.observe(el));
    }),
  );

  // 3. Animated stat counters ("12000+" counts up to 12,000+).
  const animateCount = (el) => {
    const text = el.textContent.trim();
    const target = parseInt(text.replace(/[^0-9]/g, ""), 10);
    const suffix = text.replace(/[0-9,\s]/g, "");
    if (!target || reduce) return;
    const duration = 1600;
    const start = performance.now();
    const tick = (now) => {
      const p = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - p, 3);
      el.textContent =
        Math.round(target * eased).toLocaleString("en-AU") +
        (p === 1 ? suffix : "");
      if (p < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
  };
  const statObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          animateCount(entry.target);
          statObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.6 },
  );
  document
    .querySelectorAll(".stat-number")
    .forEach((el) => statObserver.observe(el));

  // 4. Hero glow follows the pointer (home and course pages).
  const hero = document.querySelector(".hero");
  if (hero && !reduce) {
    hero.addEventListener("pointermove", (e) => {
      const r = hero.getBoundingClientRect();
      hero.style.setProperty(
        "--mx",
        (((e.clientX - r.left) / r.width) * 100).toFixed(1) + "%",
      );
      hero.style.setProperty(
        "--my",
        (((e.clientY - r.top) / r.height) * 100).toFixed(1) + "%",
      );
    });
  }

  // 5. Smooth open/close for FAQ <details>.
  document.querySelectorAll(".faq-item").forEach((details) => {
    const summary = details.querySelector("summary");
    if (!summary || reduce) return;
    summary.addEventListener("click", (e) => {
      e.preventDefault();
      const opening = !details.open;
      if (opening) details.open = true;
      const startH = opening ? summary.offsetHeight : details.offsetHeight;
      const endH = opening ? details.scrollHeight : summary.offsetHeight;
      details.style.overflow = "hidden";
      const anim = details.animate(
        { height: [startH + "px", endH + "px"] },
        { duration: 300, easing: "cubic-bezier(.22,.61,.36,1)" },
      );
      anim.onfinish = () => {
        details.open = opening;
        details.style.overflow = details.style.height = "";
      };
    });
  });
})();
