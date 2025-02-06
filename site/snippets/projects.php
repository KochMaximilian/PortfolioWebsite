<?php
$width  = 500;
$height = 500;
?>

<ul class="projects">
    <?php foreach ($projects as $project): ?>
        <li>
            <a href="<?= $project->url() ?>">
                <figure>
                    <?= $project->images()->template('gallery-image')->first()->thumb([
                        'autoOrient' => true,
                        'width' => $width, 
                        'height' => $height,
                        'crop' => true,
                        'quality' => 80, /*For faster loading*/ 
                        'fromat' => 'webp', /*For faster loading*/
                        
                    ])
                        ?>
                    <figcaption>
                        <?= $project->title() ?><br>
                        <small><?= $project->type() ?></small>
                    </figcaption>
                </figure>
            </a>
        </li>
    <?php endforeach ?>
</ul>