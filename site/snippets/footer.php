<footer class="footer-wrapper">
    <div class="container">
        <hr>

        <p><?= $site->copyright() ?></p>
        <p>Mail:<a class="mail-link" href="mailto:<?= $site->mail() ?>">maximiliankochhome@gmail.com</a></p>

        <nav class="socials">
            <a class="social-link" target="_blank" href="<?= $site->twitter() ?>">Twitter</a><span>&nbsp;|</span>
            <a class="social-link" target="_blank" href="<?= $site->itchio() ?>">Itch.io</a><span>&nbsp;|</span>
            <a class="social-link" target="_blank" href="<?= $site->linkedin() ?>">LinkedIn</a><span>&nbsp;|</span>
            <a class="social-link" target="_blank" href="<?= $site->bluesky() ?>">Bluesky</a><span>&nbsp;|</span>
            <a class="social-link" target="_blank" href="<?= $site->youtube() ?>">YouTube</a>
        </nav>
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
                wrapAround: true,  // Optional: Allows for infinite scrolling
                autoPlay: 3000,    // Optional: Auto-play carousel every 3 seconds
                prevNextButtons: true,
                dragThreshold: 15,
                cellSelector: '.carousel-cell',
                arrowShape: {
                    x0: 10,
                    x1: 70, y1: 40,
                    x2: 70, y2: 40,
                    x3: 70
                },
            });
        }
    });
    </script>
<?php endif; ?>
<?= js( 'assets/js/script.js') ?>

</body>
</html>
