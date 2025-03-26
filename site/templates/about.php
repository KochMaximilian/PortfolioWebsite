<?php snippet('header') ?>
<div class="wrapper">
    <div class="about-layout">
        <main class="main-wrapper">
            <section class="content-block">
                <h1><?= $page->title() ?></h1>
            </section>
            <section class="about-content">
                <div class="about-image">
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
                </div>
                <div class="about-text">
                    <p><?= $page->author_description() ?></p>
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