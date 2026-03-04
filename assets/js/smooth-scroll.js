/**
 * smooth-scroll.js
 * Spring physics scroll + sticky project nav + scroll-to-top button.
 * Project pages only. Never fires scroll on load/reload.
 * Respects prefers-reduced-motion (reactive).
 */

(function () {
  'use strict';

  // ─── Kill native hash-jump and scroll restoration ─────────────────────────────
  if ('scrollRestoration' in history) {
    history.scrollRestoration = 'manual';
  }
  if (window.location.hash) {
    window.scrollTo(0, 0);
  }

  // ─── Reactive reduced-motion preference ───────────────────────────────────────
  const reducedMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
  let prefersReduced = reducedMotionQuery.matches;

  reducedMotionQuery.addEventListener('change', function (e) {
    prefersReduced = e.matches;
  });

  // ─── Navbar height ────────────────────────────────────────────────────────────
  function getNavbarHeight() {
    const navbar = document.querySelector('.navbar');
    return navbar ? navbar.offsetHeight + 16 : 96;
  }

  // ─── Spring physics scroll ────────────────────────────────────────────────────
  let activeRafId = null;

  function springScrollTo(targetY) {
    if (activeRafId) {
      cancelAnimationFrame(activeRafId);
      activeRafId = null;
    }

    let pos      = window.scrollY;
    let velocity = 0;

    const stiffness = 0.18;
    const damping   = 0.74;

    document.documentElement.style.scrollBehavior = 'auto';

    function step() {
      const displacement = targetY - pos;
      velocity = (velocity + displacement * stiffness) * damping;
      pos += velocity;

      window.scrollTo(0, pos);

      if (Math.abs(displacement) > 0.5 || Math.abs(velocity) > 0.5) {
        activeRafId = requestAnimationFrame(step);
      } else {
        window.scrollTo(0, targetY);
        document.documentElement.style.scrollBehavior = '';
        activeRafId = null;
      }
    }

    activeRafId = requestAnimationFrame(step);
  }

  // ─── Shared scroll-to-hash helper ─────────────────────────────────────────────
  function scrollToHash(hash) {
    if (!hash || hash === '#') return;

    const target = document.querySelector(hash);
    if (!target) return;

    const navHeight = getNavbarHeight();
    const targetY   = target.getBoundingClientRect().top + window.scrollY - navHeight;

    if (prefersReduced) {
      window.scrollTo(0, targetY);
    } else {
      springScrollTo(targetY);
    }
  }

  // ─── Anchor click handler ─────────────────────────────────────────────────────
  document.addEventListener('click', function (e) {
    const link = e.target.closest('a[href^="#"]');
    if (!link) return;

    const hash = link.getAttribute('href');
    if (hash === '#') return;

    const target = document.querySelector(hash);
    if (!target) return;

    e.preventDefault();

    // Never push on-page anchor hashes to the URL on project pages.
    // All # links here are internal (figures, headings, text anchors).
    // Keeps the share URL clean so visitors land on the project itself.

    scrollToHash(hash);
  });

  // ─── Popstate handler — browser back/forward with spring scroll ───────────────
  window.addEventListener('popstate', function () {
    const hash = window.location.hash;
    if (hash) {
      scrollToHash(hash);
    } else {
      if (prefersReduced) {
        window.scrollTo(0, 0);
      } else {
        springScrollTo(0);
      }
    }
  });

  // ─── Scroll-to-top button ─────────────────────────────────────────────────────
  var scrollTopBtn = document.querySelector('.scroll-to-top');

  if (scrollTopBtn) {
    scrollTopBtn.addEventListener('click', function (e) {
      e.preventDefault();
      if (prefersReduced) {
        window.scrollTo(0, 0);
      } else {
        springScrollTo(0);
      }
    });
  }

  // ─── Sticky nav + scroll-to-top — unified scroll listener ────────────────────
  var stickyNav  = document.querySelector('.project-nav-sticky');
  var bottomNav  = document.getElementById('project-nav-bottom');

  var SCROLL_THRESHOLD = 300;
  var ticking = false;

  function updateScrollUI() {
    var pastTop = window.scrollY > SCROLL_THRESHOLD;

    // Hide sticky nav when bottom nav is within viewport
    var nearBottom = false;
    if (bottomNav) {
      var rect = bottomNav.getBoundingClientRect();
      nearBottom = rect.top < window.innerHeight;
    }

    // Sticky prev/next nav — hides near bottom nav to avoid overlap
    if (stickyNav) {
      if (pastTop && !nearBottom) {
        stickyNav.classList.add('is-visible');
      } else {
        stickyNav.classList.remove('is-visible');
      }
    }

    // Scroll-to-top button — stays visible regardless of bottom nav
    if (scrollTopBtn) {
      if (pastTop) {
        scrollTopBtn.classList.add('is-visible');
      } else {
        scrollTopBtn.classList.remove('is-visible');
      }
    }

    ticking = false;
  }

  window.addEventListener('scroll', function () {
    if (!ticking) {
      requestAnimationFrame(updateScrollUI);
      ticking = true;
    }
  }, { passive: true });

})();