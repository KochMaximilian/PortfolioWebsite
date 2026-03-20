<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <title><?= $page->title()->html() ?> | <?= $site->title()->html() ?></title>

    <?php
    // ── SEO Meta ──
    // Priority: per-page seo_description → auto-generated → site-level fallback
    $metaDescription = '';
    if ($page->seo_description()->isNotEmpty()) {
        $metaDescription = $page->seo_description()->excerpt(160);
    } elseif ($page->intendedTemplate()->name() === 'project' && $page->description()->isNotEmpty()) {
        $metaDescription = $page->description()->excerpt(160);
    } elseif ($page->intendedTemplate()->name() === 'about') {
        $metaDescription = 'Learn about ' . ($site->author()->or('Maximilian Koch')) . ' — ' . ($page->role()->or('Game Designer')) . '. Portfolio, skills, and experience.';
    } elseif ($site->description()->isNotEmpty()) {
        $metaDescription = $site->description()->excerpt(160);
    }

    // Per-page keywords merged with site-level
    $keywords = '';
    if ($page->seo_keywords()->isNotEmpty()) {
        $keywords = $page->seo_keywords()->value();
        if ($site->keywords()->isNotEmpty()) {
            $keywords .= ', ' . $site->keywords()->value();
        }
    } elseif ($site->keywords()->isNotEmpty()) {
        $keywords = $site->keywords()->value();
    }

    // OG image: custom og-image → template-specific → first listed project cover
    $ogImage = $page->images()->template('og-image')->first();
    if (!$ogImage) {
        if ($page->intendedTemplate()->name() === 'project') {
            $ogImage = $page->images()->template('gallery-image')->first();
        } elseif ($page->intendedTemplate()->name() === 'about') {
            $ogImage = $page->images()->template('personal-img')->first();
        }
    }
    if (!$ogImage) {
        $fallbackProject = page('projects') ? page('projects')->children()->listed()->first() : null;
        if ($fallbackProject) {
            $ogImage = $fallbackProject->images()->template('gallery-image')->first();
        }
    }

    // OG type
    $ogType = ($page->intendedTemplate()->name() === 'project') ? 'article' : 'website';
    ?>

    <?php if ($metaDescription): ?>
    <meta name="description" content="<?= esc($metaDescription, 'attr') ?>">
    <?php endif ?>

    <?php if ($keywords): ?>
    <meta name="keywords" content="<?= esc($keywords, 'attr') ?>">
    <?php endif ?>

    <meta name="author" content="<?= ($site->author()->isNotEmpty() ? $site->author()->html() : 'Maximilian Koch') ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?= $page->url() ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= $page->title()->html() ?> | <?= $site->title()->html() ?>">
    <meta property="og:type" content="<?= $ogType ?>">
    <meta property="og:url" content="<?= $page->url() ?>">
    <?php if ($metaDescription): ?>
    <meta property="og:description" content="<?= esc($metaDescription, 'attr') ?>">
    <?php endif ?>
    <?php if ($ogImage): ?>
    <meta property="og:image" content="<?= $ogImage->resize(1200)->url() ?>">
    <meta property="og:image:width" content="1200">
    <?php endif ?>
    <meta property="og:site_name" content="<?= $site->title()->html() ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="<?= $ogImage ? 'summary_large_image' : 'summary' ?>">
    <meta name="twitter:title" content="<?= $page->title()->html() ?> | <?= $site->title()->html() ?>">
    <?php if ($metaDescription): ?>
    <meta name="twitter:description" content="<?= esc($metaDescription, 'attr') ?>">
    <?php endif ?>
    <?php if ($ogImage): ?>
    <meta name="twitter:image" content="<?= $ogImage->resize(1200)->url() ?>">
    <?php endif ?>

    <?php
    // ── JSON-LD Structured Data ──
    $schema = [];

    // Site-level: Person schema (always)
    $personSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Person',
        'name' => (string) $site->author()->or('Maximilian Koch'),
        'url' => $site->url(),
        'jobTitle' => 'Game Designer',
    ];
    if ($site->linkedin()->isNotEmpty()) {
        $personSchema['sameAs'][] = (string) $site->linkedin();
    }
    if ($site->github()->isNotEmpty()) {
        $personSchema['sameAs'][] = (string) $site->github();
    }
    if ($site->youtube()->isNotEmpty()) {
        $personSchema['sameAs'][] = (string) $site->youtube();
    }
    if ($site->itchio()->isNotEmpty()) {
        $personSchema['sameAs'][] = (string) $site->itchio();
    }
    if ($site->twitter()->isNotEmpty()) {
        $personSchema['sameAs'][] = (string) $site->twitter();
    }
    $schema[] = $personSchema;

    // Project pages: CreativeWork schema
    if ($page->intendedTemplate()->name() === 'project') {
        $projectSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'CreativeWork',
            'name' => (string) $page->name(),
            'url' => $page->url(),
            'author' => [
                '@type' => 'Person',
                'name' => (string) $site->author()->or('Maximilian Koch'),
            ],
        ];
        if ($page->description()->isNotEmpty()) {
            $projectSchema['description'] = (string) $page->description()->excerpt(300);
        }
        if ($page->year()->isNotEmpty()) {
            $projectSchema['dateCreated'] = (string) $page->year();
        }
        if ($page->genre()->isNotEmpty()) {
            $projectSchema['genre'] = (string) $page->genre();
        }
        if ($ogImage) {
            $projectSchema['image'] = $ogImage->resize(1200)->url();
        }
        $schema[] = $projectSchema;
    }

    // BreadcrumbList
    $breadcrumbItems = [];
    $breadcrumbItems[] = [
        '@type' => 'ListItem',
        'position' => 1,
        'name' => 'Home',
        'item' => $site->url(),
    ];
    if ($page->intendedTemplate()->name() !== 'home') {
        $pos = 2;
        // Add parent for project pages
        if ($page->intendedTemplate()->name() === 'project' && $page->parent()) {
            $breadcrumbItems[] = [
                '@type' => 'ListItem',
                'position' => $pos,
                'name' => (string) $page->parent()->title(),
                'item' => $page->parent()->url(),
            ];
            $pos++;
        }
        $breadcrumbItems[] = [
            '@type' => 'ListItem',
            'position' => $pos,
            'name' => (string) $page->title(),
            'item' => $page->url(),
        ];
    }
    $schema[] = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $breadcrumbItems,
    ];
    ?>
    <?php foreach ($schema as $s): ?>
    <script type="application/ld+json"><?= json_encode($s, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
    <?php endforeach ?>

    <link rel="icon" href="<?= url('assets/favicon/favicon.ico') ?>" type="image/x-icon">

    <?php
    // Pick a random site variant per page load — drives both background pattern + footer logo
    $variants = ['piece', 'shaka', 'ok'];
    $GLOBALS['siteVariant'] = $variants[array_rand($variants)];
    ?>

    <link rel="preload" href="/assets/img/pattern_<?= $GLOBALS['siteVariant'] ?>.png" as="image">

    <?php if ($page->intendedTemplate()->name() === 'home'): ?>
        <?= css('assets/css/config/utility/flickity.css') ?>
        <?= css('assets/css/carousel.css') ?>
    <?php endif; ?>

    <?php if ($page->intendedTemplate()->name() === 'project'): ?>
        <?= css('assets/glightbox/glightbox.min.css') ?>
    <?php endif ?>

    <link rel="stylesheet" href="<?= url('assets/fontawesome/css/fontawesome.min.css') ?>" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="<?= url('assets/fontawesome/css/brands.min.css') ?>" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="<?= url('assets/fontawesome/css/solid.min.css') ?>" media="print" onload="this.media='all'">
    <noscript>
        <?= css('assets/fontawesome/css/fontawesome.min.css') ?>
        <?= css('assets/fontawesome/css/brands.min.css') ?>
        <?= css('assets/fontawesome/css/solid.min.css') ?>
    </noscript>

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

    <link href="https://fonts.bunny.net/css2?family=Barlow:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="variant-<?= $GLOBALS['siteVariant'] ?>">
    <a class="skip-to-content" href="#main-content">Skip to content</a>
    <div class="scrolling-background"></div>

    <header class="site-header">
        <?php snippet('navbar') ?>
    </header>