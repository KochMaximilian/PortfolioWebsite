<?php snippet('header') ?>
<div class="wrapper">
    <div class="about-layout">
        <main class="main-wrapper">
            <!-- Content Block Section with Title -->
            <section class="content-block">
                <h1><?= $page->title() ?></h1> <!-- Your h1 remains here -->
            </section>

            <!-- About Content Section -->
            <section class="about-content">
        

                <div class="about-image">
              
                <img class="slider-image" src="<?= $page->images()->template('personal-img')->first()->thumb([
                        'autoOrient' => true,
                        'width' => 500, 
                        'height' => 600,
                        'crop' => true,
                        'quality' => 100,  
                        'format' => 'webp',
                        'driver' =>'im'  
                    ])->url() ?>" 
                    alt="<?= $page->image()->alt() ?>"> 
                </div>
        
                <div class="about-text">
                    <p><?= $page->author_description() ?></p>
                </div>
            </section>

            <!-- Skills Sections -->
            <section class="skills">
                <h2>Skills</h2>
                <div class="skills-content">
                    <div class="skills-category">
                        <h3>Game Design Skills</h3>
                        <ul>
                            <?php foreach ($page->game_design_skills()->split(',') as $skill): ?>
                                <li><?= $skill ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <div class="skills-category">
                        <h3>Tools & Software</h3>
                        <ul>
                            <?php foreach ($page->software()->split(',') as $tool): ?>
                                <li><?= $tool ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <div class="skills-category">
                        <h3>Game Engines & Editors</h3>
                        <ul>
                            <?php foreach ($page->editors()->split(',') as $engine): ?>
                                <li><?= $engine ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>
<?php snippet('footer') ?>
