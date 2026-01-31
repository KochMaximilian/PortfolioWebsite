<div class="projects">
    <?php foreach ($projects as $project): ?>
        <a class="projects-link" href="<?= $project->url() ?>">
            <figure class="projects-figure">
                <div class="card-frame">
                    
                    <!-- Header: Name + Engine Icon -->
                    <div class="card-header">
                        <h5 class="card-title"><?= $project->name() ?></h5>
                        <div class="card-mana">
                            <svg role="img" aria-label="<?= $project->engine() ?> logo."><?= svg('/assets/fontawesome/engine-icons/' . $project->engineicon()) ?></svg>
                        </div>
                    </div>
                    
                    <!-- Art Box with Platform Set Symbol -->
                    <div class="card-art">
                        <img 
                            src="<?= $project->images()->template('gallery-image')->first()->thumb([
                                'autoOrient' => true,
                                'width' => 420,
                                'height' => 420,
                                'crop' => true,
                                'quality' => 60,
                                'format' => 'webp',
                                'driver' => 'im'
                            ])->url() ?>"
                            alt="<?= $project->name() ?>"
                            srcset="
                                <?= $project->images()->template('gallery-image')->first()->thumb([
                                    'width' => 250,
                                    'height' => 250,
                                    'crop' => true,
                                    'quality' => 50,
                                    'format' => 'webp',
                                ])->url() ?> 250w,
                                <?= $project->images()->template('gallery-image')->first()->thumb([
                                    'width' => 350,
                                    'height' => 350,
                                    'crop' => true,
                                    'quality' => 55,
                                    'format' => 'webp',
                                ])->url() ?> 350w,
                                <?= $project->images()->template('gallery-image')->first()->thumb([
                                    'width' => 420,
                                    'height' => 420,
                                    'crop' => true,
                                    'quality' => 60,
                                    'format' => 'webp',
                                ])->url() ?> 420w,
                                <?= $project->images()->template('gallery-image')->first()->thumb([
                                    'width' => 500,
                                    'height' => 500,
                                    'crop' => true,
                                    'quality' => 65,
                                    'format' => 'webp',
                                ])->url() ?> 500w,
                                <?= $project->images()->template('gallery-image')->first()->thumb([
                                    'width' => 700,
                                    'height' => 700,
                                    'crop' => true, 
                                    'quality' => 70,
                                    'format' => 'webp',
                                ])->url() ?> 700w
                            "
                            sizes="(max-width: 375px) 200px, 
                                   (max-width: 575px) 250px,
                                   (max-width: 768px) 300px,
                                   (max-width: 992px) 350px,
                                   (max-width: 1366px) 380px,
                                   (max-width: 1920px) 420px,
                                   (min-width: 1921px) 450px"
                        >
                        <!-- Platform Set Symbol -->
                        <div class="card-set-symbol">
                            <?php 
                            $platforms = $project->platform()->split(',');
                            $platformIcons = [
                                'PC Windows' => 'fa-brands fa-windows',
                                'Playstation 4' => 'fa-brands fa-playstation',
                                'Playstation 5' => 'fa-brands fa-playstation',
                                'Xbox One' => 'fa-brands fa-xbox',
                                'Xbox Series S/X' => 'fa-brands fa-xbox',
                                'Nintendo Switch' => 'fa-solid fa-gamepad',
                                'Android' => 'fa-brands fa-android',
                                'iOS' => 'fa-brands fa-apple',
                                'Web' => 'fa-solid fa-globe'
                            ];
                            foreach ($platforms as $platform): 
                                $iconClass = $platformIcons[trim($platform)] ?? 'fa-solid fa-gamepad';
                            ?>
                                <i class="<?= $iconClass ?>" title="<?= $platform ?>"></i>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <!-- Type Line: Project Type + Genre Tags + Year -->
                    <div class="card-type-line">
                        <div class="card-type-left">
                            <span class="card-type"><?= $project->type() ?></span>
                            <span class="card-divider">—</span>
                            <?php foreach ($project->genre()->split(',') as $genre): ?>
                                <span class="card-tag"><?= $genre ?></span>
                            <?php endforeach; ?>
                        </div>
                        <span class="card-year"><?= $project->year() ?></span>
                    </div>
                    
                    <!-- Focus Areas (Keyword Abilities) -->
                    <?php if ($project->focus()->isNotEmpty()): ?>
                    <div class="card-focus-bar">
                        <?php foreach ($project->focus()->split(',') as $focus): ?>
                            <span class="card-focus-keyword"><?= trim($focus) ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Text Box: Description -->
                    <div class="card-text-box">
                        <?php if ($project->description()->isNotEmpty()): ?>
                            <p class="card-description"><?= $project->description()->excerpt(100) ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Card Footer: Collector Info -->
                    <div class="card-footer">
                        <span class="card-footer-engine"><?= $project->engine() ?></span>
                        <span class="card-footer-set">
                            <?php 
                            // Create set code from project type
                            $typeMap = [
                                'Professional' => 'PRO',
                                'Personal' => 'PER',
                                'Game Jam' => 'JAM',
                            ];
                            $setCode = $typeMap[$project->type()->value()] ?? 'PRJ';
                            echo $setCode . '-' . $project->year();
                            ?>
                        </span>
                    </div>
                    
                </div>
            </figure>
        </a>
    <?php endforeach ?>
</div>