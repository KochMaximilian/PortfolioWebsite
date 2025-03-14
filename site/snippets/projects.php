<div class="projects">
    <?php foreach ($projects as $project): ?>
        <a class="projects-link" href="<?= $project->url() ?>">
            <figure class="projects-figure">
                <img 
                    src="<?= $project->images()->template('gallery-image')->first()->thumb([
                        'autoOrient' => true,
                        'width' => 500,
                        'height' => 500,
                        'crop' => true,
                        'quality' => 60,
                        'format' => 'webp',
                        'driver' => 'im'
                    ])->url() ?>"
                    alt="<?= $project->name() ?>"
                    srcset="
                        <?= $project->images()->template('gallery-image')->first()->thumb([
                            'width' => 300,
                            'height' => 300,
                            'crop' => true,
                            'quality' => 50,
                            'format' => 'webp',
                        ])->url() ?> 300w,
                        <?= $project->images()->template('gallery-image')->first()->thumb([
                            'width' => 500,
                            'height' => 500,
                            'crop' => true,
                            'quality' => 60,
                            'format' => 'webp',
                        ])->url() ?> 500w,
                        <?= $project->images()->template('gallery-image')->first()->thumb([
                            'width' => 700,
                            'height' => 700,
                            'crop' => true, 
                            'quality' => 70,
                            'format' => 'webp',
                        ])->url() ?> 700w,
                        <?= $project->images()->template('gallery-image')->first()->thumb([
                            'width' => 900,
                            'height' => 900,
                            'crop' => true,
                            'quality' => 75,
                            'format' => 'webp',
                        ])->url() ?> 900w
                    "
                    sizes="(max-width: 375px) 200px, 
                           (max-width: 575px) 300px,
                           (max-width: 992px) 350px, 
                           33vw"
                >
                
                <figcaption class="projects-caption">
                    <h5><?= $project->name() ?></h5>
                    <h6 class="projects-subtext"><?= $project->type() ?> &nbsp;|&nbsp; <?= $project->year() ?></h6>
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