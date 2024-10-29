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
                            <?= $project->image()->crop($width, $height) ?>
                        <figcaption><?= $project->title() ?></figcaption>
                    </figure>
                </a>
            </li>
        <?php endforeach ?>
    </ul>
</main>

<?php snippet('footer') ?>