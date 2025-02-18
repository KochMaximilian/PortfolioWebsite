<?php
$width  = 500;
$height = 500;
?>

<div class="projects">
    <?php foreach ($projects as $project): ?>

        <a class="projects-link" href="<?= $project->url() ?>">
            <figure class="projects-figure">
                <?= $project->images()->template('gallery-image')->first()->thumb([
                    'autoOrient' => true,
                    'width' => $width,
                    'height' => $height,
                    'crop' => true,
                    'quality' => 80, /*For faster loading*/
                    'fromat' => 'webp', /*For faster loading*/
                ])
                ?>
                <figcaption class="projects-caption">
                    <h5><?= $project->title() ?><br></h5>
                    <small class="projects-subtext"><?= $project->type() ?> &nbsp;|&nbsp; <?= $project->year() ?></small><br>
                    <span class="engine-icon" aria-label="<?=$project->engine() ?> Logo Icon"><?= svg('/assets/fontawesome/engine-icons/' . $project->engineicon()) ?></span>
                </figcaption>
            </figure>
        </a>

    <?php endforeach ?>
</div>