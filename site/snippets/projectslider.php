<?php
$width  = 600;
$height = 300;
?>

<div class="glider-contain">
    <div class="glider slider-grid ">
        <?php foreach ($projects as $project): ?>
                <a href="<?= $project->url() ?>">
                    <figure>
                        <img src="<?= $project->images()->template('gallery-image')->first()->thumb([
                            'autoOrient' => true,
                            'width' => $width, 
                            'height' => $height,
                            'crop' => true,
                            'quality' => 100, /* For faster loading */ 
                            'format' => 'webp', /* For faster loading */  
                        ])->url() ?>" 
                        alt="Featured Project: <?= $project->title() ?>"> <!-- End of image -->
                        <figcaption>
                            <?= $project->title() ?><br>
                            <small><?= $project->type() ?></small>
                        </figcaption>
                    </figure>
                </a>
           
        <?php endforeach ?>
        </div>
  
    <button aria-label="Previous" class="glider-prev">Previous</button>
    <button aria-label="Next" class="glider-next">Next</button>
    <div role="tablist" class="dots"></div>
   
</div>
