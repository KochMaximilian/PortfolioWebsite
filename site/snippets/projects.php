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
                    <h6 class="projects-subtext"><?= $project->type() ?> &nbsp;|&nbsp; <?= $project->year() ?> </>
                </figcaption>
                <div class="project-details">
                    <div class="tag-container">
                        <?php foreach ($project->genre()->split(',') as $genre): ?>
                            <span class="projects-genre-tag"><?= $genre ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="engine-icon">
                    <h6>Created in:</h6><svg> <?= svg('/assets/fontawesome/engine-icons/' . $project->engineicon()) ?></svg>
                </div>
            </figure>
        </a>
    <?php endforeach ?>
</div>