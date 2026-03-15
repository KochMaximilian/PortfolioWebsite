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
                        <a class="cv-download-btn" <?php if ($cv): ?>href="<?= $cv->url() ?>" download<?php endif; ?>>
                            <i class="fa-solid fa-file-arrow-down"></i>
                            <span>Download CV</span>
                        </a>
                    </div>
                    <?php
                        $socialIcons = [
                            'linkedin'   => 'fa-brands fa-linkedin',
                            'artstation' => 'fa-brands fa-artstation',
                            'github'     => 'fa-brands fa-square-github',
                            'itch'       => 'fa-brands fa-itch-io',
                            'youtube'    => 'fa-brands fa-square-youtube',
                        ];
                    ?>
                    <?php if ($page->social_links()->toStructure()->isNotEmpty()): ?>
                    <div class="about-profile-hotbar">
                        <?php foreach ($page->social_links()->toStructure() as $link): ?>
                            <a class="hotbar-slot" href="<?= $link->url() ?>" target="_blank" rel="noopener" aria-label="<?= $link->platform() ?>">
                                <i class="<?= $socialIcons[$link->platform()->value()] ?? 'fa-solid fa-link' ?>"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </section>




            <!-- Skills Section -->
            <section class="skills">
                <h2 class="subcontent-block">Skills</h2>
                <div class="skills-content">
                    <div class="skills-category">
                        <h3>Game Design Skills</h3>
                        <ul class="skills-list">
                            <?php foreach ($page->game_design_skills()->split(',') as $skill): ?>
                                <li class="skill-item"><?= $skill ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <div class="skills-category">
                        <h3>Tools & Software</h3>
                        <ul class="skills-list">
                            <?php foreach ($page->software()->split(',') as $tool): ?>
                                <li class="skill-item"><?= $tool ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <div class="skills-category">
                        <h3>Game Engines & Editors</h3>
                        <ul class="skills-list">
                            <?php foreach ($page->editors()->split(',') as $engine): ?>
                                <li class="skill-item"><?= $engine ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <div class="skills-category">
                        <h3>Production & Communication</h3>
                        <ul class="skills-list">
                            <?php foreach ($page->production()->split(',') as $engine): ?>
                                <li class="skill-item"><?= $engine ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <div class="skills-category">
                        <h3>Programming & Version Control</h3>
                        <ul class="skills-list">
                            <?php foreach ($page->programming_source()->split(',') as $engine): ?>
                                <li class="skill-item"><?= $engine ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <div class="skills-category">
                        <h3>Languages</h3>
                        <ul class="skills-list">
                            <?php foreach ($page->languages()->split(',') as $engine): ?>
                                <li class="skill-item"><?= $engine ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </section>

        </main>
    </div>
</div>
<?php snippet('footer') ?>