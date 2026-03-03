/**
 * smooth-scroll.js
 * Spring physics scroll + sticky project nav.
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
  // Track the current animation frame so rapid clicks cancel the previous scroll
  let activeRafId = null;

  function springScrollTo(targetY) {
    // Cancel any in-flight spring animation
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

    // Figure anchors (#fig-*) scroll without touching the URL —
    // keeps the share URL clean so visitors land on the project, not a figure
    if (!hash.startsWith('#fig-')) {
      history.pushState(null, '', hash);
    }

    scrollToHash(hash);
  });

  // ─── Popstate handler — browser back/forward with spring scroll ───────────────
  window.addEventListener('popstate', function () {
    const hash = window.location.hash;
    if (hash) {
      scrollToHash(hash);
    } else {
      // No hash — scroll back to top
      if (prefersReduced) {
        window.scrollTo(0, 0);
      } else {
        springScrollTo(0);
      }
    }
  });

  // ─── Sticky project nav ───────────────────────────────────────────────────────
  // Appears after scrolling 300px.
  // Disappears again when the static bottom nav scrolls into view —
  // so they never overlap and the bottom nav acts as the natural endpoint.
  const stickyNav  = document.querySelector('.project-nav-sticky');
  const bottomNav  = document.getElementById('project-nav-bottom');

  if (stickyNav) {
    const SCROLL_THRESHOLD = 300;
    let ticking = false;

    function updateStickyNav() {
      const pastTop = window.scrollY > SCROLL_THRESHOLD;

      // Hide when bottom nav is within viewport
      let nearBottom = false;
      if (bottomNav) {
        const rect = bottomNav.getBoundingClientRect();
        nearBottom = rect.top < window.innerHeight;
      }

      if (pastTop && !nearBottom) {
        stickyNav.classList.add('is-visible');
      } else {
        stickyNav.classList.remove('is-visible');
      }

      ticking = false;
    }

    window.addEventListener('scroll', function () {
      if (!ticking) {
        requestAnimationFrame(updateStickyNav);
        ticking = true;
      }
    }, { passive: true });
  }

})();