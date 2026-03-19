<?php snippet('header') ?>
<div class="wrapper">
    <div class="about-layout">
        <main class="main-wrapper" id="main-content">
            <section class="content-block">
                <h1><?= $page->title() ?></h1>
            </section>
            <section class="about-content">
                <div class="about-image">
                    <div class="about-card-header">
                        <span class="about-card-name"><?= $page->author_name() ?></span>
                    </div>
                    <div class="about-card-art">
                        <?php if ($page->languages()->isNotEmpty()): ?>
                        <div class="about-card-lang-tags">
                            <?php foreach ($page->languages()->split(',') as $lang):
                                $lang = trim($lang);
                                $name = preg_replace('/\s*\(.*?\)$/', '', $lang);
                            ?>
                                <span class="about-card-lang-tag"><?= $name ?></span>
                            <?php endforeach ?>
                        </div>
                        <?php endif; ?>
                        <?php if ($page->currently_playing()->isNotEmpty()): ?>
                        <button class="now-playing-tag" type="button" aria-label="Currently playing">
                            <span class="now-playing-text">
                                <span class="now-playing-label">Currently Playing</span>
                                <span class="now-playing-game"><?= $page->currently_playing() ?></span>
                            </span>
                            <i class="fa-solid fa-gamepad now-playing-icon"></i>
                        </button>
                        <?php endif; ?>
                        <?php $personalImg = $page->images()->template('personal-img')->first(); ?>
                        <img class="author-image"
                            src="<?= $personalImg->thumb([
                                        'autoOrient' => true,
                                        'width' => 400,
                                        'height' => 500,
                                        'crop' => true,
                                        'quality' => 80,
                                        'format' => 'webp',
                                        'driver' => 'im'
                                    ])->url() ?>"
                            alt="<?= $personalImg->alt()->or($page->author_name()->or('Profile photo')) ?>"
                            width="400"
                            height="500"
                            srcset="
                    <?= $personalImg->thumb(['width' => 200, 'height' => 250, 'crop' => true, 'format' => 'webp'])->url() ?> 200w,
                    <?= $personalImg->thumb(['width' => 400, 'height' => 500, 'crop' => true, 'format' => 'webp'])->url() ?> 400w,
                    <?= $personalImg->thumb(['width' => 600, 'height' => 750, 'crop' => true, 'format' => 'webp'])->url() ?> 600w,
                    <?= $personalImg->thumb(['width' => 800, 'height' => 1000, 'crop' => true, 'format' => 'webp'])->url() ?> 800w
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
                            <a class="hotbar-slot" href="<?= $link->url() ?>" target="_blank" rel="noopener noreferrer" aria-label="<?= $link->platform() ?>">
                                <i class="<?= $link->icon()->isNotEmpty() ? $link->icon()->value() : 'fa-solid fa-link' ?>"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </section>


            <!-- Skills — Skill Tree -->
            <section class="skills-tree">
                <?php
                $categories = [
                    ['label' => 'Game Design', 'field' => $page->game_design_skills(), 'mod' => 'gd',    'icon' => 'fa-solid fa-dice-d20'],
                    ['label' => 'Engines',     'field' => $page->editors(),             'mod' => 'eng',   'icon' => 'fa-solid fa-gear'],
                    ['label' => 'Programming', 'field' => $page->programming_source(),  'mod' => 'prg',   'icon' => 'fa-solid fa-code'],
                    ['label' => 'Tools',       'field' => $page->software(),            'mod' => 'tools', 'icon' => 'fa-solid fa-screwdriver-wrench'],
                    ['label' => 'Production',  'field' => $page->production(),          'mod' => 'prod',  'icon' => 'fa-solid fa-list-check'],
                ];
                ?>
                <div class="skills-tree__branches">
                    <h2 class="skills-tree__heading">Proficiencies</h2>
                    <?php foreach ($categories as $cat): ?>
                    <div class="skills-tree__branch skills-tree__branch--<?= $cat['mod'] ?>">
                        <div class="skills-tree__root"><i class="<?= $cat['icon'] ?>"></i> <?= $cat['label'] ?></div>
                        <div class="skills-tree__connector"></div>
                        <div class="skills-tree__nodes">
                            <?php foreach ($cat['field']->split(',') as $skill): ?>
                            <span class="skills-tree__node"><?= trim($skill) ?></span>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </section>

        </main>
    </div>
</div>
<?php snippet('footer') ?>