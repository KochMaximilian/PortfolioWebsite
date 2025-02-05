<?php snippet('header') ?>
<?php
$width = 400;
$height = 500;
$projects = $page->children()->listed()->paginate(2);
$pagination = $projects->pagination();
?>


<main class="main-wrapper">
    <ul class="projects">

        <?php foreach ($projects as $project): ?>
            <li>
                <a href="<?= $project->url() ?>">
                    <figure>
                        <?= $project->image()->crop($width, $height) ?>
                        <figcaption><?= $project->title() ?></figcaption>
                    </figure>
                </a>
            </li>
        <?php endforeach ?>

    </ul>

    <nav>
        <a href="<?= $pagination->prevPageUrl() ?>" aria-label="Previous page">&larr;</a> <!-- Todo: replace arrows with svg -->
        <a href="<?= $pagination->nextPageUrl() ?>" aria-label="Next page">&rarr;</a>
    </nav>
</main>

<?php snippet('footer') ?>