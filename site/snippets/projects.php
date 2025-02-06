<?php
$width  = 400;
$height = 500;
?>

<ul class="projects">
    <?php foreach ($projects as $project): ?>
        <li>
            <a href="<?= $project->url() ?>">
                <figure>
                    <?= $project->image()->crop($width, $height) ?>
                    <figcaption>
                        <?= $project->title() ?><br>
                        <small><?= $project->type() ?></small>
                    </figcaption>
                </figure>
            </a>
        </li>
    <?php endforeach ?>
</ul>