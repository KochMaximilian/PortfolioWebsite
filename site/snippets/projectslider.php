<?php
$width  = 600;
$height = 300;
?>

<div class="main-carousel">
<div class="static-banner"><h2></h2></div> <!--TODO maybe do sometign with this -->
    <?php foreach ($projects as $project): ?>
        <div class="carousel-cell">
            <a href="<?= $project->url() ?>">
                <figure class="slider-figure">
                    <img class="slider-image" src="<?= $project->images()->template('gallery-image')->first()->thumb([
                        'autoOrient' => true,
                        'width' => $width, 
                        'height' => $height,
                        'crop' => true,
                        'quality' => 100,  
                        'format' => 'webp',
                        'driver' =>'im'  
                    ])->url() ?>" 
                    alt="Featured Project: <?= $project->title() ?>"> 
                    <figcaption>
                        <?= $project->title() ?><br>
                        <small><?= $project->type() ?></small>
                    </figcaption>
                </figure>
            </a>
        </div>
    <?php endforeach; ?>
</div>