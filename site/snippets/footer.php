<?php snippet('footer-content') ?>

<?php
// Cache-busting for JS (mirrors cssv() in header.php)
function jsv($path, $options = []) {
    $file = kirby()->root('index') . '/' . $path;
    $v = file_exists($file) ? filemtime($file) : '';
    return js($path . '?v=' . $v, $options);
}
?>

<!-- Load JS for all pages -->
<?= jsv('assets/js/script.js') ?>

<!-- Load JS for project pages -->
<?php if ($page->intendedTemplate()->name() === 'project'): ?>

    <?= jsv('assets/glightbox/glightbox.min.js') ?>
    <?= jsv('assets/js/smooth-scroll.js', ['defer' => true]) ?>
    <script>
        const glightboxSvg = {
            close: '<i class="fa-solid fa-xmark"></i>',
            prev: '<i class="fa-solid fa-chevron-left"></i>',
            next: '<i class="fa-solid fa-chevron-right"></i>',
        };

        const lightbox = GLightbox({
            selector: '[data-gallery="project-gallery"]',
            touchNavigation: true,
            loop: true,
            autoplayVideos: true,
            openEffect: 'zoom',
            closeEffect: 'zoom',
            slideEffect: 'slide',
            svg: glightboxSvg,
        });

        const devlogLightbox = GLightbox({
            selector: '[data-gallery="devlog-gallery"]',
            touchNavigation: true,
            loop: true,
            openEffect: 'zoom',
            closeEffect: 'zoom',
            slideEffect: 'slide',
            svg: glightboxSvg,
        });
    </script>

<?php endif ?>