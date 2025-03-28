<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page->title()->html() ?> | <?= $site->title()->html() ?></title>
    <?php snippet('favicon') ?>

    <link rel="preload" href="/assets/img/pattern.png" as="image">

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






    <?= $slots->head() ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="scrolling-background" id="background1"></div>
    <div class="scrolling-background" id="background2"></div>

    <header class="site-header">
        <?php snippet('navbar') ?>
    </header>