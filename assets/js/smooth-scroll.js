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

  // ─── Reactive reduced-motion preference ──────────────────────────────────────
  var reducedMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
  var prefersReduced = reducedMotionQuery.matches;

  reducedMotionQuery.addEventListener('change', function (e) {
    prefersReduced = e.matches;
  });

  // ─── Navbar height ────────────────────────────────────────────────────────────
  function getNavbarHeight() {
    var navbar = document.querySelector('.navbar');
    return navbar ? navbar.offsetHeight + 16 : 96;
  }

  // ─── Spring physics scroll ────────────────────────────────────────────────────
  var activeRafId = null;

  function springScrollTo(targetY) {
    if (activeRafId) {
      cancelAnimationFrame(activeRafId);
      activeRafId = null;
    }

    var pos      = window.scrollY;
    var velocity = 0;

    var stiffness = 0.18;
    var damping   = 0.74;

    document.documentElement.style.scrollBehavior = 'auto';

    function step() {
      var displacement = targetY - pos;
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

    var target = document.querySelector(hash);
    if (!target) return;

    var navHeight = getNavbarHeight();
    var targetY   = target.getBoundingClientRect().top + window.scrollY - navHeight;

    if (prefersReduced) {
      window.scrollTo(0, targetY);
    } else {
      springScrollTo(targetY);
    }
  }

  // ─── Anchor click handler ─────────────────────────────────────────────────────
  document.addEventListener('click', function (e) {
    var link = e.target.closest('a[href^="#"]');
    if (!link) return;

    var hash = link.getAttribute('href');
    if (hash === '#') return;

    var target = document.querySelector(hash);
    if (!target) return;

    e.preventDefault();

    // Never push on-page anchor hashes to the URL on project pages.
    scrollToHash(hash);
  });

  // ─── Popstate handler — browser back/forward with spring scroll ───────────────
  window.addEventListener('popstate', function () {
    var hash = window.location.hash;
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

  // ─── Scroll-to-top button (lives inside sticky nav) ──────────────────────────
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

  // ─── Sticky nav — unified scroll listener ─────────────────────────────────────
  // Entrance: is-animating-in suppresses transition so pop-in keyframe plays clean.
  // Exit:     is-animating-in is removed after 510ms, restoring the base transition
  //           so removing is-visible slides the bar back down smoothly.
  // On mobile: CSS !important overrides make JS classes irrelevant for visibility.
  var stickyNav = document.querySelector('.project-nav-sticky');
  var bottomNav = document.getElementById('project-nav-bottom');

  var SCROLL_THRESHOLD   = 300;
  var ticking            = false;
  var wasVisible         = false;
  var animatingInTimer   = null; // tracks the 510ms cleanup timeout

  function updateScrollUI() {
    var pastTop = window.scrollY > SCROLL_THRESHOLD;

    var nearBottom = false;
    if (bottomNav) {
      var rect = bottomNav.getBoundingClientRect();
      nearBottom = rect.top < window.innerHeight;
    }

    if (stickyNav) {
      if (pastTop) {
        if (!wasVisible) {
          // Clear any stale cleanup timer from a previous entrance
          if (animatingInTimer) {
            clearTimeout(animatingInTimer);
            animatingInTimer = null;
          }

          // Entrance: force animation restart, add both classes simultaneously
          stickyNav.classList.remove('is-visible');
          stickyNav.classList.remove('is-animating-in');
          void stickyNav.offsetHeight; // force reflow so animation restarts cleanly
          stickyNav.classList.add('is-visible');
          stickyNav.classList.add('is-animating-in');
          wasVisible = true;

          // Remove is-animating-in after pop-in completes (500ms + 10ms buffer)
          // This restores the base transition so the exit animates properly
          animatingInTimer = setTimeout(function () {
            stickyNav.classList.remove('is-animating-in');
            animatingInTimer = null;
          }, 510);
        }
      } else {
        // Exit: cancel any pending cleanup, strip both classes
        if (animatingInTimer) {
          clearTimeout(animatingInTimer);
          animatingInTimer = null;
        }
        stickyNav.classList.remove('is-animating-in');
        stickyNav.classList.remove('is-visible');
        stickyNav.classList.remove('is-near-bottom');
        wasVisible = false;
      }

      // Near-bottom: prev/next slide away, scroll-to-top stays
      if (pastTop && nearBottom) {
        stickyNav.classList.add('is-near-bottom');
      } else {
        stickyNav.classList.remove('is-near-bottom');
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