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

            <?php
            $enginePatternMap = [
                'Unity' => 'unity',
                'Unreal Engine 5' => 'unreal',
                'Godot' => 'godot',
            ];
            $engineSlug = $enginePatternMap[$page->engine()->value()] ?? 'unity';
            ?>
            <section class="project-main-container engine-<?= $engineSlug ?>">

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
                                src="<?= $coverImage->thumb([
                                    'autoOrient' => true,
                                    'width'      => 1200,
                                    'quality'    => 80,
                                    'format'     => 'webp',
                                    'driver'     => 'im'
                                ])->url() ?>">
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
                        <?= $page->flavortext()->kt() ?>
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
                            <?php if ($page->role()->isNotEmpty()): ?>
                                <div class="stat-row">
                                    <dt>Role</dt>
                                    <dd><?= $page->role() ?></dd>
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
                        </span>
                    </div>
                    <div class="project-image-container">
                        <?php foreach ($showcaseImages as $image): ?>
                            <?php
                            $videoUrl     = $image->video_url()->isNotEmpty() ? $image->video_url()->value() : null;
                            $videoExts    = ['mp4', 'webm'];
                            $isLocalVideo = in_array(strtolower($image->extension()), $videoExts);
                            $isVideo      = $videoUrl !== null || $isLocalVideo;
                            $lightboxHref = $videoUrl ?? $image->url();
                            $isGif        = strtolower($image->extension()) === 'gif';

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

                            $slideDesc = $image->description()->isNotEmpty()
                                ? str_replace('"', '&quot;', $image->description()->kirbytext())
                                : '';
                            ?>
                            <a href="<?= $lightboxHref ?>"
                               class="image-slot"
                               data-gallery="project-gallery"
                               <?php if ($isVideo): ?>data-type="video"<?php endif ?>
                               data-description="<?= $slideDesc ?>">
                                <div class="image-slot-inner">
                                    <img class="project-gallery-image" src="<?= $thumbUrl ?>" alt="<?= $image->alt()->or($page->name()) ?>" loading="lazy">
                                    <?php if ($isVideo): ?>
                                        <span class="video-play-icon"><i class="fa-solid fa-circle-play" aria-hidden="true"></i></span>
                                    <?php endif ?>
                                </div>
                                <?php if ($image->caption()->isNotEmpty()): ?>
                                    <span class="image-caption-badge"><?= $image->caption() ?></span>
                                <?php endif ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

            <?php
            $tocItems = [];
            if ($page->devlog()->isNotEmpty()) {
                foreach ($page->devlog()->toBlocks() as $block) {
                    if ($block->type() !== 'heading') continue;
                    if ($block->anchorid()->isEmpty()) continue;
                    $rawText  = strip_tags((string)$block->text());
                    $customId = trim($block->anchorid()->value());
                    $anchorId = Str::slug($customId);
                    $level    = (string)$block->level()->or('h2');
                    $tocItems[] = ['id' => $anchorId, 'label' => $rawText, 'level' => $level];
                }
            }
            ?>

            <?php if ($page->devlog()->isNotEmpty()): ?>
                <section class="devlog">
                    <div class="section-divider">
                        <span class="section-divider-badge">
                            <i class="fa-solid fa-book-open" aria-hidden="true"></i>
                            <span class="section-divider-title">Dev Notes</span>
                        </span>
                    </div>
                    <?php if ($page->show_toc()->toBool() && !empty($tocItems)): ?>
                        <?php snippet('toc-inline', ['tocItems' => $tocItems]) ?>
                    <?php endif; ?>

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
                <nav class="project-nav" id="project-nav-bottom">
                    <?php if ($prevProject): ?>
                        <a href="<?= $prevProject->url() ?>" class="project-nav-link project-nav-prev" aria-label="Previous project: <?= $prevProject->name() ?>">
                            <i class="fa-solid fa-caret-left" aria-hidden="true"></i>
                            <span class="project-nav-name"><?= $prevProject->name() ?></span>
                        </a>
                    <?php else: ?>
                        <span class="project-nav-link project-nav-dead" aria-hidden="true">
                            <i class="fa-solid fa-caret-left" aria-hidden="true"></i>
                        </span>
                    <?php endif; ?>

                    <?php if ($nextProject): ?>
                        <a href="<?= $nextProject->url() ?>" class="project-nav-link project-nav-next" aria-label="Next project: <?= $nextProject->name() ?>">
                            <span class="project-nav-name"><?= $nextProject->name() ?></span>
                            <i class="fa-solid fa-caret-right" aria-hidden="true"></i>
                        </a>
                    <?php else: ?>
                        <span class="project-nav-link project-nav-dead" aria-hidden="true">
                            <i class="fa-solid fa-caret-right" aria-hidden="true"></i>
                        </span>
                    <?php endif; ?>
                </nav>

                <!-- Mobile-only inline buttons (scroll-to-top + TOC) — hidden on desktop -->
                <div class="project-nav-mobile-utils">
                    <?php if (!empty($tocItems)): ?>
                        <button class="toc-toggle toc-toggle-mobile" aria-label="Table of contents" aria-expanded="false" aria-controls="toc-panel" type="button">
                            <i class="fa-solid fa-list" aria-hidden="true"></i>
                        </button>
                    <?php endif; ?>
                    <button class="scroll-to-top scroll-to-top-mobile" aria-label="Scroll to top" type="button">
                        <i class="fa-solid fa-chevron-up" aria-hidden="true"></i>
                    </button>
                </div>
            <?php endif; ?>

        </main>
    </div>
</div>

<?php if ($prevProject || $nextProject): ?>
    <!-- TOC PANEL — appears above sticky nav left group -->
<?php if (!empty($tocItems)): ?>
<div class="toc-panel" id="toc-panel" aria-hidden="true">
    <div class="toc-header">
        <span class="toc-header-title">Development Notes Contents</span>
        <div class="toc-header-line"></div>
    </div>
    
    <nav class="toc-inner" aria-label="Table of contents">
        <?php foreach ($tocItems as $item): ?>
            <a href="#<?= htmlspecialchars($item['id']) ?>" 
               class="toc-item toc-item--<?= $item['level'] ?>">
                <span class="toc-item-text"><?= htmlspecialchars($item['label']) ?></span>
            </a>
        <?php endforeach; ?>
    </nav>
</div>
<?php endif; ?>

    <!-- STICKY NAV — bouncy pop-in after 300px scroll, hides near bottom nav -->
    <nav class="project-nav-sticky" aria-label="Project navigation">
        <div class="project-nav-sticky-group">
            <?php if ($prevProject): ?>
                <a href="<?= $prevProject->url() ?>" class="project-nav-sticky-link project-nav-sticky-prev" aria-label="Previous project: <?= $prevProject->name() ?>">
                    <i class="fa-solid fa-caret-left" aria-hidden="true"></i>
                    <span class="project-nav-sticky-name"><?= $prevProject->name() ?></span>
                </a>
            <?php else: ?>
                <span class="project-nav-sticky-link project-nav-sticky-dead" aria-hidden="true">
                    <i class="fa-solid fa-caret-left" aria-hidden="true"></i>
                </span>
            <?php endif; ?>
            <?php if (!empty($tocItems)): ?>
                <button class="toc-toggle" aria-label="Table of contents" aria-expanded="false" aria-controls="toc-panel" type="button">
                    <i class="fa-solid fa-list" aria-hidden="true"></i>
                </button>
            <?php endif; ?>
        </div>

        <div class="project-nav-sticky-group">
            <button class="scroll-to-top" aria-label="Scroll to top" type="button">
                <i class="fa-solid fa-chevron-up" aria-hidden="true"></i>
            </button>
            <?php if ($nextProject): ?>
                <a href="<?= $nextProject->url() ?>" class="project-nav-sticky-link project-nav-sticky-next" aria-label="Next project: <?= $nextProject->name() ?>">
                    <span class="project-nav-sticky-name"><?= $nextProject->name() ?></span>
                    <i class="fa-solid fa-caret-right" aria-hidden="true"></i>
                </a>
            <?php else: ?>
                <span class="project-nav-sticky-link project-nav-sticky-dead" aria-hidden="true">
                    <i class="fa-solid fa-caret-right" aria-hidden="true"></i>
                </span>
            <?php endif; ?>
        </div>
    </nav>
<?php endif; ?>

<?php snippet('footer') ?>