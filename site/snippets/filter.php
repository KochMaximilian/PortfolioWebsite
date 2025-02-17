<nav class="filter">
    <a href="<?= $page->url() ?>" class="button-all <?= !$filterBy ? 'activeFilter' : '' ?>">All</a>
    <?php foreach ($filters as $filter): ?>
        <a href="<?= $page->url() ?>?filter=<?= $filter ?>" class="button-filter <?= $filterBy == $filter ? 'activeFilter' : '' ?>"><?= $filter ?></a>
    <?php endforeach ?>


</nav>