<footer>
    <div class="footer-container">
        <div class="footer-left">
            <nav class="socials">
                <a class="social-link" target="_blank" href="<?= $site->github() ?>"><i class="fa-brands fa-square-github custom-icon-size"></i></a>
                <a class="social-link" target="_blank" href="<?= $site->itchio() ?>"><i class="fa-brands fa-itch-io custom-icon-size"></i></a>
                <a class="social-link" target="_blank" href="mailto:<?= $site->mail() ?>"><i class="fa-solid fa-square-envelope custom-icon-size"></i></a>
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
                <a class="social-link" target="_blank" href="<?= $site->bluesky() ?>"><i class="fa-brands fa-square-bluesky custom-icon-size"></i></a>
                <a class="social-link" target="_blank" href="<?= $site->youtube() ?>"><i class="fa-brands fa-square-youtube custom-icon-size"></i></a>
            </nav>
        </div>
    </div>
</footer>


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