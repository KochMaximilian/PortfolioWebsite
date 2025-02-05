<?php snippet('header') ?>

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
    <?php snippet('pagination') ?>
</main>

<?php snippet('footer') ?>