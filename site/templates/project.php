<?php snippet('header') ?>
<div class="wrapper">
    <div class="project-layout">
        <main class="main-wrapper">
            <section class="content-block">
                <h1><?= $page->name() ?></h1>
            </section>

            <?php
            // Platform icon mapping (matches projects.php card set symbols)
            $platformIconMap = [
                'PC Windows'      => 'fa-brands fa-windows',
                'Playstation 4'   => 'fa-brands fa-playstation',
                'Playstation 5'   => 'fa-brands fa-playstation',
                'Xbox One'        => 'fa-brands fa-xbox',
                'Xbox Series S/X' => 'fa-brands fa-xbox',
                'Nintendo Switch' => 'fa-solid fa-gamepad',
                'Android'         => 'fa-brands fa-android',
                'iOS'             => 'fa-brands fa-apple',
                'Web'             => 'fa-solid fa-globe',
            ];
            ?>

            <section class="project-main-container">

                <!-- HERO — Full-width embed or cover image -->
                <div class="project-hero">
                    <?php if ($page->embedlink()->isNotEmpty()): ?>
                        <div class="project-hero-embed">
                            <?= Html::iframe($page->embedlink(), [
                                'title' => $page->embedTitle(),
                                'frameborder' => '0',
                                'allowfullscreen' => true,
                                'allow' => 'accelerometer; autoplay; encrypted-media; gyroscope;',
                                'loading' => 'lazy',
                                'sandbox' => 'allow-scripts allow-same-origin',
                                'referrerpolicy' => 'strict-origin-when-cross-origin'
                            ]) ?>
                        </div>
                    <?php else: ?>
                        <?php $coverImage = $page->images()->template('gallery-image')->first(); ?>
                        <?php if ($coverImage): ?>
                            <img
                                loading="lazy"
                                alt="<?= $coverImage->alt() ?>"
                                class="project-hero-image"
                                src="<?= $coverImage->resize(1200)->url() ?>">
                        <?php endif ?>
                    <?php endif ?>
                </div>

                <!-- NAME PLATE — Title + Type stacked, Engine Orb right -->
                <div class="stat-name-plate">
                    <div class="stat-name-plate-text">
                        <span class="stat-project-title"><?= $page->name() ?></span>
                        <span class="stat-type-label"><?= $page->type() ?></span>
                    </div>
                    <div class="stat-engine-orb">
                        <svg role="img" aria-label="<?= $page->engine() ?> logo."><?= svg('/assets/fontawesome/engine-icons/' . $page->engineicon()) ?></svg>
                    </div>
                </div>

                <!-- AWARD ROW -->
                <?php if ($page->has_award()->toBool()): ?>
                    <div class="stat-award-row">
                        <i class="fa-solid fa-trophy" aria-hidden="true"></i>
                        <span class="stat-award-text"><?= $page->award_description()->or('Award Winner') ?></span>
                    </div>
                <?php endif; ?>

                <!-- STAT BODY — grouped by proximity, no dividers -->
                <div class="stat-body">

                    <!-- Quick Stats: Year, Duration, Team, Engine -->
                    <div class="stat-group stat-row-quick">
                        <div class="stat-item">
                            <dt>Year</dt>
                            <dd><?= $page->year() ?></dd>
                        </div>
                        <div class="stat-item">
                            <dt>Duration</dt>
                            <dd><?= $page->duration() ?></dd>
                        </div>
                        <?php if ($page->team()->isNotEmpty()): ?>
                            <div class="stat-item">
                                <dt>Team</dt>
                                <dd><?= $page->team() ?> <?= $page->team()->value() == 1 ? 'Member' : 'Members' ?></dd>
                            </div>
                        <?php endif; ?>
                        <div class="stat-item">
                            <dt>Engine</dt>
                            <dd><?= $page->engine() ?></dd>
                        </div>
                    </div>

                    <!-- Genre Tags -->
                    <div class="stat-group stat-row-tags">
                        <dt class="stat-row-label">Genre</dt>
                        <dd class="stat-tag-group">
                            <?php foreach ($page->genre()->split(',') as $genre): ?>
                                <span class="stat-tag stat-tag-genre"><?= trim($genre) ?></span>
                            <?php endforeach; ?>
                        </dd>
                    </div>

                    <!-- Platform Tags -->
                    <div class="stat-group stat-row-tags">
                        <dt class="stat-row-label">Platforms</dt>
                        <dd class="stat-tag-group">
                            <?php foreach ($page->platform()->split(',') as $platform): ?>
                                <?php $iconClass = $platformIconMap[trim($platform)] ?? 'fa-solid fa-gamepad'; ?>
                                <span class="stat-tag stat-tag-platform" title="<?= trim($platform) ?>">
                                    <i class="<?= $iconClass ?>" aria-hidden="true"></i>
                                    <?= trim($platform) ?>
                                </span>
                            <?php endforeach; ?>
                        </dd>
                    </div>

                    <!-- Focus Areas -->
                    <?php if ($page->focus()->isNotEmpty()): ?>
                        <div class="stat-group stat-row-tags">
                            <dt class="stat-row-label">Focus</dt>
                            <dd class="stat-tag-group">
                                <?php foreach ($page->focus()->split(',') as $focus): ?>
                                    <span class="stat-tag stat-focus-keyword"><?= trim($focus) ?></span>
                                <?php endforeach; ?>
                            </dd>
                        </div>
                    <?php endif; ?>

                    <!-- Additional Links -->
                    <?php if ($page->links()->isNotEmpty()): ?>
                        <div class="stat-group stat-row-tags">
                            <dt class="stat-row-label"><i class="fa-solid fa-link" aria-hidden="true"></i> Link</dt>
                            <dd><a class="additional-link" href="<?= $page->links() ?>" title="<?= $page->links() ?>"><?= Url::short($page->links(), 40) ?></a></dd>
                        </div>
                    <?php endif; ?>

                </div>
            </section>


            <section class="project-description">
                <details>
                    <summary aria-expanded="false">Project Description<br>
                        <i aria-hidden="true" class="fa-solid fa-caret-down"></i>
                    </summary>
                    <?= $page->description()->kirbytext() ?>
                </details>
            </section>



            <?php
            $showcaseImages = $page->images()->filterBy('template', 'showcase-image');

            if ($showcaseImages->isNotEmpty()): ?>
                <section class="lightbox">
                    <div class="section-divider">
                        <span class="section-divider-badge">
                            <i class="fa-solid fa-images" aria-hidden="true"></i>
                            <span class="section-divider-title">Gallery</span>
                            <span class="section-divider-count"><?= $showcaseImages->count() ?></span>
                        </span>
                    </div>
                    <div id="gallery" class="project-image-container">
                        <?php foreach ($showcaseImages as $image): ?>
                            <?php
                            $isGif = strtolower($image->extension()) === 'gif';
                            if ($isGif) {
                                $thumbUrl = $image->thumb([
                                    'autoOrient' => true,
                                    'width' => 400,
                                    'height' => 400,
                                    'crop' => true,
                                    'quality' => 70,
                                    'driver' => 'im',
                                ])->url();
                            } else {
                                $thumbUrl = $image->thumb([
                                    'autoOrient' => true,
                                    'width' => 400,
                                    'height' => 400,
                                    'crop' => true,
                                    'quality' => 70,
                                    'driver' => 'im',
                                    'format' => 'webp'
                                ])->url();
                            }
                            ?>
                            <a class="project-image-link" href="<?= $image->url() ?>"
                                data-pswp-width="<?= $image->width() ?>"
                                data-pswp-height="<?= $image->height() ?>"
                                target="_blank">
                                <div class="image-slot">
                                    <img loading="lazy" alt="<?= $image->alt() ?>" class="project-gallary-image" src="<?= $thumbUrl ?>" />
                                </div>
                                <?php if ($image->caption()->isNotEmpty()): ?>
                                    <div class="image-caption-badge"><?= $image->caption() ?></div>
                                <?php endif ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

            <?php
            $prevProject = $page->prev();
            $nextProject = $page->next();
            ?>
            <?php if ($prevProject || $nextProject): ?>
                <nav class="project-nav">
                    <?php if ($prevProject): ?>
                        <a href="<?= $prevProject->url() ?>" class="project-nav-link project-nav-prev" aria-label="Previous project: <?= $prevProject->name() ?>">
                            <span class="project-nav-button">
                                <i class="fa-solid fa-caret-left" aria-hidden="true"></i>
                                <span class="project-nav-label">Previous</span>
                            </span>
                            <span class="project-nav-name"><?= $prevProject->name() ?></span>
                        </a>
                    <?php else: ?>
                        <span class="project-nav-link project-nav-dead" aria-hidden="true">
                            <span class="project-nav-button">
                                <i class="fa-solid fa-caret-left" aria-hidden="true"></i>
                                <span class="project-nav-label">Previous</span>
                            </span>
                        </span>
                    <?php endif; ?>

                    <?php if ($nextProject): ?>
                        <a href="<?= $nextProject->url() ?>" class="project-nav-link project-nav-next" aria-label="Next project: <?= $nextProject->name() ?>">
                            <span class="project-nav-name"><?= $nextProject->name() ?></span>
                            <span class="project-nav-button">
                                <span class="project-nav-label">Next</span>
                                <i class="fa-solid fa-caret-right" aria-hidden="true"></i>
                            </span>
                        </a>
                    <?php else: ?>
                        <span class="project-nav-link project-nav-dead" aria-hidden="true">
                            <span class="project-nav-button">
                                <span class="project-nav-label">Next</span>
                                <i class="fa-solid fa-caret-right" aria-hidden="true"></i>
                            </span>
                        </span>
                    <?php endif; ?>
                </nav>
            <?php endif; ?>

        </main>
    </div>
</div>
<?php snippet('footer') ?>