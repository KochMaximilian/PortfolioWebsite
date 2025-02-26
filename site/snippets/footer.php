<footer>
    <div class="footer-container">
        <div class="footer-left">
            <nav class="socials">
                <a class="social-link" target="_blank" href="<?= $site->twitter() ?>"><i class="fa-brands fa-square-x-twitter custom-icon-size"></i></a>
                <a class="social-link" target="_blank" href="<?= $site->youtube() ?>"><i class="fa-brands fa-square-youtube custom-icon-size"></i></a>
                <a class="social-link" target="_blank" href="<?= $site->itchio() ?>"><i class="fa-brands fa-itch-io custom-icon-size"></i></a>
            </nav>
        </div>

        <div class="footer-center">
            <img id="wobbleElement" class="wobble-hor-top footer-logo" src="<?= $site->url() ?>/assets/favicon/favicon.ico">
            <h5>Don't be a Stranger!</h5>
            <span class="copyright"><?= $site->copyright() ?></span>
        </div>

        <div class="footer-right">
            <nav class="socials">
                <a class="social-link" target="_blank" href="<?= $site->linkedin() ?>"><i class="fa-brands fa-linkedin custom-icon-size "></i></a>

                <a class="social-link" target="_blank" href="mailto:<?= Str::encode($site->mail()) ?>?subject=Game Design Portfolio Inquiry"><i class="fa-solid fa-square-envelope custom-icon-size"></i></a>

                <a class="social-link" target="_blank" href="<?= $site->github() ?>"><i class="fa-brands fa-square-github custom-icon-size"></i></a>
            </nav>
        </div>
    </div>
</footer>
<?php if ($page->intendedTemplate()->name() === 'project'): ?>


    <?= js('assets/photoswipe/photoswipe.umd.min.js') ?>
    <?= js('assets/photoswipe/photoswipe-lightbox.umd.min.js') ?>
    <script type="text/javascript">
    const quickEasing = {
        in: 'cubic-bezier(0.8, -0.15, 0.3, 1)',
        out: 'cubic-bezier(0.8, 0, 0.2, 1)',
        inOut: 'cubic-bezier(0.75, -0.2, 0.25, 1.25)',
    };

    var lightbox = new PhotoSwipeLightbox({
        gallery: '#gallery',
        children: 'a',
        pswpModule: PhotoSwipe,
        preload: [1, 1],
        showAnimationDuration: 300,  // Shorter animation duration
        hideAnimationDuration: 300,
        showHideAnimationType: 'zoom',
    });

    lightbox.on('firstUpdate', () => {
        lightbox.pswp.options.easing = quickEasing.out;
    });

    lightbox.on('initialZoomInEnd', () => {
        lightbox.pswp.options.easing = quickEasing.inOut;
    });

    lightbox.on('close', () => {
        lightbox.pswp.options.easing = quickEasing.in;
    });

    lightbox.init();
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const imageContainers = document.querySelectorAll('.project-image-container');
  
  imageContainers.forEach(container => {
    const totalImages = container.querySelectorAll('.project-image-link').length;
    const badgeElements = container.querySelectorAll('.image-caption-badge');

    badgeElements.forEach(badge => {
      if (totalImages <= 2) {
     
        badge.style.bottom = 'var(--spacing-7)';
        badge.style.fontSize = 'var(--font-size-lg)';
      } else if (totalImages <= 6) {
       
        badge.style.bottom = 'var(--spacing-4)';
        badge.style.fontSize = 'var(--font-size-md)';
      } else {
       
        badge.style.bottom = 'var(--spacing-2)';
        badge.style.fontSize = 'var(--font-size-xs';
      }
    });
  });
});
</script>

<?php endif ?>

<?php if ($page->intendedTemplate()->name() === 'home'): ?>
    <!-- Load JS for home page -->
    <?= js('assets/js/flickity/flickity.pkgd.min.js') ?>

    <script>
        // Initialize Flickity when the page is loaded or shown
        window.addEventListener('pageshow', function() {
            var elem = document.querySelector('.main-carousel');
            if (elem) {
                new Flickity(elem, {
                    selectedAttraction: 0.01,
                    friction: 0.15,
                    cellAlign: 'center',
                    contain: true,
                    wrapAround: true, // Optional: Allows for infinite scrolling
                    autoPlay: 3000, // Optional: Auto-play carousel every 3 seconds
                    prevNextButtons: true,
                    dragThreshold: 15,
                    cellSelector: '.carousel-cell',
                    arrowShape: 'm24.12 54.706 38.9 34.972c4.59 4.02 11.79 0.752 11.79-5.496V15.818c0-6.248-7.2-9.516-11.79-5.496l-38.9 34.972a7 7 0 0 0 0 10.412z'
                });
            }
        });
    </script>
<?php endif; ?>
<?= js('assets/js/script.js') ?>

</body>

</html>