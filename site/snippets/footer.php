<footer>
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
                arrowShape: 'm24.12 54.706 38.9 34.972c4.59 4.02 11.79 0.752 11.79-5.496V15.818c0-6.248-7.2-9.516-11.79-5.496l-38.9 34.972a7 7 0 0 0 0 10.412z'
            });
        }
    });
    </script>
<?php endif; ?>
<?= js( 'assets/js/script.js') ?>

</body>
</html>
