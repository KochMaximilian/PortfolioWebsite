<?php snippet('header', slots: true) ?>
<?php slot() ?><?php endslot() ?>

<?php slot('head') ?>
<!-- additional meta tags or style if needed. -->
<?php endslot() ?>
<!-- End of head slot -->
<?php endsnippet() ?>

<div class="wrapper">
    <main class="main-wrapper">

        <section class="content-block">
            <h1><?= $page->title() ?></h1>
        </section>

        <section class="filter-block">
            <?php snippet('filter') ?>
        </section>

        <section class="projects-block">
            <?php snippet('projects') ?>
        </section>

        <section class="pagination-block">
            <?php snippet('pagination') ?>
        </section>

    </main>
</div>

<div class="footer-wrapper">
    <?php snippet('footer') ?>
</div>