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
                    <h5><?= $project->name() ?></h5>
                    <small class="projects-subtext"><?= $project->type() ?> &nbsp;|&nbsp; <?= $project->year() ?> </small><br>
                    <div class="project-details">
                        <div>
                            <?php foreach ($project->genre()->split(',') as $genre): ?>
                                <span><?= $genre ?></span>
                            <?php endforeach; ?>
                        </div>
                        <div> <?= svg('/assets/fontawesome/engine-icons/' . $project->engineicon()) ?></div>
                        <div></div>
                    </div>


                </figcaption>
            </figure>
        </a>

    <?php endforeach ?>
</div>