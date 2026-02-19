<?php snippet('header') ?>
<div class="wrapper">
    <div class="project-layout">
        <main class="main-wrapper">
            <section class="content-block">
                <h1><?= $page->name() ?></h1>
            </section>

            <section class="project-main-container">
                <figure class="project-figure">
                    <div class="project-gallery">
                        <?php if ($embed = $page->embedlink()->isNotEmpty()): ?>
                            <div class="responsive-iframe-container">
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
                            <div>
                                <?php $coverImage = $page->images()->template('gallery-image')->limit(1); ?>
                                <?php foreach ($coverImage as $image): ?>
                                    <img
                                        loading="lazy"
                                        alt="<?= $image->alt() ?>"
                                        class="project-image"
                                        src="<?= $image->resize(600, 600)->url() ?>">
                                <?php endforeach ?>
                            </div>
                        <?php endif ?>

                    </div>

                    <figcaption class="project-info">
                        <dl>
                            <div>
                                <dt>Project Type:</dt>
                                <dd><?= $page->type() ?></dd>
                            </div>
                            <?php if ($page->team()->isNotEmpty()): ?>
                                <div>
                                    <dt>Team Size:</dt>
                                    <dd><?= $page->team() ?></dd>
                                </div>
                            <?php endif; ?>
                            <div>
                                <dt>Genre:</dt>
                                <dd><?php foreach ($page->genre() as $genre): ?><span class="project-genre"> <?= $genre ?></span> <?php endforeach; ?></dd>
                            </div>
                            <div>
                                <dt>Platforms:</dt>
                                <dd><?php foreach ($page->platform() as $platform): ?><span class="project-platform"><?= $platform ?></span> <?php endforeach; ?></dd>
                            </div>
                            <div>
                                <dt>Release Year:</dt>
                                <dd><?= $page->year() ?></dd>
                            </div>
                            <div>
                                <dt>Project Duration:</dt>
                                <dd><?= $page->duration() ?></dd>
                            </div>
                            <div>
                                <dt>Area of Focus:</dt>
                                <dd><?php foreach ($page->focus() as $focus): ?> <span class="project-focus"><?= $focus ?></span> <?php endforeach; ?></dd>
                            </div>
                            <?php if ($page->has_award()->toBool()): ?>
                                <div class="award-info">
                                    <dt><i class="fa-solid fa-trophy"></i> Award:</dt>
                                    <dd><?= $page->award_description()->or('Award Winner') ?></dd>
                                </div>
                            <?php endif; ?>
                            <div>
                                <dt>Game Engine:</dt>
                                <dd><?= $page->engine() ?></dd>
                            </div>
                            <?php if ($page->links()->isNotEmpty()): ?>
                                <div>
                                    <dt>Additional Links:</dt>
                                    <dd><a class="additional-link" href="<?= $page->links() ?>" title="<?= $page->links() ?>"><?= Url::short($page->links(), 30) ?></a></dd>
                                </div>
                            <?php endif; ?>
                        </dl>
                    </figcaption>
                </figure>
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
                            // Preserve GIF animation — skip webp conversion for .gif files
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
            // Next/Previous project navigation
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