<?php
$width  = 500;
$height = 500;
?>

<div class="projects">
    <?php foreach ($projects as $project): ?>
    
            <a class="projects-link" href="<?= $project->url() ?>">
                <figure class="projects-figure">
                    <?= $project->images()->template('gallery-image')->first()->thumb([
                        'autoOrient' => true,
                        'width' => $width, 
                        'height' => $height,
                        'crop' => true,
                        'quality' => 80, /*For faster loading*/ 
                        'fromat' => 'webp', /*For faster loading*/  
                    ])
                        ?>
                    <figcaption class="projects-caption">
                        <?= $project->title() ?><br>
                        <small><?= $project->type() ?></small>
                    </figcaption>
                </figure>
            </a>
        
    <?php endforeach ?>
</>