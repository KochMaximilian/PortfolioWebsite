<?php snippet('header') ?>
<div class="wrapper">
    <div class="about-layout">
        <main class="main-wrapper">
            <section class="content-block">
                <h1><?= $page->title() ?></h1>
            </section>
            <section class="about-content">
                <div class="about-image">
                    <div class="about-card-header">
                        <span class="about-card-name"><?= $page->author_name() ?></span>
                    </div>
                    <div class="about-card-art">
                        <?php if ($page->currently_playing()->isNotEmpty()): ?>
                        <button class="now-playing-tag" type="button" aria-label="Currently playing">
                            <span class="now-playing-text">
                                <span class="now-playing-label">Currently Playing</span>
                                <span class="now-playing-game"><?= $page->currently_playing() ?></span>
                            </span>
                            <i class="fa-solid fa-gamepad now-playing-icon"></i>
                        </button>
                        <?php endif; ?>
                        <img class="author-image"
                            src="<?= $page->images()->template('personal-img')->first()->thumb([
                                        'autoOrient' => true,
                                        'width' => 400,
                                        'height' => 500,
                                        'crop' => true,
                                        'quality' => 80,
                                        'format' => 'webp',
                                        'driver' => 'im'
                                    ])->url() ?>"
                            alt="<?= $page->image()->alt() ?>"
                            srcset="
                    <?= $page->images()->template('personal-img')->first()->thumb([
                        'width' => 200,
                        'height' => 250,
                        'crop' => true,
                        'format' => 'webp',
                    ])->url() ?> 200w,
                    <?= $page->images()->template('personal-img')->first()->thumb([
                        'width' => 400,
                        'height' => 500,
                        'crop' => true,
                        'format' => 'webp',
                    ])->url() ?> 400w,
                    <?= $page->images()->template('personal-img')->first()->thumb([
                        'width' => 600,
                        'height' => 750,
                        'crop' => true,
                        'format' => 'webp',
                    ])->url() ?> 600w,
                    <?= $page->images()->template('personal-img')->first()->thumb([
                        'width' => 800,
                        'height' => 1000,
                        'crop' => true,
                        'format' => 'webp',
                    ])->url() ?> 800w
                "
                            sizes="(max-width: 480px) 100vw,
                       (max-width: 768px) 100vw,
                       (max-width: 992px) 300px,
                       (max-width: 1200px) 350px,
                       400px">
                        <?php if ($page->fav_games()->isNotEmpty()): ?>
                        <div class="about-card-focus-bar">
                            <span class="about-card-focus-label">Favourite Games</span>
                            <div class="about-card-focus-tags">
                                <?php foreach ($page->fav_games()->split(',') as $game): ?>
                                    <span class="about-card-keyword"><?= trim($game) ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="about-card-type-line">
                        <span class="about-card-type"><?= $page->role() ?></span>
                        <?php if ($page->location()->isNotEmpty()): ?>
                            <span class="about-card-type-divider">·</span>
                            <span class="about-card-location"><i class="fa-solid fa-location-dot"></i> <?= $page->location() ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="card-glare"></div>
                    <div class="about-card-footer">
                        <span class="about-card-footer-left">1st Edition</span>
                        <span class="about-card-footer-right">MK-PORTFOLIO-<?= date('Y') ?></span>
                    </div>
                </div>
                <div class="about-text-wrapper">
                    <div class="about-profile-header">
                        <span>Lore</span>
                    </div>
                    <?php if ($page->tagline()->isNotEmpty()): ?>
                    <div class="about-profile-tagline">
                        <span class="tagline-text">&ldquo;<?= $page->tagline() ?>&rdquo;</span>
                    </div>
                    <?php endif; ?>
                    <div class="about-profile-body">
                        <?= $page->author_description()->kt() ?>
                    </div>
                    <?php $cv = $page->files()->template('cv')->first(); ?>
                    <div class="about-profile-cv">
                        <a class="cv-download-btn" <?php if ($cv): ?>href="<?= url('download/cv') ?>" download<?php endif; ?>>
                            <i class="fa-solid fa-file-arrow-down"></i>
                            <span>Download CV</span>
                        </a>
                    </div>
                    <?php if ($page->social_links()->toStructure()->isNotEmpty()): ?>
                    <div class="about-profile-hotbar">
                        <?php foreach ($page->social_links()->toStructure() as $link): ?>
                            <a class="hotbar-slot" href="<?= $link->url() ?>" target="_blank" rel="noopener" aria-label="<?= $link->platform() ?>">
                                <i class="<?= $link->icon()->isNotEmpty() ? $link->icon()->value() : 'fa-solid fa-link' ?>"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </section>




            <!-- Skills Section — Character Sheet -->
            <section class="skills-sheet">
                <div class="skills-sheet__banner">
                    <h2 class="skills-sheet__banner-title">Skills</h2>
                </div>
                <div class="skills-sheet__body">

                    <!-- Left Sidebar — Game Design -->
                    <div class="skills-sheet__sidebar">
                        <div class="skills-sheet__cat-header">
                            <span class="skills-sheet__icon skills-sheet__icon--lg" aria-hidden="true"></span>
                            <h3 class="skills-sheet__cat-title skills-sheet__cat-title--lg">Game Design</h3>
                        </div>
                        <div class="skills-sheet__tags skills-sheet__tags--lg">
                            <?php foreach ($page->game_design_skills()->split(',') as $skill): ?>
                                <span class="skills-sheet__tag skills-sheet__tag--lg"><?= trim($skill) ?></span>
                            <?php endforeach ?>
                        </div>
                    </div>

                    <!-- Right Side — Other Categories -->
                    <div class="skills-sheet__main">

                        <!-- Row 1: Engines + Programming -->
                        <div class="skills-sheet__row">
                            <div class="skills-sheet__panel">
                                <div class="skills-sheet__panel-header">
                                    <span class="skills-sheet__icon skills-sheet__icon--sm" aria-hidden="true"></span>
                                    <h3 class="skills-sheet__cat-title skills-sheet__cat-title--sm">Engines</h3>
                                </div>
                                <div class="skills-sheet__tags">
                                    <?php foreach ($page->editors()->split(',') as $engine): ?>
                                        <span class="skills-sheet__tag"><?= trim($engine) ?></span>
                                    <?php endforeach ?>
                                </div>
                            </div>
                            <div class="skills-sheet__panel">
                                <div class="skills-sheet__panel-header">
                                    <span class="skills-sheet__icon skills-sheet__icon--sm" aria-hidden="true"></span>
                                    <h3 class="skills-sheet__cat-title skills-sheet__cat-title--sm">Programming</h3>
                                </div>
                                <div class="skills-sheet__tags">
                                    <?php foreach ($page->programming_source()->split(',') as $lang): ?>
                                        <span class="skills-sheet__tag"><?= trim($lang) ?></span>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>

                        <!-- Row 2: Tools + Production -->
                        <div class="skills-sheet__row">
                            <div class="skills-sheet__panel">
                                <div class="skills-sheet__panel-header">
                                    <span class="skills-sheet__icon skills-sheet__icon--sm" aria-hidden="true"></span>
                                    <h3 class="skills-sheet__cat-title skills-sheet__cat-title--sm">Tools</h3>
                                </div>
                                <div class="skills-sheet__tags">
                                    <?php foreach ($page->software()->split(',') as $tool): ?>
                                        <span class="skills-sheet__tag"><?= trim($tool) ?></span>
                                    <?php endforeach ?>
                                </div>
                            </div>
                            <div class="skills-sheet__panel">
                                <div class="skills-sheet__panel-header">
                                    <span class="skills-sheet__icon skills-sheet__icon--sm" aria-hidden="true"></span>
                                    <h3 class="skills-sheet__cat-title skills-sheet__cat-title--sm">Production</h3>
                                </div>
                                <div class="skills-sheet__tags">
                                    <?php foreach ($page->production()->split(',') as $item): ?>
                                        <span class="skills-sheet__tag"><?= trim($item) ?></span>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>

                        <!-- Row 3: Languages Strip -->
                        <div class="skills-sheet__lang-strip">
                            <span class="skills-sheet__icon skills-sheet__icon--xs" aria-hidden="true"></span>
                            <span class="skills-sheet__lang-title">Languages</span>
                            <div class="skills-sheet__lang-entries">
                                <?php $langs = $page->languages()->split(','); ?>
                                <?php foreach ($langs as $i => $lang):
                                    $lang = trim($lang);
                                    // Parse "German (Native)" → name + level
                                    if (preg_match('/^(.+?)\s*\((.+?)\)$/', $lang, $m)):
                                        $name = trim($m[1]);
                                        $level = trim($m[2]);
                                    else:
                                        $name = $lang;
                                        $level = '';
                                    endif;
                                ?>
                                    <?php if ($i > 0): ?>
                                        <span class="skills-sheet__lang-sep"></span>
                                    <?php endif; ?>
                                    <span class="skills-sheet__lang-entry">
                                        <span class="skills-sheet__lang-name"><?= $name ?></span>
                                        <?php if ($level): ?>
                                            <span class="skills-sheet__lang-level"><?= $level ?></span>
                                        <?php endif; ?>
                                    </span>
                                <?php endforeach ?>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </main>
    </div>
</div>
<?php snippet('footer') ?>