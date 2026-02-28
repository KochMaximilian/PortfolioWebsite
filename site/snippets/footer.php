<?php snippet('footer-content') ?>


<!-- Load JS for all pages -->
<?= js('assets/js/script.js') ?>

<!-- Load JS for project pages -->
<?php if ($page->intendedTemplate()->name() === 'project'): ?>

    <?= js('assets/glightbox/glightbox.min.js') ?>
    <?= js('assets/js/smooth-scroll.js', ['defer' => true]) ?>
    <script>
        const lightbox = GLightbox({
            selector: '[data-gallery="project-gallery"]',
            touchNavigation: true,
            loop: true,
            autoplayVideos: true,
            openEffect: 'zoom',
            closeEffect: 'zoom',
            slideEffect: 'slide',
        });

        const devlogLightbox = GLightbox({
            selector: '[data-gallery="devlog-gallery"]',
            touchNavigation: true,
            loop: true,
            openEffect: 'zoom',
            closeEffect: 'zoom',
            slideEffect: 'slide',
        });
    </script>

<?php endif ?>