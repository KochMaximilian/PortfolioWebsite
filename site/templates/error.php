<?php snippet('header') ?>
<div class="wrapper">
    <main class="main-wrapper" id="main-content">
        <section class="content-block error-page">
            <h1><?= $page->title()->html() ?></h1>
            <p class="error-code">404</p>
            <p class="error-message">The page you're looking for doesn't exist or has been moved.</p>
            <a class="error-back-btn" href="<?= $site->url() ?>">
                <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                <span>Back to Portfolio</span>
            </a>
        </section>
    </main>
</div>
<?php snippet('footer') ?>
