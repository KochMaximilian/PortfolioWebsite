/**
 * smooth-scroll.js
 * Spring physics scroll + sticky project nav.
 * Project pages only. Never fires scroll on load/reload.
 * Respects prefers-reduced-motion.
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

  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // ─── Navbar height ────────────────────────────────────────────────────────────
  function getNavbarHeight() {
    const navbar = document.querySelector('.navbar');
    return navbar ? navbar.offsetHeight + 16 : 96;
  }

  // ─── Spring physics scroll ────────────────────────────────────────────────────
  function springScrollTo(targetY) {
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
        requestAnimationFrame(step);
      } else {
        window.scrollTo(0, targetY);
        document.documentElement.style.scrollBehavior = '';
      }
    }

    requestAnimationFrame(step);
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
    history.pushState(null, '', hash);

    const navHeight = getNavbarHeight();
    const targetY   = target.getBoundingClientRect().top + window.scrollY - navHeight;

    if (prefersReduced) {
      window.scrollTo(0, targetY);
    } else {
      springScrollTo(targetY);
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