<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $page->title()->html() ?> | <?= $site->title()->html() ?></title>
    <?php snippet('favicon') ?>

    <?php
    // Pick a random site variant per page load — drives both background pattern + footer logo
    $variants = ['piece', 'shaka', 'ok'];
    $GLOBALS['siteVariant'] = $variants[array_rand($variants)];
    ?>

    <link rel="preload" href="/assets/img/pattern_<?= $GLOBALS['siteVariant'] ?>.png" as="image">

    <?= css('assets/css/config/config.css') ?>
    <?php if ($page->intendedTemplate()->name() === 'home'): ?>
        <?= css('assets/css/config/utility/flickity.css') ?>
        <?= css('assets/css/carousel.css') ?>
    <?php endif; ?>

    <?php if ($page->intendedTemplate()->name() === 'project'): ?>
        <?= css('assets/photoswipe/photoswipe.css') ?>
    <?php endif ?>

    <?= css('assets/fontawesome/css/fontawesome.min.css') ?>
    <?= css('assets/fontawesome/css/brands.min.css') ?>
    <?= css('assets/fontawesome/css/solid.min.css') ?>

    <?= css('assets/css/footer.css') ?>
    <?php if ($page->intendedTemplate()->name() === 'about'): ?>
        <?= css('assets/css/about.css') ?>
    <?php endif ?>

    <?php if ($page->intendedTemplate()->name() === 'projects'): ?>
        <?= css('assets/css/projects.css') ?>
    <?php endif ?>

    <?php if ($page->intendedTemplate()->name() === 'project'): ?>
        <?= css('assets/css/project.css') ?>
    <?php endif ?>

    <?= css('assets/css/navbar.css') ?>
    <?= css('assets/css/main.css') ?>

    <?php if (isset($slots) && $slots->head()): ?>
        <?= $slots->head() ?>
    <?php endif ?>

    <link rel="preconnect" href="https://fonts.bunny.net/css">
    <link href="https://fonts.bunny.net/css2?family=Barlow:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.bunny.net/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="variant-<?= $GLOBALS['siteVariant'] ?>">
    <div class="scrolling-background"></div>

    <header class="site-header">
        <?php snippet('navbar') ?>
    </header>