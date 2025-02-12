<footer class="footer-wrapper">
    <div class="container">
        <hr>

        <p><?= $site->copyright() ?></p>
        <p>Mail: <a href="mailto:<?= $site->mail() ?>">maximiliankochhome@gmail.com</a></p>

        <nav class="socials">
            <a target="_blank" href="<?= $site->twitter() ?>">Follow me on Twitter</a>
            <a target="_blank" href="<?= $site->itchio() ?>">Itch.io</a>
            <a target="_blank" href="<?= $site->linkedin() ?>">LinkedIn</a>
            <a target="_blank" href="<?= $site->bluesky() ?>">Bluesky</a>
            <a target="_blank" href="<?= $site->youtube() ?>">YouTube</a>
        </nav>
    </div>
</footer>
<?php if ($page->intendedTemplate()->name() === 'home'): ?>
<?= js('assets/js/gliderJS/glider-compat.min.js') ?>
<?= js('assets/js/gliderJS/glider.js') ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Glider(document.querySelector('.glider'), {
            slidesToShow: 1,
            slidesToScroll: 1,
            scrollLock: true,
            rewind: true,
            draggable: true,
            dragVelocity: 2.7, // Increased drag velocity for a more fluid swipe feel
            duration: 0.5, 
            easing: function (x, t, b, c, d) { // Custom easing function for smooth drag
                return c*(t/=d)*t + b;
            },
            dots: '.dots',
            arrows: {
                prev: '.glider-prev',
                next: '.glider-next'
            },
        });
    });
</script>
<?php endif; ?>



</body>
</html>
