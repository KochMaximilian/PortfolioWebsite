<?php snippet('header') ?>
<?php
$width = 400;
$height = 500;

$filterBy = get('filter');
$unfilterd = $page->children()->listed()->sortBy('year', 'desc');

$projects = $unfilterd
->when($filterBy, function($filterBy){
    return $this->filterBy('year', $filterBy);
})
->paginate(3);

$pagination = $projects->pagination();
$filters = $unfilterd->pluck('year', null , true); /* unique values = true */

?>


<main class="main-wrapper">
    <h1><?= $page->title() ?></h1>
    
    <nav class="filter">
        <a href="<?= $page->url() ?>">All</a>
        <?php foreach ($filters as $filter): ?>
        <a href="<?= $page->url() ?>?filter=<?= $filter ?>"><?= $filter ?></a>
        <?php endforeach ?>
    </nav>

    <ul class="projects">

        <?php foreach ($projects as $project): ?>
            <li>
                <a href="<?= $project->url() ?>">
                    <figure>
                        <?= $project->image()->crop($width, $height) ?>
                        <figcaption>
                            <?= $project->title() ?><br>
                            <small><?= $project->type() ?></small>
                        </figcaption>
                    </figure>
                </a>
            </li>
        <?php endforeach ?>

    </ul>

    <?php if ($pagination->hasPages()): ?>
    <nav class="pagination">
        <?php if ($pagination->hasPrevPage()): ?>
        <a href="<?= $pagination->prevPageUrl() ?>" aria-label="Previous page">&larr;</a> <!-- Todo: replace arrows with svg -->
        <?php else: ?>
            <span aria-hidden="true">&larr;</span>
        <?php endif ?>

            <span>Page <?=$pagination->page()?> of <?=$pagination->pages()?></span>

        <?php if ($pagination->hasNextPage()): ?>
        <a href="<?= $pagination->nextPageUrl() ?>" aria-label="Next page">&rarr;</a> <!-- Todo: replace arrows with svg -->
        <?php else: ?>
            <span aria-hidden="true">&rarr;</span>
        <?php endif?>
    </nav>
    <?php endif ?>

</main>

<?php snippet('footer') ?>