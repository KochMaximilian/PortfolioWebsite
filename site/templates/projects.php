<?php snippet('header') ?>

<main class="main-wrapper">
    <h1><?= $page->title() ?></h1>

    <nav class="filter">
        <a href="<?= $page->url() ?>">All</a>
        <?php foreach ($filters as $filter): ?>
            <a href="<?= $page->url() ?>?filter=<?= $filter ?>"><?= $filter ?></a>
        <?php endforeach ?>
    </nav>
    <?php snippet('projects')?>
    <?php snippet('pagination') ?>
</main>

<?php snippet('footer') ?>