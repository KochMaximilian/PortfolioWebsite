<?php snippet('header') ?>
<div class="wrapper">
    <div class="project-layout">
        <main class="main-wrapper">
            <section class="content-block">
                <h1><?= $page->name() ?></h1>
            </section>

            <?php
            // Platform icon mapping
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

            // External link icon mapping
            $linkIconMap = [
                'steam'    => 'fa-brands fa-square-steam',
                'itch'     => 'fa-brands fa-itch-io',
                'youtube'  => 'fa-brands fa-square-youtube',
                'igdb'     => 'fa-solid fa-database',
                'github'   => 'fa-brands fa-square-github',
                'gamejolt' => 'fa-solid fa-bolt',
                'website'  => 'fa-solid fa-arrow-up-right-from-square',
            ];

            // Status display labels
            $statusLabels = [
                'released'       => 'Released',
                'prototype'      => 'Prototype',
                'in-development' => 'In Development',
                'early-access'   => 'Early Access',
                'cancelled'      => 'Cancelled',
                'game-jam'       => 'Game Jam Build',
            ];
            ?>

            <section class="project-main-container">

                <!-- HERO -->
                <div class="project-hero">
                    <?php if ($page->embedlink()->isNotEmpty()): ?>
                        <div class="project-hero-embed">
                            <?= Html::iframe($page->embedlink(), [
                                'title'          => $page->embedTitle(),
                                'frameborder'    => '0',
                                'allowfullscreen'=> true,
                                'allow'          => 'accelerometer; autoplay; encrypted-media; gyroscope;',
                                'loading'        => 'lazy',
                                'sandbox'        => 'allow-scripts allow-same-origin',
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

                <!-- NAME PLATE -->
                <div class="stat-name-plate">
                    <div class="stat-name-plate-text">
                        <span class="stat-project-title"><?= $page->name() ?></span>
                        <div class="stat-type-line">
                            <span class="stat-type-label"><?= $page->type() ?></span>
                            <span class="stat-type-divider">·</span>
                            <?php foreach ($page->genre()->split(',') as $genre): ?>
                                <span class="stat-tag stat-tag-genre"><?= trim($genre) ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="stat-engine-orb">
                        <svg role="img" aria-label="<?= $page->engine() ?> logo."><?= svg('/assets/fontawesome/engine-icons/' . $page->engineicon()) ?></svg>
                    </div>
                </div>

                <!-- FLAVOR TEXT -->
                <?php if ($page->flavortext()->isNotEmpty()): ?>
                    <div class="stat-flavor">
                        <?= $page->flavortext()->kti() ?>
                    </div>
                <?php endif; ?>

                <!-- AWARD ROW -->
                <?php if ($page->has_award()->toBool()): ?>
                    <div class="stat-award-row">
                        <i class="fa-solid fa-trophy" aria-hidden="true"></i>
                        <span class="stat-award-text"><?= $page->award_description()->or('Award Winner') ?></span>
                    </div>
                <?php endif; ?>

                <!-- STAT BODY -->
                <div class="stat-body">

                    <div class="stat-col-left">
                        <dl class="stat-table">
                            <div class="stat-row">
                                <dt>Year</dt>
                                <dd><?= $page->year() ?></dd>
                            </div>
                            <div class="stat-row">
                                <dt>Duration</dt>
                                <dd><?= $page->duration() ?></dd>
                            </div>
                            <?php if ($page->team()->isNotEmpty()): ?>
                                <div class="stat-row">
                                    <dt>Team</dt>
                                    <dd><?= $page->team() ?> <?= $page->team()->value() == 1 ? 'Member' : 'Members' ?></dd>
                                </div>
                            <?php endif; ?>
                            <div class="stat-row">
                                <dt>Engine</dt>
                                <dd><?= $page->engine() ?></dd>
                            </div>
                            <?php if ($page->projectstatus()->isNotEmpty()): ?>
                                <div class="stat-row">
                                    <dt>Status</dt>
                                    <dd><?= $statusLabels[$page->projectstatus()->value()] ?? $page->projectstatus() ?></dd>
                                </div>
                            <?php endif; ?>
                        </dl>

                        <?php if ($page->platform()->isNotEmpty()): ?>
                            <div class="stat-tag-block">
                                <span class="stat-label">Platforms</span>
                                <div class="stat-tag-group">
                                    <?php foreach ($page->platform()->split(',') as $platform): ?>
                                        <?php $iconClass = $platformIconMap[trim($platform)] ?? 'fa-solid fa-gamepad'; ?>
                                        <span class="stat-tag stat-tag-platform" title="<?= trim($platform) ?>">
                                            <i class="<?= $iconClass ?>" aria-hidden="true"></i>
                                            <?= trim($platform) ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($page->focus()->isNotEmpty()): ?>
                            <div class="stat-tag-block">
                                <span class="stat-label">Focus</span>
                                <div class="stat-tag-group">
                                    <?php foreach ($page->focus()->split(',') as $focus): ?>
                                        <span class="stat-tag stat-tag-focus"><?= trim($focus) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="stat-col-right">
                        <?php if ($page->description()->isNotEmpty()): ?>
                            <div class="stat-description">
                                <span class="stat-label">Description</span>
                                <div class="stat-description-text">
                                    <?= $page->description()->kirbytext() ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($page->externallinks()->isNotEmpty()): ?>
                            <div class="stat-links-block">
                                <span class="stat-label">Links</span>
                                <div class="stat-links-group">
                                    <?php foreach ($page->externallinks()->toStructure() as $link): ?>
                                        <?php $iconClass = $linkIconMap[$link->platform()->value()] ?? 'fa-solid fa-link'; ?>
                                        <a class="stat-link-icon" href="<?= $link->url() ?>" target="_blank" rel="noopener" title="<?= ucfirst($link->platform()) ?>">
                                            <i class="<?= $iconClass ?>" aria-hidden="true"></i>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

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
                    <div class="project-image-container">
                        <?php foreach ($showcaseImages as $image): ?>
                            <?php
                            // Determine media type
                            $videoUrl     = $image->video_url()->isNotEmpty() ? $image->video_url()->value() : null;
                            $videoExts    = ['mp4', 'webm'];
                            $isLocalVideo = in_array(strtolower($image->extension()), $videoExts);
                            $isVideo      = $videoUrl !== null || $isLocalVideo;

                            // Href for lightbox — external video URL takes priority, then file URL
                            $lightboxHref = $videoUrl ?? $image->url();

                            // Thumbnail
                            $isGif = strtolower($image->extension()) === 'gif';
                            if ($isGif || $isLocalVideo) {
                                $thumbUrl = $image->url();
                            } else {
                                $thumbUrl = $image->thumb([
                                    'autoOrient' => true,
                                    'width'      => 640,
                                    'height'     => 360,
                                    'crop'       => true,
                                    'quality'    => 70,
                                    'driver'     => 'im',
                                    'format'     => 'webp'
                                ])->url();
                            }

                            // Slide description — convert markdown to HTML, only escape quotes for the attribute
                            $slideDesc    = $image->description()->isNotEmpty() ? (string)$image->description()->kirbytext() : null;
                            $descPosition = $image->desc_position()->isNotEmpty() ? $image->desc_position()->value() : 'bottom';
                            ?>
                            <a class="project-image-link<?= $isVideo ? ' is-video' : '' ?>"
                                href="<?= $lightboxHref ?>"
                                data-gallery="project-gallery"
                                <?= $isLocalVideo ? 'data-type="video"' : '' ?>
                                <?= $slideDesc ? 'data-description="' . str_replace('"', '&quot;', $slideDesc) . '"' : '' ?>
                                data-desc-position="<?= $descPosition ?>">
                                <div class="image-slot">
                                    <img loading="lazy" alt="<?= $image->alt() ?>" class="project-gallary-image" src="<?= $thumbUrl ?>" />
                                    <?php if ($isVideo): ?>
                                        <div class="video-play-icon" aria-hidden="true">
                                            <i class="fa-solid fa-circle-play"></i>
                                        </div>
                                    <?php endif ?>
                                </div>
                                <?php if ($image->caption()->isNotEmpty()): ?>
                                    <div class="image-caption-badge"><?= $image->caption() ?></div>
                                <?php endif ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

            <?php if ($page->devlog()->isNotEmpty()): ?>
                <section class="devlog">
                    <div class="section-divider">
                        <span class="section-divider-badge">
                            <i class="fa-solid fa-pencil" aria-hidden="true"></i>
                            <span class="section-divider-title">Dev Notes</span>
                        </span>
                    </div>
                    <div class="devlog-content">
                        <?php foreach ($page->devlog()->toBlocks() as $block): ?>
                            <?= $block ?>
                        <?php endforeach ?>
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