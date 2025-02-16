<div class="wrapper">
    <?php snippet('header', slots: true) ?>
    <?php slot() ?><?php endslot() ?>

    <?php slot('head') ?>
    <!-- addtional meta tags or style if need.  -->
    <?php endslot() ?>
    <!-- End of head slot -->
    <?php endsnippet() ?>

    <main class="main-wrapper">
        <h1><?= $page->title() ?></h1>
        <nav class="filter">
            <a href="<?= $page->url() ?>">All</a>
            <?php foreach ($filters as $filter): ?>
                <a href="<?= $page->url() ?>?filter=<?= $filter ?>"><?= $filter ?></a>
            <?php endforeach ?>
        </nav>
        <?php snippet('projects') ?>
        <?php snippet('pagination') ?>
    </main>


</div>
<div class="footer-wrapper">
    <?php snippet('footer') ?>
</div>