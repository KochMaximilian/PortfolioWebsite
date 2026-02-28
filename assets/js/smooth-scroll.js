/**
 * smooth-scroll.js
 * Spring physics scroll — feels natural because it IS physical.
 * Only fires on explicit clicks, never on load/reload.
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

  function getNavbarHeight() {
    const navbar = document.querySelector('.navbar');
    return navbar ? navbar.offsetHeight + 16 : 96;
  }

  // ─── Spring physics scroll ────────────────────────────────────────────────────
  // Simulates a damped spring per animation frame — same math game engines use.
  // stiffness: how hard it pulls toward target (higher = faster, snappier)
  // damping:   how much velocity survives each frame (lower = more bounce)
  // Tuned for: fast initial launch, slight overshoot, quick organic settle.
  function springScrollTo(targetY) {
    let pos      = window.scrollY;
    let velocity = 0;

    const stiffness = 0.18; // spring pull strength
    const damping   = 0.74; // velocity retention per frame (< 1 always settles)

    document.documentElement.style.scrollBehavior = 'auto';

    let rafId;

    function step() {
      const displacement = targetY - pos;
      velocity = (velocity + displacement * stiffness) * damping;
      pos += velocity;

      window.scrollTo(0, pos);

      // Settle when close enough — avoids infinite micro-oscillation
      if (Math.abs(displacement) > 0.5 || Math.abs(velocity) > 0.5) {
        rafId = requestAnimationFrame(step);
      } else {
        window.scrollTo(0, targetY);
        document.documentElement.style.scrollBehavior = '';
      }
    }

    rafId = requestAnimationFrame(step);
  }

  // ─── Click handler ────────────────────────────────────────────────────────────
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

})();