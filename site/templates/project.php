<?php snippet('header') ?>
<div class="wrapper">



    <?php
    $imageWidth = 600;
    $imageHeight = 600;
    ?>
    <div class="project-layout">
        <main>
            <section class="content-block">
                <h1><?= $page->title() ?></h1>
            </section>

            <section class="project-visuals-block">
                <div class="project-gallery">
                    <?php if ($embed = $page->embedlink()->toEmbed()): ?>
                        <div>
                            <?= $embed->code() ?>

                        </div>
                    <?php endif ?>
                    <ul>
                        <?php $coverImage = $page->images()->template('gallery-image')->limit(1); ?>
                        <?php foreach ($coverImage as $image): ?>
                            <li>
                                <a href="<?= $image->url() ?>">
                                    <img
                                        loading="lazy"
                                        alt="<?= $image->alt() ?>"
                                        class="project-image"
                                        src="<?= $image->resize($imageWidth, $imageHeight)->url() ?>">
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </section>

            <section>
                <div class="project-info">
                    <?= $page->context() ?>
                    <dl>
                        <dt>Title:</dt>
                        <dd><?= $page->name()->upper() ?></dd>

                        <dt>Description:</dt>
                        <dd><?= $page->description() ?></dd>

                        <dt>Project Type</dt>
                        <dd><?= $page->type() ?></dd>

                        <dt>Genre:</dt>
                        <?php foreach ($page->genre()->split(',') as $genre): ?>
                            <dd><?= $genre ?></dd>
                        <?php endforeach; ?>

                        <dt>Platform:</dt>
                        <?php foreach ($page->platform()->split(',') as $platfrom): ?>
                            <dd><?= $platfrom ?></dd>
                        <?php endforeach; ?>

                        <dt>Year:</dt>
                        <dd><?= $page->year() ?></dd>

                        <dt>Project Length:</dt>
                        <dd><?= $page->projectLength() ?></dd>

                        <dt>Area of Focus:</dt>
                        <?php foreach ($page->focus()->split(',') as $focus): ?>
                            <dd><?= $focus ?></dd>
                        <?php endforeach; ?>

                        <dt>Game Engine:</dt>
                        <dd><?= $page->engine() ?></dd>

                        <?php if ($page->links()->isNotEmpty()): ?>
                            <dt>Links:</dt>
                            <dd><a href="<?= $page->links() ?>"><?= $page->links() ?></a></dd>
                        <?php endif ?>
                    </dl>
                </div>
            </section>


        </main>
    </div>
</div>
<div class="footer-wrapper">
    <?php snippet('footer') ?>
</div>