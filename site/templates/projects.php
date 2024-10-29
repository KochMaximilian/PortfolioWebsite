<?php snippet('header') ?>

<main class="main-wrapper">
    <ul>
        <?php foreach ($page->children()->listed() as $project): ?>
            <li>
                <a href="<?= $project->url() ?>">
                    <figure>
                        <?php foreach ($project->images() as $image): ?>
                            <?= $project->image()->crop(400) ?>
                        <?php endforeach; ?>
                        <figcaption><?= $project->title() ?></figcaption>
                    </figure>
                </a>
            </li>
        <?php endforeach ?>
    </ul>
</main>

<?php snippet('footer') ?>