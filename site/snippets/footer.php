<?php snippet('footer-content') ?>


<!-- Load JS for pages -->
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
            showAnimationDuration: 300,
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

<?php endif ?>