<div class="projects">
    <?php foreach ($projects as $project): ?>

        <a class="projects-link" href="<?= $project->url() ?>">
            <figure class="projects-figure">
                <?= $project->images()->template('gallery-image')->first()->thumb([
                    'autoOrient' => true,
                    'width' => 500,
                    'height' => 500,
                    'crop' => true,
                    'quality' => 50, /*For faster loading*/
                    'driver' => 'im',
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
                <div class="engine-icon-container">
                    <h6>Created with:</h6><svg role="img" aria-label="<?= $project->engine() ?> logo."> <?= svg('/assets/fontawesome/engine-icons/' . $project->engineicon()) ?></svg>
                </div>
            </figure>
        </a>
    <?php endforeach ?>
</div>