<?php snippet('header') ?>
<div class="wrapper">
    <div class="project-layout">
        <main>
            <section class="content-block">
                <h1><?= $page->name() ?></h1>
            </section>

            <section class="project-main-container">
                <div class="project-gallery">
                    <?php if ($embed = $page->embedlink()->toEmbed()): ?>
                        <?= $embed->code() ?>
                    <?php else: ?>
                        <div>
                            <?php $coverImage = $page->images()->template('gallery-image')->limit(1); ?>
                            <?php foreach ($coverImage as $image): ?>
                                <img
                                    loading="lazy"
                                    alt="<?= $image->alt() ?>"
                                    class="project-image"
                                    src="<?= $image->resize(600, 600)->url() ?>">

                            <?php endforeach ?>
                        </div>
                    <?php endif ?>
                </div>

                <div class="project-info">
    <dl>
        <div><dt>Title:</dt> <dd><?= $page->name() ?></dd></div>
        <div><dt>Description:</dt> <dd><?= $page->type() ?></dd></div>
        <div><dt>Genre:</dt> <dd><?php foreach ($page->genre()->split(',') as $genre): ?> <?= $genre ?> <?php endforeach; ?></dd></div>
        <div><dt>Platforms:</dt> <dd><?php foreach ($page->platform()->split(',') as $platform): ?> <?= $platform ?> <?php endforeach; ?></dd></div>
        <div><dt>Release Year:</dt> <dd><?= $page->year() ?></dd></div>
        <div><dt>Project Duration:</dt> <dd><?= $page->duration() ?></dd></div>
        <div><dt>Area of Focus:</dt> <dd><?php foreach ($page->focus()->split(',') as $focus): ?> <?= $focus ?> <?php endforeach; ?></dd></div>
        <div><dt>Game Engine:</dt> <dd><?= $page->engine() ?></dd></div>
        <?php if ($page->links()->isNotEmpty()): ?>
            <div><dt>Additional Links:</dt> <dd><a href="<?= $page->links() ?>"><?= $page->links() ?></a></dd></div>
        <?php endif; ?>
    </dl>
</div>

            </section>

   
        </main>
    </div>
</div>
<div class="footer-wrapper">
    <?php snippet('footer') ?>
</div>