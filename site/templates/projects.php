<?php snippet('header') ?>
<?php
$width = 400;
$height = 500;
?>


<main class="main-wrapper">
    <ul class="projects">
        <?php foreach ($page->children()->listed() as $project): ?>
            <li>
                <a href="<?= $project->url() ?>">
                    <figure>
                        <?php foreach ($project->images() as $image): ?>
                            <?= $project->image()->crop($width, $height) ?>
                        <?php endforeach; ?>
                        <figcaption><?= $project->title() ?></figcaption>
                    </figure>
                </a>
            </li>
        <?php endforeach ?>
    </ul>
</main>

<?php snippet('footer') ?>